<?php
use Konrad\Foozeo\Ajax;
use Konrad\Foozeo\Assets;
use Konrad\Foozeo\PostTypes;

require_once get_stylesheet_directory() . '/vendor/autoload.php';

( new Ajax() )->init();
( new Assets() )->init();
( new PostTypes() )->init();

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