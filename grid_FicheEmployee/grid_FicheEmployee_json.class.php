<?php

class grid_FicheEmployee_json
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['embutida'])
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['opcao'] = "";
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
                   nm_limpa_str_grid_FicheEmployee($cadapar[1]);
                   nm_protect_num_grid_FicheEmployee($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_FicheEmployee']['opcao'] = $cadapar[1];
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $this->Tem_json_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['SC_Gb_Free_cmp']))
      {
          $this->Tem_json_res  = false;
      }
      if (!is_file($this->Ini->root . $this->Ini->path_link . "grid_FicheEmployee/grid_FicheEmployee_res_json.class.php"))
      {
          $this->Tem_json_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_label']))
      {
          $this->Json_use_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_label'];
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_format']))
      {
          $this->Json_format = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_format'];
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_FicheEmployee_total.class.php"); 
      $this->Tot = new grid_FicheEmployee_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_FicheEmployee']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_return']);
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
      $this->Arq_zip      = $this->Arquivo . "_grid_FicheEmployee.zip";
      $this->Arquivo     .= "_grid_FicheEmployee";
      $this->Arquivo     .= ".json";
      $this->Tit_doc      = "grid_FicheEmployee.json";
      $this->Tit_zip      = "grid_FicheEmployee.zip";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_FicheEmployee']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_FicheEmployee']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_FicheEmployee']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->id = (isset($Busca_temp['id'])) ? $Busca_temp['id'] : ""; 
          $tmp_pos = (is_string($this->id)) ? strpos($this->id, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->id))
          {
              $this->id = substr($this->id, 0, $tmp_pos);
          }
          $this->userid_int = (isset($Busca_temp['userid_int'])) ? $Busca_temp['userid_int'] : ""; 
          $tmp_pos = (is_string($this->userid_int)) ? strpos($this->userid_int, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->userid_int))
          {
              $this->userid_int = substr($this->userid_int, 0, $tmp_pos);
          }
          $this->userid_varchar = (isset($Busca_temp['userid_varchar'])) ? $Busca_temp['userid_varchar'] : ""; 
          $tmp_pos = (is_string($this->userid_varchar)) ? strpos($this->userid_varchar, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->userid_varchar))
          {
              $this->userid_varchar = substr($this->userid_varchar, 0, $tmp_pos);
          }
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_name'] .= ".json";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['embutida'])
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
          $nmgp_select = "SELECT userid_int, employee_name, designation, dept, Phone, Email, Gender, hiredate, rate_fixed, revenu_net, Address, DOB, rate_cass, tax_cass, rate_cfgdct, tax_cfgdct, rate_ona, tax_ona, rate_fdu, tax_fdu, rate_iris, bank_number, id from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT userid_int, employee_name, designation, dept, Phone, Email, Gender, hiredate, rate_fixed, revenu_net, Address, DOB, rate_cass, tax_cass, rate_cfgdct, tax_cfgdct, rate_ona, tax_ona, rate_fdu, tax_fdu, rate_iris, bank_number, id from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['order_grid'];
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
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         $this->userid_int = $rs->fields[0] ;  
         $this->userid_int = (string)$this->userid_int;
         $this->employee_name = $rs->fields[1] ;  
         $this->designation = $rs->fields[2] ;  
         $this->dept = $rs->fields[3] ;  
         $this->phone = $rs->fields[4] ;  
         $this->email = $rs->fields[5] ;  
         $this->gender = $rs->fields[6] ;  
         $this->hiredate = $rs->fields[7] ;  
         $this->rate_fixed = $rs->fields[8] ;  
         $this->rate_fixed =  str_replace(",", ".", $this->rate_fixed);
         $this->rate_fixed = (string)$this->rate_fixed;
         $this->revenu_net = $rs->fields[9] ;  
         $this->revenu_net =  str_replace(",", ".", $this->revenu_net);
         $this->revenu_net = (string)$this->revenu_net;
         $this->address = $rs->fields[10] ;  
         $this->dob = $rs->fields[11] ;  
         $this->rate_cass = $rs->fields[12] ;  
         $this->rate_cass = (string)$this->rate_cass;
         $this->tax_cass = $rs->fields[13] ;  
         $this->tax_cass =  str_replace(",", ".", $this->tax_cass);
         $this->tax_cass = (string)$this->tax_cass;
         $this->rate_cfgdct = $rs->fields[14] ;  
         $this->rate_cfgdct = (string)$this->rate_cfgdct;
         $this->tax_cfgdct = $rs->fields[15] ;  
         $this->tax_cfgdct =  str_replace(",", ".", $this->tax_cfgdct);
         $this->tax_cfgdct = (string)$this->tax_cfgdct;
         $this->rate_ona = $rs->fields[16] ;  
         $this->rate_ona = (string)$this->rate_ona;
         $this->tax_ona = $rs->fields[17] ;  
         $this->tax_ona =  str_replace(",", ".", $this->tax_ona);
         $this->tax_ona = (string)$this->tax_ona;
         $this->rate_fdu = $rs->fields[18] ;  
         $this->rate_fdu = (string)$this->rate_fdu;
         $this->tax_fdu = $rs->fields[19] ;  
         $this->tax_fdu =  str_replace(",", ".", $this->tax_fdu);
         $this->tax_fdu = (string)$this->tax_fdu;
         $this->rate_iris = $rs->fields[20] ;  
         $this->rate_iris =  str_replace(",", ".", $this->rate_iris);
         $this->rate_iris = (string)$this->rate_iris;
         $this->bank_number = $rs->fields[21] ;  
         $this->id = $rs->fields[22] ;  
         $this->id = (string)$this->id;
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['field_order'] as $Cada_col)
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['embutida'])
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
              require_once($this->Ini->path_aplicacao . "grid_FicheEmployee_res_json.class.php");
              $this->Res = new grid_FicheEmployee_res_json();
              $this->prep_modulos("Res");
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_res_grid'] = true;
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
                  $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_res_file']['json'];
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
                  unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_res_file']['json']);
              }
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_res_grid']);
          } 
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['export_sel_columns']['usr_cmp_sel']);
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
             $SC_Label = (isset($this->New_label['userid_int'])) ? $this->New_label['userid_int'] : "ID"; 
         }
         else
         {
             $SC_Label = "userid_int"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->userid_int;
   }
   //----- employee_name
   function NM_export_employee_name()
   {
         $this->employee_name = NM_charset_to_utf8($this->employee_name);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['employee_name'])) ? $this->New_label['employee_name'] : "" . $this->Ini->Nm_lang['lang_username'] . ""; 
         }
         else
         {
             $SC_Label = "employee_name"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->employee_name;
   }
   //----- designation
   function NM_export_designation()
   {
         $this->designation = NM_charset_to_utf8($this->designation);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['designation'])) ? $this->New_label['designation'] : "" . $this->Ini->Nm_lang['lang_designation'] . ""; 
         }
         else
         {
             $SC_Label = "designation"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->designation;
   }
   //----- dept
   function NM_export_dept()
   {
         $this->dept = NM_charset_to_utf8($this->dept);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['dept'])) ? $this->New_label['dept'] : "" . $this->Ini->Nm_lang['lang_departement'] . ""; 
         }
         else
         {
             $SC_Label = "dept"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->dept;
   }
   //----- phone
   function NM_export_phone()
   {
         $this->phone = NM_charset_to_utf8($this->phone);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['phone'])) ? $this->New_label['phone'] : "" . $this->Ini->Nm_lang['lang_phone'] . ""; 
         }
         else
         {
             $SC_Label = "phone"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->phone;
   }
   //----- email
   function NM_export_email()
   {
         $this->email = NM_charset_to_utf8($this->email);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['email'])) ? $this->New_label['email'] : "Email"; 
         }
         else
         {
             $SC_Label = "email"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->email;
   }
   //----- gender
   function NM_export_gender()
   {
         $this->gender = NM_charset_to_utf8($this->gender);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['gender'])) ? $this->New_label['gender'] : "" . $this->Ini->Nm_lang['lang_gender'] . ""; 
         }
         else
         {
             $SC_Label = "gender"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->gender;
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
                 $this->hiredate = $this->nm_data->FormataSaida("d-M-Y");
             } 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hiredate'])) ? $this->New_label['hiredate'] : "" . $this->Ini->Nm_lang['lang_hiredate'] . ""; 
         }
         else
         {
             $SC_Label = "hiredate"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hiredate;
   }
   //----- rate_fixed
   function NM_export_rate_fixed()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->rate_fixed, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['rate_fixed'])) ? $this->New_label['rate_fixed'] : "" . $this->Ini->Nm_lang['lang_rate_fixed'] . ""; 
         }
         else
         {
             $SC_Label = "rate_fixed"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->rate_fixed;
   }
   //----- revenu_net
   function NM_export_revenu_net()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->revenu_net, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['revenu_net'])) ? $this->New_label['revenu_net'] : "" . $this->Ini->Nm_lang['lang_revenu_net'] . ""; 
         }
         else
         {
             $SC_Label = "revenu_net"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->revenu_net;
   }
   //----- address
   function NM_export_address()
   {
         $this->address = NM_charset_to_utf8($this->address);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['address'])) ? $this->New_label['address'] : "Address"; 
         }
         else
         {
             $SC_Label = "address"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->address;
   }
   //----- dob
   function NM_export_dob()
   {
         if ($this->Json_format)
         {
             $conteudo_x =  $this->dob;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->dob, "YYYY-MM-DD  ");
                 $this->dob = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['dob'])) ? $this->New_label['dob'] : "DOB"; 
         }
         else
         {
             $SC_Label = "dob"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->dob;
   }
   //----- rate_cass
   function NM_export_rate_cass()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->rate_cass, ",", ".", "2", "S", "2", "", "N:2", "-") ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['rate_cass'])) ? $this->New_label['rate_cass'] : "Rate CASS"; 
         }
         else
         {
             $SC_Label = "rate_cass"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->rate_cass;
   }
   //----- tax_cass
   function NM_export_tax_cass()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->tax_cass, ",", ".", "2", "S", "2", "HTG", "V:1:1", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['tax_cass'])) ? $this->New_label['tax_cass'] : "Tax CASS"; 
         }
         else
         {
             $SC_Label = "tax_cass"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->tax_cass;
   }
   //----- rate_cfgdct
   function NM_export_rate_cfgdct()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->rate_cfgdct, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['rate_cfgdct'])) ? $this->New_label['rate_cfgdct'] : "Rate CFGDCT"; 
         }
         else
         {
             $SC_Label = "rate_cfgdct"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->rate_cfgdct;
   }
   //----- tax_cfgdct
   function NM_export_tax_cfgdct()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->tax_cfgdct, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['tax_cfgdct'])) ? $this->New_label['tax_cfgdct'] : "Tax CFGDCT"; 
         }
         else
         {
             $SC_Label = "tax_cfgdct"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->tax_cfgdct;
   }
   //----- rate_ona
   function NM_export_rate_ona()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->rate_ona, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['rate_ona'])) ? $this->New_label['rate_ona'] : "Rate ONA"; 
         }
         else
         {
             $SC_Label = "rate_ona"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->rate_ona;
   }
   //----- tax_ona
   function NM_export_tax_ona()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->tax_ona, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['tax_ona'])) ? $this->New_label['tax_ona'] : "Tax ONA"; 
         }
         else
         {
             $SC_Label = "tax_ona"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->tax_ona;
   }
   //----- rate_fdu
   function NM_export_rate_fdu()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->rate_fdu, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['rate_fdu'])) ? $this->New_label['rate_fdu'] : "Rate FDU"; 
         }
         else
         {
             $SC_Label = "rate_fdu"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->rate_fdu;
   }
   //----- tax_fdu
   function NM_export_tax_fdu()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->tax_fdu, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['tax_fdu'])) ? $this->New_label['tax_fdu'] : "Tax FDU"; 
         }
         else
         {
             $SC_Label = "tax_fdu"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->tax_fdu;
   }
   //----- rate_iris
   function NM_export_rate_iris()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->rate_iris, ",", ".", "2", "S", "2", "HTG", "V:3:12", "-"); 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['rate_iris'])) ? $this->New_label['rate_iris'] : "IRI"; 
         }
         else
         {
             $SC_Label = "rate_iris"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->rate_iris;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_active_employee_list'] ?> :: JSON</TITLE>
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
<form name="Fdown" method="get" action="grid_FicheEmployee_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_FicheEmployee"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_FicheEmployee']['json_return']); ?>"> 
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
function Download_Fingertec()
{
$_SESSION['scriptcase']['grid_FicheEmployee']['contr_erro'] = 'on';
  
$SQL0 = "TRUNCATE TABLE tbl_employee_actif";




$SQL1 = "INSERT INTO tbl_employee_actif (userid, Name, lastname, Gender, designation, path, DOB, IssueDate, expirydate, Address, Phone, Email, ic)
  SELECT
    user.userid AS userid,
    user.Name AS Name,
    user.lastname AS lastname,
    user.Gender AS Gender,
    user.designation AS designation,
    user_group.path AS path,
    user.DOB AS DOB,
    user.IssueDate AS IssueDate,
    user.expirydate AS expirydate,
	user.Address AS Address,
	user.Phone AS Phone,
	user.Email AS Email,
	user.ic AS ic
  FROM user
    INNER JOIN user_group
      ON user.User_Group = user_group.id
  WHERE user.expirydate > CURDATE()";


$SQL2 = "INSERT INTO tbl_rate (userid_varchar)
SELECT
  tbl_employee_actif.userid
FROM tbl_employee_actif
  LEFT OUTER JOIN tbl_rate
    ON tbl_employee_actif.userid = tbl_rate.userid_varchar
    WHERE ((tbl_rate.id) Is Null)";


$SQL3 = "UPDATE tbl_rate SET userid_int = CAST(tbl_rate.userid_varchar AS UNSIGNED)
WHERE userid_int = 0";


$SQL4 = "UPDATE tbl_rate
INNER JOIN tbl_employee_actif ON tbl_rate.userid_varchar = tbl_employee_actif.userid
SET     tbl_rate.employee_name = CONCAT(tbl_employee_actif.lastname, ' ', tbl_employee_actif.Name),
        tbl_rate.designation   = tbl_employee_actif.designation,
        tbl_rate.dept          = tbl_employee_actif.path,
	    tbl_rate.hiredate      = tbl_employee_actif.IssueDate,
		tbl_rate.Address       = tbl_employee_actif.Address,
		tbl_rate.Phone         = tbl_employee_actif.Phone,
		tbl_rate.Email         = tbl_employee_actif.Email,
		tbl_rate.ic            = tbl_employee_actif.ic,
		tbl_rate.Gender        = tbl_employee_actif.Gender,
        tbl_rate.DOB           = tbl_employee_actif.DOB
		";

$SQL5 = "UPDATE tbl_rate
INNER JOIN user ON tbl_rate.userid_varchar = user.userid
SET     tbl_rate.firedate   = user.expirydate
		";



     $nm_select = $SQL0; 
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
      

     $nm_select = $SQL1; 
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
      

     $nm_select = $SQL2; 
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
      

     $nm_select = $SQL3; 
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
      

     $nm_select = $SQL4; 
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
      

     $nm_select = $SQL5; 
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
      
$_SESSION['scriptcase']['grid_FicheEmployee']['contr_erro'] = 'off';
}
function Generate_netrevenue()
{
$_SESSION['scriptcase']['grid_FicheEmployee']['contr_erro'] = 'on';
  
$SQL1 = "UPDATE tbl_rate
SET hiring_duration =  TIMESTAMPDIFF(MONTH,hiredate,CURDATE())
";

$SQL2 = "UPDATE tbl_rate
SET rate_iris = (IF(((rate_fixed *12)>60000),IF(((rate_fixed *12)>240000),IF(((rate_fixed *12)>480000),IF(((rate_fixed *12)>1000000),((((180000*(10/100))+(240000*(15/100)))+(520000*(25/100)))+((((((rate_fixed *12)-60000)-180000)-240000)-520000)*(30/100))),(((180000*(10/100))+(240000*(15/100)))+(((rate_fixed *12)-480000)*(25/100)))),((180000*(10/100))+(((rate_fixed *12)-240000)*(15/100)))),(((rate_fixed *12)-60000)*(10/100))),0)/12) 
";


$SQL3 = "UPDATE tbl_rate 
SET tbl_rate.tax_ona    = (If(`tbl_rate`.`rate_fixed`>1000,`tbl_rate`.`rate_fixed`*`tbl_rate`.`rate_ona`,
		If(`tbl_rate`.`rate_fixed`>500,`tbl_rate`.`rate_fixed`*(`tbl_rate`.`rate_ona`*4/6),
		If(`tbl_rate`.`rate_fixed`>200,`tbl_rate`.`rate_fixed`*(`tbl_rate`.`rate_ona`/2),
		If(`tbl_rate`.`rate_fixed`>1,`tbl_rate`.`rate_fixed`*(`tbl_rate`.`rate_ona`/3),0))))),
	tbl_rate.tax_cass   = (If(`tbl_rate`.`rate_fixed`>5000,`tbl_rate`.`rate_fixed`*`tbl_rate`.`rate_cass`,0)),
	tbl_rate.tax_cfgdct = (If(`tbl_rate`.`rate_fixed`>5000,`tbl_rate`.`rate_fixed`*`tbl_rate`.`rate_cfgdct`,0)),
	tbl_rate.tax_fdu    = (If(`tbl_rate`.`rate_fixed`>5000,`tbl_rate`.`rate_fixed`*`tbl_rate`.`rate_fdu`,0))
	";


$SQL4 = "UPDATE tbl_rate SET revenu_net = rate_fixed-(rate_iris + tax_ona + tax_fdu + tax_cfgdct + tax_cass) ";


     $nm_select = $SQL1; 
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
      

     $nm_select = $SQL2; 
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
      

     $nm_select = $SQL3; 
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
      

     $nm_select = $SQL4; 
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
      

echo "<p> <font color=green font face='courier' size='6pt'>NET INCOME GENERATED SUCCESSFULLY</font> </p>";
$_SESSION['scriptcase']['grid_FicheEmployee']['contr_erro'] = 'off';
}
function calculate_hiringduration()
{
$_SESSION['scriptcase']['grid_FicheEmployee']['contr_erro'] = 'on';
  
$SQL0_1 = "
UPDATE tbl_rate
SET hiring_duration = CASE
    WHEN firedate > CURDATE() THEN TIMESTAMPDIFF(MONTH, hiredate, CURDATE())
    WHEN firedate <= CURDATE() THEN TIMESTAMPDIFF(MONTH, hiredate, firedate) 
        + (DAY(firedate) - DAY(hiredate)) / DAY(LAST_DAY(hiredate))
    ELSE 0.00
END
";


     $nm_select = $SQL0_1; 
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
      
$_SESSION['scriptcase']['grid_FicheEmployee']['contr_erro'] = 'off';
}
}

?>
