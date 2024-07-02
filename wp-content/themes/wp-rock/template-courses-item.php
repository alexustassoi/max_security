<?php
/**
 * Template "Courses item".
 *
 * @package WordPress
 */

$mirror_items = isset($courses_query) ? get_field_value($courses_query, 'mirror_items') : null;
$key          = isset($courses_query) ? get_field_value($courses_query, 'last_key') : null;

if (!$mirror_items || !isset($key)) die();

foreach ($mirror_items as $item) :
    $connected_course = get_field_value($item, 'connected_course_for_modal_window');
    $slider_courses_ids[] = $connected_course;
    $image                             = get_field_value($item, 'image');
    $title                             = get_field_value($item, 'title');
    $description                       = get_field_value($item, 'description');
    $btn_name                          = get_field_value($item, 'btn_name');
    ?>
    <div class="mirror-repeater__item js-mirror-item">
        <?php
        if (!empty($image)) {
            echo '<figure class="mirror-repeater__item-image"><img src="' . $image . '" alt="image"></figure>';
        }
        ?>
        <div class="mirror-repeater__item-inner">
            <?php
            if (!empty($title)) {
                echo '<h4 class="mirror-repeater__item-title">' . do_shortcode($title) . '</h4>';
            }

            if (!empty($description)) {
                echo '<p class="mirror-repeater__item-description">' . do_shortcode($description) . '</p>';
            }

            if ($connected_course) {
                echo ' <a href="#connected-course-popup" data-slide_index="' . $key . '" class="mirror-repeater__item-link primary-btn js-open-slide-course-popup-link js-open-popup-activator">' . __($btn_name, "wp-rock") . '</a>';
            }
            ?>
        </div>
    </div>
<?php
    $key++;
endforeach;



