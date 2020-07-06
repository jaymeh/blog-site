<?php
	global $Mo2fdbQueries;
	$user = wp_get_current_user();
	$is_NC = get_option( 'mo2f_is_NC' );
	$is_customer_registered = $Mo2fdbQueries->get_user_detail( 'user_registration_with_miniorange', $user->ID ) == 'SUCCESS' ? true : false;

if ($_GET['page'] == 'mo_2fa_upgrade') {
	?><br><br><?php
}
$mo2f_feature_description_set_addon = array(
"This will allow you to set a time limit on the user's session. After that time, the user would be logged out.",
"Sharing passwords will not work. Only one user will be able to login from one account.",
"Admin can set the number of allowed deivces per user to login.",
"This will allow you to logout a Wordpress user who was inactive for a period of time.",
"Set a fixed time per user session and force log out after that time irrespective of user activity.",
"Admins can decide the number of active sessions for a particular account. Limiting active sessions prevents friends and family share and access website at the same time.",
"Users login with Email without worrying for passwords. It only works with 2fa.",
"You can login with your phone number, OTP will send on your mobile phone, you can skip password for login.",
"You can login with your username, you can skip password for login.",
);
?>
	<div class="mo_upgrade_toggle">
                    <p class="mo_upgrade_toggle_2fa">

                        <input type="radio" name="sitetype" value="regular_plans" id="regular_plans" onclick="mo_2fa_show_plans();" style="display: none;" >

                        <label for="regular_plans" id="mo_2fa_licensing_plans_title" class="mo_upgrade_toggle_2fa_lable" style="display: none;">User Based Plan</label>
    					<label for="regular_plans" id="mo_2fa_licensing_plans_title1" class="mo_upgrade_toggle_2fa_lable" style="background-color: #20b2aa;border-radius: 50em;">User Based Plan</label>

    					<input type="radio" name="sitetype" value="mo_2fa_lite" id="mo_2fa_lite" onclick="mo_2fa_lite_show_plans(); " style="display: none;" >

    					<label for="mo_2fa_lite" class="mo_upgrade_toggle_2fa_lable" id="mo_2fa_lite_licensing_plans_title" >Site Based Plan</label>
    					<label for="mo_2fa_lite" class="mo_upgrade_toggle_2fa_lable" id="mo_2fa_lite_licensing_plans_title1" style="background-color: #20b2aa;border-radius: 50em;display: none;">Site Based Plan</label>

                        <input type="radio" name="sitetype" value="Recharge" id="Recharge" onclick="mo_ns_show_plans(); " style="display: none;">

                        <label for="Recharge" class="mo_upgrade_toggle_2fa_lable" id="mo_ns_licensing_plans_title">Website Security</label>
    					<label for="Recharge" class="mo_upgrade_toggle_2fa_lable" id="mo_ns_licensing_plans_title1" style="background-color: #20b2aa;border-radius: 50em;display: none;">Website Security</label>

    					<input type="radio" name="sitetype" value="mo_addon" id="mo_addon" onclick="mo_addon_show_plans(); " style="display: none;" >

    					<label for="mo_addon" class="mo_upgrade_toggle_2fa_lable" id="mo_addon_licensing_plans_title" style="background-color: #20b2aa;border-radius: 50em;display: none;">Addons</label>
    					<label for="mo_addon" class="mo_upgrade_toggle_2fa_lable" id="mo_addon_licensing_plans_title1">Addons</label>

                        <span class="cd-switch"></span>
                    </p>
    </div>
    
<div id="mo_2fa_features_only" style="display: block;">	
	<div class="mo_wpns_upgrade_page_2fa_ns">
		<div style="float: left;">
		<?php
		if (!get_option('mo_wpns_2fa_with_network_security') && ($_GET['page'] == 'mo_2fa_upgrade')) {
			echo '<a class="mo_wpns_button mo_wpns_button1" href="'.$two_fa.'">Back</a>';
		 } 
		 ?>
		</div>
		<h1 class="mo_wpns_upgrade_page_2fa_ns_1"> Two Factor Authentication</h1> <span></span>
	</div>
	<div class="mo_wpns_upgrade_title11">
		<div class="mo_wpns_upgrade_page_title_name">
			<h1 class="mo_wpns_upgrade_page_2fa_plan_name">Free</h1>	
			<hr class="mo_wpns_upgrade_page_hr">
		</div>
		<center>
				<h4>No. of User:- 3 <br>
					Basic security features<br>
					Five Authenticaton Methods<br>
					Login with Username + password + 2FA<br><br>
				</h4>
		</center>
		<div class="mo_wpns_upgrade_page_2fa_background"><br><br><br><br><br><br><br><br><br>
			<h1 style="text-align: center;color: white;">Current Plan</h1>
		</div>     
		
		
	</div>

	<div class="mo_wpns_upgrade_page_space_in_div"></div>

	<div class="mo_wpns_upgrade_title11"  >
		<div class="mo_wpns_upgrade_page_title_name">
			<h1 class="mo_wpns_upgrade_page_2fa_plan_name">Standard</h1>
			<hr class="mo_wpns_upgrade_page_hr">
		</div>
		<center>
		<h4> Multi-Site Support<br>
		     Backup Methods [ KBA ]<br>
			 Prevent Account Sharing<br>
		     Additional Authentication Methods<br> 
		     User role based redirection after Login<br>	
		</h4>
		</center>
		<div class="mo_wpns_upgrade_page_2fa_background">
			
			<center>
			<h4 class="mo_wpns_upgrade_page_starting_price">Starting From</h4>
			<h1 class="mo_wpns_upgrade_pade_pricing">$5</h1>
			
				<?php echo mo2f_yearly_standard_pricing_plan(); ?>
				<?php echo mo2f_sms_cost();?>
				<?php echo mo2f_supported_forms();?>
			</center>
		<div style="text-align: center;">
		<?php if( $is_customer_registered) {
				?>
                <button id="wp_2fa_basic_plan1" class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button" onclick="mo2f_upgradeform('wp_2fa_basic_plan')" >Upgrade</button>
        <?php }else{ 
        		?>
				<button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"  onclick="mo2f_register_and_upgradeform('wp_2fa_basic_plan')">Upgrade</button>
			<?php } 
			mo2f_payment_option_ui();
			?>

		
		</div>
		</div>
	</div>
	<div class="mo_wpns_upgrade_page_space_in_div"></div>
	<div class="mo_wpns_upgrade_title11"  >
		<div class="mo_wpns_upgrade_page_title_name">
			<h1 class="mo_wpns_upgrade_page_2fa_plan_name">Premium</h1>
			<hr class="mo_wpns_upgrade_page_hr">	
		</div>
		<center>
			<h4>Multi-Site Support<br>
				Additional 2FA methods<br>
				Prevent Account Sharing<br>
				Force Two Factor for users<br>
				Enable 2FA for specific User Roles
				
			</h4>
		</center>
		<div class="mo_wpns_upgrade_page_2fa_background">
			<center>
				<h4 class="mo_wpns_upgrade_page_starting_price">Starting From</h4>
				<h1 class="mo_wpns_upgrade_pade_pricing">$30</h1>
				
					<?php echo mo2f_yearly_premium_pricing_plan(); ?>
					<?php echo mo2f_sms_cost();?>
					<?php echo mo2f_supported_forms();?>
			</center>
			<div style="text-align: center;">
			<?php if( $is_customer_registered) {
						?>
                        <button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"onclick="mo2f_upgradeform('wp_2fa_premium_plan')" >Upgrade</button>
		                <?php 
		            }else{ ?>
						<button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"onclick="mo2f_register_and_upgradeform('wp_2fa_premium_plan')" >Upgrade</button>
		                <?php } 
		                mo2f_payment_option_ui();
		                ?>
		
		
		    </div> 
		    </div> 
	</div>
	<div class="mo_wpns_upgrade_page_space_in_div"></div>
	<div class="mo_wpns_upgrade_title11"  >

			<div class="mo_wpns_upgrade_page_title_name">
				<h1 class="mo_wpns_upgrade_page_2fa_plan_name">
				Enterprise</h1>
				<hr class="mo_wpns_upgrade_page_hr">
			</div>
			<center>
				<h4>
					Security Features<br>
					Multi-Site Support<br>
					Additional 2FA methods<br>
					Prevent Account Sharing<br>
					Login and File Protection<br>				
				</h4>
			</center>
			<div class="mo_wpns_upgrade_page_2fa_background">
			<center>
			<h4 class="mo_wpns_upgrade_page_starting_price">Starting From</h4>
			<h1 class="mo_wpns_upgrade_pade_pricing">$59</h1>
				<?php echo mo2f_yearly_all_inclusive_pricing_plan(); ?>
				<?php echo mo2f_sms_cost();?>
				<?php echo mo2f_supported_forms();?>
			</center>
			
			<div style="text-align: center;">
	<?php	if( $is_customer_registered) {
						?>
                         <button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button" onclick="mo2f_upgradeform('wp_2fa_enterprise_plan')" >Upgrade</button>
		                <?php 
		            }else
		            { ?>
						<button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button" onclick="mo2f_register_and_upgradeform('wp_2fa_enterprise_plan')" >Upgrade</button>
		                <?php } 
		                mo2f_payment_option_ui();
		                ?>
		    </div>
		    </div>
	</div>
	<div class="mo_wpns_upgrade_page_space_in_div"></div>
	<div style="width: 96%; min-height: 60px;background-color: white;float: left;border-bottom: 2px solid #2ba29b; text-align: center;">
		<br>
		<a id= "mo2f_show_features" class="mo_wpns_upgrade_page_show_feature" onclick="mo2fa_show_detail_features()"><span style="font-size: 63%;"><u>Hide Features</u></span></a>
		<a id= "mo2f_hide_features" class="mo_wpns_upgrade_page_hide_feature" onclick="mo2fa_hide_detail_features()"><span style="font-size: 63%;"><u>Show more Features</u></span></a>
		<br>
	</div>
