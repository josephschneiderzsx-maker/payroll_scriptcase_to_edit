<?php
class form_tax_form extends form_tax_apl
{
function Form_Init()
{
   global $sc_seq_vert, $nm_apl_dependente, $opcao_botoes, $nm_url_saida; 
?>
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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("ADD TAX"); } else { echo strip_tags("EDIT TAX"); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
 <META http-equiv="Pragma" content="no-cache" />
 <link rel="shortcut icon" href="../_lib/img/sys__NM__ico__NM__favicon (2).ico">
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
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
<?php
if ($this->Embutida_form && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['sc_modal'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['sc_redir_atualiz'] == 'ok')
{
?>
  var sc_closeChange = true;
<?php
}
else
{
?>
  var sc_closeChange = false;
<?php
}
?>
 </SCRIPT>
        <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
<style type="text/css">
.ui-datepicker { z-index: 6 !important }
</style>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>frameControl.js"></script>
<?php
foreach ($this->Ini->tippy_themes as $tippyTheme => $tippyThemeInfo) {
?>
 <link rel="stylesheet" href="<?php echo $tippyThemeInfo['file'] ?>" />
<?php
}
?>
 <script src="<?php echo $this->Ini->path_prod; ?>/third/tippyjs/popper.min.js"></script>
 <script src="<?php echo $this->Ini->path_prod; ?>/third/tippyjs/tippy-bundle.umd.min.js"></script>
 <script>
  $(function() {
  });
 </script>
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
   .scFormLabelOddMult a img[src$='<?php echo $this->Ini->Label_sort_desc ?>'], 
   .scFormLabelOddMult a img[src$='<?php echo $this->Ini->Label_sort_asc ?>']{opacity:1!important;} 
   .scFormLabelOddMult a img{opacity:0;transition:all .2s;} 
   .scFormLabelOddMult:HOVER a img{opacity:1;transition:all .2s;} 
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
.css_read_off_dob_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_hiredate_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_firedate_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_start_date_cons_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_end_date_cons_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_incentive_startdate_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_incentive_enddate_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_rappel_startdate_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_rappel_enddate_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_date_loan_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_date_payment_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_date_adjustment_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_loan_start_deduct_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_loan_end_deduct_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_date_loan_bank_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_loan_start_deduct_bank_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_loan_end_deduct_bank_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_date_other_loan_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_other_loan_start_deduct_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_other_loan_end_deduct_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_date_purchase_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_purchase_start_deduct_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_purchase_end_deduct_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_update_time_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_btngrp.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_btngrp<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" media="screen" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_tax/form_tax_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_tax_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['last'] : 'off'); ?>";
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
    nm_sumario = "[<?php echo $this->Ini->Nm_lang['lang_othr_smry_info']?>]";
    nm_sumario = nm_sumario.replace("?start?", reg_ini);
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

include_once('form_tax_jquery.php');

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

  $(".scBtnGrpText").mouseover(function() { $(this).addClass("scBtnGrpTextOver"); }).mouseout(function() { $(this).removeClass("scBtnGrpTextOver"); });
     $(".scBtnGrpClick").mouseup(function(){
          event.preventDefault();
          if(event.target !== event.currentTarget) return;
          if($(this).find("a").prop('href') != '')
          {
              $(this).find("a").click();
          }
          else
          {
              eval($(this).find("a").prop('onclick'));
          }
  });

  scJQGeneralAdd();

  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

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
   });
   function SC_btn_grp_text() {
      $(".scBtnGrpText").mouseover(function() { $(this).addClass("scBtnGrpTextOver"); }).mouseout(function() { $(this).removeClass("scBtnGrpTextOver"); });
   };
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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['recarga'];
}
if ('novo' == $opcao_botoes && $this->Embutida_form)
{
    $opcao_botoes = 'inicio';
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['link_info']['remove_border']) {
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
 include_once("form_tax_js0.php");
?>
<script type="text/javascript"> 
  sc_quant_excl = <?php if (!isset($sc_check_excl)) {$sc_check_excl = array();} echo count($sc_check_excl); ?>; 
  <?php if (!isset($sc_check_incl)) {$sc_check_incl = array();}?>; 
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
<input type="hidden" name="nmgp_url_saida" value="">
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
<?php
$_SESSION['scriptcase']['error_span_title']['form_tax'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_tax'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['fast_search'][2] : "";
          $stateSearchIconClose  = 'none';
          $stateSearchIconSearch = '';
          if(!empty($OPC_dat))
          {
              $stateSearchIconClose  = '';
              $stateSearchIconSearch = 'none';
          }
?> 
           <script type="text/javascript">var change_fast_t = "";</script>
          <select id='fast_search_f0_t'   class="scFormToolbarInput" style="vertical-align: middle;" name="nmgp_fast_search_t" onChange="change_fast_t = 'CH';">
<?php 
          $SC_Label_atu['SC_all_Cmp'] = $this->Ini->Nm_lang['lang_srch_all_fields']; 
          $SC_Label_atu['userid_int_'] = (isset($this->nm_new_label['userid_int_'])) ? $this->nm_new_label['userid_int_'] : 'ID'; 
          $SC_Label_atu['employee_name_'] = (isset($this->nm_new_label['employee_name_'])) ? $this->nm_new_label['employee_name_'] : '' . $this->Ini->Nm_lang['lang_username'] . ''; 
          $SC_Label_atu['dept_'] = (isset($this->nm_new_label['dept_'])) ? $this->nm_new_label['dept_'] : '' . $this->Ini->Nm_lang['lang_departement'] . ''; 
          $SC_Label_atu['rate_iris_'] = (isset($this->nm_new_label['rate_iris_'])) ? $this->nm_new_label['rate_iris_'] : 'IRI / Salary'; 
          $SC_Label_atu['rate_iric_'] = (isset($this->nm_new_label['rate_iric_'])) ? $this->nm_new_label['rate_iric_'] : 'TCA Add Rate'; 
          $SC_Label_atu['rate_cass_'] = (isset($this->nm_new_label['rate_cass_'])) ? $this->nm_new_label['rate_cass_'] : 'Rate CASS'; 
          $SC_Label_atu['rate_cfgdct_'] = (isset($this->nm_new_label['rate_cfgdct_'])) ? $this->nm_new_label['rate_cfgdct_'] : 'Rate CFGDCT'; 
          $SC_Label_atu['rate_fdu_'] = (isset($this->nm_new_label['rate_fdu_'])) ? $this->nm_new_label['rate_fdu_'] : 'Rate FDU'; 
          $SC_Label_atu['rate_ona_'] = (isset($this->nm_new_label['rate_ona_'])) ? $this->nm_new_label['rate_ona_'] : 'Rate ONA'; 
          $SC_Label_atu['rate_tms_'] = (isset($this->nm_new_label['rate_tms_'])) ? $this->nm_new_label['rate_tms_'] : 'Rate TMS'; 
          $SC_Label_atu['rate_stamp_'] = (isset($this->nm_new_label['rate_stamp_'])) ? $this->nm_new_label['rate_stamp_'] : 'Rate STAMP'; 
          foreach ($SC_Label_atu as $CMP => $LABEL)
          {
              $OPC_sel = ($CMP == $OPC_cmp) ? " selected" : "";
              echo "           <option value='" . $CMP . "'" . $OPC_sel . ">" . $LABEL . "</option>";
          }
?> 
          </select>
          <select id='cond_fast_search_f0_t' class="scFormToolbarInput" style="vertical-align: middle;display:none;" name="nmgp_cond_fast_search_t" onChange="change_fast_t = 'CH';">
<?php 
          $OPC_sel = ("qp" == $OPC_arg) ? " selected" : "";
           echo "           <option value='qp'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_like'] . "</option>";
?> 
          </select>
          <span id="quicksearchph_t" class="scFormToolbarInput" style='display: inline-block; vertical-align: inherit'>
              <span>
                  <input type="text" id="SC_fast_search_t" class="scFormToolbarInputText" style="border-width: 0px;;" name="nmgp_arg_fast_search_t" value="<?php echo $this->form_encode_input($OPC_dat) ?>" size="10" onChange="change_fast_t = 'CH';" alt="{maxLength: 255}" placeholder="<?php echo $this->Ini->Nm_lang['lang_othr_qk_watermark'] ?>">&nbsp;
                  <img style="display: <?php echo $stateSearchIconSearch ?>; "  id="SC_fast_search_submit_t" class='css_toolbar_obj_qs_search_img' src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_search; ?>" onclick="scQuickSearchSubmit_t();">
                  <img style="display: <?php echo $stateSearchIconClose ?>; " id="SC_fast_search_close_t" class='css_toolbar_obj_qs_search_img' src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_clean; ?>" onclick="document.getElementById('SC_fast_search_t').value = '__Clear_Fast__'; nm_move('fast_search', 't');">
              </span>
          </span>  </div>
  <?php
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if (($opcao_botoes != "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['balterarsel']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['balterarsel']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['balterarsel']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['balterarsel']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['balterarsel'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterarsel", "scBtnFn_sys_format_alt()", "scBtnFn_sys_format_alt()", "sc_b_upd_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + S)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['sc_btn_0'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['sc_btn_0']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['sc_btn_0']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['sc_btn_0']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['sc_btn_0']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['sc_btn_0'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "sc_btn_0", "scBtnFn_sc_btn_0()", "scBtnFn_sc_btn_0()", "sc_sc_btn_0_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "Update TCA Add";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['group_group_1']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['group_group_1']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_1']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_1']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_1'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "group_group_1", "scBtnGrpShow('group_1_t')", "scBtnGrpShow('group_1_t')", "sc_btgp_btn_group_1_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "__sc_grp__", '', '', '', '', '', '', '', '', "");?>
 
<?php
echo nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 't', 'app', 'ini');
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['reset_tcaadd'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['reset_tcaadd']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['reset_tcaadd']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_tcaadd']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_tcaadd']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_tcaadd'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_reset_tcaadd_top">
<?php echo nmButtonOutput($this->arr_buttons, "reset_tcaadd", "scBtnFn_reset_tcaadd()", "scBtnFn_reset_tcaadd()", "sc_reset_tcaadd_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_1", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['TcaAddByDept'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['tcaaddbydept']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['tcaaddbydept']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['tcaaddbydept']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['tcaaddbydept']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['tcaaddbydept'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_TcaAddByDept_top">
<?php echo nmButtonOutput($this->arr_buttons, "tcaaddbydept", "scBtnFn_TcaAddByDept()", "scBtnFn_TcaAddByDept()", "sc_TcaAddByDept_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_1", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['TcaAddByValue'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['tcaaddbyvalue']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['tcaaddbyvalue']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['tcaaddbyvalue']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['tcaaddbyvalue']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['tcaaddbyvalue'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_TcaAddByValue_top">
<?php echo nmButtonOutput($this->arr_buttons, "tcaaddbyvalue", "scBtnFn_TcaAddByValue()", "scBtnFn_TcaAddByValue()", "sc_TcaAddByValue_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_1", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
echo nmButtonGroupTableOutput($this->arr_buttons, "", '', '', '', 'fim');
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "Update CASS";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['group_group_2']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['group_group_2']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_2']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_2']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_2'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "group_group_2", "scBtnGrpShow('group_2_t')", "scBtnGrpShow('group_2_t')", "sc_btgp_btn_group_2_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "__sc_grp__", '', '', '', '', '', '', '', '', "");?>
 
<?php
echo nmButtonGroupTableOutput($this->arr_buttons, "group_group_2", 'group_2', 't', 'app', 'ini');
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['reset_cass'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['reset_cass']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['reset_cass']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_cass']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_cass']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_cass'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_reset_cass_top">
<?php echo nmButtonOutput($this->arr_buttons, "reset_cass", "scBtnFn_reset_cass()", "scBtnFn_reset_cass()", "sc_reset_cass_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_2", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['CassByDept'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['cassbydept']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['cassbydept']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['cassbydept']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['cassbydept']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['cassbydept'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_CassByDept_top">
<?php echo nmButtonOutput($this->arr_buttons, "cassbydept", "scBtnFn_CassByDept()", "scBtnFn_CassByDept()", "sc_CassByDept_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_2", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['CassByValue'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['cassbyvalue']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['cassbyvalue']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['cassbyvalue']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['cassbyvalue']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['cassbyvalue'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_CassByValue_top">
<?php echo nmButtonOutput($this->arr_buttons, "cassbyvalue", "scBtnFn_CassByValue()", "scBtnFn_CassByValue()", "sc_CassByValue_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_2", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
echo nmButtonGroupTableOutput($this->arr_buttons, "", '', '', '', 'fim');
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "Update CFGDCT";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['group_group_3']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['group_group_3']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_3']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_3']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_3'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "group_group_3", "scBtnGrpShow('group_3_t')", "scBtnGrpShow('group_3_t')", "sc_btgp_btn_group_3_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "__sc_grp__", '', '', '', '', '', '', '', '', "");?>
 
<?php
echo nmButtonGroupTableOutput($this->arr_buttons, "group_group_3", 'group_3', 't', 'app', 'ini');
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['reset_cfgdct'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['reset_cfgdct']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['reset_cfgdct']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_cfgdct']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_cfgdct']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_cfgdct'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_reset_cfgdct_top">
<?php echo nmButtonOutput($this->arr_buttons, "reset_cfgdct", "scBtnFn_reset_cfgdct()", "scBtnFn_reset_cfgdct()", "sc_reset_cfgdct_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_3", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['CfgdctByDept'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['cfgdctbydept']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['cfgdctbydept']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['cfgdctbydept']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['cfgdctbydept']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['cfgdctbydept'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_CfgdctByDept_top">
<?php echo nmButtonOutput($this->arr_buttons, "cfgdctbydept", "scBtnFn_CfgdctByDept()", "scBtnFn_CfgdctByDept()", "sc_CfgdctByDept_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_3", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['CfgdctByValue'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['cfgdctbyvalue']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['cfgdctbyvalue']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['cfgdctbyvalue']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['cfgdctbyvalue']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['cfgdctbyvalue'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_CfgdctByValue_top">
<?php echo nmButtonOutput($this->arr_buttons, "cfgdctbyvalue", "scBtnFn_CfgdctByValue()", "scBtnFn_CfgdctByValue()", "sc_CfgdctByValue_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_3", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
echo nmButtonGroupTableOutput($this->arr_buttons, "", '', '', '', 'fim');
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "Update FDU";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['group_group_4']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['group_group_4']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_4']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_4']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_4'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "group_group_4", "scBtnGrpShow('group_4_t')", "scBtnGrpShow('group_4_t')", "sc_btgp_btn_group_4_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "__sc_grp__", '', '', '', '', '', '', '', '', "");?>
 
<?php
echo nmButtonGroupTableOutput($this->arr_buttons, "group_group_4", 'group_4', 't', 'app', 'ini');
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['reset_fdu'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['reset_fdu']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['reset_fdu']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_fdu']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_fdu']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_fdu'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_reset_fdu_top">
<?php echo nmButtonOutput($this->arr_buttons, "reset_fdu", "scBtnFn_reset_fdu()", "scBtnFn_reset_fdu()", "sc_reset_fdu_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_4", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['FduByDept'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['fdubydept']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['fdubydept']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['fdubydept']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['fdubydept']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['fdubydept'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_FduByDept_top">
<?php echo nmButtonOutput($this->arr_buttons, "fdubydept", "scBtnFn_FduByDept()", "scBtnFn_FduByDept()", "sc_FduByDept_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_4", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['FduByValue'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['fdubyvalue']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['fdubyvalue']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['fdubyvalue']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['fdubyvalue']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['fdubyvalue'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_FduByValue_top">
<?php echo nmButtonOutput($this->arr_buttons, "fdubyvalue", "scBtnFn_FduByValue()", "scBtnFn_FduByValue()", "sc_FduByValue_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_4", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
echo nmButtonGroupTableOutput($this->arr_buttons, "", '', '', '', 'fim');
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "Update ONA";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['group_group_5']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['group_group_5']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_5']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_5']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_5'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "group_group_5", "scBtnGrpShow('group_5_t')", "scBtnGrpShow('group_5_t')", "sc_btgp_btn_group_5_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "__sc_grp__", '', '', '', '', '', '', '', '', "");?>
 
<?php
echo nmButtonGroupTableOutput($this->arr_buttons, "group_group_5", 'group_5', 't', 'app', 'ini');
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['reset_ona'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['reset_ona']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['reset_ona']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_ona']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_ona']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_ona'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_reset_ona_top">
<?php echo nmButtonOutput($this->arr_buttons, "reset_ona", "scBtnFn_reset_ona()", "scBtnFn_reset_ona()", "sc_reset_ona_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_5", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['OnaByDept'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['onabydept']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['onabydept']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['onabydept']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['onabydept']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['onabydept'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_OnaByDept_top">
<?php echo nmButtonOutput($this->arr_buttons, "onabydept", "scBtnFn_OnaByDept()", "scBtnFn_OnaByDept()", "sc_OnaByDept_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_5", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['OnaByValue'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['onabyvalue']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['onabyvalue']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['onabyvalue']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['onabyvalue']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['onabyvalue'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_OnaByValue_top">
<?php echo nmButtonOutput($this->arr_buttons, "onabyvalue", "scBtnFn_OnaByValue()", "scBtnFn_OnaByValue()", "sc_OnaByValue_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_5", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
echo nmButtonGroupTableOutput($this->arr_buttons, "", '', '', '', 'fim');
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "Update TMS";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['group_group_6']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['group_group_6']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_6']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_6']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_6'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "group_group_6", "scBtnGrpShow('group_6_t')", "scBtnGrpShow('group_6_t')", "sc_btgp_btn_group_6_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "__sc_grp__", '', '', '', '', '', '', '', '', "");?>
 
<?php
echo nmButtonGroupTableOutput($this->arr_buttons, "group_group_6", 'group_6', 't', 'app', 'ini');
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['reset_tms'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['reset_tms']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['reset_tms']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_tms']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_tms']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_tms'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_reset_tms_top">
<?php echo nmButtonOutput($this->arr_buttons, "reset_tms", "scBtnFn_reset_tms()", "scBtnFn_reset_tms()", "sc_reset_tms_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_6", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['RateTmsByValue'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['ratetmsbyvalue']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['ratetmsbyvalue']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['ratetmsbyvalue']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['ratetmsbyvalue']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['ratetmsbyvalue'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_RateTmsByValue_top">
<?php echo nmButtonOutput($this->arr_buttons, "ratetmsbyvalue", "scBtnFn_RateTmsByValue()", "scBtnFn_RateTmsByValue()", "sc_RateTmsByValue_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_6", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['RateTmsByDept'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['ratetmsbydept']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['ratetmsbydept']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['ratetmsbydept']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['ratetmsbydept']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['ratetmsbydept'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_RateTmsByDept_top">
<?php echo nmButtonOutput($this->arr_buttons, "ratetmsbydept", "scBtnFn_RateTmsByDept()", "scBtnFn_RateTmsByDept()", "sc_RateTmsByDept_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_6", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
echo nmButtonGroupTableOutput($this->arr_buttons, "", '', '', '', 'fim');
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "Update STAMP";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['group_group_7']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['group_group_7']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_7']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_7']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['group_group_7'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "group_group_7", "scBtnGrpShow('group_7_t')", "scBtnGrpShow('group_7_t')", "sc_btgp_btn_group_7_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "__sc_grp__", '', '', '', '', '', '', '', '', "");?>
 
<?php
echo nmButtonGroupTableOutput($this->arr_buttons, "group_group_7", 'group_7', 't', 'app', 'ini');
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['reset_stamp'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['reset_stamp']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['reset_stamp']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_stamp']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_stamp']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['reset_stamp'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_reset_stamp_top">
<?php echo nmButtonOutput($this->arr_buttons, "reset_stamp", "scBtnFn_reset_stamp()", "scBtnFn_reset_stamp()", "sc_reset_stamp_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_7", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['RateStampByValue'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['ratestampbyvalue']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['ratestampbyvalue']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['ratestampbyvalue']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['ratestampbyvalue']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['ratestampbyvalue'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_RateStampByValue_top">
<?php echo nmButtonOutput($this->arr_buttons, "ratestampbyvalue", "scBtnFn_RateStampByValue()", "scBtnFn_RateStampByValue()", "sc_RateStampByValue_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_7", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['RateStampByDept'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['ratestampbydept']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['ratestampbydept']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['ratestampbydept']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['ratestampbydept']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['ratestampbydept'];
        }
?>
  <div class="scBtnGrpText scBtnGrpClick"  style="<?php echo $sCondStyle; ?>" id="gbl_sc_RateStampByDept_top">
<?php echo nmButtonOutput($this->arr_buttons, "ratestampbydept", "scBtnFn_RateStampByDept()", "scBtnFn_RateStampByDept()", "sc_RateStampByDept_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "group_7", '', '', '', '', '', '', '', '', "");?>
  </div>
 
<?php
        $NM_btn = true;
    }
echo nmButtonGroupTableOutput($this->arr_buttons, "", '', '', '', 'fim');
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
        $sCondStyle = ($this->nmgp_botoes['reload'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['breload']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['breload']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['breload']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['breload']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['breload'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (F1)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "R")
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
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['empty_filter'] = true;
       }
       echo "<tr><td>";
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow scBlockRowFirst"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
     <div id="SC_tab_mult_reg">
<?php
}

function Form_Table($Table_refresh = false)
{
   global $sc_seq_vert, $nm_apl_dependente, $opcao_botoes, $nm_url_saida; 
   if ($Table_refresh) 
   { 
       ob_start();
   }
?>
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php
$labelRowCount = 0;
?>
   <tr class="sc-ui-header-row" id="sc-id-fixed-headers-row-<?php echo $labelRowCount++ ?>">
<?php
$orderColName = '';
$orderColOrient = '';
$orderColRule = '';
?>
    <script type="text/javascript">
    var orderColName = "", orderColRule = "";
    var alphaIconAsc = "fas fa-sort-alpha-down sc-form-order-icon sc-form-order-icon-unused";
    var alphaIconDesc = "fas fa-sort-alpha-down-alt sc-form-order-icon sc-form-order-icon-unused";
    var numericIconAsc = "fas fa-sort-numeric-down sc-form-order-icon sc-form-order-icon-unused";
    var numericIconDesc = "fas fa-sort-numeric-down-alt sc-form-order-icon sc-form-order-icon-unused";
    var orderFieldList = ["userid_int", "employee_name", "dept", "rate_iris", "rate_iric", "rate_ona", "rate_tms", "rate_stamp"];
    function scSetOrderColumn(clickedColumn)
    {
        let fieldClass;
        scResetOrderColumn();
        if (clickedColumn != orderColName) {
            orderColName = clickedColumn;
            orderColRule = scGetDefaultFieldOrder(orderColName);
        }
        else if ("" != orderColName) {
            orderColRule = "asc" == orderColRule ? "desc" : "asc";
        }
        else {
            orderColName = "";
            orderColRule = "";
        }
        if ("" != orderColName) {
            if (scIsFieldNumeric(orderColName)) {
                if ('desc' == orderColRule) {
                    fieldClass = numericIconDesc;
                } else {
                    fieldClass = numericIconAsc;
                }
            } else {
                if ('desc' == orderColRule) {
                    fieldClass = alphaIconDesc;
                } else {
                    fieldClass = alphaIconAsc;
                }
            }
            $("#hidden_field_label_" + orderColName + "_").find(".sc-form-order-icon").attr("class", fieldClass).removeClass("sc-form-order-icon-unused");
        }
    }
    function scResetOrderColumn()
    {
        if ("" == orderColName) {
            return;
        }
        $("#hidden_field_label_" + orderColName + "_").find(".sc-form-order-icon").attr("class", scGetDefaultFieldOrderIcon(orderColName));
    }
    function scIsFieldNumeric(fieldName)
    {
        switch (fieldName) {
            case "userid_int":
                return true;
            case "rate_iris":
                return true;
            case "rate_iric":
                return true;
            case "rate_cass":
                return true;
            case "rate_cfgdct":
                return true;
            case "rate_fdu":
                return true;
            case "rate_ona":
                return true;
            case "rate_tms":
                return true;
            case "rate_stamp":
                return true;
            case "id":
                return true;
            case "inactif":
                return true;
            case "payperiod":
                return true;
            case "probation_period":
                return true;
            case "rate_work":
                return true;
            case "rate_ot":
                return true;
            case "rate_ot_factor":
                return true;
            case "rate_ot_holiday_factor":
                return true;
            case "rate_ot_offday_factor":
                return true;
            case "rate_ot_restday_factor":
                return true;
            case "rate_day":
                return true;
            case "rate_fixed":
                return true;
            case "rate_restday":
                return true;
            case "rate_offday":
                return true;
            case "rate_commission1":
                return true;
            case "Rate_Prime1":
                return true;
            case "Rate_Omission1":
                return true;
            case "rate_assmd":
                return true;
            case "tax_cass":
                return true;
            case "tax_cfgdct":
                return true;
            case "tax_ona":
                return true;
            case "tax_fdu":
                return true;
            case "rate_cons":
                return true;
            case "day_cons":
                return true;
            case "revenu_net":
                return true;
            case "incentive":
                return true;
            case "apply_incentive":
                return true;
            case "rappel":
                return true;
            case "apply_rappel":
                return true;
            case "extra_insurance":
                return true;
            case "apply_extra_ins":
                return true;
            case "loan":
                return true;
            case "payment":
                return true;
            case "adjustment":
                return true;
            case "loan_deduction":
                return true;
            case "loan_monthlypayment":
                return true;
            case "apply_loan_deduction":
                return true;
            case "loan_bank":
                return true;
            case "loan_deduction_bank":
                return true;
            case "loan_monthlypayment_bank":
                return true;
            case "apply_loan_deduction_bank":
                return true;
            case "other_loan":
                return true;
            case "other_loan_deduction":
                return true;
            case "other_loan_monthlypayment":
                return true;
            case "apply_other_loan_deduction":
                return true;
            case "purchase":
                return true;
            case "purchase_deduct":
                return true;
            case "purchase_monthlypayment":
                return true;
            case "apply_purchase_deduct":
                return true;
            case "health_insurance":
                return true;
            case "other_deduct":
                return true;
            case "statement_balance":
                return true;
            case "hiring_duration":
                return true;
            default:
                return false;
        }
        return false;
    }
    function scGetDefaultFieldOrder(fieldName)
    {
        switch (fieldName) {
            case "userid_int":
                return 'desc';
            case "rate_iris":
                return 'desc';
            case "rate_iric":
                return 'desc';
            case "rate_cass":
                return 'desc';
            case "rate_cfgdct":
                return 'desc';
            case "rate_fdu":
                return 'desc';
            case "rate_ona":
                return 'desc';
            case "rate_tms":
                return 'desc';
            case "rate_stamp":
                return 'desc';
            case "id":
                return 'desc';
            case "DOB":
                return 'desc';
            case "hiredate":
                return 'desc';
            case "firedate":
                return 'desc';
            case "inactif":
                return 'desc';
            case "payperiod":
                return 'desc';
            case "probation_period":
                return 'desc';
            case "rate_work":
                return 'desc';
            case "rate_ot":
                return 'desc';
            case "rate_ot_factor":
                return 'desc';
            case "rate_ot_holiday_factor":
                return 'desc';
            case "rate_ot_offday_factor":
                return 'desc';
            case "rate_ot_restday_factor":
                return 'desc';
            case "rate_day":
                return 'desc';
            case "rate_fixed":
                return 'desc';
            case "rate_restday":
                return 'desc';
            case "rate_offday":
                return 'desc';
            case "rate_commission1":
                return 'desc';
            case "Rate_Prime1":
                return 'desc';
            case "Rate_Omission1":
                return 'desc';
            case "rate_assmd":
                return 'desc';
            case "tax_cass":
                return 'desc';
            case "tax_cfgdct":
                return 'desc';
            case "tax_ona":
                return 'desc';
            case "tax_fdu":
                return 'desc';
            case "start_date_cons":
                return 'desc';
            case "end_date_cons":
                return 'desc';
            case "rate_cons":
                return 'desc';
            case "day_cons":
                return 'desc';
            case "revenu_net":
                return 'desc';
            case "incentive":
                return 'desc';
            case "incentive_startdate":
                return 'desc';
            case "incentive_enddate":
                return 'desc';
            case "apply_incentive":
                return 'desc';
            case "rappel":
                return 'desc';
            case "rappel_startdate":
                return 'desc';
            case "rappel_enddate":
                return 'desc';
            case "apply_rappel":
                return 'desc';
            case "extra_insurance":
                return 'desc';
            case "apply_extra_ins":
                return 'desc';
            case "loan":
                return 'desc';
            case "date_loan":
                return 'desc';
            case "payment":
                return 'desc';
            case "date_payment":
                return 'desc';
            case "adjustment":
                return 'desc';
            case "date_adjustment":
                return 'desc';
            case "loan_deduction":
                return 'desc';
            case "loan_start_deduct":
                return 'desc';
            case "loan_monthlypayment":
                return 'desc';
            case "loan_end_deduct":
                return 'desc';
            case "apply_loan_deduction":
                return 'desc';
            case "loan_bank":
                return 'desc';
            case "date_loan_bank":
                return 'desc';
            case "loan_deduction_bank":
                return 'desc';
            case "loan_start_deduct_bank":
                return 'desc';
            case "loan_monthlypayment_bank":
                return 'desc';
            case "loan_end_deduct_bank":
                return 'desc';
            case "apply_loan_deduction_bank":
                return 'desc';
            case "other_loan":
                return 'desc';
            case "date_other_loan":
                return 'desc';
            case "other_loan_deduction":
                return 'desc';
            case "other_loan_start_deduct":
                return 'desc';
            case "other_loan_monthlypayment":
                return 'desc';
            case "other_loan_end_deduct":
                return 'desc';
            case "apply_other_loan_deduction":
                return 'desc';
            case "purchase":
                return 'desc';
            case "date_purchase":
                return 'desc';
            case "purchase_deduct":
                return 'desc';
            case "purchase_start_deduct":
                return 'desc';
            case "purchase_monthlypayment":
                return 'desc';
            case "purchase_end_deduct":
                return 'desc';
            case "apply_purchase_deduct":
                return 'desc';
            case "health_insurance":
                return 'desc';
            case "other_deduct":
                return 'desc';
            case "statement_balance":
                return 'desc';
            case "hiring_duration":
                return 'desc';
            case "update_time":
                return 'desc';
            default:
                return 'asc';
        }
        return 'asc';
    }
    function scGetDefaultFieldOrderIcon(fieldName)
    {
        if (scIsFieldNumeric(fieldName)) {
            if ('desc' == scGetDefaultFieldOrder(fieldName)) {
                fieldClass = numericIconDesc;
            } else {
                fieldClass = numericIconAsc;
            }
        } else {
            if ('desc' == scGetDefaultFieldOrder(fieldName)) {
                fieldClass = alphaIconDesc;
            } else {
                fieldClass = alphaIconAsc;
            }
        }
        return fieldClass;
    }
    </script>
<?php
     $Col_span = "";


       if (!$this->Embutida_form && $this->nmgp_opcao != "novo" && ($this->nmgp_botoes['delete'] == "on" || $this->nmgp_botoes['update'] == "on")) { $Col_span = " colspan=2"; }
 ?>

    <TD class="scFormLabelOddMult sc-col-title" <?php echo $Col_span ?>> &nbsp; </TD>
   
   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] == "on") {?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title"  width="10"> &nbsp; </TD>
   <?php }?>
   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] != "on") {?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title"  width="10"> &nbsp; </TD>
   <?php }?>
   <?php
    $sStyleHidden_userid_int_ = '';
    if (isset($this->nmgp_cmp_hidden['userid_int_']) && $this->nmgp_cmp_hidden['userid_int_'] == 'off') {
        $sStyleHidden_userid_int_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['userid_int_']) || $this->nmgp_cmp_hidden['userid_int_'] == 'on') {
        if (!isset($this->nm_new_label['userid_int_'])) {
            $this->nm_new_label['userid_int_'] = "ID";
        }
        $SC_Label = "" . $this->nm_new_label['userid_int_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("userid_int", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("userid_int", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'userid_int')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_userid_int__label sc-col-title" id="hidden_field_label_userid_int_" style="<?php echo $sStyleHidden_userid_int_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_employee_name_ = '';
    if (isset($this->nmgp_cmp_hidden['employee_name_']) && $this->nmgp_cmp_hidden['employee_name_'] == 'off') {
        $sStyleHidden_employee_name_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['employee_name_']) || $this->nmgp_cmp_hidden['employee_name_'] == 'on') {
        if (!isset($this->nm_new_label['employee_name_'])) {
            $this->nm_new_label['employee_name_'] = "" . $this->Ini->Nm_lang['lang_username'] . "";
        }
        $SC_Label = "" . $this->nm_new_label['employee_name_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("employee_name", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("employee_name", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'employee_name')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_employee_name__label sc-col-title" id="hidden_field_label_employee_name_" style="<?php echo $sStyleHidden_employee_name_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_dept_ = '';
    if (isset($this->nmgp_cmp_hidden['dept_']) && $this->nmgp_cmp_hidden['dept_'] == 'off') {
        $sStyleHidden_dept_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['dept_']) || $this->nmgp_cmp_hidden['dept_'] == 'on') {
        if (!isset($this->nm_new_label['dept_'])) {
            $this->nm_new_label['dept_'] = "" . $this->Ini->Nm_lang['lang_departement'] . "";
        }
        $SC_Label = "" . $this->nm_new_label['dept_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("dept", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("dept", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'dept')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_dept__label sc-col-title" id="hidden_field_label_dept_" style="<?php echo $sStyleHidden_dept_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_rate_iris_ = '';
    if (isset($this->nmgp_cmp_hidden['rate_iris_']) && $this->nmgp_cmp_hidden['rate_iris_'] == 'off') {
        $sStyleHidden_rate_iris_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['rate_iris_']) || $this->nmgp_cmp_hidden['rate_iris_'] == 'on') {
        if (!isset($this->nm_new_label['rate_iris_'])) {
            $this->nm_new_label['rate_iris_'] = "IRI / Salary";
        }
        $SC_Label = "" . $this->nm_new_label['rate_iris_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("rate_iris", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("rate_iris", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'rate_iris')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_rate_iris__label sc-col-title" id="hidden_field_label_rate_iris_" style="<?php echo $sStyleHidden_rate_iris_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_rate_iric_ = '';
    if (isset($this->nmgp_cmp_hidden['rate_iric_']) && $this->nmgp_cmp_hidden['rate_iric_'] == 'off') {
        $sStyleHidden_rate_iric_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['rate_iric_']) || $this->nmgp_cmp_hidden['rate_iric_'] == 'on') {
        if (!isset($this->nm_new_label['rate_iric_'])) {
            $this->nm_new_label['rate_iric_'] = "TCA Add Rate";
        }
        $SC_Label = "" . $this->nm_new_label['rate_iric_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("rate_iric", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("rate_iric", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'rate_iric')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_rate_iric__label sc-col-title" id="hidden_field_label_rate_iric_" style="<?php echo $sStyleHidden_rate_iric_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_rate_cass_ = '';
    if (isset($this->nmgp_cmp_hidden['rate_cass_']) && $this->nmgp_cmp_hidden['rate_cass_'] == 'off') {
        $sStyleHidden_rate_cass_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['rate_cass_']) || $this->nmgp_cmp_hidden['rate_cass_'] == 'on') {
        if (!isset($this->nm_new_label['rate_cass_'])) {
            $this->nm_new_label['rate_cass_'] = "Rate CASS";
        }
        $SC_Label = "" . $this->nm_new_label['rate_cass_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_rate_cass__label sc-col-title" id="hidden_field_label_rate_cass_" style="<?php echo $sStyleHidden_rate_cass_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_rate_cfgdct_ = '';
    if (isset($this->nmgp_cmp_hidden['rate_cfgdct_']) && $this->nmgp_cmp_hidden['rate_cfgdct_'] == 'off') {
        $sStyleHidden_rate_cfgdct_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['rate_cfgdct_']) || $this->nmgp_cmp_hidden['rate_cfgdct_'] == 'on') {
        if (!isset($this->nm_new_label['rate_cfgdct_'])) {
            $this->nm_new_label['rate_cfgdct_'] = "Rate CFGDCT";
        }
        $SC_Label = "" . $this->nm_new_label['rate_cfgdct_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_rate_cfgdct__label sc-col-title" id="hidden_field_label_rate_cfgdct_" style="<?php echo $sStyleHidden_rate_cfgdct_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_rate_fdu_ = '';
    if (isset($this->nmgp_cmp_hidden['rate_fdu_']) && $this->nmgp_cmp_hidden['rate_fdu_'] == 'off') {
        $sStyleHidden_rate_fdu_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['rate_fdu_']) || $this->nmgp_cmp_hidden['rate_fdu_'] == 'on') {
        if (!isset($this->nm_new_label['rate_fdu_'])) {
            $this->nm_new_label['rate_fdu_'] = "Rate FDU";
        }
        $SC_Label = "" . $this->nm_new_label['rate_fdu_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_rate_fdu__label sc-col-title" id="hidden_field_label_rate_fdu_" style="<?php echo $sStyleHidden_rate_fdu_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_rate_ona_ = '';
    if (isset($this->nmgp_cmp_hidden['rate_ona_']) && $this->nmgp_cmp_hidden['rate_ona_'] == 'off') {
        $sStyleHidden_rate_ona_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['rate_ona_']) || $this->nmgp_cmp_hidden['rate_ona_'] == 'on') {
        if (!isset($this->nm_new_label['rate_ona_'])) {
            $this->nm_new_label['rate_ona_'] = "Rate ONA";
        }
        $SC_Label = "" . $this->nm_new_label['rate_ona_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("rate_ona", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("rate_ona", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'rate_ona')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_rate_ona__label sc-col-title" id="hidden_field_label_rate_ona_" style="<?php echo $sStyleHidden_rate_ona_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_rate_tms_ = '';
    if (isset($this->nmgp_cmp_hidden['rate_tms_']) && $this->nmgp_cmp_hidden['rate_tms_'] == 'off') {
        $sStyleHidden_rate_tms_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['rate_tms_']) || $this->nmgp_cmp_hidden['rate_tms_'] == 'on') {
        if (!isset($this->nm_new_label['rate_tms_'])) {
            $this->nm_new_label['rate_tms_'] = "Rate TMS";
        }
        $SC_Label = "" . $this->nm_new_label['rate_tms_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("rate_tms", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("rate_tms", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'rate_tms')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_rate_tms__label sc-col-title" id="hidden_field_label_rate_tms_" style="<?php echo $sStyleHidden_rate_tms_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_rate_stamp_ = '';
    if (isset($this->nmgp_cmp_hidden['rate_stamp_']) && $this->nmgp_cmp_hidden['rate_stamp_'] == 'off') {
        $sStyleHidden_rate_stamp_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['rate_stamp_']) || $this->nmgp_cmp_hidden['rate_stamp_'] == 'on') {
        if (!isset($this->nm_new_label['rate_stamp_'])) {
            $this->nm_new_label['rate_stamp_'] = "Rate STAMP";
        }
        $SC_Label = "" . $this->nm_new_label['rate_stamp_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("rate_stamp", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("rate_stamp", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'rate_stamp')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_rate_stamp__label sc-col-title" id="hidden_field_label_rate_stamp_" style="<?php echo $sStyleHidden_rate_stamp_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>





    <script type="text/javascript">
     var orderColOrient = "<?php echo $orderColOrient ?>";
     orderColRule = "<?php echo $orderColRule ?>";
     scSetOrderColumn("<?php echo $orderColName ?>");
    </script>
   </tr>
<?php   
} 
function Form_Corpo($Line_Add = false, $Table_refresh = false) 
{ 
   global $sc_seq_vert, $sc_check_incl, $sc_check_excl; 
   $sc_hidden_no = 1; $sc_hidden_yes = 0;
   if ($Line_Add) 
   { 
       ob_start();
       $iStart = sizeof($this->form_vert_form_tax);
       $guarda_nmgp_opcao = $this->nmgp_opcao;
       $guarda_form_vert_form_tax = $this->form_vert_form_tax;
       $this->nmgp_opcao = 'novo';
   } 
   if ($this->Embutida_form && empty($this->form_vert_form_tax))
   {
       $sc_seq_vert = 0;
   }
   foreach ($this->form_vert_form_tax as $sc_seq_vert => $sc_lixo)
   {
       $this->form_fixed_column_no = 0;
       $this->loadRecordState($sc_seq_vert);
       $this->id_ = $this->form_vert_form_tax[$sc_seq_vert]['id_'];
       $this->userid_varchar_ = $this->form_vert_form_tax[$sc_seq_vert]['userid_varchar_'];
       $this->ic_ = $this->form_vert_form_tax[$sc_seq_vert]['ic_'];
       $this->address_ = $this->form_vert_form_tax[$sc_seq_vert]['address_'];
       $this->phone_ = $this->form_vert_form_tax[$sc_seq_vert]['phone_'];
       $this->email_ = $this->form_vert_form_tax[$sc_seq_vert]['email_'];
       $this->gender_ = $this->form_vert_form_tax[$sc_seq_vert]['gender_'];
       $this->dob_ = $this->form_vert_form_tax[$sc_seq_vert]['dob_'];
       $this->hiredate_ = $this->form_vert_form_tax[$sc_seq_vert]['hiredate_'];
       $this->firedate_ = $this->form_vert_form_tax[$sc_seq_vert]['firedate_'];
       $this->inactif_ = $this->form_vert_form_tax[$sc_seq_vert]['inactif_'];
       $this->building_ = $this->form_vert_form_tax[$sc_seq_vert]['building_'];
       $this->designation_ = $this->form_vert_form_tax[$sc_seq_vert]['designation_'];
       $this->section_ = $this->form_vert_form_tax[$sc_seq_vert]['section_'];
       $this->photo_name_ = $this->form_vert_form_tax[$sc_seq_vert]['photo_name_'];
       $this->photo_size_ = $this->form_vert_form_tax[$sc_seq_vert]['photo_size_'];
       $this->photo_file_ = $this->form_vert_form_tax[$sc_seq_vert]['photo_file_'];
       $this->imm_ona_ = $this->form_vert_form_tax[$sc_seq_vert]['imm_ona_'];
       $this->no_compte_ = $this->form_vert_form_tax[$sc_seq_vert]['no_compte_'];
       $this->type_de_compte_ = $this->form_vert_form_tax[$sc_seq_vert]['type_de_compte_'];
       $this->payperiod_ = $this->form_vert_form_tax[$sc_seq_vert]['payperiod_'];
       $this->probation_period_ = $this->form_vert_form_tax[$sc_seq_vert]['probation_period_'];
       $this->rate_work_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_work_'];
       $this->rate_ot_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_ot_'];
       $this->rate_ot_factor_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_ot_factor_'];
       $this->rate_ot_holiday_factor_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_ot_holiday_factor_'];
       $this->rate_ot_offday_factor_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_ot_offday_factor_'];
       $this->rate_ot_restday_factor_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_ot_restday_factor_'];
       $this->rate_day_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_day_'];
       $this->rate_fixed_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_fixed_'];
       $this->rate_restday_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_restday_'];
       $this->rate_offday_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_offday_'];
       $this->rate_commission1_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_commission1_'];
       $this->rate_prime1_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_prime1_'];
       $this->rate_omission1_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_omission1_'];
       $this->rate_assmd_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_assmd_'];
       $this->tax_cass_ = $this->form_vert_form_tax[$sc_seq_vert]['tax_cass_'];
       $this->tax_cfgdct_ = $this->form_vert_form_tax[$sc_seq_vert]['tax_cfgdct_'];
       $this->tax_ona_ = $this->form_vert_form_tax[$sc_seq_vert]['tax_ona_'];
       $this->tax_fdu_ = $this->form_vert_form_tax[$sc_seq_vert]['tax_fdu_'];
       $this->start_date_cons_ = $this->form_vert_form_tax[$sc_seq_vert]['start_date_cons_'];
       $this->end_date_cons_ = $this->form_vert_form_tax[$sc_seq_vert]['end_date_cons_'];
       $this->rate_cons_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_cons_'];
       $this->day_cons_ = $this->form_vert_form_tax[$sc_seq_vert]['day_cons_'];
       $this->revenu_net_ = $this->form_vert_form_tax[$sc_seq_vert]['revenu_net_'];
       $this->incentive_ = $this->form_vert_form_tax[$sc_seq_vert]['incentive_'];
       $this->incentive_desc_ = $this->form_vert_form_tax[$sc_seq_vert]['incentive_desc_'];
       $this->incentive_startdate_ = $this->form_vert_form_tax[$sc_seq_vert]['incentive_startdate_'];
       $this->incentive_enddate_ = $this->form_vert_form_tax[$sc_seq_vert]['incentive_enddate_'];
       $this->apply_incentive_ = $this->form_vert_form_tax[$sc_seq_vert]['apply_incentive_'];
       $this->rappel_ = $this->form_vert_form_tax[$sc_seq_vert]['rappel_'];
       $this->rappel_desc_ = $this->form_vert_form_tax[$sc_seq_vert]['rappel_desc_'];
       $this->rappel_startdate_ = $this->form_vert_form_tax[$sc_seq_vert]['rappel_startdate_'];
       $this->rappel_enddate_ = $this->form_vert_form_tax[$sc_seq_vert]['rappel_enddate_'];
       $this->apply_rappel_ = $this->form_vert_form_tax[$sc_seq_vert]['apply_rappel_'];
       $this->extra_insurance_ = $this->form_vert_form_tax[$sc_seq_vert]['extra_insurance_'];
       $this->extra_insdesc_ = $this->form_vert_form_tax[$sc_seq_vert]['extra_insdesc_'];
       $this->apply_extra_ins_ = $this->form_vert_form_tax[$sc_seq_vert]['apply_extra_ins_'];
       $this->loan_ = $this->form_vert_form_tax[$sc_seq_vert]['loan_'];
       $this->date_loan_ = $this->form_vert_form_tax[$sc_seq_vert]['date_loan_'];
       $this->payment_ = $this->form_vert_form_tax[$sc_seq_vert]['payment_'];
       $this->date_payment_ = $this->form_vert_form_tax[$sc_seq_vert]['date_payment_'];
       $this->payment_receipt_ = $this->form_vert_form_tax[$sc_seq_vert]['payment_receipt_'];
       $this->adjustment_ = $this->form_vert_form_tax[$sc_seq_vert]['adjustment_'];
       $this->date_adjustment_ = $this->form_vert_form_tax[$sc_seq_vert]['date_adjustment_'];
       $this->adjustment_receipt_ = $this->form_vert_form_tax[$sc_seq_vert]['adjustment_receipt_'];
       $this->loan_deduction_ = $this->form_vert_form_tax[$sc_seq_vert]['loan_deduction_'];
       $this->loan_description_ = $this->form_vert_form_tax[$sc_seq_vert]['loan_description_'];
       $this->loan_start_deduct_ = $this->form_vert_form_tax[$sc_seq_vert]['loan_start_deduct_'];
       $this->loan_monthlypayment_ = $this->form_vert_form_tax[$sc_seq_vert]['loan_monthlypayment_'];
       $this->loan_end_deduct_ = $this->form_vert_form_tax[$sc_seq_vert]['loan_end_deduct_'];
       $this->apply_loan_deduction_ = $this->form_vert_form_tax[$sc_seq_vert]['apply_loan_deduction_'];
       $this->loan_bank_ = $this->form_vert_form_tax[$sc_seq_vert]['loan_bank_'];
       $this->loan_bank_description_ = $this->form_vert_form_tax[$sc_seq_vert]['loan_bank_description_'];
       $this->date_loan_bank_ = $this->form_vert_form_tax[$sc_seq_vert]['date_loan_bank_'];
       $this->loan_deduction_bank_ = $this->form_vert_form_tax[$sc_seq_vert]['loan_deduction_bank_'];
       $this->loan_start_deduct_bank_ = $this->form_vert_form_tax[$sc_seq_vert]['loan_start_deduct_bank_'];
       $this->loan_monthlypayment_bank_ = $this->form_vert_form_tax[$sc_seq_vert]['loan_monthlypayment_bank_'];
       $this->loan_end_deduct_bank_ = $this->form_vert_form_tax[$sc_seq_vert]['loan_end_deduct_bank_'];
       $this->apply_loan_deduction_bank_ = $this->form_vert_form_tax[$sc_seq_vert]['apply_loan_deduction_bank_'];
       $this->other_loan_ = $this->form_vert_form_tax[$sc_seq_vert]['other_loan_'];
       $this->other_loan_description_ = $this->form_vert_form_tax[$sc_seq_vert]['other_loan_description_'];
       $this->date_other_loan_ = $this->form_vert_form_tax[$sc_seq_vert]['date_other_loan_'];
       $this->other_loan_deduction_ = $this->form_vert_form_tax[$sc_seq_vert]['other_loan_deduction_'];
       $this->other_loan_start_deduct_ = $this->form_vert_form_tax[$sc_seq_vert]['other_loan_start_deduct_'];
       $this->other_loan_monthlypayment_ = $this->form_vert_form_tax[$sc_seq_vert]['other_loan_monthlypayment_'];
       $this->other_loan_end_deduct_ = $this->form_vert_form_tax[$sc_seq_vert]['other_loan_end_deduct_'];
       $this->apply_other_loan_deduction_ = $this->form_vert_form_tax[$sc_seq_vert]['apply_other_loan_deduction_'];
       $this->purchase_ = $this->form_vert_form_tax[$sc_seq_vert]['purchase_'];
       $this->purchase_description_ = $this->form_vert_form_tax[$sc_seq_vert]['purchase_description_'];
       $this->date_purchase_ = $this->form_vert_form_tax[$sc_seq_vert]['date_purchase_'];
       $this->purchase_deduct_ = $this->form_vert_form_tax[$sc_seq_vert]['purchase_deduct_'];
       $this->purchase_start_deduct_ = $this->form_vert_form_tax[$sc_seq_vert]['purchase_start_deduct_'];
       $this->purchase_monthlypayment_ = $this->form_vert_form_tax[$sc_seq_vert]['purchase_monthlypayment_'];
       $this->purchase_end_deduct_ = $this->form_vert_form_tax[$sc_seq_vert]['purchase_end_deduct_'];
       $this->apply_purchase_deduct_ = $this->form_vert_form_tax[$sc_seq_vert]['apply_purchase_deduct_'];
       $this->health_insurance_ = $this->form_vert_form_tax[$sc_seq_vert]['health_insurance_'];
       $this->other_deduct_ = $this->form_vert_form_tax[$sc_seq_vert]['other_deduct_'];
       $this->other_deduct_desc_ = $this->form_vert_form_tax[$sc_seq_vert]['other_deduct_desc_'];
       $this->statement_balance_ = $this->form_vert_form_tax[$sc_seq_vert]['statement_balance_'];
       $this->bank_number_ = $this->form_vert_form_tax[$sc_seq_vert]['bank_number_'];
       $this->hiring_duration_ = $this->form_vert_form_tax[$sc_seq_vert]['hiring_duration_'];
       $this->update_time_ = $this->form_vert_form_tax[$sc_seq_vert]['update_time_'];
       if (isset($this->Embutida_ronly) && $this->Embutida_ronly && !$Line_Add)
       {
           $this->nmgp_cmp_readonly['userid_int_'] = true;
           $this->nmgp_cmp_readonly['employee_name_'] = true;
           $this->nmgp_cmp_readonly['dept_'] = true;
           $this->nmgp_cmp_readonly['rate_iris_'] = true;
           $this->nmgp_cmp_readonly['rate_iric_'] = true;
           $this->nmgp_cmp_readonly['rate_cass_'] = true;
           $this->nmgp_cmp_readonly['rate_cfgdct_'] = true;
           $this->nmgp_cmp_readonly['rate_fdu_'] = true;
           $this->nmgp_cmp_readonly['rate_ona_'] = true;
           $this->nmgp_cmp_readonly['rate_tms_'] = true;
           $this->nmgp_cmp_readonly['rate_stamp_'] = true;
       }
       elseif ($Line_Add)
       {
           if (!isset($this->nmgp_cmp_readonly['userid_int_']) || $this->nmgp_cmp_readonly['userid_int_'] != "on") {$this->nmgp_cmp_readonly['userid_int_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['employee_name_']) || $this->nmgp_cmp_readonly['employee_name_'] != "on") {$this->nmgp_cmp_readonly['employee_name_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['dept_']) || $this->nmgp_cmp_readonly['dept_'] != "on") {$this->nmgp_cmp_readonly['dept_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['rate_iris_']) || $this->nmgp_cmp_readonly['rate_iris_'] != "on") {$this->nmgp_cmp_readonly['rate_iris_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['rate_iric_']) || $this->nmgp_cmp_readonly['rate_iric_'] != "on") {$this->nmgp_cmp_readonly['rate_iric_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['rate_cass_']) || $this->nmgp_cmp_readonly['rate_cass_'] != "on") {$this->nmgp_cmp_readonly['rate_cass_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['rate_cfgdct_']) || $this->nmgp_cmp_readonly['rate_cfgdct_'] != "on") {$this->nmgp_cmp_readonly['rate_cfgdct_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['rate_fdu_']) || $this->nmgp_cmp_readonly['rate_fdu_'] != "on") {$this->nmgp_cmp_readonly['rate_fdu_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['rate_ona_']) || $this->nmgp_cmp_readonly['rate_ona_'] != "on") {$this->nmgp_cmp_readonly['rate_ona_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['rate_tms_']) || $this->nmgp_cmp_readonly['rate_tms_'] != "on") {$this->nmgp_cmp_readonly['rate_tms_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['rate_stamp_']) || $this->nmgp_cmp_readonly['rate_stamp_'] != "on") {$this->nmgp_cmp_readonly['rate_stamp_'] = false;}
       }
            if (isset($this->form_vert_form_preenchimento[$sc_seq_vert])) {
              foreach ($this->form_vert_form_preenchimento[$sc_seq_vert] as $sCmpNome => $mCmpVal)
              {
                  eval("\$this->" . $sCmpNome . " = \$mCmpVal;");
              }
            }
        $this->userid_int_ = $this->form_vert_form_tax[$sc_seq_vert]['userid_int_']; 
       $userid_int_ = $this->userid_int_; 
       $sStyleHidden_userid_int_ = '';
       if (isset($sCheckRead_userid_int_))
       {
           unset($sCheckRead_userid_int_);
       }
       if (isset($this->nmgp_cmp_readonly['userid_int_']))
       {
           $sCheckRead_userid_int_ = $this->nmgp_cmp_readonly['userid_int_'];
       }
       if (isset($this->nmgp_cmp_hidden['userid_int_']) && $this->nmgp_cmp_hidden['userid_int_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['userid_int_']);
           $sStyleHidden_userid_int_ = 'display: none;';
       }
       $bTestReadOnly_userid_int_ = true;
       $sStyleReadLab_userid_int_ = 'display: none;';
       $sStyleReadInp_userid_int_ = '';
       if (isset($this->nmgp_cmp_readonly['userid_int_']) && $this->nmgp_cmp_readonly['userid_int_'] == 'on')
       {
           $bTestReadOnly_userid_int_ = false;
           unset($this->nmgp_cmp_readonly['userid_int_']);
           $sStyleReadLab_userid_int_ = '';
           $sStyleReadInp_userid_int_ = 'display: none;';
       }
       $this->employee_name_ = $this->form_vert_form_tax[$sc_seq_vert]['employee_name_']; 
       $employee_name_ = $this->employee_name_; 
       $sStyleHidden_employee_name_ = '';
       if (isset($sCheckRead_employee_name_))
       {
           unset($sCheckRead_employee_name_);
       }
       if (isset($this->nmgp_cmp_readonly['employee_name_']))
       {
           $sCheckRead_employee_name_ = $this->nmgp_cmp_readonly['employee_name_'];
       }
       if (isset($this->nmgp_cmp_hidden['employee_name_']) && $this->nmgp_cmp_hidden['employee_name_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['employee_name_']);
           $sStyleHidden_employee_name_ = 'display: none;';
       }
       $bTestReadOnly_employee_name_ = true;
       $sStyleReadLab_employee_name_ = 'display: none;';
       $sStyleReadInp_employee_name_ = '';
       if (isset($this->nmgp_cmp_readonly['employee_name_']) && $this->nmgp_cmp_readonly['employee_name_'] == 'on')
       {
           $bTestReadOnly_employee_name_ = false;
           unset($this->nmgp_cmp_readonly['employee_name_']);
           $sStyleReadLab_employee_name_ = '';
           $sStyleReadInp_employee_name_ = 'display: none;';
       }
       $this->dept_ = $this->form_vert_form_tax[$sc_seq_vert]['dept_']; 
       $dept_ = $this->dept_; 
       $sStyleHidden_dept_ = '';
       if (isset($sCheckRead_dept_))
       {
           unset($sCheckRead_dept_);
       }
       if (isset($this->nmgp_cmp_readonly['dept_']))
       {
           $sCheckRead_dept_ = $this->nmgp_cmp_readonly['dept_'];
       }
       if (isset($this->nmgp_cmp_hidden['dept_']) && $this->nmgp_cmp_hidden['dept_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['dept_']);
           $sStyleHidden_dept_ = 'display: none;';
       }
       $bTestReadOnly_dept_ = true;
       $sStyleReadLab_dept_ = 'display: none;';
       $sStyleReadInp_dept_ = '';
       if (isset($this->nmgp_cmp_readonly['dept_']) && $this->nmgp_cmp_readonly['dept_'] == 'on')
       {
           $bTestReadOnly_dept_ = false;
           unset($this->nmgp_cmp_readonly['dept_']);
           $sStyleReadLab_dept_ = '';
           $sStyleReadInp_dept_ = 'display: none;';
       }
       $this->rate_iris_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_iris_']; 
       $rate_iris_ = $this->rate_iris_; 
       $sStyleHidden_rate_iris_ = '';
       if (isset($sCheckRead_rate_iris_))
       {
           unset($sCheckRead_rate_iris_);
       }
       if (isset($this->nmgp_cmp_readonly['rate_iris_']))
       {
           $sCheckRead_rate_iris_ = $this->nmgp_cmp_readonly['rate_iris_'];
       }
       if (isset($this->nmgp_cmp_hidden['rate_iris_']) && $this->nmgp_cmp_hidden['rate_iris_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['rate_iris_']);
           $sStyleHidden_rate_iris_ = 'display: none;';
       }
       $bTestReadOnly_rate_iris_ = true;
       $sStyleReadLab_rate_iris_ = 'display: none;';
       $sStyleReadInp_rate_iris_ = '';
       if (isset($this->nmgp_cmp_readonly['rate_iris_']) && $this->nmgp_cmp_readonly['rate_iris_'] == 'on')
       {
           $bTestReadOnly_rate_iris_ = false;
           unset($this->nmgp_cmp_readonly['rate_iris_']);
           $sStyleReadLab_rate_iris_ = '';
           $sStyleReadInp_rate_iris_ = 'display: none;';
       }
       $this->rate_iric_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_iric_']; 
       $rate_iric_ = $this->rate_iric_; 
       $sStyleHidden_rate_iric_ = '';
       if (isset($sCheckRead_rate_iric_))
       {
           unset($sCheckRead_rate_iric_);
       }
       if (isset($this->nmgp_cmp_readonly['rate_iric_']))
       {
           $sCheckRead_rate_iric_ = $this->nmgp_cmp_readonly['rate_iric_'];
       }
       if (isset($this->nmgp_cmp_hidden['rate_iric_']) && $this->nmgp_cmp_hidden['rate_iric_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['rate_iric_']);
           $sStyleHidden_rate_iric_ = 'display: none;';
       }
       $bTestReadOnly_rate_iric_ = true;
       $sStyleReadLab_rate_iric_ = 'display: none;';
       $sStyleReadInp_rate_iric_ = '';
       if (isset($this->nmgp_cmp_readonly['rate_iric_']) && $this->nmgp_cmp_readonly['rate_iric_'] == 'on')
       {
           $bTestReadOnly_rate_iric_ = false;
           unset($this->nmgp_cmp_readonly['rate_iric_']);
           $sStyleReadLab_rate_iric_ = '';
           $sStyleReadInp_rate_iric_ = 'display: none;';
       }
       $this->rate_cass_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_cass_']; 
       $rate_cass_ = $this->rate_cass_; 
       $sStyleHidden_rate_cass_ = '';
       if (isset($sCheckRead_rate_cass_))
       {
           unset($sCheckRead_rate_cass_);
       }
       if (isset($this->nmgp_cmp_readonly['rate_cass_']))
       {
           $sCheckRead_rate_cass_ = $this->nmgp_cmp_readonly['rate_cass_'];
       }
       if (isset($this->nmgp_cmp_hidden['rate_cass_']) && $this->nmgp_cmp_hidden['rate_cass_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['rate_cass_']);
           $sStyleHidden_rate_cass_ = 'display: none;';
       }
       $bTestReadOnly_rate_cass_ = true;
       $sStyleReadLab_rate_cass_ = 'display: none;';
       $sStyleReadInp_rate_cass_ = '';
       if (isset($this->nmgp_cmp_readonly['rate_cass_']) && $this->nmgp_cmp_readonly['rate_cass_'] == 'on')
       {
           $bTestReadOnly_rate_cass_ = false;
           unset($this->nmgp_cmp_readonly['rate_cass_']);
           $sStyleReadLab_rate_cass_ = '';
           $sStyleReadInp_rate_cass_ = 'display: none;';
       }
       $this->rate_cfgdct_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_cfgdct_']; 
       $rate_cfgdct_ = $this->rate_cfgdct_; 
       $sStyleHidden_rate_cfgdct_ = '';
       if (isset($sCheckRead_rate_cfgdct_))
       {
           unset($sCheckRead_rate_cfgdct_);
       }
       if (isset($this->nmgp_cmp_readonly['rate_cfgdct_']))
       {
           $sCheckRead_rate_cfgdct_ = $this->nmgp_cmp_readonly['rate_cfgdct_'];
       }
       if (isset($this->nmgp_cmp_hidden['rate_cfgdct_']) && $this->nmgp_cmp_hidden['rate_cfgdct_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['rate_cfgdct_']);
           $sStyleHidden_rate_cfgdct_ = 'display: none;';
       }
       $bTestReadOnly_rate_cfgdct_ = true;
       $sStyleReadLab_rate_cfgdct_ = 'display: none;';
       $sStyleReadInp_rate_cfgdct_ = '';
       if (isset($this->nmgp_cmp_readonly['rate_cfgdct_']) && $this->nmgp_cmp_readonly['rate_cfgdct_'] == 'on')
       {
           $bTestReadOnly_rate_cfgdct_ = false;
           unset($this->nmgp_cmp_readonly['rate_cfgdct_']);
           $sStyleReadLab_rate_cfgdct_ = '';
           $sStyleReadInp_rate_cfgdct_ = 'display: none;';
       }
       $this->rate_fdu_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_fdu_']; 
       $rate_fdu_ = $this->rate_fdu_; 
       $sStyleHidden_rate_fdu_ = '';
       if (isset($sCheckRead_rate_fdu_))
       {
           unset($sCheckRead_rate_fdu_);
       }
       if (isset($this->nmgp_cmp_readonly['rate_fdu_']))
       {
           $sCheckRead_rate_fdu_ = $this->nmgp_cmp_readonly['rate_fdu_'];
       }
       if (isset($this->nmgp_cmp_hidden['rate_fdu_']) && $this->nmgp_cmp_hidden['rate_fdu_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['rate_fdu_']);
           $sStyleHidden_rate_fdu_ = 'display: none;';
       }
       $bTestReadOnly_rate_fdu_ = true;
       $sStyleReadLab_rate_fdu_ = 'display: none;';
       $sStyleReadInp_rate_fdu_ = '';
       if (isset($this->nmgp_cmp_readonly['rate_fdu_']) && $this->nmgp_cmp_readonly['rate_fdu_'] == 'on')
       {
           $bTestReadOnly_rate_fdu_ = false;
           unset($this->nmgp_cmp_readonly['rate_fdu_']);
           $sStyleReadLab_rate_fdu_ = '';
           $sStyleReadInp_rate_fdu_ = 'display: none;';
       }
       $this->rate_ona_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_ona_']; 
       $rate_ona_ = $this->rate_ona_; 
       $sStyleHidden_rate_ona_ = '';
       if (isset($sCheckRead_rate_ona_))
       {
           unset($sCheckRead_rate_ona_);
       }
       if (isset($this->nmgp_cmp_readonly['rate_ona_']))
       {
           $sCheckRead_rate_ona_ = $this->nmgp_cmp_readonly['rate_ona_'];
       }
       if (isset($this->nmgp_cmp_hidden['rate_ona_']) && $this->nmgp_cmp_hidden['rate_ona_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['rate_ona_']);
           $sStyleHidden_rate_ona_ = 'display: none;';
       }
       $bTestReadOnly_rate_ona_ = true;
       $sStyleReadLab_rate_ona_ = 'display: none;';
       $sStyleReadInp_rate_ona_ = '';
       if (isset($this->nmgp_cmp_readonly['rate_ona_']) && $this->nmgp_cmp_readonly['rate_ona_'] == 'on')
       {
           $bTestReadOnly_rate_ona_ = false;
           unset($this->nmgp_cmp_readonly['rate_ona_']);
           $sStyleReadLab_rate_ona_ = '';
           $sStyleReadInp_rate_ona_ = 'display: none;';
       }
       $this->rate_tms_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_tms_']; 
       $rate_tms_ = $this->rate_tms_; 
       $sStyleHidden_rate_tms_ = '';
       if (isset($sCheckRead_rate_tms_))
       {
           unset($sCheckRead_rate_tms_);
       }
       if (isset($this->nmgp_cmp_readonly['rate_tms_']))
       {
           $sCheckRead_rate_tms_ = $this->nmgp_cmp_readonly['rate_tms_'];
       }
       if (isset($this->nmgp_cmp_hidden['rate_tms_']) && $this->nmgp_cmp_hidden['rate_tms_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['rate_tms_']);
           $sStyleHidden_rate_tms_ = 'display: none;';
       }
       $bTestReadOnly_rate_tms_ = true;
       $sStyleReadLab_rate_tms_ = 'display: none;';
       $sStyleReadInp_rate_tms_ = '';
       if (isset($this->nmgp_cmp_readonly['rate_tms_']) && $this->nmgp_cmp_readonly['rate_tms_'] == 'on')
       {
           $bTestReadOnly_rate_tms_ = false;
           unset($this->nmgp_cmp_readonly['rate_tms_']);
           $sStyleReadLab_rate_tms_ = '';
           $sStyleReadInp_rate_tms_ = 'display: none;';
       }
       $this->rate_stamp_ = $this->form_vert_form_tax[$sc_seq_vert]['rate_stamp_']; 
       $rate_stamp_ = $this->rate_stamp_; 
       $sStyleHidden_rate_stamp_ = '';
       if (isset($sCheckRead_rate_stamp_))
       {
           unset($sCheckRead_rate_stamp_);
       }
       if (isset($this->nmgp_cmp_readonly['rate_stamp_']))
       {
           $sCheckRead_rate_stamp_ = $this->nmgp_cmp_readonly['rate_stamp_'];
       }
       if (isset($this->nmgp_cmp_hidden['rate_stamp_']) && $this->nmgp_cmp_hidden['rate_stamp_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['rate_stamp_']);
           $sStyleHidden_rate_stamp_ = 'display: none;';
       }
       $bTestReadOnly_rate_stamp_ = true;
       $sStyleReadLab_rate_stamp_ = 'display: none;';
       $sStyleReadInp_rate_stamp_ = '';
       if (isset($this->nmgp_cmp_readonly['rate_stamp_']) && $this->nmgp_cmp_readonly['rate_stamp_'] == 'on')
       {
           $bTestReadOnly_rate_stamp_ = false;
           unset($this->nmgp_cmp_readonly['rate_stamp_']);
           $sStyleReadLab_rate_stamp_ = '';
           $sStyleReadInp_rate_stamp_ = 'display: none;';
       }

       $nm_cor_fun_vert = (isset($nm_cor_fun_vert) && $nm_cor_fun_vert == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
       $nm_img_fun_cel  = (isset($nm_img_fun_cel)  && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);

       $sHideNewLine = '';
?>   
   <tr id="idVertRow<?php echo $sc_seq_vert; ?>"<?php echo $sHideNewLine; ?> class="sc-row" data-sc-row-number="<?php echo $sc_seq_vert; ?>">


   
    <TD class="scFormDataOddMult"  id="hidden_field_data_sc_seq<?php echo $sc_seq_vert; ?>" > <?php echo $sc_seq_vert; ?> </TD>
   
   <?php if (!$this->Embutida_form && $this->nmgp_opcao != "novo" && ($this->nmgp_botoes['delete'] == "on" || $this->nmgp_botoes['update'] == "on")) {?>
    <TD class="scFormDataOddMult" > 
<input type="checkbox" name="sc_check_vert[<?php echo $sc_seq_vert ?>]" value="<?php echo $sc_seq_vert . "\""; if (in_array($sc_seq_vert, $sc_check_excl)) { echo " checked";} ?> onclick="if (this.checked) {sc_quant_excl++; } else {sc_quant_excl--; }" class="sc-js-input" alt="{type: 'checkbox', enterTab: false}"> </TD>
   <?php }?>
   <?php if ($this->Embutida_form) {?>
    <TD class="scFormDataOddMult"  id="hidden_field_data_sc_actions<?php echo $sc_seq_vert; ?>" NOWRAP> <?php if ($this->nmgp_opcao != "novo") {
    if ($this->nmgp_botoes['delete'] == "off") {
        $sDisplayDelete = 'display: none';
    }
    else {
        $sDisplayDelete = '';
    }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_excluir", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "sc_exc_line_" . $sc_seq_vert . "", "", "", "" . $sDisplayDelete. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php }?>

<?php
if ($this->nmgp_opcao != "novo") {
    if ($this->nmgp_botoes['update'] == "off") {
        $sDisplayUpdate = 'display: none';
    }
    else {
        $sDisplayUpdate = '';
    }
    if ($this->Embutida_ronly) {
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_edit", "mdOpenLine(" . $sc_seq_vert . ")", "mdOpenLine(" . $sc_seq_vert . ")", "sc_open_line_" . $sc_seq_vert . "", "", "", "" . $sDisplayUpdate. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php
        $sButDisp = 'display: none';
    }
    else
    {
        $sButDisp = $sDisplayUpdate;
    }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_alterar", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "sc_upd_line_" . $sc_seq_vert . "", "", "", "" . $sButDisp. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php
}
?>

<?php if ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_opcao == "novo") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_incluir", "findPos(this); nm_atualiza_line('incluir', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('incluir', " . $sc_seq_vert . ")", "sc_ins_line_" . $sc_seq_vert . "", "", "", "display: ''", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php if ($this->nmgp_botoes['delete'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_excluir", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "sc_exc_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php }?>

<?php if ($Line_Add && $this->Embutida_ronly) {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_edit", "mdOpenLine(" . $sc_seq_vert . ")", "mdOpenLine(" . $sc_seq_vert . ")", "sc_open_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php }?>

<?php if ($this->nmgp_botoes['update'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_alterar", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "sc_upd_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php }?>
<?php }?>
<?php if ($this->nmgp_botoes['insert'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_novo", "do_ajax_form_tax_add_new_line(" . $sc_seq_vert . ")", "do_ajax_form_tax_add_new_line(" . $sc_seq_vert . ")", "sc_new_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php }?>
<?php
  $Style_add_line = (!$Line_Add) ? "display: none" : "";
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_tax_cancel_insert(" . $sc_seq_vert . ")", "do_ajax_form_tax_cancel_insert(" . $sc_seq_vert . ")", "sc_canceli_line_" . $sc_seq_vert . "", "", "", "" . $Style_add_line . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_tax_cancel_update(" . $sc_seq_vert . ")", "do_ajax_form_tax_cancel_update(" . $sc_seq_vert . ")", "sc_cancelu_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
 </TD>
   <?php }?>
   <?php if (isset($this->nmgp_cmp_hidden['userid_int_']) && $this->nmgp_cmp_hidden['userid_int_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="userid_int_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($userid_int_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_userid_int__line" id="hidden_field_data_userid_int_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_userid_int_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_userid_int__line" style="vertical-align: top;padding: 0px"><input type="hidden" name="userid_int_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($userid_int_); ?>"><span id="id_ajax_label_userid_int_<?php echo $sc_seq_vert; ?>"><?php echo nl2br($userid_int_); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_userid_int_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_userid_int_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['employee_name_']) && $this->nmgp_cmp_hidden['employee_name_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="employee_name_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($employee_name_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_employee_name__line" id="hidden_field_data_employee_name_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_employee_name_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_employee_name__line" style="vertical-align: top;padding: 0px"><input type="hidden" name="employee_name_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($employee_name_); ?>"><span id="id_ajax_label_employee_name_<?php echo $sc_seq_vert; ?>"><?php echo nl2br($employee_name_); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_employee_name_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_employee_name_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['dept_']) && $this->nmgp_cmp_hidden['dept_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dept_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($dept_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_dept__line" id="hidden_field_data_dept_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_dept_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_dept__line" style="vertical-align: top;padding: 0px"><input type="hidden" name="dept_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($dept_); ?>"><span id="id_ajax_label_dept_<?php echo $sc_seq_vert; ?>"><?php echo nl2br($dept_); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dept_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dept_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['rate_iris_']) && $this->nmgp_cmp_hidden['rate_iris_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="rate_iris_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_iris_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_rate_iris__line" id="hidden_field_data_rate_iris_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_rate_iris_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_rate_iris__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_rate_iris_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["rate_iris_"]) &&  $this->nmgp_cmp_readonly["rate_iris_"] == "on") { 

 ?>
<input type="hidden" name="rate_iris_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_iris_) . "\">" . $rate_iris_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_rate_iris_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-rate_iris_<?php echo $sc_seq_vert ?> css_rate_iris__line" style="<?php echo $sStyleReadLab_rate_iris_; ?>"><?php echo $this->form_format_readonly("rate_iris_", $this->form_encode_input($this->rate_iris_)); ?></span><span id="id_read_off_rate_iris_<?php echo $sc_seq_vert ?>" class="css_read_off_rate_iris_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_rate_iris_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_rate_iris__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_rate_iris_<?php echo $sc_seq_vert ?>" type=text name="rate_iris_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_iris_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> alt="{datatype: 'currency', currencySymbol: '<?php echo $this->field_config['rate_iris_']['symbol_mon']; ?>', currencyPosition: '<?php echo ((1 == $this->field_config['rate_iris_']['format_pos'] || 3 == $this->field_config['rate_iris_']['format_pos']) ? 'left' : 'right'); ?>', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_iris_']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_iris_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['rate_iris_']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['rate_iris_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_rate_iris_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_rate_iris_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['rate_iric_']) && $this->nmgp_cmp_hidden['rate_iric_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="rate_iric_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_iric_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_rate_iric__line" id="hidden_field_data_rate_iric_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_rate_iric_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_rate_iric__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_rate_iric_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["rate_iric_"]) &&  $this->nmgp_cmp_readonly["rate_iric_"] == "on") { 

 ?>
<input type="hidden" name="rate_iric_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_iric_) . "\">" . $rate_iric_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_rate_iric_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-rate_iric_<?php echo $sc_seq_vert ?> css_rate_iric__line" style="<?php echo $sStyleReadLab_rate_iric_; ?>"><?php echo $this->form_format_readonly("rate_iric_", $this->form_encode_input($this->rate_iric_)); ?></span><span id="id_read_off_rate_iric_<?php echo $sc_seq_vert ?>" class="css_read_off_rate_iric_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_rate_iric_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_rate_iric__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_rate_iric_<?php echo $sc_seq_vert ?>" type=text name="rate_iric_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_iric_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> alt="{datatype: 'decimal', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_iric_']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_iric_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['rate_iric_']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['rate_iric_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_rate_iric_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_rate_iric_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['rate_cass_']) && $this->nmgp_cmp_hidden['rate_cass_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="rate_cass_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_cass_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_rate_cass__line" id="hidden_field_data_rate_cass_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_rate_cass_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_rate_cass__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_rate_cass_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["rate_cass_"]) &&  $this->nmgp_cmp_readonly["rate_cass_"] == "on") { 

 ?>
<input type="hidden" name="rate_cass_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_cass_) . "\">" . $rate_cass_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_rate_cass_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-rate_cass_<?php echo $sc_seq_vert ?> css_rate_cass__line" style="<?php echo $sStyleReadLab_rate_cass_; ?>"><?php echo $this->form_format_readonly("rate_cass_", $this->form_encode_input($this->rate_cass_)); ?></span><span id="id_read_off_rate_cass_<?php echo $sc_seq_vert ?>" class="css_read_off_rate_cass_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_rate_cass_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_rate_cass__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_rate_cass_<?php echo $sc_seq_vert ?>" type=text name="rate_cass_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_cass_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> alt="{datatype: 'decimal', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_cass_']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_cass_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['rate_cass_']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['rate_cass_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_rate_cass_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_rate_cass_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['rate_cfgdct_']) && $this->nmgp_cmp_hidden['rate_cfgdct_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="rate_cfgdct_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_cfgdct_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_rate_cfgdct__line" id="hidden_field_data_rate_cfgdct_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_rate_cfgdct_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_rate_cfgdct__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_rate_cfgdct_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["rate_cfgdct_"]) &&  $this->nmgp_cmp_readonly["rate_cfgdct_"] == "on") { 

 ?>
<input type="hidden" name="rate_cfgdct_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_cfgdct_) . "\">" . $rate_cfgdct_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_rate_cfgdct_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-rate_cfgdct_<?php echo $sc_seq_vert ?> css_rate_cfgdct__line" style="<?php echo $sStyleReadLab_rate_cfgdct_; ?>"><?php echo $this->form_format_readonly("rate_cfgdct_", $this->form_encode_input($this->rate_cfgdct_)); ?></span><span id="id_read_off_rate_cfgdct_<?php echo $sc_seq_vert ?>" class="css_read_off_rate_cfgdct_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_rate_cfgdct_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_rate_cfgdct__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_rate_cfgdct_<?php echo $sc_seq_vert ?>" type=text name="rate_cfgdct_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_cfgdct_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> alt="{datatype: 'decimal', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_cfgdct_']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_cfgdct_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['rate_cfgdct_']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['rate_cfgdct_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_rate_cfgdct_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_rate_cfgdct_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['rate_fdu_']) && $this->nmgp_cmp_hidden['rate_fdu_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="rate_fdu_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_fdu_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_rate_fdu__line" id="hidden_field_data_rate_fdu_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_rate_fdu_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_rate_fdu__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_rate_fdu_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["rate_fdu_"]) &&  $this->nmgp_cmp_readonly["rate_fdu_"] == "on") { 

 ?>
<input type="hidden" name="rate_fdu_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_fdu_) . "\">" . $rate_fdu_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_rate_fdu_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-rate_fdu_<?php echo $sc_seq_vert ?> css_rate_fdu__line" style="<?php echo $sStyleReadLab_rate_fdu_; ?>"><?php echo $this->form_format_readonly("rate_fdu_", $this->form_encode_input($this->rate_fdu_)); ?></span><span id="id_read_off_rate_fdu_<?php echo $sc_seq_vert ?>" class="css_read_off_rate_fdu_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_rate_fdu_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_rate_fdu__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_rate_fdu_<?php echo $sc_seq_vert ?>" type=text name="rate_fdu_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_fdu_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> alt="{datatype: 'decimal', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_fdu_']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_fdu_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['rate_fdu_']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['rate_fdu_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_rate_fdu_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_rate_fdu_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['rate_ona_']) && $this->nmgp_cmp_hidden['rate_ona_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="rate_ona_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_ona_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_rate_ona__line" id="hidden_field_data_rate_ona_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_rate_ona_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_rate_ona__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_rate_ona_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["rate_ona_"]) &&  $this->nmgp_cmp_readonly["rate_ona_"] == "on") { 

 ?>
<input type="hidden" name="rate_ona_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_ona_) . "\">" . $rate_ona_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_rate_ona_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-rate_ona_<?php echo $sc_seq_vert ?> css_rate_ona__line" style="<?php echo $sStyleReadLab_rate_ona_; ?>"><?php echo $this->form_format_readonly("rate_ona_", $this->form_encode_input($this->rate_ona_)); ?></span><span id="id_read_off_rate_ona_<?php echo $sc_seq_vert ?>" class="css_read_off_rate_ona_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_rate_ona_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_rate_ona__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_rate_ona_<?php echo $sc_seq_vert ?>" type=text name="rate_ona_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_ona_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> alt="{datatype: 'decimal', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_ona_']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_ona_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['rate_ona_']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['rate_ona_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_rate_ona_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_rate_ona_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['rate_tms_']) && $this->nmgp_cmp_hidden['rate_tms_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="rate_tms_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_tms_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_rate_tms__line" id="hidden_field_data_rate_tms_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_rate_tms_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_rate_tms__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_rate_tms_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["rate_tms_"]) &&  $this->nmgp_cmp_readonly["rate_tms_"] == "on") { 

 ?>
<input type="hidden" name="rate_tms_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_tms_) . "\">" . $rate_tms_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_rate_tms_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-rate_tms_<?php echo $sc_seq_vert ?> css_rate_tms__line" style="<?php echo $sStyleReadLab_rate_tms_; ?>"><?php echo $this->form_format_readonly("rate_tms_", $this->form_encode_input($this->rate_tms_)); ?></span><span id="id_read_off_rate_tms_<?php echo $sc_seq_vert ?>" class="css_read_off_rate_tms_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_rate_tms_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_rate_tms__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_rate_tms_<?php echo $sc_seq_vert ?>" type=text name="rate_tms_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_tms_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> alt="{datatype: 'decimal', maxLength: 24, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_tms_']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_tms_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['rate_tms_']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['rate_tms_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_rate_tms_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_rate_tms_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['rate_stamp_']) && $this->nmgp_cmp_hidden['rate_stamp_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="rate_stamp_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_stamp_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_rate_stamp__line" id="hidden_field_data_rate_stamp_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_rate_stamp_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_rate_stamp__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_rate_stamp_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["rate_stamp_"]) &&  $this->nmgp_cmp_readonly["rate_stamp_"] == "on") { 

 ?>
<input type="hidden" name="rate_stamp_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_stamp_) . "\">" . $rate_stamp_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_rate_stamp_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-rate_stamp_<?php echo $sc_seq_vert ?> css_rate_stamp__line" style="<?php echo $sStyleReadLab_rate_stamp_; ?>"><?php echo $this->form_format_readonly("rate_stamp_", $this->form_encode_input($this->rate_stamp_)); ?></span><span id="id_read_off_rate_stamp_<?php echo $sc_seq_vert ?>" class="css_read_off_rate_stamp_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_rate_stamp_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_rate_stamp__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_rate_stamp_<?php echo $sc_seq_vert ?>" type=text name="rate_stamp_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($rate_stamp_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> alt="{datatype: 'decimal', maxLength: 24, precision: 3, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_stamp_']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['rate_stamp_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['rate_stamp_']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['rate_stamp_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_rate_stamp_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_rate_stamp_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





   </tr>
<?php   
        if (isset($sCheckRead_userid_int_))
       {
           $this->nmgp_cmp_readonly['userid_int_'] = $sCheckRead_userid_int_;
       }
       if ('display: none;' == $sStyleHidden_userid_int_)
       {
           $this->nmgp_cmp_hidden['userid_int_'] = 'off';
       }
       if (isset($sCheckRead_employee_name_))
       {
           $this->nmgp_cmp_readonly['employee_name_'] = $sCheckRead_employee_name_;
       }
       if ('display: none;' == $sStyleHidden_employee_name_)
       {
           $this->nmgp_cmp_hidden['employee_name_'] = 'off';
       }
       if (isset($sCheckRead_dept_))
       {
           $this->nmgp_cmp_readonly['dept_'] = $sCheckRead_dept_;
       }
       if ('display: none;' == $sStyleHidden_dept_)
       {
           $this->nmgp_cmp_hidden['dept_'] = 'off';
       }
       if (isset($sCheckRead_rate_iris_))
       {
           $this->nmgp_cmp_readonly['rate_iris_'] = $sCheckRead_rate_iris_;
       }
       if ('display: none;' == $sStyleHidden_rate_iris_)
       {
           $this->nmgp_cmp_hidden['rate_iris_'] = 'off';
       }
       if (isset($sCheckRead_rate_iric_))
       {
           $this->nmgp_cmp_readonly['rate_iric_'] = $sCheckRead_rate_iric_;
       }
       if ('display: none;' == $sStyleHidden_rate_iric_)
       {
           $this->nmgp_cmp_hidden['rate_iric_'] = 'off';
       }
       if (isset($sCheckRead_rate_cass_))
       {
           $this->nmgp_cmp_readonly['rate_cass_'] = $sCheckRead_rate_cass_;
       }
       if ('display: none;' == $sStyleHidden_rate_cass_)
       {
           $this->nmgp_cmp_hidden['rate_cass_'] = 'off';
       }
       if (isset($sCheckRead_rate_cfgdct_))
       {
           $this->nmgp_cmp_readonly['rate_cfgdct_'] = $sCheckRead_rate_cfgdct_;
       }
       if ('display: none;' == $sStyleHidden_rate_cfgdct_)
       {
           $this->nmgp_cmp_hidden['rate_cfgdct_'] = 'off';
       }
       if (isset($sCheckRead_rate_fdu_))
       {
           $this->nmgp_cmp_readonly['rate_fdu_'] = $sCheckRead_rate_fdu_;
       }
       if ('display: none;' == $sStyleHidden_rate_fdu_)
       {
           $this->nmgp_cmp_hidden['rate_fdu_'] = 'off';
       }
       if (isset($sCheckRead_rate_ona_))
       {
           $this->nmgp_cmp_readonly['rate_ona_'] = $sCheckRead_rate_ona_;
       }
       if ('display: none;' == $sStyleHidden_rate_ona_)
       {
           $this->nmgp_cmp_hidden['rate_ona_'] = 'off';
       }
       if (isset($sCheckRead_rate_tms_))
       {
           $this->nmgp_cmp_readonly['rate_tms_'] = $sCheckRead_rate_tms_;
       }
       if ('display: none;' == $sStyleHidden_rate_tms_)
       {
           $this->nmgp_cmp_hidden['rate_tms_'] = 'off';
       }
       if (isset($sCheckRead_rate_stamp_))
       {
           $this->nmgp_cmp_readonly['rate_stamp_'] = $sCheckRead_rate_stamp_;
       }
       if ('display: none;' == $sStyleHidden_rate_stamp_)
       {
           $this->nmgp_cmp_hidden['rate_stamp_'] = 'off';
       }

   }
   if ($Line_Add) 
   { 
       $this->New_Line = ob_get_contents();
       ob_end_clean();
       $this->nmgp_opcao = $guarda_nmgp_opcao;
       $this->form_vert_form_tax = $guarda_form_vert_form_tax;
   } 
   if ($Table_refresh) 
   { 
       $this->Table_refresh = ob_get_contents();
       ob_end_clean();
   } 
}

function Form_Fim() 
{
   global $sc_seq_vert, $opcao_botoes, $nm_url_saida; 
?>   
</TABLE></div><!-- bloco_f -->
 </div>
 <div id="sc-id-fixedheaders-placeholder" style="display: none; position: fixed; top: 0; z-index: 500"></div>
<?php
$iContrVert = $this->Embutida_form ? $sc_seq_vert + 1 : $sc_seq_vert + 1;
if ($sc_seq_vert < $this->sc_max_reg)
{
    echo " <script type=\"text/javascript\">";
    echo "    bRefreshTable = true;";
    echo "</script>";
}
?>
<input type="hidden" name="sc_contr_vert" value="<?php echo $this->form_encode_input($iContrVert); ?>">
<?php
    $sEmptyStyle = 0 == $sc_seq_vert ? '' : 'display: none;';
?>
</td></tr>
<tr id="sc-ui-empty-form" style="<?php echo $sEmptyStyle; ?>"><td class="scFormPageText" style="padding: 10px; font-weight: bold">
<?php echo $this->Ini->Nm_lang['lang_errm_empt'];
?>
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['qtline'] == "on")
      {
?> 
          <span class="<?php echo $this->css_css_toolbar_obj ?>" style="border: 0px;"><?php echo $this->Ini->Nm_lang['lang_btns_rows'] ?></span>
          <select class="scFormToolbarInput" name="nmgp_quant_linhas_b" onchange="document.F7.nmgp_max_line.value = this.value; document.F7.submit();"> 
<?php 
              $obj_sel = ($this->sc_max_reg == '10') ? " selected" : "";
?> 
           <option value="10" <?php echo $obj_sel ?>>10</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '20') ? " selected" : "";
?> 
           <option value="20" <?php echo $obj_sel ?>>20</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '30') ? " selected" : "";
?> 
           <option value="30" <?php echo $obj_sel ?>>30</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '50') ? " selected" : "";
?> 
           <option value="50" <?php echo $obj_sel ?>>50</option>
          </select>
<?php 
      }
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['birpara'];
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
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['first'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "binicio", "scBtnFn_sys_format_ini()", "scBtnFn_sys_format_ini()", "sc_b_ini_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Shift + &#8592;)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['back'];
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
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['forward'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bavanca", "scBtnFn_sys_format_ava()", "scBtnFn_sys_format_ava()", "sc_b_avc_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + &#8594;)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['btn_label']['last'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
<script>
 var iAjaxNewLine = <?php echo $sc_seq_vert; ?>;
<?php
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_modal']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['run_modal'])
{
?>
 for (var iLine = 1; iLine <= iAjaxNewLine; iLine++) {
  scJQElementsAdd(iLine);
 }
<?php
}
else
{
?>
 $(function() {
  setTimeout(function() { for (var iLine = 1; iLine <= iAjaxNewLine; iLine++) { scJQElementsAdd(iLine); } }, 250);
 });
<?php
}
?>
</script>
<div id="new_line_dummy" style="display: none">
</div>

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
  $nm_sc_blocos_da_pag = array(0);

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
   </td></tr></table>
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_tax");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_tax");
 parent.scAjaxDetailHeight("form_tax", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_tax", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_tax", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['sc_modal'])
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
        function scBtnFn_sc_btn_0() {
                if ($("#sc_sc_btn_0_top").length && $("#sc_sc_btn_0_top").is(":visible")) {
                    if ($("#sc_sc_btn_0_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_sc_btn_0()
                         return;
                }
        }
        function scBtnFn_reset_tcaadd() {
                if ($("#sc_reset_tcaadd_top").length && $("#sc_reset_tcaadd_top").is(":visible")) {
                    if ($("#sc_reset_tcaadd_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_reset_tcaadd()
                         return;
                }
        }
        function scBtnFn_TcaAddByDept() {
                if ($("#sc_TcaAddByDept_top").length && $("#sc_TcaAddByDept_top").is(":visible")) {
                    if ($("#sc_TcaAddByDept_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_TcaAddByDept()
                         return;
                }
        }
        function scBtnFn_TcaAddByValue() {
                if ($("#sc_TcaAddByValue_top").length && $("#sc_TcaAddByValue_top").is(":visible")) {
                    if ($("#sc_TcaAddByValue_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_TcaAddByValue()
                         return;
                }
        }
        function scBtnFn_reset_cass() {
                if ($("#sc_reset_cass_top").length && $("#sc_reset_cass_top").is(":visible")) {
                    if ($("#sc_reset_cass_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_reset_cass()
                         return;
                }
        }
        function scBtnFn_CassByDept() {
                if ($("#sc_CassByDept_top").length && $("#sc_CassByDept_top").is(":visible")) {
                    if ($("#sc_CassByDept_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_CassByDept()
                         return;
                }
        }
        function scBtnFn_CassByValue() {
                if ($("#sc_CassByValue_top").length && $("#sc_CassByValue_top").is(":visible")) {
                    if ($("#sc_CassByValue_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_CassByValue()
                         return;
                }
        }
        function scBtnFn_reset_cfgdct() {
                if ($("#sc_reset_cfgdct_top").length && $("#sc_reset_cfgdct_top").is(":visible")) {
                    if ($("#sc_reset_cfgdct_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_reset_cfgdct()
                         return;
                }
        }
        function scBtnFn_CfgdctByDept() {
                if ($("#sc_CfgdctByDept_top").length && $("#sc_CfgdctByDept_top").is(":visible")) {
                    if ($("#sc_CfgdctByDept_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_CfgdctByDept()
                         return;
                }
        }
        function scBtnFn_CfgdctByValue() {
                if ($("#sc_CfgdctByValue_top").length && $("#sc_CfgdctByValue_top").is(":visible")) {
                    if ($("#sc_CfgdctByValue_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_CfgdctByValue()
                         return;
                }
        }
        function scBtnFn_reset_fdu() {
                if ($("#sc_reset_fdu_top").length && $("#sc_reset_fdu_top").is(":visible")) {
                    if ($("#sc_reset_fdu_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_reset_fdu()
                         return;
                }
        }
        function scBtnFn_FduByDept() {
                if ($("#sc_FduByDept_top").length && $("#sc_FduByDept_top").is(":visible")) {
                    if ($("#sc_FduByDept_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_FduByDept()
                         return;
                }
        }
        function scBtnFn_FduByValue() {
                if ($("#sc_FduByValue_top").length && $("#sc_FduByValue_top").is(":visible")) {
                    if ($("#sc_FduByValue_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_FduByValue()
                         return;
                }
        }
        function scBtnFn_reset_ona() {
                if ($("#sc_reset_ona_top").length && $("#sc_reset_ona_top").is(":visible")) {
                    if ($("#sc_reset_ona_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_reset_ona()
                         return;
                }
        }
        function scBtnFn_OnaByDept() {
                if ($("#sc_OnaByDept_top").length && $("#sc_OnaByDept_top").is(":visible")) {
                    if ($("#sc_OnaByDept_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_OnaByDept()
                         return;
                }
        }
        function scBtnFn_OnaByValue() {
                if ($("#sc_OnaByValue_top").length && $("#sc_OnaByValue_top").is(":visible")) {
                    if ($("#sc_OnaByValue_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_OnaByValue()
                         return;
                }
        }
        function scBtnFn_reset_tms() {
                if ($("#sc_reset_tms_top").length && $("#sc_reset_tms_top").is(":visible")) {
                    if ($("#sc_reset_tms_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_reset_tms()
                         return;
                }
        }
        function scBtnFn_RateTmsByValue() {
                if ($("#sc_RateTmsByValue_top").length && $("#sc_RateTmsByValue_top").is(":visible")) {
                    if ($("#sc_RateTmsByValue_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_RateTmsByValue()
                         return;
                }
        }
        function scBtnFn_RateTmsByDept() {
                if ($("#sc_RateTmsByDept_top").length && $("#sc_RateTmsByDept_top").is(":visible")) {
                    if ($("#sc_RateTmsByDept_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_RateTmsByDept()
                         return;
                }
        }
        function scBtnFn_reset_stamp() {
                if ($("#sc_reset_stamp_top").length && $("#sc_reset_stamp_top").is(":visible")) {
                    if ($("#sc_reset_stamp_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_reset_stamp()
                         return;
                }
        }
        function scBtnFn_RateStampByValue() {
                if ($("#sc_RateStampByValue_top").length && $("#sc_RateStampByValue_top").is(":visible")) {
                    if ($("#sc_RateStampByValue_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_RateStampByValue()
                         return;
                }
        }
        function scBtnFn_RateStampByDept() {
                if ($("#sc_RateStampByDept_top").length && $("#sc_RateStampByDept_top").is(":visible")) {
                    if ($("#sc_RateStampByDept_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_RateStampByDept()
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
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tax']['buttonStatus'] = $this->nmgp_botoes;
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
<?php 
 } 
} 
?> 
