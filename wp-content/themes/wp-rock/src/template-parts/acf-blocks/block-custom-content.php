<?php

/**
 * Block - Custom content.
 *
 * @package WP-rock
 * @since   4.4.0
 */

global $global_options;

$class_name     = isset($args['className']) ? ' ' . $args['className'] : '';
// $main_tags_colours = get_field_value($global_options, 'main_tags_colours');
$fields         = get_fields();
$text           = get_field_value($fields, 'text');
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

?>

<div class="custom-content <?php echo $class_name; ?>">
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
