<?php global $nm_config, $scSuffixUrl; ?>
<div class="ui container" style="padding-top: 2rem;">
    <div class="ui grid">
        <div class="left floated twelve wide column" style="text-align: left;">
            <h3><?php echo $nm_lang['page_title']; ?></h3>
        </div>
        <div class="right two wide column" style="display: flex; flex-direction: row; justify-content: flex-end; align-items: center;">
            <?php nm_display_page_help('pub_dir'); ?>
        </div>
    </div>
    <div class="ui divider"></div>  
</div>    
<div class="ui container">
	<div class="ui fluid form">
         <button id="id_button_add"  class="ui button green"><?php echo $nm_lang['pubdir_btn_new']; ?></button>
         <button id="id_button_save" class="ui button primary" style="display:none"><?php echo $nm_lang['pubdir_btn_save']; ?></button>
         
         <?php 
         if(!isset($_SESSION['nm_session']['prod_v8']['pub_dir']['dir_data']) || empty($_SESSION['nm_session']['prod_v8']['pub_dir']['dir_data'])){
            $key = (isset($key) ? $key : '');
         ?>
         	<div id="id_field_block" class="inline fields" style="padding-top:1rem;display:none">
               	<div id="id_input_block" class="sixteen wide field" >
                    <!-- <label><?php echo $nm_lang['pubdir_input_label_dir']; ?></label> -->
                    <input type="text" name="field_dir[]" placeholder="<?php echo $_SESSION['nm_session']['prod_v8']['pub_dir']['placeholder']; ?>">
            	</div>
            	<div id='id_block_edit' class="field" style="display:none">
                   	<a id="id_input_edit_<?php echo $key; ?>" onclick="nm_edit_input($(this));">
                    	<i class="fa fa-edit nmIconSize" aria-hidden="true" style="cursor:pointer"></i></a>
            	</div>
            	<div id='id_block_save' class="field">
            		<a id="id_input_save_<?php echo $key; ?>" onclick="nm_save_input($(this));">
            			<i class="fas fa-check nmIconSize" style="cursor:pointer"></i>
            		</a>
            	</div>
            	<div id="id_block_remove" class="field" >
                 	<a id="id_input_trash_<?php echo $key; ?>" onclick="nm_del_input($(this));" >
                	<i class="fa fa-trash nmIconSize" aria-hidden="true" style="color:red;cursor:pointer"></i></a>
            	</div>
            </div>
            <div class="ui below pointing red basic label hidden" style="margin-top: 0;"><?php echo $nm_lang['pubdir_dir_err']; ?></div>
         <?php    
         }else{
             foreach($_SESSION['nm_session']['prod_v8']['pub_dir']['dir_data'] as $key =>  $item){
                 $read_only       = true;
                 $attr_read_only  = "";
                 $class_input_err = "";
                 $class_show_err  = " hidden ";
                 $error_color     = ' red ';
                 $is_sc_dir       = (isset($item[5]) ? $item[5] : '' );
                 $error_text      = "";
                 $key = (isset($key) ? $key : '');
                 if($read_only){
                     $attr_read_only = "readonly=true";
                 }
                 if(!is_dir($item[0])){
                     $class_input_err = ' input error ';
                     $class_show_err  = '';
                     $error_text      = $nm_lang['pubdir_dir_err'];
                 }
                 else if($is_sc_dir == 'false'){
                     $class_input_err = ' input error ';
                     $class_show_err  = '';
                     $error_text      = $nm_lang['pubdir_dir_not_sc'];
                     $error_color     = ' orange ';
                 }
                 
                 ?>
                 <div id="id_field_block" class="inline fields" style="padding-top:1rem">
                    
                   	<div id="id_input_block" class="ui input sixteen wide field <?php echo $class_input_err; ?>" >
                        <!--  <label><?php echo $nm_lang['pubdir_input_label_dir']; ?></label> -->
                        <input type="text" 
                        	   name="field_dir[]"  
                        	   value="<?php echo $item[0]; ?>"  
                        	   placeholder="<?php echo $_SESSION['nm_session']['prod_v8']['pub_dir']['placeholder']; ?>" 
                        	   <?php echo $attr_read_only; ?> >
                        
                        
                	</div>
        	    	<div id='id_block_edit' class="field" >
                       	<a id="id_input_edit_<?php echo $key; ?>" onclick="nm_edit_input($(this));">
                        	<i class="fa fa-edit nmIconSize" aria-hidden="true" style="cursor:pointer"></i></a>
                	</div>
        	    	<div id='id_block_save' class="field" style="display:none">
                		<a id="id_input_save_<?php echo $key; ?>" onclick="nm_save_input($(this));">
                			<i class="fas fa-check nmIconSize" style="cursor:pointer"></i>
                		</a>
                	</div>
                	<div id="id_block_remove" class="field" >
                     	<a id="id_input_trash_<?php echo $key; ?>" onclick="nm_del_input($(this));" >
                    	<i class="fa fa-trash nmIconSize" aria-hidden="true" style="color:red;cursor:pointer"></i></a>
                	</div>
                </div>
                <div class="ui below pointing <?php echo $error_color; ?> basic label <?php echo $class_show_err; ?>" style="margin-top: 0;"><?php echo $error_text; ?></div>
                 <?php
             }
         }
         ?>
	</div>
