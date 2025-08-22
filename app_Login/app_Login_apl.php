<?php
//
 use Abraham\TwitterOAuth\TwitterOAuth;
 use League\OAuth2\Client\Provider\Google;
class app_Login_apl
{
   var $has_where_params = false;
   var $NM_is_redirected = false;
   var $NM_non_ajax_info = false;
   var $formatado = false;
   var $use_100perc_fields = true;
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
   var $login;
   var $pswd;
   var $remember_me;
   var $remember_me_1;
   var $new_user;
   var $retrieve_pswd;
   var $language;
   var $nm_data;
   var $nmgp_opcao;
   var $nmgp_opc_ant;
   var $sc_evento;
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
            $glo_senha_protect, $bok, $nm_apl_dependente, $nm_form_submit, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup, $nmgp_redir;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['bok']))
          {
              $this->bok = $this->NM_ajax_info['param']['bok'];
          }
          if (isset($this->NM_ajax_info['param']['captcha_code']))
          {
              $this->captcha_code = $this->NM_ajax_info['param']['captcha_code'];
          }
          if (isset($this->NM_ajax_info['param']['captcha_sent']))
          {
              $this->captcha_sent = $this->NM_ajax_info['param']['captcha_sent'];
          }
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['language']))
          {
              $this->language = $this->NM_ajax_info['param']['language'];
          }
          if (isset($this->NM_ajax_info['param']['login']))
          {
              $this->login = $this->NM_ajax_info['param']['login'];
          }
          if (isset($this->NM_ajax_info['param']['new_user']))
          {
              $this->new_user = $this->NM_ajax_info['param']['new_user'];
          }
          if (isset($this->NM_ajax_info['param']['new_user_sc_target_name']))
          {
              $this->new_user_sc_target_name = $this->NM_ajax_info['param']['new_user_sc_target_name'];
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
          if (isset($this->NM_ajax_info['param']['pswd']))
          {
              $this->pswd = $this->NM_ajax_info['param']['pswd'];
          }
          if (isset($this->NM_ajax_info['param']['remember_me']))
          {
              $this->remember_me = $this->NM_ajax_info['param']['remember_me'];
          }
          if (isset($this->NM_ajax_info['param']['retrieve_pswd']))
          {
              $this->retrieve_pswd = $this->NM_ajax_info['param']['retrieve_pswd'];
          }
          if (isset($this->NM_ajax_info['param']['retrieve_pswd_sc_target_name']))
          {
              $this->retrieve_pswd_sc_target_name = $this->NM_ajax_info['param']['retrieve_pswd_sc_target_name'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
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
      if (isset($this->facebook_error_code) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['facebook_error_code'] = $this->facebook_error_code;
      }
      if (isset($this->facebook_error_msg) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['facebook_error_msg'] = $this->facebook_error_msg;
      }
      if (isset($this->facebook_user) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['facebook_user'] = $this->facebook_user;
      }
      if (isset($this->facebook_email) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['facebook_email'] = $this->facebook_email;
      }
      if (isset($this->facebook_name) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['facebook_name'] = $this->facebook_name;
      }
      if (isset($this->usr_login) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($this->usr_priv_admin) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_priv_admin'] = $this->usr_priv_admin;
      }
      if (isset($this->usr_name) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_name'] = $this->usr_name;
      }
      if (isset($this->usr_email) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_email'] = $this->usr_email;
      }
      if (isset($this->usr_phone) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_phone'] = $this->usr_phone;
      }
      if (isset($this->remember_me) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['remember_me'] = $this->remember_me;
      }
      if (isset($this->usr_picture) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_picture'] = $this->usr_picture;
      }
      if (isset($this->usr_groups) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_groups'] = $this->usr_groups;
      }
      if (isset($this->sett_group_administrator) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_group_administrator'] = $this->sett_group_administrator;
      }
      if (isset($this->sett_enable_2fa) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_enable_2fa'] = $this->sett_enable_2fa;
      }
      if (isset($this->sett_mfa_last_updated) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_mfa_last_updated'] = $this->sett_mfa_last_updated;
      }
      if (isset($this->sett_enable_2fa_mode) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_enable_2fa_mode'] = $this->sett_enable_2fa_mode;
      }
      if (isset($this->google_error_code) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['google_error_code'] = $this->google_error_code;
      }
      if (isset($this->google_error_msg) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['google_error_msg'] = $this->google_error_msg;
      }
      if (isset($this->google_user) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['google_user'] = $this->google_user;
      }
      if (isset($this->google_email) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['google_email'] = $this->google_email;
      }
      if (isset($this->google_name) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['google_name'] = $this->google_name;
      }
      if (isset($this->sett_group_default) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_group_default'] = $this->sett_group_default;
      }
      if (isset($this->sett_smtp_api) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_smtp_api'] = $this->sett_smtp_api;
      }
      if (isset($this->sett_smtp) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_smtp'] = $this->sett_smtp;
      }
      if (isset($this->sett_smtp_server) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_smtp_server'] = $this->sett_smtp_server;
      }
      if (isset($this->sett_smtp_security) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_smtp_security'] = $this->sett_smtp_security;
      }
      if (isset($this->sett_smtp_port) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_smtp_port'] = $this->sett_smtp_port;
      }
      if (isset($this->sett_smtp_user) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_smtp_user'] = $this->sett_smtp_user;
      }
      if (isset($this->sett_smtp_pass) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_smtp_pass'] = $this->sett_smtp_pass;
      }
      if (isset($this->sett_smtp_from_email) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_smtp_from_email'] = $this->sett_smtp_from_email;
      }
      if (isset($this->sett_smtp_from_name) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_smtp_from_name'] = $this->sett_smtp_from_name;
      }
      if (isset($this->sett_theme) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_theme'] = $this->sett_theme;
      }
      if (isset($this->sett_captcha) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_captcha'] = $this->sett_captcha;
      }
      if (isset($this->logged_date_login) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['logged_date_login'] = $this->logged_date_login;
      }
      if (isset($this->sett_remember_me) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_remember_me'] = $this->sett_remember_me;
      }
      if (isset($this->return_msg_email_act) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['return_msg_email_act'] = $this->return_msg_email_act;
      }
      if (isset($this->sett_new_users) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_new_users'] = $this->sett_new_users;
      }
      if (isset($this->sett_retrieve_password) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_retrieve_password'] = $this->sett_retrieve_password;
      }
      if (isset($this->sett_language) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_language'] = $this->sett_language;
      }
      if (isset($this->sett_login_mode) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_login_mode'] = $this->sett_login_mode;
      }
      if (isset($this->sett_brute_force) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_brute_force'] = $this->sett_brute_force;
      }
      if (isset($this->sett_pswd_last_updated) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_pswd_last_updated'] = $this->sett_pswd_last_updated;
      }
      if (isset($this->sett_cookie_expiration_time) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_cookie_expiration_time'] = $this->sett_cookie_expiration_time;
      }
      if (isset($this->sett_session_expire) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_session_expire'] = $this->sett_session_expire;
      }
      if (isset($this->twitter_user) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['twitter_user'] = $this->twitter_user;
      }
      if (isset($this->twitter_email) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['twitter_email'] = $this->twitter_email;
      }
      if (isset($this->twitter_name) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['twitter_name'] = $this->twitter_name;
      }
      if (isset($this->google_photo) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['google_photo'] = $this->google_photo;
      }
      if (isset($this->sett_auth_sn_fb) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_auth_sn_fb'] = $this->sett_auth_sn_fb;
      }
      if (isset($this->sett_auth_sn_x) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_auth_sn_x'] = $this->sett_auth_sn_x;
      }
      if (isset($this->sett_auth_sn_google) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_auth_sn_google'] = $this->sett_auth_sn_google;
      }
      if (isset($this->sett_auth_sn_position) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_auth_sn_position'] = $this->sett_auth_sn_position;
      }
      if (isset($this->sett_auth_sn_fb_app_id) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_auth_sn_fb_app_id'] = $this->sett_auth_sn_fb_app_id;
      }
      if (isset($this->sett_auth_sn_fb_secret) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_auth_sn_fb_secret'] = $this->sett_auth_sn_fb_secret;
      }
      if (isset($this->sett_auth_sn_x_key) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_auth_sn_x_key'] = $this->sett_auth_sn_x_key;
      }
      if (isset($this->sett_auth_sn_x_secret) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_auth_sn_x_secret'] = $this->sett_auth_sn_x_secret;
      }
      if (isset($this->sett_auth_sn_google_client_id) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_auth_sn_google_client_id'] = $this->sett_auth_sn_google_client_id;
      }
      if (isset($this->sett_auth_sn_google_secret) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['sett_auth_sn_google_secret'] = $this->sett_auth_sn_google_secret;
      }
      if (isset($_POST["facebook_error_code"]) && isset($this->facebook_error_code)) 
      {
          $_SESSION['facebook_error_code'] = $this->facebook_error_code;
      }
      if (isset($_POST["facebook_error_msg"]) && isset($this->facebook_error_msg)) 
      {
          $_SESSION['facebook_error_msg'] = $this->facebook_error_msg;
      }
      if (isset($_POST["facebook_user"]) && isset($this->facebook_user)) 
      {
          $_SESSION['facebook_user'] = $this->facebook_user;
      }
      if (isset($_POST["facebook_email"]) && isset($this->facebook_email)) 
      {
          $_SESSION['facebook_email'] = $this->facebook_email;
      }
      if (isset($_POST["facebook_name"]) && isset($this->facebook_name)) 
      {
          $_SESSION['facebook_name'] = $this->facebook_name;
      }
      if (isset($_POST["usr_login"]) && isset($this->usr_login)) 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($_POST["usr_priv_admin"]) && isset($this->usr_priv_admin)) 
      {
          $_SESSION['usr_priv_admin'] = $this->usr_priv_admin;
      }
      if (isset($_POST["usr_name"]) && isset($this->usr_name)) 
      {
          $_SESSION['usr_name'] = $this->usr_name;
      }
      if (isset($_POST["usr_email"]) && isset($this->usr_email)) 
      {
          $_SESSION['usr_email'] = $this->usr_email;
      }
      if (isset($_POST["usr_phone"]) && isset($this->usr_phone)) 
      {
          $_SESSION['usr_phone'] = $this->usr_phone;
      }
      if (isset($_POST["remember_me"]) && isset($this->remember_me)) 
      {
          $_SESSION['remember_me'] = $this->remember_me;
      }
      if (isset($_POST["usr_picture"]) && isset($this->usr_picture)) 
      {
          $_SESSION['usr_picture'] = $this->usr_picture;
      }
      if (isset($_POST["usr_groups"]) && isset($this->usr_groups)) 
      {
          $_SESSION['usr_groups'] = $this->usr_groups;
      }
      if (isset($_POST["sett_group_administrator"]) && isset($this->sett_group_administrator)) 
      {
          $_SESSION['sett_group_administrator'] = $this->sett_group_administrator;
      }
      if (isset($_POST["sett_enable_2fa"]) && isset($this->sett_enable_2fa)) 
      {
          $_SESSION['sett_enable_2fa'] = $this->sett_enable_2fa;
      }
      if (isset($_POST["sett_mfa_last_updated"]) && isset($this->sett_mfa_last_updated)) 
      {
          $_SESSION['sett_mfa_last_updated'] = $this->sett_mfa_last_updated;
      }
      if (isset($_POST["sett_enable_2fa_mode"]) && isset($this->sett_enable_2fa_mode)) 
      {
          $_SESSION['sett_enable_2fa_mode'] = $this->sett_enable_2fa_mode;
      }
      if (isset($_POST["google_error_code"]) && isset($this->google_error_code)) 
      {
          $_SESSION['google_error_code'] = $this->google_error_code;
      }
      if (isset($_POST["google_error_msg"]) && isset($this->google_error_msg)) 
      {
          $_SESSION['google_error_msg'] = $this->google_error_msg;
      }
      if (isset($_POST["google_user"]) && isset($this->google_user)) 
      {
          $_SESSION['google_user'] = $this->google_user;
      }
      if (isset($_POST["google_email"]) && isset($this->google_email)) 
      {
          $_SESSION['google_email'] = $this->google_email;
      }
      if (isset($_POST["google_name"]) && isset($this->google_name)) 
      {
          $_SESSION['google_name'] = $this->google_name;
      }
      if (isset($_POST["sett_group_default"]) && isset($this->sett_group_default)) 
      {
          $_SESSION['sett_group_default'] = $this->sett_group_default;
      }
      if (isset($_POST["sett_smtp_api"]) && isset($this->sett_smtp_api)) 
      {
          $_SESSION['sett_smtp_api'] = $this->sett_smtp_api;
      }
      if (isset($_POST["sett_smtp"]) && isset($this->sett_smtp)) 
      {
          $_SESSION['sett_smtp'] = $this->sett_smtp;
      }
      if (isset($_POST["sett_smtp_server"]) && isset($this->sett_smtp_server)) 
      {
          $_SESSION['sett_smtp_server'] = $this->sett_smtp_server;
      }
      if (isset($_POST["sett_smtp_security"]) && isset($this->sett_smtp_security)) 
      {
          $_SESSION['sett_smtp_security'] = $this->sett_smtp_security;
      }
      if (isset($_POST["sett_smtp_port"]) && isset($this->sett_smtp_port)) 
      {
          $_SESSION['sett_smtp_port'] = $this->sett_smtp_port;
      }
      if (isset($_POST["sett_smtp_user"]) && isset($this->sett_smtp_user)) 
      {
          $_SESSION['sett_smtp_user'] = $this->sett_smtp_user;
      }
      if (isset($_POST["sett_smtp_pass"]) && isset($this->sett_smtp_pass)) 
      {
          $_SESSION['sett_smtp_pass'] = $this->sett_smtp_pass;
      }
      if (isset($_POST["sett_smtp_from_email"]) && isset($this->sett_smtp_from_email)) 
      {
          $_SESSION['sett_smtp_from_email'] = $this->sett_smtp_from_email;
      }
      if (isset($_POST["sett_smtp_from_name"]) && isset($this->sett_smtp_from_name)) 
      {
          $_SESSION['sett_smtp_from_name'] = $this->sett_smtp_from_name;
      }
      if (isset($_POST["sett_theme"]) && isset($this->sett_theme)) 
      {
          $_SESSION['sett_theme'] = $this->sett_theme;
      }
      if (isset($_POST["sett_captcha"]) && isset($this->sett_captcha)) 
      {
          $_SESSION['sett_captcha'] = $this->sett_captcha;
      }
      if (isset($_POST["logged_date_login"]) && isset($this->logged_date_login)) 
      {
          $_SESSION['logged_date_login'] = $this->logged_date_login;
      }
      if (isset($_POST["sett_remember_me"]) && isset($this->sett_remember_me)) 
      {
          $_SESSION['sett_remember_me'] = $this->sett_remember_me;
      }
      if (isset($_POST["return_msg_email_act"]) && isset($this->return_msg_email_act)) 
      {
          $_SESSION['return_msg_email_act'] = $this->return_msg_email_act;
      }
      if (isset($_POST["sett_new_users"]) && isset($this->sett_new_users)) 
      {
          $_SESSION['sett_new_users'] = $this->sett_new_users;
      }
      if (isset($_POST["sett_retrieve_password"]) && isset($this->sett_retrieve_password)) 
      {
          $_SESSION['sett_retrieve_password'] = $this->sett_retrieve_password;
      }
      if (isset($_POST["sett_language"]) && isset($this->sett_language)) 
      {
          $_SESSION['sett_language'] = $this->sett_language;
      }
      if (isset($_POST["sett_login_mode"]) && isset($this->sett_login_mode)) 
      {
          $_SESSION['sett_login_mode'] = $this->sett_login_mode;
      }
      if (isset($_POST["sett_brute_force"]) && isset($this->sett_brute_force)) 
      {
          $_SESSION['sett_brute_force'] = $this->sett_brute_force;
      }
      if (isset($_POST["sett_pswd_last_updated"]) && isset($this->sett_pswd_last_updated)) 
      {
          $_SESSION['sett_pswd_last_updated'] = $this->sett_pswd_last_updated;
      }
      if (isset($_POST["sett_cookie_expiration_time"]) && isset($this->sett_cookie_expiration_time)) 
      {
          $_SESSION['sett_cookie_expiration_time'] = $this->sett_cookie_expiration_time;
      }
      if (isset($_POST["sett_session_expire"]) && isset($this->sett_session_expire)) 
      {
          $_SESSION['sett_session_expire'] = $this->sett_session_expire;
      }
      if (isset($_POST["twitter_user"]) && isset($this->twitter_user)) 
      {
          $_SESSION['twitter_user'] = $this->twitter_user;
      }
      if (isset($_POST["twitter_email"]) && isset($this->twitter_email)) 
      {
          $_SESSION['twitter_email'] = $this->twitter_email;
      }
      if (isset($_POST["twitter_name"]) && isset($this->twitter_name)) 
      {
          $_SESSION['twitter_name'] = $this->twitter_name;
      }
      if (isset($_POST["google_photo"]) && isset($this->google_photo)) 
      {
          $_SESSION['google_photo'] = $this->google_photo;
      }
      if (isset($_POST["sett_auth_sn_fb"]) && isset($this->sett_auth_sn_fb)) 
      {
          $_SESSION['sett_auth_sn_fb'] = $this->sett_auth_sn_fb;
      }
      if (isset($_POST["sett_auth_sn_x"]) && isset($this->sett_auth_sn_x)) 
      {
          $_SESSION['sett_auth_sn_x'] = $this->sett_auth_sn_x;
      }
      if (isset($_POST["sett_auth_sn_google"]) && isset($this->sett_auth_sn_google)) 
      {
          $_SESSION['sett_auth_sn_google'] = $this->sett_auth_sn_google;
      }
      if (isset($_POST["sett_auth_sn_position"]) && isset($this->sett_auth_sn_position)) 
      {
          $_SESSION['sett_auth_sn_position'] = $this->sett_auth_sn_position;
      }
      if (isset($_POST["sett_auth_sn_fb_app_id"]) && isset($this->sett_auth_sn_fb_app_id)) 
      {
          $_SESSION['sett_auth_sn_fb_app_id'] = $this->sett_auth_sn_fb_app_id;
      }
      if (isset($_POST["sett_auth_sn_fb_secret"]) && isset($this->sett_auth_sn_fb_secret)) 
      {
          $_SESSION['sett_auth_sn_fb_secret'] = $this->sett_auth_sn_fb_secret;
      }
      if (isset($_POST["sett_auth_sn_x_key"]) && isset($this->sett_auth_sn_x_key)) 
      {
          $_SESSION['sett_auth_sn_x_key'] = $this->sett_auth_sn_x_key;
      }
      if (isset($_POST["sett_auth_sn_x_secret"]) && isset($this->sett_auth_sn_x_secret)) 
      {
          $_SESSION['sett_auth_sn_x_secret'] = $this->sett_auth_sn_x_secret;
      }
      if (isset($_POST["sett_auth_sn_google_client_id"]) && isset($this->sett_auth_sn_google_client_id)) 
      {
          $_SESSION['sett_auth_sn_google_client_id'] = $this->sett_auth_sn_google_client_id;
      }
      if (isset($_POST["sett_auth_sn_google_secret"]) && isset($this->sett_auth_sn_google_secret)) 
      {
          $_SESSION['sett_auth_sn_google_secret'] = $this->sett_auth_sn_google_secret;
      }
      if (isset($_GET["facebook_error_code"]) && isset($this->facebook_error_code)) 
      {
          $_SESSION['facebook_error_code'] = $this->facebook_error_code;
      }
      if (isset($_GET["facebook_error_msg"]) && isset($this->facebook_error_msg)) 
      {
          $_SESSION['facebook_error_msg'] = $this->facebook_error_msg;
      }
      if (isset($_GET["facebook_user"]) && isset($this->facebook_user)) 
      {
          $_SESSION['facebook_user'] = $this->facebook_user;
      }
      if (isset($_GET["facebook_email"]) && isset($this->facebook_email)) 
      {
          $_SESSION['facebook_email'] = $this->facebook_email;
      }
      if (isset($_GET["facebook_name"]) && isset($this->facebook_name)) 
      {
          $_SESSION['facebook_name'] = $this->facebook_name;
      }
      if (isset($_GET["usr_login"]) && isset($this->usr_login)) 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($_GET["usr_priv_admin"]) && isset($this->usr_priv_admin)) 
      {
          $_SESSION['usr_priv_admin'] = $this->usr_priv_admin;
      }
      if (isset($_GET["usr_name"]) && isset($this->usr_name)) 
      {
          $_SESSION['usr_name'] = $this->usr_name;
      }
      if (isset($_GET["usr_email"]) && isset($this->usr_email)) 
      {
          $_SESSION['usr_email'] = $this->usr_email;
      }
      if (isset($_GET["usr_phone"]) && isset($this->usr_phone)) 
      {
          $_SESSION['usr_phone'] = $this->usr_phone;
      }
      if (isset($_GET["remember_me"]) && isset($this->remember_me)) 
      {
          $_SESSION['remember_me'] = $this->remember_me;
      }
      if (isset($_GET["usr_picture"]) && isset($this->usr_picture)) 
      {
          $_SESSION['usr_picture'] = $this->usr_picture;
      }
      if (isset($_GET["usr_groups"]) && isset($this->usr_groups)) 
      {
          $_SESSION['usr_groups'] = $this->usr_groups;
      }
      if (isset($_GET["sett_group_administrator"]) && isset($this->sett_group_administrator)) 
      {
          $_SESSION['sett_group_administrator'] = $this->sett_group_administrator;
      }
      if (isset($_GET["sett_enable_2fa"]) && isset($this->sett_enable_2fa)) 
      {
          $_SESSION['sett_enable_2fa'] = $this->sett_enable_2fa;
      }
      if (isset($_GET["sett_mfa_last_updated"]) && isset($this->sett_mfa_last_updated)) 
      {
          $_SESSION['sett_mfa_last_updated'] = $this->sett_mfa_last_updated;
      }
      if (isset($_GET["sett_enable_2fa_mode"]) && isset($this->sett_enable_2fa_mode)) 
      {
          $_SESSION['sett_enable_2fa_mode'] = $this->sett_enable_2fa_mode;
      }
      if (isset($_GET["google_error_code"]) && isset($this->google_error_code)) 
      {
          $_SESSION['google_error_code'] = $this->google_error_code;
      }
      if (isset($_GET["google_error_msg"]) && isset($this->google_error_msg)) 
      {
          $_SESSION['google_error_msg'] = $this->google_error_msg;
      }
      if (isset($_GET["google_user"]) && isset($this->google_user)) 
      {
          $_SESSION['google_user'] = $this->google_user;
      }
      if (isset($_GET["google_email"]) && isset($this->google_email)) 
      {
          $_SESSION['google_email'] = $this->google_email;
      }
      if (isset($_GET["google_name"]) && isset($this->google_name)) 
      {
          $_SESSION['google_name'] = $this->google_name;
      }
      if (isset($_GET["sett_group_default"]) && isset($this->sett_group_default)) 
      {
          $_SESSION['sett_group_default'] = $this->sett_group_default;
      }
      if (isset($_GET["sett_smtp_api"]) && isset($this->sett_smtp_api)) 
      {
          $_SESSION['sett_smtp_api'] = $this->sett_smtp_api;
      }
      if (isset($_GET["sett_smtp"]) && isset($this->sett_smtp)) 
      {
          $_SESSION['sett_smtp'] = $this->sett_smtp;
      }
      if (isset($_GET["sett_smtp_server"]) && isset($this->sett_smtp_server)) 
      {
          $_SESSION['sett_smtp_server'] = $this->sett_smtp_server;
      }
      if (isset($_GET["sett_smtp_security"]) && isset($this->sett_smtp_security)) 
      {
          $_SESSION['sett_smtp_security'] = $this->sett_smtp_security;
      }
      if (isset($_GET["sett_smtp_port"]) && isset($this->sett_smtp_port)) 
      {
          $_SESSION['sett_smtp_port'] = $this->sett_smtp_port;
      }
      if (isset($_GET["sett_smtp_user"]) && isset($this->sett_smtp_user)) 
      {
          $_SESSION['sett_smtp_user'] = $this->sett_smtp_user;
      }
      if (isset($_GET["sett_smtp_pass"]) && isset($this->sett_smtp_pass)) 
      {
          $_SESSION['sett_smtp_pass'] = $this->sett_smtp_pass;
      }
      if (isset($_GET["sett_smtp_from_email"]) && isset($this->sett_smtp_from_email)) 
      {
          $_SESSION['sett_smtp_from_email'] = $this->sett_smtp_from_email;
      }
      if (isset($_GET["sett_smtp_from_name"]) && isset($this->sett_smtp_from_name)) 
      {
          $_SESSION['sett_smtp_from_name'] = $this->sett_smtp_from_name;
      }
      if (isset($_GET["sett_theme"]) && isset($this->sett_theme)) 
      {
          $_SESSION['sett_theme'] = $this->sett_theme;
      }
      if (isset($_GET["sett_captcha"]) && isset($this->sett_captcha)) 
      {
          $_SESSION['sett_captcha'] = $this->sett_captcha;
      }
      if (isset($_GET["logged_date_login"]) && isset($this->logged_date_login)) 
      {
          $_SESSION['logged_date_login'] = $this->logged_date_login;
      }
      if (isset($_GET["sett_remember_me"]) && isset($this->sett_remember_me)) 
      {
          $_SESSION['sett_remember_me'] = $this->sett_remember_me;
      }
      if (isset($_GET["return_msg_email_act"]) && isset($this->return_msg_email_act)) 
      {
          $_SESSION['return_msg_email_act'] = $this->return_msg_email_act;
      }
      if (isset($_GET["sett_new_users"]) && isset($this->sett_new_users)) 
      {
          $_SESSION['sett_new_users'] = $this->sett_new_users;
      }
      if (isset($_GET["sett_retrieve_password"]) && isset($this->sett_retrieve_password)) 
      {
          $_SESSION['sett_retrieve_password'] = $this->sett_retrieve_password;
      }
      if (isset($_GET["sett_language"]) && isset($this->sett_language)) 
      {
          $_SESSION['sett_language'] = $this->sett_language;
      }
      if (isset($_GET["sett_login_mode"]) && isset($this->sett_login_mode)) 
      {
          $_SESSION['sett_login_mode'] = $this->sett_login_mode;
      }
      if (isset($_GET["sett_brute_force"]) && isset($this->sett_brute_force)) 
      {
          $_SESSION['sett_brute_force'] = $this->sett_brute_force;
      }
      if (isset($_GET["sett_pswd_last_updated"]) && isset($this->sett_pswd_last_updated)) 
      {
          $_SESSION['sett_pswd_last_updated'] = $this->sett_pswd_last_updated;
      }
      if (isset($_GET["sett_cookie_expiration_time"]) && isset($this->sett_cookie_expiration_time)) 
      {
          $_SESSION['sett_cookie_expiration_time'] = $this->sett_cookie_expiration_time;
      }
      if (isset($_GET["sett_session_expire"]) && isset($this->sett_session_expire)) 
      {
          $_SESSION['sett_session_expire'] = $this->sett_session_expire;
      }
      if (isset($_GET["twitter_user"]) && isset($this->twitter_user)) 
      {
          $_SESSION['twitter_user'] = $this->twitter_user;
      }
      if (isset($_GET["twitter_email"]) && isset($this->twitter_email)) 
      {
          $_SESSION['twitter_email'] = $this->twitter_email;
      }
      if (isset($_GET["twitter_name"]) && isset($this->twitter_name)) 
      {
          $_SESSION['twitter_name'] = $this->twitter_name;
      }
      if (isset($_GET["google_photo"]) && isset($this->google_photo)) 
      {
          $_SESSION['google_photo'] = $this->google_photo;
      }
      if (isset($_GET["sett_auth_sn_fb"]) && isset($this->sett_auth_sn_fb)) 
      {
          $_SESSION['sett_auth_sn_fb'] = $this->sett_auth_sn_fb;
      }
      if (isset($_GET["sett_auth_sn_x"]) && isset($this->sett_auth_sn_x)) 
      {
          $_SESSION['sett_auth_sn_x'] = $this->sett_auth_sn_x;
      }
      if (isset($_GET["sett_auth_sn_google"]) && isset($this->sett_auth_sn_google)) 
      {
          $_SESSION['sett_auth_sn_google'] = $this->sett_auth_sn_google;
      }
      if (isset($_GET["sett_auth_sn_position"]) && isset($this->sett_auth_sn_position)) 
      {
          $_SESSION['sett_auth_sn_position'] = $this->sett_auth_sn_position;
      }
      if (isset($_GET["sett_auth_sn_fb_app_id"]) && isset($this->sett_auth_sn_fb_app_id)) 
      {
          $_SESSION['sett_auth_sn_fb_app_id'] = $this->sett_auth_sn_fb_app_id;
      }
      if (isset($_GET["sett_auth_sn_fb_secret"]) && isset($this->sett_auth_sn_fb_secret)) 
      {
          $_SESSION['sett_auth_sn_fb_secret'] = $this->sett_auth_sn_fb_secret;
      }
      if (isset($_GET["sett_auth_sn_x_key"]) && isset($this->sett_auth_sn_x_key)) 
      {
          $_SESSION['sett_auth_sn_x_key'] = $this->sett_auth_sn_x_key;
      }
      if (isset($_GET["sett_auth_sn_x_secret"]) && isset($this->sett_auth_sn_x_secret)) 
      {
          $_SESSION['sett_auth_sn_x_secret'] = $this->sett_auth_sn_x_secret;
      }
      if (isset($_GET["sett_auth_sn_google_client_id"]) && isset($this->sett_auth_sn_google_client_id)) 
      {
          $_SESSION['sett_auth_sn_google_client_id'] = $this->sett_auth_sn_google_client_id;
      }
      if (isset($_GET["sett_auth_sn_google_secret"]) && isset($this->sett_auth_sn_google_secret)) 
      {
          $_SESSION['sett_auth_sn_google_secret'] = $this->sett_auth_sn_google_secret;
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['app_Login']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['app_Login']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['app_Login']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['app_Login']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['app_Login']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['app_Login']['embutida_parms']);
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
                 nm_limpa_str_app_Login($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->facebook_error_code)) 
          {
              $_SESSION['facebook_error_code'] = $this->facebook_error_code;
          }
          if (isset($this->facebook_error_msg)) 
          {
              $_SESSION['facebook_error_msg'] = $this->facebook_error_msg;
          }
          if (isset($this->facebook_user)) 
          {
              $_SESSION['facebook_user'] = $this->facebook_user;
          }
          if (isset($this->facebook_email)) 
          {
              $_SESSION['facebook_email'] = $this->facebook_email;
          }
          if (isset($this->facebook_name)) 
          {
              $_SESSION['facebook_name'] = $this->facebook_name;
          }
          if (isset($this->usr_login)) 
          {
              $_SESSION['usr_login'] = $this->usr_login;
          }
          if (isset($this->usr_priv_admin)) 
          {
              $_SESSION['usr_priv_admin'] = $this->usr_priv_admin;
          }
          if (isset($this->usr_name)) 
          {
              $_SESSION['usr_name'] = $this->usr_name;
          }
          if (isset($this->usr_email)) 
          {
              $_SESSION['usr_email'] = $this->usr_email;
          }
          if (isset($this->usr_phone)) 
          {
              $_SESSION['usr_phone'] = $this->usr_phone;
          }
          if (isset($this->remember_me)) 
          {
              $_SESSION['remember_me'] = $this->remember_me;
          }
          if (isset($this->usr_picture)) 
          {
              $_SESSION['usr_picture'] = $this->usr_picture;
          }
          if (isset($this->usr_groups)) 
          {
              $_SESSION['usr_groups'] = $this->usr_groups;
          }
          if (isset($this->sett_group_administrator)) 
          {
              $_SESSION['sett_group_administrator'] = $this->sett_group_administrator;
          }
          if (isset($this->sett_enable_2fa)) 
          {
              $_SESSION['sett_enable_2fa'] = $this->sett_enable_2fa;
          }
          if (isset($this->sett_mfa_last_updated)) 
          {
              $_SESSION['sett_mfa_last_updated'] = $this->sett_mfa_last_updated;
          }
          if (isset($this->sett_enable_2fa_mode)) 
          {
              $_SESSION['sett_enable_2fa_mode'] = $this->sett_enable_2fa_mode;
          }
          if (isset($this->google_error_code)) 
          {
              $_SESSION['google_error_code'] = $this->google_error_code;
          }
          if (isset($this->google_error_msg)) 
          {
              $_SESSION['google_error_msg'] = $this->google_error_msg;
          }
          if (isset($this->google_user)) 
          {
              $_SESSION['google_user'] = $this->google_user;
          }
          if (isset($this->google_email)) 
          {
              $_SESSION['google_email'] = $this->google_email;
          }
          if (isset($this->google_name)) 
          {
              $_SESSION['google_name'] = $this->google_name;
          }
          if (isset($this->sett_group_default)) 
          {
              $_SESSION['sett_group_default'] = $this->sett_group_default;
          }
          if (isset($this->sett_smtp_api)) 
          {
              $_SESSION['sett_smtp_api'] = $this->sett_smtp_api;
          }
          if (isset($this->sett_smtp)) 
          {
              $_SESSION['sett_smtp'] = $this->sett_smtp;
          }
          if (isset($this->sett_smtp_server)) 
          {
              $_SESSION['sett_smtp_server'] = $this->sett_smtp_server;
          }
          if (isset($this->sett_smtp_security)) 
          {
              $_SESSION['sett_smtp_security'] = $this->sett_smtp_security;
          }
          if (isset($this->sett_smtp_port)) 
          {
              $_SESSION['sett_smtp_port'] = $this->sett_smtp_port;
          }
          if (isset($this->sett_smtp_user)) 
          {
              $_SESSION['sett_smtp_user'] = $this->sett_smtp_user;
          }
          if (isset($this->sett_smtp_pass)) 
          {
              $_SESSION['sett_smtp_pass'] = $this->sett_smtp_pass;
          }
          if (isset($this->sett_smtp_from_email)) 
          {
              $_SESSION['sett_smtp_from_email'] = $this->sett_smtp_from_email;
          }
          if (isset($this->sett_smtp_from_name)) 
          {
              $_SESSION['sett_smtp_from_name'] = $this->sett_smtp_from_name;
          }
          if (isset($this->sett_theme)) 
          {
              $_SESSION['sett_theme'] = $this->sett_theme;
          }
          if (isset($this->sett_captcha)) 
          {
              $_SESSION['sett_captcha'] = $this->sett_captcha;
          }
          if (isset($this->logged_date_login)) 
          {
              $_SESSION['logged_date_login'] = $this->logged_date_login;
          }
          if (isset($this->sett_remember_me)) 
          {
              $_SESSION['sett_remember_me'] = $this->sett_remember_me;
          }
          if (isset($this->return_msg_email_act)) 
          {
              $_SESSION['return_msg_email_act'] = $this->return_msg_email_act;
          }
          if (isset($this->sett_new_users)) 
          {
              $_SESSION['sett_new_users'] = $this->sett_new_users;
          }
          if (isset($this->sett_retrieve_password)) 
          {
              $_SESSION['sett_retrieve_password'] = $this->sett_retrieve_password;
          }
          if (isset($this->sett_language)) 
          {
              $_SESSION['sett_language'] = $this->sett_language;
          }
          if (isset($this->sett_login_mode)) 
          {
              $_SESSION['sett_login_mode'] = $this->sett_login_mode;
          }
          if (isset($this->sett_brute_force)) 
          {
              $_SESSION['sett_brute_force'] = $this->sett_brute_force;
          }
          if (isset($this->sett_pswd_last_updated)) 
          {
              $_SESSION['sett_pswd_last_updated'] = $this->sett_pswd_last_updated;
          }
          if (isset($this->sett_cookie_expiration_time)) 
          {
              $_SESSION['sett_cookie_expiration_time'] = $this->sett_cookie_expiration_time;
          }
          if (isset($this->sett_session_expire)) 
          {
              $_SESSION['sett_session_expire'] = $this->sett_session_expire;
          }
          if (isset($this->twitter_user)) 
          {
              $_SESSION['twitter_user'] = $this->twitter_user;
          }
          if (isset($this->twitter_email)) 
          {
              $_SESSION['twitter_email'] = $this->twitter_email;
          }
          if (isset($this->twitter_name)) 
          {
              $_SESSION['twitter_name'] = $this->twitter_name;
          }
          if (isset($this->google_photo)) 
          {
              $_SESSION['google_photo'] = $this->google_photo;
          }
          if (isset($this->sett_auth_sn_fb)) 
          {
              $_SESSION['sett_auth_sn_fb'] = $this->sett_auth_sn_fb;
          }
          if (isset($this->sett_auth_sn_x)) 
          {
              $_SESSION['sett_auth_sn_x'] = $this->sett_auth_sn_x;
          }
          if (isset($this->sett_auth_sn_google)) 
          {
              $_SESSION['sett_auth_sn_google'] = $this->sett_auth_sn_google;
          }
          if (isset($this->sett_auth_sn_position)) 
          {
              $_SESSION['sett_auth_sn_position'] = $this->sett_auth_sn_position;
          }
          if (isset($this->sett_auth_sn_fb_app_id)) 
          {
              $_SESSION['sett_auth_sn_fb_app_id'] = $this->sett_auth_sn_fb_app_id;
          }
          if (isset($this->sett_auth_sn_fb_secret)) 
          {
              $_SESSION['sett_auth_sn_fb_secret'] = $this->sett_auth_sn_fb_secret;
          }
          if (isset($this->sett_auth_sn_x_key)) 
          {
              $_SESSION['sett_auth_sn_x_key'] = $this->sett_auth_sn_x_key;
          }
          if (isset($this->sett_auth_sn_x_secret)) 
          {
              $_SESSION['sett_auth_sn_x_secret'] = $this->sett_auth_sn_x_secret;
          }
          if (isset($this->sett_auth_sn_google_client_id)) 
          {
              $_SESSION['sett_auth_sn_google_client_id'] = $this->sett_auth_sn_google_client_id;
          }
          if (isset($this->sett_auth_sn_google_secret)) 
          {
              $_SESSION['sett_auth_sn_google_secret'] = $this->sett_auth_sn_google_secret;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['app_Login']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['app_Login']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['app_Login']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['app_Login']['sc_redir_insert'] = $this->sc_redir_insert;
          }
          if (isset($this->facebook_error_code)) 
          {
              $_SESSION['facebook_error_code'] = $this->facebook_error_code;
          }
          if (isset($this->facebook_error_msg)) 
          {
              $_SESSION['facebook_error_msg'] = $this->facebook_error_msg;
          }
          if (isset($this->facebook_user)) 
          {
              $_SESSION['facebook_user'] = $this->facebook_user;
          }
          if (isset($this->facebook_email)) 
          {
              $_SESSION['facebook_email'] = $this->facebook_email;
          }
          if (isset($this->facebook_name)) 
          {
              $_SESSION['facebook_name'] = $this->facebook_name;
          }
          if (isset($this->usr_login)) 
          {
              $_SESSION['usr_login'] = $this->usr_login;
          }
          if (isset($this->usr_priv_admin)) 
          {
              $_SESSION['usr_priv_admin'] = $this->usr_priv_admin;
          }
          if (isset($this->usr_name)) 
          {
              $_SESSION['usr_name'] = $this->usr_name;
          }
          if (isset($this->usr_email)) 
          {
              $_SESSION['usr_email'] = $this->usr_email;
          }
          if (isset($this->usr_phone)) 
          {
              $_SESSION['usr_phone'] = $this->usr_phone;
          }
          if (isset($this->remember_me)) 
          {
              $_SESSION['remember_me'] = $this->remember_me;
          }
          if (isset($this->usr_picture)) 
          {
              $_SESSION['usr_picture'] = $this->usr_picture;
          }
          if (isset($this->usr_groups)) 
          {
              $_SESSION['usr_groups'] = $this->usr_groups;
          }
          if (isset($this->sett_group_administrator)) 
          {
              $_SESSION['sett_group_administrator'] = $this->sett_group_administrator;
          }
          if (isset($this->sett_enable_2fa)) 
          {
              $_SESSION['sett_enable_2fa'] = $this->sett_enable_2fa;
          }
          if (isset($this->sett_mfa_last_updated)) 
          {
              $_SESSION['sett_mfa_last_updated'] = $this->sett_mfa_last_updated;
          }
          if (isset($this->sett_enable_2fa_mode)) 
          {
              $_SESSION['sett_enable_2fa_mode'] = $this->sett_enable_2fa_mode;
          }
          if (isset($this->google_error_code)) 
          {
              $_SESSION['google_error_code'] = $this->google_error_code;
          }
          if (isset($this->google_error_msg)) 
          {
              $_SESSION['google_error_msg'] = $this->google_error_msg;
          }
          if (isset($this->google_user)) 
          {
              $_SESSION['google_user'] = $this->google_user;
          }
          if (isset($this->google_email)) 
          {
              $_SESSION['google_email'] = $this->google_email;
          }
          if (isset($this->google_name)) 
          {
              $_SESSION['google_name'] = $this->google_name;
          }
          if (isset($this->sett_group_default)) 
          {
              $_SESSION['sett_group_default'] = $this->sett_group_default;
          }
          if (isset($this->sett_smtp_api)) 
          {
              $_SESSION['sett_smtp_api'] = $this->sett_smtp_api;
          }
          if (isset($this->sett_smtp)) 
          {
              $_SESSION['sett_smtp'] = $this->sett_smtp;
          }
          if (isset($this->sett_smtp_server)) 
          {
              $_SESSION['sett_smtp_server'] = $this->sett_smtp_server;
          }
          if (isset($this->sett_smtp_security)) 
          {
              $_SESSION['sett_smtp_security'] = $this->sett_smtp_security;
          }
          if (isset($this->sett_smtp_port)) 
          {
              $_SESSION['sett_smtp_port'] = $this->sett_smtp_port;
          }
          if (isset($this->sett_smtp_user)) 
          {
              $_SESSION['sett_smtp_user'] = $this->sett_smtp_user;
          }
          if (isset($this->sett_smtp_pass)) 
          {
              $_SESSION['sett_smtp_pass'] = $this->sett_smtp_pass;
          }
          if (isset($this->sett_smtp_from_email)) 
          {
              $_SESSION['sett_smtp_from_email'] = $this->sett_smtp_from_email;
          }
          if (isset($this->sett_smtp_from_name)) 
          {
              $_SESSION['sett_smtp_from_name'] = $this->sett_smtp_from_name;
          }
          if (isset($this->sett_theme)) 
          {
              $_SESSION['sett_theme'] = $this->sett_theme;
          }
          if (isset($this->sett_captcha)) 
          {
              $_SESSION['sett_captcha'] = $this->sett_captcha;
          }
          if (isset($this->logged_date_login)) 
          {
              $_SESSION['logged_date_login'] = $this->logged_date_login;
          }
          if (isset($this->sett_remember_me)) 
          {
              $_SESSION['sett_remember_me'] = $this->sett_remember_me;
          }
          if (isset($this->return_msg_email_act)) 
          {
              $_SESSION['return_msg_email_act'] = $this->return_msg_email_act;
          }
          if (isset($this->sett_new_users)) 
          {
              $_SESSION['sett_new_users'] = $this->sett_new_users;
          }
          if (isset($this->sett_retrieve_password)) 
          {
              $_SESSION['sett_retrieve_password'] = $this->sett_retrieve_password;
          }
          if (isset($this->sett_language)) 
          {
              $_SESSION['sett_language'] = $this->sett_language;
          }
          if (isset($this->sett_login_mode)) 
          {
              $_SESSION['sett_login_mode'] = $this->sett_login_mode;
          }
          if (isset($this->sett_brute_force)) 
          {
              $_SESSION['sett_brute_force'] = $this->sett_brute_force;
          }
          if (isset($this->sett_pswd_last_updated)) 
          {
              $_SESSION['sett_pswd_last_updated'] = $this->sett_pswd_last_updated;
          }
          if (isset($this->sett_cookie_expiration_time)) 
          {
              $_SESSION['sett_cookie_expiration_time'] = $this->sett_cookie_expiration_time;
          }
          if (isset($this->sett_session_expire)) 
          {
              $_SESSION['sett_session_expire'] = $this->sett_session_expire;
          }
          if (isset($this->twitter_user)) 
          {
              $_SESSION['twitter_user'] = $this->twitter_user;
          }
          if (isset($this->twitter_email)) 
          {
              $_SESSION['twitter_email'] = $this->twitter_email;
          }
          if (isset($this->twitter_name)) 
          {
              $_SESSION['twitter_name'] = $this->twitter_name;
          }
          if (isset($this->google_photo)) 
          {
              $_SESSION['google_photo'] = $this->google_photo;
          }
          if (isset($this->sett_auth_sn_fb)) 
          {
              $_SESSION['sett_auth_sn_fb'] = $this->sett_auth_sn_fb;
          }
          if (isset($this->sett_auth_sn_x)) 
          {
              $_SESSION['sett_auth_sn_x'] = $this->sett_auth_sn_x;
          }
          if (isset($this->sett_auth_sn_google)) 
          {
              $_SESSION['sett_auth_sn_google'] = $this->sett_auth_sn_google;
          }
          if (isset($this->sett_auth_sn_position)) 
          {
              $_SESSION['sett_auth_sn_position'] = $this->sett_auth_sn_position;
          }
          if (isset($this->sett_auth_sn_fb_app_id)) 
          {
              $_SESSION['sett_auth_sn_fb_app_id'] = $this->sett_auth_sn_fb_app_id;
          }
          if (isset($this->sett_auth_sn_fb_secret)) 
          {
              $_SESSION['sett_auth_sn_fb_secret'] = $this->sett_auth_sn_fb_secret;
          }
          if (isset($this->sett_auth_sn_x_key)) 
          {
              $_SESSION['sett_auth_sn_x_key'] = $this->sett_auth_sn_x_key;
          }
          if (isset($this->sett_auth_sn_x_secret)) 
          {
              $_SESSION['sett_auth_sn_x_secret'] = $this->sett_auth_sn_x_secret;
          }
          if (isset($this->sett_auth_sn_google_client_id)) 
          {
              $_SESSION['sett_auth_sn_google_client_id'] = $this->sett_auth_sn_google_client_id;
          }
          if (isset($this->sett_auth_sn_google_secret)) 
          {
              $_SESSION['sett_auth_sn_google_secret'] = $this->sett_auth_sn_google_secret;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['app_Login']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['app_Login']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['app_Login']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['app_Login']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['app_Login']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['app_Login']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['app_Login']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['app_Login']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['app_Login']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['app_Login']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new app_Login_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("en_us");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['initialize'])
          {
              $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
  if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_form_add_users']))
{
unset($_SESSION['scriptcase']['sc_apl_conf']['app_form_add_users']);
}
;
if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_retrieve_pswd']))
{
unset($_SESSION['scriptcase']['sc_apl_conf']['app_retrieve_pswd']);
}
;

$this->get_settings();
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("en_us");
      } 
      $_SESSION['sc_session'][$script_case_init]['app_Login']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['app_Login']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['app_Login'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['app_Login']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['app_Login']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('app_Login') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['app_Login']['label'] = "Login";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "app_Login")
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
      $this->nm_new_label['login'] = '' . $this->Ini->Nm_lang['lang_sec_users_fild_login'] . '';
      $this->nm_new_label['pswd'] = '' . $this->Ini->Nm_lang['lang_sec_users_fild_pswd'] . '';
      $this->nm_new_label['language'] = '' . $this->Ini->Nm_lang['lang_btns_lang'] . '';

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
        if ($this->use_100perc_fields) {
            $this->classes_100perc_fields['table'] = ' sc-ui-100perc-table';
            $this->classes_100perc_fields['input'] = ' sc-ui-100perc-input';
            $this->classes_100perc_fields['span_input'] = ' sc-ui-100perc-span-input';
            $this->classes_100perc_fields['span_select'] = ' sc-ui-100perc-span-select';
            $this->classes_100perc_fields['style_category'] = ' style="width: 100%"';
            $this->classes_100perc_fields['keep_field_size'] = false;
        }



      $_SESSION['scriptcase']['error_icon']['app_Login']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Lemon__NM__nm_scriptcase9_Lemon_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['app_Login'] = "";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "off";
      $this->nmgp_botoes['ok'] = "on";
      $this->nmgp_botoes['facebook'] = "on";
      $this->nmgp_botoes['google'] = "on";
      $this->nmgp_botoes['twitter'] = "on";
      $this->nmgp_botoes['paypal'] = "off";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['app_Login'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['app_Login'];

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

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_form'];
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("app_Login", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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

      if (is_file($this->Ini->path_aplicacao . 'app_Login_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'app_Login_help.txt');
          if ($arr_link_webhelp)
          {
              foreach ($arr_link_webhelp as $str_link_webhelp)
              {
                  $str_link_webhelp = trim($str_link_webhelp);
                  if ('contr:' == substr($str_link_webhelp, 0, 6))
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
          require_once($this->Ini->path_embutida . 'app_Login/app_Login_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "app_Login_erro.class.php"); 
      }
      $this->Erro      = new app_Login_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      $this->NM_case_insensitive = false;
      $this->sc_evento = $this->nmgp_opcao;
      if (!isset($this->NM_ajax_flag) || ('validate_' != substr($this->NM_ajax_opcao, 0, 9) && 'add_new_line' != $this->NM_ajax_opcao && 'autocomp_' != substr($this->NM_ajax_opcao, 0, 9)))
      {
      $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_remember_me = $this->remember_me;
}
if (!isset($this->sc_temp_sett_remember_me)) {$this->sc_temp_sett_remember_me = (isset($_SESSION['sett_remember_me'])) ? $_SESSION['sett_remember_me'] : "";}
if (!isset($this->sc_temp_logged_date_login)) {$this->sc_temp_logged_date_login = (isset($_SESSION['logged_date_login'])) ? $_SESSION['logged_date_login'] : "";}
if (!isset($this->sc_temp_sett_captcha)) {$this->sc_temp_sett_captcha = (isset($_SESSION['sett_captcha'])) ? $_SESSION['sett_captcha'] : "";}
if (!isset($this->sc_temp_sett_theme)) {$this->sc_temp_sett_theme = (isset($_SESSION['sett_theme'])) ? $_SESSION['sett_theme'] : "";}
if (!isset($this->sc_temp_sett_smtp_from_name)) {$this->sc_temp_sett_smtp_from_name = (isset($_SESSION['sett_smtp_from_name'])) ? $_SESSION['sett_smtp_from_name'] : "";}
if (!isset($this->sc_temp_sett_smtp_from_email)) {$this->sc_temp_sett_smtp_from_email = (isset($_SESSION['sett_smtp_from_email'])) ? $_SESSION['sett_smtp_from_email'] : "";}
if (!isset($this->sc_temp_sett_smtp_pass)) {$this->sc_temp_sett_smtp_pass = (isset($_SESSION['sett_smtp_pass'])) ? $_SESSION['sett_smtp_pass'] : "";}
if (!isset($this->sc_temp_sett_smtp_user)) {$this->sc_temp_sett_smtp_user = (isset($_SESSION['sett_smtp_user'])) ? $_SESSION['sett_smtp_user'] : "";}
if (!isset($this->sc_temp_sett_smtp_port)) {$this->sc_temp_sett_smtp_port = (isset($_SESSION['sett_smtp_port'])) ? $_SESSION['sett_smtp_port'] : "";}
if (!isset($this->sc_temp_sett_smtp_security)) {$this->sc_temp_sett_smtp_security = (isset($_SESSION['sett_smtp_security'])) ? $_SESSION['sett_smtp_security'] : "";}
if (!isset($this->sc_temp_sett_smtp_server)) {$this->sc_temp_sett_smtp_server = (isset($_SESSION['sett_smtp_server'])) ? $_SESSION['sett_smtp_server'] : "";}
if (!isset($this->sc_temp_sett_smtp)) {$this->sc_temp_sett_smtp = (isset($_SESSION['sett_smtp'])) ? $_SESSION['sett_smtp'] : "";}
if (!isset($this->sc_temp_sett_smtp_api)) {$this->sc_temp_sett_smtp_api = (isset($_SESSION['sett_smtp_api'])) ? $_SESSION['sett_smtp_api'] : "";}
if (!isset($this->sc_temp_usr_picture)) {$this->sc_temp_usr_picture = (isset($_SESSION['usr_picture'])) ? $_SESSION['usr_picture'] : "";}
if (!isset($this->sc_temp_usr_phone)) {$this->sc_temp_usr_phone = (isset($_SESSION['usr_phone'])) ? $_SESSION['usr_phone'] : "";}
if (!isset($this->sc_temp_usr_name)) {$this->sc_temp_usr_name = (isset($_SESSION['usr_name'])) ? $_SESSION['usr_name'] : "";}
if (!isset($this->sc_temp_usr_email)) {$this->sc_temp_usr_email = (isset($_SESSION['usr_email'])) ? $_SESSION['usr_email'] : "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  if($this->sc_temp_sett_smtp_api == 'custom'){
	$this->sc_temp_sett_smtp = array(
		'settings' => array(
			'gateway'       => 'smtp',
			'smtp_server'   => $this->sc_temp_sett_smtp_server,
			'smtp_protocol' => $this->sc_temp_sett_smtp_security,
			'smtp_port'     => $this->sc_temp_sett_smtp_port,
			'smtp_user'     => $this->sc_temp_sett_smtp_user,
			'smtp_password' => $this->sc_temp_sett_smtp_pass,
			'from_email'    => $this->sc_temp_sett_smtp_from_email,
			'from_name'     => $this->sc_temp_sett_smtp_from_name,
		)
	);
}else{
	$this->sc_temp_sett_smtp = array('profile' => $_SESSION['sett_smtp_api']);
}

$this->Ini->sc_set_schema('$this->sc_temp_sett_theme');;

if($this->sc_temp_sett_captcha == 'Y'){
    $this->nmgp_captcha_display = '';
$_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['captcha_display'] = $this->nmgp_captcha_display;
;
}else{
    $this->nmgp_captcha_display = 'none';
$_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['captcha_display'] = $this->nmgp_captcha_display;
;
}


$this->sc_looged_check_logout();
$date_login = (isset($this->sc_temp_logged_date_login)? $this->sc_temp_logged_date_login : '');
$this->sc_logged_out($this->sc_temp_usr_login, $date_login);
unset($_SESSION['scriptcase']['sc_apl_seg']);unset($_SESSION['scriptcase']['pass']);unset($_SESSION['usr_login']);
 unset($this->sc_temp_usr_login);
 unset($_SESSION['usr_email']);
 unset($this->sc_temp_usr_email);
 unset($_SESSION['usr_name']);
 unset($this->sc_temp_usr_name);
 unset($_SESSION['usr_phone']);
 unset($this->sc_temp_usr_phone);
 unset($_SESSION['usr_picture']);
 unset($this->sc_temp_usr_picture);
;

if(isset($this->sc_temp_sett_remember_me) && $this->sc_temp_sett_remember_me == 'Y'){
    $this->remember_me_init();
}
else{ 
    $this->nmgp_cmp_hidden["remember_me"] = 'off'; $this->NM_ajax_info['fieldDisplay']['remember_me'] = 'off';
}
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
if (isset($this->sc_temp_usr_phone)) { $_SESSION['usr_phone'] = $this->sc_temp_usr_phone;}
if (isset($this->sc_temp_usr_picture)) { $_SESSION['usr_picture'] = $this->sc_temp_usr_picture;}
if (isset($this->sc_temp_sett_smtp_api)) { $_SESSION['sett_smtp_api'] = $this->sc_temp_sett_smtp_api;}
if (isset($this->sc_temp_sett_smtp)) { $_SESSION['sett_smtp'] = $this->sc_temp_sett_smtp;}
if (isset($this->sc_temp_sett_smtp_server)) { $_SESSION['sett_smtp_server'] = $this->sc_temp_sett_smtp_server;}
if (isset($this->sc_temp_sett_smtp_security)) { $_SESSION['sett_smtp_security'] = $this->sc_temp_sett_smtp_security;}
if (isset($this->sc_temp_sett_smtp_port)) { $_SESSION['sett_smtp_port'] = $this->sc_temp_sett_smtp_port;}
if (isset($this->sc_temp_sett_smtp_user)) { $_SESSION['sett_smtp_user'] = $this->sc_temp_sett_smtp_user;}
if (isset($this->sc_temp_sett_smtp_pass)) { $_SESSION['sett_smtp_pass'] = $this->sc_temp_sett_smtp_pass;}
if (isset($this->sc_temp_sett_smtp_from_email)) { $_SESSION['sett_smtp_from_email'] = $this->sc_temp_sett_smtp_from_email;}
if (isset($this->sc_temp_sett_smtp_from_name)) { $_SESSION['sett_smtp_from_name'] = $this->sc_temp_sett_smtp_from_name;}
if (isset($this->sc_temp_sett_theme)) { $_SESSION['sett_theme'] = $this->sc_temp_sett_theme;}
if (isset($this->sc_temp_sett_captcha)) { $_SESSION['sett_captcha'] = $this->sc_temp_sett_captcha;}
if (isset($this->sc_temp_logged_date_login)) { $_SESSION['logged_date_login'] = $this->sc_temp_logged_date_login;}
if (isset($this->sc_temp_sett_remember_me)) { $_SESSION['sett_remember_me'] = $this->sc_temp_sett_remember_me;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_remember_me != $this->remember_me || (isset($bFlagRead_remember_me) && $bFlagRead_remember_me)))
    {
        $this->ajax_return_values_remember_me(true);
    }
}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off'; 
      }
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['app_Login']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['app_Login']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
        if (!isset($this->NM_ajax_flag) || ('validate_' != substr($this->NM_ajax_opcao, 0, 9) && 'add_new_line' != $this->NM_ajax_opcao))
        {
            if ((isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($this->nmgp_opcao) && 'facebook_login' == $this->nmgp_opcao) || (isset($_GET['code']) && isset($_GET['state'])) || (isset($_GET['error_code']) && isset($_GET['error_msg'])))
            {

include_once($this->Ini->path_third ."/facebookauth/src/Facebook/autoload.php");
if(!empty('' . $_SESSION['sett_auth_sn_fb_app_id'] . '') && !empty('' . $_SESSION['sett_auth_sn_fb_secret'] . ''))
{
$fb = new Facebook\Facebook([
  'app_id' => '' . $_SESSION['sett_auth_sn_fb_app_id'] . '', // Replace {app-id} with your app id
  'app_secret' => '' . $_SESSION['sett_auth_sn_fb_secret'] . '',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
if(!isset($_GET['code']))
{
    $loginUrl = $helper->getLoginUrl('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'], $permissions);
    header("Location: " . $loginUrl );
        exit;
}
elseif(strpos($_SERVER['QUERY_STRING'], 'googleapis') === false)
{
    try {
      $accessToken = $helper->getAccessToken();
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      $_SESSION['facebook_error_msg'] = 'Graph returned an error: ' . $e->getMessage();
      //exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
     $_SESSION['facebook_error_msg'] = 'Facebook SDK returned an error: ' . $e->getMessage();
      //exit;
    }

if (! isset($accessToken)) {
  if ($helper->getError()) {


    $_SESSION['facebook_error_code'] = $helper->getErrorCode();
    $_SESSION['facebook_error_msg'] = $helper->getErrorDescription();
  } /*else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;*/
}


// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();



$_SESSION['fb_access_token'] = (string) $accessToken;

$fb->setDefaultAccessToken($accessToken);
$response = $fb->get('/me');

$user = $response->getGraphUser();
$_SESSION['facebook_user']       = $user->getId();
$_SESSION['facebook_photo'] = 'https://graph.facebook.com/' . $user->getId() . '/picture';
$_SESSION['facebook_name']  = $user->getName();
$_SESSION['facebook_email']  = $user['email'];

$this->fb_return();
}
}
}
} include_once($this->Ini->path_third .'/../vendor/autoload.php');
        if (!isset($this->NM_ajax_flag) || ('validate_' != substr($this->NM_ajax_opcao, 0, 9) && 'add_new_line' != $this->NM_ajax_opcao))
        {
            if ((isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($this->nmgp_opcao) && 'google_login' == $this->nmgp_opcao) || (isset($_GET['code'])))
            {
                $this_script = 'http://';
                if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
                {
                    $this_script = 'https://';
                }
                $this_script .= $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$provider = new Google([
    'clientId'     => '' . $_SESSION['sett_auth_sn_google_client_id'] . '',
    'clientSecret' => '' . $_SESSION['sett_auth_sn_google_secret'] . '',
    'redirectUri'  => $this_script,
//    'hostedDomain' => 'example.com', // optional; used to restrict access to users on your G Suite/Google Apps for Business accounts
]);
$_SESSION['google_error_msg'] = '';
if (!empty($_GET['error'])) {

    // Got an error, probably user denied access
    $_SESSION['google_error_msg'] = ('Got error: ' . htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'));

} elseif (empty($_GET['code'])) {

    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);
    exit;

} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    // State is invalid, possible CSRF attack in progress
    unset($_SESSION['oauth2state']);
    $_SESSION['google_error_msg'] = ('Invalid state');

} else {
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);
    $_SESSION['google_user'] = '';
    $_SESSION['google_name'] = '';
    $_SESSION['google_photo'] = '';
    $_SESSION['google_email'] = '';
    // Optional: Now you have a token you can look up a users profile data
    try {

        // We got an access token, let's now get the owner details
        $ownerDetails = $provider->getResourceOwner($token);

        // Use these details to create a new profile
        $_SESSION['google_user'] = $ownerDetails->getId();
        $_SESSION['google_name'] = $ownerDetails->getName();
        $_SESSION['google_photo'] = $ownerDetails->getAvatar();
        $_SESSION['google_email'] = $ownerDetails->getEmail();
        $this->go_return();
    } catch (Exception $e) {

        // Failed to get user details
        $_SESSION['google_error_msg'] = ('Something went wrong: ' . $e->getMessage());

    }
    if(isset($_SESSION['google_error_msg'])){
        echo $_SESSION['google_error_msg'];
     }
}
}
}
        if (!isset($this->NM_ajax_flag) || ('validate_' != substr($this->NM_ajax_opcao, 0, 9) && 'add_new_line' != $this->NM_ajax_opcao))
        {
            if ((isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($this->nmgp_opcao) && 'twitter_login' == $this->nmgp_opcao) || (isset($_GET['oauth_token']) && isset($_GET['oauth_verifier'])))
            {
                define('CONSUMER_KEY',    '' . $_SESSION['sett_auth_sn_x_key'] . '');
                define('CONSUMER_SECRET', '' . $_SESSION['sett_auth_sn_x_secret'] . '');
                define('OAUTH_CALLBACK',  'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);

                include_once($this->Ini->path_third ."/twitteroauth/autoload.php");

                if (!isset($_GET['oauth_token']) || !isset($_GET['oauth_verifier'])) {
                    $twitterConnection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

                    $twitterRequestToken = $twitterConnection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

                    $_SESSION['oauth_token'] = $twitterRequestToken['oauth_token'];
                    $_SESSION['oauth_token_secret'] = $twitterRequestToken['oauth_token_secret'];

                    if ($twitterConnection->getLastHttpCode() == 200) {
                        header('Location: ' . $twitterConnection->url('oauth/authorize', array('oauth_token' => $twitterRequestToken['oauth_token'])));
                        exit;
                    }
                }
                else {
                    if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
                        echo "Error in settings of API";
                    }
                    else {
                        $twitterConnection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

                        $twitterAccessToken = $twitterConnection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
                        $_SESSION['access_token'] = $twitterAccessToken;

                        if (200 == $twitterConnection->getLastHttpCode()) {
                            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $twitterAccessToken['oauth_token'], $twitterAccessToken['oauth_token_secret']);
                            $twitterContent = $connection->get('account/verify_credentials',['include_email' => 'true']);

                            $_SESSION['twitter_user'] = $twitterContent->id;
                            $_SESSION['twitter_photo'] = $twitterContent->profile_image_url_https;
                            $_SESSION['twitter_name'] = $twitterContent->name;
                            $_SESSION['twitter_email'] = $twitterContent->email;
                            $this->tw_return();
                        }
                    }
                }
           }
       }      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
   }

   function controle()
   {
        global $nm_url_saida, $teste_validade, 
            $glo_senha_protect, $bok, $nm_apl_dependente, $nm_form_submit, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup, $nmgp_redir;


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
      if (!$this->NM_ajax_flag || 'alterar' != $this->nmgp_opcao || 'submit_form' != $this->NM_ajax_opcao)
      {
      }
//
//-----> 
//
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('validate_login' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'login');
          }
          if ('validate_pswd' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'pswd');
          }
          if ('validate_remember_me' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'remember_me');
          }
          if ('validate_new_user' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'new_user');
          }
          if ('validate_retrieve_pswd' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'retrieve_pswd');
          }
          if ('validate_language' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'language');
          }
          app_Login_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          if (is_array($this->remember_me))
          {
              $x = 0; 
              $this->remember_me_1 = $this->remember_me;
              $this->remember_me = ""; 
              if ($this->remember_me_1 != "") 
              { 
                  foreach ($this->remember_me_1 as $dados_remember_me_1 ) 
                  { 
                      if ($x != 0)
                      { 
                          $this->remember_me .= ";";
                      } 
                      $this->remember_me .= $dados_remember_me_1;
                      $x++ ; 
                  } 
              } 
          } 
          $this->nm_tira_formatacao();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              app_Login_pack_ajax_response();
              exit;
          }
          $this->nmgp_opcao = $nm_sc_sv_opcao; 
          $this->nm_gera_html();
          $this->NM_close_db(); 
          $this->nmgp_opcao = ""; 
          exit; 
      }
      if ($this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") 
      {
          $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          if ($this->nmgp_opcao != "incluir")
          {
              $this->scFormFocusErrorName = '';
          }
          $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  app_Login_pack_ajax_response();
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
          $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  app_Login_pack_ajax_response();
                  exit;
              }
              $campos_erro = $this->Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros);
              $this->Campos_Mens_erro = ""; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $campos_erro); 
              $this->nmgp_opc_ant = $this->nmgp_opcao ; 
              if ($this->nmgp_opcao == "incluir") 
              { 
                  $GLOBALS["erro_incl"] = 1; 
              }
              $this->nmgp_opcao = "nada" ; 
          }
      }
