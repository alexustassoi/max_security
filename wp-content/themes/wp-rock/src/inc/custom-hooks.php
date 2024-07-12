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
function remove_lsep($html) {
    $pattern = '/\x{2028}/u';

    return preg_replace($pattern, '', $html);
}


/**
 * Remove windows LSEP from content
 *
 * @param {string} $content - Text content.
 * @return string|string[]
 */
function remove_windows_lsep_from_content($content) {
    return str_replace("\r\n", '', $content);
}
add_filter('the_content', 'remove_windows_lsep_from_content');



/**
 * Change display type for language switcher in Frontend
 */
add_filter(
    'pll_the_languages_args',
    function ($args) {
        $args['display_names_as'] = 'slug';
        return $args;
    }
);



/**
 * Remove tag <p> и <br> in plugin contact form.
 */
add_filter('wpcf7_autop_or_not', '__return_false');

// TODO: Add dynamic fields to form for sending to email

//add_action('wpcf7_before_send_mail', 'add_dynamic_fields_to_email');


/**
 * Add dynamic fields to the email message of a contact form.
 *
 * This function retrieves the submitted data from a contact form submission and adds dynamic fields
 * with names starting with 'dyn_field_' to the email message. It then updates the mail properties
 * of the contact form with the added dynamic fields.
 *
 * @param object $contact_form The Contact Form 7 form object.
 *
 * @return void
 */
function add_dynamic_fields_to_email(object $contact_form): void
{
    // Get the form ID
    $form_id = $contact_form->id();

    // Get the form submission instance
    $submission = WPCF7_Submission::get_instance();

    // Proceed if submission exists
    if ($submission) {
        // Get the posted data from the submission
        $posted_data = $submission->get_posted_data();

        // Initialize additional fields string
        $additional_fields = '';

        // Iterate through the form data
        foreach ($posted_data as $key => $value) {
            // Check if the field is dynamic
            if (preg_match('/^dyn_field_/', $key)) {
                // Add dynamic fields to the posted data array
                $posted_data[$key] = $value;
            }
        }

        // Update mail properties with dynamic fields
        $mail = $contact_form->prop('mail');
        $contact_form->set_properties(array('mail' => $mail));
    }
}


function get_resource_tag_slugs($term_ids): array
{
    global $wpdb;
    $term_slugs = [];

    if ( empty($term_ids) ) {
        return $term_slugs;
    }

    // Converting an array of term IDs into a string for use in an SQL query
    $term_ids_str = implode(',', array_map('intval', $term_ids));

    // Forming an SQL query using prepare to safely embed values
    $sql = $wpdb->prepare(
        "SELECT t.term_id, t.slug
        FROM {$wpdb->terms} t
        INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id = tt.term_id
        WHERE tt.taxonomy = 'resource_tag' AND t.term_id IN ($term_ids_str)"
    );

    $results = $wpdb->get_results($sql, ARRAY_A);


    foreach ($results as $result) {
        $term_slugs[$result['term_id']] = $result['slug'];
    }

    return $term_slugs;
}




/**
 * Output CSS styles for custom tag colors in the WordPress theme.
 * This function retrieves tag colors from theme options and generates CSS variables.
 *
 * @return void
 */
function wp_rock_color_panel(): void
{
    global $global_options;

    // Get main tag colors from theme options
    $main_tags_colours = get_field_value($global_options, 'main_tags_colours');

    // Initialize an empty array to store CSS variable declarations
    $colours_variable = array();

    // Extract term IDs from main tag colors array
    $term_ids = array_map( function ($single_data) {
        return $single_data['title'];
    }, $main_tags_colours);

    // Get slugs for terms associated with the given term IDs
    $terms_data = get_resource_tag_slugs($term_ids);

    // Generate CSS variable declarations for each main tag color
    if ( !empty($main_tags_colours) ) {
        foreach ($main_tags_colours as $main_tags_colour) {
            $term_id    = $main_tags_colour['title'];
            $term_color = $main_tags_colour['tag_term_color'];
            $colours_variable[] = '--color-term-'.$terms_data[$term_id].':'.$term_color.';';
        }
    }

    // Output CSS styles with the generated CSS variables
    ?>
    <style>
        :root {
        <?php echo implode('', $colours_variable); ?>
        }
    </style>
    <?php
}
add_action('wp_head', 'wp_rock_color_panel');


// This block will be rendered before site footer on "Single resources pages"
function add_basic_footer_block(){

    if ( is_singular('resources') ) {
        global $global_options;
        $external_data = array(
            'image' => get_field_value($global_options, 'image'),
            'title' => get_field_value($global_options, 'title'),
            'link'  => get_field_value($global_options, 'link'),
            'block_id' => 'block-id',
        );

        echo esc_html( get_template_part( 'src/template-parts/acf-blocks/block', 'lets-talk', array(
                'external_data' => $external_data
        ) ) );
    }

}
add_action('wp_rock_after_page_content', 'add_basic_footer_block', 10);


