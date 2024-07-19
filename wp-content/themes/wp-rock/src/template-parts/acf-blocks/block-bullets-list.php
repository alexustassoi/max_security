<?php

/**
 * Block - Bullets list.
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
$bg_color      = get_field_value($fields, 'bg_color');
$title         = get_field_value($fields, 'title');
$bullet_list_1 = get_field_value($fields, 'bullet_list_1');
$bullet_list_2 = get_field_value($fields, 'bullet_list_2');
$bullet_list_order_mob = get_field_value($fields, 'bullet_list_order_mob');

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');
?>

<div class="bullets-list <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : '';
echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : '';
echo $class_name; echo ' space-top-type-' . do_shortcode($space_top_type) . ' '; echo ' space-bottom-type-' . $space_bottom_type . ' '; ?>" style="background-color: <?php echo $bg_color ? do_shortcode($bg_color) : '#f5f5f5'; ?>">
    <div class="bullets-list__inner">
        <div class="custom-container">
            <div class="bullets-list__content">
                <?php
                echo $title
                    ? '<div class="bullets-list__title">' . do_shortcode($title) . '</div>'
                    : '';
                ?>
                <div class="bullets-list__columns <?php echo $bullet_list_order_mob === 'list-2-list-1' ? 'reverse-mob' : 'no-reverse-mob'; ?>">
                    <?php
                    echo $bullet_list_1
                        ? '<div class="bullets-list__col-1">' . do_shortcode($bullet_list_1) . '</div>'
                        : '';

                    echo $bullet_list_2
                        ? '<div class="bullets-list__col-2">' . do_shortcode($bullet_list_2) . '</div>'
                        : '';
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
