<?php
/**
 * Block - How it works.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields        = get_fields();
$title         = get_field_value($fields, 'title');
$item_repeater = get_field_value($fields, 'item_repeater');

?>

<section id="how-it-works" class="how-it-works">
    <div class="container how-it-works__container">
        <div class="intelligence-h__menu-wrap"></div>
        <div class="how-it-works__content">
            <?php
            echo ($title)
                ? '<h4 class="how-it-works__title">' . do_shortcode($title) . '</h4>'
                : '';

            if ($item_repeater) {
                $count = 1;
                ?>
                <div class="how-it-works__items js-howItWorks-items">
                    <?php foreach ($item_repeater as $item) {
                        $item_title = get_field_value($item, 'item_title');
                        $item_text  = get_field_value($item, 'item_text');
                        $item_img   = get_field_value($item, 'item_img');

                        if ($count > 2) continue;
                        ?>
                        <div class="how-it-works__item js-howItWorks-item <?php echo (1 === $count) ? 'active' : ''; ?>" data-role="toggle-howItWorks-item">
                            <div class="how-it-works__item-content">
                                <div class="how-it-works__item-top">
                                    <div class="how-it-works__item-number">
                                        <?php echo do_shortcode($count); ?>
                                    </div>
                                    <?php
                                    echo ($item_title)
                                        ? '<div class="how-it-works__item-closed-title js-disable-item-title">' . do_shortcode($item_title) . '</div>'
                                        : '';
                                    ?>
                                    <?php
                                    echo ($item_title)
                                        ? '<h5 class="how-it-works__item-active-title js-active-item-title">' . do_shortcode($item_title) . '</h5>'
                                        : '';
                                    ?>
                                </div>
                                <?php
                                echo ($item_text)
                                    ? '<p class="how-it-works__item-text">' . do_shortcode($item_text) . '</p>'
                                    : '';
                                ?>
                            </div>
                            <?php
                            echo ($item_img)
                                ? '<figure class="how-it-works__item-figure"><img width="233" height="273" src="' .esc_html($item_img) . '" alt="Image" /></figure>'
                                : '';
                            ?>
                        </div>
                    <?php $count++; } ?>
                </div>
            <?php }
            ?>
        </div>
    </div>
</section>
