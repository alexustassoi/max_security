<?php
/**
 * Block - Our Clients.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields        = get_fields();
$title         = get_field_value($fields, 'title');
$logo_repeater = get_field_value($fields, 'logo_repeater');
$banner_title  = get_field_value($fields, 'banner_title');
$banner_img    = get_field_value($fields, 'banner_img');

?>

<section id="our-clients" class="our-clients">
    <div class="container our-clients__container">
        <?php
        echo ($title)
            ? '<h3 class="our-clients__title">' . do_shortcode($title) . '</h3>'
            : '';

        if ($logo_repeater) { ?>
            <div class="logos__logos our-clients__logos swiper js-logos-slider">
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

        if ($banner_title && $banner_img) { ?>
            <div class="our-clients__banner">
                <?php
                echo ($banner_title)
                    ? '<h4 class="our-clients__banner-title">' . do_shortcode($banner_title) . '</h4>'
                    : '';

                echo ($banner_img)
                    ? '<figure class="our-clients__banner-img-wrap"><img class="our-clients__banner-img" width="312" height="65" src="' . esc_html($banner_img) . '" alt="Partner" /></figure>'
                    : '';
                ?>
            </div>
        <?php } ?>
    </div>
</section>
