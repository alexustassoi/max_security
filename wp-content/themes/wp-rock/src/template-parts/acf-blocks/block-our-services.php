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

?>

<div class="our-services <?php echo $class_name; ?>">
    <div class="our-services__inner">
        <div class="custom-container">
            <?php
            echo $title
                ? '<h4 class="our-services__title">'. do_shortcode($title) . '</h4>'
                : '';

            if($services_repeater): ?>
                <div class="our-services__services">
                    <?php
                    foreach ($services_repeater as $service):
                        $service_name = get_field_value($service, 'service_name');
                        ?>
                        <div class="our-services__service">
                            <?php
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
