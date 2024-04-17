<?php
/**
 * Block - Slider with big image.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields         = get_fields();
$slide_repeater = get_field_value($fields, 'slide_repeater');
$wrapping = get_field_value($fields, 'wrapping');

?>

<section id="slider-w-img" class="slider-w-img">
    <div class="container slider-w-img__container">
        <?php if ($wrapping == true) : ?>
            <div class="intelligence-h__menu-wrap"></div>
        <?php endif; ?>
        <div class="slider-w-img__content">
            <?php
            if ($slide_repeater) { ?>
                <div class="slider-w-img__items swiper js-slider-w-img">
                    <div class="swiper-wrapper">
                        <?php foreach ($slide_repeater as $item) {
                            $img         = get_field_value($item, 'img');
                            $title       = get_field_value($item, 'title');
                            $desc        = get_field_value($item, 'desc');
                            $author_name = get_field_value($item, 'author_name');
                            $job_status  = get_field_value($item, 'job_status');
                            $image_id    = attachment_url_to_postid($img);
                            list($image_url, $image_width, $image_height) = wp_get_attachment_image_src($image_id, 'default', true);
                            ?>
                            <div class="slider-w-img__item swiper-slide">
                                <figure class="slider-w-img__item-icon">
                                    <img src="<?php echo esc_html($img); ?>" alt="Image"
                                         width="<?php echo esc_html($image_width); ?>"
                                         height="<?php echo esc_html($image_height); ?>">
                                </figure>
                                <div class="slider-w-img__item-content">
                                    <h5 class="slider-w-img__item-title">
                                        <?php echo do_shortcode($title); ?>
                                    </h5>
                                    <p class="slider-w-img__item-desc">
                                        <?php echo do_shortcode($desc); ?>
                                    </p>
                                    <div class="slider-w-img__author-name">
                                        <?php echo do_shortcode($author_name); ?>
                                    </div>
                                    <div class="slider-w-img__job-status">
                                        <?php echo do_shortcode($job_status); ?>
                                    </div>
                                    <div class="slider-w-img__swiper-btn-wrap swiper-button-wrap desktop">
                                        <!-- Swiper navigation buttons -->
                                        <div class="slider-w-img__button-prev slider-btn-prev swiper-button-prev"></div>
                                        <div class="slider-w-img__button-next slider-btn-next swiper-button-next"></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="slider-w-img__swiper-btn-wrap swiper-button-wrap mobile">
                        <!-- Swiper navigation buttons -->
                        <div class="slider-w-img__button-prev slider-btn-prev swiper-button-prev"></div>
                        <div class="slider-w-img__button-next slider-btn-next swiper-button-next"></div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
</section>
