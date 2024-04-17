<?php
/**
 * Block - Intelligence report.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields = get_fields();
$title = get_field_value($fields, 'title');
$sub_title = get_field_value($fields, 'sub_title');
$posts_perview = get_field_value($fields, 'posts_perview');
$post_category = get_field_value($fields, 'post_category');

$args_posts = array(
    'post_type' => 'post', 
    'post_status' => 'publish',
    'posts_per_page' => $posts_perview,
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'terms' => $post_category,
            'field' => 'term_id',
            'operator' => 'IN',
            'include_children' => true,
        ),
    )
);

$query_posts = new WP_Query( $args_posts );
?>

<section id="intelligence-report" class="intelligence-report">
    <div class="container intelligence-report__container">
        <div class="intelligence-h__menu-wrap"></div>
        <div class="intelligence-report__content">
            <?php if ($title) { ?>
                <h3 class="intelligence-report__title">
                    <?php echo do_shortcode($title); ?>
                    <?php if ($sub_title) { ?>
                        <span class="intelligence-report__title-sub"><?php echo do_shortcode($sub_title); ?></span>
                    <?php } ?>
                </h3>
            <?php } ?>

            <?php if ( $query_posts->have_posts() ) : ?>
            <div class="intelligence-report__posts">
                <?php 
                    while ( $query_posts->have_posts() ) : 
                    $query_posts->the_post();
                        get_template_part( 'src/template-parts/content', 'post' );
                    endwhile; 
                ?>
                <?php if ( $query_posts->max_num_pages > 1 ): ?>
                    <div class="intelligence-report__posts-more">
                        <a class="button more-btn js-more-btn" 
                            data-role = "toggle-more-btn"
                            data-perview = "<?php echo $posts_perview; ?>" 
                            data-cats = "<?php echo json_encode( $post_category ); ?>" 
                            data-page = 1
                            >
                            <?php esc_html_e( 'Load more', 'wp-rock' ); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <?php
                endif; 
                wp_reset_postdata(); 
            ?>
        </div>
    </div>
</section>
