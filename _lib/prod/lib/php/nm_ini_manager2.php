<?php
if (!isset($scBaseUrl)) {
    $scBaseUrl = '../../';
    $scSuffixUrl = '';
}
/**
 * $Id: nm_ini_manager2.php,v 1.8 2012-02-07 21:26:50 vinicius Exp $
 */
// Inicializa script
set_error_handler("trataError");
mt_srand((int)(microtime() * 1000000));
session_start();
error_reporting(E_ALL);



if (!isset($_SESSION['nm_session']['prod_v8'])) {
    $_SESSION['nm_session']['prod_v8'] = array('logged' => FALSE);
}

if (isset($_GET['login']) && isset($_SESSION['nm_session']['cache']['prod_v8'])) {
    unset($_SESSION['nm_session']['cache']['prod_v8']);

    if (isset($_SESSION['nm_session']['prod_v8']['logged'])) {
        unset($_SESSION['nm_session']['prod_v8']['logged']);
    }
}

if(!isset($_SESSION['nm_session']['prod_v8']['request_code']) || $_SESSION['nm_session']['prod_v8']['request_code'] ==  false){
    $_SESSION['nm_session']['prod_v8']['request_change_pass'] = false;
}
$arr_dbms = nm_prod_dbms();
$arr_error = array();
$arr_argv = nm_prod_argv();
$nm_config = nm_prod_path();
$str_option = '';
nm_prod_lang();
require($nm_config['path_lib'] . 'lang.' . $_SESSION['nm_session']['prod_v8']['lang'] . '.php');
nm_prod_help();
// Arquivo de inicializacao
if (!defined('NM_INC_PROD_INI')) {
    require_once($nm_config['path_lib'] . 'nm_ini_lib.php');
    require_once($nm_config['path_lib'] . 'nm_serialize.php');
}
$str_ini = $nm_config['path_conf'] . 'prod.config.php';
$arr_ini = nm_unserialize_ini($str_ini);

$_SESSION['nm_session']['prod_v8']['arr_dbms'] = $arr_dbms;
$_SESSION['nm_session']['prod_v8']['arr_ini'] = $arr_ini;

// Verifica login
if (isset($arr_argv['option'])) {
    $str_option = $arr_argv['option'];
    $str_opt_par = $arr_argv['opt_par'];
}
if (
        ('' != $str_option) &&
        ('login' != $str_option) &&
        !$_SESSION['nm_session']['prod_v8']['logged']
    )
{
    $str_option = '';
    $str_opt_par = '';
}

$str_message = "";
$b_reenviar = false;

    function gd_auth_api($app_name, $json_oauth, $auth_code = '', $return_token = false, $gateway='google_drive'){
        global $nm_config;
        $_SESSION['scriptcase']['nm_path_prod'] =  $nm_config['path_prod'];
        include_once(__DIR__.'/nm_api.php');

        return sc_call_api('',
            [
                'gateway'=> $gateway,
                'settings' => [
                    'app_name' => $app_name,
                    'json_oauth' => $json_oauth,
                    'auth_code' => $auth_code,
                    'return_token' => $return_token,
                    ]
            ]);
    }


if($arr_argv['option'] == 'code_page'){
    $_SESSION['nm_session']['prod_v8']['logged'] = false;
    $str_option = 'code_page';
}
else if($arr_argv['option'] == 'recover_password'){
    $_SESSION['nm_session']['prod_v8']['logged'] = false;
    $str_option = 'change_pass_page';
}
else if($arr_argv['option'] == 'change_pass' && isset($arr_argv['opt_par']) && $arr_argv['opt_par'] == "conf_rec_pass"){
    $_SESSION['nm_session']['prod_v8']['logged'] = false;
    $str_option = 'change_pass';
    $str_opt_par = 'conf_rec_pass';
}

// Processa formulario
switch ($str_option) {
    case 'code_page':
        $response = nm_prod_recover_password('recover_password');
        if(isset($response->result))
        {
            if($response->result == 200){
                $_SESSION['nm_session']['prod_v8']['request_code'] = true;
                $file = $nm_config['path_conf'].'prod.rec.conf.php';
                $str_content = strtr(file_get_contents( $file ), array('<?php /*' => '', '*/?>' => ''));
                $str_content = unserialize(trim($str_content));
                $arr_data    = array();
                $arr_data[0] = $str_content[0];
                $arr_data[1] = encode_string_utf8($response->prod_code);
                $arr_data    = serialize($arr_data);
                if(is_file($file)){
                    @unlink($file);
                }
                file_put_contents( $file, '<?php /*'. $arr_data .'*/?>');
                $str_option = 'code_page';
            }else{
                $arr_error[] = 'service_error';
                $str_option = 'code_page';
            }
        }else{
            $arr_error[] = 'service_error';
            $str_option  = 'code_page';
        }
    break;
    case 'change_pass_page':
        $response    = nm_prod_recover_password('check_recover_password',$arr_argv['field_pass_code']);
        if(isset($response->result)){
            if($response->result == 200){
                if($_SESSION['nm_session']['prod_v8']['request_code'] == true){
                    $_SESSION['nm_session']['prod_v8']['request_change_pass'] = true;
                    $str_option = 'change_pass_page';
                }else{
                    $str_option = 'code_page';
                }
            }else{
                $str_option = 'code_page';
                if($response->result == 401){
                    $arr_error[]  = 'service_blocked';
                }else if($response->result == 408){
                    $arr_error[]  = 'service_timeout';
                }else{
                    $arr_error[]  = 'service_general_error';
                }
            }
        }else{
            $arr_error[] = 'service_communicate_error';
            $str_option = 'code_page';
        }
    break;
    case 'gd_auth_api':
                    echo gd_auth_api($_REQUEST['app_name'], $_REQUEST['json_oauth'], '', false, $_REQUEST['gateway']);
exit;
        break;
    // Altera senha
    case 'change_pass':
        $input          = $arr_argv['field_pass_new'];
        $temMaiuscula   = false;
        $temMinuscula   = false;
        $temNumeros     = false;
        $temTamanho     = false;
        for ($i = 0; $i < strlen($input); $i++) {
            if (ctype_upper($input[$i])) {
                $temMaiuscula = true;
            } elseif (ctype_lower($input[$i])) {
                $temMinuscula = true;
            }elseif(ctype_digit($input[$i])) {
                $temNumeros = true;
            }
        }
        if (strlen($input) >= 8) {
            $temTamanho = true;
        }
        if(isset($arr_argv['opt_par']) && $arr_argv['opt_par'] == 'conf_rec_pass'){
            if(isset($_SESSION['nm_session']['prod_v8']['request_change_pass']) && $_SESSION['nm_session']['prod_v8']['request_change_pass'] != true){
                $arr_error[] = 'error_password_invalid';
                break;
            }else{
                if (!$temMaiuscula || !$temMinuscula || !$temNumeros || !$temTamanho) {
                    $arr_error[] = 'error_password_invalid';
                    break;
                }
                $arr_ini['GLOBAL']['PASSWORD'] = "";
            }
        }
        if (isset($arr_argv['field_pass_email'])) {
            if(empty($arr_argv['field_pass_email'])){
                $str_pwd_email_check = true;
            }else{
                if (filter_var($arr_argv['field_pass_email'], FILTER_VALIDATE_EMAIL)) {
                    $str_pwd_email_check = true;
                }else{
                    $str_pwd_email_check = false;
                }
            }
        }else{
            $str_pwd_email_check = true;
        }
        if (isset($arr_argv['field_pass_old'])) {
            $str_pwd_ini = decode_string($arr_ini['GLOBAL']['PASSWORD']);
            $str_pwd_old = $arr_argv['field_pass_old'];
            $str_pwd_new = trim($arr_argv['field_pass_new']);
            $str_pwd_conf = $arr_argv['field_pass_conf'];
            

            if ('' == $str_pwd_ini) {
                $str_pwd_ini = 'scriptcase';
            }
            if (!$temMaiuscula || !$temMinuscula || !$temNumeros || !$temTamanho) {
                $arr_error[] = 'error_password_invalid';
                break;
            }else if ($str_pwd_old != $str_pwd_ini) {
                $arr_error[] = 'error_password_invalid';
            } elseif (('' == $str_pwd_new) || ('scriptcase' == $str_pwd_new)) {
                $arr_error[] = 'error_password_reserved';
            } elseif ($str_pwd_new != $str_pwd_conf) {
                $arr_error[] = 'error_password_confirm';
            }else if(!$str_pwd_email_check){
                $arr_error[] = 'error_password_email';
            } else {
                $arr_ini['GLOBAL']['LANGUAGE'] = $_SESSION['nm_session']['prod_v8']['lang'];
                $arr_ini['GLOBAL']['PASSWORD'] = encode_string_utf8($str_pwd_new);
                $str_xml = nm_serialize_ini($arr_ini);

                salva_xml($str_ini, $str_xml, $arr_ini);

                if (isset($_POST['hid_login']) && $_POST['hid_login'] == 'S') {
                    if(isset($_SESSION['nm_session']['prod_v8']['request_change_pass']) && $_SESSION['nm_session']['prod_v8']['request_change_pass'] == true){
                        $str_option = 'login';
                    }else{
                        $str_option = 'main_menu';
                    }

                } else {
                    $str_option = "msg";
                    $b_reenviar = false;
                    $str_message = $nm_lang['msg_change_pass_ok'];
                }
                $_SESSION['nm_session']['prod_v8']['request_change_pass'] = false;
                $_SESSION['nm_session']['prod_v8']['request_code']        = false;
            }
        }
        if (isset($arr_argv['field_pass_email']) && !empty($arr_argv['field_pass_email']) && $str_pwd_email_check == true) {
            $v_file = $nm_config['path_conf']."prod.rec.conf.php";
            if(is_file($v_file)){
                @unlink($v_file);
            }
            $v_email = array( encode_string_utf8($arr_argv['field_pass_email']));
            file_put_contents($v_file, '<?php /*'.serialize($v_email).'*/?>');
        }
        break;
    // Ambiente de producao
    case 'environment':
        if (isset($arr_argv['field_gc_dir'])) {
            $b_reenviar = $arr_ini['GLOBAL']['LANGUAGE'] != $arr_argv['field_language'];

            $arr_ini['GLOBAL']['GC_DIR'] = $arr_argv['field_gc_dir'];
            $arr_ini['GLOBAL']['GC_MIN'] = $arr_argv['field_gc_min'];
            $arr_ini['GLOBAL']['CACHE_GC_MIN'] = $arr_argv['field_cache_gc_min'];
            $arr_ini['GLOBAL']['CACHE_GC_DIR'] = $arr_argv['field_cache_gc_dir'];
            $arr_ini['GLOBAL']['PDF_SERVER_WKHTML'] = $arr_argv['field_pdf_server_wkhtml'];
            $arr_ini['GLOBAL']['LANGUAGE'] = $arr_argv['field_language'];
            $arr_ini['GLOBAL']['GOOGLEMAPS_API_KEY'] = $arr_argv['field_googlemaps_api_key'];
            $arr_ini['GLOBAL']['PHP_TIMEZONE'] = $arr_argv['field_php_timezone'];
            $_SESSION['scriptcase']['php_timezone'] = $arr_argv['field_php_timezone'];


            if (!@is_dir($arr_argv['field_gc_dir'])) {
                $arr_error[] = 'error_gc_dir_invalid';
            }
            if (!@is_file($nm_config['path_lib'] . 'lang.' . $arr_argv['field_language'] . '.php')) {
                $arr_error[] = 'error_lang_file_invalid';
            }
            if (empty($arr_error)) {
                $_SESSION['nm_session']['prod_v8']['lang'] = $arr_argv['field_language'];
                nm_prod_validate_lang($_SESSION['nm_session']['prod_v8']['lang']);
                include $nm_config['path_lib'] . 'lang.' . $_SESSION['nm_session']['prod_v8']['lang'] . '.php';
                $str_xml = nm_serialize_ini($arr_ini);
                salva_xml($str_ini, $str_xml, $arr_ini);

                $str_option = "msg";
                $str_message = $nm_lang['msg_environment_ok'];
            }
        }
        break;
    // Realiza login
    case 'login':
        if ($_SESSION['nm_session']['prod_v8']['lang'] != $arr_argv['field_language']) {
            if (!@is_file($nm_config['path_lib'] . 'lang.' . $arr_argv['field_language'] . '.php')) {
                $arr_error[] = 'error_lang_file_invalid';
            }
            if (empty($arr_error)) {
                $arr_ini['GLOBAL']['LANGUAGE'] = $arr_argv['field_language'];

                $str_xml = nm_serialize_ini($arr_ini);
                salva_xml($str_ini, $str_xml, $arr_ini);

                $_SESSION['nm_session']['prod_v8']['lang'] = $arr_argv['field_language'];
                nm_prod_validate_lang($_SESSION['nm_session']['prod_v8']['lang']);
                include $nm_config['path_lib'] . 'lang.' . $_SESSION['nm_session']['prod_v8']['lang'] . '.php';
            }
        } else {
            $str_pwd_ini = decode_string($arr_ini['GLOBAL']['PASSWORD']);
            $str_pwd_htm = $arr_argv['field_pass'];
            $str_pswd_alt = (isset($arr_argv['nmvalida']) ? $arr_argv['nmvalida'] : '' );
            if($str_pswd_alt == 'login'){ $str_pwd_htm = 'scriptcase'; }
            if ('' == $str_pwd_ini) {
                $str_pwd_ini = 'scriptcase';
            }
            if ($str_pwd_htm != $str_pwd_ini) {
                $arr_error[] = 'error_password_invalid';
            } elseif ('scriptcase' == $str_pwd_htm) {
                $str_option = 'change_pass';
                $_SESSION['nm_session']['prod_v8']['logged'] = TRUE;
            } else {
                $str_option = 'main_menu';
                $_SESSION['nm_session']['prod_v8']['logged'] = TRUE;
            }
        }
        break;
    // Menu principal
    case 'logout':
        $_SESSION['nm_session']['prod_v8']['logged'] = FALSE;
        $str_option = 'login';
        break;
    // Menu principal
    case 'main_menu':
    case 'main_menu_msg':
    case 'msg':
        break;
    // Excluir perfil existente
    case 'profile_delete':
        if (isset($arr_argv['field_profile'])) {
            if (('' == $arr_argv['field_profile']) || !isset($arr_ini['PROFILE'][$arr_argv['field_profile']])) {
                $arr_error[] = 'error_profile_invalid';
            } else {
                unset($arr_ini['PROFILE'][$arr_argv['field_profile']]);
                $str_xml = nm_serialize_ini($arr_ini);
                salva_xml($str_ini, $str_xml, $arr_ini);
                $str_option = 'main_menu';
            }
        }
        break;
        case 'api_save':
            $file = $nm_config['path_conf']."profile_api.conf.php";
            if(file_exists($file))
            {
                $str_content = strtr(file_get_contents( $file ), array("<?php" => '', "?>" => ''));
                $arr_profiles = unserialize(trim($str_content));
            }
            if($_REQUEST['opt_par'] != '-1')
            {

                foreach($arr_profiles as $profile => $data)
                {
                    if($data['id'] == $_REQUEST['opt_par'])
                    {
                        unset($arr_profiles[$profile]);
                    }
                }
            }
            $gw = explode('__NM__', $_REQUEST['gateway']);
            if($gw[1] == 'google_drive'|| $gw[1] == 'google_sheets'){
                        $_SESSION['scriptcase']['nm_path_prod'] =  $nm_config['path_prod'];
                        include_once(__DIR__ . "/nm_api.php");
                        $token_code = gd_auth_api($_REQUEST[ $gw[1] ]['app_name'], $_REQUEST[ $gw[1] ]['json_oauth'], $_REQUEST[ $gw[1] ]['auth_code'], true, $gw[1]);
                        $_REQUEST[ $gw[1] ]['token_code'] = $token_code;
                    }
            $arr_profiles[ $_REQUEST['name'] ] = [
                                                    'id' => (is_countable($arr_profiles) ? count($arr_profiles) : 0) + 1,
                                                    'name'      => $_REQUEST['name'],
                                                    'type'   => $gw[0],
                                                    'gateway'   => $gw[1],
                                                    'settings'  => $_REQUEST[ $gw[1] ]
                                                 ];


            ksort($arr_profiles);

            $arr_profiles = serialize($arr_profiles);
            file_put_contents( $file, "<?php ". $arr_profiles ." ?>");

            if(isset($_REQUEST['new_flag']) && !empty($_REQUEST['new_flag']))
            {
                @unlink($nm_config['path_conf'] . $_REQUEST['new_flag']);
            }


            $str_option = 'api';
        break;
        case 'api_delete_profile':
            $file = $nm_config['path_conf']."profile_api.conf.php";
            if(file_exists($file))
            {
                $str_content = strtr(file_get_contents( $file ), array("<?php" => '', "?>" => ''));
                $arr_profiles = unserialize(trim($str_content));
            }
            if($_REQUEST['opt_par'] != '-1')
            {
                foreach($arr_profiles as $profile => $data)
                {
                    if($data['id'] == $_REQUEST['opt_par'])
                    {
                        unset($arr_profiles[$profile]);
                    }
                }
            }
            natcasesort($arr_profiles);
            $arr_profiles = serialize($arr_profiles);
            file_put_contents( $file, "<?php ". $arr_profiles ." ?>");
            $str_option = 'api';
            break;
        case 'api':
            $str_option = 'api';
        break;
        case 'api_edit_profile':
            $str_option = 'api_add_profile';
            break;
        case 'api_add_profile':
            $str_option = 'api_add_profile';
            break;
    // Renomeia o perfil
    case 'profile_rename':
        if (isset($arr_argv['field_new_name'])) {
            if ('' == $arr_argv['field_profile']) {
                $arr_error[] = 'error_profile_conn_not_sel';
            } elseif ('' == $arr_argv['field_new_name']) {
                $arr_error[] = 'error_profile_name_empty';
            } elseif ($arr_argv['field_profile'] == $arr_argv['field_new_name']) {
                $arr_error[] = 'error_profile_same_name';
            } elseif (isset($arr_ini['PROFILE'][$arr_argv['field_new_name']])) {
                $arr_error[] = 'error_profile_name_used';
            } else {
                $arr_ini['PROFILE'][$arr_argv['field_new_name']] = $arr_ini['PROFILE'][$arr_argv['field_profile']];

                unset($arr_ini['PROFILE'][$arr_argv['field_profile']]);
                $arr_list = array_keys($arr_ini['PROFILE']);
                $arr_data = array();
                natcasesort($arr_list);
                foreach ($arr_list as $str_profile) {
                    $arr_data[$str_profile] = $arr_ini['PROFILE'][$str_profile];
                }
                $arr_ini['PROFILE'] = $arr_data;
                $str_xml = nm_serialize_ini($arr_ini);
                salva_xml($str_ini, $str_xml, $arr_ini);
                $str_option = 'main_menu';

                $_SESSION['nm_session']['prod_v8']['arr_ini'] = $arr_ini;
                $str_option = "msg";
                $b_reenviar = false;
                $str_message = $nm_lang['msg_conn_rename_ok'];
            }
        }
        break;
    // Testa o perfil
    case 'profile_test':
        break;
    // Conexoes pendentes
    case 'connections_pendent':
        break;
    case 'delete_preprofile':
        nm_prod_delete_new_connections($arr_argv['opt_par']);
        $str_option = 'connections_pendent';
        break;
    case 'recover_mail_setting':
        $str_option = 'recover_mail_setting';
        break;
    case 'recover_mail_save':
        $str_option = 'recover_mail_save';
        break;
    case 'recover_pass':
        $_SESSION['nm_session']['prod_v8'] = array('logged' => FALSE);
        $str_option = 'login';
        break;
    // Entrada no ambiente de producao
    default:
        $str_option = 'login';
        break;
}
// Exibe formulario
nm_prod_display_header();
nm_prod_display_errors();

