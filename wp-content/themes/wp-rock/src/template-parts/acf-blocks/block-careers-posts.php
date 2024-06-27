<?php

/**
 * Block - Careers posts.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields      = get_fields();
$title = get_field_value($fields, 'title');
$container_title = get_field_value($fields, 'container_title');

$args = array(
    'post_type'      => 'careers',
    'post_status'    => 'publish',
    'meta_key'       => 'is_open_position',
    'meta_value'     => true,
    'meta_compare'   => '=',
);

$query = new WP_Query($args);
?>
<div class="careers-posts">
	<div class="custom-container">
		<?php
		if (!empty($title)) {
			echo '<h2 class="careers-posts__title">' . esc_html($title) . '</h2>';
		}
		if (!empty($container_title)) {
			echo '<h4 class="careers-posts__container-title">' . esc_html($container_title) . '</h4>';
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
