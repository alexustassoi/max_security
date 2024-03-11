<?php
/**
 * Block - LET’S TALK.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields     = get_fields();
$title      = get_field_value($fields, 'title');
$image      = get_field_value($fields, 'image');
$link     = get_field_value($fields, 'link');
?>

<div class="lets-talk  <?php echo esc_html($class_name); ?>" id="<?php echo $args['id']; ?>" style="background-image: url(<?php echo $image; ?>)">
    <div class="custom-container">
        <?php if($title): ?>
            <h2 class="lets-talk__title"><?php echo $title; ?></h2>
        <?php endif; ?>

        <?php if($link): ?>
            <a class="lets-talk__link" target="<?php echo $link['target']; ?>" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
        <?php endif; ?>
    </div>
</div>
