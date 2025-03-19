<?php
// Add Meta Box for Book Details
function wpb_add_book_meta_boxes() {
    add_meta_box('wpb_book_details', 'Book Details', 'wpb_book_meta_callback', 'book', 'normal', 'high');
}
add_action('add_meta_boxes', 'wpb_add_book_meta_boxes');

function wpb_book_meta_callback($post) {
    $subtitle = get_post_meta($post->ID, 'book_subtitle', true);
    $second_cover = get_post_meta($post->ID, 'book_second_cover', true);
    $rating = get_post_meta($post->ID, 'book_rating', true);

    // Add security nonce
    wp_nonce_field('wpb_save_book_meta', 'wpb_book_nonce');
    ?>
    <p><label><strong>Book Sub Title:</strong></label>
        <input type="text" name="book_subtitle" value="<?php echo esc_attr($subtitle); ?>" class="widefat">
    </p>

    <p><label><strong>Second Cover Image:</strong></label></p>
    <div>
        <input type="hidden" name="book_second_cover" id="book_second_cover" value="<?php echo esc_attr($second_cover); ?>">
        <img id="book_second_cover_preview" src="<?php echo esc_url($second_cover); ?>" style="max-width: 100px; height: auto; display: <?php echo ($second_cover ? 'block' : 'none'); ?>;">
        <br>
        <button type="button" class="button wpb-upload-image">Select Image</button>
        <button type="button" class="button wpb-remove-image" style="display: <?php echo ($second_cover ? 'inline-block' : 'none'); ?>;">Remove</button>
    </div>

    <p><label><strong>Book Rating:</strong></label>
        <select name="book_rating">
            <?php for ($i = 0; $i <= 5; $i++) { ?>
                <option value="<?php echo $i; ?>" <?php selected($rating, $i); ?>><?php echo $i; ?></option>
            <?php } ?>
        </select>
    </p>
    <?php
}

// Save Meta Fields
function wpb_save_book_meta($post_id) {
    if (!isset($_POST['wpb_book_nonce']) || !wp_verify_nonce($_POST['wpb_book_nonce'], 'wpb_save_book_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['book_subtitle'])) {
        update_post_meta($post_id, 'book_subtitle', sanitize_text_field($_POST['book_subtitle']));
    }
    if (isset($_POST['book_second_cover'])) {
        update_post_meta($post_id, 'book_second_cover', esc_url($_POST['book_second_cover']));
    }
    if (isset($_POST['book_rating'])) {
        update_post_meta($post_id, 'book_rating', intval($_POST['book_rating']));
    }
}
add_action('save_post', 'wpb_save_book_meta');

// Enqueue Admin Scripts
function wpb_admin_scripts($hook) {
    if ('post.php' !== $hook && 'post-new.php' !== $hook) return;
    wp_enqueue_media();
    wp_enqueue_script('wpb-meta-box', plugins_url('../assets/js/book-meta-box.js', __FILE__), ['jquery'], null, true);
}
add_action('admin_enqueue_scripts', 'wpb_admin_scripts');
