<?php

/**
 * Block - Custom content.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name     = isset($args['className']) ? ' ' . $args['className'] : '';
$fields         = get_fields();
$custom_content = get_field_value($fields, 'custom_content');

?>

<div class="custom-content <?php echo $class_name; ?>">
    <div class="custom-content__inner">
        <div class="custom-container">
            <div class="custom-content__content">
                <?php
                echo $custom_content ? do_shortcode($custom_content) : '';
                ?>
            </div>
        </div>
    </div>
</div>
