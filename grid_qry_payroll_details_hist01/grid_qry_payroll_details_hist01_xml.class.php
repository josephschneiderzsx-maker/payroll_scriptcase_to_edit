<?php

class grid_qry_payroll_details_hist01_xml
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;

   var $Arquivo;
   var $Arquivo_view;
   var $Tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();
   var $count_ger;
   var $sum_sal_brut_reg;
   var $sum_income_workday_ot;
   var $sum_income_holiday_ot;
   var $sum_income_restday_ot;
   var $sum_income_offday_ot;
   var $sum_incentive;
   var $sum_income_comm;
   var $sum_rappel;
   var $sum_tax_cass;
   var $sum_tax_cfgdct;
   var $sum_tax_fdu;
   var $sum_tax_iris;
   var $sum_tax_ona;
   var $sum_tax_iric;
   var $sum_dedeuct_cons;
   var $sum_loan_deduction;
   var $sum_loan_deduction_bank;
   var $sum_other_deduct;
   var $sum_total_deduct;
   var $sum_sal_net;
   var $dct_userid_int;
   var $cnt_userid_int;
   var $sum_rate_salf;
   var $sum_rate_work;
   var $sum_income_workday;
   var $sum_income_holiday;
   var $sum_income_restday;
   var $sum_income_offday;
   var $sum_hh_sunday;
   var $sum_sal_sunday;
   var $sum_hh_offday;
   var $sum_sal_holiday;
   var $sum_sal_leavetype;
   var $sum_ot_hh_w;
   var $sum_ot_hh_w_pm;
   var $sum_ot_hh_h;
   var $sum_ot_hh_h_pm;
   var $sum_ot_hh_r;
   var $sum_ot_hh_r_pm;
   var $sum_ot_hh_o;
   var $sum_ot_hh_o_pm;

   //---- 
   function __construct()
   {
      $this->nm_data   = new nm_data("en_us");
   }


function actionBar_isValidState($buttonName, $buttonState)
{
    switch ($buttonName) {
    }

    return false;
}


function actionBar_displayState($buttonName)
{
    switch ($buttonName) {
    }
}

function actionBar_getStateHint($buttonName)
{
    switch ($buttonName) {
    }
}

function actionBar_getStateConfirm($buttonName)
{
    switch ($buttonName) {
    }
}

function actionBar_getStateDisable($buttonName)
{
    if (isset($this->sc_actionbar_disabled[$buttonName]) && $this->sc_actionbar_disabled[$buttonName]) {
        return ' disabled';
    }

    return '';
}

