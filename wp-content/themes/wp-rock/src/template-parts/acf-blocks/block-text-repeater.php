<?php

/**
 * Block - Text repeater.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields = get_fields();
$title = get_field_value($fields, 'title');
$text_repeater = get_field_value($fields, 'text_repeater');
$bg_color = get_field_value($fields, 'colors_select');
$bg_color = !empty($bg_color) ? $bg_color : '#5A7153';

?>
<div class="text-repeater" style="background-color: <?php echo $bg_color; ?>">
    <div class="custom-container">
        <?php
        if (!empty($title)) {
            echo '<h4 class="text-repeater__title">' . do_shortcode($title) . '</h4>';
        }

        echo '<div class="text-repeater__inner">';

        if (!empty($text_repeater)) {
            foreach ($text_repeater as $item) {

                echo '<div class="text-repeater__item js-benefts-item">
                            <h5 class="text-repeater__item-title js-benefts-title">
                            <svg class="text-repeater__item-title-icon default" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <g clip-path="url(#clip0_202_7443)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7896 4.39996V4.39229C11.7357 4.39229 11.682 4.39485 11.6286 4.39996C11.3108 4.43035 11.0031 4.55085 10.742 4.75835C10.6907 4.79911 10.6411 4.84321 10.5937 4.89066C9.92681 5.55755 9.92681 6.62296 10.5937 7.28985L12.6097 9.30596H4.8062C3.86334 9.30596 3.11215 10.0648 3.11215 11C3.11215 11.9352 3.87101 12.694 4.8062 12.694H12.6097L10.5937 14.7101C9.92681 15.377 9.92681 16.4424 10.5937 17.1093C11.2606 17.7762 12.3261 17.7762 12.993 17.1093L18.7498 11.3526C18.9415 11.1609 18.9415 10.8467 18.7498 10.6551L12.993 4.89833C12.6634 4.56872 12.2265 4.39996 11.7896 4.39996ZM9.85293 13.9694C9.85292 13.9694 9.85294 13.9694 9.85293 13.9694L10.0806 13.7417H4.8062C3.29243 13.7417 2.06453 12.5138 2.06453 11C2.06453 9.48932 3.28168 8.25835 4.8062 8.25835H10.0806L9.85293 8.03063C8.77691 6.95462 8.77691 5.22589 9.85293 4.14987C10.3824 3.62041 11.0796 3.34467 11.7896 3.34467H12.8372V3.5596C13.1644 3.69425 13.4703 3.89404 13.7338 4.15755L19.4906 9.91431C20.0914 10.5151 20.0914 11.4926 19.4906 12.0934L13.7338 17.8501C12.6578 18.9261 10.929 18.9261 9.85293 17.8501C8.77691 16.7741 8.77692 15.0454 9.85293 13.9694ZM18.5114 3.09294C16.9637 1.674 14.548 1.04762 11 1.04762C7.45197 1.04762 5.03627 1.674 3.48863 3.09294C1.96092 4.49362 1.04762 6.88516 1.04762 11C1.04762 15.1148 1.96092 17.5064 3.48863 18.9071C5.03627 20.326 7.45197 20.9524 11 20.9524C14.548 20.9524 16.9637 20.326 18.5114 18.9071C20.0391 17.5064 20.9524 15.1148 20.9524 11C20.9524 6.88516 20.0391 4.49362 18.5114 3.09294ZM22 11C22 2.52201 18.2516 0 11 0C3.74842 0 0 2.52201 0 11C0 19.478 3.74842 22 11 22C18.2516 22 22 19.478 22 11Z" fill="#CC7510"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_202_7443">
                                            <rect width="22" height="22" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            <svg class="text-repeater__item-title-icon active" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_10_1641)">
                                    <path d="M22 11.0001C22 18.2517 19.4781 22 11 22C2.52194 22 0 18.2517 0 11.0001C0 3.74851 2.52194 0 11 0C19.4781 0 22 3.74851 22 11.0001ZM17.6077 11.7895C17.6077 11.3525 17.439 10.9234 17.1094 10.5938C16.4425 9.9269 15.377 9.9269 14.7101 10.5938L12.694 12.6097V4.8063C12.694 3.86344 11.9352 3.11225 11 3.11225C10.0648 3.11225 9.30586 3.8711 9.30586 4.8063V12.6097L7.28992 10.5938C6.62302 9.9269 5.55751 9.9269 4.8906 10.5938C4.2237 11.2607 4.2237 12.3261 4.8906 12.993C7.01395 15.1164 8.70028 16.8028 10.6473 18.7498C10.839 18.9415 11.1533 18.9415 11.3449 18.7498L17.1017 12.993C17.4313 12.6634 17.6 12.2264 17.6 11.7895H17.6077Z" fill="#CC7510"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_10_1641">
                                    <rect width="22" height="22" fill="white"/>
                                    </clipPath>
                                    </defs>
                                </svg>

                            ' . do_shortcode($item['title']) . '</h5>
                            <p class="text-repeater__item-description js-benefts-content">
                                ' . do_shortcode($item['content']) . '
                            </p>
                        </div>';
            }
        }

        echo '</div>';
        ?>
    </div>
</div>
