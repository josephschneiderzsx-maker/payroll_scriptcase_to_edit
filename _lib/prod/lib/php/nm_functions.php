<?php

function sc_webservice($str_webservice_type, $str_url, $str_port, $str_metodo, $str_param, $arr_params = array(), $int_timeout = 30, $bol_return_array = false)
{
    $str_buffer = '';

    $str_webservice_type = trim(strtolower($str_webservice_type));
    switch ($str_webservice_type) {
        case 'fsockopen':

            $str_servidor = $str_url;
            $str_caminho = "/";

            //retira http e https
            if ('http://' == strtolower(substr(trim($str_servidor), 0, 7))) {
                $str_servidor = substr(trim($str_servidor), 7);
            } elseif ('https://' == strtolower(substr(trim($str_servidor), 0, 8))) {
                $str_servidor = substr(trim($str_servidor), 8);
            }

            if (strpos($str_servidor, '/') !== false) {
                $str_caminho = substr($str_servidor, strpos($str_servidor, '/'));
                $str_servidor = substr($str_servidor, 0, strpos($str_servidor, '/'));

            }

            $res_socket = fsockopen($str_servidor, $str_port, $int_err, $str_err, $int_timeout);

            if ('GET' == $str_metodo) {
                if (strpos($str_caminho, "?") === FALSE) {
                    $str_caminho .= '?' . $str_param;
                } else {
                    $str_caminho .= '&' . $str_param;
                }
            }

            fputs($res_socket, "$str_metodo $str_caminho HTTP/1.1\r\n");
            fputs($res_socket, "Host: $str_servidor\r\n");

            if ($str_metodo == 'POST' && !empty($str_param)) {
                fputs($res_socket, "Content-type: application/x-www-form-urlencoded\r\n");
                fputs($res_socket, 'Content-length: ' . strlen($str_param) . "\r\n");
                fputs($res_socket, $str_param);
            }
            fputs($res_socket, "Connection: close\r\n\r\n");

            if (isset($arr_params['header'])) {
                fputs($res_socket, $arr_params['header']);
            }

            stream_set_timeout($res_socket, $int_timeout);

            while (!feof($res_socket)) {
                $str_buffer .= fread($res_socket, 256);
            }
            fclose($res_socket);

            break;
        case 'soap':
            try {
                $soap_client = new SoapClient($str_url, $arr_params);
                return $soap_client;
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }

            break;
        case 'file_get_contents':

            if ('GET' == $str_metodo) {
                if (strpos($str_url, "?") === FALSE) {
                    $str_url .= '?' . $str_param;
                } else {
                    $str_url .= '&' . $str_param;
                }

                $str_param = "";
            }

            $context_options = array();
            $context_options['http']['timeout'] = $int_timeout;

            if (isset($arr_params['header'])) {
                $context_options['http']['header'] = $arr_params['header'];
            }
            if ('POST' == $str_metodo && !empty($str_param)) {
                $data_len = strlen($str_param);
                if (isset($context_options['http']['header'])) {
                    $context_options['http']['header'] .= "Connection: close\r\nContent-Length: $data_len\r\n";
                } else {
                    $context_options['http']['header'] = "Content-Type: application/x-www-form-urlencoded\r\n";
                    $context_options['http']['header'] .= "Connection: close\r\nContent-Length: $data_len\r\n";
                }
                $context_options['http']['content'] = $str_param;
                $context_options['http']['method'] = $str_metodo;
            }

            $context_options['http']['timeout'] = $int_timeout;

            $context = stream_context_create($context_options);
            $str_buffer = file_get_contents($str_url, false, $context);
            break;
        case 'curl':

            if ('GET' == $str_metodo) {
                if (strpos($str_url, "?") === FALSE) {
                    $str_url .= '?' . $str_param;
                } else {
                    $str_url .= '&' . $str_param;
                }

                $str_param = "";
            }

            $ch1 = curl_init();
            curl_setopt($ch1, CURLOPT_URL, $str_url);
            if ('POST' == $str_metodo && !empty($str_param)) {
                curl_setopt($ch1, CURLOPT_POST, true);
                curl_setopt($ch1, CURLOPT_POSTFIELDS, $str_param);
            }
            curl_setopt($ch1, CURLOPT_TIMEOUT, $int_timeout);
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch1, CURLOPT_HEADER, false);
            curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);


            if (is_array($arr_params) && !empty($arr_params)) {
                foreach ($arr_params as $key => $value) {
                    curl_setopt($ch1, $key, $value);
                }
            }

            $str_buffer = curl_exec($ch1);

            break;

    }

    if ($bol_return_array) {
        $xml = simplexml_load_string(trim($str_buffer));
        $json = json_encode($xml);
        $str_buffer = json_decode($json, TRUE);
    }

    return $str_buffer;
}

function sc_include_library($str_origem, $str_library, $str_file, $bol_once = true, $bol_require = true)
{
    $str_file_include = $str_library . "/" . $str_file;
    if ($str_origem == "prj" || $str_origem == "project") {
        $str_file_include = "../_lib/libraries/grp/" . $str_file_include;
    } elseif ($str_origem == "public" || $str_origem == "sys") {
        $str_file_include = "../_lib/libraries/sys/" . $str_file_include;
    } else {
        $str_file_include = "../_lib/libraries/scriptcase/" . $str_file_include;
    }

    if ($bol_once) {
        if ($bol_require) {
            require_once($str_file_include);
        } else {
            include_once($str_file_include);
        }
    } else {
        if ($bol_require) {
            require($str_file_include);
        } else {
            include($str_file_include);
        }
    }
}

