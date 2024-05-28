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