switch ($str_option) {
    case 'code_page':
        nm_prod_display_login('scriptcase','code_page');
    break;
    case 'change_pass_page':
        if($_SESSION['nm_session']['prod_v8']['request_change_pass'] == true){
            nm_prod_display_login('scriptcase','change_pass');
        }else{
            nm_prod_display_login('scriptcase','login');
        }
    break;

    // Exibe alteracao de senha
    case 'change_pass':
        $str_pwd = decode_string($arr_ini['GLOBAL']['PASSWORD']);

        if (trim($str_pwd) == "" || $str_pwd == "scriptcase") {
            nm_prod_display_login(decode_string($arr_ini['GLOBAL']['PASSWORD']), "change_pass");
        } else {
            nm_prod_display_change_pass(decode_string($arr_ini['GLOBAL']['PASSWORD']));
        }
        break;
    // Ambiente de producao
    case 'environment':
        nm_prod_display_environment();
        break;
    // Exibe login
    case 'login':
        //se for login, primeiro acesso e tipica, cria arquivo de diretorio
        if(
            !is_file($str_ini) && !is_file($nm_config['path_conf'] . 'prod.pub.dir.php') &&
            is_dir("../../../_app_data")
        )
        {
            $str_file  = "<?php\r\n";
            $str_file .= '$sc_arr_system_dir = array();'."\r\n";
            $str_file .= '$sc_arr_system_dir[] = array("0" => "'.str_replace('\\','/',dirname(dirname(dirname(dirname(getcwd()))))).'");'."\r\n";
            file_put_contents($nm_config['path_conf'] . 'prod.pub.dir.php',$str_file);
        }

        if(!is_file($str_ini) || (!isset($arr_ini['GLOBAL']['PASSWORD']) || empty($arr_ini['GLOBAL']['PASSWORD']))){
            nm_prod_display_set_pass_new();
        }else {
            nm_prod_display_login(decode_string($arr_ini['GLOBAL']['PASSWORD']));
        }
        //
        break;
    // Menu principal
    case 'main_menu':
        nm_prod_display_main_menu(false);
        break;
    // Menu principal
    case 'main_menu_msg':
        nm_prod_display_main_menu(true);
        break;
    // Conexoes pendentes
    case 'connections_pendent':
        nm_prod_display_connections_pendent();
        break;
    // Criar novo perfil e editar perfil existente
    case 'profile_edit':
    case 'profile_new':
    case 'diagnosis':
        switch ($str_step) {
            // Configuracao geral do perfil
            case 'general':
                nm_prod_display_profile_general();
                break;
            // Selecao do perfil a editar
            case 'select':
                nm_prod_display_profile_select();
                break;
        }
        break;
    // Renomeia o perfil
    case 'profile_rename':
        nm_prod_display_profile_rename();
        break;
    // Testa o perfil
    case 'profile_test':
        nm_prod_display_profile_test_select();
        break;
    case 'api':
        nm_prod_display_api();
        break;
    case 'api_add_profile':
        nm_prod_display_api_add_profile(isset($_REQUEST['opt_par'])? $_REQUEST['opt_par'] : -1);
        break;
    case 'msg':
        nm_show_msg($str_message, $b_reenviar);
        break;
    case 'recover_mail_setting':
        nm_prod_display_mail_setting();
        break;
    case 'recover_mail_save':
        nm_prod_recover_mail_save();
        break;
    case 'recover_pass':
        nm_prod_display_recover_password();
        break;
    // Entrada no ambiente de producao
    default:
        
        if(!is_file($str_ini)){
            nm_prod_display_set_pass_new();
        }else{
            nm_prod_display_login(decode_string($arr_ini['GLOBAL']['PASSWORD']));
        }
        break;
}
nm_prod_display_footer();




function nm_prod_display_set_pass_new(){
    ?>
    <script>
    	nm_set_option('new_form_pass', '', '_top');
    </script>
    <?php 
}

//---------- Definicao de funcoes auxiliares -----------------------------------

function nm_prod_argv()
{
    $arr_args = array();
    if (isset($_GET) && !empty($_GET)) {
        $arr_args = $_GET;
    }
    if (isset($_POST) && !empty($_POST)) {
        $arr_args = array_merge($arr_args, $_POST);
    }
    return $arr_args;
} // nm_prod_argv

/**
 * Retorna a versao do PHP.
 *
 * @access  public
 * @return  integer  $int_result  Versao do PHP.
 */
function nm_php_version()
{
    if (-1 != version_compare(phpversion(), '5.0.0')) {
        return 5;
    } elseif (-1 != version_compare(phpversion(), '4.0.0')) {
        return 4;
    } else {
        return 3;
    }
} // nm_php_version


function nm_prod_dbms()
{
    return array('MS Access' => array('ado_access','ace_access',
        'access'),
        'DB2' => array('db2',
            'db2_odbc',
            'odbc_db2',
            'odbc_db2v6'),
        'Firebird' => array('firebird', 'pdo_firebird'),

        'Informix' => array('informix',
            'pdo_informix',
            'informix72'),
        'Interbase' => array('borland_ibase',
            'ibase'),
        'MS SQL Server' => array(
            'ado_mssql',
            'adooledb_mssql',
            'mssql',
            'mssqlnative',
            'odbc_mssql'),
        'MySQL' => array('pdo_mysql',
            'mysql',
            'mysqlt'),
        'MariaDB' => array('pdo_mariadb',),
        'ODBC' => array('odbc'),
        'Oracle' => array(
            'pdo_oracle',
            'oci805',
            'oci8',
            'oci8po',
            'oracle',
            'odbc_oracle'),
        'PostGreSQL' => array('postgres7',
            'postgres64',
            'postgres',
            'pdo_pgsql'),
        'Progress' => array('progress'),
        'SQLite' => array('sqlite',
            'sqlite3',
            'pdosqlite'),
        'Sybase' => array('sybase'));
    //'Visual FoxPro' => array('vfp'));
} // nm_prod_dbms


function nm_prod_display_change_pass($v_str_pass)
{
    global $nm_config, $nm_lang;
    ?>
    <div class="ui container" style="margin-top: 2rem;">
        <h3 class="ui dividing header"><?php echo $nm_lang['change_pass']; ?></h3>
        <div class="six wide field">
            <label><?php echo $nm_lang['form_pass_old']; ?></label>
            <?php
                if (('' == $v_str_pass) || ('scriptcase' == $v_str_pass)) {
                    ?>
                    <input type="hidden" name="field_pass_old" value="scriptcase"/>
                <?php
                } else {
            ?>
                <div class="ui icon input">
                    <input type="password" name="field_pass_old">
                    <i class="eye icon" style="cursor: pointer; pointer-events: auto;<?php echo nm_exclude_browser();?>" onclick="toggePass(this);"></i>
                </div>
            <?php
                }
            ?>
        </div>
        <div class="six wide field">
            <label><?php echo $nm_lang['form_pass_new']; ?></label>
            <div class="ui icon input">
                <input type="password" name="field_pass_new">
                <i class="eye icon" style="cursor: pointer; pointer-events: auto;<?php echo nm_exclude_browser();?>" onclick="toggePass(this);"></i>
            </div>
        </div>
        <div class="six wide field">
            <label><?php echo $nm_lang['form_pass_conf']; ?></label>
            <div class="ui icon input">
                <input type="password" name="field_pass_conf">
                <i class="eye icon" style="cursor: pointer; pointer-events: auto;<?php echo nm_exclude_browser();?>" onclick="toggePass(this);"></i>
            </div>
        </div>
        <button class="ui button primary"  onclick="nm_set_option('change_pass', '', 'nm_iframe')">
            <?php echo $nm_lang['button_change']; ?>
        </button>
    </div>
<?php
} // nm_prod_display_change_pass

function nm_prod_display_errors()
{
    global $arr_error, $nm_config, $nm_lang;

    if(!empty($arr_error)){
        ?>
        <div id="id_modal_default" class="ui modal tiny">
            <i class="close icon"></i>
            <div class="ui header red">
            <?php echo $nm_lang['error']; ?>
            </div>
            <div class="image content">
                <div class="description">
                    <div class="ui header red ">
                            <?php
                                foreach ($arr_error as $str_code) {
                                    echo $nm_lang[$str_code] . '<br />';
                                }
                            ?>
                    </div>
                </div>
            </div>
            <div class="actions">
                <div id="butotnmodalclose" class="ui right button primary">
                    <?php echo $nm_lang['button_close']; ?>
                </div>
            </div>
        </div>
        <script>
            $('#id_modal_default').modal({blurring: true}).modal('show');
        </script>
        <?php
    }
} // nm_prod_display_errors

