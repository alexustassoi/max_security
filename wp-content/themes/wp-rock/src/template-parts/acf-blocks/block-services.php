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
    </div>

    <div class="custom-container services__custom-container">
        <?php if($services): ?>
            <div class="swiper js-services-slider services__wrap">
                <div class="swiper-wrapper">
                    <?php
                    $services_counter = 1;
                    foreach ($services as $item):
                        $service = $item['service'];
                        $icon = $service['icon'];
                        $title = $service['title'];
                        $color = $service['background_color'];
                        $description = $service['description'];
                        ?>

                        <a href="#services-popup-<?php echo $services_counter; ?>" class="services__item swiper-slide js-open-popup-activator" style="background-color: <?php echo $color; ?>">
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
            </div>

        <?php endif; ?>
    </div>

    <div class="custom-container">
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
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <g clip-path="url(#clip0_412_1882)">
                        <path d="M23 1H1V23H23V1Z" stroke="#F3F0EC" stroke-width="0.57" stroke-miterlimit="10"/>
                        <path d="M4.81604 4.82324L19.5467 19.5539" stroke="#F3F0EC" stroke-width="0.57" stroke-miterlimit="10"/>
                        <path d="M19.5467 4.82324L4.81604 19.5539" stroke="#F3F0EC" stroke-width="0.57" stroke-miterlimit="10"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_412_1882">
                            <rect width="24" height="24" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
            </button>

            <figure class="popup__service-image">
                <?php if($popup_image): ?>
                    <img src="<?php echo $popup_image; ?>" alt="popup image">
                <?php endif; ?>
            </figure>

            <div class="popup__service-content">
                <div class="popup__service-title-wrap">
                    <div class="popup__service-icon">
                        <?php if($popup_icon): ?>
                            <img src="<?php echo $popup_icon; ?>" alt="popup icon">
                        <?php endif; ?>
                    </div>

                    <div>
                        <?php if($popup_title): ?>
                            <h3 class="popup__service-title"><?php echo $popup_title; ?></h3>
                        <?php endif; ?>

                        <?php if($popup_subtitle): ?>
                            <p class="popup__service-subtitle"><?php echo $popup_subtitle; ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="popup__service-content-wrap">
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


