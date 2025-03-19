<?php
if (!defined('ABSPATH')) {
    exit;
}

// Function to display posts with pagination
function custompost_display_posts($atts) {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $query_args = array(
        'post_type'      => 'post',
        'posts_per_page' => 6,
        'paged'          => $paged
    );

    $query = new WP_Query($query_args);
    
    ob_start();
    ?>
    <div class="container mt-4">
        <div class="row">
            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" class="card-img-top" alt="<?php the_title_attribute(); ?>">
                                </a>
                            <?php endif; ?>
                            <div class="card-body">
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <p><?php the_excerpt(); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <div class="pagination">
                    <?php
                    echo paginate_links(array(
                        'total' => $query->max_num_pages,
                        'current' => $paged,
                    ));
                    ?>
                </div>
            <?php else : ?>
                <p>No posts found.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}

add_shortcode('pixlogix_show_posts', 'custompost_display_posts');
?>
