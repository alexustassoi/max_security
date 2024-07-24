<?php
/**
 * General template for pages
 *
 * @package WP-rock
 * @since 4.4.0
 */

get_header();

$resources_page = get_page_by_path('resources', OBJECT, 'page');
$resources_page_id = null;
if ( is_a($resources_page, 'WP_Post') ) {
    $resources_page_id = $resources_page->ID;
}
///var_dump('$resources_page', $resources_page);

// $resources_page_id = $resources_page?->ID;
?>


<?php
do_action( 'wp_rock_before_page_content' );

$args = array(
    'page_id' => $resources_page_id,
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
        the_content();
    endwhile;
endif;

wp_reset_postdata();

do_action( 'wp_rock_after_page_content' );
?>


<?php
get_footer();
