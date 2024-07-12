<?php

/**
 * Block - About us.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields = get_fields();
$title = get_field_value($fields, 'title');
$image = get_field_value($fields, 'image');
$image_mobile = get_field_value($fields, 'image_mobile');
$content = get_field_value($fields, 'content');

?>

<div class="about-us<?php echo $class_name; ?>">
    <div class="about-us__inner">

        <?php if ($image) : ?>
            <figure class="about-us__image">
                <img src="<?php echo $image; ?>" alt="image">
            </figure>
        <?php endif; ?>

        <?php if ($image_mobile) : ?>
            <figure class="about-us__image mob">
                <img src="<?php echo $image_mobile; ?>" alt="image">
            </figure>
        <?php endif; ?>

        <div class="about-us__content">

            <?php if ($title) : ?>
                <div class="about-us__title"><?php echo $title; ?></div>
            <?php endif; ?>

            <div class="about-us__content-wrap">
                <?php if ($content) : ?>
                    <div class="about-us__text">
                        <?php echo do_shortcode($content); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
