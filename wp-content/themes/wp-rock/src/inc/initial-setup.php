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


function increase_upload_size_limit($size) {
    return 30 * 1024 * 1024; // 25 MB
}
add_filter('upload_size_limit', 'increase_upload_size_limit');
add_filter('post_max_size', 'increase_upload_size_limit');


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

/**
 *
 * helper wrap text
 * @param $text
 *
 * @return mixed|string
 */
function wrap_until_colon($text) {
	$colon_pos = strpos($text, ':');
	if ($colon_pos !== false) {
		$before_colon = substr($text, 0, $colon_pos + 1);
		$after_colon = substr($text, $colon_pos + 1);
		return '<strong>' . $before_colon . '</strong>' . $after_colon;
	} else {
		return $text;
	}
}

function get_prev_next_ids($warnings, $current_id) {
	$prev_id = null;
	$next_id = null;
	
	// Найти индекс текущего ID в массиве
	foreach ($warnings as $key => $warning) {
		if ($warning['ID'] == $current_id) {
			if ($key > 0) {
				$prev_id = $warnings[$key - 1]['ID'];
			}
			
			if ($key + 1 < count($warnings)) {
				$next_id = $warnings[$key + 1]['ID'];
			}
			break;
		}
	}
	
	return array('prev' => $prev_id, 'next' => $next_id);
}