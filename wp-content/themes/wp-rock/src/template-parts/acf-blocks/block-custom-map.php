<?php

/**
 * Block - Custom map.
 *
 * @package WP-rock
 * @since   4.4.0
 */

global $global_options;

$class_name  = isset($args['className']) ? ' ' . $args['className'] : '';
$fields      = get_fields();
$map_iframe  = get_field_value($fields, 'map_iframe');
$map_caption = get_field_value($fields, 'map_caption');

?>

<div class="custom-map <?php echo $class_name; ?>">
    <div class="custom-map__inner">
        <div class="custom-container">
            <div class="custom-map__map-wrap">
                <?php
                echo $map_iframe ? do_shortcode($map_iframe) : '';

                echo $map_caption
                    ? '<p class="custom-map__map-caption">' . do_shortcode($map_caption) . '</p>'
                    : '';
                ?>
            </div>
        </div>
    </div>
</div>
