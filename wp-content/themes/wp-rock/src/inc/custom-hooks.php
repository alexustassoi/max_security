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

