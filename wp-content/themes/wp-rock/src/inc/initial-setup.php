<?php
/**
 * Initial setup actions for site
 *
 * @package WP-rock
 */

/*Collect all ACF option fields to global variable. */
global $global_options;

if ( function_exists( 'get_fields' ) ) {
    if ( function_exists( 'pll_current_language' ) ) {
        // @codingStandardsIgnoreStart
        $locale         = get_locale();
        // @codingStandardsIgnoreEnd
        $global_options = get_fields( 'theme-general-settings_' . $locale );
    } else {
        $global_options = get_fields( 'theme-general-settings' );
    }
}


/**
 * Main theme's class init
 */
$wp_rock = new WP_Rock();
add_action( 'after_setup_theme', array( $wp_rock, 'px_site_setup' ) );


/**
 * Sanitize uploaded file name
 */
add_filter( 'sanitize_file_name', array( $wp_rock, 'custom_sanitize_file_name' ), 10, 1 );


/**
 * Set custom upload size limit
 */
$wp_rock->px_custom_upload_size_limit( 5 );


/**
 * Check field and return its value or return null.
 *
 * @param {array}  $data_arr - Array to check and return data.
 * @param {string} $key      - key that should be found in array.
 *
 * @return mixed|null
 */
function get_field_value( $data_arr, $key ) {
     return ( isset( $data_arr[ $key ] ) ) ? $data_arr[ $key ] : null;
}
