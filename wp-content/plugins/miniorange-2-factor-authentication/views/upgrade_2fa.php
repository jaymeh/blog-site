<?php
	global $Mo2fdbQueries;
	$user = wp_get_current_user();
	$is_NC = get_option( 'mo2f_is_NC' );

	$is_customer_registered = $Mo2fdbQueries->get_user_detail( 'user_registration_with_miniorange', $user->ID ) == 'SUCCESS' ? true : false;

	$mo2f_feature_set = array(
		"Authentication Methods",
		"Language Translation Support",
		"Password Less Login",
		"Backup",
		"Multi-Site Support",
		"User role based redirection after Login",
		"Add custom Security Questions (KBA)",
		"Customize name in Google Authenticator app",
		"Brute Force Protection",
		"Blocking IP",
		"Monitoring",
		"Strong Password",
		"File Protection",
		"2FA for specific User Roles",
		"2FA for specific Users",
		"Choose specific authentication methods",
		"Force Two Factor for users",
		"Email Verification during 2FA Registration",
		"Enable Security Questions as backup",
		"App Specific Password from mobile Apps",
		"Support"
	);

	$mo2f_feature_description_set = array(
		"You can translate the plugin in a language of your choice",
		"After a valid username is entered, the 2FA prompt will be directly displayed",
		"By using backup you can restore the plugin settings",
		"Two Factor premium plugin works on both single site and multisite environment",
		"According to user's role the particular user will be redirected to specific location",
		"Add your own questions for your users.",
		"You can customize the account name in Google Authenticator app on mobile",
		"This protects your site from attacks which tries to gain access / login to a site with random usernames and passwords.",
		"Allows you to manually/automatically block any IP address that seems malicious from accessing your website. ",
		"Monitor activity of your users. For ex:- login activity, error report",
		"Increase security by enforcing users to set a strong password.",
		"Allows you to protect sensitive files through the malware scanner and other security features.",
		"Enable and disable 2fa for users based on roles(Like Administrator, Editor and others). It works for custom roles too.",
		"Enable or disable 2fa for a particular user.",
		"You can choose specific authentication methods for specific user roles",
		"Enforce user to setup 2nd factor during registration",
		"One time Email Verification for Users during 2FA Registration",
		"Allows for login using security questions in cases where physical access to the mobile isn’t possible",
		"For login into WordPress sites through mobile, a mobile specific password can be set",
		"24/7 support is available."
	);
	$two_factor_methods = array(
		"miniOrange QR Code Authentication",
		"miniOrange Soft Token",
		"miniOrange Push Notification",
		"Google Authenticator",
		"Security Questions",
		"Authy Authenticator",
		"Email Verification",
		"OTP Over SMS",
		"OTP Over Email",
		"OTP Over SMS and Email",
		"Hardware Token"
	);

	$two_factor_methods_EC          = array_slice( $two_factor_methods, 0, 7 );

	$mo2f_feature_set_with_plans_NC = array(
		"Authentication Methods"                                                => array(
			array_slice( $two_factor_methods, 0, 5 ),
			array_slice( $two_factor_methods, 0, 10 ),
			array_slice( $two_factor_methods, 0, 11 ),
			array_slice( $two_factor_methods, 0, 11 )
		),
		

		"Language Translation Support"                                          => array( true, true, true, true ),
		"Password Less Login"                             						=> array( false, true, true, true ),
		"Backup"                                          						=> array( false, true, true, true),
		"Multi-Site Support"                                                    => array( false, true, true, true ),
		"User role based redirection after Login"                               => array( false, true, true, true ),
		"Add custom Security Questions (KBA)"                                   => array( false, true, true, true ),
		"Add custom Security Questions (KBA)"                                   => array( false, true, true, true ),
		"Customize name in Google Authenticator app"                    => array( false, true, true, true ),
		"Brute Force Protection"												=> array( true, false, false, true ),
		"Blocking IP"															=> array( true, false, false, true ),
		"Monitoring"															=> array( true, false, false, true ),
		"Strong Password"														=> array( true, false, false, true ),
		"File Protection"														=> array( true, false, false, true ),
		"2FA for specific User Roles"                                    		=> array( false, true, true, true ),
		"2FA for specific Users"                                         		=> array( false, false, true, true ),
		"Choose specific authentication methods"                      			=> array( false, true, true, true ),
		"Force Two Factor for users"                        					=> array( false, false, true, true ),
		"Email Verification during 2FA Registration"         => array( false, false, true, true ),
		"Enable Security Questions as backup" 									=> array( false, false, true, true ),
		"App Specific Password from mobile Apps"                       			=> array( false, false, true, true ),
		"Support"                                                               => array(
			array("Basic Support by Email"),
			array("Priority Support by Email"),
			array( "Priority Support by Email", "Priority Support with GoTo meetings" ),
			array( "Priority Support by Email", "Priority Support with GoTo meetings" )
		),

	);

	$mo2f_feature_set_with_plans_EC = array(
		"Authentication Methods"                                                => array(
			array_slice( $two_factor_methods, 0, 8 ),
			array_slice( $two_factor_methods, 0, 10 ),
			array_slice( $two_factor_methods, 0, 11 ),
			array_slice( $two_factor_methods, 0, 11 )
		),
		
		"Language Translation Support"                                          => array( true, true, true, true ),
		"Password Less Login"                             => array( true, true, true, true ),
		"Backup"                                          						=> array( false, true, true, true),
		"Multi-Site Support"                                                    => array( false, true, true, true ),
		"Brute Force Protection"												=> array( true, false, false, true ),
		"Blocking IP"															=> array( true, false, false, true ),
		"Monitoring"															=> array( true, false, false, true ),
		"Strong Password"														=> array( true, false, false, true ),
		"File Protection"														=> array( true, false, false, true ),
		"User role based redirection after Login"                               => array( false, true, true, true ),
		"Add custom Security Questions (KBA)"                                   => array( false, true, true, true ),
		"Customize name in Google Authenticator app"                    		=> array( false, true, true, true ),
		"2FA for specific User Roles"                                    		=> array( false, false, true, true ),
		"2FA for specific Users"                                         		=> array( false, false, true, true ),
		"Choose specific authentication methods"                      			=> array( false, false, true, true ),
		"Force Two Factor for users"                        					=> array( false, true, true, true ),
		"Email Verification during 2FA Registration"         => array( false, false, true, true ),
		"Enable Security Questions as backup" 									=> array( false, false, true, true ),
		"App Specific Password from mobile Apps"                       			=> array( false, false, true, true ),
		"Support"                                                               => array(
			array("Basic Support by Email"),
			array("Priority Support by Email"),
			array( "Priority Support by Email", "Priority Support with GoTo meetings" ),
			array( "Priority Support by Email", "Priority Support with GoTo meetings" )
		),

	);

	$mo2f_addons           = array(
		"RBA & Trusted Devices Management Add-on",
		"Personalization Add-on",
		"Short Codes Add-on"
	);
	$mo2f_addons_plan_name = array(
		"RBA & Trusted Devices Management Add-on" => "wp_2fa_addon_rba",
		"Personalization Add-on"                  => "wp_2fa_addon_personalization",
		"Short Codes Add-on"                      => "wp_2fa_addon_shortcode"
	);


	$mo2f_addons_with_features = array(
		"Personalization Add-on"                  => array(
			"Custom UI of 2FA popups",
			"Custom Email and SMS Templates",
			"Customize 'powered by' Logo",
			"Customize Plugin Icon",
			"Customize Plugin Name",
			
		),
		"RBA & Trusted Devices Management Add-on" => array(
			"Remember Device",
			"Set Device Limit for the users to login",
		 "IP Restriction: Limit users to login from specific IPs"
		),
		"Short Codes Add-on"                      => array(
			"Option to turn on/off 2-factor by user",
			"Option to configure the Google Authenticator and Security Questions by user",
			"Option to 'Enable Remember Device' from a custom login form",
			"On-Demand ShortCodes for specific fuctionalities ( like for enabling 2FA for specific pages)"
		)
	);
	?>
    <div class="mo2f_licensing_plans" style="border:0px;width: 98%">
	
    <table class="table mo_table-bordered mo_table-striped" style="width: 100%">
        <thead>
        <tr>
        	<th class="mo2f_2fa_lite_plan_title"><h1 class="mo2f_white_color_style">Free</h1></th>
        	<th></th>
        	<th class="mo2f_2fa_lite_plan_title"><h1 class="mo2f_white_color_style">Standard</h1></th>
        	<th></th>
        	<th class="mo2f_2fa_lite_plan_title"><h1 class="mo2f_white_color_style">Premium</h1></th>
        	<th></th>
        	<th class="mo2f_2fa_lite_plan_title"><h1 class="mo2f_white_color_style">Enterprise</h1></th>
        </tr>
            
            
            </thead>
            <tbody class="mo_align-center mo-fa-icon">
			<?php for ( $i = 0; $i < count( $mo2f_feature_set ); $i ++ ) { ?>
                <tr>
                    	<?php
						$feature_set = $mo2f_feature_set[ $i ];
                   	
                   	if ( $is_NC ) {
						$f_feature_set_with_plan = $mo2f_feature_set_with_plans_NC[ $feature_set ];
					} else {
						$f_feature_set_with_plan = $mo2f_feature_set_with_plans_EC[ $feature_set ];
					}
					?>
                    <td class="mo2f_padding_style"><?php
                    	if ($feature_set == "Authentication Methods" || $feature_set == "Support") {
                    		?>
                    		<div>
                    		<?php
                    	}
                    	else
                    	{
                    		?>
                    		<div style="float: left;">
                    		<?php
                    	}
						if ( is_array( $f_feature_set_with_plan[0] ) ) {
							echo mo2f_create_li( $f_feature_set_with_plan[0] );
						} else {
							?>
							<div>
							<?php
							if ( gettype( $f_feature_set_with_plan[0] ) == "boolean" ) {
								echo mo2f_get_binary_equivalent( $f_feature_set_with_plan[0] );
							} else {
								echo $f_feature_set_with_plan[0];
							}
							echo $feature_set;
							?>
						</div></div>
						<?php
							if ($feature_set == "Backup") {
								?>
								<span style="float: left;">&nbsp;method</span>
								<?php 
							}
						?>
							<div style="float: right;">
							<?php
							if ($feature_set == "Backup") {
							
								echo mo2f_features_on_hover("Use Security Questions, OTP Over Email, Backup Codes as a backup method");
							}
							else
							{
							echo mo2f_features_on_hover($mo2f_feature_description_set[$i-1]);
							}
							?></div><?php
						} ?>
                    </td>
                    <td class="mo2f_black_background"></td>
                    <td  class="mo2f_padding_style"><?php
                    	if ($feature_set == "Authentication Methods" || $feature_set == "Support") {
                    		?>
                    		<div>
                    		<?php
                    	}
                    	else
                    	{
                    		?>
                    		<div style="float: left;">
                    		<?php
                    	}
                    	if($feature_set != "Authentication Methods")
                    	{
							if ( is_array( $f_feature_set_with_plan[1] ) ) {
								echo mo2f_create_li( $f_feature_set_with_plan[1] );
							} else {
								if ( gettype( $f_feature_set_with_plan[1] ) == "boolean" ) {
									echo mo2f_get_binary_equivalent( $f_feature_set_with_plan[1] );
								} else {
									echo $f_feature_set_with_plan[1];
								}
								echo $feature_set;
								?>
								</div>
							<?php
								if ($feature_set == "Backup") {
									?>
									<span style="float: left;">:- Security Questions (KBA)</span>
									<?php 
								}
							?>
							<div style="float: right;">
							<?php
							if ($feature_set == "Backup") {
								echo mo2f_features_on_hover("Security Questions is available as a backup method");
							}
							else
							{
							echo mo2f_features_on_hover($mo2f_feature_description_set[$i-1]);
							}
							?></div><?php
							}
						}
						if ($feature_set == "Authentication Methods") { 
                    		$feature_array_1[] = array_slice( $two_factor_methods, 0, 10 );
                    		for ($k=0; $k < 10 ; $k++) 
                    		{    
                    			if($is_NC)
                    			{        
	                    			if ($k<5) 
	                    			{
	                    				echo $feature_array_1[0][$k];
	                    				?><br><?php
	                    			}
	                    			else
	                    			{
		                    			?><b><?php
		                    			echo $feature_array_1[0][$k]; 
		                    			?></b><br><?php            			
	                    			}
                    			}
                    			else
                    			{
                    				if ($k<8) 
	                    			{
	                    				echo $feature_array_1[0][$k];
	                    				?><br><?php
	                    			}
	                    			else
	                    			{
		                    			?><b><?php
		                    			echo $feature_array_1[0][$k]; 
		                    			?></b><br><?php            			
	                    			}
                    			}
                    		}
                    		?>
                    		<?php                    	
                    	}
						 ?>
					</div>
                    </td>
                    <td class="mo2f_black_background"></td>
                    <td class="mo2f_padding_style"><?php
                    if ($feature_set == "Authentication Methods" || $feature_set == "Support") {
                    		?>
                    		<div>
                    		<?php
                    	}
                    	else
                    	{
                    		?>
                    		<div style="float: left;">
                    		<?php
                    	}
                    	if($feature_set != "Authentication Methods")
                    	{
							if ( is_array( $f_feature_set_with_plan[2] ) ) {
								echo mo2f_create_li( $f_feature_set_with_plan[2] );
							} else {
								if ( gettype( $f_feature_set_with_plan[2] ) == "boolean" ) {
									echo mo2f_get_binary_equivalent( $f_feature_set_with_plan[2] );
								} else {
									echo $f_feature_set_with_plan[2];
								}
								echo $feature_set;
								?>
								</div>
							<?php
								if ($feature_set == "Backup") {
									?>
									<span style="float: left;">:- KBA, OTP Over Email, Backup Codes</span>
									<?php 
								}
							?>
							<div style="float: right;">
							<?php
							if ($feature_set == "Backup") {
								echo mo2f_features_on_hover("Security Questions, OTP Over Email, Backup Codes are available as a backup method");
							}
							else
							{
							echo mo2f_features_on_hover($mo2f_feature_description_set[$i-1]);
							}
							?></div><?php
							}
						}
						 if ($feature_set == "Authentication Methods") { 
                    		$feature_array_3[] = array_slice( $two_factor_methods, 0, 11 );
                    		for ($k=0; $k < 11 ; $k++) 
                    		{          
                    			if ($is_NC) 
                    			{
	                    			if ($k<5) 
	                    			{
	                    				echo $feature_array_3[0][$k];
	                    				?><br><?php
	                    			}
	                    			else
	                    			{
		                    			?><b><?php
		                    			echo $feature_array_3[0][$k]; 
		                    			?></b><br><?php            			
	                    			}
                    			} 
                    			else
                    			{
                    				if ($k<8) 
	                    			{
	                    				echo $feature_array_3[0][$k];
	                    				?><br><?php
	                    			}
	                    			else
	                    			{
		                    			?><b><?php
		                    			echo $feature_array_3[0][$k]; 
		                    			?></b><br><?php            			
	                    			}
                    			} 
                    		}
                    		?>
                    		<?php                    	
                    	}?></div>
                    </td>
                    <td class="mo2f_black_background"></td>
					<td class="mo2f_padding_style"><?php
                    if ($feature_set == "Authentication Methods" || $feature_set == "Support") {
                    		?>
                    		<div>
                    		<?php
                    	}
                    	else
                    	{
                    		?>
                    		<div style="float: left;">
                    		<?php
                    	}
                    	if($feature_set != "Authentication Methods")
                    	{
							if ( is_array( $f_feature_set_with_plan[3] ) ) {
								echo mo2f_create_li( $f_feature_set_with_plan[3] );
							} else {
								if ( gettype( $f_feature_set_with_plan[3] ) == "boolean" ) {
									echo mo2f_get_binary_equivalent( $f_feature_set_with_plan[3] );
								} else {
									echo $f_feature_set_with_plan[3];
								}
								echo $feature_set;
								?>
								</div>
							<?php
								if ($feature_set == "Backup") {
									?>
									<span style="float: left;">:- KBA, OTP Over Email, Backup Codes</span>
									<?php 
								}
							?>
							<div style="float: right;">
							<?php
							if ($feature_set == "Backup") {
								echo mo2f_features_on_hover("Security Questions, OTP Over Email, Backup Codes are available as a backup method");
							}
							else
							{
							echo mo2f_features_on_hover($mo2f_feature_description_set[$i-1]);
							}
							?></div><?php
							}
						}
						 if ($feature_set == "Authentication Methods") { 
                    		$feature_array_4[] = array_slice( $two_factor_methods, 0, 11 );
                    		for ($k=0; $k < 11 ; $k++) 
                    		{          
                    			if ($is_NC) 
                    			{
	                    			if ($k<5) 
	                    			{
	                    				echo $feature_array_4[0][$k];
	                    				?><br><?php
	                    			}
	                    			else
	                    			{
		                    			?><b><?php
		                    			echo $feature_array_4[0][$k]; 
		                    			?></b><br><?php            			
	                    			}
                    			} 
                    			else
                    			{
                    				if ($k<8) 
	                    			{
	                    				echo $feature_array_4[0][$k];
	                    				?><br><?php
	                    			}
	                    			else
	                    			{
		                    			?><b><?php
		                    			echo $feature_array_4[0][$k]; 
		                    			?></b><br><?php            			
	                    			}
                    			} 
                    		}
                    		?>
                    		<?php                    	
                    	}?></div>
                    </td>
                </tr>
			<?php } ?>

            <tr>
                <td><b>Add-Ons</b></td><td class="mo2f_black_background"></td>
				<?php if ( $is_NC ) { ?>
                    <td><b>Purchase Separately</b></td><td class="mo2f_black_background"></td>
				<?php } else { ?>
                    <td><b>Purchase Separately</b></td><td class="mo2f_black_background"></td>
				<?php } ?>
                <td><b>Included</b></td><td class="mo2f_black_background"></td>
                <td><b>Included</b></td>
            </tr>
			<?php for ( $i = 0; $i < count( $mo2f_addons ); $i ++ ) { ?>
                <tr>
                    <td><?php echo $mo2f_addons[ $i ]; ?> <?php for ( $j = 0; $j < $i + 1; $j ++ ) { ?>*<?php } ?>
                    </td><td class="mo2f_black_background"></td>
					<?php if ( $is_NC ) { ?>
                        <td>
                             <button class="mo_wpns_button mo_wpns_button1" style="cursor:pointer"
                                onclick="mo2f_upgradeform('<?php echo $mo2f_addons_plan_name[ $mo2f_addons[ $i ] ]; ?>')" <?php echo $is_customer_registered ? "" : " disabled " ?> >
                            Purchase
                        </button>
                            
                        </td><td class="mo2f_black_background"></td>
					<?php } else { ?>
                        <td>Contact Us</td><td class="mo2f_black_background"></td>
					<?php } ?>
                    
                    <td><div style="color:#20b2aa;font-size: large;">✔</div></td><td class="mo2f_black_background"></td>
                    <td><div style="color:#20b2aa;font-size: large;">✔</div></td>
                </tr>
			<?php } ?>

            </tbody>
        </table>
        <hr><br>
        <div style="padding:10px;">
			<?php for ( $i = 0; $i < count( $mo2f_addons ); $i ++ ) {
				$f_feature_set_of_addons = $mo2f_addons_with_features[ $mo2f_addons[ $i ] ];
				for ( $j = 0; $j < $i + 1; $j ++ ) { ?>*<?php } ?>
                <b><?php echo $mo2f_addons[ $i ]; ?> Features</b>
                <br>
                <ol>
					<?php for ( $k = 0; $k < count( $f_feature_set_of_addons ); $k ++ ) { ?>
                        <li><?php echo $f_feature_set_of_addons[ $k ]; ?></li>
					<?php } ?>
                </ol>

                <hr><br>
			<?php } ?>
            <b>**** SMS Charges</b>
            <p><?php echo mo2f_lt( 'If you wish to choose OTP Over SMS / OTP Over SMS and Email as your authentication method,
                    SMS transaction prices & SMS delivery charges apply and they depend on country. SMS validity is for lifetime.' ); ?></p>
            <hr>
            <br>
            <div>
                <h2>Note</h2>
                <ol class="mo2f_licensing_plans_ol">
                    <li><?php echo mo2f_lt( 'The plugin works with many of the default custom login forms (like Woocommerce / Theme My Login), however if you face any issues with your custom login form, contact us and we will help you with it.' ); ?></li>
                    <li><?php echo mo2f_lt( 'There is no license key required to activate the Standard/Premium Plugins. You will have to just login with the miniOrange Account you used to make the purchase.' ); ?>
                    	
                    </li>
                </ol>
            </div>

            <br>
            <hr>
            
           

            <style>#mo2f_support_table {
                    display: none;
                }

            </style>
        </div>
    </div>

<?php 
function mo2f_create_li( $mo2f_array ) {
	$html_ol = '<ul>';
	foreach ( $mo2f_array as $element ) {
		$html_ol .= "<li>" . $element . "</li>";
	}
	$html_ol .= '</ul>';

	return $html_ol;
}
function mo2f_get_binary_equivalent( $mo2f_var ) {
	switch ( $mo2f_var ) {
		case 1:
			return "<div style='color: #20b2aa;font-size: large;float:left;margin:0px 5px;'>✔</div>";
		case 0:
			return "<div style='color: red;font-size: x-large;float:left;margin:0px 5px;'>×</div>";
		default:
			return $mo2f_var;
	}
}

function mo2f_features_on_hover( $mo2f_var ) {

	return '<div class="mo2f_tooltip"><span class="dashicons dashicons-info mo2f_info_tab"></span><br><span class="mo2f_tooltiptext" style="margin-left: -1089%;">'. $mo2f_var .'</span>';
}
