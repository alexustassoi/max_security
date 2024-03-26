<?php

/**
 * Block - Tabs.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields = get_fields();
$title = get_field_value($fields, 'title');
$description = get_field_value($fields, 'description');
$tabs_repeater = get_field_value($fields, 'tabs_repeater');
?>
<div class="tabs">
    <div class="custom-container">
        <div class="tabs__top-wrapper">
            <?php
            if (!empty($title)) {
                echo '<h2 class="tabs__title">' . do_shortcode($title) . '</h2>';
            }
            if (!empty($description)) {
                echo '<div class="tabs__description">' . do_shortcode($description) . '</div>';
            }
            ?>
        </div>
        <div class="tabs__tab-container">
            <div class="tabs__tabs-slider js-tabs-swiper">
                <div class="swiper-wrapper">
                    <?php
                    if (!empty($tabs_repeater)) {
                        foreach ($tabs_repeater as $key => $tab_link) {

                            $active_class = $key === 0 ? 'active' : '';

                            if (!empty($tab_link['icon']) && !empty($tab_link['title'])) {
                                echo '<a href="#tab-' . $key . '"
                                    class="tabs__tab-link swiper-slide js-tab-block-link ' . $active_class . '">
                                    <div class="tabs__tab-inner">
                                        <img class="icon" src="' . $tab_link['icon'] . '" alt="icon">
                                        <span class="title">' . esc_html($tab_link['title']) . '</span>
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
                                                    class="tabs__panel-link">

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
