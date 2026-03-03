<?php
use Konrad\Foozeo\Ajax;
use Konrad\Foozeo\Assets;
use Konrad\Foozeo\PostTypes;

require_once get_stylesheet_directory() . '/vendor/autoload.php';

( new Ajax() )->init();
( new Assets() )->init();
( new PostTypes() )->init();

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