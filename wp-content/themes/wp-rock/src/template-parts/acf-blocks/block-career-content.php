<?php

/**
 * Block - Career content.
 *
 * @package WP-rock
 * @since   4.4.0
 */
global $global_options;
$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields            = get_fields();
$block_pt          = get_field_value($fields, 'block_pt');
$space_top_type    = $block_pt ? get_field_value($fields, 'space_top_type') : '';
$block_pb          = get_field_value($fields, 'block_pb');
$space_bottom_type = $block_pb ? get_field_value($fields, 'space_bottom_type') : '';
$big_title         = get_field_value($fields, 'big_title');
$content           = get_field_value($fields, 'content');
$form_group        = get_field_value($global_options, 'career_contact_form');
$form_title        = get_field_value($form_group, 'form_title');
$form_description  = get_field_value($form_group, 'form_description');
$form_shortcode    = get_field_value($form_group, 'form_shortcode');

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');

?>
<div class="career-content <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : ''; echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : ''; echo ' space-top-type-' . do_shortcode($space_top_type) . ' '; echo ' space-bottom-type-' . $space_bottom_type . ' '; ?>">
	<div class="custom-container">
		<div class="career-content__inner">
			<?php
			if (!empty($big_title)) {
				echo '<div class="career-content__big-title">' . do_shortcode($big_title) . '</div>';
			}

			echo '<h5 class="career-content__content-title">' . get_the_title() . '</h5>';

			if (!empty($content)) {
				echo '<div class="career-content__content-container">
							' . do_shortcode($content) . '
						</div>';
			}
			?>
			<div class="career-content__form-wrapper">
				<div class="career-content__form-top-wrapper">
					<?php
					if (!empty($form_title)) {
						echo '<h3 class="career-content__form-title">' . esc_html($form_title) . '</h3>';
					}
					if (!empty($form_description)) {
						echo '<p class="career-content__form-description">' . esc_html($form_description) . '</p>';
					}
					?>
				</div>
				<?php
				if (!empty($form_shortcode)) {
					echo '<div class="career-content__form">' . do_shortcode($form_shortcode) . '</div>';
				}
				?>
			</div>
		</div>
	</div>
</div>
