<?php

namespace Konrad\Foozeo;

class PostTypes {

    public function init() {
        add_action('init', [$this, 'register_post_types']);
        add_action('pre_get_posts', [$this, 'pre_get_posts']);
    }

    public function register_post_types() {
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
                'wp-blocks',
                'featured-image',
                'date',
                'genres'
            ],
            'publicly_queryable' => true,
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
            'show_in_rest' => true,
            'rewrite' => ['slug' => 'book-genre'],
            'hierarchical' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'public' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'show_in_rest' => true,
            'rewrite' => ['slug' => 'book-genre'],
            'hierarchical' => true,
        ]);
    }

    public function pre_get_posts( $query ) {
        if ( is_admin() || ! $query->is_main_query() ) {
            return;
        }

        if ( is_tax('genres') ) {
            $query->set('posts_per_page', 5);
        }
    }
}