</div>
<div id="mo_2fa_lite_features_only" style="display: none;">	
	<div class="mo_wpns_upgrade_page_2fa_ns">
		<div style="float: left;">
		<?php
		if (!get_option('mo_wpns_2fa_with_network_security') && ($_GET['page'] == 'mo_2fa_upgrade')) {
			echo '<a class="mo_wpns_button mo_wpns_button1" href="'.$two_fa.'">Back</a>';
		 } 
		 ?>
		</div>
		<h1 class="mo_wpns_upgrade_page_2fa_ns_1"> Two Factor Lite: Unlimited Users </h1> <span></span>
	</div>
	<div class="mo_wpns_upgrade_title_2fa_lite">
		<div class="mo_wpns_upgrade_page_title_name">
			<h1 class="mo_wpns_upgrade_page_2fa_plan_name">Free</h1>	
			<hr class="mo_wpns_upgrade_page_hr">
		</div>
		<center>
				<h4>No. of User:- 3 <br>
					Basic security features<br>
					Five Authenticaton Methods<br>
					Login with Username + password + 2FA<br>
				</h4>
		</center>
		<div class="mo_wpns_upgrade_page_2fa_lite_background"><br><br><br><br><br><br><br><br><br>
			<h1 style="text-align: center;color: white;">Current Plan</h1>
		</div>     
		
		
	</div>

	<div class="mo_wpns_upgrade_page_space_in_div"></div>
	<div class="mo_wpns_upgrade_title_2fa_lite"  >
		<div class="mo_wpns_upgrade_page_title_name">
			<h1 class="mo_wpns_upgrade_page_2fa_plan_name">Standard</h1>
			<hr class="mo_wpns_upgrade_page_hr">
		</div>
		<center>
		<h4> 
		     Unlimited Users<br>
			 Multi-Site Support<br>
		     Additional Authentication Methods<br> 
		     User role based redirection after Login<br>	
		</h4>
		</center>
		<div class="mo_wpns_upgrade_page_2fa_lite_background">
			
			<center>
			<h4 class="mo_wpns_upgrade_page_starting_price">Starting From</h4>
			<h1 class="mo_wpns_upgrade_pade_pricing">$49</h1>
			
				<?php echo mo2f_yearly_standard_pricing_onpremise(); ?>
				<?php echo mo2f_supported_forms();?>
			</center>
			
		<div style="text-align: center;">
		<?php if( $is_customer_registered) {
				?>
                <button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button" onclick="mo2f_upgradeform('wp_security_two_factor_standard_lite_plan')" >Upgrade</button>
        <?php }else{ 
        		?>
				<button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button" id="std_upgrade_onprem" onclick="mo2f_register_and_upgradeform('wp_security_two_factor_standard_lite_plan')">Upgrade</button>
			<?php } 
			mo2f_payment_option_ui();
			?>
                   
		
		</div>
		</div>
	</div>
	<div class="mo_wpns_upgrade_page_space_in_div"></div>
	<div class="mo_wpns_upgrade_title_2fa_lite"  >
		<div class="mo_wpns_upgrade_page_title_name">
			<h1 class="mo_wpns_upgrade_page_2fa_plan_name">Premium</h1>
			<hr class="mo_wpns_upgrade_page_hr">	
		</div>
		<center>
			<h4>
				Unlimited Users<br>
				Multi-Site Support<br>
				Force Two Factor for users<br>
				Enable 2FA for specific User Roles<br>
				
			</h4>
		</center>
		<div class="mo_wpns_upgrade_page_2fa_lite_background">
			<center>
				<h4 class="mo_wpns_upgrade_page_starting_price">Starting From</h4>
				<h1 class="mo_wpns_upgrade_pade_pricing">$99</h1>
				
					<?php echo mo2f_yearly_premium_pricing_onpremise(); ?>
					<?php echo mo2f_supported_forms();?>
			</center>
			<div style="text-align: center;">
			<?php if( $is_customer_registered) {
						?>
                        <button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"onclick="mo2f_upgradeform('wp_security_two_factor_premium_lite_plan')" >Upgrade</button>
		                <?php 
		            }else{ ?>
						<button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"onclick="mo2f_register_and_upgradeform('wp_security_two_factor_premium_lite_plan')" >Upgrade</button>
		                <?php } 
		                mo2f_payment_option_ui();
		                ?>
		
		
		    </div> 
		    </div> 
	</div>
	<div class="mo_wpns_upgrade_page_space_in_div"></div>
	<div class="mo_wpns_upgrade_title_2fa_lite"  >
		<div class="mo_wpns_upgrade_page_title_name">
			<h1 class="mo_wpns_upgrade_page_2fa_integration_plan_name">Custom Forms</h1>
			<hr class="mo_wpns_upgrade_page_hr">	
		</div>
		<center>
			<h4>
				Unlimited Users<br>
				Multi-Site Support<br>
				2FA on login page<br>
				2FA on registration page<br>
				
			</h4>
		</center>
		<div class="mo_wpns_upgrade_page_2fa_lite_background">
			<center>
				<h4 class="mo_wpns_upgrade_page_starting_price">Starting From</h4>
				<h1 class="mo_wpns_upgrade_pade_pricing">$120</h1>
				
					<?php echo mo2f_yearly_custom_login_forms_pricing(); ?>
					<?php echo mo2f_supported_forms();?>
			</center>
			<div style="text-align: center;">
	                <button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button" href="mailto:2fasupport@xecurify.com">Contact Us</button>
			               			
		                <?php 
		                mo2f_payment_option_ui();
		                ?>
		
		
		    </div> 
		    </div> 
	</div>
	<div class="mo_wpns_upgrade_page_space_in_div"></div>
	<div style="width: 96%; min-height: 60px;background-color: white;float: left;border-bottom: 2px solid #2ba29b; text-align: center;">
		<br>
		<a id= "mo2f_show_2fa_lite_features" class="mo_wpns_upgrade_page_show_feature" onclick="mo2fa_show_2fa_lite_detail_features()"><span style="font-size: 63%;"><u>Hide Features</u></span></a>
		<a id= "mo2f_hide_2fa_lite_features" class="mo_wpns_upgrade_page_hide_feature" onclick="mo2fa_show_hide_lite_detail_features()"><span style="font-size: 63%;"><u>Show more Features</u></span></a>
		<br>
	</div>
