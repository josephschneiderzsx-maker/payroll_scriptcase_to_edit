<?php

class pdf_payslip_search_hist_json
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

   function __construct()
   {
      $this->nm_data = new nm_data("en_us");
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

   function monta_json()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['embutida'])
      {
          if ($this->Ini->sc_export_ajax)
          {
              $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Json_f);
              $this->Arr_result['title_export'] = NM_charset_to_utf8($this->Tit_doc);
              $Temp = ob_get_clean();
              if ($Temp !== false && trim($Temp) != "")
              {
                  $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
              }
              $result_json = json_encode($this->Arr_result, JSON_UNESCAPED_UNICODE);
              if ($result_json == false)
              {
                  $oJson = new Services_JSON();
                  $result_json = $oJson->encode($this->Arr_result);
              }
              echo $result_json;
              exit;
          }
          else
          {
              $this->progress_bar_end();
          }
      }
      else
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] = "";
      }
   }

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
                   nm_limpa_str_pdf_payslip_search_hist($cadapar[1]);
                   nm_protect_num_pdf_payslip_search_hist($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['pdf_payslip_search_hist']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Json_use_label = true;
      $this->Json_format = false;
      $this->Tem_json_res = false;
      $this->Json_password = "";
      if (isset($_REQUEST['nm_json_label']) && !empty($_REQUEST['nm_json_label']))
      {
          $this->Json_use_label = ($_REQUEST['nm_json_label'] == "S") ? true : false;
      }
      if (isset($_REQUEST['nm_json_format']) && !empty($_REQUEST['nm_json_format']))
      {
          $this->Json_format = ($_REQUEST['nm_json_format'] == "S") ? true : false;
      }
      $this->Tem_json_res  = true;
      if (isset($_REQUEST['SC_module_export']) && $_REQUEST['SC_module_export'] != "")
      { 
          $this->Tem_json_res = (strpos(" " . $_REQUEST['SC_module_export'], "resume") !== false) ? true : false;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['SC_Gb_Free_cmp']))
      {
          $this->Tem_json_res  = false;
      }
      if (!is_file($this->Ini->root . $this->Ini->path_link . "pdf_payslip_search_hist/pdf_payslip_search_hist_res_json.class.php"))
      {
          $this->Tem_json_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_label']))
      {
          $this->Json_use_label = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_label'];
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_format']))
      {
          $this->Json_format = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_format'];
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "pdf_payslip_search_hist_total.class.php"); 
      $this->Tot = new pdf_payslip_search_hist_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['pdf_payslip_search_hist']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_return']);
          if ($this->Tem_json_res) {
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
      $this->nm_data = new nm_data("en_us");
      $this->Arquivo      = "sc_json";
      $this->Arquivo     .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arq_zip      = $this->Arquivo . "_pdf_payslip_search_hist.zip";
      $this->Arquivo     .= "_pdf_payslip_search_hist";
      $this->Arquivo     .= ".json";
      $this->Tit_doc      = "pdf_payslip_search_hist.json";
      $this->Tit_zip      = "pdf_payslip_search_hist.zip";
   }

   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }

   function grava_arquivo()
   {
      global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['campos_busca'];
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
          $this->designation = (isset($Busca_temp['designation'])) ? $Busca_temp['designation'] : ""; 
          $tmp_pos = (is_string($this->designation)) ? strpos($this->designation, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->designation))
          {
              $this->designation = substr($this->designation, 0, $tmp_pos);
          }
          $this->sal_net = (isset($Busca_temp['sal_net'])) ? $Busca_temp['sal_net'] : ""; 
          $tmp_pos = (is_string($this->sal_net)) ? strpos($this->sal_net, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->sal_net))
          {
              $this->sal_net = substr($this->sal_net, 0, $tmp_pos);
          }
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_name'] .= ".json";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['embutida'])
      { 
          $this->Json_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
          $json_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      }
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT userid_int, hiredate, username, dept, designation, Rate_Work, Rate_SALF, income_workday, income_holiday, income_restday, income_offday, sal_sunday, sal_holiday, sal_leavetype, sal_brut_reg, income_workday_ot, income_holiday_ot, income_restday_ot, income_offday_ot, incentive, income_comm, rappel, tax_cass, tax_cfgdct, tax_fdu, tax_ona, tax_iric, dedeuct_cons, loan_deduction, loan_deduction_bank, other_deduct, total_deduct, sal_net, work_hh_w, ot_hh_w, hh_sunday, work_hh_r, ot_hh_r, hh_offday, work_hh_h, ot_hh_h, sal_hr_worked, sal_sunday as sal_sunday_1, sal_holiday as sal_holiday_1, sal_brut_reg as sal_brut_reg_1, sal_suppl, sal_holiday_worked_suppl, sal_holiday_suppl, sal_restday_worked_suppl, sal_restday_suppl, tax_iris, day_cons, rate_cons, other_loan_deduction, other_deduct as other_deduct_1, other_deduct_desc, bank_number, pay_startdate, pay_enddate, work_hh_w_PM, ot_hh_w_PM, work_hh_h_PM, ot_hh_h_PM, work_hh_r_PM, ot_hh_r_PM, work_hh_o, work_hh_o_PM, ot_hh_o, ot_hh_o_PM, hh_leavetype from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT userid_int, hiredate, username, dept, designation, Rate_Work, Rate_SALF, income_workday, income_holiday, income_restday, income_offday, sal_sunday, sal_holiday, sal_leavetype, sal_brut_reg, income_workday_ot, income_holiday_ot, income_restday_ot, income_offday_ot, incentive, income_comm, rappel, tax_cass, tax_cfgdct, tax_fdu, tax_ona, tax_iric, dedeuct_cons, loan_deduction, loan_deduction_bank, other_deduct, total_deduct, sal_net, work_hh_w, ot_hh_w, hh_sunday, work_hh_r, ot_hh_r, hh_offday, work_hh_h, ot_hh_h, sal_hr_worked, sal_sunday as sal_sunday_1, sal_holiday as sal_holiday_1, sal_brut_reg as sal_brut_reg_1, sal_suppl, sal_holiday_worked_suppl, sal_holiday_suppl, sal_restday_worked_suppl, sal_restday_suppl, tax_iris, day_cons, rate_cons, other_loan_deduction, other_deduct as other_deduct_1, other_deduct_desc, bank_number, pay_startdate, pay_enddate, work_hh_w_PM, ot_hh_w_PM, work_hh_h_PM, ot_hh_h_PM, work_hh_r_PM, ot_hh_r_PM, work_hh_o, work_hh_o_PM, ot_hh_o, ot_hh_o_PM, hh_leavetype from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['order_grid'];
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
      $this->json_registro = array();
      $this->SC_seq_json   = 0;
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         $this->userid_int = $rs->fields[0] ;  
         $this->userid_int = (string)$this->userid_int;
         $this->hiredate = $rs->fields[1] ;  
         $this->username = $rs->fields[2] ;  
         $this->dept = $rs->fields[3] ;  
         $this->designation = $rs->fields[4] ;  
         $this->rate_work = $rs->fields[5] ;  
         $this->rate_work =  str_replace(",", ".", $this->rate_work);
         $this->rate_work = (string)$this->rate_work;
         $this->rate_salf = $rs->fields[6] ;  
         $this->rate_salf =  str_replace(",", ".", $this->rate_salf);
         $this->rate_salf = (string)$this->rate_salf;
         $this->income_workday = $rs->fields[7] ;  
         $this->income_workday =  str_replace(",", ".", $this->income_workday);
         $this->income_workday = (string)$this->income_workday;
         $this->income_holiday = $rs->fields[8] ;  
         $this->income_holiday =  str_replace(",", ".", $this->income_holiday);
         $this->income_holiday = (string)$this->income_holiday;
         $this->income_restday = $rs->fields[9] ;  
         $this->income_restday =  str_replace(",", ".", $this->income_restday);
         $this->income_restday = (string)$this->income_restday;
         $this->income_offday = $rs->fields[10] ;  
         $this->income_offday =  str_replace(",", ".", $this->income_offday);
         $this->income_offday = (string)$this->income_offday;
         $this->sal_sunday = $rs->fields[11] ;  
         $this->sal_sunday =  str_replace(",", ".", $this->sal_sunday);
         $this->sal_sunday = (string)$this->sal_sunday;
         $this->sal_holiday = $rs->fields[12] ;  
         $this->sal_holiday =  str_replace(",", ".", $this->sal_holiday);
         $this->sal_holiday = (string)$this->sal_holiday;
         $this->sal_leavetype = $rs->fields[13] ;  
         $this->sal_leavetype =  str_replace(",", ".", $this->sal_leavetype);
         $this->sal_leavetype = (string)$this->sal_leavetype;
         $this->sal_brut_reg = $rs->fields[14] ;  
         $this->sal_brut_reg =  str_replace(",", ".", $this->sal_brut_reg);
         $this->sal_brut_reg = (string)$this->sal_brut_reg;
         $this->income_workday_ot = $rs->fields[15] ;  
         $this->income_workday_ot =  str_replace(",", ".", $this->income_workday_ot);
         $this->income_workday_ot = (string)$this->income_workday_ot;
         $this->income_holiday_ot = $rs->fields[16] ;  
         $this->income_holiday_ot =  str_replace(",", ".", $this->income_holiday_ot);
         $this->income_holiday_ot = (string)$this->income_holiday_ot;
         $this->income_restday_ot = $rs->fields[17] ;  
         $this->income_restday_ot =  str_replace(",", ".", $this->income_restday_ot);
         $this->income_restday_ot = (string)$this->income_restday_ot;
         $this->income_offday_ot = $rs->fields[18] ;  
         $this->income_offday_ot =  str_replace(",", ".", $this->income_offday_ot);
         $this->income_offday_ot = (string)$this->income_offday_ot;
         $this->incentive = $rs->fields[19] ;  
         $this->incentive =  str_replace(",", ".", $this->incentive);
         $this->incentive = (string)$this->incentive;
         $this->income_comm = $rs->fields[20] ;  
         $this->income_comm =  str_replace(",", ".", $this->income_comm);
         $this->income_comm = (string)$this->income_comm;
         $this->rappel = $rs->fields[21] ;  
         $this->rappel =  str_replace(",", ".", $this->rappel);
         $this->rappel = (string)$this->rappel;
         $this->tax_cass = $rs->fields[22] ;  
         $this->tax_cass =  str_replace(",", ".", $this->tax_cass);
         $this->tax_cass = (string)$this->tax_cass;
         $this->tax_cfgdct = $rs->fields[23] ;  
         $this->tax_cfgdct =  str_replace(",", ".", $this->tax_cfgdct);
         $this->tax_cfgdct = (string)$this->tax_cfgdct;
         $this->tax_fdu = $rs->fields[24] ;  
         $this->tax_fdu =  str_replace(",", ".", $this->tax_fdu);
         $this->tax_fdu = (string)$this->tax_fdu;
         $this->tax_ona = $rs->fields[25] ;  
         $this->tax_ona =  str_replace(",", ".", $this->tax_ona);
         $this->tax_ona = (string)$this->tax_ona;
         $this->tax_iric = $rs->fields[26] ;  
         $this->tax_iric =  str_replace(",", ".", $this->tax_iric);
         $this->tax_iric = (string)$this->tax_iric;
         $this->dedeuct_cons = $rs->fields[27] ;  
         $this->dedeuct_cons =  str_replace(",", ".", $this->dedeuct_cons);
         $this->dedeuct_cons = (string)$this->dedeuct_cons;
         $this->loan_deduction = $rs->fields[28] ;  
         $this->loan_deduction =  str_replace(",", ".", $this->loan_deduction);
         $this->loan_deduction = (string)$this->loan_deduction;
         $this->loan_deduction_bank = $rs->fields[29] ;  
         $this->loan_deduction_bank =  str_replace(",", ".", $this->loan_deduction_bank);
         $this->loan_deduction_bank = (string)$this->loan_deduction_bank;
         $this->other_deduct = $rs->fields[30] ;  
         $this->other_deduct =  str_replace(",", ".", $this->other_deduct);
         $this->other_deduct = (string)$this->other_deduct;
         $this->total_deduct = $rs->fields[31] ;  
         $this->total_deduct =  str_replace(",", ".", $this->total_deduct);
         $this->total_deduct = (string)$this->total_deduct;
         $this->sal_net = $rs->fields[32] ;  
         $this->sal_net =  str_replace(",", ".", $this->sal_net);
         $this->sal_net = (string)$this->sal_net;
         $this->work_hh_w = $rs->fields[33] ;  
         $this->work_hh_w =  str_replace(",", ".", $this->work_hh_w);
         $this->work_hh_w = (string)$this->work_hh_w;
         $this->ot_hh_w = $rs->fields[34] ;  
         $this->ot_hh_w =  str_replace(",", ".", $this->ot_hh_w);
         $this->ot_hh_w = (string)$this->ot_hh_w;
         $this->hh_sunday = $rs->fields[35] ;  
         $this->hh_sunday =  str_replace(",", ".", $this->hh_sunday);
         $this->hh_sunday = (string)$this->hh_sunday;
         $this->work_hh_r = $rs->fields[36] ;  
         $this->work_hh_r =  str_replace(",", ".", $this->work_hh_r);
         $this->work_hh_r = (string)$this->work_hh_r;
         $this->ot_hh_r = $rs->fields[37] ;  
         $this->ot_hh_r =  str_replace(",", ".", $this->ot_hh_r);
         $this->ot_hh_r = (string)$this->ot_hh_r;
         $this->hh_offday = $rs->fields[38] ;  
         $this->hh_offday =  str_replace(",", ".", $this->hh_offday);
         $this->hh_offday = (string)$this->hh_offday;
         $this->work_hh_h = $rs->fields[39] ;  
         $this->work_hh_h =  str_replace(",", ".", $this->work_hh_h);
         $this->work_hh_h = (string)$this->work_hh_h;
         $this->ot_hh_h = $rs->fields[40] ;  
         $this->ot_hh_h =  str_replace(",", ".", $this->ot_hh_h);
         $this->ot_hh_h = (string)$this->ot_hh_h;
         $this->sal_hr_worked = $rs->fields[41] ;  
         $this->sal_hr_worked =  str_replace(",", ".", $this->sal_hr_worked);
         $this->sal_hr_worked = (string)$this->sal_hr_worked;
         $this->sal_sunday_1 = $rs->fields[42] ;  
         $this->sal_sunday_1 =  str_replace(",", ".", $this->sal_sunday_1);
         $this->sal_sunday_1 = (string)$this->sal_sunday_1;
         $this->sal_holiday_1 = $rs->fields[43] ;  
         $this->sal_holiday_1 =  str_replace(",", ".", $this->sal_holiday_1);
         $this->sal_holiday_1 = (string)$this->sal_holiday_1;
         $this->sal_brut_reg_1 = $rs->fields[44] ;  
         $this->sal_brut_reg_1 =  str_replace(",", ".", $this->sal_brut_reg_1);
         $this->sal_brut_reg_1 = (string)$this->sal_brut_reg_1;
         $this->sal_suppl = $rs->fields[45] ;  
         $this->sal_suppl =  str_replace(",", ".", $this->sal_suppl);
         $this->sal_suppl = (string)$this->sal_suppl;
         $this->sal_holiday_worked_suppl = $rs->fields[46] ;  
         $this->sal_holiday_worked_suppl =  str_replace(",", ".", $this->sal_holiday_worked_suppl);
         $this->sal_holiday_worked_suppl = (string)$this->sal_holiday_worked_suppl;
         $this->sal_holiday_suppl = $rs->fields[47] ;  
         $this->sal_holiday_suppl =  str_replace(",", ".", $this->sal_holiday_suppl);
         $this->sal_holiday_suppl = (string)$this->sal_holiday_suppl;
         $this->sal_restday_worked_suppl = $rs->fields[48] ;  
         $this->sal_restday_worked_suppl =  str_replace(",", ".", $this->sal_restday_worked_suppl);
         $this->sal_restday_worked_suppl = (string)$this->sal_restday_worked_suppl;
         $this->sal_restday_suppl = $rs->fields[49] ;  
         $this->sal_restday_suppl =  str_replace(",", ".", $this->sal_restday_suppl);
         $this->sal_restday_suppl = (string)$this->sal_restday_suppl;
         $this->tax_iris = $rs->fields[50] ;  
         $this->tax_iris =  str_replace(",", ".", $this->tax_iris);
         $this->tax_iris = (string)$this->tax_iris;
         $this->day_cons = $rs->fields[51] ;  
         $this->day_cons =  str_replace(",", ".", $this->day_cons);
         $this->day_cons = (string)$this->day_cons;
         $this->rate_cons = $rs->fields[52] ;  
         $this->rate_cons =  str_replace(",", ".", $this->rate_cons);
         $this->rate_cons = (string)$this->rate_cons;
         $this->other_loan_deduction = $rs->fields[53] ;  
         $this->other_loan_deduction =  str_replace(",", ".", $this->other_loan_deduction);
         $this->other_loan_deduction = (string)$this->other_loan_deduction;
         $this->other_deduct_1 = $rs->fields[54] ;  
         $this->other_deduct_1 =  str_replace(",", ".", $this->other_deduct_1);
         $this->other_deduct_1 = (string)$this->other_deduct_1;
         $this->other_deduct_desc = $rs->fields[55] ;  
         $this->bank_number = $rs->fields[56] ;  
         $this->pay_startdate = $rs->fields[57] ;  
         $this->pay_enddate = $rs->fields[58] ;  
         $this->work_hh_w_pm = $rs->fields[59] ;  
         $this->work_hh_w_pm =  str_replace(",", ".", $this->work_hh_w_pm);
         $this->work_hh_w_pm = (string)$this->work_hh_w_pm;
         $this->ot_hh_w_pm = $rs->fields[60] ;  
         $this->ot_hh_w_pm =  str_replace(",", ".", $this->ot_hh_w_pm);
         $this->ot_hh_w_pm = (string)$this->ot_hh_w_pm;
         $this->work_hh_h_pm = $rs->fields[61] ;  
         $this->work_hh_h_pm =  str_replace(",", ".", $this->work_hh_h_pm);
         $this->work_hh_h_pm = (string)$this->work_hh_h_pm;
         $this->ot_hh_h_pm = $rs->fields[62] ;  
         $this->ot_hh_h_pm =  str_replace(",", ".", $this->ot_hh_h_pm);
         $this->ot_hh_h_pm = (string)$this->ot_hh_h_pm;
         $this->work_hh_r_pm = $rs->fields[63] ;  
         $this->work_hh_r_pm =  str_replace(",", ".", $this->work_hh_r_pm);
         $this->work_hh_r_pm = (string)$this->work_hh_r_pm;
         $this->ot_hh_r_pm = $rs->fields[64] ;  
         $this->ot_hh_r_pm =  str_replace(",", ".", $this->ot_hh_r_pm);
         $this->ot_hh_r_pm = (string)$this->ot_hh_r_pm;
         $this->work_hh_o = $rs->fields[65] ;  
         $this->work_hh_o =  str_replace(",", ".", $this->work_hh_o);
         $this->work_hh_o = (string)$this->work_hh_o;
         $this->work_hh_o_pm = $rs->fields[66] ;  
         $this->work_hh_o_pm =  str_replace(",", ".", $this->work_hh_o_pm);
         $this->work_hh_o_pm = (string)$this->work_hh_o_pm;
         $this->ot_hh_o = $rs->fields[67] ;  
         $this->ot_hh_o =  str_replace(",", ".", $this->ot_hh_o);
         $this->ot_hh_o = (string)$this->ot_hh_o;
         $this->ot_hh_o_pm = $rs->fields[68] ;  
         $this->ot_hh_o_pm =  str_replace(",", ".", $this->ot_hh_o_pm);
         $this->ot_hh_o_pm = (string)$this->ot_hh_o_pm;
         $this->hh_leavetype = $rs->fields[69] ;  
         $this->hh_leavetype =  str_replace(",", ".", $this->hh_leavetype);
         $this->hh_leavetype = (string)$this->hh_leavetype;
         $this->sc_proc_grid = true; 
         //----- lookup - lbl_companyname
         $this->Lookup->lookup_lbl_companyname($this->lbl_companyname, $this->array_lbl_companyname); 
         $this->lbl_companyname = str_replace("<br>", " ", $this->lbl_companyname); 
         $this->lbl_companyname = ($this->lbl_companyname == "&nbsp;") ? "" : $this->lbl_companyname; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->SC_seq_json++;
         $rs->MoveNext();
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['embutida'])
      { 
          $_SESSION['scriptcase']['export_return'] = $this->json_registro;
      }
      else
      { 
          $result_json = json_encode($this->json_registro, JSON_UNESCAPED_UNICODE);
          if ($result_json == false)
          {
              $oJson = new Services_JSON();
              $result_json = $oJson->encode($this->json_registro);
          }
          fwrite($json_f, $result_json);
          fclose($json_f);
          if ($this->Tem_json_res)
          { 
              if (!$this->Ini->sc_export_ajax) {
                  $this->PB_dif = intval ($this->PB_dif / 2);
                  $Mens_bar  = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
                  $Mens_smry = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_smry_titl']);
                  $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
                  $this->pb->addSteps($this->PB_dif);
              }
              require_once($this->Ini->path_aplicacao . "pdf_payslip_search_hist_res_json.class.php");
              $this->Res = new pdf_payslip_search_hist_res_json();
              $this->prep_modulos("Res");
              $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_res_grid'] = true;
              $this->Res->monta_json();
          } 
          if (!$this->Ini->sc_export_ajax) {
              $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_btns_export_finished']);
              $this->pb->setProgressbarMessage($Mens_bar);
              $this->pb->addSteps($this->PB_dif);
          }
          if ($this->Json_password != "" || $this->Tem_json_res)
          { 
              $str_zip    = "";
              $Parm_pass  = ($this->Json_password != "") ? " -p" : "";
              $Zip_f      = (FALSE !== strpos($this->Zip_f, ' ')) ? " \"" . $this->Zip_f . "\"" :  $this->Zip_f;
              $Arq_input  = (FALSE !== strpos($this->Json_f, ' ')) ? " \"" . $this->Json_f . "\"" :  $this->Json_f;
              if (is_file($Zip_f)) {
                  unlink($Zip_f);
              }
              if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
              {
                  chdir($this->Ini->path_third . "/zip/windows");
                  $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $this->Json_password . " " . $Zip_f . " " . $Arq_input;
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
                  $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
              {
                  chdir($this->Ini->path_third . "/zip/mac/bin");
                  $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
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
              $this->Json_f   = $this->Zip_f;
              $this->Tit_doc = $this->Tit_zip;
              if ($this->Tem_json_res)
              { 
                  $str_zip   = "";
                  $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_res_file']['json'];
                  $Arq_input = (FALSE !== strpos($Arq_res, ' ')) ? " \"" . $Arq_res . "\"" :  $Arq_res;
                  if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                  {
                      $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $this->Json_password . " " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
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
                  unlink($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_res_file']['json']);
              }
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_res_grid']);
          } 
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- userid_int
   function NM_export_userid_int()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->userid_int, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['userid_int'])) ? $this->New_label['userid_int'] : "Userid Int"; 
         }
         else
         {
             $SC_Label = "userid_int"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->userid_int;
   }
   //----- hiredate
   function NM_export_hiredate()
   {
         if ($this->Json_format)
         {
             $conteudo_x =  $this->hiredate;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->hiredate, "YYYY-MM-DD  ");
                 $this->hiredate = $this->nm_data->FormataSaida("d F Y");
             } 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hiredate'])) ? $this->New_label['hiredate'] : "Hiredate"; 
         }
         else
         {
             $SC_Label = "hiredate"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hiredate;
   }
   //----- username
   function NM_export_username()
   {
         $this->username = NM_charset_to_utf8($this->username);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['username'])) ? $this->New_label['username'] : "Username"; 
         }
         else
         {
             $SC_Label = "username"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->username;
   }
   //----- dept
   function NM_export_dept()
   {
         if ($this->Json_format)
         {
             if ($this->dept !== "&nbsp;") 
             { 
                 $this->dept = sc_strtoupper($this->dept); 
             } 
         }
         $this->dept = NM_charset_to_utf8($this->dept);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['dept'])) ? $this->New_label['dept'] : "Dept"; 
         }
         else
         {
             $SC_Label = "dept"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->dept;
   }
   //----- designation
   function NM_export_designation()
   {
         $this->designation = NM_charset_to_utf8($this->designation);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['designation'])) ? $this->New_label['designation'] : "Designation"; 
         }
         else
         {
             $SC_Label = "designation"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->designation;
   }
   //----- rate_work
   function NM_export_rate_work()
   {
         if ($this->Json_format)
         {
             $conteudo = str_replace($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['decimal_db'], "", $conteudo); 
             $this->nm_gera_mask($this->rate_work, "Rate Work"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['rate_work'])) ? $this->New_label['rate_work'] : "Rate Work"; 
         }
         else
         {
             $SC_Label = "rate_work"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->rate_work;
   }
   //----- rate_salf
   function NM_export_rate_salf()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->rate_salf, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['rate_salf'])) ? $this->New_label['rate_salf'] : "Rate SALF"; 
         }
         else
         {
             $SC_Label = "rate_salf"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->rate_salf;
   }
   //----- income_workday
   function NM_export_income_workday()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->income_workday, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['income_workday'])) ? $this->New_label['income_workday'] : "Income Workday"; 
         }
         else
         {
             $SC_Label = "income_workday"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->income_workday;
   }
   //----- income_holiday
   function NM_export_income_holiday()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->income_holiday, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['income_holiday'])) ? $this->New_label['income_holiday'] : "Income Holiday"; 
         }
         else
         {
             $SC_Label = "income_holiday"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->income_holiday;
   }
   //----- income_restday
   function NM_export_income_restday()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->income_restday, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['income_restday'])) ? $this->New_label['income_restday'] : "Income Restday"; 
         }
         else
         {
             $SC_Label = "income_restday"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->income_restday;
   }
   //----- income_offday
   function NM_export_income_offday()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->income_offday, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['income_offday'])) ? $this->New_label['income_offday'] : "Income Offday"; 
         }
         else
         {
             $SC_Label = "income_offday"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->income_offday;
   }
   //----- sal_sunday
   function NM_export_sal_sunday()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->sal_sunday, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sal_sunday'])) ? $this->New_label['sal_sunday'] : "Sal Sunday"; 
         }
         else
         {
             $SC_Label = "sal_sunday"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sal_sunday;
   }
   //----- sal_holiday
   function NM_export_sal_holiday()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->sal_holiday, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sal_holiday'])) ? $this->New_label['sal_holiday'] : "Sal Holiday"; 
         }
         else
         {
             $SC_Label = "sal_holiday"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sal_holiday;
   }
   //----- sal_leavetype
   function NM_export_sal_leavetype()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->sal_leavetype, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sal_leavetype'])) ? $this->New_label['sal_leavetype'] : "Sal Leavetype"; 
         }
         else
         {
             $SC_Label = "sal_leavetype"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sal_leavetype;
   }
   //----- sal_brut_reg
   function NM_export_sal_brut_reg()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->sal_brut_reg, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sal_brut_reg'])) ? $this->New_label['sal_brut_reg'] : "Sal Brut Reg"; 
         }
         else
         {
             $SC_Label = "sal_brut_reg"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sal_brut_reg;
   }
   //----- income_workday_ot
   function NM_export_income_workday_ot()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->income_workday_ot, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['income_workday_ot'])) ? $this->New_label['income_workday_ot'] : "Income Workday Ot"; 
         }
         else
         {
             $SC_Label = "income_workday_ot"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->income_workday_ot;
   }
   //----- income_holiday_ot
   function NM_export_income_holiday_ot()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->income_holiday_ot, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['income_holiday_ot'])) ? $this->New_label['income_holiday_ot'] : "Income Holiday Ot"; 
         }
         else
         {
             $SC_Label = "income_holiday_ot"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->income_holiday_ot;
   }
   //----- income_restday_ot
   function NM_export_income_restday_ot()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->income_restday_ot, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['income_restday_ot'])) ? $this->New_label['income_restday_ot'] : "Income Restday Ot"; 
         }
         else
         {
             $SC_Label = "income_restday_ot"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->income_restday_ot;
   }
   //----- income_offday_ot
   function NM_export_income_offday_ot()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->income_offday_ot, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['income_offday_ot'])) ? $this->New_label['income_offday_ot'] : "Income Offday Ot"; 
         }
         else
         {
             $SC_Label = "income_offday_ot"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->income_offday_ot;
   }
   //----- incentive
   function NM_export_incentive()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->incentive, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['incentive'])) ? $this->New_label['incentive'] : "Incentive"; 
         }
         else
         {
             $SC_Label = "incentive"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->incentive;
   }
   //----- income_comm
   function NM_export_income_comm()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->income_comm, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['income_comm'])) ? $this->New_label['income_comm'] : "Income Comm"; 
         }
         else
         {
             $SC_Label = "income_comm"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->income_comm;
   }
   //----- rappel
   function NM_export_rappel()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->rappel, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['rappel'])) ? $this->New_label['rappel'] : "Rappel"; 
         }
         else
         {
             $SC_Label = "rappel"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->rappel;
   }
   //----- tax_cass
   function NM_export_tax_cass()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->tax_cass, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['tax_cass'])) ? $this->New_label['tax_cass'] : "Tax Cass"; 
         }
         else
         {
             $SC_Label = "tax_cass"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->tax_cass;
   }
   //----- tax_cfgdct
   function NM_export_tax_cfgdct()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->tax_cfgdct, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['tax_cfgdct'])) ? $this->New_label['tax_cfgdct'] : "Tax Cfgdct"; 
         }
         else
         {
             $SC_Label = "tax_cfgdct"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->tax_cfgdct;
   }
   //----- tax_fdu
   function NM_export_tax_fdu()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->tax_fdu, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['tax_fdu'])) ? $this->New_label['tax_fdu'] : "Tax Fdu"; 
         }
         else
         {
             $SC_Label = "tax_fdu"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->tax_fdu;
   }
   //----- tax_ona
   function NM_export_tax_ona()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->tax_ona, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['tax_ona'])) ? $this->New_label['tax_ona'] : "Tax Ona"; 
         }
         else
         {
             $SC_Label = "tax_ona"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->tax_ona;
   }
   //----- tax_iric
   function NM_export_tax_iric()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->tax_iric, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['tax_iric'])) ? $this->New_label['tax_iric'] : "Tax Iric"; 
         }
         else
         {
             $SC_Label = "tax_iric"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->tax_iric;
   }
   //----- dedeuct_cons
   function NM_export_dedeuct_cons()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->dedeuct_cons, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['dedeuct_cons'])) ? $this->New_label['dedeuct_cons'] : "Dedeuct Cons"; 
         }
         else
         {
             $SC_Label = "dedeuct_cons"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->dedeuct_cons;
   }
   //----- loan_deduction
   function NM_export_loan_deduction()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->loan_deduction, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['loan_deduction'])) ? $this->New_label['loan_deduction'] : "Loan Deduction"; 
         }
         else
         {
             $SC_Label = "loan_deduction"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->loan_deduction;
   }
   //----- loan_deduction_bank
   function NM_export_loan_deduction_bank()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->loan_deduction_bank, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['loan_deduction_bank'])) ? $this->New_label['loan_deduction_bank'] : "Loan Deduction Bank"; 
         }
         else
         {
             $SC_Label = "loan_deduction_bank"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->loan_deduction_bank;
   }
   //----- other_deduct
   function NM_export_other_deduct()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->other_deduct, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['other_deduct'])) ? $this->New_label['other_deduct'] : "Other Deduct"; 
         }
         else
         {
             $SC_Label = "other_deduct"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->other_deduct;
   }
   //----- total_deduct
   function NM_export_total_deduct()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->total_deduct, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['total_deduct'])) ? $this->New_label['total_deduct'] : "Total Deduct"; 
         }
         else
         {
             $SC_Label = "total_deduct"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->total_deduct;
   }
   //----- sal_net
   function NM_export_sal_net()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->sal_net, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sal_net'])) ? $this->New_label['sal_net'] : "Sal Net"; 
         }
         else
         {
             $SC_Label = "sal_net"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sal_net;
   }
   //----- work_hh_w
   function NM_export_work_hh_w()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->work_hh_w, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['work_hh_w'])) ? $this->New_label['work_hh_w'] : "Work Hh W"; 
         }
         else
         {
             $SC_Label = "work_hh_w"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->work_hh_w;
   }
   //----- ot_hh_w
   function NM_export_ot_hh_w()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->ot_hh_w, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['ot_hh_w'])) ? $this->New_label['ot_hh_w'] : "Ot Hh W"; 
         }
         else
         {
             $SC_Label = "ot_hh_w"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->ot_hh_w;
   }
   //----- hh_sunday
   function NM_export_hh_sunday()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->hh_sunday, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hh_sunday'])) ? $this->New_label['hh_sunday'] : "Hh Sunday"; 
         }
         else
         {
             $SC_Label = "hh_sunday"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hh_sunday;
   }
   //----- work_hh_r
   function NM_export_work_hh_r()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->work_hh_r, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['work_hh_r'])) ? $this->New_label['work_hh_r'] : "Work Hh R"; 
         }
         else
         {
             $SC_Label = "work_hh_r"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->work_hh_r;
   }
   //----- ot_hh_r
   function NM_export_ot_hh_r()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->ot_hh_r, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['ot_hh_r'])) ? $this->New_label['ot_hh_r'] : "Ot Hh R"; 
         }
         else
         {
             $SC_Label = "ot_hh_r"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->ot_hh_r;
   }
   //----- hh_offday
   function NM_export_hh_offday()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->hh_offday, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hh_offday'])) ? $this->New_label['hh_offday'] : "Hh Offday"; 
         }
         else
         {
             $SC_Label = "hh_offday"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hh_offday;
   }
   //----- work_hh_h
   function NM_export_work_hh_h()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->work_hh_h, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['work_hh_h'])) ? $this->New_label['work_hh_h'] : "Work Hh H"; 
         }
         else
         {
             $SC_Label = "work_hh_h"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->work_hh_h;
   }
   //----- ot_hh_h
   function NM_export_ot_hh_h()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->ot_hh_h, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['ot_hh_h'])) ? $this->New_label['ot_hh_h'] : "Ot Hh H"; 
         }
         else
         {
             $SC_Label = "ot_hh_h"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->ot_hh_h;
   }
   //----- sal_hr_worked
   function NM_export_sal_hr_worked()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->sal_hr_worked, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sal_hr_worked'])) ? $this->New_label['sal_hr_worked'] : "Sal Hr Worked"; 
         }
         else
         {
             $SC_Label = "sal_hr_worked"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sal_hr_worked;
   }
   //----- sal_sunday_1
   function NM_export_sal_sunday_1()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->sal_sunday_1, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sal_sunday_1'])) ? $this->New_label['sal_sunday_1'] : "Sal Sunday"; 
         }
         else
         {
             $SC_Label = "sal_sunday_1"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sal_sunday_1;
   }
   //----- sal_holiday_1
   function NM_export_sal_holiday_1()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->sal_holiday_1, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sal_holiday_1'])) ? $this->New_label['sal_holiday_1'] : "Sal Holiday"; 
         }
         else
         {
             $SC_Label = "sal_holiday_1"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sal_holiday_1;
   }
   //----- sal_brut_reg_1
   function NM_export_sal_brut_reg_1()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->sal_brut_reg_1, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sal_brut_reg_1'])) ? $this->New_label['sal_brut_reg_1'] : "Sal Brut Reg"; 
         }
         else
         {
             $SC_Label = "sal_brut_reg_1"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sal_brut_reg_1;
   }
   //----- sal_suppl
   function NM_export_sal_suppl()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->sal_suppl, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sal_suppl'])) ? $this->New_label['sal_suppl'] : "Sal Suppl"; 
         }
         else
         {
             $SC_Label = "sal_suppl"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sal_suppl;
   }
   //----- sal_holiday_worked_suppl
   function NM_export_sal_holiday_worked_suppl()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->sal_holiday_worked_suppl, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sal_holiday_worked_suppl'])) ? $this->New_label['sal_holiday_worked_suppl'] : "Sal Holiday Worked Suppl"; 
         }
         else
         {
             $SC_Label = "sal_holiday_worked_suppl"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sal_holiday_worked_suppl;
   }
   //----- sal_holiday_suppl
   function NM_export_sal_holiday_suppl()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->sal_holiday_suppl, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sal_holiday_suppl'])) ? $this->New_label['sal_holiday_suppl'] : "Sal Holiday Suppl"; 
         }
         else
         {
             $SC_Label = "sal_holiday_suppl"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sal_holiday_suppl;
   }
   //----- sal_restday_worked_suppl
   function NM_export_sal_restday_worked_suppl()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->sal_restday_worked_suppl, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sal_restday_worked_suppl'])) ? $this->New_label['sal_restday_worked_suppl'] : "Sal Restday Worked Suppl"; 
         }
         else
         {
             $SC_Label = "sal_restday_worked_suppl"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sal_restday_worked_suppl;
   }
   //----- sal_restday_suppl
   function NM_export_sal_restday_suppl()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->sal_restday_suppl, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sal_restday_suppl'])) ? $this->New_label['sal_restday_suppl'] : "Sal Restday Suppl"; 
         }
         else
         {
             $SC_Label = "sal_restday_suppl"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sal_restday_suppl;
   }
   //----- tax_iris
   function NM_export_tax_iris()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->tax_iris, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['tax_iris'])) ? $this->New_label['tax_iris'] : "Tax Iris"; 
         }
         else
         {
             $SC_Label = "tax_iris"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->tax_iris;
   }
   //----- day_cons
   function NM_export_day_cons()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->day_cons, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['day_cons'])) ? $this->New_label['day_cons'] : "Day Cons"; 
         }
         else
         {
             $SC_Label = "day_cons"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->day_cons;
   }
   //----- rate_cons
   function NM_export_rate_cons()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->rate_cons, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['rate_cons'])) ? $this->New_label['rate_cons'] : "Rate Cons"; 
         }
         else
         {
             $SC_Label = "rate_cons"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->rate_cons;
   }
   //----- other_loan_deduction
   function NM_export_other_loan_deduction()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->other_loan_deduction, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['other_loan_deduction'])) ? $this->New_label['other_loan_deduction'] : "Other Loan Deduction"; 
         }
         else
         {
             $SC_Label = "other_loan_deduction"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->other_loan_deduction;
   }
   //----- other_deduct_1
   function NM_export_other_deduct_1()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->other_deduct_1, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['other_deduct_1'])) ? $this->New_label['other_deduct_1'] : "Other Deduct"; 
         }
         else
         {
             $SC_Label = "other_deduct_1"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->other_deduct_1;
   }
   //----- other_deduct_desc
   function NM_export_other_deduct_desc()
   {
         $this->other_deduct_desc = NM_charset_to_utf8($this->other_deduct_desc);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['other_deduct_desc'])) ? $this->New_label['other_deduct_desc'] : "Other Deduct Desc"; 
         }
         else
         {
             $SC_Label = "other_deduct_desc"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->other_deduct_desc;
   }
   //----- bank_number
   function NM_export_bank_number()
   {
         $this->bank_number = NM_charset_to_utf8($this->bank_number);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['bank_number'])) ? $this->New_label['bank_number'] : "Bank Number"; 
         }
         else
         {
             $SC_Label = "bank_number"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->bank_number;
   }
   //----- pay_startdate
   function NM_export_pay_startdate()
   {
         if ($this->Json_format)
         {
             $conteudo_x =  $this->pay_startdate;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->pay_startdate, "YYYY-MM-DD  ");
                 $this->pay_startdate = $this->nm_data->FormataSaida("d F Y");
             } 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['pay_startdate'])) ? $this->New_label['pay_startdate'] : "Pay Startdate"; 
         }
         else
         {
             $SC_Label = "pay_startdate"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->pay_startdate;
   }
   //----- pay_enddate
   function NM_export_pay_enddate()
   {
         if ($this->Json_format)
         {
             $conteudo_x =  $this->pay_enddate;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->pay_enddate, "YYYY-MM-DD  ");
                 $this->pay_enddate = $this->nm_data->FormataSaida("d F Y");
             } 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['pay_enddate'])) ? $this->New_label['pay_enddate'] : "Pay Enddate"; 
         }
         else
         {
             $SC_Label = "pay_enddate"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->pay_enddate;
   }
   //----- work_hh_w_pm
   function NM_export_work_hh_w_pm()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->work_hh_w_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['work_hh_w_pm'])) ? $this->New_label['work_hh_w_pm'] : "Work Hh W PM"; 
         }
         else
         {
             $SC_Label = "work_hh_w_pm"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->work_hh_w_pm;
   }
   //----- ot_hh_w_pm
   function NM_export_ot_hh_w_pm()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->ot_hh_w_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['ot_hh_w_pm'])) ? $this->New_label['ot_hh_w_pm'] : "Ot Hh W PM"; 
         }
         else
         {
             $SC_Label = "ot_hh_w_pm"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->ot_hh_w_pm;
   }
   //----- work_hh_h_pm
   function NM_export_work_hh_h_pm()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->work_hh_h_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['work_hh_h_pm'])) ? $this->New_label['work_hh_h_pm'] : "Work Hh H PM"; 
         }
         else
         {
             $SC_Label = "work_hh_h_pm"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->work_hh_h_pm;
   }
   //----- ot_hh_h_pm
   function NM_export_ot_hh_h_pm()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->ot_hh_h_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['ot_hh_h_pm'])) ? $this->New_label['ot_hh_h_pm'] : "Ot Hh H PM"; 
         }
         else
         {
             $SC_Label = "ot_hh_h_pm"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->ot_hh_h_pm;
   }
   //----- work_hh_r_pm
   function NM_export_work_hh_r_pm()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->work_hh_r_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['work_hh_r_pm'])) ? $this->New_label['work_hh_r_pm'] : "Work Hh R PM"; 
         }
         else
         {
             $SC_Label = "work_hh_r_pm"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->work_hh_r_pm;
   }
   //----- ot_hh_r_pm
   function NM_export_ot_hh_r_pm()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->ot_hh_r_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['ot_hh_r_pm'])) ? $this->New_label['ot_hh_r_pm'] : "Ot Hh R PM"; 
         }
         else
         {
             $SC_Label = "ot_hh_r_pm"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->ot_hh_r_pm;
   }
   //----- work_hh_o
   function NM_export_work_hh_o()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->work_hh_o, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['work_hh_o'])) ? $this->New_label['work_hh_o'] : "Work Hh O"; 
         }
         else
         {
             $SC_Label = "work_hh_o"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->work_hh_o;
   }
   //----- work_hh_o_pm
   function NM_export_work_hh_o_pm()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->work_hh_o_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['work_hh_o_pm'])) ? $this->New_label['work_hh_o_pm'] : "Work Hh O PM"; 
         }
         else
         {
             $SC_Label = "work_hh_o_pm"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->work_hh_o_pm;
   }
   //----- ot_hh_o
   function NM_export_ot_hh_o()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->ot_hh_o, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['ot_hh_o'])) ? $this->New_label['ot_hh_o'] : "Ot Hh O"; 
         }
         else
         {
             $SC_Label = "ot_hh_o"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->ot_hh_o;
   }
   //----- ot_hh_o_pm
   function NM_export_ot_hh_o_pm()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->ot_hh_o_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['ot_hh_o_pm'])) ? $this->New_label['ot_hh_o_pm'] : "Ot Hh O PM"; 
         }
         else
         {
             $SC_Label = "ot_hh_o_pm"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->ot_hh_o_pm;
   }
   //----- hh_leavetype
   function NM_export_hh_leavetype()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->hh_leavetype, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hh_leavetype'])) ? $this->New_label['hh_leavetype'] : "Hh Leavetype"; 
         }
         else
         {
             $SC_Label = "hh_leavetype"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hh_leavetype;
   }
   //----- amount
   function NM_export_amount()
   {
         if ($this->Json_format)
         {
             if ($this->amount !== "&nbsp;") 
             { 
                 $this->amount = sc_strtoupper($this->amount); 
             } 
             if ($this->amount !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->amount, "AMOUNT"); 
             } 
         }
         $this->amount = NM_charset_to_utf8($this->amount);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['amount'])) ? $this->New_label['amount'] : "Amount"; 
         }
         else
         {
             $SC_Label = "amount"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->amount;
   }
   //----- sc_field_0
   function NM_export_sc_field_0()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_0 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_0, "AM"); 
             } 
         }
         $this->sc_field_0 = NM_charset_to_utf8($this->sc_field_0);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_0'])) ? $this->New_label['sc_field_0'] : "Attendance AM"; 
         }
         else
         {
             $SC_Label = "sc_field_0"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_0;
   }
   //----- sc_field_1
   function NM_export_sc_field_1()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_1 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_1, "PM"); 
             } 
         }
         $this->sc_field_1 = NM_charset_to_utf8($this->sc_field_1);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_1'])) ? $this->New_label['sc_field_1'] : "Attendance PM"; 
         }
         else
         {
             $SC_Label = "sc_field_1"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_1;
   }
   //----- sc_field_2
   function NM_export_sc_field_2()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_2 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_2, "Deduct. Loan ONA"); 
             } 
         }
         $this->sc_field_2 = NM_charset_to_utf8($this->sc_field_2);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_2'])) ? $this->New_label['sc_field_2'] : "Deduct Loan Bank"; 
         }
         else
         {
             $SC_Label = "sc_field_2"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_2;
   }
   //----- sc_field_3
   function NM_export_sc_field_3()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_3 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_3, "Deduct. Loan Ent"); 
             } 
         }
         $this->sc_field_3 = NM_charset_to_utf8($this->sc_field_3);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_3'])) ? $this->New_label['sc_field_3'] : "Deduct Loan Enterprise"; 
         }
         else
         {
             $SC_Label = "sc_field_3"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_3;
   }
   //----- sc_field_4
   function NM_export_sc_field_4()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_4 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_4, "Deduct. Meal"); 
             } 
         }
         $this->sc_field_4 = NM_charset_to_utf8($this->sc_field_4);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_4'])) ? $this->New_label['sc_field_4'] : "Deduct Meal"; 
         }
         else
         {
             $SC_Label = "sc_field_4"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_4;
   }
   //----- sc_field_5
   function NM_export_sc_field_5()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_5 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_5, "Deduct. Other"); 
             } 
         }
         $this->sc_field_5 = NM_charset_to_utf8($this->sc_field_5);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_5'])) ? $this->New_label['sc_field_5'] : "Deduct Other"; 
         }
         else
         {
             $SC_Label = "sc_field_5"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_5;
   }
   //----- deductions
   function NM_export_deductions()
   {
         if ($this->Json_format)
         {
             if ($this->deductions !== "&nbsp;") 
             { 
                 $this->deductions = sc_strtoupper($this->deductions); 
             } 
             if ($this->deductions !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->deductions, "DEDUCTIONS"); 
             } 
         }
         $this->deductions = NM_charset_to_utf8($this->deductions);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['deductions'])) ? $this->New_label['deductions'] : "Deductions"; 
         }
         else
         {
             $SC_Label = "deductions"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->deductions;
   }
   //----- sc_field_6
   function NM_export_sc_field_6()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_6 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_6, "EMPLOYEE NAME"); 
             } 
         }
         $this->sc_field_6 = NM_charset_to_utf8($this->sc_field_6);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_6'])) ? $this->New_label['sc_field_6'] : "Employee Name"; 
         }
         else
         {
             $SC_Label = "sc_field_6"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_6;
   }
   //----- sc_field_7
   function NM_export_sc_field_7()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_7 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_7, "ID"); 
             } 
         }
         $this->sc_field_7 = NM_charset_to_utf8($this->sc_field_7);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_7'])) ? $this->New_label['sc_field_7'] : "Fingertec ID"; 
         }
         else
         {
             $SC_Label = "sc_field_7"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_7;
   }
   //----- irisal
   function NM_export_irisal()
   {
         if ($this->Json_format)
         {
             if ($this->irisal !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->irisal, "IRI/Sal"); 
             } 
         }
         $this->irisal = NM_charset_to_utf8($this->irisal);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['irisal'])) ? $this->New_label['irisal'] : "IRISal"; 
         }
         else
         {
             $SC_Label = "irisal"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->irisal;
   }
   //----- incentive_lbl
   function NM_export_incentive_lbl()
   {
         if ($this->Json_format)
         {
             if ($this->incentive_lbl !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->incentive_lbl, "Extra"); 
             } 
         }
         $this->incentive_lbl = NM_charset_to_utf8($this->incentive_lbl);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['incentive_lbl'])) ? $this->New_label['incentive_lbl'] : "Incentive_lbl"; 
         }
         else
         {
             $SC_Label = "incentive_lbl"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->incentive_lbl;
   }
   //----- sc_field_8
   function NM_export_sc_field_8()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_8 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_8, "NET EARNINGS"); 
             } 
         }
         $this->sc_field_8 = NM_charset_to_utf8($this->sc_field_8);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_8'])) ? $this->New_label['sc_field_8'] : "NET EARNINGS"; 
         }
         else
         {
             $SC_Label = "sc_field_8"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_8;
   }
   //----- ona
   function NM_export_ona()
   {
         if ($this->Json_format)
         {
             if ($this->ona !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->ona, "ONA"); 
             } 
         }
         $this->ona = NM_charset_to_utf8($this->ona);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['ona'])) ? $this->New_label['ona'] : "ONA"; 
         }
         else
         {
             $SC_Label = "ona"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->ona;
   }
   //----- sc_field_9
   function NM_export_sc_field_9()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_9 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_9, "OT AM"); 
             } 
         }
         $this->sc_field_9 = NM_charset_to_utf8($this->sc_field_9);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_9'])) ? $this->New_label['sc_field_9'] : "OT AM"; 
         }
         else
         {
             $SC_Label = "sc_field_9"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_9;
   }
   //----- sc_field_10
   function NM_export_sc_field_10()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_10 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_10, "OT PM"); 
             } 
         }
         $this->sc_field_10 = NM_charset_to_utf8($this->sc_field_10);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_10'])) ? $this->New_label['sc_field_10'] : "OT PM"; 
         }
         else
         {
             $SC_Label = "sc_field_10"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_10;
   }
   //----- sc_field_11
   function NM_export_sc_field_11()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_11 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_11, "Pay From"); 
             } 
         }
         $this->sc_field_11 = NM_charset_to_utf8($this->sc_field_11);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_11'])) ? $this->New_label['sc_field_11'] : "Pay From"; 
         }
         else
         {
             $SC_Label = "sc_field_11"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_11;
   }
   //----- sc_field_12
   function NM_export_sc_field_12()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_12 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_12, "Pay To"); 
             } 
         }
         $this->sc_field_12 = NM_charset_to_utf8($this->sc_field_12);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_12'])) ? $this->New_label['sc_field_12'] : "Pay To"; 
         }
         else
         {
             $SC_Label = "sc_field_12"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_12;
   }
   //----- sc_field_13
   function NM_export_sc_field_13()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_13 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_13, "Rappel / Extra"); 
             } 
         }
         $this->sc_field_13 = NM_charset_to_utf8($this->sc_field_13);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_13'])) ? $this->New_label['sc_field_13'] : "Rappel / Extra"; 
         }
         else
         {
             $SC_Label = "sc_field_13"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_13;
   }
   //----- sc_field_14
   function NM_export_sc_field_14()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_14 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_14, "Sal. Holiday OT"); 
             } 
         }
         $this->sc_field_14 = NM_charset_to_utf8($this->sc_field_14);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_14'])) ? $this->New_label['sc_field_14'] : "Sal. Holiday OT"; 
         }
         else
         {
             $SC_Label = "sc_field_14"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_14;
   }
   //----- sc_field_15
   function NM_export_sc_field_15()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_15 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_15, "Sal. Offday OT"); 
             } 
         }
         $this->sc_field_15 = NM_charset_to_utf8($this->sc_field_15);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_15'])) ? $this->New_label['sc_field_15'] : "Sal. Offday OT"; 
         }
         else
         {
             $SC_Label = "sc_field_15"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_15;
   }
   //----- sc_field_16
   function NM_export_sc_field_16()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_16 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_16, "Sal. Restday OT"); 
             } 
         }
         $this->sc_field_16 = NM_charset_to_utf8($this->sc_field_16);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_16'])) ? $this->New_label['sc_field_16'] : "Sal. Restday OT"; 
         }
         else
         {
             $SC_Label = "sc_field_16"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_16;
   }
   //----- sc_field_17
   function NM_export_sc_field_17()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_17 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_17, "Sal. Workday OT"); 
             } 
         }
         $this->sc_field_17 = NM_charset_to_utf8($this->sc_field_17);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_17'])) ? $this->New_label['sc_field_17'] : "Sal. Workday OT"; 
         }
         else
         {
             $SC_Label = "sc_field_17"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_17;
   }
   //----- sc_field_18
   function NM_export_sc_field_18()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_18 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_18, "TCA Add"); 
             } 
         }
         $this->sc_field_18 = NM_charset_to_utf8($this->sc_field_18);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_18'])) ? $this->New_label['sc_field_18'] : "TCA Add"; 
         }
         else
         {
             $SC_Label = "sc_field_18"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_18;
   }
   //----- sc_field_19
   function NM_export_sc_field_19()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_19 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_19, "Total Sal. Add"); 
             } 
         }
         $this->sc_field_19 = NM_charset_to_utf8($this->sc_field_19);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_19'])) ? $this->New_label['sc_field_19'] : "Tota Sal. Additional"; 
         }
         else
         {
             $SC_Label = "sc_field_19"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_19;
   }
   //----- sc_field_20
   function NM_export_sc_field_20()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_20 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_20, "Total Deductions"); 
             } 
         }
         $this->sc_field_20 = NM_charset_to_utf8($this->sc_field_20);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_20'])) ? $this->New_label['sc_field_20'] : "Total Deductions"; 
         }
         else
         {
             $SC_Label = "sc_field_20"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_20;
   }
   //----- sc_field_21
   function NM_export_sc_field_21()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_21 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_21, "Workday"); 
             } 
         }
         $this->sc_field_21 = NM_charset_to_utf8($this->sc_field_21);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_21'])) ? $this->New_label['sc_field_21'] : "Workday AM"; 
         }
         else
         {
             $SC_Label = "sc_field_21"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_21;
   }
   //----- lbl_holiday
   function NM_export_lbl_holiday()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_holiday !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_holiday, "Holiday"); 
             } 
         }
         $this->lbl_holiday = NM_charset_to_utf8($this->lbl_holiday);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_holiday'])) ? $this->New_label['lbl_holiday'] : "lbl_Holiday"; 
         }
         else
         {
             $SC_Label = "lbl_holiday"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_holiday;
   }
   //----- sc_field_22
   function NM_export_sc_field_22()
   {
         if ($this->Json_format)
         {
             if ($this->sc_field_22 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_22, "Holiday Earned"); 
             } 
         }
         $this->sc_field_22 = NM_charset_to_utf8($this->sc_field_22);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sc_field_22'])) ? $this->New_label['sc_field_22'] : "lbl_HolidayBenefits "; 
         }
         else
         {
             $SC_Label = "sc_field_22"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sc_field_22;
   }
   //----- lbl_holidayhh
   function NM_export_lbl_holidayhh()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_holidayhh !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_holidayhh, "Holiday"); 
             } 
         }
         $this->lbl_holidayhh = NM_charset_to_utf8($this->lbl_holidayhh);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_holidayhh'])) ? $this->New_label['lbl_holidayhh'] : "lbl_HolidayHH"; 
         }
         else
         {
             $SC_Label = "lbl_holidayhh"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_holidayhh;
   }
   //----- lbl_hourearned
   function NM_export_lbl_hourearned()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_hourearned !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_hourearned, "Hour Earned"); 
             } 
         }
         $this->lbl_hourearned = NM_charset_to_utf8($this->lbl_hourearned);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_hourearned'])) ? $this->New_label['lbl_hourearned'] : "lbl_Hourearned"; 
         }
         else
         {
             $SC_Label = "lbl_hourearned"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_hourearned;
   }
   //----- lbl_leavetypebenefits
   function NM_export_lbl_leavetypebenefits()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_leavetypebenefits !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_leavetypebenefits, "Leave Earned"); 
             } 
         }
         $this->lbl_leavetypebenefits = NM_charset_to_utf8($this->lbl_leavetypebenefits);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_leavetypebenefits'])) ? $this->New_label['lbl_leavetypebenefits'] : "lbl_LeavetypeBenefits"; 
         }
         else
         {
             $SC_Label = "lbl_leavetypebenefits"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_leavetypebenefits;
   }
   //----- lbl_mealrate
   function NM_export_lbl_mealrate()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_mealrate !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_mealrate, "Meal Rate"); 
             } 
         }
         $this->lbl_mealrate = NM_charset_to_utf8($this->lbl_mealrate);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_mealrate'])) ? $this->New_label['lbl_mealrate'] : "lbl_MealRate"; 
         }
         else
         {
             $SC_Label = "lbl_mealrate"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_mealrate;
   }
   //----- lbl_mealday
   function NM_export_lbl_mealday()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_mealday !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_mealday, "Meal Day"); 
             } 
         }
         $this->lbl_mealday = NM_charset_to_utf8($this->lbl_mealday);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_mealday'])) ? $this->New_label['lbl_mealday'] : "lbl_Mealday"; 
         }
         else
         {
             $SC_Label = "lbl_mealday"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_mealday;
   }
   //----- lbl_ratework
   function NM_export_lbl_ratework()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_ratework !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_ratework, "Rate Work"); 
             } 
         }
         $this->lbl_ratework = NM_charset_to_utf8($this->lbl_ratework);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_ratework'])) ? $this->New_label['lbl_ratework'] : "lbl_RateWork"; 
         }
         else
         {
             $SC_Label = "lbl_ratework"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_ratework;
   }
   //----- lbl_restday
   function NM_export_lbl_restday()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_restday !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_restday, "Restday"); 
             } 
         }
         $this->lbl_restday = NM_charset_to_utf8($this->lbl_restday);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_restday'])) ? $this->New_label['lbl_restday'] : "lbl_Restday"; 
         }
         else
         {
             $SC_Label = "lbl_restday"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_restday;
   }
   //----- lbl_salholiday
   function NM_export_lbl_salholiday()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_salholiday !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_salholiday, "Sal. Holiday"); 
             } 
         }
         $this->lbl_salholiday = NM_charset_to_utf8($this->lbl_salholiday);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_salholiday'])) ? $this->New_label['lbl_salholiday'] : "lbl_SalHoliday"; 
         }
         else
         {
             $SC_Label = "lbl_salholiday"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_salholiday;
   }
   //----- lbl_saloffday
   function NM_export_lbl_saloffday()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_saloffday !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_saloffday, "Sal. Offday"); 
             } 
         }
         $this->lbl_saloffday = NM_charset_to_utf8($this->lbl_saloffday);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_saloffday'])) ? $this->New_label['lbl_saloffday'] : "lbl_SalOffday"; 
         }
         else
         {
             $SC_Label = "lbl_saloffday"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_saloffday;
   }
   //----- lbl_salrestday
   function NM_export_lbl_salrestday()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_salrestday !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_salrestday, "Sal. Restday"); 
             } 
         }
         $this->lbl_salrestday = NM_charset_to_utf8($this->lbl_salrestday);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_salrestday'])) ? $this->New_label['lbl_salrestday'] : "lbl_SalRestday"; 
         }
         else
         {
             $SC_Label = "lbl_salrestday"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_salrestday;
   }
   //----- lbl_salworkday
   function NM_export_lbl_salworkday()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_salworkday !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_salworkday, "Sal. Workday"); 
             } 
         }
         $this->lbl_salworkday = NM_charset_to_utf8($this->lbl_salworkday);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_salworkday'])) ? $this->New_label['lbl_salworkday'] : "lbl_SalWorkday"; 
         }
         else
         {
             $SC_Label = "lbl_salworkday"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_salworkday;
   }
   //----- lbl_sal_reg
   function NM_export_lbl_sal_reg()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_sal_reg !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_sal_reg, "Total Sal. Regular"); 
             } 
         }
         $this->lbl_sal_reg = NM_charset_to_utf8($this->lbl_sal_reg);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_sal_reg'])) ? $this->New_label['lbl_sal_reg'] : "lbl_Sal_Reg"; 
         }
         else
         {
             $SC_Label = "lbl_sal_reg"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_sal_reg;
   }
   //----- lbl_sundaybenefits
   function NM_export_lbl_sundaybenefits()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_sundaybenefits !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_sundaybenefits, "Sunday Earned"); 
             } 
         }
         $this->lbl_sundaybenefits = NM_charset_to_utf8($this->lbl_sundaybenefits);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_sundaybenefits'])) ? $this->New_label['lbl_sundaybenefits'] : "lbl_SundayBenefits"; 
         }
         else
         {
             $SC_Label = "lbl_sundaybenefits"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_sundaybenefits;
   }
   //----- lbl_sundayhh
   function NM_export_lbl_sundayhh()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_sundayhh !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_sundayhh, "Sunday"); 
             } 
         }
         $this->lbl_sundayhh = NM_charset_to_utf8($this->lbl_sundayhh);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_sundayhh'])) ? $this->New_label['lbl_sundayhh'] : "lbl_SundayHH"; 
         }
         else
         {
             $SC_Label = "lbl_sundayhh"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_sundayhh;
   }
   //----- lbl_workay
   function NM_export_lbl_workay()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_workay !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_workay, "Workday"); 
             } 
         }
         $this->lbl_workay = NM_charset_to_utf8($this->lbl_workay);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_workay'])) ? $this->New_label['lbl_workay'] : "lbl_Workay"; 
         }
         else
         {
             $SC_Label = "lbl_workay"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_workay;
   }
   //----- lbl_amount01
   function NM_export_lbl_amount01()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_amount01 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_amount01, "AMOUNT"); 
             } 
         }
         $this->lbl_amount01 = NM_charset_to_utf8($this->lbl_amount01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_amount01'])) ? $this->New_label['lbl_amount01'] : "lbl_amount01"; 
         }
         else
         {
             $SC_Label = "lbl_amount01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_amount01;
   }
   //----- lbl_companyname
   function NM_export_lbl_companyname()
   {
         if ($this->lbl_companyname !== "&nbsp;") 
         { 
             $this->lbl_companyname = sc_strtoupper($this->lbl_companyname); 
         } 
         $this->lbl_companyname = NM_charset_to_utf8($this->lbl_companyname);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_companyname'])) ? $this->New_label['lbl_companyname'] : "lbl_companyname"; 
         }
         else
         {
             $SC_Label = "lbl_companyname"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_companyname;
   }
   //----- lbl_deductions
   function NM_export_lbl_deductions()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_deductions !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_deductions, "Deductions"); 
             } 
         }
         $this->lbl_deductions = NM_charset_to_utf8($this->lbl_deductions);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_deductions'])) ? $this->New_label['lbl_deductions'] : "lbl_deductions"; 
         }
         else
         {
             $SC_Label = "lbl_deductions"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_deductions;
   }
   //----- lbl_dept
   function NM_export_lbl_dept()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_dept !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_dept, "DEPARTMENT"); 
             } 
         }
         $this->lbl_dept = NM_charset_to_utf8($this->lbl_dept);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_dept'])) ? $this->New_label['lbl_dept'] : "lbl_dept"; 
         }
         else
         {
             $SC_Label = "lbl_dept"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_dept;
   }
   //----- lbl_earning
   function NM_export_lbl_earning()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_earning !== "&nbsp;") 
             { 
                 $this->lbl_earning = sc_strtoupper($this->lbl_earning); 
             } 
             if ($this->lbl_earning !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_earning, "EARNING"); 
             } 
         }
         $this->lbl_earning = NM_charset_to_utf8($this->lbl_earning);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_earning'])) ? $this->New_label['lbl_earning'] : "lbl_earning"; 
         }
         else
         {
             $SC_Label = "lbl_earning"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_earning;
   }
   //----- lbl_employeename
   function NM_export_lbl_employeename()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_employeename !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_employeename, "Employee Name"); 
             } 
         }
         $this->lbl_employeename = NM_charset_to_utf8($this->lbl_employeename);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_employeename'])) ? $this->New_label['lbl_employeename'] : "lbl_employeename"; 
         }
         else
         {
             $SC_Label = "lbl_employeename"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_employeename;
   }
   //----- lbl_fixedsalary
   function NM_export_lbl_fixedsalary()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_fixedsalary !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_fixedsalary, "Fixed Salary"); 
             } 
         }
         $this->lbl_fixedsalary = NM_charset_to_utf8($this->lbl_fixedsalary);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_fixedsalary'])) ? $this->New_label['lbl_fixedsalary'] : "lbl_fixedsalary"; 
         }
         else
         {
             $SC_Label = "lbl_fixedsalary"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_fixedsalary;
   }
   //----- lbl_leavehh
   function NM_export_lbl_leavehh()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_leavehh !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_leavehh, "Leave"); 
             } 
         }
         $this->lbl_leavehh = NM_charset_to_utf8($this->lbl_leavehh);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_leavehh'])) ? $this->New_label['lbl_leavehh'] : "lbl_leaveHH"; 
         }
         else
         {
             $SC_Label = "lbl_leavehh"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_leavehh;
   }
   //----- lbl_line01
   function NM_export_lbl_line01()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_line01 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_line01, "________________________________________________________________"); 
             } 
         }
         $this->lbl_line01 = NM_charset_to_utf8($this->lbl_line01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_line01'])) ? $this->New_label['lbl_line01'] : "lbl_line01"; 
         }
         else
         {
             $SC_Label = "lbl_line01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_line01;
   }
   //----- lbl_offday
   function NM_export_lbl_offday()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_offday !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_offday, "Offday"); 
             } 
         }
         $this->lbl_offday = NM_charset_to_utf8($this->lbl_offday);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_offday'])) ? $this->New_label['lbl_offday'] : "lbl_offday"; 
         }
         else
         {
             $SC_Label = "lbl_offday"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_offday;
   }
   //----- lbl_payslip
   function NM_export_lbl_payslip()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_payslip !== "&nbsp;") 
             { 
                 $this->lbl_payslip = sc_strtoupper($this->lbl_payslip); 
             } 
             if ($this->lbl_payslip !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_payslip, "PAYSLIP REPRINTED"); 
             } 
         }
         $this->lbl_payslip = NM_charset_to_utf8($this->lbl_payslip);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_payslip'])) ? $this->New_label['lbl_payslip'] : "lbl_payslip"; 
         }
         else
         {
             $SC_Label = "lbl_payslip"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_payslip;
   }
   //----- lbl_rappel
   function NM_export_lbl_rappel()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_rappel !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_rappel, "Miscellaneous"); 
             } 
         }
         $this->lbl_rappel = NM_charset_to_utf8($this->lbl_rappel);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_rappel'])) ? $this->New_label['lbl_rappel'] : "lbl_rappel"; 
         }
         else
         {
             $SC_Label = "lbl_rappel"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_rappel;
   }
   //----- lbl_salholidaydet
   function NM_export_lbl_salholidaydet()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_salholidaydet !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_salholidaydet, "Sal Holiday"); 
             } 
         }
         $this->lbl_salholidaydet = NM_charset_to_utf8($this->lbl_salholidaydet);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_salholidaydet'])) ? $this->New_label['lbl_salholidaydet'] : "lbl_salHolidaydet"; 
         }
         else
         {
             $SC_Label = "lbl_salholidaydet"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_salholidaydet;
   }
   //----- lbl_saloffdaydet
   function NM_export_lbl_saloffdaydet()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_saloffdaydet !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_saloffdaydet, "Sal Offday"); 
             } 
         }
         $this->lbl_saloffdaydet = NM_charset_to_utf8($this->lbl_saloffdaydet);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_saloffdaydet'])) ? $this->New_label['lbl_saloffdaydet'] : "lbl_salOffdaydet"; 
         }
         else
         {
             $SC_Label = "lbl_saloffdaydet"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_saloffdaydet;
   }
   //----- lbl_salrestdaydet
   function NM_export_lbl_salrestdaydet()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_salrestdaydet !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_salrestdaydet, "Sal Restday"); 
             } 
         }
         $this->lbl_salrestdaydet = NM_charset_to_utf8($this->lbl_salrestdaydet);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_salrestdaydet'])) ? $this->New_label['lbl_salrestdaydet'] : "lbl_salRestdaydet"; 
         }
         else
         {
             $SC_Label = "lbl_salrestdaydet"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_salrestdaydet;
   }
   //----- lbl_salworkdaydet
   function NM_export_lbl_salworkdaydet()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_salworkdaydet !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_salworkdaydet, "Sal Workday"); 
             } 
         }
         $this->lbl_salworkdaydet = NM_charset_to_utf8($this->lbl_salworkdaydet);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_salworkdaydet'])) ? $this->New_label['lbl_salworkdaydet'] : "lbl_salWorkdaydet"; 
         }
         else
         {
             $SC_Label = "lbl_salworkdaydet"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_salworkdaydet;
   }
   //----- lbl_taxcass
   function NM_export_lbl_taxcass()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_taxcass !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_taxcass, "CASS"); 
             } 
         }
         $this->lbl_taxcass = NM_charset_to_utf8($this->lbl_taxcass);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_taxcass'])) ? $this->New_label['lbl_taxcass'] : "lbl_taxCASS"; 
         }
         else
         {
             $SC_Label = "lbl_taxcass"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_taxcass;
   }
   //----- lbl_taxcfgdct
   function NM_export_lbl_taxcfgdct()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_taxcfgdct !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_taxcfgdct, "CFGDCT"); 
             } 
         }
         $this->lbl_taxcfgdct = NM_charset_to_utf8($this->lbl_taxcfgdct);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_taxcfgdct'])) ? $this->New_label['lbl_taxcfgdct'] : "lbl_taxCFGDCT"; 
         }
         else
         {
             $SC_Label = "lbl_taxcfgdct"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_taxcfgdct;
   }
   //----- lbl_taxfdu
   function NM_export_lbl_taxfdu()
   {
         if ($this->Json_format)
         {
             if ($this->lbl_taxfdu !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_taxfdu, "FDU"); 
             } 
         }
         $this->lbl_taxfdu = NM_charset_to_utf8($this->lbl_taxfdu);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['lbl_taxfdu'])) ? $this->New_label['lbl_taxfdu'] : "lbl_taxFDU"; 
         }
         else
         {
             $SC_Label = "lbl_taxfdu"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->lbl_taxfdu;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist'][$path_doc_md5][1] = $this->Tit_doc;
      $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
      if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
          $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
      }
      $this->pb->setProgressbarMessage($Mens_bar);
      $this->pb->setDownloadLink($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $this->pb->setDownloadMd5($path_doc_md5);
      $this->pb->completed();
   }
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_chart_title'] ?> tbl_salary :: JSON</TITLE>
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
   <td class="scExportTitle" style="height: 25px">JSON</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
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
<form name="Fdown" method="get" action="pdf_payslip_search_hist_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="pdf_payslip_search_hist"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['json_return']); ?>"> 
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
}

?>
