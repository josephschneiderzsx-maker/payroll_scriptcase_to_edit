<?php global $nm_config, $scSuffixUrl; ?>
<div class="ui container" style="padding-top: 2rem;">
    <div class="ui grid">
        <div class="left floated twelve wide column" style="text-align: left;">
            <h3><?php echo $nm_lang['update_title']; ?></h3>
        </div>
        <div class="right two wide column" style="display: flex; flex-direction: row; justify-content: flex-end; align-items: center;">
            <?php nm_display_page_help('prod_update'); ?>
        </div>
    </div>
    <div class="ui divider"></div>  
</div>    
<div class="ui container">
    <div class="ui message">
        <p><?php echo $nm_lang['update_description']; ?></p>
    </div>
    
     <div>
    <button id="id_loading_update" class="ui button icon primary disabled" style="display:none">
    	<i id="id_loading_icon" class="sync alternate icon"></i>
    </button>
    
    <button id="id_button_update" class="ui button primary"
            onclick="nm_update()"><?php echo $nm_lang['update_button']; ?></button>
    </div>
</div>
<script>
    function nm_update() {
    	$.ajax({
            method: 'POST',
            url: '<?php echo $nm_config['url_lib'] . $scSuffixUrl . 'update.php'; ?>',
            data: {
                ajax: 'nm',
                nm_action: 'update'
            },
            beforeSend: function(jqXHR){
            	str_msg = '<?php echo $nm_lang['update_process']; ?>';
            	str_tip = 'step_ini';
            	parent.show_update_modal(str_msg,str_tip,'');
            },
            success: function (retorno) {
                if(JSON.parse(retorno).status == 'error'){
                    str_msg = '<?php echo $nm_lang['update_finish_error']; ?>';
                    str_tip = 'error';
                    parent.show_update_modal(str_msg,str_tip,'');
                }else {
                    var retorno_json = JSON.parse(retorno);
                    if(retorno_json.updated == 0 && retorno_json.deleted == 0){
                        msg = "<?php echo $nm_lang['update_zero']; ?>";
                        str_action 	= '';
                    }else{
                        msg = ("<?php echo $nm_lang['update_finish']; ?>")
                            .replace("@@1@@", retorno_json.updated)
                            .replace("@@2@@", retorno_json.deleted)
                            .replace("@@3@@", retorno_json.changelog);
                       	str_action = 'logout';
                    }
                    str_tip 	= 'step_end';
                    parent.show_update_modal(msg,str_tip,str_action);
                }
            }
        });
    }
</script>