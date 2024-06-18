<?php

/**
 * Block - Bullets list.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields = get_fields();
$title = get_field_value($fields, 'title');
$bullet_list_1 = get_field_value($fields, 'bullet_list_1');
$bullet_list_2 = get_field_value($fields, 'bullet_list_2');

?>

<div class="bullets-list <?php echo $class_name; ?>">
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
