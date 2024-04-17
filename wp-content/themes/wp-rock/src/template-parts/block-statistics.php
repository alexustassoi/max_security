<?php
/**
 * Block - Statistics.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$fields        = get_fields();
$item_repeater = get_field_value($fields, 'item_repeater');

?>

<section id="statistics" class="statistics">
    <div class="container statistics__container">
        <?php
        if ($item_repeater) { ?>
            <div class="statistics__items">
                <?php foreach ($item_repeater as $item) {
                    $number = get_field_value($item, 'number');
                    $text   = get_field_value($item, 'text');
                    ?>
                    <div class="statistics__item">
                        <?php
                        if (!empty($number)) { ?>
                            <div class="statistics__number"><?php echo esc_html($number); ?></div>
                        <?php }

                        if (!empty($text)) { ?>
                            <div class="statistics__text"><?php echo do_shortcode($text); ?></div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php }
        ?>
    </div>
</section>
