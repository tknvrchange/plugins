<?php
// Shortcode to Display Books in Grid
function wpb_books_shortcode($atts) {
    $atts = shortcode_atts([
        'limit' => 6,
        'show_subtitle' => 'true'
    ], $atts, 'wpb_books');

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $query = new WP_Query([
        'post_type' => 'book',
        'posts_per_page' => intval($atts['limit']),
        'paged' => $paged,
    ]);

    ob_start();
    echo '<div class="wpb-books-main"><div class="wpb-books-grid">';

    while ($query->have_posts()) : $query->the_post();
        $subtitle = get_post_meta(get_the_ID(), 'book_subtitle', true);
        $rating = get_post_meta(get_the_ID(), 'book_rating', true);
        
        echo '<div class="wpb-book-item" data-id="' . get_the_ID() . '">';
        echo '<a href="#" class="wpb-book-popup">';
        the_post_thumbnail('medium');
        echo '<h3>' . get_the_title() . '</h3>';
        echo '</a>';

        // Show subtitle only if 'show_subtitle' is set to 'true'
        if ($atts['show_subtitle'] === 'true' && !empty($subtitle)) {
            echo '<p><strong>Sub Title:</strong> ' . esc_html($subtitle) . '</p>';
        }

        echo '<p><strong>Rating:</strong> ' . esc_html($rating) . '</p>';
        echo '</div>';

    endwhile;

    echo '</div>';
    wp_reset_postdata();

    echo paginate_links(array(
        'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
        'format'    => '?paged=%#%',
        'current'   => $paged,
        'total'     => $query->max_num_pages,
        'prev_text' => __('« Prev', 'textdomain'),
        'next_text' => __('Next »', 'textdomain'),
        'mid_size'  => 2,
        'end_size'  => 1,
    ));

    echo '</div><div class="wpb-popup-inner"></div>';

    return ob_get_clean();
}
add_shortcode('wpb_books', 'wpb_books_shortcode');
