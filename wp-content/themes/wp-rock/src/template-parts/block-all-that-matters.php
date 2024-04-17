<?php
/**
 * Block - All that matters.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields         = get_fields();
$title          = get_field_value($fields, 'title');
$btn            = get_field_value($fields, 'btn');
$bg_img         = get_field_value($fields, 'bg_img');
$content_bg_img = get_field_value($fields, 'content_bg_img');

?>

<section id="matter" class="matter" >
    <div class="matter__container">
        <img class="bg-img" src="<?php echo ($bg_img) ? do_shortcode($bg_img) : 'none'; ?>" alt="">
        <img class="bg-figure" src="<?php echo get_site_url(); ?>/wp-content/uploads/2023/matter-figure.svg" alt="">
        <img class="content-bg-img" src="<?php echo ($content_bg_img) ? do_shortcode($content_bg_img) : 'none'; ?>" alt="">
    </div>
    <div class="matter__content">
        <?php
        echo ($title)
            ? '<h2 class="matter__title">' . do_shortcode($title) . '</h2>'
            : '';

        echo ($btn)
            ? '<a href="' . esc_html($btn["url"]) . '" class="matter__btn button brown-btn">' . do_shortcode($btn["title"]) . '</a>'
            : '';
        ?>
    </div>
</section>
