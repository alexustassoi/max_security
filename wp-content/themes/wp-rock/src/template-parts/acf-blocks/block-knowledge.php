<?php

/**
 * Block - Knowledge.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields = get_fields();
$title = get_field_value($fields, 'title');
$slider = get_field_value($fields, 'slider');
$section_background = get_field_value($fields, 'section_background');
$heading_color = get_field_value($fields, 'heading_color');
$grid_columns_set = get_field_value($fields, 'grid_columns_set') ?: 4;
?>

<div class="knowledge" style="background-color: <?php echo $section_background ?: '#5a7153'; ?>;">
    <div class="custom-container">
        <?php
        $color_style = $heading_color ? 'color: '.$heading_color :  '';
        if (!empty($title)) {
            echo '<h4 class="knowledge__title" style="'.$color_style.'">' . do_shortcode($title) . '</h4>';
        }
        ?>
        <?php if (!empty($slider)) : ?>
            <!--  Class for swiper slider => .js-knowledge-slider  -->
            <div class="swiper knowledge__slider">
                <div class="swiper-wrapper grid-<?php echo $grid_columns_set; ?>">
                    <?php foreach ($slider as $slide) : ?>
                        <div class="swiper-slide knowledge__slide">
                            <?php if (!empty($slide['description'])) : ?>
                                <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.28 14V-9.53674e-07H14.28V14H0.28ZM1.84 12.54H12.72V1.46H1.84V12.54ZM3.5 8.12L4.18 7.06L6.28 8.98L9.82 3.28L10.92 3.94L6.7 10.8L3.5 8.12Z" fill="#CC7510" />
                                </svg>
                                <div class="knowledge__slide-description">
                                    <?php echo do_shortcode($slide['description']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
