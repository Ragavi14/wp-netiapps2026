<?php
/**
 * Plugin Name: Headless Translation API
 * Description: Secure Google Translate API for React (Server-side only)
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
    register_rest_route('translation/v1', '/translate', [
        'methods'  => 'POST',
        'callback' => 'hta_translate_text',
        'permission_callback' => '__return_true',
    ]);
});

/**
 * ---------------------------------------------------------
 * 2. HANDLE TRANSLATION REQUEST
 * ---------------------------------------------------------
 */
function hta_translate_text(WP_REST_Request $request) {

    $text   = sanitize_text_field($request->get_param('text'));
    $target = sanitize_text_field($request->get_param('target'));

    if (empty($text) || empty($target) || $target === 'en') {
        return new WP_REST_Response([
            'translatedText' => $text
        ], 200);
    }

    // 🔐 Store API key securely in wp-config.php
    if (!defined('GOOGLE_TRANSLATE_API_KEY')) {
        return new WP_REST_Response([
            'message' => 'Translation API key not configured'
        ], 500);
    }

    $api_key = GOOGLE_TRANSLATE_API_KEY;
    $url = "https://translation.googleapis.com/language/translate/v2?key={$api_key}";

    // ---------- Cache (IMPORTANT) ----------
    $cache_key = 'translate_' . md5($text . $target);
    $cached = get_transient($cache_key);

    if ($cached) {
        return new WP_REST_Response([
            'translatedText' => $cached,
            'cached' => true
        ], 200);
    }

    // ---------- Google API Call ----------
    $response = wp_remote_post($url, [
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode([
            'q' => $text,
            'target' => $target,
            'format' => 'text',
        ]),
        'timeout' => 20,
    ]);

    if (is_wp_error($response)) {
        return new WP_REST_Response([
            'translatedText' => $text,
            'error' => 'Google API request failed'
        ], 500);
    }

    $body = json_decode(wp_remote_retrieve_body($response), true);

    if (!isset($body['data']['translations'][0]['translatedText'])) {
        return new WP_REST_Response([
            'translatedText' => $text,
            'error' => 'Invalid API response'
        ], 500);
    }

    $translatedText = $body['data']['translations'][0]['translatedText'];

    // ---------- Save cache (24 hours) ----------
    set_transient($cache_key, $translatedText, DAY_IN_SECONDS);

    return new WP_REST_Response([
        'translatedText' => $translatedText,
        'cached' => false
    ], 200);
}

/**
 * ---------------------------------------------------------
 * 3. CORS SUPPORT (Same pattern as your form)
 * ---------------------------------------------------------
 */
add_action('rest_api_init', function () {
    add_filter('rest_pre_serve_request', function ($value) {

        $origin = get_http_origin();
        $allowed_origins = [
            'http://localhost:3000',
            'http://127.0.0.1:3000',
            'https://your-react-site.com',
        ];

        if ($origin && in_array($origin, $allowed_origins)) {
            header("Access-Control-Allow-Origin: $origin");
            header("Access-Control-Allow-Methods: POST, OPTIONS");
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
