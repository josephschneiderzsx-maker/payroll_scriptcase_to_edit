<form name="F2" method=post 
               action="./" 
               target="_self"> 
<input type="hidden" name="id_" value="<?php echo $this->form_encode_input($this->nmgp_dados_form['id_']); ?>">
<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="master_nav" value="off">
<input type="hidden" name="sc_ifr_height" value="">
<input type="hidden" name="nmgp_parms" value=""/>
<input type="hidden" name="nmgp_ordem" value=""/>
<input type="hidden" name="nmgp_clone" value=""/>
<input type="hidden" name="nmgp_fast_search" value=""/>
<input type="hidden" name="nmgp_cond_fast_search" value=""/>
<input type="hidden" name="nmgp_arg_fast_search" value=""/>
<input type="hidden" name="nmgp_arg_dyn_search" value=""/>
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
</form> 
<form name="F3" method="post" 
                  target="_self"> 
  <input type="hidden" name="nmgp_chave" value=""/>
  <input type="hidden" name="nmgp_opcao" value=""/>
  <input type="hidden" name="nmgp_ordem" value=""/>
  <input type="hidden" name="nmgp_chave_det" value=""/>
  <input type="hidden" name="nmgp_quant_linhas" value=""/>
  <input type="hidden" name="nmgp_url_saida" value=""/>
  <input type="hidden" name="nmgp_parms" value=""/>
  <input type="hidden" name="nmgp_outra_jan" value=""/>
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"/> 
</form> 
<form name="F5" method="post" 
                  action="./" 
                  target="_self"> 
  <input type="hidden" name="nmgp_opcao" value="<?php if ($this->nm_Start_new) {echo "ini";} else {echo "igual";}?>"/>
  <input type="hidden" name="nmgp_parms" value=""/>
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"/> 
</form> 
<form name="F6" method="post" 
                  action="./" 
                  target="_self"> 
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"/> 
</form> 
<form name="F7" method="post" 
                  action="./" 
                  target="_self"> 
  <input type="hidden" name="nmgp_opcao" value="change_qtd_line"/>
  <input type="hidden" name="nmgp_max_line" value=""/>
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"/> 
</form> 
<form name="FCAP" action="" method="post" target="_blank"> 
  <input type="hidden" name="SC_lig_apl_orig" value="form_tbl_rate"/>
  <input type="hidden" name="nmgp_parms" value=""> 
  <input type="hidden" name="nmgp_outra_jan" value="true"> 
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
</form> 
<div id="id_div_process" style="display: none; margin: 10px; whitespace: nowrap" class="scFormProcessFixed"><span class="scFormProcess"><img border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" />&nbsp;<?php echo $this->Ini->Nm_lang['lang_othr_prcs']; ?>...</span></div>
<div id="id_div_process_block" style="display: none; margin: 10px; whitespace: nowrap"><span class="scFormProcess"><img border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" />&nbsp;<?php echo $this->Ini->Nm_lang['lang_othr_prcs']; ?>...</span></div>
<div id="id_fatal_error" class="" style="display: none; position: absolute"></div>
<script type="text/javascript"> 
<?php
  $JsonVarLiga = new Services_JSON();
?> 
<?php
  if (isset($this->NM_ajax_info['masterValue']) && !empty($this->NM_ajax_info['masterValue']))
  {
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_rate']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_rate']['dashboard_info']['under_dashboard']) {
          echo "  var dbParentFrame = $(parent.document).find(\"[name='" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_rate']['dashboard_info']['parent_widget'] . "']\")";
          echo "  if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)";
          echo "  {"; 
          foreach ($this->NM_ajax_info['masterValue'] as $cmp => $val)
          {
              echo " dbParentFrame[0].contentWindow.scAjaxDetailValue('" . $cmp . "', '" . $val . "');";
          }
      }
      else {
          echo "  if (parent.scAjaxDetailValue)";
          echo "  {"; 
          foreach ($this->NM_ajax_info['masterValue'] as $cmp => $val)
          {
              echo " parent.scAjaxDetailValue('" . $cmp . "', '" . $val . "');";
          }
          echo "  }"; 
      }
  }
