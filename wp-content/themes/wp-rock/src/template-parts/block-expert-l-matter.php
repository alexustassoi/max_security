<?php
/**
 * Block - Expert lens and matter.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields                = get_fields();
$title                 = get_field_value($fields, 'title');
$item_repeater         = get_field_value($fields, 'item_repeater');
$bg_img                = get_field_value($fields, 'bg_img');
$matter_title          = get_field_value($fields, 'matter_title');
$matter_btn            = get_field_value($fields, 'matter_btn');
$matter_bg_img         = get_field_value($fields, 'matter_bg_img');
$matter_content_bg_img = get_field_value($fields, 'matter_content_bg_img');

?>

<div class="expert-l-matter">
    <section id="expert-lens" class="expert-lens">
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
                                $img           = get_field_value($item, 'img');
                                $btn_1         = get_field_value($item, 'btn_1');
                                $item_content  = get_field_value($item, 'item_content');
                                $authors_name  = get_field_value($item, 'authors_name');
                                $author_status = get_field_value($item, 'author_status');
                                $btn_2         = get_field_value($item, 'btn_2');
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
                <img class="expert-lens__glob"
                     src="<?php echo get_site_url(); ?>/wp-content/uploads/2023/bigglob.svg"
                     alt="">
            </div>

        </div>
    </section>
    <section id="matter" class="matter">
        <div class="matter__container">
            <?php
            if ($matter_bg_img) { ?>
                <img class="bg-img" src="<?php echo ($matter_bg_img) ? do_shortcode($matter_bg_img) : "none"; ?>"
                     alt="Image"/>
            <?php } ?>
            <img class="bg-figure" src="<?php echo get_site_url(); ?>/wp-content/uploads/2023/matter-figure.svg"
                 alt="">

            <?php
            if ($matter_content_bg_img) { ?>
                <img class="content-bg-img"
                     src="<?php echo ($matter_content_bg_img) ? do_shortcode($matter_content_bg_img) : "none"; ?>"
                     alt="Image"/>
            <?php } ?>
        </div>
        <div class="matter__content">
            <?php
            echo ($matter_title)
                ? '<h2 class="matter__title">' . do_shortcode($matter_title) . '</h2>'
                : '';

            echo ($matter_btn)
                ? '<a href="' . esc_html($matter_btn["url"]) . '" class="matter__btn button brown-btn">' . do_shortcode($matter_btn["title"]) . '</a>'
                : '';
            ?>
        </div>
    </section>
</div>
