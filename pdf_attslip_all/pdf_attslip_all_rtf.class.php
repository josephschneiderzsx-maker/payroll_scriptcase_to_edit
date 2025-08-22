<?php

class pdf_attslip_all_rtf
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
                   nm_limpa_str_pdf_attslip_all($cadapar[1]);
                   nm_protect_num_pdf_attslip_all($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['pdf_attslip_all']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "pdf_attslip_all_total.class.php"); 
      $this->Tot      = new pdf_attslip_all_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['tot_geral'][1];
      }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['pdf_attslip_all']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption('volta_grid');
          $this->pb->setTotalSteps($this->count_ger);
      }
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_pdf_attslip_all";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "pdf_attslip_all.rtf";
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
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['campos_busca'];
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['field_order'] as $Cada_col)
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
          $SC_Label = (isset($this->New_label['work_hh_w'])) ? $this->New_label['work_hh_w'] : "Work Hh W"; 
          if ($Cada_col == "work_hh_w" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ot_hh_w'])) ? $this->New_label['ot_hh_w'] : "Ot Hh W"; 
          if ($Cada_col == "ot_hh_w" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['work_hh_h'])) ? $this->New_label['work_hh_h'] : "Work Hh H"; 
          if ($Cada_col == "work_hh_h" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ot_hh_h'])) ? $this->New_label['ot_hh_h'] : "Ot Hh H"; 
          if ($Cada_col == "ot_hh_h" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['work_hh_r'])) ? $this->New_label['work_hh_r'] : "Work Hh R"; 
          if ($Cada_col == "work_hh_r" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ot_hh_r'])) ? $this->New_label['ot_hh_r'] : "Ot Hh R"; 
          if ($Cada_col == "ot_hh_r" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['hh_sunday'])) ? $this->New_label['hh_sunday'] : "Hh Sunday"; 
          if ($Cada_col == "hh_sunday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['hh_leavetype'])) ? $this->New_label['hh_leavetype'] : "Hh Leavetype"; 
          if ($Cada_col == "hh_leavetype" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['lbl_sal_reg'])) ? $this->New_label['lbl_sal_reg'] : "lbl_Sal_Reg"; 
          if ($Cada_col == "lbl_sal_reg" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['lbl_amount02'])) ? $this->New_label['lbl_amount02'] : "lbl_amount02"; 
          if ($Cada_col == "lbl_amount02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['lbl_line01'])) ? $this->New_label['lbl_line01'] : "lbl_line01"; 
          if ($Cada_col == "lbl_line01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
      } 
      $this->Texto_tag .= "</tr>\r\n";
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT userid_int, hiredate, username, dept, designation, work_hh_w, work_hh_w_PM, ot_hh_w, ot_hh_w_PM, work_hh_h, work_hh_h_PM, ot_hh_h, ot_hh_h_PM, work_hh_r, work_hh_r_PM, ot_hh_r, ot_hh_r_PM, work_hh_o, work_hh_o_PM, ot_hh_o, ot_hh_o_PM, hh_sunday, hh_offday, hh_leavetype, pay_startdate, pay_enddate from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT userid_int, hiredate, username, dept, designation, work_hh_w, work_hh_w_PM, ot_hh_w, ot_hh_w_PM, work_hh_h, work_hh_h_PM, ot_hh_h, ot_hh_h_PM, work_hh_r, work_hh_r_PM, ot_hh_r, ot_hh_r_PM, work_hh_o, work_hh_o_PM, ot_hh_o, ot_hh_o_PM, hh_sunday, hh_offday, hh_leavetype, pay_startdate, pay_enddate from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['order_grid'];
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
         $this->work_hh_w = $rs->fields[5] ;  
         $this->work_hh_w = (string)$this->work_hh_w;
         $this->work_hh_w_pm = $rs->fields[6] ;  
         $this->work_hh_w_pm = (string)$this->work_hh_w_pm;
         $this->ot_hh_w = $rs->fields[7] ;  
         $this->ot_hh_w =  str_replace(",", ".", $this->ot_hh_w);
         $this->ot_hh_w = (string)$this->ot_hh_w;
         $this->ot_hh_w_pm = $rs->fields[8] ;  
         $this->ot_hh_w_pm =  str_replace(",", ".", $this->ot_hh_w_pm);
         $this->ot_hh_w_pm = (string)$this->ot_hh_w_pm;
         $this->work_hh_h = $rs->fields[9] ;  
         $this->work_hh_h =  str_replace(",", ".", $this->work_hh_h);
         $this->work_hh_h = (string)$this->work_hh_h;
         $this->work_hh_h_pm = $rs->fields[10] ;  
         $this->work_hh_h_pm =  str_replace(",", ".", $this->work_hh_h_pm);
         $this->work_hh_h_pm = (string)$this->work_hh_h_pm;
         $this->ot_hh_h = $rs->fields[11] ;  
         $this->ot_hh_h =  str_replace(",", ".", $this->ot_hh_h);
         $this->ot_hh_h = (string)$this->ot_hh_h;
         $this->ot_hh_h_pm = $rs->fields[12] ;  
         $this->ot_hh_h_pm =  str_replace(",", ".", $this->ot_hh_h_pm);
         $this->ot_hh_h_pm = (string)$this->ot_hh_h_pm;
         $this->work_hh_r = $rs->fields[13] ;  
         $this->work_hh_r =  str_replace(",", ".", $this->work_hh_r);
         $this->work_hh_r = (string)$this->work_hh_r;
         $this->work_hh_r_pm = $rs->fields[14] ;  
         $this->work_hh_r_pm =  str_replace(",", ".", $this->work_hh_r_pm);
         $this->work_hh_r_pm = (string)$this->work_hh_r_pm;
         $this->ot_hh_r = $rs->fields[15] ;  
         $this->ot_hh_r =  str_replace(",", ".", $this->ot_hh_r);
         $this->ot_hh_r = (string)$this->ot_hh_r;
         $this->ot_hh_r_pm = $rs->fields[16] ;  
         $this->ot_hh_r_pm =  str_replace(",", ".", $this->ot_hh_r_pm);
         $this->ot_hh_r_pm = (string)$this->ot_hh_r_pm;
         $this->work_hh_o = $rs->fields[17] ;  
         $this->work_hh_o =  str_replace(",", ".", $this->work_hh_o);
         $this->work_hh_o = (string)$this->work_hh_o;
         $this->work_hh_o_pm = $rs->fields[18] ;  
         $this->work_hh_o_pm =  str_replace(",", ".", $this->work_hh_o_pm);
         $this->work_hh_o_pm = (string)$this->work_hh_o_pm;
         $this->ot_hh_o = $rs->fields[19] ;  
         $this->ot_hh_o =  str_replace(",", ".", $this->ot_hh_o);
         $this->ot_hh_o = (string)$this->ot_hh_o;
         $this->ot_hh_o_pm = $rs->fields[20] ;  
         $this->ot_hh_o_pm =  str_replace(",", ".", $this->ot_hh_o_pm);
         $this->ot_hh_o_pm = (string)$this->ot_hh_o_pm;
         $this->hh_sunday = $rs->fields[21] ;  
         $this->hh_sunday =  str_replace(",", ".", $this->hh_sunday);
         $this->hh_sunday = (string)$this->hh_sunday;
         $this->hh_offday = $rs->fields[22] ;  
         $this->hh_offday =  str_replace(",", ".", $this->hh_offday);
         $this->hh_offday = (string)$this->hh_offday;
         $this->hh_leavetype = $rs->fields[23] ;  
         $this->hh_leavetype =  str_replace(",", ".", $this->hh_leavetype);
         $this->hh_leavetype = (string)$this->hh_leavetype;
         $this->pay_startdate = $rs->fields[24] ;  
         $this->pay_enddate = $rs->fields[25] ;  
         $this->sc_proc_grid = true; 
         //----- lookup - lbl_companyname
         $this->Lookup->lookup_lbl_companyname($this->lbl_companyname, $this->array_lbl_companyname); 
         $this->lbl_companyname = str_replace("<br>", " ", $this->lbl_companyname); 
         $this->lbl_companyname = ($this->lbl_companyname == "&nbsp;") ? "" : $this->lbl_companyname; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['export_sel_columns']['usr_cmp_sel']);
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
   //----- work_hh_w
   function NM_export_work_hh_w()
   {
             nmgp_Form_Num_Val($this->work_hh_w, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->work_hh_w = NM_charset_to_utf8($this->work_hh_w);
         $this->work_hh_w = str_replace('<', '&lt;', $this->work_hh_w);
         $this->work_hh_w = str_replace('>', '&gt;', $this->work_hh_w);
         $this->Texto_tag .= "<td>" . $this->work_hh_w . "</td>\r\n";
   }
   //----- work_hh_w_pm
   function NM_export_work_hh_w_pm()
   {
             nmgp_Form_Num_Val($this->work_hh_w_pm, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->work_hh_w_pm = NM_charset_to_utf8($this->work_hh_w_pm);
         $this->work_hh_w_pm = str_replace('<', '&lt;', $this->work_hh_w_pm);
         $this->work_hh_w_pm = str_replace('>', '&gt;', $this->work_hh_w_pm);
         $this->Texto_tag .= "<td>" . $this->work_hh_w_pm . "</td>\r\n";
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
   //----- ot_hh_w_pm
   function NM_export_ot_hh_w_pm()
   {
             nmgp_Form_Num_Val($this->ot_hh_w_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->ot_hh_w_pm = NM_charset_to_utf8($this->ot_hh_w_pm);
         $this->ot_hh_w_pm = str_replace('<', '&lt;', $this->ot_hh_w_pm);
         $this->ot_hh_w_pm = str_replace('>', '&gt;', $this->ot_hh_w_pm);
         $this->Texto_tag .= "<td>" . $this->ot_hh_w_pm . "</td>\r\n";
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
   //----- work_hh_h_pm
   function NM_export_work_hh_h_pm()
   {
             nmgp_Form_Num_Val($this->work_hh_h_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->work_hh_h_pm = NM_charset_to_utf8($this->work_hh_h_pm);
         $this->work_hh_h_pm = str_replace('<', '&lt;', $this->work_hh_h_pm);
         $this->work_hh_h_pm = str_replace('>', '&gt;', $this->work_hh_h_pm);
         $this->Texto_tag .= "<td>" . $this->work_hh_h_pm . "</td>\r\n";
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
   //----- ot_hh_h_pm
   function NM_export_ot_hh_h_pm()
   {
             nmgp_Form_Num_Val($this->ot_hh_h_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->ot_hh_h_pm = NM_charset_to_utf8($this->ot_hh_h_pm);
         $this->ot_hh_h_pm = str_replace('<', '&lt;', $this->ot_hh_h_pm);
         $this->ot_hh_h_pm = str_replace('>', '&gt;', $this->ot_hh_h_pm);
         $this->Texto_tag .= "<td>" . $this->ot_hh_h_pm . "</td>\r\n";
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
   //----- work_hh_r_pm
   function NM_export_work_hh_r_pm()
   {
             nmgp_Form_Num_Val($this->work_hh_r_pm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->work_hh_r_pm = NM_charset_to_utf8($this->work_hh_r_pm);
         $this->work_hh_r_pm = str_replace('<', '&lt;', $this->work_hh_r_pm);
         $this->work_hh_r_pm = str_replace('>', '&gt;', $this->work_hh_r_pm);
         $this->Texto_tag .= "<td>" . $this->work_hh_r_pm . "</td>\r\n";
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
   //----- hh_sunday
   function NM_export_hh_sunday()
   {
             nmgp_Form_Num_Val($this->hh_sunday, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->hh_sunday = NM_charset_to_utf8($this->hh_sunday);
         $this->hh_sunday = str_replace('<', '&lt;', $this->hh_sunday);
         $this->hh_sunday = str_replace('>', '&gt;', $this->hh_sunday);
         $this->Texto_tag .= "<td>" . $this->hh_sunday . "</td>\r\n";
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
   //----- hh_leavetype
   function NM_export_hh_leavetype()
   {
             nmgp_Form_Num_Val($this->hh_leavetype, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         $this->hh_leavetype = NM_charset_to_utf8($this->hh_leavetype);
         $this->hh_leavetype = str_replace('<', '&lt;', $this->hh_leavetype);
         $this->hh_leavetype = str_replace('>', '&gt;', $this->hh_leavetype);
         $this->Texto_tag .= "<td>" . $this->hh_leavetype . "</td>\r\n";
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
   //----- lbl_amount01
   function NM_export_lbl_amount01()
   {
             if ($this->lbl_amount01 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_amount01, "Amount"); 
             } 
         $this->lbl_amount01 = html_entity_decode($this->lbl_amount01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_amount01 = NM_charset_to_utf8($this->lbl_amount01);
         $this->lbl_amount01 = str_replace('<', '&lt;', $this->lbl_amount01);
         $this->lbl_amount01 = str_replace('>', '&gt;', $this->lbl_amount01);
         $this->Texto_tag .= "<td>" . $this->lbl_amount01 . "</td>\r\n";
   }
   //----- lbl_amount02
   function NM_export_lbl_amount02()
   {
             if ($this->lbl_amount02 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_amount02, "Amount"); 
             } 
         $this->lbl_amount02 = html_entity_decode($this->lbl_amount02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_amount02 = NM_charset_to_utf8($this->lbl_amount02);
         $this->lbl_amount02 = str_replace('<', '&lt;', $this->lbl_amount02);
         $this->lbl_amount02 = str_replace('>', '&gt;', $this->lbl_amount02);
         $this->Texto_tag .= "<td>" . $this->lbl_amount02 . "</td>\r\n";
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
   //----- lbl_earning
   function NM_export_lbl_earning()
   {
             if ($this->lbl_earning !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->lbl_earning, "Earning"); 
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
                 $this->nm_gera_mask($this->lbl_rappel, "Extra"); 
             } 
         $this->lbl_rappel = html_entity_decode($this->lbl_rappel, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lbl_rappel = NM_charset_to_utf8($this->lbl_rappel);
         $this->lbl_rappel = str_replace('<', '&lt;', $this->lbl_rappel);
         $this->lbl_rappel = str_replace('>', '&gt;', $this->lbl_rappel);
         $this->Texto_tag .= "<td>" . $this->lbl_rappel . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all'][$path_doc_md5][1] = $this->Tit_doc;
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
<form name="Fdown" method="get" action="pdf_attslip_all_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="pdf_attslip_all"> 
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
