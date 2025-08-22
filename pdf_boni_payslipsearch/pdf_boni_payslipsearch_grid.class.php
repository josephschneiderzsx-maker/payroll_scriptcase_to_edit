<?php
class pdf_boni_payslipsearch_grid
{
   var $Ini;
   var $Erro;
   var $Pdf;
   var $Db;
   var $rs_grid;
   var $nm_grid_sem_reg;
   var $SC_seq_register;
   var $nm_location;
   var $nm_data;
   var $nm_cod_barra;
   var $sc_proc_grid; 
   var $nmgp_botoes = array();
   var $Campos_Mens_erro;
   var $NM_raiz_img; 
   var $Font_ttf; 
   var $SC_incr_col;
   var $SC_incr_lin;
   var $SC_desloca_col; 
   var $SC_desloca_lin; 
   var $array_lbl_companyname = array();
   var $lbl_payperiod = array();
   var $lbl_amount01 = array();
   var $lbl_amount02 = array();
   var $lbl_companyname = array();
   var $lbl_deductions = array();
   var $lbl_dept = array();
   var $lbl_designation = array();
   var $lbl_earning = array();
   var $lbl_employeename = array();
   var $lbl_fixedsalary = array();
   var $lbl_hiredate = array();
   var $lbl_id = array();
   var $lbl_incentive = array();
   var $lbl_line01 = array();
   var $lbl_otvalue = array();
   var $lbl_payslip = array();
   var $lbl_rappel = array();
   var $userid_int = array();
   var $hiredate = array();
   var $username = array();
   var $designation = array();
   var $dept = array();
   var $bank_number = array();
   var $pay_startdate = array();
   var $pay_enddate = array();
   var $boni_value = array();
   var $tax_iric = array();
   var $boni_net = array();
//--- 
 function monta_grid($linhas = 0)
 {

   clearstatcache();
   $this->inicializa();
   $this->grid();
 }
//--- 
 function inicializa()
 {
   global $nm_saida, 
   $rec, $nmgp_chave, $nmgp_opcao, $nmgp_ordem, $nmgp_chave_det, 
   $nmgp_quant_linhas, $nmgp_quant_colunas, $nmgp_url_saida, $nmgp_parms;
//
   $this->nm_data = new nm_data("en_us");
   include_once("../_lib/lib/php/nm_font_tcpdf.php");
   $this->default_font = '';
   $this->default_font_sr  = '';
   $this->default_style    = '';
   $this->default_style_sr = 'B';
   $Tp_papel = "LETTER";
   $old_dir = getcwd();
   $File_font_ttf     = "";
   $temp_font_ttf     = "";
   $this->Font_ttf    = false;
   $this->Font_ttf_sr = false;
   if (empty($this->default_font) && isset($arr_font_tcpdf[$this->Ini->str_lang]))
   {
       $this->default_font = $arr_font_tcpdf[$this->Ini->str_lang];
   }
   elseif (empty($this->default_font))
   {
       $this->default_font = "Times";
   }
   if (empty($this->default_font_sr) && isset($arr_font_tcpdf[$this->Ini->str_lang]))
   {
       $this->default_font_sr = $arr_font_tcpdf[$this->Ini->str_lang];
   }
   elseif (empty($this->default_font_sr))
   {
       $this->default_font_sr = "Times";
   }
   $_SESSION['scriptcase']['pdf_boni_payslipsearch']['default_font'] = $this->default_font;
   chdir($this->Ini->path_third . "/tcpdf/");
   include_once("tcpdf.php");
   chdir($old_dir);
   $this->Pdf = new TCPDF('P', 'mm', $Tp_papel, true, 'UTF-8', false);
   $this->Pdf->setPrintHeader(false);
   $this->Pdf->setPrintFooter(false);
   if (!empty($File_font_ttf))
   {
       $this->Pdf->addTTFfont($File_font_ttf, "", "", 32, $_SESSION['scriptcase']['dir_temp'] . "/");
   }
   $this->Pdf->SetDisplayMode('real');
   $this->aba_iframe = false;
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("pdf_boni_payslipsearch", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['exit'] = "on";
   $this->sc_proc_grid = false; 
   $this->NM_raiz_img = $this->Ini->root;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $this->nm_grid_colunas = 0;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['campos_busca'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $this->userid_int[0] = (isset($Busca_temp['userid_int'])) ? $Busca_temp['userid_int'] : ""; 
       $tmp_pos = (is_string($this->userid_int[0])) ? strpos($this->userid_int[0], "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->userid_int[0]))
       {
           $this->userid_int[0] = substr($this->userid_int[0], 0, $tmp_pos);
       }
       $this->hiredate[0] = (isset($Busca_temp['hiredate'])) ? $Busca_temp['hiredate'] : ""; 
       $tmp_pos = (is_string($this->hiredate[0])) ? strpos($this->hiredate[0], "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->hiredate[0]))
       {
           $this->hiredate[0] = substr($this->hiredate[0], 0, $tmp_pos);
       }
       $hiredate_2 = (isset($Busca_temp['hiredate_input_2'])) ? $Busca_temp['hiredate_input_2'] : ""; 
       $this->hiredate_2 = $hiredate_2; 
       $this->username[0] = (isset($Busca_temp['username'])) ? $Busca_temp['username'] : ""; 
       $tmp_pos = (is_string($this->username[0])) ? strpos($this->username[0], "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->username[0]))
       {
           $this->username[0] = substr($this->username[0], 0, $tmp_pos);
       }
       $this->designation[0] = (isset($Busca_temp['designation'])) ? $Busca_temp['designation'] : ""; 
       $tmp_pos = (is_string($this->designation[0])) ? strpos($this->designation[0], "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->designation[0]))
       {
           $this->designation[0] = substr($this->designation[0], 0, $tmp_pos);
       }
       $this->dept[0] = (isset($Busca_temp['dept'])) ? $Busca_temp['dept'] : ""; 
       $tmp_pos = (is_string($this->dept[0])) ? strpos($this->dept[0], "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->dept[0]))
       {
           $this->dept[0] = substr($this->dept[0], 0, $tmp_pos);
       }
       $this->boni_value[0] = (isset($Busca_temp['boni_value'])) ? $Busca_temp['boni_value'] : ""; 
       $tmp_pos = (is_string($this->boni_value[0])) ? strpos($this->boni_value[0], "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->boni_value[0]))
       {
           $this->boni_value[0] = substr($this->boni_value[0], 0, $tmp_pos);
       }
   } 
   else 
   { 
       $this->hiredate_2 = ""; 
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_pesq_filtro'];
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   $_SESSION['scriptcase']['contr_link_emb'] = $this->nm_location;
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['qt_col_grid'] = 1 ;  
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdf_boni_payslipsearch']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['pdf_boni_payslipsearch']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['pdf_boni_payslipsearch']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['pdf_boni_payslipsearch']['cols']);
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['ordem_select']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['ordem_select'] = array(); 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['ordem_select']['dept'] = 'asc'; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['ordem_select']['userid_int'] = 'asc'; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['ordem_select_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['ordem_select']; 
   } 
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['ordem_quebra']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['ordem_ant']  = "dept,userid_int"; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['ordem_desc'] = "" ; 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_orig'] = " where (firedate > CURDATE())";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_pesq_filtro'];
//
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['tot_geral'][1])) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['tot_geral'][1] ;  
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_pesq'];  
//----- 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT userid_int, hiredate, username, designation, dept, bank_number, pay_startdate, pay_enddate, boni_value, tax_iric, boni_net from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT userid_int, hiredate, username, designation, dept, bank_number, pay_startdate, pay_enddate, boni_value, tax_iric, boni_net from " . $this->Ini->nm_tabela; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_pesq']; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['ordem_grid'])) 
   { 
       $nmgp_order_by = " order by " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['ordem_desc']; 
   } 
   if (!empty($campos_order_select)) 
   { 
       if (!empty($nmgp_order_by)) 
       { 
          $nmgp_order_by .= ", " . $campos_order_select; 
       } 
       else 
       { 
          $nmgp_order_by = " order by $campos_order_select"; 
       } 
   } 
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['order_grid'] = $nmgp_order_by;
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
   $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   if ($this->rs_grid === false && !$this->rs_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
   { 
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit ; 
   }  
   if ($this->rs_grid->EOF || ($this->rs_grid === false && $GLOBALS["NM_ERRO_IBASE"] == 1)) 
   { 
       $this->nm_grid_sem_reg = $this->SC_conv_utf8($this->Ini->Nm_lang['lang_errm_empt']); 
   }  
// 
 }  
// 
 function Pdf_init()
 {
     if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
     {
         $this->Pdf->setRTL(true);
     }
     $this->Pdf->setHeaderMargin(0);
     $this->Pdf->setFooterMargin(0);
     if ($this->Font_ttf)
     {
         $this->Pdf->SetFont($this->default_font, $this->default_style, 12, $this->def_TTF);
     }
     else
     {
         $this->Pdf->SetFont($this->default_font, $this->default_style, 12);
     }
     $this->Pdf->SetTextColor(0, 0, 0);
     $this->Pdf->SetAutoPageBreak(false);
 }
// 
//----- 
 function grid($linhas = 0)
 {
    global 
           $nm_saida, $nm_url_saida;
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['userid_int'] = "Userid Int";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['hiredate'] = "Hiredate";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['username'] = "Username";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['designation'] = "Designation";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['dept'] = "Dept";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['bank_number'] = "Bank Number";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['pay_startdate'] = "Pay Startdate";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['pay_enddate'] = "Pay Enddate";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['boni_value'] = "Boni Value";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['tax_iric'] = "Tax Iric";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['boni_net'] = "Boni Net";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['lbl_payperiod'] = "lbl_PayPeriod";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['lbl_amount01'] = "lbl_amount01";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['lbl_amount02'] = "lbl_amount02";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['lbl_companyname'] = "lbl_companyname";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['lbl_deductions'] = "lbl_deductions";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['lbl_dept'] = "lbl_dept";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['lbl_designation'] = "lbl_designation";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['lbl_earning'] = "lbl_earning";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['lbl_employeename'] = "lbl_employeename";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['lbl_fixedsalary'] = "lbl_fixedsalary";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['lbl_hiredate'] = "lbl_hiredate";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['lbl_id'] = "lbl_id";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['lbl_incentive'] = "lbl_incentive";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['lbl_line01'] = "lbl_line01";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['lbl_otvalue'] = "lbl_otvalue";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['lbl_payslip'] = "lbl_payslip";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['labels']['lbl_rappel'] = "lbl_rappel";
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['seq_dir'] = 0; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['sub_dir'] = array(); 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['where_pesq_filtro'];
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdf_boni_payslipsearch']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['pdf_boni_payslipsearch']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['pdf_boni_payslipsearch']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       $this->Pdf_init();
       $this->Pdf->AddPage();
       if ($this->Font_ttf_sr)
       {
           $this->Pdf->SetFont($this->default_font_sr, 'B', 12, $this->def_TTF);
       }
       else
       {
           $this->Pdf->SetFont($this->default_font_sr, 'B', 12);
       }
       $this->Pdf->Text(0.000000, 0.000000, html_entity_decode($this->nm_grid_sem_reg, ENT_COMPAT, $_SESSION['scriptcase']['charset']));
       $this->Pdf->Output($this->Ini->root . $this->Ini->nm_path_pdf, 'F');
       return;
   }
// 
   $Init_Pdf = true;
   $this->SC_seq_register = 0; 
   $Contr_Y_init          = 6; 
   $Contr_lin_Pdf         = 0; 
   $this->SC_desloca_col  = 108; 
   $this->SC_desloca_lin  = 65; 
   while (!$this->rs_grid->EOF) 
   {  
      $this->nm_grid_colunas = 0; 
      $nm_quant_linhas = 0;
      $this->SC_incr_col = 0; 
      $this->SC_incr_lin = $this->SC_desloca_lin * $Contr_lin_Pdf; 
      $Contr_lin_Pdf++; 
      if ($Init_Pdf || ($this->SC_incr_lin + $this->SC_desloca_lin + $Contr_Y_init) > 279.4)
      {
          $this->Pdf->setImageScale(1.33);
          $this->Pdf->AddPage();
          $this->Pdf_init();
          $this->SC_incr_lin = 0; 
          $Contr_lin_Pdf     = 1; 
          $Init_Pdf          = false; 
      }
      while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['qt_col_grid']) 
      {  
          $this->sc_proc_grid = true;
          $this->SC_seq_register++; 
          $this->SC_incr_col = $this->SC_desloca_col * $nm_quant_linhas; 
          $this->userid_int[$this->nm_grid_colunas] = $this->rs_grid->fields[0] ;  
          $this->userid_int[$this->nm_grid_colunas] = (string)$this->userid_int[$this->nm_grid_colunas];
          $this->hiredate[$this->nm_grid_colunas] = $this->rs_grid->fields[1] ;  
          $this->username[$this->nm_grid_colunas] = $this->rs_grid->fields[2] ;  
          $this->designation[$this->nm_grid_colunas] = $this->rs_grid->fields[3] ;  
          $this->dept[$this->nm_grid_colunas] = $this->rs_grid->fields[4] ;  
          $this->bank_number[$this->nm_grid_colunas] = $this->rs_grid->fields[5] ;  
          $this->pay_startdate[$this->nm_grid_colunas] = $this->rs_grid->fields[6] ;  
          $this->pay_enddate[$this->nm_grid_colunas] = $this->rs_grid->fields[7] ;  
          $this->boni_value[$this->nm_grid_colunas] = $this->rs_grid->fields[8] ;  
          $this->boni_value[$this->nm_grid_colunas] =  str_replace(",", ".", $this->boni_value[$this->nm_grid_colunas]);
          $this->boni_value[$this->nm_grid_colunas] = (string)$this->boni_value[$this->nm_grid_colunas];
          $this->tax_iric[$this->nm_grid_colunas] = $this->rs_grid->fields[9] ;  
          $this->tax_iric[$this->nm_grid_colunas] =  str_replace(",", ".", $this->tax_iric[$this->nm_grid_colunas]);
          $this->tax_iric[$this->nm_grid_colunas] = (string)$this->tax_iric[$this->nm_grid_colunas];
          $this->boni_net[$this->nm_grid_colunas] = $this->rs_grid->fields[10] ;  
          $this->boni_net[$this->nm_grid_colunas] =  str_replace(",", ".", $this->boni_net[$this->nm_grid_colunas]);
          $this->boni_net[$this->nm_grid_colunas] = (string)$this->boni_net[$this->nm_grid_colunas];
          $this->lbl_payperiod[$this->nm_grid_colunas] = "";
          $this->lbl_amount01[$this->nm_grid_colunas] = "";
          $this->lbl_amount02[$this->nm_grid_colunas] = "";
          $this->lbl_companyname[$this->nm_grid_colunas] = "";
          $this->lbl_deductions[$this->nm_grid_colunas] = "";
          $this->lbl_dept[$this->nm_grid_colunas] = "";
          $this->lbl_designation[$this->nm_grid_colunas] = "";
          $this->lbl_earning[$this->nm_grid_colunas] = "";
          $this->lbl_employeename[$this->nm_grid_colunas] = "";
          $this->lbl_fixedsalary[$this->nm_grid_colunas] = "";
          $this->lbl_hiredate[$this->nm_grid_colunas] = "";
          $this->lbl_id[$this->nm_grid_colunas] = "";
          $this->lbl_incentive[$this->nm_grid_colunas] = "";
          $this->lbl_line01[$this->nm_grid_colunas] = "";
          $this->lbl_otvalue[$this->nm_grid_colunas] = "";
          $this->lbl_payslip[$this->nm_grid_colunas] = "";
          $this->lbl_rappel[$this->nm_grid_colunas] = "";
          $this->Lookup->lookup_lbl_companyname($this->lbl_companyname[$this->nm_grid_colunas], $this->array_lbl_companyname); 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->userid_int[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->userid_int[$this->nm_grid_colunas]));
          }
          else {
              $this->userid_int[$this->nm_grid_colunas] = sc_strip_script($this->userid_int[$this->nm_grid_colunas]);
          }
          if ($this->userid_int[$this->nm_grid_colunas] === "") 
          { 
              $this->userid_int[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->userid_int[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->userid_int[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->userid_int[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->hiredate[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->hiredate[$this->nm_grid_colunas]));
          }
          else {
              $this->hiredate[$this->nm_grid_colunas] = sc_strip_script($this->hiredate[$this->nm_grid_colunas]);
          }
          if ($this->hiredate[$this->nm_grid_colunas] === "") 
          { 
              $this->hiredate[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
               $hiredate_x =  $this->hiredate[$this->nm_grid_colunas];
               nm_conv_limpa_dado($hiredate_x, "YYYY-MM-DD");
               if (is_numeric($hiredate_x) && strlen($hiredate_x) > 0) 
               { 
                   $this->nm_data->SetaData($this->hiredate[$this->nm_grid_colunas], "YYYY-MM-DD");
                   $this->hiredate[$this->nm_grid_colunas] = html_entity_decode($this->nm_data->FormataSaida("d-M-Y"), ENT_COMPAT, $_SESSION['scriptcase']['charset']);
               } 
          } 
          $this->hiredate[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->hiredate[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->username[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->username[$this->nm_grid_colunas]));
          }
          else {
              $this->username[$this->nm_grid_colunas] = sc_strip_script($this->username[$this->nm_grid_colunas]);
          }
          if ($this->username[$this->nm_grid_colunas] === "") 
          { 
              $this->username[$this->nm_grid_colunas] = "" ;  
          } 
          $this->username[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->username[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->designation[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->designation[$this->nm_grid_colunas]));
          }
          else {
              $this->designation[$this->nm_grid_colunas] = sc_strip_script($this->designation[$this->nm_grid_colunas]);
          }
          if ($this->designation[$this->nm_grid_colunas] === "") 
          { 
              $this->designation[$this->nm_grid_colunas] = "" ;  
          } 
          if ($this->designation[$this->nm_grid_colunas] !== "") 
          { 
              $this->designation[$this->nm_grid_colunas] = sc_strtoupper($this->designation[$this->nm_grid_colunas]); 
          } 
          $this->designation[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->designation[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->dept[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->dept[$this->nm_grid_colunas]));
          }
          else {
              $this->dept[$this->nm_grid_colunas] = sc_strip_script($this->dept[$this->nm_grid_colunas]);
          }
          if ($this->dept[$this->nm_grid_colunas] === "") 
          { 
              $this->dept[$this->nm_grid_colunas] = "" ;  
          } 
          if ($this->dept[$this->nm_grid_colunas] !== "") 
          { 
              $this->dept[$this->nm_grid_colunas] = sc_strtoupper($this->dept[$this->nm_grid_colunas]); 
          } 
          $this->dept[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->dept[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->bank_number[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->bank_number[$this->nm_grid_colunas]));
          }
          else {
              $this->bank_number[$this->nm_grid_colunas] = sc_strip_script($this->bank_number[$this->nm_grid_colunas]);
          }
          if ($this->bank_number[$this->nm_grid_colunas] === "") 
          { 
              $this->bank_number[$this->nm_grid_colunas] = "" ;  
          } 
          $this->bank_number[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->bank_number[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->pay_startdate[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->pay_startdate[$this->nm_grid_colunas]));
          }
          else {
              $this->pay_startdate[$this->nm_grid_colunas] = sc_strip_script($this->pay_startdate[$this->nm_grid_colunas]);
          }
          if ($this->pay_startdate[$this->nm_grid_colunas] === "") 
          { 
              $this->pay_startdate[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
               $pay_startdate_x =  $this->pay_startdate[$this->nm_grid_colunas];
               nm_conv_limpa_dado($pay_startdate_x, "YYYY-MM-DD");
               if (is_numeric($pay_startdate_x) && strlen($pay_startdate_x) > 0) 
               { 
                   $this->nm_data->SetaData($this->pay_startdate[$this->nm_grid_colunas], "YYYY-MM-DD");
                   $this->pay_startdate[$this->nm_grid_colunas] = html_entity_decode($this->nm_data->FormataSaida("d-M-Y"), ENT_COMPAT, $_SESSION['scriptcase']['charset']);
               } 
          } 
          $this->pay_startdate[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->pay_startdate[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->pay_enddate[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->pay_enddate[$this->nm_grid_colunas]));
          }
          else {
              $this->pay_enddate[$this->nm_grid_colunas] = sc_strip_script($this->pay_enddate[$this->nm_grid_colunas]);
          }
          if ($this->pay_enddate[$this->nm_grid_colunas] === "") 
          { 
              $this->pay_enddate[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
               $pay_enddate_x =  $this->pay_enddate[$this->nm_grid_colunas];
               nm_conv_limpa_dado($pay_enddate_x, "YYYY-MM-DD");
               if (is_numeric($pay_enddate_x) && strlen($pay_enddate_x) > 0) 
               { 
                   $this->nm_data->SetaData($this->pay_enddate[$this->nm_grid_colunas], "YYYY-MM-DD");
                   $this->pay_enddate[$this->nm_grid_colunas] = html_entity_decode($this->nm_data->FormataSaida("d-M-Y"), ENT_COMPAT, $_SESSION['scriptcase']['charset']);
               } 
          } 
          $this->pay_enddate[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->pay_enddate[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->boni_value[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->boni_value[$this->nm_grid_colunas]));
          }
          else {
              $this->boni_value[$this->nm_grid_colunas] = sc_strip_script($this->boni_value[$this->nm_grid_colunas]);
          }
          if ($this->boni_value[$this->nm_grid_colunas] === "") 
          { 
              $this->boni_value[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->boni_value[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:12", "-") ; 
          } 
          $this->boni_value[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->boni_value[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->tax_iric[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->tax_iric[$this->nm_grid_colunas]));
          }
          else {
              $this->tax_iric[$this->nm_grid_colunas] = sc_strip_script($this->tax_iric[$this->nm_grid_colunas]);
          }
          if ($this->tax_iric[$this->nm_grid_colunas] === "") 
          { 
              $this->tax_iric[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->tax_iric[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:12", "-") ; 
          } 
          $this->tax_iric[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->tax_iric[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->boni_net[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->boni_net[$this->nm_grid_colunas]));
          }
          else {
              $this->boni_net[$this->nm_grid_colunas] = sc_strip_script($this->boni_net[$this->nm_grid_colunas]);
          }
          if ($this->boni_net[$this->nm_grid_colunas] === "") 
          { 
              $this->boni_net[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->boni_net[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:12", "-") ; 
          } 
          $this->boni_net[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->boni_net[$this->nm_grid_colunas]);
          if ($this->lbl_payperiod[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_payperiod[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_payperiod[$this->nm_grid_colunas], "Pay Period"); 
          $this->lbl_payperiod[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_payperiod[$this->nm_grid_colunas]);
          if ($this->lbl_amount01[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_amount01[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_amount01[$this->nm_grid_colunas], "Amount"); 
          $this->lbl_amount01[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_amount01[$this->nm_grid_colunas]);
          if ($this->lbl_amount02[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_amount02[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_amount02[$this->nm_grid_colunas], "Amount"); 
          $this->lbl_amount02[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_amount02[$this->nm_grid_colunas]);
          $this->Lookup->lookup_lbl_companyname($this->lbl_companyname[$this->nm_grid_colunas], $this->array_lbl_companyname); 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_boni_payslipsearch']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->lbl_companyname[$this->nm_grid_colunas] = trim(NM_encode_input(sc_strip_script($this->lbl_companyname[$this->nm_grid_colunas]))); 
          }
          else {
              $this->lbl_companyname[$this->nm_grid_colunas] = trim(sc_strip_script($this->lbl_companyname[$this->nm_grid_colunas])); 
          }
          if ($this->lbl_companyname[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_companyname[$this->nm_grid_colunas] = "" ;  
          } 
          if ($this->lbl_companyname[$this->nm_grid_colunas] !== "") 
          { 
              $this->lbl_companyname[$this->nm_grid_colunas] = sc_strtoupper($this->lbl_companyname[$this->nm_grid_colunas]); 
          } 
          $this->lbl_companyname[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_companyname[$this->nm_grid_colunas]);
          if ($this->lbl_deductions[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_deductions[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_deductions[$this->nm_grid_colunas], "Deductions"); 
          $this->lbl_deductions[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_deductions[$this->nm_grid_colunas]);
          if ($this->lbl_dept[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_dept[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_dept[$this->nm_grid_colunas], "Department"); 
          $this->lbl_dept[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_dept[$this->nm_grid_colunas]);
          if ($this->lbl_designation[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_designation[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_designation[$this->nm_grid_colunas], "Designation"); 
          $this->lbl_designation[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_designation[$this->nm_grid_colunas]);
          if ($this->lbl_earning[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_earning[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_earning[$this->nm_grid_colunas], "Earning"); 
          $this->lbl_earning[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_earning[$this->nm_grid_colunas]);
          if ($this->lbl_employeename[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_employeename[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_employeename[$this->nm_grid_colunas], "Employee Name"); 
          $this->lbl_employeename[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_employeename[$this->nm_grid_colunas]);
          if ($this->lbl_fixedsalary[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_fixedsalary[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_fixedsalary[$this->nm_grid_colunas], "Basic Salary"); 
          $this->lbl_fixedsalary[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_fixedsalary[$this->nm_grid_colunas]);
          if ($this->lbl_hiredate[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_hiredate[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_hiredate[$this->nm_grid_colunas], "Hire Date"); 
          $this->lbl_hiredate[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_hiredate[$this->nm_grid_colunas]);
          if ($this->lbl_id[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_id[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_id[$this->nm_grid_colunas], "Fingertec ID"); 
          $this->lbl_id[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_id[$this->nm_grid_colunas]);
          if ($this->lbl_incentive[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_incentive[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_incentive[$this->nm_grid_colunas], "Incentive"); 
          $this->lbl_incentive[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_incentive[$this->nm_grid_colunas]);
          if ($this->lbl_line01[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_line01[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_line01[$this->nm_grid_colunas], "________________________________________________________________"); 
          $this->lbl_line01[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_line01[$this->nm_grid_colunas]);
          if ($this->lbl_otvalue[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_otvalue[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_otvalue[$this->nm_grid_colunas], "Over Time"); 
          $this->lbl_otvalue[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_otvalue[$this->nm_grid_colunas]);
          if ($this->lbl_payslip[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_payslip[$this->nm_grid_colunas] = "" ;  
          } 
          if ($this->lbl_payslip[$this->nm_grid_colunas] !== "") 
          { 
              $this->lbl_payslip[$this->nm_grid_colunas] = sc_strtoupper($this->lbl_payslip[$this->nm_grid_colunas]); 
          } 
          $this->nm_gera_mask($this->lbl_payslip[$this->nm_grid_colunas], "BONI PAYSLIP REPRINT"); 
          $this->lbl_payslip[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_payslip[$this->nm_grid_colunas]);
          if ($this->lbl_rappel[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_rappel[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_rappel[$this->nm_grid_colunas], "Rappel"); 
          $this->lbl_rappel[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_rappel[$this->nm_grid_colunas]);
            $cell_userid_int = array('posx' => '40', 'posy' => '18.50', 'data' => $this->userid_int[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_username = array('posx' => '123', 'posy' => '18.50', 'data' => $this->username[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_PayPeriod = array('posx' => '9.5', 'posy' => '30.50', 'data' => $this->lbl_payperiod[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_designation = array('posx' => '84.99792499998928', 'posy' => '24.50', 'data' => $this->lbl_designation[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_dept = array('posx' => '85', 'posy' => '30.50', 'data' => $this->lbl_dept[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_companyname = array('posx' => '9.498004748533958', 'posy' => '11.50', 'data' => $this->lbl_companyname[$this->nm_grid_colunas], 'width'      => '200', 'align'      => 'C', 'font_type'  => $this->default_font, 'font_size'  => '15', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_lbl_employeename = array('posx' => '85', 'posy' => '18.50', 'data' => $this->lbl_employeename[$this->nm_grid_colunas], 'width'      => '10', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_hiredate = array('posx' => '9.5', 'posy' => '24.50', 'data' => $this->lbl_hiredate[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $hiredate = array('posx' => '40', 'posy' => '24.50', 'data' => $this->hiredate[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_id = array('posx' => '9.50', 'posy' => '18.50', 'data' => $this->lbl_id[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cellpaystartdate = array('posx' => '40.26323333332825', 'posy' => '30.50', 'data' => $this->pay_startdate[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $celldesignation = array('posx' => '123', 'posy' => '24.50', 'data' => $this->designation[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $celldepartment = array('posx' => '123', 'posy' => '30.50', 'data' => $this->dept[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_earning = array('posx' => '9.5', 'posy' => '42', 'data' => $this->lbl_earning[$this->nm_grid_colunas], 'width'      => '50', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_lbl_fixedsalary = array('posx' => '9.50', 'posy' => '50', 'data' => $this->SC_conv_utf8('Boni Value'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_iric = array('posx' => '109.50', 'posy' => '50', 'data' => $this->SC_conv_utf8('IRI/BONI'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_iric = array('posx' => '159.4995645833132', 'posy' => '50', 'data' => $this->tax_iric[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_salnet = array('posx' => '59.50', 'posy' => '56.23', 'data' => $this->SC_conv_utf8('NET EARNINGS'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_89 = array('posx' => '9.23', 'posy' => '58.23', 'data' => $this->SC_conv_utf8('________________________________________________________________________________'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $celllblamount = array('posx' => '59.49896308186099', 'posy' => '42', 'data' => $this->SC_conv_utf8('Amount'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_91 = array('posx' => '159', 'posy' => '42', 'data' => $this->SC_conv_utf8('Amount'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_93 = array('posx' => '109.50', 'posy' => '42', 'data' => $this->SC_conv_utf8('Deductions'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_94 = array('posx' => '59.76', 'posy' => '50', 'data' => $this->boni_value[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_96 = array('posx' => '109.50', 'posy' => '56.23', 'data' => $this->boni_net[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_97 = array('posx' => '40', 'posy' => '36.50', 'data' => $this->pay_enddate[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_payslip = array('posx' => '9.5', 'posy' => '6', 'data' => $this->lbl_payslip[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'C', 'font_type'  => $this->default_font, 'font_size'  => '15', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');


            $this->Pdf->SetFont($cell_userid_int['font_type'], $cell_userid_int['font_style'], $cell_userid_int['font_size']);
            $this->pdf_text_color($cell_userid_int['data'], $cell_userid_int['color_r'], $cell_userid_int['color_g'], $cell_userid_int['color_b']);
            if (!empty($cell_userid_int['posx']) && !empty($cell_userid_int['posy']))
            {
                $this->Pdf->SetXY($cell_userid_int['posx'] + $this->SC_incr_col,  $cell_userid_int['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_userid_int['posx']))
            {
                $this->Pdf->SetX($cell_userid_int['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_userid_int['posy']))
            {
                $this->Pdf->SetY($cell_userid_int['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_userid_int['width'], 0, $cell_userid_int['data'], 0, 0, $cell_userid_int['align']);

            $this->Pdf->SetFont($cell_username['font_type'], $cell_username['font_style'], $cell_username['font_size']);
            $this->pdf_text_color($cell_username['data'], $cell_username['color_r'], $cell_username['color_g'], $cell_username['color_b']);
            if (!empty($cell_username['posx']) && !empty($cell_username['posy']))
            {
                $this->Pdf->SetXY($cell_username['posx'] + $this->SC_incr_col,  $cell_username['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_username['posx']))
            {
                $this->Pdf->SetX($cell_username['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_username['posy']))
            {
                $this->Pdf->SetY($cell_username['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_username['width'], 0, $cell_username['data'], 0, 0, $cell_username['align']);

            $this->Pdf->SetFont($cell_lbl_PayPeriod['font_type'], $cell_lbl_PayPeriod['font_style'], $cell_lbl_PayPeriod['font_size']);
            $this->pdf_text_color($cell_lbl_PayPeriod['data'], $cell_lbl_PayPeriod['color_r'], $cell_lbl_PayPeriod['color_g'], $cell_lbl_PayPeriod['color_b']);
            if (!empty($cell_lbl_PayPeriod['posx']) && !empty($cell_lbl_PayPeriod['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_PayPeriod['posx'] + $this->SC_incr_col,  $cell_lbl_PayPeriod['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_PayPeriod['posx']))
            {
                $this->Pdf->SetX($cell_lbl_PayPeriod['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_PayPeriod['posy']))
            {
                $this->Pdf->SetY($cell_lbl_PayPeriod['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_PayPeriod['width'], 0, $cell_lbl_PayPeriod['data'], 0, 0, $cell_lbl_PayPeriod['align']);

            $this->Pdf->SetFont($cell_lbl_designation['font_type'], $cell_lbl_designation['font_style'], $cell_lbl_designation['font_size']);
            $this->pdf_text_color($cell_lbl_designation['data'], $cell_lbl_designation['color_r'], $cell_lbl_designation['color_g'], $cell_lbl_designation['color_b']);
            if (!empty($cell_lbl_designation['posx']) && !empty($cell_lbl_designation['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_designation['posx'] + $this->SC_incr_col,  $cell_lbl_designation['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_designation['posx']))
            {
                $this->Pdf->SetX($cell_lbl_designation['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_designation['posy']))
            {
                $this->Pdf->SetY($cell_lbl_designation['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_designation['width'], 0, $cell_lbl_designation['data'], 0, 0, $cell_lbl_designation['align']);

            $this->Pdf->SetFont($cell_lbl_dept['font_type'], $cell_lbl_dept['font_style'], $cell_lbl_dept['font_size']);
            $this->pdf_text_color($cell_lbl_dept['data'], $cell_lbl_dept['color_r'], $cell_lbl_dept['color_g'], $cell_lbl_dept['color_b']);
            if (!empty($cell_lbl_dept['posx']) && !empty($cell_lbl_dept['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_dept['posx'] + $this->SC_incr_col,  $cell_lbl_dept['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_dept['posx']))
            {
                $this->Pdf->SetX($cell_lbl_dept['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_dept['posy']))
            {
                $this->Pdf->SetY($cell_lbl_dept['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_dept['width'], 0, $cell_lbl_dept['data'], 0, 0, $cell_lbl_dept['align']);

            $this->Pdf->SetFont($cell_lbl_companyname['font_type'], $cell_lbl_companyname['font_style'], $cell_lbl_companyname['font_size']);
            $this->pdf_text_color($cell_lbl_companyname['data'], $cell_lbl_companyname['color_r'], $cell_lbl_companyname['color_g'], $cell_lbl_companyname['color_b']);
            if (!empty($cell_lbl_companyname['posx']) && !empty($cell_lbl_companyname['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_companyname['posx'] + $this->SC_incr_col,  $cell_lbl_companyname['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_companyname['posx']))
            {
                $this->Pdf->SetX($cell_lbl_companyname['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_companyname['posy']))
            {
                $this->Pdf->SetY($cell_lbl_companyname['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_companyname['width'], 0, $cell_lbl_companyname['data'], 0, 0, $cell_lbl_companyname['align']);

            $this->Pdf->SetFont($cell_lbl_employeename['font_type'], $cell_lbl_employeename['font_style'], $cell_lbl_employeename['font_size']);
            $this->pdf_text_color($cell_lbl_employeename['data'], $cell_lbl_employeename['color_r'], $cell_lbl_employeename['color_g'], $cell_lbl_employeename['color_b']);
            if (!empty($cell_lbl_employeename['posx']) && !empty($cell_lbl_employeename['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_employeename['posx'] + $this->SC_incr_col,  $cell_lbl_employeename['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_employeename['posx']))
            {
                $this->Pdf->SetX($cell_lbl_employeename['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_employeename['posy']))
            {
                $this->Pdf->SetY($cell_lbl_employeename['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_employeename['width'], 0, $cell_lbl_employeename['data'], 0, 0, $cell_lbl_employeename['align']);

            $this->Pdf->SetFont($cell_lbl_hiredate['font_type'], $cell_lbl_hiredate['font_style'], $cell_lbl_hiredate['font_size']);
            $this->pdf_text_color($cell_lbl_hiredate['data'], $cell_lbl_hiredate['color_r'], $cell_lbl_hiredate['color_g'], $cell_lbl_hiredate['color_b']);
            if (!empty($cell_lbl_hiredate['posx']) && !empty($cell_lbl_hiredate['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_hiredate['posx'] + $this->SC_incr_col,  $cell_lbl_hiredate['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_hiredate['posx']))
            {
                $this->Pdf->SetX($cell_lbl_hiredate['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_hiredate['posy']))
            {
                $this->Pdf->SetY($cell_lbl_hiredate['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_hiredate['width'], 0, $cell_lbl_hiredate['data'], 0, 0, $cell_lbl_hiredate['align']);

            $this->Pdf->SetFont($hiredate['font_type'], $hiredate['font_style'], $hiredate['font_size']);
            $this->pdf_text_color($hiredate['data'], $hiredate['color_r'], $hiredate['color_g'], $hiredate['color_b']);
            if (!empty($hiredate['posx']) && !empty($hiredate['posy']))
            {
                $this->Pdf->SetXY($hiredate['posx'] + $this->SC_incr_col,  $hiredate['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($hiredate['posx']))
            {
                $this->Pdf->SetX($hiredate['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($hiredate['posy']))
            {
                $this->Pdf->SetY($hiredate['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($hiredate['width'], 0, $hiredate['data'], 0, 0, $hiredate['align']);

            $this->Pdf->SetFont($cell_lbl_id['font_type'], $cell_lbl_id['font_style'], $cell_lbl_id['font_size']);
            $this->pdf_text_color($cell_lbl_id['data'], $cell_lbl_id['color_r'], $cell_lbl_id['color_g'], $cell_lbl_id['color_b']);
            if (!empty($cell_lbl_id['posx']) && !empty($cell_lbl_id['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_id['posx'] + $this->SC_incr_col,  $cell_lbl_id['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_id['posx']))
            {
                $this->Pdf->SetX($cell_lbl_id['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_id['posy']))
            {
                $this->Pdf->SetY($cell_lbl_id['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_id['width'], 0, $cell_lbl_id['data'], 0, 0, $cell_lbl_id['align']);

            $this->Pdf->SetFont($cellpaystartdate['font_type'], $cellpaystartdate['font_style'], $cellpaystartdate['font_size']);
            $this->pdf_text_color($cellpaystartdate['data'], $cellpaystartdate['color_r'], $cellpaystartdate['color_g'], $cellpaystartdate['color_b']);
            if (!empty($cellpaystartdate['posx']) && !empty($cellpaystartdate['posy']))
            {
                $this->Pdf->SetXY($cellpaystartdate['posx'] + $this->SC_incr_col,  $cellpaystartdate['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cellpaystartdate['posx']))
            {
                $this->Pdf->SetX($cellpaystartdate['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cellpaystartdate['posy']))
            {
                $this->Pdf->SetY($cellpaystartdate['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cellpaystartdate['width'], 0, $cellpaystartdate['data'], 0, 0, $cellpaystartdate['align']);

            $this->Pdf->SetFont($celldesignation['font_type'], $celldesignation['font_style'], $celldesignation['font_size']);
            $this->pdf_text_color($celldesignation['data'], $celldesignation['color_r'], $celldesignation['color_g'], $celldesignation['color_b']);
            if (!empty($celldesignation['posx']) && !empty($celldesignation['posy']))
            {
                $this->Pdf->SetXY($celldesignation['posx'] + $this->SC_incr_col,  $celldesignation['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($celldesignation['posx']))
            {
                $this->Pdf->SetX($celldesignation['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($celldesignation['posy']))
            {
                $this->Pdf->SetY($celldesignation['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($celldesignation['width'], 0, $celldesignation['data'], 0, 0, $celldesignation['align']);

            $this->Pdf->SetFont($celldepartment['font_type'], $celldepartment['font_style'], $celldepartment['font_size']);
            $this->pdf_text_color($celldepartment['data'], $celldepartment['color_r'], $celldepartment['color_g'], $celldepartment['color_b']);
            if (!empty($celldepartment['posx']) && !empty($celldepartment['posy']))
            {
                $this->Pdf->SetXY($celldepartment['posx'] + $this->SC_incr_col,  $celldepartment['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($celldepartment['posx']))
            {
                $this->Pdf->SetX($celldepartment['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($celldepartment['posy']))
            {
                $this->Pdf->SetY($celldepartment['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($celldepartment['width'], 0, $celldepartment['data'], 0, 0, $celldepartment['align']);

            $this->Pdf->SetFont($cell_lbl_earning['font_type'], $cell_lbl_earning['font_style'], $cell_lbl_earning['font_size']);
            $this->pdf_text_color($cell_lbl_earning['data'], $cell_lbl_earning['color_r'], $cell_lbl_earning['color_g'], $cell_lbl_earning['color_b']);
            if (!empty($cell_lbl_earning['posx']) && !empty($cell_lbl_earning['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_earning['posx'] + $this->SC_incr_col,  $cell_lbl_earning['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_earning['posx']))
            {
                $this->Pdf->SetX($cell_lbl_earning['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_earning['posy']))
            {
                $this->Pdf->SetY($cell_lbl_earning['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_earning['width'], 0, $cell_lbl_earning['data'], 0, 0, $cell_lbl_earning['align']);

            $this->Pdf->SetFont($cell_lbl_fixedsalary['font_type'], $cell_lbl_fixedsalary['font_style'], $cell_lbl_fixedsalary['font_size']);
            $this->pdf_text_color($cell_lbl_fixedsalary['data'], $cell_lbl_fixedsalary['color_r'], $cell_lbl_fixedsalary['color_g'], $cell_lbl_fixedsalary['color_b']);
            if (!empty($cell_lbl_fixedsalary['posx']) && !empty($cell_lbl_fixedsalary['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_fixedsalary['posx'] + $this->SC_incr_col,  $cell_lbl_fixedsalary['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_fixedsalary['posx']))
            {
                $this->Pdf->SetX($cell_lbl_fixedsalary['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_fixedsalary['posy']))
            {
                $this->Pdf->SetY($cell_lbl_fixedsalary['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_fixedsalary['width'], 0, $cell_lbl_fixedsalary['data'], 0, 0, $cell_lbl_fixedsalary['align']);

            $this->Pdf->SetFont($cell_lbl_iric['font_type'], $cell_lbl_iric['font_style'], $cell_lbl_iric['font_size']);
            $this->pdf_text_color($cell_lbl_iric['data'], $cell_lbl_iric['color_r'], $cell_lbl_iric['color_g'], $cell_lbl_iric['color_b']);
            if (!empty($cell_lbl_iric['posx']) && !empty($cell_lbl_iric['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_iric['posx'] + $this->SC_incr_col,  $cell_lbl_iric['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_iric['posx']))
            {
                $this->Pdf->SetX($cell_lbl_iric['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_iric['posy']))
            {
                $this->Pdf->SetY($cell_lbl_iric['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_iric['width'], 0, $cell_lbl_iric['data'], 0, 0, $cell_lbl_iric['align']);

            $this->Pdf->SetFont($cell_iric['font_type'], $cell_iric['font_style'], $cell_iric['font_size']);
            $this->pdf_text_color($cell_iric['data'], $cell_iric['color_r'], $cell_iric['color_g'], $cell_iric['color_b']);
            if (!empty($cell_iric['posx']) && !empty($cell_iric['posy']))
            {
                $this->Pdf->SetXY($cell_iric['posx'] + $this->SC_incr_col,  $cell_iric['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_iric['posx']))
            {
                $this->Pdf->SetX($cell_iric['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_iric['posy']))
            {
                $this->Pdf->SetY($cell_iric['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_iric['width'], 0, $cell_iric['data'], 0, 0, $cell_iric['align']);

            $this->Pdf->SetFont($cell_lbl_salnet['font_type'], $cell_lbl_salnet['font_style'], $cell_lbl_salnet['font_size']);
            $this->pdf_text_color($cell_lbl_salnet['data'], $cell_lbl_salnet['color_r'], $cell_lbl_salnet['color_g'], $cell_lbl_salnet['color_b']);
            if (!empty($cell_lbl_salnet['posx']) && !empty($cell_lbl_salnet['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_salnet['posx'] + $this->SC_incr_col,  $cell_lbl_salnet['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_salnet['posx']))
            {
                $this->Pdf->SetX($cell_lbl_salnet['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_salnet['posy']))
            {
                $this->Pdf->SetY($cell_lbl_salnet['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_salnet['width'], 0, $cell_lbl_salnet['data'], 0, 0, $cell_lbl_salnet['align']);

            $this->Pdf->SetFont($cell_89['font_type'], $cell_89['font_style'], $cell_89['font_size']);
            $this->pdf_text_color($cell_89['data'], $cell_89['color_r'], $cell_89['color_g'], $cell_89['color_b']);
            if (!empty($cell_89['posx']) && !empty($cell_89['posy']))
            {
                $this->Pdf->SetXY($cell_89['posx'] + $this->SC_incr_col,  $cell_89['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_89['posx']))
            {
                $this->Pdf->SetX($cell_89['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_89['posy']))
            {
                $this->Pdf->SetY($cell_89['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_89['width'], 0, $cell_89['data'], 0, 0, $cell_89['align']);

            $this->Pdf->SetFont($celllblamount['font_type'], $celllblamount['font_style'], $celllblamount['font_size']);
            $this->pdf_text_color($celllblamount['data'], $celllblamount['color_r'], $celllblamount['color_g'], $celllblamount['color_b']);
            if (!empty($celllblamount['posx']) && !empty($celllblamount['posy']))
            {
                $this->Pdf->SetXY($celllblamount['posx'] + $this->SC_incr_col,  $celllblamount['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($celllblamount['posx']))
            {
                $this->Pdf->SetX($celllblamount['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($celllblamount['posy']))
            {
                $this->Pdf->SetY($celllblamount['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($celllblamount['width'], 0, $celllblamount['data'], 0, 0, $celllblamount['align']);

            $this->Pdf->SetFont($cell_91['font_type'], $cell_91['font_style'], $cell_91['font_size']);
            $this->pdf_text_color($cell_91['data'], $cell_91['color_r'], $cell_91['color_g'], $cell_91['color_b']);
            if (!empty($cell_91['posx']) && !empty($cell_91['posy']))
            {
                $this->Pdf->SetXY($cell_91['posx'] + $this->SC_incr_col,  $cell_91['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_91['posx']))
            {
                $this->Pdf->SetX($cell_91['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_91['posy']))
            {
                $this->Pdf->SetY($cell_91['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_91['width'], 0, $cell_91['data'], 0, 0, $cell_91['align']);

            $this->Pdf->SetFont($cell_93['font_type'], $cell_93['font_style'], $cell_93['font_size']);
            $this->pdf_text_color($cell_93['data'], $cell_93['color_r'], $cell_93['color_g'], $cell_93['color_b']);
            if (!empty($cell_93['posx']) && !empty($cell_93['posy']))
            {
                $this->Pdf->SetXY($cell_93['posx'] + $this->SC_incr_col,  $cell_93['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_93['posx']))
            {
                $this->Pdf->SetX($cell_93['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_93['posy']))
            {
                $this->Pdf->SetY($cell_93['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_93['width'], 0, $cell_93['data'], 0, 0, $cell_93['align']);

            $this->Pdf->SetFont($cell_94['font_type'], $cell_94['font_style'], $cell_94['font_size']);
            $this->pdf_text_color($cell_94['data'], $cell_94['color_r'], $cell_94['color_g'], $cell_94['color_b']);
            if (!empty($cell_94['posx']) && !empty($cell_94['posy']))
            {
                $this->Pdf->SetXY($cell_94['posx'] + $this->SC_incr_col,  $cell_94['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_94['posx']))
            {
                $this->Pdf->SetX($cell_94['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_94['posy']))
            {
                $this->Pdf->SetY($cell_94['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_94['width'], 0, $cell_94['data'], 0, 0, $cell_94['align']);

            $this->Pdf->SetFont($cell_96['font_type'], $cell_96['font_style'], $cell_96['font_size']);
            $this->pdf_text_color($cell_96['data'], $cell_96['color_r'], $cell_96['color_g'], $cell_96['color_b']);
            if (!empty($cell_96['posx']) && !empty($cell_96['posy']))
            {
                $this->Pdf->SetXY($cell_96['posx'] + $this->SC_incr_col,  $cell_96['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_96['posx']))
            {
                $this->Pdf->SetX($cell_96['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_96['posy']))
            {
                $this->Pdf->SetY($cell_96['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_96['width'], 0, $cell_96['data'], 0, 0, $cell_96['align']);

            $this->Pdf->SetFont($cell_97['font_type'], $cell_97['font_style'], $cell_97['font_size']);
            $this->pdf_text_color($cell_97['data'], $cell_97['color_r'], $cell_97['color_g'], $cell_97['color_b']);
            if (!empty($cell_97['posx']) && !empty($cell_97['posy']))
            {
                $this->Pdf->SetXY($cell_97['posx'] + $this->SC_incr_col,  $cell_97['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_97['posx']))
            {
                $this->Pdf->SetX($cell_97['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_97['posy']))
            {
                $this->Pdf->SetY($cell_97['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_97['width'], 0, $cell_97['data'], 0, 0, $cell_97['align']);

            $this->Pdf->SetFont($cell_lbl_payslip['font_type'], $cell_lbl_payslip['font_style'], $cell_lbl_payslip['font_size']);
            $this->pdf_text_color($cell_lbl_payslip['data'], $cell_lbl_payslip['color_r'], $cell_lbl_payslip['color_g'], $cell_lbl_payslip['color_b']);
            if (!empty($cell_lbl_payslip['posx']) && !empty($cell_lbl_payslip['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_payslip['posx'] + $this->SC_incr_col,  $cell_lbl_payslip['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_payslip['posx']))
            {
                $this->Pdf->SetX($cell_lbl_payslip['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_payslip['posy']))
            {
                $this->Pdf->SetY($cell_lbl_payslip['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_payslip['width'], 0, $cell_lbl_payslip['data'], 0, 0, $cell_lbl_payslip['align']);
          $max_Y = 0;
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
      }  
   }  
   $this->rs_grid->Close();
   $this->Pdf->Output($this->Ini->root . $this->Ini->nm_path_pdf, 'F');
 }
 function pdf_text_color(&$val, $r, $g, $b)
 {
     if (is_array($val)) {
         $val = "";
     }
     $pos = strpos($val, "@SCNEG#");
     if ($pos !== false)
     {
         $cor = trim(substr($val, $pos + 7));
         $val = substr($val, 0, $pos);
         $cor = (substr($cor, 0, 1) == "#") ? substr($cor, 1) : $cor;
         if (strlen($cor) == 6)
         {
             $r = hexdec(substr($cor, 0, 2));
             $g = hexdec(substr($cor, 2, 2));
             $b = hexdec(substr($cor, 4, 2));
         }
     }
     $this->Pdf->SetTextColor($r, $g, $b);
 }
 function SC_conv_utf8($input)
 {
     if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($input))
     {
         $input = sc_convert_encoding($input, "UTF-8", $_SESSION['scriptcase']['charset']);
     }
     return $input;
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
