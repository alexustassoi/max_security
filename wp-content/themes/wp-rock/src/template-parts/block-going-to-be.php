<?php
/**
 * Block - Going to be.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields = get_fields();
$title  = get_field_value($fields, 'title');
$text   = get_field_value($fields, 'text');
$wrapping = get_field_value($fields, 'wrapping');

?>

<section id="going-to-be" class="going-to-be">
    <div class="container going-to-be__container">
        <?php if ($wrapping == true) : ?>
            <div class="intelligence-h__menu-wrap"></div>
        <?php endif; ?>
        <div class="going-to-be__content">
            <?php
            echo ($title)
                ? '<h2 class="going-to-be__title">' . do_shortcode($title) . '</h2>'
                : '';

            echo ($text)
                ? '<p class="going-to-be__desc">' . do_shortcode($text) . '</p>'
                : '';
            ?>
        </div>
    </div>
</section>
