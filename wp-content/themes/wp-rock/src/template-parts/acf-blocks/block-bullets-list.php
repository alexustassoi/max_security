<?php

/**
 * Block - Bullets list.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name    = isset($args['className']) ? ' ' . $args['className'] : '';
$fields        = get_fields();
$block_pt      = get_field_value($fields, 'block_pt');
$block_pb      = get_field_value($fields, 'block_pb');
$bg_color      = get_field_value($fields, 'bg_color');
$title         = get_field_value($fields, 'title');
$bullet_list_1 = get_field_value($fields, 'bullet_list_1');
$bullet_list_2 = get_field_value($fields, 'bullet_list_2');

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');
?>

<div class="bullets-list <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : '';
echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : '';
echo $class_name; ?>" style="background-color: <?php echo $bg_color ? do_shortcode($bg_color) : '#f5f5f5'; ?>">
    <div class="bullets-list__inner">
        <div class="custom-container">
            <div class="bullets-list__content">
                <?php
                echo $title
                    ? '<p class="bullets-list__title">' . do_shortcode($title) . '</p>'
                    : '';
                ?>
                <div class="bullets-list__columns">
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
