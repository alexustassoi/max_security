<?php

/**
 * Block - Custom map.
 *
 * @package WP-rock
 * @since   4.4.0
 */

global $global_options;

$class_name        = isset($args['className']) ? ' ' . $args['className'] : '';
$fields            = get_fields();
$block_pt          = get_field_value($fields, 'block_pt');
$space_top_type    = $block_pt ? get_field_value($fields, 'space_top_type') : '';
$block_pb          = get_field_value($fields, 'block_pb');
$space_bottom_type = $block_pb ? get_field_value($fields, 'space_bottom_type') : '';
$map_iframe        = get_field_value($fields, 'map_iframe');
$map_caption       = get_field_value($fields, 'map_caption');

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');


$hide_block        = get_field_value($fields, 'hide_block');

if ($hide_block) {
    return '';
}
?>

<div class="custom-map <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : ''; echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : ''; echo $class_name; echo ' space-top-type-' . do_shortcode($space_top_type) . ' '; echo ' space-bottom-type-' . $space_bottom_type . ' '; ?>">
    <div class="custom-map__inner">
        <div class="custom-container">
            <div class="custom-map__map-wrap">
                <?php
                echo $map_iframe ? do_shortcode($map_iframe) : '';

                echo $map_caption
                    ? '<div class="custom-map__map-caption">' . do_shortcode($map_caption) . '</div>'
                    : '';
                ?>
            </div>
        </div>
    </div>
</div>
