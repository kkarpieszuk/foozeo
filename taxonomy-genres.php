<?php get_header(); ?>

<main>
    <h1><?php single_term_title(); ?></h1>

    <section id="books">
        <div class="books-container">
            <?php

            while ( have_posts() ) {
                the_post();
                get_template_part( 'template-parts/book-card' );
            }

            wp_reset_postdata();
            ?>

            <div class="pagination">
                <?php
                the_posts_pagination( [
                    'prev_text' => __( 'Previous', 'foozeo' ),
                    'next_text' => __( 'Next', 'foozeo' ),
                ] );
                ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>