//
      if (!isset($nm_form_submit) && $this->nmgp_opcao != "nada")
      {
          $this->login = "" ;  
          $this->pswd = "" ;  
          $this->remember_me = "" ;  
          $this->new_user = "" ;  
          $this->retrieve_pswd = "" ;  
          $this->language = "" ;  
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_form']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_form']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_form'] as $NM_campo => $NM_valor)
              {
                  $$NM_campo = $NM_valor;
              }
          }
      }
      else
      {
           if ($this->nmgp_opcao != "nada")
           {
           }
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['recarga'] = $this->nmgp_opcao;
      }
      if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "" || $campos_erro != "" || !isset($this->bok) || $this->bok != "OK" || $this->nmgp_opcao == "recarga")
      {
          if ($Campos_Crit == "" && empty($Campos_Falta) && $this->Campos_Mens_erro == "" && !isset($this->bok) && $this->nmgp_opcao != "recarga")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos']))
              { 
                  $login = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'][0]; 
                  $pswd = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'][1]; 
                  $remember_me = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'][2]; 
                  $new_user = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'][3]; 
                  $retrieve_pswd = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'][4]; 
                  $language = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'][5]; 
              } 
          }
          $this->nm_gera_html();
          $this->NM_close_db(); 
      }
      elseif (isset($this->bok) && $this->bok == "OK")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'] = array(); 
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'][0] = $this->login; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'][1] = $this->pswd; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'][2] = $this->remember_me; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'][3] = $this->new_user; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'][4] = $this->retrieve_pswd; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'][5] = $this->language; 
          if (!empty($this->new_user))
          {
              $trab_saida = $this->new_user;
              $diretorio = explode("/", $trab_saida);
              if (count($diretorio) > 2 || count($diretorio) == 0 || strtolower(substr($this->new_user, 0, 7)) == "http://" || strtolower(substr($this->new_user, 0, 8)) == "https://" || strtolower(substr($this->new_user, 0, 3)) == "../")
              {
                  $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $trab_saida;
              }
              else
              {
                  if (count($diretorio) == 1)
                  {
                      $limpa_dir = 2;
                      $compoe_url = str_replace(".php", "", $trab_saida);
                      $trab_saida = SC_dir_app_name($compoe_url) . "/";
                  }
                  else
                  {
                     $limpa_dir = 3;
                     $trab_saida = $diretorio[0] . "/";
                     $compoe_url = str_replace(".php", "", $diretorio[1]);
                     $trab_saida .= $compoe_url . "/" . $compoe_url . ".php";
                  }
                  $trab_path             = explode("/", $_SERVER['PHP_SELF']);
                  $trab_count_path       = count($trab_path);
                  $path_retorno_aplicacao  = "";
                  for ($ix = 0; $ix + $limpa_dir < $trab_count_path; $ix++)
                  {
                       $path_retorno_aplicacao .=  $trab_path[$ix] . "/";
                  }
                  $path_retorno_aplicacao .=  $trab_saida;
                  $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['redir_target_name'] = $this->new_user_sc_target_name;
                  $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $path_retorno_aplicacao;
                  $nm_apl_dependente = 1; 
               }
               $this->NM_close_db(); 
               $this->nmgp_redireciona(); 
               exit;
           }
          if (!empty($this->retrieve_pswd))
          {
              $trab_saida = $this->retrieve_pswd;
              $diretorio = explode("/", $trab_saida);
              if (count($diretorio) > 2 || count($diretorio) == 0 || strtolower(substr($this->retrieve_pswd, 0, 7)) == "http://" || strtolower(substr($this->retrieve_pswd, 0, 8)) == "https://" || strtolower(substr($this->retrieve_pswd, 0, 3)) == "../")
              {
                  $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $trab_saida;
              }
              else
              {
                  if (count($diretorio) == 1)
                  {
                      $limpa_dir = 2;
                      $compoe_url = str_replace(".php", "", $trab_saida);
                      $trab_saida = SC_dir_app_name($compoe_url) . "/";
                  }
                  else
                  {
                     $limpa_dir = 3;
                     $trab_saida = $diretorio[0] . "/";
                     $compoe_url = str_replace(".php", "", $diretorio[1]);
                     $trab_saida .= $compoe_url . "/" . $compoe_url . ".php";
                  }
                  $trab_path             = explode("/", $_SERVER['PHP_SELF']);
                  $trab_count_path       = count($trab_path);
                  $path_retorno_aplicacao  = "";
                  for ($ix = 0; $ix + $limpa_dir < $trab_count_path; $ix++)
                  {
                       $path_retorno_aplicacao .=  $trab_path[$ix] . "/";
                  }
                  $path_retorno_aplicacao .=  $trab_saida;
                  $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['redir_target_name'] = $this->retrieve_pswd_sc_target_name;
                  $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $path_retorno_aplicacao;
                  $nm_apl_dependente = 1; 
               }
               $this->NM_close_db(); 
               $this->nmgp_redireciona(); 
               exit;
           }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['redir'] == "redir")
          {
              $this->nmgp_redireciona(); 
          }
          else
          {
              $contr_menu = "";
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['iframe_menu'])
              {
                  $contr_menu = "glo_menu";
              }
              if (isset($_SESSION['scriptcase']['sc_ult_apl_menu']) && in_array("app_Login", $_SESSION['scriptcase']['sc_ult_apl_menu']))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona_form("app_Login_fim.php", $this->nm_location, $contr_menu); 
              }
              elseif (!$this->NM_ajax_flag)
              {
                  $this->nm_gera_html();
                  if (!$_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_proc'])
                  { 
                      $this->NM_close_db(); 
                  } 
              }
          }
          $this->NM_close_db(); 
          if ($this->NM_ajax_flag)
          {
              app_Login_pack_ajax_response();
              exit;
          }
      }
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "app_Login.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("Login") ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
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
<form name="Fdown" method="get" action="app_Login_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="app_Login"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="./" target="_self" style="display: none"> 
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
           case 'login':
               return "" . $this->Ini->Nm_lang['lang_sec_users_fild_login'] . "";
               break;
           case 'pswd':
               return "" . $this->Ini->Nm_lang['lang_sec_users_fild_pswd'] . "";
               break;
           case 'remember_me':
               return "";
               break;
           case 'new_user':
               return "new_user";
               break;
           case 'retrieve_pswd':
               return "retrieve_pswd";
               break;
           case 'language':
               return "" . $this->Ini->Nm_lang['lang_btns_lang'] . "";
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
     $this->scFormFocusErrorName = '';
     $this->sc_force_zero = array();

     if (true && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['captcha_display']) || $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['captcha_display'] != 'none')) {
         include_once 'app_Login_securimage.php';
         $img_secur = new securimage();
         $valid = $img_secur->check($this->captcha_code);

         if (!$valid)
         {
             $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
             $this->Campos_Mens_erro .= "CAPTCHA: " . $this->Ini->Nm_lang['lang_othr_cptc_errm'] . "";
             if ($this->NM_ajax_flag)
             {
                 if (!isset($this->NM_ajax_info['errList']['geral_app_Login']) || !is_array($this->NM_ajax_info['errList']['geral_app_Login']))
                 {
                     $this->NM_ajax_info['errList']['geral_app_Login'] = array();
                 }
                 $this->NM_ajax_info['errList']['geral_app_Login'][] = "CAPTCHA: " . $this->Ini->Nm_lang['lang_othr_cptc_errm'] . "";
             }
         }
     }

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_app_Login']) || !is_array($this->NM_ajax_info['errList']['geral_app_Login']))
              {
                  $this->NM_ajax_info['errList']['geral_app_Login'] = array();
              }
              $this->NM_ajax_info['errList']['geral_app_Login'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'login' == $filtro)) || (is_array($filtro) && in_array('login', $filtro)))
        $this->ValidateField_login($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "login";

      if ((!is_array($filtro) && ('' == $filtro || 'pswd' == $filtro)) || (is_array($filtro) && in_array('pswd', $filtro)))
        $this->ValidateField_pswd($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "pswd";

      if ((!is_array($filtro) && ('' == $filtro || 'remember_me' == $filtro)) || (is_array($filtro) && in_array('remember_me', $filtro)))
        $this->ValidateField_remember_me($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "remember_me";

      if ((!is_array($filtro) && ('' == $filtro || 'new_user' == $filtro)) || (is_array($filtro) && in_array('new_user', $filtro)))
        $this->ValidateField_new_user($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "new_user";

      if ((!is_array($filtro) && ('' == $filtro || 'retrieve_pswd' == $filtro)) || (is_array($filtro) && in_array('retrieve_pswd', $filtro)))
        $this->ValidateField_retrieve_pswd($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "retrieve_pswd";

      if ((!is_array($filtro) && ('' == $filtro || 'language' == $filtro)) || (is_array($filtro) && in_array('language', $filtro)))
        $this->ValidateField_language($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "language";


      if (empty($Campos_Crit) && empty($Campos_Falta))
      {
      if (!isset($this->NM_ajax_flag) || 'validate_' != substr($this->NM_ajax_opcao, 0, 9))
      {
      $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_login = $this->login;
    $original_pswd = $this->pswd;
    $original_remember_me = $this->remember_me;
}
if (!isset($this->sc_temp_sett_enable_2fa_mode)) {$this->sc_temp_sett_enable_2fa_mode = (isset($_SESSION['sett_enable_2fa_mode'])) ? $_SESSION['sett_enable_2fa_mode'] : "";}
if (!isset($this->sc_temp_sett_mfa_last_updated)) {$this->sc_temp_sett_mfa_last_updated = (isset($_SESSION['sett_mfa_last_updated'])) ? $_SESSION['sett_mfa_last_updated'] : "";}
if (!isset($this->sc_temp_sett_enable_2fa)) {$this->sc_temp_sett_enable_2fa = (isset($_SESSION['sett_enable_2fa'])) ? $_SESSION['sett_enable_2fa'] : "";}
if (!isset($this->sc_temp_sett_pswd_last_updated)) {$this->sc_temp_sett_pswd_last_updated = (isset($_SESSION['sett_pswd_last_updated'])) ? $_SESSION['sett_pswd_last_updated'] : "";}
if (!isset($this->sc_temp_sett_group_administrator)) {$this->sc_temp_sett_group_administrator = (isset($_SESSION['sett_group_administrator'])) ? $_SESSION['sett_group_administrator'] : "";}
if (!isset($this->sc_temp_usr_groups)) {$this->sc_temp_usr_groups = (isset($_SESSION['usr_groups'])) ? $_SESSION['usr_groups'] : "";}
if (!isset($this->sc_temp_usr_picture)) {$this->sc_temp_usr_picture = (isset($_SESSION['usr_picture'])) ? $_SESSION['usr_picture'] : "";}
if (!isset($this->sc_temp_remember_me)) {$this->sc_temp_remember_me = (isset($_SESSION['remember_me'])) ? $_SESSION['remember_me'] : "";}
if (!isset($this->sc_temp_usr_phone)) {$this->sc_temp_usr_phone = (isset($_SESSION['usr_phone'])) ? $_SESSION['usr_phone'] : "";}
if (!isset($this->sc_temp_usr_email)) {$this->sc_temp_usr_email = (isset($_SESSION['usr_email'])) ? $_SESSION['usr_email'] : "";}
if (!isset($this->sc_temp_usr_name)) {$this->sc_temp_usr_name = (isset($_SESSION['usr_name'])) ? $_SESSION['usr_name'] : "";}
if (!isset($this->sc_temp_usr_priv_admin)) {$this->sc_temp_usr_priv_admin = (isset($_SESSION['usr_priv_admin'])) ? $_SESSION['usr_priv_admin'] : "";}
if (!isset($this->sc_temp_sett_login_mode)) {$this->sc_temp_sett_login_mode = (isset($_SESSION['sett_login_mode'])) ? $_SESSION['sett_login_mode'] : "";}
if (!isset($this->sc_temp_sett_brute_force)) {$this->sc_temp_sett_brute_force = (isset($_SESSION['sett_brute_force'])) ? $_SESSION['sett_brute_force'] : "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  if($this->sc_temp_sett_brute_force == 'Y' && $this->sc_logged_is_blocked()) { if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
 if (isset($this->sc_temp_sett_brute_force)) { $_SESSION['sett_brute_force'] = $this->sc_temp_sett_brute_force;}
 if (isset($this->sc_temp_sett_login_mode)) { $_SESSION['sett_login_mode'] = $this->sc_temp_sett_login_mode;}
 if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
 if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
 if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
 if (isset($this->sc_temp_usr_phone)) { $_SESSION['usr_phone'] = $this->sc_temp_usr_phone;}
 if (isset($this->sc_temp_remember_me)) { $_SESSION['remember_me'] = $this->sc_temp_remember_me;}
 if (isset($this->sc_temp_usr_picture)) { $_SESSION['usr_picture'] = $this->sc_temp_usr_picture;}
 if (isset($this->sc_temp_usr_groups)) { $_SESSION['usr_groups'] = $this->sc_temp_usr_groups;}
 if (isset($this->sc_temp_sett_group_administrator)) { $_SESSION['sett_group_administrator'] = $this->sc_temp_sett_group_administrator;}
 if (isset($this->sc_temp_sett_pswd_last_updated)) { $_SESSION['sett_pswd_last_updated'] = $this->sc_temp_sett_pswd_last_updated;}
 if (isset($this->sc_temp_sett_enable_2fa)) { $_SESSION['sett_enable_2fa'] = $this->sc_temp_sett_enable_2fa;}
 if (isset($this->sc_temp_sett_mfa_last_updated)) { $_SESSION['sett_mfa_last_updated'] = $this->sc_temp_sett_mfa_last_updated;}
 if (isset($this->sc_temp_sett_enable_2fa_mode)) { $_SESSION['sett_enable_2fa_mode'] = $this->sc_temp_sett_enable_2fa_mode;}
    $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
    return;
}
}


$slogin = $this->Db->qstr($this->login );
$spswd = $this->Db->qstr(hash("sha512",$this->pswd ));

switch( $this->sc_temp_sett_login_mode ){
	default:
	case 'username':
		$str_login_validate = "login =". $slogin;
		break;
	case 'email':
		$str_login_validate = "email =". $slogin;
		break;
	case 'both':
		$str_login_validate = "(login =". $slogin . " OR email =".$slogin . ")";
		break;
}


$sql = "SELECT 
			priv_admin,
			active, 
			name, 
			email, 
			mfa, 
			pswd_last_updated,
			login,
			phone,
			picture,
            mfa_last_updated
	    FROM sec_users 
	    WHERE
			".$str_login_validate."
			AND pswd = ".$spswd."";
	
 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 

	
if ( ($this->rs === false) || (!is_array($this->rs) ) || (empty($this->rs)) )
{
	;
	$this->sc_logged_in_fail($this->login );
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .=  $this->Ini->Nm_lang['lang_error_login'] ;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_app_Login';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_app_Login';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] =  $this->Ini->Nm_lang['lang_error_login'] ;
 }
;
}
else if($this->rs[0][1] == 'Y')
{
	$this->sc_temp_usr_login		= $this->rs[0][6];
	$this->sc_temp_usr_priv_admin 	= ($this->rs[0][0] == 'Y') ? TRUE : FALSE;
	$this->sc_temp_usr_name		= $this->rs[0][2];
	$this->sc_temp_usr_email		= $this->rs[0][3];
	$this->sc_temp_usr_phone		= $this->rs[0][7];
    $this->sc_temp_remember_me = $this->remember_me ;
    $this->sc_temp_usr_picture = '';
    
	$usr_grp = array();
    
	 
      $nm_select = "SELECT group_id FROM sec_users_groups WHERE login =". $this->Db->qstr($this->sc_temp_usr_login); 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs_groups = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 $SCrx->fields[0] = str_replace(',', '.', $SCrx->fields[0]);
                 $SCrx->fields[0] = (strpos(strtolower($SCrx->fields[0]), "e")) ? (float)$SCrx->fields[0] : $SCrx->fields[0];
                 $SCrx->fields[0] = (string)$SCrx->fields[0];
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs_groups[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs_groups = false;
          $this->rs_groups_erro = $this->Db->ErrorMsg();
      } 

	
	if(isset($this->rs_groups[0][0])){
		foreach($this->rs_groups  as $r){
			$usr_grp[] = $r[0];
		}
	}
	
	$this->sc_temp_usr_groups = $usr_grp;
	
	if(in_array($this->sc_temp_sett_group_administrator, $this->sc_temp_usr_groups)){
		$this->sc_temp_usr_priv_admin = TRUE;
	}
	
	
	
    
    if(!empty($this->rs[0][8])){
        
        $path_img = $_SESSION['scriptcase']['app_Login']['glo_nm_path_imag_temp'] .'/sc_img_'. $this->sc_temp_usr_login . hash("sha512",date('YmdHis')) . '.png';
        file_put_contents($this->Ini->root . $path_img, $this->rs[0][8]);
        $this->sc_temp_usr_picture = $path_img;
    }
	
	if( $this->sc_temp_sett_pswd_last_updated != 0 ){
		$diff = $this->nm_data->Dif_Datas(date("Y-m-d", strtotime($this->rs[0][5] . " +".$this->sc_temp_sett_pswd_last_updated. "days") ), "aaaa-mm-dd", date("Y-m-d"), "aaaa-mm-dd");
		if($diff <= 0){
			$code = hash("md5",date("YmdHis"));
			
     $nm_select ="UPDATE sec_users SET activation_code=".$this->Db->qstr($code) . " WHERE login=". $this->Db->qstr($this->sc_temp_usr_login); 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                app_Login_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
			if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

			 if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
 if (isset($this->sc_temp_sett_brute_force)) { $_SESSION['sett_brute_force'] = $this->sc_temp_sett_brute_force;}
 if (isset($this->sc_temp_sett_login_mode)) { $_SESSION['sett_login_mode'] = $this->sc_temp_sett_login_mode;}
 if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
 if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
 if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
 if (isset($this->sc_temp_usr_phone)) { $_SESSION['usr_phone'] = $this->sc_temp_usr_phone;}
 if (isset($this->sc_temp_remember_me)) { $_SESSION['remember_me'] = $this->sc_temp_remember_me;}
 if (isset($this->sc_temp_usr_picture)) { $_SESSION['usr_picture'] = $this->sc_temp_usr_picture;}
 if (isset($this->sc_temp_usr_groups)) { $_SESSION['usr_groups'] = $this->sc_temp_usr_groups;}
 if (isset($this->sc_temp_sett_group_administrator)) { $_SESSION['sett_group_administrator'] = $this->sc_temp_sett_group_administrator;}
 if (isset($this->sc_temp_sett_pswd_last_updated)) { $_SESSION['sett_pswd_last_updated'] = $this->sc_temp_sett_pswd_last_updated;}
 if (isset($this->sc_temp_sett_enable_2fa)) { $_SESSION['sett_enable_2fa'] = $this->sc_temp_sett_enable_2fa;}
 if (isset($this->sc_temp_sett_mfa_last_updated)) { $_SESSION['sett_mfa_last_updated'] = $this->sc_temp_sett_mfa_last_updated;}
 if (isset($this->sc_temp_sett_enable_2fa_mode)) { $_SESSION['sett_enable_2fa_mode'] = $this->sc_temp_sett_enable_2fa_mode;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('app_change_pswd') . "/", $this->nm_location, "act_code?#?" . NM_encode_input($code) . "?@?" . "pswd_expired?#?" . NM_encode_input("1") . "?@?", "_self", "ret_self", 440, 630);
 };
		}
		
	}
	
	
    if( isset($this->sc_temp_sett_enable_2fa) && $this->sc_temp_sett_enable_2fa == 'Y' ){
        if(!empty($this->rs[0][4])){
            
            
        $mfa_key = ($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '').($_SERVER['REMOTE_ADDR'] ?? '' ). ($_SERVER['HTTP_HOST'] ?? '') . ($_SERVER['SERVER_NAME'] ?? '') . ($_SERVER['HTTP_USER_AGENT'] ?? '');
        $mfa_key = '_'.hash("md5",$mfa_key);
        
            
            $diff = 0;
            if( $this->sc_temp_sett_mfa_last_updated != 0 && !empty($this->rs[0][9]) ){
                $diff = $this->nm_data->Dif_Datas(
                    date("Y-m-d", strtotime($this->rs[0][9] . " +".$this->sc_temp_sett_mfa_last_updated. "days") ),
                    "aaaa-mm-dd",
                    date("Y-m-d"),
                    "aaaa-mm-dd");
            }
            $diff_cookie = 0;
            if(isset($_COOKIE[ $mfa_key ]) && !empty($_COOKIE[ $mfa_key ])){
                $diff_cookie = $this->nm_data->Dif_Datas(
                    date("Y-m-d", strtotime(decode_string($_COOKIE[ $mfa_key ]) . " +".$this->sc_temp_sett_mfa_last_updated. "days") ),
                    "aaaa-mm-dd",
                    date("Y-m-d"),
                    "aaaa-mm-dd");
            }
            if($diff <= 0 || $diff_cookie <= 0){
                 if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
 if (isset($this->sc_temp_sett_brute_force)) { $_SESSION['sett_brute_force'] = $this->sc_temp_sett_brute_force;}
 if (isset($this->sc_temp_sett_login_mode)) { $_SESSION['sett_login_mode'] = $this->sc_temp_sett_login_mode;}
 if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
 if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
 if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
 if (isset($this->sc_temp_usr_phone)) { $_SESSION['usr_phone'] = $this->sc_temp_usr_phone;}
 if (isset($this->sc_temp_remember_me)) { $_SESSION['remember_me'] = $this->sc_temp_remember_me;}
 if (isset($this->sc_temp_usr_picture)) { $_SESSION['usr_picture'] = $this->sc_temp_usr_picture;}
 if (isset($this->sc_temp_usr_groups)) { $_SESSION['usr_groups'] = $this->sc_temp_usr_groups;}
 if (isset($this->sc_temp_sett_group_administrator)) { $_SESSION['sett_group_administrator'] = $this->sc_temp_sett_group_administrator;}
 if (isset($this->sc_temp_sett_pswd_last_updated)) { $_SESSION['sett_pswd_last_updated'] = $this->sc_temp_sett_pswd_last_updated;}
 if (isset($this->sc_temp_sett_enable_2fa)) { $_SESSION['sett_enable_2fa'] = $this->sc_temp_sett_enable_2fa;}
 if (isset($this->sc_temp_sett_mfa_last_updated)) { $_SESSION['sett_mfa_last_updated'] = $this->sc_temp_sett_mfa_last_updated;}
 if (isset($this->sc_temp_sett_enable_2fa_mode)) { $_SESSION['sett_enable_2fa_mode'] = $this->sc_temp_sett_enable_2fa_mode;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('app_control_2fa') . "/", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };
            }
        }
        else if($this->sc_temp_sett_enable_2fa_mode == 'all'){
            $_SESSION['scriptcase']['sc_apl_seg']['app_add_2fa'] = "on";;
             if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
 if (isset($this->sc_temp_sett_brute_force)) { $_SESSION['sett_brute_force'] = $this->sc_temp_sett_brute_force;}
 if (isset($this->sc_temp_sett_login_mode)) { $_SESSION['sett_login_mode'] = $this->sc_temp_sett_login_mode;}
 if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
 if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
 if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
 if (isset($this->sc_temp_usr_phone)) { $_SESSION['usr_phone'] = $this->sc_temp_usr_phone;}
 if (isset($this->sc_temp_remember_me)) { $_SESSION['remember_me'] = $this->sc_temp_remember_me;}
 if (isset($this->sc_temp_usr_picture)) { $_SESSION['usr_picture'] = $this->sc_temp_usr_picture;}
 if (isset($this->sc_temp_usr_groups)) { $_SESSION['usr_groups'] = $this->sc_temp_usr_groups;}
 if (isset($this->sc_temp_sett_group_administrator)) { $_SESSION['sett_group_administrator'] = $this->sc_temp_sett_group_administrator;}
 if (isset($this->sc_temp_sett_pswd_last_updated)) { $_SESSION['sett_pswd_last_updated'] = $this->sc_temp_sett_pswd_last_updated;}
 if (isset($this->sc_temp_sett_enable_2fa)) { $_SESSION['sett_enable_2fa'] = $this->sc_temp_sett_enable_2fa;}
 if (isset($this->sc_temp_sett_mfa_last_updated)) { $_SESSION['sett_mfa_last_updated'] = $this->sc_temp_sett_mfa_last_updated;}
 if (isset($this->sc_temp_sett_enable_2fa_mode)) { $_SESSION['sett_enable_2fa_mode'] = $this->sc_temp_sett_enable_2fa_mode;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('app_add_2fa') . "/", $this->nm_location, "redir_menu?#?" . NM_encode_input("1") . "?@?", "_self", "ret_self", 440, 630);
 };
        }

    }
    $this->remember_me_validate();
    
}
else
{
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .=  $this->Ini->Nm_lang['lang_error_not_active'] ;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_app_Login';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_app_Login';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] =  $this->Ini->Nm_lang['lang_error_not_active'] ;
 }
;
	if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
 if (isset($this->sc_temp_sett_brute_force)) { $_SESSION['sett_brute_force'] = $this->sc_temp_sett_brute_force;}
 if (isset($this->sc_temp_sett_login_mode)) { $_SESSION['sett_login_mode'] = $this->sc_temp_sett_login_mode;}
 if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
 if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
 if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
 if (isset($this->sc_temp_usr_phone)) { $_SESSION['usr_phone'] = $this->sc_temp_usr_phone;}
 if (isset($this->sc_temp_remember_me)) { $_SESSION['remember_me'] = $this->sc_temp_remember_me;}
 if (isset($this->sc_temp_usr_picture)) { $_SESSION['usr_picture'] = $this->sc_temp_usr_picture;}
 if (isset($this->sc_temp_usr_groups)) { $_SESSION['usr_groups'] = $this->sc_temp_usr_groups;}
 if (isset($this->sc_temp_sett_group_administrator)) { $_SESSION['sett_group_administrator'] = $this->sc_temp_sett_group_administrator;}
 if (isset($this->sc_temp_sett_pswd_last_updated)) { $_SESSION['sett_pswd_last_updated'] = $this->sc_temp_sett_pswd_last_updated;}
 if (isset($this->sc_temp_sett_enable_2fa)) { $_SESSION['sett_enable_2fa'] = $this->sc_temp_sett_enable_2fa;}
 if (isset($this->sc_temp_sett_mfa_last_updated)) { $_SESSION['sett_mfa_last_updated'] = $this->sc_temp_sett_mfa_last_updated;}
 if (isset($this->sc_temp_sett_enable_2fa_mode)) { $_SESSION['sett_enable_2fa_mode'] = $this->sc_temp_sett_enable_2fa_mode;}
    $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
    return;
}
}
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_sett_brute_force)) { $_SESSION['sett_brute_force'] = $this->sc_temp_sett_brute_force;}
if (isset($this->sc_temp_sett_login_mode)) { $_SESSION['sett_login_mode'] = $this->sc_temp_sett_login_mode;}
if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
if (isset($this->sc_temp_usr_phone)) { $_SESSION['usr_phone'] = $this->sc_temp_usr_phone;}
if (isset($this->sc_temp_remember_me)) { $_SESSION['remember_me'] = $this->sc_temp_remember_me;}
if (isset($this->sc_temp_usr_picture)) { $_SESSION['usr_picture'] = $this->sc_temp_usr_picture;}
if (isset($this->sc_temp_usr_groups)) { $_SESSION['usr_groups'] = $this->sc_temp_usr_groups;}
if (isset($this->sc_temp_sett_group_administrator)) { $_SESSION['sett_group_administrator'] = $this->sc_temp_sett_group_administrator;}
if (isset($this->sc_temp_sett_pswd_last_updated)) { $_SESSION['sett_pswd_last_updated'] = $this->sc_temp_sett_pswd_last_updated;}
if (isset($this->sc_temp_sett_enable_2fa)) { $_SESSION['sett_enable_2fa'] = $this->sc_temp_sett_enable_2fa;}
if (isset($this->sc_temp_sett_mfa_last_updated)) { $_SESSION['sett_mfa_last_updated'] = $this->sc_temp_sett_mfa_last_updated;}
if (isset($this->sc_temp_sett_enable_2fa_mode)) { $_SESSION['sett_enable_2fa_mode'] = $this->sc_temp_sett_enable_2fa_mode;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_login != $this->login || (isset($bFlagRead_login) && $bFlagRead_login)))
    {
        $this->ajax_return_values_login(true);
    }
    if (($original_pswd != $this->pswd || (isset($bFlagRead_pswd) && $bFlagRead_pswd)))
    {
        $this->ajax_return_values_pswd(true);
    }
    if (($original_remember_me != $this->remember_me || (isset($bFlagRead_remember_me) && $bFlagRead_remember_me)))
    {
        $this->ajax_return_values_remember_me(true);
    }
}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off'; 
      }
      }
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

      if (empty($Campos_Crit) && empty($Campos_Falta) && empty($this->Campos_Mens_erro))
      {
          if (!isset($this->NM_ajax_flag) || 'validate_' != substr($this->NM_ajax_opcao, 0, 9))
          {
              $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
  $this->sc_validate_success();
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off'; 
          }
      }
   }

    function ValidateField_login(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['login'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->login) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_sec_users_fild_login'] . " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['login']))
              {
                  $Campos_Erros['login'] = array();
              }
              $Campos_Erros['login'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['login']) || !is_array($this->NM_ajax_info['errList']['login']))
              {
                  $this->NM_ajax_info['errList']['login'] = array();
              }
              $this->NM_ajax_info['errList']['login'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
          if (NM_utf8_strlen($this->login) < 5) 
          { 
              $hasError = true;
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_sec_users_fild_login'] . " " . $this->Ini->Nm_lang['lang_errm_mnch'] . " 5 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['login']))
              {
                  $Campos_Erros['login'] = array();
              }
              $Campos_Erros['login'][] = $this->Ini->Nm_lang['lang_errm_mnch'] . " 5 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['login']) || !is_array($this->NM_ajax_info['errList']['login']))
              {
                  $this->NM_ajax_info['errList']['login'] = array();
              }
              $this->NM_ajax_info['errList']['login'][] = $this->Ini->Nm_lang['lang_errm_mnch'] . " 5 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'login';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_login

    function ValidateField_pswd(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['pswd'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->pswd) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_sec_users_fild_pswd'] . " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['pswd']))
              {
                  $Campos_Erros['pswd'] = array();
              }
              $Campos_Erros['pswd'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['pswd']) || !is_array($this->NM_ajax_info['errList']['pswd']))
              {
                  $this->NM_ajax_info['errList']['pswd'] = array();
              }
              $this->NM_ajax_info['errList']['pswd'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
          if (NM_utf8_strlen($this->pswd) < 5) 
          { 
              $hasError = true;
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_sec_users_fild_pswd'] . " " . $this->Ini->Nm_lang['lang_errm_mnch'] . " 5 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['pswd']))
              {
                  $Campos_Erros['pswd'] = array();
              }
              $Campos_Erros['pswd'][] = $this->Ini->Nm_lang['lang_errm_mnch'] . " 5 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['pswd']) || !is_array($this->NM_ajax_info['errList']['pswd']))
              {
                  $this->NM_ajax_info['errList']['pswd'] = array();
              }
              $this->NM_ajax_info['errList']['pswd'][] = $this->Ini->Nm_lang['lang_errm_mnch'] . " 5 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'pswd';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_pswd

    function ValidateField_remember_me(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['remember_me'])) {
       return;
   }
      if ($this->remember_me == "" && $this->nmgp_opcao != "excluir")
      { 
          $this->remember_me = "0";
      } 
      else 
      { 
          if (is_array($this->remember_me))
          {
              $x = 0; 
              $this->remember_me_1 = array(); 
              foreach ($this->remember_me as $ind => $dados_remember_me_1 ) 
              {
                  if ($dados_remember_me_1 != "") 
                  {
                      $this->remember_me_1[] = $dados_remember_me_1;
                  } 
              } 
              $this->remember_me = ""; 
              foreach ($this->remember_me_1 as $dados_remember_me_1 ) 
              { 
                   if ($x != 0)
                   { 
                       $this->remember_me .= ";";
                   } 
                   $this->remember_me .= $dados_remember_me_1;
                   $x++ ; 
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'remember_me';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_remember_me

    function ValidateField_new_user(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['new_user'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->new_user) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'new_user';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_new_user

    function ValidateField_retrieve_pswd(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['retrieve_pswd'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->retrieve_pswd) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'retrieve_pswd';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_retrieve_pswd

    function ValidateField_language(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['language'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->language) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'language';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_language

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
    $this->nmgp_dados_form['login'] = $this->login;
    $this->nmgp_dados_form['pswd'] = $this->pswd;
    $this->nmgp_dados_form['remember_me'] = $this->remember_me;
    $this->nmgp_dados_form['new_user'] = $this->new_user;
    $this->nmgp_dados_form['retrieve_pswd'] = $this->retrieve_pswd;
    $this->nmgp_dados_form['language'] = $this->language;
    $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
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
   }
   function nm_formatar_campos($format_fields = array())
   {
      global $nm_form_submit;
     if (isset($this->formatado) && $this->formatado)
     {
         return;
     }
     $this->formatado = true;
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

   function ajax_return_values()
   {
          $this->ajax_return_values_login();
          $this->ajax_return_values_pswd();
          $this->ajax_return_values_remember_me();
          $this->ajax_return_values_new_user();
          $this->ajax_return_values_retrieve_pswd();
          $this->ajax_return_values_language();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
          }
   } // ajax_return_values

          //----- login
   function ajax_return_values_login($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("login", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->login);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['login'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- pswd
   function ajax_return_values_pswd($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("pswd", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->pswd);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['pswd'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array(''),
              );
          }
   }

          //----- remember_me
   function ajax_return_values_remember_me($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("remember_me", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->remember_me);
              $aLookup = array();
              $this->_tmp_lookup_remember_me = $this->remember_me;

$aLookup[] = array(app_Login_pack_protect_string('1') => str_replace('<', '&lt;',app_Login_pack_protect_string("" . $this->Ini->Nm_lang['lang_sec_remember_me'] . "")));
$_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['Lookup_remember_me'][] = '1';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['remember_me']) && !empty($this->NM_ajax_info['select_html']['remember_me']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['remember_me']);
          }
          $this->NM_ajax_info['fldList']['remember_me'] = array(
                       'row'    => '',
               'type'    => 'checkbox',
               'switch'  => false,
               'valList' => explode(';', $sTmpValue),
               'colNum'  => 1,
               'optComp'  => $sOptComp,
               'optClass' => 'sc-ui-checkbox-remember_me',
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['remember_me']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['remember_me']['valList'][$i] = app_Login_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['remember_me']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['remember_me']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['remember_me']['labList'] = $aLabel;
          }
   }

          //----- new_user
   function ajax_return_values_new_user($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("new_user", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->new_user);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['new_user'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- retrieve_pswd
   function ajax_return_values_retrieve_pswd($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("retrieve_pswd", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->retrieve_pswd);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['retrieve_pswd'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- language
   function ajax_return_values_language($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("language", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->language);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['language'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['upload_dir'][$fieldName][] = $newName;
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
//
function fb_return()
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_facebook_name)) {$this->sc_temp_facebook_name = (isset($_SESSION['facebook_name'])) ? $_SESSION['facebook_name'] : "";}
if (!isset($this->sc_temp_facebook_email)) {$this->sc_temp_facebook_email = (isset($_SESSION['facebook_email'])) ? $_SESSION['facebook_email'] : "";}
if (!isset($this->sc_temp_facebook_user)) {$this->sc_temp_facebook_user = (isset($_SESSION['facebook_user'])) ? $_SESSION['facebook_user'] : "";}
if (!isset($this->sc_temp_facebook_error_msg)) {$this->sc_temp_facebook_error_msg = (isset($_SESSION['facebook_error_msg'])) ? $_SESSION['facebook_error_msg'] : "";}
if (!isset($this->sc_temp_facebook_error_code)) {$this->sc_temp_facebook_error_code = (isset($_SESSION['facebook_error_code'])) ? $_SESSION['facebook_error_code'] : "";}
  
if(!empty($this->sc_temp_facebook_error_code))
{
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'urlencode($this->sc_temp_facebook_error_msg)';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_app_Login';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_app_Login';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'urlencode($this->sc_temp_facebook_error_msg)';
 }
;
}
else
{
	$this->get_social("facebook", $this->sc_temp_facebook_user, $this->sc_temp_facebook_email, $this->sc_temp_facebook_name);
}
if (isset($this->sc_temp_facebook_error_code)) { $_SESSION['facebook_error_code'] = $this->sc_temp_facebook_error_code;}
if (isset($this->sc_temp_facebook_error_msg)) { $_SESSION['facebook_error_msg'] = $this->sc_temp_facebook_error_msg;}
if (isset($this->sc_temp_facebook_user)) { $_SESSION['facebook_user'] = $this->sc_temp_facebook_user;}
if (isset($this->sc_temp_facebook_email)) { $_SESSION['facebook_email'] = $this->sc_temp_facebook_email;}
if (isset($this->sc_temp_facebook_name)) { $_SESSION['facebook_name'] = $this->sc_temp_facebook_name;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function get_settings()
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
  

    
$check_sql = "SELECT set_name, set_value  FROM sec_settings";
   
 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


if (isset($this->rs[0][0]))     
{
    foreach($this->rs as $f ){
        $_SESSION[ 'sett_'. $f[0] ] = $f[1];
    }
}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function get_social($resource, $user_id, $email, $name, $picture='')
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_sett_enable_2fa_mode)) {$this->sc_temp_sett_enable_2fa_mode = (isset($_SESSION['sett_enable_2fa_mode'])) ? $_SESSION['sett_enable_2fa_mode'] : "";}
if (!isset($this->sc_temp_sett_mfa_last_updated)) {$this->sc_temp_sett_mfa_last_updated = (isset($_SESSION['sett_mfa_last_updated'])) ? $_SESSION['sett_mfa_last_updated'] : "";}
if (!isset($this->sc_temp_sett_enable_2fa)) {$this->sc_temp_sett_enable_2fa = (isset($_SESSION['sett_enable_2fa'])) ? $_SESSION['sett_enable_2fa'] : "";}
if (!isset($this->sc_temp_usr_picture)) {$this->sc_temp_usr_picture = (isset($_SESSION['usr_picture'])) ? $_SESSION['usr_picture'] : "";}
if (!isset($this->sc_temp_sett_group_administrator)) {$this->sc_temp_sett_group_administrator = (isset($_SESSION['sett_group_administrator'])) ? $_SESSION['sett_group_administrator'] : "";}
if (!isset($this->sc_temp_usr_groups)) {$this->sc_temp_usr_groups = (isset($_SESSION['usr_groups'])) ? $_SESSION['usr_groups'] : "";}
if (!isset($this->sc_temp_remember_me)) {$this->sc_temp_remember_me = (isset($_SESSION['remember_me'])) ? $_SESSION['remember_me'] : "";}
if (!isset($this->sc_temp_usr_phone)) {$this->sc_temp_usr_phone = (isset($_SESSION['usr_phone'])) ? $_SESSION['usr_phone'] : "";}
if (!isset($this->sc_temp_usr_email)) {$this->sc_temp_usr_email = (isset($_SESSION['usr_email'])) ? $_SESSION['usr_email'] : "";}
if (!isset($this->sc_temp_usr_name)) {$this->sc_temp_usr_name = (isset($_SESSION['usr_name'])) ? $_SESSION['usr_name'] : "";}
if (!isset($this->sc_temp_usr_priv_admin)) {$this->sc_temp_usr_priv_admin = (isset($_SESSION['usr_priv_admin'])) ? $_SESSION['usr_priv_admin'] : "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
if(empty($user_id)) return;

	$sql = "SELECT 
				priv_admin,
				active, 
				name, 
				email, 
				mfa, 
				pswd_last_updated,
				login,
				phone,
				picture,
				mfa_last_updated
			FROM sec_users 
				WHERE email = ". $this->Db->qstr($email).
		" OR login = (
		SELECT
			sec_users_social.login
		FROM
			sec_users_social
		WHERE
			sec_users_social.resource = '". $resource ."'
			AND sec_users_social.resource_id = ". $this->Db->qstr($user_id) .")";
	

	 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


	if($this->rs === false || count($this->rs) == 0)
	{
		$this->link_user($resource, $user_id, $email, $name, $picture);
		;
		$this->sc_logged_in_fail($user_id);
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .=  $this->Ini->Nm_lang['lang_error_login'] ;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_app_Login';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_app_Login';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] =  $this->Ini->Nm_lang['lang_error_login'] ;
 }
;
	}
	else if($this->rs[0][1] == 'Y')
	{
		$this->sc_temp_usr_login		= $this->rs[0][6];
		$this->sc_temp_usr_priv_admin 	= ($this->rs[0][0] == 'Y') ? TRUE : FALSE;
		$this->sc_temp_usr_name		= $this->rs[0][2];
		$this->sc_temp_usr_email		= $this->rs[0][3];
		$this->sc_temp_usr_phone		= $this->rs[0][7];
		$this->sc_temp_remember_me = $this->remember_me ;
    
		$usr_grp = array();

		 
      $nm_select = "SELECT group_id FROM sec_users_groups WHERE login =". $this->Db->qstr($this->sc_temp_usr_login); 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs_groups = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 $SCrx->fields[0] = str_replace(',', '.', $SCrx->fields[0]);
                 $SCrx->fields[0] = (strpos(strtolower($SCrx->fields[0]), "e")) ? (float)$SCrx->fields[0] : $SCrx->fields[0];
                 $SCrx->fields[0] = (string)$SCrx->fields[0];
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs_groups[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs_groups = false;
          $this->rs_groups_erro = $this->Db->ErrorMsg();
      } 


		if(isset($this->rs_groups[0][0])){
			foreach($this->rs_groups  as $r){
				$usr_grp[] = $r[0];
			}
		}

		$this->sc_temp_usr_groups = $usr_grp;
	
		if(in_array($this->sc_temp_sett_group_administrator, $this->sc_temp_usr_groups)){
			$this->sc_temp_usr_priv_admin = TRUE;
		}
	
	
	
		if(!empty($picture)){
			$path_img = $_SESSION['scriptcase']['app_Login']['glo_nm_path_imag_temp'] .'/sc_img_'. $this->sc_temp_usr_login . hash("md5",date('YmdHis')) . '.png';
			$picture_data = file_get_contents($picture);
			file_put_contents($this->Ini->root . $path_img, $picture_data);
			$this->sc_temp_usr_picture = $path_img;
			$this->update_login_img($this->sc_temp_usr_login, $picture_data);
		}
		if(empty($this->sc_temp_usr_picture) && !empty($this->rs[0][8])){
			if(substr($this->rs[0][8], 0, 5) != 'http:' && substr($this->rs[0][8], 0, 6) != 'https:'){
				$path_img = $_SESSION['scriptcase']['app_Login']['glo_nm_path_imag_temp'] .'/sc_img_'. $this->sc_temp_usr_login . hash("sha512",date('YmdHis')) . '.png';
				file_put_contents($this->Ini->root . $path_img, $this->rs[0][8]);
				$this->sc_temp_usr_picture = $path_img;
			}
			else{
				$this->sc_temp_usr_picture = $this->rs[0][8];
			}
		}
	
	
	
	
		if( isset($this->sc_temp_sett_enable_2fa) && $this->sc_temp_sett_enable_2fa == 'Y' ){
			if(!empty($this->rs[0][4])){


			$mfa_key = ($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '').($_SERVER['REMOTE_ADDR'] ?? '' ). ($_SERVER['HTTP_HOST'] ?? '') . ($_SERVER['SERVER_NAME'] ?? '') . ($_SERVER['HTTP_USER_AGENT'] ?? '');
			$mfa_key = '_'.hash("md5",$mfa_key);


				$diff = 0;
				if( $this->sc_temp_sett_mfa_last_updated != 0 && !empty($this->rs[0][9]) ){
					$diff = $this->nm_data->Dif_Datas(
						date("Y-m-d", strtotime($this->rs[0][9] . " +".$this->sc_temp_sett_mfa_last_updated. "days") ),
						"aaaa-mm-dd",
						date("Y-m-d"),
						"aaaa-mm-dd");
				}
				$diff_cookie = 0;
				if(isset($_COOKIE[ $mfa_key ]) && !empty($_COOKIE[ $mfa_key ])){
					$diff_cookie = $this->nm_data->Dif_Datas(
						date("Y-m-d", strtotime(decode_string($_COOKIE[ $mfa_key ]) . " +".$this->sc_temp_sett_mfa_last_updated. "days") ),
						"aaaa-mm-dd",
						date("Y-m-d"),
						"aaaa-mm-dd");
				}
				if($diff <= 0 || $diff_cookie <= 0){
					 if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
 if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
 if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
 if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
 if (isset($this->sc_temp_usr_phone)) { $_SESSION['usr_phone'] = $this->sc_temp_usr_phone;}
 if (isset($this->sc_temp_remember_me)) { $_SESSION['remember_me'] = $this->sc_temp_remember_me;}
 if (isset($this->sc_temp_usr_groups)) { $_SESSION['usr_groups'] = $this->sc_temp_usr_groups;}
 if (isset($this->sc_temp_sett_group_administrator)) { $_SESSION['sett_group_administrator'] = $this->sc_temp_sett_group_administrator;}
 if (isset($this->sc_temp_usr_picture)) { $_SESSION['usr_picture'] = $this->sc_temp_usr_picture;}
 if (isset($this->sc_temp_sett_enable_2fa)) { $_SESSION['sett_enable_2fa'] = $this->sc_temp_sett_enable_2fa;}
 if (isset($this->sc_temp_sett_mfa_last_updated)) { $_SESSION['sett_mfa_last_updated'] = $this->sc_temp_sett_mfa_last_updated;}
 if (isset($this->sc_temp_sett_enable_2fa_mode)) { $_SESSION['sett_enable_2fa_mode'] = $this->sc_temp_sett_enable_2fa_mode;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('app_control_2fa') . "/", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };
				}
			}
			else if($this->sc_temp_sett_enable_2fa_mode == 'all'){
				$_SESSION['scriptcase']['sc_apl_seg']['app_add_2fa'] = "on";;
				 if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
 if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
 if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
 if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
 if (isset($this->sc_temp_usr_phone)) { $_SESSION['usr_phone'] = $this->sc_temp_usr_phone;}
 if (isset($this->sc_temp_remember_me)) { $_SESSION['remember_me'] = $this->sc_temp_remember_me;}
 if (isset($this->sc_temp_usr_groups)) { $_SESSION['usr_groups'] = $this->sc_temp_usr_groups;}
 if (isset($this->sc_temp_sett_group_administrator)) { $_SESSION['sett_group_administrator'] = $this->sc_temp_sett_group_administrator;}
 if (isset($this->sc_temp_usr_picture)) { $_SESSION['usr_picture'] = $this->sc_temp_usr_picture;}
 if (isset($this->sc_temp_sett_enable_2fa)) { $_SESSION['sett_enable_2fa'] = $this->sc_temp_sett_enable_2fa;}
 if (isset($this->sc_temp_sett_mfa_last_updated)) { $_SESSION['sett_mfa_last_updated'] = $this->sc_temp_sett_mfa_last_updated;}
 if (isset($this->sc_temp_sett_enable_2fa_mode)) { $_SESSION['sett_enable_2fa_mode'] = $this->sc_temp_sett_enable_2fa_mode;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('app_add_2fa') . "/", $this->nm_location, "redir_menu?#?" . NM_encode_input("1") . "?@?", "_self", "ret_self", 440, 630);
 };
			}

		}
    	$this->remember_me_validate();
		$this->sc_validate_success();
	}
	else
	{
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .=  $this->Ini->Nm_lang['lang_error_not_active'] ;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_app_Login';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_app_Login';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] =  $this->Ini->Nm_lang['lang_error_not_active'] ;
 }
;
		if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
 if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
 if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
 if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
 if (isset($this->sc_temp_usr_phone)) { $_SESSION['usr_phone'] = $this->sc_temp_usr_phone;}
 if (isset($this->sc_temp_remember_me)) { $_SESSION['remember_me'] = $this->sc_temp_remember_me;}
 if (isset($this->sc_temp_usr_groups)) { $_SESSION['usr_groups'] = $this->sc_temp_usr_groups;}
 if (isset($this->sc_temp_sett_group_administrator)) { $_SESSION['sett_group_administrator'] = $this->sc_temp_sett_group_administrator;}
 if (isset($this->sc_temp_usr_picture)) { $_SESSION['usr_picture'] = $this->sc_temp_usr_picture;}
 if (isset($this->sc_temp_sett_enable_2fa)) { $_SESSION['sett_enable_2fa'] = $this->sc_temp_sett_enable_2fa;}
 if (isset($this->sc_temp_sett_mfa_last_updated)) { $_SESSION['sett_mfa_last_updated'] = $this->sc_temp_sett_mfa_last_updated;}
 if (isset($this->sc_temp_sett_enable_2fa_mode)) { $_SESSION['sett_enable_2fa_mode'] = $this->sc_temp_sett_enable_2fa_mode;}
    $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
    return;
}
}
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
if (isset($this->sc_temp_usr_phone)) { $_SESSION['usr_phone'] = $this->sc_temp_usr_phone;}
if (isset($this->sc_temp_remember_me)) { $_SESSION['remember_me'] = $this->sc_temp_remember_me;}
if (isset($this->sc_temp_usr_groups)) { $_SESSION['usr_groups'] = $this->sc_temp_usr_groups;}
if (isset($this->sc_temp_sett_group_administrator)) { $_SESSION['sett_group_administrator'] = $this->sc_temp_sett_group_administrator;}
if (isset($this->sc_temp_usr_picture)) { $_SESSION['usr_picture'] = $this->sc_temp_usr_picture;}
if (isset($this->sc_temp_sett_enable_2fa)) { $_SESSION['sett_enable_2fa'] = $this->sc_temp_sett_enable_2fa;}
if (isset($this->sc_temp_sett_mfa_last_updated)) { $_SESSION['sett_mfa_last_updated'] = $this->sc_temp_sett_mfa_last_updated;}
if (isset($this->sc_temp_sett_enable_2fa_mode)) { $_SESSION['sett_enable_2fa_mode'] = $this->sc_temp_sett_enable_2fa_mode;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function go_return()
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_google_photo)) {$this->sc_temp_google_photo = (isset($_SESSION['google_photo'])) ? $_SESSION['google_photo'] : "";}
if (!isset($this->sc_temp_google_name)) {$this->sc_temp_google_name = (isset($_SESSION['google_name'])) ? $_SESSION['google_name'] : "";}
if (!isset($this->sc_temp_google_email)) {$this->sc_temp_google_email = (isset($_SESSION['google_email'])) ? $_SESSION['google_email'] : "";}
if (!isset($this->sc_temp_google_user)) {$this->sc_temp_google_user = (isset($_SESSION['google_user'])) ? $_SESSION['google_user'] : "";}
if (!isset($this->sc_temp_google_error_msg)) {$this->sc_temp_google_error_msg = (isset($_SESSION['google_error_msg'])) ? $_SESSION['google_error_msg'] : "";}
if (!isset($this->sc_temp_google_error_code)) {$this->sc_temp_google_error_code = (isset($_SESSION['google_error_code'])) ? $_SESSION['google_error_code'] : "";}
  
if(!empty($this->sc_temp_google_error_code))
{
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'urlencode($this->sc_temp_google_error_msg)';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_app_Login';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_app_Login';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'urlencode($this->sc_temp_google_error_msg)';
 }
;
}
else
{
	$this->get_social("google", $this->sc_temp_google_user, $this->sc_temp_google_email, $this->sc_temp_google_name, $this->sc_temp_google_photo);
}
if (isset($this->sc_temp_google_error_code)) { $_SESSION['google_error_code'] = $this->sc_temp_google_error_code;}
if (isset($this->sc_temp_google_error_msg)) { $_SESSION['google_error_msg'] = $this->sc_temp_google_error_msg;}
if (isset($this->sc_temp_google_user)) { $_SESSION['google_user'] = $this->sc_temp_google_user;}
if (isset($this->sc_temp_google_email)) { $_SESSION['google_email'] = $this->sc_temp_google_email;}
if (isset($this->sc_temp_google_name)) { $_SESSION['google_name'] = $this->sc_temp_google_name;}
if (isset($this->sc_temp_google_photo)) { $_SESSION['google_photo'] = $this->sc_temp_google_photo;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function has_priv($param)
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
  
return ($param == 'Y' ? 'on' : 'off');

$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function link_user($resource, $usr_id, $email, $name, $picture='')
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_sett_group_default)) {$this->sc_temp_sett_group_default = (isset($_SESSION['sett_group_default'])) ? $_SESSION['sett_group_default'] : "";}
if (!isset($this->sc_temp_sett_new_users)) {$this->sc_temp_sett_new_users = (isset($_SESSION['sett_new_users'])) ? $_SESSION['sett_new_users'] : "";}
if (!isset($this->sc_temp_usr_picture)) {$this->sc_temp_usr_picture = (isset($_SESSION['usr_picture'])) ? $_SESSION['usr_picture'] : "";}
if (!isset($this->sc_temp_usr_email)) {$this->sc_temp_usr_email = (isset($_SESSION['usr_email'])) ? $_SESSION['usr_email'] : "";}
if (!isset($this->sc_temp_usr_priv_admin)) {$this->sc_temp_usr_priv_admin = (isset($_SESSION['usr_priv_admin'])) ? $_SESSION['usr_priv_admin'] : "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
	if($this->sc_temp_sett_new_users != 'Y'){
		return;
	}
	$group_default = (int)$this->sc_temp_sett_group_default;

	$sql = "INSERT INTO
				sec_users( login, name, pswd, email, active )
			VALUES 
				(". $this->Db->qstr($usr_id). ", ".
					$this->Db->qstr($name) . ", ".
					$this->Db->qstr(hash("sha512",date("YmdHis"))) . ", ".
					$this->Db->qstr($email) .
					", 'Y'".
				")";
			
	
	
     $nm_select = $sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                app_Login_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

	
	if(!empty($picture)){
		$picture_data = file_get_contents($picture); 
		$picture = $_SESSION['scriptcase']['app_Login']['glo_nm_path_imag_temp'] .'/sc_img_'. $this->sc_temp_usr_login . hash("md5",date('YmdHis')) . '.png';
		file_put_contents($this->Ini->root . $picture, $picture_data);
		$this->update_login_img($usr_id, $picture_data);
	}
	
	$sql = "INSERT INTO
				sec_users_social( sec_users_social.login, sec_users_social.resource, sec_users_social.resource_id )
			VALUES 
				(". $this->Db->qstr($usr_id). ", ".
					$this->Db->qstr($resource) . ", ".
					$this->Db->qstr($usr_id) . ")";
			
	
	
     $nm_select = $sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                app_Login_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
									 
	
	$sql = "INSERT INTO
				sec_users_groups( login, group_id )
			VALUES 
				(". $this->Db->qstr($usr_id). ", ".
					$this->Db->qstr($group_default) . ")";
			
	
	
     $nm_select = $sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                app_Login_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

	
	$usr_login			= $usr_id;
	$usr_priv_admin 	= FALSE;
	$usr_email			= $email;
	$usr_picture		= $picture;
	 if (isset($usr_login)) {$this->sc_temp_usr_login = $usr_login;}
;
	 if (isset($usr_priv_admin)) {$this->sc_temp_usr_priv_admin = $usr_priv_admin;}
;
	 if (isset($usr_email)) {$this->sc_temp_usr_email = $usr_email;}
;
	 if (isset($usr_picture)) {$this->sc_temp_usr_picture = $usr_picture;}
;
	$this->sc_validate_success();
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
if (isset($this->sc_temp_usr_picture)) { $_SESSION['usr_picture'] = $this->sc_temp_usr_picture;}
if (isset($this->sc_temp_sett_new_users)) { $_SESSION['sett_new_users'] = $this->sc_temp_sett_new_users;}
if (isset($this->sc_temp_sett_group_default)) { $_SESSION['sett_group_default'] = $this->sc_temp_sett_group_default;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function remember_me_init()
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_email)) {$this->sc_temp_usr_email = (isset($_SESSION['usr_email'])) ? $_SESSION['usr_email'] : "";}
if (!isset($this->sc_temp_usr_name)) {$this->sc_temp_usr_name = (isset($_SESSION['usr_name'])) ? $_SESSION['usr_name'] : "";}
if (!isset($this->sc_temp_usr_priv_admin)) {$this->sc_temp_usr_priv_admin = (isset($_SESSION['usr_priv_admin'])) ? $_SESSION['usr_priv_admin'] : "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
if(isset($_COOKIE['usr_data']) && !empty($_COOKIE['usr_data'])){

    $usr_data = unserialize(decode_string($_COOKIE['usr_data']));
    
    if(substr($usr_data['code'], 0, 7) == 'cookie_'){
        


        $sql = "SELECT 
                    priv_admin,
                    active, 
                    name, 
                    email 
                FROM sec_users 
                WHERE login = ". $this->Db->qstr($usr_data['login']) ."
                AND activation_code = ".$this->Db->qstr($usr_data['code']);
         
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


        if(count($this->rs) != 0 && $this->rs[0][1] == 'Y')
        {
            $this->sc_temp_usr_login		= $usr_data['login'];
            $this->sc_temp_usr_priv_admin 	= ($this->rs[0][0] == 'Y') ? TRUE : FALSE;
            $this->sc_temp_usr_name		= $this->rs[0][2];
            $this->sc_temp_usr_email		= $this->rs[0][3];
            
            $this->sc_validate_success();
        }
    }
}
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function remember_me_validate()
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_sett_cookie_expiration_time)) {$this->sc_temp_sett_cookie_expiration_time = (isset($_SESSION['sett_cookie_expiration_time'])) ? $_SESSION['sett_cookie_expiration_time'] : "";}
if (!isset($this->sc_temp_sett_remember_me)) {$this->sc_temp_sett_remember_me = (isset($_SESSION['sett_remember_me'])) ? $_SESSION['sett_remember_me'] : "";}
  
if(!isset($this->sc_temp_sett_remember_me) || $this->sc_temp_sett_remember_me != 'Y'){
	return;
}
if($this->remember_me  == 1){

    $chars  = 'abcdefghijklmnopqrstuvxywz';
    $chars .= 'ABCDEFGHIJKLMNOPQRSTUVXYWZ';
    $chars .= '0123456789!@$*.,;:';
    $max = strlen($chars)-1;
    $code = "cookie_";
    for($i=0; $i < 25; $i++)
    {
        $code .= $chars[mt_rand(0, $max)];
    }
    
    $slogin = $this->Db->qstr($this->login );

    
     $nm_select ="UPDATE sec_users SET activation_code = ". $this->Db->qstr($code) . " WHERE login = ". $slogin; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                app_Login_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

    $usr_data = array(
        'login' => $this->login ,
        'code' => $code,
    );
    $remember_me_expiry_cookie = $this->sc_temp_sett_cookie_expiration_time;
    setcookie("usr_data", encode_string(serialize($usr_data)),time()+60*60*24* $remember_me_expiry_cookie, '/');
}
if (isset($this->sc_temp_sett_remember_me)) { $_SESSION['sett_remember_me'] = $this->sc_temp_sett_remember_me;}
if (isset($this->sc_temp_sett_cookie_expiration_time)) { $_SESSION['sett_cookie_expiration_time'] = $this->sc_temp_sett_cookie_expiration_time;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function sc_validate_success()
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_sett_session_expire)) {$this->sc_temp_sett_session_expire = (isset($_SESSION['sett_session_expire'])) ? $_SESSION['sett_session_expire'] : "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
if (!isset($this->sc_temp_usr_phone)) {$this->sc_temp_usr_phone = (isset($_SESSION['usr_phone'])) ? $_SESSION['usr_phone'] : "";}
if (!isset($this->sc_temp_usr_name)) {$this->sc_temp_usr_name = (isset($_SESSION['usr_name'])) ? $_SESSION['usr_name'] : "";}
if (!isset($this->sc_temp_usr_picture)) {$this->sc_temp_usr_picture = (isset($_SESSION['usr_picture'])) ? $_SESSION['usr_picture'] : "";}
if (!isset($this->sc_temp_usr_email)) {$this->sc_temp_usr_email = (isset($_SESSION['usr_email'])) ? $_SESSION['usr_email'] : "";}
  
$sql = "SELECT 
		app_name,
		priv_access,
		priv_insert,
		priv_delete,
		priv_update,
		priv_export,
		priv_print
	      FROM sec_groups_apps
	      WHERE group_id IN
	          (SELECT
		       group_id
		   FROM
		       sec_users_groups 
		   WHERE
		       login = '". $this->sc_temp_usr_login ."')";
		
	
 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->rs = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


$arr_default = array(
					'access' => 'off',
					'insert' => 'off',
					'delete' => 'off',
					'update' => 'off',
					'export' => 'btn_display_off',
					'print'  => 'btn_display_off',
					);
if ($this->rs !== false)
{
	$arr_perm = array();
	while (!$this->rs->EOF)
	{
		$app = $this->rs->fields[0];
		
		if(!isset($arr_perm[$app]))
		{
		   $arr_perm[$app] = $arr_default;
		}
		if( $this->rs->fields[1] == 'Y')
		{
			$arr_perm[$app][ 'access' ] = 'on';
		}
		if($this->rs->fields[2] == 'Y')
		{
			$arr_perm[$app][ 'insert' ] = 'on';
		}
		if($this->rs->fields[3] == 'Y')
		{
			$arr_perm[$app][ 'delete' ] = 'on';
		}
		if($this->rs->fields[4] == 'Y')
		{
			$arr_perm[$app][ 'update' ] = 'on';
		}
		if($this->rs->fields[5] == 'Y')
		{
			$arr_perm[$app]['export'] =  'btn_display_on';
		}
		if($this->rs->fields[6] == 'Y')
		{
			$arr_perm[$app]['print'] =  'btn_display_on';
		}


		$this->rs->MoveNext();	
	}
	$this->rs->Close();
		   
	foreach($arr_perm as $app => $perm)
	{
		$_SESSION['scriptcase']['sc_apl_seg'][$app] = $perm['access'];;
		
		$_SESSION['scriptcase']['sc_apl_conf'][$app]['insert'] = $perm['insert'];
		$_SESSION['scriptcase']['sc_apl_conf'][$app]['delete'] = $perm['delete'];
		$_SESSION['scriptcase']['sc_apl_conf'][$app]['update'] = $perm['update'];
		if ($perm['export'] == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['xls'] = 'on';
}
elseif ($perm['export'] == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['xls'] = 'off';
}
elseif ($perm['export'] == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['xls'] = 'on';
}
elseif ($perm['export'] == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['xls'] = 'off';
}
elseif ($perm['export'] == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']]['xls'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']] = 'xls';
}
;
		if ($perm['export'] == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['word'] = 'on';
}
elseif ($perm['export'] == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['word'] = 'off';
}
elseif ($perm['export'] == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['word'] = 'on';
}
elseif ($perm['export'] == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['word'] = 'off';
}
elseif ($perm['export'] == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']]['word'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']] = 'word';
}
;
		if ($perm['export'] == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['pdf'] = 'on';
}
elseif ($perm['export'] == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['pdf'] = 'off';
}
elseif ($perm['export'] == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['pdf'] = 'on';
}
elseif ($perm['export'] == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['pdf'] = 'off';
}
elseif ($perm['export'] == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']]['pdf'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']] = 'pdf';
}
;
		if ($perm['export'] == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['xml'] = 'on';
}
elseif ($perm['export'] == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['xml'] = 'off';
}
elseif ($perm['export'] == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['xml'] = 'on';
}
elseif ($perm['export'] == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['xml'] = 'off';
}
elseif ($perm['export'] == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']]['xml'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']] = 'xml';
}
;
		if ($perm['export'] == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['csv'] = 'on';
}
elseif ($perm['export'] == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['csv'] = 'off';
}
elseif ($perm['export'] == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['csv'] = 'on';
}
elseif ($perm['export'] == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['csv'] = 'off';
}
elseif ($perm['export'] == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']]['csv'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']] = 'csv';
}
;
		if ($perm['export'] == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['rtf'] = 'on';
}
elseif ($perm['export'] == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['rtf'] = 'off';
}
elseif ($perm['export'] == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['rtf'] = 'on';
}
elseif ($perm['export'] == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['rtf'] = 'off';
}
elseif ($perm['export'] == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']]['rtf'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']] = 'rtf';
}
;
		if ($perm['export'] == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['json'] = 'on';
}
elseif ($perm['export'] == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['json'] = 'off';
}
elseif ($perm['export'] == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['json'] = 'on';
}
elseif ($perm['export'] == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['json'] = 'off';
}
elseif ($perm['export'] == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']]['json'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']] = 'json';
}
;
		if ($perm['print'] == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['print'] = 'on';
}
elseif ($perm['print'] == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['print'] = 'off';
}
elseif ($perm['print'] == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['print'] = 'on';
}
elseif ($perm['print'] == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['print'] = 'off';
}
elseif ($perm['print'] == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['print']]['print'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['print']] = 'print';
}
;

	}
		
		
	if($this->sc_logged($this->sc_temp_usr_login)):
		;
		$_SESSION['scriptcase']['user_logout'][] = array('V' => 'logged_user', 'U' => 'logout', 'R' => 'app_Login', 'T' => '_top');;
        if($this->sc_temp_sett_session_expire != 'N'){
            if (is_file($_SESSION['scriptcase']['dir_temp'] . "/sc_apl_default_PAYROLL_STANCO02.txt")) {
    unlink($_SESSION['scriptcase']['dir_temp'] . "/sc_apl_default_PAYROLL_STANCO02.txt");
}
if (is_file("../_lib/_app_data/app_Login_ini.php")) {
    $SC_arq_def = fopen($_SESSION['scriptcase']['dir_temp'] . "/sc_apl_default_PAYROLL_STANCO02.txt", "w");
    fwrite ($SC_arq_def, 'app_Login, $this->sc_temp_sett_session_expire');
    fclose ($SC_arq_def);
    setcookie('sc_apl_default_PAYROLL_STANCO02','app_Login, $this->sc_temp_sett_session_expire','0','/', '', ini_get('session.cookie_secure'), ini_get('session.cookie_httponly'));
}
;
        }
		 if (isset($this->usr_email)) {$this->sc_temp_usr_email = $this->usr_email;}
;
		 if (isset($this->usr_picture)) {$this->sc_temp_usr_picture = $this->usr_picture;}
;
		 if (isset($this->usr_name)) {$this->sc_temp_usr_name = $this->usr_name;}
;
		 if (isset($this->usr_phone)) {$this->sc_temp_usr_phone = $this->usr_phone;}
;
		 if (isset($this->usr_login)) {$this->sc_temp_usr_login = $this->usr_login;}
;
    	 if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
 if (isset($this->sc_temp_usr_picture)) { $_SESSION['usr_picture'] = $this->sc_temp_usr_picture;}
 if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
 if (isset($this->sc_temp_usr_phone)) { $_SESSION['usr_phone'] = $this->sc_temp_usr_phone;}
 if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
 if (isset($this->sc_temp_sett_session_expire)) { $_SESSION['sett_session_expire'] = $this->sc_temp_sett_session_expire;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('menu') . "/", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };	
	endif;
}
if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
if (isset($this->sc_temp_usr_picture)) { $_SESSION['usr_picture'] = $this->sc_temp_usr_picture;}
if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
if (isset($this->sc_temp_usr_phone)) { $_SESSION['usr_phone'] = $this->sc_temp_usr_phone;}
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_sett_session_expire)) { $_SESSION['sett_session_expire'] = $this->sc_temp_sett_session_expire;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function tw_return()
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_twitter_name)) {$this->sc_temp_twitter_name = (isset($_SESSION['twitter_name'])) ? $_SESSION['twitter_name'] : "";}
if (!isset($this->sc_temp_twitter_email)) {$this->sc_temp_twitter_email = (isset($_SESSION['twitter_email'])) ? $_SESSION['twitter_email'] : "";}
if (!isset($this->sc_temp_twitter_user)) {$this->sc_temp_twitter_user = (isset($_SESSION['twitter_user'])) ? $_SESSION['twitter_user'] : "";}
  
