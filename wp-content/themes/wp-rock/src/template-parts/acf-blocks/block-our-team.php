<?php

/**
 * Block - Our team.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields = get_fields();
$block_pt = get_field_value($fields, 'block_pt');
$block_pb = get_field_value($fields, 'block_pb');
$title = get_field_value($fields, 'title');
$subtitle = get_field_value($fields, 'subtitle');
$description = get_field_value($fields, 'description');
$team_repeater = get_field_value($fields, 'team_repeater');
$no_photo_url = get_template_directory_uri() . '/assets/public/images/no-photo.png';

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');
?>
<div class="our-team <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : ''; echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : ''; echo esc_html($class_name); ?>" id="our-team">
    <div class="our-team__custom-container">
        <?php
        if (!empty($title)) {
            echo '<h4 class="our-team__title">' . do_shortcode($title) . '</h4>';
        }
        if (!empty($subtitle)) {
            echo '<h4 class="our-team__subtitle">' . do_shortcode($subtitle) . '</h4>';
        }
        if (!empty($description)) {
            echo '<h5 class="our-team__description">' . do_shortcode($description) . '</h5>';
        }
        ?>

        <?php if (!empty($team_repeater)) : ?>
            <div class="our-team__container">
                <?php foreach ($team_repeater as $member) : ?>
                    <div class="our-team__member js-member-item">
                        <button class="our-team__member-btn js-member-item-btn">
                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.9978 1H0.257812V18.74H17.9978V1Z" stroke="#1D1D1B" stroke-width="0.34" stroke-miterlimit="10"/>
                                <path d="M3.33594 4.08008L15.2059 15.9501" stroke="#1D1D1B" stroke-width="0.34" stroke-miterlimit="10"/>
                                <path d="M15.2059 4.08008L3.33594 15.9501" stroke="#1D1D1B" stroke-width="0.34" stroke-miterlimit="10"/>
                            </svg>
                        </button>
                        <?php
                        if (!empty($member['photo'])) {
                            echo '<figure class="our-team__member-photo element-to-be-clipped">
                                    <img src="' . $member['photo'] . '" alt="photo">
                                </figure>';
                        } else {
                            echo '<figure class="our-team__member-photo element-to-be-clipped">
                                    <img src="' . $no_photo_url . '" alt="no photo">
                                </figure>';
                        }

                        if (!empty($member['name'])) {
                            echo '<div class="our-team__member-name">
                                    ' . do_shortcode($member['name']) . '
                                    </div>';
                        }
                        if (!empty($member['position'])) {
                            echo '<div class="our-team__member-position">
                                    ' . do_shortcode($member['position']) . '
                                    </div>';
                        }
                        if (!empty($member['description'])) {
                            echo '<div class="our-team__member-description">
                                    ' . do_shortcode($member['description']) . '
                                </div>';
                        }
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
