<?php

/**
 * Block - Careers posts.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name        = isset($args['className']) ? ' ' . $args['className'] : '';
$fields            = get_fields();
$block_pt          = get_field_value($fields, 'block_pt');
$space_top_type    = $block_pt ? get_field_value($fields, 'space_top_type') : '';
$block_pb          = get_field_value($fields, 'block_pb');
$space_bottom_type = $block_pb ? get_field_value($fields, 'space_bottom_type') : '';
$title             = get_field_value($fields, 'title');
$container_title   = get_field_value($fields, 'container_title');

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');

$args = array(
    'post_type'      => 'careers',
    'post_status'    => 'publish',
    'meta_key'       => 'is_open_position',
    'meta_value'     => true,
    'meta_compare'   => '=',
);

$query = new WP_Query($args);

$hide_block        = get_field_value($fields, 'hide_block');

if ($hide_block) {
    return '';
}
?>
<div class="careers-posts <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : ''; echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : ''; echo ' space-top-type-' . do_shortcode($space_top_type) . ' '; echo ' space-bottom-type-' . $space_bottom_type . ' ';  ?>">
	<div class="custom-container">
		<?php
		if (!empty($title)) {
			echo '<div class="careers-posts__title">' . do_shortcode($title) . '</div>';
		}
		if (!empty($container_title)) {
			echo '<div class="careers-posts__container-title">' . do_shortcode($container_title) . '</div>';
		}
		?>
		<?php if (!empty($query->have_posts())) : ?>
			<div class="careers-posts__posts-container">
				<?php while ($query->have_posts()) : $query->the_post();
					$career_fields = get_fields(get_the_ID());
					$title = get_the_title();
					$excerpt = get_field_value($career_fields, 'excerpt');
					$link = get_the_permalink();
				?>
					<div class="careers-posts__post">
						<p class="careers-posts__post-title">
							<?php echo $title; ?>
						</p>
						<div class="careers-posts__post-excerpt">
							<?php echo do_shortcode($excerpt); ?>
						</div>
						<a href="<?php echo $link; ?>" class="careers-posts__post-link primary-btn">
							<?php echo __('READ  MORE & APPLY', 'wp-rock'); ?>
						</a>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
