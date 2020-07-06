<?php 
	add_action('admin_footer','mo_backup_config_page_submit');
?>


 <div class="mo_wpns_setting_layout">		
	<div class="mo_wpns_subheading"></div>
	<br>
	<form id="abc" method="post" action="">
		<input type="hidden" name="option" value="mo_wpns_backup_configuration">
		<table class="mo_wpns_settings_table">
		<tr>
			<td style="width:30%"><b>Select Folders to Backup : </b></td>
			<td>
			<input type="checkbox" name="mo_file_backup_wp_files" onclick="check()" id="mo__manual_file_wp_files" 
			value="1"<?php checked(get_site_option('mo_file_manual_backup_wp_files') == 1);?>> WordPress Files<br>
		
			<input type="checkbox" name="mo_file_backup_plugins" id="mo_file_manual_backup_plugins" value="1"<?php checked(get_site_option('mo_file_manual_backup_plugins') == 1);?>> WordPress Plugins folder<br>
			<input type="checkbox" name="mo_file_backup_themes" id="mo_file_manual_backup_themes" value="1"<?php checked(get_site_option('mo_file_manual_backup_themes') == 1);?>> WordPress Themes folder<br>
			
			<input type="checkbox" name="mo_database_backup"  value="1"<?php checked(get_site_option('mo_database_backup') == 1);?>> Database
			</td>
		</tr>
		
		<tr><td>&nbsp;</td><td></td></tr>
		
        <tr>
        	<td style="width: 30%"></td>
        	<td>
        	<input type = "hidden" id = "wpns_backup_settings_url" value="<?php echo wp_create_nonce('wpns-backup-settings') ?>" >
        	<input type="button" name="save_backup_settings" id="save_backup_settings" value ="Take Backup" style="width:120px;" class="mo_wpns_scan_button"  />
 
        	</td>
        </tr>
		</table>

	</form>
	<div class="file_backup_desc" hidden></div>
</div>
  
