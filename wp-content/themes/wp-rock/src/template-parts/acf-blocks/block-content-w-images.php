<?php

/**
 * Block - Content with images.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name     = isset($args['className']) ? ' ' . $args['className'] : '';
$fields         = get_fields();
$content_w_images = get_field_value($fields, 'content_w_images');


$hide_block        = get_field_value($fields, 'hide_block');

if ($hide_block) {
    return '';
}
?>

<div class="content-w-images <?php echo $class_name; ?>">
    <div class="content-w-images__inner">
        <div class="custom-container">
            <?php
            echo $content_w_images
                ? '<div class="content-w-images__content">' . do_shortcode($content_w_images) . '</div>'
                : '';
            ?>
        </div>
    </div>
</div>
