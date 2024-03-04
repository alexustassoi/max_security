<?php
/**
 * Block - Services.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields      = get_fields();
$title = get_field_value( $fields, 'title' );
$subtitle = get_field_value( $fields, 'subtitle' );
$text = get_field_value( $fields, 'text' );
$services = get_field_value( $fields, 'services' );
$bottom_content = get_field_value( $fields, 'bottom_content' );

?>

<div class="services js-top-block <?php echo esc_html($class_name); ?>" id="<?php echo $args['id']; ?>">
    <div class="custom-container">
        <?php if($title): ?>
            <h2 class="services__title"><?php echo $title; ?></h2>
        <?php endif; ?>

        <?php if($subtitle): ?>
            <h3 class="services__subtitle"><?php echo $subtitle; ?></h3>
        <?php endif; ?>

        <?php if($text): ?>
            <h5 class="services__text"><?php echo $text; ?></h5>
        <?php endif; ?>

        <?php if($services): ?>
            <div class="services__wrap">
                <?php
                $services_counter = 1;
                foreach ($services as $item):
                    $service = $item['service'];
                    $icon = $service['icon'];
                    $title = $service['title'];
                    $color = $service['background_color'];
                    $description = $service['description'];
                    ?>

                    <a href="#services-popup-<?php echo $services_counter; ?>" class="services__item" style="background-color: <?php echo $color; ?>">
                        <figure class="services__item-icon">
                            <?php if($icon): ?>
                                <img  src="<?php echo $icon; ?>" alt="service icon">
                            <?php endif; ?>
                        </figure>

                        <?php if($title): ?>
                            <p class="services__item-title"><?php echo $title; ?></p>
                        <?php endif; ?>

                        <?php if($description): ?>
                            <p class="services__item-desc"><?php echo $description; ?></p>
                        <?php endif; ?>

                        <button class="services__item-button">
                            <span> <?php echo __('EXPLORE', 'wp-rock'); ?></span>
                        </button>
                    </a>

                <?php $services_counter++; endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if($bottom_content):
            $bottom_title = $bottom_content['title'];
            $bottom_content = $bottom_content['content'];
            ?>
            <div class="services__bottom">
                <?php if($bottom_title): ?>
                    <p class="services__bottom-title"><?php echo $bottom_title; ?></p>
                <?php endif; ?>
                <?php if($bottom_content): ?>
                    <p class="services__bottom-content"><?php echo $bottom_content; ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
