<?php

namespace Konrad\Foozeo;

class Assets {

    public function init() {

        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    function enqueue_styles() {
        wp_enqueue_style('foozeo-style', get_stylesheet_uri(), [], '1.0.0');
    }

    function enqueue_scripts() {
        wp_enqueue_script('foozeo-script', get_stylesheet_directory_uri() . '/assets/js/script.js', [ 'jquery' ], '1.0.0', true);
        wp_localize_script('foozeo-script', 'foozeo_ajax_object', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'current_page' => get_the_ID(),
            'nonce' => wp_create_nonce( 'get_latest_books' ),
        ]);
    }
}