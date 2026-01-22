<?php
/*
Plugin Name: Image Upload Bypass
*/

add_filter('wp_generate_attachment_metadata', '__return_empty_array');
add_filter('big_image_size_threshold', '__return_false');
