<?php 
global $nm_config, $scSuffixUrl; 

$arr_pub_dir         = $_SESSION['nm_session']['prod_v8']['outdated_apps']['pub_dir'];
$arr_list_dir        = $_SESSION['nm_session']['prod_v8']['outdated_apps']['pub_dir_apps'];
$is_pub_dir_list     = $_SESSION['nm_session']['prod_v8']['outdated_apps']['is_pub_dir_list'];
$is_pub_app_dir_list = $_SESSION['nm_session']['prod_v8']['outdated_apps']['is_pub_dir_app_list'];
$link_prod_new       = $_SESSION['nm_session']['prod_v8']['outdated_apps']['links']['prod_new'];
$link_deploy         = $_SESSION['nm_session']['prod_v8']['outdated_apps']['links']['deploy'];
$obsolete_apps       = $_SESSION['nm_session']['prod_v8']['outdated_apps']['outdated']['obsolete_apps'];
?>
<div class="ui container" style="padding-top: 2rem;">
    <div class="ui grid">
        <div class="left floated twelve wide column" style="text-align: left;">
            <h3><?php echo $nm_lang['page_title']; ?></h3>
        </div>
        <div class="right two wide column" style="display: flex; flex-direction: row; justify-content: flex-end; align-items: center;">
            <?php nm_display_page_help('outdated_main'); ?>
        </div>
    </div>
    <div class="ui divider"></div>  
