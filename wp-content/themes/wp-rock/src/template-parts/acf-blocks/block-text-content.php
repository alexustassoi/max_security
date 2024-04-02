<?php

/**
 * Block - Small hero.
 *
 * @package WP-rock
 * @since   4.4.0
 */
$fields = get_fields();
$title = get_field_value($fields, 'title');
$content = get_field_value($fields, 'content');
?>
<div class="text-content">
    <div class="custom-container text-content__custom-container">
        <?php
        if (!empty($title)) {
            echo '<h4 class="text-content__title">' . $title . '</h4>';
        }
        if (!empty($content)) {
            echo '<div class="text-content__content">' . do_shortcode($content) . '</div>';
        }
        ?>
    </div>
</div>
