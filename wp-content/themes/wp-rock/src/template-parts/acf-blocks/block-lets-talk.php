<?php
/**
 * Block - LET’S TALK.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields     = get_fields();

$external_data   = ( isset($args['external_data']) && !empty($args['external_data']) ) ? $args['external_data'] : [];

if ( !empty($external_data) ) {
    $title      = get_field_value($external_data , 'title');
    $image      = get_field_value($external_data , 'image');
    $link       = get_field_value($external_data, 'link');
    $block_id   = get_field_value($external_data, 'block_id');
}
else {
    $title      = get_field_value($fields, 'title');
    $image      = get_field_value($fields, 'image');
    $link       = get_field_value($fields, 'link');
    $block_id   = $args['id'];
}
?>

<div class="lets-talk  <?php echo esc_html($class_name); ?>" id="<?php echo $block_id; ?>" style="background-image: url(<?php echo $image; ?>)">
    <div class="custom-container">
        <?php if($title): ?>
            <h2 class="lets-talk__title"><?php echo $title; ?></h2>
        <?php endif; ?>

        <?php if($link): ?>
            <a class="lets-talk__link" target="<?php echo $link['target']; ?>" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
        <?php endif; ?>
    </div>
</div>
