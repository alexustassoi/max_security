<?php


    $warning_class = new Get_Warnings();
    $warnings = $warning_class->get_custom_warning(null, true);

    $ID = get_field_value($args, 'ID');
    $next_prev = get_prev_next_ids($warnings, $ID);
    $next = get_field_value($next_prev,'next');
    $prev = get_field_value($next_prev,'prev');

    $type = get_field_value($args, 'type');
    $affected_area = get_field_value($args, 'affected_area');
    $incident_type = get_field_value($args, 'incident_type');
    $incident_risk_level = get_field_value($args, 'incident_risk_level');
    $strength_of_source = get_field_value($args, 'strength_of_source');
    $country_risk_level = get_field_value($args, 'country_risk_level');
    $map_image          = get_field_value($args, 'map_image');
    $title              = get_field_value($args, 'title');

    $type_color = 'green';
    $incident_risk_color = 'green';

    if ($incident_risk_level === 'Medium') {
        $incident_risk_color = 'blue';
    }

    if ($incident_risk_level === 'High') {
        $incident_risk_color = 'red';
    }

    if ($type === 'Alert') {
        $type_color = 'red';
    }

    if ($type === 'Tactical') {
        $type_color = 'blue';
    }

    $date_string = get_field_value($args, 'publish_date');

    if (!empty($date_string)) {
        // DateTime
        $date = new DateTime($date_string);
        $day = $date->format('d');
        $month_year = $date->format('M Y');
        $time_utc = $date->format('H:i') . ' UTC';
    }

    $sections = get_field_value($args, 'sections');

?>

