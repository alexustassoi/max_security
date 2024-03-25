<?php

/**
 * Block - Our team.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields = get_fields();
$title = get_field_value($fields, 'title');
$subtitle = get_field_value($fields, 'subtitle');
$description = get_field_value($fields, 'description');
$team_repeater = get_field_value($fields, 'team_repeater');
$no_photo_url = get_template_directory_uri() . '/assets/public/images/no-photo.png';
?>
<div class="our-team">
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
                        <?php
                        if (!empty($member['photo'])) {
                            echo '<figure class="our-team__member-photo element-to-be-clipped">
                                    <img src="' . $member['photo'] . '" alt="photo">
                                </figure>';
                        } else {
                            echo '<figure class="our-team__member-photo">
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
