<?php

/**
 * Block - Small hero.
 *
 * @package WP-rock
 * @since   4.4.0
 */
$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields = get_fields();
$title = get_field_value($fields, 'title');
$content = get_field_value($fields, 'content');
$link = get_field_value($fields, 'link');
$section_background = get_field_value($fields, 'section_background');
?>
<div class="text-content <?php echo esc_html($class_name); ?>"
    style="background-color: <?php echo $section_background ?: '#5a7153'; ?>;">
    <div class="custom-container text-content__custom-container">
        <?php
        if (!empty($title)) {
            echo '<h4 class="text-content__title">' . $title . '</h4>';
        }
        if (!empty($content)) {
            echo '<div class="text-content__content">' . do_shortcode($content) . '</div>';
        }
        if (isset($link['url']) && isset($link['title'])) {
            echo '<a href="' . esc_url($link['url']) . '" class="text-content__link">
                        ' . do_shortcode($link['title']) . '
                    </a>';
        }
        ?>
    </div>
</div>