</div>

	<br><br>
	
			<form class="mo2f_display_none_forms" id="mo2fa_loginform"
                  action="<?php echo MO_HOST_NAME . '/moas/login'; ?>"
                  target="_blank" method="post">
                <input type="email" name="username" value="<?php echo get_option( 'mo2f_email' ); ?>"/>
                <input type="text" name="redirectUrl"
                       value="<?php echo MO_HOST_NAME . '/moas/initializepayment'; ?>"/>
                <input type="text" name="requestOrigin" id="requestOrigin"/>
            </form>

            <form class="mo2f_display_none_forms" id="mo2fa_register_to_upgrade_form"
                   method="post">
                <input type="hidden" name="requestOrigin" />
                <input type="hidden" name="mo2fa_register_to_upgrade_nonce"
                       value="<?php echo wp_create_nonce( 'miniorange-2-factor-user-reg-to-upgrade-nonce' ); ?>"/>
            </form>

	
	 
	<div id="mo2f_features_id" style="display: block; float: left;width: 96.6%;">
		<?php 
		include $mo2f_dirName . 'views'.DIRECTORY_SEPARATOR.'upgrade_2fa.php';?>
	</div> 
    <div id="mo2f_2fa_lite_features_id" style="display: none; float: left;width: 96.6%;">
		<?php 
		include $mo2f_dirName . 'views'.DIRECTORY_SEPARATOR.'upgrade_2fa_lite.php';
		?>
	</div>

