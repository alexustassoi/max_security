<?php
/**
 * Template "Gutenberg page".
 *
 * @package WordPress
 */

get_header();

do_action('wp_rock_before_page_content');

if (have_posts()) :
    // Start the loop.
    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
endif;

do_action('wp_rock_after_page_content');

get_footer(); ?>


