<?php
/**
 * Custom hooks
 *
 * @package WP-rock/custom-hooks
 */

/**
 * Remove windows LSEP from content
 *
 * @param { string } $html - Text content.
 *
 * @return array|string|string[]
 */
function remove_lsep( $html ) {
    $pattern = '/\x{2028}/u';

    return preg_replace( $pattern, '', $html );
}


/**
 * Remove windows LSEP from content
 *
 * @param {string} $content - Text content.
 * @return string|string[]
 */
function remove_windows_lsep_from_content( $content ) {
    return str_replace( "\r\n", '', $content );
}
add_filter( 'the_content', 'remove_windows_lsep_from_content' );



/**
 * Change display type for language switcher in Frontend
 */
add_filter(
    'pll_the_languages_args',
    function( $args ) {
        $args['display_names_as'] = 'slug';
        return $args;
    }
);



/**
 * Remove tag <p> и <br> in plugin contact form.
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );
