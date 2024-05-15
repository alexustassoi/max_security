<?php

/**
 * Block - Accordion.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields = get_fields();
$title = get_field_value($fields, 'title');
$accordion = get_field_value($fields, 'accordion');
$form_title = get_field_value($fields, 'form_title');
$form = get_field_value($fields, 'form');
?>
<div class="accordion">
    <div class="custom-container">
        <?php if (!empty($title)) {
            echo '<h3 class="accordion__title">' . do_shortcode($title) . '</h3>';
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
                                    <span>' . $item['title'] . '</span>
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
            echo '<h3 class="accordion__form-title">' . do_shortcode($form_title) . '</h3>';
        }

        if (!empty($form)) {
            echo do_shortcode($form);
        }
        ?>
    </div>
</div>