</div>    
<div class="ui container">
  <?php 
  if($is_pub_dir_list){
        if(isset($arr_pub_dir[0]) && !empty($arr_pub_dir[0]))
        {
            ?>
      <table class="ui striped table">
        <thead>
            <tr>
            	<?php 
            	if(isset($arr_pub_dir[0]) && !empty($arr_pub_dir[0])){
            	?>
            	<th><input type="checkbox" name="chk_all"></th>
            	<?php
            	}
            	?>
			    <th><?php echo $nm_lang['outdate_apps_label_dir']; ?></th>
                <th style="text-align: right;"><?php echo $nm_lang['outdate_apps_label_apps']; ?></th>
                <th style="text-align: center;"><?php echo $nm_lang['outdate_apps_label_date']; ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($arr_pub_dir as $key => $pub_dir){
                
                $hide_btn  = false;
                $data_hora = (isset($pub_dir[1])  ? $pub_dir[1] : '');;
                $count     = (isset($pub_dir[2])  ? $pub_dir[2] : '');
                $is_dir    = (is_dir($pub_dir[0]) ? true : false );
                if(!isset($pub_dir[5]) || empty($pub_dir[5])){
                    $is_sc_dir = 'true';
                }else{
                    $is_sc_dir = $pub_dir[5];
                }
                
                if(empty($count)){
                    $hide_btn = true;
                }

                if(!$is_dir || $is_sc_dir == 'false'){
                    continue;
                }
                
                ?>
            <tr>
            
            	<?php if($is_sc_dir == 'false'){ ?>
            		<td></td>
            	<?php } else if(!$is_dir){ ?>
            		<td></td>
            	<?php }else{ ?>
            		<td><input type="checkbox" name="chk_pub_dir[]" value="<?php echo $key; ?>"></td>
            	<?php } ?>
                <td data-label="path"><?php echo $pub_dir[0]; ?></td>
                <?php 
                if($count == 0)
                {
                ?>
                	<td style="text-align: right;"  data-label="count"  id="id_count_<?php echo $key; ?>"  ><?php echo $count; ?></td>
                	<td style="text-align: center;" data-label="date"   id="id_date_hour_<?php echo $key; ?>" ><?php echo $data_hora; ?></td>
                	<td data-label="action" id="id_action_<?php echo $key; ?>" >
                          <span style="color:green"><?php echo $nm_lang['outdate_apps_label_pub_ok']; ?></span>
                	</td>
                	
               	<?php
                }
                else
                {
                ?>
                	<td style="text-align: right;"  data-label="count"  id="id_count_<?php echo $key; ?>" ><?php echo $count ?></td>
                    <td style="text-align: center;" data-label="date"   id="id_date_hour_<?php echo $key; ?>" ><?php echo $data_hora; ?></td>
                    <td data-label="action" id="id_action_<?php echo $key; ?>" >
                    	<?php 
                    	if(!$is_dir){
                    	?>
                    		<span style="color:red"> <?php echo $nm_lang['outdate_apps_dir_err']; ?></span>
                       	<?php
                    	}else if($is_sc_dir == 'false'){
                    	?>
                    	    <span style="color:orange"><?php echo $nm_lang['outdate_apps_dir_not_sc']; ?></span>
                    	<?php
                    	}else if(!$hide_btn){
                    	?>
                    		<button class="fluid ui grey icon button small" onclick="nm_list_apps('<?php echo $key; ?>')"><?php echo $nm_lang['outdate_apps_btn_view']; ?></button>
                    	<?php
                    	}
                    	else if(empty($count)){
                    	?>
                    		
                          		<?php echo $nm_lang['outdate_apps_not_verified']; ?>
                        	    
                    	<?php 
                    	}
                    	?>
                    </td>
               	<?php
                }
                ?>
            </tr>
                <?php 
            }
            ?>
            </tbody>
          </table>
          <button class="ui button primary disabled" id="id_btn_scan" onclick="nm_update_list();">
            <?php echo $nm_lang['outdate_apps_label_scanner']; ?>
          </button>
            <?php
        }
        else
        {
        ?>
            <div class="ui message">
              <p><?php echo $nm_lang['outdate_apps_empty']; ?></p>
              <button class="ui icon button primary" onclick="nm_open_app_dir();"><?php echo $nm_lang['outdate_apps_btn_app_dir']; ?></button>
            </div>
        <?php
        }
        ?>
    <?php 
      }
      else if($is_pub_app_dir_list)
      {
          $app_folder_index = "";
          if(!empty($arr_list_dir)){
              foreach($arr_pub_dir as $key => $item){
                  if(trim($arr_list_dir[0]) == trim($item[0])){
                      $app_folder_index = $key;
                      break;
                  }
              }
          }
      ?>
      	<h4 class="ui dividing header"><?php echo $nm_lang['outdate_apps_label_dir']; ?> : <?php echo $arr_list_dir[0];?></h4>
        <table id="id_main_table_apps" class="ui striped table">
            <thead>
                <tr>
                    <th><?php echo $nm_lang['outdate_apps_label_app']; ?></th>
                    <th style="text-align: right;">
                    	<div class="ui" data-tooltip="<?php echo $nm_lang['outdate_apps_help_app_prod']; ?>">
                    		<?php echo $nm_lang['outdate_apps_label_app_prod_ver']; ?> 
                    		<i class="fa fa-question-circle" aria-hidden="true"></i>
                    	</div>
                    </th>
                    <th style="text-align: right;">
                		<div class="ui" data-tooltip="<?php echo $nm_lang['outdate_apps_help_prod']; ?>">
                    		<?php echo $nm_lang['outdate_apps_label_prod_ver']; ?> 
                    		<i class="fa fa-question-circle" aria-hidden="true"></i>
                		</div>
                	</th>
                	<th><?php echo $nm_lang['outdate_apps_label_solution']; ?></th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $apps_not_found         = array();
            $hide_main_table_apps   = false;
            $main_table_apps        = false;
            foreach($arr_list_dir[3] as $app => $status){
                if($status == '_folder_not_found_'){
                    $app_not_found = true;
                }else{
                    $app_not_found = false;
                    $arr_prod_ver = explode('@@',$status);
                    if($arr_prod_ver[0] == '_folder_not_found_'){
                        $apps_not_found[$app] = $arr_prod_ver[0];
                        if($main_table_apps== false){
                            $hide_main_table_apps = true;
                        }
                        continue;
                    }
                    
                    if($arr_prod_ver[0] < $arr_prod_ver[1] || $arr_prod_ver[0] == '_app_obsolete_'){
                        $main_table_apps      = true;
                        $hide_main_table_apps = false;
                        if($arr_prod_ver[0] == '_app_obsolete_'){
                            $arr_prod_ver[0] = $nm_lang['outdate_apps_app_obsolete'];
                        }
                        $solution       = $nm_lang['outdate_apps_label_deploy'];
                        $link_site      = $link_deploy;
                        $link_target    = 'target="_blank"';
                    }elseif($arr_prod_ver[0] > $arr_prod_ver[1]){
                        $main_table_apps      = true;
                        $hide_main_table_apps = false;
                        $solution       = $nm_lang['outdate_apps_label_update'];
                        $link_site      = "javascript:nm_open_update()";
                        $link_target    = "";
                    }else{
                        $solution       = "";
                        $link_site      = "";
                        $link_target    = "";
                    }
                }
                
                
            ?>
            	<tr>
                	<td data-label="app"><?php echo $app; ?></td>
                    
                    <?php 
                    if($app_not_found){
                    ?>
                    	<td></td>
                    	<td style="text-align: right;" data-label="status"><?php echo $arr_prod_ver[1]; ?></td>
                    	<td data-label="solution">
                    		<span class="ui warning"><?php echo $nm_lang['outdate_apps_dir_not_foud']; ?></span>
                        </td>
                    <?php
                    }else{
                    ?>
                    	<td style="text-align: right;" data-label="status"><?php echo $arr_prod_ver[0]; ?></td>
                        <td style="text-align: right;" data-label="status"><?php echo $arr_prod_ver[1]; ?></td>
                    	<td data-label="solution"><a href="<?php echo $link_site;?>" <?php echo $link_target; ?>><?php echo $solution; ?> </a></td>
                    <?php
                    }
                    ?>
                </tr>
            <?php
            }
            ?>
            	
         	</tbody>
         </table>
         
         <?php 
         if(!empty($apps_not_found)){
         ?>
             <h4 class="ui dividing header"><?php echo $nm_lang['outdate_apps_app_label_not_found']; ?></h4>
        	 <table class="ui striped table">
        	 	<thead>
                    <tr>
                	 	<th><?php echo $nm_lang['outdate_apps_label_app']; ?></th>
                	 	<th> </th>
                	 	<th>Status</th>
                	 	<th><?php echo $nm_lang['outdate_apps_label_solution']; ?></th>
            	 	</tr>
            	 </thead>
            	 <tbody>
            	 <?php foreach($apps_not_found as $app => $value){
            	     
            	     if($value == '_folder_not_found_'){
            	         $solution = '<a style="cursor:pointer" onclick="nm_request_solution(\''.$value.'\',\''.$app.'\','.$app_folder_index.',$(this));">'.$nm_lang['outdate_apps_delete_app'].'</a>';
            	         $value    = $nm_lang['outdate_apps_app_not_found'];
            	         
            	     }else{
            	         $solution = '';
            	         $value    = '';
            	         
            	     }
            	 ?>
            	 	<tr>
            	 		<td><?php echo $app; ?></td>
            	 		<td> </td>
            	 		<td><?php echo $value; ?></td>
            	 		<td><?php echo $solution; ?></td>
            	 	</tr>
            	 <?php    
            	 }?>
            	 </tbody>
        	 </table>
       	 <?php
         }
         ?>
         <div style="padding-bottom:55px"> </div>
        <div class="ui bottom fixed menu">
          <div class="item borderless">
          	<button class="large ui button" onclick="nm_back();">
        		<?php echo $nm_lang['outdate_apps_btn_back']; ?>
        	</button>
        	</div>
        </div>
      <?php 
      }
    ?>
	<div id="id_modal_general" class="ui modal tiny">
        <div class="ui header" style="display:none">
        </div>
        <div class="image content">
            <div class="description">
                <div id="id_msg_header" class="ui header">
                      <?php echo $nm_lang['outdate_apps_message_ok']; ?>
                </div>
            </div>
        </div>
        <div class="actions">
            <div id="butotnmodalclose" class="ui right button primary">
               <?php echo $nm_lang['outdate_apps_btn_close']; ?>
            </div>
        </div>
    </div>

    <div class="ui modal tiny" id="id_modal_confirm_delete">
      <div class="header" style="display:none"><i class="fa confirm-icon fa-exclamation-triangle" style="color: rgb(255, 154, 23);"></i></div>
      <div class="content">
        <h4><?php echo $nm_lang['outdate_apps_modal_request']; ?></h4>
      </div>
      <div class="actions">
        <div class="ui cancel button"><?php echo $nm_lang['outdate_apps_btn_cancel']; ?></div>
        <div class="ui approve button primary"><?php echo $nm_lang['outdate_apps_btn_confirm']; ?></div>
      </div>
    </div>
