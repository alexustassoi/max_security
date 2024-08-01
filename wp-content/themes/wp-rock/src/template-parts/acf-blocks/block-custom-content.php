<?php

/**
 * Block - Custom content.
 *
 * @package WP-rock
 * @since   4.4.0
 */

global $global_options;

$class_name        = isset($args['className']) ? ' ' . $args['className'] : '';
$block_bg_color    = isset($args['backgroundColor']) ? $args['backgroundColor'] : '';
// $main_tags_colours = get_field_value($global_options, 'main_tags_colours');
$fields            = get_fields();
$block_pt          = get_field_value($fields, 'block_pt');
$space_top_type    = $block_pt ? get_field_value($fields, 'space_top_type') : '';
$block_pb          = get_field_value($fields, 'block_pb');
$space_bottom_type = $block_pb ? get_field_value($fields, 'space_bottom_type') : '';
$text              = get_field_value($fields, 'text');
// $tag_term_id     = get_field_value($fields, 'select_tag');
// $tag_term_color    = '';
/*
// $title = get_field_value($fields, 'title');
if (is_array($main_tags_colours) && !empty($main_tags_colours)) :
    foreach ($main_tags_colours as $item):
        $option_tag_id = get_field_value($item, 'title');

        if ($option_tag_id === $tag_term_id) :
            $tag_term_color = get_field_value($item, 'tag_term_color');
        endif; */?><!--
    --><?php /*endforeach;
endif;*/

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');


$hide_block        = get_field_value($fields, 'hide_block');

if ($hide_block) {
    return '';
}
?>

<div class="custom-content <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : ''; echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : ''; echo $class_name; echo ' space-top-type-' . do_shortcode($space_top_type) . ' '; echo ' space-bottom-type-' . $space_bottom_type . ' '; ?>" style="background-color: <?php  echo $block_bg_color ? 'var(--wp--preset--color--' . do_shortcode($block_bg_color) . ');' : 'transparent;'; ?>">
    <div class="custom-content__inner">
        <div class="custom-container">
            <div class="custom-content__content">
                <?php
                /*echo $title
                    ? '<h5 class="custom-content__title" style="color: ' . do_shortcode($tag_term_color) . '">' . do_shortcode($title) . '</h5>'
                    : '';*/

                echo $text
                    ? '<div class="custom-content__text">' . do_shortcode($text) . '</div>'
                    : '';
                ?>
            </div>
        </div>
    </div>
</div>