function sc_url_library($str_origem, $str_library, $str_file, $boll_full_url = false, $bol_header = false)
{
    $str_file_include = $str_library . "/" . $str_file;
    if ($str_origem == "prj" || $str_origem == "project") {
        $str_file_include = "_lib/libraries/grp/" . $str_file_include;
    } elseif ($str_origem == "sys" || $str_origem == "public") {
        $str_file_include = "_lib/libraries/sys/" . $str_file_include;
    } else {
        $str_file_include = "_lib/libraries/scriptcase/" . $str_file_include;
    }

    if (!$boll_full_url) {
        $str_file_include = "../" . $str_file_include;
    } else {
        $str_file_include = "//" . dirname(dirname($_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"])) . "/" . $str_file_include;
        if ($bol_header) {
            if (is_ssl()) {
                $str_file_include = "https:" . $str_file_include;
            } else {
                $str_file_include = "http:" . $str_file_include;
            }
        }
    }

    return $str_file_include;
}

function is_ssl()
{
    if (isset($_SERVER['HTTPS'])) {
        if ('on' == strtolower($_SERVER['HTTPS'])) {
            return true;
        }
        if ('1' == $_SERVER['HTTPS']) {
            return true;
        }
    }

    if (isset($_SERVER['REQUEST_SCHEME'])) {
        if ('https' == $_SERVER['REQUEST_SCHEME']) {
            return true;
        }
    }

    if (isset($_SERVER['SERVER_PORT'])) {
        if ('443' == $_SERVER['SERVER_PORT']) {
            return true;
        }
    }

    return false;
}

function sc__statistic($arr_input, $var_tp = "A")
{
    return false;
}
function sc__ldap_groups($filter=[]){
    return false;
}

function sc_statistic($arr_input, $var_tp = "A")
{
    /* var_tp: A = amostral
               P = populacional
    */
    $media = 0;
    $mediana = 0;
    $variancia = 0;
    $desvio = 0;
    $amplitude = 0;
    $d_count = 0;
    $freq = 0;
    $count = 0;
    $max = 0;
    $min = 0;
    $trab = 0;
    if (!is_array($arr_input) || empty($arr_input)) {
        return array($media, $mediana, $variancia, $desvio, $amplitude, $d_count, $freq, $count, $min, $max);
    }
    if (count($arr_input) < 2) {
        $freq = 1;
        $d_count = 1;
        if ($arr_input[0] != null) {
            $count = 1;
        }
        if (is_numeric($arr_input[0])) {
            $media = $arr_input[0];
            $mediana = $arr_input[0];
            $min = $arr_input[0];
            $max = $arr_input[0];
        }
        return array($media, $mediana, $variancia, $desvio, $amplitude, $d_count, $freq, $count, $min, $max);
    }
    $freq = count($arr_input);
    $ctr_dupl = false;
    sort($arr_input);
    $min = $arr_input[0];
    $max = $arr_input[$freq - 1];
    foreach ($arr_input as $k => $val) {
        if ($val != null) {
            $count++;
        }
        if (is_numeric($val)) {
            $trab += $val;
        } else {
            $arr_input[$k] = 0;
        }
        if ($val !== $ctr_dupl) {
            $d_count++;
        }
        $ctr_dupl = $val;
    }
    $media = $trab / $freq;
    $amplitude = $arr_input[$freq - 1] - $arr_input[0];
    $trab = 0;
    foreach ($arr_input as $val) {
        if (!is_numeric($val)) {
            $val = 0;
        }
        $trab += pow(($val - $media), 2);
    }
    if ($var_tp == "A") {
        $variancia = $trab / ($freq - 1);
    } else {
        $variancia = $trab / $freq;
    }
    $desvio = sqrt($variancia);
    $trab = (int)$freq / 2;
    $rest = $freq % 2;
    if ($rest == 1) {
        $mediana = $arr_input[$trab];
    } else {
        $mediana = ($arr_input[$trab] + $arr_input[$trab - 1]) / 2;
    }
    return array($media, $mediana, $variancia, $desvio, $amplitude, $d_count, $freq, $count, $min, $max);
}


function nm_fix_permissions($path, $permission = 0644, $recursive = true)
{
    $arr_files = array_diff(scandir($path), ['.', '..']);
    foreach ($arr_files as $file) {
        if (is_dir($path . $file)) {
            @chmod($path . $file, 0755);
            if ($recursive) {
                nm_fix_permissions($path . $file . '/', $permission);
            }
        } else {
            @chmod($path . $file, $permission);
        }
    }
}

function sc_menu_force_orientation($str_option)
{
    if ($str_option == 'vertical') {
        $_SESSION['scriptcase']['force_menu_orientacao'] = $str_option;
    } elseif ($str_option == 'horizontal') {
        $_SESSION['scriptcase']['force_menu_orientacao'] = $str_option;
    } else {
        unset($_SESSION['scriptcase']['force_menu_orientacao']);
    }
}

/*function sc_appmenu_create($str_app_name)
{
    if (!isset($_SESSION['scriptcase']['sc_def_menu'][ $str_app_name ]))
    {
        $_SESSION['scriptcase']['sc_def_menu'][ $str_app_name ] = array();
    }
}

function sc_appmenu_reset($str_app_name)
{
    if (isset($_SESSION['scriptcase']['sc_def_menu'][ $str_app_name ]))
    {
        unset($_SESSION['scriptcase']['sc_def_menu'][ $str_app_name ]);
    }
}*/

function sc_appmenu_exist_item($str_app_name, $str_menu_item_id)
{
    return isset($_SESSION['scriptcase']['sc_def_menu'][$str_app_name][$str_menu_item_id]);
}

function sc_appmenu_remove_item($str_app_name, $str_menu_item_id)
{
    unset($_SESSION['scriptcase']['sc_def_menu'][$str_app_name][$str_menu_item_id]);
}

function sc_usermenu_create($str_app_name)
{
    if (!isset($_SESSION['scriptcase']['sc_usermenu'][$str_app_name])) {
        $_SESSION['scriptcase']['sc_usermenu'][$str_app_name] = array();
    }
}

function sc_usermenu_reset($str_app_name)
{
    if (isset($_SESSION['scriptcase']['sc_usermenu'][$str_app_name])) {
        unset($_SESSION['scriptcase']['sc_usermenu'][$str_app_name]);
    }
}

function sc_usermenu_remove_item($str_app_name, $str_menu_item_id)
{
    unset($_SESSION['scriptcase']['sc_usermenu'][$str_app_name][$str_menu_item_id]);
}

function sc_usermenu_exist_item($str_app_name, $str_menu_item_id)
{
    return isset($_SESSION['scriptcase']['sc_usermenu'][$str_app_name][$str_menu_item_id]);
}

function sc_menu_delete(&$arr_menu, $arr_remove)
{
    if (isset($arr_menu['itens'])) {
        sc_menu_delete_rec($arr_menu['itens'], $arr_remove);
    }
}

function sc_menu_delete_rec(&$arr_menu, $arr_remove)
{
    foreach ($arr_menu as $_id => $_arr_item) {
        if (in_array($_id, $arr_remove)) {
            unset($arr_menu[$_id]);
        } else {
            if (isset($_arr_item['itens']) && is_array($_arr_item['itens']) && !empty($_arr_item['itens'])) {
                sc_menu_delete_rec($arr_menu[$_id]['itens'], $arr_remove);
            }
        }
    }
}

function sc_menu_disable(&$arr_menu, $arr_remove)
{
    if (isset($arr_menu['itens'])) {
        sc_menu_disable_rec($arr_menu['itens'], $arr_remove);
    }
}

function sc_menu_disable_rec(&$arr_menu, $arr_remove)
{
    foreach ($arr_menu as $_id => $_arr_item) {
        if (in_array($_id, $arr_remove)) {
            $arr_menu[$_id]['disabled'] = 'Y';
            $arr_menu[$_id]['link'] = '#';
            $arr_menu[$_id]['itens'] = array();
        } else {
            if (isset($_arr_item['itens']) && is_array($_arr_item['itens']) && !empty($_arr_item['itens'])) {
                sc_menu_disable_rec($arr_menu[$_id]['itens'], $arr_remove);
            }
        }
    }
}

function sc_appmenu_shortcuts($str_app_name, $arr_shortcuts)
{
    $_SESSION['scriptcase']['sc_def_shortcuts'][$str_app_name] = array();
    if (is_array($arr_shortcuts) && !empty($arr_shortcuts)) {
        $_SESSION['scriptcase']['sc_def_shortcuts'][$str_app_name] = $arr_shortcuts;

        if (isset($_SESSION['scriptcase']['sc_def_menu'][$str_app_name]) && !empty($_SESSION['scriptcase']['sc_def_menu'][$str_app_name])) {
            sc_appmenu_shortcuts_rec($_SESSION['scriptcase']['sc_def_menu'][$str_app_name], $arr_shortcuts);
        }
        if (isset($_SESSION['scriptcase']['sc_usermenu'][$str_app_name]) && !empty($_SESSION['scriptcase']['sc_usermenu'][$str_app_name])) {
            sc_appmenu_shortcuts_rec($_SESSION['scriptcase']['sc_usermenu'][$str_app_name], $arr_shortcuts);
        }
    }
}

function sc_appmenu_shortcuts_rec(&$arr_menu, $arr_shortcuts)
{
    foreach ($arr_menu as $_id => $_arr_item) {
        if (in_array($_id, $arr_shortcuts)) {
            $arr_menu[$_id]['fav_check'] = 'S';
        }

        if (isset($_arr_item['itens']) && is_array($_arr_item['itens']) && !empty($_arr_item['itens'])) {
            sc_appmenu_shortcuts_rec($arr_menu[$_id]['itens'], $arr_shortcuts);
        }
    }
}

function sc_menu_clearitens(&$arr_menu)
{
    if (isset($arr_menu['itens'])) {
        sc_menu_clearitens_rec($arr_menu['itens']);
    }
}

function sc_menu_clearitens_rec(&$arr_menu)
{
    foreach ($arr_menu as $_id => $_arr_item) {
        if ($arr_menu[$_id]['disabled'] == 'Y' || empty($arr_menu[$_id]['link']) || ($arr_menu[$_id]['link'] == '#' && (!isset($_arr_item['itens']) || empty($_arr_item['itens'])))) {
            unset($arr_menu[$_id]);
        } else {
            if (isset($_arr_item['itens']) && is_array($_arr_item['itens']) && !empty($_arr_item['itens'])) {
                sc_menu_clearitens_rec($arr_menu[$_id]['itens']);

                if (empty($arr_menu[$_id]['itens'])) {
                    unset($arr_menu[$_id]);
                }
            }
        }
    }
}

function sc_appmenu2_add_item(&$arr_menu, $item_add, $menu_id_pai, $parent_list = false)
{
    if (is_array($parent_list)) {
        $cur_parent_list = $parent_list;
    } else {
        $cur_parent_list = false;
    }
    $item_add['parent_list'] = [];
    if (empty($menu_id_pai)) {
        $arr_menu[$item_add['id']] = $item_add;
    } else if (is_array($arr_menu) && !empty($arr_menu)) {
        foreach ($arr_menu as $_id => $_arr_item) {
            if ($_id == $menu_id_pai) {
                if (is_array($cur_parent_list)) {
                    $cur_parent_list[] = $menu_id_pai;
                    $item_add['parent_list'] = $cur_parent_list;
                }
                $arr_menu[$_id]['itens'][$item_add['id']] = $item_add;
            } elseif (isset($_arr_item['itens']) && is_array($_arr_item['itens']) && !empty($_arr_item['itens'])) {
                if (is_array($cur_parent_list)) {
                    $cur_parent_list[] = $_arr_item['id'];
                }
                sc_appmenu2_add_item($arr_menu[$_id]['itens'], $item_add, $menu_id_pai, $cur_parent_list);
            }
        }
    }
}

function imageToURL($in_data)
{
    $img_src = '';
    if (is_resource($in_data)) {
        $img_buffer = stream_get_contents($in_data);
    } else {
        $img_buffer = $in_data;
    }
    if (!empty($img_buffer)) {
        $file_info = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $file_info->buffer($img_buffer);
        if ($mimeType && strpos($mimeType, 'image') !== false) {
            $img_src = 'data:' . $mimeType . ';base64,' . base64_encode($img_buffer);
        } else {
            $img_src = $img_buffer;
        }
    }
    return $img_src;
}

function trataCampoTabela_app($v_str_field, $tipo_banco)
{
    return $v_str_field;
    $arr_param = explode(".", $v_str_field);
    foreach ($arr_param as $_key => $v_str_field) {
        switch (nm_db_sc_type1(nm_db_type1($tipo_banco))) {
            case 'access':
            case 'mysql':
            case 'mariadb':
            case 'sqlite':
                $v_str_field = "`" . $v_str_field . "`";
                break;
            case 'interbase':
            case 'informix':
            case 'oracle':
            case 'postgres':
            case 'mssql':
            case 'odbc':
            default:
                $v_str_field = '"' . $v_str_field . '"';
                break;
        }
        $arr_param[$_key] = $v_str_field;
    }
    return implode(".", $arr_param);
}

function nm_db_sc_type1($v_str_dbms)
{
    if (substr($v_str_dbms, 0, 6) == "azure_") {
        $v_str_dbms = substr($v_str_dbms, 6);
    } elseif (substr($v_str_dbms, 0, 10) == "amazonrds_") {
        $v_str_dbms = substr($v_str_dbms, 10);
    } elseif (substr($v_str_dbms, 0, 12) == "googlecloud_") {
        $v_str_dbms = substr($v_str_dbms, 12);
    } elseif (substr($v_str_dbms, 0, 12) == "oraclecloud_") {
        $v_str_dbms = substr($v_str_dbms, 12);
    }
    return $v_str_dbms;
}

/**
 * Retorna o tipo do banco.
 *
 * Retorna o tipo do sistema gerenciador de banco de dados.
 *
 * @access  public
 * @param string $v_str_dbms Banco de dados.
 * @return  string  $bol_result  Tipo do banco de dados.
 */
function nm_db_type1($v_str_dbms)
{
    switch ($v_str_dbms) {
        /* Access  */
        case 'access':
        case 'ace_access':
        case 'ado_access':
            return 'access';
            break;
        /* ADO */
        case 'ado':
            return 'ado';
            break;
        /* DB2 */
        case 'db2':
        case 'db2_odbc':
        case 'odbc_db2':
        case 'odbc_db2v6':
        case 'pdo_db2_odbc':
        case 'pdo_ibm':
            return 'db2';
            break;
        /* Frontbase */
        case 'fbsql':
            return 'fbsql';
            break;
        /* Informix */
        case 'informix':
        case 'pdo_informix':
        case 'informix72':
            return 'informix';
            break;
        /* Interbase */
        case 'borland_ibase':
        case 'firebird':
        case 'ibase':
        case 'interbase':
        case 'pdo_firebird':
            return 'interbase';
            break;
        /* MS-SQL Server */
        case 'ado_mssql':
        case 'adooledb_mssql':
        case 'mssql':
        case 'mssqlnative':
        case 'mssqlpo':
        case 'odbc_mssql':
        case 'pdo_sqlsrv':
        case 'sqlsrv':
        case 'pdo_dblib':
        case 'dblib':
            return 'mssql';
            break;
        /* MySQL */
        case 'mysql':
        case 'mysqlt':
        case 'mysqli':
        case 'pdo_mysql':
            return 'mysql';
            break;
        case 'pdo_mariadb':
            return 'mariadb';
            break;
        /* ODBC */
        case 'odbc':
            return 'odbc';
            break;
        /* Oracle */
        case 'oci8':
        case 'oci805':
        case 'oci8po':
        case 'odbc_oracle':
        case 'oracle':
        case 'pdo_oracle':
            return 'oracle';
            break;
        /* PostGreSQL */
        case 'pgsql':
        case 'postgres':
        case 'postgres64':
        case 'postgres7':
        case 'pdo_pgsql':
            return 'postgres';
            break;
        /* SQLite */
        case 'pdosqlite':
        case 'sqlite':
        case 'sqlite3':
            return 'sqlite';
            break;
        /* Sybase */
        case 'sqlanywhere':
        case 'sybase':
        case 'pdo_sybase_odbc':
        case 'pdo_sybase_dblib':
            return 'sybase';
            break;
        /* progress */
        case 'progress':
        case 'pdo_progress_odbc':
            return 'progress';
            break;
        /* Visual Fox Pro */
        case 'vfp':
            return 'vfp';
            break;

        case 'azure_pdo_mysql':
        case 'azure_mysqli':
        case 'azure_mysqlt':
        case 'azure_mysql':
            return 'azure_mysql';
            break;
        case 'azure_pdo_pgsql':
        case 'azure_postgres7':
        case 'azure_postgres64':
        case 'azure_postgres':
            return 'azure_postgres';
            break;
        case 'azure_ado_mssql':
        case 'azure_adooledb_mssql':
        case 'azure_mssql':
        case 'azure_mssqlnative':
        case 'azure_mssqlpo':
        case 'azure_odbc_mssql':
        case 'azure_pdo_sqlsrv':
        case 'azure_sqlsrv':
        case 'azure_pdo_dblib':
        case 'azure_dblib':
            return 'azure_mssql';
            break;
        case 'azure_pdo_mariadb':
            return 'azure_mariadb';
            break;

        case 'amazonrds_pdo_mysql':
        case 'amazonrds_mysqli':
        case 'amazonrds_mysqlt':
        case 'amazonrds_mysql':
            return 'amazonrds_mysql';
            break;
        case 'amazonrds_pdo_mariadb':
            return 'amazonrds_mariadb';
            break;
        case 'amazonrds_pdo_pgsql':
        case 'amazonrds_postgres7':
        case 'amazonrds_postgres64':
        case 'amazonrds_postgres':
            return 'amazonrds_postgres';
            break;
        case 'amazonrds_ado_mssql':
        case 'amazonrds_adooledb_mssql':
        case 'amazonrds_mssql':
        case 'amazonrds_mssqlnative':
        case 'amazonrds_mssqlpo':
        case 'amazonrds_odbc_mssql':
        case 'amazonrds_pdo_sqlsrv':
        case 'amazonrds_sqlsrv':
        case 'amazonrds_pdo_dblib':
        case 'amazonrds_dblib':
            return 'amazonrds_mssql';
            break;
        case 'amazonrds_oci8':
        case 'amazonrds_oci805':
        case 'amazonrds_oci8po':
        case 'amazonrds_odbc_oracle':
        case 'amazonrds_oracle':
        case 'amazonrds_pdo_oracle':
            return 'amazonrds_oracle';
            break;

        case 'googlecloud_pdo_mysql':
        case 'googlecloud_mysqli':
        case 'googlecloud_mysqlt':
        case 'googlecloud_mysql':
            return 'googlecloud_mysql';
            break;
        case 'googlecloud_pdo_mariadb':
            return 'googlecloud_mariadb';
            break;
        case 'googlecloud_pdo_pgsql':
        case 'googlecloud_postgres7':
        case 'googlecloud_postgres64':
        case 'googlecloud_postgres':
            return 'googlecloud_postgres';
            break;
        case 'googlecloud_ado_mssql':
        case 'googlecloud_adooledb_mssql':
        case 'googlecloud_mssql':
        case 'googlecloud_mssqlnative':
        case 'googlecloud_mssqlpo':
        case 'googlecloud_odbc_mssql':
        case 'googlecloud_pdo_sqlsrv':
        case 'googlecloud_sqlsrv':
        case 'googlecloud_pdo_dblib':
        case 'googlecloud_dblib':
            return 'googlecloud_mssql';
            break;

        case 'oraclecloud_oci8':
        case 'oraclecloud_oci805':
        case 'oraclecloud_oci8po':
        case 'oraclecloud_odbc_oracle':
        case 'oraclecloud_oracle':
        case 'oraclecloud_pdo_oracle':
            return 'oraclecloud_oracle';
            break;

        /* Outros */
        default:
            return $v_str_dbms;
            break;
    }
} // nm_db_type

//------------------------------------------------------------------------------
// Notificações
//------------------------------------------------------------------------------


function nm_list_modules($type = '')
{
    $file = __DIR__ . "/../../profile_modules.conf.php";
    if (!file_exists($file)) {
        $file = nm_get_prod_path() . "../conf/profile_modules.conf.php";
    }

    if (!file_exists($file)) {
        return false;
    }
    $str_content = strtr(file_get_contents($file), array("<?php" => '', "?>" => ''));
    $arr_content = unserialize(trim($str_content));


    return $arr_content[$type] ?? [];
}

function nm_load_profile_module($type, $profile)
{
    $file = __DIR__ . "/../../profile_modules.conf.php";
    if (!file_exists($file)) {
        $file = nm_get_prod_path() . "../conf/profile_modules.conf.php";
    }

    if (!file_exists($file)) {
        return false;
    }

    $str_content = strtr(file_get_contents($file), array("<?php" => '', "?>" => ''));
    $arr_content = unserialize(trim($str_content));
    $mod = '';
    $arr_content = $arr_content[$type];
    if (isset($arr_content[$profile])) {
        return $arr_content[$profile];
    } else {
        $ret = explode(stripos($profile, '__NM__') !== false ? '__NM__' : '::', $profile);
        $profile = isset($ret[1]) ? $ret[1] : $ret[0];
        if (count($ret) == 2) {
            $mod = $ret[0];
        }
        if (isset($arr_content[$mod]) && isset($arr_content[$mod][$profile])) {
            return $arr_content[$mod][$profile];
        } else {
            foreach (['scriptcase', 'sys', 'grp', 'usr'] as $mod) {
                if (isset($arr_content[$mod][$profile])) {
                    return $arr_content[$mod][$profile];
                }
            }
        }
    }
    return (isset($arr_content[$profile]) ? $arr_content[$profile] : false);
}

function sc_get_value_profile_module($type, $profile, $key = '')
{
    if (!isset($_SESSION['scriptcase']['profile_modules'][$type][$profile])) {
        $arr = nm_load_profile_module($type, $profile);
        $_SESSION['scriptcase']['profile_modules'][$type][$profile] = $arr;
    }
    if (empty($key)) {
        return ($_SESSION['scriptcase']['profile_modules'][$type][$profile] ?? false);
    }
    return ($_SESSION['scriptcase']['profile_modules'][$type][$profile][$key] ?? false);
}

function sc_send_notification_backend($arr_args, $app)
{
    $default_args = array(
        'title' => '',
        'notification_id' => 0,
        'message' => '',
        'to' => '',
        'from' => '',
        'type' => '',
        'link' => '',
        'destiny_type' => '', // 'user', 'group', 'all', 'profile'
        'profile' => '',
        'dtexpire' => 0,
        'ontop' => 0,
    );

    if(empty($arr_args)){
        return false;
    }
    if(!isset($arr_args['profile']) || !isset($arr_args['from']) || empty($arr_args['from'])){
        return false;
    }
    $nome_app = $app->Ini->nm_cod_apl;

    $conn_notifications = sc_get_value_profile_module('notification', $arr_args['profile'], 'tabela_conn');
    $conn_app = isset($_SESSION['scriptcase'][$nome_app]['glo_nm_conexao']) ? $_SESSION['scriptcase'][$nome_app]['glo_nm_conexao'] : $_SESSION['scriptcase'][$nome_app]['glo_nm_perfil'];

    if($conn_notifications == false){
        return false;
    }

    if($conn_notifications == $conn_app){
        $conn = $app->Db;
    }else {
        if(isset($_SESSION['scriptcase']['nm_sc_retorno'])
            && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) {
            $conn = db_conect_devel($conn_notifications,
                $app->Ini->root . $app->Ini->path_prod,
                $app->Ini->nm_grupo, 1, $app->Ini->force_db_utf8);
        }else {

            carrega_perfil("conn_sqlite", $app->path_libs, "S", $app->path_conf);
            $nm_con_persistente = (!isset($app->Ini->nm_con_persistente) ? 'N' : $app->Ini->nm_con_persistente);

            $nm_con_db2 = (!isset($app->Ini->nm_con_db2) ? '' : $app->Ini->nm_con_db2);
            $nm_database_encoding = (!isset($app->Ini->nm_database_encoding) ? '' : $app->Ini->nm_database_encoding);
            $nm_database_encoding = (isset($app->Ini->nm_database_encoding) ? 'utf8' : $nm_database_encoding);
            $nm_arr_db_extra_args = (!isset($app->Ini->nm_arr_db_extra_args) ? array() : $app->Ini->nm_arr_db_extra_args);

            $glo_senha_protect = isset($_SESSION['scriptcase']['glo_senha_protect']) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
            $conn = db_conect($app->Ini->nm_tpbanco, $app->Ini->nm_servidor, $app->Ini->nm_usuario, $app->Ini->nm_senha, $app->Ini->nm_banco,
                $glo_senha_protect, "S", $nm_con_persistente, $nm_con_db2, $nm_database_encoding, $nm_arr_db_extra_args);
        }
    }

    $to = ($arr_args['to'] ?? '');
    $fld_login = sc_get_value_profile_module('notification', $arr_args['profile'], 'table_usr_field_login');
    $fld_group_id = sc_get_value_profile_module('notification', $arr_args['profile'], 'table_grp_field_group_id');
    $fld_group_desc = sc_get_value_profile_module('notification', $arr_args['profile'], 'table_grp_field_description');

    $table_usr = sc_get_value_profile_module('notification', $arr_args['profile'], 'table_usr');
    $table_grp = sc_get_value_profile_module('notification', $arr_args['profile'], 'table_grp');
    $table_usr_grp = sc_get_value_profile_module('notification', $arr_args['profile'], 'table_usr_grp');

    $arr_profiles_db = sc_get_value_profile_module('notification', $arr_args['profile'], 'profiles');
    $arr_pref_db = sc_get_value_profile_module('notification', $arr_args['profile'], 'pref');
    $arr_notification_db = sc_get_value_profile_module('notification', $arr_args['profile'], 'notifications');
    $arr_inbox_db = sc_get_value_profile_module('notification', $arr_args['profile'], 'inbox');

    $table_profiles = $arr_profiles_db['table'];
    $fld_profiles_name = $arr_profiles_db['profile_name'];
    $fld_profiles_users = $arr_profiles_db['profile_users'];
    $fld_profiles_groups = $arr_profiles_db['profile_groups'];
    $fld_profiles_public = $arr_profiles_db['profile_public'] ?? '';
    $fld_profile_owner = $arr_profiles_db['profile_owner'] ?? '';

    $table_pref = $arr_pref_db['table'];
    $fld_pref_login = $arr_pref_db['login'];
    $fld_pref_receive_email = $arr_pref_db['receive_email'];
    $fld_pref_receive_sms = $arr_pref_db['receive_sms'];

    $hora_agora = date("Y-m-d H:i:s");

    $arr_args['from']  = (!isset($arr_args['from']) || empty($arr_args['from'])  ? 'system' : $arr_args['from']);

    if (empty($arr_args['notification_id'])) {

        //insert notification in database
        $sql = "INSERT INTO " . $arr_notification_db['table']
            . " (" . $arr_notification_db['notif_title'] . ", " .
            $arr_notification_db['notif_message'] . ", " .
            (isset($arr_args['dtexpire']) && !empty($arr_args['dtexpire']) ? $arr_notification_db['notif_dtexpire'] . ", " : '') .
            $arr_notification_db['notif_dtcreated'] . ", " .
            $arr_notification_db['notif_login_sender'] . ", " .
            $arr_notification_db['notif_type'] . ", " .
            $arr_notification_db['notif_link'] .
            ") VALUES ("
            . $conn->qstr($arr_args['title'] ?? '') . ", "
            . $conn->qstr($arr_args['message'] ?? '') . ", "
            . (isset($arr_args['dtexpire']) && !empty($arr_args['dtexpire']) ? $conn->qstr(trim($arr_args['dtexpire']) ) . ", " : '')
            . $conn->qstr($hora_agora) . ", "
            . $conn->qstr($arr_args['from']) . ", "
            . $conn->qstr($arr_args['type'] ?? '') . ", "
            . $conn->qstr($arr_args['link'] ?? '')
            . ")";

        $conn->Execute($sql);
        $notif_id = $conn->lastInsertedId($arr_notification_db['table'], $arr_notification_db['notif_id']);
    } else {
        $notif_id = $arr_args['notification_id'];
    }

    $arr_logins = [];
    switch ($arr_args['destiny_type']) {
        case 'user':
            $arr_logins = !is_array($to) ? explode(';', $to) : $to;
            break;
        case 'group':
            $arr_grp = !is_array($to) ? explode(';', $to) : $to;
            foreach ($arr_grp as $g) {
                if(!is_numeric($g)){
                    $sql = "SELECT " . $fld_group_id . " FROM " . $table_grp . " WHERE " . $fld_group_desc . " = " . $conn->qstr($g);
                    $rs = $conn->Execute($sql);
                    $__tmp = $rs->GetArray();
                    if(!isset($__tmp[0][$fld_group_id])){
                        continue;
                    }
                    $g = $__tmp[0][$fld_group_id];
                }
                $sql = "SELECT " . $fld_login . " FROM " . $table_usr_grp . " WHERE " . $fld_group_id . " = " . $conn->qstr($g);                $rs = $conn->Execute($sql);
                $__tmp = $rs->GetArray();
                foreach ($__tmp as $v) {
                    $arr_logins[] = $v[$fld_login];
                }
            }
            break;
        case 'all':
            $sql = "SELECT " . $fld_login . " FROM " . $table_usr;
            $rs = $conn->Execute($sql);
            $__tmp = $rs->GetArray();
            foreach ($__tmp as $v) {
                $arr_logins[] = $v[$fld_login];
            }
            break;
        case 'profile':
            $arr_args_profiles = !is_array($to) ? explode(';', $to) : $to;
            $arr_logins = [];
            foreach ($arr_args_profiles as $to ) {
                $sql = "SELECT " . $fld_profiles_users . ", " . $fld_profiles_groups . " FROM " . $table_profiles . " WHERE " . $fld_profiles_name . " = " . $conn->qstr($to);
                $rs = $conn->Execute($sql);
                $arr_profiles = $rs->GetArray();

                if (isset($arr_profiles[0])) {
                    if (isset($arr_profiles[0][$fld_profiles_groups]) && !empty($arr_profiles[0][$fld_profiles_groups])) {
                        $__tmp = explode(',', $arr_profiles[0][$fld_profiles_groups]);

                        foreach ($__tmp as $v) {
                            $sql = "SELECT " . $fld_login . " FROM " . $table_usr_grp . " WHERE " . $fld_group_id . " = " . $conn->qstr($v);
                            $rs = $conn->Execute($sql);
                            $___tmp = $rs->GetArray();
                            foreach ($___tmp as $r) {
                                $arr_logins[] = $r[$fld_login];
                            }
                        }
                    }
                    if (isset($arr_profiles[0][$fld_profiles_users]) && !empty($arr_profiles[0][$fld_profiles_users])) {
                        $__tmp = explode(';', $arr_profiles[0][$fld_profiles_users]);
                        foreach ($__tmp as $v) {
                            $arr_logins[] = $v;
                        }
                    }
                }
            }
            break;
    }

    $arr_logins = array_unique($arr_logins);
    if (empty($arr_logins)) {
        return;
    }

    foreach ($arr_logins as $k => $v) {
        $arr_logins[$k] = $conn->qstr($v);
        $sql = "INSERT INTO " . $arr_inbox_db['table']
            . " (" .
            $arr_inbox_db['notif_id'] . ", " .
            $arr_inbox_db['login'] . ", " .
            $arr_inbox_db['notif_ontop'] . ", " .
            $arr_inbox_db['notif_dtsent'] . ", " .
            $arr_inbox_db['notif_tags'] .
            ") VALUES (" .
            $conn->qstr($notif_id) . ", " .
            $conn->qstr($v) . ", " .
            $conn->qstr($arr_args['ontop'] ?? 0) . ", " .
            $conn->qstr($hora_agora) . ", " .
            $conn->qstr(0)
            . ")";



        $conn->Execute($sql);
    }

    $arr_login_pref = [];
    $sql = "SELECT " . $fld_pref_login . ", " . $fld_pref_receive_email . ", " . $fld_pref_receive_sms . " FROM " . $table_pref . " WHERE " . $fld_pref_login . " IN (" . implode(',', $arr_logins) . ")";

    $rs = $conn->Execute($sql);
    $_tmp = $rs->GetArray();

    foreach ($_tmp as $v) {
        $args = array(
            'title' => $arr_args['title'],
            'message' => $arr_args['message'],
            'to' => $v['login'],
            'profile' => $arr_args['profile'],
        );
        if ($v[$fld_pref_receive_email] == '1') {
            sc_send_notification_email_backend($args, $conn);
        }
        if ($v[$fld_pref_receive_sms] == '1') {
            sc_send_notification_sms_backend($args, $conn);
        }
    }
    return true;
}

function sc_send_notification_email_backend($arr_args, $conn)
{
    $default_args = array(
        'title' => '',
        'message' => '',
        'to' => '',
        'profile' => '',
    );
    $config_general = sc_get_value_profile_module('notification', $arr_args['profile'], 'config_general');
    if (empty($config_general['smtp_api'])) {
        return;
    } elseif ($config_general['smtp_api'] == 'same_of_security' && isset($_SESSION['sett_smtp'])) {
        $smtp_conf = $_SESSION['sett_smtp'];
    } elseif ($config_general['smtp_api'] == 'custom') {
        $smtp_conf = sc_get_value_profile_module('notification', $arr_args['profile'], 'config_email');
        $smtp_conf['gateway'] = 'smtp';
        $smtp_conf['smtp_password'] = $smtp_conf['smtp_pass'];
        $smtp_conf['smtp_protocol'] = $smtp_conf['smtp_security'];
        $smtp_conf['from_email'] = $smtp_conf['smtp_email'];
        $smtp_conf['from_name'] = $smtp_conf['smtp_name'];
        $smtp_conf = array('settings' => $smtp_conf);
    } else {
        $smtp_conf = array('profile' => $config_general['smtp_api']);
    }

    $table_usr = sc_get_value_profile_module('notification', $arr_args['profile'], 'table_usr');

    $fld_login = sc_get_value_profile_module('notification', $arr_args['profile'], 'table_usr_field_login');
    $fld_email = sc_get_value_profile_module('notification', $arr_args['profile'], 'table_usr_field_email');

    $sql = "SELECT " . $fld_email . " FROM " . $table_usr . " WHERE " . $fld_login . " = " . $conn->qstr($arr_args['to']);
    $rs = $conn->Execute($sql);
    $_tmp = $rs->GetArray();
    if (isset($_tmp[0])) {
        $email = $_tmp[0][$fld_email];
        sc_send_mail_api(array_merge($smtp_conf, array(
            'message' => [
                'html' => $arr_args['message'],
                'text' => '',
                'to' => $email,
                'subject' => $arr_args['title'],
            ]
        )));
    }
}

function sc_send_notification_sms_backend($arr_args, $conn)
{
    $default_args = array(
        'title' => '',
        'message' => '',
        'to' => '',
        'profile' => '',
    );
    $config_general = sc_get_value_profile_module('notification', $arr_args['profile'], 'config_general');
    $config_sms = sc_get_value_profile_module('notification', $arr_args['profile'], 'config_sms');
    if (empty($config_general['sms_api'])) {
        return;
    }

    $table_usr = sc_get_value_profile_module('notification', $arr_args['profile'], 'table_usr');

    $fld_login = sc_get_value_profile_module('notification', $arr_args['profile'], 'table_usr_field_login');
    $fld_phone = sc_get_value_profile_module('notification', $arr_args['profile'], 'table_usr_field_phone');

    $sql = "SELECT " . $fld_phone . " FROM " . $table_usr . " WHERE " . $fld_login . " = " . $conn->qstr($arr_args['to']);
    $rs = $conn->Execute($sql);
    $_tmp = $rs->GetArray();

    $msg = !empty($config_sms['qtd']) ? substr($arr_args['message'], 0, $config_sms['qtd']) : $arr_args['message'];
    if (isset($_tmp[0])) {
        $sms = $_tmp[0][$fld_phone];
        sc_send_sms(array(
                'profile' => $config_general['sms_api'],
                'message' => [
                    'to' => $sms,
                    'message' => $msg,
                ]
        ));
    }
}