</div>

<script>
function nm_back(){
	parent.nm_set_option('outdated_apps', '', 'nm_iframe');
}
function nm_update_list(){
	
	dados = [];
	$("[name='chk_pub_dir[]']").each(function(){
		if($(this).is(':checked')){
			dados.push($(this).val());
		}
	});

	$.ajax({
        method: 'POST',
        url: '<?php echo $nm_config['url_lib'] . $scSuffixUrl . 'outdated_apps.php'; ?>',
        data: {
            ajax: 'nm',
            nm_action: 'refresh',
            param: dados,
        },
        success:function (v_resp) {
        	var x = JSON.parse(v_resp);
        	if(x.status == 'ok'){
        		for(var i in x.apps){
        			var id_count = "#id_count_"+i;
        			var id_view  = "#id_action_"+i;
        			var id_date  = "#id_date_hour_"+i;
        			$(id_date).text(x.scan[i]);
        			if(x.apps[i] != 0){
        				$(id_count).text(x.apps[i]);
        				$(id_view).html("<button class=\"fluid ui icon button small\" onclick=\"nm_list_apps('"+i+"')\"><?php echo $nm_lang['outdate_apps_btn_view']; ?></button>");
        			}
                }
            	$('#id_modal_general').modal({
                	blurring: true,
                	onHide: function(){
                    		parent.nm_set_option('outdated_apps','','nm_iframe');
                    	}
                }).modal('show');
        	}
            
        }
    });
}
function nm_list_apps(str_opt)
{
	$.ajax({
        method: 'POST',
        url: '<?php echo $nm_config['url_lib'] . $scSuffixUrl . 'outdated_apps.php'; ?>',
        data: {
            ajax: 'nm',
            nm_action: 'list_apps',
            dir: str_opt 
        },
        success:function () {
        	
            parent.nm_set_option('outdated_apps', 'list_apps', 'nm_iframe');
        }
    });
}

