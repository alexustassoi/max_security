<?php

/**
 * Block - Custom video.
 *
 * @package WP-rock
 * @since   4.4.0
 */

global $global_options;

$class_name     = isset($args['className']) ? ' ' . $args['className'] : '';
$fields         = get_fields();
$block_pt = get_field_value($fields, 'block_pt');
$block_pb = get_field_value($fields, 'block_pb');
$is_url_youtube = get_field_value($fields, 'is_url_youtube');
$video_url      = get_field_value($fields, 'video_url');
$video_caption  = get_field_value($fields, 'video_caption');
$section_background = get_field_value($fields, 'colors_select');

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');

?>

<div class="custom-video <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : ''; echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : ''; echo $class_name; ?>" style="background-color: <?php echo $section_background ?: '#5a7153'; ?>;">
    <div class="custom-video__inner">
        <div class="custom-container">
            <div class="custom-video__video-wrap">
                <?php
                if (isset($is_url_youtube) && isset($video_url)) :
                    $video_content = get_post_block_video($is_url_youtube, $video_url);

                    echo $video_content
                        ? '<div class="custom-video__video">' . do_shortcode($video_content) . '</div>'
                        : '';
                endif;

                echo $video_caption
                    ? '<p class="custom-video__video-caption">' . do_shortcode($video_caption) . '</p>'
                    : '';
                ?>
            </div>
        </div>
    </div>
</div>