$this->get_social("twitter", $this->sc_temp_twitter_user, $this->sc_temp_twitter_email,$this->sc_temp_twitter_name);


if (isset($this->sc_temp_twitter_user)) { $_SESSION['twitter_user'] = $this->sc_temp_twitter_user;}
if (isset($this->sc_temp_twitter_email)) { $_SESSION['twitter_email'] = $this->sc_temp_twitter_email;}
if (isset($this->sc_temp_twitter_name)) { $_SESSION['twitter_name'] = $this->sc_temp_twitter_name;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function update_login_img($key_val, $img_val)
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
  
$databaseType = strtolower($this->Ini->nm_tpbanco);
$nm_bases_lob_geral = array_merge(
    $this->Ini->nm_bases_oracle, 
    $this->Ini->nm_bases_ibase, 
    $this->Ini->nm_bases_informix, 
    $this->Ini->nm_bases_mysql, 
    $this->Ini->nm_bases_access, 
    $this->Ini->nm_bases_sqlite, 
    $this->Ini->nm_bases_db2,
	$this->Ini->nm_bases_postgres,
    ['pdo_sqlsrv']
);

if (in_array($databaseType, $this->Ini->nm_bases_access)) {
    $nm_tmp = preg_replace('/\s+/', '', $img_val);

    if (is_string($img_val) && substr($img_val, 0, 4) !== "*nm*" && substr($nm_tmp, 0, 4) === "*nm*") {
        $img_val = $nm_tmp;
    }

    if (!empty($img_val) && $img_val !== 'null' && substr($img_val, 0, 4) !== "*nm*") {
        $img_val = "*nm*" . base64_encode($img_val);
    }
} elseif (in_array($databaseType, $this->Ini->nm_bases_mssql) && $databaseType !== "pdo_sqlsrv") {
    if (!empty($img_val) && $img_val !== 'null' && substr($img_val, 0, 4) !== "*nm*") {
        $img_val = "*nm*" . base64_encode($img_val);
    }
} elseif (!in_array($databaseType, $nm_bases_lob_geral)) {
    $img_val = substr($this->Db->qstr($img_val), 1, -1);
}

$temp_img = "''";
if ($img_val === "" && in_array($databaseType, $this->Ini->nm_bases_access)) {
    $temp_img = "null";
} elseif (!in_array($databaseType, $nm_bases_lob_geral)) {
    $temp_img = "'" . $img_val . "'";
} elseif (in_array($databaseType, array_merge(
    $this->Ini->nm_bases_ibase, 
    $this->Ini->nm_bases_mysql, 
    $this->Ini->nm_bases_access
))) {
    $temp_img = "''";
} elseif (in_array($databaseType, $this->Ini->nm_bases_informix)) {
    $temp_img = "null";
} elseif (!in_array($databaseType, array_merge($this->Ini->nm_bases_sqlite, $this->Ini->nm_bases_postgres))) {
    $temp_img = "empty_blob()";
}

$comando = "UPDATE sec_users SET picture = $temp_img WHERE login = " . $this->Db->qstr($key_val);
$rs = $this->Db->Execute($comando);

if ($rs === false) {
    return $this->Db->ErrorMsg();
}

if (in_array($databaseType, $nm_bases_lob_geral)) {
    $rs = $this->Db->UpdateBlob("sec_users", "picture", $img_val, "login = " . $this->Db->qstr($key_val));
    if ($rs === false) {
        return $this->Db->ErrorMsg();
    }
}

return 'ok';



$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function sc_logged($user, $ip = '')
	{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
  
		$str_sql = "SELECT date_login, ip FROM sec_logged WHERE login = ". $this->Db->qstr($user) ." AND sc_session <> ".$this->Db->qstr('_SC_FAIL_SC_');

		 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->data = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->data = false;
          $this->data_erro = $this->Db->ErrorMsg();
      } 


    if($this->data  === FALSE || !isset($this->data->fields[0]))
		{
            $ip = ($ip == '') ? $_SERVER['REMOTE_ADDR'] : $ip;
            $this->sc_logged_in($user, $ip);
            return true;
        }
		else
		{
            if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_logged']))
{
unset($_SESSION['scriptcase']['sc_apl_conf']['app_logged']);
}
;
            $_SESSION['scriptcase']['sc_apl_seg']['app_logged'] = "on";;
			 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('app_logged') . "/", $this->nm_location, "user?#?" . NM_encode_input($user) . "?@?", "modal", "ret_self", 440, 630);
 };
            return false;
        }
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function sc_verify_logged()
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_logged_date_login)) {$this->sc_temp_logged_date_login = (isset($_SESSION['logged_date_login'])) ? $_SESSION['logged_date_login'] : "";}
if (!isset($this->sc_temp_logged_user)) {$this->sc_temp_logged_user = (isset($_SESSION['logged_user'])) ? $_SESSION['logged_user'] : "";}
  
		$str_sql = "SELECT count(*) FROM sec_logged WHERE login = ". $this->Db->qstr($this->sc_temp_logged_user) . " AND date_login = ". $this->Db->qstr($this->sc_temp_logged_date_login) ." AND sc_session <> ".$this->Db->qstr('_SC_FAIL_SC_');
     
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs_logged = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs_logged[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs_logged = false;
          $this->rs_logged_erro = $this->Db->ErrorMsg();
      } 

    if($this->rs_logged[0][0] != 1)
		{
			 if (isset($this->sc_temp_logged_user)) { $_SESSION['logged_user'] = $this->sc_temp_logged_user;}
 if (isset($this->sc_temp_logged_date_login)) { $_SESSION['logged_date_login'] = $this->sc_temp_logged_date_login;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('app_Login') . "/", $this->nm_location, "", "_parent", "ret_self", 440, 630);
 };
        }