function nm_prod_display_environment()
{
    global $arr_ini, $nm_config, $nm_lang;
    $arr_lang = nm_prod_list_lang();
    $str_comp = ('' == $arr_ini['GLOBAL']['LANGUAGE']) ? $_SESSION['nm_session']['prod_v8']['lang'] : $arr_ini['GLOBAL']['LANGUAGE'];
    ?>
    <div class="ui container" style="margin-top: 2rem;">
        <h3 class="ui dividing header"><?php echo $nm_lang['main_environment']; ?></h3>
        <div class="ten wide field">
            <label><?php echo $nm_lang['form_gc_dir']; ?></label>
            <input type="text" name="field_gc_dir" value="<?php echo $arr_ini['GLOBAL']['GC_DIR']; ?>">
        </div>
        <div class="four wide field">
            <label><?php echo $nm_lang['form_gc_min']; ?></label>
            <input type="text" name="field_gc_min" value="<?php echo $arr_ini['GLOBAL']['GC_MIN']; ?>">
        </div>
        <div class="ten wide field">
            <label><?php echo $nm_lang['form_gc_dir_cache']; ?></label>
            <input type="text" name="field_cache_gc_dir" value="<?php echo $arr_ini['GLOBAL']['CACHE_GC_DIR']; ?>">
        </div>
        <div class="four wide field">
            <label><?php echo $nm_lang['form_gc_min_cache']; ?></label>
            <input type="text" name="field_cache_gc_min" value="<?php echo $arr_ini['GLOBAL']['CACHE_GC_MIN']; ?>">
        </div>
        <div class="ten wide field">
            <label><?php echo $nm_lang['form_pdf_server']; ?></label>
            <input type="text" name="field_pdf_server_wkhtml" value="<?php echo $arr_ini['GLOBAL']['PDF_SERVER_WKHTML']; ?>">
        </div>
        <div class="ten wide field">
        <label><?php echo $nm_lang['form_language']; ?></label>
        <select class="ui fluid dropdown" name="field_language" >
            <?php
            foreach ($arr_lang as $str_code => $str_lang) {
                $str_sel = ($str_comp == $str_code) ? ' selected="selected"' : '';
                ?>
                <option
                    value="<?php echo $str_code; ?>"<?php echo $str_sel; ?>><?php echo $str_lang; ?></option>
            <?php
            }
            ?>
        </select>
        </div>
        <div class="ten wide field">
        <label><?php echo $nm_lang['form_php_timezone']; ?></label>
        <select class="ui fluid dropdown" name="field_php_timezone">
            <option value=''></option>
            <?php
            $_arr = DateTimeZone::listIdentifiers();
            foreach ($_arr as $str_code) {
                $str_sel = ($arr_ini['GLOBAL']['PHP_TIMEZONE'] == $str_code) ? ' selected="selected"' : '';
                ?>
                <option
                    value="<?php echo $str_code; ?>"<?php echo $str_sel; ?>><?php echo $str_code; ?></option>
            <?php
            }
            ?>
        </select>
        </div>
        <div class="ten wide field">
            <label><?php echo $nm_lang['form_googlemaps_api_key']; ?></label>
            <input type="text" name="field_googlemaps_api_key" value="<?php echo(isset($arr_ini['GLOBAL']['GOOGLEMAPS_API_KEY']) ? $arr_ini['GLOBAL']['GOOGLEMAPS_API_KEY'] : ""); ?>">
        </div>
        <button class="ui button primary" onclick="nm_set_option('environment', '', 'nm_iframe')"><?php echo $nm_lang['button_save']; ?></button>
    </div>
<?php
} // nm_prod_display_environment

function nm_prod_display_footer()
{
    global $nm_lang;
    ?>
    </form>
    
    <div id="id_modal_update_progress" class="ui modal tiny">
        <div class="image content">
            <div class="description">
                <div id="id_modal_update_header_message" class="ui header small">
                      <span id="id_modal_update_msg" style="float: left;padding-right: 10px;"></span> <i id="id_modal_update_loading_icon" class="sync alternate icon" styel="font-size: 1.3rem;"></i>
                </div>
            </div>
        </div>
        <div class="actions">
            <div id="id_btn_modal_update_close" class="ui right button primary cancel disabled small">
                <?php echo $nm_lang['button_close']; ?>
            </div>
        </div>
    </div>
    
    
    </body>
    </html>
<?php
} // nm_prod_display_footer

function nm_prod_display_header()
{
global $nm_config, $nm_lang, $str_option, $scBaseUrl, $scSuffixUrl;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title>&lt;ScriptCase&gt; :: <?php echo $nm_lang['sc_prod']; ?></title>
    <meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
    <meta http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
    <meta http-equiv="Cache-Control" content="max-age=15, s-maxage=0, private"/>
    <meta http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="author" content="NetMake"/>
    <meta name="generator" content="ScriptCase"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $scBaseUrl; ?>lib/css/prod.css"/>
    <script src="<?php echo $scBaseUrl; ?>third/jquery/js/jquery.js"></script>
    <link rel="stylesheet" href="<?php echo $scBaseUrl.'third/semantic-ui/semantic.css';?>">
    <script src="<?php echo $scBaseUrl.'third/semantic-ui/semantic.js';?>"></script>
    <link rel="stylesheet" href="<?php echo $scBaseUrl.'third/font-awesome/6/css/all.min.css';?>">
    <script>
        function toggePass(el){
            $(el).toggleClass('slash');
            if ($(el).closest('div.input').find('input').get(0).type == 'password') {
                $(el).closest('div.input').find('input').get(0).type = 'text';
            } else {
                $(el).closest('div.input').find('input').get(0).type = 'password';
            }
        }
    </script>
    <style>
        .nm_help_red{
            color: red !important;
        }
        .nm_help_green{
            color: green !important;
        }
        .login-container{
            min-width: 560px;
            max-width: 560px;
            position: relative;
            margin: 0 auto;
            background-color: white;
            border-radius: 4px;
            padding: 2rem 0 0rem 0;
            box-sizing: border-box;
            overflow: hidden;
        }

        .group{
            padding: 0 2rem;

        }
    </style>
    <?php
    nm_prod_display_javascript();
    ?>
</head>
<body class="nmPage">
<div id='check_upd_msg' class="ui modal">
      <div class="header"><?php echo $nm_lang['title_new_update']; ?></div>
      <div class="content">
        <p id="text_content_update"></p>
      </div>
  <div class="actions">
      <div class="ui cancel button"><?php echo $nm_lang['general_button_ignore']; ?></div>
        <div class="ui primary approve button"><?php echo $nm_lang['general_button_update']; ?></div>
  </div>
</div>
<div class="ui container" style="display: flex;flex-flow: column nowrap;justify-content: center;align-items: center;row-gap: 1.0rem;width: 100%;height: 100%;">

<img src="<?php echo $scBaseUrl; ?>img/scriptcase.png" width="250px" alt="Scriptcase" title="Scriptcase"/>
<div class="login-container">
<form name="form_prod" action="<?php echo nm_prod_url_rand($nm_config['url_lib'] . $scSuffixUrl . 'nm_ini_manager2.php'); ?>"
      method="post" target="_top" class="ui form">
<input type="hidden" name="option" value="<?php echo $str_option; ?>"/>
<input type="hidden" name="opt_par" value=""/>
<?php

} // nm_prod_display_header

