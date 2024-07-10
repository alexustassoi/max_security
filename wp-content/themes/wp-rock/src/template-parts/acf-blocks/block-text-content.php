<?php

/**
 * Block - Small hero.
 *
 * @package WP-rock
 * @since   4.4.0
 */
$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields = get_fields();
$block_pt = get_field_value($fields, 'block_pt');
$space_top_type = $block_pt ? get_field_value($fields, 'space_top_type') : '';
$block_pb = get_field_value($fields, 'block_pb');
$space_bottom_type = $block_pb ? get_field_value($fields, 'space_bottom_type') : '';
$title = get_field_value($fields, 'title');
$content = get_field_value($fields, 'content');
$link = get_field_value($fields, 'link');
$section_background = get_field_value($fields, 'colors_select');

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');

?>

<div class="text-content <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : ''; echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : ''; echo esc_html($class_name); echo ' space-top-type-' . do_shortcode($space_top_type) . ' '; echo ' space-bottom-type-' . $space_bottom_type . ' '; ?>"
    style="background-color: <?php echo $section_background ?: '#5a7153'; ?>;">
    <div class="custom-container text-content__custom-container">
        <?php
        if (!empty($title)) {
            echo '<div class="text-content__title">' . $title . '</div>';
        }
        if (!empty($content)) {
            echo '<div class="text-content__content">' . do_shortcode($content) . '</div>';
        }
        if (isset($link['url']) && isset($link['title'])) {
            echo '<a href="' . esc_url($link['url']) . '" class="text-content__link">
                        ' . do_shortcode($link['title']) . '
                    </a>';
        }
        ?>
    </div>
</div>
