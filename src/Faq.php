<?php

namespace Konrad\Foozeo;

class Faq {
    public function init() {
        add_action( 'init', function() {
            register_block_type( get_stylesheet_directory() . '/blocks/faq-accordion/build/faq-accordion' );
        });

        add_filter( 'block_type_metadata', function ( $metadata ) {
            if ( ( $metadata['name'] ?? '' ) === 'core/accordion-item' ) {
                $metadata['parent'] = array_merge(
                    $metadata['parent'] ?? [],
                    [ 'foozeo/faq-accordion' ]
                );
            }
            return $metadata;
        }, 10, 2 );
    }
}