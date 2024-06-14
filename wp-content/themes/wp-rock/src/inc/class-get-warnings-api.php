<?php

class Get_Warnings {
	public function __construct() {
		
		add_action('init', array($this, 'create_custom_table'));
		
		if (class_exists('ActionScheduler')) {
			add_action( 'init', array( $this, 'schedule_custom_tasks' ) );
//          TEST ACTION PRINT FOR LOG PHP
//			add_action( 'custom_five_minute_task', array( $this, 'execute_five_minute_task' ) );
			add_action( 'custom_daily_task', array( $this, 'execute_daily_task' ) );
		}
	}
	
	function schedule_custom_tasks() {
//      TEST ACTION PRINT FOR LOG PHP
//		if (!as_next_scheduled_action('custom_five_minute_task')) {
//			as_schedule_recurring_action(time(), 300, 'custom_five_minute_task');
//		}

		if (!as_next_scheduled_action('custom_daily_task')) {
			as_schedule_recurring_action(time(), DAY_IN_SECONDS, 'custom_daily_task');
		}
	}
	
	function execute_five_minute_task() {
		global $global_options;
		
		$company = get_field_value($global_options, 'company');
		$token = get_field_value($global_options, 'token');
		
		error_log('TEST 5min action $company:'.$company.' $token:'.$token);
	}
	function execute_daily_task() {
		$warnings = $this->request_api();
		
		if (isset($warnings['error'])) {
			error_log('Schedule Error: '.$warnings['error']);
		}
	}
	
	function create_custom_table() {
		global $wpdb;
		
		$table_name = $wpdb->prefix . 'custom_warnings';
		$charset_collate = $wpdb->get_charset_collate();
		
		if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			$sql = "CREATE TABLE $table_name (
            id_warning mediumint(9) NOT NULL,
            content LONGTEXT NOT NULL,
            PRIMARY KEY  (id_warning)
        ) $charset_collate;";
			
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
	}
	
	function insert_custom_warning($id_warning, $content_array) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . 'custom_warnings';
		$content_json = wp_json_encode($content_array);
		
		$wpdb->insert(
			$table_name,
			array(
				'id_warning' => $id_warning,
				'content' => $content_json
			),
			array(
				'%d', // id_warning
				'%s'  // content
			)
		);
		
		return $wpdb->insert_id;
	}
	
	function get_custom_warning($id_warning, $all_warning = false) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . 'custom_warnings';
		
		if ($all_warning) {
			$row = $wpdb->get_results("SELECT id_warning as ID, content FROM $table_name", ARRAY_A);
		} else {
			$row = $wpdb->get_row($wpdb->prepare("SELECT id_warning as ID, content FROM $table_name WHERE id_warning = %d", $id_warning), ARRAY_A);
		}
		if ($all_warning && $row) {
			$content_array = array();
			foreach ($row as $key => $value) {
				$content_array[] = array('content' => json_decode($value['content'], true), 'ID' => $value['ID'] );
			}
			return $content_array;
			
		} elseif ($row) {
			$content_array = json_decode($row['content'], true);
			$content_array['ID'] = $row['ID'];
			return $content_array;
		}
		
		return null;
	}
	
	public function request_api () {
		
		global $global_options;
		
		$company = get_field_value($global_options, 'company');
		$token = get_field_value($global_options, 'token');
		
		if ($company && $token) {
		
	//		$start_date_time = "2024-04-11 09:00:00";
	//		$end_date_time = "2024-05-13 09:00:00";
			
			$end_date_time = date('Y-m-d H:i:s');
			$start_date_time = date('Y-m-d H:i:s', strtotime('-7 days'));
			
			$regions = "auto";
			$types = "auto";
	
			$query_params = http_build_query([
				'data' => [
					'company' => $company,
					'token' => $token,
					'start_date_time' => $start_date_time,
					'end_date_time' => $end_date_time,
					'regions' => $regions,
					'types' => $types,
				]
			]);
	
			$url = "https://api.max-security.com/wp-json/max-api-plugin/public-report-list-v3?" . $query_params;
	
			$ch = curl_init();
	
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$response = curl_exec($ch);
	
			if (curl_errno($ch)) {
				return array('error' => curl_error($ch));
			} else {
				$responseData = json_decode($response, true);
				return $this->prepare_save_warning($responseData);
			}
			curl_close($ch);
		}
		return array('error' => 'Something went wrong');
	}
	
	
	function prepare_save_warning ($warnings) {
		
		if (isset($warnings['info'][0]['message'])) {
			if (isset($warnings['reports']) && is_array($warnings['reports'])) {
				
				$this->clear_custom_table();
				
				foreach ($warnings['reports'] as $report) {
					$new_array = array(
						"affected_area" => $report['affected_area'],
						"strength_of_source" => $report['strength_of_source'],
						"title" => $report['title'],
						"publish_date" => $report['publish_date'],
						"longitude" => $report['longitude'],
						"latitude" => $report['latitude'],
						"type" => $report['type'],
						"sections" => $report['sections'],
						"incident_type" => $report['incident_type'],
						"incident_risk_level" => $report['incident_risk_level'],
					);
					
					$this->insert_custom_warning($report['id'], $new_array);
				}
			}
		}
		
		return true;
	}
	
	function clear_custom_table() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'custom_warnings';
		$wpdb->query("TRUNCATE TABLE $table_name");
	}
}
