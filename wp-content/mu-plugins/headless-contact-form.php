<?php
/**
 * Plugin Name: Headless Contact Form API
 * Description: Custom REST API for React contact form (no plugins).
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

    register_rest_route('contact-form/v1', '/submit', [
        'methods'  => 'POST',
        'callback' => 'hcfa_handle_submission',
        'permission_callback' => '__return_true', // required for public forms
    ]);

});



/**
 * ---------------------------------------------------------
 * 2. HANDLE FORM SUBMISSION
 * ---------------------------------------------------------
 */
function hcfa_handle_submission(WP_REST_Request $request) {

    $data = $request->get_json_params();

    // Sanitize fields
    $name    = sanitize_text_field($data['name'] ?? '');
    $email   = sanitize_email($data['email'] ?? '');
    $phone   = sanitize_text_field($data['phone'] ?? '');
    $company = sanitize_text_field($data['company'] ?? '');
    $subject = sanitize_text_field($data['subject'] ?? '');
    $message = sanitize_textarea_field($data['message'] ?? '');

    // Validate required fields
    if (!$name || !$email || !$subject || !$message) {
        return new WP_REST_Response([
            'status'  => 'error',
            'message' => 'Missing required fields'
        ], 400);
    }

    // Email config
    $to = 'ragavi@netiapps.com';

    $mail_subject = 'New Contact Form: ' . ucfirst($subject);

    $mail_body = <<<EOD
    New Contact Form Submission

    Name    : {$name}
    Email   : {$email}
    Phone   : {$phone}
    Company : {$company}

    Message:
    {$message}
    EOD;

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        "Reply-To: {$email}"
    ];

    // Send mail
    if (wp_mail($to, $mail_subject, $mail_body, $headers)) {
        return new WP_REST_Response([
            'status' => 'success'
        ], 200);
    }

    return new WP_REST_Response([
        'status'  => 'error',
        'message' => 'Mail sending failed'
    ], 500);
}

/**
 * ---------------------------------------------------------
 * 3. CORS SUPPORT FOR HEADLESS
 * ---------------------------------------------------------
 */
// add_action('rest_api_init', function () {

//     header("Access-Control-Allow-Origin: https://your-frontend-domain.com");
//     header("Access-Control-Allow-Methods: POST, OPTIONS");
//     header("Access-Control-Allow-Headers: Content-Type");

// });
add_action('rest_api_init', function () {

    add_filter('rest_pre_serve_request', function ($value) {

        $origin = get_http_origin();
        $allowed_origins = [
            'http://localhost:3000',
            'http://127.0.0.1:3000',
        ];

        if ($origin && in_array($origin, $allowed_origins)) {
            header("Access-Control-Allow-Origin: $origin");
            header("Access-Control-Allow-Methods: POST, OPTIONS");
            header("Access-Control-Allow-Headers: Content-Type");
            header("Access-Control-Allow-Credentials: true");
        }

        // Handle OPTIONS properly
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            status_header(200);
            exit;
        }

        return $value;
    });
});


// add_action('phpmailer_init', function ($phpmailer) {

//     $phpmailer->isSMTP();
//     $phpmailer->Host       = 'smtp.gmail.com';
//     $phpmailer->SMTPAuth   = true;
//     $phpmailer->Port       = 587;
//     $phpmailer->Username   = 'ragavi2002l@gmail.com'; // Gmail ID
//     $phpmailer->Password   = 'mnmviejppwwezmnv';     // App password (NO SPACES)
//     $phpmailer->SMTPSecure = 'tls';

//     $phpmailer->From       = 'ragavi2002l@gmail.com';
//     $phpmailer->FromName   = 'Netiapps Contact';

//     $phpmailer->SMTPDebug  = 2;
//     $phpmailer->Debugoutput = 'error_log';
// });

add_action('phpmailer_init', function ($phpmailer) {

    $phpmailer->isSMTP();
    $phpmailer->Host       = 'mail.wlsindia.in';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = 465;
    $phpmailer->SMTPSecure = 'ssl';

    $phpmailer->Username   = 'noreply@wlsindia.in';
    $phpmailer->Password   = "4gj3,,7p52Ue'QQ";

    // ✅ VERY IMPORTANT
    $phpmailer->From       = 'noreply@wlsindia.in';
    $phpmailer->FromName   = 'Netiapps Contact';

    // Debug (keep during testing)
    // $phpmailer->SMTPDebug  = 2;
    // $phpmailer->Debugoutput = 'error_log';
});


add_filter('wp_mail_from', function () {
    return 'noreply@wlsindia.in';
});

add_filter('wp_mail_from_name', function () {
    return 'Netiapps Contact';
});

add_action('wp_mail_failed', function ($error) {
    error_log(print_r($error, true));
});
