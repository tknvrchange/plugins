<?php
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue styles and scripts
function custompost_enqueue_scripts() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    wp_enqueue_style('custompost-style', CUSTOMPOST_PLUGIN_URL . 'assets/style.css');
}

add_action('wp_enqueue_scripts', 'custompost_enqueue_scripts');
?>