</div>
<div class="ui modal tiny" id="id_modal_general">
    <div id="id_header_title" class="ui header red" style="display:none">

    </div>
    <div class="image content">
        <div class="description">
            <div id="id_header_message" class="ui header red ">

            </div>
        </div>
    </div>
    <div class="actions">
        <div class="ui right button primary cancel">
            <?php echo $nm_lang['pubdir_btn_close']; ?>
        </div>
    </div>
</div>


<div class="ui modal tiny" id="id_modal_del_confirm">
  <div class="header" style="display:none"><i class="fa confirm-icon fa-exclamation-triangle" style="color: rgb(255, 154, 23);"></i></div>
  <div class="content">
    <h4><?php echo $nm_lang['pubdir_modal_del_message']; ?></h4>
  </div>
  <div class="actions">
    <div class="ui cancel button"><?php echo $nm_lang['pubdir_modal_del_cancel']; ?></div>
    <div class="ui approve button primary"><?php echo $nm_lang['pubdir_modal_del_ok']; ?></div>
  </div>
</div>
<div class="ui modal tiny" id="id_modal_double_dir">
  <div class="header" style="display:none"><i class="fa confirm-icon fa-exclamation-triangle" style="color: rgb(255, 154, 23);"></i></div>
  <div class="content">
    <h4><?php echo $nm_lang['pubdir_double_dir']; ?></h4>
  </div>
  <div class="actions">
    <div class="ui cancel button"><?php echo $nm_lang['pubdir_btn_close'] ; ?></div>
  </div>
</div>
<script>
function nm_edit_input(str_obj){
	str_obj.parent().parent().find('input').removeAttr("readonly");
	str_obj.parent().parent().find('input').parent().removeClass('ui transparent input');
	str_obj.parent().parent().find('input').focus();
	str_obj.parent().parent().find('input').select();
	str_obj.parent().hide();
	str_obj.parent().next().show();
	str_obj.parent().parent().find('#id_block_save').find('a').find('i').removeClass('fa-check').addClass('fa-save');
	str_obj.parent().parent().find('#id_block_save').addClass('disabled');
	str_obj.parent().parent().find('#id_block_remove').find('a').find('i').removeClass('fa-trash').addClass('fa-close');
	str_obj.parent().parent().find('#id_block_remove').find('a').attr('onclick','nm_close_edit($(this));');
	inputVal = str_obj.parent().parent().find('#id_input_block').find('input').val();
	str_obj.parent().parent().find('#id_input_block').find('input').on('input',function(){
		if($(this).val() != inputVal){
			str_obj.parent().parent().find('#id_block_save').removeClass('disabled');
		}else{
			str_obj.parent().parent().find('#id_block_save').addClass('disabled');
		}
	});
}
function nm_close_edit(str_obj){
	str_obj.parent().parent().find('input').attr("readonly",'true');
	str_obj.parent().parent().find('input').parent().addClass('ui input');
	str_obj.attr('onclick','nm_del_input($(this));');
	str_obj.find('i').removeClass('fa-close').addClass('fa-trash');
	str_obj.parent().parent().find('#id_block_save').hide();
	str_obj.parent().parent().find('#id_block_edit').show();
	
}

