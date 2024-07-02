<?php

/**
 * Block - Slider popup.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields      = get_fields();
$block_pt = get_field_value($fields, 'block_pt');
$block_pb = get_field_value($fields, 'block_pb');
$upper_description = get_field_value($fields, 'upper_description');
$title = get_field_value($fields, 'title');
$description = get_field_value($fields, 'description');
$slides = get_field_value($fields, 'slides');
$bg_color = get_field_value($fields, 'colors_select');

$show_slides_count = get_field_value($fields, 'show_slides_count');
$blocks_color = get_field_value($fields, 'blocks_color');
$background_color = get_field_value($fields, 'background_color');

$bg_color = !empty($bg_color) ? $bg_color : '#5A7153';
$blocks_color = !empty($blocks_color) ? $blocks_color : '#5A7153';
$background_color = !empty($background_color) ? $background_color : '#ffffff';

$white_text = $background_color !== '#ffffff' ? 'white-text' : '';
$no_margin = empty($slides) ? 'mb0' : '';

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');
?>

<div class="slider-popup <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : ''; echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : ''; echo $class_name .' ' . $white_text; ?>" style="background-color: <?php echo $background_color; ?>;">

    <div class="custom-container">
        <?php
        if (!empty($upper_description)) {
            echo '<div class="slider-popup__upper-description">
                        ' . do_shortcode($upper_description) . '
                    </div>';
        }
        ?>
        <div class="slider-popup__top-wrapper <?php echo $no_margin; ?>">
            <?php
            $title_is_empty = empty($title) ? 'title-is-empty' : '';

            if (!empty($title)) {
                echo '<h3 class="slider-popup__title animated-element from-left">' . do_shortcode($title) . '</h3>';
            }
            if (!empty($description)) {
                echo '<div class="slider-popup__description animated-element from-right ' . do_shortcode($title_is_empty) .  '">' . do_shortcode($description) . '</div>';
            }
            ?>
        </div>
        <?php if ($slides) : ?>
            <div data-slides_count="<?php echo $show_slides_count; ?>" class="slider-popup__slider js-slider-popup-1">
                <div class="swiper-wrapper">
                    <?php foreach ($slides as $key => $slide) {
                        echo '<div class="slider-popup__slide swiper-slide js-open-popup-activator"
                        style="background-color: ' . $blocks_color . '"
                        >';

                        echo '<a href="#slider-popup" data-slide-index="' . $key . '" class="js-open-slide-popup-link js-open-popup-activator"></a>';

                        echo '<div class="slider-popup__slide-title">
                                    ' . do_shortcode($slide['title']) .
                            '</div>';

                        if (isset($slide['image'])) {
                            echo '<figure class="slider-popup__slide-image">
                                        <img src="' . $slide['image'] . '" alt="image">
                                        <span>' . __('EXPLORE', 'wp-rock') . '</span>
                                    </figure>';
                        }

                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>


<?php if ($slides) : ?>
    <div id="slider-popup" class="popup popup__slider-popup js-popup-close">
        <div class="popup__wrapper-inner popup__slider-popup-inner" style="background-color: <?php echo $bg_color; ?>">
            <div class="custom-container popup__container-inner">
                <button class="popup__slider-popup-close js-popup-close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <g clip-path="url(#clip0_412_1882)">
                            <path d="M23 1H1V23H23V1Z" stroke="#F3F0EC" stroke-width="0.57" stroke-miterlimit="10" />
                            <path d="M4.81604 4.82324L19.5467 19.5539" stroke="#F3F0EC" stroke-width="0.57" stroke-miterlimit="10" />
                            <path d="M19.5467 4.82324L4.81604 19.5539" stroke="#F3F0EC" stroke-width="0.57" stroke-miterlimit="10" />
                        </g>
                        <defs>
                            <clipPath id="clip0_412_1882">
                                <rect width="24" height="24" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </button>
                <div class="popup__slider-button prev js-prev-slider-popup">
                    <svg xmlns="http://www.w3.org/2000/svg" width="52" height="53" viewBox="0 0 52 53" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.19014 45.253C11.8724 48.6282 17.6091 50.108 26 50.108C34.3909 50.108 40.1276 48.6282 43.8099 45.253C47.4465 41.9197 49.608 36.2383 49.608 26.5C49.608 16.7617 47.4465 11.0803 43.8099 7.74696C40.1276 4.37176 34.3909 2.892 26 2.892C17.6091 2.892 11.8724 4.37176 8.19014 7.74696C4.55352 11.0803 2.392 16.7617 2.392 26.5C2.392 36.2383 4.55352 41.9197 8.19014 45.253ZM0 26.5C0 46.5436 8.86364 52.5 26 52.5C43.1364 52.5 52 46.5436 52 26.5C52 6.45636 43.1364 0.5 26 0.5C8.86364 0.5 0 6.45636 0 26.5Z" fill="#CC7510" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M24.1331 42.1077V42.1157C24.2178 42.1157 24.3024 42.113 24.387 42.1077C25.1421 42.0596 25.8865 41.797 26.5251 41.3233C26.6798 41.2084 26.8284 41.0812 26.9694 40.9416C28.5373 39.3737 28.5373 36.8449 26.9694 35.2691L22.2106 30.5103H40.6549C42.8767 30.5103 44.6651 28.7215 44.6651 26.4997C44.6651 24.2779 42.8767 22.4895 40.6549 22.4895H22.2106L26.9694 17.7307C28.5373 16.1629 28.5373 13.6261 26.9694 12.0582C25.4015 10.4904 22.8724 10.4904 21.2966 12.0582L7.68214 25.6726C7.22517 26.1296 7.22517 26.8622 7.68214 27.3192L21.2966 40.9339C22.0845 41.7218 23.1088 42.1077 24.1331 42.1077ZM22.9854 13.7523C22.9848 13.7528 22.9843 13.7533 22.9838 13.7539L10.2417 26.4959L22.988 39.2425C22.988 39.2425 22.988 39.2425 22.988 39.2425C23.3061 39.5606 23.7126 39.7157 24.1331 39.7157H24.2941C24.6477 39.6801 24.9967 39.5267 25.2822 39.246C25.9089 38.6149 25.9141 37.6017 25.2756 36.9581C25.275 36.9575 25.2744 36.9569 25.2738 36.9563L16.4358 28.1183H40.6549C41.5554 28.1183 42.2731 27.4007 42.2731 26.4997C42.2731 25.5991 41.5557 24.8815 40.6549 24.8815H16.4358L25.278 16.0393C25.9117 15.4056 25.9117 14.3834 25.278 13.7496C24.6471 13.1187 23.6304 13.1122 22.9854 13.7523Z" fill="#CC7510" />
                    </svg>
                </div>
                <div class="popup__slider js-slider-popup-2">
                    <div class="swiper-wrapper">
                        <?php foreach ($slides as $slide) {
                            echo '<div class="popup__slide swiper-slide js-ope-popup-activator">

                                        <div class="popup__slide-description">
                                            ' . do_shortcode($slide['content']) .
                                '</div>';

                            if (isset($slide['link']['url']) && isset($slide['link']['title'])) {
                                echo '<a href="' . $slide['link']['url'] . '" class="popup__slide-link primary-btn white-text-hover">
                                        ' . $slide['link']['title'] . '
                                    </a>';
                            }

                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="popup__slider-button next js-next-slider-popup">
                    <svg xmlns="http://www.w3.org/2000/svg" width="52" height="53" viewBox="0 0 52 53" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M43.8099 7.74696C40.1276 4.37177 34.3909 2.892 26 2.892C17.6091 2.892 11.8724 4.37177 8.19014 7.74696C4.55352 11.0803 2.392 16.7617 2.392 26.5C2.392 36.2383 4.55352 41.9197 8.19014 45.253C11.8724 48.6282 17.6091 50.108 26 50.108C34.3909 50.108 40.1276 48.6282 43.8099 45.253C47.4465 41.9197 49.608 36.2383 49.608 26.5C49.608 16.7617 47.4465 11.0803 43.8099 7.74696ZM52 26.5C52 6.45636 43.1364 0.5 26 0.5C8.86364 0.5 0 6.45636 0 26.5C0 46.5436 8.86364 52.5 26 52.5C43.1364 52.5 52 46.5436 52 26.5Z" fill="#CC7510" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M27.8669 10.8923V10.8843C27.7822 10.8843 27.6975 10.887 27.613 10.8923C26.8579 10.9404 26.1135 11.203 25.4749 11.6767C25.3202 11.7916 25.1716 11.9188 25.0306 12.0584C23.4627 13.6263 23.4627 16.1551 25.0306 17.7309L29.7894 22.4897H11.3451C9.12331 22.4897 7.33486 24.2785 7.33486 26.5003C7.33486 28.7221 9.12331 30.5105 11.3451 30.5105L29.7894 30.5105L25.0306 35.2693C23.4627 36.8371 23.4627 39.3739 25.0306 40.9418C26.5985 42.5096 29.1276 42.5096 30.7034 40.9418L44.3178 27.3274C44.7748 26.8704 44.7748 26.1378 44.3178 25.6808L30.7034 12.0661C29.9155 11.2782 28.8912 10.8923 27.8669 10.8923ZM29.0146 39.2477C29.0151 39.2472 29.0157 39.2467 29.0162 39.2461L41.7583 26.5041L29.012 13.7575C29.012 13.7575 29.012 13.7575 29.012 13.7575C28.6939 13.4394 28.2874 13.2843 27.8669 13.2843H27.7059C27.3523 13.3199 27.0033 13.4733 26.7178 13.754C26.0911 14.3851 26.0859 15.3983 26.7244 16.0419C26.725 16.0425 26.7256 16.0431 26.7262 16.0437L35.5642 24.8817L11.3451 24.8817C10.4446 24.8817 9.72686 25.5993 9.72686 26.5003C9.72686 27.4009 10.4443 28.1185 11.3451 28.1185L35.5642 28.1185L26.722 36.9607C26.0882 37.5944 26.0882 38.6166 26.722 39.2504C27.3529 39.8813 28.3696 39.8878 29.0146 39.2477Z" fill="#CC7510" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<script>
    (function() {

        let wrapper = document.getElementById('wrapper');
        let popups = document.querySelectorAll('#slider-popup');

        popups.forEach(function(popup) {
            wrapper.insertAdjacentElement('afterend', popup);
        });
    })();
</script>
