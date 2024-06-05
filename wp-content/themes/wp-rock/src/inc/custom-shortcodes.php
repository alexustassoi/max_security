<?php
/**
 * Custom shortcodes
 *
 * @package WP-rock/shortcodes
 */

/*
 *  BR SHORTCODE
 */
if ( ! function_exists( 'br_shortcode' ) ) {

    /**
     * Shortcode for "br"
     *
     * @param {array}       $atts    - shortcode attributes.
     * @param {string|null} $content - content inside open/close shortcode tags.
     *
     * @return string
     */
    function br_shortcode( $atts, $content = null ) {
        extract(
            shortcode_atts(
                array(
                    'class' => '',
                ),
                $atts
            )
        );

        $output = '<br class="custom-br ' . $class . '">';

        return $output;
    }

    add_shortcode( 'br', 'br_shortcode' );

}

/*
 *  CURRENT YEAR SHORTCODE
 */

if ( ! function_exists( 'current_year_shortcode' ) ) {

    /**
     * Shortcode for "current year"
     *
     * @return string
     */
    function current_year_shortcode() {
        $output = '<span>' . gmdate( 'Y' ) . '</span>';
        return $output;
    }

    add_shortcode( 'current-year', 'current_year_shortcode' );

}

/*
 * admin_notes SHORTCODE - you should use this shortcode if you want to add big comment in admin editor,
 * but you don't want to display this info in front area
 */

if ( ! function_exists( 'admin_notes_shortcode' ) ) {

    /**
     * Shortcode for "Admin notes inside editor page in admin dashboard".
     *
     * @param {array}       $atts    - shortcode attributes.
     * @param {string|null} $content - content inside open/close shortcode tags.
     *
     * @return string
     */
    function admin_notes_shortcode( $atts, $content = null ) {
        return '';
    }

    add_shortcode( 'admin_notes', 'admin_notes_shortcode' );

}

/*
 * Content for logged user shortcode
 */

if ( ! function_exists( 'logged_user_shortcode' ) ) {

    /**
     * Shortcode for "Logged user". It means that content will be shown only for logged users.
     *
     * @param {array}       $atts    - shortcode attributes.
     * @param {string|null} $content - content inside open/close shortcode tags.
     *
     * @return string
     */
    function logged_user_shortcode( $atts, $content = null ) {
        if ( is_user_logged_in() ) {
            return do_shortcode( $content );
        }

        return '';
    }

    add_shortcode( 'logged_user', 'logged_user_shortcode' );
}

/*
 *  Popup box shortcode
 */

if ( ! function_exists( 'shortcode__boxpopup' ) ) {
    /**
     * Shortcode for "Popup box".
     *
     * @param {array}       $atts    - shortcode attributes.
     * @param {string|null} $content - content inside open/close shortcode tags.
     *
     * @return string
     */
    function shortcode_popup_box( $atts, $content = null ) {
        extract(
            shortcode_atts(
                array(
                    'box_id'      => '',
                    'box_caption' => '',
                    'put_svg'     => 'false',
                    'svg_src'     => '',
                ),
                $atts
            )
        );

        $output  = '<div id="' . $box_id . '" class="popup-2">';
        $output .= '<div class="my_overlay-2 js-popup-close"></div>';

        $output .= '<div class="popup-wrapper-inner-2">';

        $output .= '<div class="in-2 text-center js-popup-inner">';

        if ( ! empty( $box_caption ) ) {
            $output .= '<p class="box-caption">' . $box_caption . '</p>';
        }

        $output .= do_shortcode( $content );
        $output .= '</div>';
        $output .= '<button
                        data-role="login-close"
                        class="popup-close-2 js-popup-close js-open-popup-activator">
                        close popup
                    </button>';
        $output .= '</div>';
        $output .= '</div>';

        return $output;

    }

    add_shortcode( 'popup_box', 'shortcode_popup_box' );

}


if ( ! function_exists( 'custom_checkbox_shortcode' ) ) {
    function custom_checkbox_shortcode($atts)
    {
        $atts = shortcode_atts(
            array(
                'text' => '',
                'name' => '',
                'group' => '',
            ),
            $atts,
            'custom_shortcode'
        );

        return '<label class="checkbox">
                    <p class="text">' . $atts['text'] . '</p>
                    <input class="js-custom-checkbox" data-group="'.$atts['group'].'" type="checkbox" value="' . $atts['text'] . '" name="dyn_field_' . sanitize_title($atts['text']) . '">
                    <span class="icon"></span>
                </label>';
    }

    add_shortcode('custom_checkbox', 'custom_checkbox_shortcode');
}



// Webinar box shortcode. Use it for single webinar page
if ( ! function_exists( 'webinar_box_shortcode' ) ) {
    /**
     * Shortcode for "Webinar box".
     *
     * @param {array}       $atts    - shortcode attributes.
     * @param {string|null} $content - content inside open/close shortcode tags.
     *
     * @return string
     */
    function webinar_box_shortcode($atts, $content = null)
    {
        extract(
            shortcode_atts(
                array(
                    'class'      => '',
                ),
                $atts
            )
        );

        return '<div class="webinar-box'.$class.'">
                    '.do_shortcode($content).'
                </div>';
    }

    add_shortcode('webinar_box', 'webinar_box_shortcode');
}
