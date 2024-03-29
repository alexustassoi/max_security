<?php
/**
 * Block - Intelligence hero.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields        = get_fields();
$subtitle      = get_field_value($fields, 'subtitle');
$title         = get_field_value($fields, 'title');
$desc          = get_field_value($fields, 'desc');
$content_btn_1 = get_field_value($fields, 'content_btn_1');
$content_btn_2 = get_field_value($fields, 'content_btn_2');
$block_img     = get_field_value($fields, 'block_img');
$lets_talk_btn = get_field_value($fields, 'lets_talk_btn');

$image_id  = attachment_url_to_postid($block_img);
$imagesize = wp_get_attachment_image_src($image_id, 'default', true);
list($image_src, $image_width, $image_height) = $imagesize;

?>

<section id="intelligence-h" class="intelligence-h">
    <div class="container intelligence-h__container">
        <div class="intelligence-h__menu-wrap">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'intelligence_menu',
                    'container' => 'ul',
                    'menu_class' => 'intelligence-h__menu',
                )
            );

            echo ($lets_talk_btn)
                ? '<a href="' . $lets_talk_btn["url"] . '" class="intelligence-h__talk-btn button red-btn">' . do_shortcode($lets_talk_btn["title"]) . '</a>'
                : '';
            ?>
        </div>

        <div class="intelligence-h__content-wrap">
            <div class="intelligence-h__content">
                <?php
                echo ($subtitle)
                    ? '<h6 class="intelligence-h__subtitle">' . do_shortcode($subtitle) . '</h6>'
                    : '';

                echo ($title)
                    ? '<h2 class="intelligence-h__title">' . do_shortcode($title) . '</h2>'
                    : '';

                echo ($desc)
                    ? '<div class="intelligence-h__desc">' . do_shortcode($desc) . '</div>'
                    : '';

                ?>
                <div class="intelligence-h__buttons">
                    <?php 
                    echo ($content_btn_1)
                        ? '<a href="' . $content_btn_1["url"] . '" class="intelligence-h__btn-1 button white-btn">' . do_shortcode($content_btn_1["title"]) . '</a>'
                        : '';

                    echo ($content_btn_2)
                        ? '<a href="' . $content_btn_2["url"] . '" class="intelligence-h__btn-2 button white-brown-btn">' . do_shortcode($content_btn_2["title"]) . '</a>'
                        : '';
                    ?>
                </div>
            </div>
            <?php
            echo ($block_img)
                ? '<figure class="intelligence-h__block-img"><img width="' . esc_html($image_width) . '" height="' . esc_html($image_height) . '" src="' . esc_html($block_img) . '" alt="Image"></figure>'
                : '';
            ?>
        </div>
    </div>
</section>
