<?php
/**
 * Block - Clients.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields     = get_fields();
$title      = get_field_value($fields, 'title');
$subtitle   = get_field_value($fields, 'subtitle');
$clients    = get_field_value($fields, 'clients');

?>

<div class="clients  <?php echo esc_html($class_name); ?>" id="<?php echo $args['id']; ?>">
    <div class="custom-container">
        <?php if ($title): ?>
            <h2 class="clients__title"><?php echo $title; ?></h2>
        <?php endif; ?>
    </div>

    <?php if ($clients): ?>
        <div class="clients__wrap">

        </div>
    <?php endif; ?>
</div>
