<?php

/**
 * Block - Select category.
 *
 * @package WP-rock
 * @since   4.4.0
 */

global $global_options;

$class_name        = isset($args['className']) ? ' ' . $args['className'] : '';
$main_tags_colours = get_field_value($global_options, 'main_tags_colours');
$fields            = get_fields();
$tag_term_id       = get_field_value($fields, 'select_tag');
$tag_term_color    = '';

if (is_array($main_tags_colours) && !empty($main_tags_colours)) :
    foreach ($main_tags_colours as $item):
        $option_tag_id = get_field_value($item, 'title');

        if ($option_tag_id === $tag_term_id) :
            $tag_term_color = get_field_value($item, 'tag_term_color');
        endif; ?>
    <?php endforeach;
endif;
?>

<div class="select-tag <?php echo $class_name; ?>"
     style="background-color: <?php echo do_shortcode($tag_term_color); ?>">
    <div class="select-tag__inner">
        <div class="custom-container">
            <?php
            if ($tag_term_id) :
                $tag = get_term($tag_term_id);
                $tag_icon_url = get_field('card_icon', 'resource_tag_' . $tag_term_id);
                $tag_term_name = $tag->name;
                ?>
                <div class="select-tag__tag-info">
                    <figure class="select-tag__tag-icon-wrap">
                        <img width="48" height="48" src="<?php echo esc_html($tag_icon_url); ?>" alt="Icon"/>
                    </figure>
                    <p class="select-tag__tag-name"><?php echo do_shortcode($tag_term_name); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<script>
    (function(){
        const selectTag = document.querySelector('#main-wrapper .select-tag');
        const siteHeader = document.querySelector('.js-site-header');

        if (selectTag.parentElement.firstElementChild === selectTag) {
            document.body.classList.add('single-resources');
            siteHeader && siteHeader.classList.add('added-scroll-header');
        }
    })()
</script>