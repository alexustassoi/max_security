<?php
/**
 * Block - FAQ.
 *
 * @package WP-rock
 * @since   4.4.0
 */

global $global_options;

$class_name        = isset($args['className']) ? ' ' . $args['className'] : '';
$main_tags_colours = get_field_value($global_options, 'main_tags_colours');
$fields            = get_fields();
$tag_term_id       = get_field_value($fields, 'select_tag');
$faq_title         = get_field_value($fields, 'faq_title');
$faq_repeater      = get_field_value($fields, 'faq_repeater');
$tag_term_color    = '';
$tag_term_faq_item_color    = '';

if (is_array($main_tags_colours) && !empty($main_tags_colours)) :
    foreach ($main_tags_colours as $item):
        $option_tag_id = get_field_value($item, 'title');

        if ($option_tag_id === $tag_term_id) :
            $tag_term_color = get_field_value($item, 'tag_term_color');
            $tag_term_faq_item_color = get_field_value($item, 'tag_term_faq_item_color');
        endif; ?>
    <?php endforeach;
endif;
?>

<div class="faq <?php echo esc_html($class_name); ?>" id="<?php echo $args['id']; ?>">
    <div class="faq__inner">
        <div class="custom-container">
            <div class="faq__top" style="background-color: <?php echo do_shortcode($tag_term_color); ?>">
                <?php
                if ($tag_term_id) :
                    $tag = get_term($tag_term_id);
                    $tag_icon_url = get_field('card_icon', 'resource_tag_' . $tag_term_id);
                    ?>
                    <figure class="faq__tag-icon-wrap">
                        <img width="48" height="48" src="<?php echo esc_html($tag_icon_url); ?>" alt="Icon"/>
                    </figure>
                <?php endif;

                echo $faq_title
                    ? '<h5 class="faq__title">' . do_shortcode($faq_title) . '</h5>'
                    : '';
                ?>
            </div>
            <div class="faq__content">
                <?php
                if ($faq_repeater): ?>
                    <div class="faq__items">
                        <?php
                        foreach ($faq_repeater as $faq_item):
                            $title = get_field_value($faq_item, 'title');
                            $text = get_field_value($faq_item, 'text');
                            ?>
                            <div class="faq__item js-faq-item">
                                <?php
                                if ($title) : ?>
                                    <div class="faq__item-title-wrap js-faq-title-wrap" data-role="handle-faq-item" style="background-color: <?php echo $tag_term_faq_item_color ? do_shortcode($tag_term_faq_item_color) : 'none'; ?>">
                                        <svg class="faq__item-arrow default" width="48" height="48" viewBox="0 0 48 48"  xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_854_12280)">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M40.4399 6.6895C37.0409 3.57394 31.7454 2.208 24 2.208C16.2546 2.208 10.9591 3.57394 7.56013 6.6895C4.20325 9.76646 2.208 15.0108 2.208 24C2.208 32.9892 4.20325 38.2335 7.56013 41.3105C10.9591 44.4261 16.2546 45.792 24 45.792C31.7454 45.792 37.0409 44.4261 40.4399 41.3105C43.7968 38.2335 45.792 32.9892 45.792 24C45.792 15.0108 43.7968 9.76646 40.4399 6.6895ZM48 24C48 5.49818 39.8182 0 24 0C8.18182 0 0 5.49818 0 24C0 42.5018 8.18182 48 24 48C39.8182 48 48 42.5018 48 24Z" fill="#CC7510"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M25.7247 9.59288V9.58542C25.6466 9.58542 25.5684 9.58791 25.4903 9.59288C24.7934 9.63726 24.1062 9.87964 23.5167 10.3169C23.3739 10.4229 23.2367 10.5404 23.1066 10.6692C21.6593 12.1165 21.6593 14.4508 23.1066 15.9054L27.4993 20.2981L10.4738 20.2981C8.42294 20.2981 6.77206 21.9493 6.77206 24.0002C6.77206 26.0511 8.42294 27.7019 10.4738 27.7019L27.4993 27.7019L23.1066 32.0947C21.6593 33.5419 21.6593 35.8835 23.1066 37.3308C24.5538 38.7781 26.8884 38.7781 28.343 37.3308L40.9102 24.7637C41.332 24.3419 41.332 23.6656 40.9102 23.2438L28.343 10.6763C27.6157 9.94906 26.6702 9.59288 25.7247 9.59288ZM26.7841 35.7671C26.7846 35.7666 26.7851 35.7661 26.7856 35.7656L38.5476 24.0037L26.7817 12.2376C26.7817 12.2376 26.7817 12.2376 26.7817 12.2376C26.4881 11.944 26.1129 11.8009 25.7247 11.8009H25.5761C25.2497 11.8337 24.9275 11.9753 24.664 12.2344C24.0855 12.817 24.0807 13.7522 24.6701 14.3463C24.6707 14.3469 24.6712 14.3474 24.6718 14.348L32.8299 22.5061L10.4738 22.5061C9.64259 22.5061 8.98006 23.1685 8.98006 24.0002C8.98006 24.8316 9.64231 25.4939 10.4738 25.4939L32.8299 25.4939L24.6679 33.6559C24.0829 34.2409 24.0829 35.1845 24.6679 35.7695C25.2502 36.3519 26.1887 36.358 26.7841 35.7671Z" fill="#CC7510"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_854_12280">
                                                    <rect width="48" height="48" fill="white" transform="matrix(-1 0 0 -1 48 48)"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg class="faq__item-arrow active" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_854_12343)">
                                                <g clip-path="url(#clip1_854_12343)">
                                                    <path d="M47.192 24C47.192 39.2785 41.8763 47.1937 23.9983 47.1937C6.12034 47.1937 0.804688 39.2785 0.804688 24C0.804688 8.72152 6.12034 0.806396 23.9983 0.806396C41.8763 0.806396 47.192 8.71091 47.192 24ZM37.9294 25.6658C37.9294 24.7533 37.5792 23.8409 36.879 23.1406C35.4784 21.7401 33.2185 21.7401 31.8179 23.1406L27.5739 27.3846V10.9284C27.5739 8.94433 25.9824 7.35282 23.9983 7.35282C22.0142 7.35282 20.4227 8.94433 20.4227 10.9284V27.3846L16.1787 23.1406C14.7782 21.7401 12.5182 21.7401 11.1177 23.1406C9.71715 24.5411 9.71715 26.8011 11.1177 28.2016C15.5951 32.6791 19.1495 36.2335 23.2662 40.3502C23.6694 40.7533 24.3272 40.7533 24.741 40.3502L36.8896 28.2016C37.5898 27.5014 37.94 26.5889 37.94 25.6764L37.9294 25.6658Z" fill="#CC7510" stroke="#CC7510" stroke-width="1.52" stroke-miterlimit="10"/>
                                                </g>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_854_12343">
                                                    <rect width="48" height="48" fill="white" transform="matrix(0 -1 1 0 0 48)"/>
                                                </clipPath>
                                                <clipPath id="clip1_854_12343">
                                                    <rect width="48" height="48" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>

                                        <div class="faq__item-title">
                                            <?php echo do_shortcode($title); ?>
                                        </div>
                                    </div>
                                <?php
                                endif;

                                echo $text
                                    ? '<div class="faq__item-text">' . do_shortcode($text) . '</div>'
                                    : '';
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif;
                ?>
            </div>
        </div>
    </div>
</div>
