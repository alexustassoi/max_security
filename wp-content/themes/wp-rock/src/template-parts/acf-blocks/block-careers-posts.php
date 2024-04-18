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
	'post_type' => 'careers',
	'post_status' => 'publish',
);

$query = new WP_Query($args);
?>
<div class="careers-posts">
	<div class="custom-container">
		<h2 class="careers-posts__title"></h2>
		<h4 class="careers-posts__container-title"></h4>
		<?php if (!empty($query->have_posts())) : ?>
			<div class="careers-posts__container">
				<?php while ($query->have_posts()) : $query->the_post(); ?>
					<div class="careers-posts__post">
						<h5 class="careers-posts__post-title"></h5>
						<div class="careers-posts__post-excerpt"></div>
						<a href="" class="careers-posts__post-link"></a>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
