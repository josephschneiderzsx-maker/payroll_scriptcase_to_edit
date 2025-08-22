<?php

class pdf_payslip_allv2_rtf
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Texto_tag;
   var $Arquivo;
   var $Tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   //---- 
   function __construct()
   {
      $this->nm_data   = new nm_data("en_us");
      $this->Texto_tag = "";
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
   function monta_rtf()
   {
      $this->inicializa_vars();
      $this->gera_texto_tag();
      $this->grava_arquivo_rtf();
      if ($this->Ini->sc_export_ajax)
      {
          $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Rtf_f);
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
                   nm_limpa_str_pdf_payslip_allv2($cadapar[1]);
                   nm_protect_num_pdf_payslip_allv2($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['pdf_payslip_allv2']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "pdf_payslip_allv2_total.class.php"); 
      $this->Tot      = new pdf_payslip_allv2_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['tot_geral'][1];
      }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['pdf_payslip_allv2']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption('volta_grid');
          $this->pb->setTotalSteps($this->count_ger);
      }
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_pdf_payslip_allv2";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "pdf_payslip_allv2.rtf";
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
   function gera_texto_tag()
   {
     global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['campos_busca'];
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
          $this->designation = (isset($Busca_temp['designation'])) ? $Busca_temp['designation'] : ""; 
          $tmp_pos = (is_string($this->designation)) ? strpos($this->designation, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->designation))
          {
              $this->designation = substr($this->designation, 0, $tmp_pos);
          }
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['userid_int'])) ? $this->New_label['userid_int'] : "Userid Int"; 
          if ($Cada_col == "userid_int" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['hiredate'])) ? $this->New_label['hiredate'] : "Hiredate"; 
          if ($Cada_col == "hiredate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['username'])) ? $this->New_label['username'] : "Username"; 
          if ($Cada_col == "username" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['dept'])) ? $this->New_label['dept'] : "Dept"; 
          if ($Cada_col == "dept" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['designation'])) ? $this->New_label['designation'] : "Designation"; 
          if ($Cada_col == "designation" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['rate_work'])) ? $this->New_label['rate_work'] : "Rate Work"; 
          if ($Cada_col == "rate_work" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['rate_salf'])) ? $this->New_label['rate_salf'] : "Rate SALF"; 
          if ($Cada_col == "rate_salf" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['income_workday'])) ? $this->New_label['income_workday'] : "Income Workday"; 
          if ($Cada_col == "income_workday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['income_holiday'])) ? $this->New_label['income_holiday'] : "Income Holiday"; 
          if ($Cada_col == "income_holiday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['income_restday'])) ? $this->New_label['income_restday'] : "Income Restday"; 
          if ($Cada_col == "income_restday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['income_offday'])) ? $this->New_label['income_offday'] : "Income Offday"; 
          if ($Cada_col == "income_offday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sal_sunday'])) ? $this->New_label['sal_sunday'] : "Sal Sunday"; 
          if ($Cada_col == "sal_sunday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sal_holiday'])) ? $this->New_label['sal_holiday'] : "Sal Holiday"; 
          if ($Cada_col == "sal_holiday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sal_leavetype'])) ? $this->New_label['sal_leavetype'] : "Sal Leavetype"; 
          if ($Cada_col == "sal_leavetype" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sal_brut_reg'])) ? $this->New_label['sal_brut_reg'] : "Sal Brut Reg"; 
          if ($Cada_col == "sal_brut_reg" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['income_workday_ot'])) ? $this->New_label['income_workday_ot'] : "Income Workday Ot"; 
          if ($Cada_col == "income_workday_ot" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['income_holiday_ot'])) ? $this->New_label['income_holiday_ot'] : "Income Holiday Ot"; 
          if ($Cada_col == "income_holiday_ot" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['income_restday_ot'])) ? $this->New_label['income_restday_ot'] : "Income Restday Ot"; 
          if ($Cada_col == "income_restday_ot" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['income_offday_ot'])) ? $this->New_label['income_offday_ot'] : "Income Offday Ot"; 
          if ($Cada_col == "income_offday_ot" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['incentive'])) ? $this->New_label['incentive'] : "Incentive"; 
          if ($Cada_col == "incentive" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['income_comm'])) ? $this->New_label['income_comm'] : "Income Comm"; 
          if ($Cada_col == "income_comm" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['rappel'])) ? $this->New_label['rappel'] : "Rappel"; 
          if ($Cada_col == "rappel" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tax_cass'])) ? $this->New_label['tax_cass'] : "Tax Cass"; 
          if ($Cada_col == "tax_cass" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tax_cfgdct'])) ? $this->New_label['tax_cfgdct'] : "Tax Cfgdct"; 
          if ($Cada_col == "tax_cfgdct" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tax_fdu'])) ? $this->New_label['tax_fdu'] : "Tax Fdu"; 
          if ($Cada_col == "tax_fdu" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tax_ona'])) ? $this->New_label['tax_ona'] : "Tax Ona"; 
          if ($Cada_col == "tax_ona" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tax_iric'])) ? $this->New_label['tax_iric'] : "Tax Iric"; 
          if ($Cada_col == "tax_iric" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['dedeuct_cons'])) ? $this->New_label['dedeuct_cons'] : "Dedeuct Cons"; 
          if ($Cada_col == "dedeuct_cons" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['loan_deduction'])) ? $this->New_label['loan_deduction'] : "Loan Deduction"; 
          if ($Cada_col == "loan_deduction" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['loan_deduction_bank'])) ? $this->New_label['loan_deduction_bank'] : "Loan Deduction Bank"; 
          if ($Cada_col == "loan_deduction_bank" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['other_deduct'])) ? $this->New_label['other_deduct'] : "Other Deduct"; 
          if ($Cada_col == "other_deduct" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['total_deduct'])) ? $this->New_label['total_deduct'] : "Total Deduct"; 
          if ($Cada_col == "total_deduct" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sal_net'])) ? $this->New_label['sal_net'] : "Sal Net"; 
          if ($Cada_col == "sal_net" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['work_hh_w'])) ? $this->New_label['work_hh_w'] : "Work Hh W"; 
          if ($Cada_col == "work_hh_w" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ot_hh_w'])) ? $this->New_label['ot_hh_w'] : "Ot Hh W"; 
          if ($Cada_col == "ot_hh_w" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['hh_sunday'])) ? $this->New_label['hh_sunday'] : "Hh Sunday"; 
          if ($Cada_col == "hh_sunday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['work_hh_r'])) ? $this->New_label['work_hh_r'] : "Work Hh R"; 
          if ($Cada_col == "work_hh_r" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ot_hh_r'])) ? $this->New_label['ot_hh_r'] : "Ot Hh R"; 
          if ($Cada_col == "ot_hh_r" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['hh_offday'])) ? $this->New_label['hh_offday'] : "Hh Offday"; 
          if ($Cada_col == "hh_offday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['work_hh_h'])) ? $this->New_label['work_hh_h'] : "Work Hh H"; 
          if ($Cada_col == "work_hh_h" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ot_hh_h'])) ? $this->New_label['ot_hh_h'] : "Ot Hh H"; 
          if ($Cada_col == "ot_hh_h" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sal_hr_worked'])) ? $this->New_label['sal_hr_worked'] : "Sal Hr Worked"; 
          if ($Cada_col == "sal_hr_worked" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sal_sunday_1'])) ? $this->New_label['sal_sunday_1'] : "Sal Sunday"; 
          if ($Cada_col == "sal_sunday_1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sal_holiday_1'])) ? $this->New_label['sal_holiday_1'] : "Sal Holiday"; 
          if ($Cada_col == "sal_holiday_1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sal_brut_reg_1'])) ? $this->New_label['sal_brut_reg_1'] : "Sal Brut Reg"; 
          if ($Cada_col == "sal_brut_reg_1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sal_suppl'])) ? $this->New_label['sal_suppl'] : "Sal Suppl"; 
          if ($Cada_col == "sal_suppl" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sal_holiday_worked_suppl'])) ? $this->New_label['sal_holiday_worked_suppl'] : "Sal Holiday Worked Suppl"; 
          if ($Cada_col == "sal_holiday_worked_suppl" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sal_holiday_suppl'])) ? $this->New_label['sal_holiday_suppl'] : "Sal Holiday Suppl"; 
          if ($Cada_col == "sal_holiday_suppl" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sal_restday_worked_suppl'])) ? $this->New_label['sal_restday_worked_suppl'] : "Sal Restday Worked Suppl"; 
          if ($Cada_col == "sal_restday_worked_suppl" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sal_restday_suppl'])) ? $this->New_label['sal_restday_suppl'] : "Sal Restday Suppl"; 
          if ($Cada_col == "sal_restday_suppl" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tax_iris'])) ? $this->New_label['tax_iris'] : "Tax Iris"; 
          if ($Cada_col == "tax_iris" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['day_cons'])) ? $this->New_label['day_cons'] : "Day Cons"; 
          if ($Cada_col == "day_cons" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['rate_cons'])) ? $this->New_label['rate_cons'] : "Rate Cons"; 
          if ($Cada_col == "rate_cons" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['other_loan_deduction'])) ? $this->New_label['other_loan_deduction'] : "Other Loan Deduction"; 
          if ($Cada_col == "other_loan_deduction" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['other_deduct_1'])) ? $this->New_label['other_deduct_1'] : "Other Deduct"; 
          if ($Cada_col == "other_deduct_1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['other_deduct_desc'])) ? $this->New_label['other_deduct_desc'] : "Other Deduct Desc"; 
          if ($Cada_col == "other_deduct_desc" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['bank_number'])) ? $this->New_label['bank_number'] : "Bank Number"; 
          if ($Cada_col == "bank_number" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pay_startdate'])) ? $this->New_label['pay_startdate'] : "Pay Startdate"; 
          if ($Cada_col == "pay_startdate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pay_enddate'])) ? $this->New_label['pay_enddate'] : "Pay Enddate"; 
          if ($Cada_col == "pay_enddate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['work_hh_w_pm'])) ? $this->New_label['work_hh_w_pm'] : "Work Hh W PM"; 
          if ($Cada_col == "work_hh_w_pm" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ot_hh_w_pm'])) ? $this->New_label['ot_hh_w_pm'] : "Ot Hh W PM"; 
          if ($Cada_col == "ot_hh_w_pm" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['work_hh_h_pm'])) ? $this->New_label['work_hh_h_pm'] : "Work Hh H PM"; 
          if ($Cada_col == "work_hh_h_pm" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ot_hh_h_pm'])) ? $this->New_label['ot_hh_h_pm'] : "Ot Hh H PM"; 
          if ($Cada_col == "ot_hh_h_pm" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['work_hh_r_pm'])) ? $this->New_label['work_hh_r_pm'] : "Work Hh R PM"; 
          if ($Cada_col == "work_hh_r_pm" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ot_hh_r_pm'])) ? $this->New_label['ot_hh_r_pm'] : "Ot Hh R PM"; 
          if ($Cada_col == "ot_hh_r_pm" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['work_hh_o'])) ? $this->New_label['work_hh_o'] : "Work Hh O"; 
          if ($Cada_col == "work_hh_o" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['work_hh_o_pm'])) ? $this->New_label['work_hh_o_pm'] : "Work Hh O PM"; 
          if ($Cada_col == "work_hh_o_pm" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ot_hh_o'])) ? $this->New_label['ot_hh_o'] : "Ot Hh O"; 
          if ($Cada_col == "ot_hh_o" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ot_hh_o_pm'])) ? $this->New_label['ot_hh_o_pm'] : "Ot Hh O PM"; 
          if ($Cada_col == "ot_hh_o_pm" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['hh_leavetype'])) ? $this->New_label['hh_leavetype'] : "Hh Leavetype"; 
          if ($Cada_col == "hh_leavetype" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['amount'])) ? $this->New_label['amount'] : "Amount"; 
          if ($Cada_col == "amount" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_0'])) ? $this->New_label['sc_field_0'] : "Attendance AM"; 
          if ($Cada_col == "sc_field_0" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_1'])) ? $this->New_label['sc_field_1'] : "Attendance PM"; 
          if ($Cada_col == "sc_field_1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_2'])) ? $this->New_label['sc_field_2'] : "Deduct Loan Bank"; 
          if ($Cada_col == "sc_field_2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_3'])) ? $this->New_label['sc_field_3'] : "Deduct Loan Enterprise"; 
          if ($Cada_col == "sc_field_3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_4'])) ? $this->New_label['sc_field_4'] : "Deduct Meal"; 
          if ($Cada_col == "sc_field_4" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_5'])) ? $this->New_label['sc_field_5'] : "Deduct Other"; 
          if ($Cada_col == "sc_field_5" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['deductions'])) ? $this->New_label['deductions'] : "Deductions"; 
          if ($Cada_col == "deductions" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_6'])) ? $this->New_label['sc_field_6'] : "Employee Name"; 
          if ($Cada_col == "sc_field_6" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_7'])) ? $this->New_label['sc_field_7'] : "Fingertec ID"; 
          if ($Cada_col == "sc_field_7" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['irisal'])) ? $this->New_label['irisal'] : "IRISal"; 
          if ($Cada_col == "irisal" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['incentive_lbl'])) ? $this->New_label['incentive_lbl'] : "Incentive_lbl"; 
          if ($Cada_col == "incentive_lbl" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_8'])) ? $this->New_label['sc_field_8'] : "NET EARNINGS"; 
          if ($Cada_col == "sc_field_8" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ona'])) ? $this->New_label['ona'] : "ONA"; 
          if ($Cada_col == "ona" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_9'])) ? $this->New_label['sc_field_9'] : "OT AM"; 
          if ($Cada_col == "sc_field_9" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_10'])) ? $this->New_label['sc_field_10'] : "OT PM"; 
          if ($Cada_col == "sc_field_10" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_11'])) ? $this->New_label['sc_field_11'] : "Pay From"; 
          if ($Cada_col == "sc_field_11" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_12'])) ? $this->New_label['sc_field_12'] : "Pay To"; 
          if ($Cada_col == "sc_field_12" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_13'])) ? $this->New_label['sc_field_13'] : "Rappel / Extra"; 
          if ($Cada_col == "sc_field_13" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_14'])) ? $this->New_label['sc_field_14'] : "Sal. Holiday OT"; 
          if ($Cada_col == "sc_field_14" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_15'])) ? $this->New_label['sc_field_15'] : "Sal. Offday OT"; 
          if ($Cada_col == "sc_field_15" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_16'])) ? $this->New_label['sc_field_16'] : "Sal. Restday OT"; 
          if ($Cada_col == "sc_field_16" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_17'])) ? $this->New_label['sc_field_17'] : "Sal. Workday OT"; 
          if ($Cada_col == "sc_field_17" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_18'])) ? $this->New_label['sc_field_18'] : "TCA Add"; 
          if ($Cada_col == "sc_field_18" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_19'])) ? $this->New_label['sc_field_19'] : "Tota Sal. Additional"; 
          if ($Cada_col == "sc_field_19" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_20'])) ? $this->New_label['sc_field_20'] : "Total Deductions"; 
          if ($Cada_col == "sc_field_20" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_21'])) ? $this->New_label['sc_field_21'] : "Workday AM"; 
          if ($Cada_col == "sc_field_21" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_holiday'])) ? $this->New_label['lbl_holiday'] : "lbl_Holiday"; 
          if ($Cada_col == "lbl_holiday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_22'])) ? $this->New_label['sc_field_22'] : "lbl_HolidayBenefits "; 
          if ($Cada_col == "sc_field_22" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_holidayhh'])) ? $this->New_label['lbl_holidayhh'] : "lbl_HolidayHH"; 
          if ($Cada_col == "lbl_holidayhh" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_hourearned'])) ? $this->New_label['lbl_hourearned'] : "lbl_Hourearned"; 
          if ($Cada_col == "lbl_hourearned" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_leavetypebenefits'])) ? $this->New_label['lbl_leavetypebenefits'] : "lbl_LeavetypeBenefits"; 
          if ($Cada_col == "lbl_leavetypebenefits" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_mealrate'])) ? $this->New_label['lbl_mealrate'] : "lbl_MealRate"; 
          if ($Cada_col == "lbl_mealrate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_mealday'])) ? $this->New_label['lbl_mealday'] : "lbl_Mealday"; 
          if ($Cada_col == "lbl_mealday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_ratework'])) ? $this->New_label['lbl_ratework'] : "lbl_RateWork"; 
          if ($Cada_col == "lbl_ratework" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_restday'])) ? $this->New_label['lbl_restday'] : "lbl_Restday"; 
          if ($Cada_col == "lbl_restday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_salholiday'])) ? $this->New_label['lbl_salholiday'] : "lbl_SalHoliday"; 
          if ($Cada_col == "lbl_salholiday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_saloffday'])) ? $this->New_label['lbl_saloffday'] : "lbl_SalOffday"; 
          if ($Cada_col == "lbl_saloffday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_salrestday'])) ? $this->New_label['lbl_salrestday'] : "lbl_SalRestday"; 
          if ($Cada_col == "lbl_salrestday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_salworkday'])) ? $this->New_label['lbl_salworkday'] : "lbl_SalWorkday"; 
          if ($Cada_col == "lbl_salworkday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_sal_reg'])) ? $this->New_label['lbl_sal_reg'] : "lbl_Sal_Reg"; 
          if ($Cada_col == "lbl_sal_reg" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_sundaybenefits'])) ? $this->New_label['lbl_sundaybenefits'] : "lbl_SundayBenefits"; 
          if ($Cada_col == "lbl_sundaybenefits" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_sundayhh'])) ? $this->New_label['lbl_sundayhh'] : "lbl_SundayHH"; 
          if ($Cada_col == "lbl_sundayhh" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_workay'])) ? $this->New_label['lbl_workay'] : "lbl_Workay"; 
          if ($Cada_col == "lbl_workay" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_amount01'])) ? $this->New_label['lbl_amount01'] : "lbl_amount01"; 
          if ($Cada_col == "lbl_amount01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_companyname'])) ? $this->New_label['lbl_companyname'] : "lbl_companyname"; 
          if ($Cada_col == "lbl_companyname" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_deductions'])) ? $this->New_label['lbl_deductions'] : "lbl_deductions"; 
          if ($Cada_col == "lbl_deductions" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_dept'])) ? $this->New_label['lbl_dept'] : "lbl_dept"; 
          if ($Cada_col == "lbl_dept" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_earning'])) ? $this->New_label['lbl_earning'] : "lbl_earning"; 
          if ($Cada_col == "lbl_earning" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_employeename'])) ? $this->New_label['lbl_employeename'] : "lbl_employeename"; 
          if ($Cada_col == "lbl_employeename" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_fixedsalary'])) ? $this->New_label['lbl_fixedsalary'] : "lbl_fixedsalary"; 
          if ($Cada_col == "lbl_fixedsalary" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_leavehh'])) ? $this->New_label['lbl_leavehh'] : "lbl_leaveHH"; 
          if ($Cada_col == "lbl_leavehh" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_line01'])) ? $this->New_label['lbl_line01'] : "lbl_line01"; 
          if ($Cada_col == "lbl_line01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_offday'])) ? $this->New_label['lbl_offday'] : "lbl_offday"; 
          if ($Cada_col == "lbl_offday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_payslip'])) ? $this->New_label['lbl_payslip'] : "lbl_payslip"; 
          if ($Cada_col == "lbl_payslip" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_rappel'])) ? $this->New_label['lbl_rappel'] : "lbl_rappel"; 
          if ($Cada_col == "lbl_rappel" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_salholidaydet'])) ? $this->New_label['lbl_salholidaydet'] : "lbl_salHolidaydet"; 
          if ($Cada_col == "lbl_salholidaydet" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_saloffdaydet'])) ? $this->New_label['lbl_saloffdaydet'] : "lbl_salOffdaydet"; 
          if ($Cada_col == "lbl_saloffdaydet" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_salrestdaydet'])) ? $this->New_label['lbl_salrestdaydet'] : "lbl_salRestdaydet"; 
          if ($Cada_col == "lbl_salrestdaydet" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_salworkdaydet'])) ? $this->New_label['lbl_salworkdaydet'] : "lbl_salWorkdaydet"; 
          if ($Cada_col == "lbl_salworkdaydet" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_taxcass'])) ? $this->New_label['lbl_taxcass'] : "lbl_taxCASS"; 
          if ($Cada_col == "lbl_taxcass" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_taxcfgdct'])) ? $this->New_label['lbl_taxcfgdct'] : "lbl_taxCFGDCT"; 
          if ($Cada_col == "lbl_taxcfgdct" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lbl_taxfdu'])) ? $this->New_label['lbl_taxfdu'] : "lbl_taxFDU"; 
          if ($Cada_col == "lbl_taxfdu" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
      } 
      $this->Texto_tag .= "</tr>\r\n";
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
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['order_grid'];
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
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         if (!$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         $this->Texto_tag .= "<tr>\r\n";
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
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->Texto_tag .= "</tr>\r\n";
         $rs->MoveNext();
      }
      $this->Texto_tag .= "</table>\r\n";
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- userid_int
   function NM_export_userid_int()
   {
             nmgp_Form_Num_Val($this->userid_int, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->userid_int = NM_charset_to_utf8($this->userid_int);
         $this->userid_int = str_replace('<', '&lt;', $this->userid_int);
         $this->userid_int = str_replace('>', '&gt;', $this->userid_int);
         $this->Texto_tag .= "<td>" . $this->userid_int . "</td>\r\n";
   }
   //----- hiredate
   function NM_export_hiredate()
   {
             $conteudo_x =  $this->hiredate;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->hiredate, "YYYY-MM-DD  ");
                 $this->hiredate = $this->nm_data->FormataSaida("d F Y");
             } 
         $this->hiredate = NM_charset_to_utf8($this->hiredate);
         $this->hiredate = str_replace('<', '&lt;', $this->hiredate);
         $this->hiredate = str_replace('>', '&gt;', $this->hiredate);
         $this->Texto_tag .= "<td>" . $this->hiredate . "</td>\r\n";
   }
   //----- username
   function NM_export_username()
   {
         $this->username = html_entity_decode($this->username, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->username = strip_tags($this->username);
         $this->username = NM_charset_to_utf8($this->username);
         $this->username = str_replace('<', '&lt;', $this->username);
         $this->username = str_replace('>', '&gt;', $this->username);
         $this->Texto_tag .= "<td>" . $this->username . "</td>\r\n";
   }
   //----- dept
   function NM_export_dept()
   {
             if ($this->dept !== "&nbsp;") 
             { 
                 $this->dept = sc_strtoupper($this->dept); 
             } 
         $this->dept = html_entity_decode($this->dept, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->dept = NM_charset_to_utf8($this->dept);
         $this->dept = str_replace('<', '&lt;', $this->dept);
         $this->dept = str_replace('>', '&gt;', $this->dept);
         $this->Texto_tag .= "<td>" . $this->dept . "</td>\r\n";
   }
   //----- designation
   function NM_export_designation()
   {
         $this->designation = html_entity_decode($this->designation, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->designation = strip_tags($this->designation);
         $this->designation = NM_charset_to_utf8($this->designation);
         $this->designation = str_replace('<', '&lt;', $this->designation);
         $this->designation = str_replace('>', '&gt;', $this->designation);
         $this->Texto_tag .= "<td>" . $this->designation . "</td>\r\n";
   }
   //----- rate_work
   function NM_export_rate_work()
   {
             $conteudo = str_replace($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['decimal_db'], "", $conteudo); 
             $this->nm_gera_mask($this->rate_work, "Rate Work"); 
         $this->rate_work = NM_charset_to_utf8($this->rate_work);
         $this->rate_work = str_replace('<', '&lt;', $this->rate_work);
         $this->rate_work = str_replace('>', '&gt;', $this->rate_work);
         $this->Texto_tag .= "<td>" . $this->rate_work . "</td>\r\n";
   }
   //----- rate_salf
   function NM_export_rate_salf()
   {
             nmgp_Form_Num_Val($this->rate_salf, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         $this->rate_salf = NM_charset_to_utf8($this->rate_salf);
         $this->rate_salf = str_replace('<', '&lt;', $this->rate_salf);
         $this->rate_salf = str_replace('>', '&gt;', $this->rate_salf);
         $this->Texto_tag .= "<td>" . $this->rate_salf . "</td>\r\n";
   }
   //----- income_workday
   function NM_export_income_workday()
   {
             nmgp_Form_Num_Val($this->income_workday, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->income_workday = NM_charset_to_utf8($this->income_workday);
         $this->income_workday = str_replace('<', '&lt;', $this->income_workday);
         $this->income_workday = str_replace('>', '&gt;', $this->income_workday);
         $this->Texto_tag .= "<td>" . $this->income_workday . "</td>\r\n";
   }
   //----- income_holiday
   function NM_export_income_holiday()
   {
             nmgp_Form_Num_Val($this->income_holiday, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->income_holiday = NM_charset_to_utf8($this->income_holiday);
         $this->income_holiday = str_replace('<', '&lt;', $this->income_holiday);
         $this->income_holiday = str_replace('>', '&gt;', $this->income_holiday);
         $this->Texto_tag .= "<td>" . $this->income_holiday . "</td>\r\n";
   }
   //----- income_restday
   function NM_export_income_restday()
   {
             nmgp_Form_Num_Val($this->income_restday, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->income_restday = NM_charset_to_utf8($this->income_restday);
         $this->income_restday = str_replace('<', '&lt;', $this->income_restday);
         $this->income_restday = str_replace('>', '&gt;', $this->income_restday);
         $this->Texto_tag .= "<td>" . $this->income_restday . "</td>\r\n";
   }
   //----- income_offday
   function NM_export_income_offday()
   {
             nmgp_Form_Num_Val($this->income_offday, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->income_offday = NM_charset_to_utf8($this->income_offday);
         $this->income_offday = str_replace('<', '&lt;', $this->income_offday);
         $this->income_offday = str_replace('>', '&gt;', $this->income_offday);
         $this->Texto_tag .= "<td>" . $this->income_offday . "</td>\r\n";
   }
   //----- sal_sunday
   function NM_export_sal_sunday()
   {
             nmgp_Form_Num_Val($this->sal_sunday, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->sal_sunday = NM_charset_to_utf8($this->sal_sunday);
         $this->sal_sunday = str_replace('<', '&lt;', $this->sal_sunday);
         $this->sal_sunday = str_replace('>', '&gt;', $this->sal_sunday);
         $this->Texto_tag .= "<td>" . $this->sal_sunday . "</td>\r\n";
   }
   //----- sal_holiday
   function NM_export_sal_holiday()
   {
             nmgp_Form_Num_Val($this->sal_holiday, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->sal_holiday = NM_charset_to_utf8($this->sal_holiday);
         $this->sal_holiday = str_replace('<', '&lt;', $this->sal_holiday);
         $this->sal_holiday = str_replace('>', '&gt;', $this->sal_holiday);
         $this->Texto_tag .= "<td>" . $this->sal_holiday . "</td>\r\n";
   }
   //----- sal_leavetype
   function NM_export_sal_leavetype()
   {
             nmgp_Form_Num_Val($this->sal_leavetype, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->sal_leavetype = NM_charset_to_utf8($this->sal_leavetype);
         $this->sal_leavetype = str_replace('<', '&lt;', $this->sal_leavetype);
         $this->sal_leavetype = str_replace('>', '&gt;', $this->sal_leavetype);
         $this->Texto_tag .= "<td>" . $this->sal_leavetype . "</td>\r\n";
   }
   //----- sal_brut_reg
   function NM_export_sal_brut_reg()
   {
             nmgp_Form_Num_Val($this->sal_brut_reg, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         $this->sal_brut_reg = NM_charset_to_utf8($this->sal_brut_reg);
         $this->sal_brut_reg = str_replace('<', '&lt;', $this->sal_brut_reg);
         $this->sal_brut_reg = str_replace('>', '&gt;', $this->sal_brut_reg);
         $this->Texto_tag .= "<td>" . $this->sal_brut_reg . "</td>\r\n";
   }
   //----- income_workday_ot
   function NM_export_income_workday_ot()
   {
             nmgp_Form_Num_Val($this->income_workday_ot, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->income_workday_ot = NM_charset_to_utf8($this->income_workday_ot);
         $this->income_workday_ot = str_replace('<', '&lt;', $this->income_workday_ot);
         $this->income_workday_ot = str_replace('>', '&gt;', $this->income_workday_ot);
         $this->Texto_tag .= "<td>" . $this->income_workday_ot . "</td>\r\n";
   }
   //----- income_holiday_ot
   function NM_export_income_holiday_ot()
   {
             nmgp_Form_Num_Val($this->income_holiday_ot, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->income_holiday_ot = NM_charset_to_utf8($this->income_holiday_ot);
         $this->income_holiday_ot = str_replace('<', '&lt;', $this->income_holiday_ot);
         $this->income_holiday_ot = str_replace('>', '&gt;', $this->income_holiday_ot);
         $this->Texto_tag .= "<td>" . $this->income_holiday_ot . "</td>\r\n";
   }
   //----- income_restday_ot
   function NM_export_income_restday_ot()
   {
             nmgp_Form_Num_Val($this->income_restday_ot, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->income_restday_ot = NM_charset_to_utf8($this->income_restday_ot);
         $this->income_restday_ot = str_replace('<', '&lt;', $this->income_restday_ot);
         $this->income_restday_ot = str_replace('>', '&gt;', $this->income_restday_ot);
         $this->Texto_tag .= "<td>" . $this->income_restday_ot . "</td>\r\n";
   }
   //----- income_offday_ot
   function NM_export_income_offday_ot()
   {
             nmgp_Form_Num_Val($this->income_offday_ot, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->income_offday_ot = NM_charset_to_utf8($this->income_offday_ot);
         $this->income_offday_ot = str_replace('<', '&lt;', $this->income_offday_ot);
         $this->income_offday_ot = str_replace('>', '&gt;', $this->income_offday_ot);
         $this->Texto_tag .= "<td>" . $this->income_offday_ot . "</td>\r\n";
   }
   //----- incentive
   function NM_export_incentive()
   {
             nmgp_Form_Num_Val($this->incentive, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->incentive = NM_charset_to_utf8($this->incentive);
         $this->incentive = str_replace('<', '&lt;', $this->incentive);
         $this->incentive = str_replace('>', '&gt;', $this->incentive);
         $this->Texto_tag .= "<td>" . $this->incentive . "</td>\r\n";
   }
   //----- income_comm
   function NM_export_income_comm()
   {
             nmgp_Form_Num_Val($this->income_comm, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->income_comm = NM_charset_to_utf8($this->income_comm);
         $this->income_comm = str_replace('<', '&lt;', $this->income_comm);
         $this->income_comm = str_replace('>', '&gt;', $this->income_comm);
         $this->Texto_tag .= "<td>" . $this->income_comm . "</td>\r\n";
   }
   //----- rappel
   function NM_export_rappel()
   {
             nmgp_Form_Num_Val($this->rappel, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->rappel = NM_charset_to_utf8($this->rappel);
         $this->rappel = str_replace('<', '&lt;', $this->rappel);
         $this->rappel = str_replace('>', '&gt;', $this->rappel);
         $this->Texto_tag .= "<td>" . $this->rappel . "</td>\r\n";
   }
   //----- tax_cass
   function NM_export_tax_cass()
   {
             nmgp_Form_Num_Val($this->tax_cass, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->tax_cass = NM_charset_to_utf8($this->tax_cass);
         $this->tax_cass = str_replace('<', '&lt;', $this->tax_cass);
         $this->tax_cass = str_replace('>', '&gt;', $this->tax_cass);
         $this->Texto_tag .= "<td>" . $this->tax_cass . "</td>\r\n";
   }
   //----- tax_cfgdct
   function NM_export_tax_cfgdct()
   {
             nmgp_Form_Num_Val($this->tax_cfgdct, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->tax_cfgdct = NM_charset_to_utf8($this->tax_cfgdct);
         $this->tax_cfgdct = str_replace('<', '&lt;', $this->tax_cfgdct);
         $this->tax_cfgdct = str_replace('>', '&gt;', $this->tax_cfgdct);
         $this->Texto_tag .= "<td>" . $this->tax_cfgdct . "</td>\r\n";
   }
   //----- tax_fdu
   function NM_export_tax_fdu()
   {
             nmgp_Form_Num_Val($this->tax_fdu, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->tax_fdu = NM_charset_to_utf8($this->tax_fdu);
         $this->tax_fdu = str_replace('<', '&lt;', $this->tax_fdu);
         $this->tax_fdu = str_replace('>', '&gt;', $this->tax_fdu);
         $this->Texto_tag .= "<td>" . $this->tax_fdu . "</td>\r\n";
   }
   //----- tax_ona
   function NM_export_tax_ona()
   {
             nmgp_Form_Num_Val($this->tax_ona, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->tax_ona = NM_charset_to_utf8($this->tax_ona);
         $this->tax_ona = str_replace('<', '&lt;', $this->tax_ona);
         $this->tax_ona = str_replace('>', '&gt;', $this->tax_ona);
         $this->Texto_tag .= "<td>" . $this->tax_ona . "</td>\r\n";
   }
   //----- tax_iric
   function NM_export_tax_iric()
   {
             nmgp_Form_Num_Val($this->tax_iric, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->tax_iric = NM_charset_to_utf8($this->tax_iric);
         $this->tax_iric = str_replace('<', '&lt;', $this->tax_iric);
         $this->tax_iric = str_replace('>', '&gt;', $this->tax_iric);
         $this->Texto_tag .= "<td>" . $this->tax_iric . "</td>\r\n";
   }
   //----- dedeuct_cons
   function NM_export_dedeuct_cons()
   {
             nmgp_Form_Num_Val($this->dedeuct_cons, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         $this->dedeuct_cons = NM_charset_to_utf8($this->dedeuct_cons);
         $this->dedeuct_cons = str_replace('<', '&lt;', $this->dedeuct_cons);
         $this->dedeuct_cons = str_replace('>', '&gt;', $this->dedeuct_cons);
         $this->Texto_tag .= "<td>" . $this->dedeuct_cons . "</td>\r\n";
   }
   //----- loan_deduction
   function NM_export_loan_deduction()
   {
             nmgp_Form_Num_Val($this->loan_deduction, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         $this->loan_deduction = NM_charset_to_utf8($this->loan_deduction);
         $this->loan_deduction = str_replace('<', '&lt;', $this->loan_deduction);
         $this->loan_deduction = str_replace('>', '&gt;', $this->loan_deduction);
         $this->Texto_tag .= "<td>" . $this->loan_deduction . "</td>\r\n";
   }
   //----- loan_deduction_bank
   function NM_export_loan_deduction_bank()
   {
             nmgp_Form_Num_Val($this->loan_deduction_bank, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         $this->loan_deduction_bank = NM_charset_to_utf8($this->loan_deduction_bank);
         $this->loan_deduction_bank = str_replace('<', '&lt;', $this->loan_deduction_bank);
         $this->loan_deduction_bank = str_replace('>', '&gt;', $this->loan_deduction_bank);
         $this->Texto_tag .= "<td>" . $this->loan_deduction_bank . "</td>\r\n";
   }
   //----- other_deduct
   function NM_export_other_deduct()
   {
             nmgp_Form_Num_Val($this->other_deduct, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         $this->other_deduct = NM_charset_to_utf8($this->other_deduct);
         $this->other_deduct = str_replace('<', '&lt;', $this->other_deduct);
         $this->other_deduct = str_replace('>', '&gt;', $this->other_deduct);
         $this->Texto_tag .= "<td>" . $this->other_deduct . "</td>\r\n";
   }
   //----- total_deduct
   function NM_export_total_deduct()
   {
             nmgp_Form_Num_Val($this->total_deduct, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         $this->total_deduct = NM_charset_to_utf8($this->total_deduct);
         $this->total_deduct = str_replace('<', '&lt;', $this->total_deduct);
         $this->total_deduct = str_replace('>', '&gt;', $this->total_deduct);
         $this->Texto_tag .= "<td>" . $this->total_deduct . "</td>\r\n";
   }
   //----- sal_net
   function NM_export_sal_net()
   {
             nmgp_Form_Num_Val($this->sal_net, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->sal_net = NM_charset_to_utf8($this->sal_net);
         $this->sal_net = str_replace('<', '&lt;', $this->sal_net);
         $this->sal_net = str_replace('>', '&gt;', $this->sal_net);
         $this->Texto_tag .= "<td>" . $this->sal_net . "</td>\r\n";
   }
   //----- work_hh_w
   function NM_export_work_hh_w()
   {
             nmgp_Form_Num_Val($this->work_hh_w, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->work_hh_w = NM_charset_to_utf8($this->work_hh_w);
         $this->work_hh_w = str_replace('<', '&lt;', $this->work_hh_w);
         $this->work_hh_w = str_replace('>', '&gt;', $this->work_hh_w);
         $this->Texto_tag .= "<td>" . $this->work_hh_w . "</td>\r\n";
   }
   //----- ot_hh_w
   function NM_export_ot_hh_w()
   {
             nmgp_Form_Num_Val($this->ot_hh_w, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->ot_hh_w = NM_charset_to_utf8($this->ot_hh_w);
         $this->ot_hh_w = str_replace('<', '&lt;', $this->ot_hh_w);
         $this->ot_hh_w = str_replace('>', '&gt;', $this->ot_hh_w);
         $this->Texto_tag .= "<td>" . $this->ot_hh_w . "</td>\r\n";
   }
   //----- hh_sunday
   function NM_export_hh_sunday()
   {
             nmgp_Form_Num_Val($this->hh_sunday, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->hh_sunday = NM_charset_to_utf8($this->hh_sunday);
         $this->hh_sunday = str_replace('<', '&lt;', $this->hh_sunday);
         $this->hh_sunday = str_replace('>', '&gt;', $this->hh_sunday);
         $this->Texto_tag .= "<td>" . $this->hh_sunday . "</td>\r\n";
   }
   //----- work_hh_r
   function NM_export_work_hh_r()
   {
             nmgp_Form_Num_Val($this->work_hh_r, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->work_hh_r = NM_charset_to_utf8($this->work_hh_r);
         $this->work_hh_r = str_replace('<', '&lt;', $this->work_hh_r);
         $this->work_hh_r = str_replace('>', '&gt;', $this->work_hh_r);
         $this->Texto_tag .= "<td>" . $this->work_hh_r . "</td>\r\n";
   }
   //----- ot_hh_r
   function NM_export_ot_hh_r()
   {
             nmgp_Form_Num_Val($this->ot_hh_r, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->ot_hh_r = NM_charset_to_utf8($this->ot_hh_r);
         $this->ot_hh_r = str_replace('<', '&lt;', $this->ot_hh_r);
         $this->ot_hh_r = str_replace('>', '&gt;', $this->ot_hh_r);
         $this->Texto_tag .= "<td>" . $this->ot_hh_r . "</td>\r\n";
   }
   //----- hh_offday
   function NM_export_hh_offday()
   {
             nmgp_Form_Num_Val($this->hh_offday, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->hh_offday = NM_charset_to_utf8($this->hh_offday);
         $this->hh_offday = str_replace('<', '&lt;', $this->hh_offday);
         $this->hh_offday = str_replace('>', '&gt;', $this->hh_offday);
         $this->Texto_tag .= "<td>" . $this->hh_offday . "</td>\r\n";
   }
   //----- work_hh_h
   function NM_export_work_hh_h()
   {
             nmgp_Form_Num_Val($this->work_hh_h, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->work_hh_h = NM_charset_to_utf8($this->work_hh_h);
         $this->work_hh_h = str_replace('<', '&lt;', $this->work_hh_h);
         $this->work_hh_h = str_replace('>', '&gt;', $this->work_hh_h);
         $this->Texto_tag .= "<td>" . $this->work_hh_h . "</td>\r\n";
   }
   //----- ot_hh_h
   function NM_export_ot_hh_h()
   {
             nmgp_Form_Num_Val($this->ot_hh_h, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->ot_hh_h = NM_charset_to_utf8($this->ot_hh_h);
         $this->ot_hh_h = str_replace('<', '&lt;', $this->ot_hh_h);
         $this->ot_hh_h = str_replace('>', '&gt;', $this->ot_hh_h);
         $this->Texto_tag .= "<td>" . $this->ot_hh_h . "</td>\r\n";
   }
   //----- sal_hr_worked
   function NM_export_sal_hr_worked()
   {
             nmgp_Form_Num_Val($this->sal_hr_worked, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->sal_hr_worked = NM_charset_to_utf8($this->sal_hr_worked);
         $this->sal_hr_worked = str_replace('<', '&lt;', $this->sal_hr_worked);
         $this->sal_hr_worked = str_replace('>', '&gt;', $this->sal_hr_worked);
         $this->Texto_tag .= "<td>" . $this->sal_hr_worked . "</td>\r\n";
   }
   //----- sal_sunday_1
   function NM_export_sal_sunday_1()
   {
             nmgp_Form_Num_Val($this->sal_sunday_1, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->sal_sunday_1 = NM_charset_to_utf8($this->sal_sunday_1);
         $this->sal_sunday_1 = str_replace('<', '&lt;', $this->sal_sunday_1);
         $this->sal_sunday_1 = str_replace('>', '&gt;', $this->sal_sunday_1);
         $this->Texto_tag .= "<td>" . $this->sal_sunday_1 . "</td>\r\n";
   }
   //----- sal_holiday_1
   function NM_export_sal_holiday_1()
   {
             nmgp_Form_Num_Val($this->sal_holiday_1, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->sal_holiday_1 = NM_charset_to_utf8($this->sal_holiday_1);
         $this->sal_holiday_1 = str_replace('<', '&lt;', $this->sal_holiday_1);
         $this->sal_holiday_1 = str_replace('>', '&gt;', $this->sal_holiday_1);
         $this->Texto_tag .= "<td>" . $this->sal_holiday_1 . "</td>\r\n";
   }
   //----- sal_brut_reg_1
   function NM_export_sal_brut_reg_1()
   {
             nmgp_Form_Num_Val($this->sal_brut_reg_1, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->sal_brut_reg_1 = NM_charset_to_utf8($this->sal_brut_reg_1);
         $this->sal_brut_reg_1 = str_replace('<', '&lt;', $this->sal_brut_reg_1);
         $this->sal_brut_reg_1 = str_replace('>', '&gt;', $this->sal_brut_reg_1);
         $this->Texto_tag .= "<td>" . $this->sal_brut_reg_1 . "</td>\r\n";
   }
   //----- sal_suppl
   function NM_export_sal_suppl()
   {
             nmgp_Form_Num_Val($this->sal_suppl, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->sal_suppl = NM_charset_to_utf8($this->sal_suppl);
         $this->sal_suppl = str_replace('<', '&lt;', $this->sal_suppl);
         $this->sal_suppl = str_replace('>', '&gt;', $this->sal_suppl);
         $this->Texto_tag .= "<td>" . $this->sal_suppl . "</td>\r\n";
   }
   //----- sal_holiday_worked_suppl
   function NM_export_sal_holiday_worked_suppl()
   {
             nmgp_Form_Num_Val($this->sal_holiday_worked_suppl, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->sal_holiday_worked_suppl = NM_charset_to_utf8($this->sal_holiday_worked_suppl);
         $this->sal_holiday_worked_suppl = str_replace('<', '&lt;', $this->sal_holiday_worked_suppl);
         $this->sal_holiday_worked_suppl = str_replace('>', '&gt;', $this->sal_holiday_worked_suppl);
         $this->Texto_tag .= "<td>" . $this->sal_holiday_worked_suppl . "</td>\r\n";
   }
   //----- sal_holiday_suppl
   function NM_export_sal_holiday_suppl()
   {
             nmgp_Form_Num_Val($this->sal_holiday_suppl, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->sal_holiday_suppl = NM_charset_to_utf8($this->sal_holiday_suppl);
         $this->sal_holiday_suppl = str_replace('<', '&lt;', $this->sal_holiday_suppl);
         $this->sal_holiday_suppl = str_replace('>', '&gt;', $this->sal_holiday_suppl);
         $this->Texto_tag .= "<td>" . $this->sal_holiday_suppl . "</td>\r\n";
   }
   //----- sal_restday_worked_suppl
   function NM_export_sal_restday_worked_suppl()
   {
             nmgp_Form_Num_Val($this->sal_restday_worked_suppl, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->sal_restday_worked_suppl = NM_charset_to_utf8($this->sal_restday_worked_suppl);
         $this->sal_restday_worked_suppl = str_replace('<', '&lt;', $this->sal_restday_worked_suppl);
         $this->sal_restday_worked_suppl = str_replace('>', '&gt;', $this->sal_restday_worked_suppl);
         $this->Texto_tag .= "<td>" . $this->sal_restday_worked_suppl . "</td>\r\n";
   }
   //----- sal_restday_suppl
   function NM_export_sal_restday_suppl()
   {
             nmgp_Form_Num_Val($this->sal_restday_suppl, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->sal_restday_suppl = NM_charset_to_utf8($this->sal_restday_suppl);
         $this->sal_restday_suppl = str_replace('<', '&lt;', $this->sal_restday_suppl);
         $this->sal_restday_suppl = str_replace('>', '&gt;', $this->sal_restday_suppl);
         $this->Texto_tag .= "<td>" . $this->sal_restday_suppl . "</td>\r\n";
   }
   //----- tax_iris
   function NM_export_tax_iris()
   {
             nmgp_Form_Num_Val($this->tax_iris, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         $this->tax_iris = NM_charset_to_utf8($this->tax_iris);
         $this->tax_iris = str_replace('<', '&lt;', $this->tax_iris);
         $this->tax_iris = str_replace('>', '&gt;', $this->tax_iris);
         $this->Texto_tag .= "<td>" . $this->tax_iris . "</td>\r\n";
   }
   //----- day_cons
   function NM_export_day_cons()
   {
             nmgp_Form_Num_Val($this->day_cons, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->day_cons = NM_charset_to_utf8($this->day_cons);
         $this->day_cons = str_replace('<', '&lt;', $this->day_cons);
         $this->day_cons = str_replace('>', '&gt;', $this->day_cons);
         $this->Texto_tag .= "<td>" . $this->day_cons . "</td>\r\n";
   }
   //----- rate_cons
   function NM_export_rate_cons()
   {
             nmgp_Form_Num_Val($this->rate_cons, ",", ".", "2", "S", "2", "HTG", "V:3:1", "-"); 
         $this->rate_cons = NM_charset_to_utf8($this->rate_cons);
         $this->rate_cons = str_replace('<', '&lt;', $this->rate_cons);
         $this->rate_cons = str_replace('>', '&gt;', $this->rate_cons);
         $this->Texto_tag .= "<td>" . $this->rate_cons . "</td>\r\n";
   }
   //----- other_loan_deduction
   function NM_export_other_loan_deduction()
   {
             nmgp_Form_Num_Val($this->other_loan_deduction, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         $this->other_loan_deduction = NM_charset_to_utf8($this->other_loan_deduction);
         $this->other_loan_deduction = str_replace('<', '&lt;', $this->other_loan_deduction);
         $this->other_loan_deduction = str_replace('>', '&gt;', $this->other_loan_deduction);
         $this->Texto_tag .= "<td>" . $this->other_loan_deduction . "</td>\r\n";
   }
   //----- other_deduct_1
   function NM_export_other_deduct_1()
   {
             nmgp_Form_Num_Val($this->other_deduct_1, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->other_deduct_1 = NM_charset_to_utf8($this->other_deduct_1);
         $this->other_deduct_1 = str_replace('<', '&lt;', $this->other_deduct_1);
         $this->other_deduct_1 = str_replace('>', '&gt;', $this->other_deduct_1);
         $this->Texto_tag .= "<td>" . $this->other_deduct_1 . "</td>\r\n";
   }
   //----- other_deduct_desc
   function NM_export_other_deduct_desc()
   {
         $this->other_deduct_desc = html_entity_decode($this->other_deduct_desc, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->other_deduct_desc = strip_tags($this->other_deduct_desc);
         $this->other_deduct_desc = NM_charset_to_utf8($this->other_deduct_desc);
         $this->other_deduct_desc = str_replace('<', '&lt;', $this->other_deduct_desc);
         $this->other_deduct_desc = str_replace('>', '&gt;', $this->other_deduct_desc);
         $this->Texto_tag .= "<td>" . $this->other_deduct_desc . "</td>\r\n";
   }
   //----- bank_number
   function NM_export_bank_number()
   {
         $this->bank_number = html_entity_decode($this->bank_number, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->bank_number = strip_tags($this->bank_number);
         $this->bank_number = NM_charset_to_utf8($this->bank_number);
         $this->bank_number = str_replace('<', '&lt;', $this->bank_number);
         $this->bank_number = str_replace('>', '&gt;', $this->bank_number);
         $this->Texto_tag .= "<td>" . $this->bank_number . "</td>\r\n";
   }
   //----- pay_startdate
   function NM_export_pay_startdate()
   {
             $conteudo_x =  $this->pay_startdate;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->pay_startdate, "YYYY-MM-DD  ");
                 $this->pay_startdate = $this->nm_data->FormataSaida("d F Y");
             } 
         $this->pay_startdate = NM_charset_to_utf8($this->pay_startdate);
         $this->pay_startdate = str_replace('<', '&lt;', $this->pay_startdate);
         $this->pay_startdate = str_replace('>', '&gt;', $this->pay_startdate);
         $this->Texto_tag .= "<td>" . $this->pay_startdate . "</td>\r\n";
   }
   //----- pay_enddate
   function NM_export_pay_enddate()
   {
             $conteudo_x =  $this->pay_enddate;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->pay_enddate, "YYYY-MM-DD  ");
                 $this->pay_enddate = $this->nm_data->FormataSaida("d F Y");
             } 
         $this->pay_enddate = NM_charset_to_utf8($this->pay_enddate);
         $this->pay_enddate = str_replace('<', '&lt;', $this->pay_enddate);
         $this->pay_enddate = str_replace('>', '&gt;', $this->pay_enddate);
         $this->Texto_tag .= "<td>" . $this->pay_enddate . "</td>\r\n";
   }
   //----- work_hh_w_pm
   function NM_export_work_hh_w_pm()
   {
             nmgp_Form_Num_Val($this->work_hh_w_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->work_hh_w_pm = NM_charset_to_utf8($this->work_hh_w_pm);
         $this->work_hh_w_pm = str_replace('<', '&lt;', $this->work_hh_w_pm);
         $this->work_hh_w_pm = str_replace('>', '&gt;', $this->work_hh_w_pm);
         $this->Texto_tag .= "<td>" . $this->work_hh_w_pm . "</td>\r\n";
   }
   //----- ot_hh_w_pm
   function NM_export_ot_hh_w_pm()
   {
             nmgp_Form_Num_Val($this->ot_hh_w_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->ot_hh_w_pm = NM_charset_to_utf8($this->ot_hh_w_pm);
         $this->ot_hh_w_pm = str_replace('<', '&lt;', $this->ot_hh_w_pm);
         $this->ot_hh_w_pm = str_replace('>', '&gt;', $this->ot_hh_w_pm);
         $this->Texto_tag .= "<td>" . $this->ot_hh_w_pm . "</td>\r\n";
   }
   //----- work_hh_h_pm
   function NM_export_work_hh_h_pm()
   {
             nmgp_Form_Num_Val($this->work_hh_h_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->work_hh_h_pm = NM_charset_to_utf8($this->work_hh_h_pm);
         $this->work_hh_h_pm = str_replace('<', '&lt;', $this->work_hh_h_pm);
         $this->work_hh_h_pm = str_replace('>', '&gt;', $this->work_hh_h_pm);
         $this->Texto_tag .= "<td>" . $this->work_hh_h_pm . "</td>\r\n";
   }
   //----- ot_hh_h_pm
   function NM_export_ot_hh_h_pm()
   {
             nmgp_Form_Num_Val($this->ot_hh_h_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->ot_hh_h_pm = NM_charset_to_utf8($this->ot_hh_h_pm);
         $this->ot_hh_h_pm = str_replace('<', '&lt;', $this->ot_hh_h_pm);
         $this->ot_hh_h_pm = str_replace('>', '&gt;', $this->ot_hh_h_pm);
         $this->Texto_tag .= "<td>" . $this->ot_hh_h_pm . "</td>\r\n";
   }
   //----- work_hh_r_pm
   function NM_export_work_hh_r_pm()
   {
             nmgp_Form_Num_Val($this->work_hh_r_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->work_hh_r_pm = NM_charset_to_utf8($this->work_hh_r_pm);
         $this->work_hh_r_pm = str_replace('<', '&lt;', $this->work_hh_r_pm);
         $this->work_hh_r_pm = str_replace('>', '&gt;', $this->work_hh_r_pm);
         $this->Texto_tag .= "<td>" . $this->work_hh_r_pm . "</td>\r\n";
   }
   //----- ot_hh_r_pm
   function NM_export_ot_hh_r_pm()
   {
             nmgp_Form_Num_Val($this->ot_hh_r_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->ot_hh_r_pm = NM_charset_to_utf8($this->ot_hh_r_pm);
         $this->ot_hh_r_pm = str_replace('<', '&lt;', $this->ot_hh_r_pm);
         $this->ot_hh_r_pm = str_replace('>', '&gt;', $this->ot_hh_r_pm);
         $this->Texto_tag .= "<td>" . $this->ot_hh_r_pm . "</td>\r\n";
   }
   //----- work_hh_o
   function NM_export_work_hh_o()
   {
             nmgp_Form_Num_Val($this->work_hh_o, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->work_hh_o = NM_charset_to_utf8($this->work_hh_o);
         $this->work_hh_o = str_replace('<', '&lt;', $this->work_hh_o);
         $this->work_hh_o = str_replace('>', '&gt;', $this->work_hh_o);
         $this->Texto_tag .= "<td>" . $this->work_hh_o . "</td>\r\n";
   }
   //----- work_hh_o_pm
   function NM_export_work_hh_o_pm()
   {
             nmgp_Form_Num_Val($this->work_hh_o_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->work_hh_o_pm = NM_charset_to_utf8($this->work_hh_o_pm);
         $this->work_hh_o_pm = str_replace('<', '&lt;', $this->work_hh_o_pm);
         $this->work_hh_o_pm = str_replace('>', '&gt;', $this->work_hh_o_pm);
         $this->Texto_tag .= "<td>" . $this->work_hh_o_pm . "</td>\r\n";
   }
   //----- ot_hh_o
   function NM_export_ot_hh_o()
   {
             nmgp_Form_Num_Val($this->ot_hh_o, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->ot_hh_o = NM_charset_to_utf8($this->ot_hh_o);
         $this->ot_hh_o = str_replace('<', '&lt;', $this->ot_hh_o);
         $this->ot_hh_o = str_replace('>', '&gt;', $this->ot_hh_o);
         $this->Texto_tag .= "<td>" . $this->ot_hh_o . "</td>\r\n";
   }
   //----- ot_hh_o_pm
   function NM_export_ot_hh_o_pm()
   {
             nmgp_Form_Num_Val($this->ot_hh_o_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->ot_hh_o_pm = NM_charset_to_utf8($this->ot_hh_o_pm);
         $this->ot_hh_o_pm = str_replace('<', '&lt;', $this->ot_hh_o_pm);
         $this->ot_hh_o_pm = str_replace('>', '&gt;', $this->ot_hh_o_pm);
         $this->Texto_tag .= "<td>" . $this->ot_hh_o_pm . "</td>\r\n";
   }
   //----- hh_leavetype
   function NM_export_hh_leavetype()
   {
             nmgp_Form_Num_Val($this->hh_leavetype, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->hh_leavetype = NM_charset_to_utf8($this->hh_leavetype);
         $this->hh_leavetype = str_replace('<', '&lt;', $this->hh_leavetype);
         $this->hh_leavetype = str_replace('>', '&gt;', $this->hh_leavetype);
         $this->Texto_tag .= "<td>" . $this->hh_leavetype . "</td>\r\n";
   }
   //----- amount
   function NM_export_amount()
   {
             if ($this->amount !== "&nbsp;") 
             { 
                 $this->amount = sc_strtoupper($this->amount); 
             } 
             if ($this->amount !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->amount, "AMOUNT"); 
             } 
         $this->amount = html_entity_decode($this->amount, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->amount = NM_charset_to_utf8($this->amount);
         $this->amount = str_replace('<', '&lt;', $this->amount);
         $this->amount = str_replace('>', '&gt;', $this->amount);
         $this->Texto_tag .= "<td>" . $this->amount . "</td>\r\n";
   }
   //----- sc_field_0
   function NM_export_sc_field_0()
   {
             if ($this->sc_field_0 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_0, "AM"); 
             } 
         $this->sc_field_0 = html_entity_decode($this->sc_field_0, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_0 = NM_charset_to_utf8($this->sc_field_0);
         $this->sc_field_0 = str_replace('<', '&lt;', $this->sc_field_0);
         $this->sc_field_0 = str_replace('>', '&gt;', $this->sc_field_0);
         $this->Texto_tag .= "<td>" . $this->sc_field_0 . "</td>\r\n";
   }
   //----- sc_field_1
   function NM_export_sc_field_1()
   {
             if ($this->sc_field_1 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_1, "PM"); 
             } 
         $this->sc_field_1 = html_entity_decode($this->sc_field_1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_1 = NM_charset_to_utf8($this->sc_field_1);
         $this->sc_field_1 = str_replace('<', '&lt;', $this->sc_field_1);
         $this->sc_field_1 = str_replace('>', '&gt;', $this->sc_field_1);
         $this->Texto_tag .= "<td>" . $this->sc_field_1 . "</td>\r\n";
   }
   //----- sc_field_2
   function NM_export_sc_field_2()
   {
             if ($this->sc_field_2 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_2, "Deduct. Loan ONA"); 
             } 
         $this->sc_field_2 = html_entity_decode($this->sc_field_2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_2 = NM_charset_to_utf8($this->sc_field_2);
         $this->sc_field_2 = str_replace('<', '&lt;', $this->sc_field_2);
         $this->sc_field_2 = str_replace('>', '&gt;', $this->sc_field_2);
         $this->Texto_tag .= "<td>" . $this->sc_field_2 . "</td>\r\n";
   }
   //----- sc_field_3
   function NM_export_sc_field_3()
   {
             if ($this->sc_field_3 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_3, "Deduct. Loan Ent"); 
             } 
         $this->sc_field_3 = html_entity_decode($this->sc_field_3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_3 = NM_charset_to_utf8($this->sc_field_3);
         $this->sc_field_3 = str_replace('<', '&lt;', $this->sc_field_3);
         $this->sc_field_3 = str_replace('>', '&gt;', $this->sc_field_3);
         $this->Texto_tag .= "<td>" . $this->sc_field_3 . "</td>\r\n";
   }
   //----- sc_field_4
   function NM_export_sc_field_4()
   {
             if ($this->sc_field_4 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_4, "Deduct. Meal"); 
             } 
         $this->sc_field_4 = html_entity_decode($this->sc_field_4, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_4 = NM_charset_to_utf8($this->sc_field_4);
         $this->sc_field_4 = str_replace('<', '&lt;', $this->sc_field_4);
         $this->sc_field_4 = str_replace('>', '&gt;', $this->sc_field_4);
         $this->Texto_tag .= "<td>" . $this->sc_field_4 . "</td>\r\n";
   }
   //----- sc_field_5
   function NM_export_sc_field_5()
   {
             if ($this->sc_field_5 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_5, "Deduct. Other"); 
             } 
         $this->sc_field_5 = html_entity_decode($this->sc_field_5, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_5 = NM_charset_to_utf8($this->sc_field_5);
         $this->sc_field_5 = str_replace('<', '&lt;', $this->sc_field_5);
         $this->sc_field_5 = str_replace('>', '&gt;', $this->sc_field_5);
         $this->Texto_tag .= "<td>" . $this->sc_field_5 . "</td>\r\n";
   }
   //----- deductions
   function NM_export_deductions()
   {
             if ($this->deductions !== "&nbsp;") 
             { 
                 $this->deductions = sc_strtoupper($this->deductions); 
             } 
             if ($this->deductions !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->deductions, "DEDUCTIONS"); 
             } 
         $this->deductions = html_entity_decode($this->deductions, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->deductions = NM_charset_to_utf8($this->deductions);
         $this->deductions = str_replace('<', '&lt;', $this->deductions);
         $this->deductions = str_replace('>', '&gt;', $this->deductions);
         $this->Texto_tag .= "<td>" . $this->deductions . "</td>\r\n";
   }
   //----- sc_field_6
   function NM_export_sc_field_6()
   {
             if ($this->sc_field_6 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_6, "EMPLOYEE NAME"); 
             } 
         $this->sc_field_6 = html_entity_decode($this->sc_field_6, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_6 = NM_charset_to_utf8($this->sc_field_6);
         $this->sc_field_6 = str_replace('<', '&lt;', $this->sc_field_6);
         $this->sc_field_6 = str_replace('>', '&gt;', $this->sc_field_6);
         $this->Texto_tag .= "<td>" . $this->sc_field_6 . "</td>\r\n";
   }
   //----- sc_field_7
   function NM_export_sc_field_7()
   {
             if ($this->sc_field_7 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_7, "ID"); 
             } 
         $this->sc_field_7 = html_entity_decode($this->sc_field_7, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_7 = NM_charset_to_utf8($this->sc_field_7);
         $this->sc_field_7 = str_replace('<', '&lt;', $this->sc_field_7);
         $this->sc_field_7 = str_replace('>', '&gt;', $this->sc_field_7);
         $this->Texto_tag .= "<td>" . $this->sc_field_7 . "</td>\r\n";
   }
   //----- irisal
   function NM_export_irisal()
   {
             if ($this->irisal !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->irisal, "IRI/Sal"); 
             } 
         $this->irisal = html_entity_decode($this->irisal, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->irisal = NM_charset_to_utf8($this->irisal);
         $this->irisal = str_replace('<', '&lt;', $this->irisal);
         $this->irisal = str_replace('>', '&gt;', $this->irisal);
         $this->Texto_tag .= "<td>" . $this->irisal . "</td>\r\n";
   }
   //----- incentive_lbl
   function NM_export_incentive_lbl()
   {
             if ($this->incentive_lbl !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->incentive_lbl, "Extra"); 
             } 
         $this->incentive_lbl = html_entity_decode($this->incentive_lbl, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->incentive_lbl = NM_charset_to_utf8($this->incentive_lbl);
         $this->incentive_lbl = str_replace('<', '&lt;', $this->incentive_lbl);
         $this->incentive_lbl = str_replace('>', '&gt;', $this->incentive_lbl);
         $this->Texto_tag .= "<td>" . $this->incentive_lbl . "</td>\r\n";
   }
   //----- sc_field_8
   function NM_export_sc_field_8()
   {
             if ($this->sc_field_8 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_8, "NET EARNINGS"); 
             } 
         $this->sc_field_8 = html_entity_decode($this->sc_field_8, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_8 = NM_charset_to_utf8($this->sc_field_8);
         $this->sc_field_8 = str_replace('<', '&lt;', $this->sc_field_8);
         $this->sc_field_8 = str_replace('>', '&gt;', $this->sc_field_8);
         $this->Texto_tag .= "<td>" . $this->sc_field_8 . "</td>\r\n";
   }
   //----- ona
   function NM_export_ona()
   {
             if ($this->ona !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->ona, "ONA"); 
             } 
         $this->ona = html_entity_decode($this->ona, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ona = NM_charset_to_utf8($this->ona);
         $this->ona = str_replace('<', '&lt;', $this->ona);
         $this->ona = str_replace('>', '&gt;', $this->ona);
         $this->Texto_tag .= "<td>" . $this->ona . "</td>\r\n";
   }
   //----- sc_field_9
   function NM_export_sc_field_9()
   {
             if ($this->sc_field_9 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_9, "OT AM"); 
             } 
         $this->sc_field_9 = html_entity_decode($this->sc_field_9, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_9 = NM_charset_to_utf8($this->sc_field_9);
         $this->sc_field_9 = str_replace('<', '&lt;', $this->sc_field_9);
         $this->sc_field_9 = str_replace('>', '&gt;', $this->sc_field_9);
         $this->Texto_tag .= "<td>" . $this->sc_field_9 . "</td>\r\n";
   }
   //----- sc_field_10
   function NM_export_sc_field_10()
   {
             if ($this->sc_field_10 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_10, "OT PM"); 
             } 
         $this->sc_field_10 = html_entity_decode($this->sc_field_10, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_10 = NM_charset_to_utf8($this->sc_field_10);
         $this->sc_field_10 = str_replace('<', '&lt;', $this->sc_field_10);
         $this->sc_field_10 = str_replace('>', '&gt;', $this->sc_field_10);
         $this->Texto_tag .= "<td>" . $this->sc_field_10 . "</td>\r\n";
   }
   //----- sc_field_11
   function NM_export_sc_field_11()
   {
             if ($this->sc_field_11 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_11, "Pay From"); 
             } 
         $this->sc_field_11 = html_entity_decode($this->sc_field_11, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_11 = NM_charset_to_utf8($this->sc_field_11);
         $this->sc_field_11 = str_replace('<', '&lt;', $this->sc_field_11);
         $this->sc_field_11 = str_replace('>', '&gt;', $this->sc_field_11);
         $this->Texto_tag .= "<td>" . $this->sc_field_11 . "</td>\r\n";
   }
   //----- sc_field_12
   function NM_export_sc_field_12()
   {
             if ($this->sc_field_12 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_12, "Pay To"); 
             } 
         $this->sc_field_12 = html_entity_decode($this->sc_field_12, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_12 = NM_charset_to_utf8($this->sc_field_12);
         $this->sc_field_12 = str_replace('<', '&lt;', $this->sc_field_12);
         $this->sc_field_12 = str_replace('>', '&gt;', $this->sc_field_12);
         $this->Texto_tag .= "<td>" . $this->sc_field_12 . "</td>\r\n";
   }
   //----- sc_field_13
   function NM_export_sc_field_13()
   {
             if ($this->sc_field_13 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_13, "Miscellaneous"); 
             } 
         $this->sc_field_13 = html_entity_decode($this->sc_field_13, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_13 = NM_charset_to_utf8($this->sc_field_13);
         $this->sc_field_13 = str_replace('<', '&lt;', $this->sc_field_13);
         $this->sc_field_13 = str_replace('>', '&gt;', $this->sc_field_13);
         $this->Texto_tag .= "<td>" . $this->sc_field_13 . "</td>\r\n";
   }
   //----- sc_field_14
   function NM_export_sc_field_14()
   {
             if ($this->sc_field_14 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_14, "Sal. Holiday OT"); 
             } 
         $this->sc_field_14 = html_entity_decode($this->sc_field_14, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_14 = NM_charset_to_utf8($this->sc_field_14);
         $this->sc_field_14 = str_replace('<', '&lt;', $this->sc_field_14);
         $this->sc_field_14 = str_replace('>', '&gt;', $this->sc_field_14);
         $this->Texto_tag .= "<td>" . $this->sc_field_14 . "</td>\r\n";
   }
   //----- sc_field_15
   function NM_export_sc_field_15()
   {
             if ($this->sc_field_15 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_15, "Sal. Offday OT"); 
             } 
         $this->sc_field_15 = html_entity_decode($this->sc_field_15, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_15 = NM_charset_to_utf8($this->sc_field_15);
         $this->sc_field_15 = str_replace('<', '&lt;', $this->sc_field_15);
         $this->sc_field_15 = str_replace('>', '&gt;', $this->sc_field_15);
         $this->Texto_tag .= "<td>" . $this->sc_field_15 . "</td>\r\n";
   }
   //----- sc_field_16
   function NM_export_sc_field_16()
   {
             if ($this->sc_field_16 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_16, "Sal. Restday OT"); 
             } 
         $this->sc_field_16 = html_entity_decode($this->sc_field_16, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_16 = NM_charset_to_utf8($this->sc_field_16);
         $this->sc_field_16 = str_replace('<', '&lt;', $this->sc_field_16);
         $this->sc_field_16 = str_replace('>', '&gt;', $this->sc_field_16);
         $this->Texto_tag .= "<td>" . $this->sc_field_16 . "</td>\r\n";
   }
   //----- sc_field_17
   function NM_export_sc_field_17()
   {
             if ($this->sc_field_17 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_17, "Sal. Workday OT"); 
             } 
         $this->sc_field_17 = html_entity_decode($this->sc_field_17, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_17 = NM_charset_to_utf8($this->sc_field_17);
         $this->sc_field_17 = str_replace('<', '&lt;', $this->sc_field_17);
         $this->sc_field_17 = str_replace('>', '&gt;', $this->sc_field_17);
         $this->Texto_tag .= "<td>" . $this->sc_field_17 . "</td>\r\n";
   }
   //----- sc_field_18
   function NM_export_sc_field_18()
   {
             if ($this->sc_field_18 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_18, "TCA Add"); 
             } 
         $this->sc_field_18 = html_entity_decode($this->sc_field_18, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_18 = NM_charset_to_utf8($this->sc_field_18);
         $this->sc_field_18 = str_replace('<', '&lt;', $this->sc_field_18);
         $this->sc_field_18 = str_replace('>', '&gt;', $this->sc_field_18);
         $this->Texto_tag .= "<td>" . $this->sc_field_18 . "</td>\r\n";
   }
   //----- sc_field_19
   function NM_export_sc_field_19()
   {
             if ($this->sc_field_19 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_19, "Total Sal. Add"); 
             } 
         $this->sc_field_19 = html_entity_decode($this->sc_field_19, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_19 = NM_charset_to_utf8($this->sc_field_19);
         $this->sc_field_19 = str_replace('<', '&lt;', $this->sc_field_19);
         $this->sc_field_19 = str_replace('>', '&gt;', $this->sc_field_19);
         $this->Texto_tag .= "<td>" . $this->sc_field_19 . "</td>\r\n";
   }
   //----- sc_field_20
   function NM_export_sc_field_20()
   {
             if ($this->sc_field_20 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_20, "Total Deductions"); 
             } 
         $this->sc_field_20 = html_entity_decode($this->sc_field_20, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_20 = NM_charset_to_utf8($this->sc_field_20);
         $this->sc_field_20 = str_replace('<', '&lt;', $this->sc_field_20);
         $this->sc_field_20 = str_replace('>', '&gt;', $this->sc_field_20);
         $this->Texto_tag .= "<td>" . $this->sc_field_20 . "</td>\r\n";
   }
   //----- sc_field_21
   function NM_export_sc_field_21()
   {
             if ($this->sc_field_21 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_21, "Workday"); 
             } 
         $this->sc_field_21 = html_entity_decode($this->sc_field_21, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_21 = NM_charset_to_utf8($this->sc_field_21);
         $this->sc_field_21 = str_replace('<', '&lt;', $this->sc_field_21);
         $this->sc_field_21 = str_replace('>', '&gt;', $this->sc_field_21);
         $this->Texto_tag .= "<td>" . $this->sc_field_21 . "</td>\r\n";
   }
   //----- lbl_holiday
   function NM_export_lbl_holiday()
   {
             if ($this->lbl_holiday !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_holiday, "Holiday"); 
             } 
         $this->lbl_holiday = html_entity_decode($this->lbl_holiday, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_holiday = NM_charset_to_utf8($this->lbl_holiday);
         $this->lbl_holiday = str_replace('<', '&lt;', $this->lbl_holiday);
         $this->lbl_holiday = str_replace('>', '&gt;', $this->lbl_holiday);
         $this->Texto_tag .= "<td>" . $this->lbl_holiday . "</td>\r\n";
   }
   //----- sc_field_22
   function NM_export_sc_field_22()
   {
             if ($this->sc_field_22 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->sc_field_22, "Holiday Earned"); 
             } 
         $this->sc_field_22 = html_entity_decode($this->sc_field_22, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sc_field_22 = NM_charset_to_utf8($this->sc_field_22);
         $this->sc_field_22 = str_replace('<', '&lt;', $this->sc_field_22);
         $this->sc_field_22 = str_replace('>', '&gt;', $this->sc_field_22);
         $this->Texto_tag .= "<td>" . $this->sc_field_22 . "</td>\r\n";
   }
   //----- lbl_holidayhh
   function NM_export_lbl_holidayhh()
   {
             if ($this->lbl_holidayhh !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_holidayhh, "Holiday"); 
             } 
         $this->lbl_holidayhh = html_entity_decode($this->lbl_holidayhh, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_holidayhh = NM_charset_to_utf8($this->lbl_holidayhh);
         $this->lbl_holidayhh = str_replace('<', '&lt;', $this->lbl_holidayhh);
         $this->lbl_holidayhh = str_replace('>', '&gt;', $this->lbl_holidayhh);
         $this->Texto_tag .= "<td>" . $this->lbl_holidayhh . "</td>\r\n";
   }
   //----- lbl_hourearned
   function NM_export_lbl_hourearned()
   {
             if ($this->lbl_hourearned !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_hourearned, "Hour Earned"); 
             } 
         $this->lbl_hourearned = html_entity_decode($this->lbl_hourearned, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_hourearned = NM_charset_to_utf8($this->lbl_hourearned);
         $this->lbl_hourearned = str_replace('<', '&lt;', $this->lbl_hourearned);
         $this->lbl_hourearned = str_replace('>', '&gt;', $this->lbl_hourearned);
         $this->Texto_tag .= "<td>" . $this->lbl_hourearned . "</td>\r\n";
   }
   //----- lbl_leavetypebenefits
   function NM_export_lbl_leavetypebenefits()
   {
             if ($this->lbl_leavetypebenefits !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_leavetypebenefits, "Leave Earned"); 
             } 
         $this->lbl_leavetypebenefits = html_entity_decode($this->lbl_leavetypebenefits, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_leavetypebenefits = NM_charset_to_utf8($this->lbl_leavetypebenefits);
         $this->lbl_leavetypebenefits = str_replace('<', '&lt;', $this->lbl_leavetypebenefits);
         $this->lbl_leavetypebenefits = str_replace('>', '&gt;', $this->lbl_leavetypebenefits);
         $this->Texto_tag .= "<td>" . $this->lbl_leavetypebenefits . "</td>\r\n";
   }
   //----- lbl_mealrate
   function NM_export_lbl_mealrate()
   {
             if ($this->lbl_mealrate !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_mealrate, "Meal Rate"); 
             } 
         $this->lbl_mealrate = html_entity_decode($this->lbl_mealrate, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_mealrate = NM_charset_to_utf8($this->lbl_mealrate);
         $this->lbl_mealrate = str_replace('<', '&lt;', $this->lbl_mealrate);
         $this->lbl_mealrate = str_replace('>', '&gt;', $this->lbl_mealrate);
         $this->Texto_tag .= "<td>" . $this->lbl_mealrate . "</td>\r\n";
   }
   //----- lbl_mealday
   function NM_export_lbl_mealday()
   {
             if ($this->lbl_mealday !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_mealday, "Meal Day"); 
             } 
         $this->lbl_mealday = html_entity_decode($this->lbl_mealday, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_mealday = NM_charset_to_utf8($this->lbl_mealday);
         $this->lbl_mealday = str_replace('<', '&lt;', $this->lbl_mealday);
         $this->lbl_mealday = str_replace('>', '&gt;', $this->lbl_mealday);
         $this->Texto_tag .= "<td>" . $this->lbl_mealday . "</td>\r\n";
   }
   //----- lbl_ratework
   function NM_export_lbl_ratework()
   {
             if ($this->lbl_ratework !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_ratework, "Rate Work"); 
             } 
         $this->lbl_ratework = html_entity_decode($this->lbl_ratework, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_ratework = NM_charset_to_utf8($this->lbl_ratework);
         $this->lbl_ratework = str_replace('<', '&lt;', $this->lbl_ratework);
         $this->lbl_ratework = str_replace('>', '&gt;', $this->lbl_ratework);
         $this->Texto_tag .= "<td>" . $this->lbl_ratework . "</td>\r\n";
   }
   //----- lbl_restday
   function NM_export_lbl_restday()
   {
             if ($this->lbl_restday !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_restday, "Restday"); 
             } 
         $this->lbl_restday = html_entity_decode($this->lbl_restday, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_restday = NM_charset_to_utf8($this->lbl_restday);
         $this->lbl_restday = str_replace('<', '&lt;', $this->lbl_restday);
         $this->lbl_restday = str_replace('>', '&gt;', $this->lbl_restday);
         $this->Texto_tag .= "<td>" . $this->lbl_restday . "</td>\r\n";
   }
   //----- lbl_salholiday
   function NM_export_lbl_salholiday()
   {
             if ($this->lbl_salholiday !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_salholiday, "Sal. Holiday"); 
             } 
         $this->lbl_salholiday = html_entity_decode($this->lbl_salholiday, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_salholiday = NM_charset_to_utf8($this->lbl_salholiday);
         $this->lbl_salholiday = str_replace('<', '&lt;', $this->lbl_salholiday);
         $this->lbl_salholiday = str_replace('>', '&gt;', $this->lbl_salholiday);
         $this->Texto_tag .= "<td>" . $this->lbl_salholiday . "</td>\r\n";
   }
   //----- lbl_saloffday
   function NM_export_lbl_saloffday()
   {
             if ($this->lbl_saloffday !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_saloffday, "Sal. Offday"); 
             } 
         $this->lbl_saloffday = html_entity_decode($this->lbl_saloffday, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_saloffday = NM_charset_to_utf8($this->lbl_saloffday);
         $this->lbl_saloffday = str_replace('<', '&lt;', $this->lbl_saloffday);
         $this->lbl_saloffday = str_replace('>', '&gt;', $this->lbl_saloffday);
         $this->Texto_tag .= "<td>" . $this->lbl_saloffday . "</td>\r\n";
   }
   //----- lbl_salrestday
   function NM_export_lbl_salrestday()
   {
             if ($this->lbl_salrestday !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_salrestday, "Sal. Restday"); 
             } 
         $this->lbl_salrestday = html_entity_decode($this->lbl_salrestday, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_salrestday = NM_charset_to_utf8($this->lbl_salrestday);
         $this->lbl_salrestday = str_replace('<', '&lt;', $this->lbl_salrestday);
         $this->lbl_salrestday = str_replace('>', '&gt;', $this->lbl_salrestday);
         $this->Texto_tag .= "<td>" . $this->lbl_salrestday . "</td>\r\n";
   }
   //----- lbl_salworkday
   function NM_export_lbl_salworkday()
   {
             if ($this->lbl_salworkday !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_salworkday, "Sal. Workday"); 
             } 
         $this->lbl_salworkday = html_entity_decode($this->lbl_salworkday, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_salworkday = NM_charset_to_utf8($this->lbl_salworkday);
         $this->lbl_salworkday = str_replace('<', '&lt;', $this->lbl_salworkday);
         $this->lbl_salworkday = str_replace('>', '&gt;', $this->lbl_salworkday);
         $this->Texto_tag .= "<td>" . $this->lbl_salworkday . "</td>\r\n";
   }
   //----- lbl_sal_reg
   function NM_export_lbl_sal_reg()
   {
             if ($this->lbl_sal_reg !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_sal_reg, "Total Sal. Regular"); 
             } 
         $this->lbl_sal_reg = html_entity_decode($this->lbl_sal_reg, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_sal_reg = NM_charset_to_utf8($this->lbl_sal_reg);
         $this->lbl_sal_reg = str_replace('<', '&lt;', $this->lbl_sal_reg);
         $this->lbl_sal_reg = str_replace('>', '&gt;', $this->lbl_sal_reg);
         $this->Texto_tag .= "<td>" . $this->lbl_sal_reg . "</td>\r\n";
   }
   //----- lbl_sundaybenefits
   function NM_export_lbl_sundaybenefits()
   {
             if ($this->lbl_sundaybenefits !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_sundaybenefits, "Sunday Earned"); 
             } 
         $this->lbl_sundaybenefits = html_entity_decode($this->lbl_sundaybenefits, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_sundaybenefits = NM_charset_to_utf8($this->lbl_sundaybenefits);
         $this->lbl_sundaybenefits = str_replace('<', '&lt;', $this->lbl_sundaybenefits);
         $this->lbl_sundaybenefits = str_replace('>', '&gt;', $this->lbl_sundaybenefits);
         $this->Texto_tag .= "<td>" . $this->lbl_sundaybenefits . "</td>\r\n";
   }
   //----- lbl_sundayhh
   function NM_export_lbl_sundayhh()
   {
             if ($this->lbl_sundayhh !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_sundayhh, "Sunday"); 
             } 
         $this->lbl_sundayhh = html_entity_decode($this->lbl_sundayhh, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_sundayhh = NM_charset_to_utf8($this->lbl_sundayhh);
         $this->lbl_sundayhh = str_replace('<', '&lt;', $this->lbl_sundayhh);
         $this->lbl_sundayhh = str_replace('>', '&gt;', $this->lbl_sundayhh);
         $this->Texto_tag .= "<td>" . $this->lbl_sundayhh . "</td>\r\n";
   }
   //----- lbl_workay
   function NM_export_lbl_workay()
   {
             if ($this->lbl_workay !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_workay, "Workday"); 
             } 
         $this->lbl_workay = html_entity_decode($this->lbl_workay, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_workay = NM_charset_to_utf8($this->lbl_workay);
         $this->lbl_workay = str_replace('<', '&lt;', $this->lbl_workay);
         $this->lbl_workay = str_replace('>', '&gt;', $this->lbl_workay);
         $this->Texto_tag .= "<td>" . $this->lbl_workay . "</td>\r\n";
   }
   //----- lbl_amount01
   function NM_export_lbl_amount01()
   {
             if ($this->lbl_amount01 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_amount01, "AMOUNT"); 
             } 
         $this->lbl_amount01 = html_entity_decode($this->lbl_amount01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_amount01 = NM_charset_to_utf8($this->lbl_amount01);
         $this->lbl_amount01 = str_replace('<', '&lt;', $this->lbl_amount01);
         $this->lbl_amount01 = str_replace('>', '&gt;', $this->lbl_amount01);
         $this->Texto_tag .= "<td>" . $this->lbl_amount01 . "</td>\r\n";
   }
   //----- lbl_companyname
   function NM_export_lbl_companyname()
   {
         if ($this->lbl_companyname !== "&nbsp;") 
         { 
             $this->lbl_companyname = sc_strtoupper($this->lbl_companyname); 
         } 
         $this->lbl_companyname = NM_charset_to_utf8($this->lbl_companyname);
         $this->lbl_companyname = str_replace('<', '&lt;', $this->lbl_companyname);
         $this->lbl_companyname = str_replace('>', '&gt;', $this->lbl_companyname);
         $this->Texto_tag .= "<td>" . $this->lbl_companyname . "</td>\r\n";
   }
   //----- lbl_deductions
   function NM_export_lbl_deductions()
   {
             if ($this->lbl_deductions !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_deductions, "Deductions"); 
             } 
         $this->lbl_deductions = html_entity_decode($this->lbl_deductions, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_deductions = NM_charset_to_utf8($this->lbl_deductions);
         $this->lbl_deductions = str_replace('<', '&lt;', $this->lbl_deductions);
         $this->lbl_deductions = str_replace('>', '&gt;', $this->lbl_deductions);
         $this->Texto_tag .= "<td>" . $this->lbl_deductions . "</td>\r\n";
   }
   //----- lbl_dept
   function NM_export_lbl_dept()
   {
             if ($this->lbl_dept !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_dept, "DEPARTMENT"); 
             } 
         $this->lbl_dept = html_entity_decode($this->lbl_dept, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_dept = NM_charset_to_utf8($this->lbl_dept);
         $this->lbl_dept = str_replace('<', '&lt;', $this->lbl_dept);
         $this->lbl_dept = str_replace('>', '&gt;', $this->lbl_dept);
         $this->Texto_tag .= "<td>" . $this->lbl_dept . "</td>\r\n";
   }
   //----- lbl_earning
   function NM_export_lbl_earning()
   {
             if ($this->lbl_earning !== "&nbsp;") 
             { 
                 $this->lbl_earning = sc_strtoupper($this->lbl_earning); 
             } 
             if ($this->lbl_earning !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_earning, "EARNING"); 
             } 
         $this->lbl_earning = html_entity_decode($this->lbl_earning, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_earning = NM_charset_to_utf8($this->lbl_earning);
         $this->lbl_earning = str_replace('<', '&lt;', $this->lbl_earning);
         $this->lbl_earning = str_replace('>', '&gt;', $this->lbl_earning);
         $this->Texto_tag .= "<td>" . $this->lbl_earning . "</td>\r\n";
   }
   //----- lbl_employeename
   function NM_export_lbl_employeename()
   {
             if ($this->lbl_employeename !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_employeename, "Employee Name"); 
             } 
         $this->lbl_employeename = html_entity_decode($this->lbl_employeename, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_employeename = NM_charset_to_utf8($this->lbl_employeename);
         $this->lbl_employeename = str_replace('<', '&lt;', $this->lbl_employeename);
         $this->lbl_employeename = str_replace('>', '&gt;', $this->lbl_employeename);
         $this->Texto_tag .= "<td>" . $this->lbl_employeename . "</td>\r\n";
   }
   //----- lbl_fixedsalary
   function NM_export_lbl_fixedsalary()
   {
             if ($this->lbl_fixedsalary !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_fixedsalary, "Fixed Salary"); 
             } 
         $this->lbl_fixedsalary = html_entity_decode($this->lbl_fixedsalary, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_fixedsalary = NM_charset_to_utf8($this->lbl_fixedsalary);
         $this->lbl_fixedsalary = str_replace('<', '&lt;', $this->lbl_fixedsalary);
         $this->lbl_fixedsalary = str_replace('>', '&gt;', $this->lbl_fixedsalary);
         $this->Texto_tag .= "<td>" . $this->lbl_fixedsalary . "</td>\r\n";
   }
   //----- lbl_leavehh
   function NM_export_lbl_leavehh()
   {
             if ($this->lbl_leavehh !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_leavehh, "Leave"); 
             } 
         $this->lbl_leavehh = html_entity_decode($this->lbl_leavehh, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_leavehh = NM_charset_to_utf8($this->lbl_leavehh);
         $this->lbl_leavehh = str_replace('<', '&lt;', $this->lbl_leavehh);
         $this->lbl_leavehh = str_replace('>', '&gt;', $this->lbl_leavehh);
         $this->Texto_tag .= "<td>" . $this->lbl_leavehh . "</td>\r\n";
   }
   //----- lbl_line01
   function NM_export_lbl_line01()
   {
             if ($this->lbl_line01 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_line01, "________________________________________________________________"); 
             } 
         $this->lbl_line01 = html_entity_decode($this->lbl_line01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_line01 = NM_charset_to_utf8($this->lbl_line01);
         $this->lbl_line01 = str_replace('<', '&lt;', $this->lbl_line01);
         $this->lbl_line01 = str_replace('>', '&gt;', $this->lbl_line01);
         $this->Texto_tag .= "<td>" . $this->lbl_line01 . "</td>\r\n";
   }
   //----- lbl_offday
   function NM_export_lbl_offday()
   {
             if ($this->lbl_offday !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_offday, "Offday"); 
             } 
         $this->lbl_offday = html_entity_decode($this->lbl_offday, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_offday = NM_charset_to_utf8($this->lbl_offday);
         $this->lbl_offday = str_replace('<', '&lt;', $this->lbl_offday);
         $this->lbl_offday = str_replace('>', '&gt;', $this->lbl_offday);
         $this->Texto_tag .= "<td>" . $this->lbl_offday . "</td>\r\n";
   }
   //----- lbl_payslip
   function NM_export_lbl_payslip()
   {
             if ($this->lbl_payslip !== "&nbsp;") 
             { 
                 $this->lbl_payslip = sc_strtoupper($this->lbl_payslip); 
             } 
             if ($this->lbl_payslip !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_payslip, "PAYSLIP"); 
             } 
         $this->lbl_payslip = html_entity_decode($this->lbl_payslip, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_payslip = NM_charset_to_utf8($this->lbl_payslip);
         $this->lbl_payslip = str_replace('<', '&lt;', $this->lbl_payslip);
         $this->lbl_payslip = str_replace('>', '&gt;', $this->lbl_payslip);
         $this->Texto_tag .= "<td>" . $this->lbl_payslip . "</td>\r\n";
   }
   //----- lbl_rappel
   function NM_export_lbl_rappel()
   {
             if ($this->lbl_rappel !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_rappel, "Miscellaneous"); 
             } 
         $this->lbl_rappel = html_entity_decode($this->lbl_rappel, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_rappel = NM_charset_to_utf8($this->lbl_rappel);
         $this->lbl_rappel = str_replace('<', '&lt;', $this->lbl_rappel);
         $this->lbl_rappel = str_replace('>', '&gt;', $this->lbl_rappel);
         $this->Texto_tag .= "<td>" . $this->lbl_rappel . "</td>\r\n";
   }
   //----- lbl_salholidaydet
   function NM_export_lbl_salholidaydet()
   {
             if ($this->lbl_salholidaydet !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_salholidaydet, "Sal Holiday"); 
             } 
         $this->lbl_salholidaydet = html_entity_decode($this->lbl_salholidaydet, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_salholidaydet = NM_charset_to_utf8($this->lbl_salholidaydet);
         $this->lbl_salholidaydet = str_replace('<', '&lt;', $this->lbl_salholidaydet);
         $this->lbl_salholidaydet = str_replace('>', '&gt;', $this->lbl_salholidaydet);
         $this->Texto_tag .= "<td>" . $this->lbl_salholidaydet . "</td>\r\n";
   }
   //----- lbl_saloffdaydet
   function NM_export_lbl_saloffdaydet()
   {
             if ($this->lbl_saloffdaydet !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_saloffdaydet, "Sal Offday"); 
             } 
         $this->lbl_saloffdaydet = html_entity_decode($this->lbl_saloffdaydet, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_saloffdaydet = NM_charset_to_utf8($this->lbl_saloffdaydet);
         $this->lbl_saloffdaydet = str_replace('<', '&lt;', $this->lbl_saloffdaydet);
         $this->lbl_saloffdaydet = str_replace('>', '&gt;', $this->lbl_saloffdaydet);
         $this->Texto_tag .= "<td>" . $this->lbl_saloffdaydet . "</td>\r\n";
   }
   //----- lbl_salrestdaydet
   function NM_export_lbl_salrestdaydet()
   {
             if ($this->lbl_salrestdaydet !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_salrestdaydet, "Sal Restday"); 
             } 
         $this->lbl_salrestdaydet = html_entity_decode($this->lbl_salrestdaydet, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_salrestdaydet = NM_charset_to_utf8($this->lbl_salrestdaydet);
         $this->lbl_salrestdaydet = str_replace('<', '&lt;', $this->lbl_salrestdaydet);
         $this->lbl_salrestdaydet = str_replace('>', '&gt;', $this->lbl_salrestdaydet);
         $this->Texto_tag .= "<td>" . $this->lbl_salrestdaydet . "</td>\r\n";
   }
   //----- lbl_salworkdaydet
   function NM_export_lbl_salworkdaydet()
   {
             if ($this->lbl_salworkdaydet !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_salworkdaydet, "Sal Workday"); 
             } 
         $this->lbl_salworkdaydet = html_entity_decode($this->lbl_salworkdaydet, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_salworkdaydet = NM_charset_to_utf8($this->lbl_salworkdaydet);
         $this->lbl_salworkdaydet = str_replace('<', '&lt;', $this->lbl_salworkdaydet);
         $this->lbl_salworkdaydet = str_replace('>', '&gt;', $this->lbl_salworkdaydet);
         $this->Texto_tag .= "<td>" . $this->lbl_salworkdaydet . "</td>\r\n";
   }
   //----- lbl_taxcass
   function NM_export_lbl_taxcass()
   {
             if ($this->lbl_taxcass !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_taxcass, "CASS"); 
             } 
         $this->lbl_taxcass = html_entity_decode($this->lbl_taxcass, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_taxcass = NM_charset_to_utf8($this->lbl_taxcass);
         $this->lbl_taxcass = str_replace('<', '&lt;', $this->lbl_taxcass);
         $this->lbl_taxcass = str_replace('>', '&gt;', $this->lbl_taxcass);
         $this->Texto_tag .= "<td>" . $this->lbl_taxcass . "</td>\r\n";
   }
   //----- lbl_taxcfgdct
   function NM_export_lbl_taxcfgdct()
   {
             if ($this->lbl_taxcfgdct !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_taxcfgdct, "CFGDCT"); 
             } 
         $this->lbl_taxcfgdct = html_entity_decode($this->lbl_taxcfgdct, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_taxcfgdct = NM_charset_to_utf8($this->lbl_taxcfgdct);
         $this->lbl_taxcfgdct = str_replace('<', '&lt;', $this->lbl_taxcfgdct);
         $this->lbl_taxcfgdct = str_replace('>', '&gt;', $this->lbl_taxcfgdct);
         $this->Texto_tag .= "<td>" . $this->lbl_taxcfgdct . "</td>\r\n";
   }
   //----- lbl_taxfdu
   function NM_export_lbl_taxfdu()
   {
             if ($this->lbl_taxfdu !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_taxfdu, "FDU"); 
             } 
         $this->lbl_taxfdu = html_entity_decode($this->lbl_taxfdu, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_taxfdu = NM_charset_to_utf8($this->lbl_taxfdu);
         $this->lbl_taxfdu = str_replace('<', '&lt;', $this->lbl_taxfdu);
         $this->lbl_taxfdu = str_replace('>', '&gt;', $this->lbl_taxfdu);
         $this->Texto_tag .= "<td>" . $this->lbl_taxfdu . "</td>\r\n";
   }

   //----- 
   function grava_arquivo_rtf()
   {
      global $nm_lang, $doc_wrap;
      $this->Rtf_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $rtf_f       = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      require_once($this->Ini->path_third      . "/rtf_new/document_generator/cl_xml2driver.php"); 
      $text_ok  =  "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n"; 
      $text_ok .=  "<DOC config_file=\"" . $this->Ini->path_third . "/rtf_new/doc_config.inc\" >\r\n"; 
      $text_ok .=  $this->Texto_tag; 
      $text_ok .=  "</DOC>\r\n"; 
      $xml = new nDOCGEN($text_ok,"RTF"); 
      fwrite($rtf_f, $xml->get_result_file());
      fclose($rtf_f);
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_allv2'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_chart_title'] ?> tbl_salary :: RTF</TITLE>
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
   <td class="scExportTitle" style="height: 25px">RTF</td>
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
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="pdf_payslip_allv2_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="pdf_payslip_allv2"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="volta_grid"> 
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
