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

function add_dynamic_fields_to_email($contact_form) {
    // Получаем ID формы
    $form_id = $contact_form->id();


    $submission = WPCF7_Submission::get_instance();

    // Проверяем, были ли данные отправлены
    if ($submission) {
        $posted_data = $submission->get_posted_data();

        // Добавляем динамические поля в сообщение
        $additional_fields = '';

         // Перебираем данные формы
         foreach ($posted_data as $key => $value) {
            // Пропускаем поля, которые не являются динамическими
            if (preg_match('/^dyn_field_/', $key)) {
                // Добавляем динамические поля в массив posted_data
                $posted_data[$key] = $value;
            }
        }
        // Добавляем динамические поля в сообщение формы
        $mail = $contact_form->prop('mail');

        $contact_form->set_properties(array('mail' => $mail));
    }
}
