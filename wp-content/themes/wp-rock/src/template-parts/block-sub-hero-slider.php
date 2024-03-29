<?php
/**
 * Block - Sub hero slider.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields        = get_fields();
$popup_id      = get_field_value($fields, 'popup_id');
$item_repeater = get_field_value($fields, 'item_repeater');
//var_dump('$item_repeater', $item_repeater);

?>

<div id="subhero-slider" class="subhero-slider">
    <div class="subhero-slider__content">
        <?php
        if ($item_repeater) { ?>
            <div class="subhero-slider__items js-subhero-slider">
                <?php foreach ($item_repeater as $item) {
                    $icon      = get_field_value($item, 'icon');
                    $text      = get_field_value($item, 'text');
                    $item_link = get_field_value($item, 'item_link');
                    ?>
                    <div class="subhero-slider__item js-subhero-slider-item">
                        <?php
                        echo ($item_link && $popup_id)
                            ? '<a href="' . esc_html($popup_id) . '" class="subhero-slider__link js-open-popup-activator" data-url="' . esc_html($item_link) . '" data-role="get-popup-slider-data"></a>'
                            : '';
                        ?>
                        <div class="subhero-slider__icon-wrap">
                            <?php
                            echo ($icon)
                                ? '<img class="subhero-slider__icon" width="20" height="20" src="' . do_shortcode($icon) . '" alt="Icon" />'
                                : '';
                            ?>
                        </div>
                        <p class="subhero-slider__item-text">
                            <?php echo do_shortcode($text); ?>
                        </p>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>
