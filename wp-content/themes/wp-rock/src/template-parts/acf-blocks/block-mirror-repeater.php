<?php

/**
 * Block - Mirror repeater.
 *
 * @package WP-rock
 * @since   4.4.0
 */
$fields          = get_fields();
$colors_select   = get_field_value($fields, 'colors_select');
$top_description = get_field_value($fields, 'top_description');
$mirror_items    = get_field_value($fields, 'mirror_items');

$colors_select      = !empty($colors_select) ? $colors_select : '#7E97A6';
$slider_courses_ids = array();
$posts_per_page = get_option('posts_per_page');

$args = array(
    'post_type' => 'courses',
    'post_status' => 'publish',
    'posts_per_page' => $posts_per_page,
);

$query = new WP_Query($args);
$total_posts = $query->found_posts;

?>
<div class="mirror-repeater" style="background-color: <?php echo $colors_select; ?>;">
    <div class="custom-container mirror-repeater__custom-container">
        <?php
        if (!empty($top_description)) {
            echo '<p class="mirror-repeater__top-description">
                    ' . do_shortcode($top_description) .
                '</p>';
        }
        ?>
        <?php
        $courses_query = [
            'query' => $query,
            'mirror_items' => $mirror_items,
            'last_key' => 0
        ];

        if ($query->have_posts()) : ?>
            <div class="mirror-repeater__container js-mirror-repeater">
                <?php
                include( locate_template( '/template-courses-item.php', false, false, $courses_query) );
                ?>
            </div>
            <button class="mirror-repeater__load-more js-load-more-courses <?php echo ( $total_posts <= $posts_per_page ) ? 'hide' : ''; ?>" data-role="load-more-courses" data-offset="<?php echo $posts_per_page; ?>" data-post-counts="<?php echo $total_posts; ?>" data-last-key="0">
                <span><?php _e("LOAD MORE", "wp-rock") ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="31" viewBox="0 0 30 31" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M20.3532 15.9582L20.3491 15.9623L16.0036 20.3078V8.30997C16.0036 7.8328 15.6271 7.45629 15.15 7.45629C14.6729 7.45629 14.2964 7.83283 14.2964 8.30997V20.3078L9.95093 15.9623C9.60893 15.6203 9.0781 15.6262 8.74942 15.9582L8.74535 15.9623C8.40335 16.3043 8.40925 16.8352 8.74125 17.1639L8.74535 17.1679L15.15 23.5727L21.5547 17.1679L22.3678 17.9811L15.5602 24.7889C15.3393 25.0176 14.9686 25.0176 14.7398 24.7889L7.93217 17.9811C7.14334 17.2002 7.14334 15.9379 7.93217 15.1491C8.71312 14.3603 9.97527 14.3603 10.7641 15.1491L13.1464 17.5314V8.30997C13.1464 7.19771 14.0378 6.30629 15.15 6.30629C16.2623 6.30629 17.1536 7.19771 17.1536 8.30997V17.5314L19.5359 15.1491C20.3169 14.3603 21.579 14.3603 22.3678 15.1491C22.7602 15.5415 22.9574 16.051 22.9594 16.5612C22.9594 16.5638 22.9594 16.5664 22.9594 16.5691V16.5612C22.9594 16.5638 22.9594 16.5664 22.9594 16.5691C22.9574 17.0792 22.7602 17.5887 22.3678 17.9811L21.5547 17.1679C21.7263 16.9963 21.8085 16.7802 21.8094 16.5651C21.8085 16.35 21.7263 16.1339 21.5547 15.9623C21.2127 15.6203 20.6819 15.6262 20.3532 15.9582ZM26.2545 26.1279C23.939 28.6537 20.2957 29.7883 15.15 29.7883C10.0044 29.7883 6.36099 28.6537 4.04549 26.1279C1.75006 23.624 1 20.0072 1 15.6383C1 11.2693 1.75006 7.65252 4.04549 5.14863C6.36099 2.62284 10.0044 1.48828 15.15 1.48828C20.2957 1.48828 23.939 2.62284 26.2545 5.14863C28.55 7.65252 29.3 11.2693 29.3 15.6383C29.3 20.0072 28.55 23.624 26.2545 26.1279ZM15.15 28.6383C25.1682 28.6383 28.15 24.205 28.15 15.6383C28.15 7.07152 25.1682 2.63828 15.15 2.63828C5.13183 2.63828 2.15 7.07152 2.15 15.6383C2.15 24.205 5.13183 28.6383 15.15 28.6383Z"
                          fill="#F3F0EC"/>
                </svg>
            </button>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</div>


