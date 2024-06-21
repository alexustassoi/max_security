<?php

add_action( 'init', 'wp_rock_custom_buttons' );
function wp_rock_custom_buttons() {
    add_filter( "mce_external_plugins", "wp_rock_custom_add_buttons" );
    add_filter( 'mce_buttons', 'wp_rock_custom_register_buttons' );
}

function wp_rock_custom_add_buttons( $plugin_array ) {
    $plugin_array['wptuts'] = get_template_directory_uri() . '/src/js/utils/editor_plugin.js';

    return $plugin_array;
}

function wp_rock_custom_register_buttons( $buttons ) {
    $buttons[] = 'styled_heading_tag';
    //$buttons[] = 'custom_link';

    return $buttons;
}