if (isset($this->sc_temp_logged_user)) { $_SESSION['logged_user'] = $this->sc_temp_logged_user;}
if (isset($this->sc_temp_logged_date_login)) { $_SESSION['logged_date_login'] = $this->sc_temp_logged_date_login;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function sc_logged_in($user, $ip = '')
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_logged_date_login)) {$this->sc_temp_logged_date_login = (isset($_SESSION['logged_date_login'])) ? $_SESSION['logged_date_login'] : "";}
if (!isset($this->sc_temp_logged_user)) {$this->sc_temp_logged_user = (isset($_SESSION['logged_user'])) ? $_SESSION['logged_user'] : "";}
  
    $ip = ($ip == '') ? $_SERVER['REMOTE_ADDR'] : $ip;
    $this->sc_temp_logged_user = $user;
    $this->sc_temp_logged_date_login = microtime(true);

        $str_sql = "DELETE FROM sec_logged WHERE login = ". $this->Db->qstr($user) . " AND sc_session = ".$this->Db->qstr('_SC_FAIL_SC_')." AND ip = ".$this->Db->qstr($ip);
    
     $nm_select = $str_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                app_Login_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

    	$str_sql = "INSERT INTO sec_logged(login, date_login, sc_session, ip) VALUES (". $this->Db->qstr($user) .", ". $this->Db->qstr($this->sc_temp_logged_date_login) .", ". $this->Db->qstr(session_id()) .", ". $this->Db->qstr($ip) .")";
    
     $nm_select = $str_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                app_Login_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
