<?php

/**
 * Block - Tabs.
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
$title             = get_field_value($fields, 'title');
$description       = get_field_value($fields, 'description');
$tabs_repeater     = get_field_value($fields, 'tabs_repeater');

$pt_space_class = wp_rock_block_space_class($block_pt, 'block_pt');
$pb_space_class = wp_rock_block_space_class($block_pb, 'block_pb');

?>

<div class="tabs <?php echo $pt_space_class ? do_shortcode($pt_space_class) . ' ' : ''; echo $pb_space_class ? do_shortcode($pb_space_class) . ' ' : ''; echo ' space-top-type-' . do_shortcode($space_top_type) . ' '; echo ' space-bottom-type-' . $space_bottom_type . ' '; ?>">
    <div class="custom-container">
        <?php
        if ($title || $description) { ?>
            <div class="tabs__top-wrapper">
                <?php
                if (!empty($title)) {
                    echo '<div class="tabs__title animated-element from-left">' . do_shortcode($title) . '</div>';
                }
                if (!empty($description)) {
                    echo '<div class="tabs__description animated-element from-right">' . do_shortcode($description) . '</div>';
                }
                ?>
            </div>
        <?php } ?>
        <div class="tabs__tab-container">
            <div class="tabs__tabs-slider js-tabs-swiper">
                <div class="swiper-wrapper">
                    <?php
                    if (!empty($tabs_repeater)) {
                        foreach ($tabs_repeater as $key => $tab_link) {

                            $active_class = $key === 0 ? 'active' : '';

	                        $img = fetchSvgContent($tab_link['icon']);
	                        if (is_null($img)) {
		                        $img = '<img class="icon" src="' . $tab_link['icon'] . '" alt="icon">';
	                        }

                            if (!empty($tab_link['icon']) && !empty($tab_link['title'])) {
                                echo '<a href="#tab-' . $key . '"
                                    class="tabs__tab-link swiper-slide js-tab-block-link ' . $active_class . '">
                                    <svg class="shape-svg" width="265" height="265" viewBox="0 0 265 265" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M263 132.5C263 218.501 233.102 263 132.5 263C31.8979 263 2 218.501 2 132.5C2 46.4987 31.8979 2 132.5 2C233.102 2 263 46.4987 263 132.5Z" fill="transparent" stroke="#f3f0ec" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                                    <div class="tabs__tab-inner">
                                        '.$img.'
                                        <div class="title">' . do_shortcode($tab_link['title']) . '</div>
                                    </div>
                                </a>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="tabs__tab-inner-panels">
                <?php
                if (!empty($tabs_repeater)) {
                    foreach ($tabs_repeater as $key => $tab_panel) {


                        $link_url = isset($tab_panel['link']['url']) ? $tab_panel['link']['url'] : null;
                        $link_title = isset($tab_panel['link']['title']) ? $tab_panel['link']['title'] : null;
                        $active_class = $key === 0 ? 'active' : '';

                        if (!empty($tab_panel['content'])) {
                            echo '<div id="tab-' . $key . '" class="tabs__tab-panel js-tab-block-panel ' . $active_class . '">';
                            echo do_shortcode($tab_panel['content']);

                            if ($link_url && $link_title) {
                                echo '  <a href="' . $link_url . '"
                                                    class="tabs__panel-link white-text-hover primary-btn">

                                                    ' . $link_title . '
                                                </a>';
                            }
                            echo '</div>';
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
