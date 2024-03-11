<?php
/**
 * Custom header template
 *
 * @package WP-rock
 */

global $global_options;

$header_logo = get_field_value( $global_options, 'header_logo' );

?>

<header id="site-header" class="site-header js-site-header">
    <div class="custom-container site-header__container">
        <a class="site-header__logo" href="<?php echo get_site_url(); ?>">
            <?php if($header_logo): ?>
                <img src="<?php echo $header_logo; ?>" alt="header logo">
            <?php endif; ?>
        </a>

        <?php
            wp_nav_menu([
            'theme_location' => 'primary_menu',
            'echo' => true,
            'container' => 'nav',
            'container_class' => 'site-header__menu',
            ])
        ?>

        <?php if(is_user_logged_in()): ?>
            <button class="site-header__login"><?php echo __('LOG OUT', 'wp-rock'); ?></button>
        <?php else: ?>
            <button class="site-header__login"><?php echo __('LOG IN', 'wp-rock'); ?></button>
        <?php endif; ?>

    </div>
</header>