<div class="request-demo__wrapper">

    <?php if ($next): ?>
    <button class="request-demo__next" data-id="<?php echo $next; ?>"
            data-role="load-content-demo-popup">
        <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M42.9674 7.1076C39.3559 3.79731 33.7295 2.346 25.5 2.346C17.2705 2.346 11.6441 3.79731 8.03264 7.1076C4.46596 10.3769 2.346 15.949 2.346 25.5C2.346 35.051 4.46596 40.6231 8.03264 43.8924C11.6441 47.2027 17.2705 48.654 25.5 48.654C33.7295 48.654 39.3559 47.2027 42.9674 43.8924C46.534 40.6231 48.654 35.051 48.654 25.5C48.654 15.949 46.534 10.3769 42.9674 7.1076ZM51 25.5C51 5.84182 42.3068 0 25.5 0C8.69318 0 0 5.84182 0 25.5C0 45.1582 8.69318 51 25.5 51C42.3068 51 51 45.1582 51 25.5Z" fill="#CC7510"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M27.334 10.1923V10.1844C27.2509 10.1844 27.1679 10.187 27.0849 10.1923C26.3444 10.2395 25.6143 10.497 24.988 10.9616C24.8362 11.0742 24.6905 11.199 24.5522 11.3359C23.0145 12.8736 23.0145 15.3539 24.5522 16.8993L29.2195 21.5666H11.1299C8.95084 21.5666 7.19677 23.321 7.19677 25.5001C7.19677 27.6792 8.95084 29.4331 11.1299 29.4331L29.2195 29.4331L24.5522 34.1004C23.0145 35.6382 23.0145 38.1261 24.5522 39.6638C26.0899 41.2016 28.5704 41.2016 30.1159 39.6638L43.4686 26.3113C43.9167 25.8631 43.9167 25.1446 43.4686 24.6964L30.1159 11.3435C29.3432 10.5707 28.3385 10.1923 27.334 10.1923ZM28.4596 38.0024C28.4601 38.0019 28.4607 38.0013 28.4612 38.0008L40.9583 25.5038L28.457 13.0023C28.457 13.0023 28.457 13.0023 28.457 13.0023C28.1451 12.6904 27.7464 12.5383 27.334 12.5383H27.176C26.8293 12.5732 26.4869 12.7236 26.207 12.9989C25.5924 13.6179 25.5872 14.6116 26.2134 15.2428C26.214 15.2434 26.2146 15.244 26.2152 15.2446L34.8832 23.9126L11.1299 23.9126C10.2467 23.9126 9.54277 24.6164 9.54277 25.5001C9.54277 26.3834 10.2464 27.0871 11.1299 27.0871L34.8832 27.0871L26.2111 35.7593C25.5895 36.3809 25.5895 37.3834 26.2111 38.005C26.8298 38.6237 27.827 38.6302 28.4596 38.0024Z" fill="#CC7510"/>
        </svg>
    </button>
    <?php endif; ?>

	<?php if ($prev): ?>
    <button class="request-demo__prev" data-id="<?php echo $prev; ?>"
            data-role="load-content-demo-popup">
        <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.03264 43.8924C11.6441 47.2027 17.2705 48.654 25.5 48.654C33.7295 48.654 39.3559 47.2027 42.9674 43.8924C46.534 40.6231 48.654 35.051 48.654 25.5C48.654 15.949 46.534 10.3769 42.9674 7.10759C39.3559 3.79731 33.7295 2.346 25.5 2.346C17.2705 2.346 11.6441 3.79731 8.03264 7.10759C4.46595 10.3769 2.346 15.949 2.346 25.5C2.346 35.051 4.46595 40.6231 8.03264 43.8924ZM0 25.5C0 45.1582 8.69318 51 25.5 51C42.3068 51 51 45.1582 51 25.5C51 5.84182 42.3068 0 25.5 0C8.69318 0 0 5.84182 0 25.5Z" fill="#CC7510"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M23.6699 40.8077V40.8156C23.753 40.8156 23.836 40.813 23.919 40.8077C24.6595 40.7605 25.3896 40.503 26.0159 40.0384C26.1677 39.9258 26.3134 39.801 26.4517 39.6641C27.9894 38.1264 27.9894 35.6461 26.4517 34.1007L21.7844 29.4334H39.874C42.0531 29.4334 43.8071 27.679 43.8071 25.4999C43.8071 23.3208 42.0531 21.5669 39.874 21.5669H21.7844L26.4517 16.8996C27.9894 15.3618 27.9894 12.8739 26.4517 11.3362C24.914 9.79843 22.4335 9.79843 20.888 11.3362L7.53536 24.6887C7.08717 25.1369 7.08717 25.8554 7.53536 26.3036L20.888 39.6565C21.6607 40.4293 22.6654 40.8077 23.6699 40.8077ZM22.5443 12.9976C22.5438 12.9981 22.5432 12.9987 22.5427 12.9992L10.0457 25.4962L22.5469 37.9977C22.5469 37.9977 22.5469 37.9977 22.5469 37.9977C22.8588 38.3096 23.2575 38.4617 23.6699 38.4617H23.8279C24.1746 38.4268 24.517 38.2764 24.7969 38.0011C25.4116 37.3821 25.4167 36.3884 24.7905 35.7572C24.7899 35.7566 24.7893 35.756 24.7887 35.7554L16.1207 27.0874H39.874C40.7572 27.0874 41.4611 26.3836 41.4611 25.4999C41.4611 24.6166 40.7575 23.9129 39.874 23.9129H16.1207L24.7928 15.2407C25.4144 14.6191 25.4144 13.6166 24.7928 12.995C24.1741 12.3763 23.1769 12.3698 22.5443 12.9976Z" fill="#CC7510"/>
        </svg>
    </button>
	<?php endif; ?>

	<div class="request-demo__top">
		<a class="request-demo__logo" href="https://91-223-106-204.cloud-xip.com/">
			<img width="47" height="47" src="https://91-223-106-204.cloud-xip.com/wp-content/uploads/2024/06/popup-demo-icon.svg">
		</a>
		<p class="request-demo__logo-title">
			INTEL PORTAL
		</p>

        <?php if ($type): ?>
		<!-- Color classes: green, blue, red -->
		<h5 class="request-demo__img-icon <?php echo esc_html($type_color); ?>">
			<?php echo strtoupper(esc_html($type)); ?>
		</h5>
        <?php endif; ?>

	</div>
	<div class="request-demo__content-wrapper">
		<h5 class="request-demo__title">
            <?php echo strtoupper($incident_type); ?>
        </h5>
		<div class="request-demo__content-inner">
			<div class="request-demo__content">
				<div class="request-demo__map-wrapper">
                    <img src="<?php echo $map_image; ?>" alt="map_image" />
				</div>
                <div class="request-demo__wrap">
                    <div class="request-demo__left-col mobile">
                        <div class="request-demo__date-time">
                            <div class="request-demo__date-wrap">
				                <?php if (isset($day)): ?>
                                    <h3 class="request-demo__date-number">
						                <?php echo esc_html($day); ?>
                                    </h3>
				                <?php endif; ?>

				                <?php if (isset($month_year)): ?>
                                    <div class="request-demo__date-info">
						                <?php echo esc_html($month_year); ?>
                                    </div>
				                <?php endif; ?>
                            </div>
			                <?php if (isset($time_utc)): ?>
                                <div class="request-demo__time">
					                <?php echo esc_html($time_utc); ?>
                                </div>
			                <?php endif; ?>
                        </div>
                        <a href="#popup-portal-demo" class="request-demo__request-demo-btn" data-role="open-popup-portal-demo"></a>
                    </div>
                    <div class="request-demo__info-panel mobile">
                        <div class="request-demo__ipanel-item country-risk">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="15" viewBox="0 0 20 15" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.17053 1L12.7248 12.0507L16.9605 4.68903L17.6096 5.0625L12.53 13.8908L9.07543 3.15009L5.16221 12.4164L1 4.93028L1.6545 4.56639L5.07009 10.7096L9.17053 1Z" fill="#FA4646"/>
                                <path d="M18.3247 7.3394L16.9242 5.48956L14.625 5.21258L18.9982 1.8877L18.3247 7.3394Z" fill="#FA4646"/>
                            </svg>

                            <div class="request-demo__ipanel-item-title">
                                COUNTRY RISK LEVEL
                            </div>
                            <div class="request-demo__ipanel-item-value">
                                <?php echo $country_risk_level; ?>
                            </div>
                        </div>
                        <div class="request-demo__ipanel-item affected-area">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="31" viewBox="0 0 20 31" fill="none">
                                <g clip-path="url(#clip0_849_11267)">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1.5C5.30609 1.5 1.5 5.30609 1.5 10C1.5 11.1342 2.02499 12.8953 2.86911 14.9616C3.70414 17.0055 4.8208 19.2773 5.94223 21.403C7.06286 23.5273 8.18408 25.4979 9.02546 26.9379C9.42285 27.618 9.75757 28.1794 10 28.5821C10.2424 28.1794 10.5772 27.618 10.9745 26.9379C11.8159 25.4979 12.9371 23.5273 14.0578 21.403C15.1792 19.2773 16.2959 17.0055 17.1309 14.9616C17.975 12.8953 18.5 11.1342 18.5 10C18.5 5.30609 14.6939 1.5 10 1.5ZM10 29.5451C9.57457 29.8078 9.57452 29.8078 9.57443 29.8076L9.56773 29.7967L9.54811 29.7648L9.47218 29.6408C9.4058 29.5321 9.30863 29.3723 9.18507 29.1673C8.93795 28.7574 8.58521 28.1666 8.16204 27.4424C7.31592 25.9942 6.18714 24.0105 5.05777 21.8696C3.9292 19.7304 2.79586 17.4265 1.94339 15.3398C1.10001 13.2753 0.5 11.3508 0.5 10C0.5 4.75381 4.75381 0.5 10 0.5C15.2462 0.5 19.5 4.75381 19.5 10C19.5 11.3508 18.9 13.2753 18.0566 15.3398C17.2041 17.4265 16.0708 19.7304 14.9422 21.8696C13.8129 24.0105 12.6841 25.9942 11.838 27.4424C11.4148 28.1666 11.062 28.7574 10.8149 29.1673C10.6914 29.3723 10.5942 29.5321 10.5278 29.6408L10.4519 29.7648L10.4259 29.807C10.4258 29.8072 10.4254 29.8078 10 29.5451ZM10 29.5451L10.4259 29.807L10 30.4968L9.57443 29.8076L10 29.5451Z" fill="#234762"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0037 6.24634C7.93067 6.24634 6.25 7.9267 6.25 9.99957C6.25 12.0725 7.93071 13.753 10.0037 13.753C12.0767 13.753 13.7574 12.0725 13.7574 9.99957C13.7574 7.9267 12.0767 6.24634 10.0037 6.24634ZM5.25 9.99957C5.25 7.37427 7.37853 5.24634 10.0037 5.24634C12.6288 5.24634 14.7574 7.37427 14.7574 9.99957C14.7574 12.6248 12.6289 14.753 10.0037 14.753C7.37849 14.753 5.25 12.6248 5.25 9.99957Z" fill="#234762"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_849_11267">
                                        <rect width="20" height="31" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>

                            <div class="request-demo__ipanel-item-title">
                                AFFECTED AREA
                            </div>
                            <div class="request-demo__ipanel-item-value">
				                <?php echo !empty($affected_area) ? $affected_area : '-'; ?>
                            </div>
                        </div>
                        <div class="request-demo__ipanel-item incident-risk <?php echo $incident_risk_color ?>">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
                                <path d="M10.8947 13.4816V15.0206H8.99219V13.4816H10.8947ZM9.01779 7.31738H10.8782V9.76119L10.5487 12.6191H9.34726L9.01779 9.76119V7.31738Z" fill="#0EA74F"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5586 2.66525C10.315 2.23901 9.69324 2.23901 9.44967 2.66525L9.32794 2.87827H9.31841L5.68581 9.16922L1.93288 15.6702C1.93276 15.6704 1.933 15.67 1.93288 15.6702C1.68641 16.1025 1.99668 16.6357 2.48734 16.6357H17.5127C18.0034 16.6357 18.314 16.103 18.0674 15.6706C18.0673 15.6705 18.0675 15.6708 18.0674 15.6706L14.3142 9.16926L10.5595 2.6669L10.5586 2.66525ZM11.2922 2.24482C10.7677 1.32834 9.50132 1.25764 8.86233 2.03271H8.83026L4.95353 8.74643L1.19965 15.249L1.19873 15.2506C0.634122 16.2387 1.33784 17.4812 2.48734 17.4812H17.5127C18.6622 17.4812 19.3659 16.2387 18.8013 15.2506L15.0465 8.74647L11.2927 2.24573C11.2926 2.24543 11.2924 2.24512 11.2922 2.24482Z" fill="#0EA74F"/>
                            </svg>

                            <div class="request-demo__ipanel-item-title">
                                INCIDENT RISK LEVEL
                            </div>
                            <div class="request-demo__ipanel-item-value">
				                <?php echo !empty($incident_risk_level) ? $incident_risk_level : '-'; ?>
                            </div>
                        </div>
                        <div class="request-demo__ipanel-item strength-of-source">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.99965 2.22115C5.42738 2.22115 1.72115 5.92769 1.72115 10.5C1.72115 15.0723 5.42738 18.7788 9.99965 18.7788C14.572 18.7788 18.2788 15.0723 18.2788 10.5C18.2788 5.92773 14.572 2.22115 9.99965 2.22115ZM1 10.5C1 5.52945 5.02906 1.5 9.99965 1.5C14.9702 1.5 19 5.52941 19 10.5C19 15.4706 14.9702 19.5 9.99965 19.5C5.02906 19.5 1 15.4706 1 10.5Z" fill="#2D7EC0"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0008 5.04098C6.98582 5.04098 4.54147 7.48518 4.54147 10.5002C4.54147 13.5152 6.98582 15.9594 10.0008 15.9594C13.0159 15.9594 15.4602 13.5152 15.4602 10.5002C15.4602 7.48518 13.0159 5.04098 10.0008 5.04098ZM3.82031 10.5002C3.82031 7.08687 6.58757 4.31982 10.0008 4.31982C13.4141 4.31982 16.1814 7.08687 16.1814 10.5002C16.1814 13.9135 13.4141 16.6805 10.0008 16.6805C6.58757 16.6805 3.82031 13.9135 3.82031 10.5002Z" fill="#2D7EC0"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 8.31515C8.79337 8.31515 7.8149 9.29351 7.8149 10.5003C7.8149 11.707 8.79337 12.6854 10.0002 12.6854C11.207 12.6854 12.1855 11.707 12.1855 10.5003C12.1855 9.29351 11.207 8.31515 10.0002 8.31515ZM7.09375 10.5003C7.09375 8.89516 8.39515 7.59399 10.0002 7.59399C11.6052 7.59399 12.9067 8.89516 12.9067 10.5003C12.9067 12.1054 11.6052 13.4065 10.0002 13.4065C8.39515 13.4065 7.09375 12.1054 7.09375 10.5003Z" fill="#2D7EC0"/>
                            </svg>

                            <div class="request-demo__ipanel-item-title">
                                STRENGTH OF SOURCE
                            </div>
                            <div class="request-demo__ipanel-item-value">
				                <?php echo !empty($strength_of_source) ? $strength_of_source : '-'; ?>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="request-demo__info-panel desktop">
				<div class="request-demo__ipanel-item country-risk">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="15" viewBox="0 0 20 15" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.17053 1L12.7248 12.0507L16.9605 4.68903L17.6096 5.0625L12.53 13.8908L9.07543 3.15009L5.16221 12.4164L1 4.93028L1.6545 4.56639L5.07009 10.7096L9.17053 1Z" fill="#FA4646"/>
                        <path d="M18.3247 7.3394L16.9242 5.48956L14.625 5.21258L18.9982 1.8877L18.3247 7.3394Z" fill="#FA4646"/>
                    </svg>

					<div class="request-demo__ipanel-item-title">
						COUNTRY RISK LEVEL
					</div>
					<div class="request-demo__ipanel-item-value">
						High
					</div>
				</div>
				<div class="request-demo__ipanel-item affected-area">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="31" viewBox="0 0 20 31" fill="none">
                        <g clip-path="url(#clip0_849_11267)">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1.5C5.30609 1.5 1.5 5.30609 1.5 10C1.5 11.1342 2.02499 12.8953 2.86911 14.9616C3.70414 17.0055 4.8208 19.2773 5.94223 21.403C7.06286 23.5273 8.18408 25.4979 9.02546 26.9379C9.42285 27.618 9.75757 28.1794 10 28.5821C10.2424 28.1794 10.5772 27.618 10.9745 26.9379C11.8159 25.4979 12.9371 23.5273 14.0578 21.403C15.1792 19.2773 16.2959 17.0055 17.1309 14.9616C17.975 12.8953 18.5 11.1342 18.5 10C18.5 5.30609 14.6939 1.5 10 1.5ZM10 29.5451C9.57457 29.8078 9.57452 29.8078 9.57443 29.8076L9.56773 29.7967L9.54811 29.7648L9.47218 29.6408C9.4058 29.5321 9.30863 29.3723 9.18507 29.1673C8.93795 28.7574 8.58521 28.1666 8.16204 27.4424C7.31592 25.9942 6.18714 24.0105 5.05777 21.8696C3.9292 19.7304 2.79586 17.4265 1.94339 15.3398C1.10001 13.2753 0.5 11.3508 0.5 10C0.5 4.75381 4.75381 0.5 10 0.5C15.2462 0.5 19.5 4.75381 19.5 10C19.5 11.3508 18.9 13.2753 18.0566 15.3398C17.2041 17.4265 16.0708 19.7304 14.9422 21.8696C13.8129 24.0105 12.6841 25.9942 11.838 27.4424C11.4148 28.1666 11.062 28.7574 10.8149 29.1673C10.6914 29.3723 10.5942 29.5321 10.5278 29.6408L10.4519 29.7648L10.4259 29.807C10.4258 29.8072 10.4254 29.8078 10 29.5451ZM10 29.5451L10.4259 29.807L10 30.4968L9.57443 29.8076L10 29.5451Z" fill="#234762"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0037 6.24634C7.93067 6.24634 6.25 7.9267 6.25 9.99957C6.25 12.0725 7.93071 13.753 10.0037 13.753C12.0767 13.753 13.7574 12.0725 13.7574 9.99957C13.7574 7.9267 12.0767 6.24634 10.0037 6.24634ZM5.25 9.99957C5.25 7.37427 7.37853 5.24634 10.0037 5.24634C12.6288 5.24634 14.7574 7.37427 14.7574 9.99957C14.7574 12.6248 12.6289 14.753 10.0037 14.753C7.37849 14.753 5.25 12.6248 5.25 9.99957Z" fill="#234762"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_849_11267">
                                <rect width="20" height="31" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>

					<div class="request-demo__ipanel-item-title">
						AFFECTED AREA
					</div>
					<div class="request-demo__ipanel-item-value">
						<?php echo !empty($affected_area) ? $affected_area : '-'; ?>
					</div>
				</div>
				<div class="request-demo__ipanel-item incident-risk <?php echo $incident_risk_color; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
                        <path d="M10.8947 13.4816V15.0206H8.99219V13.4816H10.8947ZM9.01779 7.31738H10.8782V9.76119L10.5487 12.6191H9.34726L9.01779 9.76119V7.31738Z" fill="#0EA74F"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5586 2.66525C10.315 2.23901 9.69324 2.23901 9.44967 2.66525L9.32794 2.87827H9.31841L5.68581 9.16922L1.93288 15.6702C1.93276 15.6704 1.933 15.67 1.93288 15.6702C1.68641 16.1025 1.99668 16.6357 2.48734 16.6357H17.5127C18.0034 16.6357 18.314 16.103 18.0674 15.6706C18.0673 15.6705 18.0675 15.6708 18.0674 15.6706L14.3142 9.16926L10.5595 2.6669L10.5586 2.66525ZM11.2922 2.24482C10.7677 1.32834 9.50132 1.25764 8.86233 2.03271H8.83026L4.95353 8.74643L1.19965 15.249L1.19873 15.2506C0.634122 16.2387 1.33784 17.4812 2.48734 17.4812H17.5127C18.6622 17.4812 19.3659 16.2387 18.8013 15.2506L15.0465 8.74647L11.2927 2.24573C11.2926 2.24543 11.2924 2.24512 11.2922 2.24482Z" fill="#0EA74F"/>
                    </svg>

                    <div class="request-demo__ipanel-item-title">
						INCIDENT RISK LEVEL
					</div>
					<div class="request-demo__ipanel-item-value">
						<?php echo !empty($incident_risk_level) ? $incident_risk_level : '-'; ?>
					</div>
				</div>
				<div class="request-demo__ipanel-item strength-of-source">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.99965 2.22115C5.42738 2.22115 1.72115 5.92769 1.72115 10.5C1.72115 15.0723 5.42738 18.7788 9.99965 18.7788C14.572 18.7788 18.2788 15.0723 18.2788 10.5C18.2788 5.92773 14.572 2.22115 9.99965 2.22115ZM1 10.5C1 5.52945 5.02906 1.5 9.99965 1.5C14.9702 1.5 19 5.52941 19 10.5C19 15.4706 14.9702 19.5 9.99965 19.5C5.02906 19.5 1 15.4706 1 10.5Z" fill="#2D7EC0"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0008 5.04098C6.98582 5.04098 4.54147 7.48518 4.54147 10.5002C4.54147 13.5152 6.98582 15.9594 10.0008 15.9594C13.0159 15.9594 15.4602 13.5152 15.4602 10.5002C15.4602 7.48518 13.0159 5.04098 10.0008 5.04098ZM3.82031 10.5002C3.82031 7.08687 6.58757 4.31982 10.0008 4.31982C13.4141 4.31982 16.1814 7.08687 16.1814 10.5002C16.1814 13.9135 13.4141 16.6805 10.0008 16.6805C6.58757 16.6805 3.82031 13.9135 3.82031 10.5002Z" fill="#2D7EC0"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 8.31515C8.79337 8.31515 7.8149 9.29351 7.8149 10.5003C7.8149 11.707 8.79337 12.6854 10.0002 12.6854C11.207 12.6854 12.1855 11.707 12.1855 10.5003C12.1855 9.29351 11.207 8.31515 10.0002 8.31515ZM7.09375 10.5003C7.09375 8.89516 8.39515 7.59399 10.0002 7.59399C11.6052 7.59399 12.9067 8.89516 12.9067 10.5003C12.9067 12.1054 11.6052 13.4065 10.0002 13.4065C8.39515 13.4065 7.09375 12.1054 7.09375 10.5003Z" fill="#2D7EC0"/>
                    </svg>

					<div class="request-demo__ipanel-item-title">
						STRENGTH OF SOURCE
					</div>
					<div class="request-demo__ipanel-item-value">
						<?php echo !empty($strength_of_source) ? $strength_of_source : '-';?>
					</div>
				</div>
			</div>
            <div class="request-demo__info-wrapper">
                <div class="request-demo__left-col desktop">
                    <div class="request-demo__date-time">
                        <div class="request-demo__date-wrap">
                            <?php if (isset($day)): ?>
                                <h3 class="request-demo__date-number">
                                    <?php echo esc_html($day); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if (isset($month_year)): ?>
                                <div class="request-demo__date-info">
                                    <?php echo esc_html($month_year); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if (isset($time_utc)): ?>
                            <div class="request-demo__time">
                                <?php echo esc_html($time_utc); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <a href="#popup-portal-demo" class="request-demo__request-demo-btn" data-role="open-popup-portal-demo"></a>
                </div>
                <div class="request-demo__right-col">
                    <div class="request-demo__content-title">

                        <?php if (!empty($title)):
                            echo wrap_until_colon($title);
                        endif; ?>
                        <!--							<strong>USA Analysis:</strong> City Crime Series – Washington, DC: Violent crime rates to gradually decline over coming months amid increased security measures citywide-->
                    </div>
                    <div class="request-demo__content-items">
                        <div class="request-demo__content-item">
                            <?php if (is_array($sections)): ?>
                                <?php foreach ($sections as $section): ?>
                                    <div class="request-demo__list-title">
                                        <?php echo $section['section_title']; ?>
                                    </div>

                                    <?php echo $section['section_content']; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="request-demo__request-demo-btn-mobile-wrapper">
                <a href="#popup-portal-demo" class="request-demo__mobile-demo-btn" data-role="open-popup-portal-demo">
                    <?php _e('Request a Demo', 'wp-rock'); ?>
                </a>
            </div>
		</div>
	</div>
</div>