<?php if (!empty($slider_courses_ids)) { ?>
    <div id="connected-course-popup" class="popup course-popup js-popup-close">

        <div class="course-popup__wrapper-inner">
            <div class="custom-container course-popup__container-inner">
                <div class="course-popup__header-area">
                    <div class="course-popup__header">
                        <svg width="47" height="47" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23.5703 24.5553H25.528L24.5453 22.2148L23.5703 24.5553Z" fill="#231F20"/>
                            <path
                                d="M30.6949 19.5057H33.5818L35.074 21.486L43.6076 10.1815C40.6306 4.10551 34.5266 1 23.4961 1C6.1516 1 1 8.67378 1 23.5038C1 36.2559 4.8093 43.7197 16.9047 45.5575L33.6268 23.3988L30.6949 19.5132V19.5057ZM17.7296 27.4945H15.3151V23.3763L12.8555 26.7368L10.3959 23.3763V27.4945H7.98132V19.4757H10.0958L12.8555 23.2488L15.6149 19.4757H17.7296V27.4945ZM26.7729 27.5245L26.3231 26.4444H22.7762L22.3262 27.5245H19.7242L23.4435 19.5057H25.6706L29.3901 27.5245H26.7879H26.7729Z"
                                fill="#231F20"/>
                            <path
                                d="M44.1479 11.3906L38.0289 19.4995H39.6337L36.6117 23.5051L39.6412 27.5183H36.7541L35.1645 25.4104L33.5747 27.5183H31.9701L18.2324 45.7239C19.8446 45.9114 21.5994 46.0013 23.504 46.0013C40.8485 46.0013 46.0001 38.3275 46.0001 23.4976C46.0001 18.7118 45.4602 14.6687 44.1554 11.3906H44.1479Z"
                                fill="#231F20"/>
                        </svg>
                        <span class="line"></span>
                        <span class="name"><?php _e('MAX ACADEMY', 'wp-rock'); ?></span>
                    </div>

                    <button class="course-popup__close js-popup-close">
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23 1.5H1V23.5H23V1.5Z" stroke="#1D1D1B" stroke-width="0.57"
                                  stroke-miterlimit="10"/>
                            <path d="M4.81592 5.32422L19.5466 20.0549" stroke="#1D1D1B" stroke-width="0.57"
                                  stroke-miterlimit="10"/>
                            <path d="M19.5466 5.32422L4.81592 20.0549" stroke="#1D1D1B" stroke-width="0.57"
                                  stroke-miterlimit="10"/>
                        </svg>
                    </button>
                </div>

                <div class="course-popup__slider-button prev js-prev-course-slider-popup">
                    <svg xmlns="http://www.w3.org/2000/svg" width="52" height="53" viewBox="0 0 52 53" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M8.19014 45.253C11.8724 48.6282 17.6091 50.108 26 50.108C34.3909 50.108 40.1276 48.6282 43.8099 45.253C47.4465 41.9197 49.608 36.2383 49.608 26.5C49.608 16.7617 47.4465 11.0803 43.8099 7.74696C40.1276 4.37176 34.3909 2.892 26 2.892C17.6091 2.892 11.8724 4.37176 8.19014 7.74696C4.55352 11.0803 2.392 16.7617 2.392 26.5C2.392 36.2383 4.55352 41.9197 8.19014 45.253ZM0 26.5C0 46.5436 8.86364 52.5 26 52.5C43.1364 52.5 52 46.5436 52 26.5C52 6.45636 43.1364 0.5 26 0.5C8.86364 0.5 0 6.45636 0 26.5Z"
                              fill="#CC7510"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M24.1331 42.1077V42.1157C24.2178 42.1157 24.3024 42.113 24.387 42.1077C25.1421 42.0596 25.8865 41.797 26.5251 41.3233C26.6798 41.2084 26.8284 41.0812 26.9694 40.9416C28.5373 39.3737 28.5373 36.8449 26.9694 35.2691L22.2106 30.5103H40.6549C42.8767 30.5103 44.6651 28.7215 44.6651 26.4997C44.6651 24.2779 42.8767 22.4895 40.6549 22.4895H22.2106L26.9694 17.7307C28.5373 16.1629 28.5373 13.6261 26.9694 12.0582C25.4015 10.4904 22.8724 10.4904 21.2966 12.0582L7.68214 25.6726C7.22517 26.1296 7.22517 26.8622 7.68214 27.3192L21.2966 40.9339C22.0845 41.7218 23.1088 42.1077 24.1331 42.1077ZM22.9854 13.7523C22.9848 13.7528 22.9843 13.7533 22.9838 13.7539L10.2417 26.4959L22.988 39.2425C22.988 39.2425 22.988 39.2425 22.988 39.2425C23.3061 39.5606 23.7126 39.7157 24.1331 39.7157H24.2941C24.6477 39.6801 24.9967 39.5267 25.2822 39.246C25.9089 38.6149 25.9141 37.6017 25.2756 36.9581C25.275 36.9575 25.2744 36.9569 25.2738 36.9563L16.4358 28.1183H40.6549C41.5554 28.1183 42.2731 27.4007 42.2731 26.4997C42.2731 25.5991 41.5557 24.8815 40.6549 24.8815H16.4358L25.278 16.0393C25.9117 15.4056 25.9117 14.3834 25.278 13.7496C24.6471 13.1187 23.6304 13.1122 22.9854 13.7523Z"
                              fill="#CC7510"/>
                    </svg>
                </div>

                <div class="course-popup__inner js-popup__ccs"
                     data-slides_count="<?php echo count($slider_courses_ids); ?>">
                    <div class="swiper-wrapper course-popup__swiper-wrapper">
                        <?php
                        foreach ($slider_courses_ids as $connected_course_id) {

                            if (!$connected_course_id) continue;

                            $fields = get_field('modal_window_content', $connected_course_id);

                            $title                 = get_field_value($fields, 'title');
                            $description           = get_field_value($fields, 'description');
                            $target_audience_title = get_field_value($fields, 'target_audience_title');
                            $lets_talk_btn         = get_field_value($fields, 'lets_talk_btn');

                            $permalink             = get_the_permalink($connected_course_id);
                            $target_audience_items = get_field_value($fields, 'target_audience_items');

                            // convert {{☑}} to <span class="icon">☑</span>
                            $target_audience_items = preg_replace('/{{(.*?)}}/', '<span class="icon">$1</span>', $target_audience_items);

                            $curiculum_title               = get_field_value($fields, 'curiculum_title');
                            $curiculum_items               = get_field_value($fields, 'curiculum_items:');
                            $certifcate_of_completion_text = get_field_value($fields, 'certifcate_of_completion_text');
                            ?>
                            <div class="course-popup__slide swiper-slide">

                                <?php
                                echo $title ? '<div class="course-popup__slide-title">' . do_shortcode($title) . '</div>' : '';
                                echo $description ? '<div class="course-popup__slide-description">' . do_shortcode($description) . '</div>' : '';
                                ?>

                                <div class="course-popup__cases-area">
                                    <?php if ($target_audience_items) { ?>
                                        <div class="course-popup__target-audience-items-area">
                                            <?php
                                            echo $target_audience_title
                                                ? '<div class="course-popup__target-audience-title">' . do_shortcode($target_audience_title) . '</div>'
                                                : '';
                                            echo $target_audience_items
                                                ? '<div class="course-popup__target-audience-items">' . do_shortcode($target_audience_items) . '</div>'
                                                : '';
                                            ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($curiculum_items) { ?>
                                        <div class="course-popup__curiculum-items-area">
                                            <?php
                                            echo $curiculum_title
                                                ? '<div class="course-popup__curiculum-title">' . do_shortcode($curiculum_title) . '</div>'
                                                : '';
                                            echo $curiculum_items
                                                ? '<div class="course-popup__curiculum-content">' . do_shortcode($curiculum_items) . '</div>'
                                                : '';
                                            ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php
                                if (!empty($certifcate_of_completion_text)) {
                                    echo '  <p class="course-popup__certifcate-of-completion">
                                                        ' . esc_html($certifcate_of_completion_text) . '
                                                    </p>';
                                }

                                echo $lets_talk_btn
                                    ? '<a href="' . do_shortcode( $lets_talk_btn["url"] ) . '" class="course-popup__curiculum-items-link">' . do_shortcode( $lets_talk_btn["title"] ) . '</a>'
                                    : '';
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="course-popup__slider-button next js-next-course-slider-popup">
                    <svg xmlns="http://www.w3.org/2000/svg" width="52" height="53" viewBox="0 0 52 53" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M43.8099 7.74696C40.1276 4.37177 34.3909 2.892 26 2.892C17.6091 2.892 11.8724 4.37177 8.19014 7.74696C4.55352 11.0803 2.392 16.7617 2.392 26.5C2.392 36.2383 4.55352 41.9197 8.19014 45.253C11.8724 48.6282 17.6091 50.108 26 50.108C34.3909 50.108 40.1276 48.6282 43.8099 45.253C47.4465 41.9197 49.608 36.2383 49.608 26.5C49.608 16.7617 47.4465 11.0803 43.8099 7.74696ZM52 26.5C52 6.45636 43.1364 0.5 26 0.5C8.86364 0.5 0 6.45636 0 26.5C0 46.5436 8.86364 52.5 26 52.5C43.1364 52.5 52 46.5436 52 26.5Z"
                              fill="#CC7510"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M27.8669 10.8923V10.8843C27.7822 10.8843 27.6975 10.887 27.613 10.8923C26.8579 10.9404 26.1135 11.203 25.4749 11.6767C25.3202 11.7916 25.1716 11.9188 25.0306 12.0584C23.4627 13.6263 23.4627 16.1551 25.0306 17.7309L29.7894 22.4897H11.3451C9.12331 22.4897 7.33486 24.2785 7.33486 26.5003C7.33486 28.7221 9.12331 30.5105 11.3451 30.5105L29.7894 30.5105L25.0306 35.2693C23.4627 36.8371 23.4627 39.3739 25.0306 40.9418C26.5985 42.5096 29.1276 42.5096 30.7034 40.9418L44.3178 27.3274C44.7748 26.8704 44.7748 26.1378 44.3178 25.6808L30.7034 12.0661C29.9155 11.2782 28.8912 10.8923 27.8669 10.8923ZM29.0146 39.2477C29.0151 39.2472 29.0157 39.2467 29.0162 39.2461L41.7583 26.5041L29.012 13.7575C29.012 13.7575 29.012 13.7575 29.012 13.7575C28.6939 13.4394 28.2874 13.2843 27.8669 13.2843H27.7059C27.3523 13.3199 27.0033 13.4733 26.7178 13.754C26.0911 14.3851 26.0859 15.3983 26.7244 16.0419C26.725 16.0425 26.7256 16.0431 26.7262 16.0437L35.5642 24.8817L11.3451 24.8817C10.4446 24.8817 9.72686 25.5993 9.72686 26.5003C9.72686 27.4009 10.4443 28.1185 11.3451 28.1185L35.5642 28.1185L26.722 36.9607C26.0882 37.5944 26.0882 38.6166 26.722 39.2504C27.3529 39.8813 28.3696 39.8878 29.0146 39.2477Z"
                              fill="#CC7510"/>
                    </svg>
                </div>
            </div>
        </div>

    </div>
<?php } ?>


<script>
    (function () {

        let wrapper = document.getElementById('wrapper');
        let popups = document.querySelectorAll('#connected-course-popup');

        popups.forEach(function (popup) {
            wrapper.insertAdjacentElement('afterend', popup);
        });
    })();
</script>