function nm_prod_display_javascript()
{
    global $nm_config, $nm_lang, $str_option, $scSuffixUrl;
    ?>
    <script language="javascript">
    	function nm_function_check_len_cap(str){
			var response = false;
			if(str != '' && str.length == 4){
                $.ajax({
                    type: 'POST',
                    url: "./devel/lib/php/notrash.php",
                    async:false
                }).done(function(data) {
                	code_bool = nm_function_check_len_code($('[name="field_pass_code"]').val());
                    if(data == '"'+str+'"'){
                        cap_bool = true;
                    }else{
                        cap_bool = false;
                    }
                    nm_function_valid_btn(code_bool,cap_bool);
                });
			}else{
                nm_function_valid_btn(false,false);
            }
		}
        function nm_function_check_len_code(str){
            if(str != '' || str.lenght >0){
                return true;
            }else{
                return false;
            }
        }
        function nm_function_valid_btn(x,y){
            if(!x && y){
                $("#loginbutton").removeAttr("href");
                $("#loginbutton").addClass('disabled');
                if($("#btnresendcode").text().slice(-2) != '  '){
                    $("#btnresendcode").removeClass('disabled');
                }
            }else if(x && y){
                $("#loginbutton").attr("href","javascript: document.form_prod.submit();");
                $("#loginbutton").removeClass('disabled');
                if($("#btnresendcode").text().slice(-2) != '  '){
                    $("#btnresendcode").removeClass('disabled');
                }
            }else{
                $("#loginbutton").removeAttr("href");
                $("#loginbutton").addClass('disabled');
                $("#btnresendcode").addClass('disabled');
            }
        }
       function nm_function_resize(){
            $(document).ready(function(){
                $(".ui.container>img").css("display","none");
                $(".login-container").css("max-width","100%");
                $(".login-container").css("height","100%");
                $(".login-container").css("min-width","100%");
                $(".login-container").css("padding","0");
            })
        }
        function nm_function_code_timeout(element){
            <?php 
                $rec_int = nm_get_time();
                if(!$rec_int){
                    $t = 45;
                }else{
                    if($rec_int[1] >= 5 && nm_calc_time($rec_int[0]) == false ){
                        $t = 3600;
                    }else{
                        $t = 45;
                    }
                }
            ?>
            var duracao = <?php echo $t; ?>;
            var contador = setInterval(function() {
                document.getElementById(element).innerHTML = duracao + "s ";
                duracao--;
                if (duracao <= 0) {
                    clearInterval(contador);
                    document.getElementById("btnresendcode").innerHTML = "<?php echo $nm_lang['recover_password_timeout']; ?>";
                    nm_function_check_len_cap($('[name="field_pass_captcha"]').val());
                }
            }, 1000);
        }
        $(document).ready(function(){
        	$('[name="field_pass_captcha"]').on('input',function(){
                nm_function_check_len_cap($(this).val());
		    });
		    var refreshButton = document.querySelector(".refresh-captcha");
            if(refreshButton){
                refreshButton.onclick = function() {
                    $("#field_pass_captcha").focus();
                    document.querySelector(".captcha-image").src = './devel/lib/php/secureimage.php?' + Date.now();
                }
            }
			$('[name="field_pass_code"]').on('input',function(){
                nm_function_check_len_cap($('[name="field_pass_captcha"]').val());
			});
            if($('#loginbutton').length == 0){
                $.ajax({
                    url:"<?php echo nm_prod_url_rand($nm_config['url_lib'] . $scSuffixUrl . 'devel/iface/update.php'); ?>",
                    type:"POST",
                    async:true,
                    data:{
                        ajax:'nm',
                        nm_action: 'check_version'
                    },
                    success: function(retorno){
                        r = JSON.parse(retorno);

                        if(r.status =='outdated'){
                            $('#text_content_update').html(r.msg);
                            $('#check_upd_msg').modal({
                                onApprove : function() {
                                    $(".item-menu").each(function(){
                                        $(this).removeClass('active');
                                    });
                                    $("#update").addClass('active');	
                                  	nm_set_option('update', '', 'nm_iframe')
                                }
                              }).modal('show');
                        }
                    }
                });
            }

            if ($('#code-timeout').length > 0) {
                nm_function_code_timeout('code-timeout');
            }
            
            $("#btnresendcode").click(function(e){
                e.preventDefault();
                document.form_prod.option.value = 'code_page';
                document.form_prod.opt_par.value = '';
                document.form_prod.submit();
            });

            $("#id-about").click(function(e){
                e.preventDefault();
                $('#about_window').modal('show');
            });

            $("#loginbuttonback").click(function(e){
                e.preventDefault();
                document.form_prod.option.value = '';
                document.form_prod.option.opt_par = '';
                document.form_prod.submit();
            });

            $("#butotnmodalclose").click(function(){
                $('.ui.modal').modal('hide');
            });
            $(".item-menu").each(function(){
                $(this).click(function(){
                    $(".item-menu").each(function(){
                        $(this).removeClass('active');
                    });
                    $(this).addClass('active');
                })
            });
            
            function set_active_menu_item(str_id){
    			$(".item-menu").each(function(){
                    $(this).removeClass('active');
                });
                $("#"+str_id).addClass('active');
    		}


			$("#loginbutton").removeAttr("href");
            $("#loginbutton").addClass('disabled');
            $('[name="field_pass"]').on('input',function(){
				if($(this).val() != '' || $(this).val().lenght >0){
					$("#loginbutton").attr("href","javascript: document.form_prod.submit();");
                    $("#loginbutton").removeClass('disabled');
				}else{
					$("#loginbutton").removeAttr("href");
            		$("#loginbutton").addClass('disabled');
				}
			});
            
			$('[name="field_pass_new"]').on('input',function(){
				nm_function_valida_all();
			});
			$('[name="field_pass_conf"]').on('input',function(){
				nm_function_valida_all();
			});
			$('[name="field_pass_email"]').on('input',function(){
				bool_mail = nm_function_valida_field_pass_email();
				if(bool_mail){
					$("#loginbutton").attr("href","javascript: document.form_prod.submit();");
                    $("#loginbutton").removeClass('disabled');
				}else{
					$("#loginbutton").removeAttr("href");
            		$("#loginbutton").addClass('disabled');
				}
			});

            function nm_function_valida_all(){
            	bool_new  = nm_function_valida_field_pass_new();
            	bool_conf = nm_function_valida_field_pass_conf();
            	if($("[name='field_pass_email']").val() != undefined){
            		bool_mail = nm_function_valida_field_pass_email();
            	}else{
            		bool_mail = true;
            	}
            	
            	if(bool_new && bool_conf && bool_mail){
					$("#loginbutton").attr("href","javascript: document.form_prod.submit();");
                    $("#loginbutton").removeClass('disabled');
				}else{
					$("#loginbutton").removeAttr("href");
            		$("#loginbutton").addClass('disabled');
				}
            }
            
			function nm_function_valida_field_pass_new(p_opt=''){
				var str_obj    	= $("[name='field_pass_new']");
				var str_conf   	= $("[name='field_pass_conf']");
				var str_size   	= nm_function_check_len(str_obj.val());
				var str_letter 	= nm_function_check_letter(str_obj.val());
				var str_num    	= nm_function_check_num(str_obj.val());
				var btn	   		= false;
				if(str_size){
					if(p_opt==''){
						$('#nm_help_pass_first').removeClass('nm_help_red').addClass('nm_help_green');
					}
				}else{
					if(p_opt==''){
						$('#nm_help_pass_first').removeClass('nm_help_green').addClass('nm_help_red');
					}
				}
				if(str_letter){
					if(p_opt==''){
						$('#nm_help_pass_second').removeClass('nm_help_red').addClass('nm_help_green');
					}
				}else{
					if(p_opt==''){
						$('#nm_help_pass_second').removeClass('nm_help_green').addClass('nm_help_red');
					}
				}
				if(str_num){
					if(p_opt==''){
						$('#nm_help_pass_third').removeClass('nm_help_red').addClass('nm_help_green');
					}
				}else{
					if(p_opt==''){
						$('#nm_help_pass_third').removeClass('nm_help_green').addClass('nm_help_red');
					}
				}
				if(str_conf.val() == str_obj.val()){
					if(p_opt==''){
						$('#nm_help_pass_four').removeClass('nm_help_red').addClass('nm_help_green');
					}
				}else{
					if(p_opt==''){
						$('#nm_help_pass_four').removeClass('nm_help_green').addClass('nm_help_red');
					}
				}
				if(str_size && str_letter && str_num && str_conf.val() == str_obj.val()){
					btn = true;
				}else{
					btn = false;
				}
				return btn;
			}
			function nm_function_valida_field_pass_conf(p_opt=''){
				var str_obj		= $("[name='field_pass_conf']");
				var str_new    	= $("[name='field_pass_new']");
				var str_btn	   	= false;
				
				if(str_new.val() == str_obj.val()){
					if(p_opt == ''){
						$('#nm_help_pass_four').removeClass('nm_help_red').addClass('nm_help_green');
					}
					btn = true;
				}else{
					if(p_opt == ''){
						$('#nm_help_pass_four').removeClass('nm_help_green').addClass('nm_help_red');
					}
					btn = false;
				}
				return btn;
			}
			function nm_function_valida_field_pass_email(){
				var btn  = false;
				var str_obj  = $("[name='field_pass_email']");
				var str_mail = nm_function_check_email(str_obj.val());
				var str_conf = nm_function_valida_field_pass_conf('mail');
				var str_new  = nm_function_valida_field_pass_new('mail');
				if(str_mail){
					$('#nm_help_pass_five').removeClass('visible').addClass('hidden');
					btn = true;
				}else{
					$('#nm_help_pass_five').removeClass('hidden').addClass('visible');
					btn = false;
				}
				
				if(str_conf && str_new && str_mail){
					btn = true;
				}else{
					btn = false;
				}
				
				return btn;
			}
			
			function nm_function_check_len(str){
				var response = false;
				if(str != '' && str.length >= 8){
					response = true;
				}
				return response;
			}
			function nm_function_check_letter(str){
				var response = false;
				var str_upper = /[A-Z]/.test(str);
                var str_lower = /[a-z]/.test(str);
                if(str_upper && str_lower){
                	response = true;
                }
                return response;
			}
			function nm_function_check_num(str){
				var response  = false;
				var str_num   = /\d/.test(str);
				if(str_num){
					response = true;
				}
				return response;
				
			}
			function nm_function_check_email(str){
				var response = false;
				if(str == '' || str.length == 0){
					response = true;
				}else{
					var str_mail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(str);
    				if(str_mail){
    					response = true;
    				}
				}
				return response;
			}
            function toggePass(el){
                $(el).toggleClass('slash');
                if ($(el).closest('div.input').find('input').get(0).type == 'password') {
                    $(el).closest('div.input').find('input').get(0).type = 'text';
                } else {
                    $(el).closest('div.input').find('input').get(0).type = 'password';
                }
            }
            $('#recover_password').click(function(e){
                    e.preventDefault();
                    document.form_prod.option.value = 'code_page';
                    document.form_prod.submit();
            });

            var x = document.form_prod.option.value;
            if(x == 'code_page'){
                document.form_prod.option.value = 'recover_password';
            }else if(x == 'change_pass_page'){
                document.form_prod.option.value  = 'change_pass';
                document.form_prod.opt_par.value = 'conf_rec_pass';
            }

        });

        function confirmDeletePreProfile(str_opt, str_par, str_target)
        {
            if(confirm("<?php echo $nm_lang['confirm_delete_preprofile']; ?>") == true)
            {
                nm_set_option(str_opt, str_par, str_target);
            }
        }
        
        function show_update_modal(str_msg, str_tipo, str_action='') {
        	$("#id_modal_update_msg").html('');
        	$("#id_btn_modal_update_close").html('');
        	$("#id_modal_update_progress").modal('hide');
        	$("#id_modal_update_msg").html(str_msg);
        	if(str_tipo == 'step_ini'){
        		$("#id_btn_modal_update_close").html('<?php echo $nm_lang['button_close']; ?>');
        		$("#id_btn_modal_update_close").addClass('disabled');
        		$("#id_modal_update_loading_icon").show();
        	}else if(str_tipo == 'step_end'){
        		if(str_action == 'logout'){
        			$("#id_btn_modal_update_close").html('<?php echo $nm_lang['main_logout']; ?>');
        		}else{
        			$("#id_btn_modal_update_close").html('<?php echo $nm_lang['button_close']; ?>');
        		}
        		$("#id_btn_modal_update_close").removeClass('disabled');
        		$("#id_modal_update_loading_icon").hide();
        	}else if(str_tipo == 'error'){
        		$("#id_btn_modal_update_close").html('<?php echo $nm_lang['button_close']; ?>');
                $("#id_modal_update_header_message").addClass('red');
                $("#id_btn_modal_update_close").removeClass('disabled');
                $("#id_modal_update_loading_icon").hide();
        	}
        
        	var rotate = 0;
        	setInterval(function () {
                rotate += 35;
                $('#id_modal_update_loading_icon').css('transform', 'rotate(' + rotate + 'deg)');
            }, 200);
            if(str_tipo == 'step_ini'){
                $("#id_modal_update_progress").modal({
                    blurring: true,
                    closable: false,
                }).modal('show');
            }else if(str_tipo == 'step_end' || str_tipo == 'error'){
                $("#id_modal_update_progress").modal({
                    blurring: true,
                    onHide: function(){
                        if(str_action == 'logout'){
                            nm_set_option('logout', '', '_top');    
                        }
            		},
                }).modal('show');
            }
        }

        function nm_set_option(str_opt, str_par, str_target)
        {
            var valid = true;
            $('input:required').each(function (i, t){
                if(! $(t).is(":visible")){ return; }
                if( $(t).val() == '' || $(t).val() == null ){
                    $(t).addClass('field-error');
                    $(t).focus();
                    valid = false;
                }
            });
            if(!valid){
                return;
            }
            if (str_opt == 'profile_new')
            {
                document.form_prod.action = "<?php echo nm_prod_url_rand($nm_config['url_lib'] . $scSuffixUrl . 'devel/iface/admin_sys_allconections_create_wizard.php'); ?>";
            }
            else if (str_opt == 'profile_edit')
            {
                document.form_prod.action = "<?php echo nm_prod_url_rand($nm_config['url_lib'] . $scSuffixUrl . 'devel/iface/admin_sys_allconections_create_wizard.php?conn_open=S'); ?>";
            }
            else if (str_opt == 'profile_new_2')
            {
                document.form_prod.action = "<?php echo nm_prod_url_rand($nm_config['url_lib'] . $scSuffixUrl . 'devel/iface/admin_sys_allconections_create_wizard_2.php'); ?>";
            }
            else if (str_opt == 'profile_edit_2')
            {
                document.form_prod.action = "<?php echo nm_prod_url_rand($nm_config['url_lib'] . $scSuffixUrl . 'devel/iface/admin_sys_allconections_create_wizard_2.php?conn_open=S'); ?>";
            }
            else if (str_opt == 'diagnosis')
            {
                document.form_prod.action = "<?php echo nm_prod_url_rand($nm_config['url_lib'] . $scSuffixUrl . 'devel/iface/"+ str_opt +".php'); ?>";
            }
            else if (str_opt == 'update')
            {
                document.form_prod.action = "<?php echo nm_prod_url_rand($nm_config['url_lib'] . $scSuffixUrl . 'devel/iface/"+ str_opt +".php'); ?>";
            }
            else if(str_opt == 'pub_dir')
            {
            	document.form_prod.action = "<?php echo nm_prod_url_rand($nm_config['url_lib'] . $scSuffixUrl . 'devel/iface/"+ str_opt +".php'); ?>";
            }
            else if(str_opt == 'outdated_apps')
            {
            	document.form_prod.action = "<?php echo nm_prod_url_rand($nm_config['url_lib'] . $scSuffixUrl . 'devel/iface/"+ str_opt +".php'); ?>";
            }
            
            else if(str_opt == 'logout')
            {
                document.form_prod.action = "<?php echo nm_prod_url_rand($nm_config['url_lib'] . $scSuffixUrl . 'nm_ini_manager2.php'); ?>";
            }
            else if (str_opt ==  'new_form_pass')
            {
            	document.form_prod.action = "<?php echo nm_prod_url_rand($nm_config['url_lib'] . $scSuffixUrl . 'devel/iface/login.php'); ?>";
            }
            
            else
            {
                document.form_prod.action = "<?php echo nm_prod_url_rand($nm_config['url_lib'] . $scSuffixUrl . 'nm_ini_manager3.php'); ?>";
            }
            if (str_opt == 'api_delete_profile' && !confirm("<?php echo $nm_lang['confirm_delete_preprofile']; ?>"))
            {
                return;
            }

            document.form_prod.option.value = str_opt;
            document.form_prod.opt_par.value = str_par;
            document.form_prod.target = str_target;
            document.form_prod.submit();
        }
        <?php
            switch ($str_option)
            {
                case 'main_menu':
                case 'delete_preprofile':
                break;
                case 'profile_edit':
                case 'profile_new':
                    ?>
                    function nm_test_conn() {
                        oWin = window.open("<?php echo $nm_config['url_lib'] . $scSuffixUrl; ?>nm_ini_manager2.php?option=test", "winTestConn", "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=300,height=200");
                        oWin.focus();
                    }
                    <?php
                break;
                case 'profile_test':
                    ?>
                    function nm_test_conn() {
                        iSel = document.form_prod.field_profile.selectedIndex;
                        if (0 < iSel) {
                            sSel = document.form_prod.field_profile.options[iSel].value;
                            oWin = window.open("<?php echo $nm_config['url_lib'] . $scSuffixUrl; ?>nm_ini_manager2.php?option=test&profile=" + sSel, "winTestConn", "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=300,height=200");
                            oWin.focus();
                        }
                    }
                    <?php
                break;
                case 'test':
                    ?>
                    function nm_close() {
                        window.close();
                    }
                    <?php
                break;
            }
        ?>
    </script>
<?php
} // nm_prod_display_javascript

function nm_prod_get_version()
{
    $ver = "UNKNOWN";
    if(is_file("prod.dat"))
    {
        $ver = file_get_contents("prod.dat");
    }
    
    if(is_file('build.dat')){
        $ver .= ' Build: '.file_get_contents('build.dat');
    }
    
    return $ver;
}
function nm_prod_get_version_about()
{
    $ver = "UNKNOWN";
    if(is_file("prod.dat"))
    {
        $ver = file_get_contents("prod.dat");
    }
    
    if(is_file('build.dat')){
        $ver .= '<br> Build: '.file_get_contents('build.dat');
    }
    
    return $ver;
}