<div id="mo_ns_features_only" style="display: none;margin-top: -2.5%;">
	<div class="mo_wpns_upgrade_page_2fa_ns">
		<div style="float: left;">
		<?php
		if (!get_option('mo_wpns_2fa_with_network_security') && ($_GET['page'] == 'mo_2fa_upgrade')) {
			echo '<a class="mo_wpns_button mo_wpns_button1" href="'.$two_fa.'">Back</a>';
		 } 
		 ?>
		</div>
		<h1 class="mo_wpns_upgrade_page_2fa_ns_1"> Website Security Plans</h1></div>
	<div class="mo_wpns_upgrade_security_title"  >
		<div class="mo_wpns_upgrade_page_title_name">
			<h1 style="margin-top: 0%;padding: 10% 0% 0% 0%; color: white;font-size: 200%;">
		WAF</h1><hr class="mo_wpns_upgrade_page_hr"></div>
		<div><center><b>
		<ul>
			<li>Realtime IP Blocking</li>
			<li>Live Traffic and Audit</li>
			<li>IP Blocking and Whitelisting</li>
			<li>OWASP TOP 10 Firewall Rules</li>
			<li>Standard Rate Limiting/ DOS Protection</li>
			<li><a onclick="wpns_pricing()">Know more</a></li>
		</ul>
		</b></center></div>
	<div class="mo_wpns_upgrade_page_ns_background">
			<center>
			<h4 class="mo_wpns_upgrade_page_starting_price">Starting From</h4>
			<h1 class="mo_wpns_upgrade_pade_pricing">$50</h1>
			
				<?php echo mo2f_waf_yearly_standard_pricing(); ?>
				
			</center>
	
	<div style="text-align: center;">
	<?php	if( $is_customer_registered) {
						?>
                            <button
                                        class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"
                                        onclick="mo2f_upgradeform('wp_security_waf_plan')" >Upgrade</button>
		                <?php }else{ ?>
							<button
                                        class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"
                                        onclick="mo2f_register_and_upgradeform('wp_security_waf_plan')" >Upgrade</button>
		                <?php } 
		                ?>
	</div></div>
	</div>
	<div class="mo_wpns_upgrade_page_space_in_div"></div>
	<div class="mo_wpns_upgrade_security_title"  >
		<div class="mo_wpns_upgrade_page_title_name">
			<h1 style="margin-top: 0%;padding: 10% 0% 0% 0%; color: white;font-size: 200%;">
		Login and Spam</h1><hr class="mo_wpns_upgrade_page_hr"></div>
		<div><center><b>
		<ul>
			<li>Limit login Attempts</li>
			<li>CAPTCHA on login</li>
			<li>Blocking time period</li>
			<li>Enforce Strong Password</li>
			<li>SPAM Content and Comment Protection</li>
			<li><a onclick="wpns_pricing()">Know more</a></li>
		</ul>
		</b></center></div>
		<div class="mo_wpns_upgrade_page_ns_background">
			<center>
			<h4 class="mo_wpns_upgrade_page_starting_price">Starting From</h4>
			<h1 class="mo_wpns_upgrade_pade_pricing">$15</h1>
			
				<?php echo mo2f_login_yearly_standard_pricing(); ?>
				
			</center>
			
		<div style="text-align: center;">
		<?php if( $is_customer_registered) {
						?>
                            <button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button" 
                                        onclick="mo2f_upgradeform('wp_security_login_and_spam_plan')" >Upgrade</button>
                        <?php }else{ ?>

                           <button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"
                                    onclick="mo2f_register_and_upgradeform('wp_security_login_and_spam_plan')" >Upgrade</button>
                        <?php } 
                        ?>
		</div>
		</div>
		
		
	</div>
	<div class="mo_wpns_upgrade_page_space_in_div"></div>
	<div class="mo_wpns_upgrade_security_title"  >
		<div class="mo_wpns_upgrade_page_title_name">
			<h1 style="margin-top: 0%;padding: 10% 0% 0% 0%; color: white;font-size: 200%;">
		Malware Scanner</h1><hr class="mo_wpns_upgrade_page_hr"></div>
		<div><center><b>
		<ul>
			<li>Malware Detection</li>
			<li>Blacklisted Domains</li>
			<li>Action On Malicious Files</li>
			<li>Repository Version Comparison</li>
			<li>Detect any changes in the files</li>
			<li><a onclick="wpns_pricing()">Know more</a></li>
		</ul>
		</b></center></div>
			<div class="mo_wpns_upgrade_page_ns_background">
			<center>
			<h4 class="mo_wpns_upgrade_page_starting_price">Starting From</h4>
			<h1 class="mo_wpns_upgrade_pade_pricing">$15</h1>
			
				<?php echo mo2f_scanner_yearly_standard_pricing(); ?>
				
			</center>
			<div style="text-align: center;">
			<?php if( $is_customer_registered) {
						?>
                            <button
                                        class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"
                                        onclick="mo2f_upgradeform('wp_security_malware_plan')" >Upgrade</button>
		                <?php }else{ ?>

                           <button
                                        class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"
                                        onclick="mo2f_register_and_upgradeform('wp_security_malware_plan')" >Upgrade</button>
		                <?php } 
		                ?>
		</div>
	</div>
	</div>
	<div class="mo_wpns_upgrade_page_space_in_div"></div>
	<div class="mo_wpns_upgrade_security_title"  >
		<div class="mo_wpns_upgrade_page_title_name">
			<h1 style="margin-top: 0%;padding: 10% 0% 0% 0%; color: white;font-size: 200%;">
		Encrypted Backup</h1><hr class="mo_wpns_upgrade_page_hr"></div>
		<div><center><b>
		<ul>
			<li>Schedule Backup</li>
			<li>Encrypted Backup</li>
			<li>Files/Database Backup</li>
			<li>Restore and Migration</li>
			<li>Password Protected Zip files</li>
			<li><a onclick="wpns_pricing()">Know more</a></li>
		</ul>
		</b></center></div>
	<div class="mo_wpns_upgrade_page_ns_background">

		<center>
			<h4 class="mo_wpns_upgrade_page_starting_price">Starting From</h4>
			<h1 class="mo_wpns_upgrade_pade_pricing">$30</h1>
			
				<?php echo mo2f_backup_yearly_standard_pricing(); ?>
				
			</center>
			<div style="text-align: center;">
	<?php	if( $is_customer_registered) {
						?>
                            <button
                                        class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"
                                        onclick="mo2f_upgradeform('wp_security_backup_plan')" >Upgrade</button>
		                <?php }else{ ?>
							<button
                                        class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"
                                        onclick="mo2f_register_and_upgradeform('wp_security_backup_plan')" >Upgrade</button>
		                <?php } 
		                ?>
		
	</div></div></div>
