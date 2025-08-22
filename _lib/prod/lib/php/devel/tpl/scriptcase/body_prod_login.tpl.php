<?php
global $nm_config, $scSuffixUrl, $nm_lang;
$field_select   = $_SESSION['nm_session']['prod_v8']['login']['lang'];
$str_comp       = str_replace('_', '-', $_SESSION['nm_session']['prod_v8']['login']['default']);
$str_prod_ver   = $_SESSION['nm_session']['prod_v8']['login']['version'];
$str_toggle     = $_SESSION['nm_session']['prod_v8']['login']['toggle'];
?>
<div class="ui container"
	style="display: flex; flex-flow: column nowrap; justify-content: center; align-items: center; row-gap: 1.0rem; width: 100%; height: 100%; position: relative; z-index: 100;">
	<img src="<?php echo '../../../../'.$scSuffixUrl; ?>img/scriptcase.png"
		width="250px" alt="Scriptcase" title="Scriptcase" />
	<div class="login-container">
		<form name="form_login" id="form_login" class="ui form">
			<div class="group">
				<h3 class="ui dividing header" id="lang_login_header"><?php echo $nm_lang['sc_prod']; ?></h3>
				<div class="two fields">
					<div class="ten wide field">
						<label id="lang_login_pass_email"><?php echo $nm_lang['form_pass_email']; ?></label>
						<input type="text" name="field_pass_email" autocomplete="off"
							id="field_pass_email" />
						<div id="nm_help_pass_five"
							class="ui basic red pointing prompt label transition hidden"
							style="margin-top: 3rem; position: absolute; left: 1rem;"><?php echo $nm_lang['error_password_email'];?></div>
					</div>

					<div class="six wide field">
						<label id="lang_login_pass_language"><?php echo $nm_lang['form_language']; ?></label>
						<select class="ui dropdown" name="field_language"
							id="field_language" />
							<?php
							foreach ($field_select as $str_code => $str_lang) {
								$str_sel = ($str_comp == $str_code) ? ' selected="selected"' : '';
								?>
								<option value="<?php echo $str_code; ?>"
							<?php echo $str_sel; ?>><?php echo $str_lang; ?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="two fields">
					<div class="field">
						<label id="lang_login_pass_new"><?php echo $nm_lang['form_pass_new']; ?></label>
						<div class="ui icon input">
							<input type="password" name="field_pass_new" autocomplete="off"
								id="field_pass_new" /> <i class="eye icon" style="cursor: pointer; pointer-events: auto;<?php echo $str_toggle;?>"
								onclick="toggePass(this);"></i>
						</div>
					</div>
					<div class="field">
						<label id="lang_login_pass_conf"><?php echo $nm_lang['form_pass_conf']; ?></label>
						<div class="ui icon input">
							<input type="password" name="field_pass_conf" autocomplete="off"
								id="field_pass_conf" /> <i class="eye icon" style="cursor: pointer; pointer-events: auto;<?php echo $str_toggle;?>"
								onclick="toggePass(this);"></i>
						</div>
					</div>
				</div>
				
				<div class="ui mini info message" style="padding-bottom: 0;">
					<div class="header" id="lang_login_help" style="margin-bottom: 0.5rem">
                    	<?php echo $nm_lang['form_pass_help_title']; ?>
                	</div>
					
					<div id="nm_help_pass" class="ui grid">
						<div class="six wide column">
							<div class="bullet item" id="nm_help_pass_first"><?php echo $nm_lang['form_pass_help_desc_1']; ?></div>
							<div class="bullet item" id="nm_help_pass_second"><?php echo $nm_lang['form_pass_help_desc_2']; ?></div>
						</div>
						<div class="ten wide column">
							<div class="eight wide bullet item" id="nm_help_pass_third"><?php echo $nm_lang['form_pass_help_desc_3']; ?></div>
							<div class="eight wide bullet item" id="nm_help_pass_four"><?php echo $nm_lang['form_pass_help_desc_4']; ?></div>
						</div>
					</div>
				</div>
			</div>

			<div class="group" style="padding: 1rem 1.5rem;">
				<div class="field">
                  <div class="field">
                    <img src="../lib/php/secureimage.php" alt="CAPTCHA" class="captcha-image" style="vertical-align: middle;">
					
					<div class="ui icon tiny button refresh-captcha" style="vertical-align: top">
						<i class="fas fa-refresh"></i>
					</div>

					<div class="eight wide field" style="margin-top: 0.75rem">
						<div class="ui small input">
							<input placeholder="<?php echo $nm_lang['form_pass_captcha_placeholder'];?>" type="text" name="field_pass_captcha" autocomplete="off" id="field_pass_captcha" />
						</div>
					</div>
                  </div>
                </div>
			</div>
			<div class="group"
				style="padding: 1rem 1.5rem; background-color: #f9fafc; border-top: 1px solid #d1dde2; display: flex; flex-flow: row nowrap; justify-content: space-between; align-items: center;">
				<a id="loginbutton" class="ui button primary large"><?php echo $nm_lang['button_login']; ?></a>
			</div>
		</form>
	</div>
</div>

<div id="footer_info">
	<div class="copyright-prod">
		1997 - <?php echo date("Y"); ?> <span id="lang_copyright"> <?php echo $nm_lang['copyright_label']; ?></span>
	</div>
	<div class="spacer"></div>
	<div class="version-prod">
		<span id="lang_version"><?php echo $nm_lang['version']; ?></span>: <?php echo $str_prod_ver; ?>
	</div>
</div>

<div id="id_modal_login_error" class="ui modal tiny">
	<i class="close icon"></i>
	<div class="ui header red">
    	<?php echo $nm_lang['error']; ?>
    </div>
	<div class="image content">
		<div class="description">
			<div class="ui header red " id="id_modal_login_error_message">
				
            </div>
		</div>
	</div>
	<div class="actions">
		<div id="butotnmodalclose" class="ui right button primary cancel">
            <?php echo $nm_lang['button_close']; ?>
        </div>
	</div>
</div>

<div class="ui small modal" id="modal_info">
        <div class="header" id="modal_info_header">
        	<?php echo $nm_lang['info_page_pass_welcome']; ?>
        </div>
        <div class="content" >
        	<p id="modal_info_content_first"><?php echo $nm_lang['info_page_pass_first']; ?></p>
        	
        	<p id="modal_info_content_second"><?php echo $nm_lang['info_page_pass_second'];?></p>
        </div>
        <div class="actions">
            <div class="ui primary button approve" id="modal_info_button"><?php echo $nm_lang['info_page_pass_btn'];?></div>
        </div>
    </div>
<script>
    function toggePass(el){
        $(el).toggleClass('slash');
        if ($(el).closest('div.input').find('input').get(0).type == 'password') {
            $(el).closest('div.input').find('input').get(0).type = 'text';
        } else {
            $(el).closest('div.input').find('input').get(0).type = 'password';
        }
    }
	$(document).ready(function(){
	
		langValue = $("#field_language").val();
		$.ajax({
            method: 'POST',
            url: '<?php echo $nm_config['url_lib'] . $scSuffixUrl . 'login.php'; ?>',
            data: {
                ajax: 'nm',
                nm_action: 'change_language',
                lang: langValue
            },
            success:function (response) {
                var obj = JSON.parse(response);
                if(obj.result == 'success'){
                	$("#loginbutton").html("").html(obj.loginbutton);
                	$("#lang_login_header").html("").html(obj.lang_login_header);
                    $("#lang_login_pass_email").html("").html(obj.lang_login_pass_email);
                    $("#lang_login_pass_new").html("").html(obj.lang_login_pass_new);
                    $("#lang_login_pass_conf").html("").html(obj.lang_login_pass_conf);
                    $("#lang_login_pass_language").html("").html(obj.lang_login_pass_language);
                    $("#lang_login_help").html("").html(obj.lang_login_help);
                    $("#nm_help_pass_first").html("").html(obj.nm_help_pass_first);
                    $("#nm_help_pass_second").html("").html(obj.nm_help_pass_second);
                    $("#nm_help_pass_third").html("").html(obj.nm_help_pass_third);
                    $("#nm_help_pass_four").html("").html(obj.nm_help_pass_four);
                    $("#nm_help_pass_five").html("").html(obj.nm_help_pass_five);
                    $("#lang_copyright").html("").html(obj.copyright);
                    $("#lang_version").html("").html(obj.version);
                    $("#field_pass_captcha").attr("placeholder",obj.captcha_placeholder);
                    $("#modal_info_header").html("").html(obj.md_info_header);
                    $("#modal_info_content_first").html("").html(obj.md_info_cnt_first);
                    $("#modal_info_content_second").html("").html(obj.md_info_cnt_sec);
                    $("#modal_info_button").html("").html(obj.md_info_btn);
                    
                    $("title").html("").html(obj.title);
                }
            }
        });
		var refreshButton = document.querySelector(".refresh-captcha");
        refreshButton.onclick = function() {
        	$("#field_pass_captcha").focus();
        	document.querySelector(".captcha-image").src = '../lib/php/secureimage.php?' + Date.now();
        }
	
	
		$.ajax({
            method: 'POST',
            url: '<?php echo $nm_config['url_lib'] . $scSuffixUrl . 'login.php'; ?>',
            data: {
                ajax: 'nm',
                nm_action: 'login'
            },
            success:function (response) {
                var obj = JSON.parse(response);
                if (obj.result == 'login'){
                	document.form_login.action = '../../nm_ini_manager2.php';
                	document.form_login.method = 'POST';
                	document.form_login.submit();
                }else if(obj.result == 'new_pass'){
                	$('#modal_info').modal({blurring: true}).modal('show');
                }
            }
		});
		$("#field_language").change(function(){
			langValue = $(this).val();
			$.ajax({
                method: 'POST',
                url: '<?php echo $nm_config['url_lib'] . $scSuffixUrl . 'login.php'; ?>',
                data: {
                    ajax: 'nm',
                    nm_action: 'change_language',
                    lang: langValue
                },
                success:function (response) {
                    var obj = JSON.parse(response);
                    if(obj.result == 'success'){
                    	$("#loginbutton").html("").html(obj.loginbutton);
                    	$("#lang_login_header").html("").html(obj.lang_login_header);
                        $("#lang_login_pass_email").html("").html(obj.lang_login_pass_email);
                        $("#lang_login_pass_new").html("").html(obj.lang_login_pass_new);
                        $("#lang_login_pass_conf").html("").html(obj.lang_login_pass_conf);
                        $("#lang_login_pass_language").html("").html(obj.lang_login_pass_language);
                        $("#lang_login_help").html("").html(obj.lang_login_help);
                        $("#nm_help_pass_first").html("").html(obj.nm_help_pass_first);
                        $("#nm_help_pass_second").html("").html(obj.nm_help_pass_second);
                        $("#nm_help_pass_third").html("").html(obj.nm_help_pass_third);
                        $("#nm_help_pass_four").html("").html(obj.nm_help_pass_four);
                        $("#nm_help_pass_five").html("").html(obj.nm_help_pass_five);
                        $("#lang_copyright").html("").html(obj.copyright);
                        $("#lang_version").html("").html(obj.version);
                        $("#field_pass_captcha").attr("placeholder",obj.captcha_placeholder);
                        $("#modal_info_header").html("").html(obj.md_info_header);
                        $("#modal_info_content_first").html("").html(obj.md_info_cnt_first);
                        $("#modal_info_content_second").html("").html(obj.md_info_cnt_sec);
                        $("#modal_info_button").html("").html(obj.md_info_btn);
                        $("title").html("").html(obj.title);
                    }
                }
            });
		});
		
		$("#loginbutton").click(function(){
    		$.ajax({
                method: 'POST',
                url: '<?php echo $nm_config['url_lib'] . $scSuffixUrl . 'login.php'; ?>',
                data: {
                    ajax: 'nm',
                    nm_action: 'change_pass',
                    email: 		$("#field_pass_email").val(),
                    pass_new: 	$("#field_pass_new").val(),
                    pass_conf: 	$("#field_pass_conf").val(),
                    lang: 		$("#field_language").val(),
                    captcha:	$("#field_pass_captcha").val()
                },
                success:function (response) {
                    var obj = JSON.parse(response);
                    if (obj.result == 'success'){
                    	document.form_login.action = '../../nm_ini_manager2.php';
                    	document.form_login.method = 'POST';
                    	document.form_login.submit();
                    }else{
                    	$("#id_modal_login_error_message").html("").html(obj.message);
                    	$('#id_modal_login_error').modal({blurring: true}).modal('show');
                    }
                }
			});
		});
		
		
		$("#loginbutton").addClass('disabled');
		$('[name="field_pass"]').on('input',function(){
			if($(this).val() != '' || $(this).val().lenght >0){
                $("#loginbutton").removeClass('disabled');
			}else{
        		$("#loginbutton").addClass('disabled');
			}
		});
        
		$('[name="field_pass_new"]').on('input',function(){
			nm_function_valida_all();
		});
		$('[name="field_pass_conf"]').on('input',function(){
			nm_function_valida_all();
		});
		$('[name="field_pass_captcha"]').on('input',function(){
			nm_function_valida_all();
		});
		$('[name="field_pass_email"]').on('input',function(){
			bool_mail = nm_function_valida_field_pass_email();
			if(bool_mail){
                $("#loginbutton").removeClass('disabled');
			}else{
        		$("#loginbutton").addClass('disabled');
			}
		});

        function nm_function_valida_all(){
        	bool_new  = nm_function_valida_field_pass_new();
        	bool_conf = nm_function_valida_field_pass_conf();
        	bool_cap  = nm_function_valida_field_pass_captcha();
        	if($("[name='field_pass_email']").val() != undefined){
        		bool_mail = nm_function_valida_field_pass_email();
        	}else{
        		bool_mail = true;
        	}
        	
        	if(bool_new && bool_conf && bool_mail && bool_cap){
                $("#loginbutton").removeClass('disabled');
			}else{
        		$("#loginbutton").addClass('disabled');
			}
        }
        
		function nm_function_valida_field_pass_new(p_opt=''){
			var str_obj    	= $("[name='field_pass_new']");
			var str_conf   	= $("[name='field_pass_conf']");
			var str_size   	= nm_function_check_len(str_obj.val());
			var str_letter 	= nm_function_check_letter(str_obj.val());
			var str_num    	= nm_function_check_num(str_obj.val());
			var btn	   		= false;
			if(str_size){
				if(p_opt==''){
					$('#nm_help_pass_first').removeClass('nm_help_red').addClass('nm_help_green');
				}
			}else{
				if(p_opt==''){
					$('#nm_help_pass_first').removeClass('nm_help_green').addClass('nm_help_red');
				}
			}
			if(str_letter){
				if(p_opt==''){
					$('#nm_help_pass_second').removeClass('nm_help_red').addClass('nm_help_green');
				}
			}else{
				if(p_opt==''){
					$('#nm_help_pass_second').removeClass('nm_help_green').addClass('nm_help_red');
				}
			}
			if(str_num){
				if(p_opt==''){
					$('#nm_help_pass_third').removeClass('nm_help_red').addClass('nm_help_green');
				}
			}else{
				if(p_opt==''){
					$('#nm_help_pass_third').removeClass('nm_help_green').addClass('nm_help_red');
				}
			}
			if(str_conf.val() == str_obj.val()){
				if(p_opt==''){
					$('#nm_help_pass_four').removeClass('nm_help_red').addClass('nm_help_green');
				}
			}else{
				if(p_opt==''){
					$('#nm_help_pass_four').removeClass('nm_help_green').addClass('nm_help_red');
				}
			}
			if(str_size && str_letter && str_num && str_conf.val() == str_obj.val()){
				btn = true;
			}else{
				btn = false;
			}
			return btn;
		}
		function nm_function_valida_field_pass_conf(p_opt=''){
			var str_obj		= $("[name='field_pass_conf']");
			var str_new    	= $("[name='field_pass_new']");
			var str_btn	   	= false;
			
			if(str_new.val() == str_obj.val()){
				if(p_opt == ''){
					$('#nm_help_pass_four').removeClass('nm_help_red').addClass('nm_help_green');
				}
				btn = true;
			}else{
				if(p_opt == ''){
					$('#nm_help_pass_four').removeClass('nm_help_green').addClass('nm_help_red');
				}
				btn = false;
			}
			return btn;
		}
		function nm_function_valida_field_pass_email(){
			var btn  = false;
			var str_obj  = $("[name='field_pass_email']");
			var str_mail = nm_function_check_email(str_obj.val());
			var str_conf = nm_function_valida_field_pass_conf('mail');
			var str_new  = nm_function_valida_field_pass_new('mail');
			var str_cap  = nm_function_valida_field_pass_captcha();
			if(str_mail){
				$('#nm_help_pass_five').removeClass('visible').addClass('hidden');
				btn = true;
			}else{
				$('#nm_help_pass_five').removeClass('hidden').addClass('visible');
				btn = false;
			}
			
			if(str_conf && str_new && str_mail){
				btn = true;
			}else{
				btn = false;
			}
			
			return btn;
		}
		
		function nm_function_valida_field_pass_captcha(){
			var btn = false;
			var str_obj = $("[name='field_pass_captcha']");
			var str_cap = nm_function_check_len_cap(str_obj.val());
			var str_conf = nm_function_valida_field_pass_conf('mail');
			var str_new  = nm_function_valida_field_pass_new('mail');
			if(str_cap){
				$('#nm_help_pass_six').removeClass('nm_help_red').addClass('nm_help_green');
				btn = true;
			}else{
				$('#nm_help_pass_six').removeClass('nm_help_red').addClass('nm_help_green');
				btn = false;
			}
			
			if(str_conf && str_new && str_cap){
				btn = true;
			}else{
				btn = false;
			}
			
			return btn;
		}
		
		function nm_function_check_len_cap(str){
			var response = false;
			if(str != '' && str.length == 4){
				response = true;
			}
			return response;
		}
		
		function nm_function_check_len(str){
			var response = false;
			if(str != '' && str.length >= 8){
				response = true;
			}
			return response;
		}
		function nm_function_check_letter(str){
			var response = false;
			var str_upper = /[A-Z]/.test(str);
            var str_lower = /[a-z]/.test(str);
            if(str_upper && str_lower){
            	response = true;
            }
            return response;
		}
		function nm_function_check_num(str){
			var response  = false;
			var str_num   = /\d/.test(str);
			if(str_num){
				response = true;
			}
			return response;
			
		}
		function nm_function_check_email(str){
			var response = false;
			if(str == '' || str.length == 0){
				response = true;
			}else{
				var str_mail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(str);
				if(str_mail){
					response = true;
				}
			}
			return response;
		}
	});
</script>

