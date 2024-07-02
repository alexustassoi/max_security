<?php

/**
 * Block - Sign up offer.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields = get_fields();
$block_pt = get_field_value($fields, 'block_pt');
$block_pb = get_field_value($fields, 'block_pb');
$desc = get_field_value($fields, 'desc');
$form_shortcode = get_field_value($fields, 'form_shortcode');

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');

?>

<div class="sign-up-offer <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : ''; echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : ''; echo $class_name; ?>">
    <div class="sign-up-offer__inner">
        <div class="custom-container">
            <div class="sign-up-offer__content">
                <?php
                echo ($desc)
                    ? '<p class="sign-up-offer__desc">' . do_shortcode($desc) . '</p>'
                    : '';

                echo ($form_shortcode)
                    ? '<div class="sign-up-offer__form-wrap">' . do_shortcode($form_shortcode) . '</div>'
                    : '';
                ?>
            </div>
        </div>
    </div>
</div>
