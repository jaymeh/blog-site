<?php
/**
 * Plugin Name: miniOrange 2 Factor Authentication
 * Plugin URI: https://miniorange.com
 * Description: This plugin provides various two-factor authentication methods as an additional layer of security after the default wordpress login. We Support Google/Authy/LastPass Authenticator, QR Code, Push Notification, Soft Token and Security Questions(KBA) for 1 User in the free version of the plugin.
 * Version: 5.4.8
 * Author: miniOrange
 * Author URI: https://miniorange.com
 * License: GPL2
 */
    define( 'MO_HOST_NAME', 'https://login.xecurify.com' );
	define( 'MO2F_VERSION', '5.4.8' );
	define( 'MO2F_TEST_MODE', false );
	define( 'MO2F_IS_ONPREM', get_option('is_onprem'));
	class Miniorange_twoFactor{

		function __construct()
		{
			register_deactivation_hook(__FILE__		 , array( $this, 'mo_wpns_deactivate'		       )		);
			register_activation_hook  (__FILE__		 , array( $this, 'mo_wpns_activate'			       )		);
			add_action( 'admin_menu'				 , array( $this, 'mo_wpns_widget_menu'		  	   )		);
			add_action( 'admin_enqueue_scripts'		 , array( $this, 'mo_wpns_settings_style'	       )		);
			add_action( 'admin_enqueue_scripts'		 , array( $this, 'mo_wpns_settings_script'	       )	    );
			add_action( 'wpns_show_message'		 	 , array( $this, 'mo_show_message' 				   ), 1 , 2 );
			
			add_action( 'admin_init'                 , array( $this, 'miniorange_reset_save_settings'  )         );		
			add_filter('manage_users_columns'        , array( $this, 'mo2f_mapped_email_column'        )         );
			add_action('manage_users_custom_column'  , array( $this, 'mo2f_mapped_email_column_content'), 10,  3 );

			$actions = add_filter('user_row_actions' , array( $this, 'miniorange_reset_users'          ),10 , 2 );
            add_action( 'admin_footer'				 , array( $this, 'feedback_request' 			   )        );
	    add_action('admin_notices',array( $this, 'mo_wpns_malware_notices' ) );
			
			if(!defined("DISALLOW_FILE_EDIT") && get_option('mo2f_disable_file_editing') ) 	 define('DISALLOW_FILE_EDIT', true);
			$this->includes();
			if(get_option("mo_wpns_2fa_with_network_security"))
			{
				$notify = new miniorange_security_notification;
			    add_action('wp_dashboard_setup', array($notify,'my_custom_dashboard_widgets'));
			}
		}
        // As on plugins.php page not in the plugin
        function feedback_request() {
            if ( 'plugins.php' != basename( $_SERVER['PHP_SELF'] ) ) {
                return;
            }
            global $mo2f_dirName;

             $email = get_option("mo2f_email");
            if(empty($email)){
                $user = wp_get_current_user();
                $email = $user->user_email;
            }
            $imagepath=plugins_url( '/includes/images/', __FILE__ );

            wp_enqueue_style( 'wp-pointer' );
            wp_enqueue_script( 'wp-pointer' );
            wp_enqueue_script( 'utils' );
            wp_enqueue_style( 'mo_wpns_admin_plugins_page_style', plugins_url( '/includes/css/style_settings.css?ver=4.8.60', __FILE__ ) );

            include $mo2f_dirName . 'views'.DIRECTORY_SEPARATOR.'feedback_form.php';;

        }
		function mo_wpns_malware_notices(){
			$args=array();
			$theme_current= wp_get_themes($args);
			$theme_last = get_option('mo_wpns_last_themes');
			$flag_theme = 0;
			if(is_array($theme_last)){
				if(sizeof($theme_current) == sizeof($theme_last)){
					foreach ($theme_current as $key => $value) {
						if(isset($theme_last[$key])){
							if($theme_current[$key] != $theme_last[$key]){
								$flag_theme=1;
								break;
							}
						}else{
							$flag_theme = 1;
							break;
						}
					}
				}else{
					$flag_theme=1;
				}
			}else{
				$flag_theme=1;
			}

			$plugins_found = get_plugins();
			$plugin_last = get_option('mo_wpns_last_plugins');
			$flag_plugin = 0;
			if(is_array($plugin_last)){
				if(sizeof($plugins_found) == sizeof($plugin_last)){
					foreach ($plugins_found as $key => $value) {
						if(isset($plugin_last[$key])){
							if($plugins_found[$key] != $plugin_last[$key]){
								$flag_plugin=1;
								break;
							}
						}else{
							$flag_plugin=1;
							break;
						}
					}
				}else{
					$flag_plugin=1;
				}
			}else{
				$flag_plugin=1;
			}
			$one_day = 60*60*24;
		    $days =(time()-get_option('mo_wpns_last_scan_time'))/ $one_day;
		    $days = (int)$days;

		    $day_infected= (time()-get_option('infected_dismiss'))/$one_day;
		    $day_infected = floor($day_infected);
		    $day_weekly= (time()-get_option('weekly_dismiss'))/$one_day;
		    $day_weekly = floor($day_weekly);

		if(get_option('mo_wpns_2fa_with_network_security'))
		    {
	    	if(!get_option('donot_show_infected_file_notice') && (get_option('mo_wpns_infected_files') != 0) && ($day_infected >= 1)){
	    		echo MoWpnsMessages::showMessage('INFECTED_FILE');
	    	}else if(!get_option('donot_show_new_plugin_theme_notice') && ($flag_plugin || $flag_theme)){
	    		echo MoWpnsMessages::showMessage('NEW_PLUGIN_THEME_CHECK');
	    	}else if(!get_option('donot_show_weekly_scan_notice') && ($days >= 7) && ($day_weekly >= 1)){
	    		echo MoWpnsMessages::showMessage('WEEKLY_SCAN_CHECK');
	    	}
	    }
	}
		function mo_wpns_widget_menu()
		{
		$user  = wp_get_current_user();
		$userID = $user->ID;
		$onprem_admin = get_option('mo2f_onprem_admin');
        $roles = ( array ) $user->roles;
        $flag  = 0;
  		foreach ( $roles as $role ) {
            if(get_option('mo2fa_'.$role)=='1')
            	$flag=1;
        }
         
         $is_2fa_enabled=(($flag) or ($userID == $onprem_admin));
         
            if( $is_2fa_enabled){	
				$menu_slug = 'mo_2fa_two_fa';
			}
			else{
				$menu_slug =  'mo_2fa_dashboard';
			}
			add_menu_page (	'miniOrange 2-Factor' , 'miniOrange 2-Factor' , 'administrator', $menu_slug , array( $this, 'mo_wpns'), plugin_dir_url(__FILE__) . 'includes/images/miniorange_icon.png' );
			if(get_option('mo_wpns_2fa_with_network_security'))
			{
				add_submenu_page( $menu_slug	,'miniOrange 2-Factor'	,'Dashboard'		    ,'administrator','mo_2fa_dashboard'			, array( $this, 'mo_wpns'),1);
			}

			if(MO2F_IS_ONPREM)
			{	
				if( $is_2fa_enabled){
				add_submenu_page( $menu_slug	,'miniOrange 2-Factor'	,'Two Factor'		,'read',		'mo_2fa_two_fa'			, array( $this, 'mo_wpns'),1);
				}
			}
			else{
			add_submenu_page( $menu_slug	,'miniOrange 2-Factor'	,'Two Factor'		   	,'administrator','mo_2fa_two_fa'			, array( $this, 'mo_wpns'),2);
			}
			if(get_option('mo_wpns_2fa_with_network_security'))
		{
			add_submenu_page( $menu_slug	,'miniOrange 2-Factor'	,'Firewall'		   		,'administrator','mo_2fa_waf'				, array( $this, 'mo_wpns'),3);
			add_submenu_page( $menu_slug	,'miniOrange 2-Factor'	,'Login and Spam'		,'administrator','mo_2fa_login_and_spam'	, array( $this, 'mo_wpns'),4);
            add_submenu_page( $menu_slug	,'miniOrange 2-Factor'	,'Backup'				,'administrator','mo_2fa_backup'			, array( $this, 'mo_wpns'),5);
            add_submenu_page( $menu_slug	,'miniOrange 2-Factor'	,'Malware Scan'			,'administrator','mo_2fa_malwarescan'  		, array( $this, 'mo_wpns'),6);
            add_submenu_page( $menu_slug	,'miniOrange 2-Factor'	,'IP Blocking'	,'administrator','mo_2fa_advancedblocking'	, array( $this, 'mo_wpns'),7);
            add_submenu_page( $menu_slug	,'miniOrange 2-Factor'	,'Notifications'		,'administrator','mo_2fa_notifications'		, array( $this, 'mo_wpns'),8);
            add_submenu_page( $menu_slug	,'miniOrange 2-Factor'	,'Reports'				,'administrator','mo_2fa_reports'			, array( $this, 'mo_wpns'),9);
        }
           add_submenu_page( $menu_slug	,'miniOrange 2-Factor'	,'Troubleshooting'		,'administrator','mo_2fa_troubleshooting'	, array( $this, 'mo_wpns'),10);
            add_submenu_page( $menu_slug	,'miniOrange 2-Factor'	,'Account'				,'administrator','mo_2fa_account'			, array( $this, 'mo_wpns'),11);
            add_submenu_page( $menu_slug	,'miniOrange 2-Factor'	,'Upgrade'				,'administrator','mo_2fa_upgrade'			, array( $this, 'mo_wpns'),12);
            add_submenu_page( $menu_slug	,'miniOrange 2-Factor'	,'Request for Demo'				,'administrator','mo_2fa_request_demo'			, array( $this, 'mo_wpns'),13);
            $mo2fa_hook_page = add_users_page ('Reset 2nd Factor',  null , 'manage_options', 'reset', array( $this, 'mo_reset_2fa_for_users_by_admin' ),66);
            
        
    }
	function checkSecurity(){
			
			$guestcustomer = new Customer_Setup();
			
			$guestcustomer->guest_audit();
		}


		function mo_wpns()
		{
			global $wpnsDbQueries,$Mo2fdbQueries;
			$wpnsDbQueries->mo_plugin_activate();
			$Mo2fdbQueries->mo_plugin_activate();
			
			add_option( 'mo2f_enable_brute_force' , false);
			add_option( 'mo2f_show_remaining_attempts' , false);
			add_option( 'mo_wpns_enable_ip_blocked_email_to_admin', false);
			add_option('SQLInjection', 1);
			add_option('WAFEnabled' ,0);
			add_option('XSSAttack' ,1);
			add_option('RFIAttack' ,0);
			add_option('LFIAttack' ,0);
			add_option('RCEAttack' ,0);
			add_option('actionRateL',0);
			add_option('Rate_limiting',0);
			add_option('Rate_request',240);
			add_option('limitAttack',10);
			add_option( 'mo_wpns_check_vulnerable_code', 1);
			add_option( 'mo_wpns_check_sql_injection', 1);
			add_option( 'mo_wpns_scan_plugins', true);
			add_option( 'mo_wpns_scan_themes', true);
			include 'controllers/main_controller.php';
		}

		function mo_wpns_activate()
		{
			$this->checkSecurity();
			global $wpnsDbQueries,$Mo2fdbQueries;
			$userid = wp_get_current_user()->ID;
			$wpnsDbQueries->mo_plugin_activate();
			$Mo2fdbQueries->mo_plugin_activate();
			add_option( 'mo2f_activate_plugin', 1 );
			add_option( 'mo2f_login_option', 1 );
			add_option( 'mo2f_is_NC', 1 );
			add_option( 'mo2f_is_NNC', 1 );
			add_option( 'mo2f_number_of_transactions', 1 );
			add_option( 'mo2f_set_transactions', 0 );
			add_option( 'mo2f_enable_forgotphone', 1 );
			add_option( 'mo2f_enable_2fa_for_users', 1 );
			add_option( 'mo2f_enable_2fa_prompt_on_login_page', 0 );
			add_option( 'mo2f_enable_xmlrpc', 0 );
			add_option( 'mo2fa_administrator',1 );
			add_option( 'mo2f_custom_plugin_name','miniOrange 2-Factor' );
			add_action( 'mo_auth_show_success_message', array($this, 'mo_auth_show_success_message'), 10, 1 );
			add_action( 'mo_auth_show_error_message', array($this, 'mo_auth_show_error_message'), 10, 1 );
			add_option( 'mo2f_show_sms_transaction_message', 0 );
			add_option( 'mo2f_enforce_strong_passswords_for_accounts' ,'all');
			add_option('mo2f_onprem_admin' ,  $userid );
			
			update_site_option('mo_file_backup_plugins',1);
			update_site_option('mo_file_backup_themes',1);
		    update_site_option('mo_wpns_backup_time',12);
		    update_option('file_backup_created',0);
			update_option('db_backup_created',0);
			update_site_option('scheduled_file_backup',0);
			update_site_option('scheduled_db_backup',0);
			add_site_option('file_backup_created_time',0);
			add_site_option('db_backup_created_time',0);
			
			add_option('mo_database_backup',1);
			add_option('mo_wpns_scan_initialize',1);
			add_option( 'mo_wpns_last_scan_time', time());
			add_site_option('mo_file_manual_backup_plugins',1);
			add_site_option('mo_file_manual_backup_themes',1);
			add_site_option('mo_schedule_database_backup',1);

			add_option( 'mo_wpns_2fa_with_network_security' , 1);
			add_option( 'mo_wpns_2fa_with_network_security_popup_visible', 1);
			if(get_site_option('mo2f_activated_time') == null){
				add_site_option('mo2f_activated_time', time());
			}
			
		}

		function mo_wpns_deactivate() 
		{
			global $moWpnsUtility;
			if( !$moWpnsUtility->check_empty_or_null( get_option('mo_wpns_registration_status') ) ) {
				delete_option('mo2f_email');
			}
			update_option('mo2f_activate_plugin', 1);
			delete_option('mo2f_customerKey');
			delete_option('mo2f_api_key');
			delete_option('mo2f_customer_token');
			delete_option('mo_wpns_transactionId');
			delete_option('mo_wpns_registration_status');

      		$two_fa_settings = new Miniorange_Authentication();
			$two_fa_settings->mo_auth_deactivate();
		}

		function mo_wpns_settings_style($hook)
		{
			if(strpos($hook, 'page_mo_2fa')){
				wp_enqueue_style( 'mo_wpns_admin_settings_style'			, plugins_url('includes/css/style_settings.css', __FILE__));
				wp_enqueue_style( 'mo_wpns_admin_settings_phone_style'		, plugins_url('includes/css/phone.css', __FILE__));
				wp_enqueue_style( 'mo_wpns_admin_settings_datatable_style'	, plugins_url('includes/css/jquery.dataTables.min.css', __FILE__));
				wp_enqueue_style( 'mo_wpns_button_settings_style'			, plugins_url('includes/css/button_styles.css',__FILE__));
				wp_enqueue_style( 'mo_wpns_popup_settings_style'			, plugins_url('includes/css/popup.css',__FILE__));
				
			}

		}

		function mo_wpns_settings_script($hook)
		{
			wp_enqueue_script( 'mo_wpns_admin_settings_script'			, plugins_url('includes/js/settings_page.js', __FILE__ ), array('jquery'));
			if(strpos($hook, 'page_mo_2fa')){
				wp_enqueue_script( 'mo_wpns_admin_settings_phone_script'	, plugins_url('includes/js/phone.js', __FILE__ ));
				wp_enqueue_script( 'mo_wpns_admin_datatable_script'			, plugins_url('includes/js/jquery.dataTables.min.js', __FILE__ ), array('jquery'));
				wp_enqueue_script( 'mo_wpns_qrcode_script', plugins_url( "/includes/jquery-qrcode/jquery-qrcode.js", __FILE__ ) );
				wp_enqueue_script( 'mo_wpns_min_qrcode_script', plugins_url( "/includes/jquery-qrcode/jquery-qrcode.min.js", __FILE__ ) );
			}
		}
		function mo_show_message($content,$type) 
		{
		     if($type=="CUSTOM_MESSAGE")
			{
				echo "<div class='overlay_not_JQ_success' id='pop_up_success'><p class='popup_text_not_JQ'>".$content."</p> </div>";
				?>
				<script type="text/javascript">
				 setTimeout(function () {
					var element = document.getElementById("pop_up_success");
					   element.classList.toggle("overlay_not_JQ_success");
					   element.innerHTML = "";
						}, 7000);
						
				</script>
				<?php
			}
			 if($type=="NOTICE")
			{
				echo "<div class='overlay_not_JQ_error' id='pop_up_error'><p class='popup_text_not_JQ'>".$content."</p> </div>";
				?>
				<script type="text/javascript">
				 setTimeout(function () {
					var element = document.getElementById("pop_up_error");
					   element.classList.toggle("overlay_not_JQ_error");
					   element.innerHTML = "";
						}, 7000);
						
				</script>
				<?php
			}
			 if($type=="ERROR")
			 {
				echo "<div class='overlay_not_JQ_error' id='pop_up_error'><p class='popup_text_not_JQ'>".$content."</p> </div>";
				?>
				<script type="text/javascript">
				 setTimeout(function () {
					var element = document.getElementById("pop_up_error");
					   element.classList.toggle("overlay_not_JQ_error");
					   element.innerHTML = "";
						}, 7000);
						
				</script>
				<?php
			 }
			 if($type=="SUCCESS")
			 	{
					echo "<div class='overlay_not_JQ_success' id='pop_up_success'><p class='popup_text_not_JQ'>".$content."</p> </div>";
					?>
					<script type="text/javascript">
					 setTimeout(function () {
						var element = document.getElementById("pop_up_success");
						   element.classList.toggle("overlay_not_JQ_success");
						   element.innerHTML = "";
							}, 7000);
							
					</script>
					<?php
				}
		}

		function includes()
		{
			require('helper/pluginUtility.php');
			require('database/database_functions.php');
			require('database/database_functions_2fa.php');
			require('helper/utility.php');
			require('handler/ajax.php');
			require('api/class-customer-setup.php');
			require('api/class-rba-attributes.php');
			require('api/class-two-factor-setup.php');
			// require('api/mo2f_api.php');
			require('handler/backup.php');
			require('handler/security_features.php');
			require('handler/feedback_form.php');
			require('handler/recaptcha.php');
			require('handler/login.php');
			require('handler/twofa/setup_twofa.php');
			require('handler/twofa/two_fa_settings.php');
			require('handler/twofa/two_fa_utility.php');
			require('handler/twofa/two_fa_constants.php');
			require('handler/registration.php');
			require('handler/logger.php');
			require('handler/spam.php');
			require('helper/dashboard_security_notification.php');
			require('helper/curl.php');
			require('helper/plugins.php');
			require('helper/constants.php');
			require('helper/messages.php');
			require('views/common-elements.php');
			 
			require('controllers/wpns-loginsecurity-ajax.php');
			require('controllers/malware_scanner/malware_scan_ajax.php');
			require('controllers/backup/backup_ajax.php');
			require('controllers/twofa/two_factor_ajax.php');
			require('controllers/dashboard_ajax.php');
			require('handler/malware_scanner/malware_scanner_cron.php');
			require('handler/malware_scanner/scanner_set_cron.php');
		}

		function miniorange_reset_users($actions, $user_object){
		if ( current_user_can( 'administrator', $user_object->ID )  && get_user_meta($user_object->ID,'currentMethod', true) ) {		
			if(get_current_user_id() != $user_object->ID){
				$actions['miniorange_reset_users'] = "<a class='miniorange_reset_users' href='" . admin_url( "users.php?page=reset&action=reset_edit&amp;user=$user_object->ID") . "'>" . __( 'Reset 2 Factor', 'cgc_ub' ) . "</a>";
			}
		}	
		return $actions;
		
	}


	function mo2f_mapped_email_column($columns) {
		$columns['current_method'] = '2FA Method';
		return $columns;
	}

	function mo_reset_2fa_for_users_by_admin(){
		$nonce = wp_create_nonce('ResetTwoFnonce');
		if(isset($_GET['action']) && $_GET['action']== 'reset_edit'){
			$user_id = $_GET['user'];
			$user_info = get_userdata($user_id);	
		?> 
			<form method="post" name="reset2fa" id="reset2fa" action="<?php echo esc_url('users.php'); ?>">
				
				<div class="wrap">
				<h1>Reset 2nd Factor</h1>

				<p>You have specified this user for reset:</p>

				<ul>
				<li>ID #<?php echo $user_info->ID; ?>: <?php echo $user_info->user_login; ?></li> 
				</ul>
					<input type="hidden" name="userid" value="<?php echo $user_id; ?>">
					<input type="hidden" name="miniorange_reset_2fa_option" value="mo_reset_2fa">
					<input type="hidden" name="nonce" value="<?php echo $nonce;?>">
				<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Confirm Reset" ></p>
				</div>
			</form>
		<?php
		}	
	}

		function miniorange_reset_save_settings()
		{
		if(isset($_POST['miniorange_reset_2fa_option']) && $_POST['miniorange_reset_2fa_option'] == 'mo_reset_2fa'){
				$nonce = sanitize_text_field($_POST['nonce']);
				if(!wp_verify_nonce($nonce,'ResetTwoFnonce'))
				{
					
					return;
				}
				$user_id = isset($_POST['userid']) && !empty($_POST['userid']) ? $_POST['userid'] : '';
				if(!empty($user_id)){
					if ( current_user_can( 'edit_user' ) )
					delete_user_meta($user_id,'currentMethod');							
					delete_user_meta($user_id,'mo2f_kba_challenge');
					delete_user_meta($user_id,'mo2f_2FA_method_to_configure');
					delete_user_meta($user_id,'Security Questions');
					delete_user_meta($user_id,'Email Verification');
					delete_user_meta($user_id,'Google Authenticator');
					delete_user_meta($user_id,'kba_questions_user');
					delete_user_meta($user_id,'mo2f_2FA_method_to_test');
				}
			}
		}

	function mo2f_mapped_email_column_content($value, $column_name, $user_id) {
		if(MO2F_IS_ONPREM)
		{
			$currentMethod = get_user_meta($user_id,'currentMethod', true);
			if(!$currentMethod)
			$currentMethod = 'Not Registered for 2FA';
		}
		else
		{
			global $Mo2fdbQueries;
			$currentMethod = $Mo2fdbQueries->get_user_detail( 'mo2f_configured_2FA_method', $user_id );
			if(!$currentMethod)
			$currentMethod = 'Not Registered for 2FA';           
		}
		
		if ( 'current_method' == $column_name )
			return $currentMethod;
		return $value;
	}

	}

	new Miniorange_twoFactor;
?>
