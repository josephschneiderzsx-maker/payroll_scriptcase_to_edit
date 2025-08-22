<?php

nm_load_class('interface', 'Connection');
$obj_conn = new nmConnection();

//Carrega Array com Grupos do ScriptCase
$conHas                = $this->GetVar('conHas');
$btn_avanc             = $this->GetVar('btn_avanc');
$btn_retor             = $this->GetVar('btn_retor');
$server                = $this->GetVar('server');
$base                  = $this->GetVar('base');
$oracle_type           = $this->GetVar('oracle_type');
$schema                = $this->GetVar('schema');
$rep                   = $this->GetVar('rep');
$repositorios          = $this->GetVar('repositorios');
$postgres_encoding     = $this->GetVar('postgres_encoding');
$oracle_encoding       = $this->GetVar('oracle_encoding');
$mysql_encoding        = $this->GetVar('mysql_encoding');
$db2_autocommit        = $this->GetVar('db2_autocommit');
$db2_i5_lib            = $this->GetVar('db2_i5_lib');
$db2_i5_naming         = $this->GetVar('db2_i5_naming');
$db2_i5_commit         = $this->GetVar('db2_i5_commit');

$ibase_charset = $this->GetVar('ibase_charset');
$ibase_rolename = $this->GetVar('ibase_rolename');
$ibase_dialect = $this->GetVar('ibase_dialect');

$pg_client_encoding   = array();
if(is_file($nm_config['path_prod'] . "sql/charset/postgres.php"))
{
    $arr_charset_db = array();
    include($nm_config['path_prod'] . "sql/charset/postgres.php");
    $pg_client_encoding = $arr_charset_db;
}

$oracle_client_encoding = array();
if(is_file($nm_config['path_prod'] . "sql/charset/oracle.php"))
{
    $arr_charset_db = array();
    include($nm_config['path_prod'] . "sql/charset/oracle.php");
    $oracle_client_encoding = $arr_charset_db;
}

$ibase_charset_list = array();
if(is_file($nm_config['path_prod'] . "sql/charset/ibase.php"))
{
    $arr_charset_db = array();
    include($nm_config['path_prod'] . "sql/charset/ibase.php");
    $ibase_charset_list = $arr_charset_db;
}

$mysql_client_encoding = array();
if(is_file($nm_config['path_prod'] . "sql/charset/mysql.php"))
{
    $arr_charset_db = array();
    include($nm_config['path_prod'] . "sql/charset/mysql.php");
    $mysql_client_encoding = $arr_charset_db;
}

$dbms = $this->GetVar('dbms');
$conn = $this->GetVar('conn');

if ($conn == "")
{
    $conn = "connect";
}
?>

<script language="javascript" src="<?php echo $nm_config['url_js_third']; ?>wz_tooltip/wz_tooltip.js"></script>