if (isset($this->sc_temp_logged_user)) { $_SESSION['logged_user'] = $this->sc_temp_logged_user;}
if (isset($this->sc_temp_logged_date_login)) { $_SESSION['logged_date_login'] = $this->sc_temp_logged_date_login;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function sc_logged_in_fail($user, $ip = '')
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
  
    $ip = ($ip == '') ? $_SERVER['REMOTE_ADDR'] : $ip;
    $user = $this->Db->qstr($user);
        $str_sql = "INSERT INTO sec_logged(login, date_login, sc_session, ip) VALUES (" . $this->Db->qstr($user) . ", " . $this->Db->qstr(microtime(true)) . ", ". $this->Db->qstr('_SC_FAIL_SC_').", " . $this->Db->qstr($ip) . ")";
    
     $nm_select = $str_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                app_Login_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
    return true;
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function sc_logged_is_blocked($ip = '')
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_sett_brute_force_attempts)) {$this->sc_temp_sett_brute_force_attempts = (isset($_SESSION['sett_brute_force_attempts'])) ? $_SESSION['sett_brute_force_attempts'] : "";}
if (!isset($this->sc_temp_sett_brute_force_time_block)) {$this->sc_temp_sett_brute_force_time_block = (isset($_SESSION['sett_brute_force_time_block'])) ? $_SESSION['sett_brute_force_time_block'] : "";}
  
    $ip = ($ip == '') ? $_SERVER['REMOTE_ADDR'] : $ip;
    $minutes_ago = strtotime("-". $this->sc_temp_sett_brute_force_time_block ." minutes");
    $str_select = "SELECT count(*) FROM sec_logged WHERE sc_session = ".$this->Db->qstr('_SC_BLOCKED_SC_')." AND ip = ".$this->Db->qstr($ip)." AND date_login > ". $this->Db->qstr($minutes_ago);
     
      $nm_select = $str_select; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs_logged = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs_logged[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs_logged = false;
          $this->rs_logged_erro = $this->Db->ErrorMsg();
      } 

    if($this->rs_logged  !== FALSE && $this->rs_logged[0][0] == 1)
        {
            $message =  $this->Ini->Nm_lang['lang_user_blocked'] ;
                $message = sprintf($message, 10);
                
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $message;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_app_Login';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_app_Login';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $message;
 }