function actionBar_getStateHide($buttonName)
{
    if (isset($this->sc_actionbar_hidden[$buttonName]) && $this->sc_actionbar_hidden[$buttonName]) {
        return ' sc-actionbar-button-hidden';
    }

    return '';
}

   //---- 
   function monta_xml()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['embutida'])
      {
          if ($this->Ini->sc_export_ajax)
          {
              $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Xml_f);
              $this->Arr_result['title_export'] = NM_charset_to_utf8($this->Tit_doc);
              $Temp = ob_get_clean();
              if ($Temp !== false && trim($Temp) != "")
              {
                  $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
              }
              $oJson = new Services_JSON();
              echo $oJson->encode($this->Arr_result);
              exit;
          }
          else
          {
              $this->progress_bar_end();
          }
      }
      else
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['opcao'] = "";
      }
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      if (isset($GLOBALS['nmgp_parms']) && !empty($GLOBALS['nmgp_parms'])) 
      { 
          $GLOBALS['nmgp_parms'] = str_replace("@aspass@", "'", $GLOBALS['nmgp_parms']);
          $todox = str_replace("?#?@?@?", "?#?@ ?@?", $GLOBALS["nmgp_parms"]);
          $todo  = explode("?@?", $todox);
          foreach ($todo as $param)
          {
               $cadapar = explode("?#?", $param);
               if (1 < sizeof($cadapar))
               {
                   if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                   {
                       $cadapar[0] = substr($cadapar[0], 11);
                       $cadapar[1] = $_SESSION[$cadapar[1]];
                   }
                   if (isset($GLOBALS['sc_conv_var'][$cadapar[0]]))
                   {
                       $cadapar[0] = $GLOBALS['sc_conv_var'][$cadapar[0]];
                   }
                   elseif (isset($GLOBALS['sc_conv_var'][strtolower($cadapar[0])]))
                   {
                       $cadapar[0] = $GLOBALS['sc_conv_var'][strtolower($cadapar[0])];
                   }
                   nm_limpa_str_grid_qry_payroll_details_hist01($cadapar[1]);
                   nm_protect_num_grid_qry_payroll_details_hist01($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_qry_payroll_details_hist01']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->New_Format  = true;
      $this->Xml_tag_label = true;
      $this->Tem_xml_res = false;
      $this->Xml_password = "";
      if (isset($_REQUEST['nm_xml_tag']) && !empty($_REQUEST['nm_xml_tag']))
      {
          $this->New_Format = ($_REQUEST['nm_xml_tag'] == "tag") ? true : false;
      }
      if (isset($_REQUEST['nm_xml_label']) && !empty($_REQUEST['nm_xml_label']))
      {
          $this->Xml_tag_label = ($_REQUEST['nm_xml_label'] == "S") ? true : false;
      }
      $this->Tem_xml_res  = true;
      if (isset($_REQUEST['SC_module_export']) && $_REQUEST['SC_module_export'] != "")
      { 
          $this->Tem_xml_res = (strpos(" " . $_REQUEST['SC_module_export'], "resume") !== false) ? true : false;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['SC_Ind_Groupby'] == "_NM_SC_")
      {
          $this->Tem_xml_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['SC_Gb_Free_cmp']))
      {
          $this->Tem_xml_res  = false;
      }
      if (!is_file($this->Ini->root . $this->Ini->path_link . "grid_qry_payroll_details_hist01/grid_qry_payroll_details_hist01_res_xml.class.php"))
      {
          $this->Tem_xml_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_label']))
      {
          $this->Xml_tag_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_label'];
          $this->New_Format    = true;
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_qry_payroll_details_hist01_total.class.php"); 
      $this->Tot      = new grid_qry_payroll_details_hist01_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][1];
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['SC_Ind_Groupby'] == "sc_free_group_by")
          {
              $this->sum_sal_brut_reg = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][2];
              $this->sum_income_workday_ot = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][3];
              $this->sum_income_holiday_ot = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][4];
              $this->sum_income_restday_ot = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][5];
              $this->sum_income_offday_ot = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][6];
              $this->sum_incentive = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][7];
              $this->sum_income_comm = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][8];
              $this->sum_rappel = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][9];
              $this->sum_tax_cass = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][10];
              $this->sum_tax_cfgdct = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][11];
              $this->sum_tax_fdu = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][12];
              $this->sum_tax_iris = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][13];
              $this->sum_tax_ona = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][14];
              $this->sum_tax_iric = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][15];
              $this->sum_dedeuct_cons = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][16];
              $this->sum_loan_deduction = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][17];
              $this->sum_loan_deduction_bank = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][18];
              $this->sum_other_deduct = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][19];
              $this->sum_total_deduct = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][20];
              $this->sum_sal_net = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][21];
              $this->dct_userid_int = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][22];
              $this->cnt_userid_int = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][23];
              $this->sum_rate_salf = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][24];
              $this->sum_rate_work = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][25];
              $this->sum_income_workday = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][26];
              $this->sum_income_holiday = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][27];
              $this->sum_income_restday = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][28];
              $this->sum_income_offday = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][29];
              $this->sum_hh_sunday = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][30];
              $this->sum_sal_sunday = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][31];
              $this->sum_hh_offday = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][32];
              $this->sum_sal_holiday = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][33];
              $this->sum_sal_leavetype = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][34];
              $this->sum_ot_hh_w = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][35];
              $this->sum_ot_hh_w_pm = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][36];
              $this->sum_ot_hh_h = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][37];
              $this->sum_ot_hh_h_pm = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][38];
              $this->sum_ot_hh_r = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][39];
              $this->sum_ot_hh_r_pm = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][40];
              $this->sum_ot_hh_o = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][41];
              $this->sum_ot_hh_o_pm = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][42];
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['SC_Ind_Groupby'] == "_NM_SC_")
          {
              $this->sum_sal_brut_reg = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][2];
              $this->sum_income_workday_ot = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][3];
              $this->sum_income_holiday_ot = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][4];
              $this->sum_income_restday_ot = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][5];
              $this->sum_income_offday_ot = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][6];
              $this->sum_incentive = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][7];
              $this->sum_income_comm = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][8];
              $this->sum_rappel = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][9];
              $this->sum_tax_cass = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][10];
              $this->sum_tax_cfgdct = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][11];
              $this->sum_tax_fdu = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][12];
              $this->sum_tax_iris = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][13];
              $this->sum_tax_ona = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][14];
              $this->sum_tax_iric = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][15];
              $this->sum_dedeuct_cons = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][16];
              $this->sum_loan_deduction = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][17];
              $this->sum_loan_deduction_bank = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][18];
              $this->sum_other_deduct = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][19];
              $this->sum_total_deduct = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][20];
              $this->sum_sal_net = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][21];
              $this->sum_rate_salf = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][22];
              $this->sum_rate_work = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][23];
              $this->sum_income_workday = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][24];
              $this->sum_income_holiday = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][25];
              $this->sum_income_restday = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][26];
              $this->sum_income_offday = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][27];
              $this->sum_hh_sunday = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][28];
              $this->sum_sal_sunday = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][29];
              $this->sum_hh_offday = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][30];
              $this->sum_sal_holiday = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][31];
              $this->sum_sal_leavetype = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][32];
              $this->sum_ot_hh_w = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][33];
              $this->sum_ot_hh_w_pm = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][34];
              $this->sum_ot_hh_h = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][35];
              $this->sum_ot_hh_h_pm = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][36];
              $this->sum_ot_hh_r = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][37];
              $this->sum_ot_hh_r_pm = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][38];
              $this->sum_ot_hh_o = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][39];
              $this->sum_ot_hh_o_pm = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['tot_geral'][40];
          }
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_qry_payroll_details_hist01']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_return']);
          if ($this->Tem_xml_res) {
              $PB_plus = intval ($this->count_ger * 0.04);
              $PB_plus = ($PB_plus < 2) ? 2 : $PB_plus;
          }
          else {
              $PB_plus = intval ($this->count_ger * 0.02);
              $PB_plus = ($PB_plus < 1) ? 1 : $PB_plus;
          }
          $PB_tot = $this->count_ger + $PB_plus;
          $this->PB_dif = $PB_tot - $this->count_ger;
          $this->pb->setTotalSteps($PB_tot);
      }
      $this->nm_data    = new nm_data("en_us");
      $this->Arquivo      = "sc_xml";
      $this->Arquivo     .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arq_zip      = $this->Arquivo . "_grid_qry_payroll_details_hist01.zip";
      $this->Arquivo     .= "_grid_qry_payroll_details_hist01";
      $this->Arquivo_view = $this->Arquivo . "_view.xml";
      $this->Arquivo     .= ".xml";
      $this->Tit_doc      = "grid_qry_payroll_details_hist01.xml";
      $this->Tit_zip      = "grid_qry_payroll_details_hist01.zip";
      $this->Grava_view   = false;
      if (strtolower($_SESSION['scriptcase']['charset']) != strtolower($_SESSION['scriptcase']['charset_html']))
      {
          $this->Grava_view = true;
      }
   }

   //---- 
   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }

   //----- 
   function grava_arquivo()
   {
      global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_qry_payroll_details_hist01']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_qry_payroll_details_hist01']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_qry_payroll_details_hist01']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->userid_int = (isset($Busca_temp['userid_int'])) ? $Busca_temp['userid_int'] : ""; 
          $tmp_pos = (is_string($this->userid_int)) ? strpos($this->userid_int, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->userid_int))
          {
              $this->userid_int = substr($this->userid_int, 0, $tmp_pos);
          }
          $this->hiredate = (isset($Busca_temp['hiredate'])) ? $Busca_temp['hiredate'] : ""; 
          $tmp_pos = (is_string($this->hiredate)) ? strpos($this->hiredate, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hiredate))
          {
              $this->hiredate = substr($this->hiredate, 0, $tmp_pos);
          }
          $this->hiredate_2 = (isset($Busca_temp['hiredate_input_2'])) ? $Busca_temp['hiredate_input_2'] : ""; 
          $this->username = (isset($Busca_temp['username'])) ? $Busca_temp['username'] : ""; 
          $tmp_pos = (is_string($this->username)) ? strpos($this->username, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->username))
          {
              $this->username = substr($this->username, 0, $tmp_pos);
          }
          $this->dept = (isset($Busca_temp['dept'])) ? $Busca_temp['dept'] : ""; 
          $tmp_pos = (is_string($this->dept)) ? strpos($this->dept, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->dept))
          {
              $this->dept = substr($this->dept, 0, $tmp_pos);
          }
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_name'] .= ".xml";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_name']);
      }
      if (!$this->Grava_view)
      {
          $this->Arquivo_view = $this->Arquivo;
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['embutida'])
      { 
          $xml_charset = $_SESSION['scriptcase']['charset'];
          $this->Xml_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
          $xml_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
          fwrite($xml_f, "<?xml version=\"1.0\" encoding=\"$xml_charset\" ?>\r\n");
          fwrite($xml_f, "<root>\r\n");
          if ($this->Grava_view)
          {
              $xml_charset_v = $_SESSION['scriptcase']['charset_html'];
              $xml_v         = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo_view, "w");
              fwrite($xml_v, "<?xml version=\"1.0\" encoding=\"$xml_charset_v\" ?>\r\n");
              fwrite($xml_v, "<root>\r\n");
          }
      }
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT username, pay_startdate, pay_enddate, sal_brut_reg, income_workday_ot, income_holiday_ot, income_restday_ot, income_offday_ot, incentive, income_comm, rappel, tax_cass, tax_cfgdct, tax_fdu, tax_iris, tax_ona, tax_iric, dedeuct_cons, loan_deduction, loan_deduction_bank, other_deduct, total_deduct, sal_net, bank_number, userid_int, hiredate, dept, Rate_SALF, Rate_Work, rate_ot_factor, rate_ot_holiday_factor, rate_ot_restday_factor, rate_ot_offday_factor, income_workday, income_holiday, income_restday, income_offday, hh_sunday, sal_sunday, hh_offday, sal_holiday, sal_leavetype, ot_hh_w, ot_hh_w_PM, ot_hh_h, ot_hh_h_PM, ot_hh_r, ot_hh_r_PM, ot_hh_o, ot_hh_o_PM, incentive_desc, rappel_desc from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT username, pay_startdate, pay_enddate, sal_brut_reg, income_workday_ot, income_holiday_ot, income_restday_ot, income_offday_ot, incentive, income_comm, rappel, tax_cass, tax_cfgdct, tax_fdu, tax_iris, tax_ona, tax_iric, dedeuct_cons, loan_deduction, loan_deduction_bank, other_deduct, total_deduct, sal_net, bank_number, userid_int, hiredate, dept, Rate_SALF, Rate_Work, rate_ot_factor, rate_ot_holiday_factor, rate_ot_restday_factor, rate_ot_offday_factor, income_workday, income_holiday, income_restday, income_offday, hh_sunday, sal_sunday, hh_offday, sal_holiday, sal_leavetype, ot_hh_w, ot_hh_w_PM, ot_hh_h, ot_hh_h_PM, ot_hh_r, ot_hh_r_PM, ot_hh_o, ot_hh_o_PM, incentive_desc, rappel_desc from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['where_pesq'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['where_resumo'])) 
      { 
          if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['where_pesq'])) 
          { 
              $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['where_resumo']; 
              $nmgp_select_count .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['where_resumo']; 
          } 
          else
          { 
              $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['where_resumo'] . ")"; 
              $nmgp_select_count .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['where_resumo'] . ")"; 
          } 
      } 
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select_count;
      $rt = $this->Db->Execute($nmgp_select_count);
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->count_ger = $rt->fields[0];
      $rt->Close();
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->SC_seq_register = 0;
      $this->xml_registro = "";
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['embutida'])
         { 
             $this->xml_registro .= "<" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['embutida_tit'] . ">\r\n";
         }
         elseif ($this->New_Format)
         {
             $this->xml_registro = "<grid_qry_payroll_details_hist01>\r\n";
         }
         else
         {
             $this->xml_registro = "<grid_qry_payroll_details_hist01";
         }
         $this->username = $rs->fields[0] ;  
         $this->pay_startdate = $rs->fields[1] ;  
         $this->pay_enddate = $rs->fields[2] ;  
         $this->sal_brut_reg = $rs->fields[3] ;  
         $this->sal_brut_reg =  str_replace(",", ".", $this->sal_brut_reg);
         $this->sal_brut_reg = (string)$this->sal_brut_reg;
         $this->income_workday_ot = $rs->fields[4] ;  
         $this->income_workday_ot =  str_replace(",", ".", $this->income_workday_ot);
         $this->income_workday_ot = (string)$this->income_workday_ot;
         $this->income_holiday_ot = $rs->fields[5] ;  
         $this->income_holiday_ot =  str_replace(",", ".", $this->income_holiday_ot);
         $this->income_holiday_ot = (string)$this->income_holiday_ot;
         $this->income_restday_ot = $rs->fields[6] ;  
         $this->income_restday_ot =  str_replace(",", ".", $this->income_restday_ot);
         $this->income_restday_ot = (string)$this->income_restday_ot;
         $this->income_offday_ot = $rs->fields[7] ;  
         $this->income_offday_ot =  str_replace(",", ".", $this->income_offday_ot);
         $this->income_offday_ot = (string)$this->income_offday_ot;
         $this->incentive = $rs->fields[8] ;  
         $this->incentive =  str_replace(",", ".", $this->incentive);
         $this->incentive = (string)$this->incentive;
         $this->income_comm = $rs->fields[9] ;  
         $this->income_comm =  str_replace(",", ".", $this->income_comm);
         $this->income_comm = (string)$this->income_comm;
         $this->rappel = $rs->fields[10] ;  
         $this->rappel =  str_replace(",", ".", $this->rappel);
         $this->rappel = (string)$this->rappel;
         $this->tax_cass = $rs->fields[11] ;  
         $this->tax_cass =  str_replace(",", ".", $this->tax_cass);
         $this->tax_cass = (string)$this->tax_cass;
         $this->tax_cfgdct = $rs->fields[12] ;  
         $this->tax_cfgdct =  str_replace(",", ".", $this->tax_cfgdct);
         $this->tax_cfgdct = (string)$this->tax_cfgdct;
         $this->tax_fdu = $rs->fields[13] ;  
         $this->tax_fdu =  str_replace(",", ".", $this->tax_fdu);
         $this->tax_fdu = (string)$this->tax_fdu;
         $this->tax_iris = $rs->fields[14] ;  
         $this->tax_iris =  str_replace(",", ".", $this->tax_iris);
         $this->tax_iris = (string)$this->tax_iris;
         $this->tax_ona = $rs->fields[15] ;  
         $this->tax_ona =  str_replace(",", ".", $this->tax_ona);
         $this->tax_ona = (string)$this->tax_ona;
         $this->tax_iric = $rs->fields[16] ;  
         $this->tax_iric =  str_replace(",", ".", $this->tax_iric);
         $this->tax_iric = (string)$this->tax_iric;
         $this->dedeuct_cons = $rs->fields[17] ;  
         $this->dedeuct_cons =  str_replace(",", ".", $this->dedeuct_cons);
         $this->dedeuct_cons = (string)$this->dedeuct_cons;
         $this->loan_deduction = $rs->fields[18] ;  
         $this->loan_deduction =  str_replace(",", ".", $this->loan_deduction);
         $this->loan_deduction = (string)$this->loan_deduction;
         $this->loan_deduction_bank = $rs->fields[19] ;  
         $this->loan_deduction_bank =  str_replace(",", ".", $this->loan_deduction_bank);
         $this->loan_deduction_bank = (string)$this->loan_deduction_bank;
         $this->other_deduct = $rs->fields[20] ;  
         $this->other_deduct =  str_replace(",", ".", $this->other_deduct);
         $this->other_deduct = (string)$this->other_deduct;
         $this->total_deduct = $rs->fields[21] ;  
         $this->total_deduct =  str_replace(",", ".", $this->total_deduct);
         $this->total_deduct = (string)$this->total_deduct;
         $this->sal_net = $rs->fields[22] ;  
         $this->sal_net =  str_replace(",", ".", $this->sal_net);
         $this->sal_net = (string)$this->sal_net;
         $this->bank_number = $rs->fields[23] ;  
         $this->userid_int = $rs->fields[24] ;  
         $this->userid_int = (string)$this->userid_int;
         $this->hiredate = $rs->fields[25] ;  
         $this->dept = $rs->fields[26] ;  
         $this->rate_salf = $rs->fields[27] ;  
         $this->rate_salf =  str_replace(",", ".", $this->rate_salf);
         $this->rate_salf = (string)$this->rate_salf;
         $this->rate_work = $rs->fields[28] ;  
         $this->rate_work =  str_replace(",", ".", $this->rate_work);
         $this->rate_work = (string)$this->rate_work;
         $this->rate_ot_factor = $rs->fields[29] ;  
         $this->rate_ot_factor = (string)$this->rate_ot_factor;
         $this->rate_ot_holiday_factor = $rs->fields[30] ;  
         $this->rate_ot_holiday_factor = (string)$this->rate_ot_holiday_factor;
         $this->rate_ot_restday_factor = $rs->fields[31] ;  
         $this->rate_ot_restday_factor = (string)$this->rate_ot_restday_factor;
         $this->rate_ot_offday_factor = $rs->fields[32] ;  
         $this->rate_ot_offday_factor = (string)$this->rate_ot_offday_factor;
         $this->income_workday = $rs->fields[33] ;  
         $this->income_workday =  str_replace(",", ".", $this->income_workday);
         $this->income_workday = (string)$this->income_workday;
         $this->income_holiday = $rs->fields[34] ;  
         $this->income_holiday =  str_replace(",", ".", $this->income_holiday);
         $this->income_holiday = (string)$this->income_holiday;
         $this->income_restday = $rs->fields[35] ;  
         $this->income_restday =  str_replace(",", ".", $this->income_restday);
         $this->income_restday = (string)$this->income_restday;
         $this->income_offday = $rs->fields[36] ;  
         $this->income_offday =  str_replace(",", ".", $this->income_offday);
         $this->income_offday = (string)$this->income_offday;
         $this->hh_sunday = $rs->fields[37] ;  
         $this->hh_sunday = (string)$this->hh_sunday;
         $this->sal_sunday = $rs->fields[38] ;  
         $this->sal_sunday =  str_replace(",", ".", $this->sal_sunday);
         $this->sal_sunday = (string)$this->sal_sunday;
         $this->hh_offday = $rs->fields[39] ;  
         $this->hh_offday = (string)$this->hh_offday;
         $this->sal_holiday = $rs->fields[40] ;  
         $this->sal_holiday =  str_replace(",", ".", $this->sal_holiday);
         $this->sal_holiday = (string)$this->sal_holiday;
         $this->sal_leavetype = $rs->fields[41] ;  
         $this->sal_leavetype =  str_replace(",", ".", $this->sal_leavetype);
         $this->sal_leavetype = (string)$this->sal_leavetype;
         $this->ot_hh_w = $rs->fields[42] ;  
         $this->ot_hh_w = (string)$this->ot_hh_w;
         $this->ot_hh_w_pm = $rs->fields[43] ;  
         $this->ot_hh_w_pm = (string)$this->ot_hh_w_pm;
         $this->ot_hh_h = $rs->fields[44] ;  
         $this->ot_hh_h = (string)$this->ot_hh_h;
         $this->ot_hh_h_pm = $rs->fields[45] ;  
         $this->ot_hh_h_pm = (string)$this->ot_hh_h_pm;
         $this->ot_hh_r = $rs->fields[46] ;  
         $this->ot_hh_r = (string)$this->ot_hh_r;
         $this->ot_hh_r_pm = $rs->fields[47] ;  
         $this->ot_hh_r_pm = (string)$this->ot_hh_r_pm;
         $this->ot_hh_o = $rs->fields[48] ;  
         $this->ot_hh_o = (string)$this->ot_hh_o;
         $this->ot_hh_o_pm = $rs->fields[49] ;  
         $this->ot_hh_o_pm = (string)$this->ot_hh_o_pm;
         $this->incentive_desc = $rs->fields[50] ;  
         $this->rappel_desc = $rs->fields[51] ;  
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['embutida'])
         { 
             $this->xml_registro .= "</" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['embutida_tit'] . ">\r\n";
         }
         elseif ($this->New_Format)
         {
             $this->xml_registro .= "</grid_qry_payroll_details_hist01>\r\n";
         }
         else
         {
             $this->xml_registro .= " />\r\n";
         }
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['embutida'])
         { 
             fwrite($xml_f, $this->xml_registro);
             if ($this->Grava_view)
             {
                fwrite($xml_v, $this->xml_registro);
             }
         }
         $rs->MoveNext();
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['embutida'])
      { 
          if (!$this->New_Format)
          {
              $this->xml_registro = "";
          }
          $_SESSION['scriptcase']['export_return'] = $this->xml_registro;
      }
      else
      { 
          fwrite($xml_f, "</root>");
          fclose($xml_f);
          if ($this->Grava_view)
          {
             fwrite($xml_v, "</root>");
             fclose($xml_v);
          }
          if ($this->Tem_xml_res)
          { 
              if (!$this->Ini->sc_export_ajax) {
                  $this->PB_dif = intval ($this->PB_dif / 2);
                  $Mens_bar  = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
                  $Mens_smry = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_smry_titl']);
                  $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
                  $this->pb->addSteps($this->PB_dif);
              }
              require_once($this->Ini->path_aplicacao . "grid_qry_payroll_details_hist01_res_xml.class.php");
              $this->Res = new grid_qry_payroll_details_hist01_res_xml();
              $this->prep_modulos("Res");
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_res_grid'] = true;
              $this->Res->monta_xml();
          } 
          if (!$this->Ini->sc_export_ajax) {
              $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_btns_export_finished']);
              $this->pb->setProgressbarMessage($Mens_bar);
              $this->pb->addSteps($this->PB_dif);
          }
          if ($this->Xml_password != "" || $this->Tem_xml_res)
          { 
              $str_zip    = "";
              $Parm_pass  = ($this->Xml_password != "") ? " -p" : "";
              $Zip_f      = (FALSE !== strpos($this->Zip_f, ' ')) ? " \"" . $this->Zip_f . "\"" :  $this->Zip_f;
              $Arq_input  = (FALSE !== strpos($this->Xml_f, ' ')) ? " \"" . $this->Xml_f . "\"" :  $this->Xml_f;
              if (is_file($Zip_f)) {
                  unlink($Zip_f);
              }
              if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
              {
                  chdir($this->Ini->path_third . "/zip/windows");
                  $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
              {
                  if (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                  {
                      chdir($this->Ini->path_third . "/zip/linux-i386/bin");
                  }
                  else
                  {
                      chdir($this->Ini->path_third . "/zip/linux-amd64/bin");
                  }
                  $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
              {
                  chdir($this->Ini->path_third . "/zip/mac/bin");
                  $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
              }
              if (!empty($str_zip)) {
                  exec($str_zip);
              }
              // ----- ZIP log
              $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'w');
              if ($fp)
              {
                  @fwrite($fp, $str_zip . "\r\n\r\n");
                  @fclose($fp);
              }
              unlink($Arq_input);
              $this->Arquivo = $this->Arq_zip;
              $this->Xml_f   = $this->Zip_f;
              $this->Tit_doc = $this->Tit_zip;
              if ($this->Tem_xml_res)
              { 
                  $str_zip   = "";
                  $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_res_file']['xml'];
                  $Arq_input = (FALSE !== strpos($Arq_res, ' ')) ? " \"" . $Arq_res . "\"" :  $Arq_res;
                  if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                  {
                      $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  if (!empty($str_zip)) {
                      exec($str_zip);
                  }
                  // ----- ZIP log
                  $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'a');
                  if ($fp)
                  {
                      @fwrite($fp, $str_zip . "\r\n\r\n");
                      @fclose($fp);
                  }
                  unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_res_file']['xml']);
              }
              if ($this->Grava_view)
              {
                  $str_zip    = "";
                  $xml_view_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo_view;
                  $zip_view_f = str_replace(".zip", "_view.zip", $this->Zip_f);
                  $zip_arq_v  = str_replace(".zip", "_view.zip", $this->Arq_zip);
                  $Zip_f      = (FALSE !== strpos($zip_view_f, ' ')) ? " \"" . $zip_view_f . "\"" :  $zip_view_f;
                  $Arq_input  = (FALSE !== strpos($xml_view_ff, ' ')) ? " \"" . $xml_view_f . "\"" :  $xml_view_f;
                  if (is_file($Zip_f)) {
                      unlink($Zip_f);
                  }
                  if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                  {
                      chdir($this->Ini->path_third . "/zip/windows");
                      $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                  {
                      if (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                      {
                          chdir($this->Ini->path_third . "/zip/linux-i386/bin");
                      }
                      else
                      {
                          chdir($this->Ini->path_third . "/zip/linux-amd64/bin");
                      }
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                  {
                      chdir($this->Ini->path_third . "/zip/mac/bin");
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  if (!empty($str_zip)) {
                      exec($str_zip);
                  }
                  // ----- ZIP log
                  $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'a');
                  if ($fp)
                  {
                      @fwrite($fp, $str_zip . "\r\n\r\n");
                      @fclose($fp);
                  }
                  unlink($Arq_input);
                  $this->Arquivo_view = $zip_arq_v;
                  if ($this->Tem_xml_res)
                  { 
                      $str_zip   = "";
                      $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_res_file']['view'];
                      $Arq_input = (FALSE !== strpos($Arq_res, ' ')) ? " \"" . $Arq_res . "\"" :  $Arq_res;
                      if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                      {
                          $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
                      }
                      elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                      {
                          $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                      }
                      elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                      {
                          $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                      }
                      if (!empty($str_zip)) {
                          exec($str_zip);
                      }
                      // ----- ZIP log
                      $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'a');
                      if ($fp)
                      {
                          @fwrite($fp, $str_zip . "\r\n\r\n");
                          @fclose($fp);
                      }
                      unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_res_file']['view']);
                  }
              } 
              else 
              {
                  $this->Arquivo_view = $this->Arq_zip;
              } 
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_res_grid']);
          } 
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- username
   function NM_export_username()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->username))
         {
             $this->username = sc_convert_encoding($this->username, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['username'])) ? $this->New_label['username'] : "Employee Name"; 
         }
         else
         {
             $SC_Label = "username"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->username) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->username) . "\"";
         }
   }
   //----- pay_startdate
   function NM_export_pay_startdate()
   {
             $conteudo_x =  $this->pay_startdate;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->pay_startdate, "YYYY-MM-DD  ");
                 $this->pay_startdate = $this->nm_data->FormataSaida("d-M-Y");
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pay_startdate'])) ? $this->New_label['pay_startdate'] : "Start Date"; 
         }
         else
         {
             $SC_Label = "pay_startdate"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pay_startdate) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pay_startdate) . "\"";
         }
   }
   //----- pay_enddate
   function NM_export_pay_enddate()
   {
             $conteudo_x =  $this->pay_enddate;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->pay_enddate, "YYYY-MM-DD  ");
                 $this->pay_enddate = $this->nm_data->FormataSaida("d-M-Y");
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pay_enddate'])) ? $this->New_label['pay_enddate'] : "End Date"; 
         }
         else
         {
             $SC_Label = "pay_enddate"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pay_enddate) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pay_enddate) . "\"";
         }
   }
   //----- sal_brut_reg
   function NM_export_sal_brut_reg()
   {
             nmgp_Form_Num_Val($this->sal_brut_reg, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['sal_brut_reg'])) ? $this->New_label['sal_brut_reg'] : "Reg Gross Income"; 
         }
         else
         {
             $SC_Label = "sal_brut_reg"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->sal_brut_reg) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->sal_brut_reg) . "\"";
         }
   }
   //----- income_workday_ot
   function NM_export_income_workday_ot()
   {
             nmgp_Form_Num_Val($this->income_workday_ot, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['income_workday_ot'])) ? $this->New_label['income_workday_ot'] : "Income Workday OT"; 
         }
         else
         {
             $SC_Label = "income_workday_ot"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->income_workday_ot) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->income_workday_ot) . "\"";
         }
   }
   //----- income_holiday_ot
   function NM_export_income_holiday_ot()
   {
             nmgp_Form_Num_Val($this->income_holiday_ot, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['income_holiday_ot'])) ? $this->New_label['income_holiday_ot'] : "Income Holiday OT"; 
         }
         else
         {
             $SC_Label = "income_holiday_ot"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->income_holiday_ot) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->income_holiday_ot) . "\"";
         }
   }
   //----- income_restday_ot
   function NM_export_income_restday_ot()
   {
             nmgp_Form_Num_Val($this->income_restday_ot, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['income_restday_ot'])) ? $this->New_label['income_restday_ot'] : "Income Restday OT"; 
         }
         else
         {
             $SC_Label = "income_restday_ot"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->income_restday_ot) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->income_restday_ot) . "\"";
         }
   }
   //----- income_offday_ot
   function NM_export_income_offday_ot()
   {
             nmgp_Form_Num_Val($this->income_offday_ot, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['income_offday_ot'])) ? $this->New_label['income_offday_ot'] : "Income Offday OT"; 
         }
         else
         {
             $SC_Label = "income_offday_ot"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->income_offday_ot) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->income_offday_ot) . "\"";
         }
   }
   //----- incentive
   function NM_export_incentive()
   {
             nmgp_Form_Num_Val($this->incentive, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['incentive'])) ? $this->New_label['incentive'] : "Income Extra"; 
         }
         else
         {
             $SC_Label = "incentive"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->incentive) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->incentive) . "\"";
         }
   }
   //----- income_comm
   function NM_export_income_comm()
   {
             nmgp_Form_Num_Val($this->income_comm, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['income_comm'])) ? $this->New_label['income_comm'] : "Income Additional"; 
         }
         else
         {
             $SC_Label = "income_comm"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->income_comm) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->income_comm) . "\"";
         }
   }
   //----- rappel
   function NM_export_rappel()
   {
             nmgp_Form_Num_Val($this->rappel, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['rappel'])) ? $this->New_label['rappel'] : "Income Misc"; 
         }
         else
         {
             $SC_Label = "rappel"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->rappel) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->rappel) . "\"";
         }
   }
   //----- tax_cass
   function NM_export_tax_cass()
   {
             nmgp_Form_Num_Val($this->tax_cass, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['tax_cass'])) ? $this->New_label['tax_cass'] : "Tax CASS"; 
         }
         else
         {
             $SC_Label = "tax_cass"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->tax_cass) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->tax_cass) . "\"";
         }
   }
   //----- tax_cfgdct
   function NM_export_tax_cfgdct()
   {
             nmgp_Form_Num_Val($this->tax_cfgdct, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['tax_cfgdct'])) ? $this->New_label['tax_cfgdct'] : "Tax CFGDCT"; 
         }
         else
         {
             $SC_Label = "tax_cfgdct"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->tax_cfgdct) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->tax_cfgdct) . "\"";
         }
   }
   //----- tax_fdu
   function NM_export_tax_fdu()
   {
             nmgp_Form_Num_Val($this->tax_fdu, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['tax_fdu'])) ? $this->New_label['tax_fdu'] : "Tax FDU"; 
         }
         else
         {
             $SC_Label = "tax_fdu"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->tax_fdu) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->tax_fdu) . "\"";
         }
   }
   //----- tax_iris
   function NM_export_tax_iris()
   {
             nmgp_Form_Num_Val($this->tax_iris, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['tax_iris'])) ? $this->New_label['tax_iris'] : "Tax IRI"; 
         }
         else
         {
             $SC_Label = "tax_iris"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->tax_iris) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->tax_iris) . "\"";
         }
   }
   //----- tax_ona
   function NM_export_tax_ona()
   {
             nmgp_Form_Num_Val($this->tax_ona, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['tax_ona'])) ? $this->New_label['tax_ona'] : "Tax ONA"; 
         }
         else
         {
             $SC_Label = "tax_ona"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->tax_ona) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->tax_ona) . "\"";
         }
   }
   //----- tax_iric
   function NM_export_tax_iric()
   {
             nmgp_Form_Num_Val($this->tax_iric, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['tax_iric'])) ? $this->New_label['tax_iric'] : "TCA Add"; 
         }
         else
         {
             $SC_Label = "tax_iric"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->tax_iric) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->tax_iric) . "\"";
         }
   }
   //----- dedeuct_cons
   function NM_export_dedeuct_cons()
   {
             nmgp_Form_Num_Val($this->dedeuct_cons, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['dedeuct_cons'])) ? $this->New_label['dedeuct_cons'] : "Meal Deduction"; 
         }
         else
         {
             $SC_Label = "dedeuct_cons"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->dedeuct_cons) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->dedeuct_cons) . "\"";
         }
   }
   //----- loan_deduction
   function NM_export_loan_deduction()
   {
             nmgp_Form_Num_Val($this->loan_deduction, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['loan_deduction'])) ? $this->New_label['loan_deduction'] : "Loan Deduction"; 
         }
         else
         {
             $SC_Label = "loan_deduction"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->loan_deduction) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->loan_deduction) . "\"";
         }
   }
   //----- loan_deduction_bank
   function NM_export_loan_deduction_bank()
   {
             nmgp_Form_Num_Val($this->loan_deduction_bank, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['loan_deduction_bank'])) ? $this->New_label['loan_deduction_bank'] : "Loan Deduction ONA"; 
         }
         else
         {
             $SC_Label = "loan_deduction_bank"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->loan_deduction_bank) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->loan_deduction_bank) . "\"";
         }
   }
   //----- other_deduct
   function NM_export_other_deduct()
   {
             nmgp_Form_Num_Val($this->other_deduct, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['other_deduct'])) ? $this->New_label['other_deduct'] : "Other Deduction"; 
         }
         else
         {
             $SC_Label = "other_deduct"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->other_deduct) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->other_deduct) . "\"";
         }
   }
   //----- total_deduct
   function NM_export_total_deduct()
   {
             nmgp_Form_Num_Val($this->total_deduct, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['total_deduct'])) ? $this->New_label['total_deduct'] : "Total Deduction"; 
         }
         else
         {
             $SC_Label = "total_deduct"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->total_deduct) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->total_deduct) . "\"";
         }
   }
   //----- sal_net
   function NM_export_sal_net()
   {
             nmgp_Form_Num_Val($this->sal_net, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['sal_net'])) ? $this->New_label['sal_net'] : "Net Income"; 
         }
         else
         {
             $SC_Label = "sal_net"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->sal_net) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->sal_net) . "\"";
         }
   }
   //----- bank_number
   function NM_export_bank_number()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bank_number))
         {
             $this->bank_number = sc_convert_encoding($this->bank_number, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['bank_number'])) ? $this->New_label['bank_number'] : "Bank Number"; 
         }
         else
         {
             $SC_Label = "bank_number"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->bank_number) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->bank_number) . "\"";
         }
   }
   //----- userid_int
   function NM_export_userid_int()
   {
             nmgp_Form_Num_Val($this->userid_int, "", "", "0", "S", "2", "", "N:1", "-") ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['userid_int'])) ? $this->New_label['userid_int'] : "ID"; 
         }
         else
         {
             $SC_Label = "userid_int"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->userid_int) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->userid_int) . "\"";
         }
   }
   //----- hiredate
   function NM_export_hiredate()
   {
             $conteudo_x =  $this->hiredate;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->hiredate, "YYYY-MM-DD  ");
                 $this->hiredate = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hiredate'])) ? $this->New_label['hiredate'] : "Hiredate"; 
         }
         else
         {
             $SC_Label = "hiredate"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hiredate) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hiredate) . "\"";
         }
   }
   //----- dept
   function NM_export_dept()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->dept))
         {
             $this->dept = sc_convert_encoding($this->dept, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['dept'])) ? $this->New_label['dept'] : "Department"; 
         }
         else
         {
             $SC_Label = "dept"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->dept) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->dept) . "\"";
         }
   }
   //----- rate_salf
   function NM_export_rate_salf()
   {
             nmgp_Form_Num_Val($this->rate_salf, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['rate_salf'])) ? $this->New_label['rate_salf'] : "Fixed Salary"; 
         }
         else
         {
             $SC_Label = "rate_salf"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->rate_salf) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->rate_salf) . "\"";
         }
   }
   //----- rate_work
   function NM_export_rate_work()
   {
             nmgp_Form_Num_Val($this->rate_work, ",", ".", "2", "S", "2", "HTG", "V:1:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['rate_work'])) ? $this->New_label['rate_work'] : "Rate Work"; 
         }
         else
         {
             $SC_Label = "rate_work"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->rate_work) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->rate_work) . "\"";
         }
   }
   //----- rate_ot_factor
   function NM_export_rate_ot_factor()
   {
             nmgp_Form_Num_Val($this->rate_ot_factor, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['rate_ot_factor'])) ? $this->New_label['rate_ot_factor'] : "Rate Ot Factor"; 
         }
         else
         {
             $SC_Label = "rate_ot_factor"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->rate_ot_factor) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->rate_ot_factor) . "\"";
         }
   }
   //----- rate_ot_holiday_factor
   function NM_export_rate_ot_holiday_factor()
   {
             nmgp_Form_Num_Val($this->rate_ot_holiday_factor, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['rate_ot_holiday_factor'])) ? $this->New_label['rate_ot_holiday_factor'] : "Rate OT Holiday Factor"; 
         }
         else
         {
             $SC_Label = "rate_ot_holiday_factor"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->rate_ot_holiday_factor) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->rate_ot_holiday_factor) . "\"";
         }
   }
   //----- rate_ot_restday_factor
   function NM_export_rate_ot_restday_factor()
   {
             nmgp_Form_Num_Val($this->rate_ot_restday_factor, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['rate_ot_restday_factor'])) ? $this->New_label['rate_ot_restday_factor'] : "Rate OT Restday Factor"; 
         }
         else
         {
             $SC_Label = "rate_ot_restday_factor"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->rate_ot_restday_factor) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->rate_ot_restday_factor) . "\"";
         }
   }
   //----- rate_ot_offday_factor
   function NM_export_rate_ot_offday_factor()
   {
             nmgp_Form_Num_Val($this->rate_ot_offday_factor, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['rate_ot_offday_factor'])) ? $this->New_label['rate_ot_offday_factor'] : "Rate OT Offday Factor"; 
         }
         else
         {
             $SC_Label = "rate_ot_offday_factor"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->rate_ot_offday_factor) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->rate_ot_offday_factor) . "\"";
         }
   }
   //----- income_workday
   function NM_export_income_workday()
   {
             nmgp_Form_Num_Val($this->income_workday, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['income_workday'])) ? $this->New_label['income_workday'] : "Income Workday"; 
         }
         else
         {
             $SC_Label = "income_workday"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->income_workday) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->income_workday) . "\"";
         }
   }
   //----- income_holiday
   function NM_export_income_holiday()
   {
             nmgp_Form_Num_Val($this->income_holiday, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['income_holiday'])) ? $this->New_label['income_holiday'] : "Income Holiday"; 
         }
         else
         {
             $SC_Label = "income_holiday"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->income_holiday) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->income_holiday) . "\"";
         }
   }
   //----- income_restday
   function NM_export_income_restday()
   {
             nmgp_Form_Num_Val($this->income_restday, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['income_restday'])) ? $this->New_label['income_restday'] : "Income Restday"; 
         }
         else
         {
             $SC_Label = "income_restday"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->income_restday) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->income_restday) . "\"";
         }
   }
   //----- income_offday
   function NM_export_income_offday()
   {
             nmgp_Form_Num_Val($this->income_offday, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['income_offday'])) ? $this->New_label['income_offday'] : "Income Offday"; 
         }
         else
         {
             $SC_Label = "income_offday"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->income_offday) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->income_offday) . "\"";
         }
   }
   //----- hh_sunday
   function NM_export_hh_sunday()
   {
             nmgp_Form_Num_Val($this->hh_sunday, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hh_sunday'])) ? $this->New_label['hh_sunday'] : "HH Sunday"; 
         }
         else
         {
             $SC_Label = "hh_sunday"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hh_sunday) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hh_sunday) . "\"";
         }
   }
   //----- sal_sunday
   function NM_export_sal_sunday()
   {
             nmgp_Form_Num_Val($this->sal_sunday, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['sal_sunday'])) ? $this->New_label['sal_sunday'] : "Sunday Benefits"; 
         }
         else
         {
             $SC_Label = "sal_sunday"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->sal_sunday) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->sal_sunday) . "\"";
         }
   }
   //----- hh_offday
   function NM_export_hh_offday()
   {
             nmgp_Form_Num_Val($this->hh_offday, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hh_offday'])) ? $this->New_label['hh_offday'] : "HH Holiday"; 
         }
         else
         {
             $SC_Label = "hh_offday"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hh_offday) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hh_offday) . "\"";
         }
   }
   //----- sal_holiday
   function NM_export_sal_holiday()
   {
             nmgp_Form_Num_Val($this->sal_holiday, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['sal_holiday'])) ? $this->New_label['sal_holiday'] : "Holiday Benefits"; 
         }
         else
         {
             $SC_Label = "sal_holiday"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->sal_holiday) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->sal_holiday) . "\"";
         }
   }
   //----- sal_leavetype
   function NM_export_sal_leavetype()
   {
             nmgp_Form_Num_Val($this->sal_leavetype, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['sal_leavetype'])) ? $this->New_label['sal_leavetype'] : "Leavetype Benefits"; 
         }
         else
         {
             $SC_Label = "sal_leavetype"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->sal_leavetype) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->sal_leavetype) . "\"";
         }
   }
   //----- ot_hh_w
   function NM_export_ot_hh_w()
   {
             nmgp_Form_Num_Val($this->ot_hh_w, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['ot_hh_w'])) ? $this->New_label['ot_hh_w'] : "OT AM"; 
         }
         else
         {
             $SC_Label = "ot_hh_w"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ot_hh_w) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ot_hh_w) . "\"";
         }
   }
   //----- ot_hh_w_pm
   function NM_export_ot_hh_w_pm()
   {
             nmgp_Form_Num_Val($this->ot_hh_w_pm, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['ot_hh_w_pm'])) ? $this->New_label['ot_hh_w_pm'] : "OT PM"; 
         }
         else
         {
             $SC_Label = "ot_hh_w_pm"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ot_hh_w_pm) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ot_hh_w_pm) . "\"";
         }
   }
   //----- ot_hh_h
   function NM_export_ot_hh_h()
   {
             nmgp_Form_Num_Val($this->ot_hh_h, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['ot_hh_h'])) ? $this->New_label['ot_hh_h'] : "Holiday OT AM"; 
         }
         else
         {
             $SC_Label = "ot_hh_h"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ot_hh_h) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ot_hh_h) . "\"";
         }
   }
   //----- ot_hh_h_pm
   function NM_export_ot_hh_h_pm()
   {
             nmgp_Form_Num_Val($this->ot_hh_h_pm, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['ot_hh_h_pm'])) ? $this->New_label['ot_hh_h_pm'] : "Holiday OT PM"; 
         }
         else
         {
             $SC_Label = "ot_hh_h_pm"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ot_hh_h_pm) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ot_hh_h_pm) . "\"";
         }
   }
   //----- ot_hh_r
   function NM_export_ot_hh_r()
   {
             nmgp_Form_Num_Val($this->ot_hh_r, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['ot_hh_r'])) ? $this->New_label['ot_hh_r'] : "Restday AM OT"; 
         }
         else
         {
             $SC_Label = "ot_hh_r"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ot_hh_r) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ot_hh_r) . "\"";
         }
   }
   //----- ot_hh_r_pm
   function NM_export_ot_hh_r_pm()
   {
             nmgp_Form_Num_Val($this->ot_hh_r_pm, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['ot_hh_r_pm'])) ? $this->New_label['ot_hh_r_pm'] : "Restday PM OT"; 
         }
         else
         {
             $SC_Label = "ot_hh_r_pm"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ot_hh_r_pm) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ot_hh_r_pm) . "\"";
         }
   }
   //----- ot_hh_o
   function NM_export_ot_hh_o()
   {
             nmgp_Form_Num_Val($this->ot_hh_o, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['ot_hh_o'])) ? $this->New_label['ot_hh_o'] : "Offday AM OT"; 
         }
         else
         {
             $SC_Label = "ot_hh_o"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ot_hh_o) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ot_hh_o) . "\"";
         }
   }
   //----- ot_hh_o_pm
   function NM_export_ot_hh_o_pm()
   {
             nmgp_Form_Num_Val($this->ot_hh_o_pm, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['ot_hh_o_pm'])) ? $this->New_label['ot_hh_o_pm'] : "Offday PM OT"; 
         }
         else
         {
             $SC_Label = "ot_hh_o_pm"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ot_hh_o_pm) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ot_hh_o_pm) . "\"";
         }
   }
   //----- incentive_desc
   function NM_export_incentive_desc()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->incentive_desc))
         {
             $this->incentive_desc = sc_convert_encoding($this->incentive_desc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['incentive_desc'])) ? $this->New_label['incentive_desc'] : "Incentive Description"; 
         }
         else
         {
             $SC_Label = "incentive_desc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->incentive_desc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->incentive_desc) . "\"";
         }
   }
   //----- rappel_desc
   function NM_export_rappel_desc()
   {
             if ($this->rappel_desc !== "&nbsp;") 
             { 
                 $this->rappel_desc = sc_strtoupper($this->rappel_desc); 
             } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->rappel_desc))
         {
             $this->rappel_desc = sc_convert_encoding($this->rappel_desc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['rappel_desc'])) ? $this->New_label['rappel_desc'] : "Rappel Description"; 
         }
         else
         {
             $SC_Label = "rappel_desc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->rappel_desc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->rappel_desc) . "\"";
         }
   }

   //----- 
   function trata_dados($conteudo)
   {
      $str_temp =  $conteudo;
      $str_temp =  str_replace("<br />", "",  $str_temp);
      $str_temp =  str_replace("&", "&amp;",  $str_temp);
      $str_temp =  str_replace("<", "&lt;",   $str_temp);
      $str_temp =  str_replace(">", "&gt;",   $str_temp);
      $str_temp =  str_replace("'", "&apos;", $str_temp);
      $str_temp =  str_replace('"', "&quot;",  $str_temp);
      $str_temp =  str_replace('(', "_",  $str_temp);
      $str_temp =  str_replace(')', "",  $str_temp);
      return ($str_temp);
   }

   function clear_tag(&$conteudo)
   {
      $out = (is_numeric(substr($conteudo, 0, 1)) || substr($conteudo, 0, 1) == "") ? "_" : "";
      $str_temp = "abcdefghijklmnopqrstuvwxyz0123456789";
      for ($i = 0; $i < strlen($conteudo); $i++)
      {
          $char = substr($conteudo, $i, 1);
          $ok = false;
          for ($z = 0; $z < strlen($str_temp); $z++)
          {
              if (strtolower($char) == substr($str_temp, $z, 1))
              {
                  $ok = true;
                  break;
              }
          }
          $out .= ($ok) ? $char : "_";
      }
      $conteudo = $out;
   }

   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT") {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT") {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "SC_FORMAT_REGION") {
           $this->nm_data->SetaData($dt_in, strtoupper($form_in));
           $prep_out  = (strpos(strtolower($form_in), "dd") !== false) ? "dd" : "";
           $prep_out .= (strpos(strtolower($form_in), "mm") !== false) ? "mm" : "";
           $prep_out .= (strpos(strtolower($form_in), "aa") !== false) ? "aaaa" : "";
           $prep_out .= (strpos(strtolower($form_in), "yy") !== false) ? "aaaa" : "";
           return $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", $prep_out));
       }
       else {
           nm_conv_form_data($dt_out, $form_in, $form_out);
           return $dt_out;
       }
   }
   function progress_bar_end()
   {
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01'][$path_doc_md5][1] = $this->Tit_doc;
      $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
      if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
          $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
      }
      $this->pb->setProgressbarMessage($Mens_bar);
      $this->pb->setDownloadLink($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $this->pb->setDownloadMd5($path_doc_md5);
      $this->pb->completed();
   }
   //---- 
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>PAYROLL DETAILLED HISTORIZED :: XML</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
 <link rel="shortcut icon" href="../_lib/img/sys__NM__ico__NM__favicon (2).ico">
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <?php
 if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts))
 {
 ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->str_google_fonts ?>" />
 <?php
 }
 ?>
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY class="scExportPage">
<?php echo $this->Ini->Ajax_result_set ?>
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: middle">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">XML</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo_view ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="grid_qry_payroll_details_hist01_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_qry_payroll_details_hist01"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_hist01']['xml_return']); ?>"> 
</FORM> 
</BODY>
</HTML>
<?php
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $str_highlight_ini = "";
      $str_highlight_fim = "";
      if(substr($nm_campo, 0, 23) == '<div class="highlight">' && substr($nm_campo, -6) == '</div>')
      {
           $str_highlight_ini = substr($nm_campo, 0, 23);
           $str_highlight_fim = substr($nm_campo, -6);

           $trab_campo = substr($nm_campo, 23, -6);
           $tam_campo  = strlen($trab_campo);
      }      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($tam_campo >= $cont2)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
   } 
function calculate_netincome()
{
$_SESSION['scriptcase']['grid_qry_payroll_details_hist01']['contr_erro'] = 'on';
  
$SQL05 = "
UPDATE tbl_salary 
SET tbl_salary.sal_net = `tbl_salary`.`sal_brut_reg`+`tbl_salary`.`income_workday_ot`+`tbl_salary`.`income_holiday_ot`+`tbl_salary`.`income_restday_ot`+`tbl_salary`.`income_offday_ot`+`tbl_salary`.`incentive`+`tbl_salary`.`rappel`-`tbl_salary`.`total_deduct`
";

     $nm_select = $SQL05; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['grid_qry_payroll_details_hist01']['contr_erro'] = 'off';
}
}

?>
