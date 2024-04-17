<?php
/**
 * Block - Note.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields        = get_fields();
$title         = get_field_value($fields, 'title');
$note_text     = get_field_value($fields, 'note_text');
$author_name   = get_field_value($fields, 'author_name');
$author_status = get_field_value($fields, 'author_status');
$author_img    = get_field_value($fields, 'author_img');

?>

<section id="note" class="note">
    <div class="container note__container">
        <div class="note__content">
            <?php
            echo ($title)
                ? '<h3 class="note__title">' . do_shortcode($title) . '</h3>'
                : '';
            ?>
            <div class="note__wrapper">
                <?php
                echo ($author_img)
                    ? '<img width="452" height="534" class="note__author-img" src="' . do_shortcode($author_img) . '" alt="Author">'
                    : '';
                ?>
                <div class="note__info">
                    <?php
                    echo ($note_text)
                        ? '<p class="note__text">' . do_shortcode($note_text) . '</p>'
                        : '';

                    echo ($author_name)
                        ? '<p class="note__author-name">' . do_shortcode($author_name) . '</p>'
                        : '';

                    echo ($author_status)
                        ? '<p class="note__author-status">' . do_shortcode($author_status) . '</p>'
                        : '';
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
