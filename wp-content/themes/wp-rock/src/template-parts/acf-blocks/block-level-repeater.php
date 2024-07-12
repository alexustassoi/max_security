<?php

/**
 * Block - Level repeater.
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
$level_repeater    = get_field_value($fields, 'level_repeater');

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');

?>

<div class="level-repeater <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : ''; echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : ''; echo $class_name; echo ' space-top-type-' . do_shortcode($space_top_type) . ' '; echo ' space-bottom-type-' . $space_bottom_type . ' '; ?>">
    <div class="level-repeater__inner">
        <div class="custom-container">
            <?php if($level_repeater): ?>
                <div class="level-repeater__levels">
                    <?php
                    foreach ($level_repeater as $index => $item):
                        $icon_text = get_field_value($item, 'icon_text');
                        $level_content = get_field_value($item, 'level_content');
                        ?>
                        <div class="level-repeater__level">
                            <div class="level-repeater__icon">
                                <?php
                                echo $icon_text
                                    ? '<div class="level-repeater__icon-text">'. do_shortcode($icon_text) . '</div>'
                                    : '';
                                ?>
                                <h4 class="level-repeater__icon-number">
                                    <?php echo do_shortcode($index + 1); ?>
                                </h4>
                            </div>
                            <?php
                            echo $level_content
                                ? '<div class="level-repeater__level-content">'. do_shortcode($level_content) . '</div>'
                                : '';
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
