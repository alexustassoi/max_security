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
?>

<div class="knowledge">
    <div class="custom-container">
        <?php
        if (!empty($title)) {
            echo '<h4 class="knowledge__title">' . do_shortcode($title) . '</h4>';
        }
        ?>
        <?php if (!empty($slider)) : ?>
            <div class="swiper knowledge__slider js-knowledge-slider">
                <div class="swiper-wrapper">
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