function nm_remove_input(str_obj){
	str_obj.parent().parent().remove();
	$("#id_button_add").removeClass('disabled');
}

function nm_save_input(str_obj){
	var DoubleDir = str_obj.parent().parent().find('input').val();
	var ScDir	  = DoubleDir;
	$.ajax({
		method: 'POST',
        url: '<?php echo $nm_config['url_lib'] . $scSuffixUrl . 'pub_dir.php'; ?>',
        data: {
            ajax: 'nm',
            nm_action: 'check_double_dir',
            data: DoubleDir,
            datatype: 'json',
        },
        success: function (response1) {
        	var obj_response1 = jQuery.parseJSON(response1);
        	if(obj_response1.result == 'success'){
        		if(obj_response1.double == 'true'){
        			 $('#id_modal_double_dir').modal({
            			blurring: true,
            		 }).modal('show');
        		}else if (obj_response1.double == 'false'){
        			var Data = [];
                	$('[name^="field_dir"]').each(function() {
                		Data.push($(this).val());
                	});
                	$.ajax({
                        method: 'POST',
                        url: '<?php echo $nm_config['url_lib'] . $scSuffixUrl . 'pub_dir.php'; ?>',
                        data: {
                            ajax: 'nm',
                            nm_action: 'pub_dir_save',
                            data: Data,
                            datatype: 'json',
                        },
                        success: function (response) {
                            var obj_response = jQuery.parseJSON(response);
                            if(obj_response.result == 'success'){
                            	$("#id_header_title").removeClass('red');
                            	$("#id_header_message").removeClass('red');
                            	$("#id_header_title").text("<?php   echo $nm_lang['pubdir_header_ok'];  ?>");
                            	$("#id_header_message").text("<?php echo $nm_lang['pubdir_message_ok']; ?>");
                            	$("#id_button_add").removeClass('disabled');
                            }else if(obj_response.result == 'error'){
                            	$("#id_header_title").addClass('red');
                            	$("#id_header_message").addClass('red');
                            	$("#id_header_title").text("<?php   echo $nm_lang['pubdir_header_err'];  ?>");
                            	$("#id_header_message").text("<?php echo $nm_lang['pubdir_message_err']; ?>");
                            }else{
                            	$("#id_header_title").addClass('red');
                            	$("#id_header_message").addClass('red');
                            	$("#id_header_title").text("<?php   echo $nm_lang['pubdir_header_err'];  ?>");
                            	$("#id_header_message").text("<?php echo $nm_lang['pubdir_message_general_err']; ?>");
                            }
                            $('#id_modal_general').modal({
                            	blurring: true,
                            	onHide: function(){
                            		str_obj.parent().hide();
                            		str_obj.parent().parent().parent().find('input').attr("readonly",'true');
                            		str_obj.parent().parent().parent().find('input').parent().addClass('ui input');
                            		
                            		str_obj.parent().parent().find('#id_block_edit').show();
                            		str_obj.parent().parent().find('#id_block_remove').find('a').attr('onclick','nm_del_input($(this));');
                            		str_obj.parent().parent().find('#id_block_remove').find('a').find('i').removeClass('fa-close').addClass('fa-trash');
                            	}
                            }).modal('show');
                        },
                        complete: function(){
                        	var Data2 = [];
                			Data2.push(str_obj.parent().parent().find('div').first().find('input').val());
                        	$.ajax({
                    			method: 'POST',
                                url: '<?php echo $nm_config['url_lib'] . $scSuffixUrl . 'pub_dir.php'; ?>',
                                data: {
                                    ajax: 'nm',
                                    nm_action: 'check_dir',
                                    data: Data2,
                                    datatype: 'json',
                                },
                                success: function (response2) {
                                	var obj_response2 = jQuery.parseJSON(response2);
                                	if(obj_response2.result == 'success'){
                                		if(obj_response2.is_dir == 'true'){
                                			$.ajax({
                                        		method: 'POST',
                                                url: '<?php echo $nm_config['url_lib'] . $scSuffixUrl . 'pub_dir.php'; ?>',
                                                data: {
                                                    ajax: 'nm',
                                                    nm_action: 'check_is_sc_folder',
                                                    data: ScDir,
                                                    datatype: 'json',
                                                },
                                                success: function (is_sc_dir) {
                                                	var obj_is_sc_dir = jQuery.parseJSON(is_sc_dir);
                                                	if(obj_is_sc_dir.result == 'success'){
                                                		if(obj_is_sc_dir.sc_dir == 'false'){
                                                			str_obj.parent().parent().find('div').first().addClass('error');
                                                            str_obj.parent().parent().next().removeClass('hidden').removeClass('red').addClass('orange');
                                                            str_obj.parent().parent().next().show();
                                                            str_obj.parent().parent().next().text('<?php echo $nm_lang['pubdir_dir_not_sc'];?>');
                                                		}else{
                                                			str_obj.parent().parent().find('div').first().removeClass('error');
                                							str_obj.parent().parent().next().hide();
                                                		}
                                                	}else{
                                               			$("#id_header_title").addClass('red');
                                                    	$("#id_header_message").addClass('red');
                                                    	$("#id_header_title").text("<?php   echo $nm_lang['pubdir_header_err'];  ?>");
                                                    	$("#id_header_message").text("<?php echo $nm_lang['pubdir_message_general_err']; ?>");
                                                    	$('#id_modal_general').modal({
                                                			blurring: true,
                                                		}).modal('show'); 	
                                                	}
                                                }
                                            });
                                		}else{
                                			str_obj.parent().parent().find('div').first().addClass('error');
                                			str_obj.parent().parent().next().removeClass('hidden');
                                			str_obj.parent().parent().next().show();
                                			str_obj.parent().parent().next().html("<?php echo $nm_lang['pubdir_dir_err']; ?>");
                                		}
                                	}
                                }
                    		});
                        }
                    });
        		}
        	}else{
        		$("#id_header_title").addClass('red');
            	$("#id_header_message").addClass('red');
            	$("#id_header_title").text("<?php   echo $nm_lang['pubdir_header_err'];  ?>");
            	$("#id_header_message").text("<?php echo $nm_lang['pubdir_message_general_err']; ?>");
            	$('#id_modal_general').modal({
        			blurring: true,
        		}).modal('show');
        	}
        }
	});
}

