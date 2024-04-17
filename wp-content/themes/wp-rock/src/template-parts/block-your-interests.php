<?php
/**
 * Block - Your interests.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields         = get_fields();
$title          = get_field_value($fields, 'title');
$level_repeater = get_field_value($fields, 'level_repeater');

?>

<section id="your-interests" class="your-interests">
    <div class="container your-interests__container">
        <div class="intelligence-h__menu-wrap"></div>
        <div class="your-interests__content">
            <?php
            echo ($title)
                ? '<h4 class="your-interests__title">' . do_shortcode($title) . '</h4>'
                : '';

            if ($level_repeater) { ?>
                <div class="your-interests__levels">
                    <?php foreach ($level_repeater as $level) {
                        $item_title = get_field_value($level, 'item_title');
                        $item_text  = get_field_value($level, 'item_text');
                        ?>
                        <div class="your-interests__level">
                            <?php
                            echo ($item_title)
                                ? '<h3 class="your-interests__item-title">' . do_shortcode($item_title) . '</h3>'
                                : '';

                            echo ($item_text)
                                ? '<p class="your-interests__item-text">' . do_shortcode($item_text) . '</p>'
                                : '';
                            ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
