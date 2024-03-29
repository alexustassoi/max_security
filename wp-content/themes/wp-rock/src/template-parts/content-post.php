<div class="intelligence-report__post">
    <figure class="intelligence-report__post-img">
        <img 
            src="<?php the_post_thumbnail_url( 'thumbnail' ) ?>" 
            alt="<?php echo esc_attr( get_the_title() ); ?>" 
            title="<?php echo esc_attr( get_the_title() ); ?>" 
            />
    </figure>

    <div class="intelligence-report__post-content">
        <div class="intelligence-report__post-date">
            <?php echo get_the_date( 'F d Y' ); ?>
        </div>

        <div class="intelligence-report__post-excerpt">
            <?php the_excerpt(); ?>
        </div>

        <a href="<?php the_permalink(); ?>" class="button brown-transparent-btn">
            <?php esc_html_e( 'View report', 'wp-rock' ); ?>
        </a>
    </div>
</div>