?> 
var Crtl_btn_sc_btn_0 = false;
function sc_btn_sc_btn_0()
{
    if (scEventControl_active_all()) {
      setTimeout(function() { sc_btn_sc_btn_0(); }, 500);
      return;
    }
    if (Crtl_btn_sc_btn_0) {return;}
    sc_btn_sc_btn_0_ok();
}
function sc_btn_sc_btn_0_cancel()
{
}
function sc_btn_sc_btn_0_ok()
{
    Crtl_btn_sc_btn_0 = true;
    document.F1.nmgp_parms.value = "nmgp_opcao?#?formphp?@?nm_call_php?#?sc_btn_0?@?";
    document.F1.action = "./";
    document.F1.target = "_self";
    document.F1.submit();
}
var Crtl_btn_reset_ratework = false;
function sc_btn_reset_ratework()
{
    if (scEventControl_active_all()) {
      setTimeout(function() { sc_btn_reset_ratework(); }, 500);
      return;
    }
    if (Crtl_btn_reset_ratework) {return;}
    scJs_confirm("<?php echo html_entity_decode('DO YOU WANT TO RESET RATE WORK?', ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>", sc_btn_reset_ratework_ok, sc_btn_reset_ratework_cancel)
}
function sc_btn_reset_ratework_cancel()
{
}
function sc_btn_reset_ratework_ok()
{
    Crtl_btn_reset_ratework = true;
    document.F1.nmgp_parms.value = "nmgp_opcao?#?formphp?@?nm_call_php?#?reset_ratework?@?";
    document.F1.action = "./";
    document.F1.target = "_self";
    document.F1.submit();
}
var Crtl_btn_reset_ratefixed = false;
function sc_btn_reset_ratefixed()
{
    if (scEventControl_active_all()) {
      setTimeout(function() { sc_btn_reset_ratefixed(); }, 500);
      return;
    }
    if (Crtl_btn_reset_ratefixed) {return;}
    scJs_confirm("<?php echo html_entity_decode('DO YOU WANT TO RESET RATE FIXED?', ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>", sc_btn_reset_ratefixed_ok, sc_btn_reset_ratefixed_cancel)
}
function sc_btn_reset_ratefixed_cancel()
{
}
function sc_btn_reset_ratefixed_ok()
{
    Crtl_btn_reset_ratefixed = true;
    document.F1.nmgp_parms.value = "nmgp_opcao?#?formphp?@?nm_call_php?#?reset_ratefixed?@?";
    document.F1.action = "./";
    document.F1.target = "_self";
    document.F1.submit();
}
function sc_btn_RateFixedByValue()
{
    if (scEventControl_active_all()) {
      setTimeout(function() { sc_btn_RateFixedByValue(); }, 500);
      return;
    }
    sc_btn_RateFixedByValue_ok();
}
function sc_btn_RateFixedByValue_cancel()
{
}
function sc_btn_RateFixedByValue_ok()
{
  tb_show('', '<?php echo $this->Ini->link_frm_UpdateRatefixeByValue_edit; ?>?script_case_init=<?php echo $this->Ini->sc_page; ?>&nmgp_url_saida=modal&nmgp_parms=<?php echo "NM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scout"; ?>&nmgp_outra_jan=true&TB_iframe=true&height=400&width=400&modal=true', '');
}
function sc_btn_RateFixedByDept()
{
    if (scEventControl_active_all()) {
      setTimeout(function() { sc_btn_RateFixedByDept(); }, 500);
      return;
    }
    sc_btn_RateFixedByDept_ok();
}
function sc_btn_RateFixedByDept_cancel()
{
}
function sc_btn_RateFixedByDept_ok()
{
  tb_show('', '<?php echo $this->Ini->link_frm_UpdateRatefixeByDept_edit; ?>?script_case_init=<?php echo $this->Ini->sc_page; ?>&nmgp_url_saida=modal&nmgp_parms=<?php echo "NM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scout"; ?>&nmgp_outra_jan=true&TB_iframe=true&height=400&width=600&modal=true', '');
}
function sc_btn_RateWorkByValue()
{
    if (scEventControl_active_all()) {
      setTimeout(function() { sc_btn_RateWorkByValue(); }, 500);
      return;
    }
    sc_btn_RateWorkByValue_ok();
}
function sc_btn_RateWorkByValue_cancel()
{
}
function sc_btn_RateWorkByValue_ok()
{
  tb_show('', '<?php echo $this->Ini->link_frm_UpdateRateWorkByValue_edit; ?>?script_case_init=<?php echo $this->Ini->sc_page; ?>&nmgp_url_saida=modal&nmgp_parms=<?php echo "NM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scout"; ?>&nmgp_outra_jan=true&TB_iframe=true&height=400&width=400&modal=true', '');
}
function sc_btn_RateWorkByDept()
{
    if (scEventControl_active_all()) {
      setTimeout(function() { sc_btn_RateWorkByDept(); }, 500);
      return;
    }
    sc_btn_RateWorkByDept_ok();
}
function sc_btn_RateWorkByDept_cancel()
{
}
function sc_btn_RateWorkByDept_ok()
{
  tb_show('', '<?php echo $this->Ini->link_frm_UpdateRateWorkByDept_edit; ?>?script_case_init=<?php echo $this->Ini->sc_page; ?>&nmgp_url_saida=modal&nmgp_parms=<?php echo "NM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scout"; ?>&nmgp_outra_jan=true&TB_iframe=true&height=400&width=600&modal=true', '');
}
 NM_tp_critica(1);
