<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    $sOBContents = ob_get_contents();
    ob_end_clean();
}

header("X-XSS-Protection: 1; mode=block");
header("X-Frame-Options: SAMEORIGIN");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: same-origin");

?>
<!DOCTYPE html>

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags(""); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_settings'] . ""); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
 <META http-equiv="Pragma" content="no-cache" />
 <link rel="shortcut icon" href="../_lib/img/sys__NM__ico__NM__favicon (2).ico">
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
{
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}

?>
            <meta name="viewport" content="minimal-ui, width=300, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
            <meta name="mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="apple-touch-icon"   sizes="57x57" href="">
            <link rel="apple-touch-icon"   sizes="60x60" href="">
            <link rel="apple-touch-icon"   sizes="72x72" href="">
            <link rel="apple-touch-icon"   sizes="76x76" href="">
            <link rel="apple-touch-icon" sizes="114x114" href="">
            <link rel="apple-touch-icon" sizes="120x120" href="">
            <link rel="apple-touch-icon" sizes="144x144" href="">
            <link rel="apple-touch-icon" sizes="152x152" href="">
            <link rel="apple-touch-icon" sizes="180x180" href="">
            <link rel="icon" type="image/png" sizes="192x192" href="">
            <link rel="icon" type="image/png"   sizes="32x32" href="">
            <link rel="icon" type="image/png"   sizes="96x96" href="">
            <link rel="icon" type="image/png"   sizes="16x16" href="">
            <meta name="msapplication-TileColor" content="___">
            <meta name="msapplication-TileImage" content="">
            <meta name="theme-color" content="___">
            <meta name="apple-mobile-web-app-status-bar-style" content="___">
            <link rel="shortcut icon" href=""> <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript">
  var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
  var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_userSweetAlertDisplayed = false;
 </SCRIPT>
 <SCRIPT type="text/javascript">
  var sc_blockCol = '<?php echo $this->Ini->Block_img_col; ?>';
  var sc_blockExp = '<?php echo $this->Ini->Block_img_exp; ?>';
  var sc_ajaxBg = '<?php echo $this->Ini->Color_bg_ajax; ?>';
  var sc_ajaxBordC = '<?php echo $this->Ini->Border_c_ajax; ?>';
  var sc_ajaxBordS = '<?php echo $this->Ini->Border_s_ajax; ?>';
  var sc_ajaxBordW = '<?php echo $this->Ini->Border_w_ajax; ?>';
  var sc_ajaxMsgTime = 2;
  var sc_img_status_ok = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_ok; ?>';
  var sc_img_status_err = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_err; ?>';
  var sc_css_status = '<?php echo $this->Ini->Css_status; ?>';
  var sc_css_status_pwd_box = '<?php echo $this->Ini->Css_status_pwd_box; ?>';
  var sc_css_status_pwd_text = '<?php echo $this->Ini->Css_status_pwd_text; ?>';
 </SCRIPT>
        <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
            <?php
               if ($_SESSION['scriptcase']['display_mobile'] && $_SESSION['scriptcase']['device_mobile']) {
                   $forced_mobile = (isset($_SESSION['scriptcase']['force_mobile']) && $_SESSION['scriptcase']['force_mobile']) ? 'true' : 'false';
                   $sc_app_data   = json_encode([
                       'forceMobile' => $forced_mobile,
                       'appType' => 'form',
                       'improvements' => true,
                       'displayOptionsButton' => false,
                       'displayScrollUp' => true,
                       'scrollUpPosition' => 'A',
                       'toolbarOrientation' => 'H',
                       'mobilePanes' => 'true',
                       'navigationBarButtons' => unserialize('a:0:{}'),
                       'mobileSimpleToolbar' => false,
                       'bottomToolbarFixed' => true
                   ]); ?>
            <input type="hidden" id="sc-mobile-app-data" value='<?php echo $sc_app_data; ?>' />
            <script type="text/javascript" src="../_lib/lib/js/nm_modal_panes.jquery.js"></script>
            <script type="text/javascript" src="../_lib/lib/js/nm_form_mobile.js"></script>
            <link rel='stylesheet' href='../_lib/lib/css/nm_form_mobile.css' type='text/css'/>
            <script>
                $(document).ready(function(){

                    bootstrapMobile();

                });
            </script>
            <?php } ?> <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>frameControl.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/viewerjs/viewer.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/viewerjs/viewer.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.iframe-transport.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fileupload.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
    <style type="text/css">
        .sc-form-order-icon {
            padding: 0 2px;
        }
    </style>
<?php
           $formOrderUnusedVisivility = $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'] ? 'visible' : 'hidden';
           $formOrderUnusedOpacity = $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'] ? '0.5' : '1';
?>
    <style>
        .sc-form-order-icon-unused {
            visibility: <?php echo $formOrderUnusedVisivility ?>;
            opacity: 0.5;
        }
        .scFormLabelOddMult:hover .sc-form-order-icon-unused {
            visibility: visible;
            opacity: <?php echo $formOrderUnusedOpacity ?>;
        }
    </style>
<style type="text/css">
.sc-button-image.disabled {
        opacity: 0.25
}
.sc-button-image.disabled img {
        cursor: default !important
}
</style>
 <style type="text/css">
  .fileinput-button-padding {
   padding: 3px 10px !important;
  }
  .fileinput-button {
   position: relative;
   overflow: hidden;
   float: left;
   margin-right: 4px;
  }
  .fileinput-button input {
   position: absolute;
   top: 0;
   right: 0;
   margin: 0;
   border: solid transparent;
   border-width: 0 0 100px 200px;
   opacity: 0;
   filter: alpha(opacity=0);
   -moz-transform: translate(-300px, 0) scale(4);
   direction: ltr;
   cursor: pointer;
  }
 </style>
 <style type="text/css">
  .scSpin_cookie_expiration_time_obj {
   border: 0 !important;
   margin: 0 20px 0 0 !important;
  }
  #id_read_off_cookie_expiration_time .ui-spinner {
   display: flex;
   width: 100%;
  }
  .scSpin_pswd_last_updated_obj {
   border: 0 !important;
   margin: 0 20px 0 0 !important;
  }
  #id_read_off_pswd_last_updated .ui-spinner {
   display: flex;
   width: 100%;
  }
  .scSpin_brute_force_attempts_obj {
   border: 0 !important;
   margin: 0 20px 0 0 !important;
  }
  #id_read_off_brute_force_attempts .ui-spinner {
   display: flex;
   width: 100%;
  }
  .scSpin_brute_force_time_block_obj {
   border: 0 !important;
   margin: 0 20px 0 0 !important;
  }
  #id_read_off_brute_force_time_block .ui-spinner {
   display: flex;
   width: 100%;
  }
  .scSpin_enable_2fa_expiration_time_obj {
   border: 0 !important;
   margin: 0 20px 0 0 !important;
  }
  #id_read_off_enable_2fa_expiration_time .ui-spinner {
   display: flex;
   width: 100%;
  }
  .scSpin_mfa_last_updated_obj {
   border: 0 !important;
   margin: 0 20px 0 0 !important;
  }
  #id_read_off_mfa_last_updated .ui-spinner {
   display: flex;
   width: 100%;
  }
 </style>
 <style type="text/css">
   .select2-container {
     width: auto !important;
     flex-grow: 1;
   }
   .select2-selection {
     width: 100% !important;
   }
 </style>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['link_info']['margin_top'] ?>;
}
</style>
<?php
}

?>

<style type="text/css">
        .sc.switch {
                position: relative;
                display: inline-flex;
        }

        .sc.switch span {
                display: inline-block;
                margin-right: 5px;
        }

        .sc.switch span {
                background: #DFDFDF;
                width: 22px;
                height: 14px;
                display: block;
                position: relative;
                top: 0px;
                left: 0;
                border-radius: 15px;
                padding: 0 3px;
                transition: all .2s linear;
                box-shadow: 0px 0px 2px rgba(164, 164, 164, 0.8) inset;
        }

        .sc.switch span:before {
                content: '\2713';
                display: inline-block;
                color: white;
                font-size: 10px;
                z-index: 0;
                position: absolute;
                top: 0;
                left: 4px;
        }

        .sc.switch span:after {
                content: '';
                background: white;
                width: 12px;
                height: 12px;
                display: block;
                position: absolute;
                top: 1px;
                left: 1px;
                border-radius: 15px;
                transition: all .2s linear;
                z-index: 1;
        }

        .sc.switch input {
                margin-right: 10px;
                cursor: pointer;
                z-index: 2;
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                opacity: 0;
                margin: 0;
                padding: 0;
        }

        .sc.switch input:disabled + span {
                opacity: 0.35;
        }

        .sc.switch input:checked + span {
                background: #66AFE9;
        }

        .sc.switch input:checked + span:after {
                left: calc(100% - 1px);
                transform: translateX(-100%);
        }

        .sc.radio {
                position: relative;
                display: inline-flex;
        }

        .sc.radio span {
                display: inline-block;
                margin-right: 5px;
        }

        .sc.radio span {
                background: #ffffff;
                border: 1px solid #66AFE9;
                width: 12px;
                height: 12px;
                display: block;
                position: relative;
                top: 0px;
                left: 0;
                border-radius: 15px;
                transition: all .2s;
                box-shadow: 0px 0px 2px rgba(164, 164, 164, 0.8) inset;
        }

        .sc.radio span:after {
                content: '';
                background: #66AFE9;
                width: 12px;
                height: 12px;
                display: block;
                position: absolute;
                top: 0;
                left: 0;
                border-radius: 15px;
                transition: all .2s;
                z-index: 1;
                transform: scale(0);
        }

        .sc.radio input {
                cursor: pointer;
                z-index: 2;
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                opacity: 0;
                margin: 0;
                padding: 0;
        }

        .sc.radio input:disabled + span {
                opacity: 0.35;
        }

        .sc.radio input:checked + span {
                background: #66AFE9;
        }

        .sc.radio input:checked + span:after {
                transform: translateX(-100%);
                transform: scale(1);
        }
