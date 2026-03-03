<?php get_header(); ?>
<main>
    <h1><?php the_title(); ?></h1>

    <?php the_book_cover( $post->ID ); ?>

    <section id="publication-date">
        <p><?php echo get_the_date( 'F j, Y' ); ?></p>
    </section>

    <section id="genres">
        <p>
            <?php the_terms( $post->ID, 'genres', __( 'Genres: ', 'foozeo' ) ); ?>
        </p>
    </section>

    <section id="content">
        <?php the_content(); ?>
    </section>

    <section id="latest-books">
        <h2><?php esc_html_e( 'Latest Books', 'foozeo' ); ?></h2>
        <div class="latest-books-container"></div>
    </section>
</main>
<?php get_footer(); ?>