<?php
   include_once('frm_UpdateTcaAddByDept_session.php');
   session_start();
   if (!isset($_SESSION['sc_session']))
   {
?><!DOCTYPE html>
   <html>
    <body>
     <form name="F0" method=post
                  target="_self"
                  action="./">
     </form>
     <script type="text/javascript">
        document.F0.submit();
     </script>
    </body>
   </html>
<?php
     exit;
   }
   if (!function_exists("NM_is_utf8"))
   {
       include_once("../_lib/lib/php/nm_utf8.php");
   }

//----- 
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
                $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
             }
            $$nmgp_var = $nmgp_val;
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
                $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
             }
            $$nmgp_var = $nmgp_val;
       }
   }
   if (isset($_SESSION['session_sec_aplicacao']["PAYROLL_STANCO02_____frm_UpdateTcaAddByDept"]))
   {
      unset($_SESSION['session_sec_aplicacao']["PAYROLL_STANCO02_____frm_UpdateTcaAddByDept"]);
   }

   if (isset($_SESSION['session_sec_aplicacao']) && empty($_SESSION['session_sec_aplicacao']))
   {
      unset($_SESSION['session_sec_aplicacao']);
      unset($_SESSION['session_sec_usuario']);
   }
   if (isset($script_case_init) && !is_array($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']))
   {
      unset($_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['sc_redir_atualiz']);
      unset($_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['sc_redir_insert']);
   }
   $fecha_janela = false;
   if (isset($script_case_init) && !is_array($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['sc_outra_jan']) && $_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['sc_outra_jan'])
   {
       if (isset($_SESSION['scriptcase']['sc_force_url_saida'][$script_case_init]) && !empty($_SESSION['scriptcase']['sc_url_saida'][$script_case_init]))
       { }
       else
       {
           $fecha_janela = true;
       }
   }
   if (isset($_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['nm_run_menu']) && $_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['nm_run_menu'] == 2)
   {
       $fecha_janela   = true;
       $fecha_aba_menu = true;
   }
   $Tem_refresh_aba_menu = false;
   if ((isset($nmgp_parms) && $nmgp_parms == "glo_menu") || $fecha_janela)
   {
       if (isset($script_case_init) && !is_array($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['sc_modal']) && $_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['sc_modal'])
       {
           unset($_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['sc_modal']);
           if (!isset($_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['db_changed']) || $_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['db_changed'])
           {
               if (isset($_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['lig_iframe_modal']))
               {
                   $iframe_master = $_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['lig_iframe_modal'];
                   $saida_final = "if (typeof parent.document.getElementById('" . $iframe_master . "').contentWindow.nm_gp_move == 'function') { parent.document.getElementById('" . $iframe_master . "').contentWindow.nm_gp_move('edit'); } closeModal()";
                   unset($_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['lig_iframe_modal']);
               }
               else
               {
                   $saida_final = "if (typeof parent.nm_gp_move == 'function') { parent.nm_gp_move('edit'); } closeModal()";
               }
           }
           else
           {
               $saida_final = "closeModal()";
           }
       }
       else
       {
           if (!isset($script_case_init) || is_array($script_case_init) || !isset($_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['db_changed']) || $_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['db_changed'])
           {
               if (isset($_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['Refresh_aba_menu']) && !empty($_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['Refresh_aba_menu'])) {
                   $iframe_master = $_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['Refresh_aba_menu'];
                   $saida_final = "if (typeof parent.document.getElementById('iframe_" . $iframe_master . "').contentWindow.nm_gp_move == 'function') { parent.document.getElementById('iframe_" . $iframe_master . "').contentWindow.nm_gp_move('edit'); } ";
                   unset($_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['Refresh_aba_menu']);
                   $Tem_refresh_aba_menu = true;
               }
               else {
                  $saida_final = "if (opener && opener['nm_gp_move']) {opener.nm_gp_move('edit');} window.close()";
               }
           }
           else
           {
               $saida_final = "window.close()";
           }
       }
       if (isset($_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['lig_iframe_modal']))
       {
           $Save_modal = $_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['lig_iframe_modal'];
           nm_limpa_arr_session();
           $_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['lig_iframe_modal'] = $Save_modal;
       }
       else
       {
           nm_limpa_arr_session();
       }
?>
<!DOCTYPE html>

<HTML>
<HEAD>
 <TITLE>frm_UpdateTcaAddByDept</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && isset($_SESSION['scriptcase']['display_mobile']) && $_SESSION['scriptcase']['display_mobile'])
{
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}

?>
</HEAD>
<BODY>
<SCRIPT LANGUAGE="Javascript">
    function closeModal()
    {
        self.parent.tb_remove();
    }
<?php
if (isset($fecha_aba_menu) && $fecha_aba_menu)
{
?>
   if (typeof parent.del_aba_td === 'function') 
   { 
<?php
       if ($Tem_refresh_aba_menu) {
           echo $saida_final; 
       } 
?>
       parent.del_aba_td('frm_UpdateTcaAddByDept');
   } 
   else 
   { 
       <?php echo $saida_final; ?>;
   } 
<?php
}
else
{
   echo $saida_final;
}
?>
</SCRIPT>
</BODY>
</HTML>
<?php
   }
   elseif (!isset($script_case_init) || is_array($script_case_init) || !isset($_SESSION['scriptcase']['sc_url_saida'][$script_case_init]) || empty($_SESSION['scriptcase']['sc_url_saida'][$script_case_init]))
   {
           nm_limpa_arr_session();
?>
<!DOCTYPE html>

<HTML>
<HEAD>
 <TITLE>frm_UpdateTcaAddByDept</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
{
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}

?>
</HEAD>
<BODY>
<SCRIPT LANGUAGE="Javascript">
  history.back();
</SCRIPT>
</BODY>
</HTML>
<?php
   }
   else
   {
       nm_limpa_arr_session();
?>
<!DOCTYPE html>

<HTML>
<HEAD>
 <TITLE>frm_UpdateTcaAddByDept</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
{
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}

?>
</HEAD>
<BODY>
<form name="fsai" method="post" action="<?php echo $_SESSION['scriptcase']['sc_url_saida'][$script_case_init]; ?>">
<input type=hidden name="script_case_init" value="<?php  echo NM_encode_input($script_case_init); ?>"> 
</form>
<SCRIPT LANGUAGE="Javascript">
   nm_ver_saida = "<?php echo $_SESSION['scriptcase']['sc_url_saida'][$script_case_init]; ?>";
   nm_ver_saida = nm_ver_saida.toLowerCase();
   if (nm_ver_saida.substr(0, 4) != ".php" && (nm_ver_saida.substr(0, 7) == "http://" || nm_ver_saida.substr(0, 8) == "https://" || nm_ver_saida.substr(0, 3) == "../")) 
   { 
       window.location = ("<?php echo $_SESSION['scriptcase']['sc_url_saida'][$script_case_init]; ?>"); 
   } 
   else 
   { 
       document.fsai.submit();
   } 
</SCRIPT>
</BODY>
</HTML>
<?php
   }
   function nm_limpa_arr_session()
   {
      global $script_case_init;
      $achou = false;
      if (!isset($script_case_init) || is_array($script_case_init) || !isset($_SESSION['sc_session'][$script_case_init]))
      {
          return;
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['embutida_filho']))
      {
          foreach ($_SESSION['sc_session'][$script_case_init]['frm_UpdateTcaAddByDept']['embutida_filho'] as $ind => $sc_init)
          {
              unset($_SESSION['sc_session'][$sc_init]);
          }
      }
      foreach ($_SESSION['sc_session'][$script_case_init] as $nome_apl => $resto)
      {
          if ($nome_apl == 'frm_UpdateTcaAddByDept' || $achou)
          {
              unset($_SESSION['sc_session'][$script_case_init][$nome_apl]);
              $achou = true;
          }
      }
      if (empty($_SESSION['sc_session'][$script_case_init]))
      {
          unset($_SESSION['sc_session'][$script_case_init]);
      }
   }
?>
