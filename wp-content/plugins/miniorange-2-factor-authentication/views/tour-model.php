<!-- The Modal -->
<div id="getting-started" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
    <!--    <span class="close">&times;</span>  -->
        <div class="modal-header">
            <h3 class="modal-title" style="text-align: center; font-size: 30px; color: #2980b9"></h3><span id="tour-model" class="modal-span-close">X</span>
        </div>
        <div class="modal-body">
  			
        </div>
        <div class="modal-footer">
        	<a href="#" style="margin-right:50%; font-size: 20px;">Skip tour</a>
            <button type="button" style="margin-right:50%; display: none;" class="mo_wpns_button mo_wpns_button1 modal-button" id="skip-plugin-tour" >Previous</button>
            <button type="button" class="mo_wpns_button mo_wpns_button1 modal-button" id="start-plugin-tour">Start a tour</button>
        </div>
    </div>
</div>

<script type="text/javascript">
		var current_pointer = 0;
		var site_type = '';
		var site_elmt = '';
		var waf_pointer = <?php echo json_encode($main_pointer); ?>;
		var display = '<?php echo $display; ?>';
		// jQuery('.modal-title').html('<u>Do you want to enable Cloud version</u>');
		// jQuery('.modal-body').html('<h2 style="text-align: center">Enable Cloud version <label class="mo_wpns_switch_small"><input type="checkbox" class="mo_wpns_slider_body_large" name="mo_wpns_enable_htaccess_blocking" checked=""><span class="mo_wpns_slider_small mo_wpns_round_small"></span>				</label></h2>');
		jQuery('#getting-started').css('display', display);
		jQuery('.modal-title').html('<u>'+waf_pointer['Main'][0]+'</u>');
		jQuery('.modal-body').html(waf_pointer['Main'][1]);
		jQuery('#start-plugin-tour').html('Start a tour');
		jQuery('.modal-footer a').css('display', 'inline-block');
		// jQuery('.modal-footer a').css('display', 'none')
		// jQuery('.modal-content').css('width', '40%');
		// jQuery('#start-plugin-tour').text('Save');
		jQuery('#skip-plugin-tour').click(function(){
			if(current_pointer>=0){
				if(jQuery('#skip-plugin-tour').html() == 'Previous'){
					if(current_pointer === 0){
						current_pointer = current_pointer+1;
					}else if(current_pointer === 1){
						jQuery('#skip-plugin-tour').html('Skip tour');
						jQuery('#start-plugin-tour').html('Start a tour');
					}else{
						jQuery('#start-plugin-tour').html('Next');
					}
					current_pointer = current_pointer-1;
					scrolled = jQuery('.modal-body').scrollTop(0);
					jQuery('#body-para-instr').css('color', 'black');
					if(current_pointer == 0){
						jQuery('.modal-title').html('Step '+(current_pointer+1)+'-'+(waf_pointer[site_type].length+1)+': <u>'+waf_pointer['Main'][0]+'</u>');
						jQuery('.modal-body').html(waf_pointer['Main'][1]);
						jQuery('.modal-footer a').css('display', 'inline-block');
						jQuery('.modal-footer button:first-of-type').css('display', 'none');
						jQuery('#'+site_elmt).css({'color': '#ffffff', 'background-color': '#0073aa'});
					}else{
						jQuery('.modal-title').html('Step '+(current_pointer+1)+'-'+(waf_pointer[site_type].length+1)+': <u>'+waf_pointer[site_type][current_pointer-1][0]+'</u>');
						jQuery('.modal-body').html(waf_pointer[site_type][current_pointer-1][1]);
					}
				}
			}
		});

		jQuery('#restart-tour').click(function(){
			var data={
				'action': 'mo_wpns_malware_redirect',
				'call_type': 'wpns_enable_tour'
			};
			jQuery.post(ajaxurl, data, function(response){
				current_pointer = 0;
				jQuery('.modal-title').html('<u>'+waf_pointer['Main'][0]+'</u>');
				jQuery('.modal-body').html(waf_pointer['Main'][1]);
				jQuery('#start-plugin-tour').html('Start a tour');
				jQuery('.modal-footer a').css('display', 'inline-block');
				jQuery('.modal-footer button:first-of-type').css('display', 'none');
				jQuery('#getting-started').css('display', 'block');
			});
		});

		jQuery('.modal-footer a').click(function(){
			close_modal();
		});
		jQuery('#tour-model').click(function(){
			close_modal();
		});
		function close_modal(){
			var data={
				'action': 'mo_wpns_malware_redirect',
				'call_type': 'wpns_disable_tour'
			};
			jQuery.post(ajaxurl, data, function(response){
				site_elmt = '';
				site_type = '';
				jQuery('#getting-started').css('display', 'none');
			});
		}

		function open_hide(gettag){
			if(gettag.text == '+'){
				gettag.text='-';
				jQuery('#div-'+gettag.id).css({'overflow': '', 'height': ''});
			} else {
				gettag.text='+';
				jQuery('#div-'+gettag.id).css({'overflow': 'hidden', 'height': '50px'});
			}
		}

		function change_span_css(elmt){
			if(jQuery('#'+elmt.id).css('background-color') == 'rgb(255, 255, 255)'){
				jQuery('.modal-span').css({'color': '#0073aa', 'background-color': '#ffffff'});
				jQuery('#'+elmt.id).css({'color': '#ffffff', 'background-color': '#0073aa'});
				site_type = jQuery('#'+elmt.id).html();
				jQuery('#body-para-instr').css('color', 'black');
				site_elmt = elmt.id;
				jQuery('.modal-title').html('Step '+(current_pointer+1)+'-'+(waf_pointer[site_type].length+1)+': <u>'+waf_pointer['Main'][0]+'</u>');
			} else {
				jQuery('#'+elmt.id).css({'color': '#0073aa', 'background-color': '#ffffff'});
				site_elmt = '';
				site_type = '';
				jQuery('.modal-title').html('<u>'+waf_pointer['Main'][0]+'</u>');
			}
		}

		jQuery('#start-plugin-tour').click(function(){
			if(jQuery('#start-plugin-tour').text() == 'Save'){
				jQuery('.modal-title').html('<u>'+waf_pointer['Main'][0]+'</u>');
				jQuery('.modal-body').html(waf_pointer['Main'][1]);
				jQuery('#start-plugin-tour').html('Start a tour');
				jQuery('.modal-footer a').css('display', 'inline-block');
			}
			else if(site_type != ''){
				if (jQuery('#start-plugin-tour').text() == 'Close') {
					close_modal();
				}
				if(current_pointer<=waf_pointer[site_type].length+1){
					if(current_pointer == waf_pointer[site_type].length-1){
						jQuery('#start-plugin-tour').html('Close');
					}else if(current_pointer == waf_pointer[site_type].length){
						current_pointer = current_pointer-1;
					}else{
						jQuery('#skip-plugin-tour').html('Previous');
						jQuery('#start-plugin-tour').html('Next');
					}
					current_pointer = current_pointer+1;
					scrolled = jQuery('.modal-body').scrollTop(0);
					jQuery('.modal-footer a').css('display', 'none');
					jQuery('.modal-footer button:first-of-type').css('display', 'inline-block');
					jQuery('.modal-title').html('Step '+(current_pointer+1)+'/'+(waf_pointer[site_type].length+1)+': <u>'+waf_pointer[site_type][current_pointer-1][0]+'</u>');
					jQuery('.modal-body').html(waf_pointer[site_type][current_pointer-1][1]);
				}
			}else{
				jQuery('#body-para-instr').css('color', 'red');
			}
		})
</script>