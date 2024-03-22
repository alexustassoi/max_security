<?php

/**
 * Block - Text repeater.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields = get_fields();
$title = get_field_value($fields, 'title');
$text_repeater = get_field_value($fields, 'text_repeater');
$bg_color = get_field_value($fields, 'colors_select');
$bg_color = !empty($bg_color) ? $bg_color : '#5A7153';

?>
<div class="text-repeater" style="background-color: <?php echo $bg_color; ?>">
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
