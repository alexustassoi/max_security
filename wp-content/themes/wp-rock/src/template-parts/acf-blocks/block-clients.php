<?php
/**
 * Block - Clients.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields     = get_fields();
$block_pt = get_field_value($fields, 'block_pt');
$block_pb = get_field_value($fields, 'block_pb');
$title      = get_field_value($fields, 'title');
$subtitle   = get_field_value($fields, 'subtitle');
$clients    = get_field_value($fields, 'clients');

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');
?>

<div class="clients  <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : ''; echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : '';  echo esc_html($class_name); ?>" id="<?php echo $args['id']; ?>">
    <div class="custom-container">
        <?php if ($title): ?>
            <h2 class="clients__title"><?php echo $title; ?></h2>
        <?php endif; ?>

        <?php if ($subtitle): ?>
            <h5 class="clients__subtitle"><?php echo $subtitle; ?></h5>
        <?php endif; ?>
    </div>

    <?php if ($clients): ?>
        <div class="clients__wrap">
            <div class="swiper js-clients-swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($clients as $icon): ?>
                        <div class="swiper-slide clients__slide">
                            <img src="<?php echo $icon; ?>" alt="clients logo">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