<?php
function mo_backup_config_page_submit(){
	$img_loader_url		= plugins_url('miniorange-2-factor-authentication'.DIRECTORY_SEPARATOR .'includes'.DIRECTORY_SEPARATOR .'images'.DIRECTORY_SEPARATOR .'loader.gif');
	$filemessage			= '<div id=\'filebackupmessage\'><h2>DO NOT :</h2><ol><li>Close this browser</li><li>Reload this page</li><li>Click the Stop or Back button.</li></ol><h2>Untill your file backup is completed</h2></div><br/><div class=\'filebackupmessage\'><h2><div id=\'backupinprogress\'> BACKUP IN PROGRESS</div></h2></div><div id=\'fileloader\' ><img  src=\"'.$img_loader_url.'\"></div>';
   $filemessage2a			= 'Backup is Completed. Check ';
   $filemessage2b			= ' file in <b>uploads/miniorangebackup</b> folder.';
?>
<script>

jQuery(document).ready(function(){
	jQuery('#save_backup_settings').click(function(){
  
       var message = "<?php echo $filemessage; ?>";
                jQuery(".file_backup_desc").empty();
			    jQuery(".file_backup_desc").append(message);
			    jQuery(".file_backup_desc").slideDown(400);
			    setInterval(function(){  jQuery("#backupinprogress").fadeOut(700); }, 1000);
			    setInterval(function(){  jQuery("#backupinprogress").fadeIn(700); }, 1000);
			    document.getElementById("save_backup_settings").value = "Taking Backup...";
			    jQuery('input[name="save_backup_settings"]').attr('disabled', true);
			    document.getElementById('save_backup_settings').style.backgroundColor = '#20b2aa';

		var data={
			'action':'mo_wpns_backup_redirect',
			'call_type':'submit_backup_settings_form',
			'backup_plugin':jQuery('input[name= "mo_file_backup_plugins"]:checked').val(),
			'backup_themes':jQuery('input[name= "mo_file_backup_themes"]:checked').val(),
			'backup_wp_files':jQuery('input[name= "mo_file_backup_wp_files"]:checked').val(),
			'database':jQuery('input[name= "mo_database_backup"]:checked').val(),
			'nonce'   :jQuery('#wpns_backup_settings_url').val(),
		};
		
		
  
		
			
			
			jQuery.post(ajaxurl, data, function(response){
             
			jQuery("#mo_backup_message").empty();
			jQuery("#mo_backup_message").hide();
			jQuery('#mo_backup_message').show(); 

			if (response == "ERROR"){
			jQuery('#mo_backup_message').empty();
            jQuery('#mo_backup_message').append("<div id='notice_div' class='overlay_error'><div class='popup_text'>&nbsp; &nbsp; ERROR</div></div>");
            window.onload = nav_popup();
            window.onload = barfw_response_handler('NONCE_ERROR','Nonce did not match');

			}else if(response == "not_writable"){
			jQuery('#mo_backup_message').empty();
                jQuery('#mo_backup_message').append("<div id='notice_div' class='overlay_error'><div class='popup_text'>&nbsp; &nbsp; We don't have write permission. Please give the permission to create folder in uploads</div></div>");
            window.onload = nav_popup();
            window.onload = barfw_response_handler('We do not have write permission. Please give the permission to create folder in uploads','Permission Denied');

			}
            else if(response == "folder_error")
            {
            	jQuery('#mo_backup_message').empty();
                jQuery('#mo_backup_message').append("<div id='notice_div' class='overlay_error'><div class='popup_text'>&nbsp; &nbsp;Please select atleast one file folder from manual backup. </div></div>");
           		 window.onload = nav_popup();
               window.onload = barfw_response_handler('NO FILES TO BACKUP.PLEASE CHANGE MANUAL SETTINGS','Please select at least one folder to backup');
            
            }
            else
            {
             var str = 'Your backup is created and store at this location  /uploads/miniorangebackup'
        	 window.onload = barfw_response_handler('BACKUP COMPLETED', str);

            }

           
         window.onload = nav_popup();
		});
			
	

	});

	});
function nav_popup() {
  jQuery("#notice_div").style.width = "40%";
  setTimeout(function(){ jQuery('#notice_div').fadeOut('slow'); }, 3000);
}

function barfw_response_handler(para1, para2){
	        jQuery(".filebackupmessage h2").empty();
        	jQuery(".filebackupmessage h2").append(para1);

        	jQuery("#fileloader").empty();
        	
        	jQuery("#fileloader").append(para2);    
        	jQuery(".filebackupmessage").css("background-color","#1EC11E");

        	jQuery('input[name="save_backup_settings"]').removeAttr('disabled');
			document.getElementById('save_backup_settings').style.backgroundColor = '#20b2aa';
			document.getElementById("save_backup_settings").value = "Take Backup";
}

function check() {
 if(jQuery('input[name= "mo_file_backup_wp_files"]:checked').val()){
 	jQuery('input[name="mo_file_backup_plugins"]').attr('disabled', true);
 	jQuery('input[name="mo_file_backup_themes"]').attr('disabled', true);
 	jQuery('#mo_file_manual_backup_plugins').prop('checked', false); // Unchecks it
    jQuery('#mo_file_manual_backup_themes').prop('checked', false); // Unchecks it
 }else{
 	jQuery('input[name="mo_file_backup_plugins"]').removeAttr('disabled');
 	jQuery('input[name="mo_file_backup_themes"]').removeAttr('disabled');
 }
}
if(jQuery('input[name= "mo_file_backup_wp_files"]:checked').val()){
 	jQuery('input[name="mo_file_backup_plugins"]').attr('disabled', true);
 	jQuery('input[name="mo_file_backup_themes"]').attr('disabled', true);
 	jQuery('#mo_file_manual_backup_plugins').prop('checked', false); // Unchecks it
    jQuery('#mo_file_manual_backup_themes').prop('checked', false); // Unchecks it
 }else{
 	jQuery('input[name="mo_file_backup_plugins"]').removeAttr('disabled');
 	jQuery('input[name="mo_file_backup_themes"]').removeAttr('disabled');
 } 

</script>
<?php }?>