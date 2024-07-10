<?php

/**
 * Block - Small hero.
 *
 * @package WP-rock
 * @since   4.4.0
 */
$fields = get_fields();
$block_pt = get_field_value($fields, 'block_pt');
$space_top_type = $block_pt ? get_field_value($fields, 'space_top_type') : '';
$block_pb = get_field_value($fields, 'block_pb');
$space_bottom_type = $block_pb ? get_field_value($fields, 'space_bottom_type') : '';
$colors_select = get_field_value($fields, 'colors_select');
$icon = get_field_value($fields, 'icon');
$title = get_field_value($fields, 'title');

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');

$colors_select = !empty($colors_select) ? $colors_select : '#7E97A6';
?>

<div class="small-hero <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : ''; echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : ''; echo ' space-top-type-' . do_shortcode($space_top_type) . ' '; echo ' space-bottom-type-' . $space_bottom_type . ' '; ?>" style="background-color: <?php echo $colors_select; ?>;">
    <div class="custom-container small-hero__custom-container">
        <?php
        if (!empty($icon)) {
            echo '<figure class="small-hero__icon">
                        <img src="' . $icon . '" alt="icon">
                    </figure>';
        }

        if (!empty($title)) {
            echo '<div class="small-hero__title">' . $title . '</div>';
        }
        ?>
    </div>
</div>
