<?php

/**
 * Block - Our services.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name     = isset($args['className']) ? ' ' . $args['className'] : '';
$fields         = get_fields();
$title = get_field_value($fields, 'title');
$services_repeater = get_field_value($fields, 'services_repeater');

$section_background = get_field_value($fields, 'section_background');
$heading_color = get_field_value($fields, 'heading_color');
$grid_columns_set = get_field_value($fields, 'grid_columns_set') ?: 4;
?>

<div class="our-services <?php echo $class_name; ?>"
     style="background-color: <?php echo $section_background ?: '#5a7153'; ?>;">
    <div class="our-services__inner">
        <div class="custom-container">
            <?php
            $color_style = $heading_color ? 'color: '.$heading_color :  '';
            echo $title
                ? '<h4 class="our-services__title" 
                       style="'.$color_style.'">'. do_shortcode($title) . '</h4>'
                : '';

            if($services_repeater): ?>
                <div class="our-services__services grid-<?php echo $grid_columns_set; ?>">
                    <?php
                    foreach ($services_repeater as $service):
                        $service_name = get_field_value($service, 'service_name');
                        $service_link = get_field_value($service, 'service_link');
                        ?>
                        <div class="our-services__service">
                            <?php
                            echo $service_link
                                ? '<a href="' . do_shortcode( $service_link ) . '" class="our-services__service-link"></a>'
                                : '';

                            echo $service_name
                                ? '<div class="our-services__service-name">'. do_shortcode($service_name) . '</div>'
                                : '';
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
