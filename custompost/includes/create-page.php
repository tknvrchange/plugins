<?php
if (!defined('ABSPATH')) {
    exit;
}

// Function to create "Pixlogix" page
function custompost_create_page() {
    $page = array(
        'post_title'    => 'Pixlogix',
        'post_content'  => '[pixlogix_show_posts]',
        'post_status'   => 'publish',
        'post_type'     => 'page'
    );

    $page_id = wp_insert_post($page);
    if ($page_id) {
        update_option('custompost_page_id', $page_id);
    }
}

// Function to delete "Pixlogix" page on deactivation
function custompost_delete_page() {
    $page_id = get_option('custompost_page_id');
    if ($page_id) {
        wp_delete_post($page_id, true);
        delete_option('custompost_page_id');
    }
}
?>
