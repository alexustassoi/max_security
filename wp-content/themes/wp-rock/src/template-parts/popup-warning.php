<?php

//    var_dump($args);

    $type = get_field_value($args, 'type');
    $affected_area = get_field_value($args, 'affected_area');
    $incident_type = get_field_value($args, 'incident_type');
    $incident_risk_level = get_field_value($args, 'incident_risk_level');
    $strength_of_source = get_field_value($args, 'strength_of_source');
    $title = get_field_value($args, 'title');
    
    $type_color = 'green';
    
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
    
?>

<div class="request-demo__wrapper">
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
								<div class="request-demo__list-title">
									Executive Summary
								</div>
								<ul class="request-demo__list">
									<li class="request-demo__list-item">
										2023 recorded the highest number of homicides in Washington, DC since 2004 and one of the highest crime rate spikes nationwide.
									</li>
									<li class="request-demo__list-item">
										Surging violent crimes are likely linked to a reduction in active-duty law enforcement officers, rising youth involvement in crime, growing inequality, and high rates of recidivism.
									</li>
									<li class="request-demo__list-item">
										Crime rates, especially homicides, property crimes, and retail theft, are likely to see marginally improving rates due to the recently introduced security measures. However, these will continue in medium-risk areas due to entrenched social issues, budget constraints impacting police resources, and lower-than-usual prosecution rates.
									</li>
									<li class="request-demo__list-item">
										Travel to Washington, DC can continue while maintaining vigilance due to the threat of property and violent crime. Businesses operating in areas recording higher crime rates are advised to review their security protocols in light of the risk of retail theft and armed robbery.
									</li>
								</ul>
							</div>
							<div class="request-demo__content-item">
								<div class="request-demo__list-title">
									Recommendations:
								</div>
								<div class="request-demo__content-text">
									Those conducting business out of the port of Ashdod are advised to allot for disruptions to operations and delivery delays on February 1 due to the ongoing protest.
								</div>
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
				<div class="request-demo__ipanel-item incident-risk">
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