function nm_gp_submit(apl_lig, apl_saida, parms, opc, target, modal_h, modal_w, apl_name) 
{ 
   if (target == 'modal') 
   {
       par_modal = '?script_case_init=<?php echo $this->form_encode_input($this->Ini->sc_page) ?>&script_case_session=<?php echo $this->form_encode_input(session_id()) ?>&nmgp_outra_jan=true&nmgp_url_saida=modal';
       if (opc != null && opc != '') 
       {
           par_modal += '&nmgp_opcao=grid';
       }
       if (parms != null && parms != '') 
       {
           par_modal += '&nmgp_parms=' + parms;
       }
<?php
  if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_rate']['where_detal']))
  {
?>  
       parent.tb_show('', apl_lig + par_modal + '&TB_iframe=true&modal=true&height=' + modal_h + '&width=' + modal_w, '');
<?php
  }
  else
  {
?>  
       tb_show('', apl_lig + par_modal + '&TB_iframe=true&modal=true&height=' + modal_h + '&width=' + modal_w, '');
<?php
  }
?>  
       return;
   }
   document.F3.target               = "_self"; 
   document.F3.action               = apl_lig  ;
   document.F3.nmgp_outra_jan.value = "";
   if (opc != null && opc != "") 
   {
       document.F3.nmgp_opcao.value = "grid" ;
   }
   else
   {
       document.F3.nmgp_opcao.value = "" ;
   }
   if (target != null && target == '_blank') 
   {
       document.F3.nmgp_outra_jan.value = "true" ;
       window.open('','jan_sc','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');
       document.F3.target = "jan_sc";
   }
   if (target != null && target == 'new_tab') 
   {
       document.F3.nmgp_outra_jan.value = "true";
       window.open('','jan_sc','');
       document.F3.target = "jan_sc";
   }
   document.F3.nmgp_url_saida.value = apl_saida ;
   document.F3.nmgp_parms.value     = parms ;
   document.F3.submit() ;
} 

function scInlineFormSend()
{
  return false;
}

