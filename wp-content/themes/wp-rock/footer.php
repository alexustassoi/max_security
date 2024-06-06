<?php
/**
 * General footer
 *
 * @package WP-rock
 * @since 4.4.0
 */

global $global_options;
?>

</div><!-- end of <main> -->

<?php do_action( 'wp_rock_before_site_footer' ); ?>

<?php
// Custom footer.
echo esc_html( get_template_part( 'src/template-parts/custom', 'footer' ) );
?>

<?php do_action( 'wp_rock_after_site_footer' ); ?>

</div><!-- .wrapper -->

<?php
do_action( 'wp_rock_after_site_page_tag' );
wp_footer();
do_action( 'wp_rock_before_body_closing_tag' );


$popup_content      = get_field_value($global_options, 'popup_content');
echo $popup_content ? do_shortcode($popup_content) : '';
?>
</body>
</html>
