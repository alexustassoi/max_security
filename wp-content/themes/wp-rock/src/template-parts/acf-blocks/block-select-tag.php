<?php

/**
 * Block - Select category.
 *
 * @package WP-rock
 * @since   4.4.0
 */

global $global_options;

$class_name        = isset($args['className']) ? ' ' . $args['className'] : '';
$main_tags_colours = get_field_value($global_options, 'main_tags_colours');
$fields            = get_fields();
$block_pt          = get_field_value($fields, 'block_pt');
$space_top_type    = $block_pt ? get_field_value($fields, 'space_top_type') : '';
$block_pb          = get_field_value($fields, 'block_pb');
$space_bottom_type = $block_pb ? get_field_value($fields, 'space_bottom_type') : '';
$tag_term_id       = get_field_value($fields, 'select_tag');
$tag_term_color    = '';

if (is_array($main_tags_colours) && !empty($main_tags_colours)) :
    foreach ($main_tags_colours as $item):
        $option_tag_id = get_field_value($item, 'title');

        if ($option_tag_id === $tag_term_id) :
            $tag_term_color = get_field_value($item, 'tag_term_color');
        endif; ?>
    <?php endforeach;
endif;

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');

$hide_block        = get_field_value($fields, 'hide_block');

if ($hide_block) {
    return '';
}

?>

<div class="select-tag <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : ''; echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : ''; echo $class_name; echo ' space-top-type-' . do_shortcode($space_top_type) . ' '; echo ' space-bottom-type-' . $space_bottom_type . ' '; ?>"
     style="background-color: <?php echo do_shortcode($tag_term_color); ?>">
    <div class="select-tag__inner">
        <div class="custom-container">
            <?php
            if ($tag_term_id) :
                $tag = get_term($tag_term_id);
                $tag_icon_url = get_field('card_icon', 'resource_tag_' . $tag_term_id);
                $tag_term_name = $tag->name;
                ?>
                <div class="select-tag__tag-info">
                    <figure class="select-tag__tag-icon-wrap">
                        <img width="48" height="48" src="<?php echo esc_html($tag_icon_url); ?>" alt="Icon"/>
                    </figure>
                    <p class="select-tag__tag-name"><?php echo do_shortcode($tag_term_name); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