/**
 * Adds a custom template metabox to the 'resources' post type.
 *
 * This function hooks into the 'add_meta_boxes' action to add a metabox
 * that allows users to select a custom template for individual posts of the
 * 'resources' post type. The metabox is displayed in the sidebar.
 *
 * @return void
 */
function add_custom_template_metabox() {
    add_meta_box(
        'custom_template_metabox',           // ID of the metabox
        'Template',                          // Title of the metabox
        'render_custom_template_metabox',    // Callback function for rendering the metabox
        'resources',                         // Post type for which the metabox is added
        'side',                              // Context (position) where the metabox should appear
        'default'                            // Priority of the metabox
    );
}
add_action('add_meta_boxes', 'add_custom_template_metabox');


/**
 * Renders the custom template metabox for the 'resources' post type.
 *
 * This function outputs a dropdown select box allowing the user to choose
 * a custom template for the current post. It retrieves available templates
 * from the theme and populates the select options with template names.
 *
 * @param WP_Post $post The current post object.
 *
 * @return void
 */
function render_custom_template_metabox($post) {
    // Retrieve the currently selected template for the post
    $selected_template = get_post_meta($post->ID, '_custom_post_template', true);

    // Get all PHP files from the theme
    $templates = wp_get_theme()->get_files('php', 1);
    // Filter files to include only those with 'template-' in the filename
    $templates = array_filter($templates, function($file) {
        return strpos($file, 'template-') !== false;
    });

    // Output a nonce field for security
    wp_nonce_field('save_custom_template', 'custom_template_nonce');

    // Output the label and select box for template selection
    echo '<label for="custom_post_template">Choose a Template:</label>';
    echo '<select name="custom_post_template" id="custom_post_template">';
    echo '<option value="">Default</option>';

    // Loop through templates and create an option element for each
    foreach ($templates as $template => $file) {
        $template_name = basename($file, '.php');
        echo '<option value="' . esc_attr($template_name) . '" ' . selected($selected_template, $template_name, false) . '>' . esc_html($template_name) . '</option>';
    }
    echo '</select>';
}


/**
 * Saves the custom template selection for a post.
 *
 * This function is hooked to the 'save_post' action and handles saving
 * the selected custom template from the metabox to post meta. It includes
 * nonce verification, autosave checks, and user capability checks.
 *
 * @param int $post_id The ID of the post being saved.
 *
 * @return void
 */