</div>
<div id="mo_addon_features_only" style="display: none;">	
			<div id="mo2f_payment_option" style="margin-top: -2%;width: 93.5%;margin-left: 0%;border: none;box-shadow: none;background: none; padding: 5px 20px 30px 20px;">
       <div>
           <div class="mo_2fa_container">
           <div class="mo_2fa_card-deck">
        <div class="mo_2fa_card mo_2fa_animation" style="border-top: 4px solid #20b2aa;
    background-color: white;width: 30%;margin: 10px;">
                <div class="mo_2fa_Card-header">
                <h3>Learning Management System / Online Courses</h3>
                </div>
                <hr>
                <div class="mo_2fa_card-body" style="padding-bottom: 0%;">
	                <h4>
						<span>Session Handling</span>
						<?php echo mo2f_addon_features_on_hover($mo2f_feature_description_set_addon[0]);?>

						<br>
						<span>Prevent Account Sharing</span>
						<?php echo mo2f_addon_features_on_hover($mo2f_feature_description_set_addon[1]);?>
						<br>
						<span>Restrict no of device per user</span>
						<?php echo mo2f_addon_features_on_hover($mo2f_feature_description_set_addon[2]);?>
					</h4>
                </div>
                <hr>
                <div style="text-align: center;">
						<b><a href="mailto:2fasupport@xecurify.com" class = "mo_wpns_button mo_wpns_button1 "><i>Contact Us</i></a></b>
		    	</div><br>
        </div>
            <div class="mo_2fa_card mo_2fa_animation" style="border-top: 4px solid #20b2aa;
    background-color: white;width: 30%;margin: 10px;">
                <div class="mo_2fa_Card-header">
                <h3>User Session Control</h3>
                </div>
                <hr>
                <div class="mo_2fa_card-body" style="padding-bottom: 0%;">
                
				<h4>
						<span>Idle Session Control</span>
						<?php echo mo2f_addon_features_on_hover($mo2f_feature_description_set_addon[3]);?>
						<br>
						<span>User Session Timeout</span>
						<?php echo mo2f_addon_features_on_hover($mo2f_feature_description_set_addon[4]);?>
						<br>
						<span>Limit Simultaneous Session</span>
						<?php echo mo2f_addon_features_on_hover($mo2f_feature_description_set_addon[5]);?>
					</h4>
                </div>
				<hr>
                <div style="text-align: center;">
						<b><a href="mailto:2fasupport@xecurify.com" class = "mo_wpns_button mo_wpns_button1 "><i>Contact Us</i></a></b>
		    	</div><br>
                </div>
        <div class="mo_2fa_card mo_2fa_animation" style="border-top: 4px solid #20b2aa;background-color: white;width: 30%;margin: 10px;">
                <div class="mo_2fa_Card-header">
                <h3>Password-Less Login</h3>
                </div>
                <hr>
                <div class="mo_2fa_card-body" style="padding-bottom: 0%;">
				<h4>
						<span>Login with email only</span>
						<?php echo mo2f_addon_features_on_hover($mo2f_feature_description_set_addon[6]);?>
						<br>
						<span>Login with Phone only</span>
						<?php echo mo2f_addon_features_on_hover($mo2f_feature_description_set_addon[7]);?>
						<br>
						<span>Login with username only</span>
						<?php echo mo2f_addon_features_on_hover($mo2f_feature_description_set_addon[8]);?>
					</h4>
                </div><hr>
                <div style="text-align: center;">
						<b><a href="mailto:2fasupport@xecurify.com" class = "mo_wpns_button mo_wpns_button1 "><i>Contact Us</i></a></b>
		    	</div><br>
        </div>
        <div class="mo_2fa_card mo_2fa_animation" style="border-top: 4px solid #20b2aa;background-color: white;width: 30%;margin: 10px;">
                <div class="mo_2fa_Card-header">
                <h3>WooCommerce</h3>
                </div>
                <hr>
                <div class="mo_2fa_card-body" style="padding-bottom: 0%;">
				<h4>
						<span>OTP on Login Page</span>
						<br>
						<span>OTP on Registration</span>
						<br><br>
					</h4>
                </div><hr>
                <div style="text-align: center;">
						<b><a href="mailto:2fasupport@xecurify.com" class = "mo_wpns_button mo_wpns_button1 "><i>Contact Us</i></a></b>
		    	</div><br>
        </div>
        <div class="mo_2fa_card mo_2fa_animation" style="border-top: 4px solid #20b2aa;background-color: white;width: 30%;margin: 10px;">
                <div class="mo_2fa_Card-header">
                <h3>User Registration</h3>
                </div>
                <hr>
                <div class="mo_2fa_card-body" style="padding-bottom: 0%;">
				<h4>
						<span>OTP on Login Page</span>
						<br>
						<span>OTP on Registration</span>
						<br><br>
					</h4>
                </div><hr>
                <div style="text-align: center;">
						<b><a href="mailto:2fasupport@xecurify.com" class = "mo_wpns_button mo_wpns_button1 "><i>Contact Us</i></a></b>
		    	</div><br>
        </div>
        <div class="mo_2fa_card mo_2fa_animation" style="border-top: 4px solid #20b2aa;background-color: white;width: 30%;margin: 10px;">
                <div class="mo_2fa_Card-header">
                <h3>Ultimate Member</h3>
                </div>
                <hr>
                <div class="mo_2fa_card-body" style="padding-bottom: 0%;">
				<h4>
						<span>OTP on Login Page</span>
						<br>
						<span>OTP on Registration</span>
						<br>
						<span>OTP on Reset Password</span>
					</h4>
                </div><hr>
                <div style="text-align: center;">
						<b><a href="mailto:2fasupport@xecurify.com" class = "mo_wpns_button mo_wpns_button1 "><i>Contact Us</i></a></b>
		    	</div><br>
        </div>
           <div class="mo_2fa_card mo_2fa_animation" style="border-top: 4px solid #20b2aa;
    background-color: white;width: 30%;margin: 10px">
                <div class="mo_2fa_Card-header">
                 <h3>RBA & Trusted Devices Management</h3>
                </div>
                <hr>
                <h1 class="mo_wpns_upgrade_pade_pricing" style="color: #20b2aa">$49</h1> 
                <div class="mo_2fa_card-body" style="padding-bottom: 0%;">
                	<h3>Features</h3>
                <h4>
							Remember Device<br>
							Limit users to login from specific IPs<br>
							Set Device Limit for the users to login<br><br><br>
						
				</h4>
                </div>
				<hr>
                <div style="text-align: center;">
						<?php	if( $is_customer_registered) 
						{
							?>
	                         <button class="mo_wpns_button mo_wpns_button1 " onclick="mo2f_upgradeform('wp_2fa_addon_rba')" >Purchase</button>
			                <?php 
			            }else
			            { ?>
							<button class="mo_wpns_button mo_wpns_button1 " onclick="mo2f_register_and_upgradeform('wp_2fa_addon_rba')" >Purchase</button>
			                <?php 
			            } 
			                ?>
		    	</div>
		    	<br>
            </div>
          <div class="mo_2fa_card mo_2fa_animation" style="border-top: 4px solid #20b2aa;
    background-color: white;width: 30%;margin: 10px">
                <div class="mo_2fa_Card-header">
                <h3>Personalization Add-on Features</h3>
                </div>
                <hr>
                <h1 class="mo_wpns_upgrade_pade_pricing" style="color: #20b2aa">$199</h1>
                <div class="mo_2fa_card-body" style="padding-bottom: 0%;">
                	<h3>Features</h3>
                <h4>
					Custom UI of 2FA popups<br>
					Customize 'powered by' Logo<br>
					Custom Email and SMS Templates<br>
					Customize Plugin Icon and Plugin Name<br><br>
				</h4>
                </div>
					<hr>
                <div style="text-align: center;">
						<?php	if( $is_customer_registered) 
						{
							?>
	                         <button class="mo_wpns_button mo_wpns_button1 " onclick="mo2f_upgradeform('wp_2fa_addon_personalization')" >Purchase</button>
			                <?php 
			            }else
			            { ?>
							<button class="mo_wpns_button mo_wpns_button1 " onclick="mo2f_register_and_upgradeform('wp_2fa_addon_personalization')" >Purchase</button>
			                <?php } 
			                ?>
		    		</div>
		    		<br>
            </div>
          <div class="mo_2fa_card mo_2fa_animation" style="border-top: 4px solid #20b2aa;
    background-color: white;width: 30%;margin: 10px">
                <div class="mo_2fa_Card-header">
                <h3>Short Codes Add-on Features</h3>
                </div>
                <hr>
                <h1 class="mo_wpns_upgrade_pade_pricing" style="color: #20b2aa">$99</h1>
                <div class="mo_2fa_card-body" style="padding-bottom: 0%;">
                <h3>Features</h3>
                <h4>
							Turn on/off 2-factor by user<br>
							Configure Security Questions by user<br>
							Remember Device from custom forms<br>
							Configure Google Authenticator by user<br>
							On-Demand ShortCodes for specific fuctionalities
						
					</h4>
				
                </div><hr>
                <div style="text-align: center;">
						<?php	if( $is_customer_registered) {
							?>
	                         <button class="mo_wpns_button mo_wpns_button1 " onclick="mo2f_upgradeform('wp_2fa_addon_shortcode')" >Purchase</button>
			                <?php 
			            }else
			            { ?>
							<button class="mo_wpns_button mo_wpns_button1 " onclick="mo2f_register_and_upgradeform('wp_2fa_addon_shortcode')" >Purchase</button>
			                <?php } 
			                ?>
		    		</div>
		    		<br>
                </div>
          </div>
          </div>
     </div>
 </div>

