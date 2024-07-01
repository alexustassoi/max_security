<?php

/**
 * Custom footer template
 *
 * @package WP-rock
 */

global $global_options;

$copyright          = get_field_value( $global_options, 'copyright' );
$copyright          = str_replace( '[year]', date( 'Y' ), $copyright );
$locations          = get_field_value( $global_options, 'locations' );
$lets_talk_link     = get_field_value( $global_options, 'lets_talk_link' );
$portal_log_in_link = get_field_value( $global_options, 'portal_log_in_link' );
$phone_link         = get_field_value( $global_options, 'phone_link' );
$phone              = get_field_value( $global_options, 'phone' );
$social_link        = get_field_value( $global_options, 'social_link' );
$social_links_title = get_field_value( $global_options, 'social_links_title' );
$footer_logo        = get_field_value( $global_options, 'footer_logo' );
$bottom_text        = get_field_value( $global_options, 'bottom_text' );
$subscribe_btn      = get_field_value( $global_options, 'subscribe_btn' );
?>

<footer id="site-footer" class="site-footer">
    <div class="custom-container">
        <div class="site-footer__container">
            <div class="site-footer__left">
                <a class="site-footer__logo" href="<?php echo get_site_url(); ?>">
					<?php if ( $footer_logo ) : ?>
                        <img src="<?php echo $footer_logo; ?>" alt="foter logo">
					<?php endif; ?>
                </a>

				<?php if ( $portal_log_in_link ) : ?>
                    <a class="site-footer__login mobile white-text-hover primary-btn" target="<?php echo $portal_log_in_link[ 'target' ]; ?>"
                       href="<?php echo $portal_log_in_link[ 'url' ]; ?>">
						<?php echo $portal_log_in_link[ 'title' ] ?>
                    </a>
				<?php endif; ?>
            </div>

            <div class="site-footer__locations">
				<?php if ( $locations ) : ?>
					<?php foreach ( $locations as $location ) : ?>
                        <div class="site-footer__locations-item">
                            <p class="site-footer__locations-country"><?php echo $location[ 'country' ]; ?></p>
                            <p class="site-footer__locations-city"><?php echo $location[ 'city' ]; ?></p>
                        </div>
					<?php endforeach; ?>
				<?php endif; ?>
            </div>

			<?php
			wp_nav_menu( [
				'menu'  => 'Footer menu 1',
				'echo'            => true,
				'container'       => 'div',
				'container_class' => 'site-footer__menu',
			] )
			?>
			<?php
			wp_nav_menu( [
				'menu'  => 'Footer menu 2',
				'echo'            => true,
				'container'       => 'div',
				'container_class' => 'site-footer__menu',
			] )
			?>

            <div class="site-footer__right">
                <div>
					<?php if ( $portal_log_in_link ) : ?>
                        <a class="site-footer__login white-text-hover primary-btn" target="<?php echo $portal_log_in_link[ 'target' ]; ?>"
                           href="<?php echo $portal_log_in_link[ 'url' ]; ?>">
							<?php echo $portal_log_in_link[ 'title' ] ?>
                        </a>
					<?php endif; ?>

					<?php if ( $social_links_title ) : ?>
                        <p class="site-footer__social-title"><?php echo $social_links_title; ?></p>
					<?php endif; ?>



					<?php if ( $lets_talk_link ) : ?>
                        <a class="site-footer__talk" target="<?php echo $lets_talk_link[ 'target' ]; ?>"
                           href="<?php echo $lets_talk_link[ 'url' ] ?>"><?php echo $lets_talk_link[ 'title' ]; ?></a>
					<?php endif;
					?>
                </div>

                <div class="site-footer__right-wrap">
					<?php
					if ( $subscribe_btn ) : ?>
                        <div class="site-footer__subscribe-btn-wrap">
                            <a class="site-footer__subscribe-btn white-text-hover primary-btn js-open-popup-activator"
                               href="<?php echo $subscribe_btn[ 'url' ] ?>"><?php echo $subscribe_btn[ 'title' ]; ?></a>
                        </div>
					<?php endif; ?>
					<?php if ( $social_link ) : ?>
                        <div class="site-footer__social-links">
							<?php foreach ( $social_link as $link ) : ?>
                                <a href="<?php echo $link[ 'link' ]; ?>"><img src="<?php echo $link[ 'icon' ]; ?>"
                                                                              alt="social icon"></a>
							<?php endforeach; ?>
                        </div>
					<?php endif;

					if ( $phone && $phone_link ) : ?>
                        <div class="site-footer__phone-mobile">
                            <a class="site-footer__phone" href="tel:<?php echo $phone_link; ?>"><?php echo $phone; ?></a>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ( $phone && $phone_link ) : ?>
                    <a class="site-footer__phone" href="tel:<?php echo $phone_link; ?>">
                        <?php echo $phone; ?>
                    </a>
				<?php endif; ?>
            </div>
        </div>

        <div class="site-footer__bottom">
			<?php if ( $copyright ) : ?>
                <p class="site-footer__copyright"><?php echo $copyright ?></p>
			<?php endif; ?>

			<?php if ( $bottom_text ) : ?>
                <p class="site-footer__bottom-text"><?php echo $bottom_text; ?></p>
			<?php endif; ?>
        </div>

    </div>
    <svg width="0" height="0" style="position:absolute;">
        <defs>
            <clipPath id="svg-clip-desktop">
                <path
                        d="M334 167C334 277.055 295.74 334 167 334C38.2602 334 0 277.055 0 167C0 56.9447 38.2602 0 167 0C295.74 0 334 56.9447 334 167Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-tablet">
                <path
                        d="M300 150C300 248.852 265.635 300 150 300C34.3654 300 0 248.852 0 150C0 51.1479 34.3654 0 150 0C265.635 0 300 51.1479 300 150Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-mob">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M77.5 156.281C137.229 156.281 155 129.636 155 78.1405C155 26.645 137.229 0 77.5 0C17.7705 0 0 26.645 0 78.1405C0 129.636 17.7705 156.281 77.5 156.281Z"/>
            </clipPath>
            <clipPath id="svg-clip-332">
                <path
                        d="M332 166C332 275.396 293.969 332 166 332C38.031 332 0 275.396 0 166C0 56.6037 38.031 0 166 0C293.969 0 332 56.6037 332 166Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-320">
                <path
                        d="M320 160C320 265.442 283.344 320 160 320C36.6564 320 0 265.442 0 160C0 54.5578 36.6564 0 160 0C283.344 0 320 54.5578 320 160Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-270">
                <path
                        d="M270 135C270 223.967 239.071 270 135 270C30.9289 270 0 223.967 0 135C0 46.0332 30.9289 0 135 0C239.071 0 270 46.0332 270 135Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-250">
                <path
                        d="M250 125C250 207.377 221.362 250 125 250C28.6378 250 0 207.377 0 125C0 42.6233 28.6378 0 125 0C221.362 0 250 42.6233 250 125Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-247">
                <path
                        d="M247 123.5C247 204.888 218.706 247 123.5 247C28.2942 247 0 204.888 0 123.5C0 42.1118 28.2942 0 123.5 0C218.706 0 247 42.1118 247 123.5Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-238">
                <path
                        d="M238 119C238 197.423 210.737 238 119 238C27.2632 238 0 197.423 0 119C0 40.5774 27.2632 0 119 0C210.737 0 238 40.5774 238 119Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-236">
                <path
                        d="M236 118C236 195.764 208.966 236 118 236C27.0341 236 0 195.764 0 118C0 40.2364 27.0341 0 118 0C208.966 0 236 40.2364 236 118Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-232">
                <path
                        d="M232 116C232 192.446 205.424 232 116 232C26.5759 232 0 192.446 0 116C0 39.5544 26.5759 0 116 0C205.424 0 232 39.5544 232 116Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-230">
                <path
                        d="M230 115C230 190.787 203.653 230 115 230C26.3468 230 0 190.787 0 115C0 39.2134 26.3468 0 115 0C203.653 0 230 39.2134 230 115Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-223">
                <path
                        d="M223 111.5C223 184.98 197.455 223 111.5 223C25.545 223 0 184.98 0 111.5C0 38.02 25.545 0 111.5 0C197.455 0 223 38.02 223 111.5Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-219">
                <path
                        d="M219 109.5C219 181.662 193.913 219 109.5 219C25.0867 219 0 181.662 0 109.5C0 37.338 25.0867 0 109.5 0C193.913 0 219 37.338 219 109.5Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-210">
                <path
                        d="M210 105C210 174.196 185.944 210 105 210C24.0558 210 0 174.196 0 105C0 35.8036 24.0558 0 105 0C185.944 0 210 35.8036 210 105Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-207">
                <path
                        d="M207 103.5C207 171.708 183.288 207 103.5 207C23.7121 207 0 171.708 0 103.5C0 35.2921 23.7121 0 103.5 0C183.288 0 207 35.2921 207 103.5Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-204">
                <path
                        d="M204 102C204 169.219 180.632 204 102 204C23.3685 204 0 169.219 0 102C0 34.7806 23.3685 0 102 0C180.632 0 204 34.7806 204 102Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-200">
                <path
                        d="M200 100C200 165.901 177.09 200 100 200C22.9103 200 0 165.901 0 100C0 34.0986 22.9103 0 100 0C177.09 0 200 34.0986 200 100Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-180">
                <path
                        d="M180 90C180 149.311 159.381 180 90 180C20.6192 180 0 149.311 0 90C0 30.6888 20.6192 0 90 0C159.381 0 180 30.6888 180 90Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-171">
                <path
                        d="M170 85C170 141.016 150.526 170 85 170C19.4737 170 0 141.016 0 85C0 28.9838 19.4737 0 85 0C150.526 0 170 28.9838 170 85Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-168">
                <path
                        d="M168 84C168 139.357 148.755 168 84 168C19.2446 168 0 139.357 0 84C0 28.6429 19.2446 0 84 0C148.755 0 168 28.6429 168 84Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-161">
                <path
                        d="M161 80.5C161 133.551 142.557 161 80.5 161C18.4428 161 0 133.551 0 80.5C0 27.4494 18.4428 0 80.5 0C142.557 0 161 27.4494 161 80.5Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-155">
                <path
                        d="M154.006 77.5C154.006 128.574 136.365 155 77.0032 155C17.6416 155 0 128.574 0 77.5C0 26.4264 17.6416 0 77.0032 0C136.365 0 154.006 26.4264 154.006 77.5Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-120">
                <path
                        d="M120 60C120 99.5408 106.254 120 60 120C13.7462 120 0 99.5408 0 60C0 20.4592 13.7462 0 60 0C106.254 0 120 20.4592 120 60Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-112">
                <path
                        d="M112 56C112 92.9048 99.1703 112 56 112C12.8298 112 0 92.9048 0 56C0 19.0952 12.8298 0 56 0C99.1703 0 112 19.0952 112 56Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-94">
                <path
                        d="M94 47C94 77.9736 83.2322 94 47 94C10.7678 94 0 77.9736 0 47C0 16.0264 10.7678 0 47 0C83.2322 0 94 16.0264 94 47Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-86">
                <path
                        d="M86 43C86 71.3376 76.1486 86 43 86C9.85142 86 0 71.3376 0 43C0 14.6624 9.85142 0 43 0C76.1486 0 86 14.6624 86 43Z"
                        fill="#7E97A6"/>
            </clipPath>
            <clipPath id="svg-clip-87">
                <path class="cls-1"
                      d="M877.56,724.41c233.95,0,303.49-103.49,303.49-303.49s-69.54-303.49-303.49-303.49H138.07v606.98h739.49Z"/>
            </clipPath>
        </defs>
    </svg>
</footer>
