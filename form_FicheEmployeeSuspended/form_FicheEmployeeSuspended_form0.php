<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    $sOBContents = ob_get_contents();
    ob_end_clean();
}

header("X-XSS-Protection: 1; mode=block");
header("X-Frame-Options: SAMEORIGIN");

?>
<!DOCTYPE html>

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("Employee Sheet"); } else { echo strip_tags("Employee Sheet"); } ?></TITLE>
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
                       'navigationBarButtons' => unserialize('a:3:{i:0;s:2:"NP";i:1;s:2:"FL";i:2;s:2:"RC";}'),
                       'mobileSimpleToolbar' => true,
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
<style type="text/css">
.ui-datepicker { z-index: 6 !important }
</style>
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
<?php
$miniCalendarFA = $this->jqueryFAFile('calendar');
if ('' != $miniCalendarFA) {
?>
<style type="text/css">
.css_read_off_dob button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_hiredate button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_firedate button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_date_loan button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_date_payment button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_loan_start_deduct button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_loan_end_deduct button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_date_loan_bank button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_loan_start_deduct_bank button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_loan_end_deduct_bank button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_date_other_loan button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_other_loan_start_deduct button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_other_loan_end_deduct button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_date_purchase button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_purchase_start_deduct button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_purchase_end_deduct button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_update_time button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['link_info']['margin_top'] ?>;
}
</style>
<?php
}

?>

<link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/select2/css/select2.min.css" type="text/css" />
<script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/select2/js/select2.full.min.js"></script>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput2.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <?php
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_progressbar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_progressbar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_FicheEmployeeSuspended/form_FicheEmployeeSuspended_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_FicheEmployeeSuspended_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['last'] : 'off'); ?>";
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
function summary_atualiza(reg_ini, reg_qtd, reg_tot)
{
    nm_sumario = "[<?php echo substr($this->Ini->Nm_lang['lang_othr_smry_info'], strpos($this->Ini->Nm_lang['lang_othr_smry_info'], "?final?")) ?>]";
    nm_sumario = nm_sumario.replace("?final?", reg_qtd);
    nm_sumario = nm_sumario.replace("?total?", reg_tot);
    if (reg_qtd < 1) {
        nm_sumario = "";
    }
    if (document.getElementById("sc_b_summary_b")) document.getElementById("sc_b_summary_b").innerHTML = nm_sumario;
}
function navpage_atualiza(str_navpage)
{
    if (document.getElementById("sc_b_navpage_b")) document.getElementById("sc_b_navpage_b").innerHTML = str_navpage;
}
<?php

include_once('form_FicheEmployeeSuspended_jquery.php');

?>
var applicationKeys = "";
applicationKeys += "ctrl+shift+right";
applicationKeys += ",";
applicationKeys += "ctrl+shift+left";
applicationKeys += ",";
applicationKeys += "ctrl+right";
applicationKeys += ",";
applicationKeys += "ctrl+left";
applicationKeys += ",";
applicationKeys += "alt+q";
applicationKeys += ",";
applicationKeys += "escape";
applicationKeys += ",";
applicationKeys += "ctrl+enter";
applicationKeys += ",";
applicationKeys += "ctrl+s";
applicationKeys += ",";
applicationKeys += "ctrl+delete";
applicationKeys += ",";
applicationKeys += "f1";
applicationKeys += ",";
applicationKeys += "ctrl+shift+c";

var hotkeyList = "";

