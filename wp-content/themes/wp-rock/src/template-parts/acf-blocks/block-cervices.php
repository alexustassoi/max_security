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
            <div class="services__title"><?php echo $title; ?></div>
        <?php endif; ?>

        <?php if($subtitle): ?>
            <div class="services__subtitle"><?php echo $subtitle; ?></div>
        <?php endif; ?>

        <?php if($text): ?>
            <div class="services__text"><?php echo $text; ?></div>
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

                    <a href="#services-popup-<?php echo $services_counter; ?>" class="services__item js-open-popup-activator" style="background-color: <?php echo $color; ?>">
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

<?php if($services): ?>
    <?php
    $popup_counter = 1;
     foreach ($services as $item):
        $popup = $item['service_popup'];
        $popup_image = $popup['image'];
        $popup_icon = $popup['icon'];
        $popup_title = $popup['title'];
        $popup_subtitle = $popup['subtitle'];
        $popup_content = $popup['content'];
        $popup_color = $popup['background_color'];
        $link = $popup['link'];

    ?>
    <div id="services-popup-<?php echo $popup_counter; ?>" class="popup popup__service js-popup-close">
        <div class="popup__wrapper-inner popup__service-inner" style="background-color: <?php echo $popup_color; ?>">

            <button class="popup__btn-close js-popup-close">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g id="close">
                        <path fill="#fff" id="x" d="M18.717 6.697l-1.414-1.414-5.303 5.303-5.303-5.303-1.414 1.414 5.303 5.303-5.303 5.303 1.414 1.414 5.303-5.303 5.303 5.303 1.414-1.414-5.303-5.303z"/>
                    </g>
                </svg>
            </button>

            <figure class="popup__service-image">
                <?php if($popup_image): ?>
                    <img src="<?php echo $popup_image; ?>" alt="popup image">
                <?php endif; ?>
            </figure>

            <div class="popup__service-content">
                <div class="popup__service-icon">
                    <?php if($popup_icon): ?>
                        <img src="<?php echo $popup_icon; ?>" alt="popup icon">
                    <?php endif; ?>
                </div>

                <div class="popup__service-right">
                    <?php if($popup_title): ?>
                        <h3 class="popup__service-title"><?php echo $popup_title; ?></h3>
                    <?php endif; ?>

                    <?php if($popup_subtitle): ?>
                        <p class="popup__service-subtitle"><?php echo $popup_subtitle; ?></p>
                    <?php endif; ?>

                    <?php if($popup_content): ?>
                        <div class="popup__service-text">
                            <?php echo $popup_content; ?>
                        </div>
                    <?php endif; ?>

                    <?php if($link): ?>
                        <a target="<?php echo $link['target']; ?>" href="<?php echo $link['url']; ?>"
                           class="popup__service-link">
                            <?php echo $link['title']; ?> →
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php $popup_counter++; endforeach; ?>
<?php endif; ?>


