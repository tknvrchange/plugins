<?php
function wpb_fetch_book() {
    $post_id = intval($_POST['post_id']);
    $post = get_post($post_id);
    $subtitle = get_post_meta($post_id, 'book_subtitle', true);
    $second_cover = get_post_meta($post_id, 'book_second_cover', true);
    $rating = get_post_meta($post_id, 'book_rating', true);

    echo '<button class="close">X</button>';
    echo "<img src='$second_cover' style='width:100%;'/>";
    echo "<h2>" . get_the_title($post_id) . "</h2>";
    echo "<p><strong>Subtitle:</strong> $subtitle</p>";
    echo "<p><strong>Rating:</strong> $rating</p>";
    echo "<div>" . apply_filters('the_content', $post->post_content) . "</div>";

    wp_die();
}
add_action('wp_ajax_wpb_fetch_book', 'wpb_fetch_book');
add_action('wp_ajax_nopriv_wpb_fetch_book', 'wpb_fetch_book');
