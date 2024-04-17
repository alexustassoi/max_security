<?php
/**
 * Block - intelligence-portal tabs.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields = get_fields();
$title = get_field_value($fields, 'title');
$item_repeater = get_field_value($fields, 'item_repeater');

?>

<section id="intelligence-portal-tabs" class="intelligence-portal-tabs">
    <div class="container intelligence-portal-tabs__container">
        <div class="intelligence-h__menu-wrap"></div>
        <div class="intelligence-portal-tabs__content">
            <?php
            echo ($title)
            ? '<h3 class="intelligence-portal-tabs__title">' . do_shortcode($title) . '</h3>'
            : '';
            
            if ($item_repeater) { ?>
                <div class="intelligence-portal-tabs__wrap">
                    <ul class="intelligence-portal-tabs__items">
                        <?php foreach ($item_repeater as $key => $item) {
                            $item_name = get_field_value($item, 'item_name');
                            $active = ($key == 0) ? ' active' : '';
                            ?>
                            <li class="intelligence-portal-tabs__item-name">
                                <a href="#<?php echo sanitize_title($item_name); ?>" class="intelligence-portal-tabs__item-link js-intelligence-portal-link<?php echo $active; ?>">
                                    <?php echo do_shortcode($item_name); ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    <?php foreach ($item_repeater as $key => $item) {
                        $item_name = get_field_value($item, 'item_name');
                        $item_content = get_field_value($item, 'item_content');
                        $active = ($key == 0) ? ' active' : '';
                        ?>
                            <?php if ($item_content) { ?>
                                <div id="<?php echo sanitize_title($item_name); ?>" class="intelligence-portal-tabs__item-content js-intelligence-portal-content<?php echo $active; ?>">
                                    <?php foreach ($item_content as $elem) { 
                                        $image = get_field_value($elem, 'image');
                                        $title = get_field_value($elem, 'title');
                                        $text = get_field_value($elem, 'text');
                                        ?>
                                        <div class="intelligence-portal-tabs__elem">
                                            <img src="<?php echo esc_url($image); ?>" 
                                                class="intelligence-portal-tabs__elem-image" />
                                            <h4 class="intelligence-portal-tabs__elem-title">
                                                <?php echo do_shortcode($title); ?>
                                            </h4>
                                            <div class="intelligence-portal-tabs__elem-text">
                                                <?php echo do_shortcode($text); ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        
                    <?php } ?>
                </div>
            <?php }
            ?>
        </div>
    </div>
</section>
