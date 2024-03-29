<?php
/**
 * Block - LET’S TALK.
 *
 * @package WP-rock
 * @since   4.4.0
 */

$class_name = isset($args['className']) ? ' ' . $args['className'] : '';
$fields     = get_fields();
$title      = get_field_value($fields, 'title');


?>

<div class="lets-talk  <?php echo esc_html($class_name); ?>" id="<?php echo $args['id']; ?>">
    <div class="custom-container">

    </div>
</div>