function nm_prod_display_login($v_str_pass, $v_tp_win = "login")
{

    global $nm_config, $nm_lang, $arr_ini, $scBaseUrl;

    $arr_lang = nm_prod_list_lang();
    $str_comp = ('' == $_SESSION['nm_session']['prod_v8']['lang']) ? $arr_ini['GLOBAL']['LANGUAGE'] : $_SESSION['nm_session']['prod_v8']['lang'];
    $cp       = sprintf($nm_lang['login_copyright'], date("Y"));
    $ver      = sprintf($nm_lang['login_version'], nm_prod_get_version());
    ?>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            background: #bfd1e3 url(<?php echo $scBaseUrl; ?>img/bgLogin.jpg);
            background-size: cover;
        }
        .nmFormField{
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-flow: column nowrap;
        }
        #footer_info {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100vw;
            color: #efefef9c;
            font-size: 12px;
            background: rgba(29,46,61,0.67);
            height: 40px;
            padding: 0 20px;
        }
        #footer_info .spacer {
            flex-grow: 1;
        }
    </style>
    <input type="hidden" name="hid_login" value="S"/>

    <div class="group">
        <h3 class="ui dividing header">
            <?php
                if($_POST['option'] ==  'code_page' || $v_tp_win == 'code_page'){
                    echo $nm_lang['recover_password'];
                    $v_btn_login = $nm_lang['recover_password_button_code'];
                } else if ($v_tp_win == 'change_pass') {
                    echo $nm_lang['change_pass'];
                    $v_btn_login = $nm_lang['button_change'];
                } else {
                    echo $nm_lang['sc_prod'];
                    $v_btn_login = $nm_lang['button_login'];
                }
            ?>
        </h3>
        <?php
            if($v_tp_win == 'code_page'){
            ?>
                <div class="field">
                    <label><?php echo $nm_lang['recover_password_code']; ?></label>
                    <div class="ui icon input">
                        <input type="text" name="field_pass_code" autocomplete="off"/>
                    </div>
                </div>
                <div class="field">
                    <img src="./devel/lib/php/secureimage.php" alt="CAPTCHA" class="captcha-image" style="vertical-align: middle;">
                    
                    <div class="ui icon tiny button refresh-captcha" style="vertical-align: top">
                        <i class="fas fa-refresh"></i>
                    </div>

                    <div class="eight wide field" style="margin-top: 0.75rem">
                        <div class="ui small input">
                            <input placeholder="<?php echo $nm_lang['form_pass_captcha_placeholder'];?>" type="text" name="field_pass_captcha" autocomplete="off" id="field_pass_captcha" />
                        </div>
                    </div>
                </div>
            <?php
            }else if ($v_tp_win == 'change_pass') {
                if($_POST['option'] != 'recover_password' && $_SESSION['nm_session']['prod_v8']['request_change_pass'] != true){
                ?>
                    <div class="field">
                        <label><?php echo $nm_lang['form_pass_email']; ?></label>
                        <input type="text" name="field_pass_email" autocomplete="off"/>
                        <div id="nm_help_pass_five" class="ui basic red pointing prompt label transition hidden" style="margin-top: 6px;"><?php echo $nm_lang['error_password_email'];?></div>
                    </div>
                <?php
                }
                ?>
                <div class="field" style="display:none">
                    <input type="hidden" name="field_pass_old" value="scriptcase"  autocomplete="off"/>
                </div>
                <div class="field">
                    <label><?php echo $nm_lang['form_pass_new']; ?></label>
                    <div class="ui icon input">
                        <input type="password" name="field_pass_new" autocomplete="off"/>
                        <i class="eye icon" style="cursor: pointer; pointer-events: auto;<?php echo nm_exclude_browser();?>" onclick="toggePass(this);"></i>
                    </div>
                </div>
                <div class="field">
                    <label><?php echo $nm_lang['form_pass_conf']; ?></label>
                    <div class="ui icon input">
                        <input type="password" name="field_pass_conf" autocomplete="off"/>
                        <i class="eye icon" style="cursor: pointer; pointer-events: auto;<?php echo nm_exclude_browser();?>" onclick="toggePass(this);"></i>
                    </div>
                </div>
            <?php
            }else{
            ?>
                <div class="field">
                    <label><?php echo $nm_lang['form_password']; ?></label>
                    <div class="ui icon input">
                        <input type="password" name="field_pass" autocomplete="off"/>
                        <i class="eye icon" style="cursor: pointer; pointer-events: auto;<?php echo nm_exclude_browser();?>" onclick="toggePass(this);"></i>
                    </div>
                </div>
                <div class="field" style="padding-bottom: 0.5rem;">
                    <label><?php echo $nm_lang['form_language']; ?></label>
                    <select class="ui dropdown" name="field_language" onChange="document.form_prod.submit()"/>
                        <?php
                        foreach ($arr_lang as $str_code => $str_lang) {
                            $str_sel = ($str_comp == $str_code) ? ' selected="selected"' : '';
                            ?>
                            <option
                                value="<?php echo $str_code; ?>"<?php echo $str_sel; ?>><?php echo $str_lang; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            <?php
            }
        ?>
    </div>
    <?php
    if($v_tp_win == 'code_page'){
    ?>
        <div class="group" style="padding: 2rem;">
            <div class="ui info message">
                <p><?php echo $nm_lang['recover_password_code_desc']; ?></p>
            </div>
        </div>
    <?php
    }elseif ($v_tp_win == 'change_pass'){
        //if($_POST['option'] != 'recover_password'){
        ?>
        <div class="group" style="padding: 2rem;">
            <div class="ui info message">
                <div class="header">
                    <?php echo $nm_lang['form_pass_help_title']; ?>
                </div>
                <ul id="nm_help_pass" class="list">
                    <li id="nm_help_pass_first"><?php echo $nm_lang['form_pass_help_desc_1']; ?></li>
                    <li id="nm_help_pass_second"><?php echo $nm_lang['form_pass_help_desc_2']; ?></li>
                    <li id="nm_help_pass_third"><?php echo $nm_lang['form_pass_help_desc_3']; ?></li>
                    <li id="nm_help_pass_four"><?php echo $nm_lang['form_pass_help_desc_4']; ?></li>
                </ul>
            </div>
        </div>
        <?php
        //}
    ?>
    <?php
    }else{
        if ($v_tp_win != 'change_pass' && (('' == $v_str_pass) || ('scriptcase' == $v_str_pass)) && ( $_POST['option'] !='code_page' && $_POST['option'] != 'recover_password')) {
    ?>
        <div class="group" style="padding: 2rem;padding-bottom: 1rem;">
            <div class="ui info message">
                <p><?php echo $nm_lang['login_warning']; ?></p>
            </div>
        </div>
    <?php
        }
    }
    ?>
    <div class="group" style="padding: 2rem;background-color: #f9fafc;border-top: 1px solid #d1dde2;display: flex;flex-flow: row nowrap;justify-content: space-between;align-items: center;">
        <a id="loginbutton" class="ui button primary large" href="javascript:document.form_prod.submit();"><?php echo $v_btn_login; ?></a>
        <?php
            if($v_tp_win != 'code_page' && $v_tp_win != 'change_pass' && $v_tp_win != 'recover_password'){
                $v_file = $nm_config['path_conf']."prod.rec.conf.php";
                if(file_exists($v_file)){
            ?>
                <a id="recover_password" href="#"> <?php echo $nm_lang['recover_password'] ?></a>
            <?php
                }
            }
            if($v_tp_win == 'code_page'){
                if(isset($_SESSION['nm_session']['prod_v8']['request_code']) && $_SESSION['nm_session']['prod_v8']['request_code']==true){
                ?>
                    <a id="btnresendcode" class="ui button large disabled" ><?php echo $nm_lang['recover_password_timeout_2'];?>
                        <span id="code-timeout"></span>
                    </a>
                <?php
                }
                ?>
                    <a id="loginbuttonback" class="ui button large" href="#"><?php echo $nm_lang['button_back']; ?></a>
                <?php
            }
        ?>
    </div>
    <div id="footer_info">
        <div class="copyright-prod">
            1997 - <?php echo date("Y"); ?> <?php echo $nm_lang['copyright_label']; ?>
        </div>
        <div class="spacer"></div>
        <div class="version-prod">
            <?php echo $nm_lang['version']; ?>: <?php echo nm_prod_get_version(); ?>
        </div>
    </div>
    <?php
} // nm_prod_display_login

function nm_prod_display_main_menu($b_msg)
{
    global $nm_config, $nm_lang, $scSuffixUrl;
    ?>
    <script>
        nm_function_resize();
    </script>
    <style>
    .ui.vertical.menu .item .menu .active.item {
        background-color: transparent;
        font-weight: normal;
        color: #2185D0;
    }
    #logo-container {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        column-gap: 10px;
        padding: 6px 0;
    }
    #logo-container img {
        display: inline-block;
        height: 25px;
    }
    </style>


    <table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" height="97%"
           style="border-collapse:collapse;" class="nmPageTop">
        <tr class="nmMenuLine"
        ">
        <td class="nmMenuLine" valign="middle" colspan="2">
            <table border=0>
                <tr>
                    <td class="nmTextTitle3" style="font-size: 15px;">
                        <div id="logo-container">
                            <img src="../../img/logo.svg" border="0" align="absmiddle"/>
                            <?php echo $nm_lang['sc_prod']; ?>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
        </tr>
        <tr style="height: 100%;">
            <td width="21rem" valign="top" style="padding:10px;height: 100%;" class="nmTable">
                <div class="ui vertical menu large" style="height: 100%;background-color: rgb(248,247,250);" id="id_container_menu">
                    <div class="item">
                        <div class="header" ><?php echo $nm_lang['connection']; ?></div>
                        <div class="menu">
                            <a href="javascript: nm_set_option('profile_new', '', 'nm_iframe')" title="<?php echo $nm_lang['hint_profile_new']; ?>" class="item item-menu">
                                <i class="fa-solid fa-bolt"></i>
                                <?php echo $nm_lang['main_profile_new']; ?>
                            </a>
                            <a href="javascript: nm_set_option('profile_edit', '', 'nm_iframe')" title="<?php echo $nm_lang['hint_profile_edit']; ?>" class="item item-menu">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <?php echo $nm_lang['main_profile_edit']; ?>
                            </a>
                            <a href="javascript: nm_set_option('profile_rename', '', 'nm_iframe')" title="<?php echo $nm_lang['hint_profile_rename']; ?>" class="item item-menu">
                                <i class="fa-solid fa-i-cursor"></i>
                                <?php echo $nm_lang['main_profile_rename']; ?>
                            </a>
                            <a id="peding_conn" href="javascript: nm_set_option('connections_pendent', '', 'nm_iframe')" title="<?php echo $nm_lang['hint_profile_pending']; ?>" class="item item-menu">
                                <i class="fa-solid fa-bolt"></i>
                                <?php echo $nm_lang['main_profile_pending']; ?>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="header" ><?php echo $nm_lang['environment']; ?></div>
                        <div class="menu">
                            <a href="javascript: nm_set_option('environment', '', 'nm_iframe')" title="<?php echo $nm_lang['hint_environment']; ?>" class="item item-menu">
                                <i class="fa-solid fa-gear"></i>
                                <?php echo $nm_lang['main_environment']; ?>
                            </a>
                            <a id="pub_dir" href="javascript: nm_set_option('pub_dir', '', 'nm_iframe')" title="<?php echo $nm_lang['hint_pub_dir']; ?>" class="item item-menu">
                                <i class="fa-solid fa-folder-open"></i>
                                <?php echo $nm_lang['main_pub_dir']; ?>
                            </a>
                            <a href="javascript: nm_set_option('outdated_apps', '', 'nm_iframe')" title="<?php echo $nm_lang['hint_app_outdated']; ?>" class="item item-menu">
                                <i class="fa-solid fa-circle-xmark"></i>
                                <?php echo $nm_lang['main_app_outdated']; ?>
                            </a>
                            
                            <a id="update" href="javascript: nm_set_option('update', '', 'nm_iframe')" title="<?php echo $nm_lang['hint_update']; ?>" class="item item-menu">
                                <i class="fa-solid fa-refresh"></i>
                                <?php echo $nm_lang['main_update']; ?>
                            </a>
                            <a href="javascript: nm_set_option('api', '', 'nm_iframe')" title="<?php echo $nm_lang['hint_api']; ?>" class="item item-menu">
                                <i class="fa-solid fa-cubes"></i>
                                <?php echo $nm_lang['main_api']; ?>
                            </a>
                            
                            <a href="javascript: nm_set_option('recover_mail_setting', '', 'nm_iframe')" title="<?php echo $nm_lang['hint_smtp_setting']; ?>" class="item item-menu">
                                <i class="fa-solid fa-lock"></i>
                                <?php echo $nm_lang['main_smtp_setting']; ?>
                            </a>
                            
                            <a href="javascript: nm_set_option('change_pass', '', 'nm_iframe')" title="<?php echo $nm_lang['hint_change_pass']; ?>" class="item item-menu">
                                <i class="fa-solid fa-key"></i>
                                <?php echo $nm_lang['main_password']; ?>
                            </a>
                            <?php
                                switch ($_SESSION['nm_session']['prod_v8']['lang']) {
                                    case "pt-br":
                                        $str_lang = "pt_br";
                                        $site_lang = ".com.br";
                                        $pub_lang = "manual/12-publicacao/01-visao-geral/";
                                        break;
                                    case "es-es":
                                        $str_lang = "es_es";
                                        $site_lang = ".net";
                                        $pub_lang = "manual/12-deploy/01-general-view/";
                                        break;
                                    default:
                                        $str_lang = "en_us";
                                        $site_lang = ".net";
                                        $pub_lang = "manual/12-deploy/01-general-view/";
                                        break;
                                }

                                //$arr_file = @file("http://www.scriptcase{$site_lang}/docs/{$str_lang}/v81/manual_mp.htm");
                                $arr_file = @file($nm_lang['link_help']);

                                if (is_array($arr_file) && count($arr_file) > 1) {
                                    ?>
                                    <a href="<?php echo $nm_lang['link_help']; ?>" title="<?php echo $nm_lang['lbl_help']; ?>" class="item item-menu" target="_blank">
                                        <i class="fa-solid fa-circle-question"></i>
                                        <?php echo $nm_lang['lbl_help']; ?>
                                    </a>
                                <?php
                                } else {
                                    ?>
                                    <a href="javascript:alert('<?php echo html_entity_decode($nm_lang['msg_not_internet']); ?>');" title="<?php echo $nm_lang['lbl_help']; ?>" class="item item-menu">
                                        <i class="fa-solid fa-circle-question"></i>
                                        <?php echo $nm_lang['lbl_help']; ?>
                                    </a>
                                <?php
                                }
                                ?>
                                <a href="javascript: nm_set_option('diagnosis', '', 'nm_iframe')" title="<?php echo $nm_lang['hint_diagnosis']; ?>" class="item item-menu">
                                    <i class="fa-solid fa-list-check"></i>
                                    <?php echo $nm_lang['main_diagnosis']; ?>
                                </a>
                                <a id="id-about" href="#" title="About" class="item item-menu">
                                    <i class="fa-solid fa-circle-info"></i>
                                    <?php echo $nm_lang['main_about']; ?>
                                </a>
                                <a href="javascript: nm_set_option('logout', '', '_top')" title="<?php echo $nm_lang['hint_logout']; ?>" class="item item-menu">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <?php echo $nm_lang['main_logout']; ?>
                                </a>
                        </div>
                    </div>
                </div>
            </td>

            <td valign="top" align="center" style="height:100%;padding: 10px;" class="nmTable">
                <?php
                if ($b_msg) {
                    $str_msg = isset($_POST['opt_par']) ? $_POST['opt_par'] : '';
                    ?>
                    <iframe name="nm_iframe" id="id_iframe" width="100%" height="100%"
                            src="<?php echo nm_prod_url_rand($nm_config['url_lib'] . $scSuffixUrl . 'nm_ini_manager2.php?option=msg&msg=' . urlencode($str_msg)); ?>"
                            frameborder="0"
                            style="border-style: none; border-width: 0px;margin:0px; padding: 0px;"></iframe>
                <?php
                } else {
                    ?>
                    <iframe name="nm_iframe" id="id_iframe" width="100%" height="100%" src="../../img/index.html"
                            frameborder="0"
                            style="border-style: none; border-width: 0px;margin:0px; padding: 0px;"></iframe>
                <?php
                }
                ?>
                <!--iframe name="nm_iframe" id="id_iframe" width="640" height="468" src="../../img/index.html" frameborder="0" style="border-style: none; border-width: 0px;margin:0px; padding: 0px;"></iframe-->
            </td>
        </tr>
    </table>
    <div id="about_window" class="ui mini modal">
      <div class="header"> 
      	<?php echo $nm_lang['sc_prod']; ?> 
      </div>
      <div class=" content">
        <div class="description"> 
        	<?php echo $nm_lang['version']; ?>: <?php echo nm_prod_get_version_about(); ?> 
        	<br> 
        	1997 - <?php echo date("Y"); ?> <?php echo $nm_lang['copyright_label']; ?> 
       	</div>
      </div>
      <div class="actions">
        <div class="ui button primary cancel">
        	<?php echo $nm_lang['button_close']; ?>
        </div>
      </div>
    </div>
    <script>
    $('#about_window').modal({
		closable: true,
		blurring: true,
	})
    </script>
<?php

