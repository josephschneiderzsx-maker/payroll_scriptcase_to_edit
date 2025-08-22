<?php
class pdf_attslip_all_grid
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
   var $lbl_sal_reg = array();
   var $lbl_amount01 = array();
   var $lbl_amount02 = array();
   var $lbl_companyname = array();
   var $lbl_deductions = array();
   var $lbl_earning = array();
   var $lbl_employeename = array();
   var $lbl_fixedsalary = array();
   var $lbl_line01 = array();
   var $lbl_payslip = array();
   var $lbl_rappel = array();
   var $userid_int = array();
   var $hiredate = array();
   var $username = array();
   var $dept = array();
   var $designation = array();
   var $work_hh_w = array();
   var $work_hh_w_pm = array();
   var $ot_hh_w = array();
   var $ot_hh_w_pm = array();
   var $work_hh_h = array();
   var $work_hh_h_pm = array();
   var $ot_hh_h = array();
   var $ot_hh_h_pm = array();
   var $work_hh_r = array();
   var $work_hh_r_pm = array();
   var $ot_hh_r = array();
   var $ot_hh_r_pm = array();
   var $work_hh_o = array();
   var $work_hh_o_pm = array();
   var $ot_hh_o = array();
   var $ot_hh_o_pm = array();
   var $hh_sunday = array();
   var $hh_offday = array();
   var $hh_leavetype = array();
   var $pay_startdate = array();
   var $pay_enddate = array();
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
   $_SESSION['scriptcase']['pdf_attslip_all']['default_font'] = $this->default_font;
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
           if (in_array("pdf_attslip_all", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['exit'] = "on";
   $this->sc_proc_grid = false; 
   $this->NM_raiz_img = $this->Ini->root;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $this->nm_grid_colunas = 0;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['campos_busca'];
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
       $this->dept[0] = (isset($Busca_temp['dept'])) ? $Busca_temp['dept'] : ""; 
       $tmp_pos = (is_string($this->dept[0])) ? strpos($this->dept[0], "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->dept[0]))
       {
           $this->dept[0] = substr($this->dept[0], 0, $tmp_pos);
       }
       $this->designation[0] = (isset($Busca_temp['designation'])) ? $Busca_temp['designation'] : ""; 
       $tmp_pos = (is_string($this->designation[0])) ? strpos($this->designation[0], "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->designation[0]))
       {
           $this->designation[0] = substr($this->designation[0], 0, $tmp_pos);
       }
   } 
   else 
   { 
       $this->hiredate_2 = ""; 
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_pesq_filtro'];
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   $_SESSION['scriptcase']['contr_link_emb'] = $this->nm_location;
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['qt_col_grid'] = 1 ;  
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdf_attslip_all']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['pdf_attslip_all']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['pdf_attslip_all']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['pdf_attslip_all']['cols']);
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['ordem_select']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['ordem_select'] = array(); 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['ordem_select']['dept'] = 'asc'; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['ordem_select']['userid_int'] = 'asc'; 
   } 
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['ordem_quebra']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['ordem_ant']  = "dept,userid_int"; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['ordem_desc'] = "" ; 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_orig'] = "";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_pesq_filtro'];
//
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['tot_geral'][1])) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['tot_geral'][1] ;  
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_pesq'];  
//----- 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT userid_int, hiredate, username, dept, designation, work_hh_w, work_hh_w_PM, ot_hh_w, ot_hh_w_PM, work_hh_h, work_hh_h_PM, ot_hh_h, ot_hh_h_PM, work_hh_r, work_hh_r_PM, ot_hh_r, ot_hh_r_PM, work_hh_o, work_hh_o_PM, ot_hh_o, ot_hh_o_PM, hh_sunday, hh_offday, hh_leavetype, pay_startdate, pay_enddate from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT userid_int, hiredate, username, dept, designation, work_hh_w, work_hh_w_PM, ot_hh_w, ot_hh_w_PM, work_hh_h, work_hh_h_PM, ot_hh_h, ot_hh_h_PM, work_hh_r, work_hh_r_PM, ot_hh_r, ot_hh_r_PM, work_hh_o, work_hh_o_PM, ot_hh_o, ot_hh_o_PM, hh_sunday, hh_offday, hh_leavetype, pay_startdate, pay_enddate from " . $this->Ini->nm_tabela; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_pesq']; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['ordem_grid'])) 
   { 
       $nmgp_order_by = " order by " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['ordem_desc']; 
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['order_grid'] = $nmgp_order_by;
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['userid_int'] = "Userid Int";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['hiredate'] = "Hiredate";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['username'] = "Username";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['dept'] = "Dept";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['designation'] = "Designation";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['work_hh_w'] = "Work Hh W";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['work_hh_w_pm'] = "Work Hh W PM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['ot_hh_w'] = "Ot Hh W";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['ot_hh_w_pm'] = "Ot Hh W PM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['work_hh_h'] = "Work Hh H";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['work_hh_h_pm'] = "Work Hh H PM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['ot_hh_h'] = "Ot Hh H";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['ot_hh_h_pm'] = "Ot Hh H PM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['work_hh_r'] = "Work Hh R";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['work_hh_r_pm'] = "Work Hh R PM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['ot_hh_r'] = "Ot Hh R";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['ot_hh_r_pm'] = "Ot Hh R PM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['work_hh_o'] = "Work Hh O";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['work_hh_o_pm'] = "Work Hh O PM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['ot_hh_o'] = "Ot Hh O";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['ot_hh_o_pm'] = "Ot Hh O PM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['hh_sunday'] = "Hh Sunday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['hh_offday'] = "Hh Offday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['hh_leavetype'] = "Hh Leavetype";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['pay_startdate'] = "Pay Startdate";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['pay_enddate'] = "Pay Enddate";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['lbl_sal_reg'] = "lbl_Sal_Reg";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['lbl_amount01'] = "lbl_amount01";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['lbl_amount02'] = "lbl_amount02";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['lbl_companyname'] = "lbl_companyname";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['lbl_deductions'] = "lbl_deductions";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['lbl_earning'] = "lbl_earning";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['lbl_employeename'] = "lbl_employeename";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['lbl_fixedsalary'] = "lbl_fixedsalary";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['lbl_line01'] = "lbl_line01";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['lbl_payslip'] = "lbl_payslip";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['labels']['lbl_rappel'] = "lbl_rappel";
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['seq_dir'] = 0; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['sub_dir'] = array(); 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['where_pesq_filtro'];
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdf_attslip_all']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['pdf_attslip_all']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['pdf_attslip_all']['lig_edit'];
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
   $this->SC_desloca_lin  = 130; 
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
      while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['qt_col_grid']) 
      {  
          $this->sc_proc_grid = true;
          $this->SC_seq_register++; 
          $this->SC_incr_col = $this->SC_desloca_col * $nm_quant_linhas; 
          $this->userid_int[$this->nm_grid_colunas] = $this->rs_grid->fields[0] ;  
          $this->userid_int[$this->nm_grid_colunas] = (string)$this->userid_int[$this->nm_grid_colunas];
          $this->hiredate[$this->nm_grid_colunas] = $this->rs_grid->fields[1] ;  
          $this->username[$this->nm_grid_colunas] = $this->rs_grid->fields[2] ;  
          $this->dept[$this->nm_grid_colunas] = $this->rs_grid->fields[3] ;  
          $this->designation[$this->nm_grid_colunas] = $this->rs_grid->fields[4] ;  
          $this->work_hh_w[$this->nm_grid_colunas] = $this->rs_grid->fields[5] ;  
          $this->work_hh_w[$this->nm_grid_colunas] = (string)$this->work_hh_w[$this->nm_grid_colunas];
          $this->work_hh_w_pm[$this->nm_grid_colunas] = $this->rs_grid->fields[6] ;  
          $this->work_hh_w_pm[$this->nm_grid_colunas] = (string)$this->work_hh_w_pm[$this->nm_grid_colunas];
          $this->ot_hh_w[$this->nm_grid_colunas] = $this->rs_grid->fields[7] ;  
          $this->ot_hh_w[$this->nm_grid_colunas] =  str_replace(",", ".", $this->ot_hh_w[$this->nm_grid_colunas]);
          $this->ot_hh_w[$this->nm_grid_colunas] = (string)$this->ot_hh_w[$this->nm_grid_colunas];
          $this->ot_hh_w_pm[$this->nm_grid_colunas] = $this->rs_grid->fields[8] ;  
          $this->ot_hh_w_pm[$this->nm_grid_colunas] =  str_replace(",", ".", $this->ot_hh_w_pm[$this->nm_grid_colunas]);
          $this->ot_hh_w_pm[$this->nm_grid_colunas] = (string)$this->ot_hh_w_pm[$this->nm_grid_colunas];
          $this->work_hh_h[$this->nm_grid_colunas] = $this->rs_grid->fields[9] ;  
          $this->work_hh_h[$this->nm_grid_colunas] =  str_replace(",", ".", $this->work_hh_h[$this->nm_grid_colunas]);
          $this->work_hh_h[$this->nm_grid_colunas] = (string)$this->work_hh_h[$this->nm_grid_colunas];
          $this->work_hh_h_pm[$this->nm_grid_colunas] = $this->rs_grid->fields[10] ;  
          $this->work_hh_h_pm[$this->nm_grid_colunas] =  str_replace(",", ".", $this->work_hh_h_pm[$this->nm_grid_colunas]);
          $this->work_hh_h_pm[$this->nm_grid_colunas] = (string)$this->work_hh_h_pm[$this->nm_grid_colunas];
          $this->ot_hh_h[$this->nm_grid_colunas] = $this->rs_grid->fields[11] ;  
          $this->ot_hh_h[$this->nm_grid_colunas] =  str_replace(",", ".", $this->ot_hh_h[$this->nm_grid_colunas]);
          $this->ot_hh_h[$this->nm_grid_colunas] = (string)$this->ot_hh_h[$this->nm_grid_colunas];
          $this->ot_hh_h_pm[$this->nm_grid_colunas] = $this->rs_grid->fields[12] ;  
          $this->ot_hh_h_pm[$this->nm_grid_colunas] =  str_replace(",", ".", $this->ot_hh_h_pm[$this->nm_grid_colunas]);
          $this->ot_hh_h_pm[$this->nm_grid_colunas] = (string)$this->ot_hh_h_pm[$this->nm_grid_colunas];
          $this->work_hh_r[$this->nm_grid_colunas] = $this->rs_grid->fields[13] ;  
          $this->work_hh_r[$this->nm_grid_colunas] =  str_replace(",", ".", $this->work_hh_r[$this->nm_grid_colunas]);
          $this->work_hh_r[$this->nm_grid_colunas] = (string)$this->work_hh_r[$this->nm_grid_colunas];
          $this->work_hh_r_pm[$this->nm_grid_colunas] = $this->rs_grid->fields[14] ;  
          $this->work_hh_r_pm[$this->nm_grid_colunas] =  str_replace(",", ".", $this->work_hh_r_pm[$this->nm_grid_colunas]);
          $this->work_hh_r_pm[$this->nm_grid_colunas] = (string)$this->work_hh_r_pm[$this->nm_grid_colunas];
          $this->ot_hh_r[$this->nm_grid_colunas] = $this->rs_grid->fields[15] ;  
          $this->ot_hh_r[$this->nm_grid_colunas] =  str_replace(",", ".", $this->ot_hh_r[$this->nm_grid_colunas]);
          $this->ot_hh_r[$this->nm_grid_colunas] = (string)$this->ot_hh_r[$this->nm_grid_colunas];
          $this->ot_hh_r_pm[$this->nm_grid_colunas] = $this->rs_grid->fields[16] ;  
          $this->ot_hh_r_pm[$this->nm_grid_colunas] =  str_replace(",", ".", $this->ot_hh_r_pm[$this->nm_grid_colunas]);
          $this->ot_hh_r_pm[$this->nm_grid_colunas] = (string)$this->ot_hh_r_pm[$this->nm_grid_colunas];
          $this->work_hh_o[$this->nm_grid_colunas] = $this->rs_grid->fields[17] ;  
          $this->work_hh_o[$this->nm_grid_colunas] =  str_replace(",", ".", $this->work_hh_o[$this->nm_grid_colunas]);
          $this->work_hh_o[$this->nm_grid_colunas] = (string)$this->work_hh_o[$this->nm_grid_colunas];
          $this->work_hh_o_pm[$this->nm_grid_colunas] = $this->rs_grid->fields[18] ;  
          $this->work_hh_o_pm[$this->nm_grid_colunas] =  str_replace(",", ".", $this->work_hh_o_pm[$this->nm_grid_colunas]);
          $this->work_hh_o_pm[$this->nm_grid_colunas] = (string)$this->work_hh_o_pm[$this->nm_grid_colunas];
          $this->ot_hh_o[$this->nm_grid_colunas] = $this->rs_grid->fields[19] ;  
          $this->ot_hh_o[$this->nm_grid_colunas] =  str_replace(",", ".", $this->ot_hh_o[$this->nm_grid_colunas]);
          $this->ot_hh_o[$this->nm_grid_colunas] = (string)$this->ot_hh_o[$this->nm_grid_colunas];
          $this->ot_hh_o_pm[$this->nm_grid_colunas] = $this->rs_grid->fields[20] ;  
          $this->ot_hh_o_pm[$this->nm_grid_colunas] =  str_replace(",", ".", $this->ot_hh_o_pm[$this->nm_grid_colunas]);
          $this->ot_hh_o_pm[$this->nm_grid_colunas] = (string)$this->ot_hh_o_pm[$this->nm_grid_colunas];
          $this->hh_sunday[$this->nm_grid_colunas] = $this->rs_grid->fields[21] ;  
          $this->hh_sunday[$this->nm_grid_colunas] =  str_replace(",", ".", $this->hh_sunday[$this->nm_grid_colunas]);
          $this->hh_sunday[$this->nm_grid_colunas] = (string)$this->hh_sunday[$this->nm_grid_colunas];
          $this->hh_offday[$this->nm_grid_colunas] = $this->rs_grid->fields[22] ;  
          $this->hh_offday[$this->nm_grid_colunas] =  str_replace(",", ".", $this->hh_offday[$this->nm_grid_colunas]);
          $this->hh_offday[$this->nm_grid_colunas] = (string)$this->hh_offday[$this->nm_grid_colunas];
          $this->hh_leavetype[$this->nm_grid_colunas] = $this->rs_grid->fields[23] ;  
          $this->hh_leavetype[$this->nm_grid_colunas] =  str_replace(",", ".", $this->hh_leavetype[$this->nm_grid_colunas]);
          $this->hh_leavetype[$this->nm_grid_colunas] = (string)$this->hh_leavetype[$this->nm_grid_colunas];
          $this->pay_startdate[$this->nm_grid_colunas] = $this->rs_grid->fields[24] ;  
          $this->pay_enddate[$this->nm_grid_colunas] = $this->rs_grid->fields[25] ;  
          $this->lbl_sal_reg[$this->nm_grid_colunas] = "";
          $this->lbl_amount01[$this->nm_grid_colunas] = "";
          $this->lbl_amount02[$this->nm_grid_colunas] = "";
          $this->lbl_companyname[$this->nm_grid_colunas] = "";
          $this->lbl_deductions[$this->nm_grid_colunas] = "";
          $this->lbl_earning[$this->nm_grid_colunas] = "";
          $this->lbl_employeename[$this->nm_grid_colunas] = "";
          $this->lbl_fixedsalary[$this->nm_grid_colunas] = "";
          $this->lbl_line01[$this->nm_grid_colunas] = "";
          $this->lbl_payslip[$this->nm_grid_colunas] = "";
          $this->lbl_rappel[$this->nm_grid_colunas] = "";
          $this->Lookup->lookup_lbl_companyname($this->lbl_companyname[$this->nm_grid_colunas], $this->array_lbl_companyname); 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
                   $this->hiredate[$this->nm_grid_colunas] = html_entity_decode($this->nm_data->FormataSaida("d F Y"), ENT_COMPAT, $_SESSION['scriptcase']['charset']);
               } 
          } 
          $this->hiredate[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->hiredate[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->designation[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->designation[$this->nm_grid_colunas]));
          }
          else {
              $this->designation[$this->nm_grid_colunas] = sc_strip_script($this->designation[$this->nm_grid_colunas]);
          }
          if ($this->designation[$this->nm_grid_colunas] === "") 
          { 
              $this->designation[$this->nm_grid_colunas] = "" ;  
          } 
          $this->designation[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->designation[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->work_hh_w[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->work_hh_w[$this->nm_grid_colunas]));
          }
          else {
              $this->work_hh_w[$this->nm_grid_colunas] = sc_strip_script($this->work_hh_w[$this->nm_grid_colunas]);
          }
          if ($this->work_hh_w[$this->nm_grid_colunas] === "") 
          { 
              $this->work_hh_w[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->work_hh_w[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->work_hh_w[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->work_hh_w[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->work_hh_w_pm[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->work_hh_w_pm[$this->nm_grid_colunas]));
          }
          else {
              $this->work_hh_w_pm[$this->nm_grid_colunas] = sc_strip_script($this->work_hh_w_pm[$this->nm_grid_colunas]);
          }
          if ($this->work_hh_w_pm[$this->nm_grid_colunas] === "") 
          { 
              $this->work_hh_w_pm[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->work_hh_w_pm[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->work_hh_w_pm[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->work_hh_w_pm[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->ot_hh_w[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->ot_hh_w[$this->nm_grid_colunas]));
          }
          else {
              $this->ot_hh_w[$this->nm_grid_colunas] = sc_strip_script($this->ot_hh_w[$this->nm_grid_colunas]);
          }
          if ($this->ot_hh_w[$this->nm_grid_colunas] === "") 
          { 
              $this->ot_hh_w[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->ot_hh_w[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->ot_hh_w[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ot_hh_w[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->ot_hh_w_pm[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->ot_hh_w_pm[$this->nm_grid_colunas]));
          }
          else {
              $this->ot_hh_w_pm[$this->nm_grid_colunas] = sc_strip_script($this->ot_hh_w_pm[$this->nm_grid_colunas]);
          }
          if ($this->ot_hh_w_pm[$this->nm_grid_colunas] === "") 
          { 
              $this->ot_hh_w_pm[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->ot_hh_w_pm[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->ot_hh_w_pm[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ot_hh_w_pm[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->work_hh_h[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->work_hh_h[$this->nm_grid_colunas]));
          }
          else {
              $this->work_hh_h[$this->nm_grid_colunas] = sc_strip_script($this->work_hh_h[$this->nm_grid_colunas]);
          }
          if ($this->work_hh_h[$this->nm_grid_colunas] === "") 
          { 
              $this->work_hh_h[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->work_hh_h[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->work_hh_h[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->work_hh_h[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->work_hh_h_pm[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->work_hh_h_pm[$this->nm_grid_colunas]));
          }
          else {
              $this->work_hh_h_pm[$this->nm_grid_colunas] = sc_strip_script($this->work_hh_h_pm[$this->nm_grid_colunas]);
          }
          if ($this->work_hh_h_pm[$this->nm_grid_colunas] === "") 
          { 
              $this->work_hh_h_pm[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->work_hh_h_pm[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->work_hh_h_pm[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->work_hh_h_pm[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->ot_hh_h[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->ot_hh_h[$this->nm_grid_colunas]));
          }
          else {
              $this->ot_hh_h[$this->nm_grid_colunas] = sc_strip_script($this->ot_hh_h[$this->nm_grid_colunas]);
          }
          if ($this->ot_hh_h[$this->nm_grid_colunas] === "") 
          { 
              $this->ot_hh_h[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->ot_hh_h[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->ot_hh_h[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ot_hh_h[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->ot_hh_h_pm[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->ot_hh_h_pm[$this->nm_grid_colunas]));
          }
          else {
              $this->ot_hh_h_pm[$this->nm_grid_colunas] = sc_strip_script($this->ot_hh_h_pm[$this->nm_grid_colunas]);
          }
          if ($this->ot_hh_h_pm[$this->nm_grid_colunas] === "") 
          { 
              $this->ot_hh_h_pm[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->ot_hh_h_pm[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->ot_hh_h_pm[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ot_hh_h_pm[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->work_hh_r[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->work_hh_r[$this->nm_grid_colunas]));
          }
          else {
              $this->work_hh_r[$this->nm_grid_colunas] = sc_strip_script($this->work_hh_r[$this->nm_grid_colunas]);
          }
          if ($this->work_hh_r[$this->nm_grid_colunas] === "") 
          { 
              $this->work_hh_r[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->work_hh_r[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->work_hh_r[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->work_hh_r[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->work_hh_r_pm[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->work_hh_r_pm[$this->nm_grid_colunas]));
          }
          else {
              $this->work_hh_r_pm[$this->nm_grid_colunas] = sc_strip_script($this->work_hh_r_pm[$this->nm_grid_colunas]);
          }
          if ($this->work_hh_r_pm[$this->nm_grid_colunas] === "") 
          { 
              $this->work_hh_r_pm[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->work_hh_r_pm[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->work_hh_r_pm[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->work_hh_r_pm[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->ot_hh_r[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->ot_hh_r[$this->nm_grid_colunas]));
          }
          else {
              $this->ot_hh_r[$this->nm_grid_colunas] = sc_strip_script($this->ot_hh_r[$this->nm_grid_colunas]);
          }
          if ($this->ot_hh_r[$this->nm_grid_colunas] === "") 
          { 
              $this->ot_hh_r[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->ot_hh_r[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->ot_hh_r[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ot_hh_r[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->ot_hh_r_pm[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->ot_hh_r_pm[$this->nm_grid_colunas]));
          }
          else {
              $this->ot_hh_r_pm[$this->nm_grid_colunas] = sc_strip_script($this->ot_hh_r_pm[$this->nm_grid_colunas]);
          }
          if ($this->ot_hh_r_pm[$this->nm_grid_colunas] === "") 
          { 
              $this->ot_hh_r_pm[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->ot_hh_r_pm[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->ot_hh_r_pm[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ot_hh_r_pm[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->work_hh_o[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->work_hh_o[$this->nm_grid_colunas]));
          }
          else {
              $this->work_hh_o[$this->nm_grid_colunas] = sc_strip_script($this->work_hh_o[$this->nm_grid_colunas]);
          }
          if ($this->work_hh_o[$this->nm_grid_colunas] === "") 
          { 
              $this->work_hh_o[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->work_hh_o[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->work_hh_o[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->work_hh_o[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->work_hh_o_pm[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->work_hh_o_pm[$this->nm_grid_colunas]));
          }
          else {
              $this->work_hh_o_pm[$this->nm_grid_colunas] = sc_strip_script($this->work_hh_o_pm[$this->nm_grid_colunas]);
          }
          if ($this->work_hh_o_pm[$this->nm_grid_colunas] === "") 
          { 
              $this->work_hh_o_pm[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->work_hh_o_pm[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->work_hh_o_pm[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->work_hh_o_pm[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->ot_hh_o[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->ot_hh_o[$this->nm_grid_colunas]));
          }
          else {
              $this->ot_hh_o[$this->nm_grid_colunas] = sc_strip_script($this->ot_hh_o[$this->nm_grid_colunas]);
          }
          if ($this->ot_hh_o[$this->nm_grid_colunas] === "") 
          { 
              $this->ot_hh_o[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->ot_hh_o[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->ot_hh_o[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ot_hh_o[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->ot_hh_o_pm[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->ot_hh_o_pm[$this->nm_grid_colunas]));
          }
          else {
              $this->ot_hh_o_pm[$this->nm_grid_colunas] = sc_strip_script($this->ot_hh_o_pm[$this->nm_grid_colunas]);
          }
          if ($this->ot_hh_o_pm[$this->nm_grid_colunas] === "") 
          { 
              $this->ot_hh_o_pm[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->ot_hh_o_pm[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->ot_hh_o_pm[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ot_hh_o_pm[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->hh_sunday[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->hh_sunday[$this->nm_grid_colunas]));
          }
          else {
              $this->hh_sunday[$this->nm_grid_colunas] = sc_strip_script($this->hh_sunday[$this->nm_grid_colunas]);
          }
          if ($this->hh_sunday[$this->nm_grid_colunas] === "") 
          { 
              $this->hh_sunday[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->hh_sunday[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->hh_sunday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->hh_sunday[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->hh_offday[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->hh_offday[$this->nm_grid_colunas]));
          }
          else {
              $this->hh_offday[$this->nm_grid_colunas] = sc_strip_script($this->hh_offday[$this->nm_grid_colunas]);
          }
          if ($this->hh_offday[$this->nm_grid_colunas] === "") 
          { 
              $this->hh_offday[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->hh_offday[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->hh_offday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->hh_offday[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->hh_leavetype[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->hh_leavetype[$this->nm_grid_colunas]));
          }
          else {
              $this->hh_leavetype[$this->nm_grid_colunas] = sc_strip_script($this->hh_leavetype[$this->nm_grid_colunas]);
          }
          if ($this->hh_leavetype[$this->nm_grid_colunas] === "") 
          { 
              $this->hh_leavetype[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->hh_leavetype[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->hh_leavetype[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->hh_leavetype[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
                   $this->pay_startdate[$this->nm_grid_colunas] = html_entity_decode($this->nm_data->FormataSaida("d F Y"), ENT_COMPAT, $_SESSION['scriptcase']['charset']);
               } 
          } 
          $this->pay_startdate[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->pay_startdate[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
                   $this->pay_enddate[$this->nm_grid_colunas] = html_entity_decode($this->nm_data->FormataSaida("d F Y"), ENT_COMPAT, $_SESSION['scriptcase']['charset']);
               } 
          } 
          $this->pay_enddate[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->pay_enddate[$this->nm_grid_colunas]);
          if ($this->lbl_sal_reg[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_sal_reg[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_sal_reg[$this->nm_grid_colunas], "Total Sal. Regular"); 
          $this->lbl_sal_reg[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_sal_reg[$this->nm_grid_colunas]);
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_attslip_all']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          $this->nm_gera_mask($this->lbl_fixedsalary[$this->nm_grid_colunas], "Fixed Salary"); 
          $this->lbl_fixedsalary[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_fixedsalary[$this->nm_grid_colunas]);
          if ($this->lbl_line01[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_line01[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_line01[$this->nm_grid_colunas], "________________________________________________________________"); 
          $this->lbl_line01[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_line01[$this->nm_grid_colunas]);
          if ($this->lbl_payslip[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_payslip[$this->nm_grid_colunas] = "" ;  
          } 
          if ($this->lbl_payslip[$this->nm_grid_colunas] !== "") 
          { 
              $this->lbl_payslip[$this->nm_grid_colunas] = sc_strtoupper($this->lbl_payslip[$this->nm_grid_colunas]); 
          } 
          $this->nm_gera_mask($this->lbl_payslip[$this->nm_grid_colunas], "PAYSLIP"); 
          $this->lbl_payslip[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_payslip[$this->nm_grid_colunas]);
          if ($this->lbl_rappel[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_rappel[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_rappel[$this->nm_grid_colunas], "Extra"); 
          $this->lbl_rappel[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_rappel[$this->nm_grid_colunas]);
            $cell_FingertecID = array('posx' => '40.26323333332825', 'posy' => '18', 'data' => $this->userid_int[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_username = array('posx' => '123', 'posy' => '18', 'data' => $this->username[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_PayFrom = array('posx' => '9.5', 'posy' => '28', 'data' => $this->SC_conv_utf8('Pay From'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_designation = array('posx' => '85', 'posy' => '23', 'data' => $this->SC_conv_utf8('Designation'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_dept = array('posx' => '85', 'posy' => '28', 'data' => $this->SC_conv_utf8('Department'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_companyname = array('posx' => '9.498004748533958', 'posy' => '11.50', 'data' => $this->lbl_companyname[$this->nm_grid_colunas], 'width'      => '200', 'align'      => 'C', 'font_type'  => $this->default_font, 'font_size'  => '15', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_lbl_employeename = array('posx' => '85', 'posy' => '18', 'data' => $this->lbl_employeename[$this->nm_grid_colunas], 'width'      => '10', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_hiredate = array('posx' => '9.5', 'posy' => '23', 'data' => $this->SC_conv_utf8('HireDate'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_hiredate = array('posx' => '40', 'posy' => '23', 'data' => $this->hiredate[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_id = array('posx' => '9.50', 'posy' => '18', 'data' => $this->SC_conv_utf8('Fingertec ID'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cellpaystartdate = array('posx' => '40', 'posy' => '28', 'data' => $this->pay_startdate[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_department = array('posx' => '123', 'posy' => '28', 'data' => $this->dept[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_earning = array('posx' => '9.5', 'posy' => '40', 'data' => $this->lbl_earning[$this->nm_grid_colunas], 'width'      => '50', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_lbl_workdayAM = array('posx' => '9.76209312499877', 'posy' => '47.997797916660616', 'data' => $this->SC_conv_utf8('Workday AM'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_iris = array('posx' => '109.50', 'posy' => '72.92', 'data' => $this->SC_conv_utf8('IRI/Sal'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_iric = array('posx' => '109.50', 'posy' => '79.15', 'data' => $this->SC_conv_utf8('TCA Add'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_ona = array('posx' => '109.50', 'posy' => '85.38', 'data' => $this->SC_conv_utf8('ONA'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_DeductMeal = array('posx' => '109.50', 'posy' => '91.60', 'data' => $this->SC_conv_utf8('Deduct. Meal'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_DeductLoan = array('posx' => '109.50', 'posy' => '97.84', 'data' => $this->SC_conv_utf8('Deduct. Loan Enterprise'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_DeductLoanBank = array('posx' => '109.50', 'posy' => '104.07', 'data' => $this->SC_conv_utf8('Deduct. Loan Bank'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_DeductOther = array('posx' => '109.50', 'posy' => '110.30', 'data' => $this->SC_conv_utf8('Deduct. Other'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_totaldeduct = array('posx' => '109.50', 'posy' => '119.50', 'data' => $this->SC_conv_utf8('Total Deductions'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_lbl_IncomeComm = array('posx' => '109.50', 'posy' => '54.23', 'data' => $this->SC_conv_utf8('Tota Sal. Additional'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_lbl_salnet = array('posx' => '59.50', 'posy' => '126', 'data' => $this->SC_conv_utf8('NET EARNINGS'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_89 = array('posx' => '9.23', 'posy' => '129.50', 'data' => $this->SC_conv_utf8('________________________________________________________________________________'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $celllblamount = array('posx' => '59.49896308186099', 'posy' => '39.73433124999499', 'data' => $this->SC_conv_utf8('Amount'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_91 = array('posx' => '159', 'posy' => '66.69', 'data' => $this->SC_conv_utf8('Amount'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_93 = array('posx' => '109.50', 'posy' => '66.69', 'data' => $this->SC_conv_utf8('Deductions'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_lbl_IncomeOffday = array('posx' => '9.50', 'posy' => '66.69', 'data' => $this->SC_conv_utf8('Sal. Offday'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_Sunday = array('posx' => '9.50', 'posy' => '72.92', 'data' => $this->SC_conv_utf8('Sunday Benefits'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_payslip = array('posx' => '9.50', 'posy' => '6', 'data' => $this->lbl_payslip[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'C', 'font_type'  => $this->default_font, 'font_size'  => '15', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_lbl_WorkdayPM = array('posx' => '9.5', 'posy' => '54.23', 'data' => $this->SC_conv_utf8('Workday PM'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_IncomeRestday = array('posx' => '9.50', 'posy' => '60.46', 'data' => $this->SC_conv_utf8('Sal. Restday'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_Holiday = array('posx' => '9.50', 'posy' => '79.15', 'data' => $this->SC_conv_utf8('Holiday Benefits'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_IncomeWorkdayOT = array('posx' => '9.5', 'posy' => '97.84', 'data' => $this->SC_conv_utf8('Sal. Workday OT'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_IncomeHolidayOT = array('posx' => '9.5', 'posy' => '104.07', 'data' => $this->SC_conv_utf8('Sal. Holiday OT'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_RestdayOT = array('posx' => '9.5', 'posy' => '110.30', 'data' => $this->SC_conv_utf8('Sal. Restday OT'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_OffdayOT = array('posx' => '9.5', 'posy' => '116.53', 'data' => $this->SC_conv_utf8('Sal. Offday OT'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_PayEndDate = array('posx' => '40', 'posy' => '33', 'data' => $this->pay_enddate[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_PayTo = array('posx' => '9.5', 'posy' => '33', 'data' => $this->SC_conv_utf8('Pay To'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Designation = array('posx' => '123', 'posy' => '23', 'data' => $this->designation[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_rappel = array('posx' => '109.50', 'posy' => '60.46', 'data' => $this->SC_conv_utf8('Rappel / Extra'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_Incentive = array('posx' => '109.50', 'posy' => '48', 'data' => $this->SC_conv_utf8('Incentive'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_Sal_Reg = array('posx' => '9.50', 'posy' => '91.60', 'data' => $this->lbl_sal_reg[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_lbl_salleavetype = array('posx' => '9.50', 'posy' => '85.38', 'data' => $this->SC_conv_utf8('Leavetype Benefits'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_txt_workdayAM = array('posx' => '59.50', 'posy' => '48', 'data' => $this->work_hh_w[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '5', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_txt_workdayPM = array('posx' => '59.50', 'posy' => '54.23', 'data' => $this->work_hh_w_pm[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);


            $this->Pdf->SetFont($cell_FingertecID['font_type'], $cell_FingertecID['font_style'], $cell_FingertecID['font_size']);
            $this->pdf_text_color($cell_FingertecID['data'], $cell_FingertecID['color_r'], $cell_FingertecID['color_g'], $cell_FingertecID['color_b']);
            if (!empty($cell_FingertecID['posx']) && !empty($cell_FingertecID['posy']))
            {
                $this->Pdf->SetXY($cell_FingertecID['posx'] + $this->SC_incr_col,  $cell_FingertecID['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_FingertecID['posx']))
            {
                $this->Pdf->SetX($cell_FingertecID['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_FingertecID['posy']))
            {
                $this->Pdf->SetY($cell_FingertecID['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_FingertecID['width'], 0, $cell_FingertecID['data'], 0, 0, $cell_FingertecID['align']);

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

            $this->Pdf->SetFont($cell_lbl_PayFrom['font_type'], $cell_lbl_PayFrom['font_style'], $cell_lbl_PayFrom['font_size']);
            $this->pdf_text_color($cell_lbl_PayFrom['data'], $cell_lbl_PayFrom['color_r'], $cell_lbl_PayFrom['color_g'], $cell_lbl_PayFrom['color_b']);
            if (!empty($cell_lbl_PayFrom['posx']) && !empty($cell_lbl_PayFrom['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_PayFrom['posx'] + $this->SC_incr_col,  $cell_lbl_PayFrom['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_PayFrom['posx']))
            {
                $this->Pdf->SetX($cell_lbl_PayFrom['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_PayFrom['posy']))
            {
                $this->Pdf->SetY($cell_lbl_PayFrom['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_PayFrom['width'], 0, $cell_lbl_PayFrom['data'], 0, 0, $cell_lbl_PayFrom['align']);

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

            $this->Pdf->SetFont($cell_hiredate['font_type'], $cell_hiredate['font_style'], $cell_hiredate['font_size']);
            $this->pdf_text_color($cell_hiredate['data'], $cell_hiredate['color_r'], $cell_hiredate['color_g'], $cell_hiredate['color_b']);
            if (!empty($cell_hiredate['posx']) && !empty($cell_hiredate['posy']))
            {
                $this->Pdf->SetXY($cell_hiredate['posx'] + $this->SC_incr_col,  $cell_hiredate['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_hiredate['posx']))
            {
                $this->Pdf->SetX($cell_hiredate['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_hiredate['posy']))
            {
                $this->Pdf->SetY($cell_hiredate['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_hiredate['width'], 0, $cell_hiredate['data'], 0, 0, $cell_hiredate['align']);

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

            $this->Pdf->SetFont($cell_department['font_type'], $cell_department['font_style'], $cell_department['font_size']);
            $this->pdf_text_color($cell_department['data'], $cell_department['color_r'], $cell_department['color_g'], $cell_department['color_b']);
            if (!empty($cell_department['posx']) && !empty($cell_department['posy']))
            {
                $this->Pdf->SetXY($cell_department['posx'] + $this->SC_incr_col,  $cell_department['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_department['posx']))
            {
                $this->Pdf->SetX($cell_department['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_department['posy']))
            {
                $this->Pdf->SetY($cell_department['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_department['width'], 0, $cell_department['data'], 0, 0, $cell_department['align']);

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

            $this->Pdf->SetFont($cell_lbl_workdayAM['font_type'], $cell_lbl_workdayAM['font_style'], $cell_lbl_workdayAM['font_size']);
            $this->pdf_text_color($cell_lbl_workdayAM['data'], $cell_lbl_workdayAM['color_r'], $cell_lbl_workdayAM['color_g'], $cell_lbl_workdayAM['color_b']);
            if (!empty($cell_lbl_workdayAM['posx']) && !empty($cell_lbl_workdayAM['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_workdayAM['posx'] + $this->SC_incr_col,  $cell_lbl_workdayAM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_workdayAM['posx']))
            {
                $this->Pdf->SetX($cell_lbl_workdayAM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_workdayAM['posy']))
            {
                $this->Pdf->SetY($cell_lbl_workdayAM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_workdayAM['width'], 0, $cell_lbl_workdayAM['data'], 0, 0, $cell_lbl_workdayAM['align']);

            $this->Pdf->SetFont($cell_lbl_iris['font_type'], $cell_lbl_iris['font_style'], $cell_lbl_iris['font_size']);
            $this->pdf_text_color($cell_lbl_iris['data'], $cell_lbl_iris['color_r'], $cell_lbl_iris['color_g'], $cell_lbl_iris['color_b']);
            if (!empty($cell_lbl_iris['posx']) && !empty($cell_lbl_iris['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_iris['posx'] + $this->SC_incr_col,  $cell_lbl_iris['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_iris['posx']))
            {
                $this->Pdf->SetX($cell_lbl_iris['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_iris['posy']))
            {
                $this->Pdf->SetY($cell_lbl_iris['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_iris['width'], 0, $cell_lbl_iris['data'], 0, 0, $cell_lbl_iris['align']);

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

            $this->Pdf->SetFont($cell_lbl_ona['font_type'], $cell_lbl_ona['font_style'], $cell_lbl_ona['font_size']);
            $this->pdf_text_color($cell_lbl_ona['data'], $cell_lbl_ona['color_r'], $cell_lbl_ona['color_g'], $cell_lbl_ona['color_b']);
            if (!empty($cell_lbl_ona['posx']) && !empty($cell_lbl_ona['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_ona['posx'] + $this->SC_incr_col,  $cell_lbl_ona['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_ona['posx']))
            {
                $this->Pdf->SetX($cell_lbl_ona['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_ona['posy']))
            {
                $this->Pdf->SetY($cell_lbl_ona['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_ona['width'], 0, $cell_lbl_ona['data'], 0, 0, $cell_lbl_ona['align']);

            $this->Pdf->SetFont($cell_lbl_DeductMeal['font_type'], $cell_lbl_DeductMeal['font_style'], $cell_lbl_DeductMeal['font_size']);
            $this->pdf_text_color($cell_lbl_DeductMeal['data'], $cell_lbl_DeductMeal['color_r'], $cell_lbl_DeductMeal['color_g'], $cell_lbl_DeductMeal['color_b']);
            if (!empty($cell_lbl_DeductMeal['posx']) && !empty($cell_lbl_DeductMeal['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_DeductMeal['posx'] + $this->SC_incr_col,  $cell_lbl_DeductMeal['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_DeductMeal['posx']))
            {
                $this->Pdf->SetX($cell_lbl_DeductMeal['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_DeductMeal['posy']))
            {
                $this->Pdf->SetY($cell_lbl_DeductMeal['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_DeductMeal['width'], 0, $cell_lbl_DeductMeal['data'], 0, 0, $cell_lbl_DeductMeal['align']);

            $this->Pdf->SetFont($cell_lbl_DeductLoan['font_type'], $cell_lbl_DeductLoan['font_style'], $cell_lbl_DeductLoan['font_size']);
            $this->pdf_text_color($cell_lbl_DeductLoan['data'], $cell_lbl_DeductLoan['color_r'], $cell_lbl_DeductLoan['color_g'], $cell_lbl_DeductLoan['color_b']);
            if (!empty($cell_lbl_DeductLoan['posx']) && !empty($cell_lbl_DeductLoan['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_DeductLoan['posx'] + $this->SC_incr_col,  $cell_lbl_DeductLoan['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_DeductLoan['posx']))
            {
                $this->Pdf->SetX($cell_lbl_DeductLoan['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_DeductLoan['posy']))
            {
                $this->Pdf->SetY($cell_lbl_DeductLoan['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_DeductLoan['width'], 0, $cell_lbl_DeductLoan['data'], 0, 0, $cell_lbl_DeductLoan['align']);

            $this->Pdf->SetFont($cell_lbl_DeductLoanBank['font_type'], $cell_lbl_DeductLoanBank['font_style'], $cell_lbl_DeductLoanBank['font_size']);
            $this->pdf_text_color($cell_lbl_DeductLoanBank['data'], $cell_lbl_DeductLoanBank['color_r'], $cell_lbl_DeductLoanBank['color_g'], $cell_lbl_DeductLoanBank['color_b']);
            if (!empty($cell_lbl_DeductLoanBank['posx']) && !empty($cell_lbl_DeductLoanBank['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_DeductLoanBank['posx'] + $this->SC_incr_col,  $cell_lbl_DeductLoanBank['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_DeductLoanBank['posx']))
            {
                $this->Pdf->SetX($cell_lbl_DeductLoanBank['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_DeductLoanBank['posy']))
            {
                $this->Pdf->SetY($cell_lbl_DeductLoanBank['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_DeductLoanBank['width'], 0, $cell_lbl_DeductLoanBank['data'], 0, 0, $cell_lbl_DeductLoanBank['align']);

            $this->Pdf->SetFont($cell_lbl_DeductOther['font_type'], $cell_lbl_DeductOther['font_style'], $cell_lbl_DeductOther['font_size']);
            $this->pdf_text_color($cell_lbl_DeductOther['data'], $cell_lbl_DeductOther['color_r'], $cell_lbl_DeductOther['color_g'], $cell_lbl_DeductOther['color_b']);
            if (!empty($cell_lbl_DeductOther['posx']) && !empty($cell_lbl_DeductOther['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_DeductOther['posx'] + $this->SC_incr_col,  $cell_lbl_DeductOther['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_DeductOther['posx']))
            {
                $this->Pdf->SetX($cell_lbl_DeductOther['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_DeductOther['posy']))
            {
                $this->Pdf->SetY($cell_lbl_DeductOther['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_DeductOther['width'], 0, $cell_lbl_DeductOther['data'], 0, 0, $cell_lbl_DeductOther['align']);

            $this->Pdf->SetFont($cell_lbl_totaldeduct['font_type'], $cell_lbl_totaldeduct['font_style'], $cell_lbl_totaldeduct['font_size']);
            $this->pdf_text_color($cell_lbl_totaldeduct['data'], $cell_lbl_totaldeduct['color_r'], $cell_lbl_totaldeduct['color_g'], $cell_lbl_totaldeduct['color_b']);
            if (!empty($cell_lbl_totaldeduct['posx']) && !empty($cell_lbl_totaldeduct['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_totaldeduct['posx'] + $this->SC_incr_col,  $cell_lbl_totaldeduct['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_totaldeduct['posx']))
            {
                $this->Pdf->SetX($cell_lbl_totaldeduct['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_totaldeduct['posy']))
            {
                $this->Pdf->SetY($cell_lbl_totaldeduct['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_totaldeduct['width'], 0, $cell_lbl_totaldeduct['data'], 0, 0, $cell_lbl_totaldeduct['align']);

            $this->Pdf->SetFont($cell_lbl_IncomeComm['font_type'], $cell_lbl_IncomeComm['font_style'], $cell_lbl_IncomeComm['font_size']);
            $this->pdf_text_color($cell_lbl_IncomeComm['data'], $cell_lbl_IncomeComm['color_r'], $cell_lbl_IncomeComm['color_g'], $cell_lbl_IncomeComm['color_b']);
            if (!empty($cell_lbl_IncomeComm['posx']) && !empty($cell_lbl_IncomeComm['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_IncomeComm['posx'] + $this->SC_incr_col,  $cell_lbl_IncomeComm['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_IncomeComm['posx']))
            {
                $this->Pdf->SetX($cell_lbl_IncomeComm['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_IncomeComm['posy']))
            {
                $this->Pdf->SetY($cell_lbl_IncomeComm['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_IncomeComm['width'], 0, $cell_lbl_IncomeComm['data'], 0, 0, $cell_lbl_IncomeComm['align']);

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

            $this->Pdf->SetFont($cell_lbl_IncomeOffday['font_type'], $cell_lbl_IncomeOffday['font_style'], $cell_lbl_IncomeOffday['font_size']);
            $this->pdf_text_color($cell_lbl_IncomeOffday['data'], $cell_lbl_IncomeOffday['color_r'], $cell_lbl_IncomeOffday['color_g'], $cell_lbl_IncomeOffday['color_b']);
            if (!empty($cell_lbl_IncomeOffday['posx']) && !empty($cell_lbl_IncomeOffday['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_IncomeOffday['posx'] + $this->SC_incr_col,  $cell_lbl_IncomeOffday['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_IncomeOffday['posx']))
            {
                $this->Pdf->SetX($cell_lbl_IncomeOffday['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_IncomeOffday['posy']))
            {
                $this->Pdf->SetY($cell_lbl_IncomeOffday['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_IncomeOffday['width'], 0, $cell_lbl_IncomeOffday['data'], 0, 0, $cell_lbl_IncomeOffday['align']);

            $this->Pdf->SetFont($cell_lbl_Sunday['font_type'], $cell_lbl_Sunday['font_style'], $cell_lbl_Sunday['font_size']);
            $this->pdf_text_color($cell_lbl_Sunday['data'], $cell_lbl_Sunday['color_r'], $cell_lbl_Sunday['color_g'], $cell_lbl_Sunday['color_b']);
            if (!empty($cell_lbl_Sunday['posx']) && !empty($cell_lbl_Sunday['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_Sunday['posx'] + $this->SC_incr_col,  $cell_lbl_Sunday['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_Sunday['posx']))
            {
                $this->Pdf->SetX($cell_lbl_Sunday['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_Sunday['posy']))
            {
                $this->Pdf->SetY($cell_lbl_Sunday['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_Sunday['width'], 0, $cell_lbl_Sunday['data'], 0, 0, $cell_lbl_Sunday['align']);

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

            $this->Pdf->SetFont($cell_lbl_WorkdayPM['font_type'], $cell_lbl_WorkdayPM['font_style'], $cell_lbl_WorkdayPM['font_size']);
            $this->pdf_text_color($cell_lbl_WorkdayPM['data'], $cell_lbl_WorkdayPM['color_r'], $cell_lbl_WorkdayPM['color_g'], $cell_lbl_WorkdayPM['color_b']);
            if (!empty($cell_lbl_WorkdayPM['posx']) && !empty($cell_lbl_WorkdayPM['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_WorkdayPM['posx'] + $this->SC_incr_col,  $cell_lbl_WorkdayPM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_WorkdayPM['posx']))
            {
                $this->Pdf->SetX($cell_lbl_WorkdayPM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_WorkdayPM['posy']))
            {
                $this->Pdf->SetY($cell_lbl_WorkdayPM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_WorkdayPM['width'], 0, $cell_lbl_WorkdayPM['data'], 0, 0, $cell_lbl_WorkdayPM['align']);

            $this->Pdf->SetFont($cell_lbl_IncomeRestday['font_type'], $cell_lbl_IncomeRestday['font_style'], $cell_lbl_IncomeRestday['font_size']);
            $this->pdf_text_color($cell_lbl_IncomeRestday['data'], $cell_lbl_IncomeRestday['color_r'], $cell_lbl_IncomeRestday['color_g'], $cell_lbl_IncomeRestday['color_b']);
            if (!empty($cell_lbl_IncomeRestday['posx']) && !empty($cell_lbl_IncomeRestday['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_IncomeRestday['posx'] + $this->SC_incr_col,  $cell_lbl_IncomeRestday['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_IncomeRestday['posx']))
            {
                $this->Pdf->SetX($cell_lbl_IncomeRestday['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_IncomeRestday['posy']))
            {
                $this->Pdf->SetY($cell_lbl_IncomeRestday['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_IncomeRestday['width'], 0, $cell_lbl_IncomeRestday['data'], 0, 0, $cell_lbl_IncomeRestday['align']);

            $this->Pdf->SetFont($cell_lbl_Holiday['font_type'], $cell_lbl_Holiday['font_style'], $cell_lbl_Holiday['font_size']);
            $this->pdf_text_color($cell_lbl_Holiday['data'], $cell_lbl_Holiday['color_r'], $cell_lbl_Holiday['color_g'], $cell_lbl_Holiday['color_b']);
            if (!empty($cell_lbl_Holiday['posx']) && !empty($cell_lbl_Holiday['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_Holiday['posx'] + $this->SC_incr_col,  $cell_lbl_Holiday['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_Holiday['posx']))
            {
                $this->Pdf->SetX($cell_lbl_Holiday['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_Holiday['posy']))
            {
                $this->Pdf->SetY($cell_lbl_Holiday['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_Holiday['width'], 0, $cell_lbl_Holiday['data'], 0, 0, $cell_lbl_Holiday['align']);

            $this->Pdf->SetFont($cell_lbl_IncomeWorkdayOT['font_type'], $cell_lbl_IncomeWorkdayOT['font_style'], $cell_lbl_IncomeWorkdayOT['font_size']);
            $this->pdf_text_color($cell_lbl_IncomeWorkdayOT['data'], $cell_lbl_IncomeWorkdayOT['color_r'], $cell_lbl_IncomeWorkdayOT['color_g'], $cell_lbl_IncomeWorkdayOT['color_b']);
            if (!empty($cell_lbl_IncomeWorkdayOT['posx']) && !empty($cell_lbl_IncomeWorkdayOT['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_IncomeWorkdayOT['posx'] + $this->SC_incr_col,  $cell_lbl_IncomeWorkdayOT['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_IncomeWorkdayOT['posx']))
            {
                $this->Pdf->SetX($cell_lbl_IncomeWorkdayOT['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_IncomeWorkdayOT['posy']))
            {
                $this->Pdf->SetY($cell_lbl_IncomeWorkdayOT['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_IncomeWorkdayOT['width'], 0, $cell_lbl_IncomeWorkdayOT['data'], 0, 0, $cell_lbl_IncomeWorkdayOT['align']);

            $this->Pdf->SetFont($cell_lbl_IncomeHolidayOT['font_type'], $cell_lbl_IncomeHolidayOT['font_style'], $cell_lbl_IncomeHolidayOT['font_size']);
            $this->pdf_text_color($cell_lbl_IncomeHolidayOT['data'], $cell_lbl_IncomeHolidayOT['color_r'], $cell_lbl_IncomeHolidayOT['color_g'], $cell_lbl_IncomeHolidayOT['color_b']);
            if (!empty($cell_lbl_IncomeHolidayOT['posx']) && !empty($cell_lbl_IncomeHolidayOT['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_IncomeHolidayOT['posx'] + $this->SC_incr_col,  $cell_lbl_IncomeHolidayOT['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_IncomeHolidayOT['posx']))
            {
                $this->Pdf->SetX($cell_lbl_IncomeHolidayOT['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_IncomeHolidayOT['posy']))
            {
                $this->Pdf->SetY($cell_lbl_IncomeHolidayOT['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_IncomeHolidayOT['width'], 0, $cell_lbl_IncomeHolidayOT['data'], 0, 0, $cell_lbl_IncomeHolidayOT['align']);

            $this->Pdf->SetFont($cell_lbl_RestdayOT['font_type'], $cell_lbl_RestdayOT['font_style'], $cell_lbl_RestdayOT['font_size']);
            $this->pdf_text_color($cell_lbl_RestdayOT['data'], $cell_lbl_RestdayOT['color_r'], $cell_lbl_RestdayOT['color_g'], $cell_lbl_RestdayOT['color_b']);
            if (!empty($cell_lbl_RestdayOT['posx']) && !empty($cell_lbl_RestdayOT['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_RestdayOT['posx'] + $this->SC_incr_col,  $cell_lbl_RestdayOT['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_RestdayOT['posx']))
            {
                $this->Pdf->SetX($cell_lbl_RestdayOT['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_RestdayOT['posy']))
            {
                $this->Pdf->SetY($cell_lbl_RestdayOT['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_RestdayOT['width'], 0, $cell_lbl_RestdayOT['data'], 0, 0, $cell_lbl_RestdayOT['align']);

            $this->Pdf->SetFont($cell_lbl_OffdayOT['font_type'], $cell_lbl_OffdayOT['font_style'], $cell_lbl_OffdayOT['font_size']);
            $this->pdf_text_color($cell_lbl_OffdayOT['data'], $cell_lbl_OffdayOT['color_r'], $cell_lbl_OffdayOT['color_g'], $cell_lbl_OffdayOT['color_b']);
            if (!empty($cell_lbl_OffdayOT['posx']) && !empty($cell_lbl_OffdayOT['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_OffdayOT['posx'] + $this->SC_incr_col,  $cell_lbl_OffdayOT['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_OffdayOT['posx']))
            {
                $this->Pdf->SetX($cell_lbl_OffdayOT['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_OffdayOT['posy']))
            {
                $this->Pdf->SetY($cell_lbl_OffdayOT['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_OffdayOT['width'], 0, $cell_lbl_OffdayOT['data'], 0, 0, $cell_lbl_OffdayOT['align']);

            $this->Pdf->SetFont($cell_PayEndDate['font_type'], $cell_PayEndDate['font_style'], $cell_PayEndDate['font_size']);
            $this->pdf_text_color($cell_PayEndDate['data'], $cell_PayEndDate['color_r'], $cell_PayEndDate['color_g'], $cell_PayEndDate['color_b']);
            if (!empty($cell_PayEndDate['posx']) && !empty($cell_PayEndDate['posy']))
            {
                $this->Pdf->SetXY($cell_PayEndDate['posx'] + $this->SC_incr_col,  $cell_PayEndDate['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_PayEndDate['posx']))
            {
                $this->Pdf->SetX($cell_PayEndDate['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_PayEndDate['posy']))
            {
                $this->Pdf->SetY($cell_PayEndDate['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_PayEndDate['width'], 0, $cell_PayEndDate['data'], 0, 0, $cell_PayEndDate['align']);

            $this->Pdf->SetFont($cell_PayTo['font_type'], $cell_PayTo['font_style'], $cell_PayTo['font_size']);
            $this->pdf_text_color($cell_PayTo['data'], $cell_PayTo['color_r'], $cell_PayTo['color_g'], $cell_PayTo['color_b']);
            if (!empty($cell_PayTo['posx']) && !empty($cell_PayTo['posy']))
            {
                $this->Pdf->SetXY($cell_PayTo['posx'] + $this->SC_incr_col,  $cell_PayTo['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_PayTo['posx']))
            {
                $this->Pdf->SetX($cell_PayTo['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_PayTo['posy']))
            {
                $this->Pdf->SetY($cell_PayTo['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_PayTo['width'], 0, $cell_PayTo['data'], 0, 0, $cell_PayTo['align']);

            $this->Pdf->SetFont($cell_Designation['font_type'], $cell_Designation['font_style'], $cell_Designation['font_size']);
            $this->pdf_text_color($cell_Designation['data'], $cell_Designation['color_r'], $cell_Designation['color_g'], $cell_Designation['color_b']);
            if (!empty($cell_Designation['posx']) && !empty($cell_Designation['posy']))
            {
                $this->Pdf->SetXY($cell_Designation['posx'] + $this->SC_incr_col,  $cell_Designation['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_Designation['posx']))
            {
                $this->Pdf->SetX($cell_Designation['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_Designation['posy']))
            {
                $this->Pdf->SetY($cell_Designation['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_Designation['width'], 0, $cell_Designation['data'], 0, 0, $cell_Designation['align']);

            $this->Pdf->SetFont($cell_lbl_rappel['font_type'], $cell_lbl_rappel['font_style'], $cell_lbl_rappel['font_size']);
            $this->pdf_text_color($cell_lbl_rappel['data'], $cell_lbl_rappel['color_r'], $cell_lbl_rappel['color_g'], $cell_lbl_rappel['color_b']);
            if (!empty($cell_lbl_rappel['posx']) && !empty($cell_lbl_rappel['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_rappel['posx'] + $this->SC_incr_col,  $cell_lbl_rappel['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_rappel['posx']))
            {
                $this->Pdf->SetX($cell_lbl_rappel['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_rappel['posy']))
            {
                $this->Pdf->SetY($cell_lbl_rappel['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_rappel['width'], 0, $cell_lbl_rappel['data'], 0, 0, $cell_lbl_rappel['align']);

            $this->Pdf->SetFont($cell_lbl_Incentive['font_type'], $cell_lbl_Incentive['font_style'], $cell_lbl_Incentive['font_size']);
            $this->pdf_text_color($cell_lbl_Incentive['data'], $cell_lbl_Incentive['color_r'], $cell_lbl_Incentive['color_g'], $cell_lbl_Incentive['color_b']);
            if (!empty($cell_lbl_Incentive['posx']) && !empty($cell_lbl_Incentive['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_Incentive['posx'] + $this->SC_incr_col,  $cell_lbl_Incentive['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_Incentive['posx']))
            {
                $this->Pdf->SetX($cell_lbl_Incentive['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_Incentive['posy']))
            {
                $this->Pdf->SetY($cell_lbl_Incentive['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_Incentive['width'], 0, $cell_lbl_Incentive['data'], 0, 0, $cell_lbl_Incentive['align']);

            $this->Pdf->SetFont($cell_lbl_Sal_Reg['font_type'], $cell_lbl_Sal_Reg['font_style'], $cell_lbl_Sal_Reg['font_size']);
            $this->pdf_text_color($cell_lbl_Sal_Reg['data'], $cell_lbl_Sal_Reg['color_r'], $cell_lbl_Sal_Reg['color_g'], $cell_lbl_Sal_Reg['color_b']);
            if (!empty($cell_lbl_Sal_Reg['posx']) && !empty($cell_lbl_Sal_Reg['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_Sal_Reg['posx'] + $this->SC_incr_col,  $cell_lbl_Sal_Reg['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_Sal_Reg['posx']))
            {
                $this->Pdf->SetX($cell_lbl_Sal_Reg['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_Sal_Reg['posy']))
            {
                $this->Pdf->SetY($cell_lbl_Sal_Reg['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_Sal_Reg['width'], 0, $cell_lbl_Sal_Reg['data'], 0, 0, $cell_lbl_Sal_Reg['align']);

            $this->Pdf->SetFont($cell_lbl_salleavetype['font_type'], $cell_lbl_salleavetype['font_style'], $cell_lbl_salleavetype['font_size']);
            $this->pdf_text_color($cell_lbl_salleavetype['data'], $cell_lbl_salleavetype['color_r'], $cell_lbl_salleavetype['color_g'], $cell_lbl_salleavetype['color_b']);
            if (!empty($cell_lbl_salleavetype['posx']) && !empty($cell_lbl_salleavetype['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_salleavetype['posx'] + $this->SC_incr_col,  $cell_lbl_salleavetype['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_salleavetype['posx']))
            {
                $this->Pdf->SetX($cell_lbl_salleavetype['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_salleavetype['posy']))
            {
                $this->Pdf->SetY($cell_lbl_salleavetype['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_salleavetype['width'], 0, $cell_lbl_salleavetype['data'], 0, 0, $cell_lbl_salleavetype['align']);

            $this->Pdf->SetFont($cell_txt_workdayAM['font_type'], $cell_txt_workdayAM['font_style'], $cell_txt_workdayAM['font_size']);
            $this->pdf_text_color($cell_txt_workdayAM['data'], $cell_txt_workdayAM['color_r'], $cell_txt_workdayAM['color_g'], $cell_txt_workdayAM['color_b']);
            if (!empty($cell_txt_workdayAM['posx']) && !empty($cell_txt_workdayAM['posy']))
            {
                $this->Pdf->SetXY($cell_txt_workdayAM['posx'] + $this->SC_incr_col,  $cell_txt_workdayAM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_txt_workdayAM['posx']))
            {
                $this->Pdf->SetX($cell_txt_workdayAM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_txt_workdayAM['posy']))
            {
                $this->Pdf->SetY($cell_txt_workdayAM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_txt_workdayAM['width'], 0, $cell_txt_workdayAM['data'], 0, 0, $cell_txt_workdayAM['align']);

            $this->Pdf->SetFont($cell_txt_workdayPM['font_type'], $cell_txt_workdayPM['font_style'], $cell_txt_workdayPM['font_size']);
            $this->pdf_text_color($cell_txt_workdayPM['data'], $cell_txt_workdayPM['color_r'], $cell_txt_workdayPM['color_g'], $cell_txt_workdayPM['color_b']);
            if (!empty($cell_txt_workdayPM['posx']) && !empty($cell_txt_workdayPM['posy']))
            {
                $this->Pdf->SetXY($cell_txt_workdayPM['posx'] + $this->SC_incr_col,  $cell_txt_workdayPM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_txt_workdayPM['posx']))
            {
                $this->Pdf->SetX($cell_txt_workdayPM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_txt_workdayPM['posy']))
            {
                $this->Pdf->SetY($cell_txt_workdayPM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_txt_workdayPM['width'], 0, $cell_txt_workdayPM['data'], 0, 0, $cell_txt_workdayPM['align']);
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
