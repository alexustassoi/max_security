<?php

/**
 * Block - Sign up offer.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name        = isset($args['className']) ? ' ' . $args['className'] : '';
$fields            = get_fields();
$block_pt          = get_field_value($fields, 'block_pt');
$space_top_type    = $block_pt ? get_field_value($fields, 'space_top_type') : '';
$block_pb          = get_field_value($fields, 'block_pb');
$space_bottom_type = $block_pb ? get_field_value($fields, 'space_bottom_type') : '';
$desc              = get_field_value($fields, 'desc');
$form_shortcode    = get_field_value($fields, 'form_shortcode');

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');

?>

<div class="sign-up-offer <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : ''; echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : ''; echo $class_name; echo ' space-top-type-' . do_shortcode($space_top_type) . ' '; echo ' space-bottom-type-' . $space_bottom_type . ' '; ?>">
    <div class="sign-up-offer__inner">
        <div class="custom-container">
            <div class="sign-up-offer__content">
                <?php
                echo ($desc)
                    ? '<div class="sign-up-offer__desc">' . do_shortcode($desc) . '</div>'
                    : '';

                echo ($form_shortcode)
                    ? '<div class="sign-up-offer__form-wrap">' . do_shortcode($form_shortcode) . '</div>'
                    : '';
                ?>
            </div>
        </div>
    </div>
</div>