function save_custom_post_template($post_id) {
    // Verify the nonce for security
    if (!isset($_POST['custom_template_nonce']) || !wp_verify_nonce($_POST['custom_template_nonce'], 'save_custom_template')) {
        return;
    }

    // Check if this is an autosave and return if it is
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user capabilities
    if (isset($_POST['post_type']) && $_POST['post_type'] === 'page') {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    // Sanitize and save the custom post template
    if (isset($_POST['custom_post_template'])) {
        $template = sanitize_text_field($_POST['custom_post_template']);
        update_post_meta($post_id, '_custom_post_template', $template);
    }
}

// Hook the function to the 'save_post' action
add_action('save_post', 'save_custom_post_template');



/**
 * Loads a custom single post template for the 'resources' post type.
 *
 * This function is hooked to the 'single_template' filter and loads a custom
 * single post template based on the selected template saved in post meta. If
 * no custom template is selected or if the selected template is 'default', the
 * default single post template is used.
 *
 * @param string $single_template The path to the single template file.
 *
 * @return string The path to the custom single template file if one is found, otherwise the default single template path.
 */
function load_custom_single_template($single_template) {
    global $post;

    if ('resources' === $post->post_type) {
        $template = get_post_meta($post->ID, '_custom_post_template', true);

        if ($template && $template !== 'default') {
            $template_path = locate_template("{$template}.php");

            if ($template_path) {
                return $template_path;
            }
        }
    }

    return $single_template;
}

// Hook the function to the 'single_template' filter
add_filter('single_template', 'load_custom_single_template');



/**
 * Generates HTML for embedding a video.
 *
 * This function returns HTML code for either an embedded YouTube video
 * or a self-hosted video depending on the $is_youtube parameter.
 *
 * @param bool   $is_youtube Determines whether the video is a YouTube video. Default is false.
 * @param string $video_url  The URL of the video. Default is an empty string.
 *
 * @return string|null The HTML content for the video embed, or null if $video_url is not provided.
 */
function get_post_block_video( $is_youtube = false, $video_url = '' ) {
    if ( ! $video_url ) {
        return null;
    }

    $html_content = '';

    if ( $is_youtube ) {
        $wp_rock = new WP_Rock();
        $embed_youtube_url = $wp_rock->px_get_youtube_embed_url($video_url);

        if (!$embed_youtube_url) return null;

        $html_content .= '<iframe class="single-blog__post-video-iframe" type="text/html" src="' . do_shortcode($embed_youtube_url) . '" frameborder="0" allowfullscreen width="100%" height="100%"></iframe>';
    } else {
        $html_content .= '<video class="single-blog__post-video" preload="none" playsinline controls><source src="' . do_shortcode($video_url) . '.webm" type="video/webm"><source src="' . do_shortcode($video_url) . '.mp4" type="video/mp4"></video>';
    }

    return $html_content;
}


function wrap_columns_block_in_container( $block_content, $block ) {
    // Check if the block is the 'core/columns' block
    if ( 'core/columns' === $block['blockName'] ) {


        $bg_color = isset($block['attrs']['backgroundColor']) ?: '';

        //var_dump('wrap_columns_block_in_container block', $block);

        // Wrap the block content in a div with the class 'custom-container'
        return '<div class="wrap-columns-block" style="background-color: var(--wp--preset--color--'.$bg_color.');"><div class="custom-container">' . $block_content . '</div></div>';
    }

    // Return the block content unchanged for all other blocks
    return $block_content;
}
add_filter( 'render_block', 'wrap_columns_block_in_container', 10, 2 );


// Changing links filter
function custom_post_permalink($permalink, $post, $leavename) {
    // Check if post is = resources
    if ($post->post_type == 'resources') {
        // Get post category
        $terms = get_the_terms($post->ID, 'resources-category');
        $category_slug = '';

        if ($terms && !is_wp_error($terms)) {
            // Get only first category
            $category_slug = $terms[0]->slug;

            if (!empty($terms[0]->parent) && get_term($terms[0]->parent)) {
                $parent_term = get_term($terms[0]->parent);
                $category_slug = $parent_term->slug . '/' . $terms[0]->slug;
            }
        }

        // Build new permalink
        $permalink = str_replace('resources', 'resources/' . $category_slug, $permalink);
    }

    return $permalink;
}
add_filter('post_type_link', 'custom_post_permalink', 10, 3);

function my_custom_rewrite_rules() {
    // Have 2 categories in link
    add_rewrite_rule(
        '^resources/([^/]+)/([^/]+)/([^/]+)/?$',
        'index.php?post_type=resources&category=$matches[1]&subcategory=$matches[2]&name=$matches[3]',
        'top'
    );

    // Have 1 categories in link
    add_rewrite_rule(
        '^resources/([^/]+)/([^/]+)/?$',
        'index.php?post_type=resources&category=$matches[1]&name=$matches[2]',
        'top'
    );

    // Whiout categories
    add_rewrite_rule(
        '^resources/([^/]+)/?$',
        'index.php?post_type=resources&name=$matches[1]',
        'top'
    );
}
add_action('init', 'my_custom_rewrite_rules');


/**
 * Output CSS styles for heading tags in the WordPress theme.
 * This function retrieves heading tags from theme options and generates CSS variables.
 *
 * @return void
 */
function wp_rock_typo_size_panel(): void
{
    global $global_options;

    // set array of typography variables
    $typo_vars = array(
        'font-h1-m',
        'font-h1-t',
        'font-h1-d',
        'font-h1-w',
        'font-h2-m',
        'font-h2-t',
        'font-h2-d',
        'font-h2-w',
        'font-h3-m',
        'font-h3-t',
        'font-h3-d',
        'font-h3-w',
        'font-h4-m',
        'font-h4-t',
        'font-h4-d',
        'font-h4-w',
        'font-h5-m',
        'font-h5-t',
        'font-h5-d',
        'font-h5-w',
        'font-h6-m',
        'font-h6-t',
        'font-h6-d',
        'font-h6-w',
        'font-body1-m',
        'font-body1-t',
        'font-body1-d',
        'font-body1-w',
        'font-body2-m',
        'font-body2-t',
        'font-body2-d',
        'font-body2-w',
        'font-body3-m',
        'font-body3-t',
        'font-body3-d',
        'font-body3-w',
        'font-body4-m',
        'font-body4-t',
        'font-body4-d',
        'font-body4-w',
    );

    // set array of typography font weight variables.
    $typo_font_weight_vars = array(
        'Thin'        => 100,
        'Light'       => 300,
        'Extra Light' => 350,
        'Regular'     => 400,
        'Medium'      => 500,
        'SemiBold'    => 600,
        'Bold'        => 700,
        'ExtraBold'   => 800,
        'Black'       => 900
    );

    // Initialize an empty array to store CSS variable declarations
    $heading_variable = array();

    // Generate CSS variable declarations for each main tag color
    if ( !empty($typo_vars) ) {
        foreach ($typo_vars as $typo_var) {
            $typo_size          = get_field_value( $global_options, $typo_var );
            $heading_name_lower = strtolower($typo_var);

            if (strpos($typo_var, '-w') !== false) {
                $typo_size = isset($typo_font_weight_vars[$typo_size])
                    ? $typo_font_weight_vars[$typo_size]
                    : $typo_size;
            }

            $heading_variable[] = '--typo-size-' . $heading_name_lower . ': ' . $typo_size . ';';
        }
    }

    // Output CSS styles with the generated CSS variables
    ?>
    <style>
        :root {
        <?php echo implode('', $heading_variable); ?>
        }
    </style>
    <?php
}
add_action('wp_head', 'wp_rock_typo_size_panel');


/**
 * Output CSS styles for block spaces in the WordPress theme.
 * This function retrieves block spaces from theme options and generates CSS variables.
 *
 * @return void
 */
function wp_rock_block_space_panel(): void
{
    global $global_options;

    // set array of block space variables
    $block_space_vars = array(
        'block-pt-small-d',
        'block-pt-small-t',
        'block-pt-small-m',
        'block-pb-small-d',
        'block-pb-small-t',
        'block-pb-small-m',
        'block-pt-medium-d',
        'block-pt-medium-t',
        'block-pt-medium-m',
        'block-pb-medium-d',
        'block-pb-medium-t',
        'block-pb-medium-m',
        'block-pt-large-d',
        'block-pt-large-t',
        'block-pt-large-m',
        'block-pb-large-d',
        'block-pb-large-t',
        'block-pb-large-m',
    );

    // Initialize an empty array to store CSS variable declarations
    $space_variable = array();

    // Generate CSS variable declarations for each main tag color
    if ( !empty($block_space_vars) ) {
        foreach ($block_space_vars as $block_space_var) {
            $block_space_size   = get_field_value( $global_options, $block_space_var );
            $block_space_name_lower = strtolower($block_space_var);
            $space_variable[] = '--typo-space-' . $block_space_name_lower . ': ' . $block_space_size . ';';
        }
    }

    // Output CSS styles with the generated CSS variables
    ?>
    <style>
        :root {
        <?php echo implode('', $space_variable); ?>
        }
    </style>
    <?php
}
add_action('wp_head', 'wp_rock_block_space_panel');


/**
 * Generates a CSS class for block padding based on given parameters.
 *
 * This function takes a boolean flag and a key, then returns a corresponding
 * CSS class name for adding padding to the top or bottom of a block.
 *
 * @param bool   $is_block_space Boolean flag indicating whether to add the padding class.
 * @param string $key            A key that specifies which padding class to generate.
 *                               Accepted values are 'block_pt' for padding-top and 'block_pb' for padding-bottom.
 *
 * @return string Returns the corresponding CSS class name if $is_block_space is true; otherwise, returns an empty string.
 */
function wp_rock_block_space_class($is_block_space, $key) : string
{
    $block_space_class = '';

    // Set Block space class.
    switch ( $key ) {
        case 'block_pt': // Block padding-top
            $block_space_class = $is_block_space ? 'block-pt' : 'block-pt-0';
            break;
        case 'block_pb': // Block padding-bottom
            $block_space_class = $is_block_space ? 'block-pb' : 'block-pb-0';
            break;
        default:
            return $block_space_class;
    }
    return $block_space_class;
}



/**
 * Add Formats to TinyMCE
 * - https://developer.wordpress.org/reference/hooks/tiny_mce_before_init/
 * - https://codex.wordpress.org/Plugin_API/Filter_Reference/tiny_mce_before_init
 *
 * @param array $args - Arguments used to initialize the tinyMCE
 *
 * @return array $args  - Modified arguments
 */
function prefix_tinymce_toolbar($args ): array
{

    $args['fontsize_formats'] = "8px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 21px 22px 23px 24px 25px 26px 27px 28px 29px 30px 31px 32px 33px 34px 35px 36px 37px 38px 39px 40px 41px 42px 43px 44px 45px 46px 47px 48px 49px 50px 51px 52px 53px 54px 55px 56px 57px 58px 59px 60px 61px 62px 63px 64px 65px 66px 67px 68px 69px 70px 71px 72px 73px 74px 75px 76px 77px 78px 79px 80px 81px 82px 83px 84px 85px 86px 87px 88px 89px 90px 91px 92px 93px 94px 95px 96px 97px 98px 99px 100px";

    return $args;

}
add_filter( 'tiny_mce_before_init', 'prefix_tinymce_toolbar' );


function my_mce_buttons_2($buttons) {
    array_unshift($buttons, 'fontsizeselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2');
