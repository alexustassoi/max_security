<?php
/**
 * Add Dropcap option but keep the defaults.
 *
 * @package tiny_mce/customization
 */

add_filter( 'tiny_mce_before_init', 'my_wpeditor_formats_options' );

/**
 * Customizing WP Editor formats options.
 *
 * @param {array} $settings  -  Existing settings.
 * @return mixed
 */
function my_wpeditor_formats_options( $settings ) {
    /* Set to true to include the default settings. */
    $settings['style_formats_merge'] = true;

    $style_formats = array(
        array(
            'title' => 'body 1 (regular)',
            'block' => 'p',
            'classes' => 'body-type-1-regular',
        ),
        array(
            'title' => 'body 1 (not regular)',
            'block' => 'p',
            'classes' => 'body-type-1',
        ),
        array(
            'title' => 'body 2',
            'block' => 'p',
            'classes' => 'body-type-2',
        ),
        array(
            'title' => 'body 3',
            'block' => 'p',
            'classes' => 'body-type-3',
        ),
        array(
            'title' => 'body 4',
            'block' => 'p',
            'classes' => 'body-type-4',
        ),
        array(
            'title' => 'H1 with H3 styling',
            'block' => 'h1',
            'classes' => 'h1-like-h3',
        ),
        array(
            'title' => 'H1 with H2 styling',
            'block' => 'h1',
            'classes' => 'h1-like-h2',
        ),
        array(
            'title' => 'H1 with H4 styling',
            'block' => 'h1',
            'classes' => 'h1-like-h4',
        ),
        array(
            'title' => 'H1 with H5 styling',
            'block' => 'h1',
            'classes' => 'h1-like-h5',
        ),
        array(
            'title' => 'H1 with H6 styling',
            'block' => 'h1',
            'classes' => 'h1-like-h6',
        ),
        array(
            'title' => 'H2 with H3 styling',
            'block' => 'h2',
            'classes' => 'h2-like-h3',
        ),
        array(
            'title' => 'H2 with H1 styling',
            'block' => 'h2',
            'classes' => 'h2-like-h1',
        ),
        array(
            'title' => 'H2 with H4 styling',
            'block' => 'h2',
            'classes' => 'h2-like-h4',
        ),
        array(
            'title' => 'H2 with H5 styling',
            'block' => 'h2',
            'classes' => 'h2-like-h5',
        ),
        array(
            'title' => 'H2 with H6 styling',
            'block' => 'h2',
            'classes' => 'h2-like-h6',
        ),
        array(
            'title' => 'H3 with H4 styling',
            'block' => 'h3',
            'classes' => 'h3-like-h4',
        ),
        array(
            'title' => 'H3 with H5 styling',
            'block' => 'h3',
            'classes' => 'h3-like-h5',
        ),
        array(
            'title' => 'H3 with H6 styling',
            'block' => 'h3',
            'classes' => 'h3-like-h6',
        ),
        array(
            'title' => 'H4 with H5 styling',
            'block' => 'h4',
            'classes' => 'h4-like-h5',
        ),
        array(
            'title' => 'H4 with H6 styling',
            'block' => 'h4',
            'classes' => 'h4-like-h6',
        ),

        array(
            'title' => 'Paragraph with H1 styling',
            'block' => 'p',
            'classes' => 'p-like-h1',
        ),
        array(
            'title' => 'Paragraph with H2 styling',
            'block' => 'p',
            'classes' => 'p-like-h2',
        ),
        array(
            'title' => 'Paragraph with H3 styling',
            'block' => 'p',
            'classes' => 'p-like-h3',
        ),
        array(
            'title' => 'Paragraph with H4 styling',
            'block' => 'p',
            'classes' => 'p-like-h4',
        ),
        array(
            'title' => 'Paragraph with H5 styling',
            'block' => 'p',
            'classes' => 'p-like-h5',
        ),
        array(
            'title' => 'Paragraph with H6 styling',
            'block' => 'p',
            'classes' => 'p-like-h6',
        ),
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;
}

// Callback function to insert 'styleselect' into the $buttons array
function wpb_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');
