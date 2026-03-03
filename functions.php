<?php

function foozeo_enqueue_styles() {
    wp_enqueue_style('foozeo-style', get_stylesheet_uri(), [], '1.0.0');
}
add_action('wp_enqueue_scripts', 'foozeo_enqueue_styles');