<?php

namespace Konrad\Foozeo;

use WP_HTML_Tag_Processor;

class Faq {

    public function init() {
        add_action( 'init', function() {
            register_block_type( get_stylesheet_directory() . '/blocks/faq-accordion/build/faq-accordion', [
                'render_callback' => [ __CLASS__, 'render_faq_accordion' ],
            ] );
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

    public static function render_faq_accordion( $attributes, $content ) {
        if ( ! $content ) {
            return $content;
        }
        $p = new WP_HTML_Tag_Processor( $content );
        if ( $p->next_tag( [ 'class_name' => 'wp-block-foozeo-faq-accordion' ] ) ) {
            $p->set_attribute( 'data-wp-interactive', 'core/accordion' );
            $p->set_attribute( 'data-wp-context', '{ "autoclose": false, "accordionItems": [] }' );
            $content = $p->get_updated_html();
        }

        return $content;
    }
}