</div>
		<div id="mo2f_payment_option" class="mo_wpns_setting_layout" style="margin-top: 1%;width: 93.5%;margin-left: 0%;">
       <div>
           <h3>Supported Payment Methods</h3><hr>
           <div class="mo_2fa_container">
           <div class="mo_2fa_card-deck">
           <div class="mo_2fa_card mo_2fa_animation">
                <div class="mo_2fa_Card-header">
                 <?php 
                echo'<img src="'.dirname(plugin_dir_url(__FILE__)).'/includes/images/card.png" style="size: landscape;width: 100px;height: 27px; margin-bottom: 4px;margin-top: 4px;opacity: 1;padding-left: 8px;">';?>
                </div>
                <hr style="border-top: 2px solid #143af4;">
                <div class="mo_2fa_card-body">
                <p style="font-size: 110%;">If payment is done through Credit Card/Intenational debit card, the license would be made automatically once payment is completed. </p>
                <p style="font-size: 110%;"><i><b>For guide 
                	<?php echo'<a href='.MoWpnsConstants::FAQ_PAYMENT_URL.' target="blank">Click Here.</a>';?></b></i></p>
                
                </div>
            </div>
          <div class="mo_2fa_card mo_2fa_animation">
                <div class="mo_2fa_Card-header">
                 <?php 
                echo'<img src="'.dirname(plugin_dir_url(__FILE__)).'/includes/images/paypal.png" style="size: landscape;width: 100px;height: 27px; margin-bottom: 4px;margin-top: 4px;opacity: 1;padding-left: 8px;">';?>
                </div>
                <hr style="border-top: 2px solid #143af4;">
                <div class="mo_2fa_card-body">
                <?php echo'<p style="font-size: 110%;">Use the following PayPal id for payment via PayPal.</p><p><i><b style="color:#1261d8">'.MoWpnsConstants::SUPPORT_EMAIL.'</b></i></p>';?>
                 <p style="font-size: 110%;"><i><b>Note:</b> There is an additional 18% GST applicable via PayPal.</i></p>

                </div>
            </div>
          <div class="mo_2fa_card mo_2fa_animation">
                <div class="mo_2fa_Card-header">
                <?php 
                echo'<img src="'.dirname(plugin_dir_url(__FILE__)).'/includes/images/netbanking.png" style="size: landscape;width: 100px;height: 27px; margin-bottom: 4px;margin-top: 4px;opacity: 1;padding-left: 8px;">';?>

                </div>
                <hr style="border-top: 2px solid #143af4;">
                <div class="mo_2fa_card-body">
                <?php echo'<p style="font-size: 110%;">If you want to use net banking for payment then contact us at <i><b style="color:#1261d8">'.MoWpnsConstants::SUPPORT_EMAIL.'</b></i> so that we can provide you bank details. </i></p>';?>
                <p style="font-size: 110%;"><i><b>Note:</b> There is an additional 18% GST applicable via Bank Transfer.</i></p>
                </div>
                </div>
              </div>
          </div>
             <div class="mo_2fa_mo-supportnote">
                <p style="font-size: 110%;"><b>Note :</b> Once you have paid through PayPal/Net Banking, please inform us so that we can confirm and update your License.</p> 
                </div>
     </div>
 </div>

	<div class="mo_wpns_setting_layout" style="width: 93.5%;margin-left: 0%;">
		<div>
                <h2>Steps to upgrade to the Premium Plan</h2>
                <ol class="mo2f_licensing_plans_ol">
                    <li><?php echo mo2f_lt( 'Click on \'Upgrade\' button of your preferred plan above.' ); ?></li>
                    <li><?php echo mo2f_lt( ' You will be redirected to the miniOrange Console. Enter your miniOrange username and password, after which you will be redirected to the payment page.' ); ?></li>

                    <li><?php echo mo2f_lt( 'Select the number of users you wish to upgrade for, and any add-ons if you wish to purchase, and make the payment.' ); ?></li>
                    <li><?php echo mo2f_lt( 'After making the payment, you can find the Standard/Premium plugin to download from the \'License\' tab in the left navigation bar of the miniOrange Console.' ); ?></li>
                    <li><?php echo mo2f_lt( 'Download the premium plugin from the miniOrange Console.' ); ?></li>
                    <li><?php echo mo2f_lt( 'In the Wordpress dashboard, uninstall the free plugin and install the premium plugin downloaded.' ); ?></li>
                    <li><?php echo mo2f_lt( 'Login to the premium plugin with the miniOrange account you used to make the payment, after this your users will be able to set up 2FA.' ); ?></li>
                </ol>
            </div>
           

            <br>
            <hr>
            <br>
            <div>
                <h2>Refund Policy</h2>
                <p class="mo2f_licensing_plans_ol"><?php echo mo2f_lt( 'At miniOrange, we want to ensure you are 100% happy with your purchase. If the premium plugin you purchased is not working as advertised and you\'ve attempted to resolve any issues with our support team, which couldn\'t get resolved then we will refund the whole amount within 10 days of the purchase.' ); ?>
                </p>
            </div>
            <br>
            <hr>
            <br>
            <div>
                <h2>Privacy Policy</h2>
                <p class="mo2f_licensing_plans_ol"><a
                            href="https://www.miniorange.com/2-factor-authentication-for-wordpress-gdpr">Click Here</a>
                    to read our Privacy Policy.
                </p>
            </div>
            <br>
            <hr>
            <br>
            <div>
                <h2>Contact Us</h2>
                <p class="mo2f_licensing_plans_ol"><?php echo mo2f_lt( 'If you have any doubts regarding the licensing plans, you can mail us at' ); ?>
                    <a href="mailto:info@xecurify.com"><i>info@xecurify.com</i></a> <?php echo mo2f_lt( 'or submit a query using the support form.' ); ?>
                </p>
            </div>
	</div>
	<br>



