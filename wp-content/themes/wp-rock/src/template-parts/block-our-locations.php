<?php
/**
 * Block - Our locations.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields            = get_fields();
$title             = get_field_value($fields, 'title');
$location_repeater = get_field_value($fields, 'location_repeater');

?>

<section id="our-locations" class="our-locations">
    <div class="container our-locations__container">
        <?php
        echo ($title)
            ? '<h3 class="our-locations__title">' . do_shortcode($title) . '</h3>'
            : '';

        if ($location_repeater) { ?>
            <div class="our-locations__items">
                <?php foreach ($location_repeater as $item) {
                    $img       = get_field_value($item, 'img');
                    $continent = get_field_value($item, 'continent');
                    $location  = get_field_value($item, 'location');
                    $phone     = get_field_value($item, 'phone');
                    $email     = get_field_value($item, 'email');
                    $image_id = attachment_url_to_postid( $img );
                    list($image_src, $image_width, $image_height) = wp_get_attachment_image_src($image_id, 'default', true);

                    if ($phone) {
                        $clear_tel = preg_replace('/([\-\s\(\)\/])+/', '' , $phone);
                    }
                    ?>
                    <div class="our-locations__item">
                        <?php
                        echo ($img)
                            ? '<figure class="our-locations__img-wrap"><img width="' . do_shortcode($image_width) . '" height="' . do_shortcode($image_height ) . '" src="' . do_shortcode($img) . '" alt="Icon" /></figure>'
                            : '';

                        echo ($continent)
                            ? '<div class="our-locations__continent">' . do_shortcode($continent) . '</div>'
                            : '';

                        echo ($location)
                            ? '<div class="our-locations__location">' . do_shortcode($location) . '</div>'
                            : '';

                        echo ($phone)
                            ? '<a href="tel:' . (($clear_tel) ? do_shortcode($clear_tel) : $phone) . '" class="our-locations__phone">' . do_shortcode($phone) . '</a>'
                            : '';

                        echo ($email)
                            ? '<a href="mailto:' . do_shortcode($email) . '" class="our-locations__email">' . do_shortcode($email) . '</a>'
                            : '';
                        ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>
