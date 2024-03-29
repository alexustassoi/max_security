<?php
/**
 * Block - Home hero mobile.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields        = get_fields();
$item_repeater = get_field_value($fields, 'item_repeater');

?>

<section class="home-h-mob-wrapper">
    <div class="home-h-mob__content-wrap">
        <div class="home-h-mob__content">
            <?php if ($item_repeater) {
                $count = 1;
                ?>
                <div class="home-h-mob__bg-images js-home-h-mob-images">
                    <?php foreach ($item_repeater as $item) {
                        $item_image     = get_field_value($item, 'item_image');
                        $item_image_mob = get_field_value($item, 'item_image_mob');
                        ?>
                        <div class="home-h-mob__bg-image js-home-h-img <?php echo (1 === $count) ? 'active' : ''; ?>"
                             data-index="<?php echo do_shortcode($count); ?>">
                            <img loading="lazy"
                                 class="slide slide<?php echo do_shortcode($count); ?>"
                                 src="<?php echo do_shortcode($item_image); ?>" alt="Image"
                                 data-index="<?php echo do_shortcode($count); ?>" />

                            <img loading="lazy"
                                 class="slide slide<?php echo do_shortcode($count); ?> mobile"
                                 src="<?php echo do_shortcode($item_image_mob); ?>" alt="Image"
                                 data-index="<?php echo do_shortcode($count); ?>" />
                        </div>
                        <?php $count++;
                    } ?>
                </div>
            <?php } ?>
            <?php if ($item_repeater) {
                $count = 1;
                ?>
                <div class="home-h-mob__content-items">
                    <?php foreach ($item_repeater as $item) {
                        $item_title = get_field_value($item, 'item_title');
                        $item_text  = get_field_value($item, 'item_text');
                        $item_btn   = get_field_value($item, 'item_btn');
                        ?>
                        <div
                            class="home-h-mob__content-item js-home-h-content-item <?php echo (1 === $count) ? 'active' : ''; ?>"
                            data-index="<?php echo do_shortcode($count); ?>">
                            <h2 class="home-h-mob__item-title"><?php echo do_shortcode($item_title); ?></h2>
                            <p class="home-h-mob__item-text"><?php echo do_shortcode($item_text); ?></p>
                            <a href="<?php echo($item_btn['url']); ?>"
                               class="home-h-mob__item-btn button white-btn"><?php echo($item_btn['title']); ?></a>
                        </div>
                        <?php $count++;
                    } ?>
                </div>
                <div class="home-h-mob__icons-items">
                    <?php
                    $count = 1;
                    foreach ($item_repeater as $item) {
                        $item_icon        = get_field_value($item, 'item_icon');
                        $item_icon_active = get_field_value($item, 'item_icon_active');
                        $item_icon_title  = get_field_value($item, 'item_icon_title');
                        ?>
                        <div
                            class="home-h-mob__icons-item js-home-h-icons-item <?php echo (1 === $count) ? 'active' : ''; ?>"
                            data-index="<?php echo do_shortcode($count); ?>" data-role="toggle-hero-banner">
                            <img src="<?php echo do_shortcode($item_icon); ?>" alt="Icon" class="home-h-mob__icon"/>
                            <img src="<?php echo do_shortcode($item_icon_active); ?>" alt="Active Icon"
                                 class="home-h-mob__active-icon"/>
                            <p class="home-h-mob__icon-title"><?php echo do_shortcode($item_icon_title); ?></p>
                        </div>
                        <?php $count++;
                    } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
