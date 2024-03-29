<?php
/**
 * Block - Intelligence slider.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields        = get_fields();
$title         = get_field_value($fields, 'title');
$item_repeater = get_field_value($fields, 'item_repeater');
$bg_img        = get_field_value($fields, 'bg_img');

?>

<section id="intelligence-slider" class="intelligence-slider">
    <div class="container intelligence-slider__container">
        <div class="intelligence-h__menu-wrap"></div>
        <div class="intelligence-slider__content">
            <?php
            echo ($title)
                ? '<h3 class="intelligence-slider__title">' . do_shortcode($title) . '</h3>'
                : '';

            if ($item_repeater) { ?>
                <div class="intelligence-slider__slider-wrap">
                    <?php
                    echo ($bg_img)
                        ? '<img class="intelligence-slider__bg-img" width="650" height="650" src="' . do_shortcode($bg_img) . '" alt="Globe" />'
                        : '';
                    ?>
                    <div class="intelligence-slider__slider swiper js-intelligence-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($item_repeater as $item) {
                                $btn_1         = get_field_value($item, 'btn_1');
                                $item_content  = get_field_value($item, 'item_content');
                                $authors_name  = get_field_value($item, 'authors_name');
                                $author_status = get_field_value($item, 'author_status');
                                $btn_2         = get_field_value($item, 'btn_2');
                                ?>
                                <div class="intelligence-slider__item swiper-slide">
                                    <div class="intelligence-slider__content-wrap">
                                        <div class="intelligence-slider__content-wrap">
                                            <a href="<?php echo esc_html($btn_1["url"]); ?>"
                                               class="intelligence-slider__btn-1 button brown-transparent-btn">
                                                <?php echo do_shortcode($btn_1["title"]); ?>
                                            </a>
                                            <div class="intelligence-slider__content">
                                                <?php echo do_shortcode($item_content); ?>
                                            </div>
                                            <div class="intelligence-slider__authors-name">
                                                <?php echo do_shortcode($authors_name); ?>
                                            </div>
                                            <div class="intelligence-slider__author-status">
                                                <?php echo do_shortcode($author_status); ?>
                                            </div>
                                            <a href="<?php echo esc_html($btn_2["url"]); ?>"
                                               class="intelligence-slider__btn-2 button brown-btn">
                                                <?php echo do_shortcode($btn_2["title"]); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="intelligence-slider__swiper-btn-wrap swiper-button-wrap">
                            <!-- Swiper navigation buttons -->
                            <div class="intelligence-slider__btn-prev swiper-button-prev slider-btn-prev"></div>
                            <div class="intelligence-slider__btn-next swiper-button-next slider-btn-next"></div>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
</section>
