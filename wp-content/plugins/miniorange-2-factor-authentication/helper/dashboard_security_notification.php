<?php

class miniorange_security_notification{


        function my_custom_dashboard_widgets() {
            global $wp_meta_boxes;

            wp_add_dashboard_widget('custom_help_widget', 'MiniOrange Website Security',array($this, 'custom_dashboard_help'));
     }

      function custom_dashboard_help() {
          global $wpdb,$type_of_scan,$total_scanned_files, $wpnsDbQueries;
          
         

          $fake_domains   = get_site_option('number_of_fake_reg');
          if($fake_domains == false){
            $fake_domains = 0;
          }  
          $failed_transaction = $wpnsDbQueries->get_count_of_attacks_blocked();
          $weakPass     = get_site_option('users_with_weak_pass');
          if($weakPass == false){
            $weakPass = 0;
          }
           
           $array = $wpdb->get_results("SELECT MAX(id) as id FROM ".$wpdb->base_prefix.'wpns_malware_scan_report');

           $latest_id = (int)$array[0]->id;

          $last_scan_malicious_count = $wpdb->get_results("SELECT COUNT(*) as total FROM ".$wpdb->base_prefix."wpns_malware_scan_report_details where report_id=".$latest_id);
          

           $total_malicious_count = $wpdb->get_results("SELECT COUNT(*) as total FROM ".$wpdb->base_prefix."wpns_malware_scan_report_details");
           
            $table_content =  $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix."wpns_malware_scan_report where id=".$latest_id);
            if(sizeof($table_content)>0){
             $type_of_scan = $table_content[0]->scan_mode;
             $total_scanned_files = $table_content[0]->scanned_files;
           }
           if($type_of_scan === null)
            $type_of_scan ='Not Scanned Yet';
           

