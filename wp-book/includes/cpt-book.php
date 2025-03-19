<?php
// Register Custom Post Type: Book
function wpb_register_book_post_type() {
    register_post_type('book', [
        'labels' => ['name' => 'Books', 'singular_name' => 'Book'],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-book',
        'rewrite' => ['slug' => 'books']
    ]);

    register_taxonomy('book_category', 'book', [
        'label' => 'Book Categories',
        'hierarchical' => true,
        'show_admin_column' => true
    ]);
}
add_action('init', 'wpb_register_book_post_type');