function nm_navpage(x, op) 
{ 
    if (op == "P") 
    { 
        x = ((x * <?php echo $this->sc_max_reg . ") - ". $this->sc_max_reg?>) + 1; 
    } 
    nm_move('navpage', x);
} 
function nm_move(x, y, z) 
{ 
    if (x == "modal_igual")
    {
        x = "igual";
    }
    else
    if (Nm_Proc_Atualiz)
    {
        return;
    }
    if (("inicio" == x || "retorna" == x) && "S" != Nav_permite_ret)
    {
        return;
    }
    if (("avanca" == x || "final" == x) && "S" != Nav_permite_ava)
    {
        return;
    }
    document.F2.nmgp_opcao.value = x; 
    document.F2.nmgp_ordem.value = y; 
    document.F2.nmgp_clone.value = "";
    if ("apl_detalhe" == x)
    {
        document.F2.nmgp_opcao.value = 'igual'; 
        document.F2.master_nav.value = 'on'; 
        if (z)
        {
            document.F2.sc_ifr_height.value = z;
        }
        document.F2.submit();
        return;
    }
    if ("clone" == x)
    {
        x = "novo";
        document.F2.nmgp_clone.value = "S";
        document.F2.nmgp_opcao.value = x; 
    }
    if ("fast_search" == x)
    {
        document.F2.nmgp_ordem.value = ''; 
        document.F2.nmgp_fast_search.value = scAjaxGetFieldSelectMult("nmgp_fast_search_" + y, ";"); 
        document.F2.nmgp_arg_fast_search.value = scAjaxGetFieldText("nmgp_arg_fast_search_" + y); 
        var ver_ch = eval('change_fast_' + y);
        if (document.F2.nmgp_arg_fast_search.value == '' && ver_ch == '')
        { 
            scJs_alert("<?php echo $this->Ini->Nm_lang['lang_srch_req_field'] ?>");
            document.F1.elements["nmgp_arg_fast_search_" + y].focus();
            return false;
        } 
        if (document.F2.nmgp_arg_fast_search.value == '__Clear_Fast__')
        { 
            document.F2.nmgp_arg_fast_search.value = '';
            document.F1.elements["nmgp_arg_fast_search_" + y].value = '';
        } 
        if(document.F2.nmgp_arg_fast_search.value == '') 
        { 
            $('#SC_fast_search_close_' + y).hide();
            $('#SC_fast_search_submit_' + y).show();
        } 
        else 
        { 
            $('#SC_fast_search_close_' + y).show();
            $('#SC_fast_search_submit_' + y).hide();
        } 
        document.F2.nmgp_cond_fast_search.value = scAjaxGetFieldText("nmgp_cond_fast_search_" + y); 
    }
    if ("novo" == x || "edit_novo" == x || "reload_novo" == x)
    {
<?php
       $NM_parm_ifr = (isset($NM_run_iframe) && $NM_run_iframe == 1) ? "NM_run_iframe?#?1?@?" : "";
?>
        document.F2.nmgp_parms.value = "<?php echo $NM_parm_ifr ?>";
        if (scFormHasChanged) {
          scJs_confirm('<?php echo html_entity_decode($this->Ini->Nm_lang['lang_reload_confirm']) ?>', function() { document.F2.submit(); }, function() {});
        } else {
          document.F2.submit();
        }
    }
    else
    {
        do_ajax_form_tbl_rate_navigate_form();
    }
    if ("ordem" == x)
    {
        scSetOrderColumn(y);
    }
} 
var sc_mupload_ok = true;
var Nm_submit_ok = true; 
function nm_atualiza(x, y) 
{ 
    if ("incluir" == x) {
        scForm_insert(x, y);
        return;
    }
    if ("alterar" == x) {
        scForm_update(x, y);
        return;
    }
    if ("excluir" == x) {
        scForm_delete(x, y);
        return;
    }
    if ("recarga_mobile" == x) {
        scForm_refreshMobile(x, y);
        return;
    }
    if ("muda_form" == x) {
        scForm_changeForm(x, y);
        return;
    }
<?php 
    if (isset($this->Refresh_aba_menu)) 
    {
?>
        var aba_refresh_name = '<?php echo $this->Refresh_aba_menu ?>';
        parent.Tab_refresh[aba_refresh_name] = "S";
        if (typeof parent.tabLinkRefresh === 'function') {
            parent.tabLinkRefresh(aba_refresh_name);
        }<?php 
    }
?>
    if (scEventControl_active_all()) {
      setTimeout(function() { nm_atualiza(x, y); }, 500);
      return;
    }
    if (!sc_mupload_ok)
    {
        if (!confirm("<?php echo $this->Ini->Nm_lang['lang_errm_muok'] ?>"))
        {
            return;
        }
        sc_mupload_ok = true;
    }
    Nm_submit_ok = true; 
    if (Nm_Proc_Atualiz)
    {
        return;
    }
    if (!scAjaxDetailProc())
    {
        return;
    }
<?php
    $NM_parm_ifr = (isset($NM_run_iframe) && $NM_run_iframe == 1) ? "NM_run_iframe?#?1?@?" : "";
?>
    document.F1.nmgp_parms.value = "<?php echo $NM_parm_ifr ?>";
    document.F1.target = "_self";
    if (x == "muda_form") 
    { 
       document.F1.nmgp_num_form.value = y; 
    } 
    if (x == "excluir" && sc_quant_excl > 0) 
    { 
       if (confirm ("<?php echo html_entity_decode($this->Ini->Nm_lang['lang_errm_cfrm_remv'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"))  
       { 
           scAjaxProcOn();
           document.F1.nmgp_opcao.value = x; 
           nm_field_disabled_reset();
           document.F1.submit(); 
       } 
       else 
       { 
          return; 
       } 
    } 
    else 
    { 
       scAjaxProcOn();
       document.F1.nmgp_opcao.value = x; 
       nm_field_disabled_reset();
       document.F1.submit(); 
    } 
    if (Nm_submit_ok)
    { 
        Nm_Proc_Atualiz = true;
    } 
} 

<?php
$NM_parm_ifr = (isset($NM_run_iframe) && $NM_run_iframe == 1) ? "NM_run_iframe?#?1?@?" : "";
?>
function scForm_cancel() {
        return;
}
function scForm_insert(x, y) {
        if (!scForm_initSubmit(x, y)) { return; }
        scForm_checkMultiUpload(function() { scForm_insert_prepare(x, y); }, scForm_cancel);
} // scForm_insert

function scForm_update(x, y) {
        if (!scForm_initSubmit(x, y)) { return; }
        scForm_checkMultiUpload(function() { scForm_update_prepare(x, y); }, scForm_cancel);
} // scForm_update

function scForm_delete(x, y) {
        if (!scForm_initSubmit(x, y)) { return; }
        scForm_checkMultiUpload(function() { scForm_general_submit(x, y); }, scForm_cancel);
} // scForm_delete

function scForm_refreshMobile(x, y) {
        if (!scForm_initSubmit(x, y)) { return; }
        scForm_checkMultiUpload(function() { scForm_general_submit(x, y); }, scForm_cancel);
} // scForm_refreshMobile

function scForm_changeForm(x, y) {
        if (!scForm_initSubmit(x, y)) { return; }
        scForm_checkMultiUpload(function() { scForm_general_submit(x, y); }, scForm_cancel);
} // scForm_changeForm

function scForm_insert_prepare(x, y) {
        scForm_general_prepare(x, y);
        scForm_confirmInsert_multi(function() { scForm_submit_multi(x); }, scForm_cancel);
} // scForm_insert_prepare

function scForm_update_prepare(x, y) {
        scForm_general_prepare(x, y);
        scForm_confirmUpdate_multi(function() { scForm_submit_multi(x); }, scForm_cancel);
} // scForm_update_prepare

function scForm_general_prepare(x, y) {
        sc_mupload_ok = true;
        if (false === scForm_onSubmit(x)) {
                return;
        }
        scForm_setFormValues(x, y);
        scForm_packMultiSelect_multi();
        scForm_packSignature_multi();
} // scForm_general_prepare

function scForm_general_submit(x, y) {
        scForm_general_prepare(x, y);
        scForm_submit_multi(x);
} // scForm_general_submit

function scForm_confirmInsert_multi(callbackOk, callbackCancel) {
        callbackOk();
} // scForm_confirmInsert_multi

function scForm_confirmUpdate_multi(callbackOk, callbackCancel) {
        callbackOk();
} // scForm_confirmUpdate_multi

function scForm_submit_multi(x) {
        if (x == "excluir" && sc_quant_excl > 0) {
                scJs_confirm("<?php echo html_entity_decode($this->Ini->Nm_lang['lang_errm_cfrm_remv'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>", function() { scForm_submit_multi_after(x); }, scForm_cancel);
        }
        else {
                scForm_submit_multi_after(x);
        }
} // scForm_submit_multi

function scForm_submit_multi_after(x) {
    scAjaxProcOn();
        document.F1.nmgp_opcao.value = x;
        nm_field_disabled_reset();
        document.F1.submit();
        if (Nm_submit_ok) {
                Nm_Proc_Atualiz = true;
        }
} // scForm_submit_multi_after

function scForm_initSubmit(x, y) {
<?php
if (isset($this->Refresh_aba_menu)) {
?>
        var aba_refresh_name = '<?php echo $this->Refresh_aba_menu ?>';
        parent.Tab_refresh[aba_refresh_name] = "S";
        if (typeof parent.tabLinkRefresh === 'function') {
            parent.tabLinkRefresh(aba_refresh_name);
        }
<?php
}
?>
        if (scEventControl_active_all()) {
                setTimeout(function() { nm_atualiza(x, y); }, 500);
                return false;
        }

        Nm_submit_ok = true;
        if (Nm_Proc_Atualiz) {
                return false;
        }
        if (!scAjaxDetailProc()) {
                return false;
        }

        return true;
} // scForm_initSubmit


function scForm_checkMultiUpload(callbackOk, callbackCancel) {
        if (!sc_mupload_ok) {
                scJs_confirm("<?php echo $this->Ini->Nm_lang['lang_errm_muok'] ?>", callbackOk, callbackCancel);
        }
        else {
                callbackOk();
        }
} // scForm_checkMultiUpload

function scForm_onSubmit(x) {
        return true;
} // scForm_onSubmit

function scForm_setFormValues(x, y) {
        document.F1.nmgp_parms.value = "<?php echo $NM_parm_ifr ?>";
        document.F1.target = "_self";
        if (x == "muda_form") {
                document.F1.nmgp_num_form.value = y;
        }
} // scForm_setFormValues

function scForm_packMultiSelect_single() {
} //scForm_packMultiSelect_single

function scForm_packMultiSelect_multi() {
        NM_count_mult = document.F1.sc_contr_vert.value;
} // scForm_packMultiSelect_multi

function scForm_packSignature_single() {
} // scForm_packSignature_single

function scForm_packSignature_multi() {
        NM_count_mult = document.F1.sc_contr_vert.value;
} // scForm_packSignature_multi

function scForm_confirmDelete(callbackOk, callbackCancel) {
        scJs_confirm("<?php echo html_entity_decode($this->Ini->Nm_lang['lang_errm_remv'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>", callbackOk, callbackCancel);
} // scForm_confirmDelete

function scForm_confirmInsert_single(callbackOk, callbackCancel) {
        callbackOk();
} // scForm_confirmInsert_single

function scForm_confirmUpdate_single(callbackOk, callbackCancel) {
        callbackOk();
} // scForm_confirmUpdate_single

function scForm_submit_control(x) {
        document.F1.nmgp_opcao.value = x;
        document.F1.submit();
        if (Nm_submit_ok) {
                Nm_Proc_Atualiz = true;
        }
} // scForm_submit_control

function scForm_submit_single(x) {
        if (x != "excluir")
        {
                document.F1.nmgp_opcao.value = x;
                if ("incluir" == x || "muda_form" == x || "recarga" == x || "recarga_mobile" == x) {
            scAjaxProcOn();
                        Nm_Proc_Atualiz = true;
                        document.F1.submit();
                }
                else {
                        Nm_Proc_Atualiz = true;
                        do_ajax_form_tbl_rate_submit_form();
                }
        }
        if (Nm_submit_ok) {
                Nm_Proc_Atualiz = true;
        }
} // scForm_submit_single

<?php
if ($this->Embutida_form)
{
?>
function nm_atualiza_line(x, y) 
{ 
    if (Nm_Proc_Atualiz)
    {
        return;
    }
    var_num_lin_process = y;;
    z = document.getElementById("idVertRow" + y).rowIndex;
    document.F1.nmgp_parms.value = "";
    document.F1.target = "_self";
    document.F1.nmgp_opcao.value = x; 
    if (x == "incluir")
    {
      scForm_inline_confirmInsert(function() { scForm_inline_submit(y, z); }, scForm_cancel)
    }
    if (x == "alterar")
    {
      scForm_inline_confirmUpdate(function() { scForm_inline_submit(y, z); }, scForm_cancel)
    }
    if (x == "excluir")
    {
      scForm_inline_confirmDelete(function() { scForm_inline_submit(y, z); }, scForm_cancel)
    }
} 
<?php
}
?>
function scForm_inline_submit(y, z) {
        Nm_Proc_Atualiz = true;
        do_ajax_form_tbl_rate_submit_form(y, z);
} // scForm_inline_submit

function scForm_inline_confirmInsert(callbackOk, callbackCancel) {
        callbackOk();
} // scForm_inline_confirmInsert

function scForm_inline_confirmUpdate(callbackOk, callbackCancel) {
        callbackOk();
} // scForm_inline_confirmUpdate

function scForm_inline_confirmDelete(callbackOk, callbackCancel) {
        scJs_confirm("<?php echo html_entity_decode($this->Ini->Nm_lang['lang_errm_remv'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>", callbackOk, callbackCancel);
} // scForm_inline_confirmDelete

function nm_mostra_img(imagem, altura, largura)
{
    var image = new Image();
    image.src = imagem;
    var viewer = new Viewer(image, {
        navbar: false,
        hidden: function () {
            viewer.destroy();
        },
    });
    viewer.show();
}
function nm_recarga_form(nm_ult_ancora, nm_ult_page) 
{ 
    document.F1.target = "_self";
    document.F1.nmgp_parms.value = "";
    document.F1.nmgp_ancora.value= nm_ult_page; 
    document.F1.nmgp_ancora.value= nm_ult_page; 
    document.F1.nmgp_opcao.value= "recarga"; 
    document.F1.action += "#" +  nm_ult_ancora;
    document.F1.submit(); 
} 
function nm_link_url(Sc_url)
{
    if (Sc_url.substr(0, 7) != 'http://' && Sc_url.substr(0, 8) != 'https://')
    {
        Sc_url = 'http://' + Sc_url;
    }
    return Sc_url;
}
function sc_trim(str, chars) {
        return sc_ltrim(sc_rtrim(str, chars), chars);
}
function sc_ltrim(str, chars) {
        chars = chars || "\\s";
        return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}
function sc_rtrim(str, chars) {
        chars = chars || "\\s";
        return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}
function nm_check_insert(iLine)
{
   if (document.F1.elements['sc_check_vert[' + iLine + ']'])
      document.F1.elements['sc_check_vert[' + iLine + ']'].checked = true;
}
function nm_uncheck_delete()
{
   if (!document.F1.sc_contr_vert)
      return;
   for (iLine = 1; iLine < document.F1.sc_contr_vert.value; iLine++)
      if (document.F1.elements['sc_check_vert[' + iLine + ']'])
         document.F1.elements['sc_check_vert[' + iLine + ']'].checked = false;
}
var hasJsFormOnload = true;
function sc_form_onload()
{
   nm_field_disabled("dept_=disabled", "U");
   
}

function scCssFocus(oHtmlObj, iSeqVert)
{
  if (navigator.userAgent && 0 < navigator.userAgent.indexOf("MSIE") && "select" == oHtmlObj.type.substr(0, 6))
    return;
  $(oHtmlObj).addClass('scFormObjectFocusOddMult')
             .removeClass('scFormObjectOddMult');
}

function scCssBlur(oHtmlObj, iSeqVert)
{
  if (navigator.userAgent && 0 < navigator.userAgent.indexOf("MSIE") && "select" == oHtmlObj.type.substr(0, 6))
    return;
  $(oHtmlObj).addClass('scFormObjectOddMult')
             .removeClass('scFormObjectFocusOddMult');
}

 function nm_submit_cap(apl_dest, parms)
 {
    document.FCAP.action = apl_dest;
    document.FCAP.nmgp_parms.value = parms;
    window.open('','jan_cap','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');
    document.FCAP.target = "jan_cap"; 
    document.FCAP.submit();
 }

 function nm_field_disabled(Fields, Opt, Seq, Opcao) {
  if (Opcao != null) {
      opcao = Opcao;
  }
  else {
      opcao = "<?php if ($GLOBALS["erro_incl"] == 1) {echo "novo";} else {echo $this->nmgp_opcao;} ?>";
  }
  if (opcao == "novo" && Opt == "U") {
      return;
  }
  if (opcao != "novo" && Opt == "I") {
      return;
  }
  Field = Fields.split(";");
  for (i=0; i < Field.length; i++)
  {
     F_temp = Field[i].split("=");
     F_name = F_temp[0];
     F_opc  = (F_temp[1] && ("disabled" == F_temp[1] || "true" == F_temp[1])) ? true : false;
     ini = 1;
     xx = document.F1.sc_contr_vert.value;
     if (Seq != null) 
     {
         ini = parseInt(Seq);
         xx  = ini + 1;
     }
     if (F_name == "dept_")
     {
        for (ii=ini; ii < xx; ii++)
        {
            cmp_name = "dept_" + ii;
            $('input[name=' + cmp_name + ']').prop("disabled", F_opc);
            if (F_opc == "disabled" || F_opc == true) {
                $('input[name=' + cmp_name + ']').addClass("scFormInputDisabledMult");
            }
            else {
                $('input[name=' + cmp_name + ']').removeClass("scFormInputDisabledMult");
            }
        }
     }
  }
 } // nm_field_disabled
 function nm_field_disabled_reset() {
  for (var i = 0; i <= iAjaxNewLine; i++) {
    nm_field_disabled("dept_=enabled", "", i);
  }
 } // nm_field_disabled_reset
</script> 