function nm_del_input(str_obj){
	var inputVal = str_obj.parent().parent().find('input').val();
	$("#id_modal_del_confirm").modal({
		blurring: true,
		onApprove: function(){
			str_obj.parent().parent().next().remove();
			str_obj.parent().parent().remove();
			
			if($('[id^="id_input_trash_"]').length == 1){
    			$('[id^="id_input_trash_"]').hide();
    		}
			$.ajax({
        		method: 'POST',
        		url: '<?php echo $nm_config['url_lib'] . $scSuffixUrl . 'pub_dir.php'; ?>',
        		data: {
        			ajax: 'nm',
        			nm_action: 'pub_dir_del',
        			data: inputVal,
        			datatype: 'json',
        		},
        		success: function (response){
        			var obj_response = jQuery.parseJSON(response);
        			if(obj_response.result == 'success'){
        				$("#id_header_title").removeClass('red');
        				$("#id_header_message").removeClass('red');
        				$("#id_header_title").text("<?php   echo $nm_lang['pubdir_header_ok'];  ?>");
        				$("#id_header_message").text("<?php echo $nm_lang['pubdir_message_ok']; ?>");
        			}else if(obj_response.result == 'error'){
        				$("#id_header_title").addClass('red');
        				$("#id_header_message").addClass('red');
        				$("#id_header_title").text("<?php   echo $nm_lang['pubdir_header_err'];  ?>");
        				$("#id_header_message").text("<?php echo $nm_lang['pubdir_message_err']; ?>");
        			}else{
        				$("#id_header_title").addClass('red');
        				$("#id_header_message").addClass('red');
        				$("#id_header_title").text("<?php   echo $nm_lang['pubdir_header_err'];  ?>");
        				$("#id_header_message").text("<?php echo $nm_lang['pubdir_message_general_err']; ?>");
        			}
        			$("#id_modal_general").modal({
        				blurring: true,
        				onHide: function(){
        					parent.nm_set_option('pub_dir','','nm_iframe');
        				}
        			}).modal('show');
        		}
        	});
		}
	}).modal('show');
}

