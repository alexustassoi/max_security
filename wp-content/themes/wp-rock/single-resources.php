<?php
/**
 * General template for single resources post
 *
 * @package WP-rock
 * @since 4.4.0
 */

get_header();

do_action( 'wp_rock_before_page_content' );
?>
    <div class="custom-container single-blog">
        <div class="single-blog__content-wrap">
            <?php
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    $post_id        = get_the_ID();
                    $post_fields    = get_fields($post_id);
                    $hero_text      = get_field_value($post_fields, 'hero_text');
                    $post_content   = get_field_value($post_fields, 'post_content');
                    $custom_date    = get_field_value($post_fields, 'custom_date');
                    $read_more_text = get_field_value($post_fields, 'read_more_text');
                    $type_of_banner = get_field_value($post_fields, 'type_of_banner_image');

                    $resource_category      = @wp_get_post_terms( $post_id, 'resources-category')[0];
                    $category_name_for_post = @get_term_meta( $resource_category->term_id, 'category_name_for_post', true );

                    $card_tag        = @wp_get_post_terms( $post_id, 'resource_tag' )[0];
                    $card_icon_url   = @get_field('card_icon', 'resource_tag_' . $card_tag->term_id);
                    $card_tag_name   = @$card_tag->name;
                    $thumbnail_image = get_the_post_thumbnail( $post_id );
                    $post_title      = get_the_title();

                    $webinar_video_settings = get_field_value($post_fields, 'webinar_video_settings');
                    $is_embed_code          = get_field_value($webinar_video_settings, 'is_embed_code');
                    $embed_code             = get_field_value($webinar_video_settings, 'embed_code');
                    $webinar_video_file     = get_field_value($webinar_video_settings, 'webinar_video_file');
                    $content_before_video   = get_field_value($webinar_video_settings, 'content_before_video');

                    ?>
                    <div class="single-blog__header">
                        <h1 class="single-blog__post-category">
                            <?php
                            echo ($category_name_for_post)
                                ? do_shortcode($category_name_for_post)
                                : '';
                            ?>
                        </h1>
                        <?php
                        echo ($custom_date)
                            ? '<h3 class="single-blog__custom-date">' . do_shortcode($custom_date) . '</h3>'
                            : '';
                        ?>
                    </div>
                    <div class="single-blog__hero">
                        <div class="single-blog__hero-top">
                            <?php
                            echo ( $card_icon_url )
                                ? '<figure class="single-blog__tag-icon-wrap"><img width="40" height="40" src="' . esc_html($card_icon_url) . '" alt="Icon" /></figure>'
                                : '';

                            echo ( $card_tag_name )
                                ? '<p class="single-blog__tag-name">' . do_shortcode($card_tag_name) . '</p>'
                                : '';
                            ?>
                        </div>
                        <div class="single-blog__hero-content-wrap hero-type-<?php echo $type_of_banner; ?>">
                            <?php
                            echo ($thumbnail_image && 'webinar' !== mb_strtolower($category_name_for_post))
                                ? '<figure class="single-blog__post-img-wrap hero-content-part">' . do_shortcode($thumbnail_image) . '</figure>'
                                : '';
                            ?>
                            <div class="single-blog__hero-content hero-content-part">
                                <?php
                                echo ($post_title && 'webinar' !== mb_strtolower($category_name_for_post))
                                    ? '<h5 class="single-blog__post-title">' . do_shortcode($post_title) . '</h5>'
                                    : '';

                                echo ($hero_text)
                                    ? '<div class="single-blog__post-hero-text">' . do_shortcode($hero_text) . '</div>'
                                    : '';
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    echo ($post_content)
                        ? '<div class="single-blog__post-text">' . do_shortcode($post_content) . '</div>'
                        : '';

                    if (
                        $webinar_video_settings &&
                        ( $is_embed_code && $embed_code ) ||
                        ( !$is_embed_code && $webinar_video_file )
                    ) { ?>
                        <div class="single-blog__webinar-box">
                            <div class="single-blog__webinar-box-content">
                                <?php
                                echo ($content_before_video) ? do_shortcode($content_before_video) : '';
                                ?>
                            </div>

                            <div class="single-blog__webinar-box-video-wrapper">
                                <?php
                                if ( $is_embed_code && $embed_code ) {
                                    echo $embed_code;
                                }
                                if ( !$is_embed_code && $webinar_video_file ) {
                                    echo '<video src="'.$webinar_video_file.'" controls></video>';
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }

                }
                wp_reset_postdata();
            }
            ?>
        </div>

        <div class="single-blog__read-more-wrap">
            <?php
            echo ( $read_more_text )
                ? '<h5 class="single-blog__read-more-title">' . esc_html($read_more_text) . '</h5>'
                : '';
            ?>
            <div class="single-blog__read-more-slider-wrapper">
                <div class="swiper single-blog__read-more-slider js-blog-read-more-slider">
                    <div class="swiper-wrapper">
                        <?php
                        $args = array(
                            'post_type'      => 'resources',
                            'post_status'    => 'publish',
                            'post__not_in'   => array( $post_id ),
                            'posts_per_page' => -1
                        );
                        $target_category = $resource_category->slug;

                        if ( $target_category ) {
                            $args['tax_query'] = array(
                                array(
                                    'taxonomy' => 'resources-category',
                                    'field'    => 'slug',
                                    'terms'    => $target_category,
                                ),
                            );
                        }

                        $template_settings = [
                            'args' => $args,
                            'is_slider' => true
                        ];

                        include( locate_template( 'template-blower-topic-posts.php', false, false, $template_settings ) );
                        ?>
                    </div>
                </div>

                <div class="single-blog__read-more-btn prev js-prev-read-more">
                    <svg xmlns="http://www.w3.org/2000/svg" width="52" height="53" viewBox="0 0 52 53" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M8.19014 45.253C11.8724 48.6282 17.6091 50.108 26 50.108C34.3909 50.108 40.1276 48.6282 43.8099 45.253C47.4465 41.9197 49.608 36.2383 49.608 26.5C49.608 16.7617 47.4465 11.0803 43.8099 7.74696C40.1276 4.37176 34.3909 2.892 26 2.892C17.6091 2.892 11.8724 4.37176 8.19014 7.74696C4.55352 11.0803 2.392 16.7617 2.392 26.5C2.392 36.2383 4.55352 41.9197 8.19014 45.253ZM0 26.5C0 46.5436 8.86364 52.5 26 52.5C43.1364 52.5 52 46.5436 52 26.5C52 6.45636 43.1364 0.5 26 0.5C8.86364 0.5 0 6.45636 0 26.5Z"
                              fill="#CC7510"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M24.1331 42.1077V42.1157C24.2178 42.1157 24.3024 42.113 24.387 42.1077C25.1421 42.0596 25.8865 41.797 26.5251 41.3233C26.6798 41.2084 26.8284 41.0812 26.9694 40.9416C28.5373 39.3737 28.5373 36.8449 26.9694 35.2691L22.2106 30.5103H40.6549C42.8767 30.5103 44.6651 28.7215 44.6651 26.4997C44.6651 24.2779 42.8767 22.4895 40.6549 22.4895H22.2106L26.9694 17.7307C28.5373 16.1629 28.5373 13.6261 26.9694 12.0582C25.4015 10.4904 22.8724 10.4904 21.2966 12.0582L7.68214 25.6726C7.22517 26.1296 7.22517 26.8622 7.68214 27.3192L21.2966 40.9339C22.0845 41.7218 23.1088 42.1077 24.1331 42.1077ZM22.9854 13.7523C22.9848 13.7528 22.9843 13.7533 22.9838 13.7539L10.2417 26.4959L22.988 39.2425C22.988 39.2425 22.988 39.2425 22.988 39.2425C23.3061 39.5606 23.7126 39.7157 24.1331 39.7157H24.2941C24.6477 39.6801 24.9967 39.5267 25.2822 39.246C25.9089 38.6149 25.9141 37.6017 25.2756 36.9581C25.275 36.9575 25.2744 36.9569 25.2738 36.9563L16.4358 28.1183H40.6549C41.5554 28.1183 42.2731 27.4007 42.2731 26.4997C42.2731 25.5991 41.5557 24.8815 40.6549 24.8815H16.4358L25.278 16.0393C25.9117 15.4056 25.9117 14.3834 25.278 13.7496C24.6471 13.1187 23.6304 13.1122 22.9854 13.7523Z"
                              fill="#CC7510"/>
                    </svg>
                </div>

                <div class="single-blog__read-more-btn next js-next-read-more">
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
<?php do_action( 'wp_rock_after_page_content' ); ?>
<?php
get_footer();
