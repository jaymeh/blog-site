<?php

	global $mo2f_dirName;
	if(current_user_can( 'manage_options' ) && isset($_POST['mo_wpns_features']))
	{
		switch(sanitize_text_field(wp_unslash($_POST['mo_wpns_features'])))
		{
			case "mo_wpns_2fa_with_network_security":
				$security_features = new Mo_2fa_security_features();
				$security_features->wpns_2fa_with_network_security($_POST);			break;
			case "mo_wpns_2fa_features":
				$security_features = new Mo_2fa_security_features();
				$security_features->wpns_2fa_features_only();						break;

			
		}
	}

	
	$network_security_features= get_option('mo_wpns_2fa_with_network_security') 		? "checked" : "";


    
    include $mo2f_dirName . 'views'.DIRECTORY_SEPARATOR.'network_security_features.php';