$arr_new_conn = nm_prod_get_pending_connections();
$int_col_total = 3;
$int_col_width = floor(100 / $int_col_total);
$int_con_count = 0;
if (!empty($arr_new_conn))
{
?>
    <SCRIPT>
        nm_set_option('connections_pendent', '', 'nm_iframe');
    </SCRIPT>
<?php
}

} // nm_prod_display_main_menu


function nm_prod_display_connections_pendent()
{
    global $nm_config, $nm_lang;
    $arr_new_conn = nm_prod_get_pending_connections();
    ?>
    <div class="ui container" style="margin-top: 2rem;">
        <h3 class="ui dividing header"><?php echo $nm_lang['main_warn_conn']; ?></h3>
            <div class="ui seven cards" style="margin-top: .875rem;">

            <?php if (!empty($arr_new_conn)) {
                foreach ($arr_new_conn as $str_new_conn) {
            ?>
            <div class="ui card">
                <a href="javascript: nm_set_option('profile_new', '<?php echo $str_new_conn; ?>', '')" class="image">
                        <img src="../../img//database-bg-low-contrast.png">
                </a>
                <div class="content">
                    <div class="description" style="word-wrap: break-word;">
                        <?php echo $str_new_conn; ?></a>
                    </div>
                </div>
                <div class="extra content" style="text-align: center;">
                        <a href="javascript: confirmDeletePreProfile('delete_preprofile', '<?php echo $str_new_conn; ?>', 'nm_iframe')" class="ui mini button red"><i class="trash icon"></i> Deletar</a>
                </div>
            </div>
            <?php
            }
                } ?>
    </div>
<?php
} // nm_prod_display_connections_pendent


