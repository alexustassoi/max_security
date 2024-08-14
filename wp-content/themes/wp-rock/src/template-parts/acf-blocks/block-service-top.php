<?php
/**
 * Block - Service top.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name        = isset($args['className']) ? ' ' . $args['className'] : '';
$fields            = get_fields();
$hide_block        = get_field_value($fields, 'hide_block');
$block_pt          = get_field_value($fields, 'block_pt');
$space_top_type    = $block_pt ? get_field_value($fields, 'space_top_type') : '';
$block_pb          = get_field_value($fields, 'block_pb');
$space_bottom_type = $block_pb ? get_field_value($fields, 'space_bottom_type') : '';
$title             = get_field_value($fields, 'title');
$banner_is_small   = get_field_value($fields, 'banner_is_small');
$banner_is_video   = get_field_value($fields, 'banner_is_video');
$background_image  = get_field_value($fields, 'background_image');
$video_link        = get_field_value($fields, 'video_link');
$icon              = get_field_value($fields, 'icon');
$subtitle          = get_field_value($fields, 'subtitle');

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');

if (!$hide_block) :
    ?>

    <div id="service-top" class="service-top js-top-block <?php echo $banner_is_small ? 'banner-small ' : '';
    echo (!$icon) ? 'icon-is-missing' : '';
    echo esc_html($class_name); ?>" id="<?php echo $args['id']; ?>"
         style="background-image: url(<?php echo !$banner_is_video ? $background_image : 'none'; ?>)">
        <?php if ($video_link): ?>
            <video class="service-top__video" autoplay muted loop playsinline>
                <source src="<?php echo $video_link; ?>" type="video/mp4">
            </video>
        <?php endif; ?>
        <div
            class="service-top__custom-container custom-container <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : '';
            echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : '';
            echo ' space-top-type-' . do_shortcode($space_top_type) . ' ';
            echo ' space-bottom-type-' . $space_bottom_type . ' '; ?>">
            <div class="service-top__title <?php echo (!$icon) ? 'icon-is-missing' : ''; ?>">
                <?php if ($icon): ?>
                    <img src="<?php echo $icon ?>" alt="service icon">
                <?php endif; ?>

                <?php echo $title; ?>
            </div>

            <?php if ($subtitle): ?>
                <div
                    class="service-top__subtitle <?php echo (!$icon) ? 'icon-is-missing' : ''; ?>"><?php echo $subtitle; ?></div>
            <?php endif; ?>
        </div>

        <button class="service-top__scroll-bottom blink-animation js-scroll-bottom">
            <svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_202_7598)">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M44.753 43.8099C48.1282 40.1276 49.608 34.3909 49.608 26C49.608 17.6091 48.1282 11.8724 44.753 8.19014C41.4197 4.55352 35.7383 2.392 26 2.392C16.2617 2.392 10.5803 4.55352 7.24696 8.19014C3.87176 11.8724 2.392 17.6091 2.392 26C2.392 34.3909 3.87176 40.1276 7.24696 43.8099C10.5803 47.4465 16.2617 49.608 26 49.608C35.7383 49.608 41.4197 47.4465 44.753 43.8099ZM26 52C46.0436 52 52 43.1364 52 26C52 8.86364 46.0436 1.90735e-06 26 1.90735e-06C5.95636 1.90735e-06 0 8.86364 0 26C0 43.1364 5.95636 52 26 52Z"
                          fill="#CC7510"/>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M41.6078 27.8669H41.6159C41.6159 27.7822 41.6132 27.6975 41.6078 27.6129C41.5597 26.8579 41.2971 26.1135 40.8234 25.4749C40.7086 25.3201 40.5813 25.1715 40.4417 25.0305C38.8739 23.4627 36.345 23.4627 34.7692 25.0305L30.0104 29.7894L30.0104 11.3451C30.0104 9.12326 28.2217 7.33481 25.9999 7.33481C23.778 7.33481 21.9897 9.12326 21.9897 11.3451V29.7894L17.2309 25.0305C15.663 23.4627 13.1262 23.4627 11.5584 25.0305C9.99048 26.5984 9.99048 29.1276 11.5584 30.7033L25.1727 44.3178C25.6297 44.7748 26.3623 44.7748 26.8193 44.3178L40.434 30.7033C41.2219 29.9154 41.6078 28.8911 41.6078 27.8669ZM13.2524 29.0146C13.2529 29.0151 13.2535 29.0156 13.254 29.0162L25.996 41.7583L38.7426 29.0119C38.7426 29.0119 38.7426 29.0119 38.7426 29.0119C39.0607 28.6938 39.2158 28.2874 39.2158 27.8669V27.7058C39.1802 27.3523 39.0268 27.0032 38.7461 26.7178C38.115 26.0911 37.1018 26.0859 36.4582 26.7243C36.4576 26.725 36.457 26.7256 36.4564 26.7262L27.6184 35.5642L27.6184 11.3451C27.6184 10.4446 26.9008 9.7268 25.9999 9.7268C25.0992 9.7268 24.3817 10.4443 24.3817 11.3451V35.5642L15.5395 26.7219C14.9057 26.0882 13.8835 26.0882 13.2498 26.7219C12.6189 27.3528 12.6123 28.3695 13.2524 29.0146Z"
                          fill="#CC7510"/>
                </g>
                <defs>
                    <clipPath id="clip0_202_7598">
                        <rect width="52" height="52" fill="white" transform="matrix(0 -1 1 0 0 52)"/>
                    </clipPath>
                </defs>
            </svg>
        </button>
    </div>

<?php endif;