$(document).ready(function(){
	$("#id_button_add").click(function(){
		$(this).addClass("disabled");
	
		var inputClone 	= $("#id_field_block").first().clone();
		$("#id_field_block").last().after(inputClone);
		$("#id_field_block").last().find('input').val("");
		$("#id_field_block").last().find('input').removeAttr("value");
		$("#id_field_block").last().find('input').removeAttr("readonly");
		$("#id_field_block").last().find('input').parent().removeClass("transparent input");
		$("#id_field_block").last().find('input').focus();
		
		$("#id_field_block").last().find('input').on('input',function(){
			if($(this).val() != "" || $(this).val().length > 0 ){
				$("#id_field_block").last().find('#id_block_save').removeClass('disabled');
			}else{
				$("#id_field_block").last().find('#id_block_save').addClass('disabled');
			}
		});
		    		
		$("#id_field_block").last().find('#id_block_remove').find('a').removeAttr('href');
		$("#id_field_block").last().find('#id_block_remove').find('a').attr('onclick','nm_del_input($(this));');
		$("#id_field_block").last().find('#id_block_remove').find('a').attr('id','id_input_trash_temp');
		$("#id_field_block").last().find('#id_block_remove').show();
		    		
		$("#id_field_block").last().find('#id_block_edit').hide();
		$("#id_field_block").last().find('#id_block_edit').find('a').attr('onclick','nm_edit_input($(this));');
		$("#id_field_block").last().find('#id_block_edit').find('a').attr('id','id_input_edit_temp');
		
		$("#id_field_block").last().find('#id_block_save').find('a').attr('onclick','nm_save_input($(this));');
		$("#id_field_block").last().find('#id_block_save').find('a').attr('id','id_input_save_temp');
		$("#id_field_block").last().find('#id_block_save').find('a').find('i').removeClass('fa-save').addClass('fa-check');
		$("#id_field_block").last().find('#id_block_save').addClass('disabled');
		$("#id_field_block").last().find('#id_block_save').show();
		
		
		$("#id_field_block").last().find('#id_block_remove').find('a').find('i').removeClass('fa-trash').addClass('fa-close');
		$("#id_field_block").last().find('#id_block_remove').find('a').attr('onclick','nm_remove_input($(this));');
		
		
		
		$("#id_field_block").last().find('div').removeClass('error');
		$('<div class="ui below pointing red basic label hidden" style="margin-top: 0;"><?php echo $nm_lang['pubdir_dir_err']; ?></div>').insertAfter( $("#id_field_block").last() );
		$("#id_field_block").last().show();
	});
});
</script>