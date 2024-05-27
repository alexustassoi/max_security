<?php
/**
 * Template for resources post category pages.
 *
 * @package WP-rock
 * @since 4.4.0
 */

get_header();

do_action( 'wp_rock_before_page_content' );

include( locate_template( '/src/template-parts/acf-blocks/block-browse-by-topic.php', false, false, array(
    'post_id' => 1
)) );
?>



<?php do_action( 'wp_rock_after_page_content' ); ?>
<?php
get_footer();
