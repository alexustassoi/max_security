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
    $title = get_field_value($args, 'title');
    
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
            data-role="open-request-demo-popup">
        <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M42.9674 7.1076C39.3559 3.79731 33.7295 2.346 25.5 2.346C17.2705 2.346 11.6441 3.79731 8.03264 7.1076C4.46596 10.3769 2.346 15.949 2.346 25.5C2.346 35.051 4.46596 40.6231 8.03264 43.8924C11.6441 47.2027 17.2705 48.654 25.5 48.654C33.7295 48.654 39.3559 47.2027 42.9674 43.8924C46.534 40.6231 48.654 35.051 48.654 25.5C48.654 15.949 46.534 10.3769 42.9674 7.1076ZM51 25.5C51 5.84182 42.3068 0 25.5 0C8.69318 0 0 5.84182 0 25.5C0 45.1582 8.69318 51 25.5 51C42.3068 51 51 45.1582 51 25.5Z" fill="#CC7510"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M27.334 10.1923V10.1844C27.2509 10.1844 27.1679 10.187 27.0849 10.1923C26.3444 10.2395 25.6143 10.497 24.988 10.9616C24.8362 11.0742 24.6905 11.199 24.5522 11.3359C23.0145 12.8736 23.0145 15.3539 24.5522 16.8993L29.2195 21.5666H11.1299C8.95084 21.5666 7.19677 23.321 7.19677 25.5001C7.19677 27.6792 8.95084 29.4331 11.1299 29.4331L29.2195 29.4331L24.5522 34.1004C23.0145 35.6382 23.0145 38.1261 24.5522 39.6638C26.0899 41.2016 28.5704 41.2016 30.1159 39.6638L43.4686 26.3113C43.9167 25.8631 43.9167 25.1446 43.4686 24.6964L30.1159 11.3435C29.3432 10.5707 28.3385 10.1923 27.334 10.1923ZM28.4596 38.0024C28.4601 38.0019 28.4607 38.0013 28.4612 38.0008L40.9583 25.5038L28.457 13.0023C28.457 13.0023 28.457 13.0023 28.457 13.0023C28.1451 12.6904 27.7464 12.5383 27.334 12.5383H27.176C26.8293 12.5732 26.4869 12.7236 26.207 12.9989C25.5924 13.6179 25.5872 14.6116 26.2134 15.2428C26.214 15.2434 26.2146 15.244 26.2152 15.2446L34.8832 23.9126L11.1299 23.9126C10.2467 23.9126 9.54277 24.6164 9.54277 25.5001C9.54277 26.3834 10.2464 27.0871 11.1299 27.0871L34.8832 27.0871L26.2111 35.7593C25.5895 36.3809 25.5895 37.3834 26.2111 38.005C26.8298 38.6237 27.827 38.6302 28.4596 38.0024Z" fill="#CC7510"/>
        </svg>
    </button>
    <?php endif; ?>
    
	<?php if ($prev): ?>
    <button class="request-demo__prev" data-id="<?php echo $prev; ?>"
            data-role="open-request-demo-popup">
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
					<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d98963.27031245815!2d20.99518992067948!3d52.23822324995184!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sua!4v1717664422962!5m2!1sen!2sua" width="686" height="268" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
				<div class="request-demo__info-panel mobile">
					<div class="request-demo__ipanel-item country-risk">
						<div class="request-demo__ipanel-item-title">
							COUNTRY RISK LEVEL
						</div>
						<div class="request-demo__ipanel-item-value">
							High
						</div>
					</div>
					<div class="request-demo__ipanel-item affected-area">
						<div class="request-demo__ipanel-item-title">
							AFFECTED AREA
						</div>
						<div class="request-demo__ipanel-item-value">
							Port of Ashdod, Israel
						</div>
					</div>
					<div class="request-demo__ipanel-item incident-risk">
						<div class="request-demo__ipanel-item-title">
							INCIDENT RISK LEVEL
						</div>
						<div class="request-demo__ipanel-item-value">
							Low
						</div>
					</div>
					<div class="request-demo__ipanel-item strength-of-source">
						<div class="request-demo__ipanel-item-title">
							STRENGTH OF SOURCE
						</div>
						<div class="request-demo__ipanel-item-value">
							Credible
						</div>
					</div>
				</div>
				<div class="request-demo__info-wrapper">
					<div class="request-demo__left-col">
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
			</div>
			<div class="request-demo__info-panel desktop">
				<div class="request-demo__ipanel-item country-risk">
					<div class="request-demo__ipanel-item-title">
						COUNTRY RISK LEVEL
					</div>
					<div class="request-demo__ipanel-item-value">
						High
					</div>
				</div>
				<div class="request-demo__ipanel-item affected-area">
					<div class="request-demo__ipanel-item-title">
						AFFECTED AREA
					</div>
					<div class="request-demo__ipanel-item-value">
						<?php echo !empty($affected_area) ? $affected_area : '-'; ?>
					</div>
				</div>
				<div class="request-demo__ipanel-item incident-risk <?php echo $incident_risk_color; ?>">
					<div class="request-demo__ipanel-item-title">
						INCIDENT RISK LEVEL
					</div>
					<div class="request-demo__ipanel-item-value">
						<?php echo !empty($incident_risk_level) ? $incident_risk_level : '-'; ?>
					</div>
				</div>
				<div class="request-demo__ipanel-item strength-of-source">
					<div class="request-demo__ipanel-item-title">
						STRENGTH OF SOURCE
					</div>
					<div class="request-demo__ipanel-item-value">
						<?php echo !empty($strength_of_source) ? $strength_of_source : '-';?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
