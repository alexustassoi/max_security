<?php
/**
 * Block - Max journey.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields        = get_fields();
$title         = get_field_value($fields, 'title');
$card_repeater = get_field_value($fields, 'card_repeater');

?>

<section id="max-journey" class="max-journey">
    <div class="container max-journey__container">
        <div class="max-journey__content">
            <?php
            echo ($title)
                ? '<h2 class="max-journey__title">' . do_shortcode($title) . '</h2>'
                : '';

            if ($card_repeater) { ?>
                <div class="max-journey__cards swiper js-max-journey">
                    <div class="swiper-wrapper">
                        <?php foreach ($card_repeater as $item) {
                            $year       = get_field_value($item, 'year');
                            $icon_type  = get_field_value($item, 'icon_type');
                            $img        = get_field_value($item, 'img');
                            $card_title = get_field_value($item, 'card_title');
                            $card_desc  = get_field_value($item, 'card_desc');
                            $image_id   = attachment_url_to_postid($img);
                            list($image_url, $image_width, $image_height) = wp_get_attachment_image_src($image_id, 'default', true);
                            ?>
                            <div class="max-journey__card swiper-slide <?php echo esc_html($icon_type); ?>">
                                <div class="max-journey__year">
                                    <?php echo do_shortcode($year); ?>
                                </div>
                                <div class="max-journey__card-content">
                                    <figure class="max-journey__card-img-wrap">
                                        <img class="max-journey__card-img" src="<?php echo esc_html($img); ?>" alt="Image"
                                             width="<?php echo esc_html($image_width); ?>"
                                             height="<?php echo esc_html($image_height); ?>">
                                    </figure>
                                    <div class="max-journey__card-info">
                                        <div class="max-journey__card-title">
                                            <?php echo do_shortcode($card_title); ?>
                                        </div>
                                        <p class="max-journey__card-desc">
                                            <?php echo do_shortcode($card_desc); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="max-journey__swiper-btn-wrap swiper-button-wrap">
                        <!-- Swiper navigation buttons -->
                        <div
                            class="max-journey__button-prev swiper-button-prev slider-btn-prev"></div>
                        <div
                            class="max-journey__button-next swiper-button-next slider-btn-next"></div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
</section>
