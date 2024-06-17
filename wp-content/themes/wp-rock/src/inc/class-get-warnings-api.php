<?php

/**
 * Class Get_Warnings
 *
 * This class handles the creation of a custom warnings table in the WordPress database,
 * schedules custom tasks using ActionScheduler, and processes API requests to insert warnings into the database.
 */
class Get_Warnings {

    /**
     * Constructor method.
     *
     * Initializes the class by adding necessary actions to WordPress hooks.
     */
    public function __construct() {
        // Add action to create custom table on init
        add_action('init', array($this, 'create_custom_table'));
		
		// Init ajax actions
		$this->ajax_actions();

        // Check if ActionScheduler class exists
        if (class_exists('ActionScheduler')) {
            // Schedule custom tasks
            add_action('init', array($this, 'schedule_custom_tasks'));
            // Uncomment the following line to enable the five-minute task for testing
            // add_action('custom_five_minute_task', array($this, 'execute_five_minute_task'));
            add_action('custom_daily_task', array($this, 'execute_daily_task'));
        }
    }
	
	/**
	 * Function init all actions ajax in this class
	 *
	 * @return void
	 */
	function ajax_actions() {
		add_action( 'wp_ajax_get_popup_warning', array($this, 'get_popup_warning') );
		add_action( 'wp_ajax_nopriv_get_popup_warning', array($this, 'get_popup_warning') );
	}
	
	/**
	 * get HTML template popup body for in return ajax action
	 * @return void
	 */
	function get_popup_warning () {
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			$id = filter_input( INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT );
			
			$data = $this->get_custom_warning($id);
			ob_start();
			get_template_part( 'src/template-parts/popup-warning', null, $data );
			$template = ob_get_clean();
			
			wp_send_json_success($template);
		}
	}

    /**
     * Schedule custom tasks using ActionScheduler.
     */
    function schedule_custom_tasks() {
        // Uncomment the following lines to enable the five-minute task for testing
        // if (!as_next_scheduled_action('custom_five_minute_task')) {
        //     as_schedule_recurring_action(time(), 300, 'custom_five_minute_task');
        // }

        // Schedule daily task if not already scheduled
        if (!as_next_scheduled_action('custom_daily_task')) {
            as_schedule_recurring_action(time(), DAY_IN_SECONDS, 'custom_daily_task');
        }
    }

    /**
     * Execute the five-minute task.
     *
     * Logs the company and token values for testing purposes.
     */
    function execute_five_minute_task() {
        global $global_options;

        $company = get_field_value($global_options, 'company');
        $token = get_field_value($global_options, 'token');

        error_log('TEST 5min action $company:'.$company.' $token:'.$token);
    }

    /**
     * Execute the daily task.
     *
     * Requests warnings from the API and logs any errors.
     */
    function execute_daily_task() {
        $warnings = $this->request_api();

        if (isset($warnings['error'])) {
            error_log('Schedule Error: '.$warnings['error']);
        }
    }

    /**
     * Create a custom warnings table in the database if it does not already exist.
     */
    function create_custom_table() {
        global $wpdb;

        $table_name = $wpdb->prefix . 'custom_warnings';
        $charset_collate = $wpdb->get_charset_collate();

        // Check if the table already exists
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

    /**
     * Insert a custom warning into the database.
     *
     * @param int $id_warning The ID of the warning.
     * @param array $content_array The content of the warning.
     * @return int The ID of the inserted row.
     */
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

    /**
     * Retrieve a custom warning from the database.
     *
     * @param int $id_warning The ID of the warning.
     * @param bool $all_warning Whether to retrieve all warnings.
     * @return array|null The content of the warning(s) or null if not found.
     */
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
                $content_array[] = array('content' => json_decode($value['content'], true), 'ID' => $value['ID']);
            }
            return $content_array;
        } elseif ($row) {
            $content_array = json_decode($row['content'], true);
            $content_array['ID'] = $row['ID'];
            return $content_array;
        }

        return null;
    }

    /**
     * Request warnings from the API.
     *
     * @return array The API response or an error message.
     */
    public function request_api() {
        global $global_options;

        $company = get_field_value($global_options, 'company');
        $token = get_field_value($global_options, 'token');
        $endpoint_api = get_field_value($global_options, 'endpoint_api');

        if ($company && $token) {
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

            $url = $endpoint_api . "?" . $query_params;

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

    /**
     * Prepare and save warnings into the custom table.
     *
     * @param array $warnings The warnings data from the API.
     * @return bool True if warnings were processed and saved.
     */
    function prepare_save_warning($warnings) {
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

    /**
     * Clear all entries in the custom warnings table.
     */
    function clear_custom_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'custom_warnings';
        $wpdb->query("TRUNCATE TABLE $table_name");
    }
}