function execHotKey(e, h) {
    var hotkey_fired = false;
  switch (true) {
    case (["ctrl+shift+right"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_fim");
      break;
    case (["ctrl+shift+left"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_ini");
      break;
    case (["ctrl+right"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_ava");
      break;
    case (["ctrl+left"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_ret");
      break;
    case (["alt+q"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_sai");
      break;
    case (["escape"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_cnl");
      break;
    case (["ctrl+enter"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_inc");
      break;
    case (["ctrl+s"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_alt");
      break;
    case (["ctrl+delete"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_exc");
      break;
    case (["f1"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_webh");
      break;
    case (["ctrl+shift+c"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_copy");
      break;
    default:
      return true;
  }
  if (hotkey_fired) {
        e.preventDefault();
        return false;
    } else {
        return true;
    }
}
</script>

<script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>hotkeys.inc.js"></script>
<script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>hotkeys_setup.js"></script>
<script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>frameControl.js"></script>
<script type="text/javascript">

function process_hotkeys(hotkey)
{
  if (hotkey == "sys_format_fim") {
    if (typeof scBtnFn_sys_format_fim !== "undefined" && typeof scBtnFn_sys_format_fim === "function") {
      scBtnFn_sys_format_fim();
        return true;
    }
  }
  if (hotkey == "sys_format_ini") {
    if (typeof scBtnFn_sys_format_ini !== "undefined" && typeof scBtnFn_sys_format_ini === "function") {
      scBtnFn_sys_format_ini();
        return true;
    }
  }
  if (hotkey == "sys_format_ava") {
    if (typeof scBtnFn_sys_format_ava !== "undefined" && typeof scBtnFn_sys_format_ava === "function") {
      scBtnFn_sys_format_ava();
        return true;
    }
  }
  if (hotkey == "sys_format_ret") {
    if (typeof scBtnFn_sys_format_ret !== "undefined" && typeof scBtnFn_sys_format_ret === "function") {
      scBtnFn_sys_format_ret();
        return true;
    }
  }
  if (hotkey == "sys_format_sai") {
    if (typeof scBtnFn_sys_format_sai !== "undefined" && typeof scBtnFn_sys_format_sai === "function") {
      scBtnFn_sys_format_sai();
        return true;
    }
  }
  if (hotkey == "sys_format_cnl") {
    if (typeof scBtnFn_sys_format_cnl !== "undefined" && typeof scBtnFn_sys_format_cnl === "function") {
      scBtnFn_sys_format_cnl();
        return true;
    }
  }
  if (hotkey == "sys_format_inc") {
    if (typeof scBtnFn_sys_format_inc !== "undefined" && typeof scBtnFn_sys_format_inc === "function") {
      scBtnFn_sys_format_inc();
        return true;
    }
  }
  if (hotkey == "sys_format_alt") {
    if (typeof scBtnFn_sys_format_alt !== "undefined" && typeof scBtnFn_sys_format_alt === "function") {
      scBtnFn_sys_format_alt();
        return true;
    }
  }
  if (hotkey == "sys_format_exc") {
    if (typeof scBtnFn_sys_format_exc !== "undefined" && typeof scBtnFn_sys_format_exc === "function") {
      scBtnFn_sys_format_exc();
        return true;
    }
  }
  if (hotkey == "sys_format_webh") {
    if (typeof scBtnFn_sys_format_webh !== "undefined" && typeof scBtnFn_sys_format_webh === "function") {
      scBtnFn_sys_format_webh();
        return true;
    }
  }
  if (hotkey == "sys_format_copy") {
    if (typeof scBtnFn_sys_format_copy !== "undefined" && typeof scBtnFn_sys_format_copy === "function") {
      scBtnFn_sys_format_copy();
        return true;
    }
  }
    return false;
}

 var Dyn_Ini  = true;
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

  $("#hidden_bloco_2,#hidden_bloco_3").each(function() {
   $(this.rows[0]).bind("click", {block: this}, toggleBlock)
                  .mouseover(function() { $(this).css("cursor", "pointer"); })
                  .mouseout(function() { $(this).css("cursor", ""); });
  });

  sc_form_onload();

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

  var i, iTestWidth, iMaxLabelWidth = 0, $labelList = $(".scUiLabelWidthFix");
  for (i = 0; i < $labelList.length; i++) {
    iTestWidth = $($labelList[i]).width();
    sTestWidth = iTestWidth + "";
    if ("" == iTestWidth) {
      iTestWidth = 0;
    }
    else if ("px" == sTestWidth.substr(sTestWidth.length - 2)) {
      iTestWidth = parseInt(sTestWidth.substr(0, sTestWidth.length - 2));
    }
    iMaxLabelWidth = Math.max(iMaxLabelWidth, iTestWidth);
  }
  if (0 < iMaxLabelWidth) {
    $(".scUiLabelWidthFix").css("width", iMaxLabelWidth + "px");
  }
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
     if ($('#t').length>0) {
         scQuickSearchKeyUp('t', null);
     }
     $("#fast_search_f0_t").select2({
        containerCssClass: 'scGridQuickSearchDivResult',
        dropdownCssClass: 'scGridQuickSearchDivDropdown',
        placeholder: '<?php echo $this->Ini->Nm_lang['lang_srch_all_fields'] ?>',
    });
     $("#cond_fast_search_f0_t").select2({
        containerCssClass: 'scGridQuickSearchDivResult',
        dropdownCssClass: 'scGridQuickSearchDivDropdown',
        minimumResultsForSearch: -1
    });
   });
   function scQuickSearchSubmit_t() {
     nm_move('fast_search', 't');
   }

   function scQuickSearchKeyUp(sPos, e) {
     if (null != e) {
       var keyPressed = e.charCode || e.keyCode || e.which;
       if (13 == keyPressed) {
         if ('t' == sPos) scQuickSearchSubmit_t();
       }
       else
       {
           $('#SC_fast_search_submit_'+sPos).show();
       }
     }
   }
   function nm_gp_submit_qsearch(pos)
   {
        nm_move('fast_search', pos);
   }
   function nm_gp_open_qsearch_div(pos)
   {
        if (typeof nm_gp_open_qsearch_div_mobile == 'function') {
            return nm_gp_open_qsearch_div_mobile(pos);
        }
        if($('#SC_fast_search_dropdown_' + pos).hasClass('fa-caret-down'))
        {
            if(($('#quicksearchph_' + pos).offset().top+$('#id_qs_div_' + pos).height()+10) >= $(document).height())
            {
                $('#id_qs_div_' + pos).offset({top:($('#quicksearchph_' + pos).offset().top-($('#quicksearchph_' + pos).height()/2)-$('#id_qs_div_' + pos).height()-4)});
            }

            nm_gp_open_qsearch_div_store_temp(pos);
            $('#SC_fast_search_dropdown_' + pos).removeClass('fa-caret-down').addClass('fa-caret-up');
        }
        else
        {
            $('#SC_fast_search_dropdown_' + pos).removeClass('fa-caret-up').addClass('fa-caret-down');
        }
        $('#id_qs_div_' + pos).toggle();
   }

   var tmp_qs_arr_fields = [], tmp_qs_arr_cond = "";
   function nm_gp_open_qsearch_div_store_temp(pos)
   {
        tmp_qs_arr_fields = [], tmp_qs_str_cond = "";

        if($('#fast_search_f0_' + pos).prop('type') == 'select-multiple')
        {
            tmp_qs_arr_fields = $('#fast_search_f0_' + pos).val();
        }
        else
        {
            tmp_qs_arr_fields.push($('#fast_search_f0_' + pos).val());
        }

        tmp_qs_str_cond = $('#cond_fast_search_f0_' + pos).val();
   }

   function nm_gp_cancel_qsearch_div_store_temp(pos)
   {
        $('#fast_search_f0_' + pos).val('');
        $("#fast_search_f0_" + pos + " option").prop('selected', false);
        for(it=0; it<tmp_qs_arr_fields.length; it++)
        {
            $("#fast_search_f0_" + pos + " option[value='"+ tmp_qs_arr_fields[it] +"']").prop('selected', true);
        }
        $("#fast_search_f0_" + pos).change();
        tmp_qs_arr_fields = [];

        $('#cond_fast_search_f0_' + pos).val(tmp_qs_str_cond);
        $('#cond_fast_search_f0_' + pos).change();
        tmp_qs_str_cond = "";

        nm_gp_open_qsearch_div(pos);
   } if($(".sc-ui-block-control").length) {
  preloadBlock = new Image();
  preloadBlock.src = "<?php echo $this->Ini->path_icones; ?>/" + sc_blockExp;
 }

 var show_block = {
    "hidden_bloco_2": true,
    "hidden_bloco_3": false
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

  for (var i = 1; i < block.rows.length; i++) {
   if (show_block[block_id])
    $(block.rows[i]).show();
   else
    $(block.rows[i]).hide();
  }

  if (show_block[block_id]) {
    if ("hidden_bloco_3" == block_id) {
      scAjaxDetailHeight("form_tbl_note_employee", "500");
    }
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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['recarga'];
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['link_info']['remove_border']) {
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
<body class="scFormPage sc-app-form" style="<?php echo $remove_margin . $remove_background . $str_iframe_body . $vertical_center; ?>">
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
 include_once("form_FicheEmployeeSuspended_js0.php");
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
<form  name="F1" method="post" enctype="multipart/form-data" 
               action="./" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['insert_validation']; ?>">
<?php
}
?>
<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_idioma_novo" value="">
<input type="hidden" name="nmgp_schema_f" value="">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="nmgp_ancora" value="">
<input type="hidden" name="nmgp_num_form" value="<?php  echo $this->form_encode_input($nmgp_num_form); ?>">
<input type="hidden" name="nmgp_parms" value="">
<input type="hidden" name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>">
<input type="hidden" name="NM_cancel_return_new" value="<?php echo $this->NM_cancel_return_new ?>">
<input type="hidden" name="csrf_token" value="<?php echo $this->scCsrfGetToken() ?>" />
<input type="hidden" name="upload_file_flag" value="">
<input type="hidden" name="upload_file_check" value="">
<input type="hidden" name="upload_file_name" value="">
<input type="hidden" name="upload_file_temp" value="">
<input type="hidden" name="upload_file_libs" value="">
<input type="hidden" name="upload_file_height" value="">
<input type="hidden" name="upload_file_width" value="">
<input type="hidden" name="upload_file_aspect" value="">
<input type="hidden" name="upload_file_type" value="">
<input type="hidden" name="photo_name_salva" value="<?php  echo $this->form_encode_input($this->photo_name) ?>">
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_FicheEmployeeSuspended'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_FicheEmployeeSuspended'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
?>
<div style="display: none; position: absolute; z-index: 1000" id="id_error_display_table_frame">
<table class="scFormErrorTable scFormToastTable">
<tr><?php if ($this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><td style="padding: 0px" rowspan="2"><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top"></td><?php } ?><td class="scFormErrorTitle scFormToastTitle"><table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormErrorTitleFont" style="padding: 0px; vertical-align: top; width: 100%"><?php if (!$this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top">&nbsp;<?php } ?><?php echo $this->Ini->Nm_lang['lang_errm_errt'] ?></td><td style="padding: 0px; vertical-align: top"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideErrorDisplay('table')", "scAjaxHideErrorDisplay('table')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
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
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0  width="100%">
 <tr>
  <td>
  <div class="scFormBorder" style="<?php echo (isset($remove_border) ? $remove_border : ''); ?>">
   <table width='100%' cellspacing=0 cellpadding=0>
<?php
$this->displayAppHeader();
?>
<tr><td>
<?php
$this->displayTopToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['fast_search'][2] : "";
          $stateSearchIconClose  = 'none';
          $stateSearchIconSearch = '';
          if(!empty($OPC_dat))
          {
              $stateSearchIconClose  = '';
              $stateSearchIconSearch = 'none';
          }
?> 
           <script type="text/javascript">var change_fast_t = "";</script>
          <span id="quicksearchph_t" class="scFormToolbarInput" style='display: inline-block; vertical-align: inherit'>
              <span>
                  <input type="text" id="SC_fast_search_t" class="scFormToolbarInputText" style="border-width: 0px;;" name="nmgp_arg_fast_search_t" value="<?php echo $this->form_encode_input($OPC_dat) ?>" size="10" onChange="change_fast_t = 'CH';" alt="{maxLength: 255}" placeholder="<?php echo $this->Ini->Nm_lang['lang_othr_qk_watermark'] ?>">&nbsp;
                  <i id='SC_fast_search_dropdown_t' style='cursor: pointer;' class='fas fa-caret-down' onclick="nm_gp_open_qsearch_div('t');"></i>
                  <img id="SC_fast_search_submit_t" class='css_toolbar_obj_qs_search_img' src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_search ?>" onclick="nm_gp_submit_qsearch('t');">
                  <img style="display: <?php echo $stateSearchIconClose ?>" class='css_toolbar_obj_qs_search_img' id="SC_fast_search_close_t" src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_clean ?>" onclick="document.getElementById('SC_fast_search_t').value = '__Clear_Fast__'; nm_move('fast_search', 't');">
              </span>
                  <div id='id_qs_div_t' class='scGridQuickSearchDivMoldura' style='display:none; position:absolute;'>
                                  <div>
                                      <span >
                                        <p class='scGridQuickSearchDivLabel'><?php echo $this->Ini->Nm_lang['lang_btns_clmn'] ?></span></p>
          <select id='fast_search_f0_t' multiple=multiple  class="scFormToolbarInput" style="vertical-align: middle;" name="nmgp_fast_search_t" onChange="change_fast_t = 'CH';">
<?php 
          $SC_Label_atu['SC_all_Cmp'] = $this->Ini->Nm_lang['lang_srch_all_fields']; 
          $SC_Label_atu['userid_int'] = (isset($this->nm_new_label['userid_int'])) ? $this->nm_new_label['userid_int'] : 'ID'; 
          $SC_Label_atu['employee_name'] = (isset($this->nm_new_label['employee_name'])) ? $this->nm_new_label['employee_name'] : '' . $this->Ini->Nm_lang['lang_username'] . ''; 
          $SC_Label_atu['ic'] = (isset($this->nm_new_label['ic'])) ? $this->nm_new_label['ic'] : 'National ID'; 
          $SC_Label_atu['designation'] = (isset($this->nm_new_label['designation'])) ? $this->nm_new_label['designation'] : '' . $this->Ini->Nm_lang['lang_designation'] . ''; 
          $SC_Label_atu['dept'] = (isset($this->nm_new_label['dept'])) ? $this->nm_new_label['dept'] : '' . $this->Ini->Nm_lang['lang_departement'] . ''; 
          $SC_Label_atu['gender'] = (isset($this->nm_new_label['gender'])) ? $this->nm_new_label['gender'] : '' . $this->Ini->Nm_lang['lang_gender'] . ''; 
          $SC_Label_atu['dob'] = (isset($this->nm_new_label['dob'])) ? $this->nm_new_label['dob'] : '' . $this->Ini->Nm_lang['lang_dob'] . ''; 
          $SC_Label_atu['address'] = (isset($this->nm_new_label['address'])) ? $this->nm_new_label['address'] : 'Address'; 
          $SC_Label_atu['phone'] = (isset($this->nm_new_label['phone'])) ? $this->nm_new_label['phone'] : '' . $this->Ini->Nm_lang['lang_phone'] . ''; 
          $SC_Label_atu['hiredate'] = (isset($this->nm_new_label['hiredate'])) ? $this->nm_new_label['hiredate'] : '' . $this->Ini->Nm_lang['lang_hiredate'] . ''; 
          $SC_Label_atu['email'] = (isset($this->nm_new_label['email'])) ? $this->nm_new_label['email'] : 'Email'; 
          $SC_Label_atu['firedate'] = (isset($this->nm_new_label['firedate'])) ? $this->nm_new_label['firedate'] : '' . $this->Ini->Nm_lang['lang_fire_date'] . ''; 
          $SC_Label_atu['hiring_duration'] = (isset($this->nm_new_label['hiring_duration'])) ? $this->nm_new_label['hiring_duration'] : '' . $this->Ini->Nm_lang['lang_hiring_duration'] . ''; 
          $SC_Label_atu['photo_name'] = (isset($this->nm_new_label['photo_name'])) ? $this->nm_new_label['photo_name'] : 'Photo Name'; 
          $SC_Label_atu['photo_size'] = (isset($this->nm_new_label['photo_size'])) ? $this->nm_new_label['photo_size'] : '' . $this->Ini->Nm_lang['lang_photo_size'] . ''; 
          $SC_Label_atu['rate_cass'] = (isset($this->nm_new_label['rate_cass'])) ? $this->nm_new_label['rate_cass'] : 'CASS'; 
          $SC_Label_atu['tax_cass'] = (isset($this->nm_new_label['tax_cass'])) ? $this->nm_new_label['tax_cass'] : 'Tax CASS'; 
          $SC_Label_atu['rate_cfgdct'] = (isset($this->nm_new_label['rate_cfgdct'])) ? $this->nm_new_label['rate_cfgdct'] : 'Rate CFGDCT'; 
          $SC_Label_atu['tax_cfgdct'] = (isset($this->nm_new_label['tax_cfgdct'])) ? $this->nm_new_label['tax_cfgdct'] : 'Tax CFGDCT'; 
          $SC_Label_atu['rate_ona'] = (isset($this->nm_new_label['rate_ona'])) ? $this->nm_new_label['rate_ona'] : 'ONA'; 
          $SC_Label_atu['tax_ona'] = (isset($this->nm_new_label['tax_ona'])) ? $this->nm_new_label['tax_ona'] : 'Tax ONA'; 
          $SC_Label_atu['rate_fdu'] = (isset($this->nm_new_label['rate_fdu'])) ? $this->nm_new_label['rate_fdu'] : 'FDU'; 
          $SC_Label_atu['tax_fdu'] = (isset($this->nm_new_label['tax_fdu'])) ? $this->nm_new_label['tax_fdu'] : 'Tax FDU'; 
          $SC_Label_atu['rate_iris'] = (isset($this->nm_new_label['rate_iris'])) ? $this->nm_new_label['rate_iris'] : 'Tax IRI'; 
          $SC_Label_atu['rate_fixed'] = (isset($this->nm_new_label['rate_fixed'])) ? $this->nm_new_label['rate_fixed'] : '' . $this->Ini->Nm_lang['lang_rate_fixed'] . ''; 
          $SC_Label_atu['revenu_net'] = (isset($this->nm_new_label['revenu_net'])) ? $this->nm_new_label['revenu_net'] : '' . $this->Ini->Nm_lang['lang_revenu_net'] . ''; 
          $SC_Label_atu['block_note'] = (isset($this->nm_new_label['block_note'])) ? $this->nm_new_label['block_note'] : 'Note'; 
          foreach ($SC_Label_atu as $CMP => $LABEL)
          {
              if($CMP == 'SC_all_Cmp')
                  continue;
              $OPC_sel = ($CMP == $OPC_cmp) ? " selected" : "";
              echo "           <option value='" . $CMP . "'" . $OPC_sel . ">" . $LABEL . "</option>";
          }
?> 
          </select>
                                      </span>
                                      <span >
                                        <p class='scGridQuickSearchDivLabel'><?php echo $this->Ini->Nm_lang['lang_quck_srchcond'] ?></span></p>
          <select id='cond_fast_search_f0_t' class="scFormToolbarInput" style="vertical-align: middle;display:;" name="nmgp_cond_fast_search_t" onChange="change_fast_t = 'CH';">
<?php 
          $OPC_sel = ("qp" == $OPC_arg) ? " selected" : "";
           echo "           <option value='qp'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_like'] . "</option>";
          $OPC_sel = ("ii" == $OPC_arg) ? " selected" : "";
           echo "           <option value='ii'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_stts_with'] . "</option>";
          $OPC_sel = ("eq" == $OPC_arg) ? " selected" : "";
           echo "           <option value='eq'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>";
          $OPC_sel = ("np" == $OPC_arg) ? " selected" : "";
           echo "           <option value='np'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_not_like'] . "</option>";
?> 
          </select>
                                      </span>
                                  </div>
                                  <div class='scGridQuickSearchDivToolbar'>
       <?php echo nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "nm_gp_cancel_qsearch_div_store_temp('t')", "nm_gp_cancel_qsearch_div_store_temp('t')", "qs_cancel", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
       <?php echo nmButtonOutput($this->arr_buttons, "bapply_appdiv", "nm_gp_submit_qsearch('t');", "nm_gp_submit_qsearch('t');", "qs_search", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
                                  </div>
                               </div>          </span>  </div>
  <?php
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['update'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterar", "scBtnFn_sys_format_alt()", "scBtnFn_sys_format_alt()", "sc_b_upd_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + S)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['Historic_Salary'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['historic_salary']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['historic_salary']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['historic_salary']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['historic_salary']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['historic_salary'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "historic_salary", "scBtnFn_Historic_Salary()", "scBtnFn_Historic_Salary()", "sc_Historic_Salary_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
        $sCondStyle = ($this->nmgp_botoes['reload'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['breload']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['breload']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['breload']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['breload']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['breload'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "breload", "scBtnFn_sys_format_reload()", "scBtnFn_sys_format_reload()", "sc_b_reload_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (F1)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 't');</script><?php } ?>
</td></tr> 
<tr><td>
<?php
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow scBlockRowFirst"><tr valign="top"><td width="90%" height="">
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<?php
   if (!isset($this->nmgp_cmp_hidden['photo_size']))
   {
       $this->nmgp_cmp_hidden['photo_size'] = 'off';
   }
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><input type="hidden" name="photo_name_ul_name" id="id_sc_field_photo_name_ul_name" value="<?php echo $this->form_encode_input($this->photo_name_ul_name);?>">
<input type="hidden" name="photo_name_ul_type" id="id_sc_field_photo_name_ul_type" value="<?php echo $this->form_encode_input($this->photo_name_ul_type);?>">
   <tr>


    <TD colspan="6" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont"><?php echo $this->Ini->Nm_lang['lang_empoyee_info'] ?></TD>
       
      </TR>
     </TABLE>
    </TD>
   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['userid_int']))
    {
        $this->nm_new_label['userid_int'] = "ID";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $userid_int = $this->userid_int;
   $sStyleHidden_userid_int = '';
   if (isset($this->nmgp_cmp_hidden['userid_int']) && $this->nmgp_cmp_hidden['userid_int'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['userid_int']);
       $sStyleHidden_userid_int = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_userid_int = 'display: none;';
   $sStyleReadInp_userid_int = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['userid_int']) && $this->nmgp_cmp_readonly['userid_int'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['userid_int']);
       $sStyleReadLab_userid_int = '';
       $sStyleReadInp_userid_int = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['userid_int']) && $this->nmgp_cmp_hidden['userid_int'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="userid_int" value="<?php echo $this->form_encode_input($userid_int) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_userid_int_label" id="hidden_field_label_userid_int" style="<?php echo $sStyleHidden_userid_int; ?>"><span id="id_label_userid_int"><?php echo $this->nm_new_label['userid_int']; ?></span></TD>
    <TD class="scFormDataOdd css_userid_int_line" id="hidden_field_data_userid_int" style="<?php echo $sStyleHidden_userid_int; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_userid_int_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="userid_int" value="<?php echo $this->form_encode_input($userid_int); ?>"><span id="id_ajax_label_userid_int"><?php echo nl2br($userid_int); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_userid_int_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_userid_int_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['employee_name']))
    {
        $this->nm_new_label['employee_name'] = "" . $this->Ini->Nm_lang['lang_username'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $employee_name = $this->employee_name;
   $sStyleHidden_employee_name = '';
   if (isset($this->nmgp_cmp_hidden['employee_name']) && $this->nmgp_cmp_hidden['employee_name'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['employee_name']);
       $sStyleHidden_employee_name = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_employee_name = 'display: none;';
   $sStyleReadInp_employee_name = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['employee_name']) && $this->nmgp_cmp_readonly['employee_name'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['employee_name']);
       $sStyleReadLab_employee_name = '';
       $sStyleReadInp_employee_name = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['employee_name']) && $this->nmgp_cmp_hidden['employee_name'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="employee_name" value="<?php echo $this->form_encode_input($employee_name) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_employee_name_label" id="hidden_field_label_employee_name" style="<?php echo $sStyleHidden_employee_name; ?>"><span id="id_label_employee_name"><?php echo $this->nm_new_label['employee_name']; ?></span></TD>
    <TD class="scFormDataOdd css_employee_name_line" id="hidden_field_data_employee_name" style="<?php echo $sStyleHidden_employee_name; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_employee_name_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["employee_name"]) &&  $this->nmgp_cmp_readonly["employee_name"] == "on") { 

 ?>
<input type="hidden" name="employee_name" value="<?php echo $this->form_encode_input($employee_name) . "\">" . $employee_name . ""; ?>
<?php } else { ?>
<span id="id_read_on_employee_name" class="sc-ui-readonly-employee_name css_employee_name_line" style="<?php echo $sStyleReadLab_employee_name; ?>"><?php echo $this->form_format_readonly("employee_name", $this->form_encode_input($this->employee_name)); ?></span><span id="id_read_off_employee_name" class="css_read_off_employee_name<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_employee_name; ?>">
 <input class="sc-js-input scFormObjectOdd css_employee_name_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_employee_name" type=text name="employee_name" value="<?php echo $this->form_encode_input($employee_name) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_employee_name_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_employee_name_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['ic']))
    {
        $this->nm_new_label['ic'] = "National ID";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ic = $this->ic;
   $sStyleHidden_ic = '';
   if (isset($this->nmgp_cmp_hidden['ic']) && $this->nmgp_cmp_hidden['ic'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ic']);
       $sStyleHidden_ic = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ic = 'display: none;';
   $sStyleReadInp_ic = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ic']) && $this->nmgp_cmp_readonly['ic'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ic']);
       $sStyleReadLab_ic = '';
       $sStyleReadInp_ic = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ic']) && $this->nmgp_cmp_hidden['ic'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ic" value="<?php echo $this->form_encode_input($ic) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_ic_label" id="hidden_field_label_ic" style="<?php echo $sStyleHidden_ic; ?>"><span id="id_label_ic"><?php echo $this->nm_new_label['ic']; ?></span></TD>
    <TD class="scFormDataOdd css_ic_line" id="hidden_field_data_ic" style="<?php echo $sStyleHidden_ic; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ic_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ic"]) &&  $this->nmgp_cmp_readonly["ic"] == "on") { 

 ?>
<input type="hidden" name="ic" value="<?php echo $this->form_encode_input($ic) . "\">" . $ic . ""; ?>
<?php } else { ?>
<span id="id_read_on_ic" class="sc-ui-readonly-ic css_ic_line" style="<?php echo $sStyleReadLab_ic; ?>"><?php echo $this->form_format_readonly("ic", $this->form_encode_input($this->ic)); ?></span><span id="id_read_off_ic" class="css_read_off_ic<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_ic; ?>">
 <input class="sc-js-input scFormObjectOdd css_ic_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ic" type=text name="ic" value="<?php echo $this->form_encode_input($ic) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ic_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ic_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['designation']))
    {
        $this->nm_new_label['designation'] = "" . $this->Ini->Nm_lang['lang_designation'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $designation = $this->designation;
   $sStyleHidden_designation = '';
   if (isset($this->nmgp_cmp_hidden['designation']) && $this->nmgp_cmp_hidden['designation'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['designation']);
       $sStyleHidden_designation = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_designation = 'display: none;';
   $sStyleReadInp_designation = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['designation']) && $this->nmgp_cmp_readonly['designation'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['designation']);
       $sStyleReadLab_designation = '';
       $sStyleReadInp_designation = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['designation']) && $this->nmgp_cmp_hidden['designation'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="designation" value="<?php echo $this->form_encode_input($designation) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_designation_label" id="hidden_field_label_designation" style="<?php echo $sStyleHidden_designation; ?>"><span id="id_label_designation"><?php echo $this->nm_new_label['designation']; ?></span></TD>
    <TD class="scFormDataOdd css_designation_line" id="hidden_field_data_designation" style="<?php echo $sStyleHidden_designation; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_designation_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["designation"]) &&  $this->nmgp_cmp_readonly["designation"] == "on") { 

 ?>
<input type="hidden" name="designation" value="<?php echo $this->form_encode_input($designation) . "\">" . $designation . ""; ?>
<?php } else { ?>
<span id="id_read_on_designation" class="sc-ui-readonly-designation css_designation_line" style="<?php echo $sStyleReadLab_designation; ?>"><?php echo $this->form_format_readonly("designation", $this->form_encode_input($this->designation)); ?></span><span id="id_read_off_designation" class="css_read_off_designation<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_designation; ?>">
 <input class="sc-js-input scFormObjectOdd css_designation_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_designation" type=text name="designation" value="<?php echo $this->form_encode_input($designation) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_designation_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_designation_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['dept']))
    {
        $this->nm_new_label['dept'] = "" . $this->Ini->Nm_lang['lang_departement'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dept = $this->dept;
   $sStyleHidden_dept = '';
   if (isset($this->nmgp_cmp_hidden['dept']) && $this->nmgp_cmp_hidden['dept'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dept']);
       $sStyleHidden_dept = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dept = 'display: none;';
   $sStyleReadInp_dept = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dept']) && $this->nmgp_cmp_readonly['dept'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dept']);
       $sStyleReadLab_dept = '';
       $sStyleReadInp_dept = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dept']) && $this->nmgp_cmp_hidden['dept'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dept" value="<?php echo $this->form_encode_input($dept) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_dept_label" id="hidden_field_label_dept" style="<?php echo $sStyleHidden_dept; ?>"><span id="id_label_dept"><?php echo $this->nm_new_label['dept']; ?></span></TD>
    <TD class="scFormDataOdd css_dept_line" id="hidden_field_data_dept" style="<?php echo $sStyleHidden_dept; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dept_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dept"]) &&  $this->nmgp_cmp_readonly["dept"] == "on") { 

 ?>
<input type="hidden" name="dept" value="<?php echo $this->form_encode_input($dept) . "\">" . $dept . ""; ?>
<?php } else { ?>
<span id="id_read_on_dept" class="sc-ui-readonly-dept css_dept_line" style="<?php echo $sStyleReadLab_dept; ?>"><?php echo $this->form_format_readonly("dept", $this->form_encode_input($this->dept)); ?></span><span id="id_read_off_dept" class="css_read_off_dept<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dept; ?>">
 <input class="sc-js-input scFormObjectOdd css_dept_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dept" type=text name="dept" value="<?php echo $this->form_encode_input($dept) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dept_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dept_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['gender']))
    {
        $this->nm_new_label['gender'] = "" . $this->Ini->Nm_lang['lang_gender'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $gender = $this->gender;
   $sStyleHidden_gender = '';
   if (isset($this->nmgp_cmp_hidden['gender']) && $this->nmgp_cmp_hidden['gender'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['gender']);
       $sStyleHidden_gender = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_gender = 'display: none;';
   $sStyleReadInp_gender = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['gender']) && $this->nmgp_cmp_readonly['gender'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['gender']);
       $sStyleReadLab_gender = '';
       $sStyleReadInp_gender = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['gender']) && $this->nmgp_cmp_hidden['gender'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="gender" value="<?php echo $this->form_encode_input($gender) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_gender_label" id="hidden_field_label_gender" style="<?php echo $sStyleHidden_gender; ?>"><span id="id_label_gender"><?php echo $this->nm_new_label['gender']; ?></span></TD>
    <TD class="scFormDataOdd css_gender_line" id="hidden_field_data_gender" style="<?php echo $sStyleHidden_gender; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_gender_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["gender"]) &&  $this->nmgp_cmp_readonly["gender"] == "on") { 

 ?>
<input type="hidden" name="gender" value="<?php echo $this->form_encode_input($gender) . "\">" . $gender . ""; ?>
<?php } else { ?>
<span id="id_read_on_gender" class="sc-ui-readonly-gender css_gender_line" style="<?php echo $sStyleReadLab_gender; ?>"><?php echo $this->form_format_readonly("gender", $this->form_encode_input($this->gender)); ?></span><span id="id_read_off_gender" class="css_read_off_gender<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_gender; ?>">
 <input class="sc-js-input scFormObjectOdd css_gender_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_gender" type=text name="gender" value="<?php echo $this->form_encode_input($gender) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=15"; } ?> maxlength=15 alt="{datatype: 'text', maxLength: 15, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_gender_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_gender_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dob']))
    {
        $this->nm_new_label['dob'] = "" . $this->Ini->Nm_lang['lang_dob'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dob = $this->dob;
   $sStyleHidden_dob = '';
   if (isset($this->nmgp_cmp_hidden['dob']) && $this->nmgp_cmp_hidden['dob'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dob']);
       $sStyleHidden_dob = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dob = 'display: none;';
   $sStyleReadInp_dob = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dob']) && $this->nmgp_cmp_readonly['dob'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dob']);
       $sStyleReadLab_dob = '';
       $sStyleReadInp_dob = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dob']) && $this->nmgp_cmp_hidden['dob'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dob" value="<?php echo $this->form_encode_input($dob) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_dob_label" id="hidden_field_label_dob" style="<?php echo $sStyleHidden_dob; ?>"><span id="id_label_dob"><?php echo $this->nm_new_label['dob']; ?></span></TD>
    <TD class="scFormDataOdd css_dob_line" id="hidden_field_data_dob" style="<?php echo $sStyleHidden_dob; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dob_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dob"]) &&  $this->nmgp_cmp_readonly["dob"] == "on") { 

 ?>
<input type="hidden" name="dob" value="<?php echo $this->form_encode_input($dob) . "\">" . $dob . ""; ?>
<?php } else { ?>
<span id="id_read_on_dob" class="sc-ui-readonly-dob css_dob_line" style="<?php echo $sStyleReadLab_dob; ?>"><?php echo $this->form_format_readonly("dob", $this->form_encode_input($dob)); ?></span><span id="id_read_off_dob" class="css_read_off_dob<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dob; ?>"><?php
$tmp_form_data = $this->field_config['dob']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
<?php
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('scButton_' == substr($miniCalendarButton[1], 0, 9)) {
    $miniCalendarButton[1] = substr($miniCalendarButton[1], 9);
}
?>
<span class='trigger-picker-<?php echo $miniCalendarButton[1]; ?>' style='display: inherit; width: 100%'>

 <input class="sc-js-input scFormObjectOdd css_dob_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dob" type=text name="dob" value="<?php echo $this->form_encode_input($dob) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dob']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dob']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dob_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dob_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['address']))
    {
        $this->nm_new_label['address'] = "Address";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $address = $this->address;
   $sStyleHidden_address = '';
   if (isset($this->nmgp_cmp_hidden['address']) && $this->nmgp_cmp_hidden['address'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['address']);
       $sStyleHidden_address = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_address = 'display: none;';
   $sStyleReadInp_address = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['address']) && $this->nmgp_cmp_readonly['address'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['address']);
       $sStyleReadLab_address = '';
       $sStyleReadInp_address = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['address']) && $this->nmgp_cmp_hidden['address'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="address" value="<?php echo $this->form_encode_input($address) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_address_label" id="hidden_field_label_address" style="<?php echo $sStyleHidden_address; ?>"><span id="id_label_address"><?php echo $this->nm_new_label['address']; ?></span></TD>
    <TD class="scFormDataOdd css_address_line" id="hidden_field_data_address" style="<?php echo $sStyleHidden_address; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_address_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["address"]) &&  $this->nmgp_cmp_readonly["address"] == "on") { 

 ?>
<input type="hidden" name="address" value="<?php echo $this->form_encode_input($address) . "\">" . $address . ""; ?>
<?php } else { ?>
<span id="id_read_on_address" class="sc-ui-readonly-address css_address_line" style="<?php echo $sStyleReadLab_address; ?>"><?php echo $this->form_format_readonly("address", $this->form_encode_input($this->address)); ?></span><span id="id_read_off_address" class="css_read_off_address<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_address; ?>">
 <input class="sc-js-input scFormObjectOdd css_address_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_address" type=text name="address" value="<?php echo $this->form_encode_input($address) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=200 alt="{datatype: 'text', maxLength: 200, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_address_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_address_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['phone']))
    {
        $this->nm_new_label['phone'] = "" . $this->Ini->Nm_lang['lang_phone'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $phone = $this->phone;
   $sStyleHidden_phone = '';
   if (isset($this->nmgp_cmp_hidden['phone']) && $this->nmgp_cmp_hidden['phone'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['phone']);
       $sStyleHidden_phone = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_phone = 'display: none;';
   $sStyleReadInp_phone = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['phone']) && $this->nmgp_cmp_readonly['phone'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['phone']);
       $sStyleReadLab_phone = '';
       $sStyleReadInp_phone = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['phone']) && $this->nmgp_cmp_hidden['phone'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="phone" value="<?php echo $this->form_encode_input($phone) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_phone_label" id="hidden_field_label_phone" style="<?php echo $sStyleHidden_phone; ?>"><span id="id_label_phone"><?php echo $this->nm_new_label['phone']; ?></span></TD>
    <TD class="scFormDataOdd css_phone_line" id="hidden_field_data_phone" style="<?php echo $sStyleHidden_phone; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_phone_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["phone"]) &&  $this->nmgp_cmp_readonly["phone"] == "on") { 

 ?>
<input type="hidden" name="phone" value="<?php echo $this->form_encode_input($phone) . "\">" . $phone . ""; ?>
<?php } else { ?>
<span id="id_read_on_phone" class="sc-ui-readonly-phone css_phone_line" style="<?php echo $sStyleReadLab_phone; ?>"><?php echo $this->form_format_readonly("phone", $this->form_encode_input($this->phone)); ?></span><span id="id_read_off_phone" class="css_read_off_phone<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_phone; ?>">
 <input class="sc-js-input scFormObjectOdd css_phone_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_phone" type=text name="phone" value="<?php echo $this->form_encode_input($phone) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_phone_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_phone_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hiredate']))
    {
        $this->nm_new_label['hiredate'] = "" . $this->Ini->Nm_lang['lang_hiredate'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hiredate = $this->hiredate;
   $sStyleHidden_hiredate = '';
   if (isset($this->nmgp_cmp_hidden['hiredate']) && $this->nmgp_cmp_hidden['hiredate'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hiredate']);
       $sStyleHidden_hiredate = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hiredate = 'display: none;';
   $sStyleReadInp_hiredate = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hiredate']) && $this->nmgp_cmp_readonly['hiredate'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hiredate']);
       $sStyleReadLab_hiredate = '';
       $sStyleReadInp_hiredate = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hiredate']) && $this->nmgp_cmp_hidden['hiredate'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hiredate" value="<?php echo $this->form_encode_input($hiredate) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hiredate_label" id="hidden_field_label_hiredate" style="<?php echo $sStyleHidden_hiredate; ?>"><span id="id_label_hiredate"><?php echo $this->nm_new_label['hiredate']; ?></span></TD>
    <TD class="scFormDataOdd css_hiredate_line" id="hidden_field_data_hiredate" style="<?php echo $sStyleHidden_hiredate; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hiredate_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hiredate"]) &&  $this->nmgp_cmp_readonly["hiredate"] == "on") { 

 ?>
<input type="hidden" name="hiredate" value="<?php echo $this->form_encode_input($hiredate) . "\">" . $hiredate . ""; ?>
<?php } else { ?>
<span id="id_read_on_hiredate" class="sc-ui-readonly-hiredate css_hiredate_line" style="<?php echo $sStyleReadLab_hiredate; ?>"><?php echo $this->form_format_readonly("hiredate", $this->form_encode_input($hiredate)); ?></span><span id="id_read_off_hiredate" class="css_read_off_hiredate<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hiredate; ?>"><?php
$tmp_form_data = $this->field_config['hiredate']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
<?php
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('scButton_' == substr($miniCalendarButton[1], 0, 9)) {
    $miniCalendarButton[1] = substr($miniCalendarButton[1], 9);
}
?>
<span class='trigger-picker-<?php echo $miniCalendarButton[1]; ?>' style='display: inherit; width: 100%'>

 <input class="sc-js-input scFormObjectOdd css_hiredate_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hiredate" type=text name="hiredate" value="<?php echo $this->form_encode_input($hiredate) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['hiredate']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['hiredate']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hiredate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hiredate_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['email']))
    {
        $this->nm_new_label['email'] = "Email";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $email = $this->email;
   $sStyleHidden_email = '';
   if (isset($this->nmgp_cmp_hidden['email']) && $this->nmgp_cmp_hidden['email'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['email']);
       $sStyleHidden_email = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_email = 'display: none;';
   $sStyleReadInp_email = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['email']) && $this->nmgp_cmp_readonly['email'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['email']);
       $sStyleReadLab_email = '';
       $sStyleReadInp_email = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['email']) && $this->nmgp_cmp_hidden['email'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="email" value="<?php echo $this->form_encode_input($email) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_email_label" id="hidden_field_label_email" style="<?php echo $sStyleHidden_email; ?>"><span id="id_label_email"><?php echo $this->nm_new_label['email']; ?></span></TD>
    <TD class="scFormDataOdd css_email_line" id="hidden_field_data_email" style="<?php echo $sStyleHidden_email; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_email_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["email"]) &&  $this->nmgp_cmp_readonly["email"] == "on") { 

 ?>
<input type="hidden" name="email" value="<?php echo $this->form_encode_input($email) . "\">" . $email . ""; ?>
<?php } else { ?>
<span id="id_read_on_email" class="sc-ui-readonly-email css_email_line" style="<?php echo $sStyleReadLab_email; ?>"><?php echo $this->form_format_readonly("email", $this->form_encode_input($this->email)); ?></span><span id="id_read_off_email" class="css_read_off_email<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_email; ?>">
 <input class="sc-js-input scFormObjectOdd css_email_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_email" type=text name="email" value="<?php echo $this->form_encode_input($email) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_email_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_email_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['field01']))
    {
        $this->nm_new_label['field01'] = "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $field01 = $this->field01;
   $sStyleHidden_field01 = '';
   if (isset($this->nmgp_cmp_hidden['field01']) && $this->nmgp_cmp_hidden['field01'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['field01']);
       $sStyleHidden_field01 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_field01 = 'display: none;';
   $sStyleReadInp_field01 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['field01']) && $this->nmgp_cmp_readonly['field01'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['field01']);
       $sStyleReadLab_field01 = '';
       $sStyleReadInp_field01 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['field01']) && $this->nmgp_cmp_hidden['field01'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="field01" value="<?php echo $this->form_encode_input($field01) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_field01_label" id="hidden_field_label_field01" style="<?php echo $sStyleHidden_field01; ?>"><span id="id_label_field01"><?php echo $this->nm_new_label['field01']; ?></span></TD>
    <TD class="scFormDataOdd css_field01_line" id="hidden_field_data_field01" style="<?php echo $sStyleHidden_field01; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_field01_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="field01" value="<?php echo $this->form_encode_input($field01); ?>"><span id="id_ajax_label_field01"><?php echo nl2br($field01); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_field01_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_field01_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['firedate']))
    {
        $this->nm_new_label['firedate'] = "" . $this->Ini->Nm_lang['lang_fire_date'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $firedate = $this->firedate;
   $sStyleHidden_firedate = '';
   if (isset($this->nmgp_cmp_hidden['firedate']) && $this->nmgp_cmp_hidden['firedate'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['firedate']);
       $sStyleHidden_firedate = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_firedate = 'display: none;';
   $sStyleReadInp_firedate = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['firedate']) && $this->nmgp_cmp_readonly['firedate'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['firedate']);
       $sStyleReadLab_firedate = '';
       $sStyleReadInp_firedate = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['firedate']) && $this->nmgp_cmp_hidden['firedate'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="firedate" value="<?php echo $this->form_encode_input($firedate) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_firedate_label" id="hidden_field_label_firedate" style="<?php echo $sStyleHidden_firedate; ?>"><span id="id_label_firedate"><?php echo $this->nm_new_label['firedate']; ?></span></TD>
    <TD class="scFormDataOdd css_firedate_line" id="hidden_field_data_firedate" style="<?php echo $sStyleHidden_firedate; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_firedate_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["firedate"]) &&  $this->nmgp_cmp_readonly["firedate"] == "on") { 

 ?>
<input type="hidden" name="firedate" value="<?php echo $this->form_encode_input($firedate) . "\">" . $firedate . ""; ?>
<?php } else { ?>
<span id="id_read_on_firedate" class="sc-ui-readonly-firedate css_firedate_line" style="<?php echo $sStyleReadLab_firedate; ?>"><?php echo $this->form_format_readonly("firedate", $this->form_encode_input($firedate)); ?></span><span id="id_read_off_firedate" class="css_read_off_firedate<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_firedate; ?>"><?php
$tmp_form_data = $this->field_config['firedate']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
<?php
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('scButton_' == substr($miniCalendarButton[1], 0, 9)) {
    $miniCalendarButton[1] = substr($miniCalendarButton[1], 9);
}
?>
<span class='trigger-picker-<?php echo $miniCalendarButton[1]; ?>' style='display: inherit; width: 100%'>

 <input class="sc-js-input scFormObjectOdd css_firedate_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_firedate" type=text name="firedate" value="<?php echo $this->form_encode_input($firedate) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['firedate']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['firedate']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_firedate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_firedate_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['hiring_duration']))
    {
        $this->nm_new_label['hiring_duration'] = "" . $this->Ini->Nm_lang['lang_hiring_duration'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hiring_duration = $this->hiring_duration;
   $sStyleHidden_hiring_duration = '';
   if (isset($this->nmgp_cmp_hidden['hiring_duration']) && $this->nmgp_cmp_hidden['hiring_duration'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hiring_duration']);
       $sStyleHidden_hiring_duration = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hiring_duration = 'display: none;';
   $sStyleReadInp_hiring_duration = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hiring_duration']) && $this->nmgp_cmp_readonly['hiring_duration'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hiring_duration']);
       $sStyleReadLab_hiring_duration = '';
       $sStyleReadInp_hiring_duration = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hiring_duration']) && $this->nmgp_cmp_hidden['hiring_duration'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hiring_duration" value="<?php echo $this->form_encode_input($hiring_duration) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hiring_duration_label" id="hidden_field_label_hiring_duration" style="<?php echo $sStyleHidden_hiring_duration; ?>"><span id="id_label_hiring_duration"><?php echo $this->nm_new_label['hiring_duration']; ?></span></TD>
    <TD class="scFormDataOdd css_hiring_duration_line" id="hidden_field_data_hiring_duration" style="<?php echo $sStyleHidden_hiring_duration; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hiring_duration_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hiring_duration"]) &&  $this->nmgp_cmp_readonly["hiring_duration"] == "on") { 

 ?>
<input type="hidden" name="hiring_duration" value="<?php echo $this->form_encode_input($hiring_duration) . "\">" . $hiring_duration . ""; ?>
<?php } else { ?>
<span id="id_read_on_hiring_duration" class="sc-ui-readonly-hiring_duration css_hiring_duration_line" style="<?php echo $sStyleReadLab_hiring_duration; ?>"><?php echo $this->form_format_readonly("hiring_duration", $this->form_encode_input($this->hiring_duration)); ?></span><span id="id_read_off_hiring_duration" class="css_read_off_hiring_duration<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hiring_duration; ?>">
 <input class="sc-js-input scFormObjectOdd css_hiring_duration_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hiring_duration" type=text name="hiring_duration" value="<?php echo $this->form_encode_input($hiring_duration) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> alt="{datatype: 'decimal', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['hiring_duration']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['hiring_duration']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['hiring_duration']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['hiring_duration']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hiring_duration_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hiring_duration_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

    <TD class="scFormDataOdd" colspan="2" >&nbsp;</TD>
<?php if ($sc_hidden_yes > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } ?>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   <td width="10%" height="">
   <a name="bloco_1"></a>
<div id="div_hidden_bloco_1" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="1" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont">PHOTO</TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['photo_name']))
    {
        $this->nm_new_label['photo_name'] = "Photo Name";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $photo_name = $this->photo_name;
   $sStyleHidden_photo_name = '';
   if (isset($this->nmgp_cmp_hidden['photo_name']) && $this->nmgp_cmp_hidden['photo_name'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['photo_name']);
       $sStyleHidden_photo_name = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_photo_name = 'display: none;';
   $sStyleReadInp_photo_name = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['photo_name']) && $this->nmgp_cmp_readonly['photo_name'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['photo_name']);
       $sStyleReadLab_photo_name = '';
       $sStyleReadInp_photo_name = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['photo_name']) && $this->nmgp_cmp_hidden['photo_name'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="photo_name" value="<?php echo $this->form_encode_input($photo_name) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_photo_name_line" id="hidden_field_data_photo_name" style="<?php echo $sStyleHidden_photo_name; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_photo_name_line" style="vertical-align: top;padding: 0px">
 <?php $this->NM_ajax_info['varList'][] = array("var_ajax_img_photo_name" => $out1_photo_name); ?><script>var var_ajax_img_photo_name = '<?php echo $out1_photo_name; ?>';</script><?php if (!empty($out_photo_name)){ echo "<a  href=\"javascript:nm_mostra_img(var_ajax_img_photo_name, '" . $this->nmgp_return_img['photo_name'][0] . "', '" . $this->nmgp_return_img['photo_name'][1] . "')\"><img id=\"id_ajax_img_photo_name\" border=\"0\" src=\"$out_photo_name\"></a> &nbsp;" . "<span id=\"txt_ajax_img_photo_name\" style=\"display: none\">" . $this->form_format_readonly("photo_name", $photo_name) . "</span>"; if (!empty($photo_name)){ echo "<br>";} } else { echo "<img id=\"id_ajax_img_photo_name\" border=\"0\" style=\"display: none\"> &nbsp;<span id=\"txt_ajax_img_photo_name\"></span><br />"; } ?>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["photo_name"]) &&  $this->nmgp_cmp_readonly["photo_name"] == "on") { 

 ?>
<img id=\"photo_name_img_uploading\" style=\"display: none\" border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" /><input type="hidden" name="photo_name" value="<?php echo $this->form_encode_input($photo_name) . "\">" . $photo_name . ""; ?>
<?php } else { ?>
<span id="id_read_off_photo_name" class="css_read_off_photo_name<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_photo_name; ?>"><span style="display:inline-block"><span id="sc-id-upload-select-photo_name" class="fileinput-button fileinput-button-padding scButton_default">
 <span><?php echo $this->Ini->Nm_lang['lang_select_file'] ?></span>

 <input class="sc-js-input scFormObjectOdd css_photo_name_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" title="<?php echo $this->Ini->Nm_lang['lang_select_file'] ?>" type="file" name="photo_name[]" id="id_sc_field_photo_name" onchange="<?php if ($this->nmgp_opcao == "novo") {echo "if (document.F1.elements['sc_check_vert[" . $sc_seq_vert . "]']) { document.F1.elements['sc_check_vert[" . $sc_seq_vert . "]'].checked = true }"; }?>"></span></span>
<?php
   $sCheckInsert = "";
?>
<span id="chk_ajax_img_photo_name"<?php if ($this->nmgp_opcao == "novo" || empty($photo_name)) { echo " style=\"display: none\""; } ?>> <input type=checkbox name="photo_name_limpa" value="<?php echo $photo_name_limpa . '" '; if ($photo_name_limpa == "S"){echo "checked ";} ?> onclick="this.value = ''; if (this.checked){ this.value = 'S'};<?php echo $sCheckInsert ?>"><?php echo $this->Ini->Nm_lang['lang_btns_dele_hint']; ?> &nbsp;</span><img id="photo_name_img_uploading" style="display: none" border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" /><div id="id_img_loader_photo_name" class="progress progress-success progress-striped active scProgressBarStart" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="display: none"><div class="bar scProgressBarLoading">&nbsp;</div></div><img id="id_ajax_loader_photo_name" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" style="display: none" /></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_photo_name_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_photo_name_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['photo_size']))
    {
        $this->nm_new_label['photo_size'] = "" . $this->Ini->Nm_lang['lang_photo_size'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $photo_size = $this->photo_size;
   if (!isset($this->nmgp_cmp_hidden['photo_size']))
   {
       $this->nmgp_cmp_hidden['photo_size'] = 'off';
   }
   $sStyleHidden_photo_size = '';
   if (isset($this->nmgp_cmp_hidden['photo_size']) && $this->nmgp_cmp_hidden['photo_size'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['photo_size']);
       $sStyleHidden_photo_size = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_photo_size = 'display: none;';
   $sStyleReadInp_photo_size = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['photo_size']) && $this->nmgp_cmp_readonly['photo_size'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['photo_size']);
       $sStyleReadLab_photo_size = '';
       $sStyleReadInp_photo_size = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['photo_size']) && $this->nmgp_cmp_hidden['photo_size'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="photo_size" value="<?php echo $this->form_encode_input($photo_size) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_photo_size_line" id="hidden_field_data_photo_size" style="<?php echo $sStyleHidden_photo_size; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_photo_size_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["photo_size"]) &&  $this->nmgp_cmp_readonly["photo_size"] == "on") { 

 ?>
<input type="hidden" name="photo_size" value="<?php echo $this->form_encode_input($photo_size) . "\">" . $photo_size . ""; ?>
<?php } else { ?>
<span id="id_read_on_photo_size" class="sc-ui-readonly-photo_size css_photo_size_line" style="<?php echo $sStyleReadLab_photo_size; ?>"><?php echo $this->form_format_readonly("photo_size", $this->form_encode_input($this->photo_size)); ?></span><span id="id_read_off_photo_size" class="css_read_off_photo_size<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_photo_size; ?>">
 <input class="sc-js-input scFormObjectOdd css_photo_size_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_photo_size" type=text name="photo_size" value="<?php echo $this->form_encode_input($photo_size) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_photo_size_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_photo_size_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_photo_size_dumb = ('' == $sStyleHidden_photo_size) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_photo_size_dumb" style="<?php echo $sStyleHidden_photo_size_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_2"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_2" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_2" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="4" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf2\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;\" class=\"scFormBlockAlign\">"; } ?><?php echo $this->Ini->Nm_lang['lang_employee_income'] ?><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>
   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['rate_cass']))
    {
        $this->nm_new_label['rate_cass'] = "CASS";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $rate_cass = $this->rate_cass;
   $sStyleHidden_rate_cass = '';
   if (isset($this->nmgp_cmp_hidden['rate_cass']) && $this->nmgp_cmp_hidden['rate_cass'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['rate_cass']);
       $sStyleHidden_rate_cass = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_rate_cass = 'display: none;';
   $sStyleReadInp_rate_cass = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['rate_cass']) && $this->nmgp_cmp_readonly['rate_cass'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['rate_cass']);
       $sStyleReadLab_rate_cass = '';
       $sStyleReadInp_rate_cass = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['rate_cass']) && $this->nmgp_cmp_hidden['rate_cass'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="rate_cass" value="<?php echo $this->form_encode_input($rate_cass) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_rate_cass_label" id="hidden_field_label_rate_cass" style="<?php echo $sStyleHidden_rate_cass; ?>"><span id="id_label_rate_cass"><?php echo $this->nm_new_label['rate_cass']; ?></span></TD>
    <TD class="scFormDataOdd css_rate_cass_line" id="hidden_field_data_rate_cass" style="<?php echo $sStyleHidden_rate_cass; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_rate_cass_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["rate_cass"]) &&  $this->nmgp_cmp_readonly["rate_cass"] == "on") { 

 ?>
<input type="hidden" name="rate_cass" value="<?php echo $this->form_encode_input($rate_cass) . "\">" . $rate_cass . ""; ?>
<?php } else { ?>
<span id="id_read_on_rate_cass" class="sc-ui-readonly-rate_cass css_rate_cass_line" style="<?php echo $sStyleReadLab_rate_cass; ?>"><?php echo $this->form_format_readonly("rate_cass", $this->form_encode_input($this->rate_cass)); ?></span><span id="id_read_off_rate_cass" class="css_read_off_rate_cass<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_rate_cass; ?>">
 <input class="sc-js-input scFormObjectOdd css_rate_cass_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_rate_cass" type=text name="rate_cass" value="<?php echo $this->form_encode_input($rate_cass) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> alt="{datatype: 'decimal', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_cass']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_cass']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['rate_cass']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['rate_cass']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_rate_cass_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_rate_cass_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['tax_cass']))
    {
        $this->nm_new_label['tax_cass'] = "Tax CASS";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tax_cass = $this->tax_cass;
   $sStyleHidden_tax_cass = '';
   if (isset($this->nmgp_cmp_hidden['tax_cass']) && $this->nmgp_cmp_hidden['tax_cass'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tax_cass']);
       $sStyleHidden_tax_cass = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tax_cass = 'display: none;';
   $sStyleReadInp_tax_cass = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tax_cass']) && $this->nmgp_cmp_readonly['tax_cass'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tax_cass']);
       $sStyleReadLab_tax_cass = '';
       $sStyleReadInp_tax_cass = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tax_cass']) && $this->nmgp_cmp_hidden['tax_cass'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tax_cass" value="<?php echo $this->form_encode_input($tax_cass) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_tax_cass_label" id="hidden_field_label_tax_cass" style="<?php echo $sStyleHidden_tax_cass; ?>"><span id="id_label_tax_cass"><?php echo $this->nm_new_label['tax_cass']; ?></span></TD>
    <TD class="scFormDataOdd css_tax_cass_line" id="hidden_field_data_tax_cass" style="<?php echo $sStyleHidden_tax_cass; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tax_cass_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tax_cass"]) &&  $this->nmgp_cmp_readonly["tax_cass"] == "on") { 

 ?>
<input type="hidden" name="tax_cass" value="<?php echo $this->form_encode_input($tax_cass) . "\">" . $tax_cass . ""; ?>
<?php } else { ?>
<span id="id_read_on_tax_cass" class="sc-ui-readonly-tax_cass css_tax_cass_line" style="<?php echo $sStyleReadLab_tax_cass; ?>"><?php echo $this->form_format_readonly("tax_cass", $this->form_encode_input($this->tax_cass)); ?></span><span id="id_read_off_tax_cass" class="css_read_off_tax_cass<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tax_cass; ?>">
 <input class="sc-js-input scFormObjectOdd css_tax_cass_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tax_cass" type=text name="tax_cass" value="<?php echo $this->form_encode_input($tax_cass) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> alt="{datatype: 'currency', currencySymbol: '<?php echo $this->field_config['tax_cass']['symbol_mon']; ?>', currencyPosition: '<?php echo ((1 == $this->field_config['tax_cass']['format_pos'] || 3 == $this->field_config['tax_cass']['format_pos']) ? 'left' : 'right'); ?>', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['tax_cass']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['tax_cass']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['tax_cass']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['tax_cass']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tax_cass_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tax_cass_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['rate_cfgdct']))
    {
        $this->nm_new_label['rate_cfgdct'] = "Rate CFGDCT";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $rate_cfgdct = $this->rate_cfgdct;
   $sStyleHidden_rate_cfgdct = '';
   if (isset($this->nmgp_cmp_hidden['rate_cfgdct']) && $this->nmgp_cmp_hidden['rate_cfgdct'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['rate_cfgdct']);
       $sStyleHidden_rate_cfgdct = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_rate_cfgdct = 'display: none;';
   $sStyleReadInp_rate_cfgdct = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['rate_cfgdct']) && $this->nmgp_cmp_readonly['rate_cfgdct'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['rate_cfgdct']);
       $sStyleReadLab_rate_cfgdct = '';
       $sStyleReadInp_rate_cfgdct = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['rate_cfgdct']) && $this->nmgp_cmp_hidden['rate_cfgdct'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="rate_cfgdct" value="<?php echo $this->form_encode_input($rate_cfgdct) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_rate_cfgdct_label" id="hidden_field_label_rate_cfgdct" style="<?php echo $sStyleHidden_rate_cfgdct; ?>"><span id="id_label_rate_cfgdct"><?php echo $this->nm_new_label['rate_cfgdct']; ?></span></TD>
    <TD class="scFormDataOdd css_rate_cfgdct_line" id="hidden_field_data_rate_cfgdct" style="<?php echo $sStyleHidden_rate_cfgdct; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_rate_cfgdct_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["rate_cfgdct"]) &&  $this->nmgp_cmp_readonly["rate_cfgdct"] == "on") { 

 ?>
<input type="hidden" name="rate_cfgdct" value="<?php echo $this->form_encode_input($rate_cfgdct) . "\">" . $rate_cfgdct . ""; ?>
<?php } else { ?>
<span id="id_read_on_rate_cfgdct" class="sc-ui-readonly-rate_cfgdct css_rate_cfgdct_line" style="<?php echo $sStyleReadLab_rate_cfgdct; ?>"><?php echo $this->form_format_readonly("rate_cfgdct", $this->form_encode_input($this->rate_cfgdct)); ?></span><span id="id_read_off_rate_cfgdct" class="css_read_off_rate_cfgdct<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_rate_cfgdct; ?>">
 <input class="sc-js-input scFormObjectOdd css_rate_cfgdct_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_rate_cfgdct" type=text name="rate_cfgdct" value="<?php echo $this->form_encode_input($rate_cfgdct) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> alt="{datatype: 'decimal', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_cfgdct']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_cfgdct']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['rate_cfgdct']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['rate_cfgdct']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_rate_cfgdct_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_rate_cfgdct_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['tax_cfgdct']))
    {
        $this->nm_new_label['tax_cfgdct'] = "Tax CFGDCT";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tax_cfgdct = $this->tax_cfgdct;
   $sStyleHidden_tax_cfgdct = '';
   if (isset($this->nmgp_cmp_hidden['tax_cfgdct']) && $this->nmgp_cmp_hidden['tax_cfgdct'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tax_cfgdct']);
       $sStyleHidden_tax_cfgdct = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tax_cfgdct = 'display: none;';
   $sStyleReadInp_tax_cfgdct = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tax_cfgdct']) && $this->nmgp_cmp_readonly['tax_cfgdct'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tax_cfgdct']);
       $sStyleReadLab_tax_cfgdct = '';
       $sStyleReadInp_tax_cfgdct = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tax_cfgdct']) && $this->nmgp_cmp_hidden['tax_cfgdct'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tax_cfgdct" value="<?php echo $this->form_encode_input($tax_cfgdct) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_tax_cfgdct_label" id="hidden_field_label_tax_cfgdct" style="<?php echo $sStyleHidden_tax_cfgdct; ?>"><span id="id_label_tax_cfgdct"><?php echo $this->nm_new_label['tax_cfgdct']; ?></span></TD>
    <TD class="scFormDataOdd css_tax_cfgdct_line" id="hidden_field_data_tax_cfgdct" style="<?php echo $sStyleHidden_tax_cfgdct; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tax_cfgdct_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tax_cfgdct"]) &&  $this->nmgp_cmp_readonly["tax_cfgdct"] == "on") { 

 ?>
<input type="hidden" name="tax_cfgdct" value="<?php echo $this->form_encode_input($tax_cfgdct) . "\">" . $tax_cfgdct . ""; ?>
<?php } else { ?>
<span id="id_read_on_tax_cfgdct" class="sc-ui-readonly-tax_cfgdct css_tax_cfgdct_line" style="<?php echo $sStyleReadLab_tax_cfgdct; ?>"><?php echo $this->form_format_readonly("tax_cfgdct", $this->form_encode_input($this->tax_cfgdct)); ?></span><span id="id_read_off_tax_cfgdct" class="css_read_off_tax_cfgdct<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tax_cfgdct; ?>">
 <input class="sc-js-input scFormObjectOdd css_tax_cfgdct_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tax_cfgdct" type=text name="tax_cfgdct" value="<?php echo $this->form_encode_input($tax_cfgdct) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> alt="{datatype: 'currency', currencySymbol: '<?php echo $this->field_config['tax_cfgdct']['symbol_mon']; ?>', currencyPosition: '<?php echo ((1 == $this->field_config['tax_cfgdct']['format_pos'] || 3 == $this->field_config['tax_cfgdct']['format_pos']) ? 'left' : 'right'); ?>', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['tax_cfgdct']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['tax_cfgdct']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['tax_cfgdct']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['tax_cfgdct']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tax_cfgdct_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tax_cfgdct_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['rate_ona']))
    {
        $this->nm_new_label['rate_ona'] = "ONA";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $rate_ona = $this->rate_ona;
   $sStyleHidden_rate_ona = '';
   if (isset($this->nmgp_cmp_hidden['rate_ona']) && $this->nmgp_cmp_hidden['rate_ona'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['rate_ona']);
       $sStyleHidden_rate_ona = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_rate_ona = 'display: none;';
   $sStyleReadInp_rate_ona = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['rate_ona']) && $this->nmgp_cmp_readonly['rate_ona'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['rate_ona']);
       $sStyleReadLab_rate_ona = '';
       $sStyleReadInp_rate_ona = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['rate_ona']) && $this->nmgp_cmp_hidden['rate_ona'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="rate_ona" value="<?php echo $this->form_encode_input($rate_ona) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_rate_ona_label" id="hidden_field_label_rate_ona" style="<?php echo $sStyleHidden_rate_ona; ?>"><span id="id_label_rate_ona"><?php echo $this->nm_new_label['rate_ona']; ?></span></TD>
    <TD class="scFormDataOdd css_rate_ona_line" id="hidden_field_data_rate_ona" style="<?php echo $sStyleHidden_rate_ona; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_rate_ona_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["rate_ona"]) &&  $this->nmgp_cmp_readonly["rate_ona"] == "on") { 

 ?>
<input type="hidden" name="rate_ona" value="<?php echo $this->form_encode_input($rate_ona) . "\">" . $rate_ona . ""; ?>
<?php } else { ?>
<span id="id_read_on_rate_ona" class="sc-ui-readonly-rate_ona css_rate_ona_line" style="<?php echo $sStyleReadLab_rate_ona; ?>"><?php echo $this->form_format_readonly("rate_ona", $this->form_encode_input($this->rate_ona)); ?></span><span id="id_read_off_rate_ona" class="css_read_off_rate_ona<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_rate_ona; ?>">
 <input class="sc-js-input scFormObjectOdd css_rate_ona_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_rate_ona" type=text name="rate_ona" value="<?php echo $this->form_encode_input($rate_ona) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> alt="{datatype: 'decimal', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_ona']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_ona']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['rate_ona']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['rate_ona']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_rate_ona_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_rate_ona_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['tax_ona']))
    {
        $this->nm_new_label['tax_ona'] = "Tax ONA";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tax_ona = $this->tax_ona;
   $sStyleHidden_tax_ona = '';
   if (isset($this->nmgp_cmp_hidden['tax_ona']) && $this->nmgp_cmp_hidden['tax_ona'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tax_ona']);
       $sStyleHidden_tax_ona = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tax_ona = 'display: none;';
   $sStyleReadInp_tax_ona = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tax_ona']) && $this->nmgp_cmp_readonly['tax_ona'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tax_ona']);
       $sStyleReadLab_tax_ona = '';
       $sStyleReadInp_tax_ona = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tax_ona']) && $this->nmgp_cmp_hidden['tax_ona'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tax_ona" value="<?php echo $this->form_encode_input($tax_ona) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_tax_ona_label" id="hidden_field_label_tax_ona" style="<?php echo $sStyleHidden_tax_ona; ?>"><span id="id_label_tax_ona"><?php echo $this->nm_new_label['tax_ona']; ?></span></TD>
    <TD class="scFormDataOdd css_tax_ona_line" id="hidden_field_data_tax_ona" style="<?php echo $sStyleHidden_tax_ona; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tax_ona_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tax_ona"]) &&  $this->nmgp_cmp_readonly["tax_ona"] == "on") { 

 ?>
<input type="hidden" name="tax_ona" value="<?php echo $this->form_encode_input($tax_ona) . "\">" . $tax_ona . ""; ?>
<?php } else { ?>
<span id="id_read_on_tax_ona" class="sc-ui-readonly-tax_ona css_tax_ona_line" style="<?php echo $sStyleReadLab_tax_ona; ?>"><?php echo $this->form_format_readonly("tax_ona", $this->form_encode_input($this->tax_ona)); ?></span><span id="id_read_off_tax_ona" class="css_read_off_tax_ona<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tax_ona; ?>">
 <input class="sc-js-input scFormObjectOdd css_tax_ona_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tax_ona" type=text name="tax_ona" value="<?php echo $this->form_encode_input($tax_ona) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> alt="{datatype: 'currency', currencySymbol: '<?php echo $this->field_config['tax_ona']['symbol_mon']; ?>', currencyPosition: '<?php echo ((1 == $this->field_config['tax_ona']['format_pos'] || 3 == $this->field_config['tax_ona']['format_pos']) ? 'left' : 'right'); ?>', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['tax_ona']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['tax_ona']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['tax_ona']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['tax_ona']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tax_ona_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tax_ona_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['rate_fdu']))
    {
        $this->nm_new_label['rate_fdu'] = "FDU";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $rate_fdu = $this->rate_fdu;
   $sStyleHidden_rate_fdu = '';
   if (isset($this->nmgp_cmp_hidden['rate_fdu']) && $this->nmgp_cmp_hidden['rate_fdu'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['rate_fdu']);
       $sStyleHidden_rate_fdu = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_rate_fdu = 'display: none;';
   $sStyleReadInp_rate_fdu = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['rate_fdu']) && $this->nmgp_cmp_readonly['rate_fdu'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['rate_fdu']);
       $sStyleReadLab_rate_fdu = '';
       $sStyleReadInp_rate_fdu = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['rate_fdu']) && $this->nmgp_cmp_hidden['rate_fdu'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="rate_fdu" value="<?php echo $this->form_encode_input($rate_fdu) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_rate_fdu_label" id="hidden_field_label_rate_fdu" style="<?php echo $sStyleHidden_rate_fdu; ?>"><span id="id_label_rate_fdu"><?php echo $this->nm_new_label['rate_fdu']; ?></span></TD>
    <TD class="scFormDataOdd css_rate_fdu_line" id="hidden_field_data_rate_fdu" style="<?php echo $sStyleHidden_rate_fdu; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_rate_fdu_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["rate_fdu"]) &&  $this->nmgp_cmp_readonly["rate_fdu"] == "on") { 

 ?>
<input type="hidden" name="rate_fdu" value="<?php echo $this->form_encode_input($rate_fdu) . "\">" . $rate_fdu . ""; ?>
<?php } else { ?>
<span id="id_read_on_rate_fdu" class="sc-ui-readonly-rate_fdu css_rate_fdu_line" style="<?php echo $sStyleReadLab_rate_fdu; ?>"><?php echo $this->form_format_readonly("rate_fdu", $this->form_encode_input($this->rate_fdu)); ?></span><span id="id_read_off_rate_fdu" class="css_read_off_rate_fdu<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_rate_fdu; ?>">
 <input class="sc-js-input scFormObjectOdd css_rate_fdu_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_rate_fdu" type=text name="rate_fdu" value="<?php echo $this->form_encode_input($rate_fdu) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> alt="{datatype: 'decimal', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_fdu']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_fdu']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['rate_fdu']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['rate_fdu']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_rate_fdu_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_rate_fdu_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['tax_fdu']))
    {
        $this->nm_new_label['tax_fdu'] = "Tax FDU";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tax_fdu = $this->tax_fdu;
   $sStyleHidden_tax_fdu = '';
   if (isset($this->nmgp_cmp_hidden['tax_fdu']) && $this->nmgp_cmp_hidden['tax_fdu'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tax_fdu']);
       $sStyleHidden_tax_fdu = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tax_fdu = 'display: none;';
   $sStyleReadInp_tax_fdu = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tax_fdu']) && $this->nmgp_cmp_readonly['tax_fdu'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tax_fdu']);
       $sStyleReadLab_tax_fdu = '';
       $sStyleReadInp_tax_fdu = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tax_fdu']) && $this->nmgp_cmp_hidden['tax_fdu'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tax_fdu" value="<?php echo $this->form_encode_input($tax_fdu) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_tax_fdu_label" id="hidden_field_label_tax_fdu" style="<?php echo $sStyleHidden_tax_fdu; ?>"><span id="id_label_tax_fdu"><?php echo $this->nm_new_label['tax_fdu']; ?></span></TD>
    <TD class="scFormDataOdd css_tax_fdu_line" id="hidden_field_data_tax_fdu" style="<?php echo $sStyleHidden_tax_fdu; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tax_fdu_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tax_fdu"]) &&  $this->nmgp_cmp_readonly["tax_fdu"] == "on") { 

 ?>
<input type="hidden" name="tax_fdu" value="<?php echo $this->form_encode_input($tax_fdu) . "\">" . $tax_fdu . ""; ?>
<?php } else { ?>
<span id="id_read_on_tax_fdu" class="sc-ui-readonly-tax_fdu css_tax_fdu_line" style="<?php echo $sStyleReadLab_tax_fdu; ?>"><?php echo $this->form_format_readonly("tax_fdu", $this->form_encode_input($this->tax_fdu)); ?></span><span id="id_read_off_tax_fdu" class="css_read_off_tax_fdu<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tax_fdu; ?>">
 <input class="sc-js-input scFormObjectOdd css_tax_fdu_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tax_fdu" type=text name="tax_fdu" value="<?php echo $this->form_encode_input($tax_fdu) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> alt="{datatype: 'currency', currencySymbol: '<?php echo $this->field_config['tax_fdu']['symbol_mon']; ?>', currencyPosition: '<?php echo ((1 == $this->field_config['tax_fdu']['format_pos'] || 3 == $this->field_config['tax_fdu']['format_pos']) ? 'left' : 'right'); ?>', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['tax_fdu']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['tax_fdu']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['tax_fdu']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['tax_fdu']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tax_fdu_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tax_fdu_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['field02']))
    {
        $this->nm_new_label['field02'] = "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $field02 = $this->field02;
   $sStyleHidden_field02 = '';
   if (isset($this->nmgp_cmp_hidden['field02']) && $this->nmgp_cmp_hidden['field02'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['field02']);
       $sStyleHidden_field02 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_field02 = 'display: none;';
   $sStyleReadInp_field02 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['field02']) && $this->nmgp_cmp_readonly['field02'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['field02']);
       $sStyleReadLab_field02 = '';
       $sStyleReadInp_field02 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['field02']) && $this->nmgp_cmp_hidden['field02'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="field02" value="<?php echo $this->form_encode_input($field02) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_field02_label" id="hidden_field_label_field02" style="<?php echo $sStyleHidden_field02; ?>"><span id="id_label_field02"><?php echo $this->nm_new_label['field02']; ?></span></TD>
    <TD class="scFormDataOdd css_field02_line" id="hidden_field_data_field02" style="<?php echo $sStyleHidden_field02; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_field02_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="field02" value="<?php echo $this->form_encode_input($field02); ?>"><span id="id_ajax_label_field02"><?php echo nl2br($field02); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_field02_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_field02_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['rate_iris']))
    {
        $this->nm_new_label['rate_iris'] = "Tax IRI";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $rate_iris = $this->rate_iris;
   $sStyleHidden_rate_iris = '';
   if (isset($this->nmgp_cmp_hidden['rate_iris']) && $this->nmgp_cmp_hidden['rate_iris'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['rate_iris']);
       $sStyleHidden_rate_iris = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_rate_iris = 'display: none;';
   $sStyleReadInp_rate_iris = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['rate_iris']) && $this->nmgp_cmp_readonly['rate_iris'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['rate_iris']);
       $sStyleReadLab_rate_iris = '';
       $sStyleReadInp_rate_iris = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['rate_iris']) && $this->nmgp_cmp_hidden['rate_iris'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="rate_iris" value="<?php echo $this->form_encode_input($rate_iris) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_rate_iris_label" id="hidden_field_label_rate_iris" style="<?php echo $sStyleHidden_rate_iris; ?>"><span id="id_label_rate_iris"><?php echo $this->nm_new_label['rate_iris']; ?></span></TD>
    <TD class="scFormDataOdd css_rate_iris_line" id="hidden_field_data_rate_iris" style="<?php echo $sStyleHidden_rate_iris; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_rate_iris_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["rate_iris"]) &&  $this->nmgp_cmp_readonly["rate_iris"] == "on") { 

 ?>
<input type="hidden" name="rate_iris" value="<?php echo $this->form_encode_input($rate_iris) . "\">" . $rate_iris . ""; ?>
<?php } else { ?>
<span id="id_read_on_rate_iris" class="sc-ui-readonly-rate_iris css_rate_iris_line" style="<?php echo $sStyleReadLab_rate_iris; ?>"><?php echo $this->form_format_readonly("rate_iris", $this->form_encode_input($this->rate_iris)); ?></span><span id="id_read_off_rate_iris" class="css_read_off_rate_iris<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_rate_iris; ?>">
 <input class="sc-js-input scFormObjectOdd css_rate_iris_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_rate_iris" type=text name="rate_iris" value="<?php echo $this->form_encode_input($rate_iris) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> alt="{datatype: 'currency', currencySymbol: '<?php echo $this->field_config['rate_iris']['symbol_mon']; ?>', currencyPosition: '<?php echo ((1 == $this->field_config['rate_iris']['format_pos'] || 3 == $this->field_config['rate_iris']['format_pos']) ? 'left' : 'right'); ?>', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_iris']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_iris']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['rate_iris']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['rate_iris']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_rate_iris_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_rate_iris_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['rate_fixed']))
    {
        $this->nm_new_label['rate_fixed'] = "" . $this->Ini->Nm_lang['lang_rate_fixed'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $rate_fixed = $this->rate_fixed;
   $sStyleHidden_rate_fixed = '';
   if (isset($this->nmgp_cmp_hidden['rate_fixed']) && $this->nmgp_cmp_hidden['rate_fixed'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['rate_fixed']);
       $sStyleHidden_rate_fixed = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_rate_fixed = 'display: none;';
   $sStyleReadInp_rate_fixed = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['rate_fixed']) && $this->nmgp_cmp_readonly['rate_fixed'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['rate_fixed']);
       $sStyleReadLab_rate_fixed = '';
       $sStyleReadInp_rate_fixed = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['rate_fixed']) && $this->nmgp_cmp_hidden['rate_fixed'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="rate_fixed" value="<?php echo $this->form_encode_input($rate_fixed) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_rate_fixed_label" id="hidden_field_label_rate_fixed" style="<?php echo $sStyleHidden_rate_fixed; ?>"><span id="id_label_rate_fixed"><?php echo $this->nm_new_label['rate_fixed']; ?></span></TD>
    <TD class="scFormDataOdd css_rate_fixed_line" id="hidden_field_data_rate_fixed" style="<?php echo $sStyleHidden_rate_fixed; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_rate_fixed_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["rate_fixed"]) &&  $this->nmgp_cmp_readonly["rate_fixed"] == "on") { 

 ?>
<input type="hidden" name="rate_fixed" value="<?php echo $this->form_encode_input($rate_fixed) . "\">" . $rate_fixed . ""; ?>
<?php } else { ?>
<span id="id_read_on_rate_fixed" class="sc-ui-readonly-rate_fixed css_rate_fixed_line" style="<?php echo $sStyleReadLab_rate_fixed; ?>"><?php echo $this->form_format_readonly("rate_fixed", $this->form_encode_input($this->rate_fixed)); ?></span><span id="id_read_off_rate_fixed" class="css_read_off_rate_fixed<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_rate_fixed; ?>">
 <input class="sc-js-input scFormObjectOdd css_rate_fixed_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_rate_fixed" type=text name="rate_fixed" value="<?php echo $this->form_encode_input($rate_fixed) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> alt="{datatype: 'currency', currencySymbol: '<?php echo $this->field_config['rate_fixed']['symbol_mon']; ?>', currencyPosition: '<?php echo ((1 == $this->field_config['rate_fixed']['format_pos'] || 3 == $this->field_config['rate_fixed']['format_pos']) ? 'left' : 'right'); ?>', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_fixed']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_fixed']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['rate_fixed']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['rate_fixed']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_rate_fixed_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_rate_fixed_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['revenu_net']))
    {
        $this->nm_new_label['revenu_net'] = "" . $this->Ini->Nm_lang['lang_revenu_net'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $revenu_net = $this->revenu_net;
   $sStyleHidden_revenu_net = '';
   if (isset($this->nmgp_cmp_hidden['revenu_net']) && $this->nmgp_cmp_hidden['revenu_net'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['revenu_net']);
       $sStyleHidden_revenu_net = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_revenu_net = 'display: none;';
   $sStyleReadInp_revenu_net = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['revenu_net']) && $this->nmgp_cmp_readonly['revenu_net'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['revenu_net']);
       $sStyleReadLab_revenu_net = '';
       $sStyleReadInp_revenu_net = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['revenu_net']) && $this->nmgp_cmp_hidden['revenu_net'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="revenu_net" value="<?php echo $this->form_encode_input($revenu_net) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_revenu_net_label" id="hidden_field_label_revenu_net" style="<?php echo $sStyleHidden_revenu_net; ?>"><span id="id_label_revenu_net"><?php echo $this->nm_new_label['revenu_net']; ?></span></TD>
    <TD class="scFormDataOdd css_revenu_net_line" id="hidden_field_data_revenu_net" style="<?php echo $sStyleHidden_revenu_net; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_revenu_net_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["revenu_net"]) &&  $this->nmgp_cmp_readonly["revenu_net"] == "on") { 

 ?>
<input type="hidden" name="revenu_net" value="<?php echo $this->form_encode_input($revenu_net) . "\">" . $revenu_net . ""; ?>
<?php } else { ?>
<span id="id_read_on_revenu_net" class="sc-ui-readonly-revenu_net css_revenu_net_line" style="<?php echo $sStyleReadLab_revenu_net; ?>"><?php echo $this->form_format_readonly("revenu_net", $this->form_encode_input($this->revenu_net)); ?></span><span id="id_read_off_revenu_net" class="css_read_off_revenu_net<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_revenu_net; ?>">
 <input class="sc-js-input scFormObjectOdd css_revenu_net_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_revenu_net" type=text name="revenu_net" value="<?php echo $this->form_encode_input($revenu_net) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> alt="{datatype: 'currency', currencySymbol: '<?php echo $this->field_config['revenu_net']['symbol_mon']; ?>', currencyPosition: '<?php echo ((1 == $this->field_config['revenu_net']['format_pos'] || 3 == $this->field_config['revenu_net']['format_pos']) ? 'left' : 'right'); ?>', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['revenu_net']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['revenu_net']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['revenu_net']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['revenu_net']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_revenu_net_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_revenu_net_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_3"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_3" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_3" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="1" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf3\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_exp . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;\" class=\"scFormBlockAlign\">"; } ?><?php echo $this->Ini->Nm_lang['lang_employee_folder'] ?><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr style=\"display: none;\">"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['block_note']))
    {
        $this->nm_new_label['block_note'] = "Note";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $block_note = $this->block_note;
   $sStyleHidden_block_note = '';
   if (isset($this->nmgp_cmp_hidden['block_note']) && $this->nmgp_cmp_hidden['block_note'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['block_note']);
       $sStyleHidden_block_note = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_block_note = 'display: none;';
   $sStyleReadInp_block_note = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['block_note']) && $this->nmgp_cmp_readonly['block_note'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['block_note']);
       $sStyleReadLab_block_note = '';
       $sStyleReadInp_block_note = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['block_note']) && $this->nmgp_cmp_hidden['block_note'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="block_note" value="<?php echo $this->form_encode_input($block_note) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_block_note_line" id="hidden_field_data_block_note" style="<?php echo $sStyleHidden_block_note; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td width="100%" class="scFormDataFontOdd css_block_note_line" style="vertical-align: top;padding: 0px">
<?php
 if (isset($_SESSION['scriptcase']['dashboard_scinit'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['dashboard_app'] ][ $this->Ini->sc_lig_target['C_@scinf_Block_note'] ]) && '' != $_SESSION['scriptcase']['dashboard_scinit'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['dashboard_app'] ][ $this->Ini->sc_lig_target['C_@scinf_Block_note'] ]) {
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] = $_SESSION['scriptcase']['dashboard_scinit'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['dashboard_app'] ][ $this->Ini->sc_lig_target['C_@scinf_Block_note'] ];
 }
 else {
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] = $this->Ini->sc_page;
 }
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] ]['form_tbl_note_employee']['embutida_proc']  = false;
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] ]['form_tbl_note_employee']['embutida_form']  = true;
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] ]['form_tbl_note_employee']['embutida_call']  = true;
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] ]['form_tbl_note_employee']['embutida_multi'] = false;
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] ]['form_tbl_note_employee']['embutida_liga_form_insert'] = 'on';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] ]['form_tbl_note_employee']['embutida_liga_form_update'] = 'on';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] ]['form_tbl_note_employee']['embutida_liga_form_delete'] = 'on';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] ]['form_tbl_note_employee']['embutida_liga_form_btn_nav'] = 'off';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] ]['form_tbl_note_employee']['embutida_liga_grid_edit'] = 'on';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] ]['form_tbl_note_employee']['embutida_liga_grid_edit_link'] = 'on';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] ]['form_tbl_note_employee']['embutida_liga_qtd_reg'] = '5';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] ]['form_tbl_note_employee']['embutida_liga_tp_pag'] = 'parcial';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] ]['form_tbl_note_employee']['embutida_parms'] = "NM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scoutlink_remove_margin*scinok*scoutlink_remove_border*scinok*scout";
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] ]['form_tbl_note_employee']['foreign_key']['userid_int'] = $this->nmgp_dados_form['userid_int'];
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] ]['form_tbl_note_employee']['where_filter'] = "userid_int = " . $this->nmgp_dados_form['userid_int'] . "";
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] ]['form_tbl_note_employee']['where_detal']  = "userid_int = " . $this->nmgp_dados_form['userid_int'] . "";
 if ($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] ]['form_FicheEmployeeSuspended']['total'] < 0)
 {
     $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init'] ]['form_tbl_note_employee']['where_filter'] = "1 <> 1";
 }
 $sDetailSrc = ('novo' == $this->nmgp_opcao) ? 'form_FicheEmployeeSuspended_empty.htm' : $this->Ini->link_form_tbl_note_employee_edit . '?script_case_init=' . $this->form_encode_input($this->Ini->sc_page) . '&script_case_detail=Y&sc_ifr_height=500';
