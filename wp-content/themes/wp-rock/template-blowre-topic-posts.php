<?php
/**
 * Template "Browse topic Posts".
 *
 * @package WordPress
 */

$query = new WP_Query( $args );
$count_posts = $query->found_posts;

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        $post_id = get_the_ID();
        $card_btn_text = get_field('card_btn_text', $post_id);
        $card_custom_date = get_field('custom_date', $post_id);
        $person_name = get_field('person_name', $post_id);
        $person_status = get_field('person_status', $post_id);
        $webinar_duration = get_field('webinar_duration', $post_id);
        $resource_category = wp_get_post_terms( $post_id, 'resources-category')[0];
        $category_name_for_post = get_term_meta( $resource_category->term_id, 'category_name_for_post', true );
        $card_tag = wp_get_post_terms( $post_id, 'resource_tag' )[0];
        $card_icon_url = get_field('card_icon', 'resource_tag_' . $card_tag->term_id);
        $card_tag_name = $card_tag->name;
        $thumbnail_image = get_the_post_thumbnail( $post_id );
        $post_title = get_the_title();

        ?>
        <div class="browse-topic__card <?php echo ($card_tag->slug) ?: ''; echo ' ' .($resource_category->slug ?: '')  ?>">
            <div class="browse-topic__card-top">
                <div class="browse-topic__card-tags">
                    <?php
                    echo ( $card_icon_url )
                        ? '<figure class="browse-topic__card-icon-wrap"><img width="40" height="40" src="' . esc_html($card_icon_url) . '" alt="Icon" /></figure>'
                        : '';

                    echo ( $card_tag_name )
                        ? '<p class="browse-topic__card-tag-name">' . do_shortcode($card_tag_name) . '</p>'
                        : '';
                    ?>
                </div>
                <div class="browse-topic__card-category">
                    <?php
                    echo ($category_name_for_post)
                        ? do_shortcode($category_name_for_post)
                        : '';
                    ?>
                </div>
            </div>
            <div class="browse-topic__card-content">
                <?php
                echo ($thumbnail_image)
                    ? '<figure class="browse-topic__card-img-wrap">' . do_shortcode($thumbnail_image) . '</figure>'
                    : '';

                echo ($post_title)
                    ? '<div class="browse-topic__card-title">' . do_shortcode($post_title) . '</div>'
                    : '';

                echo ($card_custom_date)
                    ? '<div class="browse-topic__card-custom-date">' . do_shortcode($card_custom_date) . '</div>'
                    : '';

                echo '<div class="browse-topic__card-text ' . (($webinar_duration) ? 'is-webinar-duration' : '') . '">' . do_shortcode(get_the_content()) . '</div>';

                echo ($webinar_duration)
                    ? '<div class="browse-topic__card-webinar-duration">' . do_shortcode($webinar_duration) . '</div>'
                    : '';

                echo ($card_btn_text)
                    ? '<div class="browse-topic__card-btn-wrap"><a href="' . esc_html(get_permalink()) . '" class="browse-topic__card-btn">' . do_shortcode($card_btn_text) . '</a></div>'
                    : '';

                echo ($person_name)
                    ? '<div class="browse-topic__card-author">' . do_shortcode($person_name) . '</div>'
                    : '';

                echo ($person_status)
                    ? '<div class="browse-topic__card-author-status">' . do_shortcode($person_status) . '</div>'
                    : '';
                ?>
            </div>
        </div>
        <?php
    }
    wp_reset_postdata();
}