</style>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput2.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <?php
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['embutida_pdf']))
 {
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_appdiv.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_appdiv<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod; ?>/third/font-awesome/6/css/all.min.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>app_settings/app_settings_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("app_settings_sajax_js.php");
?>
<script type="text/javascript">
if (document.getElementById("id_error_display_fixed"))
{
 scCenterFixedElement("id_error_display_fixed");
}
var posDispLeft = 0;
var posDispTop = 0;
var Nm_Proc_Atualiz = false;
var scFormCtrlChanged = true;
function findPos(obj)
{
 var posCurLeft = posCurTop = 0;
 if (obj.offsetParent)
 {
  posCurLeft = obj.offsetLeft
  posCurTop = obj.offsetTop
  while (obj = obj.offsetParent)
  {
   posCurLeft += obj.offsetLeft
   posCurTop += obj.offsetTop
  }
 }
 posDispLeft = posCurLeft - 10;
 posDispTop = posCurTop + 30;
}
var Nav_permite_ret = "<?php if ($this->Nav_permite_ret) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_permite_ava = "<?php if ($this->Nav_permite_ava) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_binicio     = "<?php echo $this->arr_buttons['binicio']['type']; ?>";
var Nav_bavanca     = "<?php echo $this->arr_buttons['bavanca']['type']; ?>";
var Nav_bretorna    = "<?php echo $this->arr_buttons['bretorna']['type']; ?>";
var Nav_bfinal      = "<?php echo $this->arr_buttons['bfinal']['type']; ?>";
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_disabled']['last'] : 'off'); ?>";
function nav_atualiza(str_ret, str_ava, str_pos)
{
<?php
 if (isset($this->NM_btn_navega) && 'N' == $this->NM_btn_navega)
 {
     echo " return;";
 }
 else
 {
?>
 if ('S' == str_ret)
 {
<?php
    if (isset($this->nmgp_botoes['first']) && $this->nmgp_botoes['first'] == "on")
    {
?>
       if ("off" == Nav_binicio_macro_disabled) { $("#sc_b_ini_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
    if (isset($this->nmgp_botoes['back']) && $this->nmgp_botoes['back'] == "on")
    {
?>
       if ("off" == Nav_bretorna_macro_disabled) { $("#sc_b_ret_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
?>
 }
 else
 {
<?php
    if (isset($this->nmgp_botoes['first']) && $this->nmgp_botoes['first'] == "on")
    {
?>
       $("#sc_b_ini_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
    if (isset($this->nmgp_botoes['back']) && $this->nmgp_botoes['back'] == "on")
    {
?>
       $("#sc_b_ret_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
?>
 }
 if ('S' == str_ava)
 {
<?php
    if (isset($this->nmgp_botoes['last']) && $this->nmgp_botoes['last'] == "on")
    {
?>
       if ("off" == Nav_bfinal_macro_disabled) { $("#sc_b_fim_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
    if (isset($this->nmgp_botoes['forward']) && $this->nmgp_botoes['forward'] == "on")
    {
?>
       if ("off" == Nav_bavanca_macro_disabled) { $("#sc_b_avc_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
?>
 }
 else
 {
<?php
    if (isset($this->nmgp_botoes['last']) && $this->nmgp_botoes['last'] == "on")
    {
?>
       $("#sc_b_fim_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
    if (isset($this->nmgp_botoes['forward']) && $this->nmgp_botoes['forward'] == "on")
    {
?>
       $("#sc_b_avc_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
?>
 }
<?php
  }
?>
}
function nav_liga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' == sImg.substr(sImg.length - 4))
 {
  sImg = sImg.substr(0, sImg.length - 4);
 }
 sImg += sExt;
}
function nav_desliga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' != sImg.substr(sImg.length - 4))
 {
  sImg += '_off';
 }
 sImg += sExt;
}
<?php

include_once('app_settings_jquery.php');

?>

 var Dyn_Ini  = true;
function setLabelCellMaxWidth()
{
    var $labelList = $(".scUiLabelWidthFix"), $spanList, i, testWidth, maxLabelWidth = 0;
    for (i = 0; i < $labelList.length; i++) {
        $spanList = $($labelList[i]).find("span");

        if ($spanList.length) {
            testWidth  = $($spanList[0]).width();

            maxLabelWidth = Math.max(maxLabelWidth, testWidth);
        }
    }

    if (0 < maxLabelWidth) {
        maxLabelWidth += 20;
        $labelList.css("width", maxLabelWidth + "px");
    }
}

 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

        setLabelCellMaxWidth();

<?php
if (!$this->NM_ajax_flag && isset($this->NM_non_ajax_info['ajaxJavascript']) && !empty($this->NM_non_ajax_info['ajaxJavascript']))
{
    foreach ($this->NM_non_ajax_info['ajaxJavascript'] as $aFnData)
    {
?>
  <?php echo $aFnData[0]; ?>(<?php echo implode(', ', $aFnData[1]); ?>);

<?php
    }
}
?>
 });

   $(window).on('load', function() {
   });
 if($(".sc-ui-block-control").length) {
  preloadBlock = new Image();
  preloadBlock.src = "<?php echo $this->Ini->path_icones; ?>/" + sc_blockExp;
 }

 var show_block = {
  
 };

 function toggleBlock(e) {
  var block = e.data.block,
      block_id = $(block).attr("id");
      block_img = $("#" + block_id + " .sc-ui-block-control");

  if (1 >= block.rows.length) {
   return;
  }

  show_block[block_id] = !show_block[block_id];

  if (show_block[block_id]) {
    $(block).css("height", "100%");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockCol));
  }
  else {
    $(block).css("height", "");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockExp));
  }

  for (var i = 2; i < block.rows.length; i++) {
   if (show_block[block_id])
    $(block.rows[i]).show();
   else
    $(block.rows[i]).hide();
  }

  if (show_block[block_id]) {
  }
 }

 function changeImgName(imgOld, imgNew) {
   var aOld = imgOld.split("/");
   aOld.pop();
   aOld.push(imgNew);
   return aOld.join("/");
 }

</script>
</HEAD>
<?php
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['recarga'];
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['link_info']['remove_border']) {
        $remove_border = 'border-width: 0; ';
    }
    if ('' != $remove_background) {
?>
<style>
.scFormBorder { <?php echo $remove_background ?> }
.scFormToolbar { <?php echo $remove_background ?> }
</style>
<?php
    }
    $vertical_center = '';
?>
<body class="scFormPage sc-app-contr" style="<?php echo $remove_margin . $remove_background . $str_iframe_body . $vertical_center; ?>">
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    echo $sOBContents;
}

?>
<div id="idJSSpecChar" style="display: none;"></div>
<script type="text/javascript">
function NM_tp_critica(TP)
{
    if (TP == 0 || TP == 1 || TP == 2)
    {
        nmdg_tipo_crit = TP;
    }
}
</script> 
<?php
 include_once("app_settings_js0.php");
?>
<script type="text/javascript"> 
 function setLocale(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_idioma_novo.value = sLocale;
 }
 function setSchema(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_schema_f.value = sLocale;
 }
var scInsertFieldWithErrors = new Array();
<?php
foreach ($this->NM_ajax_info['fieldsWithErrors'] as $insertFieldName) {
?>
scInsertFieldWithErrors.push("<?php echo $insertFieldName; ?>");
<?php
}
?>
$(function() {
        scAjaxError_markFieldList(scInsertFieldWithErrors);
});
 </script>
<form  name="F1" method="post" 
               action="./" 
               target="_self">
<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_idioma_novo" value="">
<input type="hidden" name="nmgp_schema_f" value="">
<input type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($nmgp_url_saida); ?>">
<input type="hidden" name="bok" value="OK">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="nmgp_ancora" value="">
<input type="hidden" name="nmgp_num_form" value="<?php  echo $this->form_encode_input($nmgp_num_form); ?>">
<input type="hidden" name="nmgp_parms" value="">
<input type="hidden" name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>">
<input type="hidden" name="NM_cancel_return_new" value="<?php echo $this->NM_cancel_return_new ?>">
<input type="hidden" name="csrf_token" value="<?php echo $this->scCsrfGetToken() ?>" />
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['app_settings'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['app_settings'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
?>
<div style="display: none; position: absolute; z-index: 1000" id="id_error_display_table_frame">
<table class="scFormErrorTable scFormToastTable">
<tr><?php if ($this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><td style="padding: 0px" rowspan="2"><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top"></td><?php } ?><td class="scFormErrorTitle scFormToastTitle"><table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormErrorTitleFont" style="padding: 0px; vertical-align: top; width: 100%"><?php if (!$this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top">&nbsp;<?php } ?>ERROR</td><td style="padding: 0px; vertical-align: top"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideErrorDisplay('table')", "scAjaxHideErrorDisplay('table')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</td></tr></table></td></tr>
<tr><td class="scFormErrorMessage scFormToastMessage"><span id="id_error_display_table_text"></span></td></tr>
</table>
</div>
<div style="display: none; position: absolute; z-index: 1000" id="id_message_display_frame">
 <table class="scFormMessageTable" id="id_message_display_content" style="width: 100%">
  <tr id="id_message_display_title_line">
   <td class="scFormMessageTitle" style="height: 20px"><?php
if ('' != $this->Ini->Msg_ico_title) {
?>
<img src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_title; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmessageclose", "_scAjaxMessageBtnClose()", "_scAjaxMessageBtnClose()", "id_message_display_close_icon", "", "", "float: right", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<span id="id_message_display_title" style="vertical-align: middle"></span></td>
  </tr>
  <tr>
   <td class="scFormMessageMessage"><?php
if ('' != $this->Ini->Msg_ico_body) {
?>
<img id="id_message_display_body_icon" src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_body; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<span id="id_message_display_text"></span><div id="id_message_display_buttond" style="display: none; text-align: center"><br /><input id="id_message_display_buttone" type="button" class="scButton_default" value="Ok" onClick="_scAjaxMessageBtnClick()" ></div></td>
  </tr>
 </table>
</div>
<?php
$msgDefClose = isset($this->arr_buttons['bmessageclose']) ? $this->arr_buttons['bmessageclose']['value'] : 'Ok';
?>
<script type="text/javascript">
var scMsgDefTitle = "<?php if (isset($this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl'])) {echo $this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl'];} ?>";
var scMsgDefButton = "Ok";
var scMsgDefClose = "<?php echo $msgDefClose; ?>";
var scMsgDefClick = "close";
var scMsgDefScInit = "<?php echo $this->Ini->sc_page; ?>";
</script>
<?php
if ($this->record_insert_ok)
{
?>
<script type="text/javascript">
if (typeof sc_userSweetAlertDisplayed === "undefined" || !sc_userSweetAlertDisplayed) {
    _scAjaxShowMessage({message: "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_othr_ajax_frmi']) ?>", title: "", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: true, type: "success"});
}
sc_userSweetAlertDisplayed = false;
</script>
<?php
}
if ($this->record_delete_ok)
{
?>
<script type="text/javascript">
if (typeof sc_userSweetAlertDisplayed === "undefined" || !sc_userSweetAlertDisplayed) {
    _scAjaxShowMessage({message: "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_othr_ajax_frmd']) ?>", title: "", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: true, type: "success"});
}
sc_userSweetAlertDisplayed = false;
</script>
<?php
}
?>
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0  width="60%">
 <tr>
  <td>
  <div class="scFormBorder" style="<?php echo (isset($remove_border) ? $remove_border : ''); ?>">
   <table width='100%' cellspacing=0 cellpadding=0>
<?php
$this->displayAppHeader();
?>
<tr><td>
<?php
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
<?php
?>
<script type="text/javascript">
function sc_change_tabs(bTabDisp, sTabId, sTabParts)
{
  if (document.getElementById(sTabId)) {
    if (bTabDisp) {
      document.getElementById("div_" + sTabId).style.width = "";
      document.getElementById("div_" + sTabId).style.height = "";
      document.getElementById("div_" + sTabId).style.display = "";
      document.getElementById("div_" + sTabId).style.overflow = "visible";
      document.getElementById(sTabParts).className = "scTabActive";
    }
    else {
      document.getElementById("div_" + sTabId).style.width = "1px";
      document.getElementById("div_" + sTabId).style.height = "0px";
      document.getElementById("div_" + sTabId).style.display = "none";
      document.getElementById("div_" + sTabId).style.overflow = "scroll";
      document.getElementById(sTabParts).className = "scTabInactive";
    }
  }
}
</script>
<script type="text/javascript">
function sc_control_tabs_0(iTabIndex)
{
  sc_change_tabs(iTabIndex == 0, 'hidden_bloco_0', 'id_tabs_0_0');
  if (iTabIndex == 0) {
    displayChange_block("0", "on");
  }
  sc_change_tabs(iTabIndex == 1, 'hidden_bloco_1', 'id_tabs_0_1');
  if (iTabIndex == 1) {
    displayChange_block("1", "on");
  }
  sc_change_tabs(iTabIndex == 2, 'hidden_bloco_2', 'id_tabs_0_2');
  if (iTabIndex == 2) {
    displayChange_block("2", "on");
  }
  sc_change_tabs(iTabIndex == 3, 'hidden_bloco_3', 'id_tabs_0_3');
  if (iTabIndex == 3) {
    displayChange_block("3", "on");
  }
  sc_change_tabs(iTabIndex == 4, 'hidden_bloco_4', 'id_tabs_0_4');
  if (iTabIndex == 4) {
    displayChange_block("4", "on");
  }
  sc_change_tabs(iTabIndex == 5, 'hidden_bloco_5', 'id_tabs_0_5');
  if (iTabIndex == 5) {
    displayChange_block("5", "on");
  }
}
</script>
<ul class="scTabLine">
<li id="id_tabs_0_0" class="scTabActive"><a href="javascript: sc_control_tabs_0(0)"><?php echo $this->Ini->Nm_lang['lang_sec_tab_general'] ?></a></li>
<li id="id_tabs_0_1" class="scTabInactive"><a href="javascript: sc_control_tabs_0(1)"><?php echo $this->Ini->Nm_lang['lang_sec_tab_security'] ?></a></li>
<li id="id_tabs_0_2" class="scTabInactive"><a href="javascript: sc_control_tabs_0(2)"><?php echo $this->Ini->Nm_lang['lang_sec_tab_2fa'] ?></a></li>
<li id="id_tabs_0_3" class="scTabInactive"><a href="javascript: sc_control_tabs_0(3)"><?php echo $this->Ini->Nm_lang['lang_sec_tab_new_users'] ?></a></li>
<li id="id_tabs_0_4" class="scTabInactive"><a href="javascript: sc_control_tabs_0(4)"><?php echo $this->Ini->Nm_lang['lang_sec_tab_email'] ?></a></li>
<li id="id_tabs_0_5" class="scTabInactive"><a href="javascript: sc_control_tabs_0(5)"><?php echo $this->Ini->Nm_lang['lang_sec_tab_social_auth'] ?></a></li>
</ul>
<div style='clear:both'></div>
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" cellpadding="0" cellspacing="0" border="0" width="100%" style="height: 100%">
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['session_expire']))
   {
       $this->nm_new_label['session_expire'] = "" . $this->Ini->Nm_lang['lang_sec_set_session_expire'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $session_expire = $this->session_expire;
   $sStyleHidden_session_expire = '';
   if (isset($this->nmgp_cmp_hidden['session_expire']) && $this->nmgp_cmp_hidden['session_expire'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['session_expire']);
       $sStyleHidden_session_expire = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_session_expire = 'display: none;';
   $sStyleReadInp_session_expire = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['session_expire']) && $this->nmgp_cmp_readonly['session_expire'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['session_expire']);
       $sStyleReadLab_session_expire = '';
       $sStyleReadInp_session_expire = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['session_expire']) && $this->nmgp_cmp_hidden['session_expire'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="session_expire" value="<?php echo $this->form_encode_input($this->session_expire) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_session_expire_label" id="hidden_field_label_session_expire" style="<?php echo $sStyleHidden_session_expire; ?>"><span id="id_label_session_expire"><?php echo $this->nm_new_label['session_expire']; ?></span></TD>
    <TD class="scFormDataOdd css_session_expire_line" id="hidden_field_data_session_expire" style="<?php echo $sStyleHidden_session_expire; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["session_expire"]) &&  $this->nmgp_cmp_readonly["session_expire"] == "on") { 

$session_expire_look = "";
 if ($this->session_expire == "N") { $session_expire_look .= "" . $this->Ini->Nm_lang['lang_sec_sess_no'] . "" ;} 
 if ($this->session_expire == "R") { $session_expire_look .= "" . $this->Ini->Nm_lang['lang_sec_sess_redir'] . "" ;} 
 if ($this->session_expire == "M") { $session_expire_look .= "" . $this->Ini->Nm_lang['lang_sec_sess_msg'] . "" ;} 
 if (empty($session_expire_look)) { $session_expire_look = $this->session_expire; }
?>
<input type="hidden" name="session_expire" value="<?php echo $this->form_encode_input($session_expire) . "\">" . $session_expire_look . ""; ?>
<?php } else { ?>
<?php

$session_expire_look = "";
 if ($this->session_expire == "N") { $session_expire_look .= "" . $this->Ini->Nm_lang['lang_sec_sess_no'] . "" ;} 
 if ($this->session_expire == "R") { $session_expire_look .= "" . $this->Ini->Nm_lang['lang_sec_sess_redir'] . "" ;} 
 if ($this->session_expire == "M") { $session_expire_look .= "" . $this->Ini->Nm_lang['lang_sec_sess_msg'] . "" ;} 
 if (empty($session_expire_look)) { $session_expire_look = $this->session_expire; }
?>
<span id="id_read_on_session_expire" class="css_session_expire_line"  style="<?php echo $sStyleReadLab_session_expire; ?>"><?php echo $this->form_format_readonly("session_expire", $this->form_encode_input($session_expire_look)); ?></span><span id="id_read_off_session_expire" class="css_read_off_session_expire<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_session_expire; ?>">
 <span id="idAjaxSelect_session_expire" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_session_expire_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_session_expire" name="session_expire" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="N" <?php  if ($this->session_expire == "N") { echo " selected" ;} ?><?php  if (empty($this->session_expire)) { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_sec_sess_no']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_session_expire'][] = 'N'; ?>
 <option  value="R" <?php  if ($this->session_expire == "R") { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_sec_sess_redir']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_session_expire'][] = 'R'; ?>
 <option  value="M" <?php  if ($this->session_expire == "M") { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_sec_sess_msg']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_session_expire'][] = 'M'; ?>
 </select></span>
</span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['remember_me']))
   {
       $this->nm_new_label['remember_me'] = "" . $this->Ini->Nm_lang['lang_sec_set_remember_me'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $remember_me = $this->remember_me;
   $sStyleHidden_remember_me = '';
   if (isset($this->nmgp_cmp_hidden['remember_me']) && $this->nmgp_cmp_hidden['remember_me'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['remember_me']);
       $sStyleHidden_remember_me = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_remember_me = 'display: none;';
   $sStyleReadInp_remember_me = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['remember_me']) && $this->nmgp_cmp_readonly['remember_me'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['remember_me']);
       $sStyleReadLab_remember_me = '';
       $sStyleReadInp_remember_me = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['remember_me']) && $this->nmgp_cmp_hidden['remember_me'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="remember_me" value="<?php echo $this->form_encode_input($this->remember_me) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php 
  if ($this->nmgp_opcao != "recarga") 
  {
      $this->remember_me_1 = explode(";", trim($this->remember_me));
  } 
  else
  {
      if (empty($this->remember_me))
      {
          $this->remember_me_1= array(); 
          $this->remember_me= "N";
      } 
      else
      {
          $this->remember_me_1= $this->remember_me; 
          $this->remember_me= ""; 
          foreach ($this->remember_me_1 as $cada_remember_me)
          {
             if (!empty($remember_me))
             {
                 $this->remember_me.= ";"; 
             } 
             $this->remember_me.= $cada_remember_me; 
          } 
      } 
  } 
?> 

    <TD class="scFormLabelOdd scUiLabelWidthFix css_remember_me_label" id="hidden_field_label_remember_me" style="<?php echo $sStyleHidden_remember_me; ?>"><span id="id_label_remember_me"><?php echo $this->nm_new_label['remember_me']; ?></span></TD>
    <TD class="scFormDataOdd css_remember_me_line" id="hidden_field_data_remember_me" style="<?php echo $sStyleHidden_remember_me; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["remember_me"]) &&  $this->nmgp_cmp_readonly["remember_me"] == "on") { 

$remember_me_look = "";
 if ($this->remember_me == "Y") { $remember_me_look .= "" ;} 
 if (empty($remember_me_look)) { $remember_me_look = $this->remember_me; }
?>
<input type="hidden" name="remember_me" value="<?php echo $this->form_encode_input($remember_me) . "\">" . $remember_me_look . ""; ?>
<?php } else { ?>

<?php

$remember_me_look = "";
 if ($this->remember_me == "Y") { $remember_me_look .= "" ;} 
 if (empty($remember_me_look)) { $remember_me_look = $this->remember_me; }
?>
<span id="id_read_on_remember_me" class="css_remember_me_line" style="<?php echo $sStyleReadLab_remember_me; ?>"><?php echo $this->form_format_readonly("remember_me", $this->form_encode_input($remember_me_look)); ?></span><span id="id_read_off_remember_me" class="css_read_off_remember_me css_remember_me_line" style="<?php echo $sStyleReadInp_remember_me; ?>"><?php echo "<div id=\"idAjaxCheckbox_remember_me\" style=\"display: inline-block\" class=\"css_remember_me_line\">\r\n"; ?><TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_remember_me_line"><?php $tempOptionId = "id-opt-remember_me" . $sc_seq_vert . "-1"; ?>
 <div class="sc switch">
 <input type=checkbox id="<?php echo $tempOptionId ?>" class="sc-ui-checkbox-remember_me sc-ui-checkbox-remember_me" name="remember_me[]" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_remember_me'][] = 'Y'; ?>
<?php  if (in_array("Y", $this->remember_me_1))  { echo " checked" ;} ?> onClick="do_ajax_app_settings_event_remember_me_onclick();" ><span></span>
<label for="<?php echo $tempOptionId ?>"></label> </div>
</TD>
</TR></TABLE>
<?php echo "</div>\r\n"; ?></span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cookie_expiration_time']))
    {
        $this->nm_new_label['cookie_expiration_time'] = "" . $this->Ini->Nm_lang['lang_sec_set_cookie_exp_time'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cookie_expiration_time = $this->cookie_expiration_time;
   $sStyleHidden_cookie_expiration_time = '';
   if (isset($this->nmgp_cmp_hidden['cookie_expiration_time']) && $this->nmgp_cmp_hidden['cookie_expiration_time'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cookie_expiration_time']);
       $sStyleHidden_cookie_expiration_time = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cookie_expiration_time = 'display: none;';
   $sStyleReadInp_cookie_expiration_time = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cookie_expiration_time']) && $this->nmgp_cmp_readonly['cookie_expiration_time'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cookie_expiration_time']);
       $sStyleReadLab_cookie_expiration_time = '';
       $sStyleReadInp_cookie_expiration_time = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cookie_expiration_time']) && $this->nmgp_cmp_hidden['cookie_expiration_time'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cookie_expiration_time" value="<?php echo $this->form_encode_input($cookie_expiration_time) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cookie_expiration_time_label" id="hidden_field_label_cookie_expiration_time" style="<?php echo $sStyleHidden_cookie_expiration_time; ?>"><span id="id_label_cookie_expiration_time"><?php echo $this->nm_new_label['cookie_expiration_time']; ?></span></TD>
    <TD class="scFormDataOdd css_cookie_expiration_time_line" id="hidden_field_data_cookie_expiration_time" style="<?php echo $sStyleHidden_cookie_expiration_time; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cookie_expiration_time"]) &&  $this->nmgp_cmp_readonly["cookie_expiration_time"] == "on") { 

 ?>
<input type="hidden" name="cookie_expiration_time" value="<?php echo $this->form_encode_input($cookie_expiration_time) . "\">" . $cookie_expiration_time . ""; ?>
<?php } else { ?>
<span id="id_read_on_cookie_expiration_time" class="sc-ui-readonly-cookie_expiration_time css_cookie_expiration_time_line" style="<?php echo $sStyleReadLab_cookie_expiration_time; ?>"><?php echo $this->form_format_readonly("cookie_expiration_time", $this->form_encode_input($this->cookie_expiration_time)); ?></span><span id="id_read_off_cookie_expiration_time" class="css_read_off_cookie_expiration_time<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cookie_expiration_time; ?>">
 <input class="sc-js-input scFormObjectOdd scFormObjectOddSpin scSpin_cookie_expiration_time_obj css_cookie_expiration_time_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cookie_expiration_time" type=text name="cookie_expiration_time" value="<?php echo $this->form_encode_input($cookie_expiration_time) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=3"; } ?> alt="{datatype: 'integer', maxLength: 20, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['cookie_expiration_time']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['cookie_expiration_time']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['cookie_expiration_time']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
<span class="css_cookie_expiration_time_label scFormHelpOdd">&nbsp;<?php echo $this->Ini->Nm_lang['lang_sec_days'] ?>
</span></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['theme']))
   {
       $this->nm_new_label['theme'] = "" . $this->Ini->Nm_lang['lang_sec_set_theme'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $theme = $this->theme;
   $tst_schema = $this->Ini->str_schema_all;
   if (false !== strpos($tst_schema, '/'))
   {
       $tst_schema = substr($tst_schema, 0, strpos($tst_schema, '/'));
   }
   $sStyleHidden_theme = '';
   if (isset($this->nmgp_cmp_hidden['theme']) && $this->nmgp_cmp_hidden['theme'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['theme']);
       $sStyleHidden_theme = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_theme = 'display: none;';
   $sStyleReadInp_theme = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['theme']) && $this->nmgp_cmp_readonly['theme'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['theme']);
       $sStyleReadLab_theme = '';
       $sStyleReadInp_theme = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['theme']) && $this->nmgp_cmp_hidden['theme'] == 'off') { $sc_hidden_yes++; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_theme_label" id="hidden_field_label_theme" style="<?php echo $sStyleHidden_theme; ?>"><span id="id_label_theme"><?php echo $this->nm_new_label['theme']; ?></span></TD>
    <TD class="scFormDataOdd css_theme_line" id="hidden_field_data_theme" style="<?php echo $sStyleHidden_theme; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["theme"]) &&  $this->nmgp_cmp_readonly["theme"] == "on") { 

 ?>
<input type="hidden" name="theme" value="<?php echo $this->form_encode_input($theme) . "\">" . $theme . ""; ?>
<?php } else { ?>
<span id="id_read_on_theme" class="css_theme_line" style="<?php echo $sStyleReadLab_theme; ?>"><?php echo $this->Ini->Nm_lang_conf_region[$tst_conf_reg]; ?></span><span id="id_read_off_theme" class="css_read_off_theme" style="<?php echo $sStyleReadInp_theme; ?>">
 <span id="idAjaxSelect_theme"><select class="sc-js-input scFormObjectOdd css_theme_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" name="theme" size=1 onChange="document.F1.nmgp_opcao.value='change_schema_f'; setSchema(this); document.F1.submit(); return false">
<?php
      if (is_file("../_lib/css/schemas.ini"))
      {
          $arq_sch = file("../_lib/css/schemas.ini");
          foreach ($arq_sch as $cada_schema)
          {
             $par_schema = explode("#nm#", $cada_schema);
             $obj_sel = ($tst_schema == $par_schema[0]) ? " selected" : "";
             echo "  <option value=\"" . $par_schema[0] . "\"" .  $obj_sel . ">" . str_replace('<', '&lt;',$par_schema[1]) . "</option>";
          }
      }
?>
 </select></span>
</span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['language']))
   {
       $this->nm_new_label['language'] = "" . $this->Ini->Nm_lang['lang_sec_set_language'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $language = $this->language;
   $sStyleHidden_language = '';
   if (isset($this->nmgp_cmp_hidden['language']) && $this->nmgp_cmp_hidden['language'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['language']);
       $sStyleHidden_language = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_language = 'display: none;';
   $sStyleReadInp_language = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['language']) && $this->nmgp_cmp_readonly['language'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['language']);
       $sStyleReadLab_language = '';
       $sStyleReadInp_language = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['language']) && $this->nmgp_cmp_hidden['language'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="language" value="<?php echo $this->form_encode_input($this->language) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php 
  if ($this->nmgp_opcao != "recarga") 
  {
      $this->language_1 = explode(";", trim($this->language));
  } 
  else
  {
      if (empty($this->language))
      {
          $this->language_1= array(); 
          $this->language= "N";
      } 
      else
      {
          $this->language_1= $this->language; 
          $this->language= ""; 
          foreach ($this->language_1 as $cada_language)
          {
             if (!empty($language))
             {
                 $this->language.= ";"; 
             } 
             $this->language.= $cada_language; 
          } 
      } 
  } 
?> 

    <TD class="scFormLabelOdd scUiLabelWidthFix css_language_label" id="hidden_field_label_language" style="<?php echo $sStyleHidden_language; ?>"><span id="id_label_language"><?php echo $this->nm_new_label['language']; ?></span></TD>
    <TD class="scFormDataOdd css_language_line" id="hidden_field_data_language" style="<?php echo $sStyleHidden_language; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["language"]) &&  $this->nmgp_cmp_readonly["language"] == "on") { 

$language_look = "";
 if ($this->language == "Y") { $language_look .= "" ;} 
 if (empty($language_look)) { $language_look = $this->language; }
?>
<input type="hidden" name="language" value="<?php echo $this->form_encode_input($language) . "\">" . $language_look . ""; ?>
<?php } else { ?>

<?php

$language_look = "";
 if ($this->language == "Y") { $language_look .= "" ;} 
 if (empty($language_look)) { $language_look = $this->language; }
?>
<span id="id_read_on_language" class="css_language_line" style="<?php echo $sStyleReadLab_language; ?>"><?php echo $this->form_format_readonly("language", $this->form_encode_input($language_look)); ?></span><span id="id_read_off_language" class="css_read_off_language css_language_line" style="<?php echo $sStyleReadInp_language; ?>"><?php echo "<div id=\"idAjaxCheckbox_language\" style=\"display: inline-block\" class=\"css_language_line\">\r\n"; ?><TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_language_line"><?php $tempOptionId = "id-opt-language" . $sc_seq_vert . "-1"; ?>
 <div class="sc switch">
 <input type=checkbox id="<?php echo $tempOptionId ?>" class="sc-ui-checkbox-language sc-ui-checkbox-language" name="language[]" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_language'][] = 'Y'; ?>
<?php  if (in_array("Y", $this->language_1))  { echo " checked" ;} ?> onClick="" ><span></span>
<label for="<?php echo $tempOptionId ?>"></label> </div>
</TD>
</TR></TABLE>
<?php echo "</div>\r\n"; ?></span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['login_mode']))
   {
       $this->nm_new_label['login_mode'] = "" . $this->Ini->Nm_lang['lang_sec_set_login_mode'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $login_mode = $this->login_mode;
   $sStyleHidden_login_mode = '';
   if (isset($this->nmgp_cmp_hidden['login_mode']) && $this->nmgp_cmp_hidden['login_mode'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['login_mode']);
       $sStyleHidden_login_mode = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_login_mode = 'display: none;';
   $sStyleReadInp_login_mode = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['login_mode']) && $this->nmgp_cmp_readonly['login_mode'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['login_mode']);
       $sStyleReadLab_login_mode = '';
       $sStyleReadInp_login_mode = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['login_mode']) && $this->nmgp_cmp_hidden['login_mode'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="login_mode" value="<?php echo $this->form_encode_input($this->login_mode) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_login_mode_label" id="hidden_field_label_login_mode" style="<?php echo $sStyleHidden_login_mode; ?>"><span id="id_label_login_mode"><?php echo $this->nm_new_label['login_mode']; ?></span></TD>
    <TD class="scFormDataOdd css_login_mode_line" id="hidden_field_data_login_mode" style="<?php echo $sStyleHidden_login_mode; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["login_mode"]) &&  $this->nmgp_cmp_readonly["login_mode"] == "on") { 

$login_mode_look = "";
 if ($this->login_mode == "username") { $login_mode_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_login_mode_user'] . "" ;} 
 if ($this->login_mode == "email") { $login_mode_look .= "E-mail" ;} 
 if ($this->login_mode == "both") { $login_mode_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_login_mode_both'] . "" ;} 
 if (empty($login_mode_look)) { $login_mode_look = $this->login_mode; }
?>
<input type="hidden" name="login_mode" value="<?php echo $this->form_encode_input($login_mode) . "\">" . $login_mode_look . ""; ?>
<?php } else { ?>
<?php

$login_mode_look = "";
 if ($this->login_mode == "username") { $login_mode_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_login_mode_user'] . "" ;} 
 if ($this->login_mode == "email") { $login_mode_look .= "E-mail" ;} 
 if ($this->login_mode == "both") { $login_mode_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_login_mode_both'] . "" ;} 
 if (empty($login_mode_look)) { $login_mode_look = $this->login_mode; }
?>
<span id="id_read_on_login_mode" class="css_login_mode_line"  style="<?php echo $sStyleReadLab_login_mode; ?>"><?php echo $this->form_format_readonly("login_mode", $this->form_encode_input($login_mode_look)); ?></span><span id="id_read_off_login_mode" class="css_read_off_login_mode<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_login_mode; ?>">
 <span id="idAjaxSelect_login_mode" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_login_mode_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_login_mode" name="login_mode" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="username" <?php  if ($this->login_mode == "username") { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_sec_opt_login_mode_user']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_login_mode'][] = 'username'; ?>
 <option  value="email" <?php  if ($this->login_mode == "email") { echo " selected" ;} ?>>E-mail</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_login_mode'][] = 'email'; ?>
 <option  value="both" <?php  if ($this->login_mode == "both") { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_sec_opt_login_mode_both']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_login_mode'][] = 'both'; ?>
 </select></span>
</span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_1"></a>
<div id="div_hidden_bloco_1" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['captcha']))
   {
       $this->nm_new_label['captcha'] = "" . $this->Ini->Nm_lang['lang_sec_set_captcha'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $captcha = $this->captcha;
   $sStyleHidden_captcha = '';
   if (isset($this->nmgp_cmp_hidden['captcha']) && $this->nmgp_cmp_hidden['captcha'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['captcha']);
       $sStyleHidden_captcha = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_captcha = 'display: none;';
   $sStyleReadInp_captcha = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['captcha']) && $this->nmgp_cmp_readonly['captcha'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['captcha']);
       $sStyleReadLab_captcha = '';
       $sStyleReadInp_captcha = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['captcha']) && $this->nmgp_cmp_hidden['captcha'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="captcha" value="<?php echo $this->form_encode_input($this->captcha) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php 
  if ($this->nmgp_opcao != "recarga") 
  {
      $this->captcha_1 = explode(";", trim($this->captcha));
  } 
  else
  {
      if (empty($this->captcha))
      {
          $this->captcha_1= array(); 
          $this->captcha= "N";
      } 
      else
      {
          $this->captcha_1= $this->captcha; 
          $this->captcha= ""; 
          foreach ($this->captcha_1 as $cada_captcha)
          {
             if (!empty($captcha))
             {
                 $this->captcha.= ";"; 
             } 
             $this->captcha.= $cada_captcha; 
          } 
      } 
  } 
?> 

    <TD class="scFormLabelOdd scUiLabelWidthFix css_captcha_label" id="hidden_field_label_captcha" style="<?php echo $sStyleHidden_captcha; ?>"><span id="id_label_captcha"><?php echo $this->nm_new_label['captcha']; ?></span></TD>
    <TD class="scFormDataOdd css_captcha_line" id="hidden_field_data_captcha" style="<?php echo $sStyleHidden_captcha; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["captcha"]) &&  $this->nmgp_cmp_readonly["captcha"] == "on") { 

$captcha_look = "";
 if ($this->captcha == "Y") { $captcha_look .= "" ;} 
 if (empty($captcha_look)) { $captcha_look = $this->captcha; }
?>
<input type="hidden" name="captcha" value="<?php echo $this->form_encode_input($captcha) . "\">" . $captcha_look . ""; ?>
<?php } else { ?>

<?php

$captcha_look = "";
 if ($this->captcha == "Y") { $captcha_look .= "" ;} 
 if (empty($captcha_look)) { $captcha_look = $this->captcha; }
?>
<span id="id_read_on_captcha" class="css_captcha_line" style="<?php echo $sStyleReadLab_captcha; ?>"><?php echo $this->form_format_readonly("captcha", $this->form_encode_input($captcha_look)); ?></span><span id="id_read_off_captcha" class="css_read_off_captcha css_captcha_line" style="<?php echo $sStyleReadInp_captcha; ?>"><?php echo "<div id=\"idAjaxCheckbox_captcha\" style=\"display: inline-block\" class=\"css_captcha_line\">\r\n"; ?><TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_captcha_line"><?php $tempOptionId = "id-opt-captcha" . $sc_seq_vert . "-1"; ?>
 <div class="sc switch">
 <input type=checkbox id="<?php echo $tempOptionId ?>" class="sc-ui-checkbox-captcha sc-ui-checkbox-captcha" name="captcha[]" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_captcha'][] = 'Y'; ?>
<?php  if (in_array("Y", $this->captcha_1))  { echo " checked" ;} ?> onClick="" ><span></span>
<label for="<?php echo $tempOptionId ?>"></label> </div>
</TD>
</TR></TABLE>
<?php echo "</div>\r\n"; ?></span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['pswd_last_updated']))
    {
        $this->nm_new_label['pswd_last_updated'] = "" . $this->Ini->Nm_lang['lang_sec_set_pswd_last_updated'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $pswd_last_updated = $this->pswd_last_updated;
   $sStyleHidden_pswd_last_updated = '';
   if (isset($this->nmgp_cmp_hidden['pswd_last_updated']) && $this->nmgp_cmp_hidden['pswd_last_updated'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['pswd_last_updated']);
       $sStyleHidden_pswd_last_updated = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_pswd_last_updated = 'display: none;';
   $sStyleReadInp_pswd_last_updated = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['pswd_last_updated']) && $this->nmgp_cmp_readonly['pswd_last_updated'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['pswd_last_updated']);
       $sStyleReadLab_pswd_last_updated = '';
       $sStyleReadInp_pswd_last_updated = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['pswd_last_updated']) && $this->nmgp_cmp_hidden['pswd_last_updated'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="pswd_last_updated" value="<?php echo $this->form_encode_input($pswd_last_updated) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_pswd_last_updated_label" id="hidden_field_label_pswd_last_updated" style="<?php echo $sStyleHidden_pswd_last_updated; ?>"><span id="id_label_pswd_last_updated"><?php echo $this->nm_new_label['pswd_last_updated']; ?></span></TD>
    <TD class="scFormDataOdd css_pswd_last_updated_line" id="hidden_field_data_pswd_last_updated" style="<?php echo $sStyleHidden_pswd_last_updated; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["pswd_last_updated"]) &&  $this->nmgp_cmp_readonly["pswd_last_updated"] == "on") { 

 ?>
<input type="hidden" name="pswd_last_updated" value="<?php echo $this->form_encode_input($pswd_last_updated) . "\">" . $pswd_last_updated . ""; ?>
<?php } else { ?>
<span id="id_read_on_pswd_last_updated" class="sc-ui-readonly-pswd_last_updated css_pswd_last_updated_line" style="<?php echo $sStyleReadLab_pswd_last_updated; ?>"><?php echo $this->form_format_readonly("pswd_last_updated", $this->form_encode_input($this->pswd_last_updated)); ?></span><span id="id_read_off_pswd_last_updated" class="css_read_off_pswd_last_updated<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_pswd_last_updated; ?>">
 <input class="sc-js-input scFormObjectOdd scFormObjectOddSpin scSpin_pswd_last_updated_obj css_pswd_last_updated_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_pswd_last_updated" type=text name="pswd_last_updated" value="<?php echo $this->form_encode_input($pswd_last_updated) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'integer', maxLength: 20, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['pswd_last_updated']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['pswd_last_updated']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['pswd_last_updated']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
<span class="css_pswd_last_updated_label scFormHelpOdd">&nbsp;<?php echo $this->Ini->Nm_lang['lang_sec_days'] ?>
</span></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['brute_force']))
   {
       $this->nm_new_label['brute_force'] = "" . $this->Ini->Nm_lang['lang_sec_set_brute_force'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $brute_force = $this->brute_force;
   $sStyleHidden_brute_force = '';
   if (isset($this->nmgp_cmp_hidden['brute_force']) && $this->nmgp_cmp_hidden['brute_force'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['brute_force']);
       $sStyleHidden_brute_force = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_brute_force = 'display: none;';
   $sStyleReadInp_brute_force = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['brute_force']) && $this->nmgp_cmp_readonly['brute_force'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['brute_force']);
       $sStyleReadLab_brute_force = '';
       $sStyleReadInp_brute_force = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['brute_force']) && $this->nmgp_cmp_hidden['brute_force'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="brute_force" value="<?php echo $this->form_encode_input($this->brute_force) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php 
  if ($this->nmgp_opcao != "recarga") 
  {
      $this->brute_force_1 = explode(";", trim($this->brute_force));
  } 
  else
  {
      if (empty($this->brute_force))
      {
          $this->brute_force_1= array(); 
          $this->brute_force= "N";
      } 
      else
      {
          $this->brute_force_1= $this->brute_force; 
          $this->brute_force= ""; 
          foreach ($this->brute_force_1 as $cada_brute_force)
          {
             if (!empty($brute_force))
             {
                 $this->brute_force.= ";"; 
             } 
             $this->brute_force.= $cada_brute_force; 
          } 
      } 
  } 
?> 

    <TD class="scFormLabelOdd scUiLabelWidthFix css_brute_force_label" id="hidden_field_label_brute_force" style="<?php echo $sStyleHidden_brute_force; ?>"><span id="id_label_brute_force"><?php echo $this->nm_new_label['brute_force']; ?></span></TD>
    <TD class="scFormDataOdd css_brute_force_line" id="hidden_field_data_brute_force" style="<?php echo $sStyleHidden_brute_force; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["brute_force"]) &&  $this->nmgp_cmp_readonly["brute_force"] == "on") { 

$brute_force_look = "";
 if ($this->brute_force == "Y") { $brute_force_look .= "" ;} 
 if (empty($brute_force_look)) { $brute_force_look = $this->brute_force; }
?>
<input type="hidden" name="brute_force" value="<?php echo $this->form_encode_input($brute_force) . "\">" . $brute_force_look . ""; ?>
<?php } else { ?>

<?php

$brute_force_look = "";
 if ($this->brute_force == "Y") { $brute_force_look .= "" ;} 
 if (empty($brute_force_look)) { $brute_force_look = $this->brute_force; }
?>
<span id="id_read_on_brute_force" class="css_brute_force_line" style="<?php echo $sStyleReadLab_brute_force; ?>"><?php echo $this->form_format_readonly("brute_force", $this->form_encode_input($brute_force_look)); ?></span><span id="id_read_off_brute_force" class="css_read_off_brute_force css_brute_force_line" style="<?php echo $sStyleReadInp_brute_force; ?>"><?php echo "<div id=\"idAjaxCheckbox_brute_force\" style=\"display: inline-block\" class=\"css_brute_force_line\">\r\n"; ?><TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_brute_force_line"><?php $tempOptionId = "id-opt-brute_force" . $sc_seq_vert . "-1"; ?>
 <div class="sc switch">
 <input type=checkbox id="<?php echo $tempOptionId ?>" class="sc-ui-checkbox-brute_force sc-ui-checkbox-brute_force" name="brute_force[]" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_brute_force'][] = 'Y'; ?>
<?php  if (in_array("Y", $this->brute_force_1))  { echo " checked" ;} ?> onClick="do_ajax_app_settings_event_brute_force_onclick();" ><span></span>
<label for="<?php echo $tempOptionId ?>"></label> </div>
</TD>
</TR></TABLE>
<?php echo "</div>\r\n"; ?></span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['brute_force_attempts']))
    {
        $this->nm_new_label['brute_force_attempts'] = "" . $this->Ini->Nm_lang['lang_sec_set_bf_attempts'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $brute_force_attempts = $this->brute_force_attempts;
   $sStyleHidden_brute_force_attempts = '';
   if (isset($this->nmgp_cmp_hidden['brute_force_attempts']) && $this->nmgp_cmp_hidden['brute_force_attempts'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['brute_force_attempts']);
       $sStyleHidden_brute_force_attempts = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_brute_force_attempts = 'display: none;';
   $sStyleReadInp_brute_force_attempts = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['brute_force_attempts']) && $this->nmgp_cmp_readonly['brute_force_attempts'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['brute_force_attempts']);
       $sStyleReadLab_brute_force_attempts = '';
       $sStyleReadInp_brute_force_attempts = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['brute_force_attempts']) && $this->nmgp_cmp_hidden['brute_force_attempts'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="brute_force_attempts" value="<?php echo $this->form_encode_input($brute_force_attempts) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_brute_force_attempts_label" id="hidden_field_label_brute_force_attempts" style="<?php echo $sStyleHidden_brute_force_attempts; ?>"><span id="id_label_brute_force_attempts"><?php echo $this->nm_new_label['brute_force_attempts']; ?></span></TD>
    <TD class="scFormDataOdd css_brute_force_attempts_line" id="hidden_field_data_brute_force_attempts" style="<?php echo $sStyleHidden_brute_force_attempts; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["brute_force_attempts"]) &&  $this->nmgp_cmp_readonly["brute_force_attempts"] == "on") { 

 ?>
<input type="hidden" name="brute_force_attempts" value="<?php echo $this->form_encode_input($brute_force_attempts) . "\">" . $brute_force_attempts . ""; ?>
<?php } else { ?>
<span id="id_read_on_brute_force_attempts" class="sc-ui-readonly-brute_force_attempts css_brute_force_attempts_line" style="<?php echo $sStyleReadLab_brute_force_attempts; ?>"><?php echo $this->form_format_readonly("brute_force_attempts", $this->form_encode_input($this->brute_force_attempts)); ?></span><span id="id_read_off_brute_force_attempts" class="css_read_off_brute_force_attempts<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_brute_force_attempts; ?>">
 <input class="sc-js-input scFormObjectOdd scFormObjectOddSpin scSpin_brute_force_attempts_obj css_brute_force_attempts_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_brute_force_attempts" type=text name="brute_force_attempts" value="<?php echo $this->form_encode_input($brute_force_attempts) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=3"; } ?> alt="{datatype: 'integer', maxLength: 20, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['brute_force_attempts']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['brute_force_attempts']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['brute_force_attempts']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['brute_force_time_block']))
    {
        $this->nm_new_label['brute_force_time_block'] = "" . $this->Ini->Nm_lang['lang_sec_set_bf_time_bl'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $brute_force_time_block = $this->brute_force_time_block;
   $sStyleHidden_brute_force_time_block = '';
   if (isset($this->nmgp_cmp_hidden['brute_force_time_block']) && $this->nmgp_cmp_hidden['brute_force_time_block'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['brute_force_time_block']);
       $sStyleHidden_brute_force_time_block = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_brute_force_time_block = 'display: none;';
   $sStyleReadInp_brute_force_time_block = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['brute_force_time_block']) && $this->nmgp_cmp_readonly['brute_force_time_block'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['brute_force_time_block']);
       $sStyleReadLab_brute_force_time_block = '';
       $sStyleReadInp_brute_force_time_block = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['brute_force_time_block']) && $this->nmgp_cmp_hidden['brute_force_time_block'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="brute_force_time_block" value="<?php echo $this->form_encode_input($brute_force_time_block) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_brute_force_time_block_label" id="hidden_field_label_brute_force_time_block" style="<?php echo $sStyleHidden_brute_force_time_block; ?>"><span id="id_label_brute_force_time_block"><?php echo $this->nm_new_label['brute_force_time_block']; ?></span></TD>
    <TD class="scFormDataOdd css_brute_force_time_block_line" id="hidden_field_data_brute_force_time_block" style="<?php echo $sStyleHidden_brute_force_time_block; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["brute_force_time_block"]) &&  $this->nmgp_cmp_readonly["brute_force_time_block"] == "on") { 

 ?>
<input type="hidden" name="brute_force_time_block" value="<?php echo $this->form_encode_input($brute_force_time_block) . "\">" . $brute_force_time_block . ""; ?>
<?php } else { ?>
<span id="id_read_on_brute_force_time_block" class="sc-ui-readonly-brute_force_time_block css_brute_force_time_block_line" style="<?php echo $sStyleReadLab_brute_force_time_block; ?>"><?php echo $this->form_format_readonly("brute_force_time_block", $this->form_encode_input($this->brute_force_time_block)); ?></span><span id="id_read_off_brute_force_time_block" class="css_read_off_brute_force_time_block<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_brute_force_time_block; ?>">
 <input class="sc-js-input scFormObjectOdd scFormObjectOddSpin scSpin_brute_force_time_block_obj css_brute_force_time_block_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_brute_force_time_block" type=text name="brute_force_time_block" value="<?php echo $this->form_encode_input($brute_force_time_block) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=3"; } ?> alt="{datatype: 'integer', maxLength: 20, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['brute_force_time_block']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['brute_force_time_block']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['brute_force_time_block']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
<span class="css_brute_force_time_block_label scFormHelpOdd">&nbsp;<?php echo $this->Ini->Nm_lang['lang_sec_minutes'] ?>
</span></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['retrieve_password']))
   {
       $this->nm_new_label['retrieve_password'] = "" . $this->Ini->Nm_lang['lang_sec_set_retrieve_password'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $retrieve_password = $this->retrieve_password;
   $sStyleHidden_retrieve_password = '';
   if (isset($this->nmgp_cmp_hidden['retrieve_password']) && $this->nmgp_cmp_hidden['retrieve_password'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['retrieve_password']);
       $sStyleHidden_retrieve_password = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_retrieve_password = 'display: none;';
   $sStyleReadInp_retrieve_password = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['retrieve_password']) && $this->nmgp_cmp_readonly['retrieve_password'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['retrieve_password']);
       $sStyleReadLab_retrieve_password = '';
       $sStyleReadInp_retrieve_password = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['retrieve_password']) && $this->nmgp_cmp_hidden['retrieve_password'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="retrieve_password" value="<?php echo $this->form_encode_input($this->retrieve_password) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php 
  if ($this->nmgp_opcao != "recarga") 
  {
      $this->retrieve_password_1 = explode(";", trim($this->retrieve_password));
  } 
  else
  {
      if (empty($this->retrieve_password))
      {
          $this->retrieve_password_1= array(); 
          $this->retrieve_password= "N";
      } 
      else
      {
          $this->retrieve_password_1= $this->retrieve_password; 
          $this->retrieve_password= ""; 
          foreach ($this->retrieve_password_1 as $cada_retrieve_password)
          {
             if (!empty($retrieve_password))
             {
                 $this->retrieve_password.= ";"; 
             } 
             $this->retrieve_password.= $cada_retrieve_password; 
          } 
      } 
  } 
?> 

    <TD class="scFormLabelOdd scUiLabelWidthFix css_retrieve_password_label" id="hidden_field_label_retrieve_password" style="<?php echo $sStyleHidden_retrieve_password; ?>"><span id="id_label_retrieve_password"><?php echo $this->nm_new_label['retrieve_password']; ?></span></TD>
    <TD class="scFormDataOdd css_retrieve_password_line" id="hidden_field_data_retrieve_password" style="<?php echo $sStyleHidden_retrieve_password; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["retrieve_password"]) &&  $this->nmgp_cmp_readonly["retrieve_password"] == "on") { 

$retrieve_password_look = "";
 if ($this->retrieve_password == "Y") { $retrieve_password_look .= "" ;} 
 if (empty($retrieve_password_look)) { $retrieve_password_look = $this->retrieve_password; }
?>
<input type="hidden" name="retrieve_password" value="<?php echo $this->form_encode_input($retrieve_password) . "\">" . $retrieve_password_look . ""; ?>
<?php } else { ?>

<?php

$retrieve_password_look = "";
 if ($this->retrieve_password == "Y") { $retrieve_password_look .= "" ;} 
 if (empty($retrieve_password_look)) { $retrieve_password_look = $this->retrieve_password; }
?>
<span id="id_read_on_retrieve_password" class="css_retrieve_password_line" style="<?php echo $sStyleReadLab_retrieve_password; ?>"><?php echo $this->form_format_readonly("retrieve_password", $this->form_encode_input($retrieve_password_look)); ?></span><span id="id_read_off_retrieve_password" class="css_read_off_retrieve_password css_retrieve_password_line" style="<?php echo $sStyleReadInp_retrieve_password; ?>"><?php echo "<div id=\"idAjaxCheckbox_retrieve_password\" style=\"display: inline-block\" class=\"css_retrieve_password_line\">\r\n"; ?><TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_retrieve_password_line"><?php $tempOptionId = "id-opt-retrieve_password" . $sc_seq_vert . "-1"; ?>
 <div class="sc switch">
 <input type=checkbox id="<?php echo $tempOptionId ?>" class="sc-ui-checkbox-retrieve_password sc-ui-checkbox-retrieve_password" name="retrieve_password[]" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_retrieve_password'][] = 'Y'; ?>
<?php  if (in_array("Y", $this->retrieve_password_1))  { echo " checked" ;} ?> onClick="do_ajax_app_settings_event_retrieve_password_onclick();" ><span></span>
<label for="<?php echo $tempOptionId ?>"></label> </div>
</TD>
</TR></TABLE>
<?php echo "</div>\r\n"; ?></span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['recover_pswd']))
   {
       $this->nm_new_label['recover_pswd'] = "" . $this->Ini->Nm_lang['lang_sec_set_recover_pswd'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $recover_pswd = $this->recover_pswd;
   $sStyleHidden_recover_pswd = '';
   if (isset($this->nmgp_cmp_hidden['recover_pswd']) && $this->nmgp_cmp_hidden['recover_pswd'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['recover_pswd']);
       $sStyleHidden_recover_pswd = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_recover_pswd = 'display: none;';
   $sStyleReadInp_recover_pswd = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['recover_pswd']) && $this->nmgp_cmp_readonly['recover_pswd'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['recover_pswd']);
       $sStyleReadLab_recover_pswd = '';
       $sStyleReadInp_recover_pswd = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['recover_pswd']) && $this->nmgp_cmp_hidden['recover_pswd'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="recover_pswd" value="<?php echo $this->form_encode_input($this->recover_pswd) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_recover_pswd_label" id="hidden_field_label_recover_pswd" style="<?php echo $sStyleHidden_recover_pswd; ?>"><span id="id_label_recover_pswd"><?php echo $this->nm_new_label['recover_pswd']; ?></span></TD>
    <TD class="scFormDataOdd css_recover_pswd_line" id="hidden_field_data_recover_pswd" style="<?php echo $sStyleHidden_recover_pswd; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["recover_pswd"]) &&  $this->nmgp_cmp_readonly["recover_pswd"] == "on") { 

$recover_pswd_look = "";
 if ($this->recover_pswd == "reset_send") { $recover_pswd_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_reset_send'] . "" ;} 
 if ($this->recover_pswd == "send_link") { $recover_pswd_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_send_link'] . "" ;} 
 if (empty($recover_pswd_look)) { $recover_pswd_look = $this->recover_pswd; }
?>
<input type="hidden" name="recover_pswd" value="<?php echo $this->form_encode_input($recover_pswd) . "\">" . $recover_pswd_look . ""; ?>
<?php } else { ?>
<?php

$recover_pswd_look = "";
 if ($this->recover_pswd == "reset_send") { $recover_pswd_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_reset_send'] . "" ;} 
 if ($this->recover_pswd == "send_link") { $recover_pswd_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_send_link'] . "" ;} 
 if (empty($recover_pswd_look)) { $recover_pswd_look = $this->recover_pswd; }
?>
<span id="id_read_on_recover_pswd" class="css_recover_pswd_line"  style="<?php echo $sStyleReadLab_recover_pswd; ?>"><?php echo $this->form_format_readonly("recover_pswd", $this->form_encode_input($recover_pswd_look)); ?></span><span id="id_read_off_recover_pswd" class="css_read_off_recover_pswd<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_recover_pswd; ?>">
 <span id="idAjaxSelect_recover_pswd" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_recover_pswd_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_recover_pswd" name="recover_pswd" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="reset_send" <?php  if ($this->recover_pswd == "reset_send") { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_sec_opt_reset_send']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_recover_pswd'][] = 'reset_send'; ?>
 <option  value="send_link" <?php  if ($this->recover_pswd == "send_link") { echo " selected" ;} ?><?php  if (empty($this->recover_pswd)) { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_sec_opt_send_link']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_recover_pswd'][] = 'send_link'; ?>
 </select></span>
</span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['password_min']))
    {
        $this->nm_new_label['password_min'] = "" . $this->Ini->Nm_lang['lang_sec_set_password_min'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $password_min = $this->password_min;
   $sStyleHidden_password_min = '';
   if (isset($this->nmgp_cmp_hidden['password_min']) && $this->nmgp_cmp_hidden['password_min'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['password_min']);
       $sStyleHidden_password_min = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_password_min = 'display: none;';
   $sStyleReadInp_password_min = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['password_min']) && $this->nmgp_cmp_readonly['password_min'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['password_min']);
       $sStyleReadLab_password_min = '';
       $sStyleReadInp_password_min = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['password_min']) && $this->nmgp_cmp_hidden['password_min'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="password_min" value="<?php echo $this->form_encode_input($password_min) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_password_min_label" id="hidden_field_label_password_min" style="<?php echo $sStyleHidden_password_min; ?>"><span id="id_label_password_min"><?php echo $this->nm_new_label['password_min']; ?></span></TD>
    <TD class="scFormDataOdd css_password_min_line" id="hidden_field_data_password_min" style="<?php echo $sStyleHidden_password_min; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["password_min"]) &&  $this->nmgp_cmp_readonly["password_min"] == "on") { 

 ?>
<input type="hidden" name="password_min" value="<?php echo $this->form_encode_input($password_min) . "\">" . $password_min . ""; ?>
<?php } else { ?>
<span id="id_read_on_password_min" class="sc-ui-readonly-password_min css_password_min_line" style="<?php echo $sStyleReadLab_password_min; ?>"><?php echo $this->form_format_readonly("password_min", $this->form_encode_input($this->password_min)); ?></span><span id="id_read_off_password_min" class="css_read_off_password_min<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_password_min; ?>">
 <input class="sc-js-input scFormObjectOdd css_password_min_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_password_min" type=text name="password_min" value="<?php echo $this->form_encode_input($password_min) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'integer', maxLength: 20, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['password_min']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['password_min']['symbol_fmt']; ?>, allowNegative: true, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['password_min']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['password_strength']))
   {
       $this->nm_new_label['password_strength'] = "" . $this->Ini->Nm_lang['lang_sec_set_password_strength'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $password_strength = $this->password_strength;
   $sStyleHidden_password_strength = '';
   if (isset($this->nmgp_cmp_hidden['password_strength']) && $this->nmgp_cmp_hidden['password_strength'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['password_strength']);
       $sStyleHidden_password_strength = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_password_strength = 'display: none;';
   $sStyleReadInp_password_strength = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['password_strength']) && $this->nmgp_cmp_readonly['password_strength'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['password_strength']);
       $sStyleReadLab_password_strength = '';
       $sStyleReadInp_password_strength = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['password_strength']) && $this->nmgp_cmp_hidden['password_strength'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="password_strength" value="<?php echo $this->form_encode_input($this->password_strength) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php 
  if ($this->nmgp_opcao != "recarga") 
  {
      $this->password_strength_1 = explode(";", trim($this->password_strength));
  } 
  else
  {
      if (empty($this->password_strength))
      {
          $this->password_strength_1= array(); 
      } 
      else
      {
          $this->password_strength_1= $this->password_strength; 
          $this->password_strength= ""; 
          foreach ($this->password_strength_1 as $cada_password_strength)
          {
             if (!empty($password_strength))
             {
                 $this->password_strength.= ";"; 
             } 
             $this->password_strength.= $cada_password_strength; 
          } 
      } 
  } 
?> 

    <TD class="scFormLabelOdd scUiLabelWidthFix css_password_strength_label" id="hidden_field_label_password_strength" style="<?php echo $sStyleHidden_password_strength; ?>"><span id="id_label_password_strength"><?php echo $this->nm_new_label['password_strength']; ?></span></TD>
    <TD class="scFormDataOdd css_password_strength_line" id="hidden_field_data_password_strength" style="<?php echo $sStyleHidden_password_strength; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["password_strength"]) &&  $this->nmgp_cmp_readonly["password_strength"] == "on") { 

$password_strength_look = "";
 if (in_array("uppercase_letter", $this->password_strength_1))  { $password_strength_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_ps_uppercase_letter'] . "<br />";} 
 if (in_array("lowercase_letter", $this->password_strength_1))  { $password_strength_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_ps_lowercase_letter'] . "<br />";} 
 if (in_array("numbers", $this->password_strength_1))  { $password_strength_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_ps_numbers'] . "<br />";} 
 if (in_array("special_chars", $this->password_strength_1))  { $password_strength_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_ps_special_chars'] . "<br />";} 
?>
<input type="hidden" name="password_strength" value="<?php echo $this->form_encode_input($password_strength) . "\">" . $password_strength_look . ""; ?>
<?php } else { ?>

<?php

$password_strength_look = "";
 if (in_array("uppercase_letter", $this->password_strength_1))  { $password_strength_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_ps_uppercase_letter'] . "<br />";} 
 if (in_array("lowercase_letter", $this->password_strength_1))  { $password_strength_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_ps_lowercase_letter'] . "<br />";} 
 if (in_array("numbers", $this->password_strength_1))  { $password_strength_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_ps_numbers'] . "<br />";} 
 if (in_array("special_chars", $this->password_strength_1))  { $password_strength_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_ps_special_chars'] . "<br />";} 
?>
<span id="id_read_on_password_strength" class="css_password_strength_line" style="<?php echo $sStyleReadLab_password_strength; ?>"><?php echo $this->form_format_readonly("password_strength", $this->form_encode_input($password_strength_look)); ?></span><span id="id_read_off_password_strength" class="css_read_off_password_strength css_password_strength_line" style="<?php echo $sStyleReadInp_password_strength; ?>"><?php echo "<div id=\"idAjaxCheckbox_password_strength\" style=\"display: inline-block\" class=\"css_password_strength_line\">\r\n"; ?><TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_password_strength_line"><?php $tempOptionId = "id-opt-password_strength" . $sc_seq_vert . "-1"; ?>
 <input type=checkbox id="<?php echo $tempOptionId ?>" class="sc-ui-checkbox-password_strength sc-ui-checkbox-password_strength" name="password_strength[]" value="uppercase_letter"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_password_strength'][] = 'uppercase_letter'; ?>
<?php  if (in_array("uppercase_letter", $this->password_strength_1))  { echo " checked" ;} ?> onClick="" ><label for="<?php echo $tempOptionId ?>"><?php echo $this->Ini->Nm_lang['lang_sec_opt_ps_uppercase_letter']; ?></label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_password_strength_line"><?php $tempOptionId = "id-opt-password_strength" . $sc_seq_vert . "-2"; ?>
 <input type=checkbox id="<?php echo $tempOptionId ?>" class="sc-ui-checkbox-password_strength sc-ui-checkbox-password_strength" name="password_strength[]" value="lowercase_letter"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_password_strength'][] = 'lowercase_letter'; ?>
<?php  if (in_array("lowercase_letter", $this->password_strength_1))  { echo " checked" ;} ?> onClick="" ><label for="<?php echo $tempOptionId ?>"><?php echo $this->Ini->Nm_lang['lang_sec_opt_ps_lowercase_letter']; ?></label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_password_strength_line"><?php $tempOptionId = "id-opt-password_strength" . $sc_seq_vert . "-3"; ?>
 <input type=checkbox id="<?php echo $tempOptionId ?>" class="sc-ui-checkbox-password_strength sc-ui-checkbox-password_strength" name="password_strength[]" value="numbers"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_password_strength'][] = 'numbers'; ?>
<?php  if (in_array("numbers", $this->password_strength_1))  { echo " checked" ;} ?> onClick="" ><label for="<?php echo $tempOptionId ?>"><?php echo $this->Ini->Nm_lang['lang_sec_opt_ps_numbers']; ?></label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_password_strength_line"><?php $tempOptionId = "id-opt-password_strength" . $sc_seq_vert . "-4"; ?>
 <input type=checkbox id="<?php echo $tempOptionId ?>" class="sc-ui-checkbox-password_strength sc-ui-checkbox-password_strength" name="password_strength[]" value="special_chars"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_password_strength'][] = 'special_chars'; ?>
<?php  if (in_array("special_chars", $this->password_strength_1))  { echo " checked" ;} ?> onClick="" ><label for="<?php echo $tempOptionId ?>"><?php echo $this->Ini->Nm_lang['lang_sec_opt_ps_special_chars']; ?></label></TD>
</TR></TABLE>
<?php echo "</div>\r\n"; ?></span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['group_administrator']))
   {
       $this->nm_new_label['group_administrator'] = "" . $this->Ini->Nm_lang['lang_sec_set_group_administrator'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $group_administrator = $this->group_administrator;
   $sStyleHidden_group_administrator = '';
   if (isset($this->nmgp_cmp_hidden['group_administrator']) && $this->nmgp_cmp_hidden['group_administrator'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['group_administrator']);
       $sStyleHidden_group_administrator = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_group_administrator = 'display: none;';
   $sStyleReadInp_group_administrator = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['group_administrator']) && $this->nmgp_cmp_readonly['group_administrator'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['group_administrator']);
       $sStyleReadLab_group_administrator = '';
       $sStyleReadInp_group_administrator = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['group_administrator']) && $this->nmgp_cmp_hidden['group_administrator'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="group_administrator" value="<?php echo $this->form_encode_input($this->group_administrator) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_group_administrator_label" id="hidden_field_label_group_administrator" style="<?php echo $sStyleHidden_group_administrator; ?>"><span id="id_label_group_administrator"><?php echo $this->nm_new_label['group_administrator']; ?></span></TD>
    <TD class="scFormDataOdd css_group_administrator_line" id="hidden_field_data_group_administrator" style="<?php echo $sStyleHidden_group_administrator; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["group_administrator"]) &&  $this->nmgp_cmp_readonly["group_administrator"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_administrator']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_administrator'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_administrator']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_administrator'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_administrator']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_administrator'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_administrator']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_administrator'] = array(); 
    }

   $old_value_cookie_expiration_time = $this->cookie_expiration_time;
   $old_value_pswd_last_updated = $this->pswd_last_updated;
   $old_value_brute_force_attempts = $this->brute_force_attempts;
   $old_value_brute_force_time_block = $this->brute_force_time_block;
   $old_value_password_min = $this->password_min;
   $old_value_enable_2fa_expiration_time = $this->enable_2fa_expiration_time;
   $old_value_mfa_last_updated = $this->mfa_last_updated;
   $old_value_smtp_port = $this->smtp_port;
   $this->nm_tira_formatacao();


   $unformatted_value_cookie_expiration_time = $this->cookie_expiration_time;
   $unformatted_value_pswd_last_updated = $this->pswd_last_updated;
   $unformatted_value_brute_force_attempts = $this->brute_force_attempts;
   $unformatted_value_brute_force_time_block = $this->brute_force_time_block;
   $unformatted_value_password_min = $this->password_min;
   $unformatted_value_enable_2fa_expiration_time = $this->enable_2fa_expiration_time;
   $unformatted_value_mfa_last_updated = $this->mfa_last_updated;
   $unformatted_value_smtp_port = $this->smtp_port;

   $remember_me_val_str = "''";
   if (!empty($this->remember_me))
   {
       if (is_array($this->remember_me))
       {
           $Tmp_array = $this->remember_me;
       }
       else
       {
           $Tmp_array = explode(";", $this->remember_me);
       }
       $remember_me_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $remember_me_val_str)
          {
             $remember_me_val_str .= ", ";
          }
          $remember_me_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $retrieve_password_val_str = "''";
   if (!empty($this->retrieve_password))
   {
       if (is_array($this->retrieve_password))
       {
           $Tmp_array = $this->retrieve_password;
       }
       else
       {
           $Tmp_array = explode(";", $this->retrieve_password);
       }
       $retrieve_password_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $retrieve_password_val_str)
          {
             $retrieve_password_val_str .= ", ";
          }
          $retrieve_password_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $new_users_val_str = "''";
   if (!empty($this->new_users))
   {
       if (is_array($this->new_users))
       {
           $Tmp_array = $this->new_users;
       }
       else
       {
           $Tmp_array = explode(";", $this->new_users);
       }
       $new_users_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $new_users_val_str)
          {
             $new_users_val_str .= ", ";
          }
          $new_users_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $enable_2fa_val_str = "''";
   if (!empty($this->enable_2fa))
   {
       if (is_array($this->enable_2fa))
       {
           $Tmp_array = $this->enable_2fa;
       }
       else
       {
           $Tmp_array = explode(";", $this->enable_2fa);
       }
       $enable_2fa_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $enable_2fa_val_str)
          {
             $enable_2fa_val_str .= ", ";
          }
          $enable_2fa_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $brute_force_val_str = "''";
   if (!empty($this->brute_force))
   {
       if (is_array($this->brute_force))
       {
           $Tmp_array = $this->brute_force;
       }
       else
       {
           $Tmp_array = explode(";", $this->brute_force);
       }
       $brute_force_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $brute_force_val_str)
          {
             $brute_force_val_str .= ", ";
          }
          $brute_force_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $captcha_val_str = "''";
   if (!empty($this->captcha))
   {
       if (is_array($this->captcha))
       {
           $Tmp_array = $this->captcha;
       }
       else
       {
           $Tmp_array = explode(";", $this->captcha);
       }
       $captcha_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $captcha_val_str)
          {
             $captcha_val_str .= ", ";
          }
          $captcha_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $language_val_str = "''";
   if (!empty($this->language))
   {
       if (is_array($this->language))
       {
           $Tmp_array = $this->language;
       }
       else
       {
           $Tmp_array = explode(";", $this->language);
       }
       $language_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $language_val_str)
          {
             $language_val_str .= ", ";
          }
          $language_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $req_email_act_val_str = "''";
   if (!empty($this->req_email_act))
   {
       if (is_array($this->req_email_act))
       {
           $Tmp_array = $this->req_email_act;
       }
       else
       {
           $Tmp_array = explode(";", $this->req_email_act);
       }
       $req_email_act_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $req_email_act_val_str)
          {
             $req_email_act_val_str .= ", ";
          }
          $req_email_act_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $send_email_adm_val_str = "''";
   if (!empty($this->send_email_adm))
   {
       if (is_array($this->send_email_adm))
       {
           $Tmp_array = $this->send_email_adm;
       }
       else
       {
           $Tmp_array = explode(";", $this->send_email_adm);
       }
       $send_email_adm_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $send_email_adm_val_str)
          {
             $send_email_adm_val_str .= ", ";
          }
          $send_email_adm_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $password_strength_val_str = "''";
   if (!empty($this->password_strength))
   {
       if (is_array($this->password_strength))
       {
           $Tmp_array = $this->password_strength;
       }
       else
       {
           $Tmp_array = explode(";", $this->password_strength);
       }
       $password_strength_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $password_strength_val_str)
          {
             $password_strength_val_str .= ", ";
          }
          $password_strength_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $auth_sn_fb_val_str = "''";
   if (!empty($this->auth_sn_fb))
   {
       if (is_array($this->auth_sn_fb))
       {
           $Tmp_array = $this->auth_sn_fb;
       }
       else
       {
           $Tmp_array = explode(";", $this->auth_sn_fb);
       }
       $auth_sn_fb_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $auth_sn_fb_val_str)
          {
             $auth_sn_fb_val_str .= ", ";
          }
          $auth_sn_fb_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $auth_sn_x_val_str = "''";
   if (!empty($this->auth_sn_x))
   {
       if (is_array($this->auth_sn_x))
       {
           $Tmp_array = $this->auth_sn_x;
       }
       else
       {
           $Tmp_array = explode(";", $this->auth_sn_x);
       }
       $auth_sn_x_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $auth_sn_x_val_str)
          {
             $auth_sn_x_val_str .= ", ";
          }
          $auth_sn_x_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $auth_sn_google_val_str = "''";
   if (!empty($this->auth_sn_google))
   {
       if (is_array($this->auth_sn_google))
       {
           $Tmp_array = $this->auth_sn_google;
       }
       else
       {
           $Tmp_array = explode(";", $this->auth_sn_google);
       }
       $auth_sn_google_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $auth_sn_google_val_str)
          {
             $auth_sn_google_val_str .= ", ";
          }
          $auth_sn_google_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $nm_comando = "SELECT group_id, description  FROM sec_groups  ORDER BY description";

   $this->cookie_expiration_time = $old_value_cookie_expiration_time;
   $this->pswd_last_updated = $old_value_pswd_last_updated;
   $this->brute_force_attempts = $old_value_brute_force_attempts;
   $this->brute_force_time_block = $old_value_brute_force_time_block;
   $this->password_min = $old_value_password_min;
   $this->enable_2fa_expiration_time = $old_value_enable_2fa_expiration_time;
   $this->mfa_last_updated = $old_value_mfa_last_updated;
   $this->smtp_port = $old_value_smtp_port;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_administrator'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $group_administrator_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->group_administrator_1))
          {
              foreach ($this->group_administrator_1 as $tmp_group_administrator)
              {
                  if (trim($tmp_group_administrator) === trim($cadaselect[1])) {$group_administrator_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->group_administrator) && trim($this->group_administrator) === trim($cadaselect[1])) {$group_administrator_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="group_administrator" value="<?php echo $this->form_encode_input($group_administrator) . "\">" . $group_administrator_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_group_administrator();
   $x = 0 ; 
   $group_administrator_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->group_administrator_1))
          {
              foreach ($this->group_administrator_1 as $tmp_group_administrator)
              {
                  if (trim($tmp_group_administrator) === trim($cadaselect[1])) {$group_administrator_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->group_administrator)) {
                 if (trim($this->group_administrator) == trim($cadaselect[1])) { $group_administrator_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->group_administrator == $cadaselect[1]) { $group_administrator_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($group_administrator_look))
          {
              $group_administrator_look = $this->group_administrator;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_group_administrator\" class=\"css_group_administrator_line\" style=\"" .  $sStyleReadLab_group_administrator . "\">" . $this->form_format_readonly("group_administrator", $this->form_encode_input($group_administrator_look)) . "</span><span id=\"id_read_off_group_administrator\" class=\"css_read_off_group_administrator" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_group_administrator . "\">";
   echo " <span id=\"idAjaxSelect_group_administrator\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_group_administrator_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_group_administrator\" name=\"group_administrator\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->group_administrator) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->group_administrator)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_2"></a>
<div id="div_hidden_bloco_2" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_2" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['enable_2fa']))
   {
       $this->nm_new_label['enable_2fa'] = "" . $this->Ini->Nm_lang['lang_sec_set_2fa'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $enable_2fa = $this->enable_2fa;
   $sStyleHidden_enable_2fa = '';
   if (isset($this->nmgp_cmp_hidden['enable_2fa']) && $this->nmgp_cmp_hidden['enable_2fa'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['enable_2fa']);
       $sStyleHidden_enable_2fa = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_enable_2fa = 'display: none;';
   $sStyleReadInp_enable_2fa = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['enable_2fa']) && $this->nmgp_cmp_readonly['enable_2fa'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['enable_2fa']);
       $sStyleReadLab_enable_2fa = '';
       $sStyleReadInp_enable_2fa = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['enable_2fa']) && $this->nmgp_cmp_hidden['enable_2fa'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="enable_2fa" value="<?php echo $this->form_encode_input($this->enable_2fa) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php 
  if ($this->nmgp_opcao != "recarga") 
  {
      $this->enable_2fa_1 = explode(";", trim($this->enable_2fa));
  } 
  else
  {
      if (empty($this->enable_2fa))
      {
          $this->enable_2fa_1= array(); 
          $this->enable_2fa= "N";
      } 
      else
      {
          $this->enable_2fa_1= $this->enable_2fa; 
          $this->enable_2fa= ""; 
          foreach ($this->enable_2fa_1 as $cada_enable_2fa)
          {
             if (!empty($enable_2fa))
             {
                 $this->enable_2fa.= ";"; 
             } 
             $this->enable_2fa.= $cada_enable_2fa; 
          } 
      } 
  } 
?> 

    <TD class="scFormLabelOdd scUiLabelWidthFix css_enable_2fa_label" id="hidden_field_label_enable_2fa" style="<?php echo $sStyleHidden_enable_2fa; ?>"><span id="id_label_enable_2fa"><?php echo $this->nm_new_label['enable_2fa']; ?></span></TD>
    <TD class="scFormDataOdd css_enable_2fa_line" id="hidden_field_data_enable_2fa" style="<?php echo $sStyleHidden_enable_2fa; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["enable_2fa"]) &&  $this->nmgp_cmp_readonly["enable_2fa"] == "on") { 

$enable_2fa_look = "";
 if ($this->enable_2fa == "Y") { $enable_2fa_look .= "" ;} 
 if (empty($enable_2fa_look)) { $enable_2fa_look = $this->enable_2fa; }
?>
<input type="hidden" name="enable_2fa" value="<?php echo $this->form_encode_input($enable_2fa) . "\">" . $enable_2fa_look . ""; ?>
<?php } else { ?>

<?php

$enable_2fa_look = "";
 if ($this->enable_2fa == "Y") { $enable_2fa_look .= "" ;} 
 if (empty($enable_2fa_look)) { $enable_2fa_look = $this->enable_2fa; }
?>
<span id="id_read_on_enable_2fa" class="css_enable_2fa_line" style="<?php echo $sStyleReadLab_enable_2fa; ?>"><?php echo $this->form_format_readonly("enable_2fa", $this->form_encode_input($enable_2fa_look)); ?></span><span id="id_read_off_enable_2fa" class="css_read_off_enable_2fa css_enable_2fa_line" style="<?php echo $sStyleReadInp_enable_2fa; ?>"><?php echo "<div id=\"idAjaxCheckbox_enable_2fa\" style=\"display: inline-block\" class=\"css_enable_2fa_line\">\r\n"; ?><TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_enable_2fa_line"><?php $tempOptionId = "id-opt-enable_2fa" . $sc_seq_vert . "-1"; ?>
 <div class="sc switch">
 <input type=checkbox id="<?php echo $tempOptionId ?>" class="sc-ui-checkbox-enable_2fa sc-ui-checkbox-enable_2fa" name="enable_2fa[]" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_enable_2fa'][] = 'Y'; ?>
<?php  if (in_array("Y", $this->enable_2fa_1))  { echo " checked" ;} ?> onClick="do_ajax_app_settings_event_enable_2fa_onclick();" ><span></span>
<label for="<?php echo $tempOptionId ?>"></label> </div>
</TD>
</TR></TABLE>
<?php echo "</div>\r\n"; ?></span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['enable_2fa_expiration_time']))
    {
        $this->nm_new_label['enable_2fa_expiration_time'] = "" . $this->Ini->Nm_lang['lang_sec_set_2fa_exp_time'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $enable_2fa_expiration_time = $this->enable_2fa_expiration_time;
   $sStyleHidden_enable_2fa_expiration_time = '';
   if (isset($this->nmgp_cmp_hidden['enable_2fa_expiration_time']) && $this->nmgp_cmp_hidden['enable_2fa_expiration_time'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['enable_2fa_expiration_time']);
       $sStyleHidden_enable_2fa_expiration_time = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_enable_2fa_expiration_time = 'display: none;';
   $sStyleReadInp_enable_2fa_expiration_time = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['enable_2fa_expiration_time']) && $this->nmgp_cmp_readonly['enable_2fa_expiration_time'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['enable_2fa_expiration_time']);
       $sStyleReadLab_enable_2fa_expiration_time = '';
       $sStyleReadInp_enable_2fa_expiration_time = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['enable_2fa_expiration_time']) && $this->nmgp_cmp_hidden['enable_2fa_expiration_time'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="enable_2fa_expiration_time" value="<?php echo $this->form_encode_input($enable_2fa_expiration_time) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_enable_2fa_expiration_time_label" id="hidden_field_label_enable_2fa_expiration_time" style="<?php echo $sStyleHidden_enable_2fa_expiration_time; ?>"><span id="id_label_enable_2fa_expiration_time"><?php echo $this->nm_new_label['enable_2fa_expiration_time']; ?></span></TD>
    <TD class="scFormDataOdd css_enable_2fa_expiration_time_line" id="hidden_field_data_enable_2fa_expiration_time" style="<?php echo $sStyleHidden_enable_2fa_expiration_time; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["enable_2fa_expiration_time"]) &&  $this->nmgp_cmp_readonly["enable_2fa_expiration_time"] == "on") { 

 ?>
<input type="hidden" name="enable_2fa_expiration_time" value="<?php echo $this->form_encode_input($enable_2fa_expiration_time) . "\">" . $enable_2fa_expiration_time . ""; ?>
<?php } else { ?>
<span id="id_read_on_enable_2fa_expiration_time" class="sc-ui-readonly-enable_2fa_expiration_time css_enable_2fa_expiration_time_line" style="<?php echo $sStyleReadLab_enable_2fa_expiration_time; ?>"><?php echo $this->form_format_readonly("enable_2fa_expiration_time", $this->form_encode_input($this->enable_2fa_expiration_time)); ?></span><span id="id_read_off_enable_2fa_expiration_time" class="css_read_off_enable_2fa_expiration_time<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_enable_2fa_expiration_time; ?>">
 <input class="sc-js-input scFormObjectOdd scFormObjectOddSpin scSpin_enable_2fa_expiration_time_obj css_enable_2fa_expiration_time_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_enable_2fa_expiration_time" type=text name="enable_2fa_expiration_time" value="<?php echo $this->form_encode_input($enable_2fa_expiration_time) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=3"; } ?> alt="{datatype: 'integer', maxLength: 20, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['enable_2fa_expiration_time']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['enable_2fa_expiration_time']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['enable_2fa_expiration_time']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
<span class="css_enable_2fa_expiration_time_label scFormHelpOdd">&nbsp;<?php echo $this->Ini->Nm_lang['lang_sec_seconds'] ?>
</span></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['enable_2fa_mode']))
   {
       $this->nm_new_label['enable_2fa_mode'] = "" . $this->Ini->Nm_lang['lang_sec_set_enable_2fa_mode'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $enable_2fa_mode = $this->enable_2fa_mode;
   $sStyleHidden_enable_2fa_mode = '';
   if (isset($this->nmgp_cmp_hidden['enable_2fa_mode']) && $this->nmgp_cmp_hidden['enable_2fa_mode'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['enable_2fa_mode']);
       $sStyleHidden_enable_2fa_mode = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_enable_2fa_mode = 'display: none;';
   $sStyleReadInp_enable_2fa_mode = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['enable_2fa_mode']) && $this->nmgp_cmp_readonly['enable_2fa_mode'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['enable_2fa_mode']);
       $sStyleReadLab_enable_2fa_mode = '';
       $sStyleReadInp_enable_2fa_mode = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['enable_2fa_mode']) && $this->nmgp_cmp_hidden['enable_2fa_mode'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="enable_2fa_mode" value="<?php echo $this->form_encode_input($this->enable_2fa_mode) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_enable_2fa_mode_label" id="hidden_field_label_enable_2fa_mode" style="<?php echo $sStyleHidden_enable_2fa_mode; ?>"><span id="id_label_enable_2fa_mode"><?php echo $this->nm_new_label['enable_2fa_mode']; ?></span></TD>
    <TD class="scFormDataOdd css_enable_2fa_mode_line" id="hidden_field_data_enable_2fa_mode" style="<?php echo $sStyleHidden_enable_2fa_mode; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["enable_2fa_mode"]) &&  $this->nmgp_cmp_readonly["enable_2fa_mode"] == "on") { 

$enable_2fa_mode_look = "";
 if ($this->enable_2fa_mode == "individual") { $enable_2fa_mode_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_2fa_individual'] . "" ;} 
 if ($this->enable_2fa_mode == "all") { $enable_2fa_mode_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_2fa_all'] . "" ;} 
 if (empty($enable_2fa_mode_look)) { $enable_2fa_mode_look = $this->enable_2fa_mode; }
?>
<input type="hidden" name="enable_2fa_mode" value="<?php echo $this->form_encode_input($enable_2fa_mode) . "\">" . $enable_2fa_mode_look . ""; ?>
<?php } else { ?>
<?php

$enable_2fa_mode_look = "";
 if ($this->enable_2fa_mode == "individual") { $enable_2fa_mode_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_2fa_individual'] . "" ;} 
 if ($this->enable_2fa_mode == "all") { $enable_2fa_mode_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_2fa_all'] . "" ;} 
 if (empty($enable_2fa_mode_look)) { $enable_2fa_mode_look = $this->enable_2fa_mode; }
?>
<span id="id_read_on_enable_2fa_mode" class="css_enable_2fa_mode_line"  style="<?php echo $sStyleReadLab_enable_2fa_mode; ?>"><?php echo $this->form_format_readonly("enable_2fa_mode", $this->form_encode_input($enable_2fa_mode_look)); ?></span><span id="id_read_off_enable_2fa_mode" class="css_read_off_enable_2fa_mode<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_enable_2fa_mode; ?>">
 <span id="idAjaxSelect_enable_2fa_mode" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_enable_2fa_mode_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_enable_2fa_mode" name="enable_2fa_mode" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="individual" <?php  if ($this->enable_2fa_mode == "individual") { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_sec_opt_2fa_individual']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_enable_2fa_mode'][] = 'individual'; ?>
 <option  value="all" <?php  if ($this->enable_2fa_mode == "all") { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_sec_opt_2fa_all']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_enable_2fa_mode'][] = 'all'; ?>
 </select></span>
</span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['enable_2fa_api_type']))
    {
        $this->nm_new_label['enable_2fa_api_type'] = "" . $this->Ini->Nm_lang['lang_sec_set_enable_2fa_api_type'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $enable_2fa_api_type = $this->enable_2fa_api_type;
   $sStyleHidden_enable_2fa_api_type = '';
   if (isset($this->nmgp_cmp_hidden['enable_2fa_api_type']) && $this->nmgp_cmp_hidden['enable_2fa_api_type'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['enable_2fa_api_type']);
       $sStyleHidden_enable_2fa_api_type = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_enable_2fa_api_type = 'display: none;';
   $sStyleReadInp_enable_2fa_api_type = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['enable_2fa_api_type']) && $this->nmgp_cmp_readonly['enable_2fa_api_type'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['enable_2fa_api_type']);
       $sStyleReadLab_enable_2fa_api_type = '';
       $sStyleReadInp_enable_2fa_api_type = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['enable_2fa_api_type']) && $this->nmgp_cmp_hidden['enable_2fa_api_type'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="enable_2fa_api_type" value="<?php echo $this->form_encode_input($enable_2fa_api_type) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_enable_2fa_api_type_label" id="hidden_field_label_enable_2fa_api_type" style="<?php echo $sStyleHidden_enable_2fa_api_type; ?>"><span id="id_label_enable_2fa_api_type"><?php echo $this->nm_new_label['enable_2fa_api_type']; ?></span></TD>
    <TD class="scFormDataOdd css_enable_2fa_api_type_line" id="hidden_field_data_enable_2fa_api_type" style="<?php echo $sStyleHidden_enable_2fa_api_type; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["enable_2fa_api_type"]) &&  $this->nmgp_cmp_readonly["enable_2fa_api_type"] == "on") { 

 if ("email" == $this->enable_2fa_api_type) { $enable_2fa_api_type_look = "E-mail";} 
 if ("auth" == $this->enable_2fa_api_type) { $enable_2fa_api_type_look = "Google Auth";} 
 if ("sms" == $this->enable_2fa_api_type) { $enable_2fa_api_type_look = "SMS";} 
?>
<input type="hidden" name="enable_2fa_api_type" value="<?php echo $this->form_encode_input($enable_2fa_api_type) . "\">" . $enable_2fa_api_type_look . ""; ?>
<?php } else { ?>

<?php

 if ("email" == $this->enable_2fa_api_type) { $enable_2fa_api_type_look = "E-mail";} 
 if ("auth" == $this->enable_2fa_api_type) { $enable_2fa_api_type_look = "Google Auth";} 
 if ("sms" == $this->enable_2fa_api_type) { $enable_2fa_api_type_look = "SMS";} 
?>
<span id="id_read_on_enable_2fa_api_type"  class="css_enable_2fa_api_type_line" style="<?php echo $sStyleReadLab_enable_2fa_api_type; ?>"><?php echo $this->form_format_readonly("enable_2fa_api_type", $this->form_encode_input($enable_2fa_api_type_look)); ?></span><span id="id_read_off_enable_2fa_api_type" class="css_read_off_enable_2fa_api_type css_enable_2fa_api_type_line" style="<?php echo $sStyleReadInp_enable_2fa_api_type; ?>"><div id="idAjaxRadio_enable_2fa_api_type" style="display: inline-block"  class="css_enable_2fa_api_type_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_enable_2fa_api_type_line"><?php $tempOptionId = "id-opt-enable_2fa_api_type" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-enable_2fa_api_type sc-ui-radio-enable_2fa_api_type" type=radio name="enable_2fa_api_type" value="email"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_enable_2fa_api_type'][] = 'email'; ?>
<?php  if ("email" == $this->enable_2fa_api_type)  { echo " checked" ;} ?><?php  if (empty($this->enable_2fa_api_type)) { echo " checked" ;} ?>  onClick="do_ajax_app_settings_event_enable_2fa_api_type_onclick();" ><label for="<?php echo $tempOptionId ?>">E-mail</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_enable_2fa_api_type_line"><?php $tempOptionId = "id-opt-enable_2fa_api_type" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-enable_2fa_api_type sc-ui-radio-enable_2fa_api_type" type=radio name="enable_2fa_api_type" value="auth"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_enable_2fa_api_type'][] = 'auth'; ?>
<?php  if ("auth" == $this->enable_2fa_api_type)  { echo " checked" ;} ?>  onClick="do_ajax_app_settings_event_enable_2fa_api_type_onclick();" ><label for="<?php echo $tempOptionId ?>">Google Auth</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_enable_2fa_api_type_line"><?php $tempOptionId = "id-opt-enable_2fa_api_type" . $sc_seq_vert . "-3"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-enable_2fa_api_type sc-ui-radio-enable_2fa_api_type" type=radio name="enable_2fa_api_type" value="sms"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_enable_2fa_api_type'][] = 'sms'; ?>
<?php  if ("sms" == $this->enable_2fa_api_type)  { echo " checked" ;} ?>  onClick="do_ajax_app_settings_event_enable_2fa_api_type_onclick();" ><label for="<?php echo $tempOptionId ?>">SMS</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['enable_2fa_api']))
    {
        $this->nm_new_label['enable_2fa_api'] = "" . $this->Ini->Nm_lang['lang_sec_set_enable_2fa_api'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $enable_2fa_api = $this->enable_2fa_api;
   $sStyleHidden_enable_2fa_api = '';
   if (isset($this->nmgp_cmp_hidden['enable_2fa_api']) && $this->nmgp_cmp_hidden['enable_2fa_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['enable_2fa_api']);
       $sStyleHidden_enable_2fa_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_enable_2fa_api = 'display: none;';
   $sStyleReadInp_enable_2fa_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['enable_2fa_api']) && $this->nmgp_cmp_readonly['enable_2fa_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['enable_2fa_api']);
       $sStyleReadLab_enable_2fa_api = '';
       $sStyleReadInp_enable_2fa_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['enable_2fa_api']) && $this->nmgp_cmp_hidden['enable_2fa_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="enable_2fa_api" value="<?php echo $this->form_encode_input($enable_2fa_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_enable_2fa_api_label" id="hidden_field_label_enable_2fa_api" style="<?php echo $sStyleHidden_enable_2fa_api; ?>"><span id="id_label_enable_2fa_api"><?php echo $this->nm_new_label['enable_2fa_api']; ?></span></TD>
    <TD class="scFormDataOdd css_enable_2fa_api_line" id="hidden_field_data_enable_2fa_api" style="<?php echo $sStyleHidden_enable_2fa_api; ?>"><input type="hidden" name="enable_2fa_api" value="<?php echo $this->form_encode_input($enable_2fa_api); ?>"><span id="id_ajax_label_enable_2fa_api"><?php echo nl2br($enable_2fa_api); ?></span>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['mfa_last_updated']))
    {
        $this->nm_new_label['mfa_last_updated'] = "" . $this->Ini->Nm_lang['lang_sec_set_mfa_last_updated'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $mfa_last_updated = $this->mfa_last_updated;
   $sStyleHidden_mfa_last_updated = '';
   if (isset($this->nmgp_cmp_hidden['mfa_last_updated']) && $this->nmgp_cmp_hidden['mfa_last_updated'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['mfa_last_updated']);
       $sStyleHidden_mfa_last_updated = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_mfa_last_updated = 'display: none;';
   $sStyleReadInp_mfa_last_updated = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['mfa_last_updated']) && $this->nmgp_cmp_readonly['mfa_last_updated'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['mfa_last_updated']);
       $sStyleReadLab_mfa_last_updated = '';
       $sStyleReadInp_mfa_last_updated = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['mfa_last_updated']) && $this->nmgp_cmp_hidden['mfa_last_updated'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="mfa_last_updated" value="<?php echo $this->form_encode_input($mfa_last_updated) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_mfa_last_updated_label" id="hidden_field_label_mfa_last_updated" style="<?php echo $sStyleHidden_mfa_last_updated; ?>"><span id="id_label_mfa_last_updated"><?php echo $this->nm_new_label['mfa_last_updated']; ?></span></TD>
    <TD class="scFormDataOdd css_mfa_last_updated_line" id="hidden_field_data_mfa_last_updated" style="<?php echo $sStyleHidden_mfa_last_updated; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["mfa_last_updated"]) &&  $this->nmgp_cmp_readonly["mfa_last_updated"] == "on") { 

 ?>
<input type="hidden" name="mfa_last_updated" value="<?php echo $this->form_encode_input($mfa_last_updated) . "\">" . $mfa_last_updated . ""; ?>
<?php } else { ?>
<span id="id_read_on_mfa_last_updated" class="sc-ui-readonly-mfa_last_updated css_mfa_last_updated_line" style="<?php echo $sStyleReadLab_mfa_last_updated; ?>"><?php echo $this->form_format_readonly("mfa_last_updated", $this->form_encode_input($this->mfa_last_updated)); ?></span><span id="id_read_off_mfa_last_updated" class="css_read_off_mfa_last_updated<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_mfa_last_updated; ?>">
 <input class="sc-js-input scFormObjectOdd scFormObjectOddSpin scSpin_mfa_last_updated_obj css_mfa_last_updated_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_mfa_last_updated" type=text name="mfa_last_updated" value="<?php echo $this->form_encode_input($mfa_last_updated) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'integer', maxLength: 20, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['mfa_last_updated']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['mfa_last_updated']['symbol_fmt']; ?>, allowNegative: true, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['mfa_last_updated']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
<span class="css_mfa_last_updated_label scFormHelpOdd">&nbsp;<?php echo $this->Ini->Nm_lang['lang_sec_days'] ?>
</span></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_3"></a>
<div id="div_hidden_bloco_3" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_3" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['new_users']))
   {
       $this->nm_new_label['new_users'] = "" . $this->Ini->Nm_lang['lang_sec_set_new_users'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $new_users = $this->new_users;
   $sStyleHidden_new_users = '';
   if (isset($this->nmgp_cmp_hidden['new_users']) && $this->nmgp_cmp_hidden['new_users'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['new_users']);
       $sStyleHidden_new_users = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_new_users = 'display: none;';
   $sStyleReadInp_new_users = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['new_users']) && $this->nmgp_cmp_readonly['new_users'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['new_users']);
       $sStyleReadLab_new_users = '';
       $sStyleReadInp_new_users = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['new_users']) && $this->nmgp_cmp_hidden['new_users'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="new_users" value="<?php echo $this->form_encode_input($this->new_users) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php 
  if ($this->nmgp_opcao != "recarga") 
  {
      $this->new_users_1 = explode(";", trim($this->new_users));
  } 
  else
  {
      if (empty($this->new_users))
      {
          $this->new_users_1= array(); 
          $this->new_users= "N";
      } 
      else
      {
          $this->new_users_1= $this->new_users; 
          $this->new_users= ""; 
          foreach ($this->new_users_1 as $cada_new_users)
          {
             if (!empty($new_users))
             {
                 $this->new_users.= ";"; 
             } 
             $this->new_users.= $cada_new_users; 
          } 
      } 
  } 
?> 

    <TD class="scFormLabelOdd scUiLabelWidthFix css_new_users_label" id="hidden_field_label_new_users" style="<?php echo $sStyleHidden_new_users; ?>"><span id="id_label_new_users"><?php echo $this->nm_new_label['new_users']; ?></span></TD>
    <TD class="scFormDataOdd css_new_users_line" id="hidden_field_data_new_users" style="<?php echo $sStyleHidden_new_users; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["new_users"]) &&  $this->nmgp_cmp_readonly["new_users"] == "on") { 

$new_users_look = "";
 if ($this->new_users == "Y") { $new_users_look .= "" ;} 
 if (empty($new_users_look)) { $new_users_look = $this->new_users; }
?>
<input type="hidden" name="new_users" value="<?php echo $this->form_encode_input($new_users) . "\">" . $new_users_look . ""; ?>
<?php } else { ?>

<?php

$new_users_look = "";
 if ($this->new_users == "Y") { $new_users_look .= "" ;} 
 if (empty($new_users_look)) { $new_users_look = $this->new_users; }
?>
<span id="id_read_on_new_users" class="css_new_users_line" style="<?php echo $sStyleReadLab_new_users; ?>"><?php echo $this->form_format_readonly("new_users", $this->form_encode_input($new_users_look)); ?></span><span id="id_read_off_new_users" class="css_read_off_new_users css_new_users_line" style="<?php echo $sStyleReadInp_new_users; ?>"><?php echo "<div id=\"idAjaxCheckbox_new_users\" style=\"display: inline-block\" class=\"css_new_users_line\">\r\n"; ?><TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_new_users_line"><?php $tempOptionId = "id-opt-new_users" . $sc_seq_vert . "-1"; ?>
 <div class="sc switch">
 <input type=checkbox id="<?php echo $tempOptionId ?>" class="sc-ui-checkbox-new_users sc-ui-checkbox-new_users" name="new_users[]" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_new_users'][] = 'Y'; ?>
<?php  if (in_array("Y", $this->new_users_1))  { echo " checked" ;} ?><?php  if (empty($this->new_users)) { echo " checked" ;} ?> onClick="" ><span></span>
<label for="<?php echo $tempOptionId ?>"></label> </div>
</TD>
</TR></TABLE>
<?php echo "</div>\r\n"; ?></span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['req_email_act']))
   {
       $this->nm_new_label['req_email_act'] = "" . $this->Ini->Nm_lang['lang_sec_set_req_email_act'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $req_email_act = $this->req_email_act;
   $sStyleHidden_req_email_act = '';
   if (isset($this->nmgp_cmp_hidden['req_email_act']) && $this->nmgp_cmp_hidden['req_email_act'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['req_email_act']);
       $sStyleHidden_req_email_act = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_req_email_act = 'display: none;';
   $sStyleReadInp_req_email_act = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['req_email_act']) && $this->nmgp_cmp_readonly['req_email_act'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['req_email_act']);
       $sStyleReadLab_req_email_act = '';
       $sStyleReadInp_req_email_act = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['req_email_act']) && $this->nmgp_cmp_hidden['req_email_act'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="req_email_act" value="<?php echo $this->form_encode_input($this->req_email_act) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php 
  if ($this->nmgp_opcao != "recarga") 
  {
      $this->req_email_act_1 = explode(";", trim($this->req_email_act));
  } 
  else
  {
      if (empty($this->req_email_act))
      {
          $this->req_email_act_1= array(); 
          $this->req_email_act= "N";
      } 
      else
      {
          $this->req_email_act_1= $this->req_email_act; 
          $this->req_email_act= ""; 
          foreach ($this->req_email_act_1 as $cada_req_email_act)
          {
             if (!empty($req_email_act))
             {
                 $this->req_email_act.= ";"; 
             } 
             $this->req_email_act.= $cada_req_email_act; 
          } 
      } 
  } 
?> 

    <TD class="scFormLabelOdd scUiLabelWidthFix css_req_email_act_label" id="hidden_field_label_req_email_act" style="<?php echo $sStyleHidden_req_email_act; ?>"><span id="id_label_req_email_act"><?php echo $this->nm_new_label['req_email_act']; ?></span></TD>
    <TD class="scFormDataOdd css_req_email_act_line" id="hidden_field_data_req_email_act" style="<?php echo $sStyleHidden_req_email_act; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["req_email_act"]) &&  $this->nmgp_cmp_readonly["req_email_act"] == "on") { 

$req_email_act_look = "";
 if ($this->req_email_act == "Y") { $req_email_act_look .= "" ;} 
 if (empty($req_email_act_look)) { $req_email_act_look = $this->req_email_act; }
?>
<input type="hidden" name="req_email_act" value="<?php echo $this->form_encode_input($req_email_act) . "\">" . $req_email_act_look . ""; ?>
<?php } else { ?>

<?php

$req_email_act_look = "";
 if ($this->req_email_act == "Y") { $req_email_act_look .= "" ;} 
 if (empty($req_email_act_look)) { $req_email_act_look = $this->req_email_act; }
?>
<span id="id_read_on_req_email_act" class="css_req_email_act_line" style="<?php echo $sStyleReadLab_req_email_act; ?>"><?php echo $this->form_format_readonly("req_email_act", $this->form_encode_input($req_email_act_look)); ?></span><span id="id_read_off_req_email_act" class="css_read_off_req_email_act css_req_email_act_line" style="<?php echo $sStyleReadInp_req_email_act; ?>"><?php echo "<div id=\"idAjaxCheckbox_req_email_act\" style=\"display: inline-block\" class=\"css_req_email_act_line\">\r\n"; ?><TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_req_email_act_line"><?php $tempOptionId = "id-opt-req_email_act" . $sc_seq_vert . "-1"; ?>
 <div class="sc switch">
 <input type=checkbox id="<?php echo $tempOptionId ?>" class="sc-ui-checkbox-req_email_act sc-ui-checkbox-req_email_act" name="req_email_act[]" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_req_email_act'][] = 'Y'; ?>
<?php  if (in_array("Y", $this->req_email_act_1))  { echo " checked" ;} ?> onClick="" ><span></span>
<label for="<?php echo $tempOptionId ?>"></label> </div>
</TD>
</TR></TABLE>
<?php echo "</div>\r\n"; ?></span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['send_email_adm']))
   {
       $this->nm_new_label['send_email_adm'] = "" . $this->Ini->Nm_lang['lang_sec_set_send_email_adm'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $send_email_adm = $this->send_email_adm;
   $sStyleHidden_send_email_adm = '';
   if (isset($this->nmgp_cmp_hidden['send_email_adm']) && $this->nmgp_cmp_hidden['send_email_adm'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['send_email_adm']);
       $sStyleHidden_send_email_adm = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_send_email_adm = 'display: none;';
   $sStyleReadInp_send_email_adm = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['send_email_adm']) && $this->nmgp_cmp_readonly['send_email_adm'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['send_email_adm']);
       $sStyleReadLab_send_email_adm = '';
       $sStyleReadInp_send_email_adm = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['send_email_adm']) && $this->nmgp_cmp_hidden['send_email_adm'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="send_email_adm" value="<?php echo $this->form_encode_input($this->send_email_adm) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php 
  if ($this->nmgp_opcao != "recarga") 
  {
      $this->send_email_adm_1 = explode(";", trim($this->send_email_adm));
  } 
  else
  {
      if (empty($this->send_email_adm))
      {
          $this->send_email_adm_1= array(); 
          $this->send_email_adm= "N";
      } 
      else
      {
          $this->send_email_adm_1= $this->send_email_adm; 
          $this->send_email_adm= ""; 
          foreach ($this->send_email_adm_1 as $cada_send_email_adm)
          {
             if (!empty($send_email_adm))
             {
                 $this->send_email_adm.= ";"; 
             } 
             $this->send_email_adm.= $cada_send_email_adm; 
          } 
      } 
  } 
?> 

    <TD class="scFormLabelOdd scUiLabelWidthFix css_send_email_adm_label" id="hidden_field_label_send_email_adm" style="<?php echo $sStyleHidden_send_email_adm; ?>"><span id="id_label_send_email_adm"><?php echo $this->nm_new_label['send_email_adm']; ?></span></TD>
    <TD class="scFormDataOdd css_send_email_adm_line" id="hidden_field_data_send_email_adm" style="<?php echo $sStyleHidden_send_email_adm; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["send_email_adm"]) &&  $this->nmgp_cmp_readonly["send_email_adm"] == "on") { 

$send_email_adm_look = "";
 if ($this->send_email_adm == "Y") { $send_email_adm_look .= "" ;} 
 if (empty($send_email_adm_look)) { $send_email_adm_look = $this->send_email_adm; }
?>
<input type="hidden" name="send_email_adm" value="<?php echo $this->form_encode_input($send_email_adm) . "\">" . $send_email_adm_look . ""; ?>
<?php } else { ?>

<?php

$send_email_adm_look = "";
 if ($this->send_email_adm == "Y") { $send_email_adm_look .= "" ;} 
 if (empty($send_email_adm_look)) { $send_email_adm_look = $this->send_email_adm; }
?>
<span id="id_read_on_send_email_adm" class="css_send_email_adm_line" style="<?php echo $sStyleReadLab_send_email_adm; ?>"><?php echo $this->form_format_readonly("send_email_adm", $this->form_encode_input($send_email_adm_look)); ?></span><span id="id_read_off_send_email_adm" class="css_read_off_send_email_adm css_send_email_adm_line" style="<?php echo $sStyleReadInp_send_email_adm; ?>"><?php echo "<div id=\"idAjaxCheckbox_send_email_adm\" style=\"display: inline-block\" class=\"css_send_email_adm_line\">\r\n"; ?><TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_send_email_adm_line"><?php $tempOptionId = "id-opt-send_email_adm" . $sc_seq_vert . "-1"; ?>
 <div class="sc switch">
 <input type=checkbox id="<?php echo $tempOptionId ?>" class="sc-ui-checkbox-send_email_adm sc-ui-checkbox-send_email_adm" name="send_email_adm[]" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_send_email_adm'][] = 'Y'; ?>
<?php  if (in_array("Y", $this->send_email_adm_1))  { echo " checked" ;} ?> onClick="" ><span></span>
<label for="<?php echo $tempOptionId ?>"></label> </div>
</TD>
</TR></TABLE>
<?php echo "</div>\r\n"; ?></span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['group_default']))
   {
       $this->nm_new_label['group_default'] = "" . $this->Ini->Nm_lang['lang_sec_set_group_default'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $group_default = $this->group_default;
   $sStyleHidden_group_default = '';
   if (isset($this->nmgp_cmp_hidden['group_default']) && $this->nmgp_cmp_hidden['group_default'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['group_default']);
       $sStyleHidden_group_default = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_group_default = 'display: none;';
   $sStyleReadInp_group_default = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['group_default']) && $this->nmgp_cmp_readonly['group_default'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['group_default']);
       $sStyleReadLab_group_default = '';
       $sStyleReadInp_group_default = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['group_default']) && $this->nmgp_cmp_hidden['group_default'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="group_default" value="<?php echo $this->form_encode_input($this->group_default) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_group_default_label" id="hidden_field_label_group_default" style="<?php echo $sStyleHidden_group_default; ?>"><span id="id_label_group_default"><?php echo $this->nm_new_label['group_default']; ?></span></TD>
    <TD class="scFormDataOdd css_group_default_line" id="hidden_field_data_group_default" style="<?php echo $sStyleHidden_group_default; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["group_default"]) &&  $this->nmgp_cmp_readonly["group_default"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_default']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_default'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_default']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_default'] = array(); 
}
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_default']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_default'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_default']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_default'] = array(); 
    }

   $old_value_cookie_expiration_time = $this->cookie_expiration_time;
   $old_value_pswd_last_updated = $this->pswd_last_updated;
   $old_value_brute_force_attempts = $this->brute_force_attempts;
   $old_value_brute_force_time_block = $this->brute_force_time_block;
   $old_value_password_min = $this->password_min;
   $old_value_enable_2fa_expiration_time = $this->enable_2fa_expiration_time;
   $old_value_mfa_last_updated = $this->mfa_last_updated;
   $old_value_smtp_port = $this->smtp_port;
   $this->nm_tira_formatacao();


   $unformatted_value_cookie_expiration_time = $this->cookie_expiration_time;
   $unformatted_value_pswd_last_updated = $this->pswd_last_updated;
   $unformatted_value_brute_force_attempts = $this->brute_force_attempts;
   $unformatted_value_brute_force_time_block = $this->brute_force_time_block;
   $unformatted_value_password_min = $this->password_min;
   $unformatted_value_enable_2fa_expiration_time = $this->enable_2fa_expiration_time;
   $unformatted_value_mfa_last_updated = $this->mfa_last_updated;
   $unformatted_value_smtp_port = $this->smtp_port;

   $remember_me_val_str = "''";
   if (!empty($this->remember_me))
   {
       if (is_array($this->remember_me))
       {
           $Tmp_array = $this->remember_me;
       }
       else
       {
           $Tmp_array = explode(";", $this->remember_me);
       }
       $remember_me_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $remember_me_val_str)
          {
             $remember_me_val_str .= ", ";
          }
          $remember_me_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $retrieve_password_val_str = "''";
   if (!empty($this->retrieve_password))
   {
       if (is_array($this->retrieve_password))
       {
           $Tmp_array = $this->retrieve_password;
       }
       else
       {
           $Tmp_array = explode(";", $this->retrieve_password);
       }
       $retrieve_password_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $retrieve_password_val_str)
          {
             $retrieve_password_val_str .= ", ";
          }
          $retrieve_password_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $new_users_val_str = "''";
   if (!empty($this->new_users))
   {
       if (is_array($this->new_users))
       {
           $Tmp_array = $this->new_users;
       }
       else
       {
           $Tmp_array = explode(";", $this->new_users);
       }
       $new_users_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $new_users_val_str)
          {
             $new_users_val_str .= ", ";
          }
          $new_users_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $enable_2fa_val_str = "''";
   if (!empty($this->enable_2fa))
   {
       if (is_array($this->enable_2fa))
       {
           $Tmp_array = $this->enable_2fa;
       }
       else
       {
           $Tmp_array = explode(";", $this->enable_2fa);
       }
       $enable_2fa_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $enable_2fa_val_str)
          {
             $enable_2fa_val_str .= ", ";
          }
          $enable_2fa_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $brute_force_val_str = "''";
   if (!empty($this->brute_force))
   {
       if (is_array($this->brute_force))
       {
           $Tmp_array = $this->brute_force;
       }
       else
       {
           $Tmp_array = explode(";", $this->brute_force);
       }
       $brute_force_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $brute_force_val_str)
          {
             $brute_force_val_str .= ", ";
          }
          $brute_force_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $captcha_val_str = "''";
   if (!empty($this->captcha))
   {
       if (is_array($this->captcha))
       {
           $Tmp_array = $this->captcha;
       }
       else
       {
           $Tmp_array = explode(";", $this->captcha);
       }
       $captcha_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $captcha_val_str)
          {
             $captcha_val_str .= ", ";
          }
          $captcha_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $language_val_str = "''";
   if (!empty($this->language))
   {
       if (is_array($this->language))
       {
           $Tmp_array = $this->language;
       }
       else
       {
           $Tmp_array = explode(";", $this->language);
       }
       $language_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $language_val_str)
          {
             $language_val_str .= ", ";
          }
          $language_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $req_email_act_val_str = "''";
   if (!empty($this->req_email_act))
   {
       if (is_array($this->req_email_act))
       {
           $Tmp_array = $this->req_email_act;
       }
       else
       {
           $Tmp_array = explode(";", $this->req_email_act);
       }
       $req_email_act_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $req_email_act_val_str)
          {
             $req_email_act_val_str .= ", ";
          }
          $req_email_act_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $send_email_adm_val_str = "''";
   if (!empty($this->send_email_adm))
   {
       if (is_array($this->send_email_adm))
       {
           $Tmp_array = $this->send_email_adm;
       }
       else
       {
           $Tmp_array = explode(";", $this->send_email_adm);
       }
       $send_email_adm_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $send_email_adm_val_str)
          {
             $send_email_adm_val_str .= ", ";
          }
          $send_email_adm_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $password_strength_val_str = "''";
   if (!empty($this->password_strength))
   {
       if (is_array($this->password_strength))
       {
           $Tmp_array = $this->password_strength;
       }
       else
       {
           $Tmp_array = explode(";", $this->password_strength);
       }
       $password_strength_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $password_strength_val_str)
          {
             $password_strength_val_str .= ", ";
          }
          $password_strength_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $auth_sn_fb_val_str = "''";
   if (!empty($this->auth_sn_fb))
   {
       if (is_array($this->auth_sn_fb))
       {
           $Tmp_array = $this->auth_sn_fb;
       }
       else
       {
           $Tmp_array = explode(";", $this->auth_sn_fb);
       }
       $auth_sn_fb_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $auth_sn_fb_val_str)
          {
             $auth_sn_fb_val_str .= ", ";
          }
          $auth_sn_fb_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $auth_sn_x_val_str = "''";
   if (!empty($this->auth_sn_x))
   {
       if (is_array($this->auth_sn_x))
       {
           $Tmp_array = $this->auth_sn_x;
       }
       else
       {
           $Tmp_array = explode(";", $this->auth_sn_x);
       }
       $auth_sn_x_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $auth_sn_x_val_str)
          {
             $auth_sn_x_val_str .= ", ";
          }
          $auth_sn_x_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $auth_sn_google_val_str = "''";
   if (!empty($this->auth_sn_google))
   {
       if (is_array($this->auth_sn_google))
       {
           $Tmp_array = $this->auth_sn_google;
       }
       else
       {
           $Tmp_array = explode(";", $this->auth_sn_google);
       }
       $auth_sn_google_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $auth_sn_google_val_str)
          {
             $auth_sn_google_val_str .= ", ";
          }
          $auth_sn_google_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $nm_comando = "SELECT group_id, description  FROM sec_groups  ORDER BY description";

   $this->cookie_expiration_time = $old_value_cookie_expiration_time;
   $this->pswd_last_updated = $old_value_pswd_last_updated;
   $this->brute_force_attempts = $old_value_brute_force_attempts;
   $this->brute_force_time_block = $old_value_brute_force_time_block;
   $this->password_min = $old_value_password_min;
   $this->enable_2fa_expiration_time = $old_value_enable_2fa_expiration_time;
   $this->mfa_last_updated = $old_value_mfa_last_updated;
   $this->smtp_port = $old_value_smtp_port;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_default'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $group_default_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->group_default_1))
          {
              foreach ($this->group_default_1 as $tmp_group_default)
              {
                  if (trim($tmp_group_default) === trim($cadaselect[1])) {$group_default_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->group_default) && trim($this->group_default) === trim($cadaselect[1])) {$group_default_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="group_default" value="<?php echo $this->form_encode_input($group_default) . "\">" . $group_default_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_group_default();
   $x = 0 ; 
   $group_default_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->group_default_1))
          {
              foreach ($this->group_default_1 as $tmp_group_default)
              {
                  if (trim($tmp_group_default) === trim($cadaselect[1])) {$group_default_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->group_default)) {
                 if (trim($this->group_default) == trim($cadaselect[1])) { $group_default_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->group_default == $cadaselect[1]) { $group_default_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($group_default_look))
          {
              $group_default_look = $this->group_default;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_group_default\" class=\"css_group_default_line\" style=\"" .  $sStyleReadLab_group_default . "\">" . $this->form_format_readonly("group_default", $this->form_encode_input($group_default_look)) . "</span><span id=\"id_read_off_group_default\" class=\"css_read_off_group_default" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_group_default . "\">";
   echo " <span id=\"idAjaxSelect_group_default\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_group_default_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_group_default\" name=\"group_default\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_group_default'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->group_default) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->group_default)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_4"></a>
<div id="div_hidden_bloco_4" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_4" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['smtp_api']))
    {
        $this->nm_new_label['smtp_api'] = "" . $this->Ini->Nm_lang['lang_sec_set_smtp_api'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $smtp_api = $this->smtp_api;
   $sStyleHidden_smtp_api = '';
   if (isset($this->nmgp_cmp_hidden['smtp_api']) && $this->nmgp_cmp_hidden['smtp_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['smtp_api']);
       $sStyleHidden_smtp_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_smtp_api = 'display: none;';
   $sStyleReadInp_smtp_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['smtp_api']) && $this->nmgp_cmp_readonly['smtp_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['smtp_api']);
       $sStyleReadLab_smtp_api = '';
       $sStyleReadInp_smtp_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['smtp_api']) && $this->nmgp_cmp_hidden['smtp_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="smtp_api" value="<?php echo $this->form_encode_input($smtp_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_smtp_api_label" id="hidden_field_label_smtp_api" style="<?php echo $sStyleHidden_smtp_api; ?>"><span id="id_label_smtp_api"><?php echo $this->nm_new_label['smtp_api']; ?></span></TD>
    <TD class="scFormDataOdd css_smtp_api_line" id="hidden_field_data_smtp_api" style="<?php echo $sStyleHidden_smtp_api; ?>"><input type="hidden" name="smtp_api" value="<?php echo $this->form_encode_input($smtp_api); ?>"><span id="id_ajax_label_smtp_api"><?php echo nl2br($smtp_api); ?></span>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['smtp_server']))
    {
        $this->nm_new_label['smtp_server'] = "" . $this->Ini->Nm_lang['lang_sec_set_smtp_server'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $smtp_server = $this->smtp_server;
   $sStyleHidden_smtp_server = '';
   if (isset($this->nmgp_cmp_hidden['smtp_server']) && $this->nmgp_cmp_hidden['smtp_server'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['smtp_server']);
       $sStyleHidden_smtp_server = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_smtp_server = 'display: none;';
   $sStyleReadInp_smtp_server = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['smtp_server']) && $this->nmgp_cmp_readonly['smtp_server'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['smtp_server']);
       $sStyleReadLab_smtp_server = '';
       $sStyleReadInp_smtp_server = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['smtp_server']) && $this->nmgp_cmp_hidden['smtp_server'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="smtp_server" value="<?php echo $this->form_encode_input($smtp_server) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_smtp_server_label" id="hidden_field_label_smtp_server" style="<?php echo $sStyleHidden_smtp_server; ?>"><span id="id_label_smtp_server"><?php echo $this->nm_new_label['smtp_server']; ?></span></TD>
    <TD class="scFormDataOdd css_smtp_server_line" id="hidden_field_data_smtp_server" style="<?php echo $sStyleHidden_smtp_server; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["smtp_server"]) &&  $this->nmgp_cmp_readonly["smtp_server"] == "on") { 

 ?>
<input type="hidden" name="smtp_server" value="<?php echo $this->form_encode_input($smtp_server) . "\">" . $smtp_server . ""; ?>
<?php } else { ?>
<span id="id_read_on_smtp_server" class="sc-ui-readonly-smtp_server css_smtp_server_line" style="<?php echo $sStyleReadLab_smtp_server; ?>"><?php echo $this->form_format_readonly("smtp_server", $this->form_encode_input($this->smtp_server)); ?></span><span id="id_read_off_smtp_server" class="css_read_off_smtp_server<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_smtp_server; ?>">
 <input class="sc-js-input scFormObjectOdd css_smtp_server_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_smtp_server" type=text name="smtp_server" value="<?php echo $this->form_encode_input($smtp_server) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: 'smtp.example.com', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['smtp_port']))
    {
        $this->nm_new_label['smtp_port'] = "" . $this->Ini->Nm_lang['lang_sec_set_smtp_port'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $smtp_port = $this->smtp_port;
   $sStyleHidden_smtp_port = '';
   if (isset($this->nmgp_cmp_hidden['smtp_port']) && $this->nmgp_cmp_hidden['smtp_port'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['smtp_port']);
       $sStyleHidden_smtp_port = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_smtp_port = 'display: none;';
   $sStyleReadInp_smtp_port = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['smtp_port']) && $this->nmgp_cmp_readonly['smtp_port'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['smtp_port']);
       $sStyleReadLab_smtp_port = '';
       $sStyleReadInp_smtp_port = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['smtp_port']) && $this->nmgp_cmp_hidden['smtp_port'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="smtp_port" value="<?php echo $this->form_encode_input($smtp_port) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_smtp_port_label" id="hidden_field_label_smtp_port" style="<?php echo $sStyleHidden_smtp_port; ?>"><span id="id_label_smtp_port"><?php echo $this->nm_new_label['smtp_port']; ?></span></TD>
    <TD class="scFormDataOdd css_smtp_port_line" id="hidden_field_data_smtp_port" style="<?php echo $sStyleHidden_smtp_port; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["smtp_port"]) &&  $this->nmgp_cmp_readonly["smtp_port"] == "on") { 

 ?>
<input type="hidden" name="smtp_port" value="<?php echo $this->form_encode_input($smtp_port) . "\">" . $smtp_port . ""; ?>
<?php } else { ?>
<span id="id_read_on_smtp_port" class="sc-ui-readonly-smtp_port css_smtp_port_line" style="<?php echo $sStyleReadLab_smtp_port; ?>"><?php echo $this->form_format_readonly("smtp_port", $this->form_encode_input($this->smtp_port)); ?></span><span id="id_read_off_smtp_port" class="css_read_off_smtp_port<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_smtp_port; ?>">
 <input class="sc-js-input scFormObjectOdd css_smtp_port_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_smtp_port" type=text name="smtp_port" value="<?php echo $this->form_encode_input($smtp_port) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'integer', maxLength: 20, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['smtp_port']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['smtp_port']['symbol_fmt']; ?>, allowNegative: true, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['smtp_port']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '465', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['smtp_security']))
   {
       $this->nm_new_label['smtp_security'] = "" . $this->Ini->Nm_lang['lang_sec_set_smtp_security'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $smtp_security = $this->smtp_security;
   $sStyleHidden_smtp_security = '';
   if (isset($this->nmgp_cmp_hidden['smtp_security']) && $this->nmgp_cmp_hidden['smtp_security'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['smtp_security']);
       $sStyleHidden_smtp_security = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_smtp_security = 'display: none;';
   $sStyleReadInp_smtp_security = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['smtp_security']) && $this->nmgp_cmp_readonly['smtp_security'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['smtp_security']);
       $sStyleReadLab_smtp_security = '';
       $sStyleReadInp_smtp_security = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['smtp_security']) && $this->nmgp_cmp_hidden['smtp_security'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="smtp_security" value="<?php echo $this->form_encode_input($this->smtp_security) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_smtp_security_label" id="hidden_field_label_smtp_security" style="<?php echo $sStyleHidden_smtp_security; ?>"><span id="id_label_smtp_security"><?php echo $this->nm_new_label['smtp_security']; ?></span></TD>
    <TD class="scFormDataOdd css_smtp_security_line" id="hidden_field_data_smtp_security" style="<?php echo $sStyleHidden_smtp_security; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["smtp_security"]) &&  $this->nmgp_cmp_readonly["smtp_security"] == "on") { 

$smtp_security_look = "";
 if ($this->smtp_security == "ssl") { $smtp_security_look .= "SSL" ;} 
 if ($this->smtp_security == "tls") { $smtp_security_look .= "TLS" ;} 
 if (empty($smtp_security_look)) { $smtp_security_look = $this->smtp_security; }
?>
<input type="hidden" name="smtp_security" value="<?php echo $this->form_encode_input($smtp_security) . "\">" . $smtp_security_look . ""; ?>
<?php } else { ?>
<?php

$smtp_security_look = "";
 if ($this->smtp_security == "ssl") { $smtp_security_look .= "SSL" ;} 
 if ($this->smtp_security == "tls") { $smtp_security_look .= "TLS" ;} 
 if (empty($smtp_security_look)) { $smtp_security_look = $this->smtp_security; }
?>
<span id="id_read_on_smtp_security" class="css_smtp_security_line"  style="<?php echo $sStyleReadLab_smtp_security; ?>"><?php echo $this->form_format_readonly("smtp_security", $this->form_encode_input($smtp_security_look)); ?></span><span id="id_read_off_smtp_security" class="css_read_off_smtp_security<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_smtp_security; ?>">
 <span id="idAjaxSelect_smtp_security" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_smtp_security_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_smtp_security" name="smtp_security" size="1" alt="{type: 'select', enterTab: false}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_smtp_security'][] = ''; ?>
 <option value=""></option>
 <option  value="ssl" <?php  if ($this->smtp_security == "ssl") { echo " selected" ;} ?>>SSL</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_smtp_security'][] = 'ssl'; ?>
 <option  value="tls" <?php  if ($this->smtp_security == "tls") { echo " selected" ;} ?>>TLS</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_smtp_security'][] = 'tls'; ?>
 </select></span>
</span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['smtp_user']))
    {
        $this->nm_new_label['smtp_user'] = "" . $this->Ini->Nm_lang['lang_sec_set_smtp_user'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $smtp_user = $this->smtp_user;
   $sStyleHidden_smtp_user = '';
   if (isset($this->nmgp_cmp_hidden['smtp_user']) && $this->nmgp_cmp_hidden['smtp_user'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['smtp_user']);
       $sStyleHidden_smtp_user = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_smtp_user = 'display: none;';
   $sStyleReadInp_smtp_user = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['smtp_user']) && $this->nmgp_cmp_readonly['smtp_user'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['smtp_user']);
       $sStyleReadLab_smtp_user = '';
       $sStyleReadInp_smtp_user = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['smtp_user']) && $this->nmgp_cmp_hidden['smtp_user'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="smtp_user" value="<?php echo $this->form_encode_input($smtp_user) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_smtp_user_label" id="hidden_field_label_smtp_user" style="<?php echo $sStyleHidden_smtp_user; ?>"><span id="id_label_smtp_user"><?php echo $this->nm_new_label['smtp_user']; ?></span></TD>
    <TD class="scFormDataOdd css_smtp_user_line" id="hidden_field_data_smtp_user" style="<?php echo $sStyleHidden_smtp_user; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["smtp_user"]) &&  $this->nmgp_cmp_readonly["smtp_user"] == "on") { 

 ?>
<input type="hidden" name="smtp_user" value="<?php echo $this->form_encode_input($smtp_user) . "\">" . $smtp_user . ""; ?>
<?php } else { ?>
<span id="id_read_on_smtp_user" class="sc-ui-readonly-smtp_user css_smtp_user_line" style="<?php echo $sStyleReadLab_smtp_user; ?>"><?php echo $this->form_format_readonly("smtp_user", $this->form_encode_input($this->smtp_user)); ?></span><span id="id_read_off_smtp_user" class="css_read_off_smtp_user<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_smtp_user; ?>">
 <input class="sc-js-input scFormObjectOdd css_smtp_user_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_smtp_user" type=text name="smtp_user" value="<?php echo $this->form_encode_input($smtp_user) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['smtp_pass']))
    {
        $this->nm_new_label['smtp_pass'] = "" . $this->Ini->Nm_lang['lang_sec_set_smtp_smtp_pass'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $smtp_pass = $this->smtp_pass;
   $sStyleHidden_smtp_pass = '';
   if (isset($this->nmgp_cmp_hidden['smtp_pass']) && $this->nmgp_cmp_hidden['smtp_pass'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['smtp_pass']);
       $sStyleHidden_smtp_pass = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_smtp_pass = 'display: none;';
   $sStyleReadInp_smtp_pass = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['smtp_pass']) && $this->nmgp_cmp_readonly['smtp_pass'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['smtp_pass']);
       $sStyleReadLab_smtp_pass = '';
       $sStyleReadInp_smtp_pass = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['smtp_pass']) && $this->nmgp_cmp_hidden['smtp_pass'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="smtp_pass" value="<?php echo $this->form_encode_input($smtp_pass) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_smtp_pass_label" id="hidden_field_label_smtp_pass" style="<?php echo $sStyleHidden_smtp_pass; ?>"><span id="id_label_smtp_pass"><?php echo $this->nm_new_label['smtp_pass']; ?></span></TD>
    <TD class="scFormDataOdd css_smtp_pass_line" id="hidden_field_data_smtp_pass" style="<?php echo $sStyleHidden_smtp_pass; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["smtp_pass"]) &&  $this->nmgp_cmp_readonly["smtp_pass"] == "on") { ?>
<input type="hidden" name="smtp_pass" value="">
<?php } else { ?>
<span id="id_read_on_smtp_pass" class="sc-ui-readonly-smtp_pass css_smtp_pass_line" style="<?php echo $sStyleReadLab_smtp_pass; ?>"><?php echo $this->form_format_readonly("smtp_pass", $this->form_encode_input($this->smtp_pass)); ?></span><span id="id_read_off_smtp_pass" class="css_read_off_smtp_pass<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_smtp_pass; ?>"><div class="scFormObjectOddPwdBox<?php echo $this->classes_100perc_fields['span_input'] ?>" style="width: 100%"><input class="sc-js-input scFormObjectOddPwdInput scFormObjectOddPwdText sc-ui-pwd-toggle css_smtp_pass_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_smtp_pass" type="password" autocomplete="off" name="smtp_pass" value="" 
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ><span id="id_pwd_show_hide_smtp_pass" class="sc-ui-pwd-toggle-icon"><i class="fa fa-eye sc-ui-pwd-eye" aria-hidden="true" id="id_pwd_fa_smtp_pass"></i></span></div></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['smtp_from_email']))
    {
        $this->nm_new_label['smtp_from_email'] = "" . $this->Ini->Nm_lang['lang_sec_set_smtp_from_email'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $smtp_from_email = $this->smtp_from_email;
   $sStyleHidden_smtp_from_email = '';
   if (isset($this->nmgp_cmp_hidden['smtp_from_email']) && $this->nmgp_cmp_hidden['smtp_from_email'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['smtp_from_email']);
       $sStyleHidden_smtp_from_email = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_smtp_from_email = 'display: none;';
   $sStyleReadInp_smtp_from_email = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['smtp_from_email']) && $this->nmgp_cmp_readonly['smtp_from_email'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['smtp_from_email']);
       $sStyleReadLab_smtp_from_email = '';
       $sStyleReadInp_smtp_from_email = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['smtp_from_email']) && $this->nmgp_cmp_hidden['smtp_from_email'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="smtp_from_email" value="<?php echo $this->form_encode_input($smtp_from_email) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_smtp_from_email_label" id="hidden_field_label_smtp_from_email" style="<?php echo $sStyleHidden_smtp_from_email; ?>"><span id="id_label_smtp_from_email"><?php echo $this->nm_new_label['smtp_from_email']; ?></span></TD>
    <TD class="scFormDataOdd css_smtp_from_email_line" id="hidden_field_data_smtp_from_email" style="<?php echo $sStyleHidden_smtp_from_email; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["smtp_from_email"]) &&  $this->nmgp_cmp_readonly["smtp_from_email"] == "on") { 

 ?>
<input type="hidden" name="smtp_from_email" value="<?php echo $this->form_encode_input($smtp_from_email) . "\">" . $smtp_from_email . ""; ?>
<?php } else { ?>
<span id="id_read_on_smtp_from_email" class="sc-ui-readonly-smtp_from_email css_smtp_from_email_line" style="<?php echo $sStyleReadLab_smtp_from_email; ?>"><?php echo $this->form_format_readonly("smtp_from_email", $this->form_encode_input($this->smtp_from_email)); ?></span><span id="id_read_off_smtp_from_email" class="css_read_off_smtp_from_email<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_smtp_from_email; ?>">
 <input class="sc-js-input scFormObjectOdd css_smtp_from_email_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_smtp_from_email" type=text name="smtp_from_email" value="<?php echo $this->form_encode_input($smtp_from_email) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=255 alt="{enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<span style="display: none"><?php echo nmButtonOutput($this->arr_buttons, "bemail", "if (document.F1.smtp_from_email.value != '') {window.open('mailto:' + document.F1.smtp_from_email.value); }", "if (document.F1.smtp_from_email.value != '') {window.open('mailto:' + document.F1.smtp_from_email.value); }", "smtp_from_email_mail", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</span>
</span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['smtp_from_name']))
    {
        $this->nm_new_label['smtp_from_name'] = "" . $this->Ini->Nm_lang['lang_sec_set_smtp_from_name'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $smtp_from_name = $this->smtp_from_name;
   $sStyleHidden_smtp_from_name = '';
   if (isset($this->nmgp_cmp_hidden['smtp_from_name']) && $this->nmgp_cmp_hidden['smtp_from_name'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['smtp_from_name']);
       $sStyleHidden_smtp_from_name = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_smtp_from_name = 'display: none;';
   $sStyleReadInp_smtp_from_name = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['smtp_from_name']) && $this->nmgp_cmp_readonly['smtp_from_name'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['smtp_from_name']);
       $sStyleReadLab_smtp_from_name = '';
       $sStyleReadInp_smtp_from_name = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['smtp_from_name']) && $this->nmgp_cmp_hidden['smtp_from_name'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="smtp_from_name" value="<?php echo $this->form_encode_input($smtp_from_name) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_smtp_from_name_label" id="hidden_field_label_smtp_from_name" style="<?php echo $sStyleHidden_smtp_from_name; ?>"><span id="id_label_smtp_from_name"><?php echo $this->nm_new_label['smtp_from_name']; ?></span></TD>
    <TD class="scFormDataOdd css_smtp_from_name_line" id="hidden_field_data_smtp_from_name" style="<?php echo $sStyleHidden_smtp_from_name; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["smtp_from_name"]) &&  $this->nmgp_cmp_readonly["smtp_from_name"] == "on") { 

 ?>
<input type="hidden" name="smtp_from_name" value="<?php echo $this->form_encode_input($smtp_from_name) . "\">" . $smtp_from_name . ""; ?>
<?php } else { ?>
<span id="id_read_on_smtp_from_name" class="sc-ui-readonly-smtp_from_name css_smtp_from_name_line" style="<?php echo $sStyleReadLab_smtp_from_name; ?>"><?php echo $this->form_format_readonly("smtp_from_name", $this->form_encode_input($this->smtp_from_name)); ?></span><span id="id_read_off_smtp_from_name" class="css_read_off_smtp_from_name<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_smtp_from_name; ?>">
 <input class="sc-js-input scFormObjectOdd css_smtp_from_name_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_smtp_from_name" type=text name="smtp_from_name" value="<?php echo $this->form_encode_input($smtp_from_name) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_5"></a>
<div id="div_hidden_bloco_5" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_5" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['auth_sn_position']))
   {
       $this->nm_new_label['auth_sn_position'] = "" . $this->Ini->Nm_lang['lang_sec_set_sn_position'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $auth_sn_position = $this->auth_sn_position;
   $sStyleHidden_auth_sn_position = '';
   if (isset($this->nmgp_cmp_hidden['auth_sn_position']) && $this->nmgp_cmp_hidden['auth_sn_position'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['auth_sn_position']);
       $sStyleHidden_auth_sn_position = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_auth_sn_position = 'display: none;';
   $sStyleReadInp_auth_sn_position = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['auth_sn_position']) && $this->nmgp_cmp_readonly['auth_sn_position'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['auth_sn_position']);
       $sStyleReadLab_auth_sn_position = '';
       $sStyleReadInp_auth_sn_position = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['auth_sn_position']) && $this->nmgp_cmp_hidden['auth_sn_position'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="auth_sn_position" value="<?php echo $this->form_encode_input($this->auth_sn_position) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_auth_sn_position_label" id="hidden_field_label_auth_sn_position" style="<?php echo $sStyleHidden_auth_sn_position; ?>"><span id="id_label_auth_sn_position"><?php echo $this->nm_new_label['auth_sn_position']; ?></span></TD>
    <TD class="scFormDataOdd css_auth_sn_position_line" id="hidden_field_data_auth_sn_position" style="<?php echo $sStyleHidden_auth_sn_position; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["auth_sn_position"]) &&  $this->nmgp_cmp_readonly["auth_sn_position"] == "on") { 

$auth_sn_position_look = "";
 if ($this->auth_sn_position == "beside") { $auth_sn_position_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_buttons_beside'] . "" ;} 
 if ($this->auth_sn_position == "below") { $auth_sn_position_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_buttons_below'] . "" ;} 
 if (empty($auth_sn_position_look)) { $auth_sn_position_look = $this->auth_sn_position; }
?>
<input type="hidden" name="auth_sn_position" value="<?php echo $this->form_encode_input($auth_sn_position) . "\">" . $auth_sn_position_look . ""; ?>
<?php } else { ?>
<?php

$auth_sn_position_look = "";
 if ($this->auth_sn_position == "beside") { $auth_sn_position_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_buttons_beside'] . "" ;} 
 if ($this->auth_sn_position == "below") { $auth_sn_position_look .= "" . $this->Ini->Nm_lang['lang_sec_opt_buttons_below'] . "" ;} 
 if (empty($auth_sn_position_look)) { $auth_sn_position_look = $this->auth_sn_position; }
?>
<span id="id_read_on_auth_sn_position" class="css_auth_sn_position_line"  style="<?php echo $sStyleReadLab_auth_sn_position; ?>"><?php echo $this->form_format_readonly("auth_sn_position", $this->form_encode_input($auth_sn_position_look)); ?></span><span id="id_read_off_auth_sn_position" class="css_read_off_auth_sn_position<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_auth_sn_position; ?>">
 <span id="idAjaxSelect_auth_sn_position" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_auth_sn_position_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_auth_sn_position" name="auth_sn_position" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="beside" <?php  if ($this->auth_sn_position == "beside") { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_sec_opt_buttons_beside']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_auth_sn_position'][] = 'beside'; ?>
 <option  value="below" <?php  if ($this->auth_sn_position == "below") { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_sec_opt_buttons_below']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_auth_sn_position'][] = 'below'; ?>
 </select></span>
</span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['auth_sn_fb']))
   {
       $this->nm_new_label['auth_sn_fb'] = "Facebook";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $auth_sn_fb = $this->auth_sn_fb;
   $sStyleHidden_auth_sn_fb = '';
   if (isset($this->nmgp_cmp_hidden['auth_sn_fb']) && $this->nmgp_cmp_hidden['auth_sn_fb'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['auth_sn_fb']);
       $sStyleHidden_auth_sn_fb = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_auth_sn_fb = 'display: none;';
   $sStyleReadInp_auth_sn_fb = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['auth_sn_fb']) && $this->nmgp_cmp_readonly['auth_sn_fb'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['auth_sn_fb']);
       $sStyleReadLab_auth_sn_fb = '';
       $sStyleReadInp_auth_sn_fb = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['auth_sn_fb']) && $this->nmgp_cmp_hidden['auth_sn_fb'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="auth_sn_fb" value="<?php echo $this->form_encode_input($this->auth_sn_fb) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php 
  if ($this->nmgp_opcao != "recarga") 
  {
      $this->auth_sn_fb_1 = explode(";", trim($this->auth_sn_fb));
  } 
  else
  {
      if (empty($this->auth_sn_fb))
      {
          $this->auth_sn_fb_1= array(); 
          $this->auth_sn_fb= "N";
      } 
      else
      {
          $this->auth_sn_fb_1= $this->auth_sn_fb; 
          $this->auth_sn_fb= ""; 
          foreach ($this->auth_sn_fb_1 as $cada_auth_sn_fb)
          {
             if (!empty($auth_sn_fb))
             {
                 $this->auth_sn_fb.= ";"; 
             } 
             $this->auth_sn_fb.= $cada_auth_sn_fb; 
          } 
      } 
  } 
?> 

    <TD class="scFormLabelOdd scUiLabelWidthFix css_auth_sn_fb_label" id="hidden_field_label_auth_sn_fb" style="<?php echo $sStyleHidden_auth_sn_fb; ?>"><span id="id_label_auth_sn_fb"><?php echo $this->nm_new_label['auth_sn_fb']; ?></span></TD>
    <TD class="scFormDataOdd css_auth_sn_fb_line" id="hidden_field_data_auth_sn_fb" style="<?php echo $sStyleHidden_auth_sn_fb; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["auth_sn_fb"]) &&  $this->nmgp_cmp_readonly["auth_sn_fb"] == "on") { 

$auth_sn_fb_look = "";
 if ($this->auth_sn_fb == "Y") { $auth_sn_fb_look .= "" ;} 
 if (empty($auth_sn_fb_look)) { $auth_sn_fb_look = $this->auth_sn_fb; }
?>
<input type="hidden" name="auth_sn_fb" value="<?php echo $this->form_encode_input($auth_sn_fb) . "\">" . $auth_sn_fb_look . ""; ?>
<?php } else { ?>

<?php

$auth_sn_fb_look = "";
 if ($this->auth_sn_fb == "Y") { $auth_sn_fb_look .= "" ;} 
 if (empty($auth_sn_fb_look)) { $auth_sn_fb_look = $this->auth_sn_fb; }
?>
<span id="id_read_on_auth_sn_fb" class="css_auth_sn_fb_line" style="<?php echo $sStyleReadLab_auth_sn_fb; ?>"><?php echo $this->form_format_readonly("auth_sn_fb", $this->form_encode_input($auth_sn_fb_look)); ?></span><span id="id_read_off_auth_sn_fb" class="css_read_off_auth_sn_fb css_auth_sn_fb_line" style="<?php echo $sStyleReadInp_auth_sn_fb; ?>"><?php echo "<div id=\"idAjaxCheckbox_auth_sn_fb\" style=\"display: inline-block\" class=\"css_auth_sn_fb_line\">\r\n"; ?><TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_auth_sn_fb_line"><?php $tempOptionId = "id-opt-auth_sn_fb" . $sc_seq_vert . "-1"; ?>
 <div class="sc switch">
 <input type=checkbox id="<?php echo $tempOptionId ?>" class="sc-ui-checkbox-auth_sn_fb sc-ui-checkbox-auth_sn_fb" name="auth_sn_fb[]" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_auth_sn_fb'][] = 'Y'; ?>
<?php  if (in_array("Y", $this->auth_sn_fb_1))  { echo " checked" ;} ?> onClick="do_ajax_app_settings_event_auth_sn_fb_onclick();" ><span></span>
<label for="<?php echo $tempOptionId ?>"></label> </div>
</TD>
</TR></TABLE>
<?php echo "</div>\r\n"; ?></span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['auth_sn_fb_app_id']))
    {
        $this->nm_new_label['auth_sn_fb_app_id'] = "APP ID";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $auth_sn_fb_app_id = $this->auth_sn_fb_app_id;
   $sStyleHidden_auth_sn_fb_app_id = '';
   if (isset($this->nmgp_cmp_hidden['auth_sn_fb_app_id']) && $this->nmgp_cmp_hidden['auth_sn_fb_app_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['auth_sn_fb_app_id']);
       $sStyleHidden_auth_sn_fb_app_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_auth_sn_fb_app_id = 'display: none;';
   $sStyleReadInp_auth_sn_fb_app_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['auth_sn_fb_app_id']) && $this->nmgp_cmp_readonly['auth_sn_fb_app_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['auth_sn_fb_app_id']);
       $sStyleReadLab_auth_sn_fb_app_id = '';
       $sStyleReadInp_auth_sn_fb_app_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['auth_sn_fb_app_id']) && $this->nmgp_cmp_hidden['auth_sn_fb_app_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="auth_sn_fb_app_id" value="<?php echo $this->form_encode_input($auth_sn_fb_app_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_auth_sn_fb_app_id_label" id="hidden_field_label_auth_sn_fb_app_id" style="<?php echo $sStyleHidden_auth_sn_fb_app_id; ?>"><span id="id_label_auth_sn_fb_app_id"><?php echo $this->nm_new_label['auth_sn_fb_app_id']; ?></span></TD>
    <TD class="scFormDataOdd css_auth_sn_fb_app_id_line" id="hidden_field_data_auth_sn_fb_app_id" style="<?php echo $sStyleHidden_auth_sn_fb_app_id; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["auth_sn_fb_app_id"]) &&  $this->nmgp_cmp_readonly["auth_sn_fb_app_id"] == "on") { 

 ?>
<input type="hidden" name="auth_sn_fb_app_id" value="<?php echo $this->form_encode_input($auth_sn_fb_app_id) . "\">" . $auth_sn_fb_app_id . ""; ?>
<?php } else { ?>
<span id="id_read_on_auth_sn_fb_app_id" class="sc-ui-readonly-auth_sn_fb_app_id css_auth_sn_fb_app_id_line" style="<?php echo $sStyleReadLab_auth_sn_fb_app_id; ?>"><?php echo $this->form_format_readonly("auth_sn_fb_app_id", $this->form_encode_input($this->auth_sn_fb_app_id)); ?></span><span id="id_read_off_auth_sn_fb_app_id" class="css_read_off_auth_sn_fb_app_id<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_auth_sn_fb_app_id; ?>">
 <input class="sc-js-input scFormObjectOdd css_auth_sn_fb_app_id_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_auth_sn_fb_app_id" type=text name="auth_sn_fb_app_id" value="<?php echo $this->form_encode_input($auth_sn_fb_app_id) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['auth_sn_fb_secret']))
    {
        $this->nm_new_label['auth_sn_fb_secret'] = "Secret";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $auth_sn_fb_secret = $this->auth_sn_fb_secret;
   $sStyleHidden_auth_sn_fb_secret = '';
   if (isset($this->nmgp_cmp_hidden['auth_sn_fb_secret']) && $this->nmgp_cmp_hidden['auth_sn_fb_secret'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['auth_sn_fb_secret']);
       $sStyleHidden_auth_sn_fb_secret = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_auth_sn_fb_secret = 'display: none;';
   $sStyleReadInp_auth_sn_fb_secret = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['auth_sn_fb_secret']) && $this->nmgp_cmp_readonly['auth_sn_fb_secret'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['auth_sn_fb_secret']);
       $sStyleReadLab_auth_sn_fb_secret = '';
       $sStyleReadInp_auth_sn_fb_secret = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['auth_sn_fb_secret']) && $this->nmgp_cmp_hidden['auth_sn_fb_secret'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="auth_sn_fb_secret" value="<?php echo $this->form_encode_input($auth_sn_fb_secret) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_auth_sn_fb_secret_label" id="hidden_field_label_auth_sn_fb_secret" style="<?php echo $sStyleHidden_auth_sn_fb_secret; ?>"><span id="id_label_auth_sn_fb_secret"><?php echo $this->nm_new_label['auth_sn_fb_secret']; ?></span></TD>
    <TD class="scFormDataOdd css_auth_sn_fb_secret_line" id="hidden_field_data_auth_sn_fb_secret" style="<?php echo $sStyleHidden_auth_sn_fb_secret; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["auth_sn_fb_secret"]) &&  $this->nmgp_cmp_readonly["auth_sn_fb_secret"] == "on") { 

 ?>
<input type="hidden" name="auth_sn_fb_secret" value="<?php echo $this->form_encode_input($auth_sn_fb_secret) . "\">" . $auth_sn_fb_secret . ""; ?>
<?php } else { ?>
<span id="id_read_on_auth_sn_fb_secret" class="sc-ui-readonly-auth_sn_fb_secret css_auth_sn_fb_secret_line" style="<?php echo $sStyleReadLab_auth_sn_fb_secret; ?>"><?php echo $this->form_format_readonly("auth_sn_fb_secret", $this->form_encode_input($this->auth_sn_fb_secret)); ?></span><span id="id_read_off_auth_sn_fb_secret" class="css_read_off_auth_sn_fb_secret<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_auth_sn_fb_secret; ?>">
 <input class="sc-js-input scFormObjectOdd css_auth_sn_fb_secret_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_auth_sn_fb_secret" type=text name="auth_sn_fb_secret" value="<?php echo $this->form_encode_input($auth_sn_fb_secret) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['auth_sn_x']))
   {
       $this->nm_new_label['auth_sn_x'] = "X (Twitter)";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $auth_sn_x = $this->auth_sn_x;
   $sStyleHidden_auth_sn_x = '';
   if (isset($this->nmgp_cmp_hidden['auth_sn_x']) && $this->nmgp_cmp_hidden['auth_sn_x'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['auth_sn_x']);
       $sStyleHidden_auth_sn_x = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_auth_sn_x = 'display: none;';
   $sStyleReadInp_auth_sn_x = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['auth_sn_x']) && $this->nmgp_cmp_readonly['auth_sn_x'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['auth_sn_x']);
       $sStyleReadLab_auth_sn_x = '';
       $sStyleReadInp_auth_sn_x = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['auth_sn_x']) && $this->nmgp_cmp_hidden['auth_sn_x'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="auth_sn_x" value="<?php echo $this->form_encode_input($this->auth_sn_x) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php 
  if ($this->nmgp_opcao != "recarga") 
  {
      $this->auth_sn_x_1 = explode(";", trim($this->auth_sn_x));
  } 
  else
  {
      if (empty($this->auth_sn_x))
      {
          $this->auth_sn_x_1= array(); 
          $this->auth_sn_x= "N";
      } 
      else
      {
          $this->auth_sn_x_1= $this->auth_sn_x; 
          $this->auth_sn_x= ""; 
          foreach ($this->auth_sn_x_1 as $cada_auth_sn_x)
          {
             if (!empty($auth_sn_x))
             {
                 $this->auth_sn_x.= ";"; 
             } 
             $this->auth_sn_x.= $cada_auth_sn_x; 
          } 
      } 
  } 
?> 

    <TD class="scFormLabelOdd scUiLabelWidthFix css_auth_sn_x_label" id="hidden_field_label_auth_sn_x" style="<?php echo $sStyleHidden_auth_sn_x; ?>"><span id="id_label_auth_sn_x"><?php echo $this->nm_new_label['auth_sn_x']; ?></span></TD>
    <TD class="scFormDataOdd css_auth_sn_x_line" id="hidden_field_data_auth_sn_x" style="<?php echo $sStyleHidden_auth_sn_x; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["auth_sn_x"]) &&  $this->nmgp_cmp_readonly["auth_sn_x"] == "on") { 

$auth_sn_x_look = "";
 if ($this->auth_sn_x == "Y") { $auth_sn_x_look .= "" ;} 
 if (empty($auth_sn_x_look)) { $auth_sn_x_look = $this->auth_sn_x; }
?>
<input type="hidden" name="auth_sn_x" value="<?php echo $this->form_encode_input($auth_sn_x) . "\">" . $auth_sn_x_look . ""; ?>
<?php } else { ?>

<?php

$auth_sn_x_look = "";
 if ($this->auth_sn_x == "Y") { $auth_sn_x_look .= "" ;} 
 if (empty($auth_sn_x_look)) { $auth_sn_x_look = $this->auth_sn_x; }
?>
<span id="id_read_on_auth_sn_x" class="css_auth_sn_x_line" style="<?php echo $sStyleReadLab_auth_sn_x; ?>"><?php echo $this->form_format_readonly("auth_sn_x", $this->form_encode_input($auth_sn_x_look)); ?></span><span id="id_read_off_auth_sn_x" class="css_read_off_auth_sn_x css_auth_sn_x_line" style="<?php echo $sStyleReadInp_auth_sn_x; ?>"><?php echo "<div id=\"idAjaxCheckbox_auth_sn_x\" style=\"display: inline-block\" class=\"css_auth_sn_x_line\">\r\n"; ?><TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_auth_sn_x_line"><?php $tempOptionId = "id-opt-auth_sn_x" . $sc_seq_vert . "-1"; ?>
 <div class="sc switch">
 <input type=checkbox id="<?php echo $tempOptionId ?>" class="sc-ui-checkbox-auth_sn_x sc-ui-checkbox-auth_sn_x" name="auth_sn_x[]" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_auth_sn_x'][] = 'Y'; ?>
<?php  if (in_array("Y", $this->auth_sn_x_1))  { echo " checked" ;} ?> onClick="do_ajax_app_settings_event_auth_sn_x_onclick();" ><span></span>
<label for="<?php echo $tempOptionId ?>"></label> </div>
</TD>
</TR></TABLE>
<?php echo "</div>\r\n"; ?></span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['auth_sn_x_key']))
    {
        $this->nm_new_label['auth_sn_x_key'] = "Key";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $auth_sn_x_key = $this->auth_sn_x_key;
   $sStyleHidden_auth_sn_x_key = '';
   if (isset($this->nmgp_cmp_hidden['auth_sn_x_key']) && $this->nmgp_cmp_hidden['auth_sn_x_key'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['auth_sn_x_key']);
       $sStyleHidden_auth_sn_x_key = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_auth_sn_x_key = 'display: none;';
   $sStyleReadInp_auth_sn_x_key = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['auth_sn_x_key']) && $this->nmgp_cmp_readonly['auth_sn_x_key'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['auth_sn_x_key']);
       $sStyleReadLab_auth_sn_x_key = '';
       $sStyleReadInp_auth_sn_x_key = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['auth_sn_x_key']) && $this->nmgp_cmp_hidden['auth_sn_x_key'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="auth_sn_x_key" value="<?php echo $this->form_encode_input($auth_sn_x_key) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_auth_sn_x_key_label" id="hidden_field_label_auth_sn_x_key" style="<?php echo $sStyleHidden_auth_sn_x_key; ?>"><span id="id_label_auth_sn_x_key"><?php echo $this->nm_new_label['auth_sn_x_key']; ?></span></TD>
    <TD class="scFormDataOdd css_auth_sn_x_key_line" id="hidden_field_data_auth_sn_x_key" style="<?php echo $sStyleHidden_auth_sn_x_key; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["auth_sn_x_key"]) &&  $this->nmgp_cmp_readonly["auth_sn_x_key"] == "on") { 

 ?>
<input type="hidden" name="auth_sn_x_key" value="<?php echo $this->form_encode_input($auth_sn_x_key) . "\">" . $auth_sn_x_key . ""; ?>
<?php } else { ?>
<span id="id_read_on_auth_sn_x_key" class="sc-ui-readonly-auth_sn_x_key css_auth_sn_x_key_line" style="<?php echo $sStyleReadLab_auth_sn_x_key; ?>"><?php echo $this->form_format_readonly("auth_sn_x_key", $this->form_encode_input($this->auth_sn_x_key)); ?></span><span id="id_read_off_auth_sn_x_key" class="css_read_off_auth_sn_x_key<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_auth_sn_x_key; ?>">
 <input class="sc-js-input scFormObjectOdd css_auth_sn_x_key_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_auth_sn_x_key" type=text name="auth_sn_x_key" value="<?php echo $this->form_encode_input($auth_sn_x_key) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['auth_sn_x_secret']))
    {
        $this->nm_new_label['auth_sn_x_secret'] = "Secret";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $auth_sn_x_secret = $this->auth_sn_x_secret;
   $sStyleHidden_auth_sn_x_secret = '';
   if (isset($this->nmgp_cmp_hidden['auth_sn_x_secret']) && $this->nmgp_cmp_hidden['auth_sn_x_secret'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['auth_sn_x_secret']);
       $sStyleHidden_auth_sn_x_secret = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_auth_sn_x_secret = 'display: none;';
   $sStyleReadInp_auth_sn_x_secret = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['auth_sn_x_secret']) && $this->nmgp_cmp_readonly['auth_sn_x_secret'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['auth_sn_x_secret']);
       $sStyleReadLab_auth_sn_x_secret = '';
       $sStyleReadInp_auth_sn_x_secret = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['auth_sn_x_secret']) && $this->nmgp_cmp_hidden['auth_sn_x_secret'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="auth_sn_x_secret" value="<?php echo $this->form_encode_input($auth_sn_x_secret) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_auth_sn_x_secret_label" id="hidden_field_label_auth_sn_x_secret" style="<?php echo $sStyleHidden_auth_sn_x_secret; ?>"><span id="id_label_auth_sn_x_secret"><?php echo $this->nm_new_label['auth_sn_x_secret']; ?></span></TD>
    <TD class="scFormDataOdd css_auth_sn_x_secret_line" id="hidden_field_data_auth_sn_x_secret" style="<?php echo $sStyleHidden_auth_sn_x_secret; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["auth_sn_x_secret"]) &&  $this->nmgp_cmp_readonly["auth_sn_x_secret"] == "on") { 

 ?>
<input type="hidden" name="auth_sn_x_secret" value="<?php echo $this->form_encode_input($auth_sn_x_secret) . "\">" . $auth_sn_x_secret . ""; ?>
<?php } else { ?>
<span id="id_read_on_auth_sn_x_secret" class="sc-ui-readonly-auth_sn_x_secret css_auth_sn_x_secret_line" style="<?php echo $sStyleReadLab_auth_sn_x_secret; ?>"><?php echo $this->form_format_readonly("auth_sn_x_secret", $this->form_encode_input($this->auth_sn_x_secret)); ?></span><span id="id_read_off_auth_sn_x_secret" class="css_read_off_auth_sn_x_secret<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_auth_sn_x_secret; ?>">
 <input class="sc-js-input scFormObjectOdd css_auth_sn_x_secret_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_auth_sn_x_secret" type=text name="auth_sn_x_secret" value="<?php echo $this->form_encode_input($auth_sn_x_secret) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['auth_sn_google']))
   {
       $this->nm_new_label['auth_sn_google'] = "Google";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $auth_sn_google = $this->auth_sn_google;
   $sStyleHidden_auth_sn_google = '';
   if (isset($this->nmgp_cmp_hidden['auth_sn_google']) && $this->nmgp_cmp_hidden['auth_sn_google'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['auth_sn_google']);
       $sStyleHidden_auth_sn_google = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_auth_sn_google = 'display: none;';
   $sStyleReadInp_auth_sn_google = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['auth_sn_google']) && $this->nmgp_cmp_readonly['auth_sn_google'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['auth_sn_google']);
       $sStyleReadLab_auth_sn_google = '';
       $sStyleReadInp_auth_sn_google = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['auth_sn_google']) && $this->nmgp_cmp_hidden['auth_sn_google'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="auth_sn_google" value="<?php echo $this->form_encode_input($this->auth_sn_google) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php 
  if ($this->nmgp_opcao != "recarga") 
  {
      $this->auth_sn_google_1 = explode(";", trim($this->auth_sn_google));
  } 
  else
  {
      if (empty($this->auth_sn_google))
      {
          $this->auth_sn_google_1= array(); 
          $this->auth_sn_google= "N";
      } 
      else
      {
          $this->auth_sn_google_1= $this->auth_sn_google; 
          $this->auth_sn_google= ""; 
          foreach ($this->auth_sn_google_1 as $cada_auth_sn_google)
          {
             if (!empty($auth_sn_google))
             {
                 $this->auth_sn_google.= ";"; 
             } 
             $this->auth_sn_google.= $cada_auth_sn_google; 
          } 
      } 
  } 
?> 

    <TD class="scFormLabelOdd scUiLabelWidthFix css_auth_sn_google_label" id="hidden_field_label_auth_sn_google" style="<?php echo $sStyleHidden_auth_sn_google; ?>"><span id="id_label_auth_sn_google"><?php echo $this->nm_new_label['auth_sn_google']; ?></span></TD>
    <TD class="scFormDataOdd css_auth_sn_google_line" id="hidden_field_data_auth_sn_google" style="<?php echo $sStyleHidden_auth_sn_google; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["auth_sn_google"]) &&  $this->nmgp_cmp_readonly["auth_sn_google"] == "on") { 

$auth_sn_google_look = "";
 if ($this->auth_sn_google == "Y") { $auth_sn_google_look .= "" ;} 
 if (empty($auth_sn_google_look)) { $auth_sn_google_look = $this->auth_sn_google; }
?>
<input type="hidden" name="auth_sn_google" value="<?php echo $this->form_encode_input($auth_sn_google) . "\">" . $auth_sn_google_look . ""; ?>
<?php } else { ?>

<?php

$auth_sn_google_look = "";
 if ($this->auth_sn_google == "Y") { $auth_sn_google_look .= "" ;} 
 if (empty($auth_sn_google_look)) { $auth_sn_google_look = $this->auth_sn_google; }
?>
<span id="id_read_on_auth_sn_google" class="css_auth_sn_google_line" style="<?php echo $sStyleReadLab_auth_sn_google; ?>"><?php echo $this->form_format_readonly("auth_sn_google", $this->form_encode_input($auth_sn_google_look)); ?></span><span id="id_read_off_auth_sn_google" class="css_read_off_auth_sn_google css_auth_sn_google_line" style="<?php echo $sStyleReadInp_auth_sn_google; ?>"><?php echo "<div id=\"idAjaxCheckbox_auth_sn_google\" style=\"display: inline-block\" class=\"css_auth_sn_google_line\">\r\n"; ?><TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_auth_sn_google_line"><?php $tempOptionId = "id-opt-auth_sn_google" . $sc_seq_vert . "-1"; ?>
 <div class="sc switch">
 <input type=checkbox id="<?php echo $tempOptionId ?>" class="sc-ui-checkbox-auth_sn_google sc-ui-checkbox-auth_sn_google" name="auth_sn_google[]" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['Lookup_auth_sn_google'][] = 'Y'; ?>
<?php  if (in_array("Y", $this->auth_sn_google_1))  { echo " checked" ;} ?> onClick="do_ajax_app_settings_event_auth_sn_google_onclick();" ><span></span>
<label for="<?php echo $tempOptionId ?>"></label> </div>
</TD>
</TR></TABLE>
<?php echo "</div>\r\n"; ?></span><?php  }?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['auth_sn_google_client_id']))
    {
        $this->nm_new_label['auth_sn_google_client_id'] = "Client ID";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $auth_sn_google_client_id = $this->auth_sn_google_client_id;
   $sStyleHidden_auth_sn_google_client_id = '';
   if (isset($this->nmgp_cmp_hidden['auth_sn_google_client_id']) && $this->nmgp_cmp_hidden['auth_sn_google_client_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['auth_sn_google_client_id']);
       $sStyleHidden_auth_sn_google_client_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_auth_sn_google_client_id = 'display: none;';
   $sStyleReadInp_auth_sn_google_client_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['auth_sn_google_client_id']) && $this->nmgp_cmp_readonly['auth_sn_google_client_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['auth_sn_google_client_id']);
       $sStyleReadLab_auth_sn_google_client_id = '';
       $sStyleReadInp_auth_sn_google_client_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['auth_sn_google_client_id']) && $this->nmgp_cmp_hidden['auth_sn_google_client_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="auth_sn_google_client_id" value="<?php echo $this->form_encode_input($auth_sn_google_client_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_auth_sn_google_client_id_label" id="hidden_field_label_auth_sn_google_client_id" style="<?php echo $sStyleHidden_auth_sn_google_client_id; ?>"><span id="id_label_auth_sn_google_client_id"><?php echo $this->nm_new_label['auth_sn_google_client_id']; ?></span></TD>
    <TD class="scFormDataOdd css_auth_sn_google_client_id_line" id="hidden_field_data_auth_sn_google_client_id" style="<?php echo $sStyleHidden_auth_sn_google_client_id; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["auth_sn_google_client_id"]) &&  $this->nmgp_cmp_readonly["auth_sn_google_client_id"] == "on") { 

 ?>
<input type="hidden" name="auth_sn_google_client_id" value="<?php echo $this->form_encode_input($auth_sn_google_client_id) . "\">" . $auth_sn_google_client_id . ""; ?>
<?php } else { ?>
<span id="id_read_on_auth_sn_google_client_id" class="sc-ui-readonly-auth_sn_google_client_id css_auth_sn_google_client_id_line" style="<?php echo $sStyleReadLab_auth_sn_google_client_id; ?>"><?php echo $this->form_format_readonly("auth_sn_google_client_id", $this->form_encode_input($this->auth_sn_google_client_id)); ?></span><span id="id_read_off_auth_sn_google_client_id" class="css_read_off_auth_sn_google_client_id<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_auth_sn_google_client_id; ?>">
 <input class="sc-js-input scFormObjectOdd css_auth_sn_google_client_id_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_auth_sn_google_client_id" type=text name="auth_sn_google_client_id" value="<?php echo $this->form_encode_input($auth_sn_google_client_id) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['auth_sn_google_secret']))
    {
        $this->nm_new_label['auth_sn_google_secret'] = "Secret";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $auth_sn_google_secret = $this->auth_sn_google_secret;
   $sStyleHidden_auth_sn_google_secret = '';
   if (isset($this->nmgp_cmp_hidden['auth_sn_google_secret']) && $this->nmgp_cmp_hidden['auth_sn_google_secret'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['auth_sn_google_secret']);
       $sStyleHidden_auth_sn_google_secret = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_auth_sn_google_secret = 'display: none;';
   $sStyleReadInp_auth_sn_google_secret = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['auth_sn_google_secret']) && $this->nmgp_cmp_readonly['auth_sn_google_secret'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['auth_sn_google_secret']);
       $sStyleReadLab_auth_sn_google_secret = '';
       $sStyleReadInp_auth_sn_google_secret = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['auth_sn_google_secret']) && $this->nmgp_cmp_hidden['auth_sn_google_secret'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="auth_sn_google_secret" value="<?php echo $this->form_encode_input($auth_sn_google_secret) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_auth_sn_google_secret_label" id="hidden_field_label_auth_sn_google_secret" style="<?php echo $sStyleHidden_auth_sn_google_secret; ?>"><span id="id_label_auth_sn_google_secret"><?php echo $this->nm_new_label['auth_sn_google_secret']; ?></span></TD>
    <TD class="scFormDataOdd css_auth_sn_google_secret_line" id="hidden_field_data_auth_sn_google_secret" style="<?php echo $sStyleHidden_auth_sn_google_secret; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["auth_sn_google_secret"]) &&  $this->nmgp_cmp_readonly["auth_sn_google_secret"] == "on") { 

 ?>
<input type="hidden" name="auth_sn_google_secret" value="<?php echo $this->form_encode_input($auth_sn_google_secret) . "\">" . $auth_sn_google_secret . ""; ?>
<?php } else { ?>
<span id="id_read_on_auth_sn_google_secret" class="sc-ui-readonly-auth_sn_google_secret css_auth_sn_google_secret_line" style="<?php echo $sStyleReadLab_auth_sn_google_secret; ?>"><?php echo $this->form_format_readonly("auth_sn_google_secret", $this->form_encode_input($this->auth_sn_google_secret)); ?></span><span id="id_read_off_auth_sn_google_secret" class="css_read_off_auth_sn_google_secret<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_auth_sn_google_secret; ?>">
 <input class="sc-js-input scFormObjectOdd css_auth_sn_google_secret_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_auth_sn_google_secret" type=text name="auth_sn_google_secret" value="<?php echo $this->form_encode_input($auth_sn_google_secret) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } ?>
</TABLE></div><!-- bloco_f -->
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
    $NM_btn = false;
?>
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
        $sCondStyle = ($this->nmgp_botoes['ok'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_disabled']['ok']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_disabled']['ok']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_label']['ok']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_label']['ok']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_label']['ok'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bok", "scBtnFn_sys_format_ok()", "scBtnFn_sys_format_ok()", "sub_form_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
?>
       
<?php
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
?>
       
<?php
    if (($nm_apl_dependente != 1) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['dashboard_info']['under_dashboard'])) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['nm_run_menu']) || $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['nm_run_menu'] != 1))) {
        $sCondStyle = ($this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "Bsair_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
?>
       
<?php
    if (($nm_apl_dependente == 1) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "Bsair_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
?>
            </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
</td></tr> 
</table> 
</div> 
</td> 
</tr> 
</table> 

<div id="id_debug_window" style="display: none;" class='scDebugWindow'><table class="scFormMessageTable">
<tr><td class="scFormMessageTitle"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideDebug()", "scAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
&nbsp;&nbsp;Output</td></tr>
<tr><td class="scFormMessageMessage" style="padding: 0px; vertical-align: top"><div style="padding: 2px; height: 200px; width: 350px; overflow: auto" id="id_debug_text"></div></td></tr>
</table></div>

</form> 
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0,1,2,3,4,5);
  $nm_sc_blocos_aba    = array(0 => 0,1 => 0,2 => 0,3 => 0,4 => 0,5 => 0);
  foreach ($this->Ini->nm_hidden_blocos as $bloco => $hidden)
  {
      if ($hidden == "off" && in_array($bloco, $nm_sc_blocos_da_pag))
      {
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.display = 'none';";
          if (isset($nm_sc_blocos_aba[$bloco]))
          {
               echo "document.getElementById('id_tabs_" . $nm_sc_blocos_aba[$bloco] . "_" . $bloco . "').style.display = 'none';";
          }
      }
  }
?>
</script> 
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['masterValue']);
?>
}
<?php
    }
}
?>
function updateHeaderFooter(sFldName, sFldValue)
{
  if (sFldValue[0] && sFldValue[0]["value"])
  {
    sFldValue = sFldValue[0]["value"];
  }
}
</script>
<?php
if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("app_settings");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("app_settings");
 parent.scAjaxDetailHeight("app_settings", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("app_settings", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("app_settings", <?php echo $sTamanhoIframe; ?>);
 }
</script>
<?php
    }
}
?>
<?php
if (isset($this->NM_ajax_info['displayMsg']) && $this->NM_ajax_info['displayMsg'])
{
    $isToast   = isset($this->NM_ajax_info['displayMsgToast']) && $this->NM_ajax_info['displayMsgToast'] ? 'true' : 'false';
    $toastType = $isToast && isset($this->NM_ajax_info['displayMsgToastType']) ? $this->NM_ajax_info['displayMsgToastType'] : '';
?>
<script type="text/javascript">
_scAjaxShowMessage({title: scMsgDefTitle, message: "<?php echo $this->NM_ajax_info['displayMsgTxt']; ?>", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: <?php echo $isToast ?>, toastPos: "", type: "<?php echo $toastType ?>"});
</script>
<?php
}
?>
<?php
if (isset($this->scFormFocusErrorName) && '' != $this->scFormFocusErrorName)
{
?>
<script>
scAjaxFocusError();
</script>
<?php
}
?>
<script type='text/javascript'>
bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
function scLigEditLookupCall()
{
<?php
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['sc_modal'])
{
?>
  parent.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
elseif ($this->lig_edit_lookup)
{
?>
  opener.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
?>
}
if (bLigEditLookupCall)
{
  scLigEditLookupCall();
}
<?php
if (isset($this->redir_modal) && !empty($this->redir_modal))
{
    echo $this->redir_modal;
}
?>
</script>
<?php
if ($this->nmgp_form_empty) {
?>
<script type="text/javascript">
scAjax_displayEmptyForm();
</script>
<?php
}
?>
<script type="text/javascript">
        function scBtnFn_sys_format_ok() {
                if ($("#sub_form_b.sc-unique-btn-1").length && $("#sub_form_b.sc-unique-btn-1").is(":visible")) {
                    if ($("#sub_form_b.sc-unique-btn-1").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza('alterar');
                         return;
                }
        }
        function scBtnFn_sys_format_hlp() {
                if ($("#sc_b_hlp_b").length && $("#sc_b_hlp_b").is(":visible")) {
                    if ($("#sc_b_hlp_b").hasClass("disabled")) {
                        return;
                    }
                        window.open('<?php echo $this->url_webhelp; ?>', '', 'resizable, scrollbars'); 
                         return;
                }
        }
        function scBtnFn_sys_format_sai() {
                if ($("#Bsair_b.sc-unique-btn-2").length && $("#Bsair_b.sc-unique-btn-2").is(":visible")) {
                    if ($("#Bsair_b.sc-unique-btn-2").hasClass("disabled")) {
                        return;
                    }
                        nm_saida_glo(); return false;
                         return;
                }
                if ($("#Bsair_b.sc-unique-btn-3").length && $("#Bsair_b.sc-unique-btn-3").is(":visible")) {
                    if ($("#Bsair_b.sc-unique-btn-3").hasClass("disabled")) {
                        return;
                    }
                        nm_saida_glo(); return false;
                         return;
                }
        }
</script>
<script type="text/javascript">
$(function() {
 $("#sc-id-mobile-in").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("in");
 });
 $("#sc-id-mobile-out").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("out");
 });
});
function scMobileDisplayControl(sOption) {
 $("#sc-id-mobile-control").val(sOption);
 nm_atualiza("recarga_mobile");
}
</script>
<?php
       if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'])
       {
?>
<span id="sc-id-mobile-in"><?php echo $this->Ini->Nm_lang['lang_version_mobile']; ?></span>
<?php
       }
?>
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['app_settings']['buttonStatus'] = $this->nmgp_botoes;
?>
<script type="text/javascript">
   function sc_session_redir(url_redir)
   {
       if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')
       {
           window.parent.sc_session_redir(url_redir);
       }
       else
       {
           if (window.opener && typeof window.opener.sc_session_redir === 'function')
           {
               window.close();
               window.opener.sc_session_redir(url_redir);
           }
           else
           {
               window.location = url_redir;
           }
       }
   }
</script>
</body> 
</html> 
