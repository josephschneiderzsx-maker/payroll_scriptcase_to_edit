<?php
class grid_tbl_statement_all01_lookup
{
   function lookup_res_username_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "username";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_tbl_statement_all01']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_tbl_statement_all01']['where_res_lookup'];
       }
       $nm_comando .= " GROUP BY " .$campos_select . "";
       $nm_comando .= " order by " . $campos_select . "";
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
       if ($RSI = $this->Db->Execute($nm_comando))
       {
           while (!$RSI->EOF) 
           {
               $val_orig   = $RSI->fields[0];
               $val_format = $val_orig;
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_tbl_statement_all01']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'username_SC_1', 'opt' => $val_orig, 'value' => $val_format);
               $RSI->MoveNext() ;
           }
           $RSI->Close(); 
       }
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
       return $result;
   }
}
?>
