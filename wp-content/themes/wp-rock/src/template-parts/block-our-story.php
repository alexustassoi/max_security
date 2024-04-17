<?php
/**
 * Block - Our story.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields        = get_fields();
$title         = get_field_value($fields, 'title');
$item_repeater = get_field_value($fields, 'item_repeater');
$wrapping = get_field_value($fields, 'wrapping');

?>

<section id="our-story" class="our-story">
    <div class="container our-story__container">
        <?php if ($wrapping == true) : ?>
            <div class="intelligence-h__menu-wrap"></div>
        <?php endif; ?>
        <div class="our-story__content">
            <?php
            echo ($title)
                ? '<h3 class="our-story__title">' . do_shortcode($title) . '</h3>'
                : '';

            if ($item_repeater) {
                $count = 1;
                ?>
                <div class="our-story__items-wrap">
                    <div class="our-story__items">
                        <?php foreach ($item_repeater as $item) {
                            $icon       = get_field_value($item, 'icon');
                            $icon_hover = get_field_value($item, 'icon_hover');
                            $text       = get_field_value($item, 'text');
                            ?>
                            <div class="our-story__item js-our-story-item <?php echo (1 === $count) ? 'active' : ''; ?>"
                                 data-index="<?php echo esc_html($count); ?>"
                                 data-role="toggle-our-story">
                                <div class="our-story__icons">
                                    <?php
                                    echo ($icon)
                                        ? '<img class="our-story__icon" width="20" height="20" src="' . do_shortcode($icon) . '" alt="Icon" />'
                                        : '';

                                    echo ($icon_hover)
                                        ? '<img class="our-story__active-icon" width="20" height="20" src="' . do_shortcode($icon_hover) . '" alt="Icon" />'
                                        : '';
                                    ?>
                                </div>
                                <p class="our-story__item-text">
                                    <?php echo do_shortcode($text); ?>
                                </p>
                            </div>
                            <?php $count++;
                        } ?>
                    </div>
                    <div class="our-story__image-items">
                        <?php
                        $count = 1;
                        foreach ($item_repeater as $item) {
                            $img      = get_field_value($item, 'img');
                            $image_id = attachment_url_to_postid($img);
                            list($image_url, $image_width, $image_height) = wp_get_attachment_image_src($image_id, 'default', true);
                            ?>
                            <figure class="our-story__image-item js-our-story-img-item <?php echo (1 === $count) ? 'active' : ''; ?>"
                                    data-image-index="<?php echo esc_html($count); ?>">
                                <img src="<?php echo esc_html($image_url); ?>"
                                     width="<?php echo esc_html($image_width); ?>"
                                     height="<?php echo esc_html($image_height); ?>"
                                     alt="Image">
                            </figure>
                            <?php $count++;
                        } ?>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
</section>