if (isset($this->Ini->sc_lig_target['C_@scinf_Block_note']) && 'nmsc_iframe_liga_form_tbl_note_employee' != $this->Ini->sc_lig_target['C_@scinf_Block_note'])
{
    if ('novo' != $this->nmgp_opcao)
    {
        $sDetailSrc .= '&under_dashboard=1&dashboard_app=' . $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['dashboard_app'] . '&own_widget=' . $this->Ini->sc_lig_target['C_@scinf_Block_note'] . '&parent_widget=' . $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['own_widget'];
        $sDetailSrc  = $this->addUrlParam($sDetailSrc, 'script_case_init', $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['form_tbl_note_employee_script_case_init']);
    }
?>
<script type="text/javascript">
$(function() {
    scOpenMasterDetail("<?php echo $this->Ini->sc_lig_target['C_@scinf_Block_note'] ?>", "<?php echo $sDetailSrc; ?>");
});
</script>
<?php
}
else
{
?>
<iframe border="0" id="nmsc_iframe_liga_form_tbl_note_employee"  marginWidth="0" marginHeight="0" frameborder="0" valign="top" height="500" width="100%" name="nmsc_iframe_liga_form_tbl_note_employee"  scrolling="auto" src="<?php echo $sDetailSrc; ?>"></iframe>
<?php
}
?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_block_note_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_block_note_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






   </td></tr></table>
   </tr>
