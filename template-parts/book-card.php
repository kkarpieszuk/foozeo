<div class="book-card">
    <h3><?php the_title(); ?></h3>
    <p><?php the_excerpt(); ?></p>
    <a href="<?php the_permalink(); ?>" class="button"><?php esc_html_e( 'Read More', 'foozeo' ); ?></a>
</div>