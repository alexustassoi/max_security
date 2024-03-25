<?php
/**
 * Custom footer template
 *
 * @package WP-rock
 */

global $global_options;

$copyright = get_field_value( $global_options, 'copyright' );
$copyright = str_replace('[year]', date('Y'), $copyright);
$locations = get_field_value( $global_options, 'locations' );
$lets_talk_link = get_field_value( $global_options, 'lets_talk_link' );
$portal_log_in_link = get_field_value( $global_options, 'portal_log_in_link' );
$phone_link = get_field_value( $global_options, 'phone_link' );
$phone = get_field_value( $global_options, 'phone' );
$social_link = get_field_value( $global_options, 'social_link' );
$social_links_title = get_field_value( $global_options, 'social_links_title' );
$footer_logo = get_field_value( $global_options, 'footer_logo' );
$bottom_text = get_field_value( $global_options, 'bottom_text' );
?>

<footer id="site-footer" class="site-footer">
    <div class="custom-container">
        <div class="site-footer__container">
            <div class="site-footer__left">
                <a class="site-footer__logo" href="<?php echo get_site_url(); ?>">
                    <?php if($footer_logo): ?>
                        <img src="<?php echo $footer_logo; ?>" alt="foter logo">
                    <?php endif; ?>
                </a>

                <?php if($portal_log_in_link): ?>
                    <a class="site-footer__login mobile" target="<?php echo $portal_log_in_link['target']; ?>" href="<?php echo $portal_log_in_link['url']; ?>">
                        <?php echo $portal_log_in_link['title'] ?>
                    </a>
                <?php endif; ?>
            </div>

            <?php if($phone && $phone_link): ?>
            <div class="site-footer__phone-mobile">
                <a class="site-footer__phone" href="tel:<?php echo $phone_link; ?>"><?php echo $phone; ?></a>
            </div>
            <?php endif; ?>

            <div class="site-footer__locations">
                <?php if($locations): ?>
                    <?php foreach ($locations as $location): ?>
                        <div class="site-footer__locations-item">
                            <p class="site-footer__locations-country"><?php echo $location['country']; ?></p>
                            <p class="site-footer__locations-city"><?php echo $location['city']; ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php if($phone && $phone_link): ?>
                    <a class="site-footer__phone" href="tel:<?php echo $phone_link; ?>"><?php echo $phone; ?></a>
                <?php endif; ?>
            </div>

            <?php
            wp_nav_menu([
                'theme_location' => 'footer_menu',
                'echo' => true,
                'container' => 'div',
                'container_class' => 'site-footer__menu',
            ])
            ?>

            <div class="site-footer__right">
                <?php if($portal_log_in_link): ?>
                    <a class="site-footer__login" target="<?php echo $portal_log_in_link['target']; ?>" href="<?php echo $portal_log_in_link['url']; ?>">
                        <?php echo $portal_log_in_link['title'] ?>
                    </a>
                <?php endif; ?>

                <?php if($social_links_title): ?>
                    <p class="site-footer__social-title"><?php echo $social_links_title; ?></p>
                <?php endif; ?>

                <?php if($social_link): ?>
                    <div class="site-footer__social-links">
                        <?php foreach ($social_link as $link): ?>
                            <a href="<?php echo $link['link']; ?>"><img src="<?php echo $link['icon']; ?>" alt="social icon"></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if($lets_talk_link): ?>
                    <a class="site-footer__talk" target="<?php echo $lets_talk_link['target']; ?>" href="<?php echo $lets_talk_link['url'] ?>"><?php echo $lets_talk_link['title']; ?></a>
                <?php endif; ?>
            </div>
        </div>

        <div class="site-footer__bottom">
            <?php if($copyright): ?>
                <p class="site-footer__copyright"><?php echo $copyright ?></p>
            <?php endif; ?>

            <?php if($bottom_text): ?>
                <p class="site-footer__bottom-text"><?php echo $bottom_text; ?></p>
            <?php endif; ?>
        </div>

    </div>
    <svg width="0" height="0" style="position:absolute;">
        <defs>
            <clipPath id="svg-clip-desktop">
                <path d="M334 167C334 277.055 295.74 334 167 334C38.2602 334 0 277.055 0 167C0 56.9447 38.2602 0 167 0C295.74 0 334 56.9447 334 167Z" fill="#7E97A6" />
            </clipPath>
            <clipPath id="svg-clip-tablet">
                <path d="M300 150C300 248.852 265.635 300 150 300C34.3654 300 0 248.852 0 150C0 51.1479 34.3654 0 150 0C265.635 0 300 51.1479 300 150Z" fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-mob">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M77.5 156.281C137.229 156.281 155 129.636 155 78.1405C155 26.645 137.229 0 77.5 0C17.7705 0 0 26.645 0 78.1405C0 129.636 17.7705 156.281 77.5 156.281Z" />
            </clipPath>
        </defs>
    </svg>
</footer>