</TABLE></div><!-- bloco_f -->
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['birpara'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "birpara", "scBtnFn_sys_GridPermiteSeq('b')", "scBtnFn_sys_GridPermiteSeq('b')", "brec_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
?> 
   <input type="text" class="scFormToolbarInput" name="nmgp_rec_b" value="" style="width:25px;vertical-align: middle;"/> 
<?php 
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['first'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "binicio", "scBtnFn_sys_format_ini()", "scBtnFn_sys_format_ini()", "sc_b_ini_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Shift + &#8592;)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['back'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bretorna", "scBtnFn_sys_format_ret()", "scBtnFn_sys_format_ret()", "sc_b_ret_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + &#8592;)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
if ($opcao_botoes != "novo" && $this->nmgp_botoes['navpage'] == "on")
{
?> 
     <span nowrap id="sc_b_navpage_b"></span> 
<?php 
}
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['forward'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bavanca", "scBtnFn_sys_format_ava()", "scBtnFn_sys_format_ava()", "sc_b_avc_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + &#8594;)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['btn_label']['last'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bfinal", "scBtnFn_sys_format_fim()", "scBtnFn_sys_format_fim()", "sc_b_fim_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Shift + &#8594;)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
if ($opcao_botoes != "novo" && $this->nmgp_botoes['summary'] == "on")
{
?> 
     <span nowrap id="sc_b_summary_b"></span> 
<?php 
}
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 'b');</script><?php } ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
<?php
      $Tzone = ini_get('date.timezone');
      if (empty($Tzone))
      {
?>
<script> 
  _scAjaxShowMessage({title: '', message: "<?php echo $this->Ini->Nm_lang['lang_errm_tz']; ?>", isModal: false, timeout: 0, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: true, showBodyIcon: false, isToast: false, toastPos: ""});
</script> 
<?php
      }
?>
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0,1,2,3);

  foreach ($this->Ini->nm_hidden_blocos as $bloco => $hidden)
  {
      if ($hidden == "off" && in_array($bloco, $nm_sc_blocos_da_pag))
      {
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.visibility = 'hidden';";
          if (isset($nm_sc_blocos_aba[$bloco]))
          {
               echo "document.getElementById('id_tabs_" . $nm_sc_blocos_aba[$bloco] . "_" . $bloco . "').style.display = 'none';";
          }
      }
  }
