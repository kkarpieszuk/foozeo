<?php

function foozeo_enqueue_styles() {
    wp_enqueue_style('foozeo-style', get_stylesheet_uri(), [], '1.0.0');
}
add_action('wp_enqueue_scripts', 'foozeo_enqueue_styles');

function foozeo_enqueue_scripts() {
    wp_enqueue_script('foozeo-script', get_stylesheet_directory_uri() . '/assets/js/script.js', [], '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'foozeo_enqueue_scripts');

register_post_type('books', [
    'label'       => __('Books', 'foozeo'),
    'public'      => true,
    'has_archive' => true,
    'supports'    => [
        'title', 
        'editor', 
        'thumbnail', 
        'custom-fields', 
        'revisions', 
        'excerpt', 
        'author', 
        'page-attributes', 
        'post-formats', 
        'wp-blocks'
    ],
    'show_in_rest' => true,
    'rewrite'     => ['slug' => 'library'],
    'menu_icon'   => 'dashicons-book',
    'labels' => [
        'name'          => __('Books', 'foozeo'),
        'singular_name' => __('Book', 'foozeo'),
        'menu_name'     => __('Books', 'foozeo'),
        'add_new'       => __('Add Book', 'foozeo'),
        'add_new_item'  => __('Add Book', 'foozeo'),
        'edit_item'     => __('Edit Book', 'foozeo'),
        'new_item'      => __('New Book', 'foozeo'),
        'view_item'     => __('View Book', 'foozeo'),
    ],
]);

register_taxonomy('genres', 'books', [
    'rewrite' => ['slug' => 'book-genre'],
    'labels'  => [
        'name'          => __('Genres', 'foozeo'),
        'singular_name' => __('Genre', 'foozeo'),
        'menu_name'     => __('Genres', 'foozeo'),
        'add_new'       => __('Add Genre', 'foozeo'),
        'add_new_item'  => __('Add Genre', 'foozeo'),
        'edit_item'     => __('Edit Genre', 'foozeo'),
        'new_item'      => __('New Genre', 'foozeo'),
        'view_item'     => __('View Genre', 'foozeo'),
    ],
]);