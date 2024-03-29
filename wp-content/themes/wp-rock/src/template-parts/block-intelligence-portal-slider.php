<?php
/**
 * Block - intelligence-portal slider.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields        = get_fields();
$item_repeater = get_field_value($fields, 'item_repeater');

?>

<section id="intelligence-portal-slider" class="intelligence-portal-slider">
    <div class="container intelligence-portal-slider__container">
        <div class="intelligence-h__menu-wrap"></div>
        <div class="intelligence-portal-slider__content">
            <?php
            if ($item_repeater) {
                $i = $j = 1;
                ?>
                <div class="intelligence-portal-slider__wrap">
                    <div class="swiper-wrapper">
                        <?php foreach ($item_repeater as $item) {
                            $item_title = get_field_value($item, 'item_title');
                            $item_content = get_field_value($item, 'item_content');
                            $item_image = get_field_value($item, 'item_image');
                            $item_link = get_field_value($item, 'item_link');

                            switch ($i) {
                                case 1:
                                    $slide = ' prev-slide';
                                    break;
                                case 2:
                                    $slide = ' active-slide';
                                    break;
                                case 3:
                                    $slide = ' next-slide';
                                    break;
                                default:
                                    $slide = '';
                            }
                            ?>
                            <div 
                                class="intelligence-portal-slider__item js-intelligence-portal-item slide<?php echo $slide; ?>" 
                                data-index="<?php echo $i; ?>" 
                                data-role="toggle-intelligence-portal"
                                >
                                <div class="intelligence-portal-slider__content-wrap">
                                    <a href="<?php echo esc_url( $item_link ); ?>" class="intelligence-portal-slider__link">
                                        <img src="<?php echo esc_url( $item_image ); ?>" class="intelligence-portal-slider__image" />
                                    </a>
                                    <h4 class="intelligence-portal-slider__title">
                                        <?php echo do_shortcode( $item_title ); ?>
                                    </h4>
                                    <div class="intelligence-portal-slider__content">
                                        <?php echo do_shortcode( $item_content ); ?>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            $i++;
                        }
                        ?>
                    </div>

                    <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                    <?php foreach ($item_repeater as $item) {
                        switch ($j) {
                            case 2:
                                $active_button = ' swiper-pagination-bullet-active';
                                break;
                            default:
                                $active_button = '';
                        } 
                        ?>
                            <span 
                                class="swiper-pagination-bullet js-intelligence-portal-button<?php echo $active_button; ?>" 
                                data-index="<?php echo $j; ?>"
                                >
                            </span>
                        <?php 
                            $j++;
                        } 
                        ?>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
</section>
