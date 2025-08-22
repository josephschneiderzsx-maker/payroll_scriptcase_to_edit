<?php
class pdf_payslip_search_hist_grid
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
   var $amount = array();
   var $sc_field_0 = array();
   var $sc_field_1 = array();
   var $sc_field_2 = array();
   var $sc_field_3 = array();
   var $sc_field_4 = array();
   var $sc_field_5 = array();
   var $deductions = array();
   var $sc_field_6 = array();
   var $sc_field_7 = array();
   var $irisal = array();
   var $incentive_lbl = array();
   var $sc_field_8 = array();
   var $ona = array();
   var $sc_field_9 = array();
   var $sc_field_10 = array();
   var $sc_field_11 = array();
   var $sc_field_12 = array();
   var $sc_field_13 = array();
   var $sc_field_14 = array();
   var $sc_field_15 = array();
   var $sc_field_16 = array();
   var $sc_field_17 = array();
   var $sc_field_18 = array();
   var $sc_field_19 = array();
   var $sc_field_20 = array();
   var $sc_field_21 = array();
   var $lbl_holiday = array();
   var $sc_field_22 = array();
   var $lbl_holidayhh = array();
   var $lbl_hourearned = array();
   var $lbl_leavetypebenefits = array();
   var $lbl_mealrate = array();
   var $lbl_mealday = array();
   var $lbl_ratework = array();
   var $lbl_restday = array();
   var $lbl_salholiday = array();
   var $lbl_saloffday = array();
   var $lbl_salrestday = array();
   var $lbl_salworkday = array();
   var $lbl_sal_reg = array();
   var $lbl_sundaybenefits = array();
   var $lbl_sundayhh = array();
   var $lbl_workay = array();
   var $lbl_amount01 = array();
   var $lbl_companyname = array();
   var $lbl_deductions = array();
   var $lbl_dept = array();
   var $lbl_earning = array();
   var $lbl_employeename = array();
   var $lbl_fixedsalary = array();
   var $lbl_leavehh = array();
   var $lbl_line01 = array();
   var $lbl_offday = array();
   var $lbl_payslip = array();
   var $lbl_rappel = array();
   var $lbl_salholidaydet = array();
   var $lbl_saloffdaydet = array();
   var $lbl_salrestdaydet = array();
   var $lbl_salworkdaydet = array();
   var $lbl_taxcass = array();
   var $lbl_taxcfgdct = array();
   var $lbl_taxfdu = array();
   var $userid_int = array();
   var $hiredate = array();
   var $username = array();
   var $dept = array();
   var $designation = array();
   var $rate_work = array();
   var $rate_salf = array();
   var $income_workday = array();
   var $income_holiday = array();
   var $income_restday = array();
   var $income_offday = array();
   var $sal_sunday = array();
   var $sal_holiday = array();
   var $sal_leavetype = array();
   var $sal_brut_reg = array();
   var $income_workday_ot = array();
   var $income_holiday_ot = array();
   var $income_restday_ot = array();
   var $income_offday_ot = array();
   var $incentive = array();
   var $income_comm = array();
   var $rappel = array();
   var $tax_cass = array();
   var $tax_cfgdct = array();
   var $tax_fdu = array();
   var $tax_ona = array();
   var $tax_iric = array();
   var $dedeuct_cons = array();
   var $loan_deduction = array();
   var $loan_deduction_bank = array();
   var $other_deduct = array();
   var $total_deduct = array();
   var $sal_net = array();
   var $work_hh_w = array();
   var $ot_hh_w = array();
   var $hh_sunday = array();
   var $work_hh_r = array();
   var $ot_hh_r = array();
   var $hh_offday = array();
   var $work_hh_h = array();
   var $ot_hh_h = array();
   var $sal_hr_worked = array();
   var $sal_sunday_1 = array();
   var $sal_holiday_1 = array();
   var $sal_brut_reg_1 = array();
   var $sal_suppl = array();
   var $sal_holiday_worked_suppl = array();
   var $sal_holiday_suppl = array();
   var $sal_restday_worked_suppl = array();
   var $sal_restday_suppl = array();
   var $tax_iris = array();
   var $day_cons = array();
   var $rate_cons = array();
   var $other_loan_deduction = array();
   var $other_deduct_1 = array();
   var $other_deduct_desc = array();
   var $bank_number = array();
   var $pay_startdate = array();
   var $pay_enddate = array();
   var $work_hh_w_pm = array();
   var $ot_hh_w_pm = array();
   var $work_hh_h_pm = array();
   var $ot_hh_h_pm = array();
   var $work_hh_r_pm = array();
   var $ot_hh_r_pm = array();
   var $work_hh_o = array();
   var $work_hh_o_pm = array();
   var $ot_hh_o = array();
   var $ot_hh_o_pm = array();
   var $hh_leavetype = array();
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
   $_SESSION['scriptcase']['pdf_payslip_search_hist']['default_font'] = $this->default_font;
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
           if (in_array("pdf_payslip_search_hist", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['exit'] = "on";
   $this->sc_proc_grid = false; 
   $this->NM_raiz_img = $this->Ini->root;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $this->nm_grid_colunas = 0;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['campos_busca'];
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
       $this->sal_net[0] = (isset($Busca_temp['sal_net'])) ? $Busca_temp['sal_net'] : ""; 
       $tmp_pos = (is_string($this->sal_net[0])) ? strpos($this->sal_net[0], "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->sal_net[0]))
       {
           $this->sal_net[0] = substr($this->sal_net[0], 0, $tmp_pos);
       }
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_pesq_filtro'];
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   $_SESSION['scriptcase']['contr_link_emb'] = $this->nm_location;
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['qt_col_grid'] = 1 ;  
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdf_payslip_search_hist']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['pdf_payslip_search_hist']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['pdf_payslip_search_hist']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['pdf_payslip_search_hist']['cols']);
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['ordem_select']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['ordem_select'] = array(); 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['ordem_select']['dept'] = 'asc'; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['ordem_select']['userid_int'] = 'asc'; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['ordem_select_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['ordem_select']; 
   } 
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['ordem_quebra']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['ordem_ant']  = "dept,userid_int"; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['ordem_desc'] = "" ; 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_orig'] = "";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_pesq_filtro'];
//
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['tot_geral'][1])) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['tot_geral'][1] ;  
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_pesq'];  
//----- 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT userid_int, hiredate, username, dept, designation, Rate_Work, Rate_SALF, income_workday, income_holiday, income_restday, income_offday, sal_sunday, sal_holiday, sal_leavetype, sal_brut_reg, income_workday_ot, income_holiday_ot, income_restday_ot, income_offday_ot, incentive, income_comm, rappel, tax_cass, tax_cfgdct, tax_fdu, tax_ona, tax_iric, dedeuct_cons, loan_deduction, loan_deduction_bank, other_deduct, total_deduct, sal_net, work_hh_w, ot_hh_w, hh_sunday, work_hh_r, ot_hh_r, hh_offday, work_hh_h, ot_hh_h, sal_hr_worked, sal_sunday as sal_sunday_1, sal_holiday as sal_holiday_1, sal_brut_reg as sal_brut_reg_1, sal_suppl, sal_holiday_worked_suppl, sal_holiday_suppl, sal_restday_worked_suppl, sal_restday_suppl, tax_iris, day_cons, rate_cons, other_loan_deduction, other_deduct as other_deduct_1, other_deduct_desc, bank_number, pay_startdate, pay_enddate, work_hh_w_PM, ot_hh_w_PM, work_hh_h_PM, ot_hh_h_PM, work_hh_r_PM, ot_hh_r_PM, work_hh_o, work_hh_o_PM, ot_hh_o, ot_hh_o_PM, hh_leavetype from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT userid_int, hiredate, username, dept, designation, Rate_Work, Rate_SALF, income_workday, income_holiday, income_restday, income_offday, sal_sunday, sal_holiday, sal_leavetype, sal_brut_reg, income_workday_ot, income_holiday_ot, income_restday_ot, income_offday_ot, incentive, income_comm, rappel, tax_cass, tax_cfgdct, tax_fdu, tax_ona, tax_iric, dedeuct_cons, loan_deduction, loan_deduction_bank, other_deduct, total_deduct, sal_net, work_hh_w, ot_hh_w, hh_sunday, work_hh_r, ot_hh_r, hh_offday, work_hh_h, ot_hh_h, sal_hr_worked, sal_sunday as sal_sunday_1, sal_holiday as sal_holiday_1, sal_brut_reg as sal_brut_reg_1, sal_suppl, sal_holiday_worked_suppl, sal_holiday_suppl, sal_restday_worked_suppl, sal_restday_suppl, tax_iris, day_cons, rate_cons, other_loan_deduction, other_deduct as other_deduct_1, other_deduct_desc, bank_number, pay_startdate, pay_enddate, work_hh_w_PM, ot_hh_w_PM, work_hh_h_PM, ot_hh_h_PM, work_hh_r_PM, ot_hh_r_PM, work_hh_o, work_hh_o_PM, ot_hh_o, ot_hh_o_PM, hh_leavetype from " . $this->Ini->nm_tabela; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_pesq']; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['ordem_grid'])) 
   { 
       $nmgp_order_by = " order by " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['ordem_desc']; 
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['order_grid'] = $nmgp_order_by;
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['userid_int'] = "Userid Int";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['hiredate'] = "Hiredate";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['username'] = "Username";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['dept'] = "Dept";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['designation'] = "Designation";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['rate_work'] = "Rate Work";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['rate_salf'] = "Rate SALF";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['income_workday'] = "Income Workday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['income_holiday'] = "Income Holiday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['income_restday'] = "Income Restday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['income_offday'] = "Income Offday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sal_sunday'] = "Sal Sunday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sal_holiday'] = "Sal Holiday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sal_leavetype'] = "Sal Leavetype";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sal_brut_reg'] = "Sal Brut Reg";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['income_workday_ot'] = "Income Workday Ot";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['income_holiday_ot'] = "Income Holiday Ot";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['income_restday_ot'] = "Income Restday Ot";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['income_offday_ot'] = "Income Offday Ot";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['incentive'] = "Incentive";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['income_comm'] = "Income Comm";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['rappel'] = "Rappel";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['tax_cass'] = "Tax Cass";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['tax_cfgdct'] = "Tax Cfgdct";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['tax_fdu'] = "Tax Fdu";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['tax_ona'] = "Tax Ona";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['tax_iric'] = "Tax Iric";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['dedeuct_cons'] = "Dedeuct Cons";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['loan_deduction'] = "Loan Deduction";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['loan_deduction_bank'] = "Loan Deduction Bank";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['other_deduct'] = "Other Deduct";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['total_deduct'] = "Total Deduct";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sal_net'] = "Sal Net";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['work_hh_w'] = "Work Hh W";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['ot_hh_w'] = "Ot Hh W";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['hh_sunday'] = "Hh Sunday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['work_hh_r'] = "Work Hh R";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['ot_hh_r'] = "Ot Hh R";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['hh_offday'] = "Hh Offday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['work_hh_h'] = "Work Hh H";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['ot_hh_h'] = "Ot Hh H";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sal_hr_worked'] = "Sal Hr Worked";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sal_sunday_1'] = "Sal Sunday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sal_holiday_1'] = "Sal Holiday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sal_brut_reg_1'] = "Sal Brut Reg";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sal_suppl'] = "Sal Suppl";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sal_holiday_worked_suppl'] = "Sal Holiday Worked Suppl";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sal_holiday_suppl'] = "Sal Holiday Suppl";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sal_restday_worked_suppl'] = "Sal Restday Worked Suppl";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sal_restday_suppl'] = "Sal Restday Suppl";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['tax_iris'] = "Tax Iris";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['day_cons'] = "Day Cons";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['rate_cons'] = "Rate Cons";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['other_loan_deduction'] = "Other Loan Deduction";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['other_deduct_1'] = "Other Deduct";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['other_deduct_desc'] = "Other Deduct Desc";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['bank_number'] = "Bank Number";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['pay_startdate'] = "Pay Startdate";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['pay_enddate'] = "Pay Enddate";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['work_hh_w_pm'] = "Work Hh W PM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['ot_hh_w_pm'] = "Ot Hh W PM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['work_hh_h_pm'] = "Work Hh H PM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['ot_hh_h_pm'] = "Ot Hh H PM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['work_hh_r_pm'] = "Work Hh R PM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['ot_hh_r_pm'] = "Ot Hh R PM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['work_hh_o'] = "Work Hh O";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['work_hh_o_pm'] = "Work Hh O PM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['ot_hh_o'] = "Ot Hh O";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['ot_hh_o_pm'] = "Ot Hh O PM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['hh_leavetype'] = "Hh Leavetype";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['amount'] = "Amount";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_0'] = "Attendance AM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_1'] = "Attendance PM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_2'] = "Deduct Loan Bank";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_3'] = "Deduct Loan Enterprise";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_4'] = "Deduct Meal";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_5'] = "Deduct Other";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['deductions'] = "Deductions";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_6'] = "Employee Name";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_7'] = "Fingertec ID";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['irisal'] = "IRISal";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['incentive_lbl'] = "Incentive_lbl";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_8'] = "NET EARNINGS";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['ona'] = "ONA";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_9'] = "OT AM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_10'] = "OT PM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_11'] = "Pay From";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_12'] = "Pay To";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_13'] = "Rappel / Extra";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_14'] = "Sal. Holiday OT";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_15'] = "Sal. Offday OT";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_16'] = "Sal. Restday OT";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_17'] = "Sal. Workday OT";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_18'] = "TCA Add";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_19'] = "Tota Sal. Additional";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_20'] = "Total Deductions";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_21'] = "Workday AM";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_holiday'] = "lbl_Holiday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['sc_field_22'] = "lbl_HolidayBenefits ";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_holidayhh'] = "lbl_HolidayHH";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_hourearned'] = "lbl_Hourearned";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_leavetypebenefits'] = "lbl_LeavetypeBenefits";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_mealrate'] = "lbl_MealRate";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_mealday'] = "lbl_Mealday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_ratework'] = "lbl_RateWork";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_restday'] = "lbl_Restday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_salholiday'] = "lbl_SalHoliday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_saloffday'] = "lbl_SalOffday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_salrestday'] = "lbl_SalRestday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_salworkday'] = "lbl_SalWorkday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_sal_reg'] = "lbl_Sal_Reg";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_sundaybenefits'] = "lbl_SundayBenefits";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_sundayhh'] = "lbl_SundayHH";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_workay'] = "lbl_Workay";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_amount01'] = "lbl_amount01";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_companyname'] = "lbl_companyname";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_deductions'] = "lbl_deductions";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_dept'] = "lbl_dept";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_earning'] = "lbl_earning";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_employeename'] = "lbl_employeename";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_fixedsalary'] = "lbl_fixedsalary";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_leavehh'] = "lbl_leaveHH";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_line01'] = "lbl_line01";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_offday'] = "lbl_offday";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_payslip'] = "lbl_payslip";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_rappel'] = "lbl_rappel";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_salholidaydet'] = "lbl_salHolidaydet";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_saloffdaydet'] = "lbl_salOffdaydet";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_salrestdaydet'] = "lbl_salRestdaydet";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_salworkdaydet'] = "lbl_salWorkdaydet";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_taxcass'] = "lbl_taxCASS";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_taxcfgdct'] = "lbl_taxCFGDCT";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['labels']['lbl_taxfdu'] = "lbl_taxFDU";
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['seq_dir'] = 0; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['sub_dir'] = array(); 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['where_pesq_filtro'];
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdf_payslip_search_hist']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['pdf_payslip_search_hist']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['pdf_payslip_search_hist']['lig_edit'];
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
   $this->SC_desloca_lin  = 88; 
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
      while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['qt_col_grid']) 
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
          $this->rate_work[$this->nm_grid_colunas] = $this->rs_grid->fields[5] ;  
          $this->rate_work[$this->nm_grid_colunas] =  str_replace(",", ".", $this->rate_work[$this->nm_grid_colunas]);
          $this->rate_work[$this->nm_grid_colunas] = (string)$this->rate_work[$this->nm_grid_colunas];
          $this->rate_salf[$this->nm_grid_colunas] = $this->rs_grid->fields[6] ;  
          $this->rate_salf[$this->nm_grid_colunas] =  str_replace(",", ".", $this->rate_salf[$this->nm_grid_colunas]);
          $this->rate_salf[$this->nm_grid_colunas] = (string)$this->rate_salf[$this->nm_grid_colunas];
          $this->income_workday[$this->nm_grid_colunas] = $this->rs_grid->fields[7] ;  
          $this->income_workday[$this->nm_grid_colunas] =  str_replace(",", ".", $this->income_workday[$this->nm_grid_colunas]);
          $this->income_workday[$this->nm_grid_colunas] = (string)$this->income_workday[$this->nm_grid_colunas];
          $this->income_holiday[$this->nm_grid_colunas] = $this->rs_grid->fields[8] ;  
          $this->income_holiday[$this->nm_grid_colunas] =  str_replace(",", ".", $this->income_holiday[$this->nm_grid_colunas]);
          $this->income_holiday[$this->nm_grid_colunas] = (string)$this->income_holiday[$this->nm_grid_colunas];
          $this->income_restday[$this->nm_grid_colunas] = $this->rs_grid->fields[9] ;  
          $this->income_restday[$this->nm_grid_colunas] =  str_replace(",", ".", $this->income_restday[$this->nm_grid_colunas]);
          $this->income_restday[$this->nm_grid_colunas] = (string)$this->income_restday[$this->nm_grid_colunas];
          $this->income_offday[$this->nm_grid_colunas] = $this->rs_grid->fields[10] ;  
          $this->income_offday[$this->nm_grid_colunas] =  str_replace(",", ".", $this->income_offday[$this->nm_grid_colunas]);
          $this->income_offday[$this->nm_grid_colunas] = (string)$this->income_offday[$this->nm_grid_colunas];
          $this->sal_sunday[$this->nm_grid_colunas] = $this->rs_grid->fields[11] ;  
          $this->sal_sunday[$this->nm_grid_colunas] =  str_replace(",", ".", $this->sal_sunday[$this->nm_grid_colunas]);
          $this->sal_sunday[$this->nm_grid_colunas] = (string)$this->sal_sunday[$this->nm_grid_colunas];
          $this->sal_holiday[$this->nm_grid_colunas] = $this->rs_grid->fields[12] ;  
          $this->sal_holiday[$this->nm_grid_colunas] =  str_replace(",", ".", $this->sal_holiday[$this->nm_grid_colunas]);
          $this->sal_holiday[$this->nm_grid_colunas] = (string)$this->sal_holiday[$this->nm_grid_colunas];
          $this->sal_leavetype[$this->nm_grid_colunas] = $this->rs_grid->fields[13] ;  
          $this->sal_leavetype[$this->nm_grid_colunas] =  str_replace(",", ".", $this->sal_leavetype[$this->nm_grid_colunas]);
          $this->sal_leavetype[$this->nm_grid_colunas] = (string)$this->sal_leavetype[$this->nm_grid_colunas];
          $this->sal_brut_reg[$this->nm_grid_colunas] = $this->rs_grid->fields[14] ;  
          $this->sal_brut_reg[$this->nm_grid_colunas] =  str_replace(",", ".", $this->sal_brut_reg[$this->nm_grid_colunas]);
          $this->sal_brut_reg[$this->nm_grid_colunas] = (string)$this->sal_brut_reg[$this->nm_grid_colunas];
          $this->income_workday_ot[$this->nm_grid_colunas] = $this->rs_grid->fields[15] ;  
          $this->income_workday_ot[$this->nm_grid_colunas] =  str_replace(",", ".", $this->income_workday_ot[$this->nm_grid_colunas]);
          $this->income_workday_ot[$this->nm_grid_colunas] = (string)$this->income_workday_ot[$this->nm_grid_colunas];
          $this->income_holiday_ot[$this->nm_grid_colunas] = $this->rs_grid->fields[16] ;  
          $this->income_holiday_ot[$this->nm_grid_colunas] =  str_replace(",", ".", $this->income_holiday_ot[$this->nm_grid_colunas]);
          $this->income_holiday_ot[$this->nm_grid_colunas] = (string)$this->income_holiday_ot[$this->nm_grid_colunas];
          $this->income_restday_ot[$this->nm_grid_colunas] = $this->rs_grid->fields[17] ;  
          $this->income_restday_ot[$this->nm_grid_colunas] =  str_replace(",", ".", $this->income_restday_ot[$this->nm_grid_colunas]);
          $this->income_restday_ot[$this->nm_grid_colunas] = (string)$this->income_restday_ot[$this->nm_grid_colunas];
          $this->income_offday_ot[$this->nm_grid_colunas] = $this->rs_grid->fields[18] ;  
          $this->income_offday_ot[$this->nm_grid_colunas] =  str_replace(",", ".", $this->income_offday_ot[$this->nm_grid_colunas]);
          $this->income_offday_ot[$this->nm_grid_colunas] = (string)$this->income_offday_ot[$this->nm_grid_colunas];
          $this->incentive[$this->nm_grid_colunas] = $this->rs_grid->fields[19] ;  
          $this->incentive[$this->nm_grid_colunas] =  str_replace(",", ".", $this->incentive[$this->nm_grid_colunas]);
          $this->incentive[$this->nm_grid_colunas] = (string)$this->incentive[$this->nm_grid_colunas];
          $this->income_comm[$this->nm_grid_colunas] = $this->rs_grid->fields[20] ;  
          $this->income_comm[$this->nm_grid_colunas] =  str_replace(",", ".", $this->income_comm[$this->nm_grid_colunas]);
          $this->income_comm[$this->nm_grid_colunas] = (string)$this->income_comm[$this->nm_grid_colunas];
          $this->rappel[$this->nm_grid_colunas] = $this->rs_grid->fields[21] ;  
          $this->rappel[$this->nm_grid_colunas] =  str_replace(",", ".", $this->rappel[$this->nm_grid_colunas]);
          $this->rappel[$this->nm_grid_colunas] = (string)$this->rappel[$this->nm_grid_colunas];
          $this->tax_cass[$this->nm_grid_colunas] = $this->rs_grid->fields[22] ;  
          $this->tax_cass[$this->nm_grid_colunas] =  str_replace(",", ".", $this->tax_cass[$this->nm_grid_colunas]);
          $this->tax_cass[$this->nm_grid_colunas] = (string)$this->tax_cass[$this->nm_grid_colunas];
          $this->tax_cfgdct[$this->nm_grid_colunas] = $this->rs_grid->fields[23] ;  
          $this->tax_cfgdct[$this->nm_grid_colunas] =  str_replace(",", ".", $this->tax_cfgdct[$this->nm_grid_colunas]);
          $this->tax_cfgdct[$this->nm_grid_colunas] = (string)$this->tax_cfgdct[$this->nm_grid_colunas];
          $this->tax_fdu[$this->nm_grid_colunas] = $this->rs_grid->fields[24] ;  
          $this->tax_fdu[$this->nm_grid_colunas] =  str_replace(",", ".", $this->tax_fdu[$this->nm_grid_colunas]);
          $this->tax_fdu[$this->nm_grid_colunas] = (string)$this->tax_fdu[$this->nm_grid_colunas];
          $this->tax_ona[$this->nm_grid_colunas] = $this->rs_grid->fields[25] ;  
          $this->tax_ona[$this->nm_grid_colunas] =  str_replace(",", ".", $this->tax_ona[$this->nm_grid_colunas]);
          $this->tax_ona[$this->nm_grid_colunas] = (string)$this->tax_ona[$this->nm_grid_colunas];
          $this->tax_iric[$this->nm_grid_colunas] = $this->rs_grid->fields[26] ;  
          $this->tax_iric[$this->nm_grid_colunas] =  str_replace(",", ".", $this->tax_iric[$this->nm_grid_colunas]);
          $this->tax_iric[$this->nm_grid_colunas] = (string)$this->tax_iric[$this->nm_grid_colunas];
          $this->dedeuct_cons[$this->nm_grid_colunas] = $this->rs_grid->fields[27] ;  
          $this->dedeuct_cons[$this->nm_grid_colunas] =  str_replace(",", ".", $this->dedeuct_cons[$this->nm_grid_colunas]);
          $this->dedeuct_cons[$this->nm_grid_colunas] = (string)$this->dedeuct_cons[$this->nm_grid_colunas];
          $this->loan_deduction[$this->nm_grid_colunas] = $this->rs_grid->fields[28] ;  
          $this->loan_deduction[$this->nm_grid_colunas] =  str_replace(",", ".", $this->loan_deduction[$this->nm_grid_colunas]);
          $this->loan_deduction[$this->nm_grid_colunas] = (string)$this->loan_deduction[$this->nm_grid_colunas];
          $this->loan_deduction_bank[$this->nm_grid_colunas] = $this->rs_grid->fields[29] ;  
          $this->loan_deduction_bank[$this->nm_grid_colunas] =  str_replace(",", ".", $this->loan_deduction_bank[$this->nm_grid_colunas]);
          $this->loan_deduction_bank[$this->nm_grid_colunas] = (string)$this->loan_deduction_bank[$this->nm_grid_colunas];
          $this->other_deduct[$this->nm_grid_colunas] = $this->rs_grid->fields[30] ;  
          $this->other_deduct[$this->nm_grid_colunas] =  str_replace(",", ".", $this->other_deduct[$this->nm_grid_colunas]);
          $this->other_deduct[$this->nm_grid_colunas] = (string)$this->other_deduct[$this->nm_grid_colunas];
          $this->total_deduct[$this->nm_grid_colunas] = $this->rs_grid->fields[31] ;  
          $this->total_deduct[$this->nm_grid_colunas] =  str_replace(",", ".", $this->total_deduct[$this->nm_grid_colunas]);
          $this->total_deduct[$this->nm_grid_colunas] = (string)$this->total_deduct[$this->nm_grid_colunas];
          $this->sal_net[$this->nm_grid_colunas] = $this->rs_grid->fields[32] ;  
          $this->sal_net[$this->nm_grid_colunas] =  str_replace(",", ".", $this->sal_net[$this->nm_grid_colunas]);
          $this->sal_net[$this->nm_grid_colunas] = (string)$this->sal_net[$this->nm_grid_colunas];
          $this->work_hh_w[$this->nm_grid_colunas] = $this->rs_grid->fields[33] ;  
          $this->work_hh_w[$this->nm_grid_colunas] =  str_replace(",", ".", $this->work_hh_w[$this->nm_grid_colunas]);
          $this->work_hh_w[$this->nm_grid_colunas] = (string)$this->work_hh_w[$this->nm_grid_colunas];
          $this->ot_hh_w[$this->nm_grid_colunas] = $this->rs_grid->fields[34] ;  
          $this->ot_hh_w[$this->nm_grid_colunas] =  str_replace(",", ".", $this->ot_hh_w[$this->nm_grid_colunas]);
          $this->ot_hh_w[$this->nm_grid_colunas] = (string)$this->ot_hh_w[$this->nm_grid_colunas];
          $this->hh_sunday[$this->nm_grid_colunas] = $this->rs_grid->fields[35] ;  
          $this->hh_sunday[$this->nm_grid_colunas] =  str_replace(",", ".", $this->hh_sunday[$this->nm_grid_colunas]);
          $this->hh_sunday[$this->nm_grid_colunas] = (string)$this->hh_sunday[$this->nm_grid_colunas];
          $this->work_hh_r[$this->nm_grid_colunas] = $this->rs_grid->fields[36] ;  
          $this->work_hh_r[$this->nm_grid_colunas] =  str_replace(",", ".", $this->work_hh_r[$this->nm_grid_colunas]);
          $this->work_hh_r[$this->nm_grid_colunas] = (string)$this->work_hh_r[$this->nm_grid_colunas];
          $this->ot_hh_r[$this->nm_grid_colunas] = $this->rs_grid->fields[37] ;  
          $this->ot_hh_r[$this->nm_grid_colunas] =  str_replace(",", ".", $this->ot_hh_r[$this->nm_grid_colunas]);
          $this->ot_hh_r[$this->nm_grid_colunas] = (string)$this->ot_hh_r[$this->nm_grid_colunas];
          $this->hh_offday[$this->nm_grid_colunas] = $this->rs_grid->fields[38] ;  
          $this->hh_offday[$this->nm_grid_colunas] =  str_replace(",", ".", $this->hh_offday[$this->nm_grid_colunas]);
          $this->hh_offday[$this->nm_grid_colunas] = (string)$this->hh_offday[$this->nm_grid_colunas];
          $this->work_hh_h[$this->nm_grid_colunas] = $this->rs_grid->fields[39] ;  
          $this->work_hh_h[$this->nm_grid_colunas] =  str_replace(",", ".", $this->work_hh_h[$this->nm_grid_colunas]);
          $this->work_hh_h[$this->nm_grid_colunas] = (string)$this->work_hh_h[$this->nm_grid_colunas];
          $this->ot_hh_h[$this->nm_grid_colunas] = $this->rs_grid->fields[40] ;  
          $this->ot_hh_h[$this->nm_grid_colunas] =  str_replace(",", ".", $this->ot_hh_h[$this->nm_grid_colunas]);
          $this->ot_hh_h[$this->nm_grid_colunas] = (string)$this->ot_hh_h[$this->nm_grid_colunas];
          $this->sal_hr_worked[$this->nm_grid_colunas] = $this->rs_grid->fields[41] ;  
          $this->sal_hr_worked[$this->nm_grid_colunas] =  str_replace(",", ".", $this->sal_hr_worked[$this->nm_grid_colunas]);
          $this->sal_hr_worked[$this->nm_grid_colunas] = (string)$this->sal_hr_worked[$this->nm_grid_colunas];
          $this->sal_sunday_1[$this->nm_grid_colunas] = $this->rs_grid->fields[42] ;  
          $this->sal_sunday_1[$this->nm_grid_colunas] =  str_replace(",", ".", $this->sal_sunday_1[$this->nm_grid_colunas]);
          $this->sal_sunday_1[$this->nm_grid_colunas] = (string)$this->sal_sunday_1[$this->nm_grid_colunas];
          $this->sal_holiday_1[$this->nm_grid_colunas] = $this->rs_grid->fields[43] ;  
          $this->sal_holiday_1[$this->nm_grid_colunas] =  str_replace(",", ".", $this->sal_holiday_1[$this->nm_grid_colunas]);
          $this->sal_holiday_1[$this->nm_grid_colunas] = (string)$this->sal_holiday_1[$this->nm_grid_colunas];
          $this->sal_brut_reg_1[$this->nm_grid_colunas] = $this->rs_grid->fields[44] ;  
          $this->sal_brut_reg_1[$this->nm_grid_colunas] =  str_replace(",", ".", $this->sal_brut_reg_1[$this->nm_grid_colunas]);
          $this->sal_brut_reg_1[$this->nm_grid_colunas] = (string)$this->sal_brut_reg_1[$this->nm_grid_colunas];
          $this->sal_suppl[$this->nm_grid_colunas] = $this->rs_grid->fields[45] ;  
          $this->sal_suppl[$this->nm_grid_colunas] =  str_replace(",", ".", $this->sal_suppl[$this->nm_grid_colunas]);
          $this->sal_suppl[$this->nm_grid_colunas] = (string)$this->sal_suppl[$this->nm_grid_colunas];
          $this->sal_holiday_worked_suppl[$this->nm_grid_colunas] = $this->rs_grid->fields[46] ;  
          $this->sal_holiday_worked_suppl[$this->nm_grid_colunas] =  str_replace(",", ".", $this->sal_holiday_worked_suppl[$this->nm_grid_colunas]);
          $this->sal_holiday_worked_suppl[$this->nm_grid_colunas] = (string)$this->sal_holiday_worked_suppl[$this->nm_grid_colunas];
          $this->sal_holiday_suppl[$this->nm_grid_colunas] = $this->rs_grid->fields[47] ;  
          $this->sal_holiday_suppl[$this->nm_grid_colunas] =  str_replace(",", ".", $this->sal_holiday_suppl[$this->nm_grid_colunas]);
          $this->sal_holiday_suppl[$this->nm_grid_colunas] = (string)$this->sal_holiday_suppl[$this->nm_grid_colunas];
          $this->sal_restday_worked_suppl[$this->nm_grid_colunas] = $this->rs_grid->fields[48] ;  
          $this->sal_restday_worked_suppl[$this->nm_grid_colunas] =  str_replace(",", ".", $this->sal_restday_worked_suppl[$this->nm_grid_colunas]);
          $this->sal_restday_worked_suppl[$this->nm_grid_colunas] = (string)$this->sal_restday_worked_suppl[$this->nm_grid_colunas];
          $this->sal_restday_suppl[$this->nm_grid_colunas] = $this->rs_grid->fields[49] ;  
          $this->sal_restday_suppl[$this->nm_grid_colunas] =  str_replace(",", ".", $this->sal_restday_suppl[$this->nm_grid_colunas]);
          $this->sal_restday_suppl[$this->nm_grid_colunas] = (string)$this->sal_restday_suppl[$this->nm_grid_colunas];
          $this->tax_iris[$this->nm_grid_colunas] = $this->rs_grid->fields[50] ;  
          $this->tax_iris[$this->nm_grid_colunas] =  str_replace(",", ".", $this->tax_iris[$this->nm_grid_colunas]);
          $this->tax_iris[$this->nm_grid_colunas] = (string)$this->tax_iris[$this->nm_grid_colunas];
          $this->day_cons[$this->nm_grid_colunas] = $this->rs_grid->fields[51] ;  
          $this->day_cons[$this->nm_grid_colunas] =  str_replace(",", ".", $this->day_cons[$this->nm_grid_colunas]);
          $this->day_cons[$this->nm_grid_colunas] = (string)$this->day_cons[$this->nm_grid_colunas];
          $this->rate_cons[$this->nm_grid_colunas] = $this->rs_grid->fields[52] ;  
          $this->rate_cons[$this->nm_grid_colunas] =  str_replace(",", ".", $this->rate_cons[$this->nm_grid_colunas]);
          $this->rate_cons[$this->nm_grid_colunas] = (string)$this->rate_cons[$this->nm_grid_colunas];
          $this->other_loan_deduction[$this->nm_grid_colunas] = $this->rs_grid->fields[53] ;  
          $this->other_loan_deduction[$this->nm_grid_colunas] =  str_replace(",", ".", $this->other_loan_deduction[$this->nm_grid_colunas]);
          $this->other_loan_deduction[$this->nm_grid_colunas] = (string)$this->other_loan_deduction[$this->nm_grid_colunas];
          $this->other_deduct_1[$this->nm_grid_colunas] = $this->rs_grid->fields[54] ;  
          $this->other_deduct_1[$this->nm_grid_colunas] =  str_replace(",", ".", $this->other_deduct_1[$this->nm_grid_colunas]);
          $this->other_deduct_1[$this->nm_grid_colunas] = (string)$this->other_deduct_1[$this->nm_grid_colunas];
          $this->other_deduct_desc[$this->nm_grid_colunas] = $this->rs_grid->fields[55] ;  
          $this->bank_number[$this->nm_grid_colunas] = $this->rs_grid->fields[56] ;  
          $this->pay_startdate[$this->nm_grid_colunas] = $this->rs_grid->fields[57] ;  
          $this->pay_enddate[$this->nm_grid_colunas] = $this->rs_grid->fields[58] ;  
          $this->work_hh_w_pm[$this->nm_grid_colunas] = $this->rs_grid->fields[59] ;  
          $this->work_hh_w_pm[$this->nm_grid_colunas] =  str_replace(",", ".", $this->work_hh_w_pm[$this->nm_grid_colunas]);
          $this->work_hh_w_pm[$this->nm_grid_colunas] = (string)$this->work_hh_w_pm[$this->nm_grid_colunas];
          $this->ot_hh_w_pm[$this->nm_grid_colunas] = $this->rs_grid->fields[60] ;  
          $this->ot_hh_w_pm[$this->nm_grid_colunas] =  str_replace(",", ".", $this->ot_hh_w_pm[$this->nm_grid_colunas]);
          $this->ot_hh_w_pm[$this->nm_grid_colunas] = (string)$this->ot_hh_w_pm[$this->nm_grid_colunas];
          $this->work_hh_h_pm[$this->nm_grid_colunas] = $this->rs_grid->fields[61] ;  
          $this->work_hh_h_pm[$this->nm_grid_colunas] =  str_replace(",", ".", $this->work_hh_h_pm[$this->nm_grid_colunas]);
          $this->work_hh_h_pm[$this->nm_grid_colunas] = (string)$this->work_hh_h_pm[$this->nm_grid_colunas];
          $this->ot_hh_h_pm[$this->nm_grid_colunas] = $this->rs_grid->fields[62] ;  
          $this->ot_hh_h_pm[$this->nm_grid_colunas] =  str_replace(",", ".", $this->ot_hh_h_pm[$this->nm_grid_colunas]);
          $this->ot_hh_h_pm[$this->nm_grid_colunas] = (string)$this->ot_hh_h_pm[$this->nm_grid_colunas];
          $this->work_hh_r_pm[$this->nm_grid_colunas] = $this->rs_grid->fields[63] ;  
          $this->work_hh_r_pm[$this->nm_grid_colunas] =  str_replace(",", ".", $this->work_hh_r_pm[$this->nm_grid_colunas]);
          $this->work_hh_r_pm[$this->nm_grid_colunas] = (string)$this->work_hh_r_pm[$this->nm_grid_colunas];
          $this->ot_hh_r_pm[$this->nm_grid_colunas] = $this->rs_grid->fields[64] ;  
          $this->ot_hh_r_pm[$this->nm_grid_colunas] =  str_replace(",", ".", $this->ot_hh_r_pm[$this->nm_grid_colunas]);
          $this->ot_hh_r_pm[$this->nm_grid_colunas] = (string)$this->ot_hh_r_pm[$this->nm_grid_colunas];
          $this->work_hh_o[$this->nm_grid_colunas] = $this->rs_grid->fields[65] ;  
          $this->work_hh_o[$this->nm_grid_colunas] =  str_replace(",", ".", $this->work_hh_o[$this->nm_grid_colunas]);
          $this->work_hh_o[$this->nm_grid_colunas] = (string)$this->work_hh_o[$this->nm_grid_colunas];
          $this->work_hh_o_pm[$this->nm_grid_colunas] = $this->rs_grid->fields[66] ;  
          $this->work_hh_o_pm[$this->nm_grid_colunas] =  str_replace(",", ".", $this->work_hh_o_pm[$this->nm_grid_colunas]);
          $this->work_hh_o_pm[$this->nm_grid_colunas] = (string)$this->work_hh_o_pm[$this->nm_grid_colunas];
          $this->ot_hh_o[$this->nm_grid_colunas] = $this->rs_grid->fields[67] ;  
          $this->ot_hh_o[$this->nm_grid_colunas] =  str_replace(",", ".", $this->ot_hh_o[$this->nm_grid_colunas]);
          $this->ot_hh_o[$this->nm_grid_colunas] = (string)$this->ot_hh_o[$this->nm_grid_colunas];
          $this->ot_hh_o_pm[$this->nm_grid_colunas] = $this->rs_grid->fields[68] ;  
          $this->ot_hh_o_pm[$this->nm_grid_colunas] =  str_replace(",", ".", $this->ot_hh_o_pm[$this->nm_grid_colunas]);
          $this->ot_hh_o_pm[$this->nm_grid_colunas] = (string)$this->ot_hh_o_pm[$this->nm_grid_colunas];
          $this->hh_leavetype[$this->nm_grid_colunas] = $this->rs_grid->fields[69] ;  
          $this->hh_leavetype[$this->nm_grid_colunas] =  str_replace(",", ".", $this->hh_leavetype[$this->nm_grid_colunas]);
          $this->hh_leavetype[$this->nm_grid_colunas] = (string)$this->hh_leavetype[$this->nm_grid_colunas];
          $this->amount[$this->nm_grid_colunas] = "";
          $this->sc_field_0[$this->nm_grid_colunas] = "";
          $this->sc_field_1[$this->nm_grid_colunas] = "";
          $this->sc_field_2[$this->nm_grid_colunas] = "";
          $this->sc_field_3[$this->nm_grid_colunas] = "";
          $this->sc_field_4[$this->nm_grid_colunas] = "";
          $this->sc_field_5[$this->nm_grid_colunas] = "";
          $this->deductions[$this->nm_grid_colunas] = "";
          $this->sc_field_6[$this->nm_grid_colunas] = "";
          $this->sc_field_7[$this->nm_grid_colunas] = "";
          $this->irisal[$this->nm_grid_colunas] = "";
          $this->incentive_lbl[$this->nm_grid_colunas] = "";
          $this->sc_field_8[$this->nm_grid_colunas] = "";
          $this->ona[$this->nm_grid_colunas] = "";
          $this->sc_field_9[$this->nm_grid_colunas] = "";
          $this->sc_field_10[$this->nm_grid_colunas] = "";
          $this->sc_field_11[$this->nm_grid_colunas] = "";
          $this->sc_field_12[$this->nm_grid_colunas] = "";
          $this->sc_field_13[$this->nm_grid_colunas] = "";
          $this->sc_field_14[$this->nm_grid_colunas] = "";
          $this->sc_field_15[$this->nm_grid_colunas] = "";
          $this->sc_field_16[$this->nm_grid_colunas] = "";
          $this->sc_field_17[$this->nm_grid_colunas] = "";
          $this->sc_field_18[$this->nm_grid_colunas] = "";
          $this->sc_field_19[$this->nm_grid_colunas] = "";
          $this->sc_field_20[$this->nm_grid_colunas] = "";
          $this->sc_field_21[$this->nm_grid_colunas] = "";
          $this->lbl_holiday[$this->nm_grid_colunas] = "";
          $this->sc_field_22[$this->nm_grid_colunas] = "";
          $this->lbl_holidayhh[$this->nm_grid_colunas] = "";
          $this->lbl_hourearned[$this->nm_grid_colunas] = "";
          $this->lbl_leavetypebenefits[$this->nm_grid_colunas] = "";
          $this->lbl_mealrate[$this->nm_grid_colunas] = "";
          $this->lbl_mealday[$this->nm_grid_colunas] = "";
          $this->lbl_ratework[$this->nm_grid_colunas] = "";
          $this->lbl_restday[$this->nm_grid_colunas] = "";
          $this->lbl_salholiday[$this->nm_grid_colunas] = "";
          $this->lbl_saloffday[$this->nm_grid_colunas] = "";
          $this->lbl_salrestday[$this->nm_grid_colunas] = "";
          $this->lbl_salworkday[$this->nm_grid_colunas] = "";
          $this->lbl_sal_reg[$this->nm_grid_colunas] = "";
          $this->lbl_sundaybenefits[$this->nm_grid_colunas] = "";
          $this->lbl_sundayhh[$this->nm_grid_colunas] = "";
          $this->lbl_workay[$this->nm_grid_colunas] = "";
          $this->lbl_amount01[$this->nm_grid_colunas] = "";
          $this->lbl_companyname[$this->nm_grid_colunas] = "";
          $this->lbl_deductions[$this->nm_grid_colunas] = "";
          $this->lbl_dept[$this->nm_grid_colunas] = "";
          $this->lbl_earning[$this->nm_grid_colunas] = "";
          $this->lbl_employeename[$this->nm_grid_colunas] = "";
          $this->lbl_fixedsalary[$this->nm_grid_colunas] = "";
          $this->lbl_leavehh[$this->nm_grid_colunas] = "";
          $this->lbl_line01[$this->nm_grid_colunas] = "";
          $this->lbl_offday[$this->nm_grid_colunas] = "";
          $this->lbl_payslip[$this->nm_grid_colunas] = "";
          $this->lbl_rappel[$this->nm_grid_colunas] = "";
          $this->lbl_salholidaydet[$this->nm_grid_colunas] = "";
          $this->lbl_saloffdaydet[$this->nm_grid_colunas] = "";
          $this->lbl_salrestdaydet[$this->nm_grid_colunas] = "";
          $this->lbl_salworkdaydet[$this->nm_grid_colunas] = "";
          $this->lbl_taxcass[$this->nm_grid_colunas] = "";
          $this->lbl_taxcfgdct[$this->nm_grid_colunas] = "";
          $this->lbl_taxfdu[$this->nm_grid_colunas] = "";
          $this->Lookup->lookup_lbl_companyname($this->lbl_companyname[$this->nm_grid_colunas], $this->array_lbl_companyname); 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->rate_work[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->rate_work[$this->nm_grid_colunas]));
          }
          else {
              $this->rate_work[$this->nm_grid_colunas] = sc_strip_script($this->rate_work[$this->nm_grid_colunas]);
          }
          if ($this->rate_work[$this->nm_grid_colunas] === "") 
          { 
              $this->rate_work[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->rate_work[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->rate_work[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->rate_work[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->rate_salf[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->rate_salf[$this->nm_grid_colunas]));
          }
          else {
              $this->rate_salf[$this->nm_grid_colunas] = sc_strip_script($this->rate_salf[$this->nm_grid_colunas]);
          }
          if ($this->rate_salf[$this->nm_grid_colunas] === "") 
          { 
              $this->rate_salf[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->rate_salf[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:12", "-") ; 
          } 
          $this->rate_salf[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->rate_salf[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->income_workday[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->income_workday[$this->nm_grid_colunas]));
          }
          else {
              $this->income_workday[$this->nm_grid_colunas] = sc_strip_script($this->income_workday[$this->nm_grid_colunas]);
          }
          if ($this->income_workday[$this->nm_grid_colunas] === "") 
          { 
              $this->income_workday[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->income_workday[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->income_workday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->income_workday[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->income_holiday[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->income_holiday[$this->nm_grid_colunas]));
          }
          else {
              $this->income_holiday[$this->nm_grid_colunas] = sc_strip_script($this->income_holiday[$this->nm_grid_colunas]);
          }
          if ($this->income_holiday[$this->nm_grid_colunas] === "") 
          { 
              $this->income_holiday[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->income_holiday[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->income_holiday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->income_holiday[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->income_restday[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->income_restday[$this->nm_grid_colunas]));
          }
          else {
              $this->income_restday[$this->nm_grid_colunas] = sc_strip_script($this->income_restday[$this->nm_grid_colunas]);
          }
          if ($this->income_restday[$this->nm_grid_colunas] === "") 
          { 
              $this->income_restday[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->income_restday[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->income_restday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->income_restday[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->income_offday[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->income_offday[$this->nm_grid_colunas]));
          }
          else {
              $this->income_offday[$this->nm_grid_colunas] = sc_strip_script($this->income_offday[$this->nm_grid_colunas]);
          }
          if ($this->income_offday[$this->nm_grid_colunas] === "") 
          { 
              $this->income_offday[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->income_offday[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->income_offday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->income_offday[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->sal_sunday[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->sal_sunday[$this->nm_grid_colunas]));
          }
          else {
              $this->sal_sunday[$this->nm_grid_colunas] = sc_strip_script($this->sal_sunday[$this->nm_grid_colunas]);
          }
          if ($this->sal_sunday[$this->nm_grid_colunas] === "") 
          { 
              $this->sal_sunday[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sal_sunday[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->sal_sunday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sal_sunday[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->sal_holiday[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->sal_holiday[$this->nm_grid_colunas]));
          }
          else {
              $this->sal_holiday[$this->nm_grid_colunas] = sc_strip_script($this->sal_holiday[$this->nm_grid_colunas]);
          }
          if ($this->sal_holiday[$this->nm_grid_colunas] === "") 
          { 
              $this->sal_holiday[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sal_holiday[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->sal_holiday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sal_holiday[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->sal_leavetype[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->sal_leavetype[$this->nm_grid_colunas]));
          }
          else {
              $this->sal_leavetype[$this->nm_grid_colunas] = sc_strip_script($this->sal_leavetype[$this->nm_grid_colunas]);
          }
          if ($this->sal_leavetype[$this->nm_grid_colunas] === "") 
          { 
              $this->sal_leavetype[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sal_leavetype[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->sal_leavetype[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sal_leavetype[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->sal_brut_reg[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->sal_brut_reg[$this->nm_grid_colunas]));
          }
          else {
              $this->sal_brut_reg[$this->nm_grid_colunas] = sc_strip_script($this->sal_brut_reg[$this->nm_grid_colunas]);
          }
          if ($this->sal_brut_reg[$this->nm_grid_colunas] === "") 
          { 
              $this->sal_brut_reg[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sal_brut_reg[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:12", "-") ; 
          } 
          $this->sal_brut_reg[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sal_brut_reg[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->income_workday_ot[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->income_workday_ot[$this->nm_grid_colunas]));
          }
          else {
              $this->income_workday_ot[$this->nm_grid_colunas] = sc_strip_script($this->income_workday_ot[$this->nm_grid_colunas]);
          }
          if ($this->income_workday_ot[$this->nm_grid_colunas] === "") 
          { 
              $this->income_workday_ot[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->income_workday_ot[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->income_workday_ot[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->income_workday_ot[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->income_holiday_ot[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->income_holiday_ot[$this->nm_grid_colunas]));
          }
          else {
              $this->income_holiday_ot[$this->nm_grid_colunas] = sc_strip_script($this->income_holiday_ot[$this->nm_grid_colunas]);
          }
          if ($this->income_holiday_ot[$this->nm_grid_colunas] === "") 
          { 
              $this->income_holiday_ot[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->income_holiday_ot[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->income_holiday_ot[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->income_holiday_ot[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->income_restday_ot[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->income_restday_ot[$this->nm_grid_colunas]));
          }
          else {
              $this->income_restday_ot[$this->nm_grid_colunas] = sc_strip_script($this->income_restday_ot[$this->nm_grid_colunas]);
          }
          if ($this->income_restday_ot[$this->nm_grid_colunas] === "") 
          { 
              $this->income_restday_ot[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->income_restday_ot[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->income_restday_ot[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->income_restday_ot[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->income_offday_ot[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->income_offday_ot[$this->nm_grid_colunas]));
          }
          else {
              $this->income_offday_ot[$this->nm_grid_colunas] = sc_strip_script($this->income_offday_ot[$this->nm_grid_colunas]);
          }
          if ($this->income_offday_ot[$this->nm_grid_colunas] === "") 
          { 
              $this->income_offday_ot[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->income_offday_ot[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->income_offday_ot[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->income_offday_ot[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->incentive[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->incentive[$this->nm_grid_colunas]));
          }
          else {
              $this->incentive[$this->nm_grid_colunas] = sc_strip_script($this->incentive[$this->nm_grid_colunas]);
          }
          if ($this->incentive[$this->nm_grid_colunas] === "") 
          { 
              $this->incentive[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->incentive[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->incentive[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->incentive[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->income_comm[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->income_comm[$this->nm_grid_colunas]));
          }
          else {
              $this->income_comm[$this->nm_grid_colunas] = sc_strip_script($this->income_comm[$this->nm_grid_colunas]);
          }
          if ($this->income_comm[$this->nm_grid_colunas] === "") 
          { 
              $this->income_comm[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->income_comm[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->income_comm[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->income_comm[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->rappel[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->rappel[$this->nm_grid_colunas]));
          }
          else {
              $this->rappel[$this->nm_grid_colunas] = sc_strip_script($this->rappel[$this->nm_grid_colunas]);
          }
          if ($this->rappel[$this->nm_grid_colunas] === "") 
          { 
              $this->rappel[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->rappel[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->rappel[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->rappel[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->tax_cass[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->tax_cass[$this->nm_grid_colunas]));
          }
          else {
              $this->tax_cass[$this->nm_grid_colunas] = sc_strip_script($this->tax_cass[$this->nm_grid_colunas]);
          }
          if ($this->tax_cass[$this->nm_grid_colunas] === "") 
          { 
              $this->tax_cass[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->tax_cass[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->tax_cass[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->tax_cass[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->tax_cfgdct[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->tax_cfgdct[$this->nm_grid_colunas]));
          }
          else {
              $this->tax_cfgdct[$this->nm_grid_colunas] = sc_strip_script($this->tax_cfgdct[$this->nm_grid_colunas]);
          }
          if ($this->tax_cfgdct[$this->nm_grid_colunas] === "") 
          { 
              $this->tax_cfgdct[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->tax_cfgdct[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->tax_cfgdct[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->tax_cfgdct[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->tax_fdu[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->tax_fdu[$this->nm_grid_colunas]));
          }
          else {
              $this->tax_fdu[$this->nm_grid_colunas] = sc_strip_script($this->tax_fdu[$this->nm_grid_colunas]);
          }
          if ($this->tax_fdu[$this->nm_grid_colunas] === "") 
          { 
              $this->tax_fdu[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->tax_fdu[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->tax_fdu[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->tax_fdu[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->tax_ona[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->tax_ona[$this->nm_grid_colunas]));
          }
          else {
              $this->tax_ona[$this->nm_grid_colunas] = sc_strip_script($this->tax_ona[$this->nm_grid_colunas]);
          }
          if ($this->tax_ona[$this->nm_grid_colunas] === "") 
          { 
              $this->tax_ona[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->tax_ona[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->tax_ona[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->tax_ona[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
              nmgp_Form_Num_Val($this->tax_iric[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->tax_iric[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->tax_iric[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->dedeuct_cons[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->dedeuct_cons[$this->nm_grid_colunas]));
          }
          else {
              $this->dedeuct_cons[$this->nm_grid_colunas] = sc_strip_script($this->dedeuct_cons[$this->nm_grid_colunas]);
          }
          if ($this->dedeuct_cons[$this->nm_grid_colunas] === "") 
          { 
              $this->dedeuct_cons[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->dedeuct_cons[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:12", "-") ; 
          } 
          $this->dedeuct_cons[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->dedeuct_cons[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->loan_deduction[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->loan_deduction[$this->nm_grid_colunas]));
          }
          else {
              $this->loan_deduction[$this->nm_grid_colunas] = sc_strip_script($this->loan_deduction[$this->nm_grid_colunas]);
          }
          if ($this->loan_deduction[$this->nm_grid_colunas] === "") 
          { 
              $this->loan_deduction[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->loan_deduction[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:12", "-") ; 
          } 
          $this->loan_deduction[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->loan_deduction[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->loan_deduction_bank[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->loan_deduction_bank[$this->nm_grid_colunas]));
          }
          else {
              $this->loan_deduction_bank[$this->nm_grid_colunas] = sc_strip_script($this->loan_deduction_bank[$this->nm_grid_colunas]);
          }
          if ($this->loan_deduction_bank[$this->nm_grid_colunas] === "") 
          { 
              $this->loan_deduction_bank[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->loan_deduction_bank[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:12", "-") ; 
          } 
          $this->loan_deduction_bank[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->loan_deduction_bank[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->other_deduct[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->other_deduct[$this->nm_grid_colunas]));
          }
          else {
              $this->other_deduct[$this->nm_grid_colunas] = sc_strip_script($this->other_deduct[$this->nm_grid_colunas]);
          }
          if ($this->other_deduct[$this->nm_grid_colunas] === "") 
          { 
              $this->other_deduct[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->other_deduct[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:12", "-") ; 
          } 
          $this->other_deduct[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->other_deduct[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->total_deduct[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->total_deduct[$this->nm_grid_colunas]));
          }
          else {
              $this->total_deduct[$this->nm_grid_colunas] = sc_strip_script($this->total_deduct[$this->nm_grid_colunas]);
          }
          if ($this->total_deduct[$this->nm_grid_colunas] === "") 
          { 
              $this->total_deduct[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->total_deduct[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:12", "-") ; 
          } 
          $this->total_deduct[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->total_deduct[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->sal_net[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->sal_net[$this->nm_grid_colunas]));
          }
          else {
              $this->sal_net[$this->nm_grid_colunas] = sc_strip_script($this->sal_net[$this->nm_grid_colunas]);
          }
          if ($this->sal_net[$this->nm_grid_colunas] === "") 
          { 
              $this->sal_net[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              $nm_cor_neg = ($this->sal_net[$this->nm_grid_colunas] < 0) ? "@SCNEG##FF0000" : "";
              nmgp_Form_Num_Val($this->sal_net[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
              $this->sal_net[$this->nm_grid_colunas] .= $nm_cor_neg;
          } 
          $this->sal_net[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sal_net[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
              nmgp_Form_Num_Val($this->work_hh_w[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->work_hh_w[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->work_hh_w[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->sal_hr_worked[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->sal_hr_worked[$this->nm_grid_colunas]));
          }
          else {
              $this->sal_hr_worked[$this->nm_grid_colunas] = sc_strip_script($this->sal_hr_worked[$this->nm_grid_colunas]);
          }
          if ($this->sal_hr_worked[$this->nm_grid_colunas] === "") 
          { 
              $this->sal_hr_worked[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sal_hr_worked[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->sal_hr_worked[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sal_hr_worked[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->sal_sunday_1[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->sal_sunday_1[$this->nm_grid_colunas]));
          }
          else {
              $this->sal_sunday_1[$this->nm_grid_colunas] = sc_strip_script($this->sal_sunday_1[$this->nm_grid_colunas]);
          }
          if ($this->sal_sunday_1[$this->nm_grid_colunas] === "") 
          { 
              $this->sal_sunday_1[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sal_sunday_1[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->sal_sunday_1[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sal_sunday_1[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->sal_holiday_1[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->sal_holiday_1[$this->nm_grid_colunas]));
          }
          else {
              $this->sal_holiday_1[$this->nm_grid_colunas] = sc_strip_script($this->sal_holiday_1[$this->nm_grid_colunas]);
          }
          if ($this->sal_holiday_1[$this->nm_grid_colunas] === "") 
          { 
              $this->sal_holiday_1[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sal_holiday_1[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->sal_holiday_1[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sal_holiday_1[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->sal_brut_reg_1[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->sal_brut_reg_1[$this->nm_grid_colunas]));
          }
          else {
              $this->sal_brut_reg_1[$this->nm_grid_colunas] = sc_strip_script($this->sal_brut_reg_1[$this->nm_grid_colunas]);
          }
          if ($this->sal_brut_reg_1[$this->nm_grid_colunas] === "") 
          { 
              $this->sal_brut_reg_1[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sal_brut_reg_1[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->sal_brut_reg_1[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sal_brut_reg_1[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->sal_suppl[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->sal_suppl[$this->nm_grid_colunas]));
          }
          else {
              $this->sal_suppl[$this->nm_grid_colunas] = sc_strip_script($this->sal_suppl[$this->nm_grid_colunas]);
          }
          if ($this->sal_suppl[$this->nm_grid_colunas] === "") 
          { 
              $this->sal_suppl[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sal_suppl[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->sal_suppl[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sal_suppl[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->sal_holiday_worked_suppl[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->sal_holiday_worked_suppl[$this->nm_grid_colunas]));
          }
          else {
              $this->sal_holiday_worked_suppl[$this->nm_grid_colunas] = sc_strip_script($this->sal_holiday_worked_suppl[$this->nm_grid_colunas]);
          }
          if ($this->sal_holiday_worked_suppl[$this->nm_grid_colunas] === "") 
          { 
              $this->sal_holiday_worked_suppl[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sal_holiday_worked_suppl[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->sal_holiday_worked_suppl[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sal_holiday_worked_suppl[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->sal_holiday_suppl[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->sal_holiday_suppl[$this->nm_grid_colunas]));
          }
          else {
              $this->sal_holiday_suppl[$this->nm_grid_colunas] = sc_strip_script($this->sal_holiday_suppl[$this->nm_grid_colunas]);
          }
          if ($this->sal_holiday_suppl[$this->nm_grid_colunas] === "") 
          { 
              $this->sal_holiday_suppl[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sal_holiday_suppl[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->sal_holiday_suppl[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sal_holiday_suppl[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->sal_restday_worked_suppl[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->sal_restday_worked_suppl[$this->nm_grid_colunas]));
          }
          else {
              $this->sal_restday_worked_suppl[$this->nm_grid_colunas] = sc_strip_script($this->sal_restday_worked_suppl[$this->nm_grid_colunas]);
          }
          if ($this->sal_restday_worked_suppl[$this->nm_grid_colunas] === "") 
          { 
              $this->sal_restday_worked_suppl[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sal_restday_worked_suppl[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->sal_restday_worked_suppl[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sal_restday_worked_suppl[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->sal_restday_suppl[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->sal_restday_suppl[$this->nm_grid_colunas]));
          }
          else {
              $this->sal_restday_suppl[$this->nm_grid_colunas] = sc_strip_script($this->sal_restday_suppl[$this->nm_grid_colunas]);
          }
          if ($this->sal_restday_suppl[$this->nm_grid_colunas] === "") 
          { 
              $this->sal_restday_suppl[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sal_restday_suppl[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->sal_restday_suppl[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sal_restday_suppl[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->tax_iris[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->tax_iris[$this->nm_grid_colunas]));
          }
          else {
              $this->tax_iris[$this->nm_grid_colunas] = sc_strip_script($this->tax_iris[$this->nm_grid_colunas]);
          }
          if ($this->tax_iris[$this->nm_grid_colunas] === "") 
          { 
              $this->tax_iris[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->tax_iris[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:12", "-") ; 
          } 
          $this->tax_iris[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->tax_iris[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->day_cons[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->day_cons[$this->nm_grid_colunas]));
          }
          else {
              $this->day_cons[$this->nm_grid_colunas] = sc_strip_script($this->day_cons[$this->nm_grid_colunas]);
          }
          if ($this->day_cons[$this->nm_grid_colunas] === "") 
          { 
              $this->day_cons[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->day_cons[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->day_cons[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->day_cons[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->rate_cons[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->rate_cons[$this->nm_grid_colunas]));
          }
          else {
              $this->rate_cons[$this->nm_grid_colunas] = sc_strip_script($this->rate_cons[$this->nm_grid_colunas]);
          }
          if ($this->rate_cons[$this->nm_grid_colunas] === "") 
          { 
              $this->rate_cons[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->rate_cons[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:1", "-") ; 
          } 
          $this->rate_cons[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->rate_cons[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->other_loan_deduction[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->other_loan_deduction[$this->nm_grid_colunas]));
          }
          else {
              $this->other_loan_deduction[$this->nm_grid_colunas] = sc_strip_script($this->other_loan_deduction[$this->nm_grid_colunas]);
          }
          if ($this->other_loan_deduction[$this->nm_grid_colunas] === "") 
          { 
              $this->other_loan_deduction[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->other_loan_deduction[$this->nm_grid_colunas], ",", ".", "2", "S", "2", "HTG", "V:3:12", "-") ; 
          } 
          $this->other_loan_deduction[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->other_loan_deduction[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->other_deduct_1[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->other_deduct_1[$this->nm_grid_colunas]));
          }
          else {
              $this->other_deduct_1[$this->nm_grid_colunas] = sc_strip_script($this->other_deduct_1[$this->nm_grid_colunas]);
          }
          if ($this->other_deduct_1[$this->nm_grid_colunas] === "") 
          { 
              $this->other_deduct_1[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->other_deduct_1[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->other_deduct_1[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->other_deduct_1[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->other_deduct_desc[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->other_deduct_desc[$this->nm_grid_colunas]));
          }
          else {
              $this->other_deduct_desc[$this->nm_grid_colunas] = sc_strip_script($this->other_deduct_desc[$this->nm_grid_colunas]);
          }
          if ($this->other_deduct_desc[$this->nm_grid_colunas] === "") 
          { 
              $this->other_deduct_desc[$this->nm_grid_colunas] = "" ;  
          } 
          $this->other_deduct_desc[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->other_deduct_desc[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
              nmgp_Form_Num_Val($this->work_hh_w_pm[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->work_hh_w_pm[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->work_hh_w_pm[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          if ($this->amount[$this->nm_grid_colunas] === "") 
          { 
              $this->amount[$this->nm_grid_colunas] = "" ;  
          } 
          if ($this->amount[$this->nm_grid_colunas] !== "") 
          { 
              $this->amount[$this->nm_grid_colunas] = sc_strtoupper($this->amount[$this->nm_grid_colunas]); 
          } 
          $this->nm_gera_mask($this->amount[$this->nm_grid_colunas], "AMOUNT"); 
          $this->amount[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->amount[$this->nm_grid_colunas]);
          if ($this->sc_field_0[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_0[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_0[$this->nm_grid_colunas], "AM"); 
          $this->sc_field_0[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_0[$this->nm_grid_colunas]);
          if ($this->sc_field_1[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_1[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_1[$this->nm_grid_colunas], "PM"); 
          $this->sc_field_1[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_1[$this->nm_grid_colunas]);
          if ($this->sc_field_2[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_2[$this->nm_grid_colunas], "Deduct. Loan ONA"); 
          $this->sc_field_2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_2[$this->nm_grid_colunas]);
          if ($this->sc_field_3[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_3[$this->nm_grid_colunas], "Deduct. Loan Ent"); 
          $this->sc_field_3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_3[$this->nm_grid_colunas]);
          if ($this->sc_field_4[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_4[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_4[$this->nm_grid_colunas], "Deduct. Meal"); 
          $this->sc_field_4[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_4[$this->nm_grid_colunas]);
          if ($this->sc_field_5[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_5[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_5[$this->nm_grid_colunas], "Deduct. Other"); 
          $this->sc_field_5[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_5[$this->nm_grid_colunas]);
          if ($this->deductions[$this->nm_grid_colunas] === "") 
          { 
              $this->deductions[$this->nm_grid_colunas] = "" ;  
          } 
          if ($this->deductions[$this->nm_grid_colunas] !== "") 
          { 
              $this->deductions[$this->nm_grid_colunas] = sc_strtoupper($this->deductions[$this->nm_grid_colunas]); 
          } 
          $this->nm_gera_mask($this->deductions[$this->nm_grid_colunas], "DEDUCTIONS"); 
          $this->deductions[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->deductions[$this->nm_grid_colunas]);
          if ($this->sc_field_6[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_6[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_6[$this->nm_grid_colunas], "EMPLOYEE NAME"); 
          $this->sc_field_6[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_6[$this->nm_grid_colunas]);
          if ($this->sc_field_7[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_7[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_7[$this->nm_grid_colunas], "ID"); 
          $this->sc_field_7[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_7[$this->nm_grid_colunas]);
          if ($this->irisal[$this->nm_grid_colunas] === "") 
          { 
              $this->irisal[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->irisal[$this->nm_grid_colunas], "IRI/Sal"); 
          $this->irisal[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->irisal[$this->nm_grid_colunas]);
          if ($this->incentive_lbl[$this->nm_grid_colunas] === "") 
          { 
              $this->incentive_lbl[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->incentive_lbl[$this->nm_grid_colunas], "Extra"); 
          $this->incentive_lbl[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->incentive_lbl[$this->nm_grid_colunas]);
          if ($this->sc_field_8[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_8[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_8[$this->nm_grid_colunas], "NET EARNINGS"); 
          $this->sc_field_8[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_8[$this->nm_grid_colunas]);
          if ($this->ona[$this->nm_grid_colunas] === "") 
          { 
              $this->ona[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->ona[$this->nm_grid_colunas], "ONA"); 
          $this->ona[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ona[$this->nm_grid_colunas]);
          if ($this->sc_field_9[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_9[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_9[$this->nm_grid_colunas], "OT AM"); 
          $this->sc_field_9[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_9[$this->nm_grid_colunas]);
          if ($this->sc_field_10[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_10[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_10[$this->nm_grid_colunas], "OT PM"); 
          $this->sc_field_10[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_10[$this->nm_grid_colunas]);
          if ($this->sc_field_11[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_11[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_11[$this->nm_grid_colunas], "Pay From"); 
          $this->sc_field_11[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_11[$this->nm_grid_colunas]);
          if ($this->sc_field_12[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_12[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_12[$this->nm_grid_colunas], "Pay To"); 
          $this->sc_field_12[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_12[$this->nm_grid_colunas]);
          if ($this->sc_field_13[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_13[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_13[$this->nm_grid_colunas], "Rappel / Extra"); 
          $this->sc_field_13[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_13[$this->nm_grid_colunas]);
          if ($this->sc_field_14[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_14[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_14[$this->nm_grid_colunas], "Sal. Holiday OT"); 
          $this->sc_field_14[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_14[$this->nm_grid_colunas]);
          if ($this->sc_field_15[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_15[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_15[$this->nm_grid_colunas], "Sal. Offday OT"); 
          $this->sc_field_15[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_15[$this->nm_grid_colunas]);
          if ($this->sc_field_16[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_16[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_16[$this->nm_grid_colunas], "Sal. Restday OT"); 
          $this->sc_field_16[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_16[$this->nm_grid_colunas]);
          if ($this->sc_field_17[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_17[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_17[$this->nm_grid_colunas], "Sal. Workday OT"); 
          $this->sc_field_17[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_17[$this->nm_grid_colunas]);
          if ($this->sc_field_18[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_18[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_18[$this->nm_grid_colunas], "TCA Add"); 
          $this->sc_field_18[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_18[$this->nm_grid_colunas]);
          if ($this->sc_field_19[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_19[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_19[$this->nm_grid_colunas], "Total Sal. Add"); 
          $this->sc_field_19[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_19[$this->nm_grid_colunas]);
          if ($this->sc_field_20[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_20[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_20[$this->nm_grid_colunas], "Total Deductions"); 
          $this->sc_field_20[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_20[$this->nm_grid_colunas]);
          if ($this->sc_field_21[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_21[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_21[$this->nm_grid_colunas], "Workday"); 
          $this->sc_field_21[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_21[$this->nm_grid_colunas]);
          if ($this->lbl_holiday[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_holiday[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_holiday[$this->nm_grid_colunas], "Holiday"); 
          $this->lbl_holiday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_holiday[$this->nm_grid_colunas]);
          if ($this->sc_field_22[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_22[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_22[$this->nm_grid_colunas], "Holiday Earned"); 
          $this->sc_field_22[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_22[$this->nm_grid_colunas]);
          if ($this->lbl_holidayhh[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_holidayhh[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_holidayhh[$this->nm_grid_colunas], "Holiday"); 
          $this->lbl_holidayhh[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_holidayhh[$this->nm_grid_colunas]);
          if ($this->lbl_hourearned[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_hourearned[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_hourearned[$this->nm_grid_colunas], "Hour Earned"); 
          $this->lbl_hourearned[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_hourearned[$this->nm_grid_colunas]);
          if ($this->lbl_leavetypebenefits[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_leavetypebenefits[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_leavetypebenefits[$this->nm_grid_colunas], "Leave Earned"); 
          $this->lbl_leavetypebenefits[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_leavetypebenefits[$this->nm_grid_colunas]);
          if ($this->lbl_mealrate[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_mealrate[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_mealrate[$this->nm_grid_colunas], "Meal Rate"); 
          $this->lbl_mealrate[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_mealrate[$this->nm_grid_colunas]);
          if ($this->lbl_mealday[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_mealday[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_mealday[$this->nm_grid_colunas], "Meal Day"); 
          $this->lbl_mealday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_mealday[$this->nm_grid_colunas]);
          if ($this->lbl_ratework[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_ratework[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_ratework[$this->nm_grid_colunas], "Rate Work"); 
          $this->lbl_ratework[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_ratework[$this->nm_grid_colunas]);
          if ($this->lbl_restday[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_restday[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_restday[$this->nm_grid_colunas], "Restday"); 
          $this->lbl_restday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_restday[$this->nm_grid_colunas]);
          if ($this->lbl_salholiday[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_salholiday[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_salholiday[$this->nm_grid_colunas], "Sal. Holiday"); 
          $this->lbl_salholiday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_salholiday[$this->nm_grid_colunas]);
          if ($this->lbl_saloffday[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_saloffday[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_saloffday[$this->nm_grid_colunas], "Sal. Offday"); 
          $this->lbl_saloffday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_saloffday[$this->nm_grid_colunas]);
          if ($this->lbl_salrestday[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_salrestday[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_salrestday[$this->nm_grid_colunas], "Sal. Restday"); 
          $this->lbl_salrestday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_salrestday[$this->nm_grid_colunas]);
          if ($this->lbl_salworkday[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_salworkday[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_salworkday[$this->nm_grid_colunas], "Sal. Workday"); 
          $this->lbl_salworkday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_salworkday[$this->nm_grid_colunas]);
          if ($this->lbl_sal_reg[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_sal_reg[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_sal_reg[$this->nm_grid_colunas], "Total Sal. Regular"); 
          $this->lbl_sal_reg[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_sal_reg[$this->nm_grid_colunas]);
          if ($this->lbl_sundaybenefits[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_sundaybenefits[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_sundaybenefits[$this->nm_grid_colunas], "Sunday Earned"); 
          $this->lbl_sundaybenefits[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_sundaybenefits[$this->nm_grid_colunas]);
          if ($this->lbl_sundayhh[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_sundayhh[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_sundayhh[$this->nm_grid_colunas], "Sunday"); 
          $this->lbl_sundayhh[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_sundayhh[$this->nm_grid_colunas]);
          if ($this->lbl_workay[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_workay[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_workay[$this->nm_grid_colunas], "Workday"); 
          $this->lbl_workay[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_workay[$this->nm_grid_colunas]);
          if ($this->lbl_amount01[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_amount01[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_amount01[$this->nm_grid_colunas], "AMOUNT"); 
          $this->lbl_amount01[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_amount01[$this->nm_grid_colunas]);
          $this->Lookup->lookup_lbl_companyname($this->lbl_companyname[$this->nm_grid_colunas], $this->array_lbl_companyname); 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_payslip_search_hist']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
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
          $this->nm_gera_mask($this->lbl_dept[$this->nm_grid_colunas], "DEPARTMENT"); 
          $this->lbl_dept[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_dept[$this->nm_grid_colunas]);
          if ($this->lbl_earning[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_earning[$this->nm_grid_colunas] = "" ;  
          } 
          if ($this->lbl_earning[$this->nm_grid_colunas] !== "") 
          { 
              $this->lbl_earning[$this->nm_grid_colunas] = sc_strtoupper($this->lbl_earning[$this->nm_grid_colunas]); 
          } 
          $this->nm_gera_mask($this->lbl_earning[$this->nm_grid_colunas], "EARNING"); 
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
          if ($this->lbl_leavehh[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_leavehh[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_leavehh[$this->nm_grid_colunas], "Leave"); 
          $this->lbl_leavehh[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_leavehh[$this->nm_grid_colunas]);
          if ($this->lbl_line01[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_line01[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_line01[$this->nm_grid_colunas], "________________________________________________________________"); 
          $this->lbl_line01[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_line01[$this->nm_grid_colunas]);
          if ($this->lbl_offday[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_offday[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_offday[$this->nm_grid_colunas], "Offday"); 
          $this->lbl_offday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_offday[$this->nm_grid_colunas]);
          if ($this->lbl_payslip[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_payslip[$this->nm_grid_colunas] = "" ;  
          } 
          if ($this->lbl_payslip[$this->nm_grid_colunas] !== "") 
          { 
              $this->lbl_payslip[$this->nm_grid_colunas] = sc_strtoupper($this->lbl_payslip[$this->nm_grid_colunas]); 
          } 
          $this->nm_gera_mask($this->lbl_payslip[$this->nm_grid_colunas], "PAYSLIP REPRINTED"); 
          $this->lbl_payslip[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_payslip[$this->nm_grid_colunas]);
          if ($this->lbl_rappel[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_rappel[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_rappel[$this->nm_grid_colunas], "Miscellaneous"); 
          $this->lbl_rappel[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_rappel[$this->nm_grid_colunas]);
          if ($this->lbl_salholidaydet[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_salholidaydet[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_salholidaydet[$this->nm_grid_colunas], "Sal Holiday"); 
          $this->lbl_salholidaydet[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_salholidaydet[$this->nm_grid_colunas]);
          if ($this->lbl_saloffdaydet[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_saloffdaydet[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_saloffdaydet[$this->nm_grid_colunas], "Sal Offday"); 
          $this->lbl_saloffdaydet[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_saloffdaydet[$this->nm_grid_colunas]);
          if ($this->lbl_salrestdaydet[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_salrestdaydet[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_salrestdaydet[$this->nm_grid_colunas], "Sal Restday"); 
          $this->lbl_salrestdaydet[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_salrestdaydet[$this->nm_grid_colunas]);
          if ($this->lbl_salworkdaydet[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_salworkdaydet[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_salworkdaydet[$this->nm_grid_colunas], "Sal Workday"); 
          $this->lbl_salworkdaydet[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_salworkdaydet[$this->nm_grid_colunas]);
          if ($this->lbl_taxcass[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_taxcass[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_taxcass[$this->nm_grid_colunas], "CASS"); 
          $this->lbl_taxcass[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_taxcass[$this->nm_grid_colunas]);
          if ($this->lbl_taxcfgdct[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_taxcfgdct[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_taxcfgdct[$this->nm_grid_colunas], "CFGDCT"); 
          $this->lbl_taxcfgdct[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_taxcfgdct[$this->nm_grid_colunas]);
          if ($this->lbl_taxfdu[$this->nm_grid_colunas] === "") 
          { 
              $this->lbl_taxfdu[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->lbl_taxfdu[$this->nm_grid_colunas], "FDU"); 
          $this->lbl_taxfdu[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->lbl_taxfdu[$this->nm_grid_colunas]);
            $cell_FingertecID = array('posx' => '30', 'posy' => '13', 'data' => $this->userid_int[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_username = array('posx' => '70', 'posy' => '13', 'data' => $this->username[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_companyname = array('posx' => '55', 'posy' => '6', 'data' => $this->lbl_companyname[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '15', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cellpaystartdate = array('posx' => '30', 'posy' => '21', 'data' => $this->pay_startdate[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_department = array('posx' => '35', 'posy' => '17', 'data' => $this->dept[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_earning = array('posx' => '9.5', 'posy' => '25', 'data' => $this->lbl_earning[$this->nm_grid_colunas], 'width'      => '50', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_income_workday = array('posx' => '35', 'posy' => '29', 'data' => $this->income_workday[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_income_holiday = array('posx' => '35', 'posy' => '33', 'data' => $this->income_holiday[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_income_offday = array('posx' => '35', 'posy' => '41', 'data' => $this->income_offday[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_iris = array('posx' => '95', 'posy' => '41', 'data' => $this->tax_iris[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_iric = array('posx' => '95', 'posy' => '49', 'data' => $this->tax_iric[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_ona = array('posx' => '95', 'posy' => '45', 'data' => $this->tax_ona[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_totaldeduct = array('posx' => '95', 'posy' => '69', 'data' => $this->total_deduct[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cellIncomeComm = array('posx' => '35', 'posy' => '81', 'data' => $this->income_comm[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_salnet = array('posx' => '170', 'posy' => '73', 'data' => $this->sal_net[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_89 = array('posx' => '9.23', 'posy' => '85', 'data' => $this->SC_conv_utf8('________________________________________________________________________________________'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $lbl_amount = array('posx' => '35', 'posy' => '25', 'data' => $this->amount[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_lbl_payslip = array('posx' => '76', 'posy' => '6', 'data' => $this->lbl_payslip[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '15', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_IncomeRestday = array('posx' => '35', 'posy' => '37', 'data' => $this->income_restday[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_BenefitsSunday = array('posx' => '35', 'posy' => '45', 'data' => $this->sal_sunday[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_BenefitsHoliday = array('posx' => '35', 'posy' => '49', 'data' => $this->sal_holiday[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_SalBrutReg = array('posx' => '35', 'posy' => '57', 'data' => $this->sal_brut_reg[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_IncomeWorkdayOT = array('posx' => '35', 'posy' => '61', 'data' => $this->income_workday_ot[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_IncomeHolidayOT = array('posx' => '35', 'posy' => '65', 'data' => $this->income_holiday_ot[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cellIncomeRestdayOT = array('posx' => '35', 'posy' => '69', 'data' => $this->income_restday_ot[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cellIncomeOffdayOT = array('posx' => '35', 'posy' => '73', 'data' => $this->income_offday_ot[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_DeductMeal = array('posx' => '95', 'posy' => '53', 'data' => $this->dedeuct_cons[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_DeductLoan = array('posx' => '95', 'posy' => '57', 'data' => $this->loan_deduction[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_DeductLoanBank = array('posx' => '95', 'posy' => '61', 'data' => $this->loan_deduction_bank[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_deductOther = array('posx' => '95', 'posy' => '65', 'data' => $this->other_deduct[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_PayEndDate = array('posx' => '80', 'posy' => '21', 'data' => $this->pay_enddate[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Rappel = array('posx' => '35', 'posy' => '85', 'data' => $this->rappel[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_incentive = array('posx' => '35', 'posy' => '77', 'data' => $this->incentive[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_Sal_Reg = array('posx' => '9.50', 'posy' => '57', 'data' => $this->lbl_sal_reg[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_salleavetype = array('posx' => '35', 'posy' => '53', 'data' => $this->sal_leavetype[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_SalWorkday = array('posx' => '9.76209312499877', 'posy' => '29', 'data' => $this->lbl_salworkday[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_SalHoliday = array('posx' => '9.5', 'posy' => '33', 'data' => $this->lbl_salholiday[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_SalRestday = array('posx' => '9.5', 'posy' => '37', 'data' => $this->lbl_salrestday[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_SalOffday = array('posx' => '9.5', 'posy' => '41', 'data' => $this->lbl_saloffday[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_SundayBenefits = array('posx' => '9.5', 'posy' => '45', 'data' => $this->lbl_sundaybenefits[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_LeavetypeBenefits = array('posx' => '9.5', 'posy' => '53', 'data' => $this->lbl_leavetypebenefits[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_HolidayBenefit = array('posx' => '9.5', 'posy' => '49', 'data' => $this->sc_field_22[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_SalWorkdayOT = array('posx' => '9.5', 'posy' => '61', 'data' => $this->sc_field_17[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_SalHolidayOT = array('posx' => '9.499017916665467', 'posy' => '65', 'data' => $this->sc_field_14[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_SalRestdayOT = array('posx' => '9.763601249998768', 'posy' => '69', 'data' => $this->sc_field_16[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_SalOffdayOT = array('posx' => '9.5', 'posy' => '73', 'data' => $this->sc_field_15[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Incentive_lbl = array('posx' => '9.5', 'posy' => '77', 'data' => $this->incentive_lbl[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_19 = array('posx' => '9.5', 'posy' => '81', 'data' => $this->sc_field_19[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_sc_field_13 = array('posx' => '9.5', 'posy' => '85', 'data' => $this->lbl_rappel[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Deductions = array('posx' => '69.5', 'posy' => '25', 'data' => $this->deductions[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_Amount = array('posx' => '95', 'posy' => '25', 'data' => $this->amount[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_sc_field_7 = array('posx' => '9.5', 'posy' => '13', 'data' => $this->sc_field_7[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_sc_field_6 = array('posx' => '40', 'posy' => '13', 'data' => $this->sc_field_6[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_sc_field_11 = array('posx' => '9.5', 'posy' => '21', 'data' => $this->sc_field_11[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_12 = array('posx' => '65', 'posy' => '21', 'data' => $this->sc_field_12[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_IRISal = array('posx' => '69.5', 'posy' => '41', 'data' => $this->irisal[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_18 = array('posx' => '69.5', 'posy' => '49', 'data' => $this->sc_field_18[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_ONA_1 = array('posx' => '69.5', 'posy' => '45', 'data' => $this->ona[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_4 = array('posx' => '69.5', 'posy' => '53', 'data' => $this->sc_field_4[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_3 = array('posx' => '69.5', 'posy' => '57', 'data' => $this->sc_field_3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_2 = array('posx' => '69.5', 'posy' => '61', 'data' => $this->sc_field_2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_5 = array('posx' => '69.5', 'posy' => '65', 'data' => $this->sc_field_5[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_20 = array('posx' => '69.5', 'posy' => '69', 'data' => $this->sc_field_20[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_lbl_Netearning = array('posx' => '135', 'posy' => '73', 'data' => $this->sc_field_8[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_sc_field_0 = array('posx' => '150', 'posy' => '25', 'data' => $this->sc_field_0[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_1 = array('posx' => '165', 'posy' => '25.262152083330147', 'data' => $this->sc_field_1[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_WorkdayAM = array('posx' => '150', 'posy' => '29', 'data' => $this->work_hh_w[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_WorkdayPM = array('posx' => '165', 'posy' => '29', 'data' => $this->work_hh_w_pm[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_OTAM = array('posx' => '180', 'posy' => '25', 'data' => $this->sc_field_9[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_OTPM = array('posx' => '200', 'posy' => '25', 'data' => $this->sc_field_10[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_OTAM = array('posx' => '180', 'posy' => '29', 'data' => $this->ot_hh_w[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_OTPM = array('posx' => '200', 'posy' => '29', 'data' => $this->ot_hh_w_pm[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_Workay = array('posx' => '130', 'posy' => '29', 'data' => $this->lbl_workay[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_Holiday = array('posx' => '130', 'posy' => '33', 'data' => $this->lbl_holiday[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_Restday = array('posx' => '130', 'posy' => '37', 'data' => $this->lbl_restday[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_offday = array('posx' => '130', 'posy' => '41', 'data' => $this->lbl_offday[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_HolidayAM = array('posx' => '150', 'posy' => '33', 'data' => $this->work_hh_h[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_HolidayPM = array('posx' => '165', 'posy' => '33', 'data' => $this->work_hh_h_pm[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_HolidayOTAM = array('posx' => '180', 'posy' => '33', 'data' => $this->ot_hh_h[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_HolidayOTPM = array('posx' => '200', 'posy' => '33', 'data' => $this->ot_hh_h_pm[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_RestdayAM = array('posx' => '150', 'posy' => '37', 'data' => $this->work_hh_r[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_RestdayPM = array('posx' => '165', 'posy' => '37', 'data' => $this->work_hh_r_pm[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_RestdayOTAM = array('posx' => '180', 'posy' => '37', 'data' => $this->ot_hh_r[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_RestdayOTPM = array('posx' => '200', 'posy' => '37', 'data' => $this->ot_hh_r_pm[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_OffdayAM = array('posx' => '150', 'posy' => '41', 'data' => $this->work_hh_o[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_OffdayPM = array('posx' => '165', 'posy' => '41', 'data' => $this->work_hh_o_pm[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Offday_OTAM = array('posx' => '180', 'posy' => '41', 'data' => $this->ot_hh_o[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Offday_OTPM = array('posx' => '200', 'posy' => '41', 'data' => $this->ot_hh_o_pm[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_Hourearned = array('posx' => '130', 'posy' => '50', 'data' => $this->lbl_hourearned[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_Mealday = array('posx' => '130', 'posy' => '55', 'data' => $this->lbl_mealday[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Line = array('posx' => '130', 'posy' => '41', 'data' => $this->SC_conv_utf8('_______________________________________'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_SundayHH = array('posx' => '150', 'posy' => '46', 'data' => $this->lbl_sundayhh[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_HolidayHH = array('posx' => '165', 'posy' => '46', 'data' => $this->lbl_holidayhh[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_leaveHH = array('posx' => '180', 'posy' => '46', 'data' => $this->lbl_leavehh[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_SundayHH = array('posx' => '150', 'posy' => '50', 'data' => $this->hh_sunday[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_HolidayHH = array('posx' => '165', 'posy' => '50', 'data' => $this->hh_offday[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_LeaveHH = array('posx' => '180', 'posy' => '50', 'data' => $this->hh_leavetype[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Linexx = array('posx' => '130', 'posy' => '50', 'data' => $this->SC_conv_utf8('_______________________________________'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_dept = array('posx' => '9.5', 'posy' => '17', 'data' => $this->lbl_dept[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_RateWork = array('posx' => '135', 'posy' => '21', 'data' => $this->rate_work[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_RateWork = array('posx' => '115', 'posy' => '21', 'data' => $this->lbl_ratework[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_MealRate = array('posx' => '130', 'posy' => '59', 'data' => $this->lbl_mealrate[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MealDay = array('posx' => '150', 'posy' => '54.7346187499931', 'data' => $this->day_cons[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MealRate = array('posx' => '150', 'posy' => '59', 'data' => $this->rate_cons[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Linexxx = array('posx' => '130', 'posy' => '60', 'data' => $this->SC_conv_utf8('_______________________________________'), 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_taxCASS = array('posx' => '69.5', 'posy' => '29', 'data' => $this->lbl_taxcass[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_taxCFGDCT = array('posx' => '69.5', 'posy' => '33', 'data' => $this->lbl_taxcfgdct[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_lbl_taxFDU = array('posx' => '69.49836874999123', 'posy' => '37', 'data' => $this->lbl_taxfdu[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_CASS = array('posx' => '95', 'posy' => '29', 'data' => $this->tax_cass[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_CFGDCT = array('posx' => '95', 'posy' => '33', 'data' => $this->tax_cfgdct[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_FDU = array('posx' => '95', 'posy' => '37', 'data' => $this->tax_fdu[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);


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

            $this->Pdf->SetFont($cell_income_workday['font_type'], $cell_income_workday['font_style'], $cell_income_workday['font_size']);
            $this->pdf_text_color($cell_income_workday['data'], $cell_income_workday['color_r'], $cell_income_workday['color_g'], $cell_income_workday['color_b']);
            if (!empty($cell_income_workday['posx']) && !empty($cell_income_workday['posy']))
            {
                $this->Pdf->SetXY($cell_income_workday['posx'] + $this->SC_incr_col,  $cell_income_workday['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_income_workday['posx']))
            {
                $this->Pdf->SetX($cell_income_workday['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_income_workday['posy']))
            {
                $this->Pdf->SetY($cell_income_workday['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_income_workday['width'], 0, $cell_income_workday['data'], 0, 0, $cell_income_workday['align']);

            $this->Pdf->SetFont($cell_income_holiday['font_type'], $cell_income_holiday['font_style'], $cell_income_holiday['font_size']);
            $this->pdf_text_color($cell_income_holiday['data'], $cell_income_holiday['color_r'], $cell_income_holiday['color_g'], $cell_income_holiday['color_b']);
            if (!empty($cell_income_holiday['posx']) && !empty($cell_income_holiday['posy']))
            {
                $this->Pdf->SetXY($cell_income_holiday['posx'] + $this->SC_incr_col,  $cell_income_holiday['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_income_holiday['posx']))
            {
                $this->Pdf->SetX($cell_income_holiday['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_income_holiday['posy']))
            {
                $this->Pdf->SetY($cell_income_holiday['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_income_holiday['width'], 0, $cell_income_holiday['data'], 0, 0, $cell_income_holiday['align']);

            $this->Pdf->SetFont($cell_income_offday['font_type'], $cell_income_offday['font_style'], $cell_income_offday['font_size']);
            $this->pdf_text_color($cell_income_offday['data'], $cell_income_offday['color_r'], $cell_income_offday['color_g'], $cell_income_offday['color_b']);
            if (!empty($cell_income_offday['posx']) && !empty($cell_income_offday['posy']))
            {
                $this->Pdf->SetXY($cell_income_offday['posx'] + $this->SC_incr_col,  $cell_income_offday['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_income_offday['posx']))
            {
                $this->Pdf->SetX($cell_income_offday['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_income_offday['posy']))
            {
                $this->Pdf->SetY($cell_income_offday['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_income_offday['width'], 0, $cell_income_offday['data'], 0, 0, $cell_income_offday['align']);

            $this->Pdf->SetFont($cell_iris['font_type'], $cell_iris['font_style'], $cell_iris['font_size']);
            $this->pdf_text_color($cell_iris['data'], $cell_iris['color_r'], $cell_iris['color_g'], $cell_iris['color_b']);
            if (!empty($cell_iris['posx']) && !empty($cell_iris['posy']))
            {
                $this->Pdf->SetXY($cell_iris['posx'] + $this->SC_incr_col,  $cell_iris['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_iris['posx']))
            {
                $this->Pdf->SetX($cell_iris['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_iris['posy']))
            {
                $this->Pdf->SetY($cell_iris['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_iris['width'], 0, $cell_iris['data'], 0, 0, $cell_iris['align']);

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

            $this->Pdf->SetFont($cell_ona['font_type'], $cell_ona['font_style'], $cell_ona['font_size']);
            $this->pdf_text_color($cell_ona['data'], $cell_ona['color_r'], $cell_ona['color_g'], $cell_ona['color_b']);
            if (!empty($cell_ona['posx']) && !empty($cell_ona['posy']))
            {
                $this->Pdf->SetXY($cell_ona['posx'] + $this->SC_incr_col,  $cell_ona['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_ona['posx']))
            {
                $this->Pdf->SetX($cell_ona['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_ona['posy']))
            {
                $this->Pdf->SetY($cell_ona['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_ona['width'], 0, $cell_ona['data'], 0, 0, $cell_ona['align']);

            $this->Pdf->SetFont($cell_totaldeduct['font_type'], $cell_totaldeduct['font_style'], $cell_totaldeduct['font_size']);
            $this->pdf_text_color($cell_totaldeduct['data'], $cell_totaldeduct['color_r'], $cell_totaldeduct['color_g'], $cell_totaldeduct['color_b']);
            if (!empty($cell_totaldeduct['posx']) && !empty($cell_totaldeduct['posy']))
            {
                $this->Pdf->SetXY($cell_totaldeduct['posx'] + $this->SC_incr_col,  $cell_totaldeduct['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_totaldeduct['posx']))
            {
                $this->Pdf->SetX($cell_totaldeduct['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_totaldeduct['posy']))
            {
                $this->Pdf->SetY($cell_totaldeduct['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_totaldeduct['width'], 0, $cell_totaldeduct['data'], 0, 0, $cell_totaldeduct['align']);

            $this->Pdf->SetFont($cellIncomeComm['font_type'], $cellIncomeComm['font_style'], $cellIncomeComm['font_size']);
            $this->pdf_text_color($cellIncomeComm['data'], $cellIncomeComm['color_r'], $cellIncomeComm['color_g'], $cellIncomeComm['color_b']);
            if (!empty($cellIncomeComm['posx']) && !empty($cellIncomeComm['posy']))
            {
                $this->Pdf->SetXY($cellIncomeComm['posx'] + $this->SC_incr_col,  $cellIncomeComm['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cellIncomeComm['posx']))
            {
                $this->Pdf->SetX($cellIncomeComm['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cellIncomeComm['posy']))
            {
                $this->Pdf->SetY($cellIncomeComm['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cellIncomeComm['width'], 0, $cellIncomeComm['data'], 0, 0, $cellIncomeComm['align']);

            $this->Pdf->SetFont($cell_salnet['font_type'], $cell_salnet['font_style'], $cell_salnet['font_size']);
            $this->pdf_text_color($cell_salnet['data'], $cell_salnet['color_r'], $cell_salnet['color_g'], $cell_salnet['color_b']);
            if (!empty($cell_salnet['posx']) && !empty($cell_salnet['posy']))
            {
                $this->Pdf->SetXY($cell_salnet['posx'] + $this->SC_incr_col,  $cell_salnet['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_salnet['posx']))
            {
                $this->Pdf->SetX($cell_salnet['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_salnet['posy']))
            {
                $this->Pdf->SetY($cell_salnet['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_salnet['width'], 0, $cell_salnet['data'], 0, 0, $cell_salnet['align']);

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

            $this->Pdf->SetFont($lbl_amount['font_type'], $lbl_amount['font_style'], $lbl_amount['font_size']);
            $this->pdf_text_color($lbl_amount['data'], $lbl_amount['color_r'], $lbl_amount['color_g'], $lbl_amount['color_b']);
            if (!empty($lbl_amount['posx']) && !empty($lbl_amount['posy']))
            {
                $this->Pdf->SetXY($lbl_amount['posx'] + $this->SC_incr_col,  $lbl_amount['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($lbl_amount['posx']))
            {
                $this->Pdf->SetX($lbl_amount['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($lbl_amount['posy']))
            {
                $this->Pdf->SetY($lbl_amount['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($lbl_amount['width'], 0, $lbl_amount['data'], 0, 0, $lbl_amount['align']);

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

            $this->Pdf->SetFont($cell_IncomeRestday['font_type'], $cell_IncomeRestday['font_style'], $cell_IncomeRestday['font_size']);
            $this->pdf_text_color($cell_IncomeRestday['data'], $cell_IncomeRestday['color_r'], $cell_IncomeRestday['color_g'], $cell_IncomeRestday['color_b']);
            if (!empty($cell_IncomeRestday['posx']) && !empty($cell_IncomeRestday['posy']))
            {
                $this->Pdf->SetXY($cell_IncomeRestday['posx'] + $this->SC_incr_col,  $cell_IncomeRestday['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_IncomeRestday['posx']))
            {
                $this->Pdf->SetX($cell_IncomeRestday['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_IncomeRestday['posy']))
            {
                $this->Pdf->SetY($cell_IncomeRestday['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_IncomeRestday['width'], 0, $cell_IncomeRestday['data'], 0, 0, $cell_IncomeRestday['align']);

            $this->Pdf->SetFont($cell_BenefitsSunday['font_type'], $cell_BenefitsSunday['font_style'], $cell_BenefitsSunday['font_size']);
            $this->pdf_text_color($cell_BenefitsSunday['data'], $cell_BenefitsSunday['color_r'], $cell_BenefitsSunday['color_g'], $cell_BenefitsSunday['color_b']);
            if (!empty($cell_BenefitsSunday['posx']) && !empty($cell_BenefitsSunday['posy']))
            {
                $this->Pdf->SetXY($cell_BenefitsSunday['posx'] + $this->SC_incr_col,  $cell_BenefitsSunday['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_BenefitsSunday['posx']))
            {
                $this->Pdf->SetX($cell_BenefitsSunday['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_BenefitsSunday['posy']))
            {
                $this->Pdf->SetY($cell_BenefitsSunday['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_BenefitsSunday['width'], 0, $cell_BenefitsSunday['data'], 0, 0, $cell_BenefitsSunday['align']);

            $this->Pdf->SetFont($cell_BenefitsHoliday['font_type'], $cell_BenefitsHoliday['font_style'], $cell_BenefitsHoliday['font_size']);
            $this->pdf_text_color($cell_BenefitsHoliday['data'], $cell_BenefitsHoliday['color_r'], $cell_BenefitsHoliday['color_g'], $cell_BenefitsHoliday['color_b']);
            if (!empty($cell_BenefitsHoliday['posx']) && !empty($cell_BenefitsHoliday['posy']))
            {
                $this->Pdf->SetXY($cell_BenefitsHoliday['posx'] + $this->SC_incr_col,  $cell_BenefitsHoliday['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_BenefitsHoliday['posx']))
            {
                $this->Pdf->SetX($cell_BenefitsHoliday['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_BenefitsHoliday['posy']))
            {
                $this->Pdf->SetY($cell_BenefitsHoliday['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_BenefitsHoliday['width'], 0, $cell_BenefitsHoliday['data'], 0, 0, $cell_BenefitsHoliday['align']);

            $this->Pdf->SetFont($cell_SalBrutReg['font_type'], $cell_SalBrutReg['font_style'], $cell_SalBrutReg['font_size']);
            $this->pdf_text_color($cell_SalBrutReg['data'], $cell_SalBrutReg['color_r'], $cell_SalBrutReg['color_g'], $cell_SalBrutReg['color_b']);
            if (!empty($cell_SalBrutReg['posx']) && !empty($cell_SalBrutReg['posy']))
            {
                $this->Pdf->SetXY($cell_SalBrutReg['posx'] + $this->SC_incr_col,  $cell_SalBrutReg['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_SalBrutReg['posx']))
            {
                $this->Pdf->SetX($cell_SalBrutReg['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_SalBrutReg['posy']))
            {
                $this->Pdf->SetY($cell_SalBrutReg['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_SalBrutReg['width'], 0, $cell_SalBrutReg['data'], 0, 0, $cell_SalBrutReg['align']);

            $this->Pdf->SetFont($cell_IncomeWorkdayOT['font_type'], $cell_IncomeWorkdayOT['font_style'], $cell_IncomeWorkdayOT['font_size']);
            $this->pdf_text_color($cell_IncomeWorkdayOT['data'], $cell_IncomeWorkdayOT['color_r'], $cell_IncomeWorkdayOT['color_g'], $cell_IncomeWorkdayOT['color_b']);
            if (!empty($cell_IncomeWorkdayOT['posx']) && !empty($cell_IncomeWorkdayOT['posy']))
            {
                $this->Pdf->SetXY($cell_IncomeWorkdayOT['posx'] + $this->SC_incr_col,  $cell_IncomeWorkdayOT['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_IncomeWorkdayOT['posx']))
            {
                $this->Pdf->SetX($cell_IncomeWorkdayOT['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_IncomeWorkdayOT['posy']))
            {
                $this->Pdf->SetY($cell_IncomeWorkdayOT['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_IncomeWorkdayOT['width'], 0, $cell_IncomeWorkdayOT['data'], 0, 0, $cell_IncomeWorkdayOT['align']);

            $this->Pdf->SetFont($cell_IncomeHolidayOT['font_type'], $cell_IncomeHolidayOT['font_style'], $cell_IncomeHolidayOT['font_size']);
            $this->pdf_text_color($cell_IncomeHolidayOT['data'], $cell_IncomeHolidayOT['color_r'], $cell_IncomeHolidayOT['color_g'], $cell_IncomeHolidayOT['color_b']);
            if (!empty($cell_IncomeHolidayOT['posx']) && !empty($cell_IncomeHolidayOT['posy']))
            {
                $this->Pdf->SetXY($cell_IncomeHolidayOT['posx'] + $this->SC_incr_col,  $cell_IncomeHolidayOT['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_IncomeHolidayOT['posx']))
            {
                $this->Pdf->SetX($cell_IncomeHolidayOT['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_IncomeHolidayOT['posy']))
            {
                $this->Pdf->SetY($cell_IncomeHolidayOT['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_IncomeHolidayOT['width'], 0, $cell_IncomeHolidayOT['data'], 0, 0, $cell_IncomeHolidayOT['align']);

            $this->Pdf->SetFont($cellIncomeRestdayOT['font_type'], $cellIncomeRestdayOT['font_style'], $cellIncomeRestdayOT['font_size']);
            $this->pdf_text_color($cellIncomeRestdayOT['data'], $cellIncomeRestdayOT['color_r'], $cellIncomeRestdayOT['color_g'], $cellIncomeRestdayOT['color_b']);
            if (!empty($cellIncomeRestdayOT['posx']) && !empty($cellIncomeRestdayOT['posy']))
            {
                $this->Pdf->SetXY($cellIncomeRestdayOT['posx'] + $this->SC_incr_col,  $cellIncomeRestdayOT['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cellIncomeRestdayOT['posx']))
            {
                $this->Pdf->SetX($cellIncomeRestdayOT['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cellIncomeRestdayOT['posy']))
            {
                $this->Pdf->SetY($cellIncomeRestdayOT['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cellIncomeRestdayOT['width'], 0, $cellIncomeRestdayOT['data'], 0, 0, $cellIncomeRestdayOT['align']);

            $this->Pdf->SetFont($cellIncomeOffdayOT['font_type'], $cellIncomeOffdayOT['font_style'], $cellIncomeOffdayOT['font_size']);
            $this->pdf_text_color($cellIncomeOffdayOT['data'], $cellIncomeOffdayOT['color_r'], $cellIncomeOffdayOT['color_g'], $cellIncomeOffdayOT['color_b']);
            if (!empty($cellIncomeOffdayOT['posx']) && !empty($cellIncomeOffdayOT['posy']))
            {
                $this->Pdf->SetXY($cellIncomeOffdayOT['posx'] + $this->SC_incr_col,  $cellIncomeOffdayOT['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cellIncomeOffdayOT['posx']))
            {
                $this->Pdf->SetX($cellIncomeOffdayOT['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cellIncomeOffdayOT['posy']))
            {
                $this->Pdf->SetY($cellIncomeOffdayOT['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cellIncomeOffdayOT['width'], 0, $cellIncomeOffdayOT['data'], 0, 0, $cellIncomeOffdayOT['align']);

            $this->Pdf->SetFont($cell_DeductMeal['font_type'], $cell_DeductMeal['font_style'], $cell_DeductMeal['font_size']);
            $this->pdf_text_color($cell_DeductMeal['data'], $cell_DeductMeal['color_r'], $cell_DeductMeal['color_g'], $cell_DeductMeal['color_b']);
            if (!empty($cell_DeductMeal['posx']) && !empty($cell_DeductMeal['posy']))
            {
                $this->Pdf->SetXY($cell_DeductMeal['posx'] + $this->SC_incr_col,  $cell_DeductMeal['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_DeductMeal['posx']))
            {
                $this->Pdf->SetX($cell_DeductMeal['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_DeductMeal['posy']))
            {
                $this->Pdf->SetY($cell_DeductMeal['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_DeductMeal['width'], 0, $cell_DeductMeal['data'], 0, 0, $cell_DeductMeal['align']);

            $this->Pdf->SetFont($cell_DeductLoan['font_type'], $cell_DeductLoan['font_style'], $cell_DeductLoan['font_size']);
            $this->pdf_text_color($cell_DeductLoan['data'], $cell_DeductLoan['color_r'], $cell_DeductLoan['color_g'], $cell_DeductLoan['color_b']);
            if (!empty($cell_DeductLoan['posx']) && !empty($cell_DeductLoan['posy']))
            {
                $this->Pdf->SetXY($cell_DeductLoan['posx'] + $this->SC_incr_col,  $cell_DeductLoan['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_DeductLoan['posx']))
            {
                $this->Pdf->SetX($cell_DeductLoan['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_DeductLoan['posy']))
            {
                $this->Pdf->SetY($cell_DeductLoan['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_DeductLoan['width'], 0, $cell_DeductLoan['data'], 0, 0, $cell_DeductLoan['align']);

            $this->Pdf->SetFont($cell_DeductLoanBank['font_type'], $cell_DeductLoanBank['font_style'], $cell_DeductLoanBank['font_size']);
            $this->pdf_text_color($cell_DeductLoanBank['data'], $cell_DeductLoanBank['color_r'], $cell_DeductLoanBank['color_g'], $cell_DeductLoanBank['color_b']);
            if (!empty($cell_DeductLoanBank['posx']) && !empty($cell_DeductLoanBank['posy']))
            {
                $this->Pdf->SetXY($cell_DeductLoanBank['posx'] + $this->SC_incr_col,  $cell_DeductLoanBank['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_DeductLoanBank['posx']))
            {
                $this->Pdf->SetX($cell_DeductLoanBank['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_DeductLoanBank['posy']))
            {
                $this->Pdf->SetY($cell_DeductLoanBank['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_DeductLoanBank['width'], 0, $cell_DeductLoanBank['data'], 0, 0, $cell_DeductLoanBank['align']);

            $this->Pdf->SetFont($cell_deductOther['font_type'], $cell_deductOther['font_style'], $cell_deductOther['font_size']);
            $this->pdf_text_color($cell_deductOther['data'], $cell_deductOther['color_r'], $cell_deductOther['color_g'], $cell_deductOther['color_b']);
            if (!empty($cell_deductOther['posx']) && !empty($cell_deductOther['posy']))
            {
                $this->Pdf->SetXY($cell_deductOther['posx'] + $this->SC_incr_col,  $cell_deductOther['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_deductOther['posx']))
            {
                $this->Pdf->SetX($cell_deductOther['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_deductOther['posy']))
            {
                $this->Pdf->SetY($cell_deductOther['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_deductOther['width'], 0, $cell_deductOther['data'], 0, 0, $cell_deductOther['align']);

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

            $this->Pdf->SetFont($cell_Rappel['font_type'], $cell_Rappel['font_style'], $cell_Rappel['font_size']);
            $this->pdf_text_color($cell_Rappel['data'], $cell_Rappel['color_r'], $cell_Rappel['color_g'], $cell_Rappel['color_b']);
            if (!empty($cell_Rappel['posx']) && !empty($cell_Rappel['posy']))
            {
                $this->Pdf->SetXY($cell_Rappel['posx'] + $this->SC_incr_col,  $cell_Rappel['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_Rappel['posx']))
            {
                $this->Pdf->SetX($cell_Rappel['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_Rappel['posy']))
            {
                $this->Pdf->SetY($cell_Rappel['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_Rappel['width'], 0, $cell_Rappel['data'], 0, 0, $cell_Rappel['align']);

            $this->Pdf->SetFont($cell_incentive['font_type'], $cell_incentive['font_style'], $cell_incentive['font_size']);
            $this->pdf_text_color($cell_incentive['data'], $cell_incentive['color_r'], $cell_incentive['color_g'], $cell_incentive['color_b']);
            if (!empty($cell_incentive['posx']) && !empty($cell_incentive['posy']))
            {
                $this->Pdf->SetXY($cell_incentive['posx'] + $this->SC_incr_col,  $cell_incentive['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_incentive['posx']))
            {
                $this->Pdf->SetX($cell_incentive['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_incentive['posy']))
            {
                $this->Pdf->SetY($cell_incentive['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_incentive['width'], 0, $cell_incentive['data'], 0, 0, $cell_incentive['align']);

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

            $this->Pdf->SetFont($cell_salleavetype['font_type'], $cell_salleavetype['font_style'], $cell_salleavetype['font_size']);
            $this->pdf_text_color($cell_salleavetype['data'], $cell_salleavetype['color_r'], $cell_salleavetype['color_g'], $cell_salleavetype['color_b']);
            if (!empty($cell_salleavetype['posx']) && !empty($cell_salleavetype['posy']))
            {
                $this->Pdf->SetXY($cell_salleavetype['posx'] + $this->SC_incr_col,  $cell_salleavetype['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_salleavetype['posx']))
            {
                $this->Pdf->SetX($cell_salleavetype['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_salleavetype['posy']))
            {
                $this->Pdf->SetY($cell_salleavetype['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_salleavetype['width'], 0, $cell_salleavetype['data'], 0, 0, $cell_salleavetype['align']);

            $this->Pdf->SetFont($cell_lbl_SalWorkday['font_type'], $cell_lbl_SalWorkday['font_style'], $cell_lbl_SalWorkday['font_size']);
            $this->pdf_text_color($cell_lbl_SalWorkday['data'], $cell_lbl_SalWorkday['color_r'], $cell_lbl_SalWorkday['color_g'], $cell_lbl_SalWorkday['color_b']);
            if (!empty($cell_lbl_SalWorkday['posx']) && !empty($cell_lbl_SalWorkday['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_SalWorkday['posx'] + $this->SC_incr_col,  $cell_lbl_SalWorkday['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_SalWorkday['posx']))
            {
                $this->Pdf->SetX($cell_lbl_SalWorkday['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_SalWorkday['posy']))
            {
                $this->Pdf->SetY($cell_lbl_SalWorkday['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_SalWorkday['width'], 0, $cell_lbl_SalWorkday['data'], 0, 0, $cell_lbl_SalWorkday['align']);

            $this->Pdf->SetFont($cell_lbl_SalHoliday['font_type'], $cell_lbl_SalHoliday['font_style'], $cell_lbl_SalHoliday['font_size']);
            $this->pdf_text_color($cell_lbl_SalHoliday['data'], $cell_lbl_SalHoliday['color_r'], $cell_lbl_SalHoliday['color_g'], $cell_lbl_SalHoliday['color_b']);
            if (!empty($cell_lbl_SalHoliday['posx']) && !empty($cell_lbl_SalHoliday['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_SalHoliday['posx'] + $this->SC_incr_col,  $cell_lbl_SalHoliday['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_SalHoliday['posx']))
            {
                $this->Pdf->SetX($cell_lbl_SalHoliday['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_SalHoliday['posy']))
            {
                $this->Pdf->SetY($cell_lbl_SalHoliday['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_SalHoliday['width'], 0, $cell_lbl_SalHoliday['data'], 0, 0, $cell_lbl_SalHoliday['align']);

            $this->Pdf->SetFont($cell_lbl_SalRestday['font_type'], $cell_lbl_SalRestday['font_style'], $cell_lbl_SalRestday['font_size']);
            $this->pdf_text_color($cell_lbl_SalRestday['data'], $cell_lbl_SalRestday['color_r'], $cell_lbl_SalRestday['color_g'], $cell_lbl_SalRestday['color_b']);
            if (!empty($cell_lbl_SalRestday['posx']) && !empty($cell_lbl_SalRestday['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_SalRestday['posx'] + $this->SC_incr_col,  $cell_lbl_SalRestday['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_SalRestday['posx']))
            {
                $this->Pdf->SetX($cell_lbl_SalRestday['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_SalRestday['posy']))
            {
                $this->Pdf->SetY($cell_lbl_SalRestday['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_SalRestday['width'], 0, $cell_lbl_SalRestday['data'], 0, 0, $cell_lbl_SalRestday['align']);

            $this->Pdf->SetFont($cell_lbl_SalOffday['font_type'], $cell_lbl_SalOffday['font_style'], $cell_lbl_SalOffday['font_size']);
            $this->pdf_text_color($cell_lbl_SalOffday['data'], $cell_lbl_SalOffday['color_r'], $cell_lbl_SalOffday['color_g'], $cell_lbl_SalOffday['color_b']);
            if (!empty($cell_lbl_SalOffday['posx']) && !empty($cell_lbl_SalOffday['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_SalOffday['posx'] + $this->SC_incr_col,  $cell_lbl_SalOffday['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_SalOffday['posx']))
            {
                $this->Pdf->SetX($cell_lbl_SalOffday['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_SalOffday['posy']))
            {
                $this->Pdf->SetY($cell_lbl_SalOffday['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_SalOffday['width'], 0, $cell_lbl_SalOffday['data'], 0, 0, $cell_lbl_SalOffday['align']);

            $this->Pdf->SetFont($cell_lbl_SundayBenefits['font_type'], $cell_lbl_SundayBenefits['font_style'], $cell_lbl_SundayBenefits['font_size']);
            $this->pdf_text_color($cell_lbl_SundayBenefits['data'], $cell_lbl_SundayBenefits['color_r'], $cell_lbl_SundayBenefits['color_g'], $cell_lbl_SundayBenefits['color_b']);
            if (!empty($cell_lbl_SundayBenefits['posx']) && !empty($cell_lbl_SundayBenefits['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_SundayBenefits['posx'] + $this->SC_incr_col,  $cell_lbl_SundayBenefits['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_SundayBenefits['posx']))
            {
                $this->Pdf->SetX($cell_lbl_SundayBenefits['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_SundayBenefits['posy']))
            {
                $this->Pdf->SetY($cell_lbl_SundayBenefits['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_SundayBenefits['width'], 0, $cell_lbl_SundayBenefits['data'], 0, 0, $cell_lbl_SundayBenefits['align']);

            $this->Pdf->SetFont($cell_lbl_LeavetypeBenefits['font_type'], $cell_lbl_LeavetypeBenefits['font_style'], $cell_lbl_LeavetypeBenefits['font_size']);
            $this->pdf_text_color($cell_lbl_LeavetypeBenefits['data'], $cell_lbl_LeavetypeBenefits['color_r'], $cell_lbl_LeavetypeBenefits['color_g'], $cell_lbl_LeavetypeBenefits['color_b']);
            if (!empty($cell_lbl_LeavetypeBenefits['posx']) && !empty($cell_lbl_LeavetypeBenefits['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_LeavetypeBenefits['posx'] + $this->SC_incr_col,  $cell_lbl_LeavetypeBenefits['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_LeavetypeBenefits['posx']))
            {
                $this->Pdf->SetX($cell_lbl_LeavetypeBenefits['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_LeavetypeBenefits['posy']))
            {
                $this->Pdf->SetY($cell_lbl_LeavetypeBenefits['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_LeavetypeBenefits['width'], 0, $cell_lbl_LeavetypeBenefits['data'], 0, 0, $cell_lbl_LeavetypeBenefits['align']);

            $this->Pdf->SetFont($cell_lbl_HolidayBenefit['font_type'], $cell_lbl_HolidayBenefit['font_style'], $cell_lbl_HolidayBenefit['font_size']);
            $this->pdf_text_color($cell_lbl_HolidayBenefit['data'], $cell_lbl_HolidayBenefit['color_r'], $cell_lbl_HolidayBenefit['color_g'], $cell_lbl_HolidayBenefit['color_b']);
            if (!empty($cell_lbl_HolidayBenefit['posx']) && !empty($cell_lbl_HolidayBenefit['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_HolidayBenefit['posx'] + $this->SC_incr_col,  $cell_lbl_HolidayBenefit['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_HolidayBenefit['posx']))
            {
                $this->Pdf->SetX($cell_lbl_HolidayBenefit['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_HolidayBenefit['posy']))
            {
                $this->Pdf->SetY($cell_lbl_HolidayBenefit['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_HolidayBenefit['width'], 0, $cell_lbl_HolidayBenefit['data'], 0, 0, $cell_lbl_HolidayBenefit['align']);

            $this->Pdf->SetFont($cell_lbl_SalWorkdayOT['font_type'], $cell_lbl_SalWorkdayOT['font_style'], $cell_lbl_SalWorkdayOT['font_size']);
            $this->pdf_text_color($cell_lbl_SalWorkdayOT['data'], $cell_lbl_SalWorkdayOT['color_r'], $cell_lbl_SalWorkdayOT['color_g'], $cell_lbl_SalWorkdayOT['color_b']);
            if (!empty($cell_lbl_SalWorkdayOT['posx']) && !empty($cell_lbl_SalWorkdayOT['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_SalWorkdayOT['posx'] + $this->SC_incr_col,  $cell_lbl_SalWorkdayOT['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_SalWorkdayOT['posx']))
            {
                $this->Pdf->SetX($cell_lbl_SalWorkdayOT['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_SalWorkdayOT['posy']))
            {
                $this->Pdf->SetY($cell_lbl_SalWorkdayOT['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_SalWorkdayOT['width'], 0, $cell_lbl_SalWorkdayOT['data'], 0, 0, $cell_lbl_SalWorkdayOT['align']);

            $this->Pdf->SetFont($cell_lbl_SalHolidayOT['font_type'], $cell_lbl_SalHolidayOT['font_style'], $cell_lbl_SalHolidayOT['font_size']);
            $this->pdf_text_color($cell_lbl_SalHolidayOT['data'], $cell_lbl_SalHolidayOT['color_r'], $cell_lbl_SalHolidayOT['color_g'], $cell_lbl_SalHolidayOT['color_b']);
            if (!empty($cell_lbl_SalHolidayOT['posx']) && !empty($cell_lbl_SalHolidayOT['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_SalHolidayOT['posx'] + $this->SC_incr_col,  $cell_lbl_SalHolidayOT['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_SalHolidayOT['posx']))
            {
                $this->Pdf->SetX($cell_lbl_SalHolidayOT['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_SalHolidayOT['posy']))
            {
                $this->Pdf->SetY($cell_lbl_SalHolidayOT['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_SalHolidayOT['width'], 0, $cell_lbl_SalHolidayOT['data'], 0, 0, $cell_lbl_SalHolidayOT['align']);

            $this->Pdf->SetFont($cell_lbl_SalRestdayOT['font_type'], $cell_lbl_SalRestdayOT['font_style'], $cell_lbl_SalRestdayOT['font_size']);
            $this->pdf_text_color($cell_lbl_SalRestdayOT['data'], $cell_lbl_SalRestdayOT['color_r'], $cell_lbl_SalRestdayOT['color_g'], $cell_lbl_SalRestdayOT['color_b']);
            if (!empty($cell_lbl_SalRestdayOT['posx']) && !empty($cell_lbl_SalRestdayOT['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_SalRestdayOT['posx'] + $this->SC_incr_col,  $cell_lbl_SalRestdayOT['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_SalRestdayOT['posx']))
            {
                $this->Pdf->SetX($cell_lbl_SalRestdayOT['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_SalRestdayOT['posy']))
            {
                $this->Pdf->SetY($cell_lbl_SalRestdayOT['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_SalRestdayOT['width'], 0, $cell_lbl_SalRestdayOT['data'], 0, 0, $cell_lbl_SalRestdayOT['align']);

            $this->Pdf->SetFont($cell_lbl_SalOffdayOT['font_type'], $cell_lbl_SalOffdayOT['font_style'], $cell_lbl_SalOffdayOT['font_size']);
            $this->pdf_text_color($cell_lbl_SalOffdayOT['data'], $cell_lbl_SalOffdayOT['color_r'], $cell_lbl_SalOffdayOT['color_g'], $cell_lbl_SalOffdayOT['color_b']);
            if (!empty($cell_lbl_SalOffdayOT['posx']) && !empty($cell_lbl_SalOffdayOT['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_SalOffdayOT['posx'] + $this->SC_incr_col,  $cell_lbl_SalOffdayOT['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_SalOffdayOT['posx']))
            {
                $this->Pdf->SetX($cell_lbl_SalOffdayOT['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_SalOffdayOT['posy']))
            {
                $this->Pdf->SetY($cell_lbl_SalOffdayOT['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_SalOffdayOT['width'], 0, $cell_lbl_SalOffdayOT['data'], 0, 0, $cell_lbl_SalOffdayOT['align']);

            $this->Pdf->SetFont($cell_Incentive_lbl['font_type'], $cell_Incentive_lbl['font_style'], $cell_Incentive_lbl['font_size']);
            $this->pdf_text_color($cell_Incentive_lbl['data'], $cell_Incentive_lbl['color_r'], $cell_Incentive_lbl['color_g'], $cell_Incentive_lbl['color_b']);
            if (!empty($cell_Incentive_lbl['posx']) && !empty($cell_Incentive_lbl['posy']))
            {
                $this->Pdf->SetXY($cell_Incentive_lbl['posx'] + $this->SC_incr_col,  $cell_Incentive_lbl['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_Incentive_lbl['posx']))
            {
                $this->Pdf->SetX($cell_Incentive_lbl['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_Incentive_lbl['posy']))
            {
                $this->Pdf->SetY($cell_Incentive_lbl['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_Incentive_lbl['width'], 0, $cell_Incentive_lbl['data'], 0, 0, $cell_Incentive_lbl['align']);

            $this->Pdf->SetFont($cell_sc_field_19['font_type'], $cell_sc_field_19['font_style'], $cell_sc_field_19['font_size']);
            $this->pdf_text_color($cell_sc_field_19['data'], $cell_sc_field_19['color_r'], $cell_sc_field_19['color_g'], $cell_sc_field_19['color_b']);
            if (!empty($cell_sc_field_19['posx']) && !empty($cell_sc_field_19['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_19['posx'] + $this->SC_incr_col,  $cell_sc_field_19['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_sc_field_19['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_19['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_sc_field_19['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_19['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_sc_field_19['width'], 0, $cell_sc_field_19['data'], 0, 0, $cell_sc_field_19['align']);

            $this->Pdf->SetFont($cell_sc_field_13['font_type'], $cell_sc_field_13['font_style'], $cell_sc_field_13['font_size']);
            $this->pdf_text_color($cell_sc_field_13['data'], $cell_sc_field_13['color_r'], $cell_sc_field_13['color_g'], $cell_sc_field_13['color_b']);
            if (!empty($cell_sc_field_13['posx']) && !empty($cell_sc_field_13['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_13['posx'] + $this->SC_incr_col,  $cell_sc_field_13['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_sc_field_13['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_13['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_sc_field_13['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_13['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_sc_field_13['width'], 0, $cell_sc_field_13['data'], 0, 0, $cell_sc_field_13['align']);

            $this->Pdf->SetFont($cell_Deductions['font_type'], $cell_Deductions['font_style'], $cell_Deductions['font_size']);
            $this->pdf_text_color($cell_Deductions['data'], $cell_Deductions['color_r'], $cell_Deductions['color_g'], $cell_Deductions['color_b']);
            if (!empty($cell_Deductions['posx']) && !empty($cell_Deductions['posy']))
            {
                $this->Pdf->SetXY($cell_Deductions['posx'] + $this->SC_incr_col,  $cell_Deductions['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_Deductions['posx']))
            {
                $this->Pdf->SetX($cell_Deductions['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_Deductions['posy']))
            {
                $this->Pdf->SetY($cell_Deductions['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_Deductions['width'], 0, $cell_Deductions['data'], 0, 0, $cell_Deductions['align']);

            $this->Pdf->SetFont($cell_Amount['font_type'], $cell_Amount['font_style'], $cell_Amount['font_size']);
            $this->pdf_text_color($cell_Amount['data'], $cell_Amount['color_r'], $cell_Amount['color_g'], $cell_Amount['color_b']);
            if (!empty($cell_Amount['posx']) && !empty($cell_Amount['posy']))
            {
                $this->Pdf->SetXY($cell_Amount['posx'] + $this->SC_incr_col,  $cell_Amount['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_Amount['posx']))
            {
                $this->Pdf->SetX($cell_Amount['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_Amount['posy']))
            {
                $this->Pdf->SetY($cell_Amount['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_Amount['width'], 0, $cell_Amount['data'], 0, 0, $cell_Amount['align']);

            $this->Pdf->SetFont($cell_sc_field_7['font_type'], $cell_sc_field_7['font_style'], $cell_sc_field_7['font_size']);
            $this->pdf_text_color($cell_sc_field_7['data'], $cell_sc_field_7['color_r'], $cell_sc_field_7['color_g'], $cell_sc_field_7['color_b']);
            if (!empty($cell_sc_field_7['posx']) && !empty($cell_sc_field_7['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_7['posx'] + $this->SC_incr_col,  $cell_sc_field_7['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_sc_field_7['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_7['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_sc_field_7['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_7['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_sc_field_7['width'], 0, $cell_sc_field_7['data'], 0, 0, $cell_sc_field_7['align']);

            $this->Pdf->SetFont($cell_sc_field_6['font_type'], $cell_sc_field_6['font_style'], $cell_sc_field_6['font_size']);
            $this->pdf_text_color($cell_sc_field_6['data'], $cell_sc_field_6['color_r'], $cell_sc_field_6['color_g'], $cell_sc_field_6['color_b']);
            if (!empty($cell_sc_field_6['posx']) && !empty($cell_sc_field_6['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_6['posx'] + $this->SC_incr_col,  $cell_sc_field_6['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_sc_field_6['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_6['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_sc_field_6['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_6['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_sc_field_6['width'], 0, $cell_sc_field_6['data'], 0, 0, $cell_sc_field_6['align']);

            $this->Pdf->SetFont($cell_sc_field_11['font_type'], $cell_sc_field_11['font_style'], $cell_sc_field_11['font_size']);
            $this->pdf_text_color($cell_sc_field_11['data'], $cell_sc_field_11['color_r'], $cell_sc_field_11['color_g'], $cell_sc_field_11['color_b']);
            if (!empty($cell_sc_field_11['posx']) && !empty($cell_sc_field_11['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_11['posx'] + $this->SC_incr_col,  $cell_sc_field_11['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_sc_field_11['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_11['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_sc_field_11['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_11['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_sc_field_11['width'], 0, $cell_sc_field_11['data'], 0, 0, $cell_sc_field_11['align']);

            $this->Pdf->SetFont($cell_sc_field_12['font_type'], $cell_sc_field_12['font_style'], $cell_sc_field_12['font_size']);
            $this->pdf_text_color($cell_sc_field_12['data'], $cell_sc_field_12['color_r'], $cell_sc_field_12['color_g'], $cell_sc_field_12['color_b']);
            if (!empty($cell_sc_field_12['posx']) && !empty($cell_sc_field_12['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_12['posx'] + $this->SC_incr_col,  $cell_sc_field_12['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_sc_field_12['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_12['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_sc_field_12['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_12['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_sc_field_12['width'], 0, $cell_sc_field_12['data'], 0, 0, $cell_sc_field_12['align']);

            $this->Pdf->SetFont($cell_IRISal['font_type'], $cell_IRISal['font_style'], $cell_IRISal['font_size']);
            $this->pdf_text_color($cell_IRISal['data'], $cell_IRISal['color_r'], $cell_IRISal['color_g'], $cell_IRISal['color_b']);
            if (!empty($cell_IRISal['posx']) && !empty($cell_IRISal['posy']))
            {
                $this->Pdf->SetXY($cell_IRISal['posx'] + $this->SC_incr_col,  $cell_IRISal['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_IRISal['posx']))
            {
                $this->Pdf->SetX($cell_IRISal['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_IRISal['posy']))
            {
                $this->Pdf->SetY($cell_IRISal['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_IRISal['width'], 0, $cell_IRISal['data'], 0, 0, $cell_IRISal['align']);

            $this->Pdf->SetFont($cell_sc_field_18['font_type'], $cell_sc_field_18['font_style'], $cell_sc_field_18['font_size']);
            $this->pdf_text_color($cell_sc_field_18['data'], $cell_sc_field_18['color_r'], $cell_sc_field_18['color_g'], $cell_sc_field_18['color_b']);
            if (!empty($cell_sc_field_18['posx']) && !empty($cell_sc_field_18['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_18['posx'] + $this->SC_incr_col,  $cell_sc_field_18['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_sc_field_18['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_18['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_sc_field_18['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_18['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_sc_field_18['width'], 0, $cell_sc_field_18['data'], 0, 0, $cell_sc_field_18['align']);

            $this->Pdf->SetFont($cell_ONA_1['font_type'], $cell_ONA_1['font_style'], $cell_ONA_1['font_size']);
            $this->pdf_text_color($cell_ONA_1['data'], $cell_ONA_1['color_r'], $cell_ONA_1['color_g'], $cell_ONA_1['color_b']);
            if (!empty($cell_ONA_1['posx']) && !empty($cell_ONA_1['posy']))
            {
                $this->Pdf->SetXY($cell_ONA_1['posx'] + $this->SC_incr_col,  $cell_ONA_1['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_ONA_1['posx']))
            {
                $this->Pdf->SetX($cell_ONA_1['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_ONA_1['posy']))
            {
                $this->Pdf->SetY($cell_ONA_1['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_ONA_1['width'], 0, $cell_ONA_1['data'], 0, 0, $cell_ONA_1['align']);

            $this->Pdf->SetFont($cell_sc_field_4['font_type'], $cell_sc_field_4['font_style'], $cell_sc_field_4['font_size']);
            $this->pdf_text_color($cell_sc_field_4['data'], $cell_sc_field_4['color_r'], $cell_sc_field_4['color_g'], $cell_sc_field_4['color_b']);
            if (!empty($cell_sc_field_4['posx']) && !empty($cell_sc_field_4['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_4['posx'] + $this->SC_incr_col,  $cell_sc_field_4['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_sc_field_4['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_4['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_sc_field_4['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_4['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_sc_field_4['width'], 0, $cell_sc_field_4['data'], 0, 0, $cell_sc_field_4['align']);

            $this->Pdf->SetFont($cell_sc_field_3['font_type'], $cell_sc_field_3['font_style'], $cell_sc_field_3['font_size']);
            $this->pdf_text_color($cell_sc_field_3['data'], $cell_sc_field_3['color_r'], $cell_sc_field_3['color_g'], $cell_sc_field_3['color_b']);
            if (!empty($cell_sc_field_3['posx']) && !empty($cell_sc_field_3['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_3['posx'] + $this->SC_incr_col,  $cell_sc_field_3['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_sc_field_3['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_3['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_sc_field_3['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_3['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_sc_field_3['width'], 0, $cell_sc_field_3['data'], 0, 0, $cell_sc_field_3['align']);

            $this->Pdf->SetFont($cell_sc_field_2['font_type'], $cell_sc_field_2['font_style'], $cell_sc_field_2['font_size']);
            $this->pdf_text_color($cell_sc_field_2['data'], $cell_sc_field_2['color_r'], $cell_sc_field_2['color_g'], $cell_sc_field_2['color_b']);
            if (!empty($cell_sc_field_2['posx']) && !empty($cell_sc_field_2['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_2['posx'] + $this->SC_incr_col,  $cell_sc_field_2['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_sc_field_2['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_2['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_sc_field_2['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_2['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_sc_field_2['width'], 0, $cell_sc_field_2['data'], 0, 0, $cell_sc_field_2['align']);

            $this->Pdf->SetFont($cell_sc_field_5['font_type'], $cell_sc_field_5['font_style'], $cell_sc_field_5['font_size']);
            $this->pdf_text_color($cell_sc_field_5['data'], $cell_sc_field_5['color_r'], $cell_sc_field_5['color_g'], $cell_sc_field_5['color_b']);
            if (!empty($cell_sc_field_5['posx']) && !empty($cell_sc_field_5['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_5['posx'] + $this->SC_incr_col,  $cell_sc_field_5['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_sc_field_5['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_5['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_sc_field_5['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_5['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_sc_field_5['width'], 0, $cell_sc_field_5['data'], 0, 0, $cell_sc_field_5['align']);

            $this->Pdf->SetFont($cell_sc_field_20['font_type'], $cell_sc_field_20['font_style'], $cell_sc_field_20['font_size']);
            $this->pdf_text_color($cell_sc_field_20['data'], $cell_sc_field_20['color_r'], $cell_sc_field_20['color_g'], $cell_sc_field_20['color_b']);
            if (!empty($cell_sc_field_20['posx']) && !empty($cell_sc_field_20['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_20['posx'] + $this->SC_incr_col,  $cell_sc_field_20['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_sc_field_20['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_20['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_sc_field_20['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_20['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_sc_field_20['width'], 0, $cell_sc_field_20['data'], 0, 0, $cell_sc_field_20['align']);

            $this->Pdf->SetFont($cell_lbl_Netearning['font_type'], $cell_lbl_Netearning['font_style'], $cell_lbl_Netearning['font_size']);
            $this->pdf_text_color($cell_lbl_Netearning['data'], $cell_lbl_Netearning['color_r'], $cell_lbl_Netearning['color_g'], $cell_lbl_Netearning['color_b']);
            if (!empty($cell_lbl_Netearning['posx']) && !empty($cell_lbl_Netearning['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_Netearning['posx'] + $this->SC_incr_col,  $cell_lbl_Netearning['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_Netearning['posx']))
            {
                $this->Pdf->SetX($cell_lbl_Netearning['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_Netearning['posy']))
            {
                $this->Pdf->SetY($cell_lbl_Netearning['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_Netearning['width'], 0, $cell_lbl_Netearning['data'], 0, 0, $cell_lbl_Netearning['align']);

            $this->Pdf->SetFont($cell_sc_field_0['font_type'], $cell_sc_field_0['font_style'], $cell_sc_field_0['font_size']);
            $this->pdf_text_color($cell_sc_field_0['data'], $cell_sc_field_0['color_r'], $cell_sc_field_0['color_g'], $cell_sc_field_0['color_b']);
            if (!empty($cell_sc_field_0['posx']) && !empty($cell_sc_field_0['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_0['posx'] + $this->SC_incr_col,  $cell_sc_field_0['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_sc_field_0['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_0['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_sc_field_0['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_0['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_sc_field_0['width'], 0, $cell_sc_field_0['data'], 0, 0, $cell_sc_field_0['align']);

            $this->Pdf->SetFont($cell_sc_field_1['font_type'], $cell_sc_field_1['font_style'], $cell_sc_field_1['font_size']);
            $this->pdf_text_color($cell_sc_field_1['data'], $cell_sc_field_1['color_r'], $cell_sc_field_1['color_g'], $cell_sc_field_1['color_b']);
            if (!empty($cell_sc_field_1['posx']) && !empty($cell_sc_field_1['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_1['posx'] + $this->SC_incr_col,  $cell_sc_field_1['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_sc_field_1['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_1['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_sc_field_1['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_1['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_sc_field_1['width'], 0, $cell_sc_field_1['data'], 0, 0, $cell_sc_field_1['align']);

            $this->Pdf->SetFont($cell_WorkdayAM['font_type'], $cell_WorkdayAM['font_style'], $cell_WorkdayAM['font_size']);
            $this->pdf_text_color($cell_WorkdayAM['data'], $cell_WorkdayAM['color_r'], $cell_WorkdayAM['color_g'], $cell_WorkdayAM['color_b']);
            if (!empty($cell_WorkdayAM['posx']) && !empty($cell_WorkdayAM['posy']))
            {
                $this->Pdf->SetXY($cell_WorkdayAM['posx'] + $this->SC_incr_col,  $cell_WorkdayAM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_WorkdayAM['posx']))
            {
                $this->Pdf->SetX($cell_WorkdayAM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_WorkdayAM['posy']))
            {
                $this->Pdf->SetY($cell_WorkdayAM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_WorkdayAM['width'], 0, $cell_WorkdayAM['data'], 0, 0, $cell_WorkdayAM['align']);

            $this->Pdf->SetFont($cell_WorkdayPM['font_type'], $cell_WorkdayPM['font_style'], $cell_WorkdayPM['font_size']);
            $this->pdf_text_color($cell_WorkdayPM['data'], $cell_WorkdayPM['color_r'], $cell_WorkdayPM['color_g'], $cell_WorkdayPM['color_b']);
            if (!empty($cell_WorkdayPM['posx']) && !empty($cell_WorkdayPM['posy']))
            {
                $this->Pdf->SetXY($cell_WorkdayPM['posx'] + $this->SC_incr_col,  $cell_WorkdayPM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_WorkdayPM['posx']))
            {
                $this->Pdf->SetX($cell_WorkdayPM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_WorkdayPM['posy']))
            {
                $this->Pdf->SetY($cell_WorkdayPM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_WorkdayPM['width'], 0, $cell_WorkdayPM['data'], 0, 0, $cell_WorkdayPM['align']);

            $this->Pdf->SetFont($cell_lbl_OTAM['font_type'], $cell_lbl_OTAM['font_style'], $cell_lbl_OTAM['font_size']);
            $this->pdf_text_color($cell_lbl_OTAM['data'], $cell_lbl_OTAM['color_r'], $cell_lbl_OTAM['color_g'], $cell_lbl_OTAM['color_b']);
            if (!empty($cell_lbl_OTAM['posx']) && !empty($cell_lbl_OTAM['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_OTAM['posx'] + $this->SC_incr_col,  $cell_lbl_OTAM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_OTAM['posx']))
            {
                $this->Pdf->SetX($cell_lbl_OTAM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_OTAM['posy']))
            {
                $this->Pdf->SetY($cell_lbl_OTAM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_OTAM['width'], 0, $cell_lbl_OTAM['data'], 0, 0, $cell_lbl_OTAM['align']);

            $this->Pdf->SetFont($cell_lbl_OTPM['font_type'], $cell_lbl_OTPM['font_style'], $cell_lbl_OTPM['font_size']);
            $this->pdf_text_color($cell_lbl_OTPM['data'], $cell_lbl_OTPM['color_r'], $cell_lbl_OTPM['color_g'], $cell_lbl_OTPM['color_b']);
            if (!empty($cell_lbl_OTPM['posx']) && !empty($cell_lbl_OTPM['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_OTPM['posx'] + $this->SC_incr_col,  $cell_lbl_OTPM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_OTPM['posx']))
            {
                $this->Pdf->SetX($cell_lbl_OTPM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_OTPM['posy']))
            {
                $this->Pdf->SetY($cell_lbl_OTPM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_OTPM['width'], 0, $cell_lbl_OTPM['data'], 0, 0, $cell_lbl_OTPM['align']);

            $this->Pdf->SetFont($cell_OTAM['font_type'], $cell_OTAM['font_style'], $cell_OTAM['font_size']);
            $this->pdf_text_color($cell_OTAM['data'], $cell_OTAM['color_r'], $cell_OTAM['color_g'], $cell_OTAM['color_b']);
            if (!empty($cell_OTAM['posx']) && !empty($cell_OTAM['posy']))
            {
                $this->Pdf->SetXY($cell_OTAM['posx'] + $this->SC_incr_col,  $cell_OTAM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_OTAM['posx']))
            {
                $this->Pdf->SetX($cell_OTAM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_OTAM['posy']))
            {
                $this->Pdf->SetY($cell_OTAM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_OTAM['width'], 0, $cell_OTAM['data'], 0, 0, $cell_OTAM['align']);

            $this->Pdf->SetFont($cell_OTPM['font_type'], $cell_OTPM['font_style'], $cell_OTPM['font_size']);
            $this->pdf_text_color($cell_OTPM['data'], $cell_OTPM['color_r'], $cell_OTPM['color_g'], $cell_OTPM['color_b']);
            if (!empty($cell_OTPM['posx']) && !empty($cell_OTPM['posy']))
            {
                $this->Pdf->SetXY($cell_OTPM['posx'] + $this->SC_incr_col,  $cell_OTPM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_OTPM['posx']))
            {
                $this->Pdf->SetX($cell_OTPM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_OTPM['posy']))
            {
                $this->Pdf->SetY($cell_OTPM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_OTPM['width'], 0, $cell_OTPM['data'], 0, 0, $cell_OTPM['align']);

            $this->Pdf->SetFont($cell_lbl_Workay['font_type'], $cell_lbl_Workay['font_style'], $cell_lbl_Workay['font_size']);
            $this->pdf_text_color($cell_lbl_Workay['data'], $cell_lbl_Workay['color_r'], $cell_lbl_Workay['color_g'], $cell_lbl_Workay['color_b']);
            if (!empty($cell_lbl_Workay['posx']) && !empty($cell_lbl_Workay['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_Workay['posx'] + $this->SC_incr_col,  $cell_lbl_Workay['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_Workay['posx']))
            {
                $this->Pdf->SetX($cell_lbl_Workay['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_Workay['posy']))
            {
                $this->Pdf->SetY($cell_lbl_Workay['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_Workay['width'], 0, $cell_lbl_Workay['data'], 0, 0, $cell_lbl_Workay['align']);

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

            $this->Pdf->SetFont($cell_lbl_Restday['font_type'], $cell_lbl_Restday['font_style'], $cell_lbl_Restday['font_size']);
            $this->pdf_text_color($cell_lbl_Restday['data'], $cell_lbl_Restday['color_r'], $cell_lbl_Restday['color_g'], $cell_lbl_Restday['color_b']);
            if (!empty($cell_lbl_Restday['posx']) && !empty($cell_lbl_Restday['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_Restday['posx'] + $this->SC_incr_col,  $cell_lbl_Restday['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_Restday['posx']))
            {
                $this->Pdf->SetX($cell_lbl_Restday['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_Restday['posy']))
            {
                $this->Pdf->SetY($cell_lbl_Restday['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_Restday['width'], 0, $cell_lbl_Restday['data'], 0, 0, $cell_lbl_Restday['align']);

            $this->Pdf->SetFont($cell_lbl_offday['font_type'], $cell_lbl_offday['font_style'], $cell_lbl_offday['font_size']);
            $this->pdf_text_color($cell_lbl_offday['data'], $cell_lbl_offday['color_r'], $cell_lbl_offday['color_g'], $cell_lbl_offday['color_b']);
            if (!empty($cell_lbl_offday['posx']) && !empty($cell_lbl_offday['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_offday['posx'] + $this->SC_incr_col,  $cell_lbl_offday['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_offday['posx']))
            {
                $this->Pdf->SetX($cell_lbl_offday['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_offday['posy']))
            {
                $this->Pdf->SetY($cell_lbl_offday['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_offday['width'], 0, $cell_lbl_offday['data'], 0, 0, $cell_lbl_offday['align']);

            $this->Pdf->SetFont($cell_HolidayAM['font_type'], $cell_HolidayAM['font_style'], $cell_HolidayAM['font_size']);
            $this->pdf_text_color($cell_HolidayAM['data'], $cell_HolidayAM['color_r'], $cell_HolidayAM['color_g'], $cell_HolidayAM['color_b']);
            if (!empty($cell_HolidayAM['posx']) && !empty($cell_HolidayAM['posy']))
            {
                $this->Pdf->SetXY($cell_HolidayAM['posx'] + $this->SC_incr_col,  $cell_HolidayAM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_HolidayAM['posx']))
            {
                $this->Pdf->SetX($cell_HolidayAM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_HolidayAM['posy']))
            {
                $this->Pdf->SetY($cell_HolidayAM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_HolidayAM['width'], 0, $cell_HolidayAM['data'], 0, 0, $cell_HolidayAM['align']);

            $this->Pdf->SetFont($cell_HolidayPM['font_type'], $cell_HolidayPM['font_style'], $cell_HolidayPM['font_size']);
            $this->pdf_text_color($cell_HolidayPM['data'], $cell_HolidayPM['color_r'], $cell_HolidayPM['color_g'], $cell_HolidayPM['color_b']);
            if (!empty($cell_HolidayPM['posx']) && !empty($cell_HolidayPM['posy']))
            {
                $this->Pdf->SetXY($cell_HolidayPM['posx'] + $this->SC_incr_col,  $cell_HolidayPM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_HolidayPM['posx']))
            {
                $this->Pdf->SetX($cell_HolidayPM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_HolidayPM['posy']))
            {
                $this->Pdf->SetY($cell_HolidayPM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_HolidayPM['width'], 0, $cell_HolidayPM['data'], 0, 0, $cell_HolidayPM['align']);

            $this->Pdf->SetFont($cell_HolidayOTAM['font_type'], $cell_HolidayOTAM['font_style'], $cell_HolidayOTAM['font_size']);
            $this->pdf_text_color($cell_HolidayOTAM['data'], $cell_HolidayOTAM['color_r'], $cell_HolidayOTAM['color_g'], $cell_HolidayOTAM['color_b']);
            if (!empty($cell_HolidayOTAM['posx']) && !empty($cell_HolidayOTAM['posy']))
            {
                $this->Pdf->SetXY($cell_HolidayOTAM['posx'] + $this->SC_incr_col,  $cell_HolidayOTAM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_HolidayOTAM['posx']))
            {
                $this->Pdf->SetX($cell_HolidayOTAM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_HolidayOTAM['posy']))
            {
                $this->Pdf->SetY($cell_HolidayOTAM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_HolidayOTAM['width'], 0, $cell_HolidayOTAM['data'], 0, 0, $cell_HolidayOTAM['align']);

            $this->Pdf->SetFont($cell_HolidayOTPM['font_type'], $cell_HolidayOTPM['font_style'], $cell_HolidayOTPM['font_size']);
            $this->pdf_text_color($cell_HolidayOTPM['data'], $cell_HolidayOTPM['color_r'], $cell_HolidayOTPM['color_g'], $cell_HolidayOTPM['color_b']);
            if (!empty($cell_HolidayOTPM['posx']) && !empty($cell_HolidayOTPM['posy']))
            {
                $this->Pdf->SetXY($cell_HolidayOTPM['posx'] + $this->SC_incr_col,  $cell_HolidayOTPM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_HolidayOTPM['posx']))
            {
                $this->Pdf->SetX($cell_HolidayOTPM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_HolidayOTPM['posy']))
            {
                $this->Pdf->SetY($cell_HolidayOTPM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_HolidayOTPM['width'], 0, $cell_HolidayOTPM['data'], 0, 0, $cell_HolidayOTPM['align']);

            $this->Pdf->SetFont($cell_RestdayAM['font_type'], $cell_RestdayAM['font_style'], $cell_RestdayAM['font_size']);
            $this->pdf_text_color($cell_RestdayAM['data'], $cell_RestdayAM['color_r'], $cell_RestdayAM['color_g'], $cell_RestdayAM['color_b']);
            if (!empty($cell_RestdayAM['posx']) && !empty($cell_RestdayAM['posy']))
            {
                $this->Pdf->SetXY($cell_RestdayAM['posx'] + $this->SC_incr_col,  $cell_RestdayAM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_RestdayAM['posx']))
            {
                $this->Pdf->SetX($cell_RestdayAM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_RestdayAM['posy']))
            {
                $this->Pdf->SetY($cell_RestdayAM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_RestdayAM['width'], 0, $cell_RestdayAM['data'], 0, 0, $cell_RestdayAM['align']);

            $this->Pdf->SetFont($cell_RestdayPM['font_type'], $cell_RestdayPM['font_style'], $cell_RestdayPM['font_size']);
            $this->pdf_text_color($cell_RestdayPM['data'], $cell_RestdayPM['color_r'], $cell_RestdayPM['color_g'], $cell_RestdayPM['color_b']);
            if (!empty($cell_RestdayPM['posx']) && !empty($cell_RestdayPM['posy']))
            {
                $this->Pdf->SetXY($cell_RestdayPM['posx'] + $this->SC_incr_col,  $cell_RestdayPM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_RestdayPM['posx']))
            {
                $this->Pdf->SetX($cell_RestdayPM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_RestdayPM['posy']))
            {
                $this->Pdf->SetY($cell_RestdayPM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_RestdayPM['width'], 0, $cell_RestdayPM['data'], 0, 0, $cell_RestdayPM['align']);

            $this->Pdf->SetFont($cell_RestdayOTAM['font_type'], $cell_RestdayOTAM['font_style'], $cell_RestdayOTAM['font_size']);
            $this->pdf_text_color($cell_RestdayOTAM['data'], $cell_RestdayOTAM['color_r'], $cell_RestdayOTAM['color_g'], $cell_RestdayOTAM['color_b']);
            if (!empty($cell_RestdayOTAM['posx']) && !empty($cell_RestdayOTAM['posy']))
            {
                $this->Pdf->SetXY($cell_RestdayOTAM['posx'] + $this->SC_incr_col,  $cell_RestdayOTAM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_RestdayOTAM['posx']))
            {
                $this->Pdf->SetX($cell_RestdayOTAM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_RestdayOTAM['posy']))
            {
                $this->Pdf->SetY($cell_RestdayOTAM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_RestdayOTAM['width'], 0, $cell_RestdayOTAM['data'], 0, 0, $cell_RestdayOTAM['align']);

            $this->Pdf->SetFont($cell_RestdayOTPM['font_type'], $cell_RestdayOTPM['font_style'], $cell_RestdayOTPM['font_size']);
            $this->pdf_text_color($cell_RestdayOTPM['data'], $cell_RestdayOTPM['color_r'], $cell_RestdayOTPM['color_g'], $cell_RestdayOTPM['color_b']);
            if (!empty($cell_RestdayOTPM['posx']) && !empty($cell_RestdayOTPM['posy']))
            {
                $this->Pdf->SetXY($cell_RestdayOTPM['posx'] + $this->SC_incr_col,  $cell_RestdayOTPM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_RestdayOTPM['posx']))
            {
                $this->Pdf->SetX($cell_RestdayOTPM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_RestdayOTPM['posy']))
            {
                $this->Pdf->SetY($cell_RestdayOTPM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_RestdayOTPM['width'], 0, $cell_RestdayOTPM['data'], 0, 0, $cell_RestdayOTPM['align']);

            $this->Pdf->SetFont($cell_OffdayAM['font_type'], $cell_OffdayAM['font_style'], $cell_OffdayAM['font_size']);
            $this->pdf_text_color($cell_OffdayAM['data'], $cell_OffdayAM['color_r'], $cell_OffdayAM['color_g'], $cell_OffdayAM['color_b']);
            if (!empty($cell_OffdayAM['posx']) && !empty($cell_OffdayAM['posy']))
            {
                $this->Pdf->SetXY($cell_OffdayAM['posx'] + $this->SC_incr_col,  $cell_OffdayAM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_OffdayAM['posx']))
            {
                $this->Pdf->SetX($cell_OffdayAM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_OffdayAM['posy']))
            {
                $this->Pdf->SetY($cell_OffdayAM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_OffdayAM['width'], 0, $cell_OffdayAM['data'], 0, 0, $cell_OffdayAM['align']);

            $this->Pdf->SetFont($cell_OffdayPM['font_type'], $cell_OffdayPM['font_style'], $cell_OffdayPM['font_size']);
            $this->pdf_text_color($cell_OffdayPM['data'], $cell_OffdayPM['color_r'], $cell_OffdayPM['color_g'], $cell_OffdayPM['color_b']);
            if (!empty($cell_OffdayPM['posx']) && !empty($cell_OffdayPM['posy']))
            {
                $this->Pdf->SetXY($cell_OffdayPM['posx'] + $this->SC_incr_col,  $cell_OffdayPM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_OffdayPM['posx']))
            {
                $this->Pdf->SetX($cell_OffdayPM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_OffdayPM['posy']))
            {
                $this->Pdf->SetY($cell_OffdayPM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_OffdayPM['width'], 0, $cell_OffdayPM['data'], 0, 0, $cell_OffdayPM['align']);

            $this->Pdf->SetFont($cell_Offday_OTAM['font_type'], $cell_Offday_OTAM['font_style'], $cell_Offday_OTAM['font_size']);
            $this->pdf_text_color($cell_Offday_OTAM['data'], $cell_Offday_OTAM['color_r'], $cell_Offday_OTAM['color_g'], $cell_Offday_OTAM['color_b']);
            if (!empty($cell_Offday_OTAM['posx']) && !empty($cell_Offday_OTAM['posy']))
            {
                $this->Pdf->SetXY($cell_Offday_OTAM['posx'] + $this->SC_incr_col,  $cell_Offday_OTAM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_Offday_OTAM['posx']))
            {
                $this->Pdf->SetX($cell_Offday_OTAM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_Offday_OTAM['posy']))
            {
                $this->Pdf->SetY($cell_Offday_OTAM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_Offday_OTAM['width'], 0, $cell_Offday_OTAM['data'], 0, 0, $cell_Offday_OTAM['align']);

            $this->Pdf->SetFont($cell_Offday_OTPM['font_type'], $cell_Offday_OTPM['font_style'], $cell_Offday_OTPM['font_size']);
            $this->pdf_text_color($cell_Offday_OTPM['data'], $cell_Offday_OTPM['color_r'], $cell_Offday_OTPM['color_g'], $cell_Offday_OTPM['color_b']);
            if (!empty($cell_Offday_OTPM['posx']) && !empty($cell_Offday_OTPM['posy']))
            {
                $this->Pdf->SetXY($cell_Offday_OTPM['posx'] + $this->SC_incr_col,  $cell_Offday_OTPM['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_Offday_OTPM['posx']))
            {
                $this->Pdf->SetX($cell_Offday_OTPM['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_Offday_OTPM['posy']))
            {
                $this->Pdf->SetY($cell_Offday_OTPM['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_Offday_OTPM['width'], 0, $cell_Offday_OTPM['data'], 0, 0, $cell_Offday_OTPM['align']);

            $this->Pdf->SetFont($cell_lbl_Hourearned['font_type'], $cell_lbl_Hourearned['font_style'], $cell_lbl_Hourearned['font_size']);
            $this->pdf_text_color($cell_lbl_Hourearned['data'], $cell_lbl_Hourearned['color_r'], $cell_lbl_Hourearned['color_g'], $cell_lbl_Hourearned['color_b']);
            if (!empty($cell_lbl_Hourearned['posx']) && !empty($cell_lbl_Hourearned['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_Hourearned['posx'] + $this->SC_incr_col,  $cell_lbl_Hourearned['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_Hourearned['posx']))
            {
                $this->Pdf->SetX($cell_lbl_Hourearned['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_Hourearned['posy']))
            {
                $this->Pdf->SetY($cell_lbl_Hourearned['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_Hourearned['width'], 0, $cell_lbl_Hourearned['data'], 0, 0, $cell_lbl_Hourearned['align']);

            $this->Pdf->SetFont($cell_lbl_Mealday['font_type'], $cell_lbl_Mealday['font_style'], $cell_lbl_Mealday['font_size']);
            $this->pdf_text_color($cell_lbl_Mealday['data'], $cell_lbl_Mealday['color_r'], $cell_lbl_Mealday['color_g'], $cell_lbl_Mealday['color_b']);
            if (!empty($cell_lbl_Mealday['posx']) && !empty($cell_lbl_Mealday['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_Mealday['posx'] + $this->SC_incr_col,  $cell_lbl_Mealday['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_Mealday['posx']))
            {
                $this->Pdf->SetX($cell_lbl_Mealday['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_Mealday['posy']))
            {
                $this->Pdf->SetY($cell_lbl_Mealday['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_Mealday['width'], 0, $cell_lbl_Mealday['data'], 0, 0, $cell_lbl_Mealday['align']);

            $this->Pdf->SetFont($cell_Line['font_type'], $cell_Line['font_style'], $cell_Line['font_size']);
            $this->pdf_text_color($cell_Line['data'], $cell_Line['color_r'], $cell_Line['color_g'], $cell_Line['color_b']);
            if (!empty($cell_Line['posx']) && !empty($cell_Line['posy']))
            {
                $this->Pdf->SetXY($cell_Line['posx'] + $this->SC_incr_col,  $cell_Line['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_Line['posx']))
            {
                $this->Pdf->SetX($cell_Line['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_Line['posy']))
            {
                $this->Pdf->SetY($cell_Line['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_Line['width'], 0, $cell_Line['data'], 0, 0, $cell_Line['align']);

            $this->Pdf->SetFont($cell_lbl_SundayHH['font_type'], $cell_lbl_SundayHH['font_style'], $cell_lbl_SundayHH['font_size']);
            $this->pdf_text_color($cell_lbl_SundayHH['data'], $cell_lbl_SundayHH['color_r'], $cell_lbl_SundayHH['color_g'], $cell_lbl_SundayHH['color_b']);
            if (!empty($cell_lbl_SundayHH['posx']) && !empty($cell_lbl_SundayHH['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_SundayHH['posx'] + $this->SC_incr_col,  $cell_lbl_SundayHH['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_SundayHH['posx']))
            {
                $this->Pdf->SetX($cell_lbl_SundayHH['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_SundayHH['posy']))
            {
                $this->Pdf->SetY($cell_lbl_SundayHH['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_SundayHH['width'], 0, $cell_lbl_SundayHH['data'], 0, 0, $cell_lbl_SundayHH['align']);

            $this->Pdf->SetFont($cell_lbl_HolidayHH['font_type'], $cell_lbl_HolidayHH['font_style'], $cell_lbl_HolidayHH['font_size']);
            $this->pdf_text_color($cell_lbl_HolidayHH['data'], $cell_lbl_HolidayHH['color_r'], $cell_lbl_HolidayHH['color_g'], $cell_lbl_HolidayHH['color_b']);
            if (!empty($cell_lbl_HolidayHH['posx']) && !empty($cell_lbl_HolidayHH['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_HolidayHH['posx'] + $this->SC_incr_col,  $cell_lbl_HolidayHH['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_HolidayHH['posx']))
            {
                $this->Pdf->SetX($cell_lbl_HolidayHH['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_HolidayHH['posy']))
            {
                $this->Pdf->SetY($cell_lbl_HolidayHH['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_HolidayHH['width'], 0, $cell_lbl_HolidayHH['data'], 0, 0, $cell_lbl_HolidayHH['align']);

            $this->Pdf->SetFont($cell_lbl_leaveHH['font_type'], $cell_lbl_leaveHH['font_style'], $cell_lbl_leaveHH['font_size']);
            $this->pdf_text_color($cell_lbl_leaveHH['data'], $cell_lbl_leaveHH['color_r'], $cell_lbl_leaveHH['color_g'], $cell_lbl_leaveHH['color_b']);
            if (!empty($cell_lbl_leaveHH['posx']) && !empty($cell_lbl_leaveHH['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_leaveHH['posx'] + $this->SC_incr_col,  $cell_lbl_leaveHH['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_leaveHH['posx']))
            {
                $this->Pdf->SetX($cell_lbl_leaveHH['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_leaveHH['posy']))
            {
                $this->Pdf->SetY($cell_lbl_leaveHH['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_leaveHH['width'], 0, $cell_lbl_leaveHH['data'], 0, 0, $cell_lbl_leaveHH['align']);

            $this->Pdf->SetFont($cell_SundayHH['font_type'], $cell_SundayHH['font_style'], $cell_SundayHH['font_size']);
            $this->pdf_text_color($cell_SundayHH['data'], $cell_SundayHH['color_r'], $cell_SundayHH['color_g'], $cell_SundayHH['color_b']);
            if (!empty($cell_SundayHH['posx']) && !empty($cell_SundayHH['posy']))
            {
                $this->Pdf->SetXY($cell_SundayHH['posx'] + $this->SC_incr_col,  $cell_SundayHH['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_SundayHH['posx']))
            {
                $this->Pdf->SetX($cell_SundayHH['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_SundayHH['posy']))
            {
                $this->Pdf->SetY($cell_SundayHH['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_SundayHH['width'], 0, $cell_SundayHH['data'], 0, 0, $cell_SundayHH['align']);

            $this->Pdf->SetFont($cell_HolidayHH['font_type'], $cell_HolidayHH['font_style'], $cell_HolidayHH['font_size']);
            $this->pdf_text_color($cell_HolidayHH['data'], $cell_HolidayHH['color_r'], $cell_HolidayHH['color_g'], $cell_HolidayHH['color_b']);
            if (!empty($cell_HolidayHH['posx']) && !empty($cell_HolidayHH['posy']))
            {
                $this->Pdf->SetXY($cell_HolidayHH['posx'] + $this->SC_incr_col,  $cell_HolidayHH['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_HolidayHH['posx']))
            {
                $this->Pdf->SetX($cell_HolidayHH['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_HolidayHH['posy']))
            {
                $this->Pdf->SetY($cell_HolidayHH['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_HolidayHH['width'], 0, $cell_HolidayHH['data'], 0, 0, $cell_HolidayHH['align']);

            $this->Pdf->SetFont($cell_LeaveHH['font_type'], $cell_LeaveHH['font_style'], $cell_LeaveHH['font_size']);
            $this->pdf_text_color($cell_LeaveHH['data'], $cell_LeaveHH['color_r'], $cell_LeaveHH['color_g'], $cell_LeaveHH['color_b']);
            if (!empty($cell_LeaveHH['posx']) && !empty($cell_LeaveHH['posy']))
            {
                $this->Pdf->SetXY($cell_LeaveHH['posx'] + $this->SC_incr_col,  $cell_LeaveHH['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_LeaveHH['posx']))
            {
                $this->Pdf->SetX($cell_LeaveHH['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_LeaveHH['posy']))
            {
                $this->Pdf->SetY($cell_LeaveHH['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_LeaveHH['width'], 0, $cell_LeaveHH['data'], 0, 0, $cell_LeaveHH['align']);

            $this->Pdf->SetFont($cell_Linexx['font_type'], $cell_Linexx['font_style'], $cell_Linexx['font_size']);
            $this->pdf_text_color($cell_Linexx['data'], $cell_Linexx['color_r'], $cell_Linexx['color_g'], $cell_Linexx['color_b']);
            if (!empty($cell_Linexx['posx']) && !empty($cell_Linexx['posy']))
            {
                $this->Pdf->SetXY($cell_Linexx['posx'] + $this->SC_incr_col,  $cell_Linexx['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_Linexx['posx']))
            {
                $this->Pdf->SetX($cell_Linexx['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_Linexx['posy']))
            {
                $this->Pdf->SetY($cell_Linexx['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_Linexx['width'], 0, $cell_Linexx['data'], 0, 0, $cell_Linexx['align']);

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

            $this->Pdf->SetFont($cell_RateWork['font_type'], $cell_RateWork['font_style'], $cell_RateWork['font_size']);
            $this->pdf_text_color($cell_RateWork['data'], $cell_RateWork['color_r'], $cell_RateWork['color_g'], $cell_RateWork['color_b']);
            if (!empty($cell_RateWork['posx']) && !empty($cell_RateWork['posy']))
            {
                $this->Pdf->SetXY($cell_RateWork['posx'] + $this->SC_incr_col,  $cell_RateWork['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_RateWork['posx']))
            {
                $this->Pdf->SetX($cell_RateWork['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_RateWork['posy']))
            {
                $this->Pdf->SetY($cell_RateWork['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_RateWork['width'], 0, $cell_RateWork['data'], 0, 0, $cell_RateWork['align']);

            $this->Pdf->SetFont($cell_lbl_RateWork['font_type'], $cell_lbl_RateWork['font_style'], $cell_lbl_RateWork['font_size']);
            $this->pdf_text_color($cell_lbl_RateWork['data'], $cell_lbl_RateWork['color_r'], $cell_lbl_RateWork['color_g'], $cell_lbl_RateWork['color_b']);
            if (!empty($cell_lbl_RateWork['posx']) && !empty($cell_lbl_RateWork['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_RateWork['posx'] + $this->SC_incr_col,  $cell_lbl_RateWork['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_RateWork['posx']))
            {
                $this->Pdf->SetX($cell_lbl_RateWork['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_RateWork['posy']))
            {
                $this->Pdf->SetY($cell_lbl_RateWork['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_RateWork['width'], 0, $cell_lbl_RateWork['data'], 0, 0, $cell_lbl_RateWork['align']);

            $this->Pdf->SetFont($cell_lbl_MealRate['font_type'], $cell_lbl_MealRate['font_style'], $cell_lbl_MealRate['font_size']);
            $this->pdf_text_color($cell_lbl_MealRate['data'], $cell_lbl_MealRate['color_r'], $cell_lbl_MealRate['color_g'], $cell_lbl_MealRate['color_b']);
            if (!empty($cell_lbl_MealRate['posx']) && !empty($cell_lbl_MealRate['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_MealRate['posx'] + $this->SC_incr_col,  $cell_lbl_MealRate['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_MealRate['posx']))
            {
                $this->Pdf->SetX($cell_lbl_MealRate['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_MealRate['posy']))
            {
                $this->Pdf->SetY($cell_lbl_MealRate['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_MealRate['width'], 0, $cell_lbl_MealRate['data'], 0, 0, $cell_lbl_MealRate['align']);

            $this->Pdf->SetFont($cell_MealDay['font_type'], $cell_MealDay['font_style'], $cell_MealDay['font_size']);
            $this->pdf_text_color($cell_MealDay['data'], $cell_MealDay['color_r'], $cell_MealDay['color_g'], $cell_MealDay['color_b']);
            if (!empty($cell_MealDay['posx']) && !empty($cell_MealDay['posy']))
            {
                $this->Pdf->SetXY($cell_MealDay['posx'] + $this->SC_incr_col,  $cell_MealDay['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_MealDay['posx']))
            {
                $this->Pdf->SetX($cell_MealDay['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_MealDay['posy']))
            {
                $this->Pdf->SetY($cell_MealDay['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_MealDay['width'], 0, $cell_MealDay['data'], 0, 0, $cell_MealDay['align']);

            $this->Pdf->SetFont($cell_MealRate['font_type'], $cell_MealRate['font_style'], $cell_MealRate['font_size']);
            $this->pdf_text_color($cell_MealRate['data'], $cell_MealRate['color_r'], $cell_MealRate['color_g'], $cell_MealRate['color_b']);
            if (!empty($cell_MealRate['posx']) && !empty($cell_MealRate['posy']))
            {
                $this->Pdf->SetXY($cell_MealRate['posx'] + $this->SC_incr_col,  $cell_MealRate['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_MealRate['posx']))
            {
                $this->Pdf->SetX($cell_MealRate['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_MealRate['posy']))
            {
                $this->Pdf->SetY($cell_MealRate['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_MealRate['width'], 0, $cell_MealRate['data'], 0, 0, $cell_MealRate['align']);

            $this->Pdf->SetFont($cell_Linexxx['font_type'], $cell_Linexxx['font_style'], $cell_Linexxx['font_size']);
            $this->pdf_text_color($cell_Linexxx['data'], $cell_Linexxx['color_r'], $cell_Linexxx['color_g'], $cell_Linexxx['color_b']);
            if (!empty($cell_Linexxx['posx']) && !empty($cell_Linexxx['posy']))
            {
                $this->Pdf->SetXY($cell_Linexxx['posx'] + $this->SC_incr_col,  $cell_Linexxx['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_Linexxx['posx']))
            {
                $this->Pdf->SetX($cell_Linexxx['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_Linexxx['posy']))
            {
                $this->Pdf->SetY($cell_Linexxx['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_Linexxx['width'], 0, $cell_Linexxx['data'], 0, 0, $cell_Linexxx['align']);

            $this->Pdf->SetFont($cell_lbl_taxCASS['font_type'], $cell_lbl_taxCASS['font_style'], $cell_lbl_taxCASS['font_size']);
            $this->pdf_text_color($cell_lbl_taxCASS['data'], $cell_lbl_taxCASS['color_r'], $cell_lbl_taxCASS['color_g'], $cell_lbl_taxCASS['color_b']);
            if (!empty($cell_lbl_taxCASS['posx']) && !empty($cell_lbl_taxCASS['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_taxCASS['posx'] + $this->SC_incr_col,  $cell_lbl_taxCASS['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_taxCASS['posx']))
            {
                $this->Pdf->SetX($cell_lbl_taxCASS['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_taxCASS['posy']))
            {
                $this->Pdf->SetY($cell_lbl_taxCASS['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_taxCASS['width'], 0, $cell_lbl_taxCASS['data'], 0, 0, $cell_lbl_taxCASS['align']);

            $this->Pdf->SetFont($cell_lbl_taxCFGDCT['font_type'], $cell_lbl_taxCFGDCT['font_style'], $cell_lbl_taxCFGDCT['font_size']);
            $this->pdf_text_color($cell_lbl_taxCFGDCT['data'], $cell_lbl_taxCFGDCT['color_r'], $cell_lbl_taxCFGDCT['color_g'], $cell_lbl_taxCFGDCT['color_b']);
            if (!empty($cell_lbl_taxCFGDCT['posx']) && !empty($cell_lbl_taxCFGDCT['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_taxCFGDCT['posx'] + $this->SC_incr_col,  $cell_lbl_taxCFGDCT['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_taxCFGDCT['posx']))
            {
                $this->Pdf->SetX($cell_lbl_taxCFGDCT['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_taxCFGDCT['posy']))
            {
                $this->Pdf->SetY($cell_lbl_taxCFGDCT['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_taxCFGDCT['width'], 0, $cell_lbl_taxCFGDCT['data'], 0, 0, $cell_lbl_taxCFGDCT['align']);

            $this->Pdf->SetFont($cell_lbl_taxFDU['font_type'], $cell_lbl_taxFDU['font_style'], $cell_lbl_taxFDU['font_size']);
            $this->pdf_text_color($cell_lbl_taxFDU['data'], $cell_lbl_taxFDU['color_r'], $cell_lbl_taxFDU['color_g'], $cell_lbl_taxFDU['color_b']);
            if (!empty($cell_lbl_taxFDU['posx']) && !empty($cell_lbl_taxFDU['posy']))
            {
                $this->Pdf->SetXY($cell_lbl_taxFDU['posx'] + $this->SC_incr_col,  $cell_lbl_taxFDU['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_lbl_taxFDU['posx']))
            {
                $this->Pdf->SetX($cell_lbl_taxFDU['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_lbl_taxFDU['posy']))
            {
                $this->Pdf->SetY($cell_lbl_taxFDU['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_lbl_taxFDU['width'], 0, $cell_lbl_taxFDU['data'], 0, 0, $cell_lbl_taxFDU['align']);

            $this->Pdf->SetFont($cell_CASS['font_type'], $cell_CASS['font_style'], $cell_CASS['font_size']);
            $this->pdf_text_color($cell_CASS['data'], $cell_CASS['color_r'], $cell_CASS['color_g'], $cell_CASS['color_b']);
            if (!empty($cell_CASS['posx']) && !empty($cell_CASS['posy']))
            {
                $this->Pdf->SetXY($cell_CASS['posx'] + $this->SC_incr_col,  $cell_CASS['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_CASS['posx']))
            {
                $this->Pdf->SetX($cell_CASS['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_CASS['posy']))
            {
                $this->Pdf->SetY($cell_CASS['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_CASS['width'], 0, $cell_CASS['data'], 0, 0, $cell_CASS['align']);

            $this->Pdf->SetFont($cell_CFGDCT['font_type'], $cell_CFGDCT['font_style'], $cell_CFGDCT['font_size']);
            $this->pdf_text_color($cell_CFGDCT['data'], $cell_CFGDCT['color_r'], $cell_CFGDCT['color_g'], $cell_CFGDCT['color_b']);
            if (!empty($cell_CFGDCT['posx']) && !empty($cell_CFGDCT['posy']))
            {
                $this->Pdf->SetXY($cell_CFGDCT['posx'] + $this->SC_incr_col,  $cell_CFGDCT['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_CFGDCT['posx']))
            {
                $this->Pdf->SetX($cell_CFGDCT['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_CFGDCT['posy']))
            {
                $this->Pdf->SetY($cell_CFGDCT['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_CFGDCT['width'], 0, $cell_CFGDCT['data'], 0, 0, $cell_CFGDCT['align']);

            $this->Pdf->SetFont($cell_FDU['font_type'], $cell_FDU['font_style'], $cell_FDU['font_size']);
            $this->pdf_text_color($cell_FDU['data'], $cell_FDU['color_r'], $cell_FDU['color_g'], $cell_FDU['color_b']);
            if (!empty($cell_FDU['posx']) && !empty($cell_FDU['posy']))
            {
                $this->Pdf->SetXY($cell_FDU['posx'] + $this->SC_incr_col,  $cell_FDU['posy'] + $this->SC_incr_lin);
            }
            elseif (!empty($cell_FDU['posx']))
            {
                $this->Pdf->SetX($cell_FDU['posx'] + $this->SC_incr_col);
            }
            elseif (!empty($cell_FDU['posy']))
            {
                $this->Pdf->SetY($cell_FDU['posy'] + $this->SC_incr_lin);
            }
            $this->Pdf->Cell($cell_FDU['width'], 0, $cell_FDU['data'], 0, 0, $cell_FDU['align']);
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