function nm_open_app_dir(){
	window.parent.$(".item-menu").each(function(){
        $(this).removeClass('active');
    });
    window.parent.$("#pub_dir").addClass('active');
	parent.nm_set_option('pub_dir','','nm_iframe');
}
function nm_open_update(){
	window.parent.$(".item-menu").each(function(){
        $(this).removeClass('active');
    });
    window.parent.$("#update").addClass('active');
	parent.nm_set_option('update','','nm_iframe');
}

function nm_request_solution(str_tipo,str_app,str_key,str_obj){
    $("#id_modal_confirm_delete").modal({
    	blurring: true,
    	onApprove: function(){
    		str_obj.removeAttr('onclick');
    		str_obj.removeAttr('style');
    		str_obj.html('<i class="fas fa-sync fa-spin"></i>');
    		$.ajax({
                method: 'POST',
                url: '<?php echo $nm_config['url_lib'] . $scSuffixUrl . 'outdated_apps.php'; ?>',
                data: {
                    ajax: 'nm',
                    nm_action: 'user_action',
                    tipo: str_tipo,
                    app: str_app,
                    qtd: str_key
                },
                success:function (response) {
                    var obj = JSON.parse(response);
                    if(obj.result == 'success'){
                    	$("#id_modal_general").find("#id_msg_header").html(obj.message);
                    	$("#id_modal_general").modal({
                    		blurring: true,
                    		onHide:  function(){
                    			parent.nm_set_option('outdated_apps', 'list_apps', 'nm_iframe');
                    		}
                    	}).modal('show');
                    }else{
                    	$("#id_modal_general").find("#id_msg_header").addClass('red');
                    	$("#id_modal_general").find("#id_msg_header").html(obj.message);
                    	$("#id_modal_general").modal({
                    		blurring: true,
                    	}).modal('show');
                    }
                }
            });
    	}
	}).modal('show');	
}
$(document).ready(function(){
	<?php 
	   if(isset($hide_main_table_apps) && $hide_main_table_apps == true){
	       echo '$("#id_main_table_apps").hide()'; 
	   }
	?>

	$("[name='chk_all']").click(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);
		if($(this).is(':checked')){
			 $("#id_btn_scan").removeClass("disabled");  
		}else{
			 $("#id_btn_scan").addClass("disabled");
		}
	});
	$("#butotnmodalclose").click(function(){
        $('.ui.modal').modal('hide');
    });
    $("[name='chk_pub_dir[]']").click(function(){
        if($(this).is(':checked')){
            $("#id_btn_scan").removeClass("disabled");        
        }else{
            var bool_chk_cheked = false;
            $("[name='chk_pub_dir[]']").each(function(){
                if($(this).is(':checked')){
                    bool_chk_cheked = true;
                }
            })
            if(!bool_chk_cheked){
                $("#id_btn_scan").addClass("disabled");
            }
        }
    });
});
</script>