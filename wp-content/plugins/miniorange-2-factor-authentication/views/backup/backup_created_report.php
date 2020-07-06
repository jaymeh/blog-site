<?php
?>


<div class="mo_wpns_setting_layout" id="backup_report_table">
<?php if(! isset($_GET['view']))?>	
		<h2>Backup Created Report</h2>
	
		<hr>
		<div id="backupdata">
			<table id="reports_table" class="display" cellspacing="0" width="100%">
            <thead><tr><th style="text-align:center">Created Time</th><th style="text-align:center">Backup Folders</th><th style="text-align:center">Storage</th><th style="text-align:center">Download</th><th style="text-align:center">Delete</th></tr></thead>
            <tbody>
 	        <br>
<?php 
				include_once $mo2f_dirName. 'controllers'.DIRECTORY_SEPARATOR.'backup'.DIRECTORY_SEPARATOR.'backup_created_result.php';
				echo showBackupResults();
			
		?></tbody>
	</table>
</div>
</div>

<?php                       
  function show_backup_report($file_path,$file_name,$timestamp,$id)	{
  	$time = date('m/d/Y H:i:s', $timestamp);
    $nonce = wp_create_nonce('mo-wpns-download-nonce');
        echo "<tr><td style=text-align:center>".$time."</td>";
    	echo "<td style=text-align:center>".$file_name."</td>";
    	echo "<td style=text-align:center>Local</td>";
        echo "<td><form action='' method='POST' enctype='multipart/form-data'>
        	  <input type='hidden' value='mo_wpns_backup_download' name='option' />
              <input type='hidden' value=".$file_name."/".$id." name='file_name' />
              <input type='hidden' value=".$file_path." name='file_path' />
              <input type='hidden' value=".$nonce." name='download_nonce'/>
              <input type='submit' value='Download' name='download' class='upload btn btn-info btn-xs'>
              </form>
              </td>";
        echo "<td><button type='button' onclick=\"backup_delete(this, '".addslashes($file_path)."','".$file_name."',".$id.")\" name='delete' id='delete'  class='btn btn-info btn-xs delete'>Delete</button></td>";
        echo "</tr>";
} ?>
<script>
function backup_delete(elmt, file_path,file_name,id){
	
	jQuery(document).ready(function(){
	
	 if(confirm("Are you sure you want to delete it?"))
    {	
 		var data={
			'action':'mo_wpns_backup_redirect',
			'call_type':'delete_backup',
			'file_name':file_name,
			'folder_name':file_path,
            'id'         :id,
            'nonce'      : '<?php echo wp_create_nonce("delete_entry");?>',
			
		};
		
		jQuery.post(ajaxurl, data, function(response){
			
			jQuery("#mo_backup_message").empty();
			if(response=="success"){
				jQuery('#mo_backup_message').append("<div id='notice_div' class='overlay_success'><div class='popup_text'>&nbsp; &nbsp; Backup delete successfully.</div></div>");
					window.onload = nav_popup();
             
				var row = elmt.parentNode.parentNode;
				row.parentNode.removeChild(row);
			}else if(response ==="notexist"){
				jQuery('#mo_backup_message').append("<div class= 'notice notice-error is-dismissible' style='height : 25px;padding-top: 10px;  ' >	Someone has deleted the backup by going to directory please refreash the page </div>");
				jQuery('#mo_backup_message').append("<div id='notice_div' class='overlay_error'><div class='popup_text'>&nbsp; &nbsp;  Someone has deleted the backup by going to directory please refreash the page</div></div>");
					window.onload = nav_popup();
			}
		});
   }
	
});
	
}
jQuery("#reports_table").DataTable({
				"order": [[ 1, "desc" ]]
			});

function nav_popup() {
  document.getElementById("notice_div").style.width = "40%";
  setTimeout(function(){ jQuery('#notice_div').fadeOut('slow'); }, 3000);
}
</script>
