<?php

nm_load_class('interface', 'Connection');
$obj_conn = new nmConnection();

//Carrega Array com Grupos do ScriptCase
$db_sgdb           = $this->GetVar('db_sgdb');
$btn_avanc         = $this->GetVar('btn_avanc');
$btn_retor         = $this->GetVar('btn_retor');
$sgdb              = $this->GetVar('sgdb');
$decimal           = $this->GetVar('decimal');
$date_separator    = $this->GetVar('date_separator');
$use_persistent    = $this->GetVar('use_persistent');
$use_schema        = $this->GetVar('use_schema');
$retrieve_schema   = $this->GetVar('retrieve_schema');
$edit_conn         = $this->GetVar('edit_conn') == "S";
$filter_list       = $this->GetVar('arr_filters');
$id_edit_conn      = $this->GetVar('id_edit_conn');
$force_name_conn   = $this->GetVar('force_name_conn');

$use_ssl           = $this->GetVar('use_ssl');
$mysql_ssl_key     = $this->GetVar('mysql_ssl_key');
$mysql_ssl_cert    = $this->GetVar('mysql_ssl_cert');
$mysql_ssl_capath  = $this->GetVar('mysql_ssl_capath');
$mysql_ssl_ca      = $this->GetVar('mysql_ssl_ca');
$mysql_ssl_cipher  = $this->GetVar('mysql_ssl_cipher');

$postgres_sslmode  = $this->GetVar('postgres_sslmode');
$postgres_sslrootcert  = $this->GetVar('postgres_sslrootcert');
$postgres_sslkey  = $this->GetVar('postgres_sslkey');
$postgres_sslcert  = $this->GetVar('postgres_sslcert');

$mssql_encrypt  = $this->GetVar('mssql_encrypt');
$mssql_trustservercertificate  = $this->GetVar('mssql_trustservercertificate');
$mssql_truststore  = $this->GetVar('mssql_truststore');
$mssql_truststorepassword  = $this->GetVar('mssql_truststorepassword');
$mssql_hostnameincertificate  = $this->GetVar('mssql_hostnameincertificate');

$arr_ssh = array('use_ssh', 'ssh_server', 'ssh_user', 'ssh_port', 'ssh_privatecert', 'ssh_localportforwarding', 'ssh_localserver', 'ssh_localport');
foreach($arr_ssh as $_input)
{
    $$_input = $this->GetVar($_input);
}
$arr_db2ssl = array('security', 'sslservercertificate', 'sslclientkeystoredb', 'sslclientkeystash', 'authentication', 'sslclientlabel', );
foreach($arr_db2ssl as $_input)
{
    $$_input = $this->GetVar($_input);
}

$db_dbms_drive_group = $obj_conn->getSgdbGroupByDrive();

if(empty($decimal))
{
    $decimal = '.';
}

$dbms = $this->GetVar('dbms');
$conn = $this->GetVar('conn');
$user = $this->GetVar('user');
$pass = $this->GetVar('pass');

if (!$edit_conn && $this->GetVar('nome_conn_sugerido') != "")
{
    $conn = $this->GetVar('nome_conn_sugerido');
}

$str_title_conn = $nm_lang['mainmenu_new_conn'];
$lbl_filter     = $nm_lang['btn_filt'];

if ($edit_conn)
{
    $str_title_conn = $nm_lang['lbl_connection_edit'];
}

?>

<script language="javascript">

    $(document).ready(function() {

        setTimeout(function () {nm_post_conn_ajax('S');}, 1);

    });


    <?php
    /*

        var num_seq_row_filter = <?php echo (count($filter_list['list']) - 1); ?>;

        function fc_check_add_new_filter(str_focus)
        {
            rows_filter = $('tr', $('#tab_filter'));
            bln_add     = true;

            //Limpa linhas vazias
            for(nI = rows_filter.length - 1; nI > 0; nI--)
            {
                num_seq = $(rows_filter[nI]).attr('id_obj');

                if ($('#filter_table_' + num_seq).val() == "" && $('#filter_owner_' + num_seq).val() == "" && nI != (rows_filter.length - 1) )
                {
                    document.getElementById('tab_filter').deleteRow(nI);
                }
            }

            //Verifica se precisa adicionar mais uma linha
            for(nI = rows_filter.length - 1; nI > 0; nI--)
            {
                num_seq = $(rows_filter[nI]).attr('id_obj');
                if ($('#filter_table_' + num_seq).val() == "" && $('#filter_owner_' + num_seq).val() == "")
                {
                    bln_add = false;
                    break;
                }
            }

            //Adiciona mais uma linha
            if (bln_add)
            {
                num_seq_row_filter++;

                new_row = document.getElementById('tab_filter').insertRow(rows_filter.length);
                $(new_row).attr('id_obj', num_seq_row_filter);
                cell_table = new_row.insertCell(0);
                cell_owner = new_row.insertCell(1);
                cell_show  = new_row.insertCell(2);

                cell_table.innerHTML = "<input id='filter_table_"+ num_seq_row_filter +"' type='text' name='filter_table["+ num_seq_row_filter +"]' value='' size='15' class='nmInput' onchange=\"fc_check_add_new_filter('filter_owner_" + num_seq_row_filter + "')\">";
                cell_owner.innerHTML = "<input id='filter_owner_"+ num_seq_row_filter +"' type='text' name='filter_owner["+ num_seq_row_filter +"]' value='' size='15' class='nmInput' onchange=\"fc_check_add_new_filter('filter_show_" + num_seq_row_filter + "')\">";
                cell_show.innerHTML  = "<select id='filter_show_"+ num_seq_row_filter +"' class='nmInput' name='filter_show["+ num_seq_row_filter +"]'>" +
                                       "	<option value='Y'><?php echo $nm_lang['option_yes']; ?></option>" +
                                       "	<option value='N' selected><?php echo $nm_lang['option_no']; ?></option>" +
                                       "</select>";
            }

        }

    */
    ?>

