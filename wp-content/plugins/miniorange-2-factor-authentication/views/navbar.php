<?php

$security_features_nonce = wp_create_nonce('mo_2fa_security_features_nonce');

	$user = wp_get_current_user();
	$userID = wp_get_current_user()->ID;
	$onprem_admin = get_option('mo2f_onprem_admin');
	$roles = ( array ) $user->roles;
	$is_onprem = MO2F_IS_ONPREM;
        $flag  = 0;
  		foreach ( $roles as $role ) {
            if(get_option('mo2fa_'.$role)=='1')
            	$flag=1;
        }
	if($shw_feedback)
		echo MoWpnsMessages::showMessage('FEEDBACK');
	if(!$safe)
		echo MoWpnsMessages::showMessage('WHITELIST_SELF');
	echo'<div class="wrap">
				<div><img  style="float:left;margin-top:5px;" src="'.$logo_url.'"></div>
				<h1>
					miniOrange 2-Factor &nbsp;
					<a class="add-new-h2" style="font-size:17px"  href="'.$profile_url.'">Account</a>
					<a class="add-new-h2" style="font-size:17px" href="'.$help_url.'">FAQs</a>
					<a class="license-button add-new-h2" style="font-size:17px" href="'.$request_demo_url.'">Request for Demo</a>';
					if(get_option("mo_wpns_2fa_with_network_security"))
					{
					echo '<a class="license-button add-new-h2"  id="restart-tour" href="#" style="background-color: lightblue;font-size:17px;">Restart tour</a>	';					
					}
echo'					<span style="text-align:right;"> 

					<form id="mo_wpns_2fa_with_network_security" method="post" action="" style="margin-top: -2%; width: 30%; text-align: right; padding-left: 70%;">
					<input type="hidden" name="mo_security_features_nonce" value="'.$security_features_nonce.'"/>

					<input type="hidden" name="option" value="mo_wpns_2fa_with_network_security">

					<div><i>2FA + Website Security</i><span>
					<label class="mo_wpns_switch">
					<input type="checkbox" name="mo_wpns_2fa_with_network_security" '.$network_security_features.'  onchange="document.getElementById(\'mo_wpns_2fa_with_network_security\').submit();"> 
					<span class="mo_wpns_slider mo_wpns_round"></span>
					</label></span>
					</div>
					
					</form>
					</span>';
					
					
					echo '<div id = "wpns_nav_message"></div>';
				echo'</h1>			
		</div>';
		//check_is_curl_installed();
?>



		<div class="mo_flex-container">
			<?php 
		if(get_option('mo_wpns_2fa_with_network_security'))
		{
			echo '<a class="nav-tab '.($active_tab == 'mo_2fa_dashboard' 	  ? 'nav-tab-active' : '').'" href="'.$dashboard_url	.'">Dashboard</a>';
			if($is_onprem){
				if(  ($flag) or ($userID == $onprem_admin) ){
					echo '<a class="nav-tab '.($active_tab == 'mo_2fa_two_fa'		  ?	'nav-tab-active' : '').'" href="'.$two_fa		 	.'">Two Factor</a>'; 
				}
			}
			else{
				echo '<a class="nav-tab '.($active_tab == 'mo_2fa_two_fa'		  ?	'nav-tab-active' : '').'" href="'.$two_fa		 	.'">Two Factor</a>';
				}	
		
			if(get_site_option('mo_2f_switch_waf')){
	 			echo '<a id="mo_2fa_waf" class="nav-tab '.($active_tab == 'mo_2fa_waf' 			  ? 'nav-tab-active' : '').'" href="'.$waf				.'">Firewall</a>';
	 		}
	 		if(get_site_option('mo_2f_switch_loginspam')){
	 			echo '<a id="login_spam_tab" class="nav-tab '.($active_tab == 'mo_2fa_login_and_spam'  ? 'nav-tab-active' : '').'" href="'.$login_and_spam	.'">Login and Spam</a>';
	 		}
	 		if(get_site_option('mo_2f_switch_backup')){
				echo '<a id="backup_tab" class="nav-tab '.($active_tab == 'mo_2fa_backup' 	  	  ? 'nav-tab-active' : '').'" href="'.$backup			.'">Encrypted Backup</a>';
			}
			if(get_site_option('mo_2f_switch_malware')){
				echo '<a id="malware_tab" class="nav-tab '.($active_tab == 'mo_2fa_malwarescan'	  ?	'nav-tab-active' : '').'" href="'.$scan_url 		.'">Malware Scan</a>';
			}
			if(get_site_option('mo_2f_switch_adv_block')){
				echo '<a id="adv_block_tab" class="nav-tab '.($active_tab == 'mo_2fa_advancedblocking'? 'nav-tab-active' : '').'" href="'.$advance_block	.'">IP Blocking</a>';
			}
		
			echo '<a class="nav-tab '.($active_tab == 'mo_2fa_upgrade'	  	  ?	'nav-tab-active' : '').'" href="'.$upgrade_url		.'">Upgrade</a>';
		}	
			?>
		</div>