;
                return true;
        }

        $str_select = "SELECT count(*) FROM sec_logged WHERE sc_session = ".$this->Db->qstr('_SC_FAIL_SC_')." AND ip = ".$this->Db->qstr($ip)." AND date_login > ". $this->Db->qstr($minutes_ago);
         
      $nm_select = $str_select; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs_logged = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs_logged[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs_logged = false;
          $this->rs_logged_erro = $this->Db->ErrorMsg();
      } 


        if($this->rs_logged  !== FALSE && $this->rs_logged[0][0] == $this->sc_temp_sett_brute_force_attempts )
        {
            $str_sql = "INSERT INTO sec_logged(login, date_login, sc_session, ip) VALUES (".$this->Db->qstr('blocked').", ". $this->Db->qstr(microtime(true)) .", ".$this->Db->qstr('_SC_BLOCKED_SC_'). ", ". $this->Db->qstr($ip) .")";
            
     $nm_select = $str_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                app_Login_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
            $message =  $this->Ini->Nm_lang['lang_user_blocked'] ;
                $message = sprintf($message, $this->sc_temp_sett_brute_force_time_block);
                
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $message;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_app_Login';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_app_Login';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $message;
 }
;
                return true;
        }
        return false;
if (isset($this->sc_temp_sett_brute_force_time_block)) { $_SESSION['sett_brute_force_time_block'] = $this->sc_temp_sett_brute_force_time_block;}
if (isset($this->sc_temp_sett_brute_force_attempts)) { $_SESSION['sett_brute_force_attempts'] = $this->sc_temp_sett_brute_force_attempts;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function sc_logged_out($user, $date_login = '')
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_logged_user)) {$this->sc_temp_logged_user = (isset($_SESSION['logged_user'])) ? $_SESSION['logged_user'] : "";}
if (!isset($this->sc_temp_logged_date_login)) {$this->sc_temp_logged_date_login = (isset($_SESSION['logged_date_login'])) ? $_SESSION['logged_date_login'] : "";}
  
		$date_login = ($date_login == '' ? "" : " AND date_login = ". $this->Db->qstr($date_login) ."");

		$str_sql = "SELECT sc_session FROM sec_logged WHERE login = ". $this->Db->qstr($user) ." ". $date_login . " AND sc_session <> ".$this->Db->qstr('_SC_FAIL_SC_');
     
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->data = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->data[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->data = false;
          $this->data_erro = $this->Db->ErrorMsg();
      } 

    if(isset($this->data[0][0]) && !empty($this->data[0][0]))
        {
            $session_bkp = $_SESSION;
            $sessionid = session_id();
            session_write_close();

            session_id($this->data[0][0]);
			session_start();
			$_SESSION['logged_user'] = 'logout';
			session_write_close();

			session_id($sessionid);
			session_start();
			$_SESSION = $session_bkp;
		}


		$str_sql = "DELETE FROM sec_logged WHERE login = ". $this->Db->qstr($user) . " " . $date_login;
		
     $nm_select = $str_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                app_Login_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
		 unset($_SESSION['logged_date_login']);
 unset($this->sc_temp_logged_date_login);
 unset($_SESSION['logged_user']);
 unset($this->sc_temp_logged_user);
