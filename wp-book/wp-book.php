<?php
/**
 * Plugin Name: WP Book
 * Description: Manage books with custom post types, categories, and a grid view with popups.
 * Version: 1.0
 * Author: Tarun Khatri
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Define plugin path
define('WPB_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Include required files
require_once WPB_PLUGIN_DIR . 'includes/cpt-book.php';
require_once WPB_PLUGIN_DIR . 'includes/book-meta-fields.php';
require_once WPB_PLUGIN_DIR . 'includes/book-shortcode.php';
require_once WPB_PLUGIN_DIR . 'includes/book-ajax.php';

// Enqueue scripts and styles
function wpb_enqueue_scripts() {
    wp_enqueue_style('wpb-style', plugins_url('assets/css/style.css', __FILE__));
    wp_enqueue_script('wpb-popup-js', plugins_url('assets/js/book-popup.js', __FILE__), ['jquery'], null, true);
    wp_localize_script('wpb-popup-js', 'wpb_ajax', ['ajax_url' => admin_url('admin-ajax.php')]);
}
add_action('wp_enqueue_scripts', 'wpb_enqueue_scripts');
