<?php
/**
 * Plugin Name: Headless Career Form API
 * Description: Custom REST API for React Career form (no plugins).
 * Author: Ragavi
 * Version: 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ---------------------------------------------------------
 * 1. REGISTER REST API ENDPOINT
 * ---------------------------------------------------------
 */
add_action('rest_api_init', function () {
    register_rest_route('career-form/v1', '/submit', [
        'methods'  => 'POST',
        'callback' => 'hcfa_career_submission',
        'permission_callback' => '__return_true',
    ]);
});



/**
 * ---------------------------------------------------------
 * 2. HANDLE FORM SUBMISSION
 * ---------------------------------------------------------
 */

 function hcfa_career_submission(WP_REST_Request $request) {

    // ---------- reCAPTCHA ----------
    $token = sanitize_text_field($_POST['recaptcha_token'] ?? '');

    if (!$token) {
        return new WP_REST_Response([
            'message' => 'Captcha missing'
        ], 400);
    }

    $secret = '6LcoXl8sAAAAAJTYe_o_MvxJ0iz9O9hcP6R16wUw';

    $response = wp_remote_post(
        'https://www.google.com/recaptcha/api/siteverify',
        [
            'body' => [
                'secret' => $secret,
                'response' => $token
            ]
        ]
    );

    $result = json_decode(wp_remote_retrieve_body($response), true);

    if (empty($result['success'])) {
        return new WP_REST_Response([
            'message' => 'Captcha verification failed'
        ], 403);
    }

    // ---------- Fields ----------
    $name  = sanitize_text_field($_POST['fullName'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $city  = sanitize_text_field($_POST['city'] ?? '');
    $role  = sanitize_text_field($_POST['role'] ?? '');
    $experience  = sanitize_text_field($_POST['experience'] ?? '');
    $notice  = sanitize_text_field($_POST['notice'] ?? '');

    if (!$name || !$email || !$role) {
        return new WP_REST_Response([
            'message' => 'Missing required fields'
        ], 400);
    }

    // ---------- File validation ----------
    if (empty($_FILES['resume'])) {
        return new WP_REST_Response([
            'message' => 'Resume file required'
        ], 400);
    }

    $file = $_FILES['resume'];
    $allowed = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];

    if (!in_array($file['type'], $allowed)) {
        return new WP_REST_Response([
            'message' => 'Invalid file type. Only PDF or DOC/DOCX allowed.'
        ], 400);
    }

    if ($file['size'] > 2 * 1024 * 1024) {
        return new WP_REST_Response([
            'message' => 'File too large (max 2MB)'
        ], 400);
    }

    // Upload file
    require_once ABSPATH . 'wp-admin/includes/file.php';
    $upload = wp_handle_upload($file, ['test_form' => false]);

    if (isset($upload['error'])) {
        return new WP_REST_Response([
            'message' => 'File upload failed'
        ], 500);
    }

    // ---------- Mail ----------
    $to = [
        'darshana@netiapps.com',
        'manoj.p@netiapps.com'
    ];
    
    $subject = "New Career Application – $role";

    $body = "
Name  : $name
Email : $email
Phone : $phone
City  : $city
Role  : $role
Experience : $experience
Notice Period : $notice
";

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        "Reply-To: $email"
    ];

    $attachments = [$upload['file']];

    if (wp_mail($to, $subject, $body, $headers, $attachments)) {
        return new WP_REST_Response([
            'status' => 'success'
        ], 200);
    }

    return new WP_REST_Response([
        'message' => 'Mail sending failed'
    ], 500);
}


add_action('rest_api_init', function () {
    add_filter('rest_pre_serve_request', function ($value) {

        $origin = get_http_origin();
        $allowed_origins = [
            'http://localhost:3000',
            'http://127.0.0.1:3000',
        ];

        if ($origin && in_array($origin, $allowed_origins)) {
            header("Access-Control-Allow-Origin: $origin");
            header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
            header("Access-Control-Allow-Headers: Content-Type");
            header("Access-Control-Allow-Credentials: true");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            status_header(200);
            exit;
        }

        return $value;
    });
});



add_action('phpmailer_init', function ($phpmailer) {

    $phpmailer->isSMTP();
    $phpmailer->Host       = 'mail.wlsindia.in';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = 465;
    $phpmailer->SMTPSecure = 'ssl';

    $phpmailer->Username   = 'noreply@wlsindia.in';
    $phpmailer->Password   = "4gj3,,7p52Ue'QQ";

    $phpmailer->From       = 'noreply@wlsindia.in';
    $phpmailer->FromName   = 'Netiapps';
});

add_filter('wp_mail_from', function () {
    return 'noreply@wlsindia.in';
});

add_filter('wp_mail_from_name', function () {
    return 'Netiapps';
});

add_action('wp_mail_failed', function ($error) {
    error_log(print_r($error, true));
});
