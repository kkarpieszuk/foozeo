<?php

function foozeo_enqueue_styles() {
    wp_enqueue_style('foozeo-style', get_stylesheet_uri(), [], '1.0.0');
}
add_action('wp_enqueue_scripts', 'foozeo_enqueue_styles');

function foozeo_enqueue_scripts() {
    wp_enqueue_script('foozeo-script', get_stylesheet_directory_uri() . '/assets/js/script.js', [ 'jquery' ], '1.0.0', true);
    wp_localize_script('foozeo-script', 'foozeo_ajax_object', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'current_page' => get_the_ID(),
    ]);
}
add_action('wp_enqueue_scripts', 'foozeo_enqueue_scripts');

add_action('wp_ajax_get_latest_books', 'foozeo_get_latest_books');
add_action('wp_ajax_nopriv_get_latest_books', 'foozeo_get_latest_books');

function foozeo_get_latest_books() {
    $current_page = (int) $_POST['current_page'];
    $latest_books = get_posts( [
        'post_type' => 'books',
        'posts_per_page' => 20,
        'exclude' => [ $current_page ],
    ]);

    $result = array_map(function($book) {
        return [
            'title' => sanitize_text_field($book->post_title),
            'publication_date' => date('F j, Y', strtotime($book->post_date)),
            'genres' => implode(', ', wp_list_pluck(get_the_terms($book->ID, 'genres'), 'name')),
            'excerpt' => $book->post_excerpt !== '' ? sanitize_text_field($book->post_excerpt) : __( 'No excerpt available', 'foozeo' ),
            'link' => get_permalink($book->ID),
        ];
    }, $latest_books);

    wp_send_json_success($result);
}

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

function the_book_cover( $post_id ) {
    $url = get_the_post_thumbnail_url($post_id);

    if ( ! $url ) {
        return;
    }

    ?>
    <section id="featured-image">
        <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr(get_the_title($post_id)); ?>">
    </section>
    <?php
}