<?php 
function mo2f_payment_option_ui()
{
	?>
	<br><br>
	<div style="    background-color: white;min-height: 35px;padding-top: 7px;">
	<a onclick="mo2f_payment_option()" style="color: black; "><b>Payment Options</b>
    <?php echo'<img src="'.dirname(plugin_dir_url(__FILE__)).'/includes/images/card.png" style="size: landscape;width: 71px;height: 18px; margin-bottom: -4px;margin-top: 4px;opacity: 1;padding-left: 8px;">
    	<img src="'.dirname(plugin_dir_url(__FILE__)).'/includes/images/paypal.png" style="size: landscape;width: 71px;height: 18px; margin-bottom: -4px;margin-top: 4px;opacity: 1;padding-left: 8px;">
    '; ?><b style="font-size: 17px">⮟</b>
    </a>
	</div>
    <?php
}
function mo2f_sms_cost() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price" id="mo2f_sms_cost"
       title="<?php echo mo2f_lt( '(Only applicable if OTP over SMS is your preferred authentication method.)' ); ?>"><?php echo mo2f_lt( 'SMS + OTP Cost' ); ?>
        <b style="color: black;">[optional]</b><br/>
        <select id="mo2f_sms" class="form-control" style="border-radius:5px;width:200px;">
            <option><?php echo mo2f_lt( '$1 per 100 OTP + SMS delivery charges' ); ?></option>
            <option><?php echo mo2f_lt( '$5 per 500 OTP + SMS delivery charges' ); ?></option>
            <option><?php echo mo2f_lt( '$7 per 1k OTP + SMS delivery charges' ); ?></option>
            <option><?php echo mo2f_lt( '$24 per 5k OTP + SMS delivery charges' ); ?></option>
            <option><?php echo mo2f_lt( '$43 per 10k OTP + SMS delivery charges' ); ?></option>
            <option><?php echo mo2f_lt( '$160 per 50k OTP + SMS delivery charges' ); ?></option>
        </select>
    </p>
    
	<?php
}
function mo2f_supported_forms() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price" id="mo2f_sms_cost"><?php echo mo2f_lt( 'Popular Supported Forms' ); ?>
        <br/>
        <select id="mo2f_sms" class="form-control" style="border-radius:5px;width:200px;">
            <option><?php echo mo2f_lt( 'Woocommerce' ); ?></option>
            <option><?php echo mo2f_lt( 'Ultimate member' ); ?></option>
            <option><?php echo mo2f_lt( 'Restrict Content Pro' ); ?></option>
            <option><?php echo mo2f_lt( 'User Registration' ); ?></option>
            <option><?php echo mo2f_lt( 'BBPress' ); ?></option>
            <option><?php echo mo2f_lt( 'Member Press' ); ?></option>
            <option><?php echo mo2f_lt( 'DigiMember' ); ?></option>
            <option><?php echo mo2f_lt( 'Theme My Login' ); ?></option>
            <option><?php echo mo2f_lt( 'Admin Custom Login' ); ?></option>
            <option><?php echo mo2f_lt( 'Registrationmagic | Custom Registration Form and User Login' ); ?></option>
            <option><?php echo mo2f_lt( 'Users Ultra registration form' ); ?></option>
            <option style="color: red;"><?php echo mo2f_lt( 'If your forms are not included, this does not mean that they are not supported' ); ?></option>

        </select><br>
        <span style="color: black;"><b>[ Contact Us for Custom Forms ]</b></span>
    </p>
    
	<?php
}
function mo2f_yearly_standard_pricing_plan() {
	?>
	
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly Subscription Fees', 'miniorange-2-factor-authentication' ); ?><br>

        <select id="mo2f_yearly" class="form-control" style="border-radius:5px;width:200px;">
            <option> <?php echo mo2f_lt( 'Upto 2 users - $5 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 5 users - $20 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 50 users - $30 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 100 users - $49 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 500 users - $99 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 1000 users - $199 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 5000 users - $299 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 10000 users - $499 per year' ); ?></option>
            <option> <?php echo mo2f_lt( 'Upto 20000 users - $799 per year' ); ?> </option>
            
        </select>
    </p>
	<?php
}
function mo2f_yearly_premium_pricing_plan() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly Subscription Fees', 'miniorange-2-factor-authentication' ); ?><br>

        <select id="mo2f_yearly" class="form-control" style="border-radius:5px;width:200px;">
           <option> <?php echo mo2f_lt( 'Upto 5 users - $30 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 50 users - $99 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 100 users - $199 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 500 users - $349 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 1000 users - $499 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 5000 users - $799 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 10000 users - $999 per year ' ); ?></option>
            <option> <?php echo mo2f_lt( 'Upto 20000 users - $1449 per year' ); ?> </option>
            
        </select>
    </p>
	<?php
}
function mo2f_yearly_all_inclusive_pricing_plan() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly Subscription Fees', 'miniorange-2-factor-authentication' ); ?><br>

        <select id="mo2f_yearly" class="form-control" style="border-radius:5px;width:200px;">
           <option> <?php echo mo2f_lt( 'Upto 5 users - $59 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 50 users - $128 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 100 users - $228 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 500 users - $378 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 1000 users - $528 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 5000 users - $828 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 10000 users - $1028 per year ' ); ?></option>
            <option> <?php echo mo2f_lt( 'Upto 20000 users - $1478 per year' ); ?> </option>
            
        </select>
    </p>
	<?php
}
function mo2f_yearly_premium_pricing_onpremise() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly Subscription Fees', 'miniorange-2-factor-authentication' ); ?><br>
        <select id="mo2f_yearly" class="form-control" style="border-radius:5px;width:200px;">
            <option> <?php echo mo2f_lt( '1 site - $99 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 2 sites - $159 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 5 sites - $199 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 10 sites - $259 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 25 sites - $349 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '25+ sites - contact us' ); ?> </option>
        </select>
    </p>
	<?php
}
function mo2f_yearly_standard_pricing_onpremise() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly Subscription Fees', 'miniorange-2-factor-authentication' ); ?><br>
        <select id="mo2f_yearly" class="form-control" style="border-radius:5px;width:200px;">
            <option> <?php echo mo2f_lt( '1 site - $49 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 2 sites - $79 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 5 sites - $99 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 10 sites - $149 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 25 sites - $199 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '25+ sites - contact us' ); ?> </option>
        </select>
    </p>
	<?php
}
function mo2f_yearly_custom_login_forms_pricing() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly Subscription Fees', 'miniorange-2-factor-authentication' ); ?><br>
        <select id="mo2f_yearly" class="form-control" style="border-radius:5px;width:200px;">
            <option> <?php echo mo2f_lt( '1 site - $120 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 5 sites - $249 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 10 sites - $379 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '10+ sites - contact us' ); ?> </option>
        </select>
    </p>
	<?php
}
function mo2f_waf_yearly_standard_pricing() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly Subscription Fees', 'miniorange-2-factor-authentication' ); ?><br>

        <select id="mo2f_yearly" class="form-control" style="border-radius:5px;width:200px;">
            <option> <?php echo mo2f_lt( '1 site - $50 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 5 sites - $100 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 10 sites - $150 per year' ); ?> </option>
            
        </select>
    </p>
    <div><br></div>
	<?php
}
function mo2f_login_yearly_standard_pricing() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly Subscription Fees', 'miniorange-2-factor-authentication' ); ?><br>

        <select id="mo2f_yearly" class="form-control" style="border-radius:5px;width:200px;">
            <option> <?php echo mo2f_lt( '1 site - $15 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 5 sites - $35 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 10 sites - $60 per year' ); ?> </option>
            
        </select>
    </p>
    <div><br></div>
	<?php
}
function mo2f_backup_yearly_standard_pricing() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly Subscription Fees', 'miniorange-2-factor-authentication' ); ?><br>

        <select id="mo2f_yearly" class="form-control" style="border-radius:5px;width:200px;">
            <option> <?php echo mo2f_lt( '1 site - $30 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 5 sites - $50 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 10 sites - $70 per year' ); ?> </option>
            
        </select>
    </p>
    <div><br></div>
	<?php
}
function mo2f_scanner_yearly_standard_pricing() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price" 
       id="mo2f_yearly_sub"><?php echo __( 'Yearly Subscription Fees', 'miniorange-2-factor-authentication' ); ?><br>

        <select id="mo2f_yearly" class="form-control" style="border-radius:5px;width:200px;">
            <option> <?php echo mo2f_lt( '1 site - $15 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 5 sites - $35 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( 'Upto 10 sites - $60 per year' ); ?> </option>
            
        </select>
    </p>
    <div><br></div>
	<?php
}
function mo2f_addon_features_on_hover($mo2f_addon_feature)
{
	return 	'<div class="mo2f_tooltip_addon">
			<span class="dashicons dashicons-info mo2f_info_tab"></span>
			<span class="mo2f_tooltiptext_addon" >'. $mo2f_addon_feature .'
			</span>
		</div>';
}
?>

<script type="text/javascript">

function wpns_pricing()
{
	window.open("https://security.miniorange.com/pricing/");
}
</script>

	<script type="text/javascript">
			    	
    	function mo2fa_show_detail_features()
    	{
    		jQuery("#mo2f_features_id").hide(1500);

    		document.getElementById("mo2f_show_features").style.display = "none";
    		document.getElementById("mo2f_hide_features").style.display = "block";

    	}

    	function mo2fa_hide_detail_features()
    	{
    		jQuery("#mo2f_features_id").show(1500);

    		document.getElementById("mo2f_show_features").style.display = "block";
    		document.getElementById("mo2f_hide_features").style.display = "none";

    	}
    	function mo2fa_show_2fa_lite_detail_features()
    	{
    		jQuery("#mo2f_2fa_lite_features_id").hide(1500);

    		document.getElementById("mo2f_show_2fa_lite_features").style.display = "none";
    		document.getElementById("mo2f_hide_2fa_lite_features").style.display = "block";

    	}

    	function mo2fa_hide_2fa_lite_detail_features()
    	{
    		jQuery("#mo2f_2fa_lite_features_id").show(1500);

    		document.getElementById("mo2f_show_2fa_lite_features").style.display = "block";
    		document.getElementById("mo2f_hide_2fa_lite_features").style.display = "none";

    	}
		function mo2f_payment_option()
		{
			document.getElementById('mo2f_payment_option').scrollIntoView();
		}
		function mo2f_features()
		{
			document.getElementById("mo2f_visible").style.display = "block";
		}
		function mo2f_features_disable()
		{
			document.getElementById("mo2f_visible").style.display = "none";
			document.getElementById("mo2f_features_id").style.display = "none";
		}
		function mo2f_upgradeform(planType) 
		{
            jQuery('#requestOrigin').val(planType);
            jQuery('#mo2fa_loginform').submit();
        }
        function mo2f_register_and_upgradeform(planType) 
        {
                    jQuery('#requestOrigin').val(planType);
                    jQuery('input[name="requestOrigin"]').val(planType);
                    jQuery('#mo2fa_register_to_upgrade_form').submit();
        }

		function mo_2fa_lite_show_plans()
    	{
    		document.getElementById('mo_2fa_lite_features_only').style.display = "block";
    		document.getElementById('mo_2fa_features_only').style.display = "none";
    		document.getElementById('mo_ns_features_only').style.display = "none";
    		document.getElementById('mo2f_features_id').style.display = "none";
    		document.getElementById('mo_addon_features_only').style.display = "none";
    		document.getElementById('mo2f_2fa_lite_features_id').style.display = "block";
    		document.getElementById('mo_2fa_lite_licensing_plans_title').style.display = "none";
    		document.getElementById('mo_2fa_lite_licensing_plans_title1').style.display = "block";
    		document.getElementById('mo_ns_licensing_plans_title').style.display = "block"; 
    		document.getElementById('mo_ns_licensing_plans_title1').style.display = "none";
    		document.getElementById('mo_2fa_licensing_plans_title').style.display = "block"; 
    		document.getElementById('mo_2fa_licensing_plans_title1').style.display = "none";    	
    		document.getElementById('mo_addon_licensing_plans_title').style.display = "none";
    		document.getElementById('mo_addon_licensing_plans_title1').style.display = "block";

    	}
		function mo_2fa_show_plans()
    	{
    		document.getElementById('mo_2fa_features_only').style.display = "block";
    		document.getElementById('mo_ns_features_only').style.display = "none";
    		document.getElementById('mo2f_features_id').style.display = "block";
    		document.getElementById('mo_addon_features_only').style.display = "none";
    		document.getElementById('mo2f_2fa_lite_features_id').style.display = "none";
    		document.getElementById('mo_2fa_lite_features_only').style.display = "none";
    		document.getElementById('mo_ns_licensing_plans_title').style.display = "block"; 
    		document.getElementById('mo_ns_licensing_plans_title1').style.display = "none";
    		document.getElementById('mo_2fa_licensing_plans_title').style.display = "none"; 
    		document.getElementById('mo_2fa_licensing_plans_title1').style.display = "block"; 
    		document.getElementById('mo_2fa_lite_licensing_plans_title').style.display = "block";
    		document.getElementById('mo_2fa_lite_licensing_plans_title1').style.display = "none";
    		document.getElementById('mo_addon_licensing_plans_title').style.display = "none";
    		document.getElementById('mo_addon_licensing_plans_title1').style.display = "block";

    	}
    	function mo_ns_show_plans()
    	{
    		document.getElementById('mo_2fa_features_only').style.display = "none";
    		document.getElementById('mo_ns_features_only').style.display = "block";
    		document.getElementById('mo2f_features_id').style.display = "none";
    		document.getElementById('mo_addon_features_only').style.display = "none";
    		document.getElementById('mo2f_2fa_lite_features_id').style.display = "none";
    		document.getElementById('mo_2fa_lite_features_only').style.display = "none";
    		document.getElementById('mo_2fa_licensing_plans_title').style.display = "block";
    		document.getElementById('mo_2fa_licensing_plans_title1').style.display = "none"; 
    		document.getElementById('mo_ns_licensing_plans_title1').style.display = "block";
    		document.getElementById('mo_ns_licensing_plans_title').style.display = "none";
    		document.getElementById('mo_2fa_lite_licensing_plans_title').style.display = "block";
    		document.getElementById('mo_2fa_lite_licensing_plans_title1').style.display = "none"; 
    		document.getElementById('mo_addon_licensing_plans_title').style.display = "none";
    		document.getElementById('mo_addon_licensing_plans_title1').style.display = "block";

    	}
    	function mo_addon_show_plans()
    	{
    		document.getElementById('mo_addon_features_only').style.display = "block";
    		document.getElementById('mo_2fa_features_only').style.display = "none";
    		document.getElementById('mo_ns_features_only').style.display = "none";
    		document.getElementById('mo2f_features_id').style.display = "none";
    		document.getElementById('mo_addon_licensing_plans_title').style.display = "block";
    		document.getElementById('mo_addon_licensing_plans_title1').style.display = "none";
    		document.getElementById('mo_ns_licensing_plans_title').style.display = "block"; 
    		document.getElementById('mo_ns_licensing_plans_title1').style.display = "none";
    		document.getElementById('mo_2fa_licensing_plans_title').style.display = "block"; 
    		document.getElementById('mo_2fa_licensing_plans_title1').style.display = "none";
			document.getElementById('mo2f_2fa_lite_features_id').style.display = "none";
    		document.getElementById('mo_2fa_lite_features_only').style.display = "none";
    		document.getElementById('mo_2fa_lite_licensing_plans_title').style.display = "block";
    		document.getElementById('mo_2fa_lite_licensing_plans_title1').style.display = "none";

    	}
	</script>