<form action="<?php echo nm_url_rand($nm_config['url_iface'] . 'admin_sys_allconections_create_wizard.php'); ?>" name="form_create" METHOD="post">
    <div>

        <?php

        $td_width_1 = "265px";
        $td_width_2 = "225px";
        $td_width_3 = "50px";

        if (isset($_POST['ajax']) && $_POST['ajax'] == "S")
        {
            echo "__#$@$#__";
        }
        else
        {
        ?>
        <div class="nmTable">
            <tr>
                <td class="nmTitle" align="center" colspan="3"><?php echo $nm_lang['page_title']; ?></td>
            </tr>
            <?php
            }

            if (!(isset($_POST['ajax']) && $_POST['ajax'] == "S"))
            {
                ?>


                <tr style="display:<?php echo (in_array($dbms, array('firebird', 'odbc', 'progress', 'sybase')) ? "" : "none"); ?>">
                    <td class="nmLineV3" width="<?php echo $td_width_1; ?>">&nbsp;&nbsp;&nbsp;<?php echo $nm_lang['label']['conn']; ?>&nbsp;</td>
                    <td class="nmLineV3" width="<?php echo $td_width_2; ?>">
                        <INPUT name='conn' value='<?php echo $conn; ?>' type="text" class="nmInput">
                    </td>
                    <td class="nmLineV3" width="<?php echo $td_width_3; ?>" align="left" valign="middle">
                    </td>
                </tr>
                <?PHP
            }
            if($conHas['server']=='S')
            {
                $default = $port = "";
                $hasPort = false;

                $arr_db_ports = array();
                $arr_db_ports['mariadb']    = "3306";
                $arr_db_ports['mysql']    = "3306";
                $arr_db_ports['postgres'] = "5432";
                $arr_db_ports['db2']      = "50000";
                $arr_db_ports['mssql']    = "1433";
                $arr_db_ports['sybase']   = "5000";
                $arr_db_ports['firebird'] = "3050";
                $arr_db_ports['ibase']    = "3050";
                if (isset($arr_db_ports[ $obj_conn->nm_db_sc_type($dbms) ]))
                {
                    $hasPort = true;
                    $port = $arr_db_ports[ $obj_conn->nm_db_sc_type($dbms) ];

                    if (strrpos($server, ":") !== false)
                    {
                        $server1 = substr($server, 0, strrpos($server, ":"));
                        $server2 = substr($server, strrpos($server, ":") + 1);

                        if (is_numeric($server2))
                        {
                            $server = $server1;
                            $port   = $server2;
                        }
                    }
                }

                if(isset($conHas['port']) && $conHas['port']=='N')
                {
                    $hasPort = false;
                    $port    = 0;
                }

                ?>
                <div class="two fields">
                    <div class="twelve wide field">
                        <label><?php echo $nm_lang['label']['server']; ?></label>
                        <input type='text' name='server' id='server' value='<?php echo $server; ?>' class="nmInput" onchange="$('#carregar_db').val('S');">
                    </div>

                    <div class="four wide field" style="display:<?php echo ($hasPort ? '' : 'none'); ?>">
                        <label><?php echo sprintf($nm_lang['label']['port'], $default); ?></label>
                        <div class="ui input" id="meticulous-pixel-perfect-special-field">
                            <button class="ui compact icon button" onclick="if (parseInt($('#port').val()) > 0) {$('#port').val(parseInt($('#port').val()) - 1); $('#carregar_db').val('S');}" ><i class="minus icon"></i></button>
                            <input type='text' name='port' id='port' size="5" onblur="if ($('#port').val() == '') {$('#port').val('0');}" value='<?php echo $port; ?>' class="nmInput" maxlength="6" onchange="$('#carregar_db').val('S');" />
                            <button class="ui compact icon button" onclick="$('#port').val(parseInt($('#port').val()) + 1); $('#carregar_db').val('S');"><i class="plus icon"></i></button>
                        </div>
                        <style>
                            #meticulous-pixel-perfect-special-field {
                                column-gap: 3px !important;
                            }
                            #meticulous-pixel-perfect-special-field > *{
                                margin: 0 !important;
                            }
                        </style>
                    </div>
                </div>

                <?php
            }
            if($conHas['base']=='S')
            {

                if ($obj_conn->nm_db_sc_type($dbms) == 'mysql' || $obj_conn->nm_db_sc_type($dbms) == 'mariadb')
                {
                    ?>
                    <tr style="display:none"><td colspan="3"><input type="hidden" name="base" id="base" value='<?php echo $base; ?>' /></td></tr>
                    <?php
                }
                else
                {
                    ?>
                    <div class="field">
                        <label><?php echo $nm_lang['label']['base']; ?></label>
                        <input type='text' name='base' value='<?php echo $base; ?>' class="nmInput">
                    </div>
                    <?php
                }
            }

            if($conHas['oracle_type']=='S')
            {
                ?>
                <div class="field">
                    <div class="nmLineV3" width="<?php echo $td_width_2; ?>">
                        <input type="radio" id="oracle_type_service_name" name="oracle_type" value="service_name" <?php echo ($oracle_type=='service_name')?'checked=checked':''; ?> style="vertical-align: middle" />
                        <label for="oracle_type_service_name">Service Name</label>
                        &nbsp;&nbsp;
                        <input type="radio" id="oracle_type_sid" name="oracle_type" value="sid" <?php echo ($oracle_type=='sid')?'checked=checked':''; ?> style="vertical-align: middle" />
                        <label for="oracle_type_sid">SID</label><br>
                    </div>
                </div>
                <?php
            }

            if($conHas['schema']=='S')
            {
                ?>
                <div class="field">
                    <label><?php echo $nm_lang['label']['schema']; ?></label>
                    <input type='text' name='schema' value='<?php echo $schema?>' class="nmInput" >
                </div>
                <?php
            }

            if (isset($_POST['ajax']) && $_POST['ajax'] == "S")
            {
                echo "__#$@$#__";
            }

            if ($obj_conn->nm_db_sc_type($dbms) == "oracle")
            {
                ?>

                <div class="field">
                    <label >client_encoding</label>
                    <select name="oracle_encoding" class="nmInput">
                        <option value="" <?php if(empty($oracle_encoding)){ echo "selected"; } ?>></option>
                        <?php
                        foreach ($oracle_client_encoding as $key=>$value)
                        {
                            if (strlen($value) > 50)
                            {
                                $value = substr($value, 0, 47) . "...";
                            }

                            ?>
                            <option value="<?php echo $key; ?>" <?php if($oracle_encoding==$key){ echo "selected"; } ?>><?php echo $key . " - " . $value; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>


                <?php
            }
            elseif ($obj_conn->nm_db_sc_type($dbms) == "ibase" || $obj_conn->nm_db_sc_type($dbms) == "firebird")
            {
                ?>

                <div class="field">
                    <label >charset</label>
                    <select name="ibase_charset" class="nmInput">
                        <option value="" <?php if(empty($ibase_charset)){ echo "selected"; } ?>></option>
                        <?php
                        foreach ($ibase_charset_list as $key=>$value)
                        {
                            if (strlen($value) > 50)
                            {
                                $value = substr($value, 0, 47) . "...";
                            }

                            ?>
                            <option value="<?php echo $key; ?>" <?php if($ibase_charset==$key){ echo "selected"; } ?>><?php echo $key . " - " . $value; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="field">
                    <label>role</label>
                    <input type="text" class="nmInput" name='ibase_rolename' id='ibase_rolename' value="<?php echo $ibase_rolename; ?>" />
                </div>

                <div class="field">
                    <label>role</label>
                    <select name="ibase_dialect" class="nmInput">
                        <option value="" <?php if(empty($ibase_dialect)){ echo "selected"; } ?>></option>
                        <?php
                        $ibase_dialect_list = array(1, 2, 3);
                        foreach ($ibase_dialect_list as $value)
                        {
                            if (strlen($value) > 50)
                            {
                                $value = substr($value, 0, 47) . "...";
                            }

                            ?>
                            <option value="<?php echo $value; ?>" <?php if($ibase_dialect==$value){ echo "selected"; } ?>><?php echo $value; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <?php
            }
            elseif ($obj_conn->nm_db_sc_type($dbms) == "postgres")
            {
                ?>
                <div class="field">
                    <label>client_encoding</label>
                    <select name="postgres_encoding" class="nmInput">
                        <option value="" <?php if(empty($postgres_encoding)){ echo "selected"; } ?>></option>
                        <?php
                        foreach ($pg_client_encoding as $key=>$value)
                        {
                            ?>
                            <option value="<?php echo $key; ?>" <?php if($postgres_encoding==$key){ echo "selected"; } ?>><?php echo $key; ?> - <?php echo $value; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <?php
            }elseif ($obj_conn->nm_db_sc_type($dbms) == "mysql" || $obj_conn->nm_db_sc_type($dbms) == "mariadb")
            {
                ?>
                <div class="field">
                    <label>client_encoding</label>
                    <select name="mysql_encoding" class="nmInput">
                        <option value="" <?php if(empty($mysql_encoding)){ echo "selected"; } ?>></option>
                        <?php
                        foreach ($mysql_client_encoding as $key=>$value)
                        {
                            ?>
                            <option value="<?php echo $key; ?>" <?php if($mysql_encoding==$key){ echo "selected"; } ?>><?php echo $key; ?> - <?php echo $value; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <?php
            }


            if($conHas['db2']=='S')
            {

                if (!(isset($_POST['ajax']) && $_POST['ajax'] == "S"))
                {
                    ?>
                    <div>
                        <td class="nmLineV3" colspan="3">&nbsp;</td>
                    </div>
                    <?php
                }
                ?>
                <div>
                    <div class="nmLineV3" colspan="3" align="center" style="border:1px dotted #ff0000;"><?php echo $nm_lang['form_db2_warning']; ?></div>
                </div>
                <!--tbody style="display:<?php if(DB2_AUTOCOMMIT_ON=="" && DB2_AUTOCOMMIT_OFF==""){ echo "none"; } ?>"-->
                <div class="field" style="display:<?php if(DB2_AUTOCOMMIT_ON=="" && DB2_AUTOCOMMIT_OFF==""){ echo "none"; } ?>">
                    <label>autocommit</label>
                    <select name="db2_autocommit" class="nmInput">
                        <option value="" <?php if(empty($db2_autocommit)){ echo "selected"; } ?>></option>
                        <option value="<?php echo DB2_AUTOCOMMIT_ON; ?>" <?php if($db2_autocommit==DB2_AUTOCOMMIT_ON && DB2_AUTOCOMMIT_ON!=''){ echo "selected"; } ?>>DB2_AUTOCOMMIT_ON</option>
                        <option value="<?php echo DB2_AUTOCOMMIT_OFF; ?>" <?php if($db2_autocommit==DB2_AUTOCOMMIT_OFF && DB2_AUTOCOMMIT_OFF!=''){ echo "selected"; } ?>>DB2_AUTOCOMMIT_OFF</option>
                    </select>
                </div>


                <!--/tbody-->
                <div class="field">
                    <label>i5_lib</label>
                    <input type='text' name='db2_i5_lib' value='<?php echo $db2_i5_lib; ?>' class="nmInput" >
                </div>
                <!--tbody style="display:<?php if(DB2_I5_NAMING_ON=="" && DB2_I5_NAMING_OFF==""){ echo "none"; } ?>"-->
                <div class="field" style="display:<?php if(DB2_I5_NAMING_ON=="" && DB2_I5_NAMING_OFF==""){ echo "none"; } ?>">
                    <label>i5_naming</label>
                    <select name="db2_i5_naming" class="nmInput">
                        <option value="" <?php if(empty($db2_i5_naming)){ echo "selected"; } ?>></option>
                        <option value="<?php echo DB2_I5_NAMING_ON; ?>" <?php if($db2_i5_naming==DB2_I5_NAMING_ON && DB2_I5_NAMING_ON!=''){ echo "selected"; } ?>>DB2_I5_NAMING_ON</option>
                        <option value="<?php echo DB2_I5_NAMING_OFF; ?>" <?php if($db2_i5_naming==DB2_I5_NAMING_OFF && DB2_I5_NAMING_OFF!=''){ echo "selected"; } ?>>DB2_I5_NAMING_OFF</option>
                    </select>
                </div>
                <!--/tbody-->
                <!--tbody style="display:<?php if(DB2_I5_TXN_NO_COMMIT=="" && DB2_I5_TXN_READ_UNCOMMITTED=="" && DB2_I5_TXN_READ_COMMITTED=="" && DB2_I5_TXN_REPEATABLE_READ=="" && DB2_I5_TXN_SERIALIZABLE==""){ echo "none"; } ?>"-->
                <div class="field" style="display:<?php if(DB2_I5_TXN_NO_COMMIT=="" && DB2_I5_TXN_READ_UNCOMMITTED=="" && DB2_I5_TXN_READ_COMMITTED=="" && DB2_I5_TXN_REPEATABLE_READ=="" && DB2_I5_TXN_SERIALIZABLE==""){ echo "none"; } ?>">
                    <label>i5_commit</label>
                    <select name="db2_i5_commit" class="nmInput">
                        <option value="" <?php if(empty($db2_i5_commit)){ echo "selected"; } ?>></option>
                        <option value="<?php echo DB2_I5_TXN_NO_COMMIT; ?>" <?php if($db2_i5_commit==DB2_I5_TXN_NO_COMMIT && DB2_I5_TXN_NO_COMMIT!=''){ echo "selected"; } ?>>DB2_I5_TXN_NO_COMMIT</option>
                        <option value="<?php echo DB2_I5_TXN_READ_UNCOMMITTED; ?>" <?php if($db2_i5_commit==DB2_I5_TXN_READ_UNCOMMITTED && DB2_I5_TXN_READ_UNCOMMITTED!=''){ echo "selected"; } ?>>DB2_I5_TXN_READ_UNCOMMITTED</option>
                        <option value="<?php echo DB2_I5_TXN_READ_COMMITTED; ?>" <?php if($db2_i5_commit==DB2_I5_TXN_READ_COMMITTED && DB2_I5_TXN_READ_COMMITTED!=''){ echo "selected"; } ?>>DB2_I5_TXN_READ_COMMITTED</option>
                        <option value="<?php echo DB2_I5_TXN_REPEATABLE_READ; ?>" <?php if($db2_i5_commit==DB2_I5_TXN_REPEATABLE_READ && DB2_I5_TXN_REPEATABLE_READ!=''){ echo "selected"; } ?>>DB2_I5_TXN_REPEATABLE_READ</option>
                        <option value="<?php echo DB2_I5_TXN_SERIALIZABLE; ?>" <?php if($db2_i5_commit==DB2_I5_TXN_SERIALIZABLE && DB2_I5_TXN_SERIALIZABLE!=''){ echo "selected"; } ?>>DB2_I5_TXN_SERIALIZABLE</option>
                    </select>
                </div>
                <!--/tbody-->
                <!--tbody style="display:<?php if(DB2_FIRST_IO=="" && DB2_ALL_IO==""){ echo "none"; } ?>"-->
                <div class="field" style="display:<?php if(DB2_FIRST_IO=="" && DB2_ALL_IO==""){ echo "none"; } ?>">
                    <label class="nmLineV3" width="<?php echo $td_width_1; ?>">i5_query_optimize</label>
                    <select name="db2_i5_query_optimize" class="nmInput">
                        <option value="" <?php if(empty($db2_i5_query_optimize)){ echo "selected"; } ?>></option>
                        <option value="<?php echo DB2_FIRST_IO; ?>" <?php if($db2_i5_query_optimize==DB2_FIRST_IO && DB2_FIRST_IO!=''){ echo "selected"; } ?>>DB2_FIRST_IO</option>
                        <option value="<?php echo DB2_ALL_IO; ?>" <?php if($db2_i5_query_optimize==DB2_ALL_IO && DB2_ALL_IO!=''){ echo "selected"; } ?>>DB2_ALL_IO</option>
                    </select>
                </div>
                <!--/tbody-->
                <?php
            }

            if (isset($_POST['ajax']) && $_POST['ajax'] == "S")
            {
                echo "__#$@$#__";
            }
            ?>

        </div>

        <?php
        //aaaa
        ?>
        <input type="hidden" name="rep" value="<?PHP echo $rep; ?>">
        <?php
        //fim aaaa
        ?>
        <br>
        <input type="hidden" name="form_create" value="<?php echo $nm_config['form_valid']; ?>" />

        <input type='button' name='voltar' value='<?php echo $nm_lang['create_conn_wizard']['btnvoltar']; ?>' onclick="setStep('<?php echo $btn_retor; ?>');" class="nmButton">
        <input type='button' name='avancar' value='<?php echo $nm_lang['create_conn_wizard']['btnavancar']; ?>' onclick="setStep('<?php echo $btn_avanc; ?>');" class="nmButton">
        <input type='button' name='sair' value='<?php echo $nm_lang['create_conn_wizard']['btnsair']; ?>' onclick="setStep('cancel');" class="nmButton">
        <input type='hidden' value='<?php echo $this->GetVar('step');?>' name='step'>
        <input type='hidden' value='' name='nextstep'>
    </div>


    <BR \>
    <BR \>
    <DIV style="display:none" id="id_server">
        <TABLE WIDTH="400" align='center' class="nmTitle">
            <TR>
                <TD width="100" class="nmLineV3" valign="top">
                    <?php echo $nm_lang['label']['server']; ?>
                </TD>
                <TD width='300' class="nmLineV3">
                    <?php echo $nm_lang['create_conn_wizard']['descricoes']['server']; ?>
                </TD>
            </TR>
        </TABLE>
    </DIV>
    <DIV style="display:none" id="id_base">
        <TABLE WIDTH="400" align='center' class="nmTitle">
            <TR>
                <TD width="100" class="nmLineV3" valign="top">
                    <?php echo $nm_lang['label']['base']; ?>
                </TD>
                <TD width='300' class="nmLineV3">
                    <?php echo $nm_lang['create_conn_wizard']['descricoes']['base']; ?>
                </TD>
            </TR>
        </TABLE>
    </DIV>
    <DIV style="display:none" id="id_schema">
        <TABLE WIDTH="400" align='center' class="nmTitle">
            <TR>
                <TD width="100" class="nmLineV3" valign="top">
                    <?php echo $nm_lang['label']['schema']; ?>
                </TD>
                <TD width='300' class="nmLineV3">
                    <?php echo $nm_lang['create_conn_wizard']['descricoes']['schema']; ?>
                </TD>
            </TR>
        </TABLE>
    </DIV>
</form>