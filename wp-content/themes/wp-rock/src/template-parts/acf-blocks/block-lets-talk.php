<?php
/**
 * Block - LET’S TALK.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name        = isset($args['className']) ? ' ' . $args['className'] : '';
$fields            = get_fields();

$hide_block        = get_field_value($fields, 'hide_block');
$block_pt          = get_field_value($fields, 'block_pt');
$space_top_type    = $block_pt ? get_field_value($fields, 'space_top_type') : '';
$block_pb          = get_field_value($fields, 'block_pb');
$space_bottom_type = $block_pb ? get_field_value($fields, 'space_bottom_type') : '';

$external_data = (isset($args['external_data']) && !empty($args['external_data'])) ? $args['external_data'] : [];

if (!empty($external_data)) {
    $title    = get_field_value($external_data, 'title');
    $image    = get_field_value($external_data, 'image');
    $link     = get_field_value($external_data, 'link');
    $block_id = get_field_value($external_data, 'block_id');
} else {
    $title    = get_field_value($fields, 'title');
    $image    = get_field_value($fields, 'image');
    $link     = get_field_value($fields, 'link');
    $block_id = $args['id'];
}

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');

if (!$hide_block) : ?>

    <div class="lets-talk  <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : '';
    echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : '';
    echo esc_html($class_name);
    echo 'space-top-type-' . do_shortcode($space_top_type) . ' ';
    echo 'space-bottom-type-' . $space_bottom_type . ' '; ?>" id="<?php echo $block_id; ?>" style="background-image: url(<?php echo $image; ?>)">
        <div class="custom-container">
            <?php if ($title): ?>
                <div class="lets-talk__title"><?php echo $title; ?></div>
            <?php endif; ?>

            <?php if ($link): ?>
                <a class="lets-talk__link white-text-hover transparent-orange-btn"
                   target="<?php echo $link['target']; ?>"
                   href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
            <?php endif; ?>
        </div>
    </div>

<?php endif;