;
if (isset($this->sc_temp_logged_date_login)) { $_SESSION['logged_date_login'] = $this->sc_temp_logged_date_login;}
if (isset($this->sc_temp_logged_user)) { $_SESSION['logged_user'] = $this->sc_temp_logged_user;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function sc_looged_check_logout()
    {
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_email)) {$this->sc_temp_usr_email = (isset($_SESSION['usr_email'])) ? $_SESSION['usr_email'] : "";}
if (!isset($this->sc_temp_logged_date_login)) {$this->sc_temp_logged_date_login = (isset($_SESSION['logged_date_login'])) ? $_SESSION['logged_date_login'] : "";}
if (!isset($this->sc_temp_logged_user)) {$this->sc_temp_logged_user = (isset($_SESSION['logged_user'])) ? $_SESSION['logged_user'] : "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
        if(isset($this->sc_temp_logged_user) && ($this->sc_temp_logged_user == 'logout' || empty($this->sc_temp_logged_user)))
        {
             unset($_SESSION['usr_login']);
 unset($this->sc_temp_usr_login);
 unset($_SESSION['logged_user']);
 unset($this->sc_temp_logged_user);
 unset($_SESSION['logged_date_login']);
 unset($this->sc_temp_logged_date_login);
 unset($_SESSION['usr_email']);
 unset($this->sc_temp_usr_email);
;
        }
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_logged_user)) { $_SESSION['logged_user'] = $this->sc_temp_logged_user;}
if (isset($this->sc_temp_logged_date_login)) { $_SESSION['logged_date_login'] = $this->sc_temp_logged_date_login;}
if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              app_Login_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1) 
      { 
          $nm_saida_global = $_SESSION['scriptcase']['nm_sc_retorno']; 
      } 
    if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
    $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_language = $this->language;
    $original_new_user = $this->new_user;
    $original_retrieve_pswd = $this->retrieve_pswd;
}
if (!isset($this->sc_temp_sett_login_mode)) {$this->sc_temp_sett_login_mode = (isset($_SESSION['sett_login_mode'])) ? $_SESSION['sett_login_mode'] : "";}
if (!isset($this->sc_temp_sett_auth_sn_position)) {$this->sc_temp_sett_auth_sn_position = (isset($_SESSION['sett_auth_sn_position'])) ? $_SESSION['sett_auth_sn_position'] : "";}
if (!isset($this->sc_temp_sett_auth_sn_google)) {$this->sc_temp_sett_auth_sn_google = (isset($_SESSION['sett_auth_sn_google'])) ? $_SESSION['sett_auth_sn_google'] : "";}
if (!isset($this->sc_temp_sett_auth_sn_x)) {$this->sc_temp_sett_auth_sn_x = (isset($_SESSION['sett_auth_sn_x'])) ? $_SESSION['sett_auth_sn_x'] : "";}
if (!isset($this->sc_temp_sett_auth_sn_fb)) {$this->sc_temp_sett_auth_sn_fb = (isset($_SESSION['sett_auth_sn_fb'])) ? $_SESSION['sett_auth_sn_fb'] : "";}
if (!isset($this->sc_temp_sett_language)) {$this->sc_temp_sett_language = (isset($_SESSION['sett_language'])) ? $_SESSION['sett_language'] : "";}
if (!isset($this->sc_temp_sett_retrieve_password)) {$this->sc_temp_sett_retrieve_password = (isset($_SESSION['sett_retrieve_password'])) ? $_SESSION['sett_retrieve_password'] : "";}
if (!isset($this->sc_temp_sett_new_users)) {$this->sc_temp_sett_new_users = (isset($_SESSION['sett_new_users'])) ? $_SESSION['sett_new_users'] : "";}
if (!isset($this->sc_temp_return_msg_email_act)) {$this->sc_temp_return_msg_email_act = (isset($_SESSION['return_msg_email_act'])) ? $_SESSION['return_msg_email_act'] : "";}
  $_SESSION['scriptcase']['sc_apl_conf']['app_form_add_users']['start'] = 'new';

if(isset($this->sc_temp_return_msg_email_act) && $this->sc_temp_return_msg_email_act == 1){
    $this->nm_mens_alert[] = $this->Ini->Nm_lang['lang_sec_add_user_success']; $this->nm_params_alert[] = array(
			'title' => $this->Ini->Nm_lang['lang_sec_2fa_success_title'],
			'type' => 'success',
			'timer' => '5000',
			'showConfirmButton' => false,
			'position' => 'center',
			'toast' => true
			); if ($this->NM_ajax_flag) { $this->sc_ajax_alert($this->Ini->Nm_lang['lang_sec_add_user_success'], array(
			'title' => $this->Ini->Nm_lang['lang_sec_2fa_success_title'],
			'type' => 'success',
			'timer' => '5000',
			'showConfirmButton' => false,
			'position' => 'center',
			'toast' => true
			)); }$this->sc_temp_return_msg_email_act=0;
}

if($this->sc_temp_sett_new_users != 'Y'){
    $this->nmgp_cmp_hidden["new_user"] = 'off'; $this->NM_ajax_info['fieldDisplay']['new_user'] = 'off';
}

if($this->sc_temp_sett_retrieve_password != 'Y'){
    $this->nmgp_cmp_hidden["retrieve_pswd"] = 'off'; $this->NM_ajax_info['fieldDisplay']['retrieve_pswd'] = 'off';
}
if($this->sc_temp_sett_language != 'Y'){
    $this->nmgp_cmp_hidden["language"] = 'off'; $this->NM_ajax_info['fieldDisplay']['language'] = 'off';
}


$arr_btn_social = ['#bfacebook_b', '#btwitter_b', '#bgoogle_b', '#sub_form_b'];

if($this->sc_temp_sett_auth_sn_fb != 'Y'){
	unset($arr_btn_social[0]);
	$this->NM_ajax_info['buttonDisplay']['facebook'] = $this->nmgp_botoes["facebook"] = 'off';;
}

if($this->sc_temp_sett_auth_sn_x != 'Y'){
	unset($arr_btn_social[1]);
	$this->NM_ajax_info['buttonDisplay']['twitter'] = $this->nmgp_botoes["twitter"] = 'off';;
}

if($this->sc_temp_sett_auth_sn_google != 'Y'){
	unset($arr_btn_social[2]);
	$this->NM_ajax_info['buttonDisplay']['google'] = $this->nmgp_botoes["google"] = 'off';;
}

$str_btn_social = implode(', ', $arr_btn_social);

if($this->sc_temp_sett_auth_sn_position == 'below'){
	echo <<<CSS
	<style>
		$str_btn_social
		{
			margin: 10px 20px;
			display: block !important;
		}
		.scFormToolbarPadding:not(:has(.sc-unique-btn-1)){
			width: 0 !important;
			padding: 0px;
		}
		.scFormToolbarPadding:has(.sc-unique-btn-1){
			width:100% !important;
			padding:4px;
		}
	</style>
CSS;
}

switch( $this->sc_temp_sett_login_mode ){
	default:
	case 'username':
		$sc_tmp_field_name = 'login';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] =  $this->Ini->Nm_lang['lang_field_login'] ;
		break;
	case 'email':
		$sc_tmp_field_name = 'login';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] =  $this->Ini->Nm_lang['lang_field_email'] ;
		break;
	case 'both':
		$sc_tmp_field_name = 'login';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] =  $this->Ini->Nm_lang['lang_field_both'] ;
		break;
}
if (isset($this->sc_temp_return_msg_email_act)) { $_SESSION['return_msg_email_act'] = $this->sc_temp_return_msg_email_act;}
if (isset($this->sc_temp_sett_new_users)) { $_SESSION['sett_new_users'] = $this->sc_temp_sett_new_users;}
if (isset($this->sc_temp_sett_retrieve_password)) { $_SESSION['sett_retrieve_password'] = $this->sc_temp_sett_retrieve_password;}
if (isset($this->sc_temp_sett_language)) { $_SESSION['sett_language'] = $this->sc_temp_sett_language;}
if (isset($this->sc_temp_sett_auth_sn_fb)) { $_SESSION['sett_auth_sn_fb'] = $this->sc_temp_sett_auth_sn_fb;}
if (isset($this->sc_temp_sett_auth_sn_x)) { $_SESSION['sett_auth_sn_x'] = $this->sc_temp_sett_auth_sn_x;}
if (isset($this->sc_temp_sett_auth_sn_google)) { $_SESSION['sett_auth_sn_google'] = $this->sc_temp_sett_auth_sn_google;}
if (isset($this->sc_temp_sett_auth_sn_position)) { $_SESSION['sett_auth_sn_position'] = $this->sc_temp_sett_auth_sn_position;}
if (isset($this->sc_temp_sett_login_mode)) { $_SESSION['sett_login_mode'] = $this->sc_temp_sett_login_mode;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_language != $this->language || (isset($bFlagRead_language) && $bFlagRead_language)))
    {
        $this->ajax_return_values_language(true);
    }
    if (($original_new_user != $this->new_user || (isset($bFlagRead_new_user) && $bFlagRead_new_user)))
    {
        $this->ajax_return_values_new_user(true);
    }
    if (($original_retrieve_pswd != $this->retrieve_pswd || (isset($bFlagRead_retrieve_pswd) && $bFlagRead_retrieve_pswd)))
    {
        $this->ajax_return_values_retrieve_pswd(true);
    }
}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off'; 
    }
    if (!empty($this->Campos_Mens_erro)) 
    {
        $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
    }
    $this->nm_guardar_campos();
    $this->nm_formatar_campos();
        $this->initFormPages();
    $login = $this->login;
    $pswd = $this->pswd;
    $remember_me = $this->remember_me;
    $new_user = $this->new_user;
    $retrieve_pswd = $this->retrieve_pswd;
    $language = $this->language;
    header("X-XSS-Protection: 1; mode=block");
    header("X-Frame-Options: SAMEORIGIN");
    header("X-Content-Type-Options: nosniff");
    header("Referrer-Policy: same-origin");
    include_once("app_Login_form_user.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array(""))) {
            $searchOk = true;
        }
        elseif ($field == $this->nmgp_fast_search && in_array($field, array(""))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['table_refresh'])
        {
            return NM_encode_input(NM_encode_input($string));
        }
        else
        {
            return NM_encode_input($string);
        }
    } // form_encode_input


    function scCsrfGetToken()
    {
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['csrf_token'];
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

   function Form_lookup_remember_me()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "" . $this->Ini->Nm_lang['lang_sec_remember_me'] . "?#?1?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function SC_fast_search($in_fields, $arg_search, $data_search)
   {
      $fields = (strpos($in_fields, "SC_all_Cmp") !== false) ? array("SC_all_Cmp") : explode(";", $in_fields);
      $this->NM_case_insensitive = false;
      if (empty($data_search)) 
      {
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              app_Login_pack_ajax_response();
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
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_filter_form'] . " and (" . $comando . ")";
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
      $qt_geral_reg_app_Login = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['total'] = $qt_geral_reg_app_Login;
      $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          app_Login_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          app_Login_pack_ajax_response();
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
      
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['decimal_db'] == ".")
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
       $nmgp_saida_form = "app_Login_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['nm_run_menu'] = 2;
       $nmgp_saida_form = "app_Login_fim.php";
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
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['redir_target_name']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['redir_target_name'])
       {
           $sTarget = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['redir_target_name'];
           unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['redir_target_name']);
       }
       else
       {
           $sTarget = '_self';
       }
       $this->NM_ajax_info['redir']['metodo']              = 'post';
       $this->NM_ajax_info['redir']['action']              = $nmgp_saida_form;
       $this->NM_ajax_info['redir']['target']              = $sTarget;
       $this->NM_ajax_info['redir']['script_case_init']    = $this->Ini->sc_page;
       if (0 == $tipo)
       {
           $this->NM_ajax_info['redir']['nmgp_url_saida'] = $this->nm_location;
       }
       app_Login_pack_ajax_response();
       exit;
   }
?>
<!DOCTYPE html>

   <HTML>
   <HEAD>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['masterValue']);
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
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login'][substr($val, 1, -1)];
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opc_ant'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           app_Login_pack_ajax_response();
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
       app_Login_pack_ajax_response();
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
    function sc_ajax_alert($sMessage, $params = array())
    {
        if ($this->NM_ajax_flag)
        {
            $this->NM_ajax_info['ajaxAlert']['message'] = NM_charset_to_utf8($sMessage);
            $this->NM_ajax_info['ajaxAlert']['params']  = $this->sc_ajax_alert_params($params);
        }
    } // sc_ajax_alert

    function sc_ajax_alert_params($params)
    {
        $paramList = array();
        foreach ($params as $paramName => $paramValue)
        {
            if (in_array($paramName, array('title', 'timer', 'confirmButtonText', 'confirmButtonFA', 'confirmButtonFAPos', 'cancelButtonText', 'cancelButtonFA', 'cancelButtonFAPos', 'footer', 'width', 'padding', 'position')))
            {
                $paramList[$paramName] = NM_charset_to_utf8($paramValue);
            }
            elseif (in_array($paramName, array('showConfirmButton', 'showCancelButton', 'toast')) && in_array($paramValue, array(true, false)))
            {
                $paramList[$paramName] = NM_charset_to_utf8($paramValue);
            }
            elseif ('position' == $paramName && in_array($paramValue, array('top', 'top-start', 'top-end', 'center', 'center-start', 'center-end', 'bottom', 'bottom-start', 'bottom-end')))
            {
                $paramList[$paramName] = NM_charset_to_utf8($paramValue);
            }
            elseif ('type' == $paramName && in_array($paramValue, array('warning', 'error', 'success', 'info', 'question')))
            {
                $paramList[$paramName] = NM_charset_to_utf8($paramValue);
            }
            elseif ('background' == $paramName)
            {
                $paramList[$paramName] = $this->sc_ajax_alert_image(NM_charset_to_utf8($paramValue));
            }
        }
        return $paramList;
    } // sc_ajax_alert_params

    function sc_ajax_alert_image($background)
    {
        $image_param = $background;
        preg_match_all('/url\(([\s])?(["|\'])?(.*?)(["|\'])?([\s])?\)/i', $background, $matches, PREG_PATTERN_ORDER);
        if (isset($matches[3])) {
            foreach ($matches[3] as $match) {
                if ('http:' != substr($match, 0, 5) && 'https:' != substr($match, 0, 6) && '/' != substr($match, 0, 1)) {
                    $image_param = str_replace($match, "{$this->Ini->path_img_global}/{$match}", $image_param);
                }
            }
        }
        return $image_param;
    } // sc_ajax_alert_image
    function getButtonIds($buttonName) {
        switch ($buttonName) {
            case "ok":
                return array("sub_form_b.sc-unique-btn-1");
                break;
            case "facebook":
                return array("bfacebook_b.sc-unique-btn-2");
                break;
            case "google":
                return array("bgoogle_b.sc-unique-btn-3");
                break;
            case "twitter":
                return array("btwitter_b.sc-unique-btn-4");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr><td class="sc-app-header">
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo ""; } else { echo "Login"; } ?></div>
    <div class="scFormHeaderFont" style="float: right;"></div>
</div>
    </td></tr>
<?php
    }

    function displayAppFooter()
    {
    }

    function displayAppToolbars()
    {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['ordem_ord'] == " desc") {
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
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            default:
                return 'asc';
        }
        return 'asc';
    }

}
?>
