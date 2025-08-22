<?php
 @session_start();
 $script_case_init = filter_input(INPUT_GET, 'script_case_init', FILTER_SANITIZE_NUMBER_INT);
 $path_botoes      = (isset($_GET['path_botoes']))     ? strip_tags($_GET['path_botoes']) : "";
 $apl_dependente   = (isset($_GET['apl_dependente']))  ? strip_tags($_GET['apl_dependente']) : "";
 $apl_opcao        = (isset($_GET['opcao']))           ? strip_tags($_GET['opcao'])   : "print";
 $apl_atual        = (isset($_GET['apl_prt']))         ? strip_tags($_GET['apl_prt']) : "index.php";
 $apl_cor_print    = (isset($_GET['cor_print']))        ? strip_tags($_GET['cor_print']) : "PB";
 $apl_pag_ativa    = (isset($_GET['SC_Pdf_pag_ativa'])) ? strip_tags($_GET['SC_Pdf_pag_ativa']) : "";
 $apl_tipo_print   =  "RC";
 $apl_saida        = (isset($_GET['apl_saida'])) ? strip_tags($_GET['apl_saida']) : "";
?><!DOCTYPE html>
<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
 <head>
  <title>frm_loan_enterprise :: PRINT</title>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
  <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
  <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?>" GMT">
  <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
  <META http-equiv="Cache-Control" content="post-check=0, pre-check=0">
  <META http-equiv="Pragma" content="no-cache">
  <link rel="shortcut icon" href="../_lib/img/sys__NM__ico__NM__favicon (2).ico">
 </head>
 <body>
  <form name="Fini" method="post" 
        action="<?php echo $apl_atual ?>" 
        target="_self"> 
    <input type="hidden" name="nmgp_opcao" value="<?php echo $apl_opcao;?>"/> 
    <input type="hidden" name="nmgp_tipo_print" value="<?php echo $apl_tipo_print;?>"/> 
    <input type="hidden" name="nmgp_cor_print" value="<?php echo $apl_cor_print;?>"/> 
    <input type="hidden" name="SC_Pdf_pag_ativa" value="<?php echo $apl_pag_ativa;?>"/> 
    <input type="hidden" name="nmgp_navegator_print" value=""/> 
    <input type="hidden" name="script_case_init" value="<?php echo $script_case_init ?>"/> 
  </form> 
 <script>
    document.Fini.nmgp_navegator_print.value = navigator.appName;
    document.Fini.submit();
 </script>
 </body>
</html>