           if($total_scanned_files === null)
            $total_scanned_files = '0';
          // -------------------------------------------------------------------------------------------------------->
           $array = $wpnsDbQueries->get_number_of_plugin_backup();
           $last_backup_create_time = get_option('backup_created_time');
           $last_backup = 'No Backup Util';
           if($array['total_backup'] !=0){
             $timestamp = time()-$last_backup_create_time;
             $days = $timestamp/(60*60*24);
             $day = (int)$days;
             if($day == 0){
              $last_backup ='Last Backup Create Today';
             }else{
              $last_backup= 'Last backup'.' '.$day.' '.'day ago';
             }
           }else{
             $last_backup = 'No Backup Until Now';
           }
           
          
          if(current_user_can('administrator'))
          {

          echo "<html>
                <head>
                <style>
                

              p{
              margin:0px;
             
              </style>
              </head>
             
     <div style='width:100%;background-color:#555f5f;padding-top:10px;''>
          <div style='font-size:25px;color:white;text-align:center'>
          <strong style='font-weight:300;''>Last Scan Result <span style='color:orange;'>[". $type_of_scan."]</span></strong>
      </div>
       <hr>
       <div>
        <table>
                <tbody>
                       
                            <tr>
                              <td style='border-collapse:collapse!important;color:#0a0a0a;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:normal'>
                                  <table dir='ltr'   style='table-layout:fixed;margin:10px 0 20px 0;padding:0;vertical-align:top;width:100%'>
                                    <tbody>
                                     

                                      <tr>
                                      <td style='text-align:center;font-size:36px;color:#ffffff;font-weight:400' ><strong>".$last_scan_malicious_count[0]->total."</strong></td>
                                      <td style='text-align:center;font-size:36px;color:#ffffff;font-weight:400'><strong>".$total_malicious_count[0]->total."</strong></td>
                                       

                                       <td style='text-align:center;font-size:36px;color:#ffffff;font-weight:400'><strong>".$total_scanned_files."</strong></td>
                                     
                                   
                                      </tr>
                                   
                                      <tr><td>&nbsp;</td><td></td></tr>
                                      <tr>
                                      <td style='font-size:18px;color:#ffffff;text-align:center'><strong style='font-weight:300;'>Current Infected Files </strong></td>
                                       <td style='font-size:18px;color:#ffffff;text-align:center'><strong style='font-weight:300;'>Total Infected Files Found</strong></td>
                                     
                                       <td style='font-size:18px;color:#ffffff;text-align:center'><strong style='font-weight:300;'>Total Files Scanned</strong></td>
                                   
                                      </tr>
                                    </tbody>
                                    </table>
                              </tr>  
                       </tbody>
               </table>
       </div>
     </div>

";
            
            echo '<a class="button button-primary" style="background-color:#f0a702;width:100%;text-align:center;" href="admin.php?page=mo_2fa_malwarescan&tab=default&view='.$latest_id.'"><h3 style="background-color:#f0a702">View Details</h3></a>';
          
         echo "<br><br><br>";

               echo "<div style='width:100%;background-color:#555f5f;padding-top:10px;'>
                    <div style='font-size:25px;color:white;text-align:center'>
                      <strong style='font-weight:300;'>Login and Spam<span style='color:orange;'>[ On your Website ]</span></strong>
                    </div>
                    <div>
                <table>
                <tbody>
                       
                  <tr>
                  <td style='border-collapse:collapse!important;color:#0a0a0a;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:normal'>
                    <table dir='ltr'   style='table-layout:fixed;margin:10px 0 20px 0;padding:0;vertical-align:top;width:100%'>
                      <tbody>
                        <tr>
                          <td style='text-align:center;font-size:36px;color:#ffffff;font-weight:400' ><strong>".$failed_transaction."</strong></td>
                          <td style='text-align:center;font-size:36px;color:#ffffff;font-weight:400'><strong>".$weakPass."</strong></td>
                          <td style='text-align:center;font-size:36px;color:#ffffff;font-weight:400'><strong>".$fake_domains."</strong></td>
                           
                       
                        </tr>
                       
                        <tr>
                        <td>&nbsp;
                        </td>
                        <td>
                        </td>
                        </tr>
                        <tr>
                        <td style='font-size:18px;color:#ffffff;text-align:center'><strong style='font-weight:300;'>Login Attempts Failed</strong></td>
                        <td style='font-size:18px;color:#ffffff;text-align:center'><strong style='font-weight:300;'>Users with weak passwords</strong></td>
                        <td style='font-size:18px;color:#ffffff;text-align:center'><strong style='font-weight:300;'>Fake Domain Registerations</strong></td>
                        
                        
                        </tr>
                     </tbody>
                    </table>
                    
                  </tr>  
              </tbody>
              </table>
              </div>
              <a class='button button-primary' style='background-color:#f0a702;width:100%;text-align:center' href='admin.php?page=mo_2fa_login_and_spam&tab=default&view==".$latest_id."'><h3 style='background-color:#f0a702'>View Details</h3></a>
              </div>";

         echo '<br><br>';

          echo "<div style='width:100%;background-color:#555f5f;padding-top:10px;'>
                    <div style='font-size:20px;color:white;text-align:center'>
                      <strong style='font-weight:300;'>Backup <span style='color:orange;'>[".$last_backup." ]</span></strong>
                    </div>
                    <hr>
                    <div>
                <table>
                <tbody>
                       
                  <tr>
                  <td style='border-collapse:collapse!important;color:#0a0a0a;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:normal'>
                    <table dir='ltr'   style='table-layout:fixed;margin:10px 0 20px 0;padding:0;vertical-align:top;width:100%'>
                      <tbody>
                        <tr>
                          <td style='text-align:center;font-size:36px;color:#ffffff;font-weight:400' ><strong>".$array['plugin_count']."</strong></td>
                          <td style='text-align:center;font-size:36px;color:#ffffff;font-weight:400'><strong>".$array['themes_count']."</strong></td>
                          <td style='text-align:center;font-size:36px;color:#ffffff;font-weight:400'><strong>".$array['wp_files_count']."</strong></td>
                          <td style='text-align:center;font-size:36px;color:#ffffff;font-weight:400'><strong>".$array['db_count']."</strong></td>
                       
                        </tr>
                       
                        <tr>
                        <td>&nbsp;
                        </td>
                        <td>
                        </td>
                        </tr>
                        <tr>
                        <td style='font-size:18px;color:#ffffff;text-align:center'><strong style='font-weight:300;'>Plugin Backup</strong></td>
                        <td style='font-size:18px;color:#ffffff;text-align:center'><strong style='font-weight:300;'>Themes Backup</strong></td>
                        <td style='font-size:18px;color:#ffffff;text-align:center'><strong style='font-weight:300;'>WP File Backup</strong></td>
                        <td style='font-size:18px;color:#ffffff;text-align:center'><strong style='font-weight:300;'>Database Backup</strong></td>
                        
                        </tr>
                     </tbody>
                    </table>
                    
                  </tr>  
              </tbody>
              </table>
              </div>

              <a class='button button-primary' style='background-color:#f0a702;width:100%;text-align:center' href='admin.php?page=mo_2fa_backup'><h3 style='background-color:#f0a702'>Take Backup</h3></a>
              </div>";  


              
             
      }

      

}

}

?>