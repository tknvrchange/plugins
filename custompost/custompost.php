<?php
/**
 * Plugin Name: CustomPost
 * Description: Creates a "Pixlogix" page with a shortcode to list posts with pagination.
 * Version: 1.0
 * Author: Your Name
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin path
define('CUSTOMPOST_PLUGIN_PATH', plugin_dir_path(__FILE__));

define('CUSTOMPOST_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files
require_once CUSTOMPOST_PLUGIN_PATH . 'includes/create-page.php';
require_once CUSTOMPOST_PLUGIN_PATH . 'includes/display-posts.php';
require_once CUSTOMPOST_PLUGIN_PATH . 'includes/enqueue-scripts.php';

// Activation and deactivation hooks
register_activation_hook(__FILE__, 'custompost_create_page');
register_deactivation_hook(__FILE__, 'custompost_delete_page');