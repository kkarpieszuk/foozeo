<?php

namespace Konrad\Foozeo;

/**
 * Ajax class
 */
class Ajax {

    /**
     * Initialize the Ajax class
     */
    public function init() {
        add_action('wp_ajax_get_latest_books', [$this, 'get_latest_books']);
        add_action('wp_ajax_nopriv_get_latest_books', [$this, 'get_latest_books']);
    }

    /**
     * Get the latest books.
     *
     * Ajax data:
     * - current_page: The current page number
     *
     * @return void
     */
    public function get_latest_books() {
        $current_page = (int) $_POST['current_page'];

        if ( ! $current_page ) {
            wp_send_json_error( __( 'Current page is required', 'foozeo' ) );
        }

        // Do not allow to fetch the latest books for unauthorized actors.
        if ( ! wp_verify_nonce( $_POST['nonce'], 'get_latest_books' ) ) {
            wp_send_json_error( __( 'Invalid nonce', 'foozeo' ) );
        }


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
                'excerpt' => $book->post_excerpt !== '' ? sanitize_text_field($book->post_excerpt) : esc_html__( 'No excerpt available', 'foozeo' ),
                'link' => get_permalink($book->ID),
            ];
        }, $latest_books);

        wp_send_json_success($result);
    }
}