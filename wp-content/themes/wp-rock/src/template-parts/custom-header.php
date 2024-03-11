<?php
/**
 * Custom header template
 *
 * @package WP-rock
 */

global $global_options;

$header_logo = get_field_value( $global_options, 'header_logo' );
$max_words = get_field_value( $global_options, 'max_words' );

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

        <button data-role="open-menu" class="site-header__hamburger">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M3 6H21M3 12H21M3 18H21" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>

    </div>

    <?php if($max_words): ?>
        <div class="site-header__max-words js-header-max-words js-max-words">
            <div class="custom-container site-header__max-words-wrap">
                <?php
                foreach ($max_words as $item):
                    $icon = $item['icon'];
                    $title = $item['title'];
                    $color = $item['background_color'];
                    $description = $item['description'];
                    $link = $item['link'];
                ?>

                <a href="<?php echo $link; ?>" class="services__item" style="background-color: <?php echo $color; ?>">
                    <figure class="services__item-icon">
                        <?php if($icon): ?>
                            <img  src="<?php echo $icon; ?>" alt="service icon">
                        <?php endif; ?>
                    </figure>

                    <?php if($title): ?>
                        <p class="services__item-title"><?php echo $title; ?></p>
                    <?php endif; ?>

                    <?php if($description): ?>
                        <p class="services__item-desc"><?php echo $description; ?></p>
                    <?php endif; ?>

                    <button class="services__item-button">
                        <span> <?php echo __('EXPLORE', 'wp-rock'); ?></span>
                    </button>
                </a>

                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

</header>
