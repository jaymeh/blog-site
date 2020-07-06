<?php
	$user   = wp_get_current_user();
	$mo2f_second_factor = mo2f_get_activated_second_factor( $user );

	global $Mo2fdbQueries;

	$is_customer_admin_registered = get_option( 'mo_2factor_admin_registration_status' );
	$configured_2FA_method        = $Mo2fdbQueries->get_user_detail( 'mo2f_configured_2FA_method', $user->ID );

	if ( $mo2f_second_factor == 'GOOGLE AUTHENTICATOR' ) {
		$app_type = get_user_meta( $user->ID, 'mo2f_external_app_type', true );

		if ( $app_type == 'Google Authenticator' ) {
			$selectedMethod = 'Google Authenticator';
		} else if ( $app_type == 'Authy Authenticator' ) {
			$selectedMethod = 'Authy Authenticator';
		} else {
			$selectedMethod = 'Google Authenticator';
			update_user_meta( $user->ID, 'mo2f_external_app_type', $selectedMethod );
		}
		$testMethod=$selectedMethod;
	} else {
		$selectedMethod = mo2f_decode_2_factor( $mo2f_second_factor, "servertowpdb" );
		$testMethod=$selectedMethod;
	}
				
	if($testMethod=='NONE'){
				$testMethod = "Not Configured"; 
		}
	
    if ( $selectedMethod !== 'NONE' and !MO2F_IS_ONPREM) {
		$Mo2fdbQueries->update_user_details( $user->ID, array(
			'mo2f_configured_2FA_method'                                         => $selectedMethod,
			'mo2f_' . str_replace( ' ', '', $selectedMethod ) . '_config_status' => true
		) );
		update_option('mo2f_configured_2_factor_method', $selectedMethod);
	}

	if ( $configured_2FA_method == "OTP Over SMS" ) {
		update_option( 'mo2f_show_sms_transaction_message', 1 );
	} else {
		update_option( 'mo2f_show_sms_transaction_message', 0 );
	} 
	$is_customer_admin          = current_user_can( 'manage_options' ) && get_option( 'mo2f_miniorange_admin' ) == $user->ID;
	$can_display_admin_features = ! $is_customer_admin_registered || $is_customer_admin ? true : false;

	$is_customer_registered = $Mo2fdbQueries->get_user_detail( 'user_registration_with_miniorange', $user->ID ) == 'SUCCESS' ? true : false;
	if ( get_user_meta( $user->ID, 'configure_2FA', true ) ) {

		$current_selected_method = get_user_meta( $user->ID, 'mo2f_2FA_method_to_configure', true );
        echo '<div class="mo_wpns_setting_layout">';
			mo2f_show_2FA_configuration_screen( $user, $current_selected_method );
        echo '</div>';
	} else if ( get_user_meta( $user->ID, 'test_2FA', true ) ) {
		$current_selected_method = get_user_meta( $user->ID, 'mo2f_2FA_method_to_test', true );
        echo '<div class="mo_wpns_setting_layout">';
			mo2f_show_2FA_test_screen( $user, $current_selected_method );
        echo '</div>';
	}else if ( get_user_meta( $user->ID, 'register_account_popup', true ) && $can_display_admin_features ) {
        display_customer_registration_forms( $user ); 
	} else {
		$is_NC = get_option( 'mo2f_is_NC' );
		$free_plan_existing_user = array(
			"Email Verification",
			"OTP Over SMS",
			"Security Questions",
			"miniOrange QR Code Authentication",
			"miniOrange Soft Token",
			"miniOrange Push Notification",
			"Google Authenticator",
			"Authy Authenticator"

		);

		$free_plan_new_user = array(
			"Google Authenticator",
			"Security Questions",
			"miniOrange Soft Token",
			"miniOrange QR Code Authentication",
			"miniOrange Push Notification"
		);

		$standard_plan_existing_user = array(
		        "",
			"OTP Over Email",
			"OTP Over SMS and Email"
		);

        $standard_plan_new_user = array(
		        "",
			"Email Verification",
			"OTP Over SMS",
			"OTP Over Email",
			"OTP Over SMS and Email",
			"Authy Authenticator"
		);

		$premium_plan = array(
			"Hardware Token"
		);

        if(MO2F_IS_ONPREM)
        {
            $free_plan_existing_user = array(
            "Email Verification",
            "Security Questions",
            "Google Authenticator",
            );

            $free_plan_new_user = array(
            "Google Authenticator",
            "Security Questions",
            );
            $premium_plan = array(
            "Hardware Token",
            "miniOrange QR Code Authentication",
            "miniOrange Soft Token",
            "miniOrange Push Notification",
            "Authy Authenticator"            

            );  
            $standard_plan_existing_user = array(
                "",
            "OTP Over Email",
            "OTP Over SMS and Email",
            "OTP Over SMS"
            );
            $standard_plan_new_user =  array(
                "",
            "Email Verification",
            "OTP Over SMS",
            "OTP Over Email",
            "OTP Over SMS and Email"        
            );  
        }

		$free_plan_methods_existing_user     = array_chunk( $free_plan_existing_user, 3 );
		$free_plan_methods_new_user          = array_chunk( $free_plan_new_user, 3 );
		$standard_plan_methods_existing_user = array_chunk( $standard_plan_existing_user, 3 );
		$standard_plan_methods_new_user      = array_chunk( $standard_plan_new_user, 3 );

		$premium_plan_methods_existing_user  = array_chunk( array_merge( $standard_plan_existing_user, $premium_plan) , 3 );
		$premium_plan_methods_new_user       = array_chunk( array_merge( $standard_plan_new_user, $premium_plan ), 3 );
        $showOTP=FALSE;
        if(MO2F_IS_ONPREM)
        {
            $selectedMethod         = get_user_meta($user->ID,'currentMethod',true);  
						
            $is_customer_registered = true;
            $testMethod             = $selectedMethod;
            if($selectedMethod == '')
            {
                $selectedMethod = 'NONE';
                $testMethod     = 'Not Configured'; 
            }
			
			if($selectedMethod=="Google Authenticator"){
                $currentTimeSlice = floor(time() / 30);
				include_once $mo2f_dirName . DIRECTORY_SEPARATOR. 'handler'.DIRECTORY_SEPARATOR. 'twofa' . DIRECTORY_SEPARATOR . 'gaonprem.php';
				$gauth_obj= new Google_auth_onpremise();
				$secret= $gauth_obj->mo_GAuth_get_secret($user->ID);
                $i = get_option('mo2f_time_slice',0);
				$otpcode = $gauth_obj->getCode($secret, $currentTimeSlice + $i);
				$showOTP=TRUE;
			}
			
          //  $premium_plan_methods_existing_user  = array_chunk( array_merge( $standard_plan_existing_user, $premium_plan , 3 );
            //$premium_plan_methods_new_user       = array_chunk( array_merge( $standard_plan_new_user, $premium_plan ), 3 );
        

        } 

        ?>
        <div id="wpns_message"></div>
        <div class="mo_wpns_setting_layout">
            <div>
                <div>
                    <a class="mo2f_view_free_plan_auth_methods" onclick="show_free_plan_auth_methods()">
                        <img src="<?php echo plugins_url( 'includes/images/right-arrow.png"', dirname(dirname(__FILE__ ))); ?>"
                             class="mo2f_2factor_heading_images" style="margin-top: 2px;"/>
                        <p class="mo2f_heading_style" style="padding:0px;"><?php echo mo2f_lt( 'Authentication methods' ); ?>
							<?php if ( $can_display_admin_features ) { ?>
                                <span style="color:limegreen">( <?php echo mo2f_lt( 'Current Plan' ); ?> )</span>
							<?php } ?>
							<?php if($showOTP){?>
							<span style="color:black">[ <?php echo mo2f_lt( 'Current OTP: ' ). $otpcode; ?> (<span style="color:blue" onclick="window.location.reload();">Refresh</span>)] </span>
							<?php } ?>
							<button class="btn btn-primary btn-large" id="test" style="float:right; margin-right: 20px; height: 36px" onclick="testAuthenticationMethod('<?php echo $selectedMethod; ?>');"
							<?php echo $is_customer_registered && ( $selectedMethod != 'NONE' ) ? "" : " disabled "; ?>>Test : <?php echo $testMethod;?> 
							</button>
                        </p>
                    </a>
					

                </div>
				<?php 
    				// if ( in_array( $selectedMethod, array(
    					// "Google Authenticator",
    					// "miniOrange Soft Token",
    					// "Authy Authenticator",
         //                "Security Questions",
         //                "miniOrange Push Notification",
         //                "miniOrange QR Code Authentication"
    				// ) ) ) { 
                        ?>
                        <?php if(current_user_can('administrator')){ ?>
                        <div style="float:right;">
                            <form name="f" method="post" action="" id="mo2f_enable_2FA_on_login_page_form">
                                <input type="hidden" name="option" value="mo2f_enable_2FA_on_login_page_option"/>
    							<input type="hidden" name="mo2f_enable_2FA_on_login_page_option_nonce"
    							value="<?php echo wp_create_nonce( "mo2f-enable-2FA-on-login-page-option-nonce" ) ?>"/>

                                <input type="checkbox" id="mo2f_enable_2fa_prompt_on_login_page"
                                       name="mo2f_enable_2fa_prompt_on_login_page" 
                                       value="1" <?php checked( get_option( 'mo2f_enable_2fa_prompt_on_login_page' ) == 1 );

    							if (!current_user_can('administrator') && ! in_array( $Mo2fdbQueries->get_user_detail( 'mo_2factor_user_registration_status', $user->ID ), array(
    								'MO_2_FACTOR_PLUGIN_SETTINGS',
    								'MO_2_FACTOR_INITIALIZE_TWO_FACTOR'
    							) ) ) {
    								echo 'disabled';
    							} 
                                ?> onChange="document.getElementById('mo2f_enable_2fa_prompt_on_login_page').form.submit()"/>
    							<?php echo mo2f_lt( 'Enable 2FA prompt on the WP Login Page' ); ?>
                            </form>
                        </div>
                        
                    <?php 
                ?>
               <br>
                <?php
                }
                 ?>
    					<?php
    				// }
                    // else
                    // {
                    //     update_option( 'mo2f_enable_2fa_prompt_on_login_page', 1 );
                    // }
				 echo mo2f_create_2fa_form( $user, "free_plan", $is_NC ? $free_plan_methods_new_user : $free_plan_methods_existing_user, $can_display_admin_features ); ?>
            </div>
            <hr>
			<?php if ( $can_display_admin_features ) { ?>
                <div>
                   <span id="mo2f_premium_plan"> <a class="mo2f_view_premium_plan_auth_methods" onclick="show_premium_auth_methods()">
                        <img src="<?php echo plugins_url( 'includes/images/right-arrow.png"', dirname(dirname(__FILE__))); ?>"
                             class="mo2f_2factor_heading_images"/>
                        <p class="mo2f_heading_style"><?php echo mo2f_lt( 'Premium plan - Authentication methods' ); ?>
                                *</p></a></span>
					<?php echo mo2f_create_2fa_form( $user, "premium_plan", $is_NC ? $premium_plan_methods_new_user : $premium_plan_methods_existing_user ); ?>

                </div>
                <hr>
                <br>
                <p><?php if(current_user_can('administrator')){ ?>
                    * <?php echo mo2f_lt( 'These authentication methods are available in the STANDARD and PREMIUM plans' ); ?>
                    . <a
                            href="admin.php?page=mo_2fa_upgrade"><?php echo mo2f_lt( 'Click here' ); ?></a> <?php echo mo2f_lt( 'to learn more' ) ?>
                    .</p>
				<?php }} ?>
                <form name="f" method="post" action="" id="mo2f_2factor_test_authentication_method_form">
                    <input type="hidden" name="option" value="mo_2factor_test_authentication_method"/>
                    <input type="hidden" name="mo2f_configured_2FA_method_test" id="mo2f_configured_2FA_method_test"/>
					<input type="hidden" name="mo_2factor_test_authentication_method_nonce"
							value="<?php echo wp_create_nonce( "mo-2factor-test-authentication-method-nonce" ) ?>"/>
                </form>
                <form name="f" method="post" action="" id="mo2f_2factor_resume_flow_driven_setup_form">
                    <input type="hidden" name="option" value="mo_2factor_resume_flow_driven_setup"/>
					<input type="hidden" name="mo_2factor_resume_flow_driven_setup_nonce"
							value="<?php echo wp_create_nonce( "mo-2factor-resume-flow-driven-setup-nonce" ) ?>"/>
                </form>
        </div>
        <div id="EnterEmail" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
            <!--    <span class="close">&times;</span>  -->
                <div class="modal-header">
                    <h3 class="modal-title" style="text-align: center; font-size: 20px; color: #20b2aa">Email Address</h3><span id="closeEnterEmail" class="modal-span-close">X</span>
                </div>
                <div class="modal-body" style="height: auto">
                    <h2><i>Enter your Email address :&nbsp;&nbsp;&nbsp;  <input type ='email' id='emailEntered' name='emailEntered' size= '50' required value=<?php echo $email;?>></i></h2> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="mo_wpns_button mo_wpns_button1 modal-button" id="save_entered_email">Save</button>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
        jQuery('#test').click(function(){
                jQuery("#test").attr("disabled", true);
            });
           
            jQuery('#closeEnterEmail').click(function(){
                jQuery('#EnterEmail').css('display', 'none');
                        });
            var emailinput = document.getElementById("emailEntered");
            emailinput.addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("save_entered_email").click();
                }   
            });
            jQuery('#save_entered_email').click(function(){
                var email   = jQuery('#emailEntered').val();
                var nonce   = '<?php echo wp_create_nonce('EmailVerificationSaveNonce');?>';
                var user_id = '<?php echo get_current_user_id();?>';
                if(email != '')
                {
                    var data = {
                    'action'                        : 'mo_two_factor_ajax',
                    'mo_2f_two_factor_ajax'         : 'mo2f_save_email_verification', 
                    'nonce'                         : nonce,
                    'email'                         : email,
                    'user_id'                       : user_id
                    };
                    jQuery.post(ajaxurl, data, function(response) {    
                            var response = response.replace(/\s+/g,' ').trim();
                            if(response=="settingsSaved")
                            {
                                jQuery('#mo2f_configured_2FA_method_free_plan').val('EmailVerification');
                                jQuery('#mo2f_selected_action_free_plan').val('select2factor');
                                jQuery('#mo2f_save_free_plan_auth_methods_form').submit();
                            }
                            else if(response == "NonceDidNotMatch")
                            {
                                jQuery('#wpns_message').empty();
				jQuery('#wpns_message').append("<div id='notice_div' class='overlay_success'><div class='popup_text'>&nbsp; &nbsp; An unknown error has occured.</div></div>");
                                window.onload = nav_popup();
                            }else if(response=="USER_LIMIT_EXCEEDED"){
                                jQuery('#EnterEmail').css('display', 'none');
                                jQuery('#wpns_message').empty();
                                jQuery('#wpns_message').append("<div id='notice_div' class='overlay_error'><div class='popup_text'>&nbsp; &nbsp; Your limit of 3 users has exceeded. Please upgrade to premium plans for more users.</div></div>");
                                window.onload = nav_popup();
                            }
                            else
                            {
                                jQuery('#wpns_message').empty()
                                jQuery('#wpns_message').append("<div id='notice_div' class='overlay_error'><div class='popup_text'>&nbsp; &nbsp; Invalid Email.</div></div>");
                                window.onload = nav_popup();
                            }    
                            close_modal();
                        });
                }

            });
     //        function restart_tour() {
     //            tour.restart();
     //        }

     //        var tour = new Tour({
     //            name: "tour",
     //            steps: [
     //                {
     //                    element: "#GoogleAuthenticator_thumbnail_2_factor",
     //                    title: "Google Authenticator Method",
     //                    content: "Select the authentication method you wish to configure, for example Google Authenticator.",
     //                    backdrop:'body',
     //                    backdropPadding:'6'
     //                }, {
     //                    element: "#GoogleAuthenticator_configuration",
     //                      title: "Configure Second Factor",
     //                    content: "Click here to Configure Google Authenticator Method on your phone.",
     //                    backdrop:'body',
     //                    backdropPadding:'6'
     //                }, {
     //                    element: "#mo2f_selected_method",
     //                    title: "Selected Authentication Method",
     //                    content: "After the configuration, Google Authenticator will be set as your 2FA method.",
     //                    onPrev:function(tour){
     //                        jQuery("#mo2f_free_plan_auth_methods").show();
     //                        jQuery("#mo2f_standard_plan_auth_methods").hide();
     //                        jQuery("#mo2f_premium_plan_auth_methods").hide();
     //                    },
     //                    backdrop:'body',
     //                    backdropPadding:'6'
     //                }
     //            ,{
     //                    element: "#test",
     //                    title: "Test Configured Method",
     //                    content: "Please test the 2FA method you configured, to ensure it works.",
     //                    backdrop:'body',
     //                    backdropPadding:'6'
						 
     //                }
                    
					// , {
     //                    element: "#mo2f_need_help",
     //                    title: "Need Any Help?",
     //                    content: "Click here to reach us anytime you need any help with the plugin.",
     //                    backdrop:'body',
					// 	placement:'bottom',
     //                    backdropPadding:'6',
					// 	onNext: function(){
					// 		 mo2f_opensupport();
					// 	 }
     //                    }
					
     //            ,{
     //                    element: "#mo2f_upgrade",
     //                    title: "Premium Plans",
     //                    content: "For the Standard & Premium features we provide, click here to view & upgrade.",
     //                    placement: 'bottom',
     //                backdrop:'body',
     //                backdropPadding:'6'
     //                }
     //            ,
     //                {
     //                    element: "#mo2f_restart_tour",
     //                    title: "Restart Tour",
     //                    content: "Click here to restart the tour whenever you wish.",
     //                    backdrop:'body',
     //                    backdropPadding:'6'
     //                }


     //            ]});

     //        // Initialize the tour
     //        tour.init();

     //        // Start the tour
     //        tour.start();

     //        cosole.log('saasdsa');
            function configureOrSet2ndFactor_free_plan(authMethod, action) {
                if(authMethod == 'EmailVerification')
                {
                    var is_onprem       = '<?php echo MO2F_IS_ONPREM;?>';
                    var is_registered   = '<?php echo $email_registered;?>';
                    if(is_onprem == 1 && is_registered!=0 && action != 'select2factor')
                    {
                        jQuery('#EnterEmail').css('display', 'block');
                        jQuery('.modal-content').css('width', '35%');
                    }
                    else
                    {
                        jQuery('#mo2f_configured_2FA_method_free_plan').val(authMethod);
                        jQuery('#mo2f_selected_action_free_plan').val(action);
                        jQuery('#mo2f_save_free_plan_auth_methods_form').submit();       
                    }
                } 
                else
                {
                    jQuery('#mo2f_configured_2FA_method_free_plan').val(authMethod);
                    jQuery('#mo2f_selected_action_free_plan').val(action);
                    jQuery('#mo2f_save_free_plan_auth_methods_form').submit();
                }            
            }

            function testAuthenticationMethod(authMethod) {
                jQuery('#mo2f_configured_2FA_method_test').val(authMethod);
                jQuery('#loading_image').show();

                jQuery('#mo2f_2factor_test_authentication_method_form').submit();
            }

            function resumeFlowDrivenSetup() {
                jQuery('#mo2f_2factor_resume_flow_driven_setup_form').submit();
            }


            function show_free_plan_auth_methods() {
                jQuery("#mo2f_free_plan_auth_methods").slideToggle(1000);                
            }


            function show_premium_auth_methods() {
                jQuery("#mo2f_premium_plan_auth_methods").slideToggle(1000);
            }

            jQuery("#how_to_configure_2fa").hide();

            function show_how_to_configure_2fa() {
                jQuery("#how_to_configure_2fa").slideToggle(700);
            }

function nav_popup() {
  document.getElementById("notice_div").style.width = "40%";
  setTimeout(function(){ $('#notice_div').fadeOut('slow'); }, 3000);
}
        </script>
<?php } ?>