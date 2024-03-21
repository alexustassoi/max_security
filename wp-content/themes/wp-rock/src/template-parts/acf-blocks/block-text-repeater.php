<?php

/**
 * Block - Slider popup.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields = get_fields();
$title = get_field_value($fields, 'title');
$text_repeater = get_field_value($fields, 'text_repeater');

?>
<div class="text-repeater">
    <div class="custom-container">
        <?php
        if (!empty($title)) {
            echo '<h4 class="text-repeater__title">' . do_shortcode($title) . '</h4>';
        }

        echo '<div class="text-repeater__inner">';

        if (!empty($text_repeater)) {
            foreach ($text_repeater as $item) {

                echo '<div class="text-repeater__item">
                            <h5 class="text-repeater__item-title">' . do_shortcode($item['title']) . '</h5>
                            <p class="text-repeater__item-description">
                                ' . do_shortcode($item['content']) . '
                            </p>
                        </div>';
            }
        }

        echo '</div>';
        ?>
    </div>
</div>
