<?php
/**
 * Block - Our team.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields        = get_fields();
$title         = get_field_value($fields, 'title');
$card_repeater = get_field_value($fields, 'card_repeater');

?>

<section id="our-team" class="our-team">
    <div class="container our-team__container">
        <?php
        echo ($title)
            ? '<h3 class="our-team__title">' . do_shortcode($title) . '</h3>'
            : '';

        if ($card_repeater) { ?>
            <div class="our-team__cards">
                <?php foreach ($card_repeater as $item) {
                    $image  = get_field_value($item, 'image');
                    $name   = get_field_value($item, 'name');
                    $status = get_field_value($item, 'status');
                    $text   = get_field_value($item, 'text');
                    ?>
                    <div class="our-team__card">
                        <?php
                        echo ($image)
                            ? '<figure class="our-team__img-wrap"><img width="300" height="310" class="our-team__img" src="' . esc_html($image) . '" alt="Person" /></figure>'
                            : '';

                        echo ($name)
                            ? '<div class="our-team__name">' . do_shortcode($name) . '</div>'
                            : '';

                        echo ($status)
                            ? '<div class="our-team__status">' . do_shortcode($status) . '</div>'
                            : '';
                        ?>
                        <div class="our-team__card-inner">
                            <?php
                            echo ($name)
                                ? '<div class="our-team__name">' . do_shortcode($name) . '</div>'
                                : '';

                            echo ($status)
                                ? '<div class="our-team__status">' . do_shortcode($status) . '</div>'
                                : '';

                            echo ($text)
                                ? '<p class="our-team__text">' . do_shortcode($text) . '</p>'
                                : '';
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php }
        ?>
    </div>
</section>
