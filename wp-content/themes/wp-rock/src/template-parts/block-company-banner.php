<?php
/**
 * Block - Company banner.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields = get_fields();
$title  = get_field_value($fields, 'title');
$desc   = get_field_value($fields, 'desc');
$bg_img = get_field_value($fields, 'bg_img');

?>

<section id="company-banner" class="company-banner"
         style="background-image: url(<?php echo ($bg_img) ? do_shortcode($bg_img) : 'none'; ?>)">
    <div class="container company-banner__container">
        <div class="company-banner__content">
            <?php
            echo ($title)
                ? '<h1 class="company-banner__title">' . do_shortcode($title) . '</h1>'
                : '';

            echo ($desc)
                ? '<p class="company-banner__desc">' . do_shortcode($desc) . '</p>'
                : '';
            ?>
        </div>
    </div>
</section>
