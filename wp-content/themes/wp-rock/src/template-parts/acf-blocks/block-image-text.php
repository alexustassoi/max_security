<?php

/**
 * Block - Image text.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields = get_fields();
$block_pt = get_field_value($fields, 'block_pt');
$block_pb = get_field_value($fields, 'block_pb');
$image = get_field_value($fields, 'image');
$text = get_field_value($fields, 'text');
$title = get_field_value($fields, 'title');

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');

?>

<div class="image-text <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : ''; echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : ''; ?>">
	<div class="custom-container">
        <?php if ($title): ?>
        <h2 class="image-text__title">
            <?php echo $title; ?>
        </h2>
        <?php endif; ?>
		<div class="image-text__inner">
			<?php
			if ($image) {
				echo '<figure class="image-text__image">
						<img src="' . $image . '" alt="image">
					</figure>';
			}

			if (!empty($text)) {
				echo '<div class="image-text__text">
							' . do_shortcode($text) . '
						</div>';
			}
			?>
		</div>
	</div>
</div>
