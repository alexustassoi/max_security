<?php

/**
 * Block - Image text.
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
$image             = get_field_value($fields, 'image');
$text              = get_field_value($fields, 'text');
$title             = get_field_value($fields, 'title');

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');

$hide_block        = get_field_value($fields, 'hide_block');

if ($hide_block) {
    return '';
}
?>

<div class="image-text <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : ''; echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : ''; echo ' space-top-type-' . do_shortcode($space_top_type) . ' '; echo ' space-bottom-type-' . $space_bottom_type . ' '; ?>">
	<div class="custom-container">
        <?php if ($title): ?>
        <div class="image-text__title">
            <?php echo $title; ?>
        </div>
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