?>
$(window).bind("load", function() {
<?php
  $nm_sc_blocos_da_pag = array(0,1,2,3);

  foreach ($this->Ini->nm_hidden_blocos as $bloco => $hidden)
  {
      if ($hidden == "off" && in_array($bloco, $nm_sc_blocos_da_pag))
      {
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.display = 'none';";
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.visibility = '';";
      }
  }
?>
});
</script> 
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_FicheEmployeeSuspended");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_FicheEmployeeSuspended");
 parent.scAjaxDetailHeight("form_FicheEmployeeSuspended", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_FicheEmployeeSuspended", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_FicheEmployeeSuspended", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['sc_modal'])
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
        function scBtnFn_sys_format_alt() {
                if ($("#sc_b_upd_t.sc-unique-btn-1").length && $("#sc_b_upd_t.sc-unique-btn-1").is(":visible")) {
                    if ($("#sc_b_upd_t.sc-unique-btn-1").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('alterar');
                         return;
                }
        }
        function scBtnFn_Historic_Salary() {
                if ($("#sc_Historic_Salary_top").length && $("#sc_Historic_Salary_top").is(":visible")) {
                    if ($("#sc_Historic_Salary_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_Historic_Salary()
                         return;
                }
        }
        function scBtnFn_sys_format_reload() {
                if ($("#sc_b_reload_t.sc-unique-btn-2").length && $("#sc_b_reload_t.sc-unique-btn-2").is(":visible")) {
                    if ($("#sc_b_reload_t.sc-unique-btn-2").hasClass("disabled")) {
                        return;
                    }
                        scAjax_formReload();
                         return;
                }
        }
        function scBtnFn_sys_format_hlp() {
                if ($("#sc_b_hlp_t").length && $("#sc_b_hlp_t").is(":visible")) {
                    if ($("#sc_b_hlp_t").hasClass("disabled")) {
                        return;
                    }
                        window.open('<?php echo $this->url_webhelp; ?>', '', 'resizable, scrollbars'); 
                         return;
                }
        }
        function scBtnFn_sys_format_sai() {
                if ($("#sc_b_sai_t.sc-unique-btn-3").length && $("#sc_b_sai_t.sc-unique-btn-3").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-3").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                         return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-4").length && $("#sc_b_sai_t.sc-unique-btn-4").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-4").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                         return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-5").length && $("#sc_b_sai_t.sc-unique-btn-5").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-5").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                         return;
                }
        }
        function scBtnFn_sys_GridPermiteSeq(btnPos) {
                if ($("#brec_b").length && $("#brec_b").is(":visible")) {
                    if ($("#brec_b").hasClass("disabled")) {
                        return;
                    }
                        if (document.F1['nmgp_rec_' + btnPos].value != '') {nm_navpage(document.F1['nmgp_rec_' + btnPos].value, 'P');} document.F1['nmgp_rec_' + btnPos].value = '';
                         return;
                }
        }
        function scBtnFn_sys_format_ini() {
                if ($("#sc_b_ini_b.sc-unique-btn-6").length && $("#sc_b_ini_b.sc-unique-btn-6").is(":visible")) {
                    if ($("#sc_b_ini_b.sc-unique-btn-6").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('inicio');
                         return;
                }
        }
        function scBtnFn_sys_format_ret() {
                if ($("#sc_b_ret_b.sc-unique-btn-7").length && $("#sc_b_ret_b.sc-unique-btn-7").is(":visible")) {
                    if ($("#sc_b_ret_b.sc-unique-btn-7").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('retorna');
                         return;
                }
        }
        function scBtnFn_sys_format_ava() {
                if ($("#sc_b_avc_b.sc-unique-btn-8").length && $("#sc_b_avc_b.sc-unique-btn-8").is(":visible")) {
                    if ($("#sc_b_avc_b.sc-unique-btn-8").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('avanca');
                         return;
                }
        }
        function scBtnFn_sys_format_fim() {
                if ($("#sc_b_fim_b.sc-unique-btn-9").length && $("#sc_b_fim_b.sc-unique-btn-9").is(":visible")) {
                    if ($("#sc_b_fim_b.sc-unique-btn-9").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('final');
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['buttonStatus'] = $this->nmgp_botoes;
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