function nm_prod_display_profile_general()
{
    global $arr_dbms, $nm_lang, $str_step;
    ?>
    <div style="text-align: center">
        <table class="nmTable" style="width: 500px;margin:0px auto;" align="center">
            <tr>
                <td class="nmTitle" colspan="2"
                    style="white-space: nowrap"><?php echo $nm_lang['profile_general']; ?></td>
            </tr>
            <tr>
                <td class="nmLineV3"><?php echo $nm_lang['form_dbms']; ?></td>
                <td class="nmLineV3">
                    <?php
                    if (1 == sizeof($arr_dbms[$_SESSION['nm_session']['prod_v8']['profile']['dbms_group']])) {
                        reset($arr_dbms[$_SESSION['nm_session']['prod_v8']['profile']['dbms_group']]);
                        $str_dbms = current($arr_dbms[$_SESSION['nm_session']['prod_v8']['profile']['dbms_group']]);
                        ?>
                        <input type="hidden" name="field_dbms" value="<?php echo $str_dbms; ?>"/>
                        <?php echo $nm_lang[$str_dbms]; ?>
                    <?php
                    } else {
                        ?>
                        <select name="field_dbms" class="nmInput">
                            <?php
                            foreach ($arr_dbms[$_SESSION['nm_session']['prod_v8']['profile']['dbms_group']] as $str_dbms) {
                                ?>
                                <option
                                    value="<?php echo $str_dbms; ?>"<?php if ($str_dbms == $_SESSION['nm_session']['prod_v8']['profile']['dbms']) {
                                    echo ' selected="selected"';
                                } ?>><?php echo $nm_lang[$str_dbms]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="nmLineV3"><?php echo $nm_lang['form_dec']; ?></td>
                <td class="nmLineV3">
                    <select name="field_decimal" class="nmInput">
                        <option value="."<?php if ('.' == $_SESSION['nm_session']['prod_v8']['profile']['decimal']) {
                            echo ' selected="selected"';
                        } ?>><?php echo $nm_lang['form_dec_dot']; ?></option>
                        <option value=","<?php if (',' == $_SESSION['nm_session']['prod_v8']['profile']['decimal']) {
                            echo ' selected="selected"';
                        } ?>><?php echo $nm_lang['form_dec_comma']; ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="nmLineV3"><?php echo $nm_lang['form_use_persistent']; ?></td>
                <td class="nmLineV3">
                    <select name="field_use_persistent" class="nmInput">
                        <option
                            value="Y"<?php if ('Y' == $_SESSION['nm_session']['prod_v8']['profile']['use_persistent']) {
                            echo ' selected="selected"';
                        } ?>><?php echo $nm_lang['form_persistente_y']; ?></option>
                        <option
                            value="N"<?php if ('N' == $_SESSION['nm_session']['prod_v8']['profile']['use_persistent'] || empty($_SESSION['nm_session']['prod_v8']['profile']['use_persistent'])) {
                            echo ' selected="selected"';
                        } ?>><?php echo $nm_lang['form_persistente_n']; ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="nmLineV3"><?php echo $nm_lang['form_use_schema']; ?></td>
                <td class="nmLineV3">
                    <select name="field_use_schema" class="nmInput">
                        <option
                            value="Y"<?php if ('Y' == $_SESSION['nm_session']['prod_v8']['profile']['use_schema']) {
                            echo ' selected="selected"';
                        } ?>><?php echo $nm_lang['form_persistente_y']; ?></option>
                        <option
                            value="N"<?php if ('N' == $_SESSION['nm_session']['prod_v8']['profile']['use_schema'] || empty($_SESSION['nm_session']['prod_v8']['profile']['use_schema'])) {
                            echo ' selected="selected"';
                        } ?>><?php echo $nm_lang['form_persistente_n']; ?></option>
                    </select>
                </td>
            </tr>
        </table>
        <br/>
        <input type="hidden" name="step" value="<?php echo $str_step; ?>"/>
        <input type="submit" value="<?php echo $nm_lang['button_continue']; ?>" class="nmButton"/>
        <input type="button" value="<?php echo $nm_lang['button_cancel']; ?>"
               onClick="nm_set_option('main_menu', '', 'nm_iframe')" class="nmButton"/>
    </div>
<?php
} // nm_prod_display_profile_general


function nm_prod_display_profile_rename()
{
    global $arr_ini, $nm_lang;
    $arr_profiles = array_keys($arr_ini['PROFILE']);
    if (empty($arr_profiles)) {
        ?>
        <div class="ui container" style="margin-top: 2rem;">
            <h3 class="ui dividing header"><?php echo $nm_lang['profile_rename']; ?></h3>
            <div class="ui ignored  message">
                <?php echo $nm_lang['profile_rename_empty']; ?>
            </div>
        </div>
    <?php
    } else {
        natcasesort($arr_profiles);

        $conn_sel = isset($_POST['field_profile']) ? $_POST['field_profile'] : "";
        ?>
        <div class="ui container" style="margin-top: 2rem;">
                <h3 class="ui dividing header"><?php echo $nm_lang['profile_rename']; ?></h3>
                <div class="four wide field">
                    <label><?php echo $nm_lang['rem_conn_sel_conn']; ?></label>
                    <select class="ui fluid dropdown" name="field_profile">
                        <option></option>
                        <?php
                            foreach ($arr_profiles as $str_profile) {
                                $sel = $conn_sel == $str_profile ? " selected " : "";
                                ?>
                                <option value="<?php echo $str_profile; ?>" <?php echo $sel; ?>><?php echo $str_profile; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="four wide field">
                    <label><?php echo $nm_lang['rem_conn_new_name']; ?></label>
                    <input type="text" name="field_new_name">
                </div>


                <button class="ui button primary" onclick="nm_set_option('profile_rename', '', 'nm_iframe')">
                    <?php echo $nm_lang['button_rename']; ?>
                </button>
        </div>
    <?php
    }
} // nm_prod_display_profile_rename

function nm_prod_display_profile_select()
{
    global $arr_ini, $nm_lang, $str_step;
    $arr_profiles = array_keys($arr_ini['PROFILE']);
    if (empty($arr_profiles)) {
        ?>
        <div style="text-align: center">
            <table class="nmTable" style="width: 500px" align="center">
                <tr>
                    <td class="nmTitle" style="white-space: nowrap"><?php echo $nm_lang['profile_select']; ?></td>
                </tr>
                <tr>
                    <td class="nmLineV3"><?php echo $nm_lang['profile_select_empty']; ?></td>
                </tr>
            </table>
            <br/>
            <input type="button" value="<?php echo $nm_lang['button_back']; ?>"
                   onClick="nm_set_option('main_menu', '', 'nm_iframe')" class="nmButton"/>
        </div>
    <?php
    } else {
        natcasesort($arr_profiles);
        ?>
        <div style="text-align: center">
            <table class="nmTable" style="width: 500px" align="center">
                <tr>
                    <td class="nmTitle" style="white-space: nowrap"><?php echo $nm_lang['profile_select']; ?></td>
                </tr>
                <tr>
                    <td class="nmLineV3">
                        <?php echo $nm_lang['profile_select_warning']; ?>
                        <div style="text-align: center">
                            <br/>
                            <select name="field_profile" class="nmInput">
                                <option></option>
                                <?php
                                foreach ($arr_profiles as $str_profile) {
                                    ?>
                                    <option value="<?php echo $str_profile; ?>"><?php echo $str_profile; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
            </table>
            <br/>
            <input type="hidden" name="step" value="<?php echo $str_step; ?>"/>
            <input type="submit" value="<?php echo $nm_lang['button_edit']; ?>" class="nmButton"/>
            <input type="button" value="<?php echo $nm_lang['button_cancel']; ?>"
                   onClick="nm_set_option('main_menu', '', 'nm_iframe')" class="nmButton"/>
        </div>
    <?php
    }
} // nm_prod_display_profile_select


function nm_prod_display_profile_test_select()
{
    global $arr_ini, $nm_lang;
    $arr_profiles = array_keys($arr_ini['PROFILE']);
    if (empty($arr_profiles)) {
        ?>
        <div style="text-align: center">
            <table class="nmTable" style="width: 500px" align="center">
                <tr>
                    <td class="nmTitle" style="white-space: nowrap"><?php echo $nm_lang['profile_test']; ?></td>
                </tr>
                <tr>
                    <td class="nmLineV3"><?php echo $nm_lang['profile_test_empty']; ?></td>
                </tr>
            </table>
            <br/>
            <input type="button" value="<?php echo $nm_lang['button_back']; ?>"
                   onClick="nm_set_option('main_menu', '', 'nm_iframe')" class="nmButton"/>
        </div>
    <?php
    } else {
        natcasesort($arr_profiles);
        ?>
        <div style="text-align: center">
            <table class="nmTable" style="width: 500px" align="center">
                <tr>
                    <td class="nmTitle" style="white-space: nowrap"><?php echo $nm_lang['profile_test']; ?></td>
                </tr>
                <tr>
                    <td class="nmLineV3">
                        <?php echo $nm_lang['profile_test_warning']; ?>
                        <div style="text-align: center">
                            <br/>
                            <select name="field_profile" class="nmInput">
                                <option></option>
                                <?php
                                foreach ($arr_profiles as $str_profile) {
                                    ?>
                                    <option value="<?php echo $str_profile; ?>"><?php echo $str_profile; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
            </table>
            <br/>
            <input type="button" value="<?php echo $nm_lang['button_test']; ?>" onClick="nm_test_conn()"
                   class="nmButton"/>
            <input type="button" value="<?php echo $nm_lang['button_cancel']; ?>"
                   onClick="nm_set_option('main_menu', '', 'nm_iframe')" class="nmButton"/>
        </div>
    <?php
    }
} // nm_prod_display_profile_test_select



function nm_prod_display_api()
{
    global $nm_config, $nm_lang;


    $arr_profiles = [];


    $file = $nm_config['path_conf']."profile_api.conf.php";
    if(file_exists($file))
    {
        $str_content = strtr(file_get_contents( $file ), array("<?php" => '', "?>" => ''));
        $arr_profiles = unserialize(trim($str_content));
    }


    $arr_new = [];
    $arr_files = scandir($nm_config['path_conf']);
    foreach($arr_files as $file)
    {
        if(substr($file, 0 , 8) == 'new_api_')
        {
            $arr_new[$file] = file_get_contents($nm_config['path_conf'].$file);
        }
    }



?>
<div class="ui container" style="margin-top: 2rem;">
    <h3 class="ui dividing header"><?php echo $nm_lang['main_api']; ?></h3>
    <div style="display:none">
        <?php foreach($arr_new as $profile => $name): ?>
            <a href="javascript:nm_set_option('api_edit_profile', '<?php echo $profile ?>', '')" style="color:#000;    display: inline-block; text-align: center;width:67px">
            <img src="../../img/api.png" border=0 align="absmiddle" style="width:60px"/>
            <span><?php echo $name; ?></span>
            </a>
        <?php endforeach;?>
    </div>
    <table class="ui striped table">
        <thead>
            <tr>
                <th>#</th>
                <th><?php echo $nm_lang['name']; ?></th>
                <th><?php echo $nm_lang['gateway']; ?></th>
                <th><?php echo $nm_lang['action']; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach($arr_profiles as $profile): ?>
                <tr>
                    <td data-label="id"><?php echo $i; ?></td>
                    <td data-label="name"><?php echo $profile['name']; ?></td>
                    <td data-label="gateway"><?php echo $profile['gateway']; ?></td>
                    <td data-label="action">
                    <!-- <a class="ui icon button tiny" title="<?php echo $nm_lang['button_edit']; ?>" href="javascript:nm_set_option('api_edit_profile', '<?php echo $profile['id'] ?>', 'nm_iframe')">
                        <i class="icon edit"></i>
                    </a>
                    <a class="ui icon button red tiny" title="<?php echo $nm_lang['button_delete']; ?>" href="javascript:nm_set_option('api_delete_profile', '<?php echo $profile['id'] ?>', 'nm_iframe')">
                        <i class="icon trash"></i>
                    </a> -->

                    <button class="ui icon button tiny" title="<?php echo $nm_lang['button_edit']; ?>" onclick="javascript:nm_set_option('api_edit_profile', '<?php echo $profile['id'] ?>', 'nm_iframe')"><i class="icon edit"> </i></button>
                    <button class="ui icon button red tiny" title="<?php echo $nm_lang['button_delete']; ?>" onclick="javascript:nm_set_option('api_delete_profile', '<?php echo $profile['id'] ?>', 'nm_iframe')"> <i class="icon trash"></i></button>
                    </td>
                </tr>
            <?php $i++; endforeach; ?>
        </tbody>
    </table>
    <button class="ui button green" onclick="nm_set_option('api_add_profile', '', '')">
        <i class="icon add"></i><?php echo $nm_lang['button_add']; ?>
    </button>
</div>
    <?php
} // nm_prod_display_profile_test_select



function nm_prod_display_api_add_profile($id = -1)
{
    global $nm_config, $nm_lang;


    $arr_profiles = [];


    $file = $nm_config['path_conf']."profile_api.conf.php";
    if(file_exists($file))
    {
        $str_content = strtr(file_get_contents( $file ), array("<?php" => '', "?>" => ''));
        $arr_profiles = unserialize(trim($str_content));
    }

    include_once(__DIR__.'/nm_api.php');

    $arr_gateways = nm_get_api_gateways_deep();
    $api = [];
    if($id != -1)
    {
        foreach($arr_profiles as $arr_data)
        {
            if($arr_data['id'] == $id)
            {
                $api = $arr_data;
            }
        }
    }
    $name_default = (isset($api['name']) ? $api['name'] : '');
    $new_flag = '';
    if(empty($name_default) && !is_numeric($id) && file_exists($nm_config['path_conf'].$id))
    {
        $name_default = file_get_contents($nm_config['path_conf'].$id);
        $new_flag = $id;
    }

    $gateway_default = isset($api['gateway']) ? $api['gateway'] : 'smtp';
?>
<style>
    .gw {
        display: none
    }
    *{font-size:14px;}
    .form-control{width:100%; height:23px;}
    .field-error{ border-color:#dc3545; background-color: #e7bcc0 }
</style>
<script src="../../third/jquery/js/jquery.js"></script>
<script>
function openAuthGoogle(){
            var gateway = $('select[name=gateway]').val().split('__NM__')[1];
            var app_name = $('input[name="'+gateway+'[app_name]"]').val();
            var json_oauth = $('textarea[name="'+gateway+'[json_oauth]"]').val();
            $.post('nm_ini_manager2.php?nm_ajax=1&option=gd_auth_api&app_name='+app_name+'&json_oauth='+json_oauth+'&gateway='+ gateway, function(str_return){
                            window.open(str_return, '_blank');
                        } );
        }
</script>
        <div>
            <div class="ui container" style="margin-top: 2rem;">
            <form method="post" action="nm_ini_manager2.php" class="ui form">
                <input type="hidden" name="option" value="api_save">
                <input type="hidden" name="api_id" value="<?php echo $api['id']; ?>">
                <input type="hidden" name="new_flag" value="<?php echo $new_flag; ?>">
                <h3 class="ui dividing header"><?php echo $nm_lang['hint_api']; ?></h3>
                <div class="ten wide field">
                    <label><?php echo $nm_lang['gateway']; ?></label>
                    <select class="ui fluid dropdown" name="gateway" onchange="$('.gw').hide(); $('#id_gw_'+this.value.split('__NM__')[1]).show();" required="required">
                        <?php foreach ($arr_gateways as $type => $arr_gat): ?>
                            <optgroup label="<?=ucfirst($type)?>">
                                <?php foreach ($arr_gat as $k => $gw_data): ?>
                                    <option value="<?php echo $type . '__NM__'.$k; ?>" <?php echo $api['gateway'] == $k ? "selected='selected'" : ''; ?> >
                                        <?php echo ucfirst($k); ?>
                                    </option>
                                <?php endforeach; ?>
                            </optgroup>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="ten wide field">
                    <label><?php echo $nm_lang['name']; ?></label>
                    <input name="name" required="required" id="id_name_api"
                                   placeholder="<?php echo $nm_lang['name']; ?>"
                                   value="<?php echo $name_default; ?>">
                </div>
                <?php foreach ($arr_gateways as $type => $arr_gw_data): ?>
                <?php foreach ($arr_gw_data as $k => $gw_data): ?>
                    <div id="id_gw_<?php echo $k; ?>" class="gw" <?php echo($k == $gateway_default ? "style='display:block'" : ""); ?>>
                        <?php foreach ($gw_data as $field_name => $value): ?>
                            <div class="ten wide field">
                                <label><?php echo  ucfirst(implode(' ', explode('_',$field_name))) ; ?></label>
                                <?php if( $value['type'] == 'select'): ?>
                                    <select name="<?php echo $k; ?>[<?php echo $field_name; ?>]" class="ui fluid dropdown" required="required">
                                        <?php $selected = (isset($api['settings'][$field_name]) ? $api['settings'][$field_name] : '') ?>
                                        <?php foreach($value['options'] as $k_value => $v):
                                                if(!isset($value['use_key']) || $value['use_key'] != true){ $k_value = $v; }
                                            ?>
                                            <option value='<?php echo $k_value ?>' <?php echo $selected == $k_value ? "selected='selected'" : "" ?>><?php echo $v; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php elseif( $value['type'] == 'gd_auth_code'): ?>
                                    <input type="text"  name="<?php echo $k; ?>[<?php echo $field_name; ?>]" required="required" <?=$on_change?>
                                       placeholder="<?php echo  $nm_lang['api_gw_sett'][$field_name ."_placeholder"]; ?>" style="width: 84%;"
                                       value="<?php echo(isset($api['settings'][$field_name]) ? $api['settings'][$field_name] : '') ?>"/>
                                        <button class="ui button primary" onclick="openAuthGoogle();">Auth</button>
                                <?php elseif($value['type'] == 'textarea'): ?>
                                    <textarea name="<?php echo $k; ?>[<?php echo $field_name; ?>]" required="required" <?=$on_change?> rows="7" style="height:auto"
                                   placeholder="<?php echo  $value['placeholder']; ?>"><?php echo(isset($api['settings'][$field_name]) ? $api['settings'][$field_name] : '') ?></textarea>
                                <?php else: ?>
                                	<?php
                                            $required_field = 'required="required"';
                                            if($k.'['.$field_name.']' == 'smtp[smtp_user]' || $k.'['.$field_name.']' == 'smtp[smtp_password]'){
                                                $required_field = '';
                                            }
                                    ?>
                                    <input type="<?php echo isset($value['type'])? $value['type'] : 'text'; ?>"
                                    name="<?php echo $k; ?>[<?php echo $field_name; ?>]" <?php echo $required_field; ?> <?=$on_change?>
                                        placeholder="<?php echo $value['placeholder']; ?>"
                                        value="<?php echo(isset($api['settings'][$field_name]) ? $api['settings'][$field_name] : '') ?>">
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
                <?php endforeach; ?>
                <input type="button" class="ui button" style="margin-top: 1rem;" value="<?php echo $nm_lang['button_back']; ?>" onclick="nm_set_option('api', '', 'nm_iframe')">
                <input type="button" class="ui button primary" style="margin-top: 1rem;" value="<?php echo $nm_lang['button_save']; ?>" onclick="nm_set_option('api_save', '<?php echo (isset($api['id'])?$api['id'] : -1) ; ?>', 'nm_iframe')">
            </form>
        </div>
    <?php
}


function nm_prod_error_filter($v_str_msg)
{
    global $nm_db;
    if ('' == trim($v_str_msg)) {
        return FALSE;
    } elseif (FALSE !== strpos($v_str_msg, 'Changed language setting')) {
        return FALSE;
    } elseif (FALSE !== strpos($v_str_msg, 'Changed database context to')) {
        return FALSE;
    } elseif (FALSE !== strpos($v_str_msg, 'Creating default object from empty value')) {
        return FALSE;
    } elseif (FALSE !== strpos($v_str_msg, 'should be compatible with that of')) {
        return FALSE;
    } elseif (FALSE !== strpos($v_str_msg, 'Contexto do banco de dados alterado para')) {
        return FALSE;
    } elseif (FALSE !== strpos($v_str_msg, 'Contexto do banco de dados modificado para')) {
        return FALSE;
    } elseif (FALSE !== strpos($v_str_msg, "Invalid object name 'sys.schemas'")) {
        return FALSE;
    } elseif (FALSE !== strpos($v_str_msg, 'do idioma alterada para')) {
        return FALSE;
    } elseif (FALSE !== strpos(strtolower($v_str_msg), 'n de idioma a espa')) {
        return FALSE;
    } elseif (FALSE !== strpos($v_str_msg, 'Qualified object name COLUMNS not valid')) {
        return FALSE;
    } elseif (FALSE !== strpos($v_str_msg, 'Check messages from the SQL Server')) {
        return FALSE;
    } elseif (FALSE !== strpos(strtolower($v_str_msg), 'seclabelname')) {
        return FALSE;
    } elseif (FALSE !== strpos(strtolower($v_str_msg), 'db2admin.rcml01')) {
        return FALSE;
    } elseif (FALSE !== strpos(strtolower($v_str_msg), 'nada foi executado')) {
        return FALSE;
    } elseif (FALSE !== strpos(strtolower($v_str_msg), 'the mysql extension is deprecated and will be removed in the future')) {
        return FALSE;
    } elseif (FALSE !== strpos(strtolower($v_str_msg), 'driver doesn\'t support meta data')) {
        return FALSE;
    } else {
        return TRUE;
    }
} // nm_prod_error_filter

function nm_prod_error_handler($v_int_no, $v_str_msg, $v_str_script,
                               $v_int_line, $v_arr_context = array())
{
    global $str_db_err;
    $arr_handled = array(
        E_ERROR,
        E_WARNING,
        E_PARSE,
        E_NOTICE,
        E_CORE_ERROR,
        E_CORE_WARNING,
        E_COMPILE_ERROR,
        E_COMPILE_WARNING,
        E_USER_ERROR,
        E_USER_WARNING,
        E_USER_NOTICE
    );
    if (in_array($v_int_no, $arr_handled) && '' != $v_str_msg) {
        if ((FALSE !== strpos($v_str_msg, 'Invoke() failed')) &&
            (FALSE !== strpos($v_str_msg, 'sybase_select_db()')) &&
            (FALSE !== strpos($v_str_msg, 'Changed database context to')) &&
            (FALSE !== strpos($v_str_msg, 'Creating default object from empty value')) &&
            (FALSE !== strpos($v_str_msg, 'should be compatible with that of')) &&
            (FALSE !== strpos($v_str_msg, 'Contexto do banco de dados alterado para')) &&
            (FALSE !== strpos($v_str_msg, 'Contexto do banco de dados modificado para')) &&
            (FALSE !== strpos($v_str_msg, 'do idioma alterada para')) &&
            (FALSE !== strpos(strtolower($v_str_msg), 'n de idioma a espa')) &&
            (FALSE !== strpos($v_str_msg, 'Unexpected results, cancelling current')) &&
            (FALSE !== strpos($v_str_msg, 'Only variable references should be returned by reference')) &&
            (FALSE !== strpos($v_str_msg, 'Only variables should be assigned by reference')) &&
            (FALSE !== strpos($v_str_msg, 'Undefined index:')) &&
            (FALSE !== strpos($v_str_msg, 'Assigning the return value of new by reference is deprecated')) &&
            (FALSE !== strpos($v_str_msg, 'var: Deprecated. Please use the')) &&
            (FALSE !== strpos($v_str_msg, "Invalid object name 'sys.schemas'")) &&
            (FALSE !== strpos($v_str_msg, "Qualified object name COLUMNS not valid")) &&
            (FALSE !== strpos($v_str_msg, "Check messages from the SQL Server")) &&
            (FALSE !== strpos($v_str_msg, 'Changed language')) &&
            (FALSE !== strpos(strtolower($v_str_msg), 'the mysql extension is deprecated and will be removed in the future')) &&
            (FALSE !== strpos(strtolower($v_str_msg), 'driver doesn\'t support meta data')) &&
            (FALSE !== strpos(strtolower($v_str_msg), 'unable to bind to server'))
        ) {
            $str_db_err = $v_str_msg;
        }
    }
} // nm_prod_error_handler

function nm_prod_get_old_connections()
{
    global $arr_ini;
    $arr_conn = array_keys($arr_ini['PROFILE']);
    natcasesort($arr_conn);
    return $arr_conn;
} // nm_prod_get_old_connections

function nm_prod_get_pending_connections()
{
    global $nm_config;

    $arr_new_conn = nm_prod_get_new_connections($nm_config['path_conf']);
    $arr_old_conn = nm_prod_get_old_connections();

    foreach ($arr_old_conn as $str_old_conn) {
        if (in_array($str_old_conn, $arr_new_conn)) {
            @unlink($nm_config['path_conf'] . 'new_connection_' . $str_old_conn);
            unset($arr_new_conn[array_search($str_old_conn, $arr_new_conn)]);
        }
    }

    return $arr_new_conn;
} // nm_prod_get_pending_connections

function nm_prod_get_new_connections($str_path)
{
    $arr_conn = array();
    $res_dir = @opendir($str_path);
    if ($res_dir) {
        while (false !== ($str_file_conn = @readdir($res_dir))) {
            if ('new_connection_' == substr($str_file_conn, 0, 15)) {
                $arr_conn[] = substr(trim($str_file_conn), 15);
            }
        }
        @closedir($res_dir);
    }
    //conexones pub avancada
    if(is_file($str_path.'/prod.pub.dir.php')){
        include($str_path.'/prod.pub.dir.php');
        foreach($sc_arr_system_dir as $item){
            if(isset($item[0])){
                $res_dir = @opendir($item[0].'/_lib/conf');
                if ($res_dir) {
                    while (false !== ($str_file_conn = @readdir($res_dir))) {
                        if ('new_connection_' == substr($str_file_conn, 0, 15)) {
                            $arr_conn[] = substr(trim($str_file_conn), 15);
                        }
                    }
                    @closedir($res_dir);
                }
            }
        }
    }
    natcasesort($arr_conn);
    $arr_conn = array_unique($arr_conn);
    return $arr_conn;
} // nm_prod_get_new_connections

function nm_prod_delete_new_connections($str_conn)
{
    global $nm_config;

    if(is_file($nm_config['path_conf'] . "new_connection_" . $str_conn))
    {
        unlink($nm_config['path_conf'] . "new_connection_" . $str_conn);
    }
    //conexones pub avancada
    if(is_file($nm_config['path_conf'].'/prod.pub.dir.php')){
        include($nm_config['path_conf'].'/prod.pub.dir.php');
        foreach($sc_arr_system_dir as $item){
            if(isset($item[0])){
                if(is_file($item[0].'/_lib/conf/new_connection_'.$str_conn)){
                    unlink($item[0].'/_lib/conf/new_connection_'.$str_conn);
                }
            }
        }
    }

} // nm_prod_get_new_connections

function nm_prod_lang()
{
    global $nm_config;
    if (!isset($_SESSION['nm_session']['prod_v8']['lang']) ||
        !@is_file($nm_config['path_lib'] . 'lang.' . $_SESSION['nm_session']['prod_v8']['lang'] . '.php')
    ) {
        $arr_accept = array();
        $str_accept = '';
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            if (FALSE !== strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'], ',')) {
                $arr_accept = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
                $str_accept = $arr_accept[0];
            } else {
                $str_accept = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
            }
        } else {
            $str_accept = 'en-us';
        }
        if (!@is_file($nm_config['path_lib'] . 'lang.' . $str_accept . '.php')) {
            $str_accept = 'en-us';
        }

        //checa se a publicacao fixou algum idioma inicial
        if (@is_file("../../../conf/language")) {
            $str_language = implode("", file("../../../conf/language"));
            if (!empty($str_language)) {
                if ($str_language == 'pt_br') {
                    $str_accept = 'pt-br';
                } else {
                    $str_accept = 'en-us';
                }
            }
        }

        $_SESSION['nm_session']['prod_v8']['lang'] = strtolower($str_accept);
    }

    nm_prod_validate_lang($_SESSION['nm_session']['prod_v8']['lang']);
} // nm_prod_lang

function nm_prod_validate_lang(&$lang)
{
    preg_match("/^[a-z]{2}-[a-z]{2}$/i", $lang, $match);
    if (empty($match)) {
        $lang = "en-us";
    }
} // nm_prod_validate_lang

function nm_prod_list_lang()
{
    global $nm_config;
    $arr_lang = array();
    $res_dir = @opendir($nm_config['path_lib']);
    if ($res_dir) {
        while (FALSE !== ($str_file = @readdir($res_dir))) {
            if ('.' != $str_file && '..' != $str_file &&
                'lang.' == substr($str_file, 0, 5) &&
                '.php' == substr($str_file, -4) &&
                @is_file($nm_config['path_lib'] . $str_file)
            ) {
                $str_lang = substr($str_file, 5, -4);
                $arr_data = @file($nm_config['path_lib'] . $str_file);
                $arr_lang[$str_lang] = trim(substr($arr_data[1], 2));
            }
        }
        @closedir($res_dir);
    }
    return $arr_lang;
} // nm_prod_list_lang

function nm_prod_path()
{
    $arr_config = array();
    /* Calculo dos caminhos */
    $str_script = $_SERVER['PHP_SELF'];
    $str_url_base = dirname($str_script);
    if (in_array($str_url_base, array("\\", ".\\", './'))) {
        $str_url_base = '';
    }

    //alteracao diogo
    $dir_getcwd = getcwd();
    if (!empty($dir_getcwd)) {
        $str_path_base = $dir_getcwd . "/" . basename($_SERVER["SCRIPT_NAME"]);
    } else {
        if (isset($_SERVER["SCRIPT_FILENAME"])) {
            $str_path_base = $_SERVER["SCRIPT_FILENAME"];
        } else {
            $str_path_base = $_SERVER["ORIG_PATH_TRANSLATED"];
        }
    }
    //fim alteracao diogo

    $str_path_base = str_replace("\\", '/', $str_path_base);
    $str_root = substr($str_path_base, 0, (-1 * strlen($str_script)) + 1);
    $str_path_base = dirname($str_path_base);
    $str_path_prod = $str_path_base;
    $str_url_prod = $str_url_base;

    for ($i = 0; $i < 2; $i++) {
        $str_path_prod = substr($str_path_prod, 0, strrpos($str_path_prod, '/'));
        $str_url_prod = substr($str_url_prod, 0, strrpos($str_url_prod, '/'));
    }
    $str_path_conf = substr($str_path_prod, 0, strrpos($str_path_prod, '/'));

    $arr_config['script'] = $str_script;
    $arr_config['path_root'] = $str_root;
    $arr_config['path_conf'] = $str_path_conf . '/conf/';
    $arr_config['path_prod'] = $str_path_prod . '/';
    $arr_config['path_lib'] = $str_path_base . '/';
    $arr_config['url_prod'] = $str_url_prod . '/';
    $arr_config['url_img'] = $str_url_prod . '/img/';
    $arr_config['url_lib'] = $str_url_base . '/';
    $arr_config['is_dev']  = (is_file($arr_config['path_prod'].'is_dev') ? true : false);
    $url = "webservice.scriptcase.com.br";
    if($arr_config['is_dev']){
        $url = 'dev-'.$url;
    }
    $arr_config['prod_service'] = "http://".$url."/prodservicev9/nm_prod_service_v9.php";
    return $arr_config;
} // nm_prod_path

function nm_prod_help(){
    global $nm_config;
    include('help.'.$_SESSION['nm_session']['prod_v8']['lang'].'.php');
}

function nm_prod_php_version()
{
    if (-1 != version_compare(phpversion(), '5.0.0')) {
        return 5;
    } elseif (-1 != version_compare(phpversion(), '4.0.0')) {
        return 4;
    } else {
        return 3;
    }
} // nm_prod_php_version

function nm_prod_url_rand($v_str_url, $v_bol_force = FALSE)
{
    $str_url = $v_str_url;
    $str_url .= (FALSE === strpos($v_str_url, '?'))
        ? '?rand='
        : '&rand=';
    $str_url .= substr(md5(mt_rand()), 8, 16);
    return $str_url;
} // nm_prod_url_rand

function trataError($errno, $errstr, $errfile, $errline)
{
    $arr_handled = array(
        E_ERROR,
        E_WARNING,
        E_PARSE,
        E_NOTICE,
        E_CORE_ERROR,
        E_CORE_WARNING,
        E_COMPILE_ERROR,
        E_COMPILE_WARNING,
        E_USER_ERROR,
        E_USER_WARNING,
        E_USER_NOTICE
    );

    if (strpos($errstr, "set_time_limit()") !== false) {
    } elseif (in_array($errno, $arr_handled) && '' != $errstr) {
        switch ($errno) {
            case E_ERROR:
                $errno = "FATAL";
                break;
            case E_WARNING:
                $errno = "WARNING";
                break;
            case E_NOTICE:
                $errno = "NOTICE";
                break;
            case E_PARSE:
                $errno = "PARSE ERROR";
                break;
        }
        if (in_array($errno, $arr_handled) && '' != $errstr) {
            if ((FALSE !== strpos($errstr, 'Invoke() failed')) &&
                (FALSE !== strpos($errstr, 'sybase_select_db()')) &&
                (FALSE !== strpos($errstr, 'Changed database context to')) &&
                (FALSE !== strpos($errstr, 'Creating default object from empty value')) &&
                (FALSE !== strpos($errstr, 'should be compatible with that of')) &&
                (FALSE !== strpos($errstr, 'Contexto do banco de dados alterado para')) &&
                (FALSE !== strpos($errstr, 'Contexto do banco de dados modificado para')) &&
                (FALSE !== strpos($errstr, "Invalid object name 'sys.schemas'")) &&
                (FALSE !== strpos($errstr, 'do idioma alterada para')) &&
                (FALSE !== strpos(errstr($v_str_msg), 'n de idioma a espa')) &&
                (FALSE !== strpos($errstr, 'Unexpected results, cancelling current')) &&
                (FALSE !== strpos($errstr, 'Only variable references should be returned by reference')) &&
                (FALSE !== strpos($errstr, 'Only variables should be assigned by reference')) &&
                (FALSE !== strpos($errstr, 'Undefined index:')) &&
                (FALSE !== strpos($errstr, 'Assigning the return value of new by reference is deprecated')) &&
                (FALSE !== strpos($errstr, 'var: Deprecated. Please use the')) &&
                (FALSE !== strpos($errstr, 'Qualified object name COLUMNS not valid')) &&
                (FALSE !== strpos($errstr, 'Check messages from the SQL Server')) &&
                (FALSE !== strpos($errstr, 'Changed language')) &&
                (FALSE !== strpos(strtolower($errstr), 'the mysql extension is deprecated and will be removed in the future')) &&
                (FALSE !== strpos(strtolower($errstr), 'driver doesn\'t support meta data')) &&
                (FALSE !== strpos(strtolower($errstr), 'unable to bind to server'))
            ) {
                echo $errno . ": " . $errstr . " in <B>" . $errfile . "</B> on line <B>" . $errline . "</B>";
            }
        }
    }
}

function nm_show_msg($str_msg, $par_reenviar)
{
    if ($par_reenviar) {
        ?>
        <script>

            setTimeout(function () {
                nm_set_option("main_menu_msg", "<?php echo $str_msg; ?>", "_top")
            }, 1000);

        </script>
    <?php
    } else {
        if (isset($_GET['msg']) && $_GET['msg'] != "" && $str_msg == "") {
            $str_msg = $_GET['msg'];
        }
        ?>
        <div class="ui container" style="margin-top: 2rem;">
            <div class="ui  success message" style="display: block;">
                <?php echo $str_msg; ?>
            </div>
        </div>
    <?php
    }
}//nm_show_msg

function nm_show_message($str_message="",$str_type='success'){
    ?>
        <div class="ui container" style="margin-top: 2rem;">
            <div class="ui <?php echo $str_type; ?> message" style="display: block;">
                <?php echo $str_message; ?>
            </div>
        </div>
    <?php
}
function nm_prod_display_mail_setting(){
    global $nm_config, $nm_lang;
    $file = $nm_config['path_conf'].'prod.rec.conf.php';
    if(is_file($file)){
        $str_content = strtr(file_get_contents( $file ), array('<?php /*' => '', '*/?>' => ''));
        $arr_data    = unserialize(trim($str_content));
        $v_value     = decode_string($arr_data[0]);
    }else{
        $v_value = "";
    }
    ?>
        <div class="ui container" style="margin-top: 2rem;">
            <form class="ui form">
                <h3 class="ui dividing header"><?php echo $nm_lang['main_smtp_setting']; ?></h3>
                <div class="ten wide field">
                    <label>Email</label>
                    <input type="text" name="recover_mail" placeholder="example@example.com" value="<?php echo $v_value; ?>" required='required'>
            </div>
                <button class="ui button primary" onclick="nm_set_option('recover_mail_save', '', 'nm_iframe');">Salvar</button>
            </form>
        </div>
    <?php
}
function nm_prod_recover_mail_save(){
    global $nm_config, $nm_lang;
    $file = $nm_config['path_conf'].'prod.rec.conf.php';
    if(is_file($file)){
        @unlink($file);
    }
    try{
        $arr_data = [ encode_string_utf8($_POST['recover_mail']), ];
        $arr_data = serialize($arr_data);
        file_put_contents( $file, '<?php /*'. $arr_data .'*/?>');
        nm_show_message($nm_lang['recover_mail_save_ok']);
    } catch(Exception $e){
        $str_message = $nm_lang['recover_mail_save_error'].'<br>'.$e->getMessage();
        nm_show_message($str_message,'negative');
    }
}
function nm_prod_recover_password($tipo,$option=""){
    global $nm_config;
    $file = $nm_config['path_conf'].'prod.rec.conf.php';
    $rec_int_file = $nm_config['path_conf'].'prod.rec.conf.txt';
    $rec_int_time = strtotime(date("Y-m-d H:i:s")).'|1';
    $str_content = strtr(file_get_contents( $file ), array('<?php /*' => '', '*/?>' => ''));
    $arr_data    = unserialize(trim($str_content));
    $v_value     = decode_string($arr_data[0]);
    $v_value_2   = (isset($arr_data[1]) ? decode_string($arr_data[1]): '' );
    if(!empty($option)){
        $v_value = $v_value_2;
        $v_value_2 = $option;
    }
    $param = array($v_value,$v_value_2);
    if(!nm_get_time()){
        file_put_contents($rec_int_file,$rec_int_time);
        $response = nm_webservice($tipo,$param);
    }else{
        $rec_int = nm_get_time();
        if($rec_int[1] >= 5){
            if(nm_calc_time($rec_int[0]) == false ){
                $response = false;
            }else{
                $rec_int[0]   = strtotime(date("Y-m-d H:i:s"));
                $rec_int[1]   = 1;
                $rec_int_time = implode('|',$rec_int);
                $response = nm_webservice($tipo,$param);
                file_put_contents($rec_int_file,$rec_int_time);
            }
        }else{
            $rec_int[0]   = strtotime(date("Y-m-d H:i:s"));
            $rec_int[1]   = (int)$rec_int[1]+1;
            $rec_int_time = implode('|',$rec_int);
            $response = nm_webservice($tipo,$param);
            file_put_contents($rec_int_file,$rec_int_time);
        }
    }
    return $response;
}
function nm_calc_time($str_time){
    $h = 60 * 60;
    $t = strtotime(date("Y-m-d H:i:s"));
    if(($t - $str_time) >= $h){
        return true;
    }else{
        return false;
    }
}
function nm_get_time(){
    global $nm_config;
    $f = $nm_config['path_conf'].'prod.rec.conf.txt';
    $r = false;
    if(is_file($f)){
        $c = file_get_contents($f);
        $r = explode('|',$c);
    }
    return $r;
}
function nm_webservice($tipo,$options=array()){
    global $nm_config;
    if($tipo == 'recover_password'){
        $params = array
        (
            'data'  => json_encode
                        (
                            array
                            (
                                'action'        => $tipo,
                                'email'         => $options[0],
                                'server_name'   => htmlentities((isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : $_SERVER['SERVER_ADDR']), ENT_QUOTES),
                                'path'          => htmlentities($nm_config['path_conf'], ENT_QUOTES),
                                'version'       => htmlentities(nm_prod_get_version(), ENT_QUOTES),
                                'os'            => htmlentities(php_uname(), ENT_QUOTES),
                                'date'          => strtotime(date('Y-m-d H:i:s')),
                            )
                        ),
            'rem_lang'      => strtolower(str_replace('-','_',$_SESSION['nm_session']['prod_v8']['lang'])),
        );
        $request = true;
    }else if($tipo == 'check_recover_password'){
        if(!empty($options[1])){
            $params = array
            (
                'data' =>   json_encode
                            (
                                array
                                (
                                    'action'    => $tipo,
                                    'prod_code' => $options[0],
                                    'user_code' => $options[1],
                                )

                            )
            );
            $request = true;
        }else{
            $request = false;
        }
    }else{
        $request = false;
    }
    if($request){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$nm_config['prod_service']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($ch));
        curl_close($ch);
    }else{
        $response = false;
    }
    return $response;
}
function nm_exclude_browser(){
    $user_agent     = $_SERVER['HTTP_USER_AGENT'];
    $style_display  = "";
    if (strpos($user_agent, 'Edg') !== false) {
        $style_display = "display:none;";
    }

    return $style_display;
}
?>