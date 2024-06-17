<?php

/**
 * Block - Image text.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields = get_fields();
$image = get_field_value($fields, 'image');
$text = get_field_value($fields, 'text');
$title = get_field_value($fields, 'title');
?>
<div class="image-text">
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
