<?php
/**
 * Block - Personalized protection.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields        = get_fields();
$title         = get_field_value($fields, 'title');
$desc          = get_field_value($fields, 'desc');
$item_repeater = get_field_value($fields, 'item_repeater');

?>

<section id="protection" class="protection">
    <div class="container protection__container">
        <?php
        echo ($title)
            ? '<h3 class="protection__title">' . do_shortcode($title) . '</h3>'
            : '';

        echo ($desc)
            ? '<p class="protection__desc">' . do_shortcode($desc) . '</p>'
            : '';

        if ($item_repeater) { ?>
            <div class="protection__items">
                <?php foreach ($item_repeater as $item) {
                    $icon       = get_field_value($item, 'icon');
                    $item_title = get_field_value($item, 'item_title');
                    $item_text  = get_field_value($item, 'item_text');
                    ?>
                    <div class="protection__item">
                        <figure class="protection__item-icon">
                            <img src="<?php echo esc_html($icon); ?>" alt="Icon" width="135" height="87">
                        </figure>
                        <div class="protection__item-title">
                            <?php echo do_shortcode($item_title); ?>
                        </div>
                        <div class="protection__item-text">
                            <?php echo do_shortcode($item_text); ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php }
        ?>
    </div>
</section>
