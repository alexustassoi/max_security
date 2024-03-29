<?php
/**
 * Burger menu template
 *
 * @package WP-rock
 */

global $global_options;

$btn_1 = get_field_value($global_options, 'btn_1');
$btn_2 = get_field_value($global_options, 'btn_2');

?>

<div id="burger-menu" class="burger-menu">
    <div class="container burger-menu__container">
        <div class="burger-menu__wrapper">
            <div class="burger-menu__menu-wrapper">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary_menu',
                        'container' => 'ul',
                        'menu_class' => 'burger-menu__menu',
                    )
                )
                ?>
            </div>
            <?php
            echo ($btn_1)
                ? '<a href="' . esc_html($btn_1["url"]) . '" class="burger-menu__btn-1 button red-btn js-open-popup-activator" data-role="get-popup-slider-data">' . do_shortcode($btn_1["title"]) . '</a>'
                : '';

            echo ($btn_2)
                ? '<a href="' . esc_html($btn_2["url"]) . '" class="burger-menu__btn-2 button white-brown-btn">' . do_shortcode($btn_2["title"]) . '</a>'
                : '';
            ?>
        </div>
    </div>
</div>