</script>

<form name='frm_back_edit' style="display:none" action="<?php echo nm_url_rand($nm_config['url_iface'] . 'admin_sys_allconections_create_wizard.php'); ?>" method="GET">
    <input type="hidden" name="conn_open" value="S" />
</form>


<div class="ui container">
    <form action="" onsubmit="return false;" name="form_create" METHOD="post" class="ui form">
        <input type="hidden" name="dbms" id="dbms" value="<?php echo $dbms; ?>" />
        <input type="hidden" name="edit_conn" value="<?php echo $this->GetVar('edit_conn'); ?>" />
        <input type="hidden" name="id_edit_conn" value="<?php echo $id_edit_conn; ?>" />
        <input type="hidden" id="carregar_db" value="S" />
        <!--br-->

        <div id='tr_title_extra' class="ui dividing header" style="display: flex;flex-direction: row;justify-content: space-between;align-items: flex-end;">
            <?php

            $img        = $obj_conn->nm_db_sc_type($dbms);
            $imgStyle   = "";
            $imgOverlay = "";
            if(isset($db_dbms_drive_group[ $dbms ]))
            {
                $img        = $db_dbms_drive_group[ $dbms ];
                $imgStyle   = "opacity: 0.4;";
                $imgOverlay = '<img src="'. $nm_config['url_img'] .'db_'. $obj_conn->nm_db_sc_type($dbms) .'.png" width="100%" style="max-width:90px;margin: 0 auto; width: 60%; position: absolute; left: 18px; top: 12px;">';
            }

            ?>
            <?php echo $str_title_conn; ?>
            <div style="display: inline-block; position: relative;">
                <div style="display: inline-block; position: relative; "><?php echo $this->GetVar('block_image_help'); ?></div>
                <img src="<?php echo $nm_config['url_img']; ?>db_<?php echo $img; ?>.png" border="0" style="max-width:90px;margin: 0 auto; <?php echo $imgStyle; ?>" />
                <?php echo $imgOverlay; ?>
            </div>
        </div>
        <div id='tab_new_conn'>
            <div id='tabs_selector' class="ui top attached tabular menu">
                <a class="item active" data-tab="conn_data"><?php echo $str_title_conn; ?></a>
                <?php
                if ($dbms == 'mysql' || $dbms == 'mariadb' || $dbms == 'postgres' || $dbms == 'mssql' || $dbms == 'db2') {
                    ?>
                    <a class="item" data-tab="tr_security"><?php echo $nm_lang['mainmenu_sec_tab']; ?></a>
                    <?php
                }
                ?>
                <a class="item" data-tab="tr_advanced"><?php echo $nm_lang['mainmenu_new_conn_tab']; ?></a>
                <a class="item" data-tab="tr_ssh" style="display: <?php echo ($nm_config['os_code'] == 'windows'?'none':''); ?>;">SSH</a>
            </div>
            <div id='conn_data' class="ui bottom attached active tab segment" data-tab="conn_data">
                <div class="two fields">
                    <div class="field">
                        <label><?php echo $nm_lang['label']['conn']; ?></label>
                        <?php
                        if ($force_name_conn != "")
                        {
                            ?>
                            <INPUT value='<?php echo $force_name_conn; ?>' type="text" disabled class="nmInput" style="display:<?php echo ($edit_conn ? "none" : ""); ?>">
                            <INPUT type="hidden" name='conn' value='<?php echo $force_name_conn; ?>' >
                            <?php
                        }
                        else
                        {
                            ?>
                            <INPUT name='conn' value='<?php echo $conn; ?>' type="text" class="nmInput" style="display:<?php echo ($edit_conn ? "none" : ""); ?>">
                            <?php
                        }
                        ?>


                        <?php
                        if ($edit_conn)
                        {
                            $conn_aux = strlen($conn) > 17 ? substr($conn, 0, 16) . "..." : $conn;
                            ?>
                            <div style="color:gray;width:130px;height: 30px;display: flex;flex-direction: row;justify-content: flex-start;align-items: center;" title="<?php echo $conn; ?>">
                                <div class="nmLineV3" style="margin-left:11px">&nbsp;<?php echo $conn_aux; ?></div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="field">
                        <label><?php echo $nm_lang['label']['sgdb']; ?></label>
                        <select class="nmInput" name='sgdb' onchange="nm_post_conn_ajax()">
                            <?php
                            $ops = [''];
                            $filled = false;
                            foreach ($db_sgdb as $str_name => $str_value)
                            {
                                $selected = "";
                                if($sgdb==$str_name)
                                {
                                    $selected = ' selected ';
                                }
                                if ($filled || (strpos($str_value , 'PDO') === false) ) {
                                    $ops[] = "<option value='$str_name' $selected>$str_value</option>";
                                } else {
                                    $ops[0] = "<option value='$str_name' $selected>$str_value</option>";
                                    $filled = true;
                                }
                            }
                            foreach ($ops as $op) {
                                echo $op;
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div id='tr_dados_rep' style="display: none">
                    <div colspan="2" id="td_dados_rep">
                    </div>
                </div>

                <div id='tr_load_ajax' style="display: none">
                    <div colspan="2" id="td_load_ajax" height="70px" valign="middle" align="center" style="display:">
                        <center>
                            <img src="<?php echo $nm_config['url_img']; ?>load_ajax_blue.gif" />
                        </center>
                    </div>
                </div>

                <div id='tr_dados_usu'>
                    <div colspan="2" id="td_dados_usu" style="display:none">
                        <div class="two fields">
                            <div class="field">
                                <label><?php echo $nm_lang['label']['user']; ?></label>
                                <input type='text' name='user' id='user' value='<?php echo $user?>' class="nmInput"  onchange="" >
                            </div>

                            <div class="field" style="display:<?php echo $dbms == 'sqlite' ? 'none' : ''; ?>">
                                <label><?php echo $nm_lang['label']['pass']; ?></label>
                                <input type='password' name='pass' id='pass' value='<?php echo $pass?>' class="nmInput" onchange="">
                            </div>
                        </div>

                        <?php
                        if ($obj_conn->nm_db_sc_type($dbms) == 'mysql' || $obj_conn->nm_db_sc_type($dbms) == 'mariadb')
                        {
                            ?>
                            <div class="field" onclick="fc_get_db('', '');">
                                <label><?php echo $nm_lang['label']['base']; ?></label>
                                <div id='span_sel_database_name' style="display: flex; flex-direction: column; justify-content: center; align-items: stretch;">
                                    <select name='sel_base' id='sel_base' class="nmInput">
                                        <option></option>
                                    </select>
                                </div>

                                <input type="button" value="<?php echo $nm_lang['label']['listar_base']; ?>" onclick="$('#carregar_db').val('S');" class="ui primary button" />
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div id='tr_filter' style="display:none">
                    <div colspan="2" width="100%" height="200px">
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                                <td width="2%">&nbsp;</td>
                                <td class="nmLineV3" width="38%" valign="top" style="border-right: 1px dotted #bfdaf2;">
                                    <?php echo $nm_lang['lbl_exi']; ?>

                                    <table style="font-size:4px"><tr><td>&nbsp;</td></tr></table>
                                    <input type="checkbox" name="show_table" value="Y"      <?php echo ($filter_list['show_table']  == 'Y' ? 'checked' : ''); ?>><span class="nmText"><?php echo $nm_lang['lbl_show_table'];?></span><BR>
                                    <input type="checkbox" name="show_view" value="Y"       <?php echo ($filter_list['show_view']  == 'Y' ? 'checked' : ''); ?>><span class="nmText"><?php echo $nm_lang['lbl_show_view'];?></span><BR>
                                    <input type="checkbox" name="show_system" value="Y"     <?php echo ($filter_list['show_system']  == 'Y' ? 'checked' : ''); ?>><span class="nmText"><?php echo $nm_lang['lbl_show_system'];?></span><BR>
                                    <input type="checkbox" name="show_procedure" value="Y"  <?php echo ($filter_list['show_procedure']  == 'Y' ? 'checked' : ''); ?>><span class="nmText"><?php echo $nm_lang['lbl_show_proc'];?></span>
                                </td>
                                <td width="2%">&nbsp;</td>
                                <td width="58%" valign="top">
                                    <div class="nmLineV3">
                                        <?php echo $nm_lang['lbl_filt']; ?>
                                    </div>
                                    <div id='div_tab_filter' class="nmLineV3" style="width:100%; height:150px; overflow:auto;">
                                        <table width="90%" id='tab_filter'>
                                            <tr>
                                                <td><span class="nmText"><?php echo $nm_lang['lbl_filt_tab']; ?></span></td>
                                                <td><span class="nmText"><?php echo $nm_lang['lbl_filt_owner']; ?></span></td>
                                                <td><span class="nmText"><?php echo $nm_lang['lbl_exi']; ?></span></td>
                                            </tr>

                                            <?php
                                            /*
                                            foreach ($filter_list['list'] as $i => $arr_fields_list)
                                            {
                                                $selected_y = $arr_fields_list['filter_show'] == 'Y' ? 'selected' : '';
                                                $selected_n = $arr_fields_list['filter_show'] != 'Y' ? 'selected' : '';
                                            ?>
                                                <tr class="tr_fld_filter" id_obj="<?php echo $i; ?>">
                                                    <td><input id='filter_table_<?php echo $i; ?>' type="text" name="filter_table[<?php echo $i; ?>]" value="<?php echo $arr_fields_list['filter_table']; ?>" size="15" class="nmInput" onchange="fc_check_add_new_filter('filter_owner_<?php echo $i; ?>')"></td>
                                                    <td><input id='filter_owner_<?php echo $i; ?>' type="text" name="filter_owner[<?php echo $i; ?>]" value="<?php echo $arr_fields_list['filter_owner'] ?>"  size="15" class="nmInput" onchange="fc_check_add_new_filter('filter_show_<?php echo $i; ?>')"></td>
                                                    <td>
                                                        <select id='filter_show_<?php echo $i; ?>' class="nmInput" name="filter_show[<?php echo $i; ?>]">
                                                            <option value="Y" <?php echo $selected_y; ?>><?php echo $nm_lang['option_yes']; ?></option>
                                                            <option value="N" <?php echo $selected_n; ?>><?php echo $nm_lang['option_no']; ?></option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            <?php
                                            }*/
                                            ?>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table cellpadding="0" cellspacing="0" border="0" width="100%" height="30px"> <!--style="border: 1px dotted #bfdaf2;"-->
                            <tr style="display:none">
                                <td class="nmLineV3" align="center" valign="middle" onclick="fc_show_filter(false, true)" style="cursor:pointer">
                                    <img src="<?php echo $nm_config['url_img']; ?>hide_funil.png" border="0" /> <?php echo $nm_lang['lbl_hide_filter']; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div id='tr_security' class="ui bottom attached tab segment" data-tab="tr_security" style="">
                <?php
                    if($obj_conn->nm_db_sc_type($dbms) == 'mysql' || $obj_conn->nm_db_sc_type($dbms) == 'mariadb')
                    {
                        ?>
                        <div class="field" id='tr_use_ssl'>
                            <label><?php echo $nm_lang['label']['use_ssl']; ?></label>
                            <div class="ui">
                                <input type="radio" name='use_ssl' id='use_ssl_y' value="Y" onClick="" <?php echo ($use_ssl=='Y')?"checked=checked":""; ?> />
                                <label for="use_ssl_y"><?php echo $nm_lang['values']['sim']; ?></label>
                                &nbsp;&nbsp;
                                <input type="radio" name='use_ssl' id='use_ssl_n' value="N" onClick="" <?php echo ($use_ssl!='Y')?"checked=checked":""; ?> />
                                <label for="use_ssl_n"><?php echo $nm_lang['values']['nao']; ?></label>
                            </div>
                        </div>
                        <div class="two fields" >
                            <div class="twelve wide field" id='tr_mysql_ssl_key' style="display:<?php echo ($dbms != 'mysql' && $dbms != 'mariadb') ? 'none' : ''; ?>">
                                <label><?php echo $nm_lang['label']['mysql_ssl_key']; ?></label>
                                <input type="text" class="nmInput" name='mysql_ssl_key' id='mysql_ssl_key' value="<?php echo str_replace('"', '&quot;', $mysql_ssl_key); ?>" />
                            </div>
                            <div class="twelve wide field" id='tr_mysql_ssl_cert' style="display:<?php echo ($dbms != 'mysql' && $dbms != 'mariadb') ? 'none' : ''; ?>">
                                <label><?php echo $nm_lang['label']['mysql_ssl_cert']; ?></label>
                                <input type="text" class="nmInput" name='mysql_ssl_cert' id='mysql_ssl_cert' value="<?php echo str_replace('"', '&quot;', $mysql_ssl_cert); ?>" />
                            </div>
                        </div>
                        <div class="two fields" >
                            <div class="field" id='tr_mysql_ssl_capath' style="display:<?php echo ($dbms != 'mysql' && $dbms != 'mariadb') ? 'none' : ''; ?>">
                                <label><?php echo $nm_lang['label']['mysql_ssl_capath']; ?>&nbsp;</label>
                                <input type="text" class="nmInput" name='mysql_ssl_capath' id='mysql_ssl_capath' value="<?php echo str_replace('"', '&quot;', $mysql_ssl_capath); ?>" />
                            </div>
                            <div class="field" id='tr_mysql_ssl_ca' style="display:<?php echo ($dbms != 'mysql' && $dbms != 'mariadb') ? 'none' : ''; ?>">
                                <label><?php echo $nm_lang['label']['mysql_ssl_ca']; ?></label>
                                <input type="text" class="nmInput" name='mysql_ssl_ca' id='mysql_ssl_ca' value="<?php echo str_replace('"', '&quot;', $mysql_ssl_ca); ?>" />
                            </div>
                        </div>
                        <div class="field" id='tr_mysql_ssl_cipher' style="display:<?php echo ($dbms != 'mysql' && $dbms != 'mariadb') ? 'none' : ''; ?>">
                            <label><?php echo $nm_lang['label']['mysql_ssl_cipher']; ?></label>
                            <input type="text" class="nmInput" name='mysql_ssl_cipher' id='mysql_ssl_cipher' value="<?php echo str_replace('"', '&quot;', $mysql_ssl_cipher); ?>" />
                        </div>
                        <?php
                    }
                    elseif($obj_conn->nm_db_sc_type($dbms) == 'postgres')
                    {
                        ?>
                        <div class="field" id='tr_use_ssl'>
                            <label><?php echo $nm_lang['label']['use_ssl']; ?></label>
                            <div class="ui">
                                <input type="radio" name='use_ssl' id='use_ssl_y' value="Y" onClick="" <?php echo ($use_ssl=='Y')?"checked=checked":""; ?> />
                                <label for="use_ssl_y"><?php echo $nm_lang['values']['sim']; ?></label>
                                &nbsp;&nbsp;
                                <input type="radio" name='use_ssl' id='use_ssl_n' value="N" onClick="" <?php echo ($use_ssl!='Y')?"checked=checked":""; ?> />
                                <label for="use_ssl_n"><?php echo $nm_lang['values']['nao']; ?></label>
                            </div>
                        </div>
                        <div class="field" id='tr_postgres_sslmode'>
                            <label>sslmode</label>
                            <select class="ui dropdown" id='postgres_sslmode' name="postgres_sslmode">
                                <?php
                                $arr_option = array('', 'disable', 'allow', 'prefer', 'require', 'verify-ca', 'verify-full', );
                                foreach($arr_option as $_option)
                                {
                                    $selected_n = ($_option==$postgres_sslmode)?"selected=selected":"";
                                    ?>
                                    <option	value="<?php echo $_option; ?>" <?php echo $selected_n; ?>><?php echo $_option; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="field" id='tr_postgres_sslrootcert'>
                            <label>sslrootcert</label>
                            <input type="text" class="nmInput" name='postgres_sslrootcert' id='postgres_sslrootcert' value="<?php echo str_replace('"', '&quot;', $postgres_sslrootcert); ?>" />
                        </div>
                        <div class="field" id='tr_postgres_sslkey'>
                            <label>sslkey</label>
                            <input type="text" class="nmInput" name='postgres_sslkey' id='postgres_sslkey' value="<?php echo str_replace('"', '&quot;', $postgres_sslkey); ?>" />
                        </div>
                        <div class="field" id='tr_postgres_sslcert'>
                            <label>sslcert</label>
                            <input type="text" class="nmInput" name='postgres_sslcert' id='postgres_sslcert' value="<?php echo str_replace('"', '&quot;', $postgres_sslcert); ?>" />
                        </div>
                        <?php
                    }
                    elseif($obj_conn->nm_db_sc_type($dbms) == 'mssql')
                    {
                    ?>
                        <div class="field" id='tr_mssql_encrypt' style="display:<?php echo $obj_conn->nm_db_sc_type($dbms) != 'mssql' ? 'none' : ''; ?>">
                            <label>Encrypt</label>
                            <input type="checkbox" name='mssql_encrypt' id='mssql_encrypt' value="Y" onClick="" <?php echo ($mssql_encrypt=='Y')?"checked=checked":""; ?> />
                        </div>
                        <div class="field" id='tr_mssql_trustservercertificate' style="display:<?php echo $obj_conn->nm_db_sc_type($dbms) != 'mssql' ? 'none' : ''; ?>">
                            <label>trustServerCertificate</label>
                            <input type="checkbox" name='mssql_trustservercertificate' id='mssql_trustservercertificate' value="Y" onClick="" <?php echo ($mssql_trustservercertificate=='Y')?"checked=checked":""; ?> />
                        </div>
                        <div class="field" id='tr_mssql_truststore' style="display:<?php echo $dbms != 'mssql' ? 'none' : ''; ?>">
                            <label>trustStore</label>
                            <input type="text" class="nmInput" name='mssql_truststore' id='mssql_truststore' value="<?php echo str_replace('"', '&quot;', $mssql_truststore); ?>" />
                        </div>
                        <div class="field" id='tr_mssql_truststorepassword' style="display:<?php echo $dbms != 'mssql' ? 'none' : ''; ?>">
                            <label>trustStorePassword</label>
                            <input type="text" class="nmInput" name='mssql_truststorepassword' id='mssql_truststorepassword' value="<?php echo str_replace('"', '&quot;', $mssql_truststorepassword); ?>" />
                        </div>
                        <div class="field" id='tr_mssql_hostnameincertificate' style="display:<?php echo $dbms != 'mssql' ? 'none' : ''; ?>">
                            <label>hostnameInCertificate</label>
                            <input type="text" class="nmInput" name='mssql_hostnameincertificate' id='mssql_hostnameincertificate' value="<?php echo str_replace('"', '&quot;', $mssql_hostnameincertificate); ?>" />
                        </div>
                    <?php
                    }
                    elseif($obj_conn->nm_db_sc_type($dbms) == 'db2')
                    {
                        foreach($arr_db2ssl as $_input)
                        {
                            ?>
                        <div class="field" id='tr_<?php echo $_input; ?>'>
                            <label><?php echo $_input; ?></label>
                            <input type="text" class="nmInput" name='<?php echo $_input; ?>' id='<?php echo $_input; ?>' value="<?php echo str_replace('"', '&quot;', $$_input); ?>" />
                        </div>
                        <?php
                        }
                    }
                ?>
            </div>
            <div id='tr_advanced' class="ui bottom attached tab segment" data-tab="tr_advanced" style="">

                <div id="tr_more_dados_rep" style="display:none">
                    <div colspan="2" id='td_more_dados_rep'>

                    </div>
                </div>
                <div id="tr_more_info" style="">
                    <div class="three fields" >
                        <div class="field" id='tr_decimal' style="display:">
                            <label><?php echo $nm_lang['label']['decimal']; ?></label>
                            <select class="ui compact dropdown" name='decimal'>
                                <option value='.' <?php if($decimal=='.'){ echo ' selected '; } ?>>.</option>
                                <option value=',' <?php if($decimal==','){ echo ' selected '; } ?>>,</option>
                            </select>
                            <div class="nmLineV3" align="center" valign="middle" onclick="fc_show_filter(true, false)" style="cursor:pointer; display: none;">
                                <img src="<?php echo $nm_config['url_img']; ?>funil.gif" border="0" /> <?php echo $lbl_filter; ?>
                            </div>
                        </div>
                        <div class="ten wide field" id='tr_use_persistent' style="display:">
                            <label><?php echo $nm_lang['label']['use_persistent']; ?></label>
                            <select class="nmInput" name='use_persistent'>
                                <option value='N' <?php if($use_persistent!='Y'){ echo "selected"; } ?>><?php echo $nm_lang['values']['nao']; ?></option>
                                <option value='Y' <?php if($use_persistent=='Y'){ echo "selected"; } ?>><?php echo $nm_lang['values']['sim']; ?></option>
                            </select>
                        </div>
                        <div class="ten wide field" id='tr_use_schema' style="display:<?php echo $dbms == 'db2' ? '' : 'none'; ?>">
                            <label><?php echo $nm_lang['label']['retrieve_schema']; ?></label>
                            <select class="nmInput" name='use_schema'>
                                <option value='N' <?php if($use_schema!='Y'){ echo "selected"; } ?>><?php echo $nm_lang['values']['nao']; ?></option>
                                <option value='Y' <?php if($use_schema=='Y'){ echo "selected"; } ?>><?php echo $nm_lang['values']['sim']; ?></option>
                            </select>
                        </div>
                        <div class="eight wide field" style="display:none">
                            <label><?php echo $nm_lang['label']['retrieve_schema']; ?></label>
                            <span id='tr_retrieve_schema'></span> <!-- para n exibir -->
                            <select class="nmInput" name='retrieve_schema'>
                                <option value='N' <?php if($retrieve_schema!='Y'){ echo "selected"; } ?>><?php echo $nm_lang['values']['nao']; ?></option>
                                <option value='Y' <?php if($retrieve_schema=='Y'){ echo "selected"; } ?>><?php echo $nm_lang['values']['sim']; ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="two fields" >
                        <div class="field" id='tr_date_separator' style="display:<?php echo $dbms != 'odbc' ? 'none' : ''; ?>">
                            <label><?php echo $nm_lang['label']['date_separator']; ?></label>
                            <input type="text" class="nmInput" name='date_separator' value="<?php echo str_replace('"', '&quot;', $date_separator); ?>" />
                        </div>
                        <div class="field" style="display:none">
                            <label><?php echo $nm_lang['label']['retrieve_schema']; ?></label>
                            <span id='tr_retrieve_schema'></span> <!-- para n exibir -->
                            <select class="nmInput" name='retrieve_schema'>
                                <option value='N' <?php if($retrieve_schema!='Y'){ echo "selected"; } ?>><?php echo $nm_lang['values']['nao']; ?></option>
                                <option value='Y' <?php if($retrieve_schema=='Y'){ echo "selected"; } ?>><?php echo $nm_lang['values']['sim']; ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div id='tr_ssh' class="ui bottom attached tab segment" data-tab="tr_ssh" style="">
                <div class="field" id='tr_use_ssh'>
                    <label><?php echo $nm_lang['label']['use_ssh']; ?></label>
                    <div class="ui">
                        <input type="radio" name='use_ssh' id='use_ssh_y' value="Y" onClick="" <?php echo ($use_ssh=='Y')?"checked=checked":""; ?> />
                        <label for="use_ssh_y"><?php echo $nm_lang['values']['sim']; ?></label>
                        &nbsp;&nbsp;
                        <input type="radio" name='use_ssh' id='use_ssh_n' value="N" onClick="" <?php echo ($use_ssh!='Y')?"checked=checked":""; ?> />
                        <label for="use_ssh_n"><?php echo $nm_lang['values']['nao']; ?></label>
                    </div>
                </div>
                <?php
                foreach($arr_ssh as $_input)
                {
                    if($_input == 'use_ssh') continue;
                    ?>
                    <div class="field" id='tr_<?php echo $_input; ?>'>
                        <label><?php echo $nm_lang['label'][$_input]; ?></label>
                        <input type="text" class="nmInput" name='<?php echo $_input; ?>' id='<?php echo $_input; ?>' value="<?php echo str_replace('"', '&quot;', $$_input); ?>" />
                    </div>
                    <?php
                }
                ?>
            </div>
            <div id='tabs_content'>
                <div id="id_test_conn" style="display:none">
                    <td align="center" valign="middle">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center" valign="middle">
                                    <center>
                                    <span id='span_load_ajax_test_conn'>
                                        <img src="<?php echo $nm_config['url_img']; ?>load_ajax_blue.gif" />
                                    </span>

                                        <div id='span_iframe_test_conn' style="display:none; padding-top: 20px;">
                                            <iframe name="testaconn" height="80px" align="middle" marginheight="0" marginwidth="0" src="" frameborder="0" scrolling="No" style="width: 100%;"></iframe>
                                        </div>

                                        <span id='span_msg_err_test_auto' style="display:none">
                                        <table><tr><td style="font-size:4px">&nbsp;</td></table>
                                        <table width="480px" border="0">
                                           <tr>
                                               <td width="30px" valign="top">
                                                    <img src="<?php echo $nm_config['url_img']; ?>cancel.png"  />
                                               </td>
                                               <td width="420px" class="nmErrorMsg" id='td_msg_erro'></td>
                                           </tr>
                                        </table>
                                        <table><tr><td style="font-size:4px">&nbsp;</td></table>
                                    </span>
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </td>
                </div>
            </div>
        </div>
        <script>
            $('#tabs_selector .item').tab();
            var bln_test = true;
        </script>


        <div style="padding: 20px 0 0 0;">
            <input type="hidden" name="form_create" value="<?php echo $nm_config['form_valid']; ?>" />
            <div id='bt_nav_1' style="display: flex; flex-direction: row; justify-content: flex-start;align-items: flex-start">
                <?php
                if ($edit_conn)
                {
                    ?>
                    <input type='button' name='sair' value='<?php echo $nm_lang['create_conn_wizard']['btnvoltar']; ?>' onclick="fc_cancel_edit();" class="ui button">
                    <button id='img_bt_test_conn' onclick="document.getElementById('span_save_conn').innerHTML = 'N'; nm_test_conn();" class="ui positive button">
                        <?php echo $nm_lang['create_conn_wizard']['btntestar']; ?>
                    </button>
                    <input type='button' name='concluir' value='<?php echo $nm_lang['create_conn_wizard']['btnconcluir']; ?>' onclick="nm_salvar_conn();" class="ui primary button">
                    <?php
                }
                else
                {
                    ?>
                    <span id='bt_back_sel_conn'><input type='button' name='retornar' value='<?php echo $nm_lang['create_conn_wizard']['btnvoltar']; ?>' onclick="fc_ajust_port(); setStep('<?php echo $btn_retor; ?>');" class="ui button" /></span>
                    <button id='img_bt_test_conn' onclick="document.getElementById('span_save_conn').innerHTML = 'N'; nm_test_conn();" class="ui positive button">
                        <?php echo $nm_lang['create_conn_wizard']['btntestar']; ?>
                    </button>
                    <input type='button' name='concluir' value='<?php echo $nm_lang['create_conn_wizard']['btnconcluir']; ?>' onclick="nm_salvar_conn();" class="ui primary button">
                    <!--                    <input type='button' name='sair' value='--><?php //echo $nm_lang['create_conn_wizard']['btnsair']; ?><!--' onclick="setStep('cancel');" class="ui negative button">-->
                    <?php
                }
                ?>
            </div>

            <div id='bt_nav_2' style="display:flex; display: none; flex-direction: row; justify-content: flex-start;align-items: flex-start;">
                <input type='button' name='confirmar' value='<?php echo $nm_lang['create_conn_wizard']['btnvoltar']; ?>' onclick="fc_back_save()" class="ui primary button">
                <button id='img_bt_test_conn' onclick="nm_test_conn();" class="ui positive button">
                    <?php echo $nm_lang['create_conn_wizard']['btntestar']; ?>
                </button>
                <input type='button' name='voltar' value='<?php echo $nm_lang['button_confirm']; ?>' onclick="fc_ajust_port();  setStep('testar');" class="ui negative button">
            </div>

            <div style="flex-grow: 1;"></div>
            <div id='bt_back_test_conn' style="display:none"><input type='button' value='<?php echo $nm_lang['create_conn_wizard']['btnvoltar']; ?>' onclick="nm_back_test_conn();" class="ui button" /></div>
            <input type='hidden' value='<?php echo $this->GetVar('step');?>' name='step'>
            <input type='hidden' value='<?php echo $btn_avanc; ?>' name='nextstep'>
        </div>

        <span id='span_erro_sel_db' style="display:none;">
            <br>
            <table class="nmTable" align='center'>
             <tr>
              <td class="nmErrorTitle">
               <img src="<?php echo $nm_config['url_img']; ?>notice.gif" style="border-width: 0px; vertical-align: middle" />
               <?php echo "Error"; ?>
              </td>
             </tr>
             <tr>
              <td class="nmErrorMsg" id='td_msg_erro'></td>
             </tr>
            </table>
        </span>

        <div style="display:none" id="hidden_misc">
            <DIV style="display:none" id="id_sgdb">
                <TABLE WIDTH="400" align='center' class="nmTitle">
                    <TR>
                        <TD width="100" class="nmLineV3" valign="top">
                            <?php echo $nm_lang['label']['sgdb']; ?>
                        </TD>
                        <TD width='300' class="nmLineV3">
                            <?php echo $nm_lang['create_conn_wizard']['descricoes']['sgdb']; ?>
                        </TD>
                    </TR>
                </TABLE>
            </DIV>
            <DIV style="display:none" id="id_date_separator">
                <TABLE WIDTH="400" align='center' class="nmTitle">
                    <TR>
                        <TD width="100" class="nmLineV3" valign="top">
                            <?php echo $nm_lang['label']['date_separator']; ?>
                        </TD>
                        <TD width='300' class="nmLineV3">
                            <?php echo $nm_lang['create_conn_wizard']['descricoes']['date_separator']; ?>
                        </TD>
                    </TR>
                </TABLE>
            </DIV>
            <DIV style="display:none" id="id_use_persistent">
                <TABLE WIDTH="400" align='center' class="nmTitle">
                    <TR>
                        <TD width="100" class="nmLineV3" valign="top">
                            <?php echo $nm_lang['label']['use_persistent']; ?>
                        </TD>
                        <TD width='300' class="nmLineV3">
                            <?php echo $nm_lang['create_conn_wizard']['descricoes']['use_persistent']; ?>
                        </TD>
                    </TR>
                </TABLE>
            </DIV>
            <DIV style="display:none" id="id_retrieve_schema">
                <TABLE WIDTH="400" align='center' class="nmTitle">
                    <TR>
                        <TD width="100" class="nmLineV3" valign="top">
                            <?php echo $nm_lang['label']['retrieve_schema']; ?>
                        </TD>
                        <TD width='300' class="nmLineV3">
                            <?php echo $nm_lang['create_conn_wizard']['descricoes']['retrieve_schema']; ?>
                        </TD>
                    </TR>
                </TABLE>
            </DIV>
            <DIV style="display:none" id="id_decimal">
                <TABLE WIDTH="400" align='center' class="nmTitle">
                    <TR>
                        <TD width="100" class="nmLineV3" valign="top">
                            <?php echo $nm_lang['label']['decimal']; ?>
                        </TD>
                        <TD width='300' class="nmLineV3">
                            <?php echo $nm_lang['create_conn_wizard']['descricoes']['decimal']; ?>
                        </TD>
                    </TR>
                </TABLE>
            </DIV>
        </div>
    </form>
</div>


<form name='test_conn' action="" method="POST" style="display:none">
    <input type="hidden" name="hid_create_connect" value="S" />
    <div id='div_form_conn_test'></div>
</form>


<span id="span_save_conn" style="display:none"></span>