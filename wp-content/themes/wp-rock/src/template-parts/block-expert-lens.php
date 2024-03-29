<?php
/**
 * Block - Expert lens.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields = get_fields();
$title = get_field_value($fields, 'title');
$item_repeater = get_field_value($fields, 'item_repeater');
$bg_img = get_field_value($fields, 'bg_img');

?>

<section id="expert-lens" class="expert-lens" >
<!-- style="background-image: url(<?php /*echo ($bg_img) ? do_shortcode($bg_img) : 'none'; */ ?>)"-->
    <?php
    echo ($title)
        ? '<h2 class="expert-lens__title">' . do_shortcode($title) . '</h2>'
        : '';
    ?>
    <div class="expert-lens__container">
        <div class="expert-lens__content">
            <?php


            if ($item_repeater) { ?>
                <div class="expert-lens__expert-lens swiper js-expert-lens-slider">
                    <div class="swiper-wrapper">
                        <?php foreach ($item_repeater as $item) {
                            $img = get_field_value($item, 'img');
                            $btn_1 = get_field_value($item, 'btn_1');
                            $item_content = get_field_value($item, 'item_content');
                            $authors_name = get_field_value($item, 'authors_name');
                            $author_status = get_field_value($item, 'author_status');
                            $btn_2 = get_field_value($item, 'btn_2');
                            ?>
                            <div class="expert-lens__item swiper-slide">
                                <div class="expert-lens__img-wrap">
                                    <figure class="expert-lens__img-inner">
                                        <img class="expert-lens__author-img" src="<?php echo esc_html($img); ?>"
                                             alt="Author">
                                    </figure>
                                </div>
                                <div class="expert-lens__content-wrap">
                                    <div class="expert-lens__content-wrap">
                                        <a href="<?php echo esc_html($btn_1["url"]); ?>"
                                           class="expert-lens__btn-1 button brown-transparent-btn">
                                            <?php echo do_shortcode($btn_1["title"]); ?>
                                        </a>
                                        <div class="expert-lens__content">
                                            <?php echo do_shortcode($item_content); ?>
                                        </div>
                                        <div class="expert-lens__authors-name">
                                            <?php echo do_shortcode($authors_name); ?>
                                        </div>
                                        <div class="expert-lens__author-status">
                                            <?php echo do_shortcode($author_status); ?>
                                        </div>
                                        <a href="<?php echo esc_html($btn_2["url"]); ?>"
                                           class="expert-lens__btn-2 button brown-btn">
                                            <?php echo do_shortcode($btn_2["title"]); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="expert-lens__swiper-btn-wrap swiper-button-wrap">
                        <!-- Swiper navigation buttons -->
                        <div class="expert-lens__btn-prev swiper-button-prev slider-btn-prev"></div>
                        <div class="expert-lens__btn-next swiper-button-next slider-btn-next"></div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="expert-lens__glob-container">
            <img class="expert-lens__glob" src="<?php echo get_site_url(); ?>/wp-content/uploads/2023/bigglob.svg" alt="">
        </div>

    </div>
</section>
