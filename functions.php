<?php

function foozeo_enqueue_styles() {
    wp_enqueue_style('foozeo-style', get_stylesheet_uri(), [], '1.0.0');
}
add_action('wp_enqueue_scripts', 'foozeo_enqueue_styles');

function foozeo_enqueue_scripts() {
    wp_enqueue_script('foozeo-script', get_stylesheet_directory_uri() . '/assets/js/script.js', [], '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'foozeo_enqueue_scripts');