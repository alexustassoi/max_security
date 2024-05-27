<?php
/**
 * Template "Courses item".
 *
 * @package WordPress
 */

$query = isset($courses_query) ? get_field_value($courses_query, 'query') : null;
$key   = isset($courses_query) ? get_field_value($courses_query, 'last_key') : null;

if (!$query || !isset($key)) die();

while ($query->have_posts()) : $query->the_post();
    $post_id              = get_the_ID();
    $post_fields          = get_fields($post_id);
    $connected_course     = $post_id;
    $slider_courses_ids[] = $connected_course;
    $image                = get_the_post_thumbnail($post_id, 'full');
    $modal_window_content = get_field_value($post_fields, 'modal_window_content');
    $description          = isset($modal_window_content['description']) ? $modal_window_content['description'] : null;
    ?>
    <div class="mirror-repeater__item js-mirror-item">
        <?php
        if (!empty($image)) {
            echo '<figure class="mirror-repeater__item-image"><img src="' . $image . '" alt="image"></figure>';
        }
        ?>
        <div class="mirror-repeater__item-inner">
            <?php
            echo '<h4 class="mirror-repeater__item-title">' . do_shortcode(get_the_title()) . '</h4>';

            if (!empty($description)) {
                echo '<p class="mirror-repeater__item-description">' . do_shortcode($description) . '</p>';
            }

            if ($connected_course) {
                echo ' <a href="#connected-course-popup" data-slide_index="' . $key . '" class="mirror-repeater__item-link js-open-slide-course-popup-link js-open-popup-activator">' . __("Course overview", "wp-rock") . '</a>';
            }
            ?>
        </div>
    </div>
    <?php $key++;
endwhile;


