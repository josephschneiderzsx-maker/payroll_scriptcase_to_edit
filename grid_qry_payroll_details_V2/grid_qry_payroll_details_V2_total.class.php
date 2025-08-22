<?php

class grid_qry_payroll_details_V2_total
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;

   var $nm_data;

   //----- 
   function __construct($sc_page)
   {
      $this->sc_page = $sc_page;
      $this->nm_data = new nm_data("en_us");
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_qry_payroll_details_V2']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_qry_payroll_details_V2']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['campos_busca'];
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
          $hiredate_2 = (isset($Busca_temp['hiredate_input_2'])) ? $Busca_temp['hiredate_input_2'] : ""; 
          $this->hiredate_2 = $hiredate_2; 
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
   }


   //----- 
   function Calc_resumo_sc_free_group_by($destino_resumo, $res_export=false, $ind_compara="", $tipo="")
   {
      global $nm_lang;
      $this->nm_data = new nm_data("en_us");
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['sql_tot_res']);
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['campos_busca'];
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
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['where_pesq'];
      $ind_qb                = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['SC_Ind_Groupby'];
      $cmp_sql_def   = array('dept' => "dept");
      $cmps_quebra_atual = array();
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['SC_Gb_Free_cmp'] as $cmp => $resto)
      {
          $cmps_quebra_atual[] = $cmp;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['SC_force_fiels_gb']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['SC_force_fiels_gb']))
      {
          $cmps_quebra_atual = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['SC_force_fiels_gb'];
      }
      $Save_Format = '';
      $ult_cmp_quebra_atual = $cmps_quebra_atual[(count($cmps_quebra_atual) - 1)];
      $arr_tots = "";
      $join     = "";
      $group    = "";
      $i_group  = 1;
      $cmps_gb  = "";
      $cmps_gb1 = "";
      $cmps_gb2 = "";
      $cmps_gbS = array();
      $ind_cmps = 42;
      $ind_alias = "1";
      $cmp_dim   = array();
      $all_group = array();
      foreach ($cmps_quebra_atual as $cmp_gb)
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['SC_clear_total']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['SC_clear_total']) {
              $str_tot = "array_total_" . $cmp_gb;
              $this->$str_tot = array();
          }
          $Format_tst = $this->Ini->Get_Gb_date_format($ind_qb, $cmp_gb);
          if (!empty($Format_tst))
          {
              $Str_arg_sum = $this->Ini->Get_date_arg_sum($cmp_gb, $Format_tst, $cmp_sql_def[$cmp_gb], false, true);
              $Str_arg_sql = ($Str_arg_sum == " is null") ? $cmp_sql_def[$cmp_gb] : $this->Ini->Get_sql_date_groupby($cmp_sql_def[$cmp_gb], $Format_tst);
          }
          else
          {
              $Str_arg_sql = "";
              $Str_arg_sum = $cmp_sql_def[$cmp_gb] . " *sc# SC." . $cmp_sql_def[$cmp_gb];
          }
          $cmp_dim[$cmp_gb] = $ind_cmps;
          $temp = explode(" and ", $Str_arg_sum);
          foreach ($temp as $cada_parte)
          {
              $temp1 = explode("*sc#", $cada_parte);
              if (!in_array($Str_arg_sql . trim($temp1[0]), $all_group))
              {
                  $group   .= (empty($group))   ? $Str_arg_sql . trim($temp1[0]) : "," . $Str_arg_sql . trim($temp1[0]);
                  $all_group[] = $Str_arg_sql . trim($temp1[0]);
              }
              $cmps_gb1 .= (empty($cmps_gb1)) ? $Str_arg_sql . trim($temp1[0]) : "," . $Str_arg_sql . trim($temp1[0]);
              $cmps_gb1 .= " as a_cmp_" .  $ind_alias;
              $cmps_gb2 .= (empty($cmps_gb2)) ? $Str_arg_sql . trim($temp1[0]) : "," . $Str_arg_sql . trim($temp1[0]);
              $cmps_gb2 .= " as b_cmp_" .  $ind_alias;
              $join     .= empty($join) ? "" : " and ";
              $join     .= " SC_sel1.a_cmp_" .  $ind_alias . " =  SC_sel2.b_cmp_" .  $ind_alias;
              $ind_cmps++;
              $ind_alias++;
              $i_group++;
          }
      }
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['SC_clear_total']);
      $ind_cmps  = 42;
      $ind_alias = "1";
      $cmp_dim   = array();
      foreach ($cmps_quebra_atual as $cmp_gb)
      {
          $arr_tots .= "[\$" . $cmp_gb . "_orig]";
          $Format_tst = $this->Ini->Get_Gb_date_format($ind_qb, $cmp_gb);
          if (!empty($Format_tst))
          {
              $Str_arg_sum = $this->Ini->Get_date_arg_sum($cmp_gb, $Format_tst, $cmp_sql_def[$cmp_gb], false, true);
              $Str_arg_sql = ($Str_arg_sum == " is null") ? $cmp_sql_def[$cmp_gb] : $this->Ini->Get_sql_date_groupby($cmp_sql_def[$cmp_gb], $Format_tst);
          }
          else
          {
              $Str_arg_sql = "";
              $Str_arg_sum = $cmp_sql_def[$cmp_gb] . " *sc# SC." . $cmp_sql_def[$cmp_gb];
          }
          $cmp_dim[$cmp_gb] = $ind_cmps;
          $temp = explode(" and ", $Str_arg_sum);
          foreach ($temp as $cada_parte)
          {
              $temp1 = explode("*sc#", $cada_parte);
              $cmps_gb  .= (empty($cmps_gb)) ? "a_cmp_" .  $ind_alias : "," . "a_cmp_" .  $ind_alias;
              $cmps_gbS['a_cmp_' . $ind_alias] = $Str_arg_sql . trim($temp1[0]);
              $ind_cmps++;
              $ind_alias++;
          }
          $arr_compara = "[" . $ind_compara . "]";
          $this->Res_Totaliza_sc_free_group_by($ind_qb, $cmp_gb, $arr_tots . $arr_compara, $group, $join, $cmps_gb, $cmps_gb1, $cmps_gb2, $cmps_gbS, $cmp_dim, $cmps_quebra_atual, $cmp_sql_def, $res_export, $Save_Format);
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['arr_total'] = array();
      foreach ($cmps_quebra_atual as $cmp_gb)
      {
          $Arr_tot_name = "array_total_" . $cmp_gb;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['arr_total'][$cmp_gb] = $this->$Arr_tot_name;
      }
   }

   function Res_Totaliza_sc_free_group_by($ind_qb, $cmp_tot, $arr_tots, $group, $join, $cmps_quebras, $cmps_quebras1, $cmps_quebras2, $cmps_quebrasS, $Cmp_dim, $cmps_quebra_atual, $cmp_sql_def, $res_export, $Save_Format)
   {
      $sc_having = ((isset($parms_sub_sel['having']))) ? "  having " . $parms_sub_sel['having'] : "";
      $Tem_estat_manual = false;
      if ((isset($this->Ini->nm_bases_vfp) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_vfp)) || (isset($this->Ini->nm_bases_odbc) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_odbc)))
      {
          $Tem_estat_manual = true;
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $Tem_estat_manual = true;
      }
      $where_ok = $this->sc_where_atual;
      $cmp_sql_tp_num = array('userid_int' => 'N','rate_salf' => 'N','rate_work' => 'N','rate_ot_factor' => 'N','rate_ot_holiday_factor' => 'N','rate_ot_restday_factor' => 'N','rate_ot_offday_factor' => 'N','income_workday' => 'N','income_holiday' => 'N','income_restday' => 'N','income_offday' => 'N','hh_sunday' => 'N','sal_sunday' => 'N','hh_offday' => 'N','sal_holiday' => 'N','sal_leavetype' => 'N','sal_brut_reg' => 'N','ot_hh_w' => 'N','ot_hh_w_pm' => 'N','income_workday_ot' => 'N','ot_hh_h' => 'N','ot_hh_h_pm' => 'N','income_holiday_ot' => 'N','ot_hh_r' => 'N','ot_hh_r_pm' => 'N','income_restday_ot' => 'N','ot_hh_o' => 'N','ot_hh_o_pm' => 'N','income_offday_ot' => 'N','incentive' => 'N','income_comm' => 'N','rappel' => 'N','tax_cass' => 'N','tax_cfgdct' => 'N','tax_fdu' => 'N','tax_iris' => 'N','tax_ona' => 'N','tax_iric' => 'N','dedeuct_cons' => 'N','loan_deduction' => 'N','loan_deduction_bank' => 'N','other_deduct' => 'N','total_deduct' => 'N','sal_net' => 'N');
     $cmd_simp = "select count(*), sum(sal_brut_reg), sum(income_workday_ot), sum(income_holiday_ot), sum(income_restday_ot), sum(income_offday_ot), sum(incentive), sum(income_comm), sum(rappel), sum(tax_cass), sum(tax_cfgdct), sum(tax_fdu), sum(tax_iris), sum(tax_ona), sum(tax_iric), sum(dedeuct_cons), sum(loan_deduction), sum(loan_deduction_bank), sum(other_deduct), sum(total_deduct), sum(sal_net), count(distinct userid_int), count(userid_int), sum(Rate_SALF), sum(Rate_Work), sum(income_workday), sum(income_holiday), sum(income_restday), sum(income_offday), sum(hh_sunday), sum(sal_sunday), sum(hh_offday), sum(sal_holiday), sum(sal_leavetype), sum(ot_hh_w), sum(ot_hh_w_PM), sum(ot_hh_h), sum(ot_hh_h_PM), sum(ot_hh_r), sum(ot_hh_r_PM), sum(ot_hh_o), sum(ot_hh_o_PM)#@#cmps_quebras#@# from " . $this->Ini->nm_tabela . " " . $where_ok;
     $comando  = "select count(*), sum(SC_metric1), sum(SC_metric2), sum(SC_metric3), sum(SC_metric4), sum(SC_metric5), sum(SC_metric6), sum(SC_metric7), sum(SC_metric8), sum(SC_metric9), sum(SC_metric10), sum(SC_metric11), sum(SC_metric12), sum(SC_metric13), sum(SC_metric14), sum(SC_metric15), sum(SC_metric16), sum(SC_metric17), sum(SC_metric18), sum(SC_metric19), sum(SC_metric20), count(distinct SC_metric21), count(SC_metric21), sum(SC_metric22), sum(SC_metric23), sum(SC_metric24), sum(SC_metric25), sum(SC_metric26), sum(SC_metric27), sum(SC_metric28), sum(SC_metric29), sum(SC_metric30), sum(SC_metric31), sum(SC_metric32), sum(SC_metric33), sum(SC_metric34), sum(SC_metric35), sum(SC_metric36), sum(SC_metric37), sum(SC_metric38), sum(SC_metric39), sum(SC_metric40)#@#cmps_quebras#@# from (";
     $comando .= "select sal_brut_reg as SC_metric1,income_workday_ot as SC_metric2,income_holiday_ot as SC_metric3,income_restday_ot as SC_metric4,income_offday_ot as SC_metric5,incentive as SC_metric6,income_comm as SC_metric7,rappel as SC_metric8,tax_cass as SC_metric9,tax_cfgdct as SC_metric10,tax_fdu as SC_metric11,tax_iris as SC_metric12,tax_ona as SC_metric13,tax_iric as SC_metric14,dedeuct_cons as SC_metric15,loan_deduction as SC_metric16,loan_deduction_bank as SC_metric17,other_deduct as SC_metric18,total_deduct as SC_metric19,sal_net as SC_metric20,userid_int as SC_metric21,Rate_SALF as SC_metric22,Rate_Work as SC_metric23,income_workday as SC_metric24,income_holiday as SC_metric25,income_restday as SC_metric26,income_offday as SC_metric27,hh_sunday as SC_metric28,sal_sunday as SC_metric29,hh_offday as SC_metric30,sal_holiday as SC_metric31,sal_leavetype as SC_metric32,ot_hh_w as SC_metric33,ot_hh_w_PM as SC_metric34,ot_hh_h as SC_metric35,ot_hh_h_PM as SC_metric36,ot_hh_r as SC_metric37,ot_hh_r_PM as SC_metric38,ot_hh_o as SC_metric39,ot_hh_o_PM as SC_metric40, " . $cmps_quebras1 . " from " . $this->Ini->nm_tabela . " " .  $where_ok . ") SC_sel1 INNER JOIN (";
     $comando .= "select " . $cmps_quebras2 . " from " . $this->Ini->nm_tabela . " " .  $where_ok . " group by " . $group . $sc_having . ") SC_sel2 ";
     $comando .= " ON " . $join;
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['sql_tot_res']))
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['sql_tot_res'] = str_replace("#@#cmps_quebras#@#", "", $comando);
      }
      $comando  = str_replace("#@#cmps_quebras#@#", "," . $cmps_quebras, $comando);
      $comando .= " group by " . $cmps_quebras . " order by " .  $cmps_quebras;
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['Res_search_metric_use']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['Res_search_metric_use']))
      {
          $comando = $cmd_simp;
          $cmps_S  = "";
          foreach ($cmps_quebrasS as $alias => $sql)
          {
              $cmps_S .= empty($cmps_S) ? $sql : ", " . $sql;
          }
          $comando = str_replace("#@#cmps_quebras#@#", "," . $cmps_S, $comando);
          $order_group = "";
          foreach ($cmps_quebrasS as $alias => $cada_tst)
          {
              $cada_tst = trim($cada_tst);
              $pos = strpos(" " . $order_group, " " . $cada_tst);
              if ($pos === false)
              {
                  $order_group .= (!empty($order_group)) ? ", " . $cada_tst : $cada_tst;
              }
          }
          $comando .= " group by " . $order_group . " order by " .  $order_group;
      }
      $comando  = $this->Ajust_statistic($comando);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($comando))
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit;
      }
      $format_dimensions = array();
      $format_dimensions['dept']['reg'] = "S";
      $format_dimensions['dept']['msk'] = "";
      while (!$rt->EOF)
      {
          $sql_where = "";
          foreach ($Cmp_dim as $Cada_dim => $Ind_sql)
          {
              $prep_look  = $Cada_dim . "_SC_look";
              $$prep_look = $rt->fields[$Ind_sql];
              $SC_prep = $this->Ini->Get_format_dimension($Ind_sql, 'sc_free_group_by', $Cada_dim, $rt, $format_dimensions[$Cada_dim]['reg'], $format_dimensions[$Cada_dim]['msk']);
              $SC_orig = $Cada_dim . "_orig";
              $SC_graf = "val_grafico_" . $Cada_dim;
              $$Cada_dim = $SC_prep['fmt'];
              $$SC_orig = $SC_prep['orig'];
              if ($Cada_dim == "dept") {
              }
              if (null === $$Cada_dim)
              {
                  $$Cada_dim = '';
              }
              if (null === $$SC_orig)
              {
                  $$SC_orig = '__SCNULL__';
              }
              $$SC_graf = $$Cada_dim;
              if ($Tem_estat_manual)
              {
                  $Format_tst = $this->Ini->Get_Gb_date_format($ind_qb, $Cada_dim);
                  if (!empty($Format_tst))
                  {
                      $val_sql  = $rt->fields[$Ind_sql];
                      if ($Format_tst == 'YYYYMMDDHHII')
                      {
                          $val_sql .= "-" . $rt->fields[$Ind_sql + 1] . "-" . $rt->fields[$Ind_sql + 2] . " " . $rt->fields[$Ind_sql + 3] . ":" . $rt->fields[$Ind_sql + 4];
                      }
                      if ($Format_tst == 'YYYYMMDDHH')
                      {
                          $val_sql .= "-" . $rt->fields[$Ind_sql + 1] . "-" . $rt->fields[$Ind_sql + 2] . " " . $rt->fields[$Ind_sql + 3];
                      }
                      if ($Format_tst == 'YYYYMMDD2')
                      {
                          $val_sql .= "-" . $rt->fields[$Ind_sql + 1] . "-" . $rt->fields[$Ind_sql + 2];
                      }
                      if ($Format_tst == 'YYYYMM')
                      {
                          $val_sql .= "-" . $rt->fields[$Ind_sql + 1];
                      }
                      if ($Format_tst == 'YYYYHH' || $Format_tst == 'YYYYDD' || $Format_tst == 'YYYYDAYNAME' || $Format_tst == 'YYYYWEEK' || $Format_tst == 'YYYYBIMONTHLY' || $Format_tst == 'YYYYQUARTER' || $Format_tst == 'YYYYFOURMONTHS' || $Format_tst == 'YYYYSEMIANNUAL')
                      {
                          $val_sql .= $rt->fields[$Ind_sql + 1];
                      }
                      if ($Format_tst == 'HHIISS')
                      {
                          $val_sql  = $rt->fields[$Ind_sql] . ":" . $rt->fields[$Ind_sql + 1] . ":" . $rt->fields[$Ind_sql + 2];
                      }
                      if ($Format_tst == 'HHII')
                      {
                          $val_sql  = $rt->fields[$Ind_sql] . ":" . $rt->fields[$Ind_sql + 1];
                      }
                      $Str_arg_sum = $this->Ini->Get_date_arg_sum($val_sql, $Format_tst, $cmp_sql_def[$Cada_dim], true);
                      $Str_arg_sql = ($Str_arg_sum == " is null") ? $cmp_sql_def[$Cada_dim] : $this->Ini->Get_sql_date_groupby($cmp_sql_def[$Cada_dim], $Format_tst);
                  }
                  elseif (isset($cmp_sql_tp_num[$Cada_dim]))
                  {
                      $Str_arg_sql = $cmp_sql_def[$Cada_dim];
                      $Str_arg_sum = " = " . $rt->fields[$Ind_sql];
                  }
                  else
                  {
                      $Str_arg_sql = $cmp_sql_def[$Cada_dim];
                      $Str_arg_sum = " = " . $this->Db->qstr($rt->fields[$Ind_sql]);
                  }
                  $sql_where .= (!empty($sql_where)) ? " and " : "";
                  $sql_where .= $Str_arg_sql . $Str_arg_sum;
              }
          }
          if ($Tem_estat_manual)
          {
              $where_ok = (empty($this->sc_where_atual)) ? " where " . $sql_where : $this->sc_where_atual . " and " . $sql_where;
              $vl_statistic = $this->Calc_statist_manual_sc_free_group_by($where_ok);
              foreach ($vl_statistic as $ind => $val)
              {
                  $rt->fields[$ind] = $val;
              }
          }
          $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
          $rt->fields[1] = (strpos(strtolower($rt->fields[1]), "e")) ? (float)$rt->fields[1] : $rt->fields[1]; 
          $rt->fields[1] = (string)$rt->fields[1];
          if ($rt->fields[1] == "") 
          {
              $rt->fields[1] = 0;
          }
          if (substr($rt->fields[1], 0, 1) == ".") 
          {
              $rt->fields[1] = "0" . $rt->fields[1];
          }
          if (substr($rt->fields[1], 0, 2) == "-.") 
          {
              $rt->fields[1] = "-0" . substr($rt->fields[1], 1);
          }
          nmgp_Trunc_Num($rt->fields[1], 2);
          $rt->fields[2] = str_replace(",", ".", $rt->fields[2]);
          $rt->fields[2] = (strpos(strtolower($rt->fields[2]), "e")) ? (float)$rt->fields[2] : $rt->fields[2]; 
          $rt->fields[2] = (string)$rt->fields[2];
          if ($rt->fields[2] == "") 
          {
              $rt->fields[2] = 0;
          }
          if (substr($rt->fields[2], 0, 1) == ".") 
          {
              $rt->fields[2] = "0" . $rt->fields[2];
          }
          if (substr($rt->fields[2], 0, 2) == "-.") 
          {
              $rt->fields[2] = "-0" . substr($rt->fields[2], 1);
          }
          nmgp_Trunc_Num($rt->fields[2], 2);
          $rt->fields[3] = str_replace(",", ".", $rt->fields[3]);
          $rt->fields[3] = (strpos(strtolower($rt->fields[3]), "e")) ? (float)$rt->fields[3] : $rt->fields[3]; 
          $rt->fields[3] = (string)$rt->fields[3];
          if ($rt->fields[3] == "") 
          {
              $rt->fields[3] = 0;
          }
          if (substr($rt->fields[3], 0, 1) == ".") 
          {
              $rt->fields[3] = "0" . $rt->fields[3];
          }
          if (substr($rt->fields[3], 0, 2) == "-.") 
          {
              $rt->fields[3] = "-0" . substr($rt->fields[3], 1);
          }
          nmgp_Trunc_Num($rt->fields[3], 2);
          $rt->fields[4] = str_replace(",", ".", $rt->fields[4]);
          $rt->fields[4] = (strpos(strtolower($rt->fields[4]), "e")) ? (float)$rt->fields[4] : $rt->fields[4]; 
          $rt->fields[4] = (string)$rt->fields[4];
          if ($rt->fields[4] == "") 
          {
              $rt->fields[4] = 0;
          }
          if (substr($rt->fields[4], 0, 1) == ".") 
          {
              $rt->fields[4] = "0" . $rt->fields[4];
          }
          if (substr($rt->fields[4], 0, 2) == "-.") 
          {
              $rt->fields[4] = "-0" . substr($rt->fields[4], 1);
          }
          nmgp_Trunc_Num($rt->fields[4], 2);
          $rt->fields[5] = str_replace(",", ".", $rt->fields[5]);
          $rt->fields[5] = (strpos(strtolower($rt->fields[5]), "e")) ? (float)$rt->fields[5] : $rt->fields[5]; 
          $rt->fields[5] = (string)$rt->fields[5];
          if ($rt->fields[5] == "") 
          {
              $rt->fields[5] = 0;
          }
          if (substr($rt->fields[5], 0, 1) == ".") 
          {
              $rt->fields[5] = "0" . $rt->fields[5];
          }
          if (substr($rt->fields[5], 0, 2) == "-.") 
          {
              $rt->fields[5] = "-0" . substr($rt->fields[5], 1);
          }
          nmgp_Trunc_Num($rt->fields[5], 2);
          $rt->fields[6] = str_replace(",", ".", $rt->fields[6]);
          $rt->fields[6] = (strpos(strtolower($rt->fields[6]), "e")) ? (float)$rt->fields[6] : $rt->fields[6]; 
          $rt->fields[6] = (string)$rt->fields[6];
          if ($rt->fields[6] == "") 
          {
              $rt->fields[6] = 0;
          }
          if (substr($rt->fields[6], 0, 1) == ".") 
          {
              $rt->fields[6] = "0" . $rt->fields[6];
          }
          if (substr($rt->fields[6], 0, 2) == "-.") 
          {
              $rt->fields[6] = "-0" . substr($rt->fields[6], 1);
          }
          nmgp_Trunc_Num($rt->fields[6], 2);
          $rt->fields[7] = str_replace(",", ".", $rt->fields[7]);
          $rt->fields[7] = (strpos(strtolower($rt->fields[7]), "e")) ? (float)$rt->fields[7] : $rt->fields[7]; 
          $rt->fields[7] = (string)$rt->fields[7];
          if ($rt->fields[7] == "") 
          {
              $rt->fields[7] = 0;
          }
          if (substr($rt->fields[7], 0, 1) == ".") 
          {
              $rt->fields[7] = "0" . $rt->fields[7];
          }
          if (substr($rt->fields[7], 0, 2) == "-.") 
          {
              $rt->fields[7] = "-0" . substr($rt->fields[7], 1);
          }
          nmgp_Trunc_Num($rt->fields[7], 2);
          $rt->fields[8] = str_replace(",", ".", $rt->fields[8]);
          $rt->fields[8] = (strpos(strtolower($rt->fields[8]), "e")) ? (float)$rt->fields[8] : $rt->fields[8]; 
          $rt->fields[8] = (string)$rt->fields[8];
          if ($rt->fields[8] == "") 
          {
              $rt->fields[8] = 0;
          }
          if (substr($rt->fields[8], 0, 1) == ".") 
          {
              $rt->fields[8] = "0" . $rt->fields[8];
          }
          if (substr($rt->fields[8], 0, 2) == "-.") 
          {
              $rt->fields[8] = "-0" . substr($rt->fields[8], 1);
          }
          nmgp_Trunc_Num($rt->fields[8], 2);
          $rt->fields[9] = str_replace(",", ".", $rt->fields[9]);
          $rt->fields[9] = (strpos(strtolower($rt->fields[9]), "e")) ? (float)$rt->fields[9] : $rt->fields[9]; 
          $rt->fields[9] = (string)$rt->fields[9];
          if ($rt->fields[9] == "") 
          {
              $rt->fields[9] = 0;
          }
          if (substr($rt->fields[9], 0, 1) == ".") 
          {
              $rt->fields[9] = "0" . $rt->fields[9];
          }
          if (substr($rt->fields[9], 0, 2) == "-.") 
          {
              $rt->fields[9] = "-0" . substr($rt->fields[9], 1);
          }
          nmgp_Trunc_Num($rt->fields[9], 2);
          $rt->fields[10] = str_replace(",", ".", $rt->fields[10]);
          $rt->fields[10] = (strpos(strtolower($rt->fields[10]), "e")) ? (float)$rt->fields[10] : $rt->fields[10]; 
          $rt->fields[10] = (string)$rt->fields[10];
          if ($rt->fields[10] == "") 
          {
              $rt->fields[10] = 0;
          }
          if (substr($rt->fields[10], 0, 1) == ".") 
          {
              $rt->fields[10] = "0" . $rt->fields[10];
          }
          if (substr($rt->fields[10], 0, 2) == "-.") 
          {
              $rt->fields[10] = "-0" . substr($rt->fields[10], 1);
          }
          nmgp_Trunc_Num($rt->fields[10], 2);
          $rt->fields[11] = str_replace(",", ".", $rt->fields[11]);
          $rt->fields[11] = (strpos(strtolower($rt->fields[11]), "e")) ? (float)$rt->fields[11] : $rt->fields[11]; 
          $rt->fields[11] = (string)$rt->fields[11];
          if ($rt->fields[11] == "") 
          {
              $rt->fields[11] = 0;
          }
          if (substr($rt->fields[11], 0, 1) == ".") 
          {
              $rt->fields[11] = "0" . $rt->fields[11];
          }
          if (substr($rt->fields[11], 0, 2) == "-.") 
          {
              $rt->fields[11] = "-0" . substr($rt->fields[11], 1);
          }
          nmgp_Trunc_Num($rt->fields[11], 2);
          $rt->fields[12] = str_replace(",", ".", $rt->fields[12]);
          $rt->fields[12] = (strpos(strtolower($rt->fields[12]), "e")) ? (float)$rt->fields[12] : $rt->fields[12]; 
          $rt->fields[12] = (string)$rt->fields[12];
          if ($rt->fields[12] == "") 
          {
              $rt->fields[12] = 0;
          }
          if (substr($rt->fields[12], 0, 1) == ".") 
          {
              $rt->fields[12] = "0" . $rt->fields[12];
          }
          if (substr($rt->fields[12], 0, 2) == "-.") 
          {
              $rt->fields[12] = "-0" . substr($rt->fields[12], 1);
          }
          nmgp_Trunc_Num($rt->fields[12], 2);
          $rt->fields[13] = str_replace(",", ".", $rt->fields[13]);
          $rt->fields[13] = (strpos(strtolower($rt->fields[13]), "e")) ? (float)$rt->fields[13] : $rt->fields[13]; 
          $rt->fields[13] = (string)$rt->fields[13];
          if ($rt->fields[13] == "") 
          {
              $rt->fields[13] = 0;
          }
          if (substr($rt->fields[13], 0, 1) == ".") 
          {
              $rt->fields[13] = "0" . $rt->fields[13];
          }
          if (substr($rt->fields[13], 0, 2) == "-.") 
          {
              $rt->fields[13] = "-0" . substr($rt->fields[13], 1);
          }
          nmgp_Trunc_Num($rt->fields[13], 2);
          $rt->fields[14] = str_replace(",", ".", $rt->fields[14]);
          $rt->fields[14] = (strpos(strtolower($rt->fields[14]), "e")) ? (float)$rt->fields[14] : $rt->fields[14]; 
          $rt->fields[14] = (string)$rt->fields[14];
          if ($rt->fields[14] == "") 
          {
              $rt->fields[14] = 0;
          }
          if (substr($rt->fields[14], 0, 1) == ".") 
          {
              $rt->fields[14] = "0" . $rt->fields[14];
          }
          if (substr($rt->fields[14], 0, 2) == "-.") 
          {
              $rt->fields[14] = "-0" . substr($rt->fields[14], 1);
          }
          nmgp_Trunc_Num($rt->fields[14], 2);
          $rt->fields[15] = str_replace(",", ".", $rt->fields[15]);
          $rt->fields[15] = (strpos(strtolower($rt->fields[15]), "e")) ? (float)$rt->fields[15] : $rt->fields[15]; 
          $rt->fields[15] = (string)$rt->fields[15];
          if ($rt->fields[15] == "") 
          {
              $rt->fields[15] = 0;
          }
          if (substr($rt->fields[15], 0, 1) == ".") 
          {
              $rt->fields[15] = "0" . $rt->fields[15];
          }
          if (substr($rt->fields[15], 0, 2) == "-.") 
          {
              $rt->fields[15] = "-0" . substr($rt->fields[15], 1);
          }
          nmgp_Trunc_Num($rt->fields[15], 2);
          $rt->fields[16] = str_replace(",", ".", $rt->fields[16]);
          $rt->fields[16] = (strpos(strtolower($rt->fields[16]), "e")) ? (float)$rt->fields[16] : $rt->fields[16]; 
          $rt->fields[16] = (string)$rt->fields[16];
          if ($rt->fields[16] == "") 
          {
              $rt->fields[16] = 0;
          }
          if (substr($rt->fields[16], 0, 1) == ".") 
          {
              $rt->fields[16] = "0" . $rt->fields[16];
          }
          if (substr($rt->fields[16], 0, 2) == "-.") 
          {
              $rt->fields[16] = "-0" . substr($rt->fields[16], 1);
          }
          nmgp_Trunc_Num($rt->fields[16], 2);
          $rt->fields[17] = str_replace(",", ".", $rt->fields[17]);
          $rt->fields[17] = (strpos(strtolower($rt->fields[17]), "e")) ? (float)$rt->fields[17] : $rt->fields[17]; 
          $rt->fields[17] = (string)$rt->fields[17];
          if ($rt->fields[17] == "") 
          {
              $rt->fields[17] = 0;
          }
          if (substr($rt->fields[17], 0, 1) == ".") 
          {
              $rt->fields[17] = "0" . $rt->fields[17];
          }
          if (substr($rt->fields[17], 0, 2) == "-.") 
          {
              $rt->fields[17] = "-0" . substr($rt->fields[17], 1);
          }
          nmgp_Trunc_Num($rt->fields[17], 2);
          $rt->fields[18] = str_replace(",", ".", $rt->fields[18]);
          $rt->fields[18] = (strpos(strtolower($rt->fields[18]), "e")) ? (float)$rt->fields[18] : $rt->fields[18]; 
          $rt->fields[18] = (string)$rt->fields[18];
          if ($rt->fields[18] == "") 
          {
              $rt->fields[18] = 0;
          }
          if (substr($rt->fields[18], 0, 1) == ".") 
          {
              $rt->fields[18] = "0" . $rt->fields[18];
          }
          if (substr($rt->fields[18], 0, 2) == "-.") 
          {
              $rt->fields[18] = "-0" . substr($rt->fields[18], 1);
          }
          nmgp_Trunc_Num($rt->fields[18], 2);
          $rt->fields[19] = str_replace(",", ".", $rt->fields[19]);
          $rt->fields[19] = (strpos(strtolower($rt->fields[19]), "e")) ? (float)$rt->fields[19] : $rt->fields[19]; 
          $rt->fields[19] = (string)$rt->fields[19];
          if ($rt->fields[19] == "") 
          {
              $rt->fields[19] = 0;
          }
          if (substr($rt->fields[19], 0, 1) == ".") 
          {
              $rt->fields[19] = "0" . $rt->fields[19];
          }
          if (substr($rt->fields[19], 0, 2) == "-.") 
          {
              $rt->fields[19] = "-0" . substr($rt->fields[19], 1);
          }
          nmgp_Trunc_Num($rt->fields[19], 2);
          $rt->fields[20] = str_replace(",", ".", $rt->fields[20]);
          $rt->fields[20] = (strpos(strtolower($rt->fields[20]), "e")) ? (float)$rt->fields[20] : $rt->fields[20]; 
          $rt->fields[20] = (string)$rt->fields[20];
          if ($rt->fields[20] == "") 
          {
              $rt->fields[20] = 0;
          }
          if (substr($rt->fields[20], 0, 1) == ".") 
          {
              $rt->fields[20] = "0" . $rt->fields[20];
          }
          if (substr($rt->fields[20], 0, 2) == "-.") 
          {
              $rt->fields[20] = "-0" . substr($rt->fields[20], 1);
          }
          nmgp_Trunc_Num($rt->fields[20], 2);
          $rt->fields[21] = str_replace(",", ".", $rt->fields[21]);
          $rt->fields[21] = (strpos(strtolower($rt->fields[21]), "e")) ? (float)$rt->fields[21] : $rt->fields[21]; 
          $rt->fields[21] = (string)$rt->fields[21];
          if ($rt->fields[21] == "") 
          {
              $rt->fields[21] = 0;
          }
          if (substr($rt->fields[21], 0, 1) == ".") 
          {
              $rt->fields[21] = "0" . $rt->fields[21];
          }
          if (substr($rt->fields[21], 0, 2) == "-.") 
          {
              $rt->fields[21] = "-0" . substr($rt->fields[21], 1);
          }
          nmgp_Trunc_Num($rt->fields[21], 0);
          $rt->fields[22] = str_replace(",", ".", $rt->fields[22]);
          $rt->fields[22] = (strpos(strtolower($rt->fields[22]), "e")) ? (float)$rt->fields[22] : $rt->fields[22]; 
          $rt->fields[22] = (string)$rt->fields[22];
          if ($rt->fields[22] == "") 
          {
              $rt->fields[22] = 0;
          }
          if (substr($rt->fields[22], 0, 1) == ".") 
          {
              $rt->fields[22] = "0" . $rt->fields[22];
          }
          if (substr($rt->fields[22], 0, 2) == "-.") 
          {
              $rt->fields[22] = "-0" . substr($rt->fields[22], 1);
          }
          nmgp_Trunc_Num($rt->fields[22], 0);
          $rt->fields[23] = str_replace(",", ".", $rt->fields[23]);
          $rt->fields[23] = (strpos(strtolower($rt->fields[23]), "e")) ? (float)$rt->fields[23] : $rt->fields[23]; 
          $rt->fields[23] = (string)$rt->fields[23];
          if ($rt->fields[23] == "") 
          {
              $rt->fields[23] = 0;
          }
          if (substr($rt->fields[23], 0, 1) == ".") 
          {
              $rt->fields[23] = "0" . $rt->fields[23];
          }
          if (substr($rt->fields[23], 0, 2) == "-.") 
          {
              $rt->fields[23] = "-0" . substr($rt->fields[23], 1);
          }
          nmgp_Trunc_Num($rt->fields[23], 2);
          $rt->fields[24] = str_replace(",", ".", $rt->fields[24]);
          $rt->fields[24] = (strpos(strtolower($rt->fields[24]), "e")) ? (float)$rt->fields[24] : $rt->fields[24]; 
          $rt->fields[24] = (string)$rt->fields[24];
          if ($rt->fields[24] == "") 
          {
              $rt->fields[24] = 0;
          }
          if (substr($rt->fields[24], 0, 1) == ".") 
          {
              $rt->fields[24] = "0" . $rt->fields[24];
          }
          if (substr($rt->fields[24], 0, 2) == "-.") 
          {
              $rt->fields[24] = "-0" . substr($rt->fields[24], 1);
          }
          nmgp_Trunc_Num($rt->fields[24], 2);
          $rt->fields[25] = str_replace(",", ".", $rt->fields[25]);
          $rt->fields[25] = (strpos(strtolower($rt->fields[25]), "e")) ? (float)$rt->fields[25] : $rt->fields[25]; 
          $rt->fields[25] = (string)$rt->fields[25];
          if ($rt->fields[25] == "") 
          {
              $rt->fields[25] = 0;
          }
          if (substr($rt->fields[25], 0, 1) == ".") 
          {
              $rt->fields[25] = "0" . $rt->fields[25];
          }
          if (substr($rt->fields[25], 0, 2) == "-.") 
          {
              $rt->fields[25] = "-0" . substr($rt->fields[25], 1);
          }
          nmgp_Trunc_Num($rt->fields[25], 2);
          $rt->fields[26] = str_replace(",", ".", $rt->fields[26]);
          $rt->fields[26] = (strpos(strtolower($rt->fields[26]), "e")) ? (float)$rt->fields[26] : $rt->fields[26]; 
          $rt->fields[26] = (string)$rt->fields[26];
          if ($rt->fields[26] == "") 
          {
              $rt->fields[26] = 0;
          }
          if (substr($rt->fields[26], 0, 1) == ".") 
          {
              $rt->fields[26] = "0" . $rt->fields[26];
          }
          if (substr($rt->fields[26], 0, 2) == "-.") 
          {
              $rt->fields[26] = "-0" . substr($rt->fields[26], 1);
          }
          nmgp_Trunc_Num($rt->fields[26], 2);
          $rt->fields[27] = str_replace(",", ".", $rt->fields[27]);
          $rt->fields[27] = (strpos(strtolower($rt->fields[27]), "e")) ? (float)$rt->fields[27] : $rt->fields[27]; 
          $rt->fields[27] = (string)$rt->fields[27];
          if ($rt->fields[27] == "") 
          {
              $rt->fields[27] = 0;
          }
          if (substr($rt->fields[27], 0, 1) == ".") 
          {
              $rt->fields[27] = "0" . $rt->fields[27];
          }
          if (substr($rt->fields[27], 0, 2) == "-.") 
          {
              $rt->fields[27] = "-0" . substr($rt->fields[27], 1);
          }
          nmgp_Trunc_Num($rt->fields[27], 2);
          $rt->fields[28] = str_replace(",", ".", $rt->fields[28]);
          $rt->fields[28] = (strpos(strtolower($rt->fields[28]), "e")) ? (float)$rt->fields[28] : $rt->fields[28]; 
          $rt->fields[28] = (string)$rt->fields[28];
          if ($rt->fields[28] == "") 
          {
              $rt->fields[28] = 0;
          }
          if (substr($rt->fields[28], 0, 1) == ".") 
          {
              $rt->fields[28] = "0" . $rt->fields[28];
          }
          if (substr($rt->fields[28], 0, 2) == "-.") 
          {
              $rt->fields[28] = "-0" . substr($rt->fields[28], 1);
          }
          nmgp_Trunc_Num($rt->fields[28], 2);
          $rt->fields[29] = str_replace(",", ".", $rt->fields[29]);
          $rt->fields[29] = (strpos(strtolower($rt->fields[29]), "e")) ? (float)$rt->fields[29] : $rt->fields[29]; 
          $rt->fields[29] = (string)$rt->fields[29];
          if ($rt->fields[29] == "") 
          {
              $rt->fields[29] = 0;
          }
          if (substr($rt->fields[29], 0, 1) == ".") 
          {
              $rt->fields[29] = "0" . $rt->fields[29];
          }
          if (substr($rt->fields[29], 0, 2) == "-.") 
          {
              $rt->fields[29] = "-0" . substr($rt->fields[29], 1);
          }
          nmgp_Trunc_Num($rt->fields[29], 2);
          $rt->fields[30] = str_replace(",", ".", $rt->fields[30]);
          $rt->fields[30] = (strpos(strtolower($rt->fields[30]), "e")) ? (float)$rt->fields[30] : $rt->fields[30]; 
          $rt->fields[30] = (string)$rt->fields[30];
          if ($rt->fields[30] == "") 
          {
              $rt->fields[30] = 0;
          }
          if (substr($rt->fields[30], 0, 1) == ".") 
          {
              $rt->fields[30] = "0" . $rt->fields[30];
          }
          if (substr($rt->fields[30], 0, 2) == "-.") 
          {
              $rt->fields[30] = "-0" . substr($rt->fields[30], 1);
          }
          nmgp_Trunc_Num($rt->fields[30], 2);
          $rt->fields[31] = str_replace(",", ".", $rt->fields[31]);
          $rt->fields[31] = (strpos(strtolower($rt->fields[31]), "e")) ? (float)$rt->fields[31] : $rt->fields[31]; 
          $rt->fields[31] = (string)$rt->fields[31];
          if ($rt->fields[31] == "") 
          {
              $rt->fields[31] = 0;
          }
          if (substr($rt->fields[31], 0, 1) == ".") 
          {
              $rt->fields[31] = "0" . $rt->fields[31];
          }
          if (substr($rt->fields[31], 0, 2) == "-.") 
          {
              $rt->fields[31] = "-0" . substr($rt->fields[31], 1);
          }
          nmgp_Trunc_Num($rt->fields[31], 2);
          $rt->fields[32] = str_replace(",", ".", $rt->fields[32]);
          $rt->fields[32] = (strpos(strtolower($rt->fields[32]), "e")) ? (float)$rt->fields[32] : $rt->fields[32]; 
          $rt->fields[32] = (string)$rt->fields[32];
          if ($rt->fields[32] == "") 
          {
              $rt->fields[32] = 0;
          }
          if (substr($rt->fields[32], 0, 1) == ".") 
          {
              $rt->fields[32] = "0" . $rt->fields[32];
          }
          if (substr($rt->fields[32], 0, 2) == "-.") 
          {
              $rt->fields[32] = "-0" . substr($rt->fields[32], 1);
          }
          nmgp_Trunc_Num($rt->fields[32], 2);
          $rt->fields[33] = str_replace(",", ".", $rt->fields[33]);
          $rt->fields[33] = (strpos(strtolower($rt->fields[33]), "e")) ? (float)$rt->fields[33] : $rt->fields[33]; 
          $rt->fields[33] = (string)$rt->fields[33];
          if ($rt->fields[33] == "") 
          {
              $rt->fields[33] = 0;
          }
          if (substr($rt->fields[33], 0, 1) == ".") 
          {
              $rt->fields[33] = "0" . $rt->fields[33];
          }
          if (substr($rt->fields[33], 0, 2) == "-.") 
          {
              $rt->fields[33] = "-0" . substr($rt->fields[33], 1);
          }
          nmgp_Trunc_Num($rt->fields[33], 2);
          $rt->fields[34] = str_replace(",", ".", $rt->fields[34]);
          $rt->fields[34] = (strpos(strtolower($rt->fields[34]), "e")) ? (float)$rt->fields[34] : $rt->fields[34]; 
          $rt->fields[34] = (string)$rt->fields[34];
          if ($rt->fields[34] == "") 
          {
              $rt->fields[34] = 0;
          }
          if (substr($rt->fields[34], 0, 1) == ".") 
          {
              $rt->fields[34] = "0" . $rt->fields[34];
          }
          if (substr($rt->fields[34], 0, 2) == "-.") 
          {
              $rt->fields[34] = "-0" . substr($rt->fields[34], 1);
          }
          nmgp_Trunc_Num($rt->fields[34], 2);
          $rt->fields[35] = str_replace(",", ".", $rt->fields[35]);
          $rt->fields[35] = (strpos(strtolower($rt->fields[35]), "e")) ? (float)$rt->fields[35] : $rt->fields[35]; 
          $rt->fields[35] = (string)$rt->fields[35];
          if ($rt->fields[35] == "") 
          {
              $rt->fields[35] = 0;
          }
          if (substr($rt->fields[35], 0, 1) == ".") 
          {
              $rt->fields[35] = "0" . $rt->fields[35];
          }
          if (substr($rt->fields[35], 0, 2) == "-.") 
          {
              $rt->fields[35] = "-0" . substr($rt->fields[35], 1);
          }
          nmgp_Trunc_Num($rt->fields[35], 2);
          $rt->fields[36] = str_replace(",", ".", $rt->fields[36]);
          $rt->fields[36] = (strpos(strtolower($rt->fields[36]), "e")) ? (float)$rt->fields[36] : $rt->fields[36]; 
          $rt->fields[36] = (string)$rt->fields[36];
          if ($rt->fields[36] == "") 
          {
              $rt->fields[36] = 0;
          }
          if (substr($rt->fields[36], 0, 1) == ".") 
          {
              $rt->fields[36] = "0" . $rt->fields[36];
          }
          if (substr($rt->fields[36], 0, 2) == "-.") 
          {
              $rt->fields[36] = "-0" . substr($rt->fields[36], 1);
          }
          nmgp_Trunc_Num($rt->fields[36], 2);
          $rt->fields[37] = str_replace(",", ".", $rt->fields[37]);
          $rt->fields[37] = (strpos(strtolower($rt->fields[37]), "e")) ? (float)$rt->fields[37] : $rt->fields[37]; 
          $rt->fields[37] = (string)$rt->fields[37];
          if ($rt->fields[37] == "") 
          {
              $rt->fields[37] = 0;
          }
          if (substr($rt->fields[37], 0, 1) == ".") 
          {
              $rt->fields[37] = "0" . $rt->fields[37];
          }
          if (substr($rt->fields[37], 0, 2) == "-.") 
          {
              $rt->fields[37] = "-0" . substr($rt->fields[37], 1);
          }
          nmgp_Trunc_Num($rt->fields[37], 2);
          $rt->fields[38] = str_replace(",", ".", $rt->fields[38]);
          $rt->fields[38] = (strpos(strtolower($rt->fields[38]), "e")) ? (float)$rt->fields[38] : $rt->fields[38]; 
          $rt->fields[38] = (string)$rt->fields[38];
          if ($rt->fields[38] == "") 
          {
              $rt->fields[38] = 0;
          }
          if (substr($rt->fields[38], 0, 1) == ".") 
          {
              $rt->fields[38] = "0" . $rt->fields[38];
          }
          if (substr($rt->fields[38], 0, 2) == "-.") 
          {
              $rt->fields[38] = "-0" . substr($rt->fields[38], 1);
          }
          nmgp_Trunc_Num($rt->fields[38], 2);
          $rt->fields[39] = str_replace(",", ".", $rt->fields[39]);
          $rt->fields[39] = (strpos(strtolower($rt->fields[39]), "e")) ? (float)$rt->fields[39] : $rt->fields[39]; 
          $rt->fields[39] = (string)$rt->fields[39];
          if ($rt->fields[39] == "") 
          {
              $rt->fields[39] = 0;
          }
          if (substr($rt->fields[39], 0, 1) == ".") 
          {
              $rt->fields[39] = "0" . $rt->fields[39];
          }
          if (substr($rt->fields[39], 0, 2) == "-.") 
          {
              $rt->fields[39] = "-0" . substr($rt->fields[39], 1);
          }
          nmgp_Trunc_Num($rt->fields[39], 2);
          $rt->fields[40] = str_replace(",", ".", $rt->fields[40]);
          $rt->fields[40] = (strpos(strtolower($rt->fields[40]), "e")) ? (float)$rt->fields[40] : $rt->fields[40]; 
          $rt->fields[40] = (string)$rt->fields[40];
          if ($rt->fields[40] == "") 
          {
              $rt->fields[40] = 0;
          }
          if (substr($rt->fields[40], 0, 1) == ".") 
          {
              $rt->fields[40] = "0" . $rt->fields[40];
          }
          if (substr($rt->fields[40], 0, 2) == "-.") 
          {
              $rt->fields[40] = "-0" . substr($rt->fields[40], 1);
          }
          nmgp_Trunc_Num($rt->fields[40], 2);
          $rt->fields[41] = str_replace(",", ".", $rt->fields[41]);
          $rt->fields[41] = (strpos(strtolower($rt->fields[41]), "e")) ? (float)$rt->fields[41] : $rt->fields[41]; 
          $rt->fields[41] = (string)$rt->fields[41];
          if ($rt->fields[41] == "") 
          {
              $rt->fields[41] = 0;
          }
          if (substr($rt->fields[41], 0, 1) == ".") 
          {
              $rt->fields[41] = "0" . $rt->fields[41];
          }
          if (substr($rt->fields[41], 0, 2) == "-.") 
          {
              $rt->fields[41] = "-0" . substr($rt->fields[41], 1);
          }
          nmgp_Trunc_Num($rt->fields[41], 2);
          $str_tot = "array_total_" . $cmp_tot;
          if (!isset($this->$str_tot))
          {
              $this->$str_tot = array();
          }
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[0]";
          eval ('$this->' . $str_tot . ' = ' . $rt->fields[0] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[13]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[1] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[16]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[2] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[19]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[3] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[22]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[4] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[25]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[5] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[26]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[6] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[27]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[7] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[28]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[8] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[29]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[9] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[30]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[10] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[31]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[11] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[32]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[12] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[33]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[13] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[34]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[14] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[35]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[15] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[36]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[16] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[37]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[17] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[38]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[18] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[39]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[19] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[40]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[20] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[1]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[22] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[2]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[23] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[3]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[24] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[4]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[25] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[5]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[26] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[6]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[27] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[7]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[28] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[8]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[29] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[9]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[30] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[10]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[31] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[11]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[32] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[12]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[33] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[14]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[34] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[15]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[35] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[17]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[36] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[18]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[37] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[20]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[38] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[21]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[39] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[23]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[40] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[24]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[41] . ';');
          $str_grf = "val_grafico_" . $cmp_tot;
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[42]";
          eval ('$this->' . $str_tot . ' = $' . $str_grf . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[43]";
          $str_org = $cmp_tot . "_orig";
          eval ('$this->' . $str_tot . ' = $' . $str_org . ';');
          eval ('ksort($this->array_total_' . $cmp_tot . $arr_tots . ');');
          $rt->MoveNext();
      }
      $rt->Close();
   }
   //---- 
   function quebra_geral_sc_free_group_by($res_limit=false, $res_export=false)
   {
      global $nada, $nm_lang ;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'] = array() ;  
      $nm_comando = "select count(*), sum(sal_brut_reg), sum(income_workday_ot), sum(income_holiday_ot), sum(income_restday_ot), sum(income_offday_ot), sum(incentive), sum(income_comm), sum(rappel), sum(tax_cass), sum(tax_cfgdct), sum(tax_fdu), sum(tax_iris), sum(tax_ona), sum(tax_iric), sum(dedeuct_cons), sum(loan_deduction), sum(loan_deduction_bank), sum(other_deduct), sum(total_deduct), sum(sal_net), count(distinct userid_int), count(userid_int), sum(Rate_SALF), sum(Rate_Work), sum(income_workday), sum(income_holiday), sum(income_restday), sum(income_offday), sum(hh_sunday), sum(sal_sunday), sum(hh_offday), sum(sal_holiday), sum(sal_leavetype), sum(ot_hh_w), sum(ot_hh_w_PM), sum(ot_hh_h), sum(ot_hh_h_PM), sum(ot_hh_r), sum(ot_hh_r_PM), sum(ot_hh_o), sum(ot_hh_o_PM) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['where_pesq']; 
      $nm_comando = $this->Ajust_statistic($nm_comando);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      if ((isset($this->Ini->nm_bases_vfp) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_vfp)) || (isset($this->Ini->nm_bases_odbc) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_odbc)))
      {
          $vl_statistic = $this->Calc_statist_manual_sc_free_group_by($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['where_pesq']);
          foreach ($vl_statistic as $ind => $val)
          {
              $rt->fields[$ind] = $val;
          }
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $vl_statistic = $this->Calc_statist_manual_sc_free_group_by($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['where_pesq']);
          foreach ($vl_statistic as $ind => $val)
          {
              $rt->fields[$ind] = $val;
          }
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $rt->fields[1] = (string)$rt->fields[1]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][2] = $rt->fields[1]; 
      $rt->fields[2] = str_replace(",", ".", $rt->fields[2]);
      $rt->fields[2] = (string)$rt->fields[2]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][3] = $rt->fields[2]; 
      $rt->fields[3] = str_replace(",", ".", $rt->fields[3]);
      $rt->fields[3] = (string)$rt->fields[3]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][4] = $rt->fields[3]; 
      $rt->fields[4] = str_replace(",", ".", $rt->fields[4]);
      $rt->fields[4] = (string)$rt->fields[4]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][5] = $rt->fields[4]; 
      $rt->fields[5] = str_replace(",", ".", $rt->fields[5]);
      $rt->fields[5] = (string)$rt->fields[5]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][6] = $rt->fields[5]; 
      $rt->fields[6] = str_replace(",", ".", $rt->fields[6]);
      $rt->fields[6] = (string)$rt->fields[6]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][7] = $rt->fields[6]; 
      $rt->fields[7] = str_replace(",", ".", $rt->fields[7]);
      $rt->fields[7] = (string)$rt->fields[7]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][8] = $rt->fields[7]; 
      $rt->fields[8] = str_replace(",", ".", $rt->fields[8]);
      $rt->fields[8] = (string)$rt->fields[8]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][9] = $rt->fields[8]; 
      $rt->fields[9] = str_replace(",", ".", $rt->fields[9]);
      $rt->fields[9] = (string)$rt->fields[9]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][10] = $rt->fields[9]; 
      $rt->fields[10] = str_replace(",", ".", $rt->fields[10]);
      $rt->fields[10] = (string)$rt->fields[10]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][11] = $rt->fields[10]; 
      $rt->fields[11] = str_replace(",", ".", $rt->fields[11]);
      $rt->fields[11] = (string)$rt->fields[11]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][12] = $rt->fields[11]; 
      $rt->fields[12] = str_replace(",", ".", $rt->fields[12]);
      $rt->fields[12] = (string)$rt->fields[12]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][13] = $rt->fields[12]; 
      $rt->fields[13] = str_replace(",", ".", $rt->fields[13]);
      $rt->fields[13] = (string)$rt->fields[13]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][14] = $rt->fields[13]; 
      $rt->fields[14] = str_replace(",", ".", $rt->fields[14]);
      $rt->fields[14] = (string)$rt->fields[14]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][15] = $rt->fields[14]; 
      $rt->fields[15] = str_replace(",", ".", $rt->fields[15]);
      $rt->fields[15] = (string)$rt->fields[15]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][16] = $rt->fields[15]; 
      $rt->fields[16] = str_replace(",", ".", $rt->fields[16]);
      $rt->fields[16] = (string)$rt->fields[16]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][17] = $rt->fields[16]; 
      $rt->fields[17] = str_replace(",", ".", $rt->fields[17]);
      $rt->fields[17] = (string)$rt->fields[17]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][18] = $rt->fields[17]; 
      $rt->fields[18] = str_replace(",", ".", $rt->fields[18]);
      $rt->fields[18] = (string)$rt->fields[18]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][19] = $rt->fields[18]; 
      $rt->fields[19] = str_replace(",", ".", $rt->fields[19]);
      $rt->fields[19] = (string)$rt->fields[19]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][20] = $rt->fields[19]; 
      $rt->fields[20] = str_replace(",", ".", $rt->fields[20]);
      $rt->fields[20] = (string)$rt->fields[20]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][21] = $rt->fields[20]; 
      $rt->fields[21] = str_replace(",", ".", $rt->fields[21]);
      $rt->fields[21] = (string)$rt->fields[21]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][22] = $rt->fields[21]; 
      $rt->fields[22] = str_replace(",", ".", $rt->fields[22]);
      $rt->fields[22] = (string)$rt->fields[22]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][23] = $rt->fields[22]; 
      $rt->fields[23] = str_replace(",", ".", $rt->fields[23]);
      $rt->fields[23] = (string)$rt->fields[23]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][24] = $rt->fields[23]; 
      $rt->fields[24] = str_replace(",", ".", $rt->fields[24]);
      $rt->fields[24] = (string)$rt->fields[24]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][25] = $rt->fields[24]; 
      $rt->fields[25] = str_replace(",", ".", $rt->fields[25]);
      $rt->fields[25] = (string)$rt->fields[25]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][26] = $rt->fields[25]; 
      $rt->fields[26] = str_replace(",", ".", $rt->fields[26]);
      $rt->fields[26] = (string)$rt->fields[26]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][27] = $rt->fields[26]; 
      $rt->fields[27] = str_replace(",", ".", $rt->fields[27]);
      $rt->fields[27] = (string)$rt->fields[27]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][28] = $rt->fields[27]; 
      $rt->fields[28] = str_replace(",", ".", $rt->fields[28]);
      $rt->fields[28] = (string)$rt->fields[28]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][29] = $rt->fields[28]; 
      $rt->fields[29] = str_replace(",", ".", $rt->fields[29]);
      $rt->fields[29] = (string)$rt->fields[29]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][30] = $rt->fields[29]; 
      $rt->fields[30] = str_replace(",", ".", $rt->fields[30]);
      $rt->fields[30] = (string)$rt->fields[30]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][31] = $rt->fields[30]; 
      $rt->fields[31] = str_replace(",", ".", $rt->fields[31]);
      $rt->fields[31] = (string)$rt->fields[31]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][32] = $rt->fields[31]; 
      $rt->fields[32] = str_replace(",", ".", $rt->fields[32]);
      $rt->fields[32] = (string)$rt->fields[32]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][33] = $rt->fields[32]; 
      $rt->fields[33] = str_replace(",", ".", $rt->fields[33]);
      $rt->fields[33] = (string)$rt->fields[33]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][34] = $rt->fields[33]; 
      $rt->fields[34] = str_replace(",", ".", $rt->fields[34]);
      $rt->fields[34] = (string)$rt->fields[34]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][35] = $rt->fields[34]; 
      $rt->fields[35] = str_replace(",", ".", $rt->fields[35]);
      $rt->fields[35] = (string)$rt->fields[35]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][36] = $rt->fields[35]; 
      $rt->fields[36] = str_replace(",", ".", $rt->fields[36]);
      $rt->fields[36] = (string)$rt->fields[36]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][37] = $rt->fields[36]; 
      $rt->fields[37] = str_replace(",", ".", $rt->fields[37]);
      $rt->fields[37] = (string)$rt->fields[37]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][38] = $rt->fields[37]; 
      $rt->fields[38] = str_replace(",", ".", $rt->fields[38]);
      $rt->fields[38] = (string)$rt->fields[38]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][39] = $rt->fields[38]; 
      $rt->fields[39] = str_replace(",", ".", $rt->fields[39]);
      $rt->fields[39] = (string)$rt->fields[39]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][40] = $rt->fields[39]; 
      $rt->fields[40] = str_replace(",", ".", $rt->fields[40]);
      $rt->fields[40] = (string)$rt->fields[40]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][41] = $rt->fields[40]; 
      $rt->fields[41] = str_replace(",", ".", $rt->fields[41]);
      $rt->fields[41] = (string)$rt->fields[41]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][42] = $rt->fields[41]; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['contr_total_geral'] = "OK";
   } 


   function Calc_statist_manual_sc_free_group_by($sql_where="")
   {
       $comando  = "select userid_int from " . $this->Ini->nm_tabela . "  " .  $sql_where;
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando;
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
       if (!$rstat = $this->Db->Execute($comando))
       {
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit;
       }
       $cmp_0 = array();
       while (!$rstat->EOF)
       {
           $rstat->fields[0] = str_replace(",", ".", $rstat->fields[0]);
           $cmp_0[] = $rstat->fields[0];
           $rstat->MoveNext();
       }
       $rstat->Close();
       $arr_result = array();
       $tmp = sc_statistic($cmp_0, $this->Ini->nm_tp_variance);
       $arr_result[21] = $tmp[5];
       return $arr_result;
   }
   //---- 
   function quebra_geral__NM_SC_($res_limit=false, $res_export=false)
   {
      global $nada, $nm_lang ;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'] = array() ;  
      $nm_comando = "select count(*), sum(sal_brut_reg), sum(income_workday_ot), sum(income_holiday_ot), sum(income_restday_ot), sum(income_offday_ot), sum(incentive), sum(income_comm), sum(rappel), sum(tax_cass), sum(tax_cfgdct), sum(tax_fdu), sum(tax_iris), sum(tax_ona), sum(tax_iric), sum(dedeuct_cons), sum(loan_deduction), sum(loan_deduction_bank), sum(other_deduct), sum(total_deduct), sum(sal_net), sum(Rate_SALF), sum(Rate_Work), sum(income_workday), sum(income_holiday), sum(income_restday), sum(income_offday), sum(hh_sunday), sum(sal_sunday), sum(hh_offday), sum(sal_holiday), sum(sal_leavetype), sum(ot_hh_w), sum(ot_hh_w_PM), sum(ot_hh_h), sum(ot_hh_h_PM), sum(ot_hh_r), sum(ot_hh_r_PM), sum(ot_hh_o), sum(ot_hh_o_PM) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['where_pesq']; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $rt->fields[1] = (string)$rt->fields[1]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][2] = $rt->fields[1]; 
      $rt->fields[2] = str_replace(",", ".", $rt->fields[2]);
      $rt->fields[2] = (string)$rt->fields[2]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][3] = $rt->fields[2]; 
      $rt->fields[3] = str_replace(",", ".", $rt->fields[3]);
      $rt->fields[3] = (string)$rt->fields[3]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][4] = $rt->fields[3]; 
      $rt->fields[4] = str_replace(",", ".", $rt->fields[4]);
      $rt->fields[4] = (string)$rt->fields[4]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][5] = $rt->fields[4]; 
      $rt->fields[5] = str_replace(",", ".", $rt->fields[5]);
      $rt->fields[5] = (string)$rt->fields[5]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][6] = $rt->fields[5]; 
      $rt->fields[6] = str_replace(",", ".", $rt->fields[6]);
      $rt->fields[6] = (string)$rt->fields[6]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][7] = $rt->fields[6]; 
      $rt->fields[7] = str_replace(",", ".", $rt->fields[7]);
      $rt->fields[7] = (string)$rt->fields[7]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][8] = $rt->fields[7]; 
      $rt->fields[8] = str_replace(",", ".", $rt->fields[8]);
      $rt->fields[8] = (string)$rt->fields[8]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][9] = $rt->fields[8]; 
      $rt->fields[9] = str_replace(",", ".", $rt->fields[9]);
      $rt->fields[9] = (string)$rt->fields[9]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][10] = $rt->fields[9]; 
      $rt->fields[10] = str_replace(",", ".", $rt->fields[10]);
      $rt->fields[10] = (string)$rt->fields[10]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][11] = $rt->fields[10]; 
      $rt->fields[11] = str_replace(",", ".", $rt->fields[11]);
      $rt->fields[11] = (string)$rt->fields[11]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][12] = $rt->fields[11]; 
      $rt->fields[12] = str_replace(",", ".", $rt->fields[12]);
      $rt->fields[12] = (string)$rt->fields[12]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][13] = $rt->fields[12]; 
      $rt->fields[13] = str_replace(",", ".", $rt->fields[13]);
      $rt->fields[13] = (string)$rt->fields[13]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][14] = $rt->fields[13]; 
      $rt->fields[14] = str_replace(",", ".", $rt->fields[14]);
      $rt->fields[14] = (string)$rt->fields[14]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][15] = $rt->fields[14]; 
      $rt->fields[15] = str_replace(",", ".", $rt->fields[15]);
      $rt->fields[15] = (string)$rt->fields[15]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][16] = $rt->fields[15]; 
      $rt->fields[16] = str_replace(",", ".", $rt->fields[16]);
      $rt->fields[16] = (string)$rt->fields[16]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][17] = $rt->fields[16]; 
      $rt->fields[17] = str_replace(",", ".", $rt->fields[17]);
      $rt->fields[17] = (string)$rt->fields[17]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][18] = $rt->fields[17]; 
      $rt->fields[18] = str_replace(",", ".", $rt->fields[18]);
      $rt->fields[18] = (string)$rt->fields[18]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][19] = $rt->fields[18]; 
      $rt->fields[19] = str_replace(",", ".", $rt->fields[19]);
      $rt->fields[19] = (string)$rt->fields[19]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][20] = $rt->fields[19]; 
      $rt->fields[20] = str_replace(",", ".", $rt->fields[20]);
      $rt->fields[20] = (string)$rt->fields[20]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][21] = $rt->fields[20]; 
      $rt->fields[21] = str_replace(",", ".", $rt->fields[21]);
      $rt->fields[21] = (string)$rt->fields[21]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][22] = $rt->fields[21]; 
      $rt->fields[22] = str_replace(",", ".", $rt->fields[22]);
      $rt->fields[22] = (string)$rt->fields[22]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][23] = $rt->fields[22]; 
      $rt->fields[23] = str_replace(",", ".", $rt->fields[23]);
      $rt->fields[23] = (string)$rt->fields[23]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][24] = $rt->fields[23]; 
      $rt->fields[24] = str_replace(",", ".", $rt->fields[24]);
      $rt->fields[24] = (string)$rt->fields[24]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][25] = $rt->fields[24]; 
      $rt->fields[25] = str_replace(",", ".", $rt->fields[25]);
      $rt->fields[25] = (string)$rt->fields[25]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][26] = $rt->fields[25]; 
      $rt->fields[26] = str_replace(",", ".", $rt->fields[26]);
      $rt->fields[26] = (string)$rt->fields[26]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][27] = $rt->fields[26]; 
      $rt->fields[27] = str_replace(",", ".", $rt->fields[27]);
      $rt->fields[27] = (string)$rt->fields[27]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][28] = $rt->fields[27]; 
      $rt->fields[28] = str_replace(",", ".", $rt->fields[28]);
      $rt->fields[28] = (string)$rt->fields[28]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][29] = $rt->fields[28]; 
      $rt->fields[29] = str_replace(",", ".", $rt->fields[29]);
      $rt->fields[29] = (string)$rt->fields[29]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][30] = $rt->fields[29]; 
      $rt->fields[30] = str_replace(",", ".", $rt->fields[30]);
      $rt->fields[30] = (string)$rt->fields[30]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][31] = $rt->fields[30]; 
      $rt->fields[31] = str_replace(",", ".", $rt->fields[31]);
      $rt->fields[31] = (string)$rt->fields[31]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][32] = $rt->fields[31]; 
      $rt->fields[32] = str_replace(",", ".", $rt->fields[32]);
      $rt->fields[32] = (string)$rt->fields[32]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][33] = $rt->fields[32]; 
      $rt->fields[33] = str_replace(",", ".", $rt->fields[33]);
      $rt->fields[33] = (string)$rt->fields[33]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][34] = $rt->fields[33]; 
      $rt->fields[34] = str_replace(",", ".", $rt->fields[34]);
      $rt->fields[34] = (string)$rt->fields[34]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][35] = $rt->fields[34]; 
      $rt->fields[35] = str_replace(",", ".", $rt->fields[35]);
      $rt->fields[35] = (string)$rt->fields[35]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][36] = $rt->fields[35]; 
      $rt->fields[36] = str_replace(",", ".", $rt->fields[36]);
      $rt->fields[36] = (string)$rt->fields[36]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][37] = $rt->fields[36]; 
      $rt->fields[37] = str_replace(",", ".", $rt->fields[37]);
      $rt->fields[37] = (string)$rt->fields[37]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][38] = $rt->fields[37]; 
      $rt->fields[38] = str_replace(",", ".", $rt->fields[38]);
      $rt->fields[38] = (string)$rt->fields[38]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][39] = $rt->fields[38]; 
      $rt->fields[39] = str_replace(",", ".", $rt->fields[39]);
      $rt->fields[39] = (string)$rt->fields[39]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['tot_geral'][40] = $rt->fields[39]; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['contr_total_geral'] = "OK";
   } 

   //-----  dept
   function quebra_dept_sc_free_group_by($dept, $Where_qb, $Cmp_Name) 
   {
      $Var_name_gb = "SC_tot_" . $Cmp_Name;
      global $$Var_name_gb;
      $tot_dept = array() ;  
      $nm_comando = "select count(*), sum(sal_brut_reg), sum(income_workday_ot), sum(income_holiday_ot), sum(income_restday_ot), sum(income_offday_ot), sum(incentive), sum(income_comm), sum(rappel), sum(tax_cass), sum(tax_cfgdct), sum(tax_fdu), sum(tax_iris), sum(tax_ona), sum(tax_iric), sum(dedeuct_cons), sum(loan_deduction), sum(loan_deduction_bank), sum(other_deduct), sum(total_deduct), sum(sal_net), count(distinct userid_int), count(userid_int), sum(Rate_SALF), sum(Rate_Work), sum(income_workday), sum(income_holiday), sum(income_restday), sum(income_offday), sum(hh_sunday), sum(sal_sunday), sum(hh_offday), sum(sal_holiday), sum(sal_leavetype), sum(ot_hh_w), sum(ot_hh_w_PM), sum(ot_hh_h), sum(ot_hh_h_PM), sum(ot_hh_r), sum(ot_hh_r_PM), sum(ot_hh_o), sum(ot_hh_o_PM) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['where_pesq']; 
      $nm_comando = $this->Ajust_statistic($nm_comando);
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['where_pesq'])) 
      { 
         $nm_comando .= " where " . $Where_qb ; 
      } 
      else 
      { 
         $nm_comando .= " and " . $Where_qb ; 
      } 
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['where_pesq'])) 
      { 
         $where_ok = " where " . $Where_qb ; 
      } 
      else 
      { 
         $where_ok = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['where_pesq'] . " and " . $Where_qb ; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }  
      if ((isset($this->Ini->nm_bases_vfp) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_vfp)) || (isset($this->Ini->nm_bases_odbc) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_odbc)))
      {
          $vl_statistic = $this->Calc_statist_manual_sc_free_group_by($where_ok);
          foreach ($vl_statistic as $ind => $val)
          {
              $rt->fields[$ind] = $val;
          }
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $vl_statistic = $this->Calc_statist_manual_sc_free_group_by($where_ok);
          foreach ($vl_statistic as $ind => $val)
          {
              $rt->fields[$ind] = $val;
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_qry_payroll_details_V2']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
          $tot_dept[0] = NM_encode_input(sc_strip_script($dept));
      }
      else {
          $tot_dept[0] = sc_strip_script($dept) ; 
      }
      $tot_dept[1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $tot_dept[2] = (string)$rt->fields[1]; 
      $rt->fields[2] = str_replace(",", ".", $rt->fields[2]);
      $tot_dept[3] = (string)$rt->fields[2]; 
      $rt->fields[3] = str_replace(",", ".", $rt->fields[3]);
      $tot_dept[4] = (string)$rt->fields[3]; 
      $rt->fields[4] = str_replace(",", ".", $rt->fields[4]);
      $tot_dept[5] = (string)$rt->fields[4]; 
      $rt->fields[5] = str_replace(",", ".", $rt->fields[5]);
      $tot_dept[6] = (string)$rt->fields[5]; 
      $rt->fields[6] = str_replace(",", ".", $rt->fields[6]);
      $tot_dept[7] = (string)$rt->fields[6]; 
      $rt->fields[7] = str_replace(",", ".", $rt->fields[7]);
      $tot_dept[8] = (string)$rt->fields[7]; 
      $rt->fields[8] = str_replace(",", ".", $rt->fields[8]);
      $tot_dept[9] = (string)$rt->fields[8]; 
      $rt->fields[9] = str_replace(",", ".", $rt->fields[9]);
      $tot_dept[10] = (string)$rt->fields[9]; 
      $rt->fields[10] = str_replace(",", ".", $rt->fields[10]);
      $tot_dept[11] = (string)$rt->fields[10]; 
      $rt->fields[11] = str_replace(",", ".", $rt->fields[11]);
      $tot_dept[12] = (string)$rt->fields[11]; 
      $rt->fields[12] = str_replace(",", ".", $rt->fields[12]);
      $tot_dept[13] = (string)$rt->fields[12]; 
      $rt->fields[13] = str_replace(",", ".", $rt->fields[13]);
      $tot_dept[14] = (string)$rt->fields[13]; 
      $rt->fields[14] = str_replace(",", ".", $rt->fields[14]);
      $tot_dept[15] = (string)$rt->fields[14]; 
      $rt->fields[15] = str_replace(",", ".", $rt->fields[15]);
      $tot_dept[16] = (string)$rt->fields[15]; 
      $rt->fields[16] = str_replace(",", ".", $rt->fields[16]);
      $tot_dept[17] = (string)$rt->fields[16]; 
      $rt->fields[17] = str_replace(",", ".", $rt->fields[17]);
      $tot_dept[18] = (string)$rt->fields[17]; 
      $rt->fields[18] = str_replace(",", ".", $rt->fields[18]);
      $tot_dept[19] = (string)$rt->fields[18]; 
      $rt->fields[19] = str_replace(",", ".", $rt->fields[19]);
      $tot_dept[20] = (string)$rt->fields[19]; 
      $rt->fields[20] = str_replace(",", ".", $rt->fields[20]);
      $tot_dept[21] = (string)$rt->fields[20]; 
      $rt->fields[21] = str_replace(",", ".", $rt->fields[21]);
      $tot_dept[22] = (string)$rt->fields[21]; 
      $rt->fields[22] = str_replace(",", ".", $rt->fields[22]);
      $tot_dept[23] = (string)$rt->fields[22]; 
      $rt->fields[23] = str_replace(",", ".", $rt->fields[23]);
      $tot_dept[24] = (string)$rt->fields[23]; 
      $rt->fields[24] = str_replace(",", ".", $rt->fields[24]);
      $tot_dept[25] = (string)$rt->fields[24]; 
      $rt->fields[25] = str_replace(",", ".", $rt->fields[25]);
      $tot_dept[26] = (string)$rt->fields[25]; 
      $rt->fields[26] = str_replace(",", ".", $rt->fields[26]);
      $tot_dept[27] = (string)$rt->fields[26]; 
      $rt->fields[27] = str_replace(",", ".", $rt->fields[27]);
      $tot_dept[28] = (string)$rt->fields[27]; 
      $rt->fields[28] = str_replace(",", ".", $rt->fields[28]);
      $tot_dept[29] = (string)$rt->fields[28]; 
      $rt->fields[29] = str_replace(",", ".", $rt->fields[29]);
      $tot_dept[30] = (string)$rt->fields[29]; 
      $rt->fields[30] = str_replace(",", ".", $rt->fields[30]);
      $tot_dept[31] = (string)$rt->fields[30]; 
      $rt->fields[31] = str_replace(",", ".", $rt->fields[31]);
      $tot_dept[32] = (string)$rt->fields[31]; 
      $rt->fields[32] = str_replace(",", ".", $rt->fields[32]);
      $tot_dept[33] = (string)$rt->fields[32]; 
      $rt->fields[33] = str_replace(",", ".", $rt->fields[33]);
      $tot_dept[34] = (string)$rt->fields[33]; 
      $rt->fields[34] = str_replace(",", ".", $rt->fields[34]);
      $tot_dept[35] = (string)$rt->fields[34]; 
      $rt->fields[35] = str_replace(",", ".", $rt->fields[35]);
      $tot_dept[36] = (string)$rt->fields[35]; 
      $rt->fields[36] = str_replace(",", ".", $rt->fields[36]);
      $tot_dept[37] = (string)$rt->fields[36]; 
      $rt->fields[37] = str_replace(",", ".", $rt->fields[37]);
      $tot_dept[38] = (string)$rt->fields[37]; 
      $rt->fields[38] = str_replace(",", ".", $rt->fields[38]);
      $tot_dept[39] = (string)$rt->fields[38]; 
      $rt->fields[39] = str_replace(",", ".", $rt->fields[39]);
      $tot_dept[40] = (string)$rt->fields[39]; 
      $rt->fields[40] = str_replace(",", ".", $rt->fields[40]);
      $tot_dept[41] = (string)$rt->fields[40]; 
      $rt->fields[41] = str_replace(",", ".", $rt->fields[41]);
      $tot_dept[42] = (string)$rt->fields[41]; 
      $rt->Close(); 
      $$Var_name_gb = $tot_dept;
   } 

   function Ajust_statistic($comando)
   {
      if ((isset($this->Ini->nm_bases_vfp) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_vfp)) || (isset($this->Ini->nm_bases_odbc) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_odbc)))
      {
          $comando = str_replace(array('count(distinct ','varp(','stdevp(','variance(','stddev('), array('sum(','sum(','sum(','sum(','sum('), $comando);
      }
      if ($this->Ini->nm_tp_variance == "P")
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite) && $this->Ini->sqlite_version == "old")
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
      }
      if ($this->Ini->nm_tp_variance == "A")
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite) && $this->Ini->sqlite_version == "old")
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_samp(','stddev_samp('), $comando);
          }
      }
      return $comando;
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
function calculate_netincome()
{
$_SESSION['scriptcase']['grid_qry_payroll_details_V2']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_qry_payroll_details_V2']['contr_erro'] = 'off';
}
}

?>
