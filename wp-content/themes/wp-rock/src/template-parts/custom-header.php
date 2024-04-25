<?php

/**
 * Custom header template
 *
 * @package WP-rock
 */

global $global_options;

$header_logo = get_field_value($global_options, 'header_logo');
$max_words = get_field_value($global_options, 'max_words');
$lets_talk_link = get_field_value($global_options, 'lets_talk_link');
$login_link = get_field_value($global_options, 'login_link');
$page_to_redirect = get_field_value($global_options, 'page_to_redirect');
$page_link = !empty($page_to_redirect) ? get_permalink($page_to_redirect) : '';
?>

<header id="site-header" class="site-header js-site-header" data-redirect_to="<?php echo $page_link; ?>">
    <div class="custom-container site-header__container">
        <a class="site-header__logo" href="<?php echo get_site_url(); ?>">
            <?php if ($header_logo) : ?>
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

        <?php if (isset($login_link['url']) && isset($login_link['title'])) : ?>
            <a href="<?php echo $login_link['url']; ?>" class="site-header__login">
                <?php echo $login_link['title']; ?>
            </a>
        <?php endif; ?>

        <button class="site-header__hamburger js-open-mobile-menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M3 6H21M3 12H21M3 18H21" stroke="white" stroke-width="2.5" stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
        </button>

    </div>
    <?php if ($max_words) : ?>
        <div class="site-header__max-words js-header-max-words js-max-words">
            <div class="custom-container site-header__max-words-wrap">
                <?php
                foreach ($max_words as $item) :
                    $icon = $item['icon'];
                    $title = $item['title'];
                    $color = $item['background_color'];
                    $description = $item['description'];
                    $link = $item['link'];
                    ?>
                    <div class="services__item-wrapper">
                        <a href="<?php echo $link; ?>" class="services__item"
                           style="background-color: <?php echo $color; ?>">
                            <figure class="services__item-icon">
                                <?php if ($icon) : ?>
                                    <img src="<?php echo $icon; ?>" alt="service icon">
                                <?php endif; ?>
                            </figure>

                            <?php if ($title) : ?>
                                <p class="services__item-title"><?php echo $title; ?></p>
                            <?php endif; ?>

                            <?php if ($description) : ?>
                                <p class="services__item-desc"><?php echo $description; ?></p>
                            <?php endif; ?>

                            <button class="services__item-button">
                                <span> <?php echo __('EXPLORE', 'wp-rock'); ?></span>
                            </button>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</header>


<div class="mobile-menu js-mobile-menu">
    <div class="mobile-menu__header">
        <a class="mobile-menu__logo" href="<?php echo get_site_url(); ?>">
            <?php if ($header_logo) : ?>
                <img src="<?php echo $header_logo; ?>" alt="header logo">
            <?php endif; ?>
        </a>

        <button class="mobile-menu__close js-close-menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M18.3002 5.71022C18.2077 5.61752 18.0978 5.54397 17.9768 5.49379C17.8559 5.44361 17.7262 5.41778 17.5952 5.41778C17.4643 5.41778 17.3346 5.44361 17.2136 5.49379C17.0926 5.54397 16.9827 5.61752 16.8902 5.71022L12.0002 10.5902L7.11022 5.70022C7.01764 5.60764 6.90773 5.5342 6.78677 5.4841C6.6658 5.43399 6.53615 5.4082 6.40522 5.4082C6.27429 5.4082 6.14464 5.43399 6.02368 5.4841C5.90272 5.5342 5.79281 5.60764 5.70022 5.70022C5.60764 5.79281 5.5342 5.90272 5.4841 6.02368C5.43399 6.14464 5.4082 6.27429 5.4082 6.40522C5.4082 6.53615 5.43399 6.6658 5.4841 6.78677C5.5342 6.90773 5.60764 7.01764 5.70022 7.11022L10.5902 12.0002L5.70022 16.8902C5.60764 16.9828 5.5342 17.0927 5.4841 17.2137C5.43399 17.3346 5.4082 17.4643 5.4082 17.5952C5.4082 17.7262 5.43399 17.8558 5.4841 17.9768C5.5342 18.0977 5.60764 18.2076 5.70022 18.3002C5.79281 18.3928 5.90272 18.4662 6.02368 18.5163C6.14464 18.5665 6.27429 18.5922 6.40522 18.5922C6.53615 18.5922 6.6658 18.5665 6.78677 18.5163C6.90773 18.4662 7.01764 18.3928 7.11022 18.3002L12.0002 13.4102L16.8902 18.3002C16.9828 18.3928 17.0927 18.4662 17.2137 18.5163C17.3346 18.5665 17.4643 18.5922 17.5952 18.5922C17.7262 18.5922 17.8558 18.5665 17.9768 18.5163C18.0977 18.4662 18.2076 18.3928 18.3002 18.3002C18.3928 18.2076 18.4662 18.0977 18.5163 17.9768C18.5665 17.8558 18.5922 17.7262 18.5922 17.5952C18.5922 17.4643 18.5665 17.3346 18.5163 17.2137C18.4662 17.0927 18.3928 16.9828 18.3002 16.8902L13.4102 12.0002L18.3002 7.11022C18.6802 6.73022 18.6802 6.09022 18.3002 5.71022Z"
                      fill="#F3F0EC"/>
            </svg>
        </button>
    </div>

    <?php
    wp_nav_menu([
        'theme_location' => 'mobile_menu',
        'echo' => true,
        'container' => 'nav',
        'container_class' => 'mobile-menu__menu',
    ])
    ?>

    <p>
        <?php if ($lets_talk_link) : ?>
            <a class="mobile-menu__talk" target="<?php echo $lets_talk_link['target']; ?>"
               href="<?php echo $lets_talk_link['url'] ?>"><?php echo $lets_talk_link['title']; ?></a>
        <?php endif; ?>
    </p>

    <p>
        <?php // if (is_user_logged_in()) : ?>
<!--            <button class="mobile-menu__login">--><?php //echo __('LOG OUT', 'wp-rock'); ?><!--</button>-->
        <?php //else : ?>
            <button class="mobile-menu__login"><?php echo __('LOG IN', 'wp-rock'); ?></button>
        <?php //endif; ?>
    </p>

</div>
