<?php
//
class form_FicheEmployeeSuspended_mob_apl
{
   var $has_where_params = false;
   var $NM_is_redirected = false;
   var $NM_non_ajax_info = false;
   var $formatado = false;
   var $use_100perc_fields = false;
   var $classes_100perc_fields = array();
   var $close_modal_after_insert = false;
   var $NM_ajax_flag    = false;
   var $NM_ajax_opcao   = '';
   var $NM_ajax_retorno = '';
   var $NM_ajax_info    = array('result'            => '',
                                'param'             => array(),
                                'autoComp'          => '',
                                'rsSize'            => '',
                                'msgDisplay'        => '',
                                'errList'           => array(),
                                'fldList'           => array(),
                                'varList'           => array(),
                                'focus'             => '',
                                'navStatus'         => array(),
                                'navSummary'        => array(),
                                'navPage'           => array(),
                                'redir'             => array(),
                                'blockDisplay'      => array(),
                                'fieldDisplay'      => array(),
                                'fieldLabel'        => array(),
                                'readOnly'          => array(),
                                'btnVars'           => array(),
                                'ajaxAlert'         => array(),
                                'ajaxMessage'       => array(),
                                'ajaxJavascript'    => array(),
                                'buttonDisplay'     => array(),
                                'buttonDisplayVert' => array(),
                                'calendarReload'    => false,
                                'quickSearchRes'    => false,
                                'displayMsg'        => false,
                                'displayMsgTxt'     => '',
                                'dyn_search'        => array(),
                                'empty_filter'      => '',
                                'event_field'       => '',
                                'fieldsWithErrors'  => array(),
                               );
   var $NM_ajax_force_values = false;
   var $captcha_code;
   var $captcha_sent;
   var $Nav_permite_ava     = true;
   var $Nav_permite_ret     = true;
   var $Apl_com_erro        = false;
   var $app_is_initializing = false;
   var $Ini;
   var $Erro;
   var $Db;
   var $id;
   var $userid_int;
   var $userid_varchar;
   var $employee_name;
   var $ic;
   var $address;
   var $phone;
   var $email;
   var $gender;
   var $dob;
   var $hiredate;
   var $firedate;
   var $inactif;
   var $building;
   var $designation;
   var $dept;
   var $section;
   var $photo_name;
   var $photo_name_scfile_name;
   var $photo_name_ul_name;
   var $photo_name_scfile_type;
   var $photo_name_ul_type;
   var $photo_name_limpa;
   var $photo_name_salva;
   var $out_photo_name;
   var $out1_photo_name;
   var $photo_size;
   var $photo_file;
   var $photo_file_scfile_name;
   var $photo_file_ul_name;
   var $photo_file_scfile_type;
   var $photo_file_ul_type;
   var $photo_file_limpa;
   var $photo_file_salva;
   var $out_photo_file;
   var $out1_photo_file;
   var $imm_ona;
   var $no_compte;
   var $type_de_compte;
   var $payperiod;
   var $probation_period;
   var $rate_work;
   var $rate_ot;
   var $rate_ot_factor;
   var $rate_ot_holiday_factor;
   var $rate_ot_offday_factor;
   var $rate_ot_restday_factor;
   var $rate_day;
   var $rate_fixed;
   var $rate_restday;
   var $rate_offday;
   var $rate_commission1;
   var $rate_prime1;
   var $rate_omission1;
   var $rate_assmd;
   var $rate_cass;
   var $tax_cass;
   var $rate_cfgdct;
   var $tax_cfgdct;
   var $rate_ona;
   var $tax_ona;
   var $rate_fdu;
   var $tax_fdu;
   var $rate_iris;
   var $rate_iric;
   var $rate_cons;
   var $day_cons;
   var $revenu_net;
   var $incentive;
   var $incentive_desc;
   var $rappel;
   var $other_deduct;
   var $other_deduct_desc;
   var $loan;
   var $date_loan;
   var $payment;
   var $date_payment;
   var $payment_receipt;
   var $loan_deduction;
   var $loan_description;
   var $loan_start_deduct;
   var $loan_monthlypayment;
   var $loan_end_deduct;
   var $apply_loan_deduction;
   var $loan_bank;
   var $date_loan_bank;
   var $loan_deduction_bank;
   var $loan_start_deduct_bank;
   var $loan_end_deduct_bank;
   var $apply_loan_deduction_bank;
   var $other_loan;
   var $date_other_loan;
   var $other_loan_deduction;
   var $other_loan_description;
   var $other_loan_start_deduct;
   var $other_loan_monthlypayment;
   var $other_loan_end_deduct;
   var $apply_other_loan_deduction;
   var $purchase;
   var $purchase_description;
   var $date_purchase;
   var $purchase_deduct;
   var $purchase_start_deduct;
   var $purchase_monthlypayment;
   var $purchase_end_deduct;
   var $apply_purchase_deduct;
   var $health_insurance;
   var $bank_number;
   var $hiring_duration;
   var $update_time;
   var $update_time_hora;
   var $block_note;
   var $field01;
   var $field02;
   var $field03;
   var $nm_data;
   var $nmgp_opcao;
   var $nmgp_opc_ant;
   var $sc_evento;
   var $sc_insert_on;
   var $nmgp_clone;
   var $nmgp_return_img = array();
   var $nmgp_dados_form = array();
   var $nmgp_dados_select = array();
   var $nm_location;
   var $nm_flag_iframe;
   var $nm_flag_saida_novo;
   var $nmgp_botoes = array();
   var $nmgp_url_saida;
   var $nmgp_form_show;
   var $nmgp_form_empty;
   var $nmgp_cmp_readonly = array();
   var $nmgp_cmp_hidden   = array();
   var $Field_no_validate  = array();
   var $form_paginacao = 'parcial';
   var $lig_edit_lookup      = false;
   var $lig_edit_lookup_call = false;
   var $lig_edit_lookup_cb   = '';
   var $lig_edit_lookup_row  = '';
   var $is_calendar_app = false;
   var $Embutida_call  = false;
   var $Embutida_ronly = false;
   var $Embutida_proc  = false;
   var $Embutida_form  = false;
   var $Grid_editavel  = false;
   var $url_webhelp = '';
   var $nm_todas_criticas;
   var $Campos_Mens_erro;
   var $nm_new_label = array();
   var $record_insert_ok = false;
   var $record_delete_ok = false;
//
//----- 
   function ini_controle()
   {
        global $nm_url_saida, $teste_validade, $script_case_init, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['address']))
          {
              $this->address = $this->NM_ajax_info['param']['address'];
          }
          if (isset($this->NM_ajax_info['param']['block_note']))
          {
              $this->block_note = $this->NM_ajax_info['param']['block_note'];
          }
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['dept']))
          {
              $this->dept = $this->NM_ajax_info['param']['dept'];
          }
          if (isset($this->NM_ajax_info['param']['designation']))
          {
              $this->designation = $this->NM_ajax_info['param']['designation'];
          }
          if (isset($this->NM_ajax_info['param']['dob']))
          {
              $this->dob = $this->NM_ajax_info['param']['dob'];
          }
          if (isset($this->NM_ajax_info['param']['email']))
          {
              $this->email = $this->NM_ajax_info['param']['email'];
          }
          if (isset($this->NM_ajax_info['param']['employee_name']))
          {
              $this->employee_name = $this->NM_ajax_info['param']['employee_name'];
          }
          if (isset($this->NM_ajax_info['param']['field01']))
          {
              $this->field01 = $this->NM_ajax_info['param']['field01'];
          }
          if (isset($this->NM_ajax_info['param']['field02']))
          {
              $this->field02 = $this->NM_ajax_info['param']['field02'];
          }
          if (isset($this->NM_ajax_info['param']['firedate']))
          {
              $this->firedate = $this->NM_ajax_info['param']['firedate'];
          }
          if (isset($this->NM_ajax_info['param']['gender']))
          {
              $this->gender = $this->NM_ajax_info['param']['gender'];
          }
          if (isset($this->NM_ajax_info['param']['hiredate']))
          {
              $this->hiredate = $this->NM_ajax_info['param']['hiredate'];
          }
          if (isset($this->NM_ajax_info['param']['hiring_duration']))
          {
              $this->hiring_duration = $this->NM_ajax_info['param']['hiring_duration'];
          }
          if (isset($this->NM_ajax_info['param']['ic']))
          {
              $this->ic = $this->NM_ajax_info['param']['ic'];
          }
          if (isset($this->NM_ajax_info['param']['id']))
          {
              $this->id = $this->NM_ajax_info['param']['id'];
          }
          if (isset($this->NM_ajax_info['param']['nm_form_submit']))
          {
              $this->nm_form_submit = $this->NM_ajax_info['param']['nm_form_submit'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_ancora']))
          {
              $this->nmgp_ancora = $this->NM_ajax_info['param']['nmgp_ancora'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_arg_dyn_search']))
          {
              $this->nmgp_arg_dyn_search = $this->NM_ajax_info['param']['nmgp_arg_dyn_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_arg_fast_search']))
          {
              $this->nmgp_arg_fast_search = $this->NM_ajax_info['param']['nmgp_arg_fast_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_cond_fast_search']))
          {
              $this->nmgp_cond_fast_search = $this->NM_ajax_info['param']['nmgp_cond_fast_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_fast_search']))
          {
              $this->nmgp_fast_search = $this->NM_ajax_info['param']['nmgp_fast_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_num_form']))
          {
              $this->nmgp_num_form = $this->NM_ajax_info['param']['nmgp_num_form'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_opcao']))
          {
              $this->nmgp_opcao = $this->NM_ajax_info['param']['nmgp_opcao'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_ordem']))
          {
              $this->nmgp_ordem = $this->NM_ajax_info['param']['nmgp_ordem'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_parms']))
          {
              $this->nmgp_parms = $this->NM_ajax_info['param']['nmgp_parms'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_url_saida']))
          {
              $this->nmgp_url_saida = $this->NM_ajax_info['param']['nmgp_url_saida'];
          }
          if (isset($this->NM_ajax_info['param']['phone']))
          {
              $this->phone = $this->NM_ajax_info['param']['phone'];
          }
          if (isset($this->NM_ajax_info['param']['photo_name']))
          {
              $this->photo_name = $this->NM_ajax_info['param']['photo_name'];
          }
          if (isset($this->NM_ajax_info['param']['photo_name_limpa']))
          {
              $this->photo_name_limpa = $this->NM_ajax_info['param']['photo_name_limpa'];
          }
          if (isset($this->NM_ajax_info['param']['photo_name_salva']))
          {
              $this->photo_name_salva = $this->NM_ajax_info['param']['photo_name_salva'];
          }
          if (isset($this->NM_ajax_info['param']['photo_name_ul_name']))
          {
              $this->photo_name_ul_name = $this->NM_ajax_info['param']['photo_name_ul_name'];
          }
          if (isset($this->NM_ajax_info['param']['photo_name_ul_type']))
          {
              $this->photo_name_ul_type = $this->NM_ajax_info['param']['photo_name_ul_type'];
          }
          if (isset($this->NM_ajax_info['param']['photo_size']))
          {
              $this->photo_size = $this->NM_ajax_info['param']['photo_size'];
          }
          if (isset($this->NM_ajax_info['param']['rate_cass']))
          {
              $this->rate_cass = $this->NM_ajax_info['param']['rate_cass'];
          }
          if (isset($this->NM_ajax_info['param']['rate_cfgdct']))
          {
              $this->rate_cfgdct = $this->NM_ajax_info['param']['rate_cfgdct'];
          }
          if (isset($this->NM_ajax_info['param']['rate_fdu']))
          {
              $this->rate_fdu = $this->NM_ajax_info['param']['rate_fdu'];
          }
          if (isset($this->NM_ajax_info['param']['rate_fixed']))
          {
              $this->rate_fixed = $this->NM_ajax_info['param']['rate_fixed'];
          }
          if (isset($this->NM_ajax_info['param']['rate_iris']))
          {
              $this->rate_iris = $this->NM_ajax_info['param']['rate_iris'];
          }
          if (isset($this->NM_ajax_info['param']['rate_ona']))
          {
              $this->rate_ona = $this->NM_ajax_info['param']['rate_ona'];
          }
          if (isset($this->NM_ajax_info['param']['revenu_net']))
          {
              $this->revenu_net = $this->NM_ajax_info['param']['revenu_net'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->NM_ajax_info['param']['tax_cass']))
          {
              $this->tax_cass = $this->NM_ajax_info['param']['tax_cass'];
          }
          if (isset($this->NM_ajax_info['param']['tax_cfgdct']))
          {
              $this->tax_cfgdct = $this->NM_ajax_info['param']['tax_cfgdct'];
          }
          if (isset($this->NM_ajax_info['param']['tax_fdu']))
          {
              $this->tax_fdu = $this->NM_ajax_info['param']['tax_fdu'];
          }
          if (isset($this->NM_ajax_info['param']['tax_ona']))
          {
              $this->tax_ona = $this->NM_ajax_info['param']['tax_ona'];
          }
          if (isset($this->NM_ajax_info['param']['userid_int']))
          {
              $this->userid_int = $this->NM_ajax_info['param']['userid_int'];
          }
          if (isset($this->nmgp_refresh_fields))
          {
              $this->nmgp_refresh_fields = explode('_#fld#_', $this->nmgp_refresh_fields);
              $this->nmgp_opcao          = 'recarga';
          }
          if (!isset($this->nmgp_refresh_row))
          {
              $this->nmgp_refresh_row = '';
          }
      }

      $this->scSajaxReservedWords = array('rs', 'rst', 'rsrnd', 'rsargs');
      $this->sc_conv_var = array();
      if (!empty($_FILES))
      {
          foreach ($_FILES as $nmgp_campo => $nmgp_valores)
          {
               if (!in_array(strtolower($nmgp_campo), $this->scSajaxReservedWords)) {
                   if (isset($this->sc_conv_var[$nmgp_campo]))
                   {
                       $nmgp_campo = $this->sc_conv_var[$nmgp_campo];
                   }
                   elseif (isset($this->sc_conv_var[strtolower($nmgp_campo)]))
                   {
                       $nmgp_campo = $this->sc_conv_var[strtolower($nmgp_campo)];
                   }
               }
               $tmp_scfile_name     = $nmgp_campo . "_scfile_name";
               $tmp_scfile_type     = $nmgp_campo . "_scfile_type";
               $this->$nmgp_campo = is_array($nmgp_valores['tmp_name']) ? $nmgp_valores['tmp_name'][0] : $nmgp_valores['tmp_name'];
               $this->$tmp_scfile_type   = is_array($nmgp_valores['type'])     ? $nmgp_valores['type'][0]     : $nmgp_valores['type'];
               $this->$tmp_scfile_name   = is_array($nmgp_valores['name'])     ? $nmgp_valores['name'][0]     : $nmgp_valores['name'];
          }
      }
      $Sc_lig_md5 = false;
      if (!empty($_POST))
      {
          foreach ($_POST as $nmgp_var => $nmgp_val)
          {
               if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
               {
                   $nmgp_var = substr($nmgp_var, 11);
                   $nmgp_val = $_SESSION[$nmgp_val];
               }
              if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
              {
                  $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                  if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]]))
                  {
                      $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
                      $Sc_lig_md5 = true;
                  }
                  else
                  {
                      $_SESSION['sc_session']['SC_parm_violation'] = true;
                  }
              }
               if (!in_array(strtolower($nmgp_var), $this->scSajaxReservedWords)) {
                   if (isset($this->sc_conv_var[$nmgp_var]))
                   {
                       $nmgp_var = $this->sc_conv_var[$nmgp_var];
                   }
                   elseif (isset($this->sc_conv_var[strtolower($nmgp_var)]))
                   {
                       $nmgp_var = $this->sc_conv_var[strtolower($nmgp_var)];
                   }
               }
               $nmgp_val = NM_decode_input($nmgp_val);
               $this->$nmgp_var = $nmgp_val;
          }
      }
      if (!empty($_GET))
      {
          foreach ($_GET as $nmgp_var => $nmgp_val)
          {
               if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
               {
                   $nmgp_var = substr($nmgp_var, 11);
                   $nmgp_val = $_SESSION[$nmgp_val];
               }
              if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
              {
                  $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                  if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]]))
                  {
                      $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
                      $Sc_lig_md5 = true;
                  }
                  else
                  {
                       $_SESSION['sc_session']['SC_parm_violation'] = true;
                  }
              }
               if (!in_array(strtolower($nmgp_var), $this->scSajaxReservedWords)) {
                   if (isset($this->sc_conv_var[$nmgp_var]))
                   {
                       $nmgp_var = $this->sc_conv_var[$nmgp_var];
                   }
                   elseif (isset($this->sc_conv_var[strtolower($nmgp_var)]))
                   {
                       $nmgp_var = $this->sc_conv_var[strtolower($nmgp_var)];
                   }
               }
               $nmgp_val = NM_decode_input($nmgp_val);
               $this->$nmgp_var = $nmgp_val;
          }
      }
      if (isset($SC_lig_apl_orig) && !$Sc_lig_md5 && (!isset($nmgp_parms) || ($nmgp_parms != "SC_null" && substr($nmgp_parms, 0, 8) != "OrScLink")))
      {
          $_SESSION['sc_session']['SC_parm_violation'] = true;
      }
      if (isset($nmgp_parms) && $nmgp_parms == "SC_null")
      {
          $nmgp_parms = "";
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['embutida_parms']);
      } 
      if (isset($this->nmgp_parms) && !empty($this->nmgp_parms)) 
      { 
          if (isset($_SESSION['nm_aba_bg_color'])) 
          { 
              unset($_SESSION['nm_aba_bg_color']);
          }   
          $nmgp_parms = str_replace("@aspass@", "'", $this->nmgp_parms);
          $nmgp_parms = str_replace("*scout", "?@?", $nmgp_parms);
          $nmgp_parms = str_replace("*scin", "?#?", $nmgp_parms);
          $todox = str_replace("?#?@?@?", "?#?@ ?@?", $nmgp_parms);
          $todo  = explode("?@?", $todox);
          $ix = 0;
          while (!empty($todo[$ix]))
          {
             $cadapar = explode("?#?", $todo[$ix]);
             if (1 < sizeof($cadapar))
             {
                if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                {
                    $cadapar[0] = substr($cadapar[0], 11);
                    $cadapar[1] = $_SESSION[$cadapar[1]];
                }
                 if (isset($this->sc_conv_var[$cadapar[0]]))
                 {
                     $cadapar[0] = $this->sc_conv_var[$cadapar[0]];
                 }
                 elseif (isset($this->sc_conv_var[strtolower($cadapar[0])]))
                 {
                     $cadapar[0] = $this->sc_conv_var[strtolower($cadapar[0])];
                 }
                 nm_limpa_str_form_FicheEmployeeSuspended_mob($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['total']);
          }
          if (!isset($_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['total']))
          {
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee_mob']['reg_start'] = "";
              unset($_SESSION['sc_session'][ $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee_mob']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['sc_redir_insert'] = $this->sc_redir_insert;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['parms']);
              $todo  = explode("?@?", $todox);
              $ix = 0;
              while (!empty($todo[$ix]))
              {
                 $cadapar = explode("?#?", $todo[$ix]);
                 if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                 {
                     $cadapar[0] = substr($cadapar[0], 11);
                     $cadapar[1] = $_SESSION[$cadapar[1]];
                 }
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
                 $ix++;
              }
          }
      } 

      if (isset($this->nm_run_menu) && $this->nm_run_menu == 1)
      { 
          $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new form_FicheEmployeeSuspended_mob_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("en_us");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['initialize'];
          if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended']))
          {
              foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended'] as $I_conf => $Conf_opt)
              {
                  $_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob'][$I_conf]  = $Conf_opt;
              }
          }
      } 
      else 
      { 
         $this->nm_data = new nm_data("en_us");
      } 
      $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['upload_field_info'] = array();

      $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['upload_field_info']['photo_name'] = array(
          'app_dir'            => $this->Ini->path_aplicacao,
          'app_name'           => 'form_FicheEmployeeSuspended_mob',
          'upload_dir'         => $this->Ini->root . $this->Ini->path_imag_temp . '/',
          'upload_url'         => $this->Ini->path_imag_temp . '/',
          'upload_type'        => 'single',
          'upload_allowed_type'  => '/\.(png|jpg|jpeg)$/i',
          'upload_max_size'  => null,
          'upload_file_height' => '200',
          'upload_file_width'  => '200',
          'upload_file_aspect' => 'S',
          'upload_file_type'   => 'I',
      );

      $_SESSION['sc_session'][$script_case_init]['form_FicheEmployeeSuspended_mob']['upload_field_info']['photo_file'] = array(
          'app_dir'            => $this->Ini->path_aplicacao,
          'app_name'           => 'form_FicheEmployeeSuspended_mob',
          'upload_dir'         => $this->Ini->root . $this->Ini->path_imag_temp . '/',
          'upload_url'         => $this->Ini->path_imag_temp . '/',
          'upload_type'        => 'single',
          'upload_allowed_type'  => '/\.(jpeg|jpg|png)$/i',
          'upload_max_size'  => null,
          'upload_file_height' => '200',
          'upload_file_width'  => '300',
          'upload_file_aspect' => 'S',
          'upload_file_type'   => 'I',
      );

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_FicheEmployeeSuspended_mob']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_FicheEmployeeSuspended_mob'];
          }
          elseif (isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']]))
          {
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']] as $init => $resto)
              {
                  if ($this->Ini->sc_page == $init)
                  {
                      $this->sc_init_menu = $init;
                      break;
                  }
              }
          }
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_FicheEmployeeSuspended_mob']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_FicheEmployeeSuspended_mob']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('form_FicheEmployeeSuspended_mob') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_FicheEmployeeSuspended_mob']['label'] = "Employee Sheet";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "form_FicheEmployeeSuspended_mob")
                  {
                      $achou = true;
                  }
                  elseif ($achou)
                  {
                      unset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu][$apl]);
                      $this->Change_Menu = true;
                  }
              }
          }
      }
      if (!function_exists("nmButtonOutput"))
      {
          include_once($this->Ini->path_lib_php . "nm_gp_config_btn.php");
      }
      include("../_lib/css/" . $this->Ini->str_schema_all . "_form.php");
      $this->Ini->Str_btn_form    = trim($str_button);
      include($this->Ini->path_btn . $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form . $_SESSION['scriptcase']['reg_conf']['css_dir'] . '.php');
      $_SESSION['scriptcase']['css_form_help'] = '../_lib/css/' . $this->Ini->str_schema_all . "_form.css";
      $_SESSION['scriptcase']['css_form_help_dir'] = '../_lib/css/' . $this->Ini->str_schema_all . "_form" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      $this->Db = $this->Ini->Db; 
      $this->nm_new_label['employee_name'] = '' . $this->Ini->Nm_lang['lang_username'] . '';
      $this->nm_new_label['phone'] = '' . $this->Ini->Nm_lang['lang_phone'] . '';
      $this->nm_new_label['gender'] = '' . $this->Ini->Nm_lang['lang_gender'] . '';
      $this->nm_new_label['dob'] = '' . $this->Ini->Nm_lang['lang_dob'] . '';
      $this->nm_new_label['hiredate'] = '' . $this->Ini->Nm_lang['lang_hiredate'] . '';
      $this->nm_new_label['firedate'] = '' . $this->Ini->Nm_lang['lang_fire_date'] . '';
      $this->nm_new_label['designation'] = '' . $this->Ini->Nm_lang['lang_designation'] . '';
      $this->nm_new_label['dept'] = '' . $this->Ini->Nm_lang['lang_departement'] . '';
      $this->nm_new_label['photo_size'] = '' . $this->Ini->Nm_lang['lang_photo_size'] . '';
      $this->nm_new_label['rate_fixed'] = '' . $this->Ini->Nm_lang['lang_rate_fixed'] . '';
      $this->nm_new_label['revenu_net'] = '' . $this->Ini->Nm_lang['lang_revenu_net'] . '';
      $this->nm_new_label['hiring_duration'] = '' . $this->Ini->Nm_lang['lang_hiring_duration'] . '';

      $this->Ini->str_google_fonts = isset($str_google_fonts)?$str_google_fonts:'';
      $this->Ini->Img_sep_form    = "/" . trim($str_toolbar_separator);
      $this->Ini->Color_bg_ajax   = !isset($str_ajax_bg)         || "" == trim($str_ajax_bg)         ? "#000" : $str_ajax_bg;
      $this->Ini->Border_c_ajax   = !isset($str_ajax_border_c)   || "" == trim($str_ajax_border_c)   ? ""     : $str_ajax_border_c;
      $this->Ini->Border_s_ajax   = !isset($str_ajax_border_s)   || "" == trim($str_ajax_border_s)   ? ""     : $str_ajax_border_s;
      $this->Ini->Border_w_ajax   = !isset($str_ajax_border_w)   || "" == trim($str_ajax_border_w)   ? ""     : $str_ajax_border_w;
      $this->Ini->Block_img_exp   = !isset($str_block_exp)       || "" == trim($str_block_exp)       ? ""     : $str_block_exp;
      $this->Ini->Block_img_col   = !isset($str_block_col)       || "" == trim($str_block_col)       ? ""     : $str_block_col;
      $this->Ini->Msg_ico_title   = !isset($str_msg_ico_title)   || "" == trim($str_msg_ico_title)   ? ""     : $str_msg_ico_title;
      $this->Ini->Msg_ico_body    = !isset($str_msg_ico_body)    || "" == trim($str_msg_ico_body)    ? ""     : $str_msg_ico_body;
      $this->Ini->Err_ico_title   = !isset($str_err_ico_title)   || "" == trim($str_err_ico_title)   ? ""     : $str_err_ico_title;
      $this->Ini->Err_ico_body    = !isset($str_err_ico_body)    || "" == trim($str_err_ico_body)    ? ""     : $str_err_ico_body;
      $this->Ini->Cal_ico_back    = !isset($str_cal_ico_back)    || "" == trim($str_cal_ico_back)    ? ""     : $str_cal_ico_back;
      $this->Ini->Cal_ico_for     = !isset($str_cal_ico_for)     || "" == trim($str_cal_ico_for)     ? ""     : $str_cal_ico_for;
      $this->Ini->Cal_ico_close   = !isset($str_cal_ico_close)   || "" == trim($str_cal_ico_close)   ? ""     : $str_cal_ico_close;
      $this->Ini->Tab_space       = !isset($str_tab_space)       || "" == trim($str_tab_space)       ? ""     : $str_tab_space;
      $this->Ini->Bubble_tail     = !isset($str_bubble_tail)     || "" == trim($str_bubble_tail)     ? ""     : $str_bubble_tail;
      $this->Ini->Label_sort_pos  = !isset($str_label_sort_pos)  || "" == trim($str_label_sort_pos)  ? ""     : $str_label_sort_pos;
      $this->Ini->Label_sort      = !isset($str_label_sort)      || "" == trim($str_label_sort)      ? ""     : $str_label_sort;
      $this->Ini->Label_sort_asc  = !isset($str_label_sort_asc)  || "" == trim($str_label_sort_asc)  ? ""     : $str_label_sort_asc;
      $this->Ini->Label_sort_desc = !isset($str_label_sort_desc) || "" == trim($str_label_sort_desc) ? ""     : $str_label_sort_desc;
      $this->Ini->Img_status_ok       = !isset($str_img_status_ok)  || "" == trim($str_img_status_ok)   ? ""     : $str_img_status_ok;
      $this->Ini->Img_status_err      = !isset($str_img_status_err) || "" == trim($str_img_status_err)  ? ""     : $str_img_status_err;
      $this->Ini->Css_status          = "scFormInputError";
      $this->Ini->Css_status_pwd_box  = "scFormInputErrorPwdBox";
      $this->Ini->Css_status_pwd_text = "scFormInputErrorPwdText";
      $this->Ini->Error_icon_span      = !isset($str_error_icon_span)  || "" == trim($str_error_icon_span)  ? false  : "message" == $str_error_icon_span;
      $this->Ini->Img_qs_search        = !isset($img_qs_search)        || "" == trim($img_qs_search)        ? "scriptcase__NM__qs_lupa.png"  : $img_qs_search;
      $this->Ini->Img_qs_clean         = !isset($img_qs_clean)         || "" == trim($img_qs_clean)         ? "scriptcase__NM__qs_close.png" : $img_qs_clean;
      $this->Ini->Str_qs_image_padding = !isset($str_qs_image_padding) || "" == trim($str_qs_image_padding) ? "0"                            : $str_qs_image_padding;
      $this->Ini->App_div_tree_img_col = trim($app_div_str_tree_col);
      $this->Ini->App_div_tree_img_exp = trim($app_div_str_tree_exp);
      $this->Ini->form_table_width     = isset($str_form_table_width) && '' != trim($str_form_table_width) ? $str_form_table_width : '';
      $this->Ini->Bubble_tail          = trim($str_bubble_tail);

        $this->classes_100perc_fields['table'] = '';
        $this->classes_100perc_fields['input'] = '';
        $this->classes_100perc_fields['span_input'] = '';
        $this->classes_100perc_fields['span_select'] = '';
        $this->classes_100perc_fields['style_category'] = '';
        $this->classes_100perc_fields['keep_field_size'] = true;


      $this->arr_buttons['sc_btn_0']['hint']             = "";
      $this->arr_buttons['sc_btn_0']['type']             = "button";
      $this->arr_buttons['sc_btn_0']['value']            = "Generate NET INCOME";
      $this->arr_buttons['sc_btn_0']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['sc_btn_0']['display_position'] = "text_right";
      $this->arr_buttons['sc_btn_0']['style']            = "default";
      $this->arr_buttons['sc_btn_0']['image']            = "";
      $this->arr_buttons['sc_btn_0']['has_fa']            = "true";
      $this->arr_buttons['sc_btn_0']['fontawesomeicon']            = "";

      $this->arr_buttons['sc_btn_1']['hint']             = "";
      $this->arr_buttons['sc_btn_1']['type']             = "button";
      $this->arr_buttons['sc_btn_1']['value']            = "Download from Fingertec";
      $this->arr_buttons['sc_btn_1']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['sc_btn_1']['display_position'] = "text_right";
      $this->arr_buttons['sc_btn_1']['style']            = "default";
      $this->arr_buttons['sc_btn_1']['image']            = "";
      $this->arr_buttons['sc_btn_1']['has_fa']            = "true";
      $this->arr_buttons['sc_btn_1']['fontawesomeicon']            = "";

      $this->arr_buttons['historic_salary']['hint']             = "";
      $this->arr_buttons['historic_salary']['type']             = "button";
      $this->arr_buttons['historic_salary']['value']            = "Salary History";
      $this->arr_buttons['historic_salary']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['historic_salary']['display_position'] = "text_right";
      $this->arr_buttons['historic_salary']['style']            = "default";
      $this->arr_buttons['historic_salary']['image']            = "";
      $this->arr_buttons['historic_salary']['has_fa']            = "true";
      $this->arr_buttons['historic_salary']['fontawesomeicon']            = "";


      $_SESSION['scriptcase']['error_icon']['form_FicheEmployeeSuspended_mob']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Lemon__NM__nm_scriptcase9_Lemon_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['form_FicheEmployeeSuspended_mob'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      if (isset($this->NM_ajax_info['param']['photo_name_ul_name']) && '' != $this->NM_ajax_info['param']['photo_name_ul_name'])
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['upload_field_ul_name'][$this->photo_name_ul_name]))
          {
              $this->NM_ajax_info['param']['photo_name_ul_name'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['upload_field_ul_name'][$this->photo_name_ul_name];
          }
          $this->photo_name = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->NM_ajax_info['param']['photo_name_ul_name'];
          $this->photo_name_scfile_name = substr($this->NM_ajax_info['param']['photo_name_ul_name'], 12);
          $this->photo_name_scfile_type = $this->NM_ajax_info['param']['photo_name_ul_type'];
          $this->photo_name_ul_name = $this->NM_ajax_info['param']['photo_name_ul_name'];
          $this->photo_name_ul_type = $this->NM_ajax_info['param']['photo_name_ul_type'];
      }
      elseif (isset($this->photo_name_ul_name) && '' != $this->photo_name_ul_name)
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['upload_field_ul_name'][$this->photo_name_ul_name]))
          {
              $this->photo_name_ul_name = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['upload_field_ul_name'][$this->photo_name_ul_name];
          }
          $this->photo_name = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->photo_name_ul_name;
          $this->photo_name_scfile_name = substr($this->photo_name_ul_name, 12);
          $this->photo_name_scfile_type = $this->photo_name_ul_type;
      }

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['qsearch'] = "on";
      $this->nmgp_botoes['new']  = "off";
      $this->nmgp_botoes['copy'] = "off";
      $this->nmgp_botoes['insert'] = "off";
      $this->nmgp_botoes['update'] = "on";
      $this->nmgp_botoes['delete'] = "off";
      $this->nmgp_botoes['first'] = "on";
      $this->nmgp_botoes['back'] = "on";
      $this->nmgp_botoes['forward'] = "on";
      $this->nmgp_botoes['last'] = "on";
      $this->nmgp_botoes['summary'] = "on";
      $this->nmgp_botoes['navpage'] = "off";
      $this->nmgp_botoes['goto'] = "off";
      $this->nmgp_botoes['qtline'] = "off";
      $this->nmgp_botoes['reload'] = "on";
      $this->nmgp_botoes['sc_btn_0'] = "on";
      $this->nmgp_botoes['sc_btn_1'] = "on";
      $this->nmgp_botoes['Historic_Salary'] = "on";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_FicheEmployeeSuspended_mob']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_FicheEmployeeSuspended_mob'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_FicheEmployeeSuspended_mob'];

              $this->nmgp_botoes['update']     = $tmpDashboardButtons['form_update']    ? 'on' : 'off';
              $this->nmgp_botoes['new']        = $tmpDashboardButtons['form_insert']    ? 'on' : 'off';
              $this->nmgp_botoes['insert']     = $tmpDashboardButtons['form_insert']    ? 'on' : 'off';
              $this->nmgp_botoes['delete']     = $tmpDashboardButtons['form_delete']    ? 'on' : 'off';
              $this->nmgp_botoes['copy']       = $tmpDashboardButtons['form_copy']      ? 'on' : 'off';
              $this->nmgp_botoes['first']      = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['back']       = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['last']       = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['forward']    = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['navpage']    = $tmpDashboardButtons['form_navpage']   ? 'on' : 'off';
              $this->nmgp_botoes['goto']       = $tmpDashboardButtons['form_goto']      ? 'on' : 'off';
              $this->nmgp_botoes['qtline']     = $tmpDashboardButtons['form_lineqty']   ? 'on' : 'off';
              $this->nmgp_botoes['summary']    = $tmpDashboardButtons['form_summary']   ? 'on' : 'off';
              $this->nmgp_botoes['qsearch']    = $tmpDashboardButtons['form_qsearch']   ? 'on' : 'off';
              $this->nmgp_botoes['dynsearch']  = $tmpDashboardButtons['form_dynsearch'] ? 'on' : 'off';
              $this->nmgp_botoes['reload']     = $tmpDashboardButtons['form_reload']    ? 'on' : 'off';
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form'];
          if (!isset($this->id)){$this->id = $this->nmgp_dados_form['id'];} 
          if (!isset($this->userid_varchar)){$this->userid_varchar = $this->nmgp_dados_form['userid_varchar'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['employee_name'] != "null"){$this->employee_name = $this->nmgp_dados_form['employee_name'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['ic'] != "null"){$this->ic = $this->nmgp_dados_form['ic'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['address'] != "null"){$this->address = $this->nmgp_dados_form['address'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['phone'] != "null"){$this->phone = $this->nmgp_dados_form['phone'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['email'] != "null"){$this->email = $this->nmgp_dados_form['email'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['gender'] != "null"){$this->gender = $this->nmgp_dados_form['gender'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['dob'] != "null"){
              $this->dob = $this->nmgp_dados_form['dob'];
              $this->dob = $this->nm_conv_data_db($this->dob, 'yyyy-mm-dd', $this->field_config['dob']['date_format']);
          }
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['hiredate'] != "null"){
              $this->hiredate = $this->nmgp_dados_form['hiredate'];
              $this->hiredate = $this->nm_conv_data_db($this->hiredate, 'yyyy-mm-dd', $this->field_config['hiredate']['date_format']);
          }
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['firedate'] != "null"){
              $this->firedate = $this->nmgp_dados_form['firedate'];
              $this->firedate = $this->nm_conv_data_db($this->firedate, 'yyyy-mm-dd', $this->field_config['firedate']['date_format']);
          }
          if (!isset($this->inactif)){$this->inactif = $this->nmgp_dados_form['inactif'];} 
          if (!isset($this->building)){$this->building = $this->nmgp_dados_form['building'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['designation'] != "null"){$this->designation = $this->nmgp_dados_form['designation'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['dept'] != "null"){$this->dept = $this->nmgp_dados_form['dept'];} 
          if (!isset($this->section)){$this->section = $this->nmgp_dados_form['section'];} 
          if (!isset($this->photo_file)){$this->photo_file = $this->nmgp_dados_form['photo_file'];} 
          if (!isset($this->imm_ona)){$this->imm_ona = $this->nmgp_dados_form['imm_ona'];} 
          if (!isset($this->no_compte)){$this->no_compte = $this->nmgp_dados_form['no_compte'];} 
          if (!isset($this->type_de_compte)){$this->type_de_compte = $this->nmgp_dados_form['type_de_compte'];} 
          if (!isset($this->payperiod)){$this->payperiod = $this->nmgp_dados_form['payperiod'];} 
          if (!isset($this->probation_period)){$this->probation_period = $this->nmgp_dados_form['probation_period'];} 
          if (!isset($this->rate_work)){$this->rate_work = $this->nmgp_dados_form['rate_work'];} 
          if (!isset($this->rate_ot)){$this->rate_ot = $this->nmgp_dados_form['rate_ot'];} 
          if (!isset($this->rate_ot_factor)){$this->rate_ot_factor = $this->nmgp_dados_form['rate_ot_factor'];} 
          if (!isset($this->rate_ot_holiday_factor)){$this->rate_ot_holiday_factor = $this->nmgp_dados_form['rate_ot_holiday_factor'];} 
          if (!isset($this->rate_ot_offday_factor)){$this->rate_ot_offday_factor = $this->nmgp_dados_form['rate_ot_offday_factor'];} 
          if (!isset($this->rate_ot_restday_factor)){$this->rate_ot_restday_factor = $this->nmgp_dados_form['rate_ot_restday_factor'];} 
          if (!isset($this->rate_day)){$this->rate_day = $this->nmgp_dados_form['rate_day'];} 
          if (!isset($this->rate_restday)){$this->rate_restday = $this->nmgp_dados_form['rate_restday'];} 
          if (!isset($this->rate_offday)){$this->rate_offday = $this->nmgp_dados_form['rate_offday'];} 
          if (!isset($this->rate_commission1)){$this->rate_commission1 = $this->nmgp_dados_form['rate_commission1'];} 
          if (!isset($this->rate_prime1)){$this->rate_prime1 = $this->nmgp_dados_form['rate_prime1'];} 
          if (!isset($this->rate_omission1)){$this->rate_omission1 = $this->nmgp_dados_form['rate_omission1'];} 
          if (!isset($this->rate_assmd)){$this->rate_assmd = $this->nmgp_dados_form['rate_assmd'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['tax_cass'] != "null"){$this->tax_cass = $this->nmgp_dados_form['tax_cass'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['tax_cfgdct'] != "null"){$this->tax_cfgdct = $this->nmgp_dados_form['tax_cfgdct'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['tax_ona'] != "null"){$this->tax_ona = $this->nmgp_dados_form['tax_ona'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['tax_fdu'] != "null"){$this->tax_fdu = $this->nmgp_dados_form['tax_fdu'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['rate_iris'] != "null"){$this->rate_iris = $this->nmgp_dados_form['rate_iris'];} 
          if (!isset($this->rate_iric)){$this->rate_iric = $this->nmgp_dados_form['rate_iric'];} 
          if (!isset($this->rate_cons)){$this->rate_cons = $this->nmgp_dados_form['rate_cons'];} 
          if (!isset($this->day_cons)){$this->day_cons = $this->nmgp_dados_form['day_cons'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['revenu_net'] != "null"){$this->revenu_net = $this->nmgp_dados_form['revenu_net'];} 
          if (!isset($this->incentive)){$this->incentive = $this->nmgp_dados_form['incentive'];} 
          if (!isset($this->incentive_desc)){$this->incentive_desc = $this->nmgp_dados_form['incentive_desc'];} 
          if (!isset($this->rappel)){$this->rappel = $this->nmgp_dados_form['rappel'];} 
          if (!isset($this->other_deduct)){$this->other_deduct = $this->nmgp_dados_form['other_deduct'];} 
          if (!isset($this->other_deduct_desc)){$this->other_deduct_desc = $this->nmgp_dados_form['other_deduct_desc'];} 
          if (!isset($this->loan)){$this->loan = $this->nmgp_dados_form['loan'];} 
          if (!isset($this->date_loan)){$this->date_loan = $this->nmgp_dados_form['date_loan'];} 
          if (!isset($this->payment)){$this->payment = $this->nmgp_dados_form['payment'];} 
          if (!isset($this->date_payment)){$this->date_payment = $this->nmgp_dados_form['date_payment'];} 
          if (!isset($this->payment_receipt)){$this->payment_receipt = $this->nmgp_dados_form['payment_receipt'];} 
          if (!isset($this->loan_deduction)){$this->loan_deduction = $this->nmgp_dados_form['loan_deduction'];} 
          if (!isset($this->loan_description)){$this->loan_description = $this->nmgp_dados_form['loan_description'];} 
          if (!isset($this->loan_start_deduct)){$this->loan_start_deduct = $this->nmgp_dados_form['loan_start_deduct'];} 
          if (!isset($this->loan_monthlypayment)){$this->loan_monthlypayment = $this->nmgp_dados_form['loan_monthlypayment'];} 
          if (!isset($this->loan_end_deduct)){$this->loan_end_deduct = $this->nmgp_dados_form['loan_end_deduct'];} 
          if (!isset($this->apply_loan_deduction)){$this->apply_loan_deduction = $this->nmgp_dados_form['apply_loan_deduction'];} 
          if (!isset($this->loan_bank)){$this->loan_bank = $this->nmgp_dados_form['loan_bank'];} 
          if (!isset($this->date_loan_bank)){$this->date_loan_bank = $this->nmgp_dados_form['date_loan_bank'];} 
          if (!isset($this->loan_deduction_bank)){$this->loan_deduction_bank = $this->nmgp_dados_form['loan_deduction_bank'];} 
          if (!isset($this->loan_start_deduct_bank)){$this->loan_start_deduct_bank = $this->nmgp_dados_form['loan_start_deduct_bank'];} 
          if (!isset($this->loan_end_deduct_bank)){$this->loan_end_deduct_bank = $this->nmgp_dados_form['loan_end_deduct_bank'];} 
          if (!isset($this->apply_loan_deduction_bank)){$this->apply_loan_deduction_bank = $this->nmgp_dados_form['apply_loan_deduction_bank'];} 
          if (!isset($this->other_loan)){$this->other_loan = $this->nmgp_dados_form['other_loan'];} 
          if (!isset($this->date_other_loan)){$this->date_other_loan = $this->nmgp_dados_form['date_other_loan'];} 
          if (!isset($this->other_loan_deduction)){$this->other_loan_deduction = $this->nmgp_dados_form['other_loan_deduction'];} 
          if (!isset($this->other_loan_description)){$this->other_loan_description = $this->nmgp_dados_form['other_loan_description'];} 
          if (!isset($this->other_loan_start_deduct)){$this->other_loan_start_deduct = $this->nmgp_dados_form['other_loan_start_deduct'];} 
          if (!isset($this->other_loan_monthlypayment)){$this->other_loan_monthlypayment = $this->nmgp_dados_form['other_loan_monthlypayment'];} 
          if (!isset($this->other_loan_end_deduct)){$this->other_loan_end_deduct = $this->nmgp_dados_form['other_loan_end_deduct'];} 
          if (!isset($this->apply_other_loan_deduction)){$this->apply_other_loan_deduction = $this->nmgp_dados_form['apply_other_loan_deduction'];} 
          if (!isset($this->purchase)){$this->purchase = $this->nmgp_dados_form['purchase'];} 
          if (!isset($this->purchase_description)){$this->purchase_description = $this->nmgp_dados_form['purchase_description'];} 
          if (!isset($this->date_purchase)){$this->date_purchase = $this->nmgp_dados_form['date_purchase'];} 
          if (!isset($this->purchase_deduct)){$this->purchase_deduct = $this->nmgp_dados_form['purchase_deduct'];} 
          if (!isset($this->purchase_start_deduct)){$this->purchase_start_deduct = $this->nmgp_dados_form['purchase_start_deduct'];} 
          if (!isset($this->purchase_monthlypayment)){$this->purchase_monthlypayment = $this->nmgp_dados_form['purchase_monthlypayment'];} 
          if (!isset($this->purchase_end_deduct)){$this->purchase_end_deduct = $this->nmgp_dados_form['purchase_end_deduct'];} 
          if (!isset($this->apply_purchase_deduct)){$this->apply_purchase_deduct = $this->nmgp_dados_form['apply_purchase_deduct'];} 
          if (!isset($this->health_insurance)){$this->health_insurance = $this->nmgp_dados_form['health_insurance'];} 
          if (!isset($this->bank_number)){$this->bank_number = $this->nmgp_dados_form['bank_number'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['hiring_duration'] != "null"){$this->hiring_duration = $this->nmgp_dados_form['hiring_duration'];} 
          if (!isset($this->update_time)){$this->update_time = $this->nmgp_dados_form['update_time'];} 
          if (!isset($this->field03)){$this->field03 = $this->nmgp_dados_form['field03'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("form_FicheEmployeeSuspended_mob", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
      $this->Ini->sc_Include($this->Ini->path_libs . "/nm_gc.php", "F", "nm_gc") ; 
      $_SESSION['scriptcase']['sc_tab_meses']['int'] = array(
                                      $this->Ini->Nm_lang['lang_mnth_janu'],
                                      $this->Ini->Nm_lang['lang_mnth_febr'],
                                      $this->Ini->Nm_lang['lang_mnth_marc'],
                                      $this->Ini->Nm_lang['lang_mnth_apri'],
                                      $this->Ini->Nm_lang['lang_mnth_mayy'],
                                      $this->Ini->Nm_lang['lang_mnth_june'],
                                      $this->Ini->Nm_lang['lang_mnth_july'],
                                      $this->Ini->Nm_lang['lang_mnth_augu'],
                                      $this->Ini->Nm_lang['lang_mnth_sept'],
                                      $this->Ini->Nm_lang['lang_mnth_octo'],
                                      $this->Ini->Nm_lang['lang_mnth_nove'],
                                      $this->Ini->Nm_lang['lang_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_meses']['abr'] = array(
                                      $this->Ini->Nm_lang['lang_shrt_mnth_janu'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_febr'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_marc'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_apri'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_mayy'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_june'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_july'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_augu'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_sept'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_octo'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_nove'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_dias']['int'] = array(
                                      $this->Ini->Nm_lang['lang_days_sund'],
                                      $this->Ini->Nm_lang['lang_days_mond'],
                                      $this->Ini->Nm_lang['lang_days_tued'],
                                      $this->Ini->Nm_lang['lang_days_wend'],
                                      $this->Ini->Nm_lang['lang_days_thud'],
                                      $this->Ini->Nm_lang['lang_days_frid'],
                                      $this->Ini->Nm_lang['lang_days_satd']);
      $_SESSION['scriptcase']['sc_tab_dias']['abr'] = array(
                                      $this->Ini->Nm_lang['lang_shrt_days_sund'],
                                      $this->Ini->Nm_lang['lang_shrt_days_mond'],
                                      $this->Ini->Nm_lang['lang_shrt_days_tued'],
                                      $this->Ini->Nm_lang['lang_shrt_days_wend'],
                                      $this->Ini->Nm_lang['lang_shrt_days_thud'],
                                      $this->Ini->Nm_lang['lang_shrt_days_frid'],
                                      $this->Ini->Nm_lang['lang_shrt_days_satd']);
      nm_gc($this->Ini->path_libs);
      $this->Ini->Gd_missing  = true;
      if(function_exists("getProdVersion"))
      {
         $_SESSION['scriptcase']['sc_prod_Version'] = str_replace(".", "", getProdVersion($this->Ini->path_libs));
         if(function_exists("gd_info"))
         {
            $this->Ini->Gd_missing = false;
         }
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_trata_img.php", "C", "nm_trata_img") ; 
      if (isset($_GET['nm_cal_display']))
      {
          if ($this->Embutida_proc)
          { 
              include_once($this->Ini->path_embutida . 'form_FicheEmployeeSuspended/form_FicheEmployeeSuspended_mob_calendar.php');
          }
          else
          { 
              include_once($this->Ini->path_aplicacao . 'form_FicheEmployeeSuspended_mob_calendar.php');
          }
          exit;
      }

      if (is_file($this->Ini->path_aplicacao . 'form_FicheEmployeeSuspended_mob_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'form_FicheEmployeeSuspended_mob_help.txt');
          if ($arr_link_webhelp)
          {
              foreach ($arr_link_webhelp as $str_link_webhelp)
              {
                  $str_link_webhelp = trim($str_link_webhelp);
                  if ('form:' == substr($str_link_webhelp, 0, 5))
                  {
                      $arr_link_parts = explode(':', $str_link_webhelp);
                      if ('' != $arr_link_parts[1] && is_file($this->Ini->root . $this->Ini->path_help . $arr_link_parts[1]))
                      {
                          $this->url_webhelp = $this->Ini->path_help . $arr_link_parts[1];
                      }
                  }
              }
          }
      }

      if (is_dir($this->Ini->path_aplicacao . 'img'))
      {
          $Res_dir_img = @opendir($this->Ini->path_aplicacao . 'img');
          if ($Res_dir_img)
          {
              while (FALSE !== ($Str_arquivo = @readdir($Res_dir_img))) 
              {
                 if (@is_file($this->Ini->path_aplicacao . 'img/' . $Str_arquivo) && '.' != $Str_arquivo && '..' != $this->Ini->path_aplicacao . 'img/' . $Str_arquivo)
                 {
                     @unlink($this->Ini->path_aplicacao . 'img/' . $Str_arquivo);
                 }
              }
          }
          @closedir($Res_dir_img);
          rmdir($this->Ini->path_aplicacao . 'img');
      }

      if ($this->Embutida_proc)
      { 
          require_once($this->Ini->path_embutida . 'form_FicheEmployeeSuspended/form_FicheEmployeeSuspended_mob_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "form_FicheEmployeeSuspended_mob_erro.class.php"); 
      }
      $this->Erro      = new form_FicheEmployeeSuspended_mob_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ($this->nmgp_opcao == "fast_search")  
      {
          $this->SC_fast_search($this->nmgp_fast_search, $this->nmgp_cond_fast_search, $this->nmgp_arg_fast_search);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opcao'] = "inicio";
          $this->nmgp_opcao = "inicio";
          $this->proc_fast_search = true;
      } 
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opcao']))
         { 
             if ($this->id != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended_mob']['start']);
          unset($_SESSION['scriptcase']['sc_apl_conf']['form_FicheEmployeeSuspended']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "novo")  
      {
          $this->nmgp_botoes['sc_btn_0'] = "off";
          $this->nmgp_botoes['sc_btn_1'] = "off";
          $this->nmgp_botoes['Historic_Salary'] = "off";
      }
      elseif ($this->nmgp_opcao == "incluir")  
      {
          $this->nmgp_botoes['sc_btn_0'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['botoes']['sc_btn_0'];
          $this->nmgp_botoes['sc_btn_1'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['botoes']['sc_btn_1'];
          $this->nmgp_botoes['Historic_Salary'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['botoes']['Historic_Salary'];
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      if ($this->nmgp_opcao == "excluir")
      {
          $GLOBALS['script_case_init'] = $this->Ini->sc_page;
          $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee_mob']['embutida_form'] = false;
          $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee_mob']['embutida_proc'] = true;
          $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee_mob']['reg_start'] = "";
          $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee']['embutida_form'] = false;
          $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee']['embutida_proc'] = true;
          $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee']['reg_start'] = "";
          unset($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee_mob']['total']);
          $detailAppName = 'form_tbl_note_employee_mob';
          $detailAppObject = "form_tbl_note_employee_mob";
          $detailAppFolder = $this->Ini->root . $this->Ini->path_link  . SC_dir_app_name($detailAppName);
          if (!@is_dir($detailAppFolder)) {
              $detailAppName = substr($detailAppName, 0, -4);
              $detailAppObject = substr($detailAppObject, 0, -4);
              $detailAppFolder = $this->Ini->root . $this->Ini->path_link  . SC_dir_app_name($detailAppName);
          }
          $detailAppObject .= '_apl';
          require_once($detailAppFolder . "/index.php");
          require_once($detailAppFolder . "/{$detailAppName}_apl.php");
          $this->form_tbl_note_employee_mob = new $detailAppObject;
      }
      $this->NM_case_insensitive = false;
      $this->sc_evento = $this->nmgp_opcao;
      $this->sc_insert_on = false;
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){


        case 'photo_name':
            $_POST['AjaxCheckImg'] = (urldecode($_POST['AjaxCheckImg']));

            $__file_download = $_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['glo_nm_path_cache'] . (isset($_POST['p_cache']) ? $_POST['p_cache'] : '//' ). basename($_POST['AjaxCheckImg']);
            $img_width = '200';
            $img_height = '200';
            $file_name = '/sc_'.$_REQUEST['rsargs']. '_' . md5("".'_'.basename($__file_download)) .'.' . 'gif';
            if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['download_filenames']))
            {
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['download_filenames'] = array();
            }
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['download_filenames'][$_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['glo_nm_path_imag_temp'] .$file_name] = utf8_decode($_POST['AjaxCheckImg']);

            if(file_exists($__file_download)){ break; }

            if(!__sc_api_storage_check([
                    'profile' => 'grp__NM__PHIFA_API',
                    'file' => $_SERVER['DOCUMENT_ROOT'] .'/' . $_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['glo_nm_path_imagens'] . "" . '/' . $_POST['AjaxCheckImg'],
                    'parents' => isset($_POST['p']) && !empty($_POST['p']) ? $_POST['p'] : '/PAYROLLHTG/EMPPHOTO',
                    'destination' => dirname($__file_download),
                     ])){
                         $retorno = sc_api_download([
                            'profile' => 'grp__NM__PHIFA_API',
                            'file' => $_SERVER['DOCUMENT_ROOT'] .'/' . $_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['glo_nm_path_imagens'] . "" . '/' . $_POST['AjaxCheckImg'],
                            'parents' => isset($_POST['p']) && !empty($_POST['p']) ? $_POST['p'] : '/PAYROLLHTG/EMPPHOTO',
                            'destination' => $__file_download,
                             ]);
                             if($retorno == false){
                                echo 0;
                                exit;
                             }


                     } else{
                         echo 0;
                         exit;
                     }

                     break;
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$orig_img);
            echo $orig_img . '_@@NM@@_';            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            $sc_obj_img = new nm_trata_img($_SERVER['DOCUMENT_ROOT'].$out1_img_cache, true);

            if(!empty($img_width) && !empty($img_height)){
                $sc_obj_img->setWidth($img_width);
                $sc_obj_img->setHeight($img_height);
            }            $sc_obj_img->createImg($_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            echo $out1_img_cache;
               exit;
            }
      if (isset($this->userid_int)) { $this->nm_limpa_alfa($this->userid_int); }
      if (isset($this->employee_name)) { $this->nm_limpa_alfa($this->employee_name); }
      if (isset($this->ic)) { $this->nm_limpa_alfa($this->ic); }
      if (isset($this->address)) { $this->nm_limpa_alfa($this->address); }
      if (isset($this->phone)) { $this->nm_limpa_alfa($this->phone); }
      if (isset($this->email)) { $this->nm_limpa_alfa($this->email); }
      if (isset($this->designation)) { $this->nm_limpa_alfa($this->designation); }
      if (isset($this->dept)) { $this->nm_limpa_alfa($this->dept); }
      if (isset($this->photo_size)) { $this->nm_limpa_alfa($this->photo_size); }
      if (isset($this->rate_fixed)) { $this->nm_limpa_alfa($this->rate_fixed); }
      if (isset($this->rate_cass)) { $this->nm_limpa_alfa($this->rate_cass); }
      if (isset($this->tax_cass)) { $this->nm_limpa_alfa($this->tax_cass); }
      if (isset($this->rate_cfgdct)) { $this->nm_limpa_alfa($this->rate_cfgdct); }
      if (isset($this->tax_cfgdct)) { $this->nm_limpa_alfa($this->tax_cfgdct); }
      if (isset($this->rate_ona)) { $this->nm_limpa_alfa($this->rate_ona); }
      if (isset($this->tax_ona)) { $this->nm_limpa_alfa($this->tax_ona); }
      if (isset($this->rate_fdu)) { $this->nm_limpa_alfa($this->rate_fdu); }
      if (isset($this->tax_fdu)) { $this->nm_limpa_alfa($this->tax_fdu); }
      if (isset($this->rate_iris)) { $this->nm_limpa_alfa($this->rate_iris); }
      if (isset($this->revenu_net)) { $this->nm_limpa_alfa($this->revenu_net); }
      if (isset($this->hiring_duration)) { $this->nm_limpa_alfa($this->hiring_duration); }
      if (isset($this->block_note)) { $this->nm_limpa_alfa($this->block_note); }
      if ($nm_opc_form_php == "formphp")
      { 
          if ($nm_call_php == "sc_btn_0")
          { 
              $this->sc_btn_sc_btn_0();
          } 
          if ($nm_call_php == "sc_btn_1")
          { 
              $this->sc_btn_sc_btn_1();
          } 
          if ($nm_call_php == "Historic_Salary")
          { 
              $this->sc_btn_Historic_Salary();
          } 
          $this->NM_close_db(); 
          exit;
      } 
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- userid_int
      $this->field_config['userid_int']               = array();
      $this->field_config['userid_int']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['userid_int']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['userid_int']['symbol_dec'] = '';
      $this->field_config['userid_int']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['userid_int']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- dob
      $this->field_config['dob']                 = array();
      $this->field_config['dob']['date_format']  = "dd/mm/aaaa";
      $this->field_config['dob']['date_sep']     = "-";
      $this->field_config['dob']['date_display'] = "dd/mm/aaaa";
      $this->new_date_format('DT', 'dob');
      //-- hiredate
      $this->field_config['hiredate']                 = array();
      $this->field_config['hiredate']['date_format']  = "dd/mm/aaaa";
      $this->field_config['hiredate']['date_sep']     = "-";
      $this->field_config['hiredate']['date_display'] = "dd/mm/aaaa";
      $this->new_date_format('DT', 'hiredate');
      //-- firedate
      $this->field_config['firedate']                 = array();
      $this->field_config['firedate']['date_format']  = "dd/mm/aaaa";
      $this->field_config['firedate']['date_sep']     = "-";
      $this->field_config['firedate']['date_display'] = "dd/mm/aaaa";
      $this->new_date_format('DT', 'firedate');
      //-- hiring_duration
      $this->field_config['hiring_duration']               = array();
      $this->field_config['hiring_duration']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['hiring_duration']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['hiring_duration']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['hiring_duration']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['hiring_duration']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- rate_cass
      $this->field_config['rate_cass']               = array();
      $this->field_config['rate_cass']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['rate_cass']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['rate_cass']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['rate_cass']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['rate_cass']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- tax_cass
      $this->field_config['tax_cass']               = array();
      $this->field_config['tax_cass']['symbol_grp'] = ',';
      $this->field_config['tax_cass']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['tax_cass']['symbol_dec'] = '.';
      $this->field_config['tax_cass']['symbol_mon'] = 'HTG';
      $this->field_config['tax_cass']['format_pos'] = '3';
      $this->field_config['tax_cass']['format_neg'] = '2';
      //-- rate_cfgdct
      $this->field_config['rate_cfgdct']               = array();
      $this->field_config['rate_cfgdct']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['rate_cfgdct']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['rate_cfgdct']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['rate_cfgdct']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['rate_cfgdct']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- tax_cfgdct
      $this->field_config['tax_cfgdct']               = array();
      $this->field_config['tax_cfgdct']['symbol_grp'] = ',';
      $this->field_config['tax_cfgdct']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['tax_cfgdct']['symbol_dec'] = '.';
      $this->field_config['tax_cfgdct']['symbol_mon'] = 'HTG';
      $this->field_config['tax_cfgdct']['format_pos'] = '3';
      $this->field_config['tax_cfgdct']['format_neg'] = '2';
      //-- rate_ona
      $this->field_config['rate_ona']               = array();
      $this->field_config['rate_ona']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['rate_ona']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['rate_ona']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['rate_ona']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['rate_ona']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- tax_ona
      $this->field_config['tax_ona']               = array();
      $this->field_config['tax_ona']['symbol_grp'] = ',';
      $this->field_config['tax_ona']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['tax_ona']['symbol_dec'] = '.';
      $this->field_config['tax_ona']['symbol_mon'] = 'HTG';
      $this->field_config['tax_ona']['format_pos'] = '3';
      $this->field_config['tax_ona']['format_neg'] = '2';
      //-- rate_fdu
      $this->field_config['rate_fdu']               = array();
      $this->field_config['rate_fdu']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['rate_fdu']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['rate_fdu']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['rate_fdu']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['rate_fdu']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- tax_fdu
      $this->field_config['tax_fdu']               = array();
      $this->field_config['tax_fdu']['symbol_grp'] = ',';
      $this->field_config['tax_fdu']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['tax_fdu']['symbol_dec'] = '.';
      $this->field_config['tax_fdu']['symbol_mon'] = 'HTG';
      $this->field_config['tax_fdu']['format_pos'] = '3';
      $this->field_config['tax_fdu']['format_neg'] = '2';
      //-- rate_iris
      $this->field_config['rate_iris']               = array();
      $this->field_config['rate_iris']['symbol_grp'] = ',';
      $this->field_config['rate_iris']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['rate_iris']['symbol_dec'] = '.';
      $this->field_config['rate_iris']['symbol_mon'] = 'HTG';
      $this->field_config['rate_iris']['format_pos'] = '3';
      $this->field_config['rate_iris']['format_neg'] = '2';
      //-- rate_fixed
      $this->field_config['rate_fixed']               = array();
      $this->field_config['rate_fixed']['symbol_grp'] = ',';
      $this->field_config['rate_fixed']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['rate_fixed']['symbol_dec'] = '.';
      $this->field_config['rate_fixed']['symbol_mon'] = 'HTG';
      $this->field_config['rate_fixed']['format_pos'] = '3';
      $this->field_config['rate_fixed']['format_neg'] = '2';
      //-- revenu_net
      $this->field_config['revenu_net']               = array();
      $this->field_config['revenu_net']['symbol_grp'] = ',';
      $this->field_config['revenu_net']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['revenu_net']['symbol_dec'] = '.';
      $this->field_config['revenu_net']['symbol_mon'] = 'HTG';
      $this->field_config['revenu_net']['format_pos'] = '3';
      $this->field_config['revenu_net']['format_neg'] = '2';
      //-- id
      $this->field_config['id']               = array();
      $this->field_config['id']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['id']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['id']['symbol_dec'] = '';
      $this->field_config['id']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['id']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- inactif
      $this->field_config['inactif']               = array();
      $this->field_config['inactif']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['inactif']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['inactif']['symbol_dec'] = '';
      $this->field_config['inactif']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['inactif']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- payperiod
      $this->field_config['payperiod']               = array();
      $this->field_config['payperiod']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['payperiod']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['payperiod']['symbol_dec'] = '';
      $this->field_config['payperiod']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['payperiod']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- probation_period
      $this->field_config['probation_period']               = array();
      $this->field_config['probation_period']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['probation_period']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['probation_period']['symbol_dec'] = '';
      $this->field_config['probation_period']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['probation_period']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- rate_work
      $this->field_config['rate_work']               = array();
      $this->field_config['rate_work']['symbol_grp'] = ',';
      $this->field_config['rate_work']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['rate_work']['symbol_dec'] = '.';
      $this->field_config['rate_work']['symbol_mon'] = 'HTG';
      $this->field_config['rate_work']['format_pos'] = '3';
      $this->field_config['rate_work']['format_neg'] = '2';
      //-- rate_ot
      $this->field_config['rate_ot']               = array();
      $this->field_config['rate_ot']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['rate_ot']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['rate_ot']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['rate_ot']['symbol_mon'] = '';
      $this->field_config['rate_ot']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['rate_ot']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- rate_ot_factor
      $this->field_config['rate_ot_factor']               = array();
      $this->field_config['rate_ot_factor']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['rate_ot_factor']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['rate_ot_factor']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['rate_ot_factor']['symbol_mon'] = '';
      $this->field_config['rate_ot_factor']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['rate_ot_factor']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- rate_ot_holiday_factor
      $this->field_config['rate_ot_holiday_factor']               = array();
      $this->field_config['rate_ot_holiday_factor']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['rate_ot_holiday_factor']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['rate_ot_holiday_factor']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['rate_ot_holiday_factor']['symbol_mon'] = '';
      $this->field_config['rate_ot_holiday_factor']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['rate_ot_holiday_factor']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- rate_ot_offday_factor
      $this->field_config['rate_ot_offday_factor']               = array();
      $this->field_config['rate_ot_offday_factor']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['rate_ot_offday_factor']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['rate_ot_offday_factor']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['rate_ot_offday_factor']['symbol_mon'] = '';
      $this->field_config['rate_ot_offday_factor']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['rate_ot_offday_factor']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- rate_ot_restday_factor
      $this->field_config['rate_ot_restday_factor']               = array();
      $this->field_config['rate_ot_restday_factor']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['rate_ot_restday_factor']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['rate_ot_restday_factor']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['rate_ot_restday_factor']['symbol_mon'] = '';
      $this->field_config['rate_ot_restday_factor']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['rate_ot_restday_factor']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- rate_day
      $this->field_config['rate_day']               = array();
      $this->field_config['rate_day']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['rate_day']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['rate_day']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['rate_day']['symbol_mon'] = '';
      $this->field_config['rate_day']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['rate_day']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- rate_restday
      $this->field_config['rate_restday']               = array();
      $this->field_config['rate_restday']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['rate_restday']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['rate_restday']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['rate_restday']['symbol_mon'] = '';
      $this->field_config['rate_restday']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['rate_restday']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- rate_offday
      $this->field_config['rate_offday']               = array();
      $this->field_config['rate_offday']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['rate_offday']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['rate_offday']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['rate_offday']['symbol_mon'] = '';
      $this->field_config['rate_offday']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['rate_offday']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- rate_commission1
      $this->field_config['rate_commission1']               = array();
      $this->field_config['rate_commission1']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['rate_commission1']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['rate_commission1']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['rate_commission1']['symbol_mon'] = '';
      $this->field_config['rate_commission1']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['rate_commission1']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- rate_prime1
      $this->field_config['rate_prime1']               = array();
      $this->field_config['rate_prime1']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['rate_prime1']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['rate_prime1']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['rate_prime1']['symbol_mon'] = '';
      $this->field_config['rate_prime1']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['rate_prime1']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- rate_omission1
      $this->field_config['rate_omission1']               = array();
      $this->field_config['rate_omission1']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['rate_omission1']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['rate_omission1']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['rate_omission1']['symbol_mon'] = '';
      $this->field_config['rate_omission1']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['rate_omission1']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- rate_assmd
      $this->field_config['rate_assmd']               = array();
      $this->field_config['rate_assmd']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['rate_assmd']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['rate_assmd']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['rate_assmd']['symbol_mon'] = '';
      $this->field_config['rate_assmd']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['rate_assmd']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- rate_iric
      $this->field_config['rate_iric']               = array();
      $this->field_config['rate_iric']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['rate_iric']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['rate_iric']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['rate_iric']['symbol_mon'] = '';
      $this->field_config['rate_iric']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['rate_iric']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- rate_cons
      $this->field_config['rate_cons']               = array();
      $this->field_config['rate_cons']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['rate_cons']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['rate_cons']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['rate_cons']['symbol_mon'] = '';
      $this->field_config['rate_cons']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['rate_cons']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- day_cons
      $this->field_config['day_cons']               = array();
      $this->field_config['day_cons']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['day_cons']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['day_cons']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['day_cons']['symbol_mon'] = '';
      $this->field_config['day_cons']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['day_cons']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- incentive
      $this->field_config['incentive']               = array();
      $this->field_config['incentive']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['incentive']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['incentive']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['incentive']['symbol_mon'] = '';
      $this->field_config['incentive']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['incentive']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- rappel
      $this->field_config['rappel']               = array();
      $this->field_config['rappel']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['rappel']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['rappel']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['rappel']['symbol_mon'] = '';
      $this->field_config['rappel']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['rappel']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- other_deduct
      $this->field_config['other_deduct']               = array();
      $this->field_config['other_deduct']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['other_deduct']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['other_deduct']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['other_deduct']['symbol_mon'] = '';
      $this->field_config['other_deduct']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['other_deduct']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- loan
      $this->field_config['loan']               = array();
      $this->field_config['loan']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['loan']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['loan']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['loan']['symbol_mon'] = '';
      $this->field_config['loan']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['loan']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- date_loan
      $this->field_config['date_loan']                 = array();
      $this->field_config['date_loan']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['date_loan']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['date_loan']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'date_loan');
      //-- payment
      $this->field_config['payment']               = array();
      $this->field_config['payment']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['payment']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['payment']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['payment']['symbol_mon'] = '';
      $this->field_config['payment']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['payment']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- date_payment
      $this->field_config['date_payment']                 = array();
      $this->field_config['date_payment']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['date_payment']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['date_payment']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'date_payment');
      //-- loan_deduction
      $this->field_config['loan_deduction']               = array();
      $this->field_config['loan_deduction']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['loan_deduction']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['loan_deduction']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['loan_deduction']['symbol_mon'] = '';
      $this->field_config['loan_deduction']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['loan_deduction']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- loan_start_deduct
      $this->field_config['loan_start_deduct']                 = array();
      $this->field_config['loan_start_deduct']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['loan_start_deduct']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['loan_start_deduct']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'loan_start_deduct');
      //-- loan_monthlypayment
      $this->field_config['loan_monthlypayment']               = array();
      $this->field_config['loan_monthlypayment']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['loan_monthlypayment']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['loan_monthlypayment']['symbol_dec'] = '';
      $this->field_config['loan_monthlypayment']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['loan_monthlypayment']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- loan_end_deduct
      $this->field_config['loan_end_deduct']                 = array();
      $this->field_config['loan_end_deduct']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['loan_end_deduct']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['loan_end_deduct']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'loan_end_deduct');
      //-- apply_loan_deduction
      $this->field_config['apply_loan_deduction']               = array();
      $this->field_config['apply_loan_deduction']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['apply_loan_deduction']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['apply_loan_deduction']['symbol_dec'] = '';
      $this->field_config['apply_loan_deduction']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['apply_loan_deduction']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- loan_bank
      $this->field_config['loan_bank']               = array();
      $this->field_config['loan_bank']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['loan_bank']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['loan_bank']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['loan_bank']['symbol_mon'] = '';
      $this->field_config['loan_bank']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['loan_bank']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- date_loan_bank
      $this->field_config['date_loan_bank']                 = array();
      $this->field_config['date_loan_bank']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['date_loan_bank']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['date_loan_bank']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'date_loan_bank');
      //-- loan_deduction_bank
      $this->field_config['loan_deduction_bank']               = array();
      $this->field_config['loan_deduction_bank']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['loan_deduction_bank']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['loan_deduction_bank']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['loan_deduction_bank']['symbol_mon'] = '';
      $this->field_config['loan_deduction_bank']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['loan_deduction_bank']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- loan_start_deduct_bank
      $this->field_config['loan_start_deduct_bank']                 = array();
      $this->field_config['loan_start_deduct_bank']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['loan_start_deduct_bank']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['loan_start_deduct_bank']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'loan_start_deduct_bank');
      //-- loan_end_deduct_bank
      $this->field_config['loan_end_deduct_bank']                 = array();
      $this->field_config['loan_end_deduct_bank']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['loan_end_deduct_bank']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['loan_end_deduct_bank']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'loan_end_deduct_bank');
      //-- apply_loan_deduction_bank
      $this->field_config['apply_loan_deduction_bank']               = array();
      $this->field_config['apply_loan_deduction_bank']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['apply_loan_deduction_bank']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['apply_loan_deduction_bank']['symbol_dec'] = '';
      $this->field_config['apply_loan_deduction_bank']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['apply_loan_deduction_bank']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- other_loan
      $this->field_config['other_loan']               = array();
      $this->field_config['other_loan']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['other_loan']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['other_loan']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['other_loan']['symbol_mon'] = '';
      $this->field_config['other_loan']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['other_loan']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- date_other_loan
      $this->field_config['date_other_loan']                 = array();
      $this->field_config['date_other_loan']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['date_other_loan']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['date_other_loan']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'date_other_loan');
      //-- other_loan_deduction
      $this->field_config['other_loan_deduction']               = array();
      $this->field_config['other_loan_deduction']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['other_loan_deduction']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['other_loan_deduction']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['other_loan_deduction']['symbol_mon'] = '';
      $this->field_config['other_loan_deduction']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['other_loan_deduction']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- other_loan_start_deduct
      $this->field_config['other_loan_start_deduct']                 = array();
      $this->field_config['other_loan_start_deduct']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['other_loan_start_deduct']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['other_loan_start_deduct']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'other_loan_start_deduct');
      //-- other_loan_monthlypayment
      $this->field_config['other_loan_monthlypayment']               = array();
      $this->field_config['other_loan_monthlypayment']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['other_loan_monthlypayment']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['other_loan_monthlypayment']['symbol_dec'] = '';
      $this->field_config['other_loan_monthlypayment']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['other_loan_monthlypayment']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- other_loan_end_deduct
      $this->field_config['other_loan_end_deduct']                 = array();
      $this->field_config['other_loan_end_deduct']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['other_loan_end_deduct']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['other_loan_end_deduct']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'other_loan_end_deduct');
      //-- apply_other_loan_deduction
      $this->field_config['apply_other_loan_deduction']               = array();
      $this->field_config['apply_other_loan_deduction']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['apply_other_loan_deduction']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['apply_other_loan_deduction']['symbol_dec'] = '';
      $this->field_config['apply_other_loan_deduction']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['apply_other_loan_deduction']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- purchase
      $this->field_config['purchase']               = array();
      $this->field_config['purchase']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['purchase']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['purchase']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['purchase']['symbol_mon'] = '';
      $this->field_config['purchase']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['purchase']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- date_purchase
      $this->field_config['date_purchase']                 = array();
      $this->field_config['date_purchase']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['date_purchase']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['date_purchase']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'date_purchase');
      //-- purchase_deduct
      $this->field_config['purchase_deduct']               = array();
      $this->field_config['purchase_deduct']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['purchase_deduct']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['purchase_deduct']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['purchase_deduct']['symbol_mon'] = '';
      $this->field_config['purchase_deduct']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['purchase_deduct']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- purchase_start_deduct
      $this->field_config['purchase_start_deduct']                 = array();
      $this->field_config['purchase_start_deduct']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['purchase_start_deduct']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['purchase_start_deduct']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'purchase_start_deduct');
      //-- purchase_monthlypayment
      $this->field_config['purchase_monthlypayment']               = array();
      $this->field_config['purchase_monthlypayment']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['purchase_monthlypayment']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['purchase_monthlypayment']['symbol_dec'] = '';
      $this->field_config['purchase_monthlypayment']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['purchase_monthlypayment']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- purchase_end_deduct
      $this->field_config['purchase_end_deduct']                 = array();
      $this->field_config['purchase_end_deduct']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['purchase_end_deduct']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['purchase_end_deduct']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'purchase_end_deduct');
      //-- apply_purchase_deduct
      $this->field_config['apply_purchase_deduct']               = array();
      $this->field_config['apply_purchase_deduct']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['apply_purchase_deduct']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['apply_purchase_deduct']['symbol_dec'] = '';
      $this->field_config['apply_purchase_deduct']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['apply_purchase_deduct']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- health_insurance
      $this->field_config['health_insurance']               = array();
      $this->field_config['health_insurance']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['health_insurance']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['health_insurance']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['health_insurance']['symbol_mon'] = '';
      $this->field_config['health_insurance']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['health_insurance']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- update_time
      $this->field_config['update_time']                 = array();
      $this->field_config['update_time']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['update_time']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['update_time']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['update_time']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'update_time');
   }

   function controle()
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      $this->ini_controle();

      if ('' != $_SESSION['scriptcase']['change_regional_old'])
      {
          $_SESSION['scriptcase']['str_conf_reg'] = $_SESSION['scriptcase']['change_regional_old'];
          $this->Ini->regionalDefault($_SESSION['scriptcase']['str_conf_reg']);
          $this->loadFieldConfig();
          $this->nm_tira_formatacao();

          $_SESSION['scriptcase']['str_conf_reg'] = $_SESSION['scriptcase']['change_regional_new'];
          $this->Ini->regionalDefault($_SESSION['scriptcase']['str_conf_reg']);
          $this->loadFieldConfig();
          $guarda_formatado = $this->formatado;
          $this->nm_formatar_campos();
          $this->formatado = $guarda_formatado;

          $_SESSION['scriptcase']['change_regional_old'] = '';
          $_SESSION['scriptcase']['change_regional_new'] = '';
      }

      if ($nm_form_submit == 1 && ($this->nmgp_opcao == 'inicio' || $this->nmgp_opcao == 'igual'))
      {
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "incluir") {
          $this->employee_name = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['employee_name'];
          $this->ic = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['ic'];
          $this->designation = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['designation'];
          $this->dept = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['dept'];
          $this->gender = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['gender'];
          $this->dob = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['dob'];
      if ((!empty($this->dob) && 'null' != $this->dob) || (!empty($format_fields) && isset($format_fields['dob'])))
      {
          nm_volta_data($this->dob, $this->field_config['dob']['date_format']) ; 
          nmgp_Form_Datas($this->dob, $this->field_config['dob']['date_format'], $this->field_config['dob']['date_sep']) ;  
      }
      elseif ('null' == $this->dob || '' == $this->dob)
      {
          $this->dob = '';
      }
          $this->address = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['address'];
          $this->phone = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['phone'];
          $this->hiredate = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['hiredate'];
      if ((!empty($this->hiredate) && 'null' != $this->hiredate) || (!empty($format_fields) && isset($format_fields['hiredate'])))
      {
          nm_volta_data($this->hiredate, $this->field_config['hiredate']['date_format']) ; 
          nmgp_Form_Datas($this->hiredate, $this->field_config['hiredate']['date_format'], $this->field_config['hiredate']['date_sep']) ;  
      }
      elseif ('null' == $this->hiredate || '' == $this->hiredate)
      {
          $this->hiredate = '';
      }
          $this->email = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['email'];
          $this->firedate = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['firedate'];
      if ((!empty($this->firedate) && 'null' != $this->firedate) || (!empty($format_fields) && isset($format_fields['firedate'])))
      {
          nm_volta_data($this->firedate, $this->field_config['firedate']['date_format']) ; 
          nmgp_Form_Datas($this->firedate, $this->field_config['firedate']['date_format'], $this->field_config['firedate']['date_sep']) ;  
      }
      elseif ('null' == $this->firedate || '' == $this->firedate)
      {
          $this->firedate = '';
      }
          $this->hiring_duration = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['hiring_duration'];
      if ('' !== $this->hiring_duration || (!empty($format_fields) && isset($format_fields['hiring_duration'])))
      {
          nmgp_Form_Num_Val($this->hiring_duration, $this->field_config['hiring_duration']['symbol_grp'], $this->field_config['hiring_duration']['symbol_dec'], "2", "S", $this->field_config['hiring_duration']['format_neg'], "", "", "-", $this->field_config['hiring_duration']['symbol_fmt']) ; 
      }
          $this->tax_cass = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['tax_cass'];
      if ('' !== $this->tax_cass || (!empty($format_fields) && isset($format_fields['tax_cass'])))
      {
          nmgp_Form_Num_Val($this->tax_cass, $this->field_config['tax_cass']['symbol_grp'], $this->field_config['tax_cass']['symbol_dec'], "2", "S", $this->field_config['tax_cass']['format_neg'], "", "", "-", $this->field_config['tax_cass']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['tax_cass']['symbol_mon'];
          $this->sc_add_currency($this->tax_cass, $sMonSymb, $this->field_config['tax_cass']['format_pos']); 
      }
          $this->tax_cfgdct = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['tax_cfgdct'];
      if ('' !== $this->tax_cfgdct || (!empty($format_fields) && isset($format_fields['tax_cfgdct'])))
      {
          nmgp_Form_Num_Val($this->tax_cfgdct, $this->field_config['tax_cfgdct']['symbol_grp'], $this->field_config['tax_cfgdct']['symbol_dec'], "2", "S", $this->field_config['tax_cfgdct']['format_neg'], "", "", "-", $this->field_config['tax_cfgdct']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['tax_cfgdct']['symbol_mon'];
          $this->sc_add_currency($this->tax_cfgdct, $sMonSymb, $this->field_config['tax_cfgdct']['format_pos']); 
      }
          $this->tax_ona = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['tax_ona'];
      if ('' !== $this->tax_ona || (!empty($format_fields) && isset($format_fields['tax_ona'])))
      {
          nmgp_Form_Num_Val($this->tax_ona, $this->field_config['tax_ona']['symbol_grp'], $this->field_config['tax_ona']['symbol_dec'], "2", "S", $this->field_config['tax_ona']['format_neg'], "", "", "-", $this->field_config['tax_ona']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['tax_ona']['symbol_mon'];
          $this->sc_add_currency($this->tax_ona, $sMonSymb, $this->field_config['tax_ona']['format_pos']); 
      }
          $this->tax_fdu = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['tax_fdu'];
      if ('' !== $this->tax_fdu || (!empty($format_fields) && isset($format_fields['tax_fdu'])))
      {
          nmgp_Form_Num_Val($this->tax_fdu, $this->field_config['tax_fdu']['symbol_grp'], $this->field_config['tax_fdu']['symbol_dec'], "2", "S", $this->field_config['tax_fdu']['format_neg'], "", "", "-", $this->field_config['tax_fdu']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['tax_fdu']['symbol_mon'];
          $this->sc_add_currency($this->tax_fdu, $sMonSymb, $this->field_config['tax_fdu']['format_pos']); 
      }
          $this->rate_iris = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['rate_iris'];
      if ('' !== $this->rate_iris || (!empty($format_fields) && isset($format_fields['rate_iris'])))
      {
          nmgp_Form_Num_Val($this->rate_iris, $this->field_config['rate_iris']['symbol_grp'], $this->field_config['rate_iris']['symbol_dec'], "2", "S", $this->field_config['rate_iris']['format_neg'], "", "", "-", $this->field_config['rate_iris']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['rate_iris']['symbol_mon'];
          $this->sc_add_currency($this->rate_iris, $sMonSymb, $this->field_config['rate_iris']['format_pos']); 
      }
          $this->revenu_net = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['revenu_net'];
      if ('' !== $this->revenu_net || (!empty($format_fields) && isset($format_fields['revenu_net'])))
      {
          nmgp_Form_Num_Val($this->revenu_net, $this->field_config['revenu_net']['symbol_grp'], $this->field_config['revenu_net']['symbol_dec'], "2", "S", $this->field_config['revenu_net']['format_neg'], "", "", "-", $this->field_config['revenu_net']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['revenu_net']['symbol_mon'];
          $this->sc_add_currency($this->revenu_net, $sMonSymb, $this->field_config['revenu_net']['format_pos']); 
      }
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") {
          $this->employee_name = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['employee_name'];
          $this->ic = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['ic'];
          $this->designation = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['designation'];
          $this->dept = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['dept'];
          $this->gender = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['gender'];
          $this->dob = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['dob'];
      if ((!empty($this->dob) && 'null' != $this->dob) || (!empty($format_fields) && isset($format_fields['dob'])))
      {
          nm_volta_data($this->dob, $this->field_config['dob']['date_format']) ; 
          nmgp_Form_Datas($this->dob, $this->field_config['dob']['date_format'], $this->field_config['dob']['date_sep']) ;  
      }
      elseif ('null' == $this->dob || '' == $this->dob)
      {
          $this->dob = '';
      }
          $this->address = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['address'];
          $this->phone = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['phone'];
          $this->hiredate = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['hiredate'];
      if ((!empty($this->hiredate) && 'null' != $this->hiredate) || (!empty($format_fields) && isset($format_fields['hiredate'])))
      {
          nm_volta_data($this->hiredate, $this->field_config['hiredate']['date_format']) ; 
          nmgp_Form_Datas($this->hiredate, $this->field_config['hiredate']['date_format'], $this->field_config['hiredate']['date_sep']) ;  
      }
      elseif ('null' == $this->hiredate || '' == $this->hiredate)
      {
          $this->hiredate = '';
      }
          $this->email = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['email'];
          $this->firedate = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['firedate'];
      if ((!empty($this->firedate) && 'null' != $this->firedate) || (!empty($format_fields) && isset($format_fields['firedate'])))
      {
          nm_volta_data($this->firedate, $this->field_config['firedate']['date_format']) ; 
          nmgp_Form_Datas($this->firedate, $this->field_config['firedate']['date_format'], $this->field_config['firedate']['date_sep']) ;  
      }
      elseif ('null' == $this->firedate || '' == $this->firedate)
      {
          $this->firedate = '';
      }
          $this->hiring_duration = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['hiring_duration'];
      if ('' !== $this->hiring_duration || (!empty($format_fields) && isset($format_fields['hiring_duration'])))
      {
          nmgp_Form_Num_Val($this->hiring_duration, $this->field_config['hiring_duration']['symbol_grp'], $this->field_config['hiring_duration']['symbol_dec'], "2", "S", $this->field_config['hiring_duration']['format_neg'], "", "", "-", $this->field_config['hiring_duration']['symbol_fmt']) ; 
      }
          $this->tax_cass = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['tax_cass'];
      if ('' !== $this->tax_cass || (!empty($format_fields) && isset($format_fields['tax_cass'])))
      {
          nmgp_Form_Num_Val($this->tax_cass, $this->field_config['tax_cass']['symbol_grp'], $this->field_config['tax_cass']['symbol_dec'], "2", "S", $this->field_config['tax_cass']['format_neg'], "", "", "-", $this->field_config['tax_cass']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['tax_cass']['symbol_mon'];
          $this->sc_add_currency($this->tax_cass, $sMonSymb, $this->field_config['tax_cass']['format_pos']); 
      }
          $this->tax_cfgdct = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['tax_cfgdct'];
      if ('' !== $this->tax_cfgdct || (!empty($format_fields) && isset($format_fields['tax_cfgdct'])))
      {
          nmgp_Form_Num_Val($this->tax_cfgdct, $this->field_config['tax_cfgdct']['symbol_grp'], $this->field_config['tax_cfgdct']['symbol_dec'], "2", "S", $this->field_config['tax_cfgdct']['format_neg'], "", "", "-", $this->field_config['tax_cfgdct']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['tax_cfgdct']['symbol_mon'];
          $this->sc_add_currency($this->tax_cfgdct, $sMonSymb, $this->field_config['tax_cfgdct']['format_pos']); 
      }
          $this->tax_ona = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['tax_ona'];
      if ('' !== $this->tax_ona || (!empty($format_fields) && isset($format_fields['tax_ona'])))
      {
          nmgp_Form_Num_Val($this->tax_ona, $this->field_config['tax_ona']['symbol_grp'], $this->field_config['tax_ona']['symbol_dec'], "2", "S", $this->field_config['tax_ona']['format_neg'], "", "", "-", $this->field_config['tax_ona']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['tax_ona']['symbol_mon'];
          $this->sc_add_currency($this->tax_ona, $sMonSymb, $this->field_config['tax_ona']['format_pos']); 
      }
          $this->tax_fdu = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['tax_fdu'];
      if ('' !== $this->tax_fdu || (!empty($format_fields) && isset($format_fields['tax_fdu'])))
      {
          nmgp_Form_Num_Val($this->tax_fdu, $this->field_config['tax_fdu']['symbol_grp'], $this->field_config['tax_fdu']['symbol_dec'], "2", "S", $this->field_config['tax_fdu']['format_neg'], "", "", "-", $this->field_config['tax_fdu']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['tax_fdu']['symbol_mon'];
          $this->sc_add_currency($this->tax_fdu, $sMonSymb, $this->field_config['tax_fdu']['format_pos']); 
      }
          $this->rate_iris = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['rate_iris'];
      if ('' !== $this->rate_iris || (!empty($format_fields) && isset($format_fields['rate_iris'])))
      {
          nmgp_Form_Num_Val($this->rate_iris, $this->field_config['rate_iris']['symbol_grp'], $this->field_config['rate_iris']['symbol_dec'], "2", "S", $this->field_config['rate_iris']['format_neg'], "", "", "-", $this->field_config['rate_iris']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['rate_iris']['symbol_mon'];
          $this->sc_add_currency($this->rate_iris, $sMonSymb, $this->field_config['rate_iris']['format_pos']); 
      }
          $this->revenu_net = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['revenu_net'];
      if ('' !== $this->revenu_net || (!empty($format_fields) && isset($format_fields['revenu_net'])))
      {
          nmgp_Form_Num_Val($this->revenu_net, $this->field_config['revenu_net']['symbol_grp'], $this->field_config['revenu_net']['symbol_dec'], "2", "S", $this->field_config['revenu_net']['format_neg'], "", "", "-", $this->field_config['revenu_net']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['revenu_net']['symbol_mon'];
          $this->sc_add_currency($this->revenu_net, $sMonSymb, $this->field_config['revenu_net']['format_pos']); 
      }
      }
      if (!$this->NM_ajax_flag || 'alterar' != $this->nmgp_opcao || 'submit_form' != $this->NM_ajax_opcao)
      {
      }
//
//-----> 
//
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('validate_userid_int' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'userid_int');
          }
          if ('validate_employee_name' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'employee_name');
          }
          if ('validate_ic' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ic');
          }
          if ('validate_designation' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'designation');
          }
          if ('validate_dept' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'dept');
          }
          if ('validate_gender' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'gender');
          }
          if ('validate_dob' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'dob');
          }
          if ('validate_address' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'address');
          }
          if ('validate_phone' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'phone');
          }
          if ('validate_hiredate' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hiredate');
          }
          if ('validate_email' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'email');
          }
          if ('validate_field01' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'field01');
          }
          if ('validate_firedate' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'firedate');
          }
          if ('validate_hiring_duration' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hiring_duration');
          }
          if ('validate_photo_name' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'photo_name');
          }
          if ('validate_photo_size' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'photo_size');
          }
          if ('validate_rate_cass' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'rate_cass');
          }
          if ('validate_tax_cass' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tax_cass');
          }
          if ('validate_rate_cfgdct' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'rate_cfgdct');
          }
          if ('validate_tax_cfgdct' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tax_cfgdct');
          }
          if ('validate_rate_ona' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'rate_ona');
          }
          if ('validate_tax_ona' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tax_ona');
          }
          if ('validate_rate_fdu' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'rate_fdu');
          }
          if ('validate_tax_fdu' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tax_fdu');
          }
          if ('validate_field02' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'field02');
          }
          if ('validate_rate_iris' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'rate_iris');
          }
          if ('validate_rate_fixed' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'rate_fixed');
          }
          if ('validate_revenu_net' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'revenu_net');
          }
          if ('validate_block_note' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'block_note');
          }
          form_FicheEmployeeSuspended_mob_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['employee_name']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->employee_name = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['employee_name'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['ic']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->ic = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['ic'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['designation']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->designation = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['designation'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['dept']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->dept = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['dept'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['gender']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->gender = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['gender'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['dob']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->dob = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['dob'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['address']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->address = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['address'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['phone']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->phone = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['phone'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['hiredate']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->hiredate = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['hiredate'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['email']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->email = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['email'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['firedate']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->firedate = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['firedate'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['hiring_duration']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->hiring_duration = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['hiring_duration'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['tax_cass']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->tax_cass = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['tax_cass'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['tax_cfgdct']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->tax_cfgdct = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['tax_cfgdct'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['tax_ona']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->tax_ona = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['tax_ona'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['tax_fdu']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->tax_fdu = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['tax_fdu'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['rate_iris']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->rate_iris = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['rate_iris'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['revenu_net']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->revenu_net = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select']['revenu_net'];
          } 
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              form_FicheEmployeeSuspended_mob_pack_ajax_response();
              exit;
          }
          $this->nm_formatar_campos();
          $this->nmgp_opcao = $nm_sc_sv_opcao; 
          $this->nm_gera_html();
          $this->NM_close_db(); 
          $this->nmgp_opcao = ""; 
          exit; 
      }
      if ($this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") 
      {
          $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  form_FicheEmployeeSuspended_mob_pack_ajax_response();
                  exit;
              }
              $campos_erro = $this->Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros, 4);
              $this->Campos_Mens_erro = ""; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $campos_erro, '', true, true); 
              $this->nmgp_opc_ant = $this->nmgp_opcao ; 
              if ($this->nmgp_opcao == "incluir" && $nm_apl_dependente == 1) 
              { 
                  $this->nm_flag_saida_novo = "S";; 
              }
              if ($this->nmgp_opcao == "incluir") 
              { 
                  $GLOBALS["erro_incl"] = 1; 
              }
              $this->nmgp_opcao = "nada" ; 
          }
      }
      elseif (isset($nm_form_submit) && 1 == $nm_form_submit && $this->nmgp_opcao != "menu_link" && $this->nmgp_opcao != "recarga_mobile")
      {
      }
//
      if ($this->nmgp_opcao != "nada")
      {
          $this->nm_acessa_banco();
      }
      else
      {
           if ($this->nmgp_opc_ant == "incluir") 
           { 
               $this->nm_proc_onload(false);
           }
           else
           { 
              $this->nm_guardar_campos();
           }
      }
      if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form" && !$this->Apl_com_erro)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['sc_redir_atualiz'] == "ok")
          {
              if ($this->sc_evento == "update")
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
              if ($this->sc_evento == "delete")
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
      }
      if ($this->NM_ajax_flag && 'navigate_form' == $this->NM_ajax_opcao)
      {
          $this->ajax_return_values();
          $this->ajax_add_parameters();
          form_FicheEmployeeSuspended_mob_pack_ajax_response();
          exit;
      }
      $this->nm_formatar_campos();
      if ($this->NM_ajax_flag)
      {
          $this->NM_ajax_info['result'] = 'OK';
          if ('alterar' == $this->NM_ajax_info['param']['nmgp_opcao'])
          {
              $this->NM_ajax_info['msgDisplay'] = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_ajax_frmu']);
          }
          form_FicheEmployeeSuspended_mob_pack_ajax_response();
          exit;
      }
      $this->nm_gera_html();
      $this->NM_close_db(); 
      $this->nmgp_opcao = ""; 
      if ($this->Change_Menu)
      {
          $apl_menu  = $_SESSION['scriptcase']['menu_atual'];
          $Arr_rastro = array();
          if (isset($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu]) && count($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu]) > 1)
          {
              foreach ($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu] as $menu => $apls)
              {
                 $Arr_rastro[] = "'<a href=\"" . $apls['link'] . "?script_case_init=" . $this->sc_init_menu . "\" target=\"#NMIframe#\">" . $apls['label'] . "</a>'";
              }
              $ult_apl = count($Arr_rastro) - 1;
              unset($Arr_rastro[$ult_apl]);
              $rastro = implode(",", $Arr_rastro);
?>
  <script type="text/javascript">
     link_atual = new Array (<?php echo $rastro ?>);
     if (parent.writeFastMenu)
     {
         parent.writeFastMenu(link_atual);
     }
  </script>
<?php
          }
          else
          {
?>
  <script type="text/javascript">
     if (parent.clearFastMenu)
     {
        parent.clearFastMenu();
     }
  </script>
<?php
          }
      }
   }
  function html_export_print($nm_arquivo_html, $nmgp_password)
  {
      $Html_password = "";
          $Arq_base  = $this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_html;
          $Parm_pass = ($Html_password != "") ? " -p" : "";
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "form_FicheEmployeeSuspended_mob.zip";
          $Arq_htm = $this->Ini->path_imag_temp . "/" . $Zip_name;
          $Arq_zip = $this->Ini->root . $Arq_htm;
          $Zip_f     = (FALSE !== strpos($Arq_zip, ' ')) ? " \"" . $Arq_zip . "\"" :  $Arq_zip;
          $Arq_input = (FALSE !== strpos($Arq_base, ' ')) ? " \"" . $Arq_base . "\"" :  $Arq_base;
           if (is_file($Arq_zip)) {
               unlink($Arq_zip);
           }
           $str_zip = "";
           if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
           {
               chdir($this->Ini->path_third . "/zip/windows");
               $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $Html_password . " " . $Zip_f . " " . $Arq_input;
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
               $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $Arq_input;
           }
           elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
           {
               chdir($this->Ini->path_third . "/zip/mac/bin");
               $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $Arq_input;
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
           foreach ($this->Ini->Img_export_zip as $cada_img_zip)
           {
               $str_zip      = "";
              $cada_img_zip = '"' . $cada_img_zip . '"';
               if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
               {
                   $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $Html_password . " " . $Zip_f . " " . $cada_img_zip;
               }
               elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
               {
                   $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $cada_img_zip;
               }
               elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
               {
                   $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $cada_img_zip;
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
           }
           if (is_file($Arq_zip)) {
               unlink($Arq_base);
           } 
          $path_doc_md5 = md5($Arq_htm);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("Employee Sheet") ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
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
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" /> 
  <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod; ?>/third/font-awesome/6/css/all.min.css" /> 
  <link rel="shortcut icon" href="../_lib/img/sys__NM__ico__NM__favicon (2).ico">
</HEAD>
<BODY class="scExportPage">
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: top">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">PRINT</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
   <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

   <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

   <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo  $this->form_encode_input($Arq_htm) ?>" target="_self" style="display: none"> 
</form>
<form name="Fdown" method="get" action="form_FicheEmployeeSuspended_mob_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="form_FicheEmployeeSuspended_mob"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="form_FicheEmployeeSuspended_mob.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nmgp_opcao" value="<?php echo $this->nmgp_opcao ?>"> 
</form> 
         </BODY>
         </HTML>
<?php
          exit;
  }
//
//--------------------------------------------------------------------------------------
   function NM_has_trans()
   {
       return !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access);
   }
//
//--------------------------------------------------------------------------------------
   function NM_commit_db()
   {
       if ($this->Ini->sc_tem_trans_banco && !$this->Embutida_proc)
       { 
           $this->Db->CommitTrans(); 
           $this->Ini->sc_tem_trans_banco = false;
       } 
   }
//
//--------------------------------------------------------------------------------------
   function NM_rollback_db()
   {
       if ($this->Ini->sc_tem_trans_banco && !$this->Embutida_proc)
       { 
           $this->Db->RollbackTrans(); 
           $this->Ini->sc_tem_trans_banco = false;
       } 
   }
//
//--------------------------------------------------------------------------------------
   function NM_close_db()
   {
       if ($this->Db && !$this->Embutida_proc)
       { 
           $this->Db->Close(); 
       } 
   }
   function sc_btn_sc_btn_0() 
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;
 
     ob_start();
     if (empty($this->photo_name)) {
         $this->photo_name = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['photo_name'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['photo_name'] : "";
     }
?>
<!DOCTYPE html>

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
 <head>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

      if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
      {
?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
      }

?>
        <link rel="shortcut icon" href="../_lib/img/sys__NM__ico__NM__favicon (2).ico">
    <SCRIPT type="text/javascript">
      var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
      var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
      var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
      var sc_userSweetAlertDisplayed = false;
    </SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
<?php
include_once("form_FicheEmployeeSuspended_mob_sajax_js.php");
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <script type="text/javascript" src="../_lib/lib/js/frameControl.js"></script>
    <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 </head>
  <body class="scFormPage">
      <table class="scFormTabela" align="center"><tr><td>
<?php
      $nmgp_opcao_saida_php = "igual";
      $nmgp_opc_ant_saida_php = "";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      $nm_f_saida = "form_FicheEmployeeSuspended_mob.php";
      nm_limpa_numero($this->userid_int, $this->field_config['userid_int']['symbol_grp']) ; 
      nm_limpa_data($this->dob, $this->field_config['dob']['date_sep']) ; 
      nm_limpa_data($this->hiredate, $this->field_config['hiredate']['date_sep']) ; 
      nm_limpa_data($this->firedate, $this->field_config['firedate']['date_sep']) ; 
      if (!empty($this->field_config['hiring_duration']['symbol_dec']))
      {
          nm_limpa_valor($this->hiring_duration, $this->field_config['hiring_duration']['symbol_dec'], $this->field_config['hiring_duration']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['rate_cass']['symbol_dec']))
      {
          nm_limpa_valor($this->rate_cass, $this->field_config['rate_cass']['symbol_dec'], $this->field_config['rate_cass']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['tax_cass']['symbol_dec']))
      {
          $this->sc_remove_currency($this->tax_cass, $this->field_config['tax_cass']['symbol_dec'], $this->field_config['tax_cass']['symbol_grp'], $this->field_config['tax_cass']['symbol_mon']); 
          nm_limpa_valor($this->tax_cass, $this->field_config['tax_cass']['symbol_dec'], $this->field_config['tax_cass']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['rate_cfgdct']['symbol_dec']))
      {
          nm_limpa_valor($this->rate_cfgdct, $this->field_config['rate_cfgdct']['symbol_dec'], $this->field_config['rate_cfgdct']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['tax_cfgdct']['symbol_dec']))
      {
          $this->sc_remove_currency($this->tax_cfgdct, $this->field_config['tax_cfgdct']['symbol_dec'], $this->field_config['tax_cfgdct']['symbol_grp'], $this->field_config['tax_cfgdct']['symbol_mon']); 
          nm_limpa_valor($this->tax_cfgdct, $this->field_config['tax_cfgdct']['symbol_dec'], $this->field_config['tax_cfgdct']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['rate_ona']['symbol_dec']))
      {
          nm_limpa_valor($this->rate_ona, $this->field_config['rate_ona']['symbol_dec'], $this->field_config['rate_ona']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['tax_ona']['symbol_dec']))
      {
          $this->sc_remove_currency($this->tax_ona, $this->field_config['tax_ona']['symbol_dec'], $this->field_config['tax_ona']['symbol_grp'], $this->field_config['tax_ona']['symbol_mon']); 
          nm_limpa_valor($this->tax_ona, $this->field_config['tax_ona']['symbol_dec'], $this->field_config['tax_ona']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['rate_fdu']['symbol_dec']))
      {
          nm_limpa_valor($this->rate_fdu, $this->field_config['rate_fdu']['symbol_dec'], $this->field_config['rate_fdu']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['tax_fdu']['symbol_dec']))
      {
          $this->sc_remove_currency($this->tax_fdu, $this->field_config['tax_fdu']['symbol_dec'], $this->field_config['tax_fdu']['symbol_grp'], $this->field_config['tax_fdu']['symbol_mon']); 
          nm_limpa_valor($this->tax_fdu, $this->field_config['tax_fdu']['symbol_dec'], $this->field_config['tax_fdu']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['rate_iris']['symbol_dec']))
      {
          $this->sc_remove_currency($this->rate_iris, $this->field_config['rate_iris']['symbol_dec'], $this->field_config['rate_iris']['symbol_grp'], $this->field_config['rate_iris']['symbol_mon']); 
          nm_limpa_valor($this->rate_iris, $this->field_config['rate_iris']['symbol_dec'], $this->field_config['rate_iris']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['rate_fixed']['symbol_dec']))
      {
          $this->sc_remove_currency($this->rate_fixed, $this->field_config['rate_fixed']['symbol_dec'], $this->field_config['rate_fixed']['symbol_grp'], $this->field_config['rate_fixed']['symbol_mon']); 
          nm_limpa_valor($this->rate_fixed, $this->field_config['rate_fixed']['symbol_dec'], $this->field_config['rate_fixed']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['revenu_net']['symbol_dec']))
      {
          $this->sc_remove_currency($this->revenu_net, $this->field_config['revenu_net']['symbol_dec'], $this->field_config['revenu_net']['symbol_grp'], $this->field_config['revenu_net']['symbol_mon']); 
          nm_limpa_valor($this->revenu_net, $this->field_config['revenu_net']['symbol_dec'], $this->field_config['revenu_net']['symbol_grp']) ; 
      }
      $this->nm_converte_datas();
      $_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['contr_erro'] = 'on';
  $this->Generate_netrevenue();
$_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['contr_erro'] = 'off'; 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="id" value="<?php echo $this->form_encode_input($this->id) ?>"/>
      <input type=hidden name="nmgp_opcao" value="<?php echo $this->form_encode_input($nmgp_opcao_saida_php); ?>"/>
      <input type=hidden name="nmgp_opc_ant" value="<?php echo $this->form_encode_input($nmgp_opc_ant_saida_php); ?>"/>
      <input type=submit name="nmgp_bok" value="<?php echo $this->Ini->Nm_lang['lang_btns_cfrm'] ?>"/>
      </form>
      </td></tr></table>
      </body>
      </html>
<?php
       if (isset($this->redir_modal) && !empty($this->redir_modal))
       {
           echo "<script type=\"text/javascript\">" . $this->redir_modal . "</script>";
           $this->redir_modal = "";
       }
   }
   function sc_btn_sc_btn_1() 
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;
 
     ob_start();
     if (empty($this->photo_name)) {
         $this->photo_name = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['photo_name'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['photo_name'] : "";
     }
?>
<!DOCTYPE html>

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
 <head>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

      if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
      {
?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
      }

?>
        <link rel="shortcut icon" href="../_lib/img/sys__NM__ico__NM__favicon (2).ico">
    <SCRIPT type="text/javascript">
      var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
      var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
      var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
      var sc_userSweetAlertDisplayed = false;
    </SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
<?php
include_once("form_FicheEmployeeSuspended_mob_sajax_js.php");
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <script type="text/javascript" src="../_lib/lib/js/frameControl.js"></script>
    <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 </head>
  <body class="scFormPage">
      <table class="scFormTabela" align="center"><tr><td>
<?php
      $nmgp_opcao_saida_php = "igual";
      $nmgp_opc_ant_saida_php = "";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      $nm_f_saida = "form_FicheEmployeeSuspended_mob.php";
      nm_limpa_numero($this->userid_int, $this->field_config['userid_int']['symbol_grp']) ; 
      nm_limpa_data($this->dob, $this->field_config['dob']['date_sep']) ; 
      nm_limpa_data($this->hiredate, $this->field_config['hiredate']['date_sep']) ; 
      nm_limpa_data($this->firedate, $this->field_config['firedate']['date_sep']) ; 
      if (!empty($this->field_config['hiring_duration']['symbol_dec']))
      {
          nm_limpa_valor($this->hiring_duration, $this->field_config['hiring_duration']['symbol_dec'], $this->field_config['hiring_duration']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['rate_cass']['symbol_dec']))
      {
          nm_limpa_valor($this->rate_cass, $this->field_config['rate_cass']['symbol_dec'], $this->field_config['rate_cass']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['tax_cass']['symbol_dec']))
      {
          $this->sc_remove_currency($this->tax_cass, $this->field_config['tax_cass']['symbol_dec'], $this->field_config['tax_cass']['symbol_grp'], $this->field_config['tax_cass']['symbol_mon']); 
          nm_limpa_valor($this->tax_cass, $this->field_config['tax_cass']['symbol_dec'], $this->field_config['tax_cass']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['rate_cfgdct']['symbol_dec']))
      {
          nm_limpa_valor($this->rate_cfgdct, $this->field_config['rate_cfgdct']['symbol_dec'], $this->field_config['rate_cfgdct']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['tax_cfgdct']['symbol_dec']))
      {
          $this->sc_remove_currency($this->tax_cfgdct, $this->field_config['tax_cfgdct']['symbol_dec'], $this->field_config['tax_cfgdct']['symbol_grp'], $this->field_config['tax_cfgdct']['symbol_mon']); 
          nm_limpa_valor($this->tax_cfgdct, $this->field_config['tax_cfgdct']['symbol_dec'], $this->field_config['tax_cfgdct']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['rate_ona']['symbol_dec']))
      {
          nm_limpa_valor($this->rate_ona, $this->field_config['rate_ona']['symbol_dec'], $this->field_config['rate_ona']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['tax_ona']['symbol_dec']))
      {
          $this->sc_remove_currency($this->tax_ona, $this->field_config['tax_ona']['symbol_dec'], $this->field_config['tax_ona']['symbol_grp'], $this->field_config['tax_ona']['symbol_mon']); 
          nm_limpa_valor($this->tax_ona, $this->field_config['tax_ona']['symbol_dec'], $this->field_config['tax_ona']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['rate_fdu']['symbol_dec']))
      {
          nm_limpa_valor($this->rate_fdu, $this->field_config['rate_fdu']['symbol_dec'], $this->field_config['rate_fdu']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['tax_fdu']['symbol_dec']))
      {
          $this->sc_remove_currency($this->tax_fdu, $this->field_config['tax_fdu']['symbol_dec'], $this->field_config['tax_fdu']['symbol_grp'], $this->field_config['tax_fdu']['symbol_mon']); 
          nm_limpa_valor($this->tax_fdu, $this->field_config['tax_fdu']['symbol_dec'], $this->field_config['tax_fdu']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['rate_iris']['symbol_dec']))
      {
          $this->sc_remove_currency($this->rate_iris, $this->field_config['rate_iris']['symbol_dec'], $this->field_config['rate_iris']['symbol_grp'], $this->field_config['rate_iris']['symbol_mon']); 
          nm_limpa_valor($this->rate_iris, $this->field_config['rate_iris']['symbol_dec'], $this->field_config['rate_iris']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['rate_fixed']['symbol_dec']))
      {
          $this->sc_remove_currency($this->rate_fixed, $this->field_config['rate_fixed']['symbol_dec'], $this->field_config['rate_fixed']['symbol_grp'], $this->field_config['rate_fixed']['symbol_mon']); 
          nm_limpa_valor($this->rate_fixed, $this->field_config['rate_fixed']['symbol_dec'], $this->field_config['rate_fixed']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['revenu_net']['symbol_dec']))
      {
          $this->sc_remove_currency($this->revenu_net, $this->field_config['revenu_net']['symbol_dec'], $this->field_config['revenu_net']['symbol_grp'], $this->field_config['revenu_net']['symbol_mon']); 
          nm_limpa_valor($this->revenu_net, $this->field_config['revenu_net']['symbol_dec'], $this->field_config['revenu_net']['symbol_grp']) ; 
      }
      $this->nm_converte_datas();
      $_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['contr_erro'] = 'on';
  $this->Download_Fingertec();
$this->calculate_hiringduration();
$_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['contr_erro'] = 'off'; 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="id" value="<?php echo $this->form_encode_input($this->id) ?>"/>
      <input type=hidden name="nmgp_opcao" value="<?php echo $this->form_encode_input($nmgp_opcao_saida_php); ?>"/>
      <input type=hidden name="nmgp_opc_ant" value="<?php echo $this->form_encode_input($nmgp_opc_ant_saida_php); ?>"/>
      <input type=submit name="nmgp_bok" value="<?php echo $this->Ini->Nm_lang['lang_btns_cfrm'] ?>"/>
      </form>
      </td></tr></table>
      </body>
      </html>
<?php
       if (isset($this->redir_modal) && !empty($this->redir_modal))
       {
           echo "<script type=\"text/javascript\">" . $this->redir_modal . "</script>";
           $this->redir_modal = "";
       }
   }
   function sc_btn_Historic_Salary() 
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;
 
     ob_start();
     if (empty($this->photo_name)) {
         $this->photo_name = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['photo_name'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['photo_name'] : "";
     }
?>
<!DOCTYPE html>

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
 <head>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

      if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
      {
?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
      }

?>
        <link rel="shortcut icon" href="../_lib/img/sys__NM__ico__NM__favicon (2).ico">
    <SCRIPT type="text/javascript">
      var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
      var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
      var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
      var sc_userSweetAlertDisplayed = false;
    </SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
<?php
include_once("form_FicheEmployeeSuspended_mob_sajax_js.php");
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <script type="text/javascript" src="../_lib/lib/js/frameControl.js"></script>
    <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 </head>
  <body class="scFormPage">
      <table class="scFormTabela" align="center"><tr><td>
<?php
      $varloc_btn_php = array();
      $nmgp_opcao_saida_php = "igual";
      $nmgp_opc_ant_saida_php = "";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      else
      {
          if (!isset($this->userid_int) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['userid_int']))
          {
              $varloc_btn_php['userid_int'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form']['userid_int'];
          }
      }
      $nm_f_saida = "form_FicheEmployeeSuspended_mob.php";
      nm_limpa_numero($this->userid_int, $this->field_config['userid_int']['symbol_grp']) ; 
      nm_limpa_data($this->dob, $this->field_config['dob']['date_sep']) ; 
      nm_limpa_data($this->hiredate, $this->field_config['hiredate']['date_sep']) ; 
      nm_limpa_data($this->firedate, $this->field_config['firedate']['date_sep']) ; 
      if (!empty($this->field_config['hiring_duration']['symbol_dec']))
      {
          nm_limpa_valor($this->hiring_duration, $this->field_config['hiring_duration']['symbol_dec'], $this->field_config['hiring_duration']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['rate_cass']['symbol_dec']))
      {
          nm_limpa_valor($this->rate_cass, $this->field_config['rate_cass']['symbol_dec'], $this->field_config['rate_cass']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['tax_cass']['symbol_dec']))
      {
          $this->sc_remove_currency($this->tax_cass, $this->field_config['tax_cass']['symbol_dec'], $this->field_config['tax_cass']['symbol_grp'], $this->field_config['tax_cass']['symbol_mon']); 
          nm_limpa_valor($this->tax_cass, $this->field_config['tax_cass']['symbol_dec'], $this->field_config['tax_cass']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['rate_cfgdct']['symbol_dec']))
      {
          nm_limpa_valor($this->rate_cfgdct, $this->field_config['rate_cfgdct']['symbol_dec'], $this->field_config['rate_cfgdct']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['tax_cfgdct']['symbol_dec']))
      {
          $this->sc_remove_currency($this->tax_cfgdct, $this->field_config['tax_cfgdct']['symbol_dec'], $this->field_config['tax_cfgdct']['symbol_grp'], $this->field_config['tax_cfgdct']['symbol_mon']); 
          nm_limpa_valor($this->tax_cfgdct, $this->field_config['tax_cfgdct']['symbol_dec'], $this->field_config['tax_cfgdct']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['rate_ona']['symbol_dec']))
      {
          nm_limpa_valor($this->rate_ona, $this->field_config['rate_ona']['symbol_dec'], $this->field_config['rate_ona']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['tax_ona']['symbol_dec']))
      {
          $this->sc_remove_currency($this->tax_ona, $this->field_config['tax_ona']['symbol_dec'], $this->field_config['tax_ona']['symbol_grp'], $this->field_config['tax_ona']['symbol_mon']); 
          nm_limpa_valor($this->tax_ona, $this->field_config['tax_ona']['symbol_dec'], $this->field_config['tax_ona']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['rate_fdu']['symbol_dec']))
      {
          nm_limpa_valor($this->rate_fdu, $this->field_config['rate_fdu']['symbol_dec'], $this->field_config['rate_fdu']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['tax_fdu']['symbol_dec']))
      {
          $this->sc_remove_currency($this->tax_fdu, $this->field_config['tax_fdu']['symbol_dec'], $this->field_config['tax_fdu']['symbol_grp'], $this->field_config['tax_fdu']['symbol_mon']); 
          nm_limpa_valor($this->tax_fdu, $this->field_config['tax_fdu']['symbol_dec'], $this->field_config['tax_fdu']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['rate_iris']['symbol_dec']))
      {
          $this->sc_remove_currency($this->rate_iris, $this->field_config['rate_iris']['symbol_dec'], $this->field_config['rate_iris']['symbol_grp'], $this->field_config['rate_iris']['symbol_mon']); 
          nm_limpa_valor($this->rate_iris, $this->field_config['rate_iris']['symbol_dec'], $this->field_config['rate_iris']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['rate_fixed']['symbol_dec']))
      {
          $this->sc_remove_currency($this->rate_fixed, $this->field_config['rate_fixed']['symbol_dec'], $this->field_config['rate_fixed']['symbol_grp'], $this->field_config['rate_fixed']['symbol_mon']); 
          nm_limpa_valor($this->rate_fixed, $this->field_config['rate_fixed']['symbol_dec'], $this->field_config['rate_fixed']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['revenu_net']['symbol_dec']))
      {
          $this->sc_remove_currency($this->revenu_net, $this->field_config['revenu_net']['symbol_dec'], $this->field_config['revenu_net']['symbol_grp'], $this->field_config['revenu_net']['symbol_mon']); 
          nm_limpa_valor($this->revenu_net, $this->field_config['revenu_net']['symbol_dec'], $this->field_config['revenu_net']['symbol_grp']) ; 
      }
      $this->nm_converte_datas();
      foreach ($varloc_btn_php as $cmp => $val_cmp)
      {
          $this->$cmp = $val_cmp;
      }
      $_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['contr_erro'] = 'on';
   if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('grid_HistoricSalaire') . "/", $this->nm_location, "parm01?#?" . NM_encode_input($this->userid_int ) . "?@?","_self", '', 440, 630);
 };
$_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['contr_erro'] = 'off'; 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="id" value="<?php echo $this->form_encode_input($this->id) ?>"/>
      <input type=hidden name="nmgp_opcao" value="<?php echo $this->form_encode_input($nmgp_opcao_saida_php); ?>"/>
      <input type=hidden name="nmgp_opc_ant" value="<?php echo $this->form_encode_input($nmgp_opc_ant_saida_php); ?>"/>
      <input type=submit name="nmgp_bok" value="<?php echo $this->Ini->Nm_lang['lang_btns_cfrm'] ?>"/>
      </form>
      </td></tr></table>
      </body>
      </html>
<?php
       if (isset($this->redir_modal) && !empty($this->redir_modal))
       {
           echo "<script type=\"text/javascript\">" . $this->redir_modal . "</script>";
           $this->redir_modal = "";
       }
   }
//
//--------------------------------------------------------------------------------------
   function Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros, $mode = 3) 
   {
       switch ($mode)
       {
           case 1:
               $campos_erro = array();
               if (!empty($Campos_Crit))
               {
                   $campos_erro[] = $Campos_Crit;
               }
               if (!empty($Campos_Falta))
               {
                   $campos_erro[] = $this->Formata_Campos_Falta($Campos_Falta);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_erro[] = $this->Campos_Mens_erro;
               }
               return implode('<br />', $campos_erro);
               break;

           case 2:
               $campos_erro = array();
               if (!empty($Campos_Crit))
               {
                   $campos_erro[] = $Campos_Crit;
               }
               if (!empty($Campos_Falta))
               {
                   $campos_erro[] = $this->Formata_Campos_Falta($Campos_Falta, true);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_erro[] = $this->Campos_Mens_erro;
               }
               return implode('<br />', $campos_erro);
               break;

           case 3:
               $campos_erro = array();
               if (!empty($Campos_Erros))
               {
                   $campos_erro[] = $this->Formata_Campos_Erros($Campos_Erros);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_mens_erro = str_replace(array('<br />', '<br>', '<BR />'), array('<BR>', '<BR>', '<BR>'), $this->Campos_Mens_erro);
                   $campos_mens_erro = explode('<BR>', $campos_mens_erro);
                   foreach ($campos_mens_erro as $msg_erro)
                   {
                       if ('' != $msg_erro && !in_array($msg_erro, $campos_erro))
                       {
                           $campos_erro[] = $msg_erro;
                       }
                   }
               }
               return implode('<br />', $campos_erro);
               break;

           case 4:
               $campos_erro = array();
               if (!empty($Campos_Erros))
               {
                   $campos_erro[] = $this->Formata_Campos_Erros_SweetAlert($Campos_Erros);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_mens_erro = str_replace(array('<br />', '<br>', '<BR />'), array('<BR>', '<BR>', '<BR>'), $this->Campos_Mens_erro);
                   $campos_mens_erro = explode('<BR>', $campos_mens_erro);
                   foreach ($campos_mens_erro as $msg_erro)
                   {
                       if ('' != $msg_erro && !in_array($msg_erro, $campos_erro))
                       {
                           $campos_erro[] = $msg_erro;
                       }
                   }
               }
               return implode('<br />', $campos_erro);
               break;
       }
   }

   function Formata_Campos_Falta($Campos_Falta, $table = false) 
   {
       $Campos_Falta = array_unique($Campos_Falta);

       if (!$table)
       {
           return $this->Ini->Nm_lang['lang_errm_reqd'] . ' ' . implode('; ', $Campos_Falta);
       }

       $aCols  = array();
       $iTotal = sizeof($Campos_Falta);
       $iCols  = 6 > $iTotal ? 1 : (11 > $iTotal ? 2 : (16 > $iTotal ? 3 : 4));
       $iItems = ceil($iTotal / $iCols);
       $iNowC  = 0;
       $iNowI  = 0;

       foreach ($Campos_Falta as $campo)
       {
           $aCols[$iNowC][] = $campo;
           if ($iItems == ++$iNowI)
           {
               $iNowC++;
               $iNowI = 0;
           }
       }

       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';
       $sError .= '<tr>';
       $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Ini->Nm_lang['lang_errm_reqd'] . '</td>';
       foreach ($aCols as $aCol)
       {
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', $aCol) . '</td>';
       }
       $sError .= '</tr>';
       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Crit($Campos_Crit, $table = false) 
   {
       $Campos_Crit = array_unique($Campos_Crit);

       if (!$table)
       {
           return $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . implode('; ', $Campos_Crit);
       }

       $aCols  = array();
       $iTotal = sizeof($Campos_Crit);
       $iCols  = 6 > $iTotal ? 1 : (11 > $iTotal ? 2 : (16 > $iTotal ? 3 : 4));
       $iItems = ceil($iTotal / $iCols);
       $iNowC  = 0;
       $iNowI  = 0;

       foreach ($Campos_Crit as $campo)
       {
           $aCols[$iNowC][] = $campo;
           if ($iItems == ++$iNowI)
           {
               $iNowC++;
               $iNowI = 0;
           }
       }

       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';
       $sError .= '<tr>';
       $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Ini->Nm_lang['lang_errm_flds'] . '</td>';
       foreach ($aCols as $aCol)
       {
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', $aCol) . '</td>';
       }
       $sError .= '</tr>';
       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Erros($Campos_Erros) 
   {
       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';

       foreach ($Campos_Erros as $campo => $erros)
       {
           $sError .= '<tr>';
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Recupera_Nome_Campo($campo) . ':</td>';
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', array_unique($erros)) . '</td>';
           $sError .= '</tr>';
       }

       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Erros_SweetAlert($Campos_Erros) 
   {
       $sError  = '';

       foreach ($Campos_Erros as $campo => $erros)
       {
           $sError .= $this->Recupera_Nome_Campo($campo) . ': ' . implode('<br />', array_unique($erros)) . '<br />';
       }

       return $sError;
   }

   function Recupera_Nome_Campo($campo) 
   {
       switch($campo)
       {
           case 'userid_int':
               return "ID";
               break;
           case 'employee_name':
               return "" . $this->Ini->Nm_lang['lang_username'] . "";
               break;
           case 'ic':
               return "National ID";
               break;
           case 'designation':
               return "" . $this->Ini->Nm_lang['lang_designation'] . "";
               break;
           case 'dept':
               return "" . $this->Ini->Nm_lang['lang_departement'] . "";
               break;
           case 'gender':
               return "" . $this->Ini->Nm_lang['lang_gender'] . "";
               break;
           case 'dob':
               return "" . $this->Ini->Nm_lang['lang_dob'] . "";
               break;
           case 'address':
               return "Address";
               break;
           case 'phone':
               return "" . $this->Ini->Nm_lang['lang_phone'] . "";
               break;
           case 'hiredate':
               return "" . $this->Ini->Nm_lang['lang_hiredate'] . "";
               break;
           case 'email':
               return "Email";
               break;
           case 'field01':
               return "";
               break;
           case 'firedate':
               return "" . $this->Ini->Nm_lang['lang_fire_date'] . "";
               break;
           case 'hiring_duration':
               return "" . $this->Ini->Nm_lang['lang_hiring_duration'] . "";
               break;
           case 'photo_name':
               return "Photo Name";
               break;
           case 'photo_size':
               return "" . $this->Ini->Nm_lang['lang_photo_size'] . "";
               break;
           case 'rate_cass':
               return "CASS";
               break;
           case 'tax_cass':
               return "Tax CASS";
               break;
           case 'rate_cfgdct':
               return "Rate CFGDCT";
               break;
           case 'tax_cfgdct':
               return "Tax CFGDCT";
               break;
           case 'rate_ona':
               return "ONA";
               break;
           case 'tax_ona':
               return "Tax ONA";
               break;
           case 'rate_fdu':
               return "FDU";
               break;
           case 'tax_fdu':
               return "Tax FDU";
               break;
           case 'field02':
               return "";
               break;
           case 'rate_iris':
               return "Tax IRI";
               break;
           case 'rate_fixed':
               return "" . $this->Ini->Nm_lang['lang_rate_fixed'] . "";
               break;
           case 'revenu_net':
               return "" . $this->Ini->Nm_lang['lang_revenu_net'] . "";
               break;
           case 'block_note':
               return "Note";
               break;
           case 'id':
               return "Id";
               break;
           case 'userid_varchar':
               return "Userid Varchar";
               break;
           case 'inactif':
               return "Inactif";
               break;
           case 'building':
               return "Building";
               break;
           case 'section':
               return "Section";
               break;
           case 'photo_file':
               return "Photo File";
               break;
           case 'imm_ona':
               return "Imm Ona";
               break;
           case 'no_compte':
               return "No Compte";
               break;
           case 'type_de_compte':
               return "Type De Compte";
               break;
           case 'payperiod':
               return "Payperiod";
               break;
           case 'probation_period':
               return "Probation Period";
               break;
           case 'rate_work':
               return "Rate Work";
               break;
           case 'rate_ot':
               return "Rate Ot";
               break;
           case 'rate_ot_factor':
               return "Rate Ot Factor";
               break;
           case 'rate_ot_holiday_factor':
               return "Rate Ot Holiday Factor";
               break;
           case 'rate_ot_offday_factor':
               return "Rate Ot Offday Factor";
               break;
           case 'rate_ot_restday_factor':
               return "Rate Ot Restday Factor";
               break;
           case 'rate_day':
               return "Rate Day";
               break;
           case 'rate_restday':
               return "Rate Restday";
               break;
           case 'rate_offday':
               return "Rate Offday";
               break;
           case 'rate_commission1':
               return "Rate Commission 1";
               break;
           case 'rate_prime1':
               return "Rate  Prime 1";
               break;
           case 'rate_omission1':
               return "Rate  Omission 1";
               break;
           case 'rate_assmd':
               return "Rate Assmd";
               break;
           case 'rate_iric':
               return "Rate Iric";
               break;
           case 'rate_cons':
               return "Rate Cons";
               break;
           case 'day_cons':
               return "Day Cons";
               break;
           case 'incentive':
               return "Incentive";
               break;
           case 'incentive_desc':
               return "Incentive Desc";
               break;
           case 'rappel':
               return "Rappel";
               break;
           case 'other_deduct':
               return "Other Deduct";
               break;
           case 'other_deduct_desc':
               return "Other Deduct Desc";
               break;
           case 'loan':
               return "Loan";
               break;
           case 'date_loan':
               return "Date Loan";
               break;
           case 'payment':
               return "Payment";
               break;
           case 'date_payment':
               return "Date Payment";
               break;
           case 'payment_receipt':
               return "Payment Receipt";
               break;
           case 'loan_deduction':
               return "Loan Deduction";
               break;
           case 'loan_description':
               return "Loan Description";
               break;
           case 'loan_start_deduct':
               return "Loan Start Deduct";
               break;
           case 'loan_monthlypayment':
               return "Loan Monthlypayment";
               break;
           case 'loan_end_deduct':
               return "Loan End Deduct";
               break;
           case 'apply_loan_deduction':
               return "Apply Loan Deduction";
               break;
           case 'loan_bank':
               return "Loan Bank";
               break;
           case 'date_loan_bank':
               return "Date Loan Bank";
               break;
           case 'loan_deduction_bank':
               return "Loan Deduction Bank";
               break;
           case 'loan_start_deduct_bank':
               return "Loan Start Deduct Bank";
               break;
           case 'loan_end_deduct_bank':
               return "Loan End Deduct Bank";
               break;
           case 'apply_loan_deduction_bank':
               return "Apply Loan Deduction Bank";
               break;
           case 'other_loan':
               return "Other Loan";
               break;
           case 'date_other_loan':
               return "Date Other Loan";
               break;
           case 'other_loan_deduction':
               return "Other Loan Deduction";
               break;
           case 'other_loan_description':
               return "Other Loan Description";
               break;
           case 'other_loan_start_deduct':
               return "Other Loan Start Deduct";
               break;
           case 'other_loan_monthlypayment':
               return "Other Loan Monthlypayment";
               break;
           case 'other_loan_end_deduct':
               return "Other Loan End Deduct";
               break;
           case 'apply_other_loan_deduction':
               return "Apply Other Loan Deduction";
               break;
           case 'purchase':
               return "Purchase";
               break;
           case 'purchase_description':
               return "Purchase Description";
               break;
           case 'date_purchase':
               return "Date Purchase";
               break;
           case 'purchase_deduct':
               return "Purchase Deduct";
               break;
           case 'purchase_start_deduct':
               return "Purchase Start Deduct";
               break;
           case 'purchase_monthlypayment':
               return "Purchase Monthlypayment";
               break;
           case 'purchase_end_deduct':
               return "Purchase End Deduct";
               break;
           case 'apply_purchase_deduct':
               return "Apply Purchase Deduct";
               break;
           case 'health_insurance':
               return "Health Insurance";
               break;
           case 'bank_number':
               return "Bank Number";
               break;
           case 'update_time':
               return "Update Time";
               break;
           case 'field03':
               return "";
               break;
       }

       return $campo;
   }

   function dateDefaultFormat()
   {
       if (isset($this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_format']))
       {
           $sDate = str_replace('yyyy', 'Y', $this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_format']);
           $sDate = str_replace('mm',   'm', $sDate);
           $sDate = str_replace('dd',   'd', $sDate);
           return substr(chunk_split($sDate, 1, $this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_sep']), 0, -1);
       }
       elseif ('en_us' == $this->Ini->str_lang)
       {
           return 'm/d/Y';
       }
       else
       {
           return 'd/m/Y';
       }
   } // dateDefaultFormat

//
//--------------------------------------------------------------------------------------
   function Valida_campos(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros, $filtro = '') 
   {
     global $nm_browser, $teste_validade;
     if (is_array($filtro) && empty($filtro)) {
         $filtro = '';
     }
//---------------------------------------------------------
     $this->sc_force_zero = array();

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_form_FicheEmployeeSuspended_mob']) || !is_array($this->NM_ajax_info['errList']['geral_form_FicheEmployeeSuspended_mob']))
              {
                  $this->NM_ajax_info['errList']['geral_form_FicheEmployeeSuspended_mob'] = array();
              }
              $this->NM_ajax_info['errList']['geral_form_FicheEmployeeSuspended_mob'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'userid_int' == $filtro)) || (is_array($filtro) && in_array('userid_int', $filtro)))
        $this->ValidateField_userid_int($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'employee_name' == $filtro)) || (is_array($filtro) && in_array('employee_name', $filtro)))
        $this->ValidateField_employee_name($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'ic' == $filtro)) || (is_array($filtro) && in_array('ic', $filtro)))
        $this->ValidateField_ic($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'designation' == $filtro)) || (is_array($filtro) && in_array('designation', $filtro)))
        $this->ValidateField_designation($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'dept' == $filtro)) || (is_array($filtro) && in_array('dept', $filtro)))
        $this->ValidateField_dept($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'gender' == $filtro)) || (is_array($filtro) && in_array('gender', $filtro)))
        $this->ValidateField_gender($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'dob' == $filtro)) || (is_array($filtro) && in_array('dob', $filtro)))
        $this->ValidateField_dob($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'address' == $filtro)) || (is_array($filtro) && in_array('address', $filtro)))
        $this->ValidateField_address($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'phone' == $filtro)) || (is_array($filtro) && in_array('phone', $filtro)))
        $this->ValidateField_phone($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hiredate' == $filtro)) || (is_array($filtro) && in_array('hiredate', $filtro)))
        $this->ValidateField_hiredate($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'email' == $filtro)) || (is_array($filtro) && in_array('email', $filtro)))
        $this->ValidateField_email($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'field01' == $filtro)) || (is_array($filtro) && in_array('field01', $filtro)))
        $this->ValidateField_field01($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'firedate' == $filtro)) || (is_array($filtro) && in_array('firedate', $filtro)))
        $this->ValidateField_firedate($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hiring_duration' == $filtro)) || (is_array($filtro) && in_array('hiring_duration', $filtro)))
        $this->ValidateField_hiring_duration($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'photo_name' == $filtro)) || (is_array($filtro) && in_array('photo_name', $filtro)))
        $this->ValidateField_photo_name($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'photo_size' == $filtro)) || (is_array($filtro) && in_array('photo_size', $filtro)))
        $this->ValidateField_photo_size($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'rate_cass' == $filtro)) || (is_array($filtro) && in_array('rate_cass', $filtro)))
        $this->ValidateField_rate_cass($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'tax_cass' == $filtro)) || (is_array($filtro) && in_array('tax_cass', $filtro)))
        $this->ValidateField_tax_cass($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'rate_cfgdct' == $filtro)) || (is_array($filtro) && in_array('rate_cfgdct', $filtro)))
        $this->ValidateField_rate_cfgdct($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'tax_cfgdct' == $filtro)) || (is_array($filtro) && in_array('tax_cfgdct', $filtro)))
        $this->ValidateField_tax_cfgdct($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'rate_ona' == $filtro)) || (is_array($filtro) && in_array('rate_ona', $filtro)))
        $this->ValidateField_rate_ona($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'tax_ona' == $filtro)) || (is_array($filtro) && in_array('tax_ona', $filtro)))
        $this->ValidateField_tax_ona($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'rate_fdu' == $filtro)) || (is_array($filtro) && in_array('rate_fdu', $filtro)))
        $this->ValidateField_rate_fdu($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'tax_fdu' == $filtro)) || (is_array($filtro) && in_array('tax_fdu', $filtro)))
        $this->ValidateField_tax_fdu($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'field02' == $filtro)) || (is_array($filtro) && in_array('field02', $filtro)))
        $this->ValidateField_field02($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'rate_iris' == $filtro)) || (is_array($filtro) && in_array('rate_iris', $filtro)))
        $this->ValidateField_rate_iris($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'rate_fixed' == $filtro)) || (is_array($filtro) && in_array('rate_fixed', $filtro)))
        $this->ValidateField_rate_fixed($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'revenu_net' == $filtro)) || (is_array($filtro) && in_array('revenu_net', $filtro)))
        $this->ValidateField_revenu_net($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'block_note' == $filtro)) || (is_array($filtro) && in_array('block_note', $filtro)))
        $this->ValidateField_block_note($Campos_Crit, $Campos_Falta, $Campos_Erros);
      $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros);
//-- converter datas   
          $this->nm_converte_datas();
//---
      if (!empty($Campos_Crit) || !empty($Campos_Falta) || !empty($this->Campos_Mens_erro))
      {
          if (!empty($this->sc_force_zero))
          {
              foreach ($this->sc_force_zero as $i_force_zero => $sc_force_zero_field)
              {
                  eval('$this->' . $sc_force_zero_field . ' = "";');
                  unset($this->sc_force_zero[$i_force_zero]);
              }
          }
      }
   }

    function ValidateField_userid_int(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['userid_int'])) {
          nm_limpa_numero($this->userid_int, $this->field_config['userid_int']['symbol_grp']) ; 
          return;
      }
      if ($this->userid_int === "" || is_null($this->userid_int))  
      { 
          $this->userid_int = 0;
          $this->sc_force_zero[] = 'userid_int';
      } 
      nm_limpa_numero($this->userid_int, $this->field_config['userid_int']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->userid_int != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->userid_int) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "ID: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['userid_int']))
                  {
                      $Campos_Erros['userid_int'] = array();
                  }
                  $Campos_Erros['userid_int'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['userid_int']) || !is_array($this->NM_ajax_info['errList']['userid_int']))
                  {
                      $this->NM_ajax_info['errList']['userid_int'] = array();
                  }
                  $this->NM_ajax_info['errList']['userid_int'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->userid_int, 11, 0, -0, 99999999999, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "ID; " ; 
                  if (!isset($Campos_Erros['userid_int']))
                  {
                      $Campos_Erros['userid_int'] = array();
                  }
                  $Campos_Erros['userid_int'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['userid_int']) || !is_array($this->NM_ajax_info['errList']['userid_int']))
                  {
                      $this->NM_ajax_info['errList']['userid_int'] = array();
                  }
                  $this->NM_ajax_info['errList']['userid_int'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'userid_int';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_userid_int

    function ValidateField_employee_name(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['employee_name'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->employee_name) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_username'] . " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['employee_name']))
              {
                  $Campos_Erros['employee_name'] = array();
              }
              $Campos_Erros['employee_name'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['employee_name']) || !is_array($this->NM_ajax_info['errList']['employee_name']))
              {
                  $this->NM_ajax_info['errList']['employee_name'] = array();
              }
              $this->NM_ajax_info['errList']['employee_name'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'employee_name';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_employee_name

    function ValidateField_ic(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['ic'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->ic) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "National ID " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['ic']))
              {
                  $Campos_Erros['ic'] = array();
              }
              $Campos_Erros['ic'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['ic']) || !is_array($this->NM_ajax_info['errList']['ic']))
              {
                  $this->NM_ajax_info['errList']['ic'] = array();
              }
              $this->NM_ajax_info['errList']['ic'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'ic';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_ic

    function ValidateField_designation(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['designation'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->designation) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_designation'] . " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['designation']))
              {
                  $Campos_Erros['designation'] = array();
              }
              $Campos_Erros['designation'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['designation']) || !is_array($this->NM_ajax_info['errList']['designation']))
              {
                  $this->NM_ajax_info['errList']['designation'] = array();
              }
              $this->NM_ajax_info['errList']['designation'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'designation';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_designation

    function ValidateField_dept(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['dept'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->dept) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_departement'] . " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['dept']))
              {
                  $Campos_Erros['dept'] = array();
              }
              $Campos_Erros['dept'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['dept']) || !is_array($this->NM_ajax_info['errList']['dept']))
              {
                  $this->NM_ajax_info['errList']['dept'] = array();
              }
              $this->NM_ajax_info['errList']['dept'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'dept';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_dept

    function ValidateField_gender(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['gender'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->gender) > 15) 
          { 
              $hasError = true;
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_gender'] . " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 15 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['gender']))
              {
                  $Campos_Erros['gender'] = array();
              }
              $Campos_Erros['gender'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 15 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['gender']) || !is_array($this->NM_ajax_info['errList']['gender']))
              {
                  $this->NM_ajax_info['errList']['gender'] = array();
              }
              $this->NM_ajax_info['errList']['gender'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 15 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'gender';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_gender

    function ValidateField_dob(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->dob, $this->field_config['dob']['date_sep']) ; 
      if (isset($this->Field_no_validate['dob'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['dob']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['dob']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['dob']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['dob']['date_sep']) ; 
          if (trim($this->dob) != "")  
          { 
              $validateTest = $teste_validade->Data($this->dob, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_dob'] . "; " ; 
                  if (!isset($Campos_Erros['dob']))
                  {
                      $Campos_Erros['dob'] = array();
                  }
                  $Campos_Erros['dob'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['dob']) || !is_array($this->NM_ajax_info['errList']['dob']))
                  {
                      $this->NM_ajax_info['errList']['dob'] = array();
                  }
                  $this->NM_ajax_info['errList']['dob'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['dob']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'dob';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_dob

    function ValidateField_address(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['address'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->address) > 200) 
          { 
              $hasError = true;
              $Campos_Crit .= "Address " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 200 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['address']))
              {
                  $Campos_Erros['address'] = array();
              }
              $Campos_Erros['address'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 200 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['address']) || !is_array($this->NM_ajax_info['errList']['address']))
              {
                  $this->NM_ajax_info['errList']['address'] = array();
              }
              $this->NM_ajax_info['errList']['address'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 200 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'address';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_address

    function ValidateField_phone(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['phone'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->phone) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_phone'] . " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['phone']))
              {
                  $Campos_Erros['phone'] = array();
              }
              $Campos_Erros['phone'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['phone']) || !is_array($this->NM_ajax_info['errList']['phone']))
              {
                  $this->NM_ajax_info['errList']['phone'] = array();
              }
              $this->NM_ajax_info['errList']['phone'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'phone';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_phone

    function ValidateField_hiredate(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->hiredate, $this->field_config['hiredate']['date_sep']) ; 
      if (isset($this->Field_no_validate['hiredate'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['hiredate']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['hiredate']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['hiredate']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['hiredate']['date_sep']) ; 
          if (trim($this->hiredate) != "")  
          { 
              $validateTest = $teste_validade->Data($this->hiredate, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_hiredate'] . "; " ; 
                  if (!isset($Campos_Erros['hiredate']))
                  {
                      $Campos_Erros['hiredate'] = array();
                  }
                  $Campos_Erros['hiredate'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['hiredate']) || !is_array($this->NM_ajax_info['errList']['hiredate']))
                  {
                      $this->NM_ajax_info['errList']['hiredate'] = array();
                  }
                  $this->NM_ajax_info['errList']['hiredate'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['hiredate']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hiredate';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hiredate

    function ValidateField_email(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['email'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->email) > 50) 
          { 
              $hasError = true;
              $Campos_Crit .= "Email " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['email']))
              {
                  $Campos_Erros['email'] = array();
              }
              $Campos_Erros['email'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['email']) || !is_array($this->NM_ajax_info['errList']['email']))
              {
                  $this->NM_ajax_info['errList']['email'] = array();
              }
              $this->NM_ajax_info['errList']['email'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'email';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_email

    function ValidateField_field01(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['field01'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->field01) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'field01';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_field01

    function ValidateField_firedate(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->firedate, $this->field_config['firedate']['date_sep']) ; 
      if (isset($this->Field_no_validate['firedate'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['firedate']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['firedate']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['firedate']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['firedate']['date_sep']) ; 
          if (trim($this->firedate) != "")  
          { 
              $validateTest = $teste_validade->Data($this->firedate, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_fire_date'] . "; " ; 
                  if (!isset($Campos_Erros['firedate']))
                  {
                      $Campos_Erros['firedate'] = array();
                  }
                  $Campos_Erros['firedate'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['firedate']) || !is_array($this->NM_ajax_info['errList']['firedate']))
                  {
                      $this->NM_ajax_info['errList']['firedate'] = array();
                  }
                  $this->NM_ajax_info['errList']['firedate'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['firedate']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'firedate';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_firedate

    function ValidateField_hiring_duration(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hiring_duration'])) {
          if (!empty($this->field_config['hiring_duration']['symbol_dec'])) {
              nm_limpa_valor($this->hiring_duration, $this->field_config['hiring_duration']['symbol_dec'], $this->field_config['hiring_duration']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->hiring_duration === "" || is_null($this->hiring_duration))  
      { 
          $this->hiring_duration = 0;
          $this->sc_force_zero[] = 'hiring_duration';
      } 
      if (!empty($this->field_config['hiring_duration']['symbol_dec']))
      {
          nm_limpa_valor($this->hiring_duration, $this->field_config['hiring_duration']['symbol_dec'], $this->field_config['hiring_duration']['symbol_grp']) ; 
          if ('.' == substr($this->hiring_duration, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->hiring_duration, 1)))
              {
                  $this->hiring_duration = '';
              }
              else
              {
                  $this->hiring_duration = '0' . $this->hiring_duration;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->hiring_duration != '')  
          { 
              $iTestSize = 25;
              if (strlen($this->hiring_duration) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_hiring_duration'] . ": " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['hiring_duration']))
                  {
                      $Campos_Erros['hiring_duration'] = array();
                  }
                  $Campos_Erros['hiring_duration'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['hiring_duration']) || !is_array($this->NM_ajax_info['errList']['hiring_duration']))
                  {
                      $this->NM_ajax_info['errList']['hiring_duration'] = array();
                  }
                  $this->NM_ajax_info['errList']['hiring_duration'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->hiring_duration, 22, 2, -0, 1.0E+24, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_hiring_duration'] . "; " ; 
                  if (!isset($Campos_Erros['hiring_duration']))
                  {
                      $Campos_Erros['hiring_duration'] = array();
                  }
                  $Campos_Erros['hiring_duration'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['hiring_duration']) || !is_array($this->NM_ajax_info['errList']['hiring_duration']))
                  {
                      $this->NM_ajax_info['errList']['hiring_duration'] = array();
                  }
                  $this->NM_ajax_info['errList']['hiring_duration'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hiring_duration';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hiring_duration

    function ValidateField_photo_name(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['photo_name'])) {
          return;
      }
        if ($this->nmgp_opcao != "excluir")
        {
            $sTestFile = $this->photo_name;
            if ("" != $this->photo_name && "S" != $this->photo_name_limpa && !$teste_validade->ArqExtensao($this->photo_name, array('png', 'jpg', 'jpeg')))
            {
                $hasError = true;
                $Campos_Crit .= "Photo Name: " . $this->Ini->Nm_lang['lang_errm_file_invl']; 
                if (!isset($Campos_Erros['photo_name']))
                {
                    $Campos_Erros['photo_name'] = array();
                }
                $Campos_Erros['photo_name'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
                if (!isset($this->NM_ajax_info['errList']['photo_name']) || !is_array($this->NM_ajax_info['errList']['photo_name']))
                {
                    $this->NM_ajax_info['errList']['photo_name'] = array();
                }
                $this->NM_ajax_info['errList']['photo_name'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
            }
            if (!$hasError && "" != $this->photo_name && "S" != $this->photo_name_limpa) {
                if (!function_exists('sc_upload_unprotect_chars')) {
                    include_once 'form_FicheEmployeeSuspended_mob_doc_name.php';
                }
                $pathParts = pathinfo(sc_upload_unprotect_chars($sTestFile));
                $fileSize = filesize(sc_upload_unprotect_chars($sTestFile));
                $sizeErrorSuffix = '';
                if ('png' == strtolower($pathParts['extension']) && 31457280 < $fileSize) {
                    $sizeErrorSuffix = ' (PNG < 30 MB)';
                    $hasError = true;
                }
                if ('jpg' == strtolower($pathParts['extension']) && 31457280 < $fileSize) {
                    $sizeErrorSuffix = ' (JPG < 30 MB)';
                    $hasError = true;
                }
                if ('jpeg' == strtolower($pathParts['extension']) && 31457280 < $fileSize) {
                    $sizeErrorSuffix = ' (JPEG < 30 MB)';
                    $hasError = true;
                }
                if ($hasError) {
                    $Campos_Crit .= "Photo Name: " . $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                    if (!isset($Campos_Erros['photo_name']))
                    {
                        $Campos_Erros['photo_name'] = array();
                    }
                    $Campos_Erros['photo_name'][] = $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                    if (!isset($this->NM_ajax_info['errList']['photo_name']) || !is_array($this->NM_ajax_info['errList']['photo_name']))
                    {
                        $this->NM_ajax_info['errList']['photo_name'] = array();
                    }
                    $this->NM_ajax_info['errList']['photo_name'][] = $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                }
            }
        }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'photo_name';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_photo_name

    function ValidateField_photo_size(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['photo_size'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->photo_size) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_photo_size'] . " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['photo_size']))
              {
                  $Campos_Erros['photo_size'] = array();
              }
              $Campos_Erros['photo_size'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['photo_size']) || !is_array($this->NM_ajax_info['errList']['photo_size']))
              {
                  $this->NM_ajax_info['errList']['photo_size'] = array();
              }
              $this->NM_ajax_info['errList']['photo_size'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'photo_size';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_photo_size

    function ValidateField_rate_cass(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['rate_cass'])) {
          if (!empty($this->field_config['rate_cass']['symbol_dec'])) {
              nm_limpa_valor($this->rate_cass, $this->field_config['rate_cass']['symbol_dec'], $this->field_config['rate_cass']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_cass === "" || is_null($this->rate_cass))  
      { 
          $this->rate_cass = 0;
          $this->sc_force_zero[] = 'rate_cass';
      } 
      }
      if (!empty($this->field_config['rate_cass']['symbol_dec']))
      {
          nm_limpa_valor($this->rate_cass, $this->field_config['rate_cass']['symbol_dec'], $this->field_config['rate_cass']['symbol_grp']) ; 
          if ('.' == substr($this->rate_cass, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->rate_cass, 1)))
              {
                  $this->rate_cass = '';
              }
              else
              {
                  $this->rate_cass = '0' . $this->rate_cass;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->rate_cass != '')  
          { 
              $iTestSize = 25;
              if (strlen($this->rate_cass) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "CASS: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['rate_cass']))
                  {
                      $Campos_Erros['rate_cass'] = array();
                  }
                  $Campos_Erros['rate_cass'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['rate_cass']) || !is_array($this->NM_ajax_info['errList']['rate_cass']))
                  {
                      $this->NM_ajax_info['errList']['rate_cass'] = array();
                  }
                  $this->NM_ajax_info['errList']['rate_cass'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->rate_cass, 22, 2, -0, 1.0E+24, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "CASS; " ; 
                  if (!isset($Campos_Erros['rate_cass']))
                  {
                      $Campos_Erros['rate_cass'] = array();
                  }
                  $Campos_Erros['rate_cass'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['rate_cass']) || !is_array($this->NM_ajax_info['errList']['rate_cass']))
                  {
                      $this->NM_ajax_info['errList']['rate_cass'] = array();
                  }
                  $this->NM_ajax_info['errList']['rate_cass'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'rate_cass';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_rate_cass

    function ValidateField_tax_cass(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['tax_cass'])) {
          if (!empty($this->field_config['tax_cass']['symbol_dec'])) {
              $this->sc_remove_currency($this->tax_cass, $this->field_config['tax_cass']['symbol_dec'], $this->field_config['tax_cass']['symbol_grp'], $this->field_config['tax_cass']['symbol_mon']); 
              nm_limpa_valor($this->tax_cass, $this->field_config['tax_cass']['symbol_dec'], $this->field_config['tax_cass']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->tax_cass === "" || is_null($this->tax_cass))  
      { 
          $this->tax_cass = 0;
          $this->sc_force_zero[] = 'tax_cass';
      } 
      if (!empty($this->field_config['tax_cass']['symbol_dec']))
      {
          $this->sc_remove_currency($this->tax_cass, $this->field_config['tax_cass']['symbol_dec'], $this->field_config['tax_cass']['symbol_grp'], $this->field_config['tax_cass']['symbol_mon']); 
          nm_limpa_valor($this->tax_cass, $this->field_config['tax_cass']['symbol_dec'], $this->field_config['tax_cass']['symbol_grp']) ; 
          if ('.' == substr($this->tax_cass, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->tax_cass, 1)))
              {
                  $this->tax_cass = '';
              }
              else
              {
                  $this->tax_cass = '0' . $this->tax_cass;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->tax_cass != '')  
          { 
              $iTestSize = 25;
              if (strlen($this->tax_cass) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Tax CASS: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['tax_cass']))
                  {
                      $Campos_Erros['tax_cass'] = array();
                  }
                  $Campos_Erros['tax_cass'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['tax_cass']) || !is_array($this->NM_ajax_info['errList']['tax_cass']))
                  {
                      $this->NM_ajax_info['errList']['tax_cass'] = array();
                  }
                  $this->NM_ajax_info['errList']['tax_cass'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->tax_cass, 22, 2, -0, 1.0E+24, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Tax CASS; " ; 
                  if (!isset($Campos_Erros['tax_cass']))
                  {
                      $Campos_Erros['tax_cass'] = array();
                  }
                  $Campos_Erros['tax_cass'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tax_cass']) || !is_array($this->NM_ajax_info['errList']['tax_cass']))
                  {
                      $this->NM_ajax_info['errList']['tax_cass'] = array();
                  }
                  $this->NM_ajax_info['errList']['tax_cass'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'tax_cass';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_tax_cass

    function ValidateField_rate_cfgdct(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['rate_cfgdct'])) {
          if (!empty($this->field_config['rate_cfgdct']['symbol_dec'])) {
              nm_limpa_valor($this->rate_cfgdct, $this->field_config['rate_cfgdct']['symbol_dec'], $this->field_config['rate_cfgdct']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_cfgdct === "" || is_null($this->rate_cfgdct))  
      { 
          $this->rate_cfgdct = 0;
          $this->sc_force_zero[] = 'rate_cfgdct';
      } 
      }
      if (!empty($this->field_config['rate_cfgdct']['symbol_dec']))
      {
          nm_limpa_valor($this->rate_cfgdct, $this->field_config['rate_cfgdct']['symbol_dec'], $this->field_config['rate_cfgdct']['symbol_grp']) ; 
          if ('.' == substr($this->rate_cfgdct, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->rate_cfgdct, 1)))
              {
                  $this->rate_cfgdct = '';
              }
              else
              {
                  $this->rate_cfgdct = '0' . $this->rate_cfgdct;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->rate_cfgdct != '')  
          { 
              $iTestSize = 25;
              if (strlen($this->rate_cfgdct) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Rate CFGDCT: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['rate_cfgdct']))
                  {
                      $Campos_Erros['rate_cfgdct'] = array();
                  }
                  $Campos_Erros['rate_cfgdct'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['rate_cfgdct']) || !is_array($this->NM_ajax_info['errList']['rate_cfgdct']))
                  {
                      $this->NM_ajax_info['errList']['rate_cfgdct'] = array();
                  }
                  $this->NM_ajax_info['errList']['rate_cfgdct'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->rate_cfgdct, 22, 2, -0, 1.0E+24, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Rate CFGDCT; " ; 
                  if (!isset($Campos_Erros['rate_cfgdct']))
                  {
                      $Campos_Erros['rate_cfgdct'] = array();
                  }
                  $Campos_Erros['rate_cfgdct'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['rate_cfgdct']) || !is_array($this->NM_ajax_info['errList']['rate_cfgdct']))
                  {
                      $this->NM_ajax_info['errList']['rate_cfgdct'] = array();
                  }
                  $this->NM_ajax_info['errList']['rate_cfgdct'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'rate_cfgdct';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_rate_cfgdct

    function ValidateField_tax_cfgdct(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['tax_cfgdct'])) {
          if (!empty($this->field_config['tax_cfgdct']['symbol_dec'])) {
              $this->sc_remove_currency($this->tax_cfgdct, $this->field_config['tax_cfgdct']['symbol_dec'], $this->field_config['tax_cfgdct']['symbol_grp'], $this->field_config['tax_cfgdct']['symbol_mon']); 
              nm_limpa_valor($this->tax_cfgdct, $this->field_config['tax_cfgdct']['symbol_dec'], $this->field_config['tax_cfgdct']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->tax_cfgdct === "" || is_null($this->tax_cfgdct))  
      { 
          $this->tax_cfgdct = 0;
          $this->sc_force_zero[] = 'tax_cfgdct';
      } 
      if (!empty($this->field_config['tax_cfgdct']['symbol_dec']))
      {
          $this->sc_remove_currency($this->tax_cfgdct, $this->field_config['tax_cfgdct']['symbol_dec'], $this->field_config['tax_cfgdct']['symbol_grp'], $this->field_config['tax_cfgdct']['symbol_mon']); 
          nm_limpa_valor($this->tax_cfgdct, $this->field_config['tax_cfgdct']['symbol_dec'], $this->field_config['tax_cfgdct']['symbol_grp']) ; 
          if ('.' == substr($this->tax_cfgdct, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->tax_cfgdct, 1)))
              {
                  $this->tax_cfgdct = '';
              }
              else
              {
                  $this->tax_cfgdct = '0' . $this->tax_cfgdct;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->tax_cfgdct != '')  
          { 
              $iTestSize = 25;
              if (strlen($this->tax_cfgdct) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Tax CFGDCT: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['tax_cfgdct']))
                  {
                      $Campos_Erros['tax_cfgdct'] = array();
                  }
                  $Campos_Erros['tax_cfgdct'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['tax_cfgdct']) || !is_array($this->NM_ajax_info['errList']['tax_cfgdct']))
                  {
                      $this->NM_ajax_info['errList']['tax_cfgdct'] = array();
                  }
                  $this->NM_ajax_info['errList']['tax_cfgdct'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->tax_cfgdct, 22, 2, -0, 1.0E+24, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Tax CFGDCT; " ; 
                  if (!isset($Campos_Erros['tax_cfgdct']))
                  {
                      $Campos_Erros['tax_cfgdct'] = array();
                  }
                  $Campos_Erros['tax_cfgdct'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tax_cfgdct']) || !is_array($this->NM_ajax_info['errList']['tax_cfgdct']))
                  {
                      $this->NM_ajax_info['errList']['tax_cfgdct'] = array();
                  }
                  $this->NM_ajax_info['errList']['tax_cfgdct'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'tax_cfgdct';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_tax_cfgdct

    function ValidateField_rate_ona(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['rate_ona'])) {
          if (!empty($this->field_config['rate_ona']['symbol_dec'])) {
              nm_limpa_valor($this->rate_ona, $this->field_config['rate_ona']['symbol_dec'], $this->field_config['rate_ona']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_ona === "" || is_null($this->rate_ona))  
      { 
          $this->rate_ona = 0;
          $this->sc_force_zero[] = 'rate_ona';
      } 
      }
      if (!empty($this->field_config['rate_ona']['symbol_dec']))
      {
          nm_limpa_valor($this->rate_ona, $this->field_config['rate_ona']['symbol_dec'], $this->field_config['rate_ona']['symbol_grp']) ; 
          if ('.' == substr($this->rate_ona, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->rate_ona, 1)))
              {
                  $this->rate_ona = '';
              }
              else
              {
                  $this->rate_ona = '0' . $this->rate_ona;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->rate_ona != '')  
          { 
              $iTestSize = 25;
              if (strlen($this->rate_ona) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "ONA: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['rate_ona']))
                  {
                      $Campos_Erros['rate_ona'] = array();
                  }
                  $Campos_Erros['rate_ona'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['rate_ona']) || !is_array($this->NM_ajax_info['errList']['rate_ona']))
                  {
                      $this->NM_ajax_info['errList']['rate_ona'] = array();
                  }
                  $this->NM_ajax_info['errList']['rate_ona'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->rate_ona, 22, 2, -0, 1.0E+24, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "ONA; " ; 
                  if (!isset($Campos_Erros['rate_ona']))
                  {
                      $Campos_Erros['rate_ona'] = array();
                  }
                  $Campos_Erros['rate_ona'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['rate_ona']) || !is_array($this->NM_ajax_info['errList']['rate_ona']))
                  {
                      $this->NM_ajax_info['errList']['rate_ona'] = array();
                  }
                  $this->NM_ajax_info['errList']['rate_ona'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'rate_ona';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_rate_ona

    function ValidateField_tax_ona(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['tax_ona'])) {
          if (!empty($this->field_config['tax_ona']['symbol_dec'])) {
              $this->sc_remove_currency($this->tax_ona, $this->field_config['tax_ona']['symbol_dec'], $this->field_config['tax_ona']['symbol_grp'], $this->field_config['tax_ona']['symbol_mon']); 
              nm_limpa_valor($this->tax_ona, $this->field_config['tax_ona']['symbol_dec'], $this->field_config['tax_ona']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->tax_ona === "" || is_null($this->tax_ona))  
      { 
          $this->tax_ona = 0;
          $this->sc_force_zero[] = 'tax_ona';
      } 
      if (!empty($this->field_config['tax_ona']['symbol_dec']))
      {
          $this->sc_remove_currency($this->tax_ona, $this->field_config['tax_ona']['symbol_dec'], $this->field_config['tax_ona']['symbol_grp'], $this->field_config['tax_ona']['symbol_mon']); 
          nm_limpa_valor($this->tax_ona, $this->field_config['tax_ona']['symbol_dec'], $this->field_config['tax_ona']['symbol_grp']) ; 
          if ('.' == substr($this->tax_ona, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->tax_ona, 1)))
              {
                  $this->tax_ona = '';
              }
              else
              {
                  $this->tax_ona = '0' . $this->tax_ona;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->tax_ona != '')  
          { 
              $iTestSize = 25;
              if (strlen($this->tax_ona) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Tax ONA: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['tax_ona']))
                  {
                      $Campos_Erros['tax_ona'] = array();
                  }
                  $Campos_Erros['tax_ona'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['tax_ona']) || !is_array($this->NM_ajax_info['errList']['tax_ona']))
                  {
                      $this->NM_ajax_info['errList']['tax_ona'] = array();
                  }
                  $this->NM_ajax_info['errList']['tax_ona'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->tax_ona, 22, 2, -0, 1.0E+24, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Tax ONA; " ; 
                  if (!isset($Campos_Erros['tax_ona']))
                  {
                      $Campos_Erros['tax_ona'] = array();
                  }
                  $Campos_Erros['tax_ona'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tax_ona']) || !is_array($this->NM_ajax_info['errList']['tax_ona']))
                  {
                      $this->NM_ajax_info['errList']['tax_ona'] = array();
                  }
                  $this->NM_ajax_info['errList']['tax_ona'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'tax_ona';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_tax_ona

    function ValidateField_rate_fdu(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['rate_fdu'])) {
          if (!empty($this->field_config['rate_fdu']['symbol_dec'])) {
              nm_limpa_valor($this->rate_fdu, $this->field_config['rate_fdu']['symbol_dec'], $this->field_config['rate_fdu']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_fdu === "" || is_null($this->rate_fdu))  
      { 
          $this->rate_fdu = 0;
          $this->sc_force_zero[] = 'rate_fdu';
      } 
      }
      if (!empty($this->field_config['rate_fdu']['symbol_dec']))
      {
          nm_limpa_valor($this->rate_fdu, $this->field_config['rate_fdu']['symbol_dec'], $this->field_config['rate_fdu']['symbol_grp']) ; 
          if ('.' == substr($this->rate_fdu, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->rate_fdu, 1)))
              {
                  $this->rate_fdu = '';
              }
              else
              {
                  $this->rate_fdu = '0' . $this->rate_fdu;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->rate_fdu != '')  
          { 
              $iTestSize = 25;
              if (strlen($this->rate_fdu) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "FDU: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['rate_fdu']))
                  {
                      $Campos_Erros['rate_fdu'] = array();
                  }
                  $Campos_Erros['rate_fdu'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['rate_fdu']) || !is_array($this->NM_ajax_info['errList']['rate_fdu']))
                  {
                      $this->NM_ajax_info['errList']['rate_fdu'] = array();
                  }
                  $this->NM_ajax_info['errList']['rate_fdu'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->rate_fdu, 22, 2, -0, 1.0E+24, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "FDU; " ; 
                  if (!isset($Campos_Erros['rate_fdu']))
                  {
                      $Campos_Erros['rate_fdu'] = array();
                  }
                  $Campos_Erros['rate_fdu'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['rate_fdu']) || !is_array($this->NM_ajax_info['errList']['rate_fdu']))
                  {
                      $this->NM_ajax_info['errList']['rate_fdu'] = array();
                  }
                  $this->NM_ajax_info['errList']['rate_fdu'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'rate_fdu';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_rate_fdu

    function ValidateField_tax_fdu(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['tax_fdu'])) {
          if (!empty($this->field_config['tax_fdu']['symbol_dec'])) {
              $this->sc_remove_currency($this->tax_fdu, $this->field_config['tax_fdu']['symbol_dec'], $this->field_config['tax_fdu']['symbol_grp'], $this->field_config['tax_fdu']['symbol_mon']); 
              nm_limpa_valor($this->tax_fdu, $this->field_config['tax_fdu']['symbol_dec'], $this->field_config['tax_fdu']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->tax_fdu === "" || is_null($this->tax_fdu))  
      { 
          $this->tax_fdu = 0;
          $this->sc_force_zero[] = 'tax_fdu';
      } 
      if (!empty($this->field_config['tax_fdu']['symbol_dec']))
      {
          $this->sc_remove_currency($this->tax_fdu, $this->field_config['tax_fdu']['symbol_dec'], $this->field_config['tax_fdu']['symbol_grp'], $this->field_config['tax_fdu']['symbol_mon']); 
          nm_limpa_valor($this->tax_fdu, $this->field_config['tax_fdu']['symbol_dec'], $this->field_config['tax_fdu']['symbol_grp']) ; 
          if ('.' == substr($this->tax_fdu, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->tax_fdu, 1)))
              {
                  $this->tax_fdu = '';
              }
              else
              {
                  $this->tax_fdu = '0' . $this->tax_fdu;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->tax_fdu != '')  
          { 
              $iTestSize = 25;
              if (strlen($this->tax_fdu) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Tax FDU: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['tax_fdu']))
                  {
                      $Campos_Erros['tax_fdu'] = array();
                  }
                  $Campos_Erros['tax_fdu'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['tax_fdu']) || !is_array($this->NM_ajax_info['errList']['tax_fdu']))
                  {
                      $this->NM_ajax_info['errList']['tax_fdu'] = array();
                  }
                  $this->NM_ajax_info['errList']['tax_fdu'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->tax_fdu, 22, 2, -0, 1.0E+24, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Tax FDU; " ; 
                  if (!isset($Campos_Erros['tax_fdu']))
                  {
                      $Campos_Erros['tax_fdu'] = array();
                  }
                  $Campos_Erros['tax_fdu'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tax_fdu']) || !is_array($this->NM_ajax_info['errList']['tax_fdu']))
                  {
                      $this->NM_ajax_info['errList']['tax_fdu'] = array();
                  }
                  $this->NM_ajax_info['errList']['tax_fdu'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'tax_fdu';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_tax_fdu

    function ValidateField_field02(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['field02'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->field02) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'field02';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_field02

    function ValidateField_rate_iris(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['rate_iris'])) {
          if (!empty($this->field_config['rate_iris']['symbol_dec'])) {
              $this->sc_remove_currency($this->rate_iris, $this->field_config['rate_iris']['symbol_dec'], $this->field_config['rate_iris']['symbol_grp'], $this->field_config['rate_iris']['symbol_mon']); 
              nm_limpa_valor($this->rate_iris, $this->field_config['rate_iris']['symbol_dec'], $this->field_config['rate_iris']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_iris === "" || is_null($this->rate_iris))  
      { 
          $this->rate_iris = 0;
          $this->sc_force_zero[] = 'rate_iris';
      } 
      }
      if (!empty($this->field_config['rate_iris']['symbol_dec']))
      {
          $this->sc_remove_currency($this->rate_iris, $this->field_config['rate_iris']['symbol_dec'], $this->field_config['rate_iris']['symbol_grp'], $this->field_config['rate_iris']['symbol_mon']); 
          nm_limpa_valor($this->rate_iris, $this->field_config['rate_iris']['symbol_dec'], $this->field_config['rate_iris']['symbol_grp']) ; 
          if ('.' == substr($this->rate_iris, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->rate_iris, 1)))
              {
                  $this->rate_iris = '';
              }
              else
              {
                  $this->rate_iris = '0' . $this->rate_iris;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->rate_iris != '')  
          { 
              $iTestSize = 25;
              if (strlen($this->rate_iris) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Tax IRI: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['rate_iris']))
                  {
                      $Campos_Erros['rate_iris'] = array();
                  }
                  $Campos_Erros['rate_iris'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['rate_iris']) || !is_array($this->NM_ajax_info['errList']['rate_iris']))
                  {
                      $this->NM_ajax_info['errList']['rate_iris'] = array();
                  }
                  $this->NM_ajax_info['errList']['rate_iris'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->rate_iris, 22, 2, -0, 1.0E+24, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Tax IRI; " ; 
                  if (!isset($Campos_Erros['rate_iris']))
                  {
                      $Campos_Erros['rate_iris'] = array();
                  }
                  $Campos_Erros['rate_iris'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['rate_iris']) || !is_array($this->NM_ajax_info['errList']['rate_iris']))
                  {
                      $this->NM_ajax_info['errList']['rate_iris'] = array();
                  }
                  $this->NM_ajax_info['errList']['rate_iris'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'rate_iris';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_rate_iris

    function ValidateField_rate_fixed(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['rate_fixed'])) {
          if (!empty($this->field_config['rate_fixed']['symbol_dec'])) {
              $this->sc_remove_currency($this->rate_fixed, $this->field_config['rate_fixed']['symbol_dec'], $this->field_config['rate_fixed']['symbol_grp'], $this->field_config['rate_fixed']['symbol_mon']); 
              nm_limpa_valor($this->rate_fixed, $this->field_config['rate_fixed']['symbol_dec'], $this->field_config['rate_fixed']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_fixed === "" || is_null($this->rate_fixed))  
      { 
          $this->rate_fixed = 0;
          $this->sc_force_zero[] = 'rate_fixed';
      } 
      }
      if (!empty($this->field_config['rate_fixed']['symbol_dec']))
      {
          $this->sc_remove_currency($this->rate_fixed, $this->field_config['rate_fixed']['symbol_dec'], $this->field_config['rate_fixed']['symbol_grp'], $this->field_config['rate_fixed']['symbol_mon']); 
          nm_limpa_valor($this->rate_fixed, $this->field_config['rate_fixed']['symbol_dec'], $this->field_config['rate_fixed']['symbol_grp']) ; 
          if ('.' == substr($this->rate_fixed, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->rate_fixed, 1)))
              {
                  $this->rate_fixed = '';
              }
              else
              {
                  $this->rate_fixed = '0' . $this->rate_fixed;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->rate_fixed != '')  
          { 
              $iTestSize = 25;
              if (strlen($this->rate_fixed) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_rate_fixed'] . ": " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['rate_fixed']))
                  {
                      $Campos_Erros['rate_fixed'] = array();
                  }
                  $Campos_Erros['rate_fixed'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['rate_fixed']) || !is_array($this->NM_ajax_info['errList']['rate_fixed']))
                  {
                      $this->NM_ajax_info['errList']['rate_fixed'] = array();
                  }
                  $this->NM_ajax_info['errList']['rate_fixed'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->rate_fixed, 22, 2, -0, 1.0E+24, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_rate_fixed'] . "; " ; 
                  if (!isset($Campos_Erros['rate_fixed']))
                  {
                      $Campos_Erros['rate_fixed'] = array();
                  }
                  $Campos_Erros['rate_fixed'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['rate_fixed']) || !is_array($this->NM_ajax_info['errList']['rate_fixed']))
                  {
                      $this->NM_ajax_info['errList']['rate_fixed'] = array();
                  }
                  $this->NM_ajax_info['errList']['rate_fixed'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'rate_fixed';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_rate_fixed

    function ValidateField_revenu_net(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['revenu_net'])) {
          if (!empty($this->field_config['revenu_net']['symbol_dec'])) {
              $this->sc_remove_currency($this->revenu_net, $this->field_config['revenu_net']['symbol_dec'], $this->field_config['revenu_net']['symbol_grp'], $this->field_config['revenu_net']['symbol_mon']); 
              nm_limpa_valor($this->revenu_net, $this->field_config['revenu_net']['symbol_dec'], $this->field_config['revenu_net']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->revenu_net === "" || is_null($this->revenu_net))  
      { 
          $this->revenu_net = 0;
          $this->sc_force_zero[] = 'revenu_net';
      } 
      if (!empty($this->field_config['revenu_net']['symbol_dec']))
      {
          $this->sc_remove_currency($this->revenu_net, $this->field_config['revenu_net']['symbol_dec'], $this->field_config['revenu_net']['symbol_grp'], $this->field_config['revenu_net']['symbol_mon']); 
          nm_limpa_valor($this->revenu_net, $this->field_config['revenu_net']['symbol_dec'], $this->field_config['revenu_net']['symbol_grp']) ; 
          if ('.' == substr($this->revenu_net, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->revenu_net, 1)))
              {
                  $this->revenu_net = '';
              }
              else
              {
                  $this->revenu_net = '0' . $this->revenu_net;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->revenu_net != '')  
          { 
              $iTestSize = 25;
              if (strlen($this->revenu_net) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_revenu_net'] . ": " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['revenu_net']))
                  {
                      $Campos_Erros['revenu_net'] = array();
                  }
                  $Campos_Erros['revenu_net'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['revenu_net']) || !is_array($this->NM_ajax_info['errList']['revenu_net']))
                  {
                      $this->NM_ajax_info['errList']['revenu_net'] = array();
                  }
                  $this->NM_ajax_info['errList']['revenu_net'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->revenu_net, 22, 2, -0, 1.0E+24, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_revenu_net'] . "; " ; 
                  if (!isset($Campos_Erros['revenu_net']))
                  {
                      $Campos_Erros['revenu_net'] = array();
                  }
                  $Campos_Erros['revenu_net'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['revenu_net']) || !is_array($this->NM_ajax_info['errList']['revenu_net']))
                  {
                      $this->NM_ajax_info['errList']['revenu_net'] = array();
                  }
                  $this->NM_ajax_info['errList']['revenu_net'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'revenu_net';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_revenu_net

    function ValidateField_block_note(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['block_note'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->block_note) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'block_note';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_block_note
//
//--------------------------------------------------------------------------------------
   function upload_img_doc(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros, $filtro = '') 
   {
     global $nm_browser;
     if (!empty($Campos_Crit) || !empty($Campos_Falta))
     {
          return;
     }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->photo_name == "none") 
          { 
              $this->photo_name = ""; 
          } 
          if ($this->photo_name != "") 
          { 
              if (!function_exists('sc_upload_unprotect_chars'))
              {
                  include_once 'form_FicheEmployeeSuspended_mob_doc_name.php';
              }
              $this->photo_name = sc_upload_unprotect_chars($this->photo_name, true);
              $this->photo_name_scfile_name = sc_upload_unprotect_chars($this->photo_name_scfile_name, true);
              if ($nm_browser == "Opera")  
              { 
                  $this->photo_name_scfile_type = substr($this->photo_name_scfile_type, 0, strpos($this->photo_name_scfile_type, ";")) ; 
              } 
              if ($this->photo_name_scfile_type == "image/pjpeg" || $this->photo_name_scfile_type == "image/jpeg" || $this->photo_name_scfile_type == "image/gif" ||  
                  $this->photo_name_scfile_type == "image/png" || $this->photo_name_scfile_type == "image/x-png" || $this->photo_name_scfile_type == "image/bmp")  
              { 
                  if (!is_file($this->photo_name) && isset($_SESSION['scriptcase']['charset']) && $_SESSION['scriptcase']['charset'] != 'UTF-8') {
                      $mbConvertFileName = mb_convert_encoding($this->photo_name, $_SESSION['scriptcase']['charset'], 'UTF-8');
                      $mbConvertScFileName = mb_convert_encoding($this->photo_name_scfile_name, $_SESSION['scriptcase']['charset'], 'UTF-8');
                      if (is_file($mbConvertFileName)) {
                          $this->photo_name = $mbConvertFileName;
                          $this->photo_name_scfile_name = $mbConvertScFileName;
                      }
                  }
                  if (is_file($this->photo_name))  
                  { 
                      $this->NM_size_docs[$this->photo_name_scfile_name] = $this->sc_file_size($this->photo_name);
                      $this->photo_size = $this->NM_size_docs[$this->photo_name_scfile_name];
                      if ($this->nmgp_opcao == "incluir")
                      { 
                          $this->SC_IMG_photo_name = $this->photo_name;
                      } 
                      else 
                      { 
                          $arq_photo_name = fopen($this->photo_name, "r") ; 
                          $reg_photo_name = fread($arq_photo_name, filesize($this->photo_name)) ; 
                          fclose($arq_photo_name) ;  
                      } 
                      $this->photo_name =  trim($this->photo_name_scfile_name) ;  
                      $dir_img = $this->Ini->root . $this->Ini->path_imagens . "" . "/"; 
                     if ($this->nmgp_opcao != "incluir")
                     { 
                      if (is_dir($dir_img))  
                      { 
                          $_test_file = $this->fetchUniqueUploadName($this->photo_name_scfile_name, $dir_img, "photo_name");
                          if (trim($this->photo_name_scfile_name) != $_test_file)
                          {
                              $this->photo_name_scfile_name = $_test_file;
                              $this->photo_name = $_test_file;
                          }
                          $arq_photo_name = fopen($dir_img . trim($this->photo_name_scfile_name), "w") ; 
                          fwrite($arq_photo_name, $reg_photo_name) ;  
                          fclose($arq_photo_name) ;  
                      } 
                      else 
                      { 
                          $Campos_Crit .= "Photo Name: " . $this->Ini->Nm_lang['lang_errm_nfdr']; 
                          $this->photo_name = "";
                          if (!isset($Campos_Erros['photo_name']))
                          {
                              $Campos_Erros['photo_name'] = array();
                          }
                          $Campos_Erros['photo_name'][] = $this->Ini->Nm_lang['lang_errm_nfdr'];
                          if (!isset($this->NM_ajax_info['errList']['photo_name']) || !is_array($this->NM_ajax_info['errList']['photo_name']))
                          {
                              $this->NM_ajax_info['errList']['photo_name'] = array();
                          }
                          $this->NM_ajax_info['errList']['photo_name'][] = $this->Ini->Nm_lang['lang_errm_nfdr'];
                      } 
                     } 
                  } 
                  else 
                  { 
                      $Campos_Crit .= "Photo Name " . $this->Ini->Nm_lang['lang_errm_upld']; 
                      $this->photo_name = "";
                      if (!isset($Campos_Erros['photo_name']))
                      {
                          $Campos_Erros['photo_name'] = array();
                      }
                      $Campos_Erros['photo_name'][] = $this->Ini->Nm_lang['lang_errm_upld'];
                      if (!isset($this->NM_ajax_info['errList']['photo_name']) || !is_array($this->NM_ajax_info['errList']['photo_name']))
                      {
                          $this->NM_ajax_info['errList']['photo_name'] = array();
                      }
                      $this->NM_ajax_info['errList']['photo_name'][] = $this->Ini->Nm_lang['lang_errm_upld'];
                  } 
              } 
              else 
              { 
                  if ($nm_browser == "Konqueror")  
                  { 
                      $this->photo_name = "" ; 
                  } 
                  else 
                  { 
                      $Campos_Crit .= "Photo Name " . $this->Ini->Nm_lang['lang_errm_ivtp']; 
                      if (!isset($Campos_Erros['photo_name']))
                      {
                          $Campos_Erros['photo_name'] = array();
                      }
                      $Campos_Erros['photo_name'][] = $this->Ini->Nm_lang['geracao_tp_inval'];
                      if (!isset($this->NM_ajax_info['errList']['photo_name']) || !is_array($this->NM_ajax_info['errList']['photo_name']))
                      {
                          $this->NM_ajax_info['errList']['photo_name'] = array();
                      }
                      $this->NM_ajax_info['errList']['photo_name'][] = $this->Ini->Nm_lang['geracao_tp_inval'];
                  } 
              } 
          } 
          elseif (!empty($this->photo_name_salva) && $this->photo_name_limpa != "S")
          {
              $this->photo_name = $this->photo_name_salva;
          }
      } 
      elseif (!empty($this->photo_name_salva) && $this->photo_name_limpa != "S")
      {
          $this->photo_name = $this->photo_name_salva;
      }
   }

    function removeDuplicateDttmError($aErrDate, &$aErrTime)
    {
        if (empty($aErrDate) || empty($aErrTime))
        {
            return;
        }

        foreach ($aErrDate as $sErrDate)
        {
            foreach ($aErrTime as $iErrTime => $sErrTime)
            {
                if ($sErrDate == $sErrTime)
                {
                    unset($aErrTime[$iErrTime]);
                }
            }
        }
    } // removeDuplicateDttmError

   function nm_guardar_campos()
   {
    global
           $sc_seq_vert;
    $this->nmgp_dados_form['userid_int'] = $this->userid_int;
    $this->nmgp_dados_form['employee_name'] = $this->employee_name;
    $this->nmgp_dados_form['ic'] = $this->ic;
    $this->nmgp_dados_form['designation'] = $this->designation;
    $this->nmgp_dados_form['dept'] = $this->dept;
    $this->nmgp_dados_form['gender'] = $this->gender;
    $this->nmgp_dados_form['dob'] = (strlen(trim($this->dob)) > 19) ? str_replace(".", ":", $this->dob) : trim($this->dob);
    $this->nmgp_dados_form['address'] = $this->address;
    $this->nmgp_dados_form['phone'] = $this->phone;
    $this->nmgp_dados_form['hiredate'] = (strlen(trim($this->hiredate)) > 19) ? str_replace(".", ":", $this->hiredate) : trim($this->hiredate);
    $this->nmgp_dados_form['email'] = $this->email;
    $this->nmgp_dados_form['field01'] = $this->field01;
    $this->nmgp_dados_form['firedate'] = (strlen(trim($this->firedate)) > 19) ? str_replace(".", ":", $this->firedate) : trim($this->firedate);
    $this->nmgp_dados_form['hiring_duration'] = $this->hiring_duration;
    if (empty($this->photo_name))
    {
        $this->photo_name = $this->nmgp_dados_form['photo_name'];
    }
    $this->nmgp_dados_form['photo_name'] = $this->photo_name;
    $this->nmgp_dados_form['photo_name_limpa'] = $this->photo_name_limpa;
    $this->nmgp_dados_form['photo_size'] = $this->photo_size;
    $this->nmgp_dados_form['rate_cass'] = $this->rate_cass;
    $this->nmgp_dados_form['tax_cass'] = $this->tax_cass;
    $this->nmgp_dados_form['rate_cfgdct'] = $this->rate_cfgdct;
    $this->nmgp_dados_form['tax_cfgdct'] = $this->tax_cfgdct;
    $this->nmgp_dados_form['rate_ona'] = $this->rate_ona;
    $this->nmgp_dados_form['tax_ona'] = $this->tax_ona;
    $this->nmgp_dados_form['rate_fdu'] = $this->rate_fdu;
    $this->nmgp_dados_form['tax_fdu'] = $this->tax_fdu;
    $this->nmgp_dados_form['field02'] = $this->field02;
    $this->nmgp_dados_form['rate_iris'] = $this->rate_iris;
    $this->nmgp_dados_form['rate_fixed'] = $this->rate_fixed;
    $this->nmgp_dados_form['revenu_net'] = $this->revenu_net;
    $this->nmgp_dados_form['block_note'] = $this->block_note;
    $this->nmgp_dados_form['id'] = $this->id;
    $this->nmgp_dados_form['userid_varchar'] = $this->userid_varchar;
    $this->nmgp_dados_form['inactif'] = $this->inactif;
    $this->nmgp_dados_form['building'] = $this->building;
    $this->nmgp_dados_form['section'] = $this->section;
    if (empty($this->photo_file))
    {
        $this->photo_file = $this->nmgp_dados_form['photo_file'];
    }
    $this->nmgp_dados_form['photo_file'] = $this->photo_file;
    $this->nmgp_dados_form['photo_file_limpa'] = $this->photo_file_limpa;
    $this->nmgp_dados_form['imm_ona'] = $this->imm_ona;
    $this->nmgp_dados_form['no_compte'] = $this->no_compte;
    $this->nmgp_dados_form['type_de_compte'] = $this->type_de_compte;
    $this->nmgp_dados_form['payperiod'] = $this->payperiod;
    $this->nmgp_dados_form['probation_period'] = $this->probation_period;
    $this->nmgp_dados_form['rate_work'] = $this->rate_work;
    $this->nmgp_dados_form['rate_ot'] = $this->rate_ot;
    $this->nmgp_dados_form['rate_ot_factor'] = $this->rate_ot_factor;
    $this->nmgp_dados_form['rate_ot_holiday_factor'] = $this->rate_ot_holiday_factor;
    $this->nmgp_dados_form['rate_ot_offday_factor'] = $this->rate_ot_offday_factor;
    $this->nmgp_dados_form['rate_ot_restday_factor'] = $this->rate_ot_restday_factor;
    $this->nmgp_dados_form['rate_day'] = $this->rate_day;
    $this->nmgp_dados_form['rate_restday'] = $this->rate_restday;
    $this->nmgp_dados_form['rate_offday'] = $this->rate_offday;
    $this->nmgp_dados_form['rate_commission1'] = $this->rate_commission1;
    $this->nmgp_dados_form['rate_prime1'] = $this->rate_prime1;
    $this->nmgp_dados_form['rate_omission1'] = $this->rate_omission1;
    $this->nmgp_dados_form['rate_assmd'] = $this->rate_assmd;
    $this->nmgp_dados_form['rate_iric'] = $this->rate_iric;
    $this->nmgp_dados_form['rate_cons'] = $this->rate_cons;
    $this->nmgp_dados_form['day_cons'] = $this->day_cons;
    $this->nmgp_dados_form['incentive'] = $this->incentive;
    $this->nmgp_dados_form['incentive_desc'] = $this->incentive_desc;
    $this->nmgp_dados_form['rappel'] = $this->rappel;
    $this->nmgp_dados_form['other_deduct'] = $this->other_deduct;
    $this->nmgp_dados_form['other_deduct_desc'] = $this->other_deduct_desc;
    $this->nmgp_dados_form['loan'] = $this->loan;
    $this->nmgp_dados_form['date_loan'] = $this->date_loan;
    $this->nmgp_dados_form['payment'] = $this->payment;
    $this->nmgp_dados_form['date_payment'] = $this->date_payment;
    $this->nmgp_dados_form['payment_receipt'] = $this->payment_receipt;
    $this->nmgp_dados_form['loan_deduction'] = $this->loan_deduction;
    $this->nmgp_dados_form['loan_description'] = $this->loan_description;
    $this->nmgp_dados_form['loan_start_deduct'] = $this->loan_start_deduct;
    $this->nmgp_dados_form['loan_monthlypayment'] = $this->loan_monthlypayment;
    $this->nmgp_dados_form['loan_end_deduct'] = $this->loan_end_deduct;
    $this->nmgp_dados_form['apply_loan_deduction'] = $this->apply_loan_deduction;
    $this->nmgp_dados_form['loan_bank'] = $this->loan_bank;
    $this->nmgp_dados_form['date_loan_bank'] = $this->date_loan_bank;
    $this->nmgp_dados_form['loan_deduction_bank'] = $this->loan_deduction_bank;
    $this->nmgp_dados_form['loan_start_deduct_bank'] = $this->loan_start_deduct_bank;
    $this->nmgp_dados_form['loan_end_deduct_bank'] = $this->loan_end_deduct_bank;
    $this->nmgp_dados_form['apply_loan_deduction_bank'] = $this->apply_loan_deduction_bank;
    $this->nmgp_dados_form['other_loan'] = $this->other_loan;
    $this->nmgp_dados_form['date_other_loan'] = $this->date_other_loan;
    $this->nmgp_dados_form['other_loan_deduction'] = $this->other_loan_deduction;
    $this->nmgp_dados_form['other_loan_description'] = $this->other_loan_description;
    $this->nmgp_dados_form['other_loan_start_deduct'] = $this->other_loan_start_deduct;
    $this->nmgp_dados_form['other_loan_monthlypayment'] = $this->other_loan_monthlypayment;
    $this->nmgp_dados_form['other_loan_end_deduct'] = $this->other_loan_end_deduct;
    $this->nmgp_dados_form['apply_other_loan_deduction'] = $this->apply_other_loan_deduction;
    $this->nmgp_dados_form['purchase'] = $this->purchase;
    $this->nmgp_dados_form['purchase_description'] = $this->purchase_description;
    $this->nmgp_dados_form['date_purchase'] = $this->date_purchase;
    $this->nmgp_dados_form['purchase_deduct'] = $this->purchase_deduct;
    $this->nmgp_dados_form['purchase_start_deduct'] = $this->purchase_start_deduct;
    $this->nmgp_dados_form['purchase_monthlypayment'] = $this->purchase_monthlypayment;
    $this->nmgp_dados_form['purchase_end_deduct'] = $this->purchase_end_deduct;
    $this->nmgp_dados_form['apply_purchase_deduct'] = $this->apply_purchase_deduct;
    $this->nmgp_dados_form['health_insurance'] = $this->health_insurance;
    $this->nmgp_dados_form['bank_number'] = $this->bank_number;
    $this->nmgp_dados_form['update_time'] = $this->update_time;
    $this->nmgp_dados_form['field03'] = $this->field03;
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['userid_int'] = $this->userid_int;
      nm_limpa_numero($this->userid_int, $this->field_config['userid_int']['symbol_grp']) ; 
      $this->Before_unformat['dob'] = $this->dob;
      nm_limpa_data($this->dob, $this->field_config['dob']['date_sep']) ; 
      $this->Before_unformat['hiredate'] = $this->hiredate;
      nm_limpa_data($this->hiredate, $this->field_config['hiredate']['date_sep']) ; 
      $this->Before_unformat['firedate'] = $this->firedate;
      nm_limpa_data($this->firedate, $this->field_config['firedate']['date_sep']) ; 
      $this->Before_unformat['hiring_duration'] = $this->hiring_duration;
      if (!empty($this->field_config['hiring_duration']['symbol_dec']))
      {
         nm_limpa_valor($this->hiring_duration, $this->field_config['hiring_duration']['symbol_dec'], $this->field_config['hiring_duration']['symbol_grp']);
      }
      $this->Before_unformat['rate_cass'] = $this->rate_cass;
      if (!empty($this->field_config['rate_cass']['symbol_dec']))
      {
         nm_limpa_valor($this->rate_cass, $this->field_config['rate_cass']['symbol_dec'], $this->field_config['rate_cass']['symbol_grp']);
      }
      $this->Before_unformat['tax_cass'] = $this->tax_cass;
      if (!empty($this->field_config['tax_cass']['symbol_dec']))
      {
         $this->sc_remove_currency($this->tax_cass, $this->field_config['tax_cass']['symbol_dec'], $this->field_config['tax_cass']['symbol_grp'], $this->field_config['tax_cass']['symbol_mon']);
         nm_limpa_valor($this->tax_cass, $this->field_config['tax_cass']['symbol_dec'], $this->field_config['tax_cass']['symbol_grp']);
      }
      $this->Before_unformat['rate_cfgdct'] = $this->rate_cfgdct;
      if (!empty($this->field_config['rate_cfgdct']['symbol_dec']))
      {
         nm_limpa_valor($this->rate_cfgdct, $this->field_config['rate_cfgdct']['symbol_dec'], $this->field_config['rate_cfgdct']['symbol_grp']);
      }
      $this->Before_unformat['tax_cfgdct'] = $this->tax_cfgdct;
      if (!empty($this->field_config['tax_cfgdct']['symbol_dec']))
      {
         $this->sc_remove_currency($this->tax_cfgdct, $this->field_config['tax_cfgdct']['symbol_dec'], $this->field_config['tax_cfgdct']['symbol_grp'], $this->field_config['tax_cfgdct']['symbol_mon']);
         nm_limpa_valor($this->tax_cfgdct, $this->field_config['tax_cfgdct']['symbol_dec'], $this->field_config['tax_cfgdct']['symbol_grp']);
      }
      $this->Before_unformat['rate_ona'] = $this->rate_ona;
      if (!empty($this->field_config['rate_ona']['symbol_dec']))
      {
         nm_limpa_valor($this->rate_ona, $this->field_config['rate_ona']['symbol_dec'], $this->field_config['rate_ona']['symbol_grp']);
      }
      $this->Before_unformat['tax_ona'] = $this->tax_ona;
      if (!empty($this->field_config['tax_ona']['symbol_dec']))
      {
         $this->sc_remove_currency($this->tax_ona, $this->field_config['tax_ona']['symbol_dec'], $this->field_config['tax_ona']['symbol_grp'], $this->field_config['tax_ona']['symbol_mon']);
         nm_limpa_valor($this->tax_ona, $this->field_config['tax_ona']['symbol_dec'], $this->field_config['tax_ona']['symbol_grp']);
      }
      $this->Before_unformat['rate_fdu'] = $this->rate_fdu;
      if (!empty($this->field_config['rate_fdu']['symbol_dec']))
      {
         nm_limpa_valor($this->rate_fdu, $this->field_config['rate_fdu']['symbol_dec'], $this->field_config['rate_fdu']['symbol_grp']);
      }
      $this->Before_unformat['tax_fdu'] = $this->tax_fdu;
      if (!empty($this->field_config['tax_fdu']['symbol_dec']))
      {
         $this->sc_remove_currency($this->tax_fdu, $this->field_config['tax_fdu']['symbol_dec'], $this->field_config['tax_fdu']['symbol_grp'], $this->field_config['tax_fdu']['symbol_mon']);
         nm_limpa_valor($this->tax_fdu, $this->field_config['tax_fdu']['symbol_dec'], $this->field_config['tax_fdu']['symbol_grp']);
      }
      $this->Before_unformat['rate_iris'] = $this->rate_iris;
      if (!empty($this->field_config['rate_iris']['symbol_dec']))
      {
         $this->sc_remove_currency($this->rate_iris, $this->field_config['rate_iris']['symbol_dec'], $this->field_config['rate_iris']['symbol_grp'], $this->field_config['rate_iris']['symbol_mon']);
         nm_limpa_valor($this->rate_iris, $this->field_config['rate_iris']['symbol_dec'], $this->field_config['rate_iris']['symbol_grp']);
      }
      $this->Before_unformat['rate_fixed'] = $this->rate_fixed;
      if (!empty($this->field_config['rate_fixed']['symbol_dec']))
      {
         $this->sc_remove_currency($this->rate_fixed, $this->field_config['rate_fixed']['symbol_dec'], $this->field_config['rate_fixed']['symbol_grp'], $this->field_config['rate_fixed']['symbol_mon']);
         nm_limpa_valor($this->rate_fixed, $this->field_config['rate_fixed']['symbol_dec'], $this->field_config['rate_fixed']['symbol_grp']);
      }
      $this->Before_unformat['revenu_net'] = $this->revenu_net;
      if (!empty($this->field_config['revenu_net']['symbol_dec']))
      {
         $this->sc_remove_currency($this->revenu_net, $this->field_config['revenu_net']['symbol_dec'], $this->field_config['revenu_net']['symbol_grp'], $this->field_config['revenu_net']['symbol_mon']);
         nm_limpa_valor($this->revenu_net, $this->field_config['revenu_net']['symbol_dec'], $this->field_config['revenu_net']['symbol_grp']);
      }
      $this->Before_unformat['id'] = $this->id;
      nm_limpa_numero($this->id, $this->field_config['id']['symbol_grp']) ; 
      $this->Before_unformat['inactif'] = $this->inactif;
      nm_limpa_numero($this->inactif, $this->field_config['inactif']['symbol_grp']) ; 
      $this->Before_unformat['payperiod'] = $this->payperiod;
      nm_limpa_numero($this->payperiod, $this->field_config['payperiod']['symbol_grp']) ; 
      $this->Before_unformat['probation_period'] = $this->probation_period;
      nm_limpa_numero($this->probation_period, $this->field_config['probation_period']['symbol_grp']) ; 
      $this->Before_unformat['rate_work'] = $this->rate_work;
      if (!empty($this->field_config['rate_work']['symbol_dec']))
      {
         $this->sc_remove_currency($this->rate_work, $this->field_config['rate_work']['symbol_dec'], $this->field_config['rate_work']['symbol_grp'], $this->field_config['rate_work']['symbol_mon']);
         nm_limpa_valor($this->rate_work, $this->field_config['rate_work']['symbol_dec'], $this->field_config['rate_work']['symbol_grp']);
      }
      $this->Before_unformat['rate_ot'] = $this->rate_ot;
      if (!empty($this->field_config['rate_ot']['symbol_dec']))
      {
         $this->sc_remove_currency($this->rate_ot, $this->field_config['rate_ot']['symbol_dec'], $this->field_config['rate_ot']['symbol_grp'], $this->field_config['rate_ot']['symbol_mon']);
         nm_limpa_valor($this->rate_ot, $this->field_config['rate_ot']['symbol_dec'], $this->field_config['rate_ot']['symbol_grp']);
      }
      $this->Before_unformat['rate_ot_factor'] = $this->rate_ot_factor;
      if (!empty($this->field_config['rate_ot_factor']['symbol_dec']))
      {
         $this->sc_remove_currency($this->rate_ot_factor, $this->field_config['rate_ot_factor']['symbol_dec'], $this->field_config['rate_ot_factor']['symbol_grp'], $this->field_config['rate_ot_factor']['symbol_mon']);
         nm_limpa_valor($this->rate_ot_factor, $this->field_config['rate_ot_factor']['symbol_dec'], $this->field_config['rate_ot_factor']['symbol_grp']);
      }
      $this->Before_unformat['rate_ot_holiday_factor'] = $this->rate_ot_holiday_factor;
      if (!empty($this->field_config['rate_ot_holiday_factor']['symbol_dec']))
      {
         $this->sc_remove_currency($this->rate_ot_holiday_factor, $this->field_config['rate_ot_holiday_factor']['symbol_dec'], $this->field_config['rate_ot_holiday_factor']['symbol_grp'], $this->field_config['rate_ot_holiday_factor']['symbol_mon']);
         nm_limpa_valor($this->rate_ot_holiday_factor, $this->field_config['rate_ot_holiday_factor']['symbol_dec'], $this->field_config['rate_ot_holiday_factor']['symbol_grp']);
      }
      $this->Before_unformat['rate_ot_offday_factor'] = $this->rate_ot_offday_factor;
      if (!empty($this->field_config['rate_ot_offday_factor']['symbol_dec']))
      {
         $this->sc_remove_currency($this->rate_ot_offday_factor, $this->field_config['rate_ot_offday_factor']['symbol_dec'], $this->field_config['rate_ot_offday_factor']['symbol_grp'], $this->field_config['rate_ot_offday_factor']['symbol_mon']);
         nm_limpa_valor($this->rate_ot_offday_factor, $this->field_config['rate_ot_offday_factor']['symbol_dec'], $this->field_config['rate_ot_offday_factor']['symbol_grp']);
      }
      $this->Before_unformat['rate_ot_restday_factor'] = $this->rate_ot_restday_factor;
      if (!empty($this->field_config['rate_ot_restday_factor']['symbol_dec']))
      {
         $this->sc_remove_currency($this->rate_ot_restday_factor, $this->field_config['rate_ot_restday_factor']['symbol_dec'], $this->field_config['rate_ot_restday_factor']['symbol_grp'], $this->field_config['rate_ot_restday_factor']['symbol_mon']);
         nm_limpa_valor($this->rate_ot_restday_factor, $this->field_config['rate_ot_restday_factor']['symbol_dec'], $this->field_config['rate_ot_restday_factor']['symbol_grp']);
      }
      $this->Before_unformat['rate_day'] = $this->rate_day;
      if (!empty($this->field_config['rate_day']['symbol_dec']))
      {
         $this->sc_remove_currency($this->rate_day, $this->field_config['rate_day']['symbol_dec'], $this->field_config['rate_day']['symbol_grp'], $this->field_config['rate_day']['symbol_mon']);
         nm_limpa_valor($this->rate_day, $this->field_config['rate_day']['symbol_dec'], $this->field_config['rate_day']['symbol_grp']);
      }
      $this->Before_unformat['rate_restday'] = $this->rate_restday;
      if (!empty($this->field_config['rate_restday']['symbol_dec']))
      {
         $this->sc_remove_currency($this->rate_restday, $this->field_config['rate_restday']['symbol_dec'], $this->field_config['rate_restday']['symbol_grp'], $this->field_config['rate_restday']['symbol_mon']);
         nm_limpa_valor($this->rate_restday, $this->field_config['rate_restday']['symbol_dec'], $this->field_config['rate_restday']['symbol_grp']);
      }
      $this->Before_unformat['rate_offday'] = $this->rate_offday;
      if (!empty($this->field_config['rate_offday']['symbol_dec']))
      {
         $this->sc_remove_currency($this->rate_offday, $this->field_config['rate_offday']['symbol_dec'], $this->field_config['rate_offday']['symbol_grp'], $this->field_config['rate_offday']['symbol_mon']);
         nm_limpa_valor($this->rate_offday, $this->field_config['rate_offday']['symbol_dec'], $this->field_config['rate_offday']['symbol_grp']);
      }
      $this->Before_unformat['rate_commission1'] = $this->rate_commission1;
      if (!empty($this->field_config['rate_commission1']['symbol_dec']))
      {
         $this->sc_remove_currency($this->rate_commission1, $this->field_config['rate_commission1']['symbol_dec'], $this->field_config['rate_commission1']['symbol_grp'], $this->field_config['rate_commission1']['symbol_mon']);
         nm_limpa_valor($this->rate_commission1, $this->field_config['rate_commission1']['symbol_dec'], $this->field_config['rate_commission1']['symbol_grp']);
      }
      $this->Before_unformat['rate_prime1'] = $this->rate_prime1;
      if (!empty($this->field_config['rate_prime1']['symbol_dec']))
      {
         $this->sc_remove_currency($this->rate_prime1, $this->field_config['rate_prime1']['symbol_dec'], $this->field_config['rate_prime1']['symbol_grp'], $this->field_config['rate_prime1']['symbol_mon']);
         nm_limpa_valor($this->rate_prime1, $this->field_config['rate_prime1']['symbol_dec'], $this->field_config['rate_prime1']['symbol_grp']);
      }
      $this->Before_unformat['rate_omission1'] = $this->rate_omission1;
      if (!empty($this->field_config['rate_omission1']['symbol_dec']))
      {
         $this->sc_remove_currency($this->rate_omission1, $this->field_config['rate_omission1']['symbol_dec'], $this->field_config['rate_omission1']['symbol_grp'], $this->field_config['rate_omission1']['symbol_mon']);
         nm_limpa_valor($this->rate_omission1, $this->field_config['rate_omission1']['symbol_dec'], $this->field_config['rate_omission1']['symbol_grp']);
      }
      $this->Before_unformat['rate_assmd'] = $this->rate_assmd;
      if (!empty($this->field_config['rate_assmd']['symbol_dec']))
      {
         $this->sc_remove_currency($this->rate_assmd, $this->field_config['rate_assmd']['symbol_dec'], $this->field_config['rate_assmd']['symbol_grp'], $this->field_config['rate_assmd']['symbol_mon']);
         nm_limpa_valor($this->rate_assmd, $this->field_config['rate_assmd']['symbol_dec'], $this->field_config['rate_assmd']['symbol_grp']);
      }
      $this->Before_unformat['rate_iric'] = $this->rate_iric;
      if (!empty($this->field_config['rate_iric']['symbol_dec']))
      {
         $this->sc_remove_currency($this->rate_iric, $this->field_config['rate_iric']['symbol_dec'], $this->field_config['rate_iric']['symbol_grp'], $this->field_config['rate_iric']['symbol_mon']);
         nm_limpa_valor($this->rate_iric, $this->field_config['rate_iric']['symbol_dec'], $this->field_config['rate_iric']['symbol_grp']);
      }
      $this->Before_unformat['rate_cons'] = $this->rate_cons;
      if (!empty($this->field_config['rate_cons']['symbol_dec']))
      {
         $this->sc_remove_currency($this->rate_cons, $this->field_config['rate_cons']['symbol_dec'], $this->field_config['rate_cons']['symbol_grp'], $this->field_config['rate_cons']['symbol_mon']);
         nm_limpa_valor($this->rate_cons, $this->field_config['rate_cons']['symbol_dec'], $this->field_config['rate_cons']['symbol_grp']);
      }
      $this->Before_unformat['day_cons'] = $this->day_cons;
      if (!empty($this->field_config['day_cons']['symbol_dec']))
      {
         $this->sc_remove_currency($this->day_cons, $this->field_config['day_cons']['symbol_dec'], $this->field_config['day_cons']['symbol_grp'], $this->field_config['day_cons']['symbol_mon']);
         nm_limpa_valor($this->day_cons, $this->field_config['day_cons']['symbol_dec'], $this->field_config['day_cons']['symbol_grp']);
      }
      $this->Before_unformat['incentive'] = $this->incentive;
      if (!empty($this->field_config['incentive']['symbol_dec']))
      {
         $this->sc_remove_currency($this->incentive, $this->field_config['incentive']['symbol_dec'], $this->field_config['incentive']['symbol_grp'], $this->field_config['incentive']['symbol_mon']);
         nm_limpa_valor($this->incentive, $this->field_config['incentive']['symbol_dec'], $this->field_config['incentive']['symbol_grp']);
      }
      $this->Before_unformat['rappel'] = $this->rappel;
      if (!empty($this->field_config['rappel']['symbol_dec']))
      {
         $this->sc_remove_currency($this->rappel, $this->field_config['rappel']['symbol_dec'], $this->field_config['rappel']['symbol_grp'], $this->field_config['rappel']['symbol_mon']);
         nm_limpa_valor($this->rappel, $this->field_config['rappel']['symbol_dec'], $this->field_config['rappel']['symbol_grp']);
      }
      $this->Before_unformat['other_deduct'] = $this->other_deduct;
      if (!empty($this->field_config['other_deduct']['symbol_dec']))
      {
         $this->sc_remove_currency($this->other_deduct, $this->field_config['other_deduct']['symbol_dec'], $this->field_config['other_deduct']['symbol_grp'], $this->field_config['other_deduct']['symbol_mon']);
         nm_limpa_valor($this->other_deduct, $this->field_config['other_deduct']['symbol_dec'], $this->field_config['other_deduct']['symbol_grp']);
      }
      $this->Before_unformat['loan'] = $this->loan;
      if (!empty($this->field_config['loan']['symbol_dec']))
      {
         $this->sc_remove_currency($this->loan, $this->field_config['loan']['symbol_dec'], $this->field_config['loan']['symbol_grp'], $this->field_config['loan']['symbol_mon']);
         nm_limpa_valor($this->loan, $this->field_config['loan']['symbol_dec'], $this->field_config['loan']['symbol_grp']);
      }
      $this->Before_unformat['date_loan'] = $this->date_loan;
      nm_limpa_data($this->date_loan, $this->field_config['date_loan']['date_sep']) ; 
      $this->Before_unformat['payment'] = $this->payment;
      if (!empty($this->field_config['payment']['symbol_dec']))
      {
         $this->sc_remove_currency($this->payment, $this->field_config['payment']['symbol_dec'], $this->field_config['payment']['symbol_grp'], $this->field_config['payment']['symbol_mon']);
         nm_limpa_valor($this->payment, $this->field_config['payment']['symbol_dec'], $this->field_config['payment']['symbol_grp']);
      }
      $this->Before_unformat['date_payment'] = $this->date_payment;
      nm_limpa_data($this->date_payment, $this->field_config['date_payment']['date_sep']) ; 
      $this->Before_unformat['loan_deduction'] = $this->loan_deduction;
      if (!empty($this->field_config['loan_deduction']['symbol_dec']))
      {
         $this->sc_remove_currency($this->loan_deduction, $this->field_config['loan_deduction']['symbol_dec'], $this->field_config['loan_deduction']['symbol_grp'], $this->field_config['loan_deduction']['symbol_mon']);
         nm_limpa_valor($this->loan_deduction, $this->field_config['loan_deduction']['symbol_dec'], $this->field_config['loan_deduction']['symbol_grp']);
      }
      $this->Before_unformat['loan_start_deduct'] = $this->loan_start_deduct;
      nm_limpa_data($this->loan_start_deduct, $this->field_config['loan_start_deduct']['date_sep']) ; 
      $this->Before_unformat['loan_monthlypayment'] = $this->loan_monthlypayment;
      nm_limpa_numero($this->loan_monthlypayment, $this->field_config['loan_monthlypayment']['symbol_grp']) ; 
      $this->Before_unformat['loan_end_deduct'] = $this->loan_end_deduct;
      nm_limpa_data($this->loan_end_deduct, $this->field_config['loan_end_deduct']['date_sep']) ; 
      $this->Before_unformat['apply_loan_deduction'] = $this->apply_loan_deduction;
      nm_limpa_numero($this->apply_loan_deduction, $this->field_config['apply_loan_deduction']['symbol_grp']) ; 
      $this->Before_unformat['loan_bank'] = $this->loan_bank;
      if (!empty($this->field_config['loan_bank']['symbol_dec']))
      {
         $this->sc_remove_currency($this->loan_bank, $this->field_config['loan_bank']['symbol_dec'], $this->field_config['loan_bank']['symbol_grp'], $this->field_config['loan_bank']['symbol_mon']);
         nm_limpa_valor($this->loan_bank, $this->field_config['loan_bank']['symbol_dec'], $this->field_config['loan_bank']['symbol_grp']);
      }
      $this->Before_unformat['date_loan_bank'] = $this->date_loan_bank;
      nm_limpa_data($this->date_loan_bank, $this->field_config['date_loan_bank']['date_sep']) ; 
      $this->Before_unformat['loan_deduction_bank'] = $this->loan_deduction_bank;
      if (!empty($this->field_config['loan_deduction_bank']['symbol_dec']))
      {
         $this->sc_remove_currency($this->loan_deduction_bank, $this->field_config['loan_deduction_bank']['symbol_dec'], $this->field_config['loan_deduction_bank']['symbol_grp'], $this->field_config['loan_deduction_bank']['symbol_mon']);
         nm_limpa_valor($this->loan_deduction_bank, $this->field_config['loan_deduction_bank']['symbol_dec'], $this->field_config['loan_deduction_bank']['symbol_grp']);
      }
      $this->Before_unformat['loan_start_deduct_bank'] = $this->loan_start_deduct_bank;
      nm_limpa_data($this->loan_start_deduct_bank, $this->field_config['loan_start_deduct_bank']['date_sep']) ; 
      $this->Before_unformat['loan_end_deduct_bank'] = $this->loan_end_deduct_bank;
      nm_limpa_data($this->loan_end_deduct_bank, $this->field_config['loan_end_deduct_bank']['date_sep']) ; 
      $this->Before_unformat['apply_loan_deduction_bank'] = $this->apply_loan_deduction_bank;
      nm_limpa_numero($this->apply_loan_deduction_bank, $this->field_config['apply_loan_deduction_bank']['symbol_grp']) ; 
      $this->Before_unformat['other_loan'] = $this->other_loan;
      if (!empty($this->field_config['other_loan']['symbol_dec']))
      {
         $this->sc_remove_currency($this->other_loan, $this->field_config['other_loan']['symbol_dec'], $this->field_config['other_loan']['symbol_grp'], $this->field_config['other_loan']['symbol_mon']);
         nm_limpa_valor($this->other_loan, $this->field_config['other_loan']['symbol_dec'], $this->field_config['other_loan']['symbol_grp']);
      }
      $this->Before_unformat['date_other_loan'] = $this->date_other_loan;
      nm_limpa_data($this->date_other_loan, $this->field_config['date_other_loan']['date_sep']) ; 
      $this->Before_unformat['other_loan_deduction'] = $this->other_loan_deduction;
      if (!empty($this->field_config['other_loan_deduction']['symbol_dec']))
      {
         $this->sc_remove_currency($this->other_loan_deduction, $this->field_config['other_loan_deduction']['symbol_dec'], $this->field_config['other_loan_deduction']['symbol_grp'], $this->field_config['other_loan_deduction']['symbol_mon']);
         nm_limpa_valor($this->other_loan_deduction, $this->field_config['other_loan_deduction']['symbol_dec'], $this->field_config['other_loan_deduction']['symbol_grp']);
      }
      $this->Before_unformat['other_loan_start_deduct'] = $this->other_loan_start_deduct;
      nm_limpa_data($this->other_loan_start_deduct, $this->field_config['other_loan_start_deduct']['date_sep']) ; 
      $this->Before_unformat['other_loan_monthlypayment'] = $this->other_loan_monthlypayment;
      nm_limpa_numero($this->other_loan_monthlypayment, $this->field_config['other_loan_monthlypayment']['symbol_grp']) ; 
      $this->Before_unformat['other_loan_end_deduct'] = $this->other_loan_end_deduct;
      nm_limpa_data($this->other_loan_end_deduct, $this->field_config['other_loan_end_deduct']['date_sep']) ; 
      $this->Before_unformat['apply_other_loan_deduction'] = $this->apply_other_loan_deduction;
      nm_limpa_numero($this->apply_other_loan_deduction, $this->field_config['apply_other_loan_deduction']['symbol_grp']) ; 
      $this->Before_unformat['purchase'] = $this->purchase;
      if (!empty($this->field_config['purchase']['symbol_dec']))
      {
         $this->sc_remove_currency($this->purchase, $this->field_config['purchase']['symbol_dec'], $this->field_config['purchase']['symbol_grp'], $this->field_config['purchase']['symbol_mon']);
         nm_limpa_valor($this->purchase, $this->field_config['purchase']['symbol_dec'], $this->field_config['purchase']['symbol_grp']);
      }
      $this->Before_unformat['date_purchase'] = $this->date_purchase;
      nm_limpa_data($this->date_purchase, $this->field_config['date_purchase']['date_sep']) ; 
      $this->Before_unformat['purchase_deduct'] = $this->purchase_deduct;
      if (!empty($this->field_config['purchase_deduct']['symbol_dec']))
      {
         $this->sc_remove_currency($this->purchase_deduct, $this->field_config['purchase_deduct']['symbol_dec'], $this->field_config['purchase_deduct']['symbol_grp'], $this->field_config['purchase_deduct']['symbol_mon']);
         nm_limpa_valor($this->purchase_deduct, $this->field_config['purchase_deduct']['symbol_dec'], $this->field_config['purchase_deduct']['symbol_grp']);
      }
      $this->Before_unformat['purchase_start_deduct'] = $this->purchase_start_deduct;
      nm_limpa_data($this->purchase_start_deduct, $this->field_config['purchase_start_deduct']['date_sep']) ; 
      $this->Before_unformat['purchase_monthlypayment'] = $this->purchase_monthlypayment;
      nm_limpa_numero($this->purchase_monthlypayment, $this->field_config['purchase_monthlypayment']['symbol_grp']) ; 
      $this->Before_unformat['purchase_end_deduct'] = $this->purchase_end_deduct;
      nm_limpa_data($this->purchase_end_deduct, $this->field_config['purchase_end_deduct']['date_sep']) ; 
      $this->Before_unformat['apply_purchase_deduct'] = $this->apply_purchase_deduct;
      nm_limpa_numero($this->apply_purchase_deduct, $this->field_config['apply_purchase_deduct']['symbol_grp']) ; 
      $this->Before_unformat['health_insurance'] = $this->health_insurance;
      if (!empty($this->field_config['health_insurance']['symbol_dec']))
      {
         $this->sc_remove_currency($this->health_insurance, $this->field_config['health_insurance']['symbol_dec'], $this->field_config['health_insurance']['symbol_grp'], $this->field_config['health_insurance']['symbol_mon']);
         nm_limpa_valor($this->health_insurance, $this->field_config['health_insurance']['symbol_dec'], $this->field_config['health_insurance']['symbol_grp']);
      }
      $this->Before_unformat['update_time'] = $this->update_time;
      $this->Before_unformat['update_time_hora'] = $this->update_time_hora;
      nm_limpa_data($this->update_time, $this->field_config['update_time']['date_sep']) ; 
      nm_limpa_hora($this->update_time_hora, $this->field_config['update_time']['time_sep']) ; 
   }
   function sc_add_currency(&$value, $symbol, $pos)
   {
       if ('' == $value)
       {
           return;
       }
       $value = (1 == $pos || 3 == $pos) ? $symbol . ' ' . $value : $value . ' ' . $symbol;
   }
   function sc_remove_currency(&$value, $symbol_dec, $symbol_tho, $symbol_mon)
   {
       $value = preg_replace('~&#x0*([0-9a-f]+);~i', '', $value);
       $sNew  = str_replace($symbol_mon, '', $value);
       if ($sNew != $value)
       {
           $value = str_replace(' ', '', $sNew);
           return;
       }
       $aTest = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '-', $symbol_dec, $symbol_tho);
       $sNew  = '';
       for ($i = 0; $i < strlen($value); $i++)
       {
           if ($this->sc_test_currency_char($value[$i], $aTest))
           {
               $sNew .= $value[$i];
           }
       }
       $value = $sNew;
   }
   function sc_test_currency_char($char, $test)
   {
       $found = false;
       foreach ($test as $test_char)
       {
           if ($char === $test_char)
           {
               $found = true;
           }
       }
       return $found;
   }
   function nm_clear_val($Nome_Campo)
   {
      if ($Nome_Campo == "userid_int")
      {
          nm_limpa_numero($this->userid_int, $this->field_config['userid_int']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "hiring_duration")
      {
          if (!empty($this->field_config['hiring_duration']['symbol_dec']))
          {
             nm_limpa_valor($this->hiring_duration, $this->field_config['hiring_duration']['symbol_dec'], $this->field_config['hiring_duration']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_cass")
      {
          if (!empty($this->field_config['rate_cass']['symbol_dec']))
          {
             nm_limpa_valor($this->rate_cass, $this->field_config['rate_cass']['symbol_dec'], $this->field_config['rate_cass']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "tax_cass")
      {
          if (!empty($this->field_config['tax_cass']['symbol_dec']))
          {
             $this->sc_remove_currency($this->tax_cass, $this->field_config['tax_cass']['symbol_dec'], $this->field_config['tax_cass']['symbol_grp'], $this->field_config['tax_cass']['symbol_mon']);
             nm_limpa_valor($this->tax_cass, $this->field_config['tax_cass']['symbol_dec'], $this->field_config['tax_cass']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_cfgdct")
      {
          if (!empty($this->field_config['rate_cfgdct']['symbol_dec']))
          {
             nm_limpa_valor($this->rate_cfgdct, $this->field_config['rate_cfgdct']['symbol_dec'], $this->field_config['rate_cfgdct']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "tax_cfgdct")
      {
          if (!empty($this->field_config['tax_cfgdct']['symbol_dec']))
          {
             $this->sc_remove_currency($this->tax_cfgdct, $this->field_config['tax_cfgdct']['symbol_dec'], $this->field_config['tax_cfgdct']['symbol_grp'], $this->field_config['tax_cfgdct']['symbol_mon']);
             nm_limpa_valor($this->tax_cfgdct, $this->field_config['tax_cfgdct']['symbol_dec'], $this->field_config['tax_cfgdct']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_ona")
      {
          if (!empty($this->field_config['rate_ona']['symbol_dec']))
          {
             nm_limpa_valor($this->rate_ona, $this->field_config['rate_ona']['symbol_dec'], $this->field_config['rate_ona']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "tax_ona")
      {
          if (!empty($this->field_config['tax_ona']['symbol_dec']))
          {
             $this->sc_remove_currency($this->tax_ona, $this->field_config['tax_ona']['symbol_dec'], $this->field_config['tax_ona']['symbol_grp'], $this->field_config['tax_ona']['symbol_mon']);
             nm_limpa_valor($this->tax_ona, $this->field_config['tax_ona']['symbol_dec'], $this->field_config['tax_ona']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_fdu")
      {
          if (!empty($this->field_config['rate_fdu']['symbol_dec']))
          {
             nm_limpa_valor($this->rate_fdu, $this->field_config['rate_fdu']['symbol_dec'], $this->field_config['rate_fdu']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "tax_fdu")
      {
          if (!empty($this->field_config['tax_fdu']['symbol_dec']))
          {
             $this->sc_remove_currency($this->tax_fdu, $this->field_config['tax_fdu']['symbol_dec'], $this->field_config['tax_fdu']['symbol_grp'], $this->field_config['tax_fdu']['symbol_mon']);
             nm_limpa_valor($this->tax_fdu, $this->field_config['tax_fdu']['symbol_dec'], $this->field_config['tax_fdu']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_iris")
      {
          if (!empty($this->field_config['rate_iris']['symbol_dec']))
          {
             $this->sc_remove_currency($this->rate_iris, $this->field_config['rate_iris']['symbol_dec'], $this->field_config['rate_iris']['symbol_grp'], $this->field_config['rate_iris']['symbol_mon']);
             nm_limpa_valor($this->rate_iris, $this->field_config['rate_iris']['symbol_dec'], $this->field_config['rate_iris']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_fixed")
      {
          if (!empty($this->field_config['rate_fixed']['symbol_dec']))
          {
             $this->sc_remove_currency($this->rate_fixed, $this->field_config['rate_fixed']['symbol_dec'], $this->field_config['rate_fixed']['symbol_grp'], $this->field_config['rate_fixed']['symbol_mon']);
             nm_limpa_valor($this->rate_fixed, $this->field_config['rate_fixed']['symbol_dec'], $this->field_config['rate_fixed']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "revenu_net")
      {
          if (!empty($this->field_config['revenu_net']['symbol_dec']))
          {
             $this->sc_remove_currency($this->revenu_net, $this->field_config['revenu_net']['symbol_dec'], $this->field_config['revenu_net']['symbol_grp'], $this->field_config['revenu_net']['symbol_mon']);
             nm_limpa_valor($this->revenu_net, $this->field_config['revenu_net']['symbol_dec'], $this->field_config['revenu_net']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "id")
      {
          nm_limpa_numero($this->id, $this->field_config['id']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "inactif")
      {
          nm_limpa_numero($this->inactif, $this->field_config['inactif']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "payperiod")
      {
          nm_limpa_numero($this->payperiod, $this->field_config['payperiod']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "probation_period")
      {
          nm_limpa_numero($this->probation_period, $this->field_config['probation_period']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "rate_work")
      {
          if (!empty($this->field_config['rate_work']['symbol_dec']))
          {
             $this->sc_remove_currency($this->rate_work, $this->field_config['rate_work']['symbol_dec'], $this->field_config['rate_work']['symbol_grp'], $this->field_config['rate_work']['symbol_mon']);
             nm_limpa_valor($this->rate_work, $this->field_config['rate_work']['symbol_dec'], $this->field_config['rate_work']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_ot")
      {
          if (!empty($this->field_config['rate_ot']['symbol_dec']))
          {
             $this->sc_remove_currency($this->rate_ot, $this->field_config['rate_ot']['symbol_dec'], $this->field_config['rate_ot']['symbol_grp'], $this->field_config['rate_ot']['symbol_mon']);
             nm_limpa_valor($this->rate_ot, $this->field_config['rate_ot']['symbol_dec'], $this->field_config['rate_ot']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_ot_factor")
      {
          if (!empty($this->field_config['rate_ot_factor']['symbol_dec']))
          {
             $this->sc_remove_currency($this->rate_ot_factor, $this->field_config['rate_ot_factor']['symbol_dec'], $this->field_config['rate_ot_factor']['symbol_grp'], $this->field_config['rate_ot_factor']['symbol_mon']);
             nm_limpa_valor($this->rate_ot_factor, $this->field_config['rate_ot_factor']['symbol_dec'], $this->field_config['rate_ot_factor']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_ot_holiday_factor")
      {
          if (!empty($this->field_config['rate_ot_holiday_factor']['symbol_dec']))
          {
             $this->sc_remove_currency($this->rate_ot_holiday_factor, $this->field_config['rate_ot_holiday_factor']['symbol_dec'], $this->field_config['rate_ot_holiday_factor']['symbol_grp'], $this->field_config['rate_ot_holiday_factor']['symbol_mon']);
             nm_limpa_valor($this->rate_ot_holiday_factor, $this->field_config['rate_ot_holiday_factor']['symbol_dec'], $this->field_config['rate_ot_holiday_factor']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_ot_offday_factor")
      {
          if (!empty($this->field_config['rate_ot_offday_factor']['symbol_dec']))
          {
             $this->sc_remove_currency($this->rate_ot_offday_factor, $this->field_config['rate_ot_offday_factor']['symbol_dec'], $this->field_config['rate_ot_offday_factor']['symbol_grp'], $this->field_config['rate_ot_offday_factor']['symbol_mon']);
             nm_limpa_valor($this->rate_ot_offday_factor, $this->field_config['rate_ot_offday_factor']['symbol_dec'], $this->field_config['rate_ot_offday_factor']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_ot_restday_factor")
      {
          if (!empty($this->field_config['rate_ot_restday_factor']['symbol_dec']))
          {
             $this->sc_remove_currency($this->rate_ot_restday_factor, $this->field_config['rate_ot_restday_factor']['symbol_dec'], $this->field_config['rate_ot_restday_factor']['symbol_grp'], $this->field_config['rate_ot_restday_factor']['symbol_mon']);
             nm_limpa_valor($this->rate_ot_restday_factor, $this->field_config['rate_ot_restday_factor']['symbol_dec'], $this->field_config['rate_ot_restday_factor']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_day")
      {
          if (!empty($this->field_config['rate_day']['symbol_dec']))
          {
             $this->sc_remove_currency($this->rate_day, $this->field_config['rate_day']['symbol_dec'], $this->field_config['rate_day']['symbol_grp'], $this->field_config['rate_day']['symbol_mon']);
             nm_limpa_valor($this->rate_day, $this->field_config['rate_day']['symbol_dec'], $this->field_config['rate_day']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_restday")
      {
          if (!empty($this->field_config['rate_restday']['symbol_dec']))
          {
             $this->sc_remove_currency($this->rate_restday, $this->field_config['rate_restday']['symbol_dec'], $this->field_config['rate_restday']['symbol_grp'], $this->field_config['rate_restday']['symbol_mon']);
             nm_limpa_valor($this->rate_restday, $this->field_config['rate_restday']['symbol_dec'], $this->field_config['rate_restday']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_offday")
      {
          if (!empty($this->field_config['rate_offday']['symbol_dec']))
          {
             $this->sc_remove_currency($this->rate_offday, $this->field_config['rate_offday']['symbol_dec'], $this->field_config['rate_offday']['symbol_grp'], $this->field_config['rate_offday']['symbol_mon']);
             nm_limpa_valor($this->rate_offday, $this->field_config['rate_offday']['symbol_dec'], $this->field_config['rate_offday']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_commission1")
      {
          if (!empty($this->field_config['rate_commission1']['symbol_dec']))
          {
             $this->sc_remove_currency($this->rate_commission1, $this->field_config['rate_commission1']['symbol_dec'], $this->field_config['rate_commission1']['symbol_grp'], $this->field_config['rate_commission1']['symbol_mon']);
             nm_limpa_valor($this->rate_commission1, $this->field_config['rate_commission1']['symbol_dec'], $this->field_config['rate_commission1']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_prime1")
      {
          if (!empty($this->field_config['rate_prime1']['symbol_dec']))
          {
             $this->sc_remove_currency($this->rate_prime1, $this->field_config['rate_prime1']['symbol_dec'], $this->field_config['rate_prime1']['symbol_grp'], $this->field_config['rate_prime1']['symbol_mon']);
             nm_limpa_valor($this->rate_prime1, $this->field_config['rate_prime1']['symbol_dec'], $this->field_config['rate_prime1']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_omission1")
      {
          if (!empty($this->field_config['rate_omission1']['symbol_dec']))
          {
             $this->sc_remove_currency($this->rate_omission1, $this->field_config['rate_omission1']['symbol_dec'], $this->field_config['rate_omission1']['symbol_grp'], $this->field_config['rate_omission1']['symbol_mon']);
             nm_limpa_valor($this->rate_omission1, $this->field_config['rate_omission1']['symbol_dec'], $this->field_config['rate_omission1']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_assmd")
      {
          if (!empty($this->field_config['rate_assmd']['symbol_dec']))
          {
             $this->sc_remove_currency($this->rate_assmd, $this->field_config['rate_assmd']['symbol_dec'], $this->field_config['rate_assmd']['symbol_grp'], $this->field_config['rate_assmd']['symbol_mon']);
             nm_limpa_valor($this->rate_assmd, $this->field_config['rate_assmd']['symbol_dec'], $this->field_config['rate_assmd']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_iric")
      {
          if (!empty($this->field_config['rate_iric']['symbol_dec']))
          {
             $this->sc_remove_currency($this->rate_iric, $this->field_config['rate_iric']['symbol_dec'], $this->field_config['rate_iric']['symbol_grp'], $this->field_config['rate_iric']['symbol_mon']);
             nm_limpa_valor($this->rate_iric, $this->field_config['rate_iric']['symbol_dec'], $this->field_config['rate_iric']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rate_cons")
      {
          if (!empty($this->field_config['rate_cons']['symbol_dec']))
          {
             $this->sc_remove_currency($this->rate_cons, $this->field_config['rate_cons']['symbol_dec'], $this->field_config['rate_cons']['symbol_grp'], $this->field_config['rate_cons']['symbol_mon']);
             nm_limpa_valor($this->rate_cons, $this->field_config['rate_cons']['symbol_dec'], $this->field_config['rate_cons']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "day_cons")
      {
          if (!empty($this->field_config['day_cons']['symbol_dec']))
          {
             $this->sc_remove_currency($this->day_cons, $this->field_config['day_cons']['symbol_dec'], $this->field_config['day_cons']['symbol_grp'], $this->field_config['day_cons']['symbol_mon']);
             nm_limpa_valor($this->day_cons, $this->field_config['day_cons']['symbol_dec'], $this->field_config['day_cons']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "incentive")
      {
          if (!empty($this->field_config['incentive']['symbol_dec']))
          {
             $this->sc_remove_currency($this->incentive, $this->field_config['incentive']['symbol_dec'], $this->field_config['incentive']['symbol_grp'], $this->field_config['incentive']['symbol_mon']);
             nm_limpa_valor($this->incentive, $this->field_config['incentive']['symbol_dec'], $this->field_config['incentive']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "rappel")
      {
          if (!empty($this->field_config['rappel']['symbol_dec']))
          {
             $this->sc_remove_currency($this->rappel, $this->field_config['rappel']['symbol_dec'], $this->field_config['rappel']['symbol_grp'], $this->field_config['rappel']['symbol_mon']);
             nm_limpa_valor($this->rappel, $this->field_config['rappel']['symbol_dec'], $this->field_config['rappel']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "other_deduct")
      {
          if (!empty($this->field_config['other_deduct']['symbol_dec']))
          {
             $this->sc_remove_currency($this->other_deduct, $this->field_config['other_deduct']['symbol_dec'], $this->field_config['other_deduct']['symbol_grp'], $this->field_config['other_deduct']['symbol_mon']);
             nm_limpa_valor($this->other_deduct, $this->field_config['other_deduct']['symbol_dec'], $this->field_config['other_deduct']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "loan")
      {
          if (!empty($this->field_config['loan']['symbol_dec']))
          {
             $this->sc_remove_currency($this->loan, $this->field_config['loan']['symbol_dec'], $this->field_config['loan']['symbol_grp'], $this->field_config['loan']['symbol_mon']);
             nm_limpa_valor($this->loan, $this->field_config['loan']['symbol_dec'], $this->field_config['loan']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "payment")
      {
          if (!empty($this->field_config['payment']['symbol_dec']))
          {
             $this->sc_remove_currency($this->payment, $this->field_config['payment']['symbol_dec'], $this->field_config['payment']['symbol_grp'], $this->field_config['payment']['symbol_mon']);
             nm_limpa_valor($this->payment, $this->field_config['payment']['symbol_dec'], $this->field_config['payment']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "loan_deduction")
      {
          if (!empty($this->field_config['loan_deduction']['symbol_dec']))
          {
             $this->sc_remove_currency($this->loan_deduction, $this->field_config['loan_deduction']['symbol_dec'], $this->field_config['loan_deduction']['symbol_grp'], $this->field_config['loan_deduction']['symbol_mon']);
             nm_limpa_valor($this->loan_deduction, $this->field_config['loan_deduction']['symbol_dec'], $this->field_config['loan_deduction']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "loan_monthlypayment")
      {
          nm_limpa_numero($this->loan_monthlypayment, $this->field_config['loan_monthlypayment']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "apply_loan_deduction")
      {
          nm_limpa_numero($this->apply_loan_deduction, $this->field_config['apply_loan_deduction']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "loan_bank")
      {
          if (!empty($this->field_config['loan_bank']['symbol_dec']))
          {
             $this->sc_remove_currency($this->loan_bank, $this->field_config['loan_bank']['symbol_dec'], $this->field_config['loan_bank']['symbol_grp'], $this->field_config['loan_bank']['symbol_mon']);
             nm_limpa_valor($this->loan_bank, $this->field_config['loan_bank']['symbol_dec'], $this->field_config['loan_bank']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "loan_deduction_bank")
      {
          if (!empty($this->field_config['loan_deduction_bank']['symbol_dec']))
          {
             $this->sc_remove_currency($this->loan_deduction_bank, $this->field_config['loan_deduction_bank']['symbol_dec'], $this->field_config['loan_deduction_bank']['symbol_grp'], $this->field_config['loan_deduction_bank']['symbol_mon']);
             nm_limpa_valor($this->loan_deduction_bank, $this->field_config['loan_deduction_bank']['symbol_dec'], $this->field_config['loan_deduction_bank']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "apply_loan_deduction_bank")
      {
          nm_limpa_numero($this->apply_loan_deduction_bank, $this->field_config['apply_loan_deduction_bank']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "other_loan")
      {
          if (!empty($this->field_config['other_loan']['symbol_dec']))
          {
             $this->sc_remove_currency($this->other_loan, $this->field_config['other_loan']['symbol_dec'], $this->field_config['other_loan']['symbol_grp'], $this->field_config['other_loan']['symbol_mon']);
             nm_limpa_valor($this->other_loan, $this->field_config['other_loan']['symbol_dec'], $this->field_config['other_loan']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "other_loan_deduction")
      {
          if (!empty($this->field_config['other_loan_deduction']['symbol_dec']))
          {
             $this->sc_remove_currency($this->other_loan_deduction, $this->field_config['other_loan_deduction']['symbol_dec'], $this->field_config['other_loan_deduction']['symbol_grp'], $this->field_config['other_loan_deduction']['symbol_mon']);
             nm_limpa_valor($this->other_loan_deduction, $this->field_config['other_loan_deduction']['symbol_dec'], $this->field_config['other_loan_deduction']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "other_loan_monthlypayment")
      {
          nm_limpa_numero($this->other_loan_monthlypayment, $this->field_config['other_loan_monthlypayment']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "apply_other_loan_deduction")
      {
          nm_limpa_numero($this->apply_other_loan_deduction, $this->field_config['apply_other_loan_deduction']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "purchase")
      {
          if (!empty($this->field_config['purchase']['symbol_dec']))
          {
             $this->sc_remove_currency($this->purchase, $this->field_config['purchase']['symbol_dec'], $this->field_config['purchase']['symbol_grp'], $this->field_config['purchase']['symbol_mon']);
             nm_limpa_valor($this->purchase, $this->field_config['purchase']['symbol_dec'], $this->field_config['purchase']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "purchase_deduct")
      {
          if (!empty($this->field_config['purchase_deduct']['symbol_dec']))
          {
             $this->sc_remove_currency($this->purchase_deduct, $this->field_config['purchase_deduct']['symbol_dec'], $this->field_config['purchase_deduct']['symbol_grp'], $this->field_config['purchase_deduct']['symbol_mon']);
             nm_limpa_valor($this->purchase_deduct, $this->field_config['purchase_deduct']['symbol_dec'], $this->field_config['purchase_deduct']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "purchase_monthlypayment")
      {
          nm_limpa_numero($this->purchase_monthlypayment, $this->field_config['purchase_monthlypayment']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "apply_purchase_deduct")
      {
          nm_limpa_numero($this->apply_purchase_deduct, $this->field_config['apply_purchase_deduct']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "health_insurance")
      {
          if (!empty($this->field_config['health_insurance']['symbol_dec']))
          {
             $this->sc_remove_currency($this->health_insurance, $this->field_config['health_insurance']['symbol_dec'], $this->field_config['health_insurance']['symbol_grp'], $this->field_config['health_insurance']['symbol_mon']);
             nm_limpa_valor($this->health_insurance, $this->field_config['health_insurance']['symbol_dec'], $this->field_config['health_insurance']['symbol_grp']);
          }
      }
   }
   function nm_formatar_campos($format_fields = array())
   {
      global $nm_form_submit;
     if (isset($this->formatado) && $this->formatado)
     {
         return;
     }
     $this->formatado = true;
      if ('' !== $this->userid_int || (!empty($format_fields) && isset($format_fields['userid_int'])))
      {
          nmgp_Form_Num_Val($this->userid_int, $this->field_config['userid_int']['symbol_grp'], $this->field_config['userid_int']['symbol_dec'], "0", "S", $this->field_config['userid_int']['format_neg'], "", "", "-", $this->field_config['userid_int']['symbol_fmt']) ; 
      }
      if ((!empty($this->dob) && 'null' != $this->dob) || (!empty($format_fields) && isset($format_fields['dob'])))
      {
          nm_volta_data($this->dob, $this->field_config['dob']['date_format']) ; 
          nmgp_Form_Datas($this->dob, $this->field_config['dob']['date_format'], $this->field_config['dob']['date_sep']) ;  
      }
      elseif ('null' == $this->dob || '' == $this->dob)
      {
          $this->dob = '';
      }
      if ((!empty($this->hiredate) && 'null' != $this->hiredate) || (!empty($format_fields) && isset($format_fields['hiredate'])))
      {
          nm_volta_data($this->hiredate, $this->field_config['hiredate']['date_format']) ; 
          nmgp_Form_Datas($this->hiredate, $this->field_config['hiredate']['date_format'], $this->field_config['hiredate']['date_sep']) ;  
      }
      elseif ('null' == $this->hiredate || '' == $this->hiredate)
      {
          $this->hiredate = '';
      }
      if ((!empty($this->firedate) && 'null' != $this->firedate) || (!empty($format_fields) && isset($format_fields['firedate'])))
      {
          nm_volta_data($this->firedate, $this->field_config['firedate']['date_format']) ; 
          nmgp_Form_Datas($this->firedate, $this->field_config['firedate']['date_format'], $this->field_config['firedate']['date_sep']) ;  
      }
      elseif ('null' == $this->firedate || '' == $this->firedate)
      {
          $this->firedate = '';
      }
      if ('' !== $this->hiring_duration || (!empty($format_fields) && isset($format_fields['hiring_duration'])))
      {
          nmgp_Form_Num_Val($this->hiring_duration, $this->field_config['hiring_duration']['symbol_grp'], $this->field_config['hiring_duration']['symbol_dec'], "2", "S", $this->field_config['hiring_duration']['format_neg'], "", "", "-", $this->field_config['hiring_duration']['symbol_fmt']) ; 
      }
      if ('' !== $this->rate_cass || (!empty($format_fields) && isset($format_fields['rate_cass'])))
      {
          nmgp_Form_Num_Val($this->rate_cass, $this->field_config['rate_cass']['symbol_grp'], $this->field_config['rate_cass']['symbol_dec'], "2", "S", $this->field_config['rate_cass']['format_neg'], "", "", "-", $this->field_config['rate_cass']['symbol_fmt']) ; 
      }
      if ('' !== $this->tax_cass || (!empty($format_fields) && isset($format_fields['tax_cass'])))
      {
          nmgp_Form_Num_Val($this->tax_cass, $this->field_config['tax_cass']['symbol_grp'], $this->field_config['tax_cass']['symbol_dec'], "2", "S", $this->field_config['tax_cass']['format_neg'], "", "", "-", $this->field_config['tax_cass']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['tax_cass']['symbol_mon'];
          $this->sc_add_currency($this->tax_cass, $sMonSymb, $this->field_config['tax_cass']['format_pos']); 
      }
      if ('' !== $this->rate_cfgdct || (!empty($format_fields) && isset($format_fields['rate_cfgdct'])))
      {
          nmgp_Form_Num_Val($this->rate_cfgdct, $this->field_config['rate_cfgdct']['symbol_grp'], $this->field_config['rate_cfgdct']['symbol_dec'], "2", "S", $this->field_config['rate_cfgdct']['format_neg'], "", "", "-", $this->field_config['rate_cfgdct']['symbol_fmt']) ; 
      }
      if ('' !== $this->tax_cfgdct || (!empty($format_fields) && isset($format_fields['tax_cfgdct'])))
      {
          nmgp_Form_Num_Val($this->tax_cfgdct, $this->field_config['tax_cfgdct']['symbol_grp'], $this->field_config['tax_cfgdct']['symbol_dec'], "2", "S", $this->field_config['tax_cfgdct']['format_neg'], "", "", "-", $this->field_config['tax_cfgdct']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['tax_cfgdct']['symbol_mon'];
          $this->sc_add_currency($this->tax_cfgdct, $sMonSymb, $this->field_config['tax_cfgdct']['format_pos']); 
      }
      if ('' !== $this->rate_ona || (!empty($format_fields) && isset($format_fields['rate_ona'])))
      {
          nmgp_Form_Num_Val($this->rate_ona, $this->field_config['rate_ona']['symbol_grp'], $this->field_config['rate_ona']['symbol_dec'], "2", "S", $this->field_config['rate_ona']['format_neg'], "", "", "-", $this->field_config['rate_ona']['symbol_fmt']) ; 
      }
      if ('' !== $this->tax_ona || (!empty($format_fields) && isset($format_fields['tax_ona'])))
      {
          nmgp_Form_Num_Val($this->tax_ona, $this->field_config['tax_ona']['symbol_grp'], $this->field_config['tax_ona']['symbol_dec'], "2", "S", $this->field_config['tax_ona']['format_neg'], "", "", "-", $this->field_config['tax_ona']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['tax_ona']['symbol_mon'];
          $this->sc_add_currency($this->tax_ona, $sMonSymb, $this->field_config['tax_ona']['format_pos']); 
      }
      if ('' !== $this->rate_fdu || (!empty($format_fields) && isset($format_fields['rate_fdu'])))
      {
          nmgp_Form_Num_Val($this->rate_fdu, $this->field_config['rate_fdu']['symbol_grp'], $this->field_config['rate_fdu']['symbol_dec'], "2", "S", $this->field_config['rate_fdu']['format_neg'], "", "", "-", $this->field_config['rate_fdu']['symbol_fmt']) ; 
      }
      if ('' !== $this->tax_fdu || (!empty($format_fields) && isset($format_fields['tax_fdu'])))
      {
          nmgp_Form_Num_Val($this->tax_fdu, $this->field_config['tax_fdu']['symbol_grp'], $this->field_config['tax_fdu']['symbol_dec'], "2", "S", $this->field_config['tax_fdu']['format_neg'], "", "", "-", $this->field_config['tax_fdu']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['tax_fdu']['symbol_mon'];
          $this->sc_add_currency($this->tax_fdu, $sMonSymb, $this->field_config['tax_fdu']['format_pos']); 
      }
      if ('' !== $this->rate_iris || (!empty($format_fields) && isset($format_fields['rate_iris'])))
      {
          nmgp_Form_Num_Val($this->rate_iris, $this->field_config['rate_iris']['symbol_grp'], $this->field_config['rate_iris']['symbol_dec'], "2", "S", $this->field_config['rate_iris']['format_neg'], "", "", "-", $this->field_config['rate_iris']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['rate_iris']['symbol_mon'];
          $this->sc_add_currency($this->rate_iris, $sMonSymb, $this->field_config['rate_iris']['format_pos']); 
      }
      if ('' !== $this->rate_fixed || (!empty($format_fields) && isset($format_fields['rate_fixed'])))
      {
          nmgp_Form_Num_Val($this->rate_fixed, $this->field_config['rate_fixed']['symbol_grp'], $this->field_config['rate_fixed']['symbol_dec'], "2", "S", $this->field_config['rate_fixed']['format_neg'], "", "", "-", $this->field_config['rate_fixed']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['rate_fixed']['symbol_mon'];
          $this->sc_add_currency($this->rate_fixed, $sMonSymb, $this->field_config['rate_fixed']['format_pos']); 
      }
      if ('' !== $this->revenu_net || (!empty($format_fields) && isset($format_fields['revenu_net'])))
      {
          nmgp_Form_Num_Val($this->revenu_net, $this->field_config['revenu_net']['symbol_grp'], $this->field_config['revenu_net']['symbol_dec'], "2", "S", $this->field_config['revenu_net']['format_neg'], "", "", "-", $this->field_config['revenu_net']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['revenu_net']['symbol_mon'];
          $this->sc_add_currency($this->revenu_net, $sMonSymb, $this->field_config['revenu_net']['format_pos']); 
      }
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";

      if (false !== strpos($nm_mask, '9') || false !== strpos($nm_mask, 'a') || false !== strpos($nm_mask, '*'))
      {
          $new_campo = '';
          $a_mask_ord  = array();
          $i_mask_size = -1;

          foreach (explode(';', $nm_mask) as $str_mask)
          {
              $a_mask_ord[ $this->nm_conta_mask_chars($str_mask) ] = $str_mask;
          }
          ksort($a_mask_ord);

          foreach ($a_mask_ord as $i_size => $s_mask)
          {
              if (-1 == $i_mask_size)
              {
                  $i_mask_size = $i_size;
              }
              elseif (strlen($nm_campo) >= $i_size && strlen($nm_campo) > $i_mask_size)
              {
                  $i_mask_size = $i_size;
              }
          }
          $nm_mask = $a_mask_ord[$i_mask_size];

          for ($i = 0; $i < strlen($nm_mask); $i++)
          {
              $test_mask = substr($nm_mask, $i, 1);
              
              if ('9' == $test_mask || 'a' == $test_mask || '*' == $test_mask)
              {
                  $new_campo .= substr($nm_campo, 0, 1);
                  $nm_campo   = substr($nm_campo, 1);
              }
              else
              {
                  $new_campo .= $test_mask;
              }
          }

                  $nm_campo = $new_campo;

          return;
      }

      $mask_num = false;
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
              if ($cont1 < $cont2 && $tam_campo <= $cont2 && $tam_campo > $cont1)
              {
                  $trab_mask = $ver_duas[1];
              }
              elseif ($cont1 > $cont2 && $tam_campo <= $cont2)
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
          $nm_campo = $trab_saida;
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
      $nm_campo = $trab_saida;
   } 
   function nm_conta_mask_chars($sMask)
   {
       $iLength = 0;

       for ($i = 0; $i < strlen($sMask); $i++)
       {
           if (in_array($sMask[$i], array('9', 'a', '*')))
           {
               $iLength++;
           }
       }

       return $iLength;
   }
   function nm_tira_mask(&$nm_campo, $nm_mask, $nm_chars = '')
   { 
      $mask_dados = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $tam_mask   = strlen($nm_mask);
      $trab_saida = "";

      if (false !== strpos($nm_mask, '9') || false !== strpos($nm_mask, 'a') || false !== strpos($nm_mask, '*'))
      {
          $raw_campo = $this->sc_clear_mask($nm_campo, $nm_chars);
          $raw_mask  = $this->sc_clear_mask($nm_mask, $nm_chars);
          $new_campo = '';

          $test_mask = substr($raw_mask, 0, 1);
          $raw_mask  = substr($raw_mask, 1);

          while ('' != $raw_campo)
          {
              $test_val  = substr($raw_campo, 0, 1);
              $raw_campo = substr($raw_campo, 1);
              $ord       = ord($test_val);
              $found     = false;

              switch ($test_mask)
              {
                  case '9':
                      if (48 <= $ord && 57 >= $ord)
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;

                  case 'a':
                      if ((65 <= $ord && 90 >= $ord) || (97 <= $ord && 122 >= $ord))
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;

                  case '*':
                      if ((48 <= $ord && 57 >= $ord) || (65 <= $ord && 90 >= $ord) || (97 <= $ord && 122 >= $ord))
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;
              }

              if ($found)
              {
                  $test_mask = substr($raw_mask, 0, 1);
                  $raw_mask  = substr($raw_mask, 1);
              }
          }

          $nm_campo = $new_campo;

          return;
      }

      $mask_num = false;
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
          for ($x=0; $x < strlen($mask_dados); $x++)
          {
              if (is_numeric(substr($mask_dados, $x, 1)))
              {
                  $trab_saida .= substr($mask_dados, $x, 1);
              }
          }
          $nm_campo = $trab_saida;
          return;
      }
      if ($tam_mask > $tam_campo)
      {
         $mask_desfaz = "";
         for ($mask_ind = 0; $tam_mask > $tam_campo; $mask_ind++)
         {
              $mask_char = substr($trab_mask, $mask_ind, 1);
              if ($mask_char == "z")
              {
                  $tam_mask--;
              }
              else
              {
                  $mask_desfaz .= $mask_char;
              }
              if ($mask_ind == $tam_campo)
              {
                  $tam_mask = $tam_campo;
              }
         }
         $trab_mask = $mask_desfaz . substr($trab_mask, $mask_ind);
      }
      $mask_saida = "";
      for ($mask_ind = strlen($trab_mask); $mask_ind > 0; $mask_ind--)
      {
          $mask_char = substr($trab_mask, $mask_ind - 1, 1);
          if ($mask_char == "x" || $mask_char == "z")
          {
              if ($tam_campo > 0)
              {
                  $mask_saida = substr($mask_dados, $tam_campo - 1, 1) . $mask_saida;
              }
          }
          else
          {
              if ($mask_char != substr($mask_dados, $tam_campo - 1, 1) && $tam_campo > 0)
              {
                  $mask_saida = substr($mask_dados, $tam_campo - 1, 1) . $mask_saida;
                  $mask_ind--;
              }
          }
          $tam_campo--;
      }
      if ($tam_campo > 0)
      {
         $mask_saida = substr($mask_dados, 0, $tam_campo) . $mask_saida;
      }
      $nm_campo = $mask_saida;
   }

   function sc_clear_mask($value, $chars)
   {
       $new = '';

       for ($i = 0; $i < strlen($value); $i++)
       {
           if (false === strpos($chars, $value[$i]))
           {
               $new .= $value[$i];
           }
       }

       return $new;
   }
//
   function nm_limpa_alfa(&$str)
   {
   }
//
//-- 
   function nm_converte_datas($use_null = true, $bForce = false)
   {
      $guarda_format_hora = $this->field_config['dob']['date_format'];
      if ($this->dob != "")  
      { 
          nm_conv_data($this->dob, $this->field_config['dob']['date_format']) ; 
          $this->dob_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->dob_hora = substr($this->dob_hora, 0, -4);
          }
      } 
      if ($this->dob == "" && $use_null)  
      { 
          $this->dob = "null" ; 
      } 
      $this->field_config['dob']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['hiredate']['date_format'];
      if ($this->hiredate != "")  
      { 
          nm_conv_data($this->hiredate, $this->field_config['hiredate']['date_format']) ; 
          $this->hiredate_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hiredate_hora = substr($this->hiredate_hora, 0, -4);
          }
      } 
      if ($this->hiredate == "" && $use_null)  
      { 
          $this->hiredate = "null" ; 
      } 
      $this->field_config['hiredate']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['firedate']['date_format'];
      if ($this->firedate != "")  
      { 
          nm_conv_data($this->firedate, $this->field_config['firedate']['date_format']) ; 
          $this->firedate_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->firedate_hora = substr($this->firedate_hora, 0, -4);
          }
      } 
      if ($this->firedate == "" && $use_null)  
      { 
          $this->firedate = "null" ; 
      } 
      $this->field_config['firedate']['date_format'] = $guarda_format_hora;
   }
//
   function nm_prep_date_change($cmp_date, $format_dt)
   {
       $vl_return  = "";
       if ($cmp_date != 'null') {
           $vl_return .= (strpos($format_dt, "yy") !== false) ? substr($cmp_date,  0, 4) : "";
           $vl_return .= (strpos($format_dt, "mm") !== false) ? substr($cmp_date,  5, 2) : "";
           $vl_return .= (strpos($format_dt, "dd") !== false) ? substr($cmp_date,  8, 2) : "";
           $vl_return .= (strpos($format_dt, "hh") !== false) ? substr($cmp_date, 11, 2) : "";
           $vl_return .= (strpos($format_dt, "ii") !== false) ? substr($cmp_date, 14, 2) : "";
           $vl_return .= (strpos($format_dt, "ss") !== false) ? substr($cmp_date, 17, 2) : "";
       }
       return $vl_return;
   }
   function nm_conv_data_db($dt_in, $form_in, $form_out, $replaces = array())
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
           nm_conv_form_data($dt_out, $form_in, $form_out, $replaces);
           return $dt_out;
       }
   }

   function returnWhere($aCond, $sOp = 'AND')
   {
       $aWhere = array();
       foreach ($aCond as $sCond)
       {
           $this->handleWhereCond($sCond);
           if ('' != $sCond)
           {
               $aWhere[] = $sCond;
           }
       }
       if (empty($aWhere))
       {
           return '';
       }
       else
       {
           return ' WHERE (' . implode(') ' . $sOp . ' (', $aWhere) . ')';
       }
   } // returnWhere

   function handleWhereCond(&$sCond)
   {
       $sCond = trim($sCond);
       if ('where' == strtolower(substr($sCond, 0, 5)))
       {
           $sCond = trim(substr($sCond, 5));
       }
   } // handleWhereCond

   function ajax_return_values()
   {
          $this->ajax_return_values_userid_int();
          $this->ajax_return_values_employee_name();
          $this->ajax_return_values_ic();
          $this->ajax_return_values_designation();
          $this->ajax_return_values_dept();
          $this->ajax_return_values_gender();
          $this->ajax_return_values_dob();
          $this->ajax_return_values_address();
          $this->ajax_return_values_phone();
          $this->ajax_return_values_hiredate();
          $this->ajax_return_values_email();
          $this->ajax_return_values_field01();
          $this->ajax_return_values_firedate();
          $this->ajax_return_values_hiring_duration();
          $this->ajax_return_values_photo_name();
          $this->ajax_return_values_photo_size();
          $this->ajax_return_values_rate_cass();
          $this->ajax_return_values_tax_cass();
          $this->ajax_return_values_rate_cfgdct();
          $this->ajax_return_values_tax_cfgdct();
          $this->ajax_return_values_rate_ona();
          $this->ajax_return_values_tax_ona();
          $this->ajax_return_values_rate_fdu();
          $this->ajax_return_values_tax_fdu();
          $this->ajax_return_values_field02();
          $this->ajax_return_values_rate_iris();
          $this->ajax_return_values_rate_fixed();
          $this->ajax_return_values_revenu_net();
          $this->ajax_return_values_block_note();
          $this->ajax_return_values_id();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['id']['keyVal'] = form_FicheEmployeeSuspended_mob_pack_protect_string($this->nmgp_dados_form['id']);
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee_mob']['foreign_key']['userid_int'] = $this->nmgp_dados_form['userid_int'];
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee_mob']['where_filter'] = "userid_int = " . $this->nmgp_dados_form['userid_int'] . "";
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee_mob']['where_detal']  = "userid_int = " . $this->nmgp_dados_form['userid_int'] . "";
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['total'] < 0)
              {
                  $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee_mob']['where_filter'] = "1 <> 1";
              }
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee_mob']['reg_start'] = "";
              unset($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee_mob']['total']);
              foreach ($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee_mob'] as $i => $v)
              {
                  $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee'][$i] = $v;
              }
              if (isset($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee_mob']['total']))
              {
                  unset($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['form_tbl_note_employee_mob_script_case_init'] ]['form_tbl_note_employee_mob']['total']);
              }
          }
   } // ajax_return_values

          //----- userid_int
   function ajax_return_values_userid_int($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("userid_int", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->userid_int);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['userid_int'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- employee_name
   function ajax_return_values_employee_name($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("employee_name", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->employee_name);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['employee_name'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- ic
   function ajax_return_values_ic($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ic", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ic);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['ic'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- designation
   function ajax_return_values_designation($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("designation", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->designation);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['designation'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- dept
   function ajax_return_values_dept($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("dept", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->dept);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['dept'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- gender
   function ajax_return_values_gender($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("gender", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->gender);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['gender'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- dob
   function ajax_return_values_dob($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("dob", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->dob);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['dob'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- address
   function ajax_return_values_address($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("address", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->address);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['address'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- phone
   function ajax_return_values_phone($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("phone", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->phone);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['phone'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- hiredate
   function ajax_return_values_hiredate($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hiredate", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hiredate);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hiredate'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- email
   function ajax_return_values_email($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("email", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->email);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['email'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- field01
   function ajax_return_values_field01($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("field01", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->field01);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['field01'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- firedate
   function ajax_return_values_firedate($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("firedate", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->firedate);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['firedate'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- hiring_duration
   function ajax_return_values_hiring_duration($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hiring_duration", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hiring_duration);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hiring_duration'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- photo_name
   function ajax_return_values_photo_name($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("photo_name", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->photo_name);
              $aLookup = array();
   $out_photo_name = '';
   $out1_photo_name = '';
   if ($this->photo_name != "" && $this->photo_name != "none")   
   { 
       $path_photo_name = $this->Ini->root . $this->Ini->path_imagens . "" . "/" . $this->photo_name;
       $md5_photo_name  = md5("" . $this->photo_name);
       nm_fix_SubDirUpload($this->photo_name,$this->Ini->root . $this->Ini->path_imagens,"");
 
       $file_path_cache = $this->Ini->path_cache . '//' . $this->photo_name;
       if(file_exists($file_path_cache)){
            $path_photo_name = $file_path_cache;
       }
       if (is_file($path_photo_name))  
       { 
           $NM_ler_img = true;
           $out_photo_name = $this->Ini->path_imag_temp . "/sc_photo_name_" . $md5_photo_name . ".gif" ;  
           $out1_photo_name = $out_photo_name; 
           if (is_file($this->Ini->root . $out_photo_name))  
           { 
               $NM_img_time = filemtime($this->Ini->root . $out_photo_name) + 0; 
               if ($this->Ini->nm_timestamp < $NM_img_time)  
               { 
                   $NM_ler_img = false;
               } 
           } 
           if ($NM_ler_img) 
           { 
               $tmp_photo_name = fopen($path_photo_name, "r") ; 
               $reg_photo_name = fread($tmp_photo_name, filesize($path_photo_name)) ; 
               fclose($tmp_photo_name) ;  
               $arq_photo_name = fopen($this->Ini->root . $out_photo_name, "w") ;  
               fwrite($arq_photo_name, $reg_photo_name) ;  
               fclose($arq_photo_name) ;  
           } 
           $sc_obj_img = new nm_trata_img($this->Ini->root . $out_photo_name, true);
           $this->nmgp_return_img['photo_name'][0] = $sc_obj_img->getHeight();
           $this->nmgp_return_img['photo_name'][1] = $sc_obj_img->getWidth();
           $NM_redim_img = true;
           $md5_photo_name  = md5($this->photo_name);
           $out_photo_name = $this->Ini->path_imag_temp . "/sc_photo_name_200200" . $md5_photo_name . ".gif" ;  
           if (is_file($this->Ini->root . $out_photo_name))  
           { 
               $NM_img_time = filemtime($this->Ini->root . $out_photo_name) + 0; 
               if ($this->Ini->nm_timestamp < $NM_img_time)  
               { 
                   $NM_redim_img = false;
               } 
           } 
           if ($NM_redim_img) 
           { 
               if (!$this->Ini->Gd_missing)
               { 
                   $sc_obj_img = new nm_trata_img($this->Ini->root . $out1_photo_name, true);
                   $sc_obj_img->setWidth(200);
                   $sc_obj_img->setHeight(200);
                   $sc_obj_img->setManterAspecto(true);
                   $sc_obj_img->createImg($this->Ini->root . $out_photo_name);
               } 
               else 
               { 
                   $out_photo_name = $out1_photo_name;
               } 
           } 
       } 
   } 
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['photo_name'] = array(
                       'row'    => '',
               'type'    => 'imagem',
               'valList' => array($sTmpValue),
               'imgFile' => $out_photo_name,
               'imgOrig' => $out1_photo_name,
               'keepImg' => $sKeepImage,
               'hideName' => 'S',
              );
          }
   }

          //----- photo_size
   function ajax_return_values_photo_size($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("photo_size", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->photo_size);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['photo_size'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- rate_cass
   function ajax_return_values_rate_cass($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("rate_cass", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->rate_cass);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['rate_cass'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tax_cass
   function ajax_return_values_tax_cass($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tax_cass", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tax_cass);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tax_cass'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- rate_cfgdct
   function ajax_return_values_rate_cfgdct($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("rate_cfgdct", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->rate_cfgdct);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['rate_cfgdct'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tax_cfgdct
   function ajax_return_values_tax_cfgdct($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tax_cfgdct", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tax_cfgdct);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tax_cfgdct'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- rate_ona
   function ajax_return_values_rate_ona($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("rate_ona", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->rate_ona);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['rate_ona'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tax_ona
   function ajax_return_values_tax_ona($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tax_ona", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tax_ona);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tax_ona'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- rate_fdu
   function ajax_return_values_rate_fdu($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("rate_fdu", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->rate_fdu);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['rate_fdu'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tax_fdu
   function ajax_return_values_tax_fdu($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tax_fdu", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tax_fdu);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tax_fdu'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- field02
   function ajax_return_values_field02($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("field02", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->field02);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['field02'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- rate_iris
   function ajax_return_values_rate_iris($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("rate_iris", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->rate_iris);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['rate_iris'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- rate_fixed
   function ajax_return_values_rate_fixed($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("rate_fixed", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->rate_fixed);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['rate_fixed'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- revenu_net
   function ajax_return_values_revenu_net($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("revenu_net", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->revenu_net);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['revenu_net'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- block_note
   function ajax_return_values_block_note($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("block_note", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->block_note);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['block_note'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- id
   function ajax_return_values_id($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("id", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->id);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['id'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("id", $this->form_encode_input($sTmpValue))),
              );
          }
   }

    function fetchUniqueUploadName($originalName, $uploadDir, $fieldName)
    {
        $originalName = trim($originalName);
        if ('' == $originalName)
        {
            return $originalName;
        }
        if (!@is_dir($uploadDir))
        {
            return $originalName;
        }
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['upload_dir'][$fieldName][] = $newName;
            return $newName;
        }
    } // fetchUniqueUploadName

    function fetchFileNextName($uniqueName, $uniqueList)
    {
        $aPathinfo     = pathinfo($uniqueName);
        $fileExtension = $aPathinfo['extension'];
        $fileName      = $aPathinfo['filename'];
        $foundName     = false;
        $nameIt        = 1;
        if ('' != $fileExtension)
        {
            $fileExtension = '.' . $fileExtension;
        }
        while (!$foundName)
        {
            $testName = $fileName . '(' . $nameIt . ')' . $fileExtension;
            if (in_array($testName, $uniqueList))
            {
                $nameIt++;
            }
            else
            {
                $foundName = true;
                return $testName;
            }
        }
    } // fetchFileNextName

   function ajax_add_parameters()
   {
       $this->NM_ajax_info['summary_line'] = $this->getSummaryLine();
   } // ajax_add_parameters
  function nm_proc_onload($bFormat = true)
  {
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['Field_no_validate'] = array();
      $this->nm_guardar_campos();
      if ($bFormat) $this->nm_formatar_campos();
  }
//
//----------------------------------------------------
//-----> 
//----------------------------------------------------
//
   function nm_troca_decimal($sc_parm1, $sc_parm2) 
   { 
      $this->hiring_duration = str_replace($sc_parm1, $sc_parm2, $this->hiring_duration); 
      $this->rate_cass = str_replace($sc_parm1, $sc_parm2, $this->rate_cass); 
      $this->tax_cass = str_replace($sc_parm1, $sc_parm2, $this->tax_cass); 
      $this->rate_cfgdct = str_replace($sc_parm1, $sc_parm2, $this->rate_cfgdct); 
      $this->tax_cfgdct = str_replace($sc_parm1, $sc_parm2, $this->tax_cfgdct); 
      $this->rate_ona = str_replace($sc_parm1, $sc_parm2, $this->rate_ona); 
      $this->tax_ona = str_replace($sc_parm1, $sc_parm2, $this->tax_ona); 
      $this->rate_fdu = str_replace($sc_parm1, $sc_parm2, $this->rate_fdu); 
      $this->tax_fdu = str_replace($sc_parm1, $sc_parm2, $this->tax_fdu); 
      $this->rate_iris = str_replace($sc_parm1, $sc_parm2, $this->rate_iris); 
      $this->rate_fixed = str_replace($sc_parm1, $sc_parm2, $this->rate_fixed); 
      $this->revenu_net = str_replace($sc_parm1, $sc_parm2, $this->revenu_net); 
      $this->rate_work = str_replace($sc_parm1, $sc_parm2, $this->rate_work); 
      $this->rate_ot = str_replace($sc_parm1, $sc_parm2, $this->rate_ot); 
      $this->rate_ot_factor = str_replace($sc_parm1, $sc_parm2, $this->rate_ot_factor); 
      $this->rate_ot_holiday_factor = str_replace($sc_parm1, $sc_parm2, $this->rate_ot_holiday_factor); 
      $this->rate_ot_offday_factor = str_replace($sc_parm1, $sc_parm2, $this->rate_ot_offday_factor); 
      $this->rate_ot_restday_factor = str_replace($sc_parm1, $sc_parm2, $this->rate_ot_restday_factor); 
      $this->rate_day = str_replace($sc_parm1, $sc_parm2, $this->rate_day); 
      $this->rate_restday = str_replace($sc_parm1, $sc_parm2, $this->rate_restday); 
      $this->rate_offday = str_replace($sc_parm1, $sc_parm2, $this->rate_offday); 
      $this->rate_commission1 = str_replace($sc_parm1, $sc_parm2, $this->rate_commission1); 
      $this->rate_prime1 = str_replace($sc_parm1, $sc_parm2, $this->rate_prime1); 
      $this->rate_omission1 = str_replace($sc_parm1, $sc_parm2, $this->rate_omission1); 
      $this->rate_assmd = str_replace($sc_parm1, $sc_parm2, $this->rate_assmd); 
      $this->rate_iric = str_replace($sc_parm1, $sc_parm2, $this->rate_iric); 
      $this->rate_cons = str_replace($sc_parm1, $sc_parm2, $this->rate_cons); 
      $this->day_cons = str_replace($sc_parm1, $sc_parm2, $this->day_cons); 
      $this->incentive = str_replace($sc_parm1, $sc_parm2, $this->incentive); 
      $this->rappel = str_replace($sc_parm1, $sc_parm2, $this->rappel); 
      $this->other_deduct = str_replace($sc_parm1, $sc_parm2, $this->other_deduct); 
      $this->loan = str_replace($sc_parm1, $sc_parm2, $this->loan); 
      $this->payment = str_replace($sc_parm1, $sc_parm2, $this->payment); 
      $this->loan_deduction = str_replace($sc_parm1, $sc_parm2, $this->loan_deduction); 
      $this->loan_bank = str_replace($sc_parm1, $sc_parm2, $this->loan_bank); 
      $this->loan_deduction_bank = str_replace($sc_parm1, $sc_parm2, $this->loan_deduction_bank); 
      $this->other_loan = str_replace($sc_parm1, $sc_parm2, $this->other_loan); 
      $this->other_loan_deduction = str_replace($sc_parm1, $sc_parm2, $this->other_loan_deduction); 
      $this->purchase = str_replace($sc_parm1, $sc_parm2, $this->purchase); 
      $this->purchase_deduct = str_replace($sc_parm1, $sc_parm2, $this->purchase_deduct); 
      $this->health_insurance = str_replace($sc_parm1, $sc_parm2, $this->health_insurance); 
   } 
   function nm_poe_aspas_decimal() 
   { 
      $this->hiring_duration = "'" . $this->hiring_duration . "'";
      $this->rate_cass = "'" . $this->rate_cass . "'";
      $this->tax_cass = "'" . $this->tax_cass . "'";
      $this->rate_cfgdct = "'" . $this->rate_cfgdct . "'";
      $this->tax_cfgdct = "'" . $this->tax_cfgdct . "'";
      $this->rate_ona = "'" . $this->rate_ona . "'";
      $this->tax_ona = "'" . $this->tax_ona . "'";
      $this->rate_fdu = "'" . $this->rate_fdu . "'";
      $this->tax_fdu = "'" . $this->tax_fdu . "'";
      $this->rate_iris = "'" . $this->rate_iris . "'";
      $this->rate_fixed = "'" . $this->rate_fixed . "'";
      $this->revenu_net = "'" . $this->revenu_net . "'";
      $this->rate_work = "'" . $this->rate_work . "'";
      $this->rate_ot = "'" . $this->rate_ot . "'";
      $this->rate_ot_factor = "'" . $this->rate_ot_factor . "'";
      $this->rate_ot_holiday_factor = "'" . $this->rate_ot_holiday_factor . "'";
      $this->rate_ot_offday_factor = "'" . $this->rate_ot_offday_factor . "'";
      $this->rate_ot_restday_factor = "'" . $this->rate_ot_restday_factor . "'";
      $this->rate_day = "'" . $this->rate_day . "'";
      $this->rate_restday = "'" . $this->rate_restday . "'";
      $this->rate_offday = "'" . $this->rate_offday . "'";
      $this->rate_commission1 = "'" . $this->rate_commission1 . "'";
      $this->rate_prime1 = "'" . $this->rate_prime1 . "'";
      $this->rate_omission1 = "'" . $this->rate_omission1 . "'";
      $this->rate_assmd = "'" . $this->rate_assmd . "'";
      $this->rate_iric = "'" . $this->rate_iric . "'";
      $this->rate_cons = "'" . $this->rate_cons . "'";
      $this->day_cons = "'" . $this->day_cons . "'";
      $this->incentive = "'" . $this->incentive . "'";
      $this->rappel = "'" . $this->rappel . "'";
      $this->other_deduct = "'" . $this->other_deduct . "'";
      $this->loan = "'" . $this->loan . "'";
      $this->payment = "'" . $this->payment . "'";
      $this->loan_deduction = "'" . $this->loan_deduction . "'";
      $this->loan_bank = "'" . $this->loan_bank . "'";
      $this->loan_deduction_bank = "'" . $this->loan_deduction_bank . "'";
      $this->other_loan = "'" . $this->other_loan . "'";
      $this->other_loan_deduction = "'" . $this->other_loan_deduction . "'";
      $this->purchase = "'" . $this->purchase . "'";
      $this->purchase_deduct = "'" . $this->purchase_deduct . "'";
      $this->health_insurance = "'" . $this->health_insurance . "'";
   } 
   function nm_tira_aspas_decimal() 
   { 
      $this->hiring_duration = str_replace("'", "", $this->hiring_duration); 
      $this->rate_cass = str_replace("'", "", $this->rate_cass); 
      $this->tax_cass = str_replace("'", "", $this->tax_cass); 
      $this->rate_cfgdct = str_replace("'", "", $this->rate_cfgdct); 
      $this->tax_cfgdct = str_replace("'", "", $this->tax_cfgdct); 
      $this->rate_ona = str_replace("'", "", $this->rate_ona); 
      $this->tax_ona = str_replace("'", "", $this->tax_ona); 
      $this->rate_fdu = str_replace("'", "", $this->rate_fdu); 
      $this->tax_fdu = str_replace("'", "", $this->tax_fdu); 
      $this->rate_iris = str_replace("'", "", $this->rate_iris); 
      $this->rate_fixed = str_replace("'", "", $this->rate_fixed); 
      $this->revenu_net = str_replace("'", "", $this->revenu_net); 
      $this->rate_work = str_replace("'", "", $this->rate_work); 
      $this->rate_ot = str_replace("'", "", $this->rate_ot); 
      $this->rate_ot_factor = str_replace("'", "", $this->rate_ot_factor); 
      $this->rate_ot_holiday_factor = str_replace("'", "", $this->rate_ot_holiday_factor); 
      $this->rate_ot_offday_factor = str_replace("'", "", $this->rate_ot_offday_factor); 
      $this->rate_ot_restday_factor = str_replace("'", "", $this->rate_ot_restday_factor); 
      $this->rate_day = str_replace("'", "", $this->rate_day); 
      $this->rate_restday = str_replace("'", "", $this->rate_restday); 
      $this->rate_offday = str_replace("'", "", $this->rate_offday); 
      $this->rate_commission1 = str_replace("'", "", $this->rate_commission1); 
      $this->rate_prime1 = str_replace("'", "", $this->rate_prime1); 
      $this->rate_omission1 = str_replace("'", "", $this->rate_omission1); 
      $this->rate_assmd = str_replace("'", "", $this->rate_assmd); 
      $this->rate_iric = str_replace("'", "", $this->rate_iric); 
      $this->rate_cons = str_replace("'", "", $this->rate_cons); 
      $this->day_cons = str_replace("'", "", $this->day_cons); 
      $this->incentive = str_replace("'", "", $this->incentive); 
      $this->rappel = str_replace("'", "", $this->rappel); 
      $this->other_deduct = str_replace("'", "", $this->other_deduct); 
      $this->loan = str_replace("'", "", $this->loan); 
      $this->payment = str_replace("'", "", $this->payment); 
      $this->loan_deduction = str_replace("'", "", $this->loan_deduction); 
      $this->loan_bank = str_replace("'", "", $this->loan_bank); 
      $this->loan_deduction_bank = str_replace("'", "", $this->loan_deduction_bank); 
      $this->other_loan = str_replace("'", "", $this->other_loan); 
      $this->other_loan_deduction = str_replace("'", "", $this->other_loan_deduction); 
      $this->purchase = str_replace("'", "", $this->purchase); 
      $this->purchase_deduct = str_replace("'", "", $this->purchase_deduct); 
      $this->health_insurance = str_replace("'", "", $this->health_insurance); 
   } 
//----------- 


   function temRegistros($sWhere)
   {
       if ('' == $sWhere)
       {
           return false;
       }
       $nmgp_sel_count = 'SELECT COUNT(*) AS countTest FROM ' . $this->Ini->nm_tabela . ' WHERE ' . $sWhere;
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
       $rsc = $this->Db->Execute($nmgp_sel_count); 
       if ($rsc === false && !$rsc->EOF)
       {
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg());
           exit; 
       }
       $iTotal = $rsc->fields[0];
       $rsc->Close();
       return 0 < $iTotal;
   } // temRegistros

   function deletaRegistros($sWhere)
   {
       if ('' == $sWhere)
       {
           return false;
       }
       $nmgp_sel_count = 'DELETE FROM ' . $this->Ini->nm_tabela . ' WHERE ' . $sWhere;
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
       $rsc = $this->Db->Execute($nmgp_sel_count); 
       $bResult = $rsc;
       $rsc->Close();
       return $bResult == true;
   } // deletaRegistros
    function handleDbErrorMessage(&$dbErrorMessage, $dbErrorCode)
    {
        if (1267 == $dbErrorCode) {
            $dbErrorMessage = $this->Ini->Nm_lang['lang_errm_db_invalid_collation'];
        }
    }

   function restore_zeros_null()
   {
      if (!empty($this->sc_force_zero))
      {
          foreach ($this->sc_force_zero as $i_force_zero => $sc_force_zero_field)
          {
              eval('if ($this->' . $sc_force_zero_field . ' == 0) {$this->' . $sc_force_zero_field . ' = "";}');
          }
      }
      $this->sc_force_zero = array();
      if (!empty($this->NM_val_null))
      {
          foreach ($this->NM_val_null as $i_val_null => $sc_val_null_field)
          {
              eval('$this->' . $sc_val_null_field . ' = "";');
          }
      }
      $this->NM_val_null = array();
   }

   function nm_acessa_banco() 
   { 
      global  $nm_form_submit, $teste_validade, $sc_where;
 
      $this->NM_val_null = array();
      $NM_val_form = array();
      $this->sc_erro_insert = "";
      $this->sc_erro_update = "";
      $this->sc_erro_delete = "";
      $this->restore_zeros_null();
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $salva_opcao = $this->nmgp_opcao; 
      if ($this->sc_evento != "novo" && $this->sc_evento != "incluir") 
      { 
          $this->sc_evento = ""; 
      } 
      if ((!isset($this->Ini->nm_bases_access) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) && !$this->Ini->sc_tem_trans_banco && in_array($this->nmgp_opcao, array('excluir', 'incluir', 'alterar')))
      { 
          $this->Ini->sc_tem_trans_banco = $this->Db->BeginTrans(); 
      } 
      $NM_val_form['userid_int'] = $this->userid_int;
      $NM_val_form['employee_name'] = $this->employee_name;
      $NM_val_form['ic'] = $this->ic;
      $NM_val_form['designation'] = $this->designation;
      $NM_val_form['dept'] = $this->dept;
      $NM_val_form['gender'] = $this->gender;
      $NM_val_form['dob'] = $this->dob;
      $NM_val_form['address'] = $this->address;
      $NM_val_form['phone'] = $this->phone;
      $NM_val_form['hiredate'] = $this->hiredate;
      $NM_val_form['email'] = $this->email;
      $NM_val_form['field01'] = $this->field01;
      $NM_val_form['firedate'] = $this->firedate;
      $NM_val_form['hiring_duration'] = $this->hiring_duration;
      $NM_val_form['photo_name'] = $this->photo_name;
      $NM_val_form['photo_size'] = $this->photo_size;
      $NM_val_form['rate_cass'] = $this->rate_cass;
      $NM_val_form['tax_cass'] = $this->tax_cass;
      $NM_val_form['rate_cfgdct'] = $this->rate_cfgdct;
      $NM_val_form['tax_cfgdct'] = $this->tax_cfgdct;
      $NM_val_form['rate_ona'] = $this->rate_ona;
      $NM_val_form['tax_ona'] = $this->tax_ona;
      $NM_val_form['rate_fdu'] = $this->rate_fdu;
      $NM_val_form['tax_fdu'] = $this->tax_fdu;
      $NM_val_form['field02'] = $this->field02;
      $NM_val_form['rate_iris'] = $this->rate_iris;
      $NM_val_form['rate_fixed'] = $this->rate_fixed;
      $NM_val_form['revenu_net'] = $this->revenu_net;
      $NM_val_form['block_note'] = $this->block_note;
      $NM_val_form['id'] = $this->id;
      $NM_val_form['userid_varchar'] = $this->userid_varchar;
      $NM_val_form['inactif'] = $this->inactif;
      $NM_val_form['building'] = $this->building;
      $NM_val_form['section'] = $this->section;
      $NM_val_form['photo_file'] = $this->photo_file;
      $NM_val_form['imm_ona'] = $this->imm_ona;
      $NM_val_form['no_compte'] = $this->no_compte;
      $NM_val_form['type_de_compte'] = $this->type_de_compte;
      $NM_val_form['payperiod'] = $this->payperiod;
      $NM_val_form['probation_period'] = $this->probation_period;
      $NM_val_form['rate_work'] = $this->rate_work;
      $NM_val_form['rate_ot'] = $this->rate_ot;
      $NM_val_form['rate_ot_factor'] = $this->rate_ot_factor;
      $NM_val_form['rate_ot_holiday_factor'] = $this->rate_ot_holiday_factor;
      $NM_val_form['rate_ot_offday_factor'] = $this->rate_ot_offday_factor;
      $NM_val_form['rate_ot_restday_factor'] = $this->rate_ot_restday_factor;
      $NM_val_form['rate_day'] = $this->rate_day;
      $NM_val_form['rate_restday'] = $this->rate_restday;
      $NM_val_form['rate_offday'] = $this->rate_offday;
      $NM_val_form['rate_commission1'] = $this->rate_commission1;
      $NM_val_form['rate_prime1'] = $this->rate_prime1;
      $NM_val_form['rate_omission1'] = $this->rate_omission1;
      $NM_val_form['rate_assmd'] = $this->rate_assmd;
      $NM_val_form['rate_iric'] = $this->rate_iric;
      $NM_val_form['rate_cons'] = $this->rate_cons;
      $NM_val_form['day_cons'] = $this->day_cons;
      $NM_val_form['incentive'] = $this->incentive;
      $NM_val_form['incentive_desc'] = $this->incentive_desc;
      $NM_val_form['rappel'] = $this->rappel;
      $NM_val_form['other_deduct'] = $this->other_deduct;
      $NM_val_form['other_deduct_desc'] = $this->other_deduct_desc;
      $NM_val_form['loan'] = $this->loan;
      $NM_val_form['date_loan'] = $this->date_loan;
      $NM_val_form['payment'] = $this->payment;
      $NM_val_form['date_payment'] = $this->date_payment;
      $NM_val_form['payment_receipt'] = $this->payment_receipt;
      $NM_val_form['loan_deduction'] = $this->loan_deduction;
      $NM_val_form['loan_description'] = $this->loan_description;
      $NM_val_form['loan_start_deduct'] = $this->loan_start_deduct;
      $NM_val_form['loan_monthlypayment'] = $this->loan_monthlypayment;
      $NM_val_form['loan_end_deduct'] = $this->loan_end_deduct;
      $NM_val_form['apply_loan_deduction'] = $this->apply_loan_deduction;
      $NM_val_form['loan_bank'] = $this->loan_bank;
      $NM_val_form['date_loan_bank'] = $this->date_loan_bank;
      $NM_val_form['loan_deduction_bank'] = $this->loan_deduction_bank;
      $NM_val_form['loan_start_deduct_bank'] = $this->loan_start_deduct_bank;
      $NM_val_form['loan_end_deduct_bank'] = $this->loan_end_deduct_bank;
      $NM_val_form['apply_loan_deduction_bank'] = $this->apply_loan_deduction_bank;
      $NM_val_form['other_loan'] = $this->other_loan;
      $NM_val_form['date_other_loan'] = $this->date_other_loan;
      $NM_val_form['other_loan_deduction'] = $this->other_loan_deduction;
      $NM_val_form['other_loan_description'] = $this->other_loan_description;
      $NM_val_form['other_loan_start_deduct'] = $this->other_loan_start_deduct;
      $NM_val_form['other_loan_monthlypayment'] = $this->other_loan_monthlypayment;
      $NM_val_form['other_loan_end_deduct'] = $this->other_loan_end_deduct;
      $NM_val_form['apply_other_loan_deduction'] = $this->apply_other_loan_deduction;
      $NM_val_form['purchase'] = $this->purchase;
      $NM_val_form['purchase_description'] = $this->purchase_description;
      $NM_val_form['date_purchase'] = $this->date_purchase;
      $NM_val_form['purchase_deduct'] = $this->purchase_deduct;
      $NM_val_form['purchase_start_deduct'] = $this->purchase_start_deduct;
      $NM_val_form['purchase_monthlypayment'] = $this->purchase_monthlypayment;
      $NM_val_form['purchase_end_deduct'] = $this->purchase_end_deduct;
      $NM_val_form['apply_purchase_deduct'] = $this->apply_purchase_deduct;
      $NM_val_form['health_insurance'] = $this->health_insurance;
      $NM_val_form['bank_number'] = $this->bank_number;
      $NM_val_form['update_time'] = $this->update_time;
      $NM_val_form['field03'] = $this->field03;
      if ($this->id === "" || is_null($this->id))  
      { 
          $this->id = 0;
      } 
      if ($this->userid_int === "" || is_null($this->userid_int))  
      { 
          $this->userid_int = 0;
          $this->sc_force_zero[] = 'userid_int';
      } 
      if ($this->inactif === "" || is_null($this->inactif))  
      { 
          $this->inactif = 0;
          $this->sc_force_zero[] = 'inactif';
      } 
      if ($this->payperiod === "" || is_null($this->payperiod))  
      { 
          $this->payperiod = 0;
          $this->sc_force_zero[] = 'payperiod';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->probation_period === "" || is_null($this->probation_period))  
      { 
          $this->probation_period = 0;
          $this->sc_force_zero[] = 'probation_period';
      } 
      }
      if ($this->rate_work === "" || is_null($this->rate_work))  
      { 
          $this->rate_work = 0;
          $this->sc_force_zero[] = 'rate_work';
      } 
      if ($this->rate_ot === "" || is_null($this->rate_ot))  
      { 
          $this->rate_ot = 0;
          $this->sc_force_zero[] = 'rate_ot';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_ot_factor === "" || is_null($this->rate_ot_factor))  
      { 
          $this->rate_ot_factor = 0;
          $this->sc_force_zero[] = 'rate_ot_factor';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_ot_holiday_factor === "" || is_null($this->rate_ot_holiday_factor))  
      { 
          $this->rate_ot_holiday_factor = 0;
          $this->sc_force_zero[] = 'rate_ot_holiday_factor';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_ot_offday_factor === "" || is_null($this->rate_ot_offday_factor))  
      { 
          $this->rate_ot_offday_factor = 0;
          $this->sc_force_zero[] = 'rate_ot_offday_factor';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_ot_restday_factor === "" || is_null($this->rate_ot_restday_factor))  
      { 
          $this->rate_ot_restday_factor = 0;
          $this->sc_force_zero[] = 'rate_ot_restday_factor';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_day === "" || is_null($this->rate_day))  
      { 
          $this->rate_day = 0;
          $this->sc_force_zero[] = 'rate_day';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_fixed === "" || is_null($this->rate_fixed))  
      { 
          $this->rate_fixed = 0;
          $this->sc_force_zero[] = 'rate_fixed';
      } 
      }
      if ($this->rate_restday === "" || is_null($this->rate_restday))  
      { 
          $this->rate_restday = 0;
          $this->sc_force_zero[] = 'rate_restday';
      } 
      if ($this->rate_offday === "" || is_null($this->rate_offday))  
      { 
          $this->rate_offday = 0;
          $this->sc_force_zero[] = 'rate_offday';
      } 
      if ($this->rate_commission1 === "" || is_null($this->rate_commission1))  
      { 
          $this->rate_commission1 = 0;
          $this->sc_force_zero[] = 'rate_commission1';
      } 
      if ($this->rate_prime1 === "" || is_null($this->rate_prime1))  
      { 
          $this->rate_prime1 = 0;
          $this->sc_force_zero[] = 'rate_prime1';
      } 
      if ($this->rate_omission1 === "" || is_null($this->rate_omission1))  
      { 
          $this->rate_omission1 = 0;
          $this->sc_force_zero[] = 'rate_omission1';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_assmd === "" || is_null($this->rate_assmd))  
      { 
          $this->rate_assmd = 0;
          $this->sc_force_zero[] = 'rate_assmd';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_cass === "" || is_null($this->rate_cass))  
      { 
          $this->rate_cass = 0;
          $this->sc_force_zero[] = 'rate_cass';
      } 
      }
      if ($this->tax_cass === "" || is_null($this->tax_cass))  
      { 
          $this->tax_cass = 0;
          $this->sc_force_zero[] = 'tax_cass';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_cfgdct === "" || is_null($this->rate_cfgdct))  
      { 
          $this->rate_cfgdct = 0;
          $this->sc_force_zero[] = 'rate_cfgdct';
      } 
      }
      if ($this->tax_cfgdct === "" || is_null($this->tax_cfgdct))  
      { 
          $this->tax_cfgdct = 0;
          $this->sc_force_zero[] = 'tax_cfgdct';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_ona === "" || is_null($this->rate_ona))  
      { 
          $this->rate_ona = 0;
          $this->sc_force_zero[] = 'rate_ona';
      } 
      }
      if ($this->tax_ona === "" || is_null($this->tax_ona))  
      { 
          $this->tax_ona = 0;
          $this->sc_force_zero[] = 'tax_ona';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_fdu === "" || is_null($this->rate_fdu))  
      { 
          $this->rate_fdu = 0;
          $this->sc_force_zero[] = 'rate_fdu';
      } 
      }
      if ($this->tax_fdu === "" || is_null($this->tax_fdu))  
      { 
          $this->tax_fdu = 0;
          $this->sc_force_zero[] = 'tax_fdu';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_iris === "" || is_null($this->rate_iris))  
      { 
          $this->rate_iris = 0;
          $this->sc_force_zero[] = 'rate_iris';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_iric === "" || is_null($this->rate_iric))  
      { 
          $this->rate_iric = 0;
          $this->sc_force_zero[] = 'rate_iric';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rate_cons === "" || is_null($this->rate_cons))  
      { 
          $this->rate_cons = 0;
          $this->sc_force_zero[] = 'rate_cons';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->day_cons === "" || is_null($this->day_cons))  
      { 
          $this->day_cons = 0;
          $this->sc_force_zero[] = 'day_cons';
      } 
      }
      if ($this->revenu_net === "" || is_null($this->revenu_net))  
      { 
          $this->revenu_net = 0;
          $this->sc_force_zero[] = 'revenu_net';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->incentive === "" || is_null($this->incentive))  
      { 
          $this->incentive = 0;
          $this->sc_force_zero[] = 'incentive';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->rappel === "" || is_null($this->rappel))  
      { 
          $this->rappel = 0;
          $this->sc_force_zero[] = 'rappel';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->other_deduct === "" || is_null($this->other_deduct))  
      { 
          $this->other_deduct = 0;
          $this->sc_force_zero[] = 'other_deduct';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->loan === "" || is_null($this->loan))  
      { 
          $this->loan = 0;
          $this->sc_force_zero[] = 'loan';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->payment === "" || is_null($this->payment))  
      { 
          $this->payment = 0;
          $this->sc_force_zero[] = 'payment';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->loan_deduction === "" || is_null($this->loan_deduction))  
      { 
          $this->loan_deduction = 0;
          $this->sc_force_zero[] = 'loan_deduction';
      } 
      }
      if ($this->loan_monthlypayment === "" || is_null($this->loan_monthlypayment))  
      { 
          $this->loan_monthlypayment = 0;
          $this->sc_force_zero[] = 'loan_monthlypayment';
      } 
      if ($this->apply_loan_deduction === "" || is_null($this->apply_loan_deduction))  
      { 
          $this->apply_loan_deduction = 0;
          $this->sc_force_zero[] = 'apply_loan_deduction';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->loan_bank === "" || is_null($this->loan_bank))  
      { 
          $this->loan_bank = 0;
          $this->sc_force_zero[] = 'loan_bank';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->loan_deduction_bank === "" || is_null($this->loan_deduction_bank))  
      { 
          $this->loan_deduction_bank = 0;
          $this->sc_force_zero[] = 'loan_deduction_bank';
      } 
      }
      if ($this->apply_loan_deduction_bank === "" || is_null($this->apply_loan_deduction_bank))  
      { 
          $this->apply_loan_deduction_bank = 0;
          $this->sc_force_zero[] = 'apply_loan_deduction_bank';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->other_loan === "" || is_null($this->other_loan))  
      { 
          $this->other_loan = 0;
          $this->sc_force_zero[] = 'other_loan';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->other_loan_deduction === "" || is_null($this->other_loan_deduction))  
      { 
          $this->other_loan_deduction = 0;
          $this->sc_force_zero[] = 'other_loan_deduction';
      } 
      }
      if ($this->other_loan_monthlypayment === "" || is_null($this->other_loan_monthlypayment))  
      { 
          $this->other_loan_monthlypayment = 0;
          $this->sc_force_zero[] = 'other_loan_monthlypayment';
      } 
      if ($this->apply_other_loan_deduction === "" || is_null($this->apply_other_loan_deduction))  
      { 
          $this->apply_other_loan_deduction = 0;
          $this->sc_force_zero[] = 'apply_other_loan_deduction';
      } 
      if ($this->purchase === "" || is_null($this->purchase))  
      { 
          $this->purchase = 0;
          $this->sc_force_zero[] = 'purchase';
      } 
      if ($this->purchase_deduct === "" || is_null($this->purchase_deduct))  
      { 
          $this->purchase_deduct = 0;
          $this->sc_force_zero[] = 'purchase_deduct';
      } 
      if ($this->purchase_monthlypayment === "" || is_null($this->purchase_monthlypayment))  
      { 
          $this->purchase_monthlypayment = 0;
          $this->sc_force_zero[] = 'purchase_monthlypayment';
      } 
      if ($this->apply_purchase_deduct === "" || is_null($this->apply_purchase_deduct))  
      { 
          $this->apply_purchase_deduct = 0;
          $this->sc_force_zero[] = 'apply_purchase_deduct';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->health_insurance === "" || is_null($this->health_insurance))  
      { 
          $this->health_insurance = 0;
          $this->sc_force_zero[] = 'health_insurance';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->hiring_duration === "" || is_null($this->hiring_duration))  
      { 
          $this->hiring_duration = 0;
          $this->sc_force_zero[] = 'hiring_duration';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      }
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_mysql, $this->Ini->nm_bases_sqlite);
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['decimal_db'] == ",") 
      {
          $this->nm_troca_decimal(".", ",");
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          $this->userid_varchar_before_qstr = $this->userid_varchar;
          $this->userid_varchar = substr($this->Db->qstr($this->userid_varchar), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->userid_varchar = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->userid_varchar);
          }
          $this->employee_name_before_qstr = $this->employee_name;
          $this->employee_name = substr($this->Db->qstr($this->employee_name), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->employee_name = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->employee_name);
          }
          $this->ic_before_qstr = $this->ic;
          $this->ic = substr($this->Db->qstr($this->ic), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->ic = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->ic);
          }
          $this->address_before_qstr = $this->address;
          $this->address = substr($this->Db->qstr($this->address), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->address = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->address);
          }
          $this->phone_before_qstr = $this->phone;
          $this->phone = substr($this->Db->qstr($this->phone), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->phone = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->phone);
          }
          $this->email_before_qstr = $this->email;
          $this->email = substr($this->Db->qstr($this->email), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->email = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->email);
          }
          $this->gender_before_qstr = $this->gender;
          $this->gender = substr($this->Db->qstr($this->gender), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->gender = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->gender);
          }
          if ($this->dob == "")  
          { 
              $this->dob = "null"; 
              $this->NM_val_null[] = "dob";
          } 
          if ($this->hiredate == "")  
          { 
              $this->hiredate = "null"; 
              $this->NM_val_null[] = "hiredate";
          } 
          if ($this->firedate == "")  
          { 
              $this->firedate = "null"; 
              $this->NM_val_null[] = "firedate";
          } 
          $this->building_before_qstr = $this->building;
          $this->building = substr($this->Db->qstr($this->building), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->building = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->building);
          }
          $this->designation_before_qstr = $this->designation;
          $this->designation = substr($this->Db->qstr($this->designation), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->designation = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->designation);
          }
          $this->dept_before_qstr = $this->dept;
          $this->dept = substr($this->Db->qstr($this->dept), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->dept = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->dept);
          }
          $this->section_before_qstr = $this->section;
          $this->section = substr($this->Db->qstr($this->section), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->section = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->section);
          }
          $this->photo_name_before_qstr = $this->photo_name;
          $this->photo_name = substr($this->Db->qstr($this->photo_name), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->photo_name = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->photo_name);
          }
          $this->photo_size_before_qstr = $this->photo_size;
          $this->photo_size = substr($this->Db->qstr($this->photo_size), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->photo_size = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->photo_size);
          }
          $this->photo_file_before_qstr = $this->photo_file;
          $this->photo_file = substr($this->Db->qstr($this->photo_file), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->photo_file = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->photo_file);
          }
          $this->imm_ona_before_qstr = $this->imm_ona;
          $this->imm_ona = substr($this->Db->qstr($this->imm_ona), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->imm_ona = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->imm_ona);
          }
          $this->no_compte_before_qstr = $this->no_compte;
          $this->no_compte = substr($this->Db->qstr($this->no_compte), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->no_compte = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->no_compte);
          }
          $this->type_de_compte_before_qstr = $this->type_de_compte;
          $this->type_de_compte = substr($this->Db->qstr($this->type_de_compte), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->type_de_compte = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->type_de_compte);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          $this->incentive_desc_before_qstr = $this->incentive_desc;
          $this->incentive_desc = substr($this->Db->qstr($this->incentive_desc), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->incentive_desc = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->incentive_desc);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          $this->other_deduct_desc_before_qstr = $this->other_deduct_desc;
          $this->other_deduct_desc = substr($this->Db->qstr($this->other_deduct_desc), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->other_deduct_desc = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->other_deduct_desc);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->date_loan == "")  
          { 
              $this->date_loan = "null"; 
              $this->NM_val_null[] = "date_loan";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->date_payment == "")  
          { 
              $this->date_payment = "null"; 
              $this->NM_val_null[] = "date_payment";
          } 
          $this->payment_receipt_before_qstr = $this->payment_receipt;
          $this->payment_receipt = substr($this->Db->qstr($this->payment_receipt), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->payment_receipt = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->payment_receipt);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          $this->loan_description_before_qstr = $this->loan_description;
          $this->loan_description = substr($this->Db->qstr($this->loan_description), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->loan_description = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->loan_description);
          }
          if ($this->loan_start_deduct == "")  
          { 
              $this->loan_start_deduct = "null"; 
              $this->NM_val_null[] = "loan_start_deduct";
          } 
          if ($this->loan_end_deduct == "")  
          { 
              $this->loan_end_deduct = "null"; 
              $this->NM_val_null[] = "loan_end_deduct";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->date_loan_bank == "")  
          { 
              $this->date_loan_bank = "null"; 
              $this->NM_val_null[] = "date_loan_bank";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->loan_start_deduct_bank == "")  
          { 
              $this->loan_start_deduct_bank = "null"; 
              $this->NM_val_null[] = "loan_start_deduct_bank";
          } 
          if ($this->loan_end_deduct_bank == "")  
          { 
              $this->loan_end_deduct_bank = "null"; 
              $this->NM_val_null[] = "loan_end_deduct_bank";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->date_other_loan == "")  
          { 
              $this->date_other_loan = "null"; 
              $this->NM_val_null[] = "date_other_loan";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          $this->other_loan_description_before_qstr = $this->other_loan_description;
          $this->other_loan_description = substr($this->Db->qstr($this->other_loan_description), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->other_loan_description = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->other_loan_description);
          }
          if ($this->other_loan_start_deduct == "")  
          { 
              $this->other_loan_start_deduct = "null"; 
              $this->NM_val_null[] = "other_loan_start_deduct";
          } 
          if ($this->other_loan_end_deduct == "")  
          { 
              $this->other_loan_end_deduct = "null"; 
              $this->NM_val_null[] = "other_loan_end_deduct";
          } 
          $this->purchase_description_before_qstr = $this->purchase_description;
          $this->purchase_description = substr($this->Db->qstr($this->purchase_description), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->purchase_description = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->purchase_description);
          }
          if ($this->date_purchase == "")  
          { 
              $this->date_purchase = "null"; 
              $this->NM_val_null[] = "date_purchase";
          } 
          if ($this->purchase_start_deduct == "")  
          { 
              $this->purchase_start_deduct = "null"; 
              $this->NM_val_null[] = "purchase_start_deduct";
          } 
          if ($this->purchase_end_deduct == "")  
          { 
              $this->purchase_end_deduct = "null"; 
              $this->NM_val_null[] = "purchase_end_deduct";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          $this->bank_number_before_qstr = $this->bank_number;
          $this->bank_number = substr($this->Db->qstr($this->bank_number), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->bank_number = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->bank_number);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->update_time == "")  
              { 
                  $this->update_time = "null"; 
                  $this->NM_val_null[] = "update_time";
              } 
          }
          $this->block_note_before_qstr = $this->block_note;
          $this->block_note = substr($this->Db->qstr($this->block_note), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->block_note = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->block_note);
          }
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id ";
          $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id "); 
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 form_FicheEmployeeSuspended_mob_pack_ajax_response();
              }
              exit; 
          }  
          $bUpdateOk = true;
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_nfnd']); 
              $this->nmgp_opcao = "nada"; 
              $bUpdateOk = false;
              $this->sc_evento = 'update';
          } 
          $aUpdateOk = array();
          $bUpdateOk = $bUpdateOk && empty($aUpdateOk);
          if ($bUpdateOk)
          { 
              $rs1->Close(); 
              $aDoNotUpdate = array();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "userid_int = $this->userid_int, employee_name = '$this->employee_name', ic = '$this->ic', Address = '$this->address', Phone = '$this->phone', Email = '$this->email', Gender = '$this->gender', DOB = " . $this->Ini->date_delim . $this->dob . $this->Ini->date_delim1 . ", hiredate = " . $this->Ini->date_delim . $this->hiredate . $this->Ini->date_delim1 . ", firedate = " . $this->Ini->date_delim . $this->firedate . $this->Ini->date_delim1 . ", designation = '$this->designation', dept = '$this->dept', photo_size = '$this->photo_size', rate_fixed = $this->rate_fixed, rate_cass = $this->rate_cass, tax_cass = $this->tax_cass, rate_cfgdct = $this->rate_cfgdct, tax_cfgdct = $this->tax_cfgdct, rate_ona = $this->rate_ona, tax_ona = $this->tax_ona, rate_fdu = $this->rate_fdu, tax_fdu = $this->tax_fdu, rate_iris = $this->rate_iris, revenu_net = $this->revenu_net, hiring_duration = $this->hiring_duration"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "userid_int = $this->userid_int, employee_name = '$this->employee_name', ic = '$this->ic', Address = '$this->address', Phone = '$this->phone', Email = '$this->email', Gender = '$this->gender', DOB = " . $this->Ini->date_delim . $this->dob . $this->Ini->date_delim1 . ", hiredate = " . $this->Ini->date_delim . $this->hiredate . $this->Ini->date_delim1 . ", firedate = " . $this->Ini->date_delim . $this->firedate . $this->Ini->date_delim1 . ", designation = '$this->designation', dept = '$this->dept', photo_size = '$this->photo_size', rate_fixed = $this->rate_fixed, rate_cass = $this->rate_cass, tax_cass = $this->tax_cass, rate_cfgdct = $this->rate_cfgdct, tax_cfgdct = $this->tax_cfgdct, rate_ona = $this->rate_ona, tax_ona = $this->tax_ona, rate_fdu = $this->rate_fdu, tax_fdu = $this->tax_fdu, rate_iris = $this->rate_iris, revenu_net = $this->revenu_net, hiring_duration = $this->hiring_duration"; 
              } 
              if (isset($NM_val_form['userid_varchar']) && $NM_val_form['userid_varchar'] != $this->nmgp_dados_select['userid_varchar']) 
              { 
                  $SC_fields_update[] = "userid_varchar = '$this->userid_varchar'"; 
              } 
              if (isset($NM_val_form['inactif']) && $NM_val_form['inactif'] != $this->nmgp_dados_select['inactif']) 
              { 
                  $SC_fields_update[] = "inactif = $this->inactif"; 
              } 
              if (isset($NM_val_form['building']) && $NM_val_form['building'] != $this->nmgp_dados_select['building']) 
              { 
                  $SC_fields_update[] = "building = '$this->building'"; 
              } 
              if (isset($NM_val_form['section']) && $NM_val_form['section'] != $this->nmgp_dados_select['section']) 
              { 
                  $SC_fields_update[] = "section = '$this->section'"; 
              } 
              if (isset($NM_val_form['imm_ona']) && $NM_val_form['imm_ona'] != $this->nmgp_dados_select['imm_ona']) 
              { 
                  $SC_fields_update[] = "imm_ona = '$this->imm_ona'"; 
              } 
              if (isset($NM_val_form['no_compte']) && $NM_val_form['no_compte'] != $this->nmgp_dados_select['no_compte']) 
              { 
                  $SC_fields_update[] = "no_compte = '$this->no_compte'"; 
              } 
              if (isset($NM_val_form['type_de_compte']) && $NM_val_form['type_de_compte'] != $this->nmgp_dados_select['type_de_compte']) 
              { 
                  $SC_fields_update[] = "type_de_compte = '$this->type_de_compte'"; 
              } 
              if (isset($NM_val_form['payperiod']) && $NM_val_form['payperiod'] != $this->nmgp_dados_select['payperiod']) 
              { 
                  $SC_fields_update[] = "payperiod = $this->payperiod"; 
              } 
              if (isset($NM_val_form['probation_period']) && $NM_val_form['probation_period'] != $this->nmgp_dados_select['probation_period']) 
              { 
                  $SC_fields_update[] = "probation_period = $this->probation_period"; 
              } 
              if (isset($NM_val_form['rate_work']) && $NM_val_form['rate_work'] != $this->nmgp_dados_select['rate_work']) 
              { 
                  $SC_fields_update[] = "rate_work = $this->rate_work"; 
              } 
              if (isset($NM_val_form['rate_ot']) && $NM_val_form['rate_ot'] != $this->nmgp_dados_select['rate_ot']) 
              { 
                  $SC_fields_update[] = "rate_ot = $this->rate_ot"; 
              } 
              if (isset($NM_val_form['rate_ot_factor']) && $NM_val_form['rate_ot_factor'] != $this->nmgp_dados_select['rate_ot_factor']) 
              { 
                  $SC_fields_update[] = "rate_ot_factor = $this->rate_ot_factor"; 
              } 
              if (isset($NM_val_form['rate_ot_holiday_factor']) && $NM_val_form['rate_ot_holiday_factor'] != $this->nmgp_dados_select['rate_ot_holiday_factor']) 
              { 
                  $SC_fields_update[] = "rate_ot_holiday_factor = $this->rate_ot_holiday_factor"; 
              } 
              if (isset($NM_val_form['rate_ot_offday_factor']) && $NM_val_form['rate_ot_offday_factor'] != $this->nmgp_dados_select['rate_ot_offday_factor']) 
              { 
                  $SC_fields_update[] = "rate_ot_offday_factor = $this->rate_ot_offday_factor"; 
              } 
              if (isset($NM_val_form['rate_ot_restday_factor']) && $NM_val_form['rate_ot_restday_factor'] != $this->nmgp_dados_select['rate_ot_restday_factor']) 
              { 
                  $SC_fields_update[] = "rate_ot_restday_factor = $this->rate_ot_restday_factor"; 
              } 
              if (isset($NM_val_form['rate_day']) && $NM_val_form['rate_day'] != $this->nmgp_dados_select['rate_day']) 
              { 
                  $SC_fields_update[] = "rate_day = $this->rate_day"; 
              } 
              if (isset($NM_val_form['rate_restday']) && $NM_val_form['rate_restday'] != $this->nmgp_dados_select['rate_restday']) 
              { 
                  $SC_fields_update[] = "rate_restday = $this->rate_restday"; 
              } 
              if (isset($NM_val_form['rate_offday']) && $NM_val_form['rate_offday'] != $this->nmgp_dados_select['rate_offday']) 
              { 
                  $SC_fields_update[] = "rate_offday = $this->rate_offday"; 
              } 
              if (isset($NM_val_form['rate_commission1']) && $NM_val_form['rate_commission1'] != $this->nmgp_dados_select['rate_commission1']) 
              { 
                  $SC_fields_update[] = "rate_commission1 = $this->rate_commission1"; 
              } 
              if (isset($NM_val_form['rate_prime1']) && $NM_val_form['rate_prime1'] != $this->nmgp_dados_select['rate_prime1']) 
              { 
                  $SC_fields_update[] = "Rate_Prime1 = $this->rate_prime1"; 
              } 
              if (isset($NM_val_form['rate_omission1']) && $NM_val_form['rate_omission1'] != $this->nmgp_dados_select['rate_omission1']) 
              { 
                  $SC_fields_update[] = "Rate_Omission1 = $this->rate_omission1"; 
              } 
              if (isset($NM_val_form['rate_assmd']) && $NM_val_form['rate_assmd'] != $this->nmgp_dados_select['rate_assmd']) 
              { 
                  $SC_fields_update[] = "rate_assmd = $this->rate_assmd"; 
              } 
              if (isset($NM_val_form['rate_iric']) && $NM_val_form['rate_iric'] != $this->nmgp_dados_select['rate_iric']) 
              { 
                  $SC_fields_update[] = "rate_iric = $this->rate_iric"; 
              } 
              if (isset($NM_val_form['rate_cons']) && $NM_val_form['rate_cons'] != $this->nmgp_dados_select['rate_cons']) 
              { 
                  $SC_fields_update[] = "rate_cons = $this->rate_cons"; 
              } 
              if (isset($NM_val_form['day_cons']) && $NM_val_form['day_cons'] != $this->nmgp_dados_select['day_cons']) 
              { 
                  $SC_fields_update[] = "day_cons = $this->day_cons"; 
              } 
              if (isset($NM_val_form['incentive']) && $NM_val_form['incentive'] != $this->nmgp_dados_select['incentive']) 
              { 
                  $SC_fields_update[] = "incentive = $this->incentive"; 
              } 
              if (isset($NM_val_form['incentive_desc']) && $NM_val_form['incentive_desc'] != $this->nmgp_dados_select['incentive_desc']) 
              { 
                  $SC_fields_update[] = "incentive_desc = '$this->incentive_desc'"; 
              } 
              if (isset($NM_val_form['rappel']) && $NM_val_form['rappel'] != $this->nmgp_dados_select['rappel']) 
              { 
                  $SC_fields_update[] = "rappel = $this->rappel"; 
              } 
              if (isset($NM_val_form['other_deduct']) && $NM_val_form['other_deduct'] != $this->nmgp_dados_select['other_deduct']) 
              { 
                  $SC_fields_update[] = "other_deduct = $this->other_deduct"; 
              } 
              if (isset($NM_val_form['other_deduct_desc']) && $NM_val_form['other_deduct_desc'] != $this->nmgp_dados_select['other_deduct_desc']) 
              { 
                  $SC_fields_update[] = "other_deduct_desc = '$this->other_deduct_desc'"; 
              } 
              if (isset($NM_val_form['loan']) && $NM_val_form['loan'] != $this->nmgp_dados_select['loan']) 
              { 
                  $SC_fields_update[] = "loan = $this->loan"; 
              } 
              if (isset($NM_val_form['date_loan']) && $NM_val_form['date_loan'] != $this->nmgp_dados_select['date_loan']) 
              { 
                  $SC_fields_update[] = "date_loan = " . $this->Ini->date_delim . $this->date_loan . $this->Ini->date_delim1 . ""; 
              } 
              if (isset($NM_val_form['payment']) && $NM_val_form['payment'] != $this->nmgp_dados_select['payment']) 
              { 
                  $SC_fields_update[] = "payment = $this->payment"; 
              } 
              if (isset($NM_val_form['date_payment']) && $NM_val_form['date_payment'] != $this->nmgp_dados_select['date_payment']) 
              { 
                  $SC_fields_update[] = "date_payment = " . $this->Ini->date_delim . $this->date_payment . $this->Ini->date_delim1 . ""; 
              } 
              if (isset($NM_val_form['payment_receipt']) && $NM_val_form['payment_receipt'] != $this->nmgp_dados_select['payment_receipt']) 
              { 
                  $SC_fields_update[] = "payment_receipt = '$this->payment_receipt'"; 
              } 
              if (isset($NM_val_form['loan_deduction']) && $NM_val_form['loan_deduction'] != $this->nmgp_dados_select['loan_deduction']) 
              { 
                  $SC_fields_update[] = "loan_deduction = $this->loan_deduction"; 
              } 
              if (isset($NM_val_form['loan_description']) && $NM_val_form['loan_description'] != $this->nmgp_dados_select['loan_description']) 
              { 
                  $SC_fields_update[] = "loan_description = '$this->loan_description'"; 
              } 
              if (isset($NM_val_form['loan_start_deduct']) && $NM_val_form['loan_start_deduct'] != $this->nmgp_dados_select['loan_start_deduct']) 
              { 
                  $SC_fields_update[] = "loan_start_deduct = " . $this->Ini->date_delim . $this->loan_start_deduct . $this->Ini->date_delim1 . ""; 
              } 
              if (isset($NM_val_form['loan_monthlypayment']) && $NM_val_form['loan_monthlypayment'] != $this->nmgp_dados_select['loan_monthlypayment']) 
              { 
                  $SC_fields_update[] = "loan_monthlypayment = $this->loan_monthlypayment"; 
              } 
              if (isset($NM_val_form['loan_end_deduct']) && $NM_val_form['loan_end_deduct'] != $this->nmgp_dados_select['loan_end_deduct']) 
              { 
                  $SC_fields_update[] = "loan_end_deduct = " . $this->Ini->date_delim . $this->loan_end_deduct . $this->Ini->date_delim1 . ""; 
              } 
              if (isset($NM_val_form['apply_loan_deduction']) && $NM_val_form['apply_loan_deduction'] != $this->nmgp_dados_select['apply_loan_deduction']) 
              { 
                  $SC_fields_update[] = "apply_loan_deduction = $this->apply_loan_deduction"; 
              } 
              if (isset($NM_val_form['loan_bank']) && $NM_val_form['loan_bank'] != $this->nmgp_dados_select['loan_bank']) 
              { 
                  $SC_fields_update[] = "loan_bank = $this->loan_bank"; 
              } 
              if (isset($NM_val_form['date_loan_bank']) && $NM_val_form['date_loan_bank'] != $this->nmgp_dados_select['date_loan_bank']) 
              { 
                  $SC_fields_update[] = "date_loan_bank = " . $this->Ini->date_delim . $this->date_loan_bank . $this->Ini->date_delim1 . ""; 
              } 
              if (isset($NM_val_form['loan_deduction_bank']) && $NM_val_form['loan_deduction_bank'] != $this->nmgp_dados_select['loan_deduction_bank']) 
              { 
                  $SC_fields_update[] = "loan_deduction_bank = $this->loan_deduction_bank"; 
              } 
              if (isset($NM_val_form['loan_start_deduct_bank']) && $NM_val_form['loan_start_deduct_bank'] != $this->nmgp_dados_select['loan_start_deduct_bank']) 
              { 
                  $SC_fields_update[] = "loan_start_deduct_bank = " . $this->Ini->date_delim . $this->loan_start_deduct_bank . $this->Ini->date_delim1 . ""; 
              } 
              if (isset($NM_val_form['loan_end_deduct_bank']) && $NM_val_form['loan_end_deduct_bank'] != $this->nmgp_dados_select['loan_end_deduct_bank']) 
              { 
                  $SC_fields_update[] = "loan_end_deduct_bank = " . $this->Ini->date_delim . $this->loan_end_deduct_bank . $this->Ini->date_delim1 . ""; 
              } 
              if (isset($NM_val_form['apply_loan_deduction_bank']) && $NM_val_form['apply_loan_deduction_bank'] != $this->nmgp_dados_select['apply_loan_deduction_bank']) 
              { 
                  $SC_fields_update[] = "apply_loan_deduction_bank = $this->apply_loan_deduction_bank"; 
              } 
              if (isset($NM_val_form['other_loan']) && $NM_val_form['other_loan'] != $this->nmgp_dados_select['other_loan']) 
              { 
                  $SC_fields_update[] = "other_loan = $this->other_loan"; 
              } 
              if (isset($NM_val_form['date_other_loan']) && $NM_val_form['date_other_loan'] != $this->nmgp_dados_select['date_other_loan']) 
              { 
                  $SC_fields_update[] = "date_other_loan = " . $this->Ini->date_delim . $this->date_other_loan . $this->Ini->date_delim1 . ""; 
              } 
              if (isset($NM_val_form['other_loan_deduction']) && $NM_val_form['other_loan_deduction'] != $this->nmgp_dados_select['other_loan_deduction']) 
              { 
                  $SC_fields_update[] = "other_loan_deduction = $this->other_loan_deduction"; 
              } 
              if (isset($NM_val_form['other_loan_description']) && $NM_val_form['other_loan_description'] != $this->nmgp_dados_select['other_loan_description']) 
              { 
                  $SC_fields_update[] = "other_loan_description = '$this->other_loan_description'"; 
              } 
              if (isset($NM_val_form['other_loan_start_deduct']) && $NM_val_form['other_loan_start_deduct'] != $this->nmgp_dados_select['other_loan_start_deduct']) 
              { 
                  $SC_fields_update[] = "other_loan_start_deduct = " . $this->Ini->date_delim . $this->other_loan_start_deduct . $this->Ini->date_delim1 . ""; 
              } 
              if (isset($NM_val_form['other_loan_monthlypayment']) && $NM_val_form['other_loan_monthlypayment'] != $this->nmgp_dados_select['other_loan_monthlypayment']) 
              { 
                  $SC_fields_update[] = "other_loan_monthlypayment = $this->other_loan_monthlypayment"; 
              } 
              if (isset($NM_val_form['other_loan_end_deduct']) && $NM_val_form['other_loan_end_deduct'] != $this->nmgp_dados_select['other_loan_end_deduct']) 
              { 
                  $SC_fields_update[] = "other_loan_end_deduct = " . $this->Ini->date_delim . $this->other_loan_end_deduct . $this->Ini->date_delim1 . ""; 
              } 
              if (isset($NM_val_form['apply_other_loan_deduction']) && $NM_val_form['apply_other_loan_deduction'] != $this->nmgp_dados_select['apply_other_loan_deduction']) 
              { 
                  $SC_fields_update[] = "apply_other_loan_deduction = $this->apply_other_loan_deduction"; 
              } 
              if (isset($NM_val_form['purchase']) && $NM_val_form['purchase'] != $this->nmgp_dados_select['purchase']) 
              { 
                  $SC_fields_update[] = "purchase = $this->purchase"; 
              } 
              if (isset($NM_val_form['purchase_description']) && $NM_val_form['purchase_description'] != $this->nmgp_dados_select['purchase_description']) 
              { 
                  $SC_fields_update[] = "purchase_description = '$this->purchase_description'"; 
              } 
              if (isset($NM_val_form['date_purchase']) && $NM_val_form['date_purchase'] != $this->nmgp_dados_select['date_purchase']) 
              { 
                  $SC_fields_update[] = "date_purchase = " . $this->Ini->date_delim . $this->date_purchase . $this->Ini->date_delim1 . ""; 
              } 
              if (isset($NM_val_form['purchase_deduct']) && $NM_val_form['purchase_deduct'] != $this->nmgp_dados_select['purchase_deduct']) 
              { 
                  $SC_fields_update[] = "purchase_deduct = $this->purchase_deduct"; 
              } 
              if (isset($NM_val_form['purchase_start_deduct']) && $NM_val_form['purchase_start_deduct'] != $this->nmgp_dados_select['purchase_start_deduct']) 
              { 
                  $SC_fields_update[] = "purchase_start_deduct = " . $this->Ini->date_delim . $this->purchase_start_deduct . $this->Ini->date_delim1 . ""; 
              } 
              if (isset($NM_val_form['purchase_monthlypayment']) && $NM_val_form['purchase_monthlypayment'] != $this->nmgp_dados_select['purchase_monthlypayment']) 
              { 
                  $SC_fields_update[] = "purchase_monthlypayment = $this->purchase_monthlypayment"; 
              } 
              if (isset($NM_val_form['purchase_end_deduct']) && $NM_val_form['purchase_end_deduct'] != $this->nmgp_dados_select['purchase_end_deduct']) 
              { 
                  $SC_fields_update[] = "purchase_end_deduct = " . $this->Ini->date_delim . $this->purchase_end_deduct . $this->Ini->date_delim1 . ""; 
              } 
              if (isset($NM_val_form['apply_purchase_deduct']) && $NM_val_form['apply_purchase_deduct'] != $this->nmgp_dados_select['apply_purchase_deduct']) 
              { 
                  $SC_fields_update[] = "apply_purchase_deduct = $this->apply_purchase_deduct"; 
              } 
              if (isset($NM_val_form['health_insurance']) && $NM_val_form['health_insurance'] != $this->nmgp_dados_select['health_insurance']) 
              { 
                  $SC_fields_update[] = "health_insurance = $this->health_insurance"; 
              } 
              if (isset($NM_val_form['bank_number']) && $NM_val_form['bank_number'] != $this->nmgp_dados_select['bank_number']) 
              { 
                  $SC_fields_update[] = "bank_number = '$this->bank_number'"; 
              } 
              if (isset($NM_val_form['update_time']) && $NM_val_form['update_time'] != $this->nmgp_dados_select['update_time']) 
              { 
                  $SC_fields_update[] = "update_time = '$this->update_time'"; 
              } 
              $aEraseFiles  = array();
              $temp_cmd_sql = "";
              if ($this->photo_name_limpa == "S")
              {
                  $sDirErase     = $this->Ini->root . $this->Ini->path_imagens . "" . "/";
                  $aEraseFiles[] = array('dir' => $sDirErase, 'file' => $this->nmgp_dados_form['photo_name']);
            sc_api_storage_delete([
                    'profile' => 'grp__NM__PHIFA_API',
                    'file' => $this->Ini->root . $this->Ini->path_imagens . "" . '/' . $this->nmgp_dados_form['photo_name'],
                    'parents' => '/PAYROLLHTG/EMPPHOTO',
                     ]);
                     $__file_api = $_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['glo_nm_path_cache'] . '//'. basename($this->nmgp_dados_form['photo_name']);
                     if(file_exists($__file_api)){
                        unlink($__file_api);
                     }
                  if ($this->photo_name != "null")
                  {
                      $this->photo_name = '';
                  }
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                  {
                      $temp_cmd_sql = "photo_name = '" . $this->photo_name . "'";
                  }
                  else
                  {
                      $temp_cmd_sql = "photo_name = '" . $this->photo_name . "'";
                  }
                  $this->photo_name = "";
              }
              else
              {
                  if ($this->photo_name != "none" && $this->photo_name != "")
                  {
                      $NM_conteudo =  $this->photo_name;
                      if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                      {
                      $temp_cmd_sql .= " photo_name = '$NM_conteudo'";
                      }
                      else
                      {
                          $temp_cmd_sql .= " photo_name = '$NM_conteudo'";
                      }
                  }
                  else
                  {
                      $aDoNotUpdate[] = "photo_name";
                  }
              }
              if (!empty($temp_cmd_sql))
              {
                  $SC_fields_update[] = $temp_cmd_sql;
              }
              $comando .= implode(",", $SC_fields_update);  
              $comando .= " WHERE id = $this->id ";  
              $comando = str_replace("N'null'", "null", $comando) ; 
              $comando = str_replace("'null'", "null", $comando) ; 
              $comando = str_replace("#null#", "null", $comando) ; 
              $comando = str_replace($this->Ini->date_delim . "null" . $this->Ini->date_delim1, "null", $comando) ; 
              $useUpdateProcedure = false;
              if (!empty($SC_fields_update) || $useUpdateProcedure)
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
                  $rs = $this->Db->Execute($comando);  
                  if ($rs === false) 
                  { 
                      if (FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "MAIL SENT") && FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "WARNING"))
                      {
                          $dbErrorMessage = $this->Db->ErrorMsg();
                          $dbErrorCode = $this->Db->ErrorNo();
                          $this->handleDbErrorMessage($dbErrorMessage, $dbErrorCode);
                          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_updt'], $dbErrorMessage, true);
                          if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler']) 
                          { 
                              $this->sc_erro_update = $dbErrorMessage;
                              $this->NM_rollback_db(); 
                              if ($this->NM_ajax_flag)
                              {
                                  form_FicheEmployeeSuspended_mob_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->userid_varchar = $this->userid_varchar_before_qstr;
              $this->employee_name = $this->employee_name_before_qstr;
              $this->ic = $this->ic_before_qstr;
              $this->address = $this->address_before_qstr;
              $this->phone = $this->phone_before_qstr;
              $this->email = $this->email_before_qstr;
              $this->gender = $this->gender_before_qstr;
              $this->building = $this->building_before_qstr;
              $this->designation = $this->designation_before_qstr;
              $this->dept = $this->dept_before_qstr;
              $this->section = $this->section_before_qstr;
              $this->photo_name = $this->photo_name_before_qstr;
              $this->photo_size = $this->photo_size_before_qstr;
              $this->photo_file = $this->photo_file_before_qstr;
              $this->imm_ona = $this->imm_ona_before_qstr;
              $this->no_compte = $this->no_compte_before_qstr;
              $this->type_de_compte = $this->type_de_compte_before_qstr;
              $this->incentive_desc = $this->incentive_desc_before_qstr;
              $this->other_deduct_desc = $this->other_deduct_desc_before_qstr;
              $this->payment_receipt = $this->payment_receipt_before_qstr;
              $this->loan_description = $this->loan_description_before_qstr;
              $this->other_loan_description = $this->other_loan_description_before_qstr;
              $this->purchase_description = $this->purchase_description_before_qstr;
              $this->bank_number = $this->bank_number_before_qstr;
              $this->block_note = $this->block_note_before_qstr;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
              }   
              if ($this->photo_name_limpa == "S")
              {
                  $this->NM_ajax_info['fldList']['photo_name_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }
              if (!empty($aEraseFiles))
              {
                  foreach ($aEraseFiles as $aEraseData)
                  {
                      $sEraseFile = $aEraseData['dir'] . $aEraseData['file'];
                      if (@is_file($sEraseFile))
                      {
                          @unlink($sEraseFile);
                      }
                  }
              }
            if (!empty($aEraseFiles)){
                foreach ($aEraseFiles as $aEraseData){
                    sc_api_storage_delete([
                            'profile' => 'grp__NM__PHIFA_API',
                            'file' => $aEraseData['file'],
                            'parents' => '/PAYROLLHTG/EMPPHOTO',
                         ]);
                    $__file_api = $_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['glo_nm_path_cache'] . '//'. basename($aEraseData['file']);
                     if(file_exists($__file_api)){
                        unlink($__file_api);
                     }
                }
            }

        if( !empty($this->photo_name_scfile_name) ){
              $this->photo_name_scfile_name = urldecode($this->photo_name_scfile_name);
              sc_api_upload([
                    'profile' => 'grp__NM__PHIFA_API',
                    'file' => $this->Ini->root . $this->Ini->path_imagens . "" . '/' .  $this->photo_name_scfile_name,
                    'parents' => '/PAYROLLHTG/EMPPHOTO',
                     ]);
                     @mkdir($_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['glo_nm_path_cache'] . '//', 0755, true);
                     @copy($this->Ini->root . $this->Ini->path_imagens . "" . '/' .  $this->photo_name_scfile_name, $_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['glo_nm_path_cache'] . '//'.  $this->photo_name_scfile_name);

}
              $this->sc_evento = "update"; 
              $this->nmgp_opcao = "igual"; 
              $this->nm_flag_iframe = true;
              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
                  $this->NM_ajax_info['fldList']['photo_name_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }


              if     (isset($NM_val_form) && isset($NM_val_form['id'])) { $this->id = $NM_val_form['id']; }
              elseif (isset($this->id)) { $this->nm_limpa_alfa($this->id); }
              if     (isset($NM_val_form) && isset($NM_val_form['userid_int'])) { $this->userid_int = $NM_val_form['userid_int']; }
              elseif (isset($this->userid_int)) { $this->nm_limpa_alfa($this->userid_int); }
              if     (isset($NM_val_form) && isset($NM_val_form['employee_name'])) { $this->employee_name = $NM_val_form['employee_name']; }
              elseif (isset($this->employee_name)) { $this->nm_limpa_alfa($this->employee_name); }
              if     (isset($NM_val_form) && isset($NM_val_form['ic'])) { $this->ic = $NM_val_form['ic']; }
              elseif (isset($this->ic)) { $this->nm_limpa_alfa($this->ic); }
              if     (isset($NM_val_form) && isset($NM_val_form['address'])) { $this->address = $NM_val_form['address']; }
              elseif (isset($this->address)) { $this->nm_limpa_alfa($this->address); }
              if     (isset($NM_val_form) && isset($NM_val_form['phone'])) { $this->phone = $NM_val_form['phone']; }
              elseif (isset($this->phone)) { $this->nm_limpa_alfa($this->phone); }
              if     (isset($NM_val_form) && isset($NM_val_form['email'])) { $this->email = $NM_val_form['email']; }
              elseif (isset($this->email)) { $this->nm_limpa_alfa($this->email); }
              if     (isset($NM_val_form) && isset($NM_val_form['designation'])) { $this->designation = $NM_val_form['designation']; }
              elseif (isset($this->designation)) { $this->nm_limpa_alfa($this->designation); }
              if     (isset($NM_val_form) && isset($NM_val_form['dept'])) { $this->dept = $NM_val_form['dept']; }
              elseif (isset($this->dept)) { $this->nm_limpa_alfa($this->dept); }
              if     (isset($NM_val_form) && isset($NM_val_form['photo_size'])) { $this->photo_size = $NM_val_form['photo_size']; }
              elseif (isset($this->photo_size)) { $this->nm_limpa_alfa($this->photo_size); }
              if     (isset($NM_val_form) && isset($NM_val_form['rate_fixed'])) { $this->rate_fixed = $NM_val_form['rate_fixed']; }
              elseif (isset($this->rate_fixed)) { $this->nm_limpa_alfa($this->rate_fixed); }
              if     (isset($NM_val_form) && isset($NM_val_form['rate_cass'])) { $this->rate_cass = $NM_val_form['rate_cass']; }
              elseif (isset($this->rate_cass)) { $this->nm_limpa_alfa($this->rate_cass); }
              if     (isset($NM_val_form) && isset($NM_val_form['tax_cass'])) { $this->tax_cass = $NM_val_form['tax_cass']; }
              elseif (isset($this->tax_cass)) { $this->nm_limpa_alfa($this->tax_cass); }
              if     (isset($NM_val_form) && isset($NM_val_form['rate_cfgdct'])) { $this->rate_cfgdct = $NM_val_form['rate_cfgdct']; }
              elseif (isset($this->rate_cfgdct)) { $this->nm_limpa_alfa($this->rate_cfgdct); }
              if     (isset($NM_val_form) && isset($NM_val_form['tax_cfgdct'])) { $this->tax_cfgdct = $NM_val_form['tax_cfgdct']; }
              elseif (isset($this->tax_cfgdct)) { $this->nm_limpa_alfa($this->tax_cfgdct); }
              if     (isset($NM_val_form) && isset($NM_val_form['rate_ona'])) { $this->rate_ona = $NM_val_form['rate_ona']; }
              elseif (isset($this->rate_ona)) { $this->nm_limpa_alfa($this->rate_ona); }
              if     (isset($NM_val_form) && isset($NM_val_form['tax_ona'])) { $this->tax_ona = $NM_val_form['tax_ona']; }
              elseif (isset($this->tax_ona)) { $this->nm_limpa_alfa($this->tax_ona); }
              if     (isset($NM_val_form) && isset($NM_val_form['rate_fdu'])) { $this->rate_fdu = $NM_val_form['rate_fdu']; }
              elseif (isset($this->rate_fdu)) { $this->nm_limpa_alfa($this->rate_fdu); }
              if     (isset($NM_val_form) && isset($NM_val_form['tax_fdu'])) { $this->tax_fdu = $NM_val_form['tax_fdu']; }
              elseif (isset($this->tax_fdu)) { $this->nm_limpa_alfa($this->tax_fdu); }
              if     (isset($NM_val_form) && isset($NM_val_form['rate_iris'])) { $this->rate_iris = $NM_val_form['rate_iris']; }
              elseif (isset($this->rate_iris)) { $this->nm_limpa_alfa($this->rate_iris); }
              if     (isset($NM_val_form) && isset($NM_val_form['revenu_net'])) { $this->revenu_net = $NM_val_form['revenu_net']; }
              elseif (isset($this->revenu_net)) { $this->nm_limpa_alfa($this->revenu_net); }
              if     (isset($NM_val_form) && isset($NM_val_form['hiring_duration'])) { $this->hiring_duration = $NM_val_form['hiring_duration']; }
              elseif (isset($this->hiring_duration)) { $this->nm_limpa_alfa($this->hiring_duration); }
              if     (isset($NM_val_form) && isset($NM_val_form['block_note'])) { $this->block_note = $NM_val_form['block_note']; }
              elseif (isset($this->block_note)) { $this->nm_limpa_alfa($this->block_note); }

              $this->nm_formatar_campos();

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('userid_int', 'employee_name', 'ic', 'designation', 'dept', 'gender', 'dob', 'address', 'phone', 'hiredate', 'email', 'field01', 'firedate', 'hiring_duration', 'photo_name', 'photo_size', 'rate_cass', 'tax_cass', 'rate_cfgdct', 'tax_cfgdct', 'rate_ona', 'tax_ona', 'rate_fdu', 'tax_fdu', 'field02', 'rate_iris', 'rate_fixed', 'revenu_net', 'block_note'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              $this->nm_tira_formatacao();
              $this->nm_converte_datas();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { 
              $NM_seq_auto = "NULL, ";
              $NM_cmp_auto = "id, ";
          } 
          $bInsertOk = true;
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      form_FicheEmployeeSuspended_mob_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              $dir_file = $this->Ini->root . $this->Ini->path_imagens . "" . "/"; 
              $_test_file = $this->fetchUniqueUploadName($this->photo_name_scfile_name, $dir_file, "photo_name");
              if (trim($this->photo_name_scfile_name) != $_test_file)
              {
                  $this->photo_name_scfile_name = $_test_file;
                  $this->photo_name = $_test_file;
              }
              $_test_file = $this->fetchUniqueUploadName($this->photo_file_scfile_name, $dir_file, "photo_file");
              if (trim($this->photo_file_scfile_name) != $_test_file)
              {
                  $this->photo_file_scfile_name = $_test_file;
                  $this->photo_file = $_test_file;
              }
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->probation_period != "")
                  { 
                       $compl_insert     .= ", probation_period";
                       $compl_insert_val .= ", $this->probation_period";
                  } 
                  if ($this->rate_ot_factor != "")
                  { 
                       $compl_insert     .= ", rate_ot_factor";
                       $compl_insert_val .= ", $this->rate_ot_factor";
                  } 
                  if ($this->rate_ot_holiday_factor != "")
                  { 
                       $compl_insert     .= ", rate_ot_holiday_factor";
                       $compl_insert_val .= ", $this->rate_ot_holiday_factor";
                  } 
                  if ($this->rate_ot_offday_factor != "")
                  { 
                       $compl_insert     .= ", rate_ot_offday_factor";
                       $compl_insert_val .= ", $this->rate_ot_offday_factor";
                  } 
                  if ($this->rate_ot_restday_factor != "")
                  { 
                       $compl_insert     .= ", rate_ot_restday_factor";
                       $compl_insert_val .= ", $this->rate_ot_restday_factor";
                  } 
                  if ($this->rate_day != "")
                  { 
                       $compl_insert     .= ", rate_day";
                       $compl_insert_val .= ", $this->rate_day";
                  } 
                  if ($this->rate_fixed != "")
                  { 
                       $compl_insert     .= ", rate_fixed";
                       $compl_insert_val .= ", $this->rate_fixed";
                  } 
                  if ($this->rate_assmd != "")
                  { 
                       $compl_insert     .= ", rate_assmd";
                       $compl_insert_val .= ", $this->rate_assmd";
                  } 
                  if ($this->rate_cass != "")
                  { 
                       $compl_insert     .= ", rate_cass";
                       $compl_insert_val .= ", $this->rate_cass";
                  } 
                  if ($this->rate_cfgdct != "")
                  { 
                       $compl_insert     .= ", rate_cfgdct";
                       $compl_insert_val .= ", $this->rate_cfgdct";
                  } 
                  if ($this->rate_ona != "")
                  { 
                       $compl_insert     .= ", rate_ona";
                       $compl_insert_val .= ", $this->rate_ona";
                  } 
                  if ($this->rate_fdu != "")
                  { 
                       $compl_insert     .= ", rate_fdu";
                       $compl_insert_val .= ", $this->rate_fdu";
                  } 
                  if ($this->rate_iris != "")
                  { 
                       $compl_insert     .= ", rate_iris";
                       $compl_insert_val .= ", $this->rate_iris";
                  } 
                  if ($this->rate_iric != "")
                  { 
                       $compl_insert     .= ", rate_iric";
                       $compl_insert_val .= ", $this->rate_iric";
                  } 
                  if ($this->rate_cons != "")
                  { 
                       $compl_insert     .= ", rate_cons";
                       $compl_insert_val .= ", $this->rate_cons";
                  } 
                  if ($this->day_cons != "")
                  { 
                       $compl_insert     .= ", day_cons";
                       $compl_insert_val .= ", $this->day_cons";
                  } 
                  if ($this->incentive != "")
                  { 
                       $compl_insert     .= ", incentive";
                       $compl_insert_val .= ", $this->incentive";
                  } 
                  if ($this->rappel != "")
                  { 
                       $compl_insert     .= ", rappel";
                       $compl_insert_val .= ", $this->rappel";
                  } 
                  if ($this->other_deduct != "")
                  { 
                       $compl_insert     .= ", other_deduct";
                       $compl_insert_val .= ", $this->other_deduct";
                  } 
                  if ($this->loan != "")
                  { 
                       $compl_insert     .= ", loan";
                       $compl_insert_val .= ", $this->loan";
                  } 
                  if ($this->payment != "")
                  { 
                       $compl_insert     .= ", payment";
                       $compl_insert_val .= ", $this->payment";
                  } 
                  if ($this->loan_deduction != "")
                  { 
                       $compl_insert     .= ", loan_deduction";
                       $compl_insert_val .= ", $this->loan_deduction";
                  } 
                  if ($this->loan_bank != "")
                  { 
                       $compl_insert     .= ", loan_bank";
                       $compl_insert_val .= ", $this->loan_bank";
                  } 
                  if ($this->loan_deduction_bank != "")
                  { 
                       $compl_insert     .= ", loan_deduction_bank";
                       $compl_insert_val .= ", $this->loan_deduction_bank";
                  } 
                  if ($this->other_loan != "")
                  { 
                       $compl_insert     .= ", other_loan";
                       $compl_insert_val .= ", $this->other_loan";
                  } 
                  if ($this->other_loan_deduction != "")
                  { 
                       $compl_insert     .= ", other_loan_deduction";
                       $compl_insert_val .= ", $this->other_loan_deduction";
                  } 
                  if ($this->health_insurance != "")
                  { 
                       $compl_insert     .= ", health_insurance";
                       $compl_insert_val .= ", $this->health_insurance";
                  } 
                  if ($this->bank_number != "")
                  { 
                       $compl_insert     .= ", bank_number";
                       $compl_insert_val .= ", '$this->bank_number'";
                  } 
                  if ($this->update_time != "")
                  { 
                       $compl_insert     .= ", update_time";
                       $compl_insert_val .= ", '$this->update_time'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "userid_int, userid_varchar, employee_name, ic, Address, Phone, Email, Gender, DOB, hiredate, firedate, inactif, building, designation, dept, section, photo_name, photo_size, photo_file, imm_ona, no_compte, type_de_compte, payperiod, rate_work, rate_ot, rate_restday, rate_offday, rate_commission1, Rate_Prime1, Rate_Omission1, tax_cass, tax_cfgdct, tax_ona, tax_fdu, revenu_net, incentive_desc, other_deduct_desc, date_loan, date_payment, payment_receipt, loan_description, loan_start_deduct, loan_monthlypayment, loan_end_deduct, apply_loan_deduction, date_loan_bank, loan_start_deduct_bank, loan_end_deduct_bank, apply_loan_deduction_bank, date_other_loan, other_loan_description, other_loan_start_deduct, other_loan_monthlypayment, other_loan_end_deduct, apply_other_loan_deduction, purchase, purchase_description, date_purchase, purchase_deduct, purchase_start_deduct, purchase_monthlypayment, purchase_end_deduct, apply_purchase_deduct, hiring_duration $compl_insert) VALUES (" . $NM_seq_auto . "$this->userid_int, '$this->userid_varchar', '$this->employee_name', '$this->ic', '$this->address', '$this->phone', '$this->email', '$this->gender', " . $this->Ini->date_delim . $this->dob . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hiredate . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->firedate . $this->Ini->date_delim1 . ", $this->inactif, '$this->building', '$this->designation', '$this->dept', '$this->section', '$this->photo_name', '$this->photo_size', '', '$this->imm_ona', '$this->no_compte', '$this->type_de_compte', $this->payperiod, $this->rate_work, $this->rate_ot, $this->rate_restday, $this->rate_offday, $this->rate_commission1, $this->rate_prime1, $this->rate_omission1, $this->tax_cass, $this->tax_cfgdct, $this->tax_ona, $this->tax_fdu, $this->revenu_net, '$this->incentive_desc', '$this->other_deduct_desc', " . $this->Ini->date_delim . $this->date_loan . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->date_payment . $this->Ini->date_delim1 . ", '$this->payment_receipt', '$this->loan_description', " . $this->Ini->date_delim . $this->loan_start_deduct . $this->Ini->date_delim1 . ", $this->loan_monthlypayment, " . $this->Ini->date_delim . $this->loan_end_deduct . $this->Ini->date_delim1 . ", $this->apply_loan_deduction, " . $this->Ini->date_delim . $this->date_loan_bank . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->loan_start_deduct_bank . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->loan_end_deduct_bank . $this->Ini->date_delim1 . ", $this->apply_loan_deduction_bank, " . $this->Ini->date_delim . $this->date_other_loan . $this->Ini->date_delim1 . ", '$this->other_loan_description', " . $this->Ini->date_delim . $this->other_loan_start_deduct . $this->Ini->date_delim1 . ", $this->other_loan_monthlypayment, " . $this->Ini->date_delim . $this->other_loan_end_deduct . $this->Ini->date_delim1 . ", $this->apply_other_loan_deduction, $this->purchase, '$this->purchase_description', " . $this->Ini->date_delim . $this->date_purchase . $this->Ini->date_delim1 . ", $this->purchase_deduct, " . $this->Ini->date_delim . $this->purchase_start_deduct . $this->Ini->date_delim1 . ", $this->purchase_monthlypayment, " . $this->Ini->date_delim . $this->purchase_end_deduct . $this->Ini->date_delim1 . ", $this->apply_purchase_deduct, $this->hiring_duration $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->probation_period != "")
                  { 
                       $compl_insert     .= ", probation_period";
                       $compl_insert_val .= ", $this->probation_period";
                  } 
                  if ($this->rate_ot_factor != "")
                  { 
                       $compl_insert     .= ", rate_ot_factor";
                       $compl_insert_val .= ", $this->rate_ot_factor";
                  } 
                  if ($this->rate_ot_holiday_factor != "")
                  { 
                       $compl_insert     .= ", rate_ot_holiday_factor";
                       $compl_insert_val .= ", $this->rate_ot_holiday_factor";
                  } 
                  if ($this->rate_ot_offday_factor != "")
                  { 
                       $compl_insert     .= ", rate_ot_offday_factor";
                       $compl_insert_val .= ", $this->rate_ot_offday_factor";
                  } 
                  if ($this->rate_ot_restday_factor != "")
                  { 
                       $compl_insert     .= ", rate_ot_restday_factor";
                       $compl_insert_val .= ", $this->rate_ot_restday_factor";
                  } 
                  if ($this->rate_day != "")
                  { 
                       $compl_insert     .= ", rate_day";
                       $compl_insert_val .= ", $this->rate_day";
                  } 
                  if ($this->rate_fixed != "")
                  { 
                       $compl_insert     .= ", rate_fixed";
                       $compl_insert_val .= ", $this->rate_fixed";
                  } 
                  if ($this->rate_assmd != "")
                  { 
                       $compl_insert     .= ", rate_assmd";
                       $compl_insert_val .= ", $this->rate_assmd";
                  } 
                  if ($this->rate_cass != "")
                  { 
                       $compl_insert     .= ", rate_cass";
                       $compl_insert_val .= ", $this->rate_cass";
                  } 
                  if ($this->rate_cfgdct != "")
                  { 
                       $compl_insert     .= ", rate_cfgdct";
                       $compl_insert_val .= ", $this->rate_cfgdct";
                  } 
                  if ($this->rate_ona != "")
                  { 
                       $compl_insert     .= ", rate_ona";
                       $compl_insert_val .= ", $this->rate_ona";
                  } 
                  if ($this->rate_fdu != "")
                  { 
                       $compl_insert     .= ", rate_fdu";
                       $compl_insert_val .= ", $this->rate_fdu";
                  } 
                  if ($this->rate_iris != "")
                  { 
                       $compl_insert     .= ", rate_iris";
                       $compl_insert_val .= ", $this->rate_iris";
                  } 
                  if ($this->rate_iric != "")
                  { 
                       $compl_insert     .= ", rate_iric";
                       $compl_insert_val .= ", $this->rate_iric";
                  } 
                  if ($this->rate_cons != "")
                  { 
                       $compl_insert     .= ", rate_cons";
                       $compl_insert_val .= ", $this->rate_cons";
                  } 
                  if ($this->day_cons != "")
                  { 
                       $compl_insert     .= ", day_cons";
                       $compl_insert_val .= ", $this->day_cons";
                  } 
                  if ($this->incentive != "")
                  { 
                       $compl_insert     .= ", incentive";
                       $compl_insert_val .= ", $this->incentive";
                  } 
                  if ($this->rappel != "")
                  { 
                       $compl_insert     .= ", rappel";
                       $compl_insert_val .= ", $this->rappel";
                  } 
                  if ($this->other_deduct != "")
                  { 
                       $compl_insert     .= ", other_deduct";
                       $compl_insert_val .= ", $this->other_deduct";
                  } 
                  if ($this->loan != "")
                  { 
                       $compl_insert     .= ", loan";
                       $compl_insert_val .= ", $this->loan";
                  } 
                  if ($this->payment != "")
                  { 
                       $compl_insert     .= ", payment";
                       $compl_insert_val .= ", $this->payment";
                  } 
                  if ($this->loan_deduction != "")
                  { 
                       $compl_insert     .= ", loan_deduction";
                       $compl_insert_val .= ", $this->loan_deduction";
                  } 
                  if ($this->loan_bank != "")
                  { 
                       $compl_insert     .= ", loan_bank";
                       $compl_insert_val .= ", $this->loan_bank";
                  } 
                  if ($this->loan_deduction_bank != "")
                  { 
                       $compl_insert     .= ", loan_deduction_bank";
                       $compl_insert_val .= ", $this->loan_deduction_bank";
                  } 
                  if ($this->other_loan != "")
                  { 
                       $compl_insert     .= ", other_loan";
                       $compl_insert_val .= ", $this->other_loan";
                  } 
                  if ($this->other_loan_deduction != "")
                  { 
                       $compl_insert     .= ", other_loan_deduction";
                       $compl_insert_val .= ", $this->other_loan_deduction";
                  } 
                  if ($this->health_insurance != "")
                  { 
                       $compl_insert     .= ", health_insurance";
                       $compl_insert_val .= ", $this->health_insurance";
                  } 
                  if ($this->bank_number != "")
                  { 
                       $compl_insert     .= ", bank_number";
                       $compl_insert_val .= ", '$this->bank_number'";
                  } 
                  if ($this->update_time != "")
                  { 
                       $compl_insert     .= ", update_time";
                       $compl_insert_val .= ", '$this->update_time'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "userid_int, userid_varchar, employee_name, ic, Address, Phone, Email, Gender, DOB, hiredate, firedate, inactif, building, designation, dept, section, photo_name, photo_size, photo_file, imm_ona, no_compte, type_de_compte, payperiod, rate_work, rate_ot, rate_restday, rate_offday, rate_commission1, Rate_Prime1, Rate_Omission1, tax_cass, tax_cfgdct, tax_ona, tax_fdu, revenu_net, incentive_desc, other_deduct_desc, date_loan, date_payment, payment_receipt, loan_description, loan_start_deduct, loan_monthlypayment, loan_end_deduct, apply_loan_deduction, date_loan_bank, loan_start_deduct_bank, loan_end_deduct_bank, apply_loan_deduction_bank, date_other_loan, other_loan_description, other_loan_start_deduct, other_loan_monthlypayment, other_loan_end_deduct, apply_other_loan_deduction, purchase, purchase_description, date_purchase, purchase_deduct, purchase_start_deduct, purchase_monthlypayment, purchase_end_deduct, apply_purchase_deduct, hiring_duration $compl_insert) VALUES (" . $NM_seq_auto . "$this->userid_int, '$this->userid_varchar', '$this->employee_name', '$this->ic', '$this->address', '$this->phone', '$this->email', '$this->gender', " . $this->Ini->date_delim . $this->dob . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hiredate . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->firedate . $this->Ini->date_delim1 . ", $this->inactif, '$this->building', '$this->designation', '$this->dept', '$this->section', '$this->photo_name', '$this->photo_size', '', '$this->imm_ona', '$this->no_compte', '$this->type_de_compte', $this->payperiod, $this->rate_work, $this->rate_ot, $this->rate_restday, $this->rate_offday, $this->rate_commission1, $this->rate_prime1, $this->rate_omission1, $this->tax_cass, $this->tax_cfgdct, $this->tax_ona, $this->tax_fdu, $this->revenu_net, '$this->incentive_desc', '$this->other_deduct_desc', " . $this->Ini->date_delim . $this->date_loan . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->date_payment . $this->Ini->date_delim1 . ", '$this->payment_receipt', '$this->loan_description', " . $this->Ini->date_delim . $this->loan_start_deduct . $this->Ini->date_delim1 . ", $this->loan_monthlypayment, " . $this->Ini->date_delim . $this->loan_end_deduct . $this->Ini->date_delim1 . ", $this->apply_loan_deduction, " . $this->Ini->date_delim . $this->date_loan_bank . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->loan_start_deduct_bank . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->loan_end_deduct_bank . $this->Ini->date_delim1 . ", $this->apply_loan_deduction_bank, " . $this->Ini->date_delim . $this->date_other_loan . $this->Ini->date_delim1 . ", '$this->other_loan_description', " . $this->Ini->date_delim . $this->other_loan_start_deduct . $this->Ini->date_delim1 . ", $this->other_loan_monthlypayment, " . $this->Ini->date_delim . $this->other_loan_end_deduct . $this->Ini->date_delim1 . ", $this->apply_other_loan_deduction, $this->purchase, '$this->purchase_description', " . $this->Ini->date_delim . $this->date_purchase . $this->Ini->date_delim1 . ", $this->purchase_deduct, " . $this->Ini->date_delim . $this->purchase_start_deduct . $this->Ini->date_delim1 . ", $this->purchase_monthlypayment, " . $this->Ini->date_delim . $this->purchase_end_deduct . $this->Ini->date_delim1 . ", $this->apply_purchase_deduct, $this->hiring_duration $compl_insert_val)"; 
              }
              else
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->probation_period != "")
                  { 
                       $compl_insert     .= ", probation_period";
                       $compl_insert_val .= ", $this->probation_period";
                  } 
                  if ($this->rate_ot_factor != "")
                  { 
                       $compl_insert     .= ", rate_ot_factor";
                       $compl_insert_val .= ", $this->rate_ot_factor";
                  } 
                  if ($this->rate_ot_holiday_factor != "")
                  { 
                       $compl_insert     .= ", rate_ot_holiday_factor";
                       $compl_insert_val .= ", $this->rate_ot_holiday_factor";
                  } 
                  if ($this->rate_ot_offday_factor != "")
                  { 
                       $compl_insert     .= ", rate_ot_offday_factor";
                       $compl_insert_val .= ", $this->rate_ot_offday_factor";
                  } 
                  if ($this->rate_ot_restday_factor != "")
                  { 
                       $compl_insert     .= ", rate_ot_restday_factor";
                       $compl_insert_val .= ", $this->rate_ot_restday_factor";
                  } 
                  if ($this->rate_day != "")
                  { 
                       $compl_insert     .= ", rate_day";
                       $compl_insert_val .= ", $this->rate_day";
                  } 
                  if ($this->rate_fixed != "")
                  { 
                       $compl_insert     .= ", rate_fixed";
                       $compl_insert_val .= ", $this->rate_fixed";
                  } 
                  if ($this->rate_assmd != "")
                  { 
                       $compl_insert     .= ", rate_assmd";
                       $compl_insert_val .= ", $this->rate_assmd";
                  } 
                  if ($this->rate_cass != "")
                  { 
                       $compl_insert     .= ", rate_cass";
                       $compl_insert_val .= ", $this->rate_cass";
                  } 
                  if ($this->rate_cfgdct != "")
                  { 
                       $compl_insert     .= ", rate_cfgdct";
                       $compl_insert_val .= ", $this->rate_cfgdct";
                  } 
                  if ($this->rate_ona != "")
                  { 
                       $compl_insert     .= ", rate_ona";
                       $compl_insert_val .= ", $this->rate_ona";
                  } 
                  if ($this->rate_fdu != "")
                  { 
                       $compl_insert     .= ", rate_fdu";
                       $compl_insert_val .= ", $this->rate_fdu";
                  } 
                  if ($this->rate_iris != "")
                  { 
                       $compl_insert     .= ", rate_iris";
                       $compl_insert_val .= ", $this->rate_iris";
                  } 
                  if ($this->rate_iric != "")
                  { 
                       $compl_insert     .= ", rate_iric";
                       $compl_insert_val .= ", $this->rate_iric";
                  } 
                  if ($this->rate_cons != "")
                  { 
                       $compl_insert     .= ", rate_cons";
                       $compl_insert_val .= ", $this->rate_cons";
                  } 
                  if ($this->day_cons != "")
                  { 
                       $compl_insert     .= ", day_cons";
                       $compl_insert_val .= ", $this->day_cons";
                  } 
                  if ($this->incentive != "")
                  { 
                       $compl_insert     .= ", incentive";
                       $compl_insert_val .= ", $this->incentive";
                  } 
                  if ($this->rappel != "")
                  { 
                       $compl_insert     .= ", rappel";
                       $compl_insert_val .= ", $this->rappel";
                  } 
                  if ($this->other_deduct != "")
                  { 
                       $compl_insert     .= ", other_deduct";
                       $compl_insert_val .= ", $this->other_deduct";
                  } 
                  if ($this->loan != "")
                  { 
                       $compl_insert     .= ", loan";
                       $compl_insert_val .= ", $this->loan";
                  } 
                  if ($this->payment != "")
                  { 
                       $compl_insert     .= ", payment";
                       $compl_insert_val .= ", $this->payment";
                  } 
                  if ($this->loan_deduction != "")
                  { 
                       $compl_insert     .= ", loan_deduction";
                       $compl_insert_val .= ", $this->loan_deduction";
                  } 
                  if ($this->loan_bank != "")
                  { 
                       $compl_insert     .= ", loan_bank";
                       $compl_insert_val .= ", $this->loan_bank";
                  } 
                  if ($this->loan_deduction_bank != "")
                  { 
                       $compl_insert     .= ", loan_deduction_bank";
                       $compl_insert_val .= ", $this->loan_deduction_bank";
                  } 
                  if ($this->other_loan != "")
                  { 
                       $compl_insert     .= ", other_loan";
                       $compl_insert_val .= ", $this->other_loan";
                  } 
                  if ($this->other_loan_deduction != "")
                  { 
                       $compl_insert     .= ", other_loan_deduction";
                       $compl_insert_val .= ", $this->other_loan_deduction";
                  } 
                  if ($this->health_insurance != "")
                  { 
                       $compl_insert     .= ", health_insurance";
                       $compl_insert_val .= ", $this->health_insurance";
                  } 
                  if ($this->bank_number != "")
                  { 
                       $compl_insert     .= ", bank_number";
                       $compl_insert_val .= ", '$this->bank_number'";
                  } 
                  if ($this->update_time != "")
                  { 
                       $compl_insert     .= ", update_time";
                       $compl_insert_val .= ", '$this->update_time'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "userid_int, userid_varchar, employee_name, ic, Address, Phone, Email, Gender, DOB, hiredate, firedate, inactif, building, designation, dept, section, photo_name, photo_size, photo_file, imm_ona, no_compte, type_de_compte, payperiod, rate_work, rate_ot, rate_restday, rate_offday, rate_commission1, Rate_Prime1, Rate_Omission1, tax_cass, tax_cfgdct, tax_ona, tax_fdu, revenu_net, incentive_desc, other_deduct_desc, date_loan, date_payment, payment_receipt, loan_description, loan_start_deduct, loan_monthlypayment, loan_end_deduct, apply_loan_deduction, date_loan_bank, loan_start_deduct_bank, loan_end_deduct_bank, apply_loan_deduction_bank, date_other_loan, other_loan_description, other_loan_start_deduct, other_loan_monthlypayment, other_loan_end_deduct, apply_other_loan_deduction, purchase, purchase_description, date_purchase, purchase_deduct, purchase_start_deduct, purchase_monthlypayment, purchase_end_deduct, apply_purchase_deduct, hiring_duration $compl_insert) VALUES (" . $NM_seq_auto . "$this->userid_int, '$this->userid_varchar', '$this->employee_name', '$this->ic', '$this->address', '$this->phone', '$this->email', '$this->gender', " . $this->Ini->date_delim . $this->dob . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hiredate . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->firedate . $this->Ini->date_delim1 . ", $this->inactif, '$this->building', '$this->designation', '$this->dept', '$this->section', '$this->photo_name', '$this->photo_size', '$this->photo_file', '$this->imm_ona', '$this->no_compte', '$this->type_de_compte', $this->payperiod, $this->rate_work, $this->rate_ot, $this->rate_restday, $this->rate_offday, $this->rate_commission1, $this->rate_prime1, $this->rate_omission1, $this->tax_cass, $this->tax_cfgdct, $this->tax_ona, $this->tax_fdu, $this->revenu_net, '$this->incentive_desc', '$this->other_deduct_desc', " . $this->Ini->date_delim . $this->date_loan . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->date_payment . $this->Ini->date_delim1 . ", '$this->payment_receipt', '$this->loan_description', " . $this->Ini->date_delim . $this->loan_start_deduct . $this->Ini->date_delim1 . ", $this->loan_monthlypayment, " . $this->Ini->date_delim . $this->loan_end_deduct . $this->Ini->date_delim1 . ", $this->apply_loan_deduction, " . $this->Ini->date_delim . $this->date_loan_bank . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->loan_start_deduct_bank . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->loan_end_deduct_bank . $this->Ini->date_delim1 . ", $this->apply_loan_deduction_bank, " . $this->Ini->date_delim . $this->date_other_loan . $this->Ini->date_delim1 . ", '$this->other_loan_description', " . $this->Ini->date_delim . $this->other_loan_start_deduct . $this->Ini->date_delim1 . ", $this->other_loan_monthlypayment, " . $this->Ini->date_delim . $this->other_loan_end_deduct . $this->Ini->date_delim1 . ", $this->apply_other_loan_deduction, $this->purchase, '$this->purchase_description', " . $this->Ini->date_delim . $this->date_purchase . $this->Ini->date_delim1 . ", $this->purchase_deduct, " . $this->Ini->date_delim . $this->purchase_start_deduct . $this->Ini->date_delim1 . ", $this->purchase_monthlypayment, " . $this->Ini->date_delim . $this->purchase_end_deduct . $this->Ini->date_delim1 . ", $this->apply_purchase_deduct, $this->hiring_duration $compl_insert_val)"; 
              }
              $comando = str_replace("N'null'", "null", $comando) ; 
              $comando = str_replace("'null'", "null", $comando) ; 
              $comando = str_replace("#null#", "null", $comando) ; 
              $comando = str_replace($this->Ini->date_delim . "null" . $this->Ini->date_delim1, "null", $comando) ; 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
              $rs = $this->Db->Execute($comando); 
              if ($rs === false)  
              { 
                  if (FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "MAIL SENT") && FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "WARNING"))
                  {
                      $dbErrorMessage = $this->Db->ErrorMsg();
                      $dbErrorCode = $this->Db->ErrorNo();
                      $this->handleDbErrorMessage($dbErrorMessage, $dbErrorCode);
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $dbErrorMessage, true);
                      if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
                      { 
                          $this->sc_erro_insert = $dbErrorMessage;
                          $this->nmgp_opcao     = 'refresh_insert';
                          $this->NM_rollback_db(); 
                          if ($this->NM_ajax_flag)
                          {
                              form_FicheEmployeeSuspended_mob_pack_ajax_response();
                              exit; 
                          }
                      }  
                  }  
              }  
              if ('refresh_insert' != $this->nmgp_opcao)
              {
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  {
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select last_insert_id()"; 
                  }
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select last_insert_rowid()"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              $this->userid_varchar = $this->userid_varchar_before_qstr;
              $this->employee_name = $this->employee_name_before_qstr;
              $this->ic = $this->ic_before_qstr;
              $this->address = $this->address_before_qstr;
              $this->phone = $this->phone_before_qstr;
              $this->email = $this->email_before_qstr;
              $this->gender = $this->gender_before_qstr;
              $this->building = $this->building_before_qstr;
              $this->designation = $this->designation_before_qstr;
              $this->dept = $this->dept_before_qstr;
              $this->section = $this->section_before_qstr;
              $this->photo_name = $this->photo_name_before_qstr;
              $this->photo_size = $this->photo_size_before_qstr;
              $this->photo_file = $this->photo_file_before_qstr;
              $this->imm_ona = $this->imm_ona_before_qstr;
              $this->no_compte = $this->no_compte_before_qstr;
              $this->type_de_compte = $this->type_de_compte_before_qstr;
              $this->incentive_desc = $this->incentive_desc_before_qstr;
              $this->other_deduct_desc = $this->other_deduct_desc_before_qstr;
              $this->payment_receipt = $this->payment_receipt_before_qstr;
              $this->loan_description = $this->loan_description_before_qstr;
              $this->other_loan_description = $this->other_loan_description_before_qstr;
              $this->purchase_description = $this->purchase_description_before_qstr;
              $this->bank_number = $this->bank_number_before_qstr;
              $this->block_note = $this->block_note_before_qstr;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
                  if (trim($this->photo_file ) != "") 
                  { 
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ",  photo_file , $this->photo_file,  \"id = $this->id\")"; 
                      $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "photo_file", $this->photo_file,  "id = $this->id"); 
                      if ($rs === false)  
                      { 
                          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
                          $this->NM_rollback_db(); 
                          if ($this->NM_ajax_flag)
                          {
                              form_FicheEmployeeSuspended_mob_pack_ajax_response();
                          }
                          exit; 
                      }  
                  }  
              }  
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['total']);
              }

              $dir_img = $this->Ini->root . $this->Ini->path_imagens . "" . "/"; 
              $reg_photo_name = ""; 
              if (is_file($this->SC_IMG_photo_name)) { 
                  $arq_photo_name = fopen($this->SC_IMG_photo_name, "r") ; 
                  $reg_photo_name = fread($arq_photo_name, filesize($this->SC_IMG_photo_name)) ; 
                  fclose($arq_photo_name) ;  
                  $arq_photo_name = fopen($dir_img . trim($this->photo_name_scfile_name), "w") ; 
                  fwrite($arq_photo_name, $reg_photo_name) ;  
                  fclose($arq_photo_name) ;  
              }
        if( !empty($this->photo_name_scfile_name) ){
            $this->photo_name_scfile_name = urldecode($this->photo_name_scfile_name);
            sc_api_upload([
                    'profile' => 'grp__NM__PHIFA_API',
                    'file' => $this->Ini->root . $this->Ini->path_imagens . "" . '/' . $this->photo_name_scfile_name,
                    'parents' => '/PAYROLLHTG/EMPPHOTO',
                     ]);
                     @mkdir($_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['glo_nm_path_cache'] . '//', 0755, true);
                     @copy($this->Ini->root . $this->Ini->path_imagens . "" . '/' .  $this->photo_name_scfile_name, $_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['glo_nm_path_cache'] . '//'.  $this->photo_name_scfile_name);
}
              $this->sc_evento = "insert"; 
              $this->userid_varchar = $this->userid_varchar_before_qstr;
              $this->employee_name = $this->employee_name_before_qstr;
              $this->ic = $this->ic_before_qstr;
              $this->address = $this->address_before_qstr;
              $this->phone = $this->phone_before_qstr;
              $this->email = $this->email_before_qstr;
              $this->gender = $this->gender_before_qstr;
              $this->building = $this->building_before_qstr;
              $this->designation = $this->designation_before_qstr;
              $this->dept = $this->dept_before_qstr;
              $this->section = $this->section_before_qstr;
              $this->photo_name = $this->photo_name_before_qstr;
              $this->photo_size = $this->photo_size_before_qstr;
              $this->photo_file = $this->photo_file_before_qstr;
              $this->imm_ona = $this->imm_ona_before_qstr;
              $this->no_compte = $this->no_compte_before_qstr;
              $this->type_de_compte = $this->type_de_compte_before_qstr;
              $this->incentive_desc = $this->incentive_desc_before_qstr;
              $this->other_deduct_desc = $this->other_deduct_desc_before_qstr;
              $this->payment_receipt = $this->payment_receipt_before_qstr;
              $this->loan_description = $this->loan_description_before_qstr;
              $this->other_loan_description = $this->other_loan_description_before_qstr;
              $this->purchase_description = $this->purchase_description_before_qstr;
              $this->bank_number = $this->bank_number_before_qstr;
              $this->block_note = $this->block_note_before_qstr;
              $this->sc_insert_on = true; 
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao   = "igual"; 
              $this->nmgp_opc_ant = "igual"; 
              $this->nmgp_botoes['sc_btn_0'] = "on";
              $this->nmgp_botoes['sc_btn_1'] = "on";
              $this->nmgp_botoes['Historic_Salary'] = "on";
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['decimal_db'] == ",") 
      {
          $this->nm_tira_aspas_decimal();
      }
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->id = substr($this->Db->qstr($this->id), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';
          if ($bDelecaoOk)
          {
              $sDetailWhere = "userid_int = " . $this->userid_int . "";
              $this->form_tbl_note_employee_mob->ini_controle();
              if ($this->form_tbl_note_employee_mob->temRegistros($sDetailWhere))
              {
                  $bDelecaoOk = false;
                  $sMsgErro   = $this->Ini->Nm_lang['lang_errm_fkvi'];
              }
          }

          if ($bDelecaoOk)
          {

          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id"; 
          $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id = $this->id "); 
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          $aEraseFiles = array();
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_dele_nfnd']); 
              $this->nmgp_opcao = "nada"; 
              $this->sc_evento = 'delete';
          } 
          else 
          { 
              $rs1->Close(); 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id = $this->id "; 
              $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id = $this->id "); 
              if ($rs === false) 
              { 
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dele'], $this->Db->ErrorMsg(), true); 
                  if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler']) 
                  { 
                      $this->sc_erro_delete = $this->Db->ErrorMsg();  
                      $this->NM_rollback_db(); 
                      if ($this->NM_ajax_flag)
                      {
                          form_FicheEmployeeSuspended_mob_pack_ajax_response();
                          exit; 
                      }
                  } 
              } 
        if( !empty($this->nmgp_dados_form['photo_name']) ){
            sc_api_storage_delete([
                    'profile' => 'grp__NM__PHIFA_API',
                    'file' => $this->Ini->root . $this->Ini->path_imagens . "" . '/' . $this->nmgp_dados_form['photo_name'],
                    'parents' => '/PAYROLLHTG/EMPPHOTO',
                     ]);

             $__file_api = $_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['glo_nm_path_cache'] . '//'. basename($this->nmgp_dados_form['photo_name']);
             if(file_exists($__file_api)){
                unlink($__file_api);
             }

        }
                  $sDirErase     = $this->Ini->root . $this->Ini->path_imagens . "" . "/"; 
                  $aEraseFiles[] = array('dir' => $sDirErase, 'file' => $this->nmgp_dados_form['photo_name']);
              if (!empty($aEraseFiles))
              {
                  foreach ($aEraseFiles as $aEraseData)
                  {
                      $sEraseFile = $aEraseData['dir'] . $aEraseData['file'];
                      if (@is_file($sEraseFile))
                      {
                          @unlink($sEraseFile);
                      }
                  }
              }
if(!empty($this->nmgp_dados_form['photo_name'])){
            sc_api_storage_delete([
                    'profile' => 'grp__NM__PHIFA_API',
                    'file' => $this->nmgp_dados_form['photo_name'],
                    'parents' => '/PAYROLLHTG/EMPPHOTO',
                     ]);

                     $__file_api = $_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['glo_nm_path_cache'] . '//'. basename($this->nmgp_dados_form['photo_name']);
                     if(file_exists($__file_api)){
                        unlink($__file_api);
                     }
                     }
              $this->sc_evento = "delete"; 
              if (empty($this->sc_erro_delete)) {
                  $this->record_delete_ok = true;
              }
              $this->nmgp_opcao = "avanca"; 
              $this->nm_flag_iframe = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['total']);
              }

              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }
          }

          }
          else
          {
              $this->sc_evento = "delete"; 
              $this->nmgp_opcao = "igual"; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $sMsgErro); 
          }

      }  
      $this->restore_zeros_null();
if ("delete" == $this->sc_evento && $this->nmgp_opcao != "nada"){

if(!empty($this->nmgp_dados_form['photo_name'])){
            sc_api_storage_delete([
                    'profile' => 'grp__NM__PHIFA_API',
                    'file' => $this->nmgp_dados_form['photo_name'],
                    'parents' => '/PAYROLLHTG/EMPPHOTO',
                     ]);

             $__file_api = $_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['glo_nm_path_cache'] . '//'. basename($this->nmgp_dados_form['photo_name']);
             if(file_exists($__file_api)){
                unlink($__file_api);
             }
         }
    }      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['parms'] = "id?#?$this->id?@?"; 
      }
      $this->nmgp_dados_form['photo_name'] = ""; 
      $this->photo_name_limpa = ""; 
      $this->photo_name_salva = ""; 
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->id = null === $this->id ? null : substr($this->Db->qstr($this->id), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_filter'] . ")";
          }
      }
//------------ 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe'] == "R")
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['iframe_evento']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['iframe_evento'] == "insert") 
          { 
               $this->nmgp_opcao = "novo"; 
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['select'] = "";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['iframe_evento'] = $this->sc_evento; 
      } 
      if (!isset($this->nmgp_opcao) || empty($this->nmgp_opcao)) 
      { 
          if (empty($this->id)) 
          { 
              $this->nmgp_opcao = "inicio"; 
          } 
          else 
          { 
              $this->nmgp_opcao = "igual"; 
          } 
      } 
      if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav']) 
      { 
          $this->nmgp_opcao = "inicio";
      } 
      if ($this->nmgp_opcao != "nada" && (trim($this->id) == "")) 
      { 
          if ($this->nmgp_opcao == "avanca")  
          { 
              $this->nmgp_opcao = "final"; 
          } 
          elseif ($this->nmgp_opcao != "novo")
          { 
              $this->nmgp_opcao = "inicio"; 
          } 
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe'] == "F" && $this->sc_evento == "insert")
      {
          $this->nmgp_opcao = "final";
      }
      $sc_where = trim("");
      if (substr(strtolower($sc_where), 0, 5) == "where")
      {
          $sc_where  = substr($sc_where , 5);
      }
      if (!empty($sc_where))
      {
          $sc_where = " where " . $sc_where . " ";
      }
      if ('' != $sc_where_filter)
      {
          $sc_where = ('' != $sc_where) ? $sc_where . ' and (' . $sc_where_filter . ')' : ' where ' . $sc_where_filter;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['total']))
      { 
          $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
          $rt = $this->Db->Execute($nmgp_select) ; 
          if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          $qt_geral_reg_form_FicheEmployeeSuspended_mob = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['total'] = $qt_geral_reg_form_FicheEmployeeSuspended_mob;
          $rt->Close(); 
          if ($this->nmgp_opcao == "igual" && isset($this->NM_btn_navega) && 'S' == $this->NM_btn_navega && !empty($this->id))
          {
              $Key_Where = "id < $this->id "; 
              $Where_Start = (empty($sc_where)) ? " where " . $Key_Where :  $sc_where . " and (" . $Key_Where . ")";
              $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $Where_Start; 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rt = $this->Db->Execute($nmgp_select) ; 
              if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
              { 
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
                  exit ; 
              }  
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start'] = $rt->fields[0];
              $rt->Close(); 
          }
      } 
      else 
      { 
          $qt_geral_reg_form_FicheEmployeeSuspended_mob = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['total'];
      } 
      if ($this->nmgp_opcao == "inicio") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start'] = 0; 
      } 
      if ($this->nmgp_opcao == "avanca")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start']++; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start'] > $qt_geral_reg_form_FicheEmployeeSuspended_mob)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start'] = $qt_geral_reg_form_FicheEmployeeSuspended_mob; 
          }
      } 
      if ($this->nmgp_opcao == "retorna") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start']--; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start'] = 0; 
          }
      } 
      if ($this->nmgp_opcao == "final") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start'] = $qt_geral_reg_form_FicheEmployeeSuspended_mob; 
      } 
      if ($this->nmgp_opcao == "navpage" && ($this->nmgp_ordem - 1) <= $qt_geral_reg_form_FicheEmployeeSuspended_mob) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start'] = $this->nmgp_ordem - 1; 
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start'] = 0;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start'] + 1;
      $this->NM_ajax_info['navSummary']['reg_ini'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start'] + 1; 
      $this->NM_ajax_info['navSummary']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_qtd']; 
      $this->NM_ajax_info['navSummary']['reg_tot'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['total'] + 1; 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
//---------- 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "refresh_insert") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['parms'] = ""; 
          $nmgp_select = "SELECT id, userid_int, userid_varchar, employee_name, ic, Address, Phone, Email, Gender, DOB, hiredate, firedate, inactif, building, designation, dept, section, photo_name, photo_size, photo_file, imm_ona, no_compte, type_de_compte, payperiod, probation_period, rate_work, rate_ot, rate_ot_factor, rate_ot_holiday_factor, rate_ot_offday_factor, rate_ot_restday_factor, rate_day, rate_fixed, rate_restday, rate_offday, rate_commission1, Rate_Prime1, Rate_Omission1, rate_assmd, rate_cass, tax_cass, rate_cfgdct, tax_cfgdct, rate_ona, tax_ona, rate_fdu, tax_fdu, rate_iris, rate_iric, rate_cons, day_cons, revenu_net, incentive, incentive_desc, rappel, other_deduct, other_deduct_desc, loan, date_loan, payment, date_payment, payment_receipt, loan_deduction, loan_description, loan_start_deduct, loan_monthlypayment, loan_end_deduct, apply_loan_deduction, loan_bank, date_loan_bank, loan_deduction_bank, loan_start_deduct_bank, loan_end_deduct_bank, apply_loan_deduction_bank, other_loan, date_other_loan, other_loan_deduction, other_loan_description, other_loan_start_deduct, other_loan_monthlypayment, other_loan_end_deduct, apply_other_loan_deduction, purchase, purchase_description, date_purchase, purchase_deduct, purchase_start_deduct, purchase_monthlypayment, purchase_end_deduct, apply_purchase_deduct, health_insurance, bank_number, hiring_duration, update_time from " . $this->Ini->nm_tabela ; 
          $aWhere = array();
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              $aWhere[] = "id = $this->id"; 
              if (!empty($sc_where_filter))  
              {
                  $teste_select = $nmgp_select . $this->returnWhere($aWhere);
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = $teste_select; 
                  $rs = $this->Db->Execute($teste_select); 
                  if ($rs->EOF)
                  {
                     $aWhere = array($sc_where_filter);
                  }  
                  $rs->Close(); 
              }  
          } 
          $nmgp_select .= $this->returnWhere($aWhere) . ' ';
          $sc_order_by = "";
          $sc_order_by = "id";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['select'] = ""; 
              } 
          } 
          if ($this->nmgp_opcao == "igual") 
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start']) ; 
          } 
          else  
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
              if (!$rs === false && !$rs->EOF) 
              { 
                  $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start']) ;  
              } 
          } 
          if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_nfnd_extr'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($rs->EOF) 
          { 
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['sc_btn_0'] = $this->nmgp_botoes['sc_btn_0'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['sc_btn_1'] = $this->nmgp_botoes['sc_btn_1'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['Historic_Salary'] = $this->nmgp_botoes['Historic_Salary'] = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['empty_filter'] = true;
                  return; 
              }
              if ($this->nmgp_botoes['insert'] != "on")
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
              }
              $this->NM_ajax_info['buttonDisplay']['update'] = $this->nmgp_botoes['update'] = "off";
              $this->NM_ajax_info['buttonDisplay']['delete'] = $this->nmgp_botoes['delete'] = "off";
              return; 
          } 
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_nfnd_extr'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($this->nmgp_opcao != "novo") 
          { 
              $this->id = $rs->fields[0] ; 
              $this->nmgp_dados_select['id'] = $this->id;
              $this->userid_int = $rs->fields[1] ; 
              $this->nmgp_dados_select['userid_int'] = $this->userid_int;
              $this->userid_varchar = $rs->fields[2] ; 
              $this->nmgp_dados_select['userid_varchar'] = $this->userid_varchar;
              $this->employee_name = $rs->fields[3] ; 
              $this->nmgp_dados_select['employee_name'] = $this->employee_name;
              $this->ic = $rs->fields[4] ; 
              $this->nmgp_dados_select['ic'] = $this->ic;
              $this->address = $rs->fields[5] ; 
              $this->nmgp_dados_select['address'] = $this->address;
              $this->phone = $rs->fields[6] ; 
              $this->nmgp_dados_select['phone'] = $this->phone;
              $this->email = $rs->fields[7] ; 
              $this->nmgp_dados_select['email'] = $this->email;
              $this->gender = $rs->fields[8] ; 
              $this->nmgp_dados_select['gender'] = $this->gender;
              $this->dob = $rs->fields[9] ; 
              $this->nmgp_dados_select['dob'] = $this->dob;
              $this->hiredate = $rs->fields[10] ; 
              $this->nmgp_dados_select['hiredate'] = $this->hiredate;
              $this->firedate = $rs->fields[11] ; 
              $this->nmgp_dados_select['firedate'] = $this->firedate;
              $this->inactif = $rs->fields[12] ; 
              $this->nmgp_dados_select['inactif'] = $this->inactif;
              $this->building = $rs->fields[13] ; 
              $this->nmgp_dados_select['building'] = $this->building;
              $this->designation = $rs->fields[14] ; 
              $this->nmgp_dados_select['designation'] = $this->designation;
              $this->dept = $rs->fields[15] ; 
              $this->nmgp_dados_select['dept'] = $this->dept;
              $this->section = $rs->fields[16] ; 
              $this->nmgp_dados_select['section'] = $this->section;
              $this->photo_name = $rs->fields[17] ; 
              $this->nmgp_dados_select['photo_name'] = $this->photo_name;
              $this->photo_size = $rs->fields[18] ; 
              $this->nmgp_dados_select['photo_size'] = $this->photo_size;
              $this->photo_file = $rs->fields[19] ; 
              $this->nmgp_dados_select['photo_file'] = $this->photo_file;
              $this->imm_ona = $rs->fields[20] ; 
              $this->nmgp_dados_select['imm_ona'] = $this->imm_ona;
              $this->no_compte = $rs->fields[21] ; 
              $this->nmgp_dados_select['no_compte'] = $this->no_compte;
              $this->type_de_compte = $rs->fields[22] ; 
              $this->nmgp_dados_select['type_de_compte'] = $this->type_de_compte;
              $this->payperiod = $rs->fields[23] ; 
              $this->nmgp_dados_select['payperiod'] = $this->payperiod;
              $this->probation_period = $rs->fields[24] ; 
              $this->nmgp_dados_select['probation_period'] = $this->probation_period;
              $this->rate_work = $rs->fields[25] ; 
              $this->nmgp_dados_select['rate_work'] = $this->rate_work;
              $this->rate_ot = $rs->fields[26] ; 
              $this->nmgp_dados_select['rate_ot'] = $this->rate_ot;
              $this->rate_ot_factor = $rs->fields[27] ; 
              $this->nmgp_dados_select['rate_ot_factor'] = $this->rate_ot_factor;
              $this->rate_ot_holiday_factor = $rs->fields[28] ; 
              $this->nmgp_dados_select['rate_ot_holiday_factor'] = $this->rate_ot_holiday_factor;
              $this->rate_ot_offday_factor = $rs->fields[29] ; 
              $this->nmgp_dados_select['rate_ot_offday_factor'] = $this->rate_ot_offday_factor;
              $this->rate_ot_restday_factor = $rs->fields[30] ; 
              $this->nmgp_dados_select['rate_ot_restday_factor'] = $this->rate_ot_restday_factor;
              $this->rate_day = $rs->fields[31] ; 
              $this->nmgp_dados_select['rate_day'] = $this->rate_day;
              $this->rate_fixed = $rs->fields[32] ; 
              $this->nmgp_dados_select['rate_fixed'] = $this->rate_fixed;
              $this->rate_restday = $rs->fields[33] ; 
              $this->nmgp_dados_select['rate_restday'] = $this->rate_restday;
              $this->rate_offday = $rs->fields[34] ; 
              $this->nmgp_dados_select['rate_offday'] = $this->rate_offday;
              $this->rate_commission1 = $rs->fields[35] ; 
              $this->nmgp_dados_select['rate_commission1'] = $this->rate_commission1;
              $this->rate_prime1 = $rs->fields[36] ; 
              $this->nmgp_dados_select['rate_prime1'] = $this->rate_prime1;
              $this->rate_omission1 = $rs->fields[37] ; 
              $this->nmgp_dados_select['rate_omission1'] = $this->rate_omission1;
              $this->rate_assmd = $rs->fields[38] ; 
              $this->nmgp_dados_select['rate_assmd'] = $this->rate_assmd;
              $this->rate_cass = $rs->fields[39] ; 
              $this->nmgp_dados_select['rate_cass'] = $this->rate_cass;
              $this->tax_cass = $rs->fields[40] ; 
              $this->nmgp_dados_select['tax_cass'] = $this->tax_cass;
              $this->rate_cfgdct = $rs->fields[41] ; 
              $this->nmgp_dados_select['rate_cfgdct'] = $this->rate_cfgdct;
              $this->tax_cfgdct = $rs->fields[42] ; 
              $this->nmgp_dados_select['tax_cfgdct'] = $this->tax_cfgdct;
              $this->rate_ona = $rs->fields[43] ; 
              $this->nmgp_dados_select['rate_ona'] = $this->rate_ona;
              $this->tax_ona = $rs->fields[44] ; 
              $this->nmgp_dados_select['tax_ona'] = $this->tax_ona;
              $this->rate_fdu = $rs->fields[45] ; 
              $this->nmgp_dados_select['rate_fdu'] = $this->rate_fdu;
              $this->tax_fdu = $rs->fields[46] ; 
              $this->nmgp_dados_select['tax_fdu'] = $this->tax_fdu;
              $this->rate_iris = $rs->fields[47] ; 
              $this->nmgp_dados_select['rate_iris'] = $this->rate_iris;
              $this->rate_iric = $rs->fields[48] ; 
              $this->nmgp_dados_select['rate_iric'] = $this->rate_iric;
              $this->rate_cons = $rs->fields[49] ; 
              $this->nmgp_dados_select['rate_cons'] = $this->rate_cons;
              $this->day_cons = $rs->fields[50] ; 
              $this->nmgp_dados_select['day_cons'] = $this->day_cons;
              $this->revenu_net = $rs->fields[51] ; 
              $this->nmgp_dados_select['revenu_net'] = $this->revenu_net;
              $this->incentive = $rs->fields[52] ; 
              $this->nmgp_dados_select['incentive'] = $this->incentive;
              $this->incentive_desc = $rs->fields[53] ; 
              $this->nmgp_dados_select['incentive_desc'] = $this->incentive_desc;
              $this->rappel = $rs->fields[54] ; 
              $this->nmgp_dados_select['rappel'] = $this->rappel;
              $this->other_deduct = $rs->fields[55] ; 
              $this->nmgp_dados_select['other_deduct'] = $this->other_deduct;
              $this->other_deduct_desc = $rs->fields[56] ; 
              $this->nmgp_dados_select['other_deduct_desc'] = $this->other_deduct_desc;
              $this->loan = $rs->fields[57] ; 
              $this->nmgp_dados_select['loan'] = $this->loan;
              $this->date_loan = $rs->fields[58] ; 
              $this->nmgp_dados_select['date_loan'] = $this->date_loan;
              $this->payment = $rs->fields[59] ; 
              $this->nmgp_dados_select['payment'] = $this->payment;
              $this->date_payment = $rs->fields[60] ; 
              $this->nmgp_dados_select['date_payment'] = $this->date_payment;
              $this->payment_receipt = $rs->fields[61] ; 
              $this->nmgp_dados_select['payment_receipt'] = $this->payment_receipt;
              $this->loan_deduction = $rs->fields[62] ; 
              $this->nmgp_dados_select['loan_deduction'] = $this->loan_deduction;
              $this->loan_description = $rs->fields[63] ; 
              $this->nmgp_dados_select['loan_description'] = $this->loan_description;
              $this->loan_start_deduct = $rs->fields[64] ; 
              $this->nmgp_dados_select['loan_start_deduct'] = $this->loan_start_deduct;
              $this->loan_monthlypayment = $rs->fields[65] ; 
              $this->nmgp_dados_select['loan_monthlypayment'] = $this->loan_monthlypayment;
              $this->loan_end_deduct = $rs->fields[66] ; 
              $this->nmgp_dados_select['loan_end_deduct'] = $this->loan_end_deduct;
              $this->apply_loan_deduction = $rs->fields[67] ; 
              $this->nmgp_dados_select['apply_loan_deduction'] = $this->apply_loan_deduction;
              $this->loan_bank = $rs->fields[68] ; 
              $this->nmgp_dados_select['loan_bank'] = $this->loan_bank;
              $this->date_loan_bank = $rs->fields[69] ; 
              $this->nmgp_dados_select['date_loan_bank'] = $this->date_loan_bank;
              $this->loan_deduction_bank = $rs->fields[70] ; 
              $this->nmgp_dados_select['loan_deduction_bank'] = $this->loan_deduction_bank;
              $this->loan_start_deduct_bank = $rs->fields[71] ; 
              $this->nmgp_dados_select['loan_start_deduct_bank'] = $this->loan_start_deduct_bank;
              $this->loan_end_deduct_bank = $rs->fields[72] ; 
              $this->nmgp_dados_select['loan_end_deduct_bank'] = $this->loan_end_deduct_bank;
              $this->apply_loan_deduction_bank = $rs->fields[73] ; 
              $this->nmgp_dados_select['apply_loan_deduction_bank'] = $this->apply_loan_deduction_bank;
              $this->other_loan = $rs->fields[74] ; 
              $this->nmgp_dados_select['other_loan'] = $this->other_loan;
              $this->date_other_loan = $rs->fields[75] ; 
              $this->nmgp_dados_select['date_other_loan'] = $this->date_other_loan;
              $this->other_loan_deduction = $rs->fields[76] ; 
              $this->nmgp_dados_select['other_loan_deduction'] = $this->other_loan_deduction;
              $this->other_loan_description = $rs->fields[77] ; 
              $this->nmgp_dados_select['other_loan_description'] = $this->other_loan_description;
              $this->other_loan_start_deduct = $rs->fields[78] ; 
              $this->nmgp_dados_select['other_loan_start_deduct'] = $this->other_loan_start_deduct;
              $this->other_loan_monthlypayment = $rs->fields[79] ; 
              $this->nmgp_dados_select['other_loan_monthlypayment'] = $this->other_loan_monthlypayment;
              $this->other_loan_end_deduct = $rs->fields[80] ; 
              $this->nmgp_dados_select['other_loan_end_deduct'] = $this->other_loan_end_deduct;
              $this->apply_other_loan_deduction = $rs->fields[81] ; 
              $this->nmgp_dados_select['apply_other_loan_deduction'] = $this->apply_other_loan_deduction;
              $this->purchase = $rs->fields[82] ; 
              $this->nmgp_dados_select['purchase'] = $this->purchase;
              $this->purchase_description = $rs->fields[83] ; 
              $this->nmgp_dados_select['purchase_description'] = $this->purchase_description;
              $this->date_purchase = $rs->fields[84] ; 
              $this->nmgp_dados_select['date_purchase'] = $this->date_purchase;
              $this->purchase_deduct = $rs->fields[85] ; 
              $this->nmgp_dados_select['purchase_deduct'] = $this->purchase_deduct;
              $this->purchase_start_deduct = $rs->fields[86] ; 
              $this->nmgp_dados_select['purchase_start_deduct'] = $this->purchase_start_deduct;
              $this->purchase_monthlypayment = $rs->fields[87] ; 
              $this->nmgp_dados_select['purchase_monthlypayment'] = $this->purchase_monthlypayment;
              $this->purchase_end_deduct = $rs->fields[88] ; 
              $this->nmgp_dados_select['purchase_end_deduct'] = $this->purchase_end_deduct;
              $this->apply_purchase_deduct = $rs->fields[89] ; 
              $this->nmgp_dados_select['apply_purchase_deduct'] = $this->apply_purchase_deduct;
              $this->health_insurance = $rs->fields[90] ; 
              $this->nmgp_dados_select['health_insurance'] = $this->health_insurance;
              $this->bank_number = $rs->fields[91] ; 
              $this->nmgp_dados_select['bank_number'] = $this->bank_number;
              $this->hiring_duration = $rs->fields[92] ; 
              $this->nmgp_dados_select['hiring_duration'] = $this->hiring_duration;
              $this->update_time = $rs->fields[93] ; 
              if (substr($this->update_time, 10, 1) == "-") 
              { 
                 $this->update_time = substr($this->update_time, 0, 10) . " " . substr($this->update_time, 11);
              } 
              if (substr($this->update_time, 13, 1) == ".") 
              { 
                 $this->update_time = substr($this->update_time, 0, 13) . ":" . substr($this->update_time, 14, 2) . ":" . substr($this->update_time, 17);
              } 
              $this->nmgp_dados_select['update_time'] = $this->update_time;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->nm_troca_decimal(",", ".");
              $this->id = (string)$this->id; 
              $this->userid_int = (string)$this->userid_int; 
              $this->inactif = (string)$this->inactif; 
              $this->payperiod = (string)$this->payperiod; 
              $this->probation_period = (string)$this->probation_period; 
              $this->rate_work = (string)$this->rate_work; 
              $this->rate_ot = (string)$this->rate_ot; 
              $this->rate_ot_factor = (string)$this->rate_ot_factor; 
              $this->rate_ot_holiday_factor = (string)$this->rate_ot_holiday_factor; 
              $this->rate_ot_offday_factor = (string)$this->rate_ot_offday_factor; 
              $this->rate_ot_restday_factor = (string)$this->rate_ot_restday_factor; 
              $this->rate_day = (string)$this->rate_day; 
              $this->rate_fixed = (string)$this->rate_fixed; 
              $this->rate_restday = (string)$this->rate_restday; 
              $this->rate_offday = (string)$this->rate_offday; 
              $this->rate_commission1 = (string)$this->rate_commission1; 
              $this->rate_prime1 = (string)$this->rate_prime1; 
              $this->rate_omission1 = (string)$this->rate_omission1; 
              $this->rate_assmd = (string)$this->rate_assmd; 
              $this->rate_cass = (string)$this->rate_cass; 
              $this->tax_cass = (string)$this->tax_cass; 
              $this->rate_cfgdct = (string)$this->rate_cfgdct; 
              $this->tax_cfgdct = (string)$this->tax_cfgdct; 
              $this->rate_ona = (string)$this->rate_ona; 
              $this->tax_ona = (string)$this->tax_ona; 
              $this->rate_fdu = (string)$this->rate_fdu; 
              $this->tax_fdu = (string)$this->tax_fdu; 
              $this->rate_iris = (string)$this->rate_iris; 
              $this->rate_iric = (string)$this->rate_iric; 
              $this->rate_cons = (string)$this->rate_cons; 
              $this->day_cons = (string)$this->day_cons; 
              $this->revenu_net = (string)$this->revenu_net; 
              $this->incentive = (string)$this->incentive; 
              $this->rappel = (string)$this->rappel; 
              $this->other_deduct = (string)$this->other_deduct; 
              $this->loan = (string)$this->loan; 
              $this->payment = (string)$this->payment; 
              $this->loan_deduction = (string)$this->loan_deduction; 
              $this->loan_monthlypayment = (string)$this->loan_monthlypayment; 
              $this->apply_loan_deduction = (string)$this->apply_loan_deduction; 
              $this->loan_bank = (string)$this->loan_bank; 
              $this->loan_deduction_bank = (string)$this->loan_deduction_bank; 
              $this->apply_loan_deduction_bank = (string)$this->apply_loan_deduction_bank; 
              $this->other_loan = (string)$this->other_loan; 
              $this->other_loan_deduction = (string)$this->other_loan_deduction; 
              $this->other_loan_monthlypayment = (string)$this->other_loan_monthlypayment; 
              $this->apply_other_loan_deduction = (string)$this->apply_other_loan_deduction; 
              $this->purchase = (string)$this->purchase; 
              $this->purchase_deduct = (string)$this->purchase_deduct; 
              $this->purchase_monthlypayment = (string)$this->purchase_monthlypayment; 
              $this->apply_purchase_deduct = (string)$this->apply_purchase_deduct; 
              $this->health_insurance = (string)$this->health_insurance; 
              $this->hiring_duration = (string)$this->hiring_duration; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['parms'] = "id?#?$this->id?@?";
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['sub_dir'][0]  = "";
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['sub_dir'][1]  = "";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start'] < $qt_geral_reg_form_FicheEmployeeSuspended_mob;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opcao']   = '';
          }
      } 
      if ($this->nmgp_opcao == "novo" || $this->nmgp_opcao == "refresh_insert") 
      { 
          $this->sc_evento_old = $this->sc_evento;
          $this->sc_evento = "novo";
          if ('refresh_insert' == $this->nmgp_opcao)
          {
              $this->nmgp_opcao = 'novo';
          }
          else
          {
              $this->nm_formatar_campos();
              $this->id = "";  
              $this->nmgp_dados_form["id"] = $this->id;
              $this->userid_int = "";  
              $this->nmgp_dados_form["userid_int"] = $this->userid_int;
              $this->userid_varchar = "";  
              $this->nmgp_dados_form["userid_varchar"] = $this->userid_varchar;
              $this->employee_name = "";  
              $this->nmgp_dados_form["employee_name"] = $this->employee_name;
              $this->ic = "";  
              $this->nmgp_dados_form["ic"] = $this->ic;
              $this->address = "";  
              $this->nmgp_dados_form["address"] = $this->address;
              $this->phone = "";  
              $this->nmgp_dados_form["phone"] = $this->phone;
              $this->email = "";  
              $this->nmgp_dados_form["email"] = $this->email;
              $this->gender = "";  
              $this->nmgp_dados_form["gender"] = $this->gender;
              $this->dob = "";  
              $this->dob_hora = "" ;  
              $this->nmgp_dados_form["dob"] = $this->dob;
              $this->hiredate = "";  
              $this->hiredate_hora = "" ;  
              $this->nmgp_dados_form["hiredate"] = $this->hiredate;
              $this->firedate = "";  
              $this->firedate_hora = "" ;  
              $this->nmgp_dados_form["firedate"] = $this->firedate;
              $this->inactif = "";  
              $this->nmgp_dados_form["inactif"] = $this->inactif;
              $this->building = "";  
              $this->nmgp_dados_form["building"] = $this->building;
              $this->designation = "";  
              $this->nmgp_dados_form["designation"] = $this->designation;
              $this->dept = "";  
              $this->nmgp_dados_form["dept"] = $this->dept;
              $this->section = "";  
              $this->nmgp_dados_form["section"] = $this->section;
              $this->photo_name = "";  
              $this->photo_name_ul_name = "" ;  
              $this->photo_name_ul_type = "" ;  
              $this->nmgp_dados_form["photo_name"] = $this->photo_name;
              $this->photo_size = "";  
              $this->nmgp_dados_form["photo_size"] = $this->photo_size;
              $this->photo_file = "";  
              $this->photo_file_ul_name = "" ;  
              $this->photo_file_ul_type = "" ;  
              $this->nmgp_dados_form["photo_file"] = $this->photo_file;
              $this->imm_ona = "";  
              $this->nmgp_dados_form["imm_ona"] = $this->imm_ona;
              $this->no_compte = "";  
              $this->nmgp_dados_form["no_compte"] = $this->no_compte;
              $this->type_de_compte = "";  
              $this->nmgp_dados_form["type_de_compte"] = $this->type_de_compte;
              $this->payperiod = "";  
              $this->nmgp_dados_form["payperiod"] = $this->payperiod;
              $this->probation_period = "";  
              $this->nmgp_dados_form["probation_period"] = $this->probation_period;
              $this->rate_work = "";  
              $this->nmgp_dados_form["rate_work"] = $this->rate_work;
              $this->rate_ot = "";  
              $this->nmgp_dados_form["rate_ot"] = $this->rate_ot;
              $this->rate_ot_factor = "";  
              $this->nmgp_dados_form["rate_ot_factor"] = $this->rate_ot_factor;
              $this->rate_ot_holiday_factor = "";  
              $this->nmgp_dados_form["rate_ot_holiday_factor"] = $this->rate_ot_holiday_factor;
              $this->rate_ot_offday_factor = "";  
              $this->nmgp_dados_form["rate_ot_offday_factor"] = $this->rate_ot_offday_factor;
              $this->rate_ot_restday_factor = "";  
              $this->nmgp_dados_form["rate_ot_restday_factor"] = $this->rate_ot_restday_factor;
              $this->rate_day = "";  
              $this->nmgp_dados_form["rate_day"] = $this->rate_day;
              $this->rate_fixed = "";  
              $this->nmgp_dados_form["rate_fixed"] = $this->rate_fixed;
              $this->rate_restday = "";  
              $this->nmgp_dados_form["rate_restday"] = $this->rate_restday;
              $this->rate_offday = "";  
              $this->nmgp_dados_form["rate_offday"] = $this->rate_offday;
              $this->rate_commission1 = "";  
              $this->nmgp_dados_form["rate_commission1"] = $this->rate_commission1;
              $this->rate_prime1 = "";  
              $this->nmgp_dados_form["rate_prime1"] = $this->rate_prime1;
              $this->rate_omission1 = "";  
              $this->nmgp_dados_form["rate_omission1"] = $this->rate_omission1;
              $this->rate_assmd = "";  
              $this->nmgp_dados_form["rate_assmd"] = $this->rate_assmd;
              $this->rate_cass = "";  
              $this->nmgp_dados_form["rate_cass"] = $this->rate_cass;
              $this->tax_cass = "";  
              $this->nmgp_dados_form["tax_cass"] = $this->tax_cass;
              $this->rate_cfgdct = "";  
              $this->nmgp_dados_form["rate_cfgdct"] = $this->rate_cfgdct;
              $this->tax_cfgdct = "";  
              $this->nmgp_dados_form["tax_cfgdct"] = $this->tax_cfgdct;
              $this->rate_ona = "";  
              $this->nmgp_dados_form["rate_ona"] = $this->rate_ona;
              $this->tax_ona = "";  
              $this->nmgp_dados_form["tax_ona"] = $this->tax_ona;
              $this->rate_fdu = "";  
              $this->nmgp_dados_form["rate_fdu"] = $this->rate_fdu;
              $this->tax_fdu = "";  
              $this->nmgp_dados_form["tax_fdu"] = $this->tax_fdu;
              $this->rate_iris = "";  
              $this->nmgp_dados_form["rate_iris"] = $this->rate_iris;
              $this->rate_iric = "";  
              $this->nmgp_dados_form["rate_iric"] = $this->rate_iric;
              $this->rate_cons = "";  
              $this->nmgp_dados_form["rate_cons"] = $this->rate_cons;
              $this->day_cons = "";  
              $this->nmgp_dados_form["day_cons"] = $this->day_cons;
              $this->revenu_net = "";  
              $this->nmgp_dados_form["revenu_net"] = $this->revenu_net;
              $this->incentive = "";  
              $this->nmgp_dados_form["incentive"] = $this->incentive;
              $this->incentive_desc = "";  
              $this->nmgp_dados_form["incentive_desc"] = $this->incentive_desc;
              $this->rappel = "";  
              $this->nmgp_dados_form["rappel"] = $this->rappel;
              $this->other_deduct = "";  
              $this->nmgp_dados_form["other_deduct"] = $this->other_deduct;
              $this->other_deduct_desc = "";  
              $this->nmgp_dados_form["other_deduct_desc"] = $this->other_deduct_desc;
              $this->loan = "";  
              $this->nmgp_dados_form["loan"] = $this->loan;
              $this->date_loan = "";  
              $this->date_loan_hora = "" ;  
              $this->nmgp_dados_form["date_loan"] = $this->date_loan;
              $this->payment = "";  
              $this->nmgp_dados_form["payment"] = $this->payment;
              $this->date_payment = "";  
              $this->date_payment_hora = "" ;  
              $this->nmgp_dados_form["date_payment"] = $this->date_payment;
              $this->payment_receipt = "";  
              $this->nmgp_dados_form["payment_receipt"] = $this->payment_receipt;
              $this->loan_deduction = "";  
              $this->nmgp_dados_form["loan_deduction"] = $this->loan_deduction;
              $this->loan_description = "";  
              $this->nmgp_dados_form["loan_description"] = $this->loan_description;
              $this->loan_start_deduct = "";  
              $this->loan_start_deduct_hora = "" ;  
              $this->nmgp_dados_form["loan_start_deduct"] = $this->loan_start_deduct;
              $this->loan_monthlypayment = "";  
              $this->nmgp_dados_form["loan_monthlypayment"] = $this->loan_monthlypayment;
              $this->loan_end_deduct = "";  
              $this->loan_end_deduct_hora = "" ;  
              $this->nmgp_dados_form["loan_end_deduct"] = $this->loan_end_deduct;
              $this->apply_loan_deduction = "";  
              $this->nmgp_dados_form["apply_loan_deduction"] = $this->apply_loan_deduction;
              $this->loan_bank = "";  
              $this->nmgp_dados_form["loan_bank"] = $this->loan_bank;
              $this->date_loan_bank = "";  
              $this->date_loan_bank_hora = "" ;  
              $this->nmgp_dados_form["date_loan_bank"] = $this->date_loan_bank;
              $this->loan_deduction_bank = "";  
              $this->nmgp_dados_form["loan_deduction_bank"] = $this->loan_deduction_bank;
              $this->loan_start_deduct_bank = "";  
              $this->loan_start_deduct_bank_hora = "" ;  
              $this->nmgp_dados_form["loan_start_deduct_bank"] = $this->loan_start_deduct_bank;
              $this->loan_end_deduct_bank = "";  
              $this->loan_end_deduct_bank_hora = "" ;  
              $this->nmgp_dados_form["loan_end_deduct_bank"] = $this->loan_end_deduct_bank;
              $this->apply_loan_deduction_bank = "";  
              $this->nmgp_dados_form["apply_loan_deduction_bank"] = $this->apply_loan_deduction_bank;
              $this->other_loan = "";  
              $this->nmgp_dados_form["other_loan"] = $this->other_loan;
              $this->date_other_loan = "";  
              $this->date_other_loan_hora = "" ;  
              $this->nmgp_dados_form["date_other_loan"] = $this->date_other_loan;
              $this->other_loan_deduction = "";  
              $this->nmgp_dados_form["other_loan_deduction"] = $this->other_loan_deduction;
              $this->other_loan_description = "";  
              $this->nmgp_dados_form["other_loan_description"] = $this->other_loan_description;
              $this->other_loan_start_deduct = "";  
              $this->other_loan_start_deduct_hora = "" ;  
              $this->nmgp_dados_form["other_loan_start_deduct"] = $this->other_loan_start_deduct;
              $this->other_loan_monthlypayment = "";  
              $this->nmgp_dados_form["other_loan_monthlypayment"] = $this->other_loan_monthlypayment;
              $this->other_loan_end_deduct = "";  
              $this->other_loan_end_deduct_hora = "" ;  
              $this->nmgp_dados_form["other_loan_end_deduct"] = $this->other_loan_end_deduct;
              $this->apply_other_loan_deduction = "";  
              $this->nmgp_dados_form["apply_other_loan_deduction"] = $this->apply_other_loan_deduction;
              $this->purchase = "";  
              $this->nmgp_dados_form["purchase"] = $this->purchase;
              $this->purchase_description = "";  
              $this->nmgp_dados_form["purchase_description"] = $this->purchase_description;
              $this->date_purchase = "";  
              $this->date_purchase_hora = "" ;  
              $this->nmgp_dados_form["date_purchase"] = $this->date_purchase;
              $this->purchase_deduct = "";  
              $this->nmgp_dados_form["purchase_deduct"] = $this->purchase_deduct;
              $this->purchase_start_deduct = "";  
              $this->purchase_start_deduct_hora = "" ;  
              $this->nmgp_dados_form["purchase_start_deduct"] = $this->purchase_start_deduct;
              $this->purchase_monthlypayment = "";  
              $this->nmgp_dados_form["purchase_monthlypayment"] = $this->purchase_monthlypayment;
              $this->purchase_end_deduct = "";  
              $this->purchase_end_deduct_hora = "" ;  
              $this->nmgp_dados_form["purchase_end_deduct"] = $this->purchase_end_deduct;
              $this->apply_purchase_deduct = "";  
              $this->nmgp_dados_form["apply_purchase_deduct"] = $this->apply_purchase_deduct;
              $this->health_insurance = "";  
              $this->nmgp_dados_form["health_insurance"] = $this->health_insurance;
              $this->bank_number = "";  
              $this->nmgp_dados_form["bank_number"] = $this->bank_number;
              $this->hiring_duration = "";  
              $this->nmgp_dados_form["hiring_duration"] = $this->hiring_duration;
              $this->update_time = "";  
              $this->update_time_hora = "" ;  
              $this->nmgp_dados_form["update_time"] = $this->update_time;
              $this->block_note = "";  
              $this->nmgp_dados_form["block_note"] = $this->block_note;
              $this->field01 = "";  
              $this->nmgp_dados_form["field01"] = $this->field01;
              $this->field02 = "";  
              $this->nmgp_dados_form["field02"] = $this->field02;
              $this->field03 = "";  
              $this->nmgp_dados_form["field03"] = $this->field03;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
      }  
//
//
//-- 
      if ($this->nmgp_opcao != "novo") 
      {
      }
      if (!isset($this->nmgp_refresh_fields)) 
      { 
          $this->nm_proc_onload();
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_note_employee_mob']['embutida_parms'] = "NM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scoutlink_remove_margin*scinok*scoutlink_remove_border*scinok*scout";
  }
// 
//-- 
   function nm_db_retorna($str_where_param = '') 
   {  
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $str_where_filter = ('' != $str_where_param) ? ' and ' . $str_where_param : '';
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id) from " . $this->Ini->nm_tabela . " where id < $this->id" . $str_where_filter; 
     $rs = $this->Db->Execute("select max(id) from " . $this->Ini->nm_tabela . " where id < $this->id" . $str_where_filter); 
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
         $rs->Close();  
         $this->nmgp_opcao = "igual";  
         return ;  
     } 
     else 
     { 
        $this->nmgp_opcao = "inicio";  
        $rs->Close();  
        return ; 
     } 
   } 
// 
//-- 
   function nm_db_avanca($str_where_param = '') 
   {  
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $str_where_filter = ('' != $str_where_param) ? ' and ' . $str_where_param : '';
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(id) from " . $this->Ini->nm_tabela . " where id > $this->id" . $str_where_filter; 
     $rs = $this->Db->Execute("select min(id) from " . $this->Ini->nm_tabela . " where id > $this->id" . $str_where_filter); 
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
         $rs->Close();  
         $this->nmgp_opcao = "igual";  
         return ;  
     } 
     else 
     { 
        $this->nmgp_opcao = "final";  
        $rs->Close();  
        return ; 
     } 
   } 
// 
//-- 
   function nm_db_inicio($str_where_param = '') 
   {   
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela; 
     $rs = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela);
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if ($rs->fields[0] == 0) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_nfnd_extr'], $this->Db->ErrorMsg()); 
         $rs->Close(); 
         exit ; 
     }
     $str_where_filter = ('' != $str_where_param) ? ' where ' . $str_where_param : '';
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
     $rs = $this->Db->Execute("select min(id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (!isset($rs->fields[0]) || $rs->EOF) 
     { 
         if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_filter']))
         { 
             $rs->Close();  
             return ; 
         } 
         $this->nm_flag_saida_novo = "S"; 
         $this->nmgp_opcao = "novo";  
         $rs->Close();  
         if ($this->aba_iframe)
         {
             $this->nmgp_botoes['exit'] = 'off';
         }
         return ; 
     } 
     $this->id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
     $rs->Close();  
     $this->nmgp_opcao = "igual";  
     return ;  
   } 
// 
//-- 
   function nm_db_final($str_where_param = '') 
   { 
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $str_where_filter = ('' != $str_where_param) ? ' where ' . $str_where_param : '';
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (!isset($rs->fields[0]) || $rs->EOF) 
     { 
         $this->nm_flag_saida_novo = "S"; 
         $this->nmgp_opcao = "novo";  
         $rs->Close();  
         if ($this->aba_iframe)
         {
             $this->nmgp_botoes['exit'] = 'off';
         }
         return ; 
     } 
     $this->id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
     $rs->Close();  
     $this->nmgp_opcao = "igual";  
     return ;  
   } 
        function initializeRecordState() {
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//
function Download_Fingertec()
{
$_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['contr_erro'] = 'on';
  
$UserID = $this->userid_int ;

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
  WHERE user.define_6 = 0 
  AND   user.expirydate > CURDATE()";



$SQL2 = "UPDATE tbl_rate
INNER JOIN tbl_employee_actif ON tbl_rate.userid_varchar = tbl_employee_actif.userid
SET     tbl_rate.Gender        = tbl_employee_actif.Gender,
        tbl_rate.DOB           = tbl_employee_actif.DOB,
        tbl_rate.hiredate      = tbl_employee_actif.IssueDate,
	    tbl_rate.Address       = tbl_employee_actif.Address,
		tbl_rate.Phone         = tbl_employee_actif.Phone,
		tbl_rate.Email         = tbl_employee_actif.Email,
		tbl_rate.ic            = tbl_employee_actif.ic
WHERE tbl_rate.userid_int = '$UserID'		
		";



     $nm_select = $SQL0; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_FicheEmployeeSuspended_mob_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_FicheEmployeeSuspended_mob_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_FicheEmployeeSuspended_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

echo "<p> <font color=green font face='courier' size='6pt'>DATA FROM FINGERTEC DOWNLOADED SUCCESSFULLY</font> </p>";
$_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['contr_erro'] = 'off';
}
function Generate_netrevenue()
{
$_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['contr_erro'] = 'on';
  
$UserID = $this->userid_int ;


$SQL1 = "UPDATE tbl_rate
SET rate_iris = (IF(((rate_fixed *12)>60000),IF(((rate_fixed *12)>240000),IF(((rate_fixed *12)>480000),IF(((rate_fixed *12)>1000000),((((180000*(10/100))+(240000*(15/100)))+(520000*(25/100)))+((((((rate_fixed *12)-60000)-180000)-240000)-520000)*(30/100))),(((180000*(10/100))+(240000*(15/100)))+(((rate_fixed *12)-480000)*(25/100)))),((180000*(10/100))+(((rate_fixed *12)-240000)*(15/100)))),(((rate_fixed *12)-60000)*(10/100))),0)/12) 
WHERE userid_int = '$UserID'
";


$SQL2 = "UPDATE tbl_rate 
SET tbl_rate.tax_ona    = (If(`tbl_rate`.`rate_fixed`>1000,`tbl_rate`.`rate_fixed`*`tbl_rate`.`rate_ona`,
		If(`tbl_rate`.`rate_fixed`>500,`tbl_rate`.`rate_fixed`*(`tbl_rate`.`rate_ona`*4/6),
		If(`tbl_rate`.`rate_fixed`>200,`tbl_rate`.`rate_fixed`*(`tbl_rate`.`rate_ona`/2),
		If(`tbl_rate`.`rate_fixed`>1,`tbl_rate`.`rate_fixed`*(`tbl_rate`.`rate_ona`/3),0))))),
	tbl_rate.tax_cass   = (If(`tbl_rate`.`rate_fixed`>5000,`tbl_rate`.`rate_fixed`*`tbl_rate`.`rate_cass`,0)),
	tbl_rate.tax_cfgdct = (If(`tbl_rate`.`rate_fixed`>5000,`tbl_rate`.`rate_fixed`*`tbl_rate`.`rate_cfgdct`,0)),
	tbl_rate.tax_fdu    = (If(`tbl_rate`.`rate_fixed`>5000,`tbl_rate`.`rate_fixed`*`tbl_rate`.`rate_fdu`,0))
WHERE userid_int = '$UserID'
	";


$SQL3 = "UPDATE tbl_rate SET revenu_net = rate_fixed-(rate_iris + tax_ona + tax_fdu + tax_cfgdct + tax_cass) WHERE userid_int = '$UserID'";


     $nm_select = $SQL1; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_FicheEmployeeSuspended_mob_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_FicheEmployeeSuspended_mob_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_FicheEmployeeSuspended_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

echo "<p> <font color=green font face='courier' size='6pt'>NET REVENUE GENERATED SUCCESSFULLY</font> </p>";
$_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['contr_erro'] = 'off';
}
function calculate_hiringduration()
{
$_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['contr_erro'] = 'on';
  
$UserID = $this->userid_int ;
$SQL1 = "UPDATE tbl_rate
SET hiring_duration =  TIMESTAMPDIFF(MONTH,hiredate,CURDATE())
WHERE userid_int = '$UserID'
";


$_SESSION['scriptcase']['form_FicheEmployeeSuspended_mob']['contr_erro'] = 'off';
}
//
 function nm_gera_html()
 {
    global
           $nm_url_saida, $nmgp_url_saida, $nm_saida_global, $nm_apl_dependente, $glo_subst, $sc_check_excl, $sc_check_incl, $nmgp_num_form, $NM_run_iframe;
     if ($this->Embutida_proc)
     {
         return;
     }
     if ($this->nmgp_form_show == 'off')
     {
         exit;
     }
      if (isset($NM_run_iframe) && $NM_run_iframe == 1)
      {
          $this->nmgp_botoes['exit'] = "off";
      }
     $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opc_ant'] = $this->nmgp_opcao;
     }
     else
     {
         $this->nmgp_opcao = $this->nmgp_opc_ant;
     }
     if (!empty($this->Campos_Mens_erro)) 
     {
         $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
         $this->Campos_Mens_erro = "";
     }
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              form_FicheEmployeeSuspended_mob_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
//-- 
   if ($this->nmgp_opcao == "novo")
   { 
       $out_photo_name = "";  
   } 
   else 
   { 
       $out_photo_name = $this->photo_name;  
   } 
   if ($this->photo_name != "" && $this->photo_name != "none")   
   { 
       $path_photo_name = $this->Ini->root . $this->Ini->path_imagens . "" . "/" . $this->photo_name;
       $md5_photo_name  = md5("" . $this->photo_name);
       nm_fix_SubDirUpload($this->photo_name,$this->Ini->root . $this->Ini->path_imagens,"");
 
    $file_path_cache = $this->Ini->path_cache . '//' . $this->photo_name;
    if(file_exists($file_path_cache)){
        $path_photo_name = $file_path_cache;
    }
       if (is_file($path_photo_name))  
       { 
           $NM_ler_img = true;
           $out_photo_name = $this->Ini->path_imag_temp . "/sc_photo_name_" . $md5_photo_name . ".gif" ;  
           if (is_file($this->Ini->root . $out_photo_name))  
           { 
               $NM_img_time = filemtime($this->Ini->root . $out_photo_name) + 0; 
               if ($this->Ini->nm_timestamp < $NM_img_time)  
               { 
                   $NM_ler_img = false;
               } 
           } 
           if ($NM_ler_img) 
           { 
               $tmp_photo_name = fopen($path_photo_name, "r") ; 
               $reg_photo_name = fread($tmp_photo_name, filesize($path_photo_name)) ; 
               fclose($tmp_photo_name) ;  
               $arq_photo_name = fopen($this->Ini->root . $out_photo_name, "w") ;  
               fwrite($arq_photo_name, $reg_photo_name) ;  
               fclose($arq_photo_name) ;  
           } 
           $sc_obj_img = new nm_trata_img($this->Ini->root . $out_photo_name, true);
           $this->nmgp_return_img['photo_name'][0] = $sc_obj_img->getHeight();
           $this->nmgp_return_img['photo_name'][1] = $sc_obj_img->getWidth();
           $NM_redim_img = true;
           $out1_photo_name = $out_photo_name; 
           $md5_photo_name  = md5("" . $this->photo_name);
           $out_photo_name = $this->Ini->path_imag_temp . "/sc_photo_name_200200" . $md5_photo_name . ".gif" ;  
           if (is_file($this->Ini->root . $out_photo_name))  
           { 
               $NM_img_time = filemtime($this->Ini->root . $out_photo_name) + 0; 
               if ($this->Ini->nm_timestamp < $NM_img_time)  
               { 
                   $NM_redim_img = false;
               } 
           } 
           if ($NM_redim_img) 
           { 
               if (!$this->Ini->Gd_missing)
               { 
                   $sc_obj_img = new nm_trata_img($this->Ini->root . $out1_photo_name, true);
                   $sc_obj_img->setWidth(200);
                   $sc_obj_img->setHeight(200);
                   $sc_obj_img->setManterAspecto(true);
                   $sc_obj_img->createImg($this->Ini->root . $out_photo_name);
               } 
               else 
               { 
                   $out_photo_name = $out1_photo_name;
               } 
           } 
       if ($this->Ini->Export_img_zip) {
           $this->Ini->Img_export_zip[] = $this->Ini->root . $out_photo_name;
           $out_photo_name = str_replace($this->Ini->path_imag_temp . "/", "", $out_photo_name);
       } 
       } 
   } 
   if (isset($_POST['nmgp_opcao']) && 'excluir' == $_POST['nmgp_opcao'] && $this->sc_evento != "delete" && (!isset($this->sc_evento_old) || 'delete' != $this->sc_evento_old))
   {
       global $temp_out_photo_name;
       if (isset($temp_out_photo_name))
       {
           $out_photo_name = $temp_out_photo_name;
       }
       global $temp_out1_photo_name;
       if (isset($temp_out1_photo_name))
       {
           $out1_photo_name = $temp_out1_photo_name;
       }
   }
        $this->initFormPages();
    include_once("form_FicheEmployeeSuspended_mob_form0.php");
        $this->hideFormPages();
 }

        function initFormPages() {
        } // initFormPages

        function hideFormPages() {
        } // hideFormPages

    function form_format_readonly($field, $value)
    {
        $result = $value;

        $this->form_highlight_search($result, $field, $value);

        return $result;
    }

    function form_highlight_search(&$result, $field, $value)
    {
        if ($this->proc_fast_search) {
            $this->form_highlight_search_quicksearch($result, $field, $value);
        }
    }

    function form_highlight_search_quicksearch(&$result, $field, $value)
    {
        $searchOk = false;
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("userid_int", "employee_name", "ic", "designation", "dept", "gender", "dob", "address", "phone", "hiredate", "email", "firedate", "hiring_duration", "photo_name", "photo_size", "rate_cass", "tax_cass", "rate_cfgdct", "tax_cfgdct", "rate_ona", "tax_ona", "rate_fdu", "tax_fdu", "rate_iris", "rate_fixed", "revenu_net", "block_note"))) {
            $searchOk = true;
        }
        elseif ($field == $this->nmgp_fast_search && in_array($field, array("userid_int", "employee_name", "ic", "designation", "dept", "gender", "dob", "address", "phone", "hiredate", "email", "firedate", "hiring_duration", "photo_name", "photo_size", "rate_cass", "tax_cass", "rate_cfgdct", "tax_cfgdct", "rate_ona", "tax_ona", "rate_fdu", "tax_fdu", "rate_iris", "rate_fixed", "revenu_net", "block_note"))) {
            $searchOk = true;
        }

        if (!$searchOk || '' == $this->nmgp_arg_fast_search) {
            return;
        }

        $htmlIni = '<div class="highlight" style="background-color: #fafaca; display: inline-block">';
        $htmlFim = '</div>';

        if ('qp' == $this->nmgp_cond_fast_search) {
            $keywords = preg_quote($this->nmgp_arg_fast_search, '/');
            $result = preg_replace('/'. $keywords .'/i', $htmlIni . '$0' . $htmlFim, $result);
        } elseif ('eq' == $this->nmgp_cond_fast_search) {
            if (strcasecmp($this->nmgp_arg_fast_search, $value) == 0) {
                $result = $htmlIni. $result .$htmlFim;
            }
        }
    }


    function form_encode_input($string)
    {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['table_refresh'])
        {
            return NM_encode_input(NM_encode_input($string));
        }
        else
        {
            return NM_encode_input($string);
        }
    } // form_encode_input

   function jqueryCalendarDtFormat($sFormat, $sSep)
   {
       $sFormat = chunk_split(str_replace('yyyy', 'yy', $sFormat), 2, $sSep);

       if ($sSep == substr($sFormat, -1))
       {
           $sFormat = substr($sFormat, 0, -1);
       }

       return $sFormat;
   } // jqueryCalendarDtFormat

   function jqueryCalendarTimeStart($sFormat, $value)
   {
       $aDateParts = explode(';', $sFormat);

       if (2 == sizeof($aDateParts))
       {
           $sTime = $aDateParts[1];
       }
       else
       {
           $sTime = 'hh:mm:ss';
       }

       if ('now' == $value) {
           return str_replace(array('hh', 'mm', 'ii', 'ss'), array(date('H'), date('i'), date('i'), date('s')), $sTime);
       } elseif ('end' == $value) {
           return str_replace(array('hh', 'mm', 'ii', 'ss'), array('23', '59', '59', '59'), $sTime);
       } else {
           return str_replace(array('h', 'm', 'i', 's'), array('0', '0', '0', '0'), $sTime);
       }
   } // jqueryCalendarTimeStart

   function jqueryCalendarWeekInit($sDay)
   {
       switch ($sDay) {
           case 'MO': return 1; break;
           case 'TU': return 2; break;
           case 'WE': return 3; break;
           case 'TH': return 4; break;
           case 'FR': return 5; break;
           case 'SA': return 6; break;
           default  : return 7; break;
       }
   } // jqueryCalendarWeekInit

   function jqueryIconFile($sModule)
   {
       $sImage = '';
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && 'image' == $this->arr_buttons['bcalendario']['type'] && 'only_fontawesomeicon' != $this->arr_buttons['bcalendario']['display'])
           {
               $sImage = $this->arr_buttons['bcalendario']['image'];
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && 'image' == $this->arr_buttons['bcalculadora']['type'] && 'only_fontawesomeicon' != $this->arr_buttons['bcalculadora']['display'])
           {
               $sImage = $this->arr_buttons['bcalculadora']['image'];
           }
       }

       return '' == $sImage ? '' : $this->Ini->path_icones . '/' . $sImage;
   } // jqueryIconFile

   function jqueryFAFile($sModule)
   {
       $sFA = '';
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && ('image' == $this->arr_buttons['bcalendario']['type'] || 'button' == $this->arr_buttons['bcalendario']['type']) && 'only_fontawesomeicon' == $this->arr_buttons['bcalendario']['display'])
           {
               $sFA = $this->arr_buttons['bcalendario']['fontawesomeicon'];
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && ('image' == $this->arr_buttons['bcalculadora']['type'] || 'button' == $this->arr_buttons['bcalculadora']['type']) && 'only_fontawesomeicon' == $this->arr_buttons['bcalculadora']['display'])
           {
               $sFA = $this->arr_buttons['bcalculadora']['fontawesomeicon'];
           }
       }

       return '' == $sFA ? '' : "<span class='scButton_fontawesome " . $sFA . "'></span>";
   } // jqueryFAFile

   function jqueryButtonText($sModule)
   {
       $sClass = '';
       $sText  = '';
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && ('image' == $this->arr_buttons['bcalendario']['type'] || 'button' == $this->arr_buttons['bcalendario']['type']))
           {
               if ('only_text' == $this->arr_buttons['bcalendario']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   $sText  = $this->arr_buttons['bcalendario']['value'];
               }
               elseif ('text_fontawesomeicon' == $this->arr_buttons['bcalendario']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   if ('text_right' == $this->arr_buttons['bcalendario']['display_position'])
                   {
                       $sText = "<i class='icon_fa " . $this->arr_buttons['bcalendario']['fontawesomeicon'] . "'></i> " . $this->arr_buttons['bcalendario']['value'];
                   }
                   else
                   {
                       $sText = $this->arr_buttons['bcalendario']['value'] . " <i class='icon_fa " . $this->arr_buttons['bcalendario']['fontawesomeicon'] . "'></i>";
                   }
               }
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && ('image' == $this->arr_buttons['bcalculadora']['type'] || 'button' == $this->arr_buttons['bcalculadora']['type']))
           {
               if ('only_text' == $this->arr_buttons['bcalculadora']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   $sText  = $this->arr_buttons['bcalculadora']['value'];
               }
               elseif ('text_fontawesomeicon' == $this->arr_buttons['bcalculadora']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   if ('text_right' == $this->arr_buttons['bcalendario']['display_position'])
                   {
                       $sText = "<i class='icon_fa " . $this->arr_buttons['bcalculadora']['fontawesomeicon'] . "'></i> " . $this->arr_buttons['bcalculadora']['value'];
                   }
                   else
                   {
                       $sText = $this->arr_buttons['bcalculadora']['value'] . " <i class='icon_fa " . $this->arr_buttons['bcalculadora']['fontawesomeicon'] . "'></i> ";
                   }
               }
           }
       }

       return '' == $sText ? array('', '') : array($sText, $sClass);
   } // jqueryButtonText


    function scCsrfGetToken()
    {
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['csrf_token'];
    }

    function scCsrfGenerateToken()
    {
        $aSources = array(
            'abcdefghijklmnopqrstuvwxyz',
            'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            '1234567890',
            '!@$*()-_[]{},.;:'
        );

        $sRandom = '';

        $aSourcesSizes = array();
        $iSourceSize   = sizeof($aSources) - 1;
        for ($i = 0; $i <= $iSourceSize; $i++)
        {
            $aSourcesSizes[$i] = strlen($aSources[$i]) - 1;
        }

        for ($i = 0; $i < 64; $i++)
        {
            $iSource = $this->scCsrfRandom(0, $iSourceSize);
            $sRandom .= substr($aSources[$iSource], $this->scCsrfRandom(0, $aSourcesSizes[$iSource]), 1);
        }

        return $sRandom;
    }

    function scCsrfRandom($iMin, $iMax)
    {
        return mt_rand($iMin, $iMax);
    }

        function addUrlParam($url, $param, $value) {
                $urlParts  = explode('?', $url);
                $urlParams = isset($urlParts[1]) ? explode('&', $urlParts[1]) : array();
                $objParams = array();
                foreach ($urlParams as $paramInfo) {
                        $paramParts = explode('=', $paramInfo);
                        $objParams[ $paramParts[0] ] = isset($paramParts[1]) ? $paramParts[1] : '';
                }
                $objParams[$param] = $value;
                $urlParams = array();
                foreach ($objParams as $paramName => $paramValue) {
                        $urlParams[] = $paramName . '=' . $paramValue;
                }
                return $urlParts[0] . '?' . implode('&', $urlParams);
        }
 function allowedCharsCharset($charlist)
 {
     if ($_SESSION['scriptcase']['charset'] != 'UTF-8')
     {
         $charlist = NM_conv_charset($charlist, $_SESSION['scriptcase']['charset'], 'UTF-8');
     }
     return str_replace("'", "\'", $charlist);
 }

function sc_file_size($file, $format = false)
{
    if ('' == $file) {
        return '';
    }
    if (!@is_file($file)) {
        return '';
    }
    $fileSize = @filesize($file);
    if ($format) {
        $suffix = '';
        if (1024 >= $fileSize) {
            $fileSize /= 1024;
            $suffix    = ' KB';
        }
        if (1024 >= $fileSize) {
            $fileSize /= 1024;
            $suffix    = ' MB';
        }
        if (1024 >= $fileSize) {
            $fileSize /= 1024;
            $suffix    = ' GB';
        }
        $fileSize = $fileSize . $suffix;
    }
    return $fileSize;
}


 function new_date_format($type, $field)
 {
     $new_date_format_out = '';

     if ('DT' == $type)
     {
         $date_format  = $this->field_config[$field]['date_format'];
         $date_sep     = $this->field_config[$field]['date_sep'];
         $date_display = $this->field_config[$field]['date_display'];
         $time_format  = '';
         $time_sep     = '';
         $time_display = '';
     }
     elseif ('DH' == $type)
     {
         $date_format  = false !== strpos($this->field_config[$field]['date_format'] , ';') ? substr($this->field_config[$field]['date_format'] , 0, strpos($this->field_config[$field]['date_format'] , ';')) : $this->field_config[$field]['date_format'];
         $date_sep     = $this->field_config[$field]['date_sep'];
         $date_display = false !== strpos($this->field_config[$field]['date_display'], ';') ? substr($this->field_config[$field]['date_display'], 0, strpos($this->field_config[$field]['date_display'], ';')) : $this->field_config[$field]['date_display'];
         $time_format  = false !== strpos($this->field_config[$field]['date_format'] , ';') ? substr($this->field_config[$field]['date_format'] , strpos($this->field_config[$field]['date_format'] , ';') + 1) : '';
         $time_sep     = $this->field_config[$field]['time_sep'];
         $time_display = false !== strpos($this->field_config[$field]['date_display'], ';') ? substr($this->field_config[$field]['date_display'], strpos($this->field_config[$field]['date_display'], ';') + 1) : '';
     }
     elseif ('HH' == $type)
     {
         $date_format  = '';
         $date_sep     = '';
         $date_display = '';
         $time_format  = $this->field_config[$field]['date_format'];
         $time_sep     = $this->field_config[$field]['time_sep'];
         $time_display = $this->field_config[$field]['date_display'];
     }

     if ('DT' == $type || 'DH' == $type)
     {
         $date_array = array();
         $date_index = 0;
         $date_ult   = '';
         for ($i = 0; $i < strlen($date_format); $i++)
         {
             $char = strtolower(substr($date_format, $i, 1));
             if (in_array($char, array('d', 'm', 'y', 'a')))
             {
                 if ('a' == $char)
                 {
                     $char = 'y';
                 }
                 if ($char == $date_ult)
                 {
                     $date_array[$date_index] .= $char;
                 }
                 else
                 {
                     if ('' != $date_ult)
                     {
                         $date_index++;
                     }
                     $date_array[$date_index] = $char;
                 }
             }
             $date_ult = $char;
         }

         $disp_array = array();
         $date_index = 0;
         $date_ult   = '';
         for ($i = 0; $i < strlen($date_display); $i++)
         {
             $char = strtolower(substr($date_display, $i, 1));
             if (in_array($char, array('d', 'm', 'y', 'a')))
             {
                 if ('a' == $char)
                 {
                     $char = 'y';
                 }
                 if ($char == $date_ult)
                 {
                     $disp_array[$date_index] .= $char;
                 }
                 else
                 {
                     if ('' != $date_ult)
                     {
                         $date_index++;
                     }
                     $disp_array[$date_index] = $char;
                 }
             }
             $date_ult = $char;
         }

         $date_final = array();
         foreach ($date_array as $date_part)
         {
             if (in_array($date_part, $disp_array))
             {
                 $date_final[] = $date_part;
             }
         }

         $date_format = implode($date_sep, $date_final);
     }
     if ('HH' == $type || 'DH' == $type)
     {
         $time_array = array();
         $time_index = 0;
         $time_ult   = '';
         for ($i = 0; $i < strlen($time_format); $i++)
         {
             $char = strtolower(substr($time_format, $i, 1));
             if (in_array($char, array('h', 'i', 's')))
             {
                 if ($char == $time_ult)
                 {
                     $time_array[$time_index] .= $char;
                 }
                 else
                 {
                     if ('' != $time_ult)
                     {
                         $time_index++;
                     }
                     $time_array[$time_index] = $char;
                 }
             }
             $time_ult = $char;
         }

         $disp_array = array();
         $time_index = 0;
         $time_ult   = '';
         for ($i = 0; $i < strlen($time_display); $i++)
         {
             $char = strtolower(substr($time_display, $i, 1));
             if (in_array($char, array('h', 'i', 's')))
             {
                 if ($char == $time_ult)
                 {
                     $disp_array[$time_index] .= $char;
                 }
                 else
                 {
                     if ('' != $time_ult)
                     {
                         $time_index++;
                     }
                     $disp_array[$time_index] = $char;
                 }
             }
             $time_ult = $char;
         }

         $time_final = array();
         foreach ($time_array as $time_part)
         {
             if (in_array($time_part, $disp_array))
             {
                 $time_final[] = $time_part;
             }
         }

         $time_format = implode($time_sep, $time_final);
     }

     if ('DT' == $type)
     {
         $old_date_format = $date_format;
     }
     elseif ('DH' == $type)
     {
         $old_date_format = $date_format . ';' . $time_format;
     }
     elseif ('HH' == $type)
     {
         $old_date_format = $time_format;
     }

     for ($i = 0; $i < strlen($old_date_format); $i++)
     {
         $char = substr($old_date_format, $i, 1);
         if ('/' == $char)
         {
             $new_date_format_out .= $date_sep;
         }
         elseif (':' == $char)
         {
             $new_date_format_out .= $time_sep;
         }
         else
         {
             $new_date_format_out .= $char;
         }
     }

     $this->field_config[$field]['date_format'] = $new_date_format_out;
     if ('DH' == $type)
     {
         $new_date_format_out                                  = explode(';', $new_date_format_out);
         $this->field_config[$field]['date_format_js']        = $new_date_format_out[0];
         $this->field_config[$field . '_hora']['date_format'] = $new_date_format_out[1];
         $this->field_config[$field . '_hora']['time_sep']    = $this->field_config[$field]['time_sep'];
     }
 } // new_date_format

   function SC_fast_search($in_fields, $arg_search, $data_search)
   {
      $fields = (strpos($in_fields, "SC_all_Cmp") !== false) ? array("SC_all_Cmp") : explode(";", $in_fields);
      $this->NM_case_insensitive = false;
      if (empty($data_search)) 
      {
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              form_FicheEmployeeSuspended_mob_pack_ajax_response();
              exit;
          }
          return;
      }
      $comando = "";
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($data_search))
      {
          $data_search = NM_conv_charset($data_search, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
      $sv_data = $data_search;
      foreach ($fields as $field) {
          if ($field == "SC_all_Cmp" || $field == "userid_int") 
          {
              $this->SC_monta_condicao($comando, "userid_int", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "employee_name") 
          {
              $this->SC_monta_condicao($comando, "employee_name", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "ic") 
          {
              $this->SC_monta_condicao($comando, "ic", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "designation") 
          {
              $this->SC_monta_condicao($comando, "designation", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "dept") 
          {
              $this->SC_monta_condicao($comando, "dept", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "gender") 
          {
              $this->SC_monta_condicao($comando, "Gender", $arg_search, $data_search, "TINYTEXT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "dob") 
          {
              $this->SC_monta_condicao($comando, "DOB", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "address") 
          {
              $this->SC_monta_condicao($comando, "Address", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "phone") 
          {
              $this->SC_monta_condicao($comando, "Phone", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hiredate") 
          {
              $this->SC_monta_condicao($comando, "hiredate", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "email") 
          {
              $this->SC_monta_condicao($comando, "Email", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "firedate") 
          {
              $this->SC_monta_condicao($comando, "firedate", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hiring_duration") 
          {
              $this->SC_monta_condicao($comando, "hiring_duration", $arg_search, str_replace(",", ".", $data_search), "DECIMAL", false);
          }
          if ($field == "SC_all_Cmp" || $field == "photo_name") 
          {
              $this->SC_monta_condicao($comando, "photo_name", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "photo_size") 
          {
              $this->SC_monta_condicao($comando, "photo_size", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "rate_cass") 
          {
              $this->SC_monta_condicao($comando, "rate_cass", $arg_search, str_replace(",", ".", $data_search), "DECIMAL", false);
          }
          if ($field == "SC_all_Cmp" || $field == "tax_cass") 
          {
              $this->SC_monta_condicao($comando, "tax_cass", $arg_search, str_replace(",", ".", $data_search), "DECIMAL", false);
          }
          if ($field == "SC_all_Cmp" || $field == "rate_cfgdct") 
          {
              $this->SC_monta_condicao($comando, "rate_cfgdct", $arg_search, str_replace(",", ".", $data_search), "DECIMAL", false);
          }
          if ($field == "SC_all_Cmp" || $field == "tax_cfgdct") 
          {
              $this->SC_monta_condicao($comando, "tax_cfgdct", $arg_search, str_replace(",", ".", $data_search), "DECIMAL", false);
          }
          if ($field == "SC_all_Cmp" || $field == "rate_ona") 
          {
              $this->SC_monta_condicao($comando, "rate_ona", $arg_search, str_replace(",", ".", $data_search), "DECIMAL", false);
          }
          if ($field == "SC_all_Cmp" || $field == "tax_ona") 
          {
              $this->SC_monta_condicao($comando, "tax_ona", $arg_search, str_replace(",", ".", $data_search), "DECIMAL", false);
          }
          if ($field == "SC_all_Cmp" || $field == "rate_fdu") 
          {
              $this->SC_monta_condicao($comando, "rate_fdu", $arg_search, str_replace(",", ".", $data_search), "DECIMAL", false);
          }
          if ($field == "SC_all_Cmp" || $field == "tax_fdu") 
          {
              $this->SC_monta_condicao($comando, "tax_fdu", $arg_search, str_replace(",", ".", $data_search), "DECIMAL", false);
          }
          if ($field == "SC_all_Cmp" || $field == "rate_iris") 
          {
              $this->SC_monta_condicao($comando, "rate_iris", $arg_search, str_replace(",", ".", $data_search), "DECIMAL", false);
          }
          if ($field == "SC_all_Cmp" || $field == "rate_fixed") 
          {
              $this->SC_monta_condicao($comando, "rate_fixed", $arg_search, str_replace(",", ".", $data_search), "DECIMAL", false);
          }
          if ($field == "SC_all_Cmp" || $field == "revenu_net") 
          {
              $this->SC_monta_condicao($comando, "revenu_net", $arg_search, str_replace(",", ".", $data_search), "DECIMAL", false);
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_filter_form'] . " and (" . $comando . ")";
      }
      else
      {
         $sc_where = " where " . $comando;
      }
      $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $rt = $this->Db->Execute($nmgp_select) ; 
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit ; 
      }  
      $qt_geral_reg_form_FicheEmployeeSuspended_mob = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['total'] = $qt_geral_reg_form_FicheEmployeeSuspended_mob;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_FicheEmployeeSuspended_mob_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_FicheEmployeeSuspended_mob_pack_ajax_response();
          exit;
      }
   }
   function SC_monta_condicao(&$comando, $nome, $condicao, $campo, $tp_campo="", $tp_unaccent=false)
   {
      $nm_aspas   = "'";
      $nm_aspas1  = "'";
      $nm_numeric = array();
      $Nm_datas   = array();
      $campo_join = strtolower(str_replace(".", "_", $nome));
      $nm_ini_lower = "";
      $nm_fim_lower = "";
      $Nm_accent = $this->Ini->Nm_accent_no;
      if ($tp_unaccent) {
          $Nm_accent = $this->Ini->Nm_accent_yes;
      }
      $nm_numeric[] = "id";$nm_numeric[] = "userid_int";$nm_numeric[] = "inactif";$nm_numeric[] = "payperiod";$nm_numeric[] = "probation_period";$nm_numeric[] = "rate_work";$nm_numeric[] = "rate_ot";$nm_numeric[] = "rate_ot_factor";$nm_numeric[] = "rate_ot_holiday_factor";$nm_numeric[] = "rate_ot_offday_factor";$nm_numeric[] = "rate_ot_restday_factor";$nm_numeric[] = "rate_day";$nm_numeric[] = "rate_fixed";$nm_numeric[] = "rate_restday";$nm_numeric[] = "rate_offday";$nm_numeric[] = "rate_commission1";$nm_numeric[] = "rate_prime1";$nm_numeric[] = "rate_omission1";$nm_numeric[] = "rate_assmd";$nm_numeric[] = "rate_cass";$nm_numeric[] = "tax_cass";$nm_numeric[] = "rate_cfgdct";$nm_numeric[] = "tax_cfgdct";$nm_numeric[] = "rate_ona";$nm_numeric[] = "tax_ona";$nm_numeric[] = "rate_fdu";$nm_numeric[] = "tax_fdu";$nm_numeric[] = "rate_iris";$nm_numeric[] = "rate_iric";$nm_numeric[] = "rate_cons";$nm_numeric[] = "day_cons";$nm_numeric[] = "revenu_net";$nm_numeric[] = "incentive";$nm_numeric[] = "rappel";$nm_numeric[] = "other_deduct";$nm_numeric[] = "loan";$nm_numeric[] = "payment";$nm_numeric[] = "loan_deduction";$nm_numeric[] = "loan_monthlypayment";$nm_numeric[] = "apply_loan_deduction";$nm_numeric[] = "loan_bank";$nm_numeric[] = "loan_deduction_bank";$nm_numeric[] = "apply_loan_deduction_bank";$nm_numeric[] = "other_loan";$nm_numeric[] = "other_loan_deduction";$nm_numeric[] = "other_loan_monthlypayment";$nm_numeric[] = "apply_other_loan_deduction";$nm_numeric[] = "purchase";$nm_numeric[] = "purchase_deduct";$nm_numeric[] = "purchase_monthlypayment";$nm_numeric[] = "apply_purchase_deduct";$nm_numeric[] = "health_insurance";$nm_numeric[] = "hiring_duration";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['decimal_db'] == ".")
         {
             $nm_aspas  = "";
             $nm_aspas1 = "";
         }
         if (is_array($campo))
         {
             foreach ($campo as $Ind => $Cmp)
             {
                if (!is_numeric($Cmp))
                {
                    return;
                }
                if ($Cmp == "")
                {
                    $campo[$Ind] = 0;
                }
             }
         }
         else
         {
             if (!is_numeric($campo))
             {
                 return;
             }
             if ($campo == "")
             {
                $campo = 0;
             }
         }
      }
      if (is_array($campo)) {
          foreach ($campo as $Ind => $Cmp) {
             if ($Cmp != null) {
                 $campo[$Ind] = substr($this->Ini->Db->qstr($Cmp), 1, -1);
             }
          }
      }
      else {
          $campo = substr($this->Ini->Db->qstr($campo), 1, -1);
      }
      $Nm_datas["dob"] = "date";$Nm_datas["hiredate"] = "date";$Nm_datas["firedate"] = "date";$Nm_datas["date_loan"] = "date";$Nm_datas["date_payment"] = "date";$Nm_datas["loan_start_deduct"] = "date";$Nm_datas["loan_end_deduct"] = "date";$Nm_datas["date_loan_bank"] = "date";$Nm_datas["loan_start_deduct_bank"] = "date";$Nm_datas["loan_end_deduct_bank"] = "date";$Nm_datas["date_other_loan"] = "date";$Nm_datas["other_loan_start_deduct"] = "date";$Nm_datas["other_loan_end_deduct"] = "date";$Nm_datas["date_purchase"] = "date";$Nm_datas["purchase_start_deduct"] = "date";$Nm_datas["purchase_end_deduct"] = "date";$Nm_datas["update_time"] = "timestamp";
         if (isset($Nm_datas[$campo_join]))
         {
             for ($x = 0; $x < strlen($campo); $x++)
             {
                 $tst = substr($campo, $x, 1);
                 if (!is_numeric($tst) && ($tst != "-" && $tst != ":" && $tst != " "))
                 {
                     return;
                 }
             }
         }
          if (isset($Nm_datas[$campo_join]))
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['SC_sep_date1'];
              }
          }
      if (isset($Nm_datas[$campo_join]) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP" || strtoupper($condicao) == "DF"))
      {
          if (strtoupper($condicao) == "DF")
          {
              $condicao = "NP";
          }
      }
         $comando .= (!empty($comando) ? " or " : "");
         if (is_array($campo))
         {
             $prep = "";
             foreach ($campo as $Ind => $Cmp)
             {
                 $prep .= (!empty($prep)) ? "," : "";
                 $Cmp   = substr($this->Db->qstr($Cmp), 1, -1);
                 $prep .= $nm_ini_lower . $nm_aspas . $Cmp . $nm_aspas1 . $nm_fim_lower;
             }
             $prep .= (empty($prep)) ? $nm_aspas . $nm_aspas1 : "";
             $comando .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $prep . ")";
             return;
         }
         $campo  = substr($this->Db->qstr($campo), 1, -1);
         $cond_tst = strtoupper($condicao);
         if ($cond_tst == "II" || $cond_tst == "QP" || $cond_tst == "NP")
         {
             $op_like = " like ";
         }
         switch ($cond_tst)
         {
            case "EQ":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "II":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_like . $nm_ini_lower . "'" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
            break;
            case "QP":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_like . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
            break;
            case "NP":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . " not" . $op_like . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
            break;
            case "DF":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "GT":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " > " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "GE":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " >= " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "LT":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " < " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "LE":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <= " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
         }
   }
function nmgp_redireciona($tipo=0)
{
   global $nm_apl_dependente;
   if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $_SESSION['scriptcase']['sc_tp_saida'] != "D" && $nm_apl_dependente != 1) 
   {
       $nmgp_saida_form = $_SESSION['scriptcase']['nm_sc_retorno'];
   }
   else
   {
       $nmgp_saida_form = $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page];
   }
   if ($tipo == 2)
   {
       $nmgp_saida_form = "form_FicheEmployeeSuspended_mob_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['nm_run_menu'] = 2;
       $nmgp_saida_form = "form_FicheEmployeeSuspended_mob_fim.php";
   }
   $diretorio = explode("/", $nmgp_saida_form);
   $cont = count($diretorio);
   $apl = $diretorio[$cont - 1];
   $apl = str_replace(".php", "", $apl);
   $pos = strpos($apl, "?");
   if ($pos !== false)
   {
       $apl = substr($apl, 0, $pos);
   }
   if ($tipo != 1 && $tipo != 2)
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page][$apl]['where_orig']);
   }
   if ($this->NM_ajax_flag)
   {
       $sTarget = '_self';
       $this->NM_ajax_info['redir']['metodo']              = 'post';
       $this->NM_ajax_info['redir']['action']              = $nmgp_saida_form;
       $this->NM_ajax_info['redir']['target']              = $sTarget;
       $this->NM_ajax_info['redir']['script_case_init']    = $this->Ini->sc_page;
       if (0 == $tipo)
       {
           $this->NM_ajax_info['redir']['nmgp_url_saida'] = $this->nm_location;
       }
       form_FicheEmployeeSuspended_mob_pack_ajax_response();
       exit;
   }
?>
<!DOCTYPE html>

   <HTML>
   <HEAD>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

   if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
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
   </HEAD>
   <BODY>
   <FORM name="form_ok" method="POST" action="<?php echo $this->form_encode_input($nmgp_saida_form); ?>" target="_self">
<?php
   if ($tipo == 0)
   {
?>
     <INPUT type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($this->nm_location); ?>"> 
<?php
   }
?>
     <INPUT type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
   </FORM>
   <SCRIPT type="text/javascript">
      bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
      function scLigEditLookupCall()
      {
<?php
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['sc_modal'])
   {
?>
        parent.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
   }
   elseif ($this->lig_edit_lookup)
   {
?>
        opener.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
   }
?>
      }
      if (bLigEditLookupCall)
      {
        scLigEditLookupCall();
      }
<?php
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['masterValue']);
?>
}
<?php
    }
}
?>
      document.form_ok.submit();
   </SCRIPT>
   </BODY>
   </HTML>
<?php
  exit;
}
function nmgp_redireciona_form($nm_apl_dest, $nm_apl_retorno, $nm_apl_parms, $nm_target="", $opc="", $alt_modal=430, $larg_modal=630)
{
   if (isset($this->NM_is_redirected) && $this->NM_is_redirected)
   {
       return;
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_note_employee_mob']['reg_start'] = "";
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_note_employee_mob']['total']);
   if (is_array($nm_apl_parms))
   {
       $tmp_parms = "";
       foreach ($nm_apl_parms as $par => $val)
       {
           $par = trim($par);
           $val = trim($val);
           $tmp_parms .= str_replace(".", "_", $par) . "?#?";
           if (substr($val, 0, 1) == "$")
           {
               $tmp_parms .= $$val;
           }
           elseif (substr($val, 0, 1) == "{")
           {
               $val        = substr($val, 1, -1);
               $tmp_parms .= $this->$val;
           }
           elseif (substr($val, 0, 1) == "[")
           {
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob'][substr($val, 1, -1)];
           }
           else
           {
               $tmp_parms .= $val;
           }
           $tmp_parms .= "?@?";
       }
       $nm_apl_parms = $tmp_parms;
   }
   if (empty($opc))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['opc_ant'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           form_FicheEmployeeSuspended_mob_pack_ajax_response();
           exit;
       }
       echo "<SCRIPT language=\"javascript\">";
       if (strtolower($nm_target) == "_blank")
       {
           echo "window.open ('" . $nm_apl_dest . "');";
           echo "</SCRIPT>";
           return;
       }
       else
       {
           echo "window.location='" . $nm_apl_dest . "';";
           echo "</SCRIPT>";
           $this->NM_close_db();
           exit;
       }
   }
   $dir = explode("/", $nm_apl_dest);
   if (count($dir) == 1)
   {
       $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
       $nm_apl_dest = $this->Ini->path_link . SC_dir_app_name($nm_apl_dest) . "/" . $nm_apl_dest . ".php";
   }
   if ($this->NM_ajax_flag)
   {
       $nm_apl_parms = str_replace("?#?", "*scin", NM_charset_to_utf8($nm_apl_parms));
       $nm_apl_parms = str_replace("?@?", "*scout", $nm_apl_parms);
       $this->NM_ajax_info['redir']['metodo']     = 'post';
       $this->NM_ajax_info['redir']['action']     = $nm_apl_dest;
       $this->NM_ajax_info['redir']['nmgp_parms'] = $nm_apl_parms;
       $this->NM_ajax_info['redir']['target']     = $nm_target_form;
       $this->NM_ajax_info['redir']['h_modal']    = $alt_modal;
       $this->NM_ajax_info['redir']['w_modal']    = $larg_modal;
       if ($nm_target_form == "_blank")
       {
           $this->NM_ajax_info['redir']['nmgp_outra_jan'] = 'true';
       }
       else
       {
           $this->NM_ajax_info['redir']['nmgp_url_saida']      = $nm_apl_retorno;
           $this->NM_ajax_info['redir']['script_case_init']    = $this->Ini->sc_page;
       }
       form_FicheEmployeeSuspended_mob_pack_ajax_response();
       exit;
   }
   if ($nm_target == "modal")
   {
       if (!empty($nm_apl_parms))
       {
           $nm_apl_parms = str_replace("?#?", "*scin", $nm_apl_parms);
           $nm_apl_parms = str_replace("?@?", "*scout", $nm_apl_parms);
           $nm_apl_parms = "nmgp_parms=" . $nm_apl_parms . "&";
       }
       $par_modal = "?script_case_init=" . $this->Ini->sc_page . "&nmgp_outra_jan=true&nmgp_url_saida=modal&NMSC_modal=ok&";
       $this->redir_modal = "$(function() { tb_show('', '" . $nm_apl_dest . $par_modal . $nm_apl_parms . "TB_iframe=true&modal=true&height=" . $alt_modal . "&width=" . $larg_modal . "', '') })";
       $this->NM_is_redirected = true;
       return;
   }
   if ($nm_target == "_blank")
   {
?>
<form name="Fredir" method="post" target="_blank" action="<?php echo $nm_apl_dest; ?>">
  <input type="hidden" name="nmgp_parms" value="<?php echo $this->form_encode_input($nm_apl_parms); ?>"/>
</form>
<script type="text/javascript">
setTimeout(function() { document.Fredir.submit(); }, 250);
</script>
<?php
    return;
   }
?>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
?>
<!DOCTYPE html>

   <HTML>
   <HEAD>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

   if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
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
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
   </HEAD>
   <BODY>
<?php
   }
?>
<form name="Fredir" method="post" 
                  target="_self"> 
  <input type="hidden" name="nmgp_parms" value="<?php echo $this->form_encode_input($nm_apl_parms); ?>"/>
<?php
   if ($nm_target_form == "_blank")
   {
?>
  <input type="hidden" name="nmgp_outra_jan" value="true"/> 
<?php
   }
   else
   {
?>
  <input type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($nm_apl_retorno) ?>">
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"/> 
<?php
   }
?>
</form> 
   <SCRIPT type="text/javascript">
<?php
   if ($nm_target_form == "modal")
   {
?>
       $(document).ready(function(){
           tb_show('', '<?php echo $nm_apl_dest ?>?script_case_init=<?php echo $this->Ini->sc_page; ?>&nmgp_url_saida=modal&nmgp_parms=<?php echo $this->form_encode_input($nm_apl_parms); ?>&nmgp_outra_jan=true&TB_iframe=true&height=<?php echo $alt_modal; ?>&width=<?php echo $larg_modal; ?>&modal=true', '');
       });
<?php
   }
   else
   {
?>
    $(function() {
       document.Fredir.target = "<?php echo $nm_target_form ?>"; 
       document.Fredir.action = "<?php echo $nm_apl_dest ?>";
       document.Fredir.submit();
    });
<?php
   }
?>
   </SCRIPT>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
?>
   </BODY>
   </HTML>
<?php
   }
?>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
       $this->NM_close_db();
       exit;
   }
}
    function getButtonIds($buttonName) {
        switch ($buttonName) {
            case "update":
                return array("sc_b_upd_t.sc-unique-btn-1", "sc_b_upd_t.sc-unique-btn-10");
                break;
            case "historic_salary":
                return array("sc_Historic_Salary_top");
                break;
            case "breload":
                return array("sc_b_reload_t.sc-unique-btn-2", "sc_b_reload_t.sc-unique-btn-11");
                break;
            case "help":
                return array("sc_b_hlp_t");
                break;
            case "exit":
                return array("sc_b_sai_t.sc-unique-btn-3", "sc_b_sai_t.sc-unique-btn-5", "sc_b_sai_t.sc-unique-btn-12", "sc_b_sai_t.sc-unique-btn-14", "sc_b_sai_t.sc-unique-btn-4", "sc_b_sai_t.sc-unique-btn-13");
                break;
            case "birpara":
                return array("brec_b");
                break;
            case "first":
                return array("sc_b_ini_b.sc-unique-btn-6", "sc_b_ini_b.sc-unique-btn-15");
                break;
            case "back":
                return array("sc_b_ret_b.sc-unique-btn-7", "sc_b_ret_b.sc-unique-btn-16");
                break;
            case "forward":
                return array("sc_b_avc_b.sc-unique-btn-8", "sc_b_avc_b.sc-unique-btn-17");
                break;
            case "last":
                return array("sc_b_fim_b.sc-unique-btn-9", "sc_b_fim_b.sc-unique-btn-18");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr><td class="sc-app-header">
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "Employee Sheet"; } else { echo "Employee Sheet"; } ?></div>
    <div class="scFormHeaderFont" style="float: right;">
<?php
$this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS");
echo $this->nm_data->FormataSaida("d-m-Y");
?>
</div>
</div>
    </td></tr>
<?php
    }

    function displayAppFooter()
    {
    }

    function displayAppToolbars()
    {
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['run_iframe'] != "R") {
        } else {
            return false;
        }
        return true;
    } // displayAppToolbars

    function displayTopToolbar()
    {
        if (!$this->displayAppToolbars()) {
            return;
        }
    } // displayTopToolbar

    function displayBottomToolbar()
    {
        if (!$this->displayAppToolbars()) {
            return;
        }
    } // displayBottomToolbar

    function getSummaryLine()
    {
        $summaryLine = "[" . $this->Ini->Nm_lang['lang_othr_smry_info_simp'] . "]";
        $summaryLine = str_replace(
            [
                '?final?',
                '?total?',
            ],
            [
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_FicheEmployeeSuspended_mob']['ordem_ord'] == " desc") {
                $orderColOrient = $nome_img = $this->Ini->Label_sort_desc;
                $orderColRule = $sortRule = 'desc';
            } else {
                $orderColOrient = $nome_img = $this->Ini->Label_sort_asc;
                $orderColRule = $sortRule = 'asc';
            }
        }
        return $sortRule;
    }

    function scGetColumnOrderIcon($fieldName, $sortRule)
    {        if ($this->scIsFieldNumeric($fieldName)) {
            $defaultOffIcon = 'asc' == $this->scGetDefaultFieldOrder($fieldName) ? "fas fa-sort-numeric-down" : "fas fa-sort-numeric-down-alt";
            if ('desc' == $sortRule) {
                return "<span class=\"fas fa-sort-numeric-down-alt sc-form-order-icon\"></span>";
            } elseif ('asc' == $sortRule) {
                return "<span class=\"fas fa-sort-numeric-down sc-form-order-icon\"></span>";
            } else {
                return "<span class=\"" . $defaultOffIcon . " sc-form-order-icon sc-form-order-icon-unused\"></span>";
            }
        } else {
            $defaultOffIcon = 'asc' == $this->scGetDefaultFieldOrder($fieldName) ? "fas fa-sort-alpha-down" : "fas fa-sort-alpha-down-alt";
            if ('desc' == $sortRule) {
                return "<span class=\"fas fa-sort-alpha-down-alt sc-form-order-icon\"></span>";
            } elseif ('asc' == $sortRule) {
                return "<span class=\"fas fa-sort-alpha-down sc-form-order-icon\"></span>";
            } else {
                return "<span class=\"" . $defaultOffIcon . " sc-form-order-icon sc-form-order-icon-unused\"></span>";
            }
        }
    }

    function scIsFieldNumeric($fieldName)
    {
        switch ($fieldName) {
            case "userid_int":
                return true;
            case "hiring_duration":
                return true;
            case "rate_cass":
                return true;
            case "tax_cass":
                return true;
            case "rate_cfgdct":
                return true;
            case "tax_cfgdct":
                return true;
            case "rate_ona":
                return true;
            case "tax_ona":
                return true;
            case "rate_fdu":
                return true;
            case "tax_fdu":
                return true;
            case "rate_iris":
                return true;
            case "rate_fixed":
                return true;
            case "revenu_net":
                return true;
            case "id":
                return true;
            case "inactif":
                return true;
            case "payperiod":
                return true;
            case "probation_period":
                return true;
            case "rate_work":
                return true;
            case "rate_ot":
                return true;
            case "rate_ot_factor":
                return true;
            case "rate_ot_holiday_factor":
                return true;
            case "rate_ot_offday_factor":
                return true;
            case "rate_ot_restday_factor":
                return true;
            case "rate_day":
                return true;
            case "rate_restday":
                return true;
            case "rate_offday":
                return true;
            case "rate_commission1":
                return true;
            case "Rate_Prime1":
                return true;
            case "Rate_Omission1":
                return true;
            case "rate_assmd":
                return true;
            case "rate_iric":
                return true;
            case "rate_cons":
                return true;
            case "day_cons":
                return true;
            case "incentive":
                return true;
            case "rappel":
                return true;
            case "other_deduct":
                return true;
            case "loan":
                return true;
            case "payment":
                return true;
            case "loan_deduction":
                return true;
            case "loan_monthlypayment":
                return true;
            case "apply_loan_deduction":
                return true;
            case "loan_bank":
                return true;
            case "loan_deduction_bank":
                return true;
            case "apply_loan_deduction_bank":
                return true;
            case "other_loan":
                return true;
            case "other_loan_deduction":
                return true;
            case "other_loan_monthlypayment":
                return true;
            case "apply_other_loan_deduction":
                return true;
            case "purchase":
                return true;
            case "purchase_deduct":
                return true;
            case "purchase_monthlypayment":
                return true;
            case "apply_purchase_deduct":
                return true;
            case "health_insurance":
                return true;
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "userid_int":
                return 'desc';
            case "DOB":
                return 'desc';
            case "hiredate":
                return 'desc';
            case "firedate":
                return 'desc';
            case "hiring_duration":
                return 'desc';
            case "rate_cass":
                return 'desc';
            case "tax_cass":
                return 'desc';
            case "rate_cfgdct":
                return 'desc';
            case "tax_cfgdct":
                return 'desc';
            case "rate_ona":
                return 'desc';
            case "tax_ona":
                return 'desc';
            case "rate_fdu":
                return 'desc';
            case "tax_fdu":
                return 'desc';
            case "rate_iris":
                return 'desc';
            case "rate_fixed":
                return 'desc';
            case "revenu_net":
                return 'desc';
            case "id":
                return 'desc';
            case "inactif":
                return 'desc';
            case "payperiod":
                return 'desc';
            case "probation_period":
                return 'desc';
            case "rate_work":
                return 'desc';
            case "rate_ot":
                return 'desc';
            case "rate_ot_factor":
                return 'desc';
            case "rate_ot_holiday_factor":
                return 'desc';
            case "rate_ot_offday_factor":
                return 'desc';
            case "rate_ot_restday_factor":
                return 'desc';
            case "rate_day":
                return 'desc';
            case "rate_restday":
                return 'desc';
            case "rate_offday":
                return 'desc';
            case "rate_commission1":
                return 'desc';
            case "Rate_Prime1":
                return 'desc';
            case "Rate_Omission1":
                return 'desc';
            case "rate_assmd":
                return 'desc';
            case "rate_iric":
                return 'desc';
            case "rate_cons":
                return 'desc';
            case "day_cons":
                return 'desc';
            case "incentive":
                return 'desc';
            case "rappel":
                return 'desc';
            case "other_deduct":
                return 'desc';
            case "loan":
                return 'desc';
            case "date_loan":
                return 'desc';
            case "payment":
                return 'desc';
            case "date_payment":
                return 'desc';
            case "loan_deduction":
                return 'desc';
            case "loan_start_deduct":
                return 'desc';
            case "loan_monthlypayment":
                return 'desc';
            case "loan_end_deduct":
                return 'desc';
            case "apply_loan_deduction":
                return 'desc';
            case "loan_bank":
                return 'desc';
            case "date_loan_bank":
                return 'desc';
            case "loan_deduction_bank":
                return 'desc';
            case "loan_start_deduct_bank":
                return 'desc';
            case "loan_end_deduct_bank":
                return 'desc';
            case "apply_loan_deduction_bank":
                return 'desc';
            case "other_loan":
                return 'desc';
            case "date_other_loan":
                return 'desc';
            case "other_loan_deduction":
                return 'desc';
            case "other_loan_start_deduct":
                return 'desc';
            case "other_loan_monthlypayment":
                return 'desc';
            case "other_loan_end_deduct":
                return 'desc';
            case "apply_other_loan_deduction":
                return 'desc';
            case "purchase":
                return 'desc';
            case "date_purchase":
                return 'desc';
            case "purchase_deduct":
                return 'desc';
            case "purchase_start_deduct":
                return 'desc';
            case "purchase_monthlypayment":
                return 'desc';
            case "purchase_end_deduct":
                return 'desc';
            case "apply_purchase_deduct":
                return 'desc';
            case "health_insurance":
                return 'desc';
            case "update_time":
                return 'desc';
            default:
                return 'asc';
        }
        return 'asc';
    }

}
?>
