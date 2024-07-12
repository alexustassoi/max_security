<?php

/**
 * Block - Accordion.
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
$title             = get_field_value($fields, 'title');
$accordion         = get_field_value($fields, 'accordion');
$form_title        = get_field_value($fields, 'form_title');
$form              = get_field_value($fields, 'form');

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');

?>

<div class="accordion <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : ''; echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : ''; echo ' space-top-type-' . do_shortcode($space_top_type) . ' '; echo ' space-bottom-type-' . $space_bottom_type . ' '; ?>">
    <div class="custom-container">
        <?php if (!empty($title)) {
            echo '<div class="accordion__title">' . do_shortcode($title) . '</div>';
        } ?>
        <?php if (!empty($accordion)) : ?>
            <div class="accordion__wrapper wrock-accordion js-wrock-accordion">
                <?php foreach ($accordion as $item) : ?>
                    <div class="accordion__item wrock-accordion__item js-wrock-accordion__item"
                         id="<?php echo sanitize_title($item['title']); ?>">
                        <?php
                        if (!empty($item['title'])) {
                            $img =  !empty($item['icon']) ? '<img class="accordion__item-icon style-svg" src="' . $item['icon'] . '" alt="icon">' : '';

                            $img_hover =  !empty($item['icon']) ? '<img class="accordion__item-icon hover style-svg" src="' . $item['icon_hover'] . '" alt="icon">' : '';

                            echo '<button class="accordion__btn wrock-accordion__btn js-wrock-accordion__btn">
                                    ' . $img . '
                                    ' . $img_hover . '
                                    ' . $item['title'] . '
                                </button>';
                        }
                        if (!empty($item['content'])) {
                            echo '<div class="accordion__item-content wrock-accordion__content js-wrock-accordion__content">
                                        ' . $item['content'] . '
                                    </div>';
                        }
                        ?>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="custom-container">
        <?php
        if (!empty($form_title)) {
            echo '<div class="accordion__form-title">' . do_shortcode($form_title) . '</div>';
        }

        if (!empty($form)) {
            echo do_shortcode($form);
        }
        ?>
    </div>
</div>
