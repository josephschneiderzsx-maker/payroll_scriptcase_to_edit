<?php

if(empty($_POST)){
    exit;
}

if (!isset($scBaseUrl)) {
    $scBaseUrl = '../../';
    $scSuffixUrl = '';
}
/**
 * $Id: nm_ini_manager3.php,v 1.8 2012-02-07 21:26:50 vinicius Exp $
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

$arr_dbms = nm_prod_dbms();
$arr_error = array();
$arr_argv = nm_prod_argv();
$nm_config = nm_prod_path();
$str_option = '';
nm_prod_lang();
require($nm_config['path_lib'] . 'lang.' . $_SESSION['nm_session']['prod_v8']['lang'] . '.php');

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
if (('' != $str_option) && ('login' != $str_option) && !$_SESSION['nm_session']['prod_v8']['logged']) {
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

    function paypal_auth_api($clientID, $clientSecret)
    {
        global $nm_config;
        $_SESSION['scriptcase']['nm_path_prod'] =  $nm_config['path_prod'];
        include_once(__DIR__.'/nm_api.php');

        $arr_settings = [
            'gateway' => 'paypal_rest',
            'settings' =>
                [
                    'clientId' => $clientID,
                    'secret' => $clientSecret,
//                'token'	=> $token,
                    'testMode' => false
                ]
        ];

        $gateway = sc_call_api('', $arr_settings);
        return $gateway->getToken();
    }


if($arr_argv['option'] == 'code_page'){
    $_SESSION['nm_session']['prod_v8']['logged'] = false;
    $str_option = 'code_page';
}
if($arr_argv['option'] == 'recover_password'){
    $_SESSION['nm_session']['prod_v8']['logged'] = false;
    $str_option = 'change_pass_page';
}
// Processa formulario
switch ($str_option) {
    case 'code_page':
        //guardar codigo no prod.rec.conf.php
        //verificar se já existe código criado, se nao, deve cria-lo: 
        $response = json_decode(nm_prod_recover_password('recover_password'));
        $str_option = 'code_page';
    break;
    case 'change_pass_page':
        //obter codigo no prod.rec.conf.php
        //enviar o codigo junto do valor do input que o usuario vai usar.
        // codigo do arquivo + $arr_argv['field_pass_code']
        $response = json_decode(nm_prod_recover_password('check_recover_password',$prod_code,$arr_argv['field_pass_code']));
        if($response->result != 200){
                $_SESSION['nm_session']['prod_v8']['error_message_type']         = 'negative';
                $_SESSION['nm_session']['prod_v8']['error_message_msg']          = 'Erro ao comunicar-se como webservice';
                $str_option = 'code_page';
        }else{
            if($v_check_code->code == true){
                $str_option = 'change_pass_page';
            }else{
                $_SESSION['nm_session']['prod_v8']['error_message_type']         = 'negative';
                $_SESSION['nm_session']['prod_v8']['error_message_msg']          = 'Codigo invalido';
                $str_option = 'code_page';
            }
        }
    break;
    case 'gd_auth_api':
                    echo gd_auth_api($_REQUEST['app_name'], $_REQUEST['json_oauth'], '', false, $_REQUEST['gateway']);
exit;
        break;
    case 'paypal_auth_api':
                    echo paypal_auth_api($_REQUEST['clientId'], $_REQUEST['secret']);
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

        if(!empty($arr_argv['opt_par']) && $arr_argv['opt_par'] == 'conf_rec_pass'){
            if (!$temMaiuscula || !$temMinuscula || !$temNumeros || !$temTamanho) {
                $arr_error[] = 'error_password_invalid';
                break;
            }
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
            }else if ($str_pwd_old != $str_pwd_ini) {
                $arr_error[] = 'error_password_invalid';
            } elseif (('' == $str_pwd_new) || ('scriptcase' == $str_pwd_new)) {
                $arr_error[] = 'error_password_reserved';
            } elseif ($str_pwd_new != $str_pwd_conf) {
                $arr_error[] = 'error_password_confirm';
            }else if($str_pwd_old == $str_pwd_new){
                $arr_error[] = 'error_password_old_new';
            } else {
                $arr_ini['GLOBAL']['LANGUAGE'] = $_SESSION['nm_session']['prod_v8']['lang'];
                $arr_ini['GLOBAL']['PASSWORD'] = encode_string_utf8($str_pwd_new);
                $str_xml = nm_serialize_ini($arr_ini);

                salva_xml($str_ini, $str_xml, $arr_ini);

                if (isset($_POST['hid_login']) && $_POST['hid_login'] == 'S') {
                    $str_option = 'main_menu';
                } else {
                    $str_option = "msg";
                    $b_reenviar = false;
                    $str_message = $nm_lang['msg_change_pass_ok'];
                }
            }
        }
        if (isset($arr_argv['field_pass_email'])) {
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

                $str_option = "environment";
                $str_show_success_msg = true;
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

            $max_api = 1;
            foreach($arr_profiles as $profile => $data)
            {
                if($_REQUEST['opt_par'] != '-1' && $data['id'] == $_REQUEST['opt_par'])
                {
                    unset($arr_profiles[$profile]);
                }
                elseif($data['id'] >= $max_api)
                {
                    $max_api = $data['id'];
                }
            }
            $max_api++;
            $gw = explode('__NM__', $_REQUEST['gateway']);
            if($gw[1] == 'google_drive'|| $gw[1] == 'google_sheets'){
                        $_SESSION['scriptcase']['nm_path_prod'] =  $nm_config['path_prod'];
                        include_once(__DIR__ . "/nm_api.php");
                        $token_code = gd_auth_api($_REQUEST[ $gw[1] ]['app_name'], $_REQUEST[ $gw[1] ]['json_oauth'], $_REQUEST[ $gw[1] ]['auth_code'], true, $gw[1]);
                        $_REQUEST[ $gw[1] ]['token_code'] = $token_code;
                    }

            $arr_profiles[ $_REQUEST['name'] ] = [
                                                    'id' => ($_REQUEST['opt_par'] != '-1')?$_REQUEST['opt_par']:$max_api,
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
            
            $str_show_success_msg = true;
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
        $response = nm_prod_recover_password('check_recover_password', $_SESSION['nm_session']['prod_v8']['authcode']->code);
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
        nm_prod_display_login('scriptcase','change_pass');
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
        if(isset($str_show_success_msg) && $str_show_success_msg == true){
            $str_show_success_msg = false;
        ?>
        	<script>
        		$("#id_modal_success").modal({
                	blurring: true,
                	onHide: function(){
                		parent.nm_set_option('main_menu','','_top');
                	},
                }).modal('show');
        	</script>
        <?php
        }else{
            nm_prod_display_environment();
        }
        break;
    // Exibe login
    case 'login':
        nm_prod_display_login(decode_string($arr_ini['GLOBAL']['PASSWORD']));
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
        if(isset($str_show_success_msg) && $str_show_success_msg == true){
        ?>
        	<script>
        		$("#id_modal_success").modal({blurring: true,}).modal('show');
        	</script>
        <?php
        }
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
        nm_prod_display_login(decode_string($arr_ini['GLOBAL']['PASSWORD']));
        break;
}
nm_prod_display_footer();

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
        <div class="ui container" style="padding-top: 2rem;">
            <div class="ui grid">
                <div class="left floated twelve wide column" style="text-align: left;">
                    <h3><?php echo $nm_lang['change_pass']; ?></h3>
                </div>
                <div class="right two wide column" style="display: flex; flex-direction: row; justify-content: flex-end; align-items: center;" >
                    <?php nm_display_page_help('prod_change_pswd'); ?>
                </div>
            </div>
            <div class="ui divider"></div>  
        </div>    
        <div class="ui container">
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
        <div class="six wide field">
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
        <button id="prod-change-password" class="ui button primary"  onclick="nm_set_option('change_pass', '', 'nm_iframe')">
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
        <div id="id_modal_general_error" class="ui modal tiny">
            
            <div class="ui header red" style="display:none">
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
            $('#id_modal_general_error').modal({blurring: true}).modal('show');
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
    <div class="ui container" style="padding-top: 2rem;">
        <div class="ui grid">
            <div class="left floated twelve wide column" style="text-align: left;">
                <h3><?php echo $nm_lang['main_environment']; ?></h3>
            </div>
            <div class="right floated two wide column" style="display: flex; flex-direction: row; justify-content: flex-end; align-items: center;">
                <?php nm_display_page_help('prod_setting'); ?>
            </div>
        </div>
        <div class="ui divider"></div>  
    </div>    
    <div class="ui container">
        <div class="field">
            <label><?php echo $nm_lang['form_gc_dir']; ?></label>
            <input type="text" name="field_gc_dir" value="<?php echo $arr_ini['GLOBAL']['GC_DIR']; ?>">
        </div>
        <div class="field">
            <label><?php echo $nm_lang['form_gc_dir_cache']; ?></label>
            <input type="text" name="field_cache_gc_dir" value="<?php echo $arr_ini['GLOBAL']['CACHE_GC_DIR']; ?>">
        </div>
        <div class="three fields">
            <div class="seven wide field">
                <label><?php echo $nm_lang['form_pdf_server']; ?></label>
                <input type="text" name="field_pdf_server_wkhtml" value="<?php echo $arr_ini['GLOBAL']['PDF_SERVER_WKHTML']; ?>">
            </div>
            <div class="field">
                <label><?php echo $nm_lang['form_gc_min']; ?></label>
                <input type="text" name="field_gc_min" value="<?php echo $arr_ini['GLOBAL']['GC_MIN']; ?>">
            </div>
            <div class=" field">
                <label><?php echo $nm_lang['form_gc_min_cache']; ?></label>
                <input type="text" name="field_cache_gc_min" value="<?php echo $arr_ini['GLOBAL']['CACHE_GC_MIN']; ?>">
            </div>
        </div>
        <div class="three fields">
            <div class=" field">
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
            <div class=" field">
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
            <div class="eight wide field">
                <label><?php echo $nm_lang['form_googlemaps_api_key']; ?></label>
                <input type="text" name="field_googlemaps_api_key" value="<?php echo(isset($arr_ini['GLOBAL']['GOOGLEMAPS_API_KEY']) ? $arr_ini['GLOBAL']['GOOGLEMAPS_API_KEY'] : ""); ?>">
            </div>
        </div>

        <button class="ui button primary" onclick="nm_set_option('environment', '', 'nm_iframe')"><?php echo $nm_lang['button_save']; ?></button>
    </div>
<?php
} // nm_prod_display_environment

function nm_prod_display_footer()
{
    global $nm_lang;
    ?>
    </div>
    </div>
    </form>
    <div class="ui modal tiny" id="id_modal_confirm_delete">
        <div class="header" style="display:none"><i class="fa confirm-icon fa-exclamation-triangle" style="color: rgb(255, 154, 23);"></i></div>
            <div id="id_modal_confirm_delete_content" class="content">
            <h4><?php echo $nm_lang['confirm_delete_preprofile']; ?></h4>
        </div>
        <div class="actions">
            <div class="ui cancel button"><?php echo $nm_lang['button_cancel']; ?></div>
            <div class="ui approve button primary"><?php echo $nm_lang['recover_password_button_code']; ?></div>
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
<div class="ui modal tiny" id="id_modal_success">
    <div class="content" id="id_modal_success_content">
    	<h4><?php echo $nm_lang['recover_mail_save_ok']; ?></h4>
    </div>
    <div class="actions">
        <div class="ui button primary cancel small"><?php echo $nm_lang['button_close']; ?></div>
    </div>
</div>
<form name="form_prod" action="<?php echo nm_prod_url_rand($nm_config['url_lib'] . $scSuffixUrl . 'nm_ini_manager3.php'); ?>"
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
        $(document).ready(function(){
            $("#butotnmodalclose").click(function(){
                $('.ui.modal').modal('hide');
            });
            $("#back-api").click(function(e){
                e.preventDefault();
                document.form_prod.option.value = 'api';
                document.form_prod.target       = 'nm_iframe';
                document.form_prod.submit();
            });
            $("#prod-change-password").removeAttr('onclick');
            $("#prod-change-password").addClass('disabled');
            $("[name='field_pass_new']").on('input',function() {
                nm_validar_pass($(this));
            });
            $("[name='field_pass_conf']").on('input',function(){
                nm_validar_pass($(this));
                if($("[name='field_pass_conf']").val() == $("[name='field_pass_new']").val()){
                    $('#nm_help_pass_four').removeClass('nm_help_red').addClass('nm_help_green');
                }else{
                    $('#nm_help_pass_four').removeClass('nm_help_green').addClass('nm_help_red');
                }
            });
            $("[name='field_pass_old']").on('input',function(){
                nm_valida_input($(this));
            });
            function nm_valida_input(input){
                if(input.val().length > 0 ){
                    nm_validar_pass($("[name='field_pass_new']"));
                    nm_validar_pass($("[name='field_pass_conf']"));
                    //$("#prod-change-password").attr("onclick","nm_set_option('change_pass', '', 'nm_iframe')");
                    //$("#prod-change-password").removeClass('disabled');
                }else{
                    $("#prod-change-password").removeAttr("onclick");
                    $("#prod-change-password").addClass('disabled');
                }
            }
            function nm_validar_pass(field) {
                if(field.val().length == 0 || field.val() == ''){
                    $('#nm_help_pass_first').removeClass('nm_help_green').addClass('nm_help_red');
                    $('#nm_help_pass_second').removeClass('nm_help_green').addClass('nm_help_red');
                    $('#nm_help_pass_third').removeClass('nm_help_green').addClass('nm_help_red');
                    $("#prod-change-password").removeAttr("onclick");
                    $("#prod-change-password").addClass('disabled');
                }else{
                    var check_length,check_letter,check_num = false;
                    var possuiMaiuscula = /[A-Z]/.test(field.val());
                    var possuiMinuscula = /[a-z]/.test(field.val());
                    var possuiNumeros   = /\d/.test(field.val());
                    if (field.val().length >= 8) {
                        $('#nm_help_pass_first').removeClass('nm_help_red').addClass('nm_help_green');
                        check_length = true;
                    } else {
                        $('#nm_help_pass_first').removeClass('nm_help_green').addClass('nm_help_red');
                    }
                    if (possuiMaiuscula && possuiMinuscula) {
                        $('#nm_help_pass_second').removeClass('nm_help_red').addClass('nm_help_green');
                        check_letter = true;
                    }else{
                        $('#nm_help_pass_second').removeClass('nm_help_green').addClass('nm_help_red');
                    }
                    if (possuiNumeros) {
                        $('#nm_help_pass_third').removeClass('nm_help_red').addClass('nm_help_green');
                        check_num = true;
                    }else{
                        $('#nm_help_pass_third').removeClass('nm_help_green').addClass('nm_help_red');
                    }

                    if(check_length == true && check_letter == true && check_num == true){
                        if($("[name='field_pass_conf']").val() == $("[name='field_pass_new']").val() && $("[name='field_pass_conf']").val() != '' && $("[name='field_pass_new']").val() != ''){
                            $('#nm_help_pass_four').removeClass('nm_help_red').addClass('nm_help_green');
                            $("#prod-change-password").attr("onclick","nm_set_option('change_pass', '', 'nm_iframe')");
                            $("#prod-change-password").removeClass('disabled');
                        }else{
                            $("#prod-change-password").removeAttr('onclick');
                            $("#prod-change-password").addClass('disabled');
                            $('#nm_help_pass_four').removeClass('nm_help_green').addClass('nm_help_red');
                        }
                    }else{
                        $("#prod-change-password").removeAttr("onclick");
                        $("#prod-change-password").addClass('disabled');
                    }

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
                document.form_prod.option.value = 'change_pass';
            }

        });

        function confirmDeleteProfile(var_id) {
    		event.stopPropagation();
    		event.preventDefault();
    		$("#id_modal_confirm_delete_content").html("<h4><?php echo $nm_lang['confirm_delete_preprofile']; ?></h4>");
            $("#id_modal_confirm_delete").modal({
                blurring: true,
                onApprove: function(){
                    nm_set_option('api_delete_profile', var_id, 'nm_iframe');
                },
            }).modal('show');
        }

        function confirmDeletePreProfile(str_opt, str_par, str_target)
        {
            if(confirm("<?php echo $nm_lang['confirm_delete_preprofile']; ?>") == true)
            {
                nm_set_option(str_opt, str_par, str_target);
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

            else
            {
                document.form_prod.action = "<?php echo nm_prod_url_rand($nm_config['url_lib'] . $scSuffixUrl . 'nm_ini_manager3.php'); ?>";
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
                        oWin = window.open("<?php echo $nm_config['url_lib'] . $scSuffixUrl; ?>nm_ini_manager3.php?option=test", "winTestConn", "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=300,height=200");
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
                            oWin = window.open("<?php echo $nm_config['url_lib'] . $scSuffixUrl; ?>nm_ini_manager3.php?option=test&profile=" + sSel, "winTestConn", "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=300,height=200");
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
    $ver = "9.1";
    if(is_file("ver.dat"))
    {
        $ver = file_get_contents("ver.dat");
    }
    return $ver;
}





function nm_prod_display_connections_pendent()
{
    global $nm_config, $nm_lang;
    $arr_new_conn = nm_prod_get_pending_connections();
    ?>
    <div class="ui container" style="padding-top: 2rem;">
    	<?php 
	    if (empty($arr_new_conn)) { 
	    ?>
	    
    	<div class="ui grid">
            <div class="left floated twelve wide column" style="text-align: left;">
                <h3><?php echo $nm_lang['main_profile_pending']; ?></h3>
            </div>
            <div class="right two wide column" style="display: flex; flex-direction: row; justify-content: flex-end; align-items: center;">
                <?php nm_display_page_help('prod_peding_conn'); ?>
            </div>
        </div>
    	<div class="ui divider"></div>  
    </div>
    <div class="ui container">
    	<div class="ui message">
          <p><?php echo $nm_lang['profile_pending_ok']; ?></p>
        </div>
	    <?php
	    }else{
	    ?>
        <div class="ui grid">
            <div class="left floated twelve wide column" style="text-align: left;">
                <h3><?php echo $nm_lang['main_warn_conn']; ?></h3>
            </div>
            <div class="right two wide column" style="display: flex; flex-direction: row; justify-content: flex-end; align-items: center;">
                <?php nm_display_page_help('prod_peding_conn'); ?>
            </div>
        </div>
        <div class="ui divider"></div>
     </div>
   	 <div class="ui container">
            <div class="ui seven cards" style="padding-top: .875rem;">

            <?php 
            if (!empty($arr_new_conn)) {
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
                        <a href="javascript: confirmDeletePreProfile('delete_preprofile', '<?php echo $str_new_conn; ?>', 'nm_iframe')" class="ui mini button red"><i class="trash icon"></i> <?php echo $nm_lang['button_delete']; ?></a>
                </div>
            </div>
            <?php
                }
            } 
	    } 
	    ?>
    </div>
    <script>
    	$(document).ready(function(){
    		window.parent.$(".item-menu").each(function(){
                $(this).removeClass('active');
            });
            window.parent.$("#peding_conn").addClass('active');
    	})
    </script>
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
        <div class="ui container" style="padding-top: 2rem;">
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
        <div class="ui container" style="padding-top: 2rem;">
        		<div class="ui grid">
        			<div class="left floated twelve wide column" style="text-align: left;">
    					<h3><?php echo $nm_lang['profile_rename']; ?></h3>
    				</div>
        			<div class="right floated two wide column" style="display: flex; flex-direction: row; justify-content: flex-end; align-items: center;">
                    	<?php nm_display_page_help('prod_rename_conn'); ?>
                    </div>
        			
        		</div>
        		<div class="ui divider"></div>
        </div>
        
           <div class="ui container">
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
    <div class="ui container" style="padding-top: 2rem;">
        <div class="ui grid">
            <div class="left floated twelve wide column" style="text-align: left;">
                <h3><?php echo $nm_lang['main_api']; ?></h3>
            </div>
            <div class="right two wide column" style="display: flex; flex-direction: row; justify-content: flex-end; align-items: center;">
                <?php nm_display_page_help('prod_api'); ?>
            </div>
        </div>
        <div class="ui divider"></div>  
    </div>    
    <div class="ui container">
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
                    <td data-label="id"><?php echo $profile['id']; ?></td>
                    <td data-label="name"><?php echo $profile['name']; ?></td>
                    <td data-label="gateway"><?php echo $profile['gateway']; ?></td>
                    <td data-label="action">
                    <button class="ui icon button tiny" title="<?php echo $nm_lang['button_edit']; ?>" onclick="javascript:nm_set_option('api_edit_profile', '<?php echo $profile['id'] ?>', 'nm_iframe')"><i class="icon edit"> </i></button>
                    <button class="ui icon button red tiny" title="<?php echo $nm_lang['button_delete']; ?>"
                    onclick="confirmDeleteProfile('<?php echo $profile['id'] ?>');"><i class="icon trash"></i></button>
                    </td>
                </tr>
            <?php $i++; endforeach; ?>
        </tbody>
    </table>
    <button class="ui button green" onclick="nm_set_option('api_add_profile', '', 'nm_iframe')">
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
    .field-error{ border-color:#e0b4b4 !important; background-color: #fff6f6 !important; color: #9f3a38 !important;}
</style>
<script src="../../third/jquery/js/jquery.js"></script>
<script src="../../third/semantic-ui/semantic.js"></script>

<script>
    function toggePass(el){
        $(el).toggleClass('slash');
        if ($(el).closest('div.input').find('input').get(0).type == 'password') {
            $(el).closest('div.input').find('input').get(0).type = 'text';
        } else {
            $(el).closest('div.input').find('input').get(0).type = 'password';
        }
    }
function openAuthGoogle(){
            var gateway = $('select[name=gateway]').val().split('__NM__')[1];
            var app_name = $('input[name="'+gateway+'[app_name]"]').val();
            var json_oauth = $('textarea[name="'+gateway+'[json_oauth]"]').val();
            $.post('nm_ini_manager3.php','nm_ajax=1&option=gd_auth_api&app_name='+app_name+'&json_oauth='+json_oauth+'&gateway='+ gateway, function(str_return){
                            window.open(str_return, '_blank');
                        } );
        }

        function authPaypal(){
            var gateway = $('select[name=gateway]').val().split('__NM__')[1];
            var clientId = $('input[name="'+gateway+'[clientId]"]').val();
            var secret = $('input[name="'+gateway+'[secret]"]').val();
            if(clientId == '' || secret == ''){
                return;
            }
            $.post(nm_url_iface + 'prj_api.php?nm_ajax=1&nm_option=paypal_auth_api&clientId=' + clientId + '&secret='+secret, function(str_return){
                            $('input[name="'+gateway+'[token]"]').val(str_return);
                        } );
        }
</script>
        <div>
            <div class="ui container" style="padding-top: 2rem;">
            	<div class="ui grid">
                    <div class="left floated twelve wide column" style="text-align: left;">
                        <h3><?php echo $nm_lang['hint_api']; ?></h3>
                    </div>
                    <div class="right two wide column" style="display: flex; flex-direction: row; justify-content: flex-end; align-items: center;">
                        <?php nm_display_page_help('prod_api_setting'); ?>
                    </div>
                </div>
                <div class="ui divider"></div>
            </div>
				<div class="ui container">
            <!-- <form method="post" action="nm_ini_manager3.php" class="ui form">
                <input type="hidden" name="option" value="api_save"> -->
                <input type="hidden" name="api_id" value="<?php echo $api['id']; ?>">
                <input type="hidden" name="new_flag" value="<?php echo $new_flag; ?>">
                <div class="two fields">
                    <div class=" field">
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
                    <div class=" field">
                        <label><?php echo $nm_lang['name']; ?></label>
                        <input name="name" required="required" id="id_name_api"
                                       placeholder="<?php echo $nm_lang['name']; ?>"
                                       value="<?php echo $name_default; ?>">
                    </div>
                </div>
                <?php
                foreach ($arr_gateways as $type => $arr_gw_data):
                    foreach ($arr_gw_data as $k => $gw_data):
                ?>
                        <div id="id_gw_<?php echo $k; ?>" class="gw" <?php echo($k == $gateway_default ? "style='display:block'" : ""); ?>>
                            <?php
                            foreach ($gw_data as $k_field_name => $k_value):
                                $number_words = [
                                    1 => 'one',
                                    2 => 'two',
                                    3 => 'three',
                                    4 => 'four',
                                    5 => 'five',
                                    6 => 'six',
                                    7 => 'seven',
                                    8 => 'eight',
                                    9 => 'nine',
                                    10 => 'ten',
                                    11 => 'eleven',
                                    12 => 'twelve',
                                    13 => 'thirteen',
                                    14 => 'fourteen',
                                    15 => 'fifteen',
                                    16 => 'sixteen',
                                ];

                            $col_num = $number_words[count($k_value)];
                        ?>

                            <div class="<?php echo $col_num; ?> fields">
                                <?php
                                foreach ($k_value as $field_name => $value):
                        ?>
                                <div class=" field" style="<?php echo ($value['type'] == 'textarea'? "width:100%" : ""); ?>">
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
                                        <div class="ui action input">
                                            <input type="text"  name="<?php echo $k; ?>[<?php echo $field_name; ?>]" required="required" <?=$on_change?>
                                               placeholder="<?php echo  $nm_lang['api_gw_sett'][$field_name ."_placeholder"]; ?>" style="width: 84%;"
                                               value="<?php echo(isset($api['settings'][$field_name]) ? $api['settings'][$field_name] : '') ?>"/>
                                                <button class="ui button primary" onclick="openAuthGoogle();">Auth</button>
                                        </div>
                                    <?php elseif( isset($value['type']) && $value['type'] == 'paypal_auth_code'): ?>
                                        <div class="ui action input">
                                            <input type="text"  name="<?php echo $k; ?>[<?php echo $field_name; ?>]" <?=$on_change?> class="form-control"
                                                   placeholder="<?php echo  nm_get_text_lang("['api_gw_sett']['". $field_name ."_placeholder']"); ?>"
                                                   value="<?php echo(isset($api['settings'][$field_name]) ? $api['settings'][$field_name] : '') ?>"
            />
                                            <button class="ui button primary" onclick="authPaypal();"><?php echo nm_get_text_lang("['auth']"); ?></button>
                                        </div>
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
                        </div>
                <?php endforeach; ?>
                <?php endforeach; ?>
                <button id="back-api" class="ui button" style="margin-top: 1rem;" ><?php echo $nm_lang['button_back']; ?></button>
                <input type="button" class="ui button primary" style="margin-top: 1rem;" value="<?php echo $nm_lang['button_save']; ?>" onclick="nm_set_option('api_save', '<?php echo (isset($api['id'])?$api['id'] : -1) ; ?>', 'nm_iframe')">
           <!--  </form> -->

            <script>
                //$('select').dropdown();
            </script>
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

        $_SESSION['nm_session']['prod_v8']['lang'] = $str_accept;
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

    return $arr_config;
} // nm_prod_path

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
        <div class="ui container" style="padding-top: 2rem;">
            <div class="ui  success message" style="display: block;">
                <?php echo $str_msg; ?>
            </div>
        </div>
    <?php
    }
}//nm_show_msg


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
 		<div class="ui container" style="padding-top: 2rem;">
            <div class="ui grid">
                <div class="left floated twelve wide column" style="text-align: left;">
                    <h3><?php echo $nm_lang['main_smtp_setting']; ?></h3>
                </div>
                <div class="right two wide column" style="display: flex; flex-direction: row; justify-content: flex-end; align-items: center;">
                    <?php nm_display_page_help('prod_pswd_recover'); ?>
                </div>
            </div>
            <div class="ui divider"></div>  
        </div>    
        <div class="ui container">
            <form class="ui form">
                <div class="ten wide field">
                    <label>Email</label>
                    <input type="text" name="recover_mail" placeholder="example@example.com" value="<?php echo $v_value; ?>" required='required'>
            </div>
                <button class="ui button primary" onclick="nm_set_option('recover_mail_save', '', 'nm_iframe');"><?php echo $nm_lang['button_save']; ?></button>
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
function nm_prod_recover_password($tipo,$code=""){
    return nm_webservice($tipo,$code);
}
function nm_show_message($str_message="",$str_type='success'){
    ?>
        <div class="ui container" style="padding-top: 2rem;">
            <div class="ui <?php echo $str_type; ?> message" style="display: block;">
                <?php echo $str_message; ?>
            </div>
        </div>
    <?php
}
function nm_webservice($tipo,$code=""){
    global $nm_config;
    $file = $nm_config['path_conf'].'prod.rec.conf.php';
    $str_content = strtr(file_get_contents( $file ), array('<?php /*' => '', '*/?>' => ''));
    $arr_data    = unserialize(trim($str_content));
    $v_value     = decode_string($arr_data[0]);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://dev-webservice.scriptcase.com.br/prodservicev9/nm_prod_service_v9.php");
    if($tipo == 'recover_password'){
        $params = 
            [

                'token'     => 'TESTE_RONYAN',
                'action'    => $tipo,
                'name'      => (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : $_SERVER['SERVER_ADDR']),
                'path'      => $nm_config['path_conf'],
                'version'   => nm_prod_get_version(),
                'mail'      => $v_value,
                'os'        => php_uname(),
                'date'      => strtotime(date('Y-m-d H:i:s')),
            ];
    }else if($tipo == 'check_recover_password'){
        $params = 
            [   
                'action'    => $tipo,
                'code'      => $code
            ];
    }
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,array('data' => json_encode($params)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
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
function nm_prod_display_main_menu($b_msg){
    ?>
        <script>
            document.form_prod.action="nm_ini_manager2.php";
            document.form_prod.target='_top';
            document.form_prod.submit();
        </script>
    <?php
}
function nm_display_page_help($str_page){
    if(isset($_SESSION['nm_session']['prod_v8']['help'][$str_page])){
        echo '<a href="'.$_SESSION['nm_session']['prod_v8']['help'][$str_page].'" target="_blank"><i class="fa fa-question-circle" aria-hidden="true" style="font-size:1.2rem;"></i></a>';
    }else{
        echo "['help']['$str_page']";
    }
}
?>