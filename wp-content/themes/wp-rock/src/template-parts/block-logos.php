<?php
/**
 * Block - All that logos.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields        = get_fields();
$logo_repeater = get_field_value($fields, 'logo_repeater');

?>

<section id="logos" class="logos">
    <div class="container logos__container">
        <div class="logos__content">
            <?php
            if ($logo_repeater) { ?>
                <div class="logos__logos swiper js-logos-slider">
                    <div class="swiper-wrapper">
                        <?php foreach ($logo_repeater as $item) {
                            $image     = get_field_value($item, 'image');
                            $hover_img = get_field_value($item, 'hover_img');
                            ?>
                            <figure class="logos__logo-img-wrap swiper-slide">
                                <?php
                                if (!empty($image)) { ?>
                                    <img class="logos__logo-img" src="<?php echo esc_html($image); ?>" alt="Logo"/>
                                <?php }

                                if (!empty($hover_img)) { ?>
                                    <img class="logos__hover-logo-img" src="<?php echo esc_html($hover_img); ?>"
                                         alt="Logo"/>
                                <?php } ?>
                            </figure>
                        <?php } ?>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
</section>
