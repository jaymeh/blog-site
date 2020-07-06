		<div class="mo_wpns_setting_layout">
		<h2>Custom Login Forms</h2>
		<p>We support most of the login forms present on the wordpress. And our plugin is tested with almost all the forms like Woocommerce, Ultimate Member, Restrict Content Pro and so on.</p>

        <div>
		<table class="customloginform" style="width: 100%;" align="left">
			<tr>
				<th style="width: 65%">
					Custom Login form
				</th>
				<th style="width: 22%">
					Show 2FA prompt on Custom login
					
				</th>
				<th style="width: 13%">
					Documents
					
				</th>
			</tr>
			<tr>
				<td>
					<?php echo '<img style="width:30px; height:30px;display: inline;" src="'.dirname(plugin_dir_url(dirname(__FILE__))).'/includes/images/woocommerce.png">';?><h3 style="margin-left: 15px; font-size: large; display: inline; float: inherit; padding-right: 50px;">Woocommerce</h3>
				</td>
				<td style="align-items: right;">
		<form id="woocommerce_login_prompt_form" method="post">
		<div align="center">
		<input  type="checkbox" name="woocommerce_login_prompt"  onchange="document.getElementById('woocommerce_login_prompt_form').submit();" <?php if(get_site_option('mo2f_woocommerce_login_prompt')){?> checked <?php } ?> <?php if(!get_site_option('mo2f_enable_2fa_prompt_on_login_page')){?> checked <?php } ?>/>
		</div>
		<input type="hidden" name="option" value="woocommerce_disable_login_prompt">
		 
		</form>
				</td>
				<td>
					<div style="text-align: center;">
						<a href="https://developers.miniorange.com/docs/security/wordpress/wp-security/setup-custom-login-form" target="blank"><span class="dashicons dashicons-text-page mo2f_doc_icon_style" style="font-size: 25px;color: #199C95"></span></a>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo '<img style="width:30px; height:30px;display: inline;" src="'.dirname(plugin_dir_url(dirname(__FILE__))).'/includes/images/ultimate_member.png">';?><h3 style="margin-left: 15px; font-size: large; display: inline; float: inherit;">Ultimate Member</h3>
				</td>
				<td style="text-align: center;">
					<input type="checkbox" name=""  checked>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo '<img style="width:30px; height:30px;display: inline;" src="'.dirname(plugin_dir_url(dirname(__FILE__))).'/includes/images/restrict_content_pro.png">';?><h3 style="margin-left: 15px; font-size: large; display: inline; float: inherit;">Restrict Content Pro</h3>
				</td>
				<td style="text-align: center;">
					<input type="checkbox" name="" checked>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td >
					<?php echo '<img style="width:30px; height:30px;display: inline;" src="'.dirname(plugin_dir_url(dirname(__FILE__))).'/includes/images/theme_my_login.png">';?><h3 style="margin-left: 15px; font-size: large; display: inline; float: inherit;">My Theme Login</h3>
				</td>
				<td style="text-align: center;">
					<input type="checkbox" name="" checked>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo '<img style="width:30px; height:30px;display: inline;" src="'.dirname(plugin_dir_url(dirname(__FILE__))).'/includes/images/user_registration.png">';?><h3 style="margin-left: 15px; font-size: large; display: inline; float: inherit;">User Registration</h3>
				</td>
				<td style="text-align: center;">
					<input type="checkbox" name="" checked>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo '<img style="width:30px; height:30px;display: inline;" src="'.dirname(plugin_dir_url(dirname(__FILE__))).'/includes/images/Custom_Login_Page_Customizer_LoginPress.png">';?><h3 style="margin-left: 15px; font-size: large; display: inline; float: inherit;">Custom Login Page Customizer | LoginPress</h3>
				</td>
				<td style="text-align: center;">
					<input type="checkbox" name="" checked>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo '<img style="width:30px; height:30px;display: inline;float: left;" src="'.dirname(plugin_dir_url(dirname(__FILE__))).'/includes/images/Admin_Custom_Login.png">';?><h3 style="margin-left: 15px; font-size: large; display: inline; float: inherit;">Admin Custom Login</h3>
				</td>
				<td style="text-align: center;">
					<input type="checkbox" name="" checked>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo '<img style="width:30px; height:30px;display: inline;float: left;" src="'.dirname(plugin_dir_url(dirname(__FILE__))).'/includes/images/RegistrationMagic_Custom_Registration_Forms_and_User_Login.png">';?><h3 style="margin-left: 15px; font-size: large; display: inline; float: inherit;">RegistrationMagic – Custom Registration Forms and User Login</h3>
				</td>
				<td style="text-align: center; ">
					<input type="checkbox" name="" checked>
				</td>
				<td>
				</td>
			</tr>

		</table>
		</div>
		<div style="float: left;">
		<br>
					<b style="color: red; " >**If you want to enable/disable 2FA prompt on other Custom login pages please Contact us.</b>
					<br>
					<b style="color: red;" >**This feature will only work when you enable 2FA prompt on wordpress login page.</li></b>

	<p style="font-size:15px">If there is any custom login form where Two Factor is not initiated for you, plese reach out to us by dropping a query in the <b>Support</b> section.</p>
</div>
</div>