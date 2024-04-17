<?php
/**
 * Block - Key concerns.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields        = get_fields();
$title         = get_field_value($fields, 'title');
$item_repeater = get_field_value($fields, 'item_repeater');

?>

<section id="key-concerns" class="key-concerns">
    <div class="container key-concerns__container">
        <div class="intelligence-h__menu-wrap"></div>
        <div class="key-concerns__content">
            <?php
            echo ($title)
                ? '<h3 class="key-concerns__title">' . do_shortcode($title) . '</h3>'
                : '';

            if ($item_repeater) { ?>
                <div class="key-concerns__items">
                    <?php foreach ($item_repeater as $item) {
                        $item_title = get_field_value($item, 'item_title');
                        ?>
                        <div class="key-concerns__item">
                            <?php
                            echo ($item_title)
                                ? '<p class="key-concerns__item-title">' . do_shortcode($item_title) . '</p>'
                                : '';
                            ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?> 
        </div>
    </div>
</section>
