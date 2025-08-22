<?php

/* Classes ancestrais */
nm_load_class('page', 'Page');

/* Definicao da classe */
class nmPageProdLogin extends nmPage{
    /* ----- Construtor e Destrutor ------------------------------------ */
    
    /**
     * Construtor da classe.
     *
     * Seta o nome da pagina a ser exibida.
     *
     * @access  public
     * @global  array $nm_config Array de configuracao do ScriptCase.
     */
    function __construct()
    {
        
        $this->doAjax();
        $this->SetBody('nmPage');
        $this->SetMargin(10);
        $this->SetPage('ProdLogin');
        $this->iniSession();
        $this->SetPageSubtitle('');
        
    } // nmPageMenu
    
    function doAjax(){
        $str_response = "";
        
        if(empty($_POST)){
            header('Location: ../../nm_ini_manager2.php');
        }
        if(isset($_POST['ajax']) && $_POST['ajax'] == 'nm'){
            switch($_POST['nm_action']){
                case 'login':
                    $str_response = $this->checkFirstAccess();
                break;
                case 'change_language':
                    $str_response = $this->changeLanguage($_POST['lang']);
                break;
                case 'change_pass':
                    $str_response = $this->changePass($_POST['pass_new'],$_POST['pass_conf'],$_POST['lang'],$_POST['email'],$_POST['captcha']);
                break;
                default:
                    $str_response = $this->checkFirstAccess();
            }
            echo $str_response;
            exit;
        }
    }
    
    function iniSession(){  
        $_SESSION['nm_session']['prod_v8']['login']['is_page'] = true; 
        
        if (!isset($_SESSION['nm_session']['prod_v8'])) {
            $_SESSION['nm_session']['prod_v8'] = array('logged' => FALSE);
        }
        
        if (isset($_GET['login']) && isset($_SESSION['nm_session']['cache']['prod_v8'])) {
            unset($_SESSION['nm_session']['cache']['prod_v8']);
            
            if (isset($_SESSION['nm_session']['prod_v8']['logged'])) {
                unset($_SESSION['nm_session']['prod_v8']['logged']);
            }
        }
        
        $_SESSION['nm_session']['prod_v8']['login']['version']  = $this->nm_prod_get_version();
        $_SESSION['nm_session']['prod_v8']['login']['toggle']   = $this->nm_exclude_browser();
        
        $_SESSION['nm_session']['prod_v8']['login']['lang']     = $this->nm_prod_list_lang();
        $_SESSION['nm_session']['prod_v8']['login']['default']  = $this->getDefaultLang();
        
        
        if(!is_file($this->getDirConf().'prod.config.php') && !is_file($this->getDirConf() . 'prod.pub.dir.php') && is_dir("../../../_app_data"))
        {
            $str_file  = "<?php\r\n";
            $str_file .= '$sc_arr_system_dir = array();'."\r\n";
            $str_file .= '$sc_arr_system_dir[] = array("0" => "'.str_replace('\\','/',dirname(dirname(dirname(dirname(dirname(getcwd())))))).'");'."\r\n";
            file_put_contents($this->getDirConf() . 'prod.pub.dir.php',$str_file);   
        }

    }

    function nm_unserialize_ini($ini_file)
    {
        $arr_prod_tmp = array();
        if(is_file($ini_file)) {
            $str_prod = file_get_contents($ini_file);
            if (substr($str_prod, 0, 8) == '<?php /*') {
                $str_prod = substr($str_prod, 8, -5);
            }

            $arr_prod_tmp = unserialize($str_prod);
        }
        return $arr_prod_tmp;
    }

    function checkFirstAccess(){
        $arr_ini = $this->nm_unserialize_ini($this->getDirConf().'prod.config.php');

        if(is_file($this->getDirConf().'prod.config.php') &&  (isset($arr_ini['GLOBAL']['PASSWORD']) && !empty($arr_ini['GLOBAL']['PASSWORD']))){
            $str_response = array('result' => 'login');
        }else{
            $str_response = array('result' => 'new_pass');
        }
        return json_encode($str_response);
    }
    
    function changePass($str_pass_new='',$str_pass_conf='',$str_lang='',$str_email='',$str_captcha=''){
        if(!$_SESSION['nm_session']['prod_v8']['login']['is_page']){
            $str_response  = "";
        }else{
            include($this->getDirProd().'/lib/php/nm_ini_lib.php');
            include($this->getDirProd().'/lib/php/nm_serialize.php');
            $str_lang   = str_replace('-','_',$str_lang);
            if($str_lang == "es_es" || $str_lang == "en_us" || $str_lang == "pt_br"){
                include($this->getDirProd().'/lib/php/devel/lang/'.$str_lang.'/ProdLogin.lang.php');
            }else{
                include($this->getDirProd().'/lib/php/devel/lang/en_us/ProdLogin.lang.php');
            }
            if(isset($_SESSION['nm_session']['prod_v8']['login']['captcha_text']) && $_SESSION['nm_session']['prod_v8']['login']['captcha_text'] == $str_captcha){
                $str_error  = "";
                if(empty($str_pass_new)){
                    $str_error = $nm_lang['pass_empty'];
                }elseif(empty($str_pass_conf)){
                    $str_error = $nm_lang['pass_conf_empty'];
                }elseif(empty($str_lang)){
                    $str_error = $nm_lang['error_lang_file_invalid'];
                }elseif($str_pass_new != $str_pass_conf){
                    $str_error = $nm_lang['error_profile_password_conf'];
                }else{
                    $temMaiuscula   = false;
                    $temMinuscula   = false;
                    $temNumeros     = false;
                    $temTamanho     = false;
                    $email_check    = true;
                    for ($i = 0; $i < strlen($str_pass_new); $i++) {
                        if (ctype_upper($str_pass_new[$i])) {
                            $temMaiuscula = true;
                        } elseif (ctype_lower($str_pass_new[$i])) {
                            $temMinuscula = true;
                        }elseif(ctype_digit($str_pass_new[$i])) {
                            $temNumeros = true;
                        }
                    }
                    if (strlen($str_pass_new) >= 8) {
                        $temTamanho = true;
                    }
                    if (!$temMaiuscula || !$temMinuscula || !$temNumeros || !$temTamanho) {
                        $str_error = $nm_lang['error_password_invalid'];
                    }else{
                        if(!empty($str_email)){
                            if (filter_var($str_email, FILTER_VALIDATE_EMAIL)) {
                                $email_check = true;
                                $v_file = $this->getDirConf()."prod.rec.conf.php";
                                if(is_file($v_file)){
                                    @unlink($v_file);
                                }
                                $v_email = array( encode_string_utf8(trim($str_email)));
                                file_put_contents($v_file, '<?php /*'.serialize($v_email).'*/?>');
                            }else{
                                $email_check = false;
                            }
                        }
                        if(!$email_check){
                            $str_error = $nm_lang['error_password_email'];
                        }else{
                            $str_pass_new  = trim($str_pass_new);
                            $str_pass_conf = trim($str_pass_conf);
                            
                            $str_ini = $this->getDirConf() . 'prod.config.php';
                            $arr_ini = nm_unserialize_ini($str_ini);
                            
                            
                            $arr_ini['GLOBAL']['LANGUAGE'] = $_SESSION['nm_session']['prod_v8']['lang'] = str_replace('_','-',$str_lang);
                            $arr_ini['GLOBAL']['PASSWORD'] = encode_string_utf8($str_pass_new);
                            $str_xml = nm_serialize_ini($arr_ini);
                            salva_xml($str_ini, $str_xml, $arr_ini);
                            
                            $_SESSION['nm_session']['prod_v8']['logged'] = true;
                            $str_response = array('result' => 'success');
                        }
                    }
                }
            }else{
                $str_error = $nm_lang['pass_captcha_error'];
            }
            if(!empty($str_error)){
                $str_response = array('result' => 'error', 'message' => $str_error);
            }
        }
        return json_encode($str_response);
    }
    
    function getDirProd()
    {
        $dir = dirname(dirname(dirname(dirname(dirname(__DIR__)))));
        return $dir;
    }
    
    function getDirConf(){
        $dir = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))).DIRECTORY_SEPARATOR.'conf'.DIRECTORY_SEPARATOR;
        return $dir;
    }
    
    function getDefaultLang(){
        if(is_file($this->getDirConf().'languague')){
            $str_return = trim(file_get_contents(getDirConf().'languague'));
        }else{
            $str_nav_lang = trim(strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)));
            switch($str_nav_lang){
                case 'pt':
                    $str_return = 'pt-br';
                    break;
                case 'es':
                    $str_return = 'es-es';
                    break;
                default:
                    $str_return = 'en-us';
                
            }
        }
        return $str_return;
        
    }
    
    function nm_prod_list_lang()
    {
        $path_lib = $this->getDirProd().'/lib/php/';
        $arr_lang = array();
        $res_dir = @opendir($path_lib);
        if ($res_dir) {
            while (FALSE !== ($str_file = @readdir($res_dir))) {
                if ('.' != $str_file && '..' != $str_file &&
                    'lang.' == substr($str_file, 0, 5) &&
                    '.php' == substr($str_file, -4) &&
                    @is_file($path_lib . $str_file)
                    ) {
                        $str_lang = substr($str_file, 5, -4);
                        $arr_data = @file($path_lib . $str_file);
                        $arr_lang[$str_lang] = trim(substr($arr_data[1], 2));
                    }
            }
            @closedir($res_dir);
        }
        return $arr_lang;
        
    } // nm_prod_list_lang
    
    function changeLanguage($str_option){
        $str_langs = array();
        $str_option = str_replace('-','_',$str_option);
        if($str_option == "es_es" || $str_option == "en_us" || $str_option == "pt_br"){
            include($this->getDirProd().'/lib/php/devel/lang/'.$str_option.'/ProdLogin.lang.php');
        }else{
            include($this->getDirProd().'/lib/php/devel/lang/en_us/ProdLogin.lang.php');
        }
        $str_langs['result']                    =   'success';
        $str_langs['lang_login_header']         =   $nm_lang['sc_prod'];
        $str_langs['lang_login_pass_email']     =   $nm_lang['form_pass_email'];
        $str_langs['lang_login_pass_new']       =   $nm_lang['form_pass_new'];
        $str_langs['lang_login_pass_conf']      =   $nm_lang['form_pass_conf'];
        $str_langs['lang_login_pass_language']  =   $nm_lang['form_language'];
        $str_langs['lang_login_help']           =   $nm_lang['form_pass_help_title'];
        $str_langs['nm_help_pass_first']        =   $nm_lang['form_pass_help_desc_1'];
        $str_langs['nm_help_pass_second']       =   $nm_lang['form_pass_help_desc_2'];
        $str_langs['nm_help_pass_third']        =   $nm_lang['form_pass_help_desc_3'];
        $str_langs['nm_help_pass_four']         =   $nm_lang['form_pass_help_desc_4'];
        $str_langs['nm_help_pass_five']         =   $nm_lang['error_password_email'];
        $str_langs['nm_help_pass_six']          =    $nm_lang['form_pass_help_desc_6'];
        $str_langs['loginbutton']               =   $nm_lang['button_save'];
        $str_langs['copyright']                 =   $nm_lang['copyright_label'];
        $str_langs['version']                   =   $nm_lang['version'];
        $str_langs['captcha_placeholder']       =   $nm_lang['form_pass_captcha_placeholder'];
        $str_langs['title']                     =   "ScriptCase :: ".$nm_lang['sc_prod'];
        
        if (extension_loaded('gd') && function_exists('gd_info')) {
            $str_langs['md_info_header']            =   $nm_lang['info_page_pass_welcome'];
            $str_langs['md_info_cnt_first']         =   $nm_lang['info_page_pass_first'];
            $str_langs['md_info_cnt_sec']           =   $nm_lang['info_page_pass_second'];
            $str_langs['md_info_btn']               =   $nm_lang['info_page_pass_btn'];
        }else{
            $str_langs['md_info_header']            =   $nm_lang['info_page_pass_welcome'];
            $str_langs['md_info_cnt_first']         =   $nm_lang['info_page_gd'];
            $str_langs['md_info_cnt_sec']           =   "";
            $str_langs['md_info_btn']               =   $nm_lang['button_close'];
        }
        
        return json_encode($str_langs);
    }
    
    function loadLanguage($str_option){
        $str_option = str_replace('-','_',$str_option);
        if($str_option == "es_es" || $str_option == "en_us" || $str_option == "pt_br"){
            include($this->getDirProd().'/lib/php/devel/lang/'.$str_option.'/ProdLogin.lang.php');
        }else{
            include($this->getDirProd().'/lib/php/devel/lang/en_us/ProdLogin.lang.php');
        }
    }
    
    
    function nm_prod_get_version()
    {
        $ver = "UNKNOWN";
        if(is_file(dirname(dirname(dirname(__DIR__))).'/prod.dat'))
        {
            $ver = file_get_contents(dirname(dirname(dirname(__DIR__))).'/prod.dat');
        }
        
        if(is_file(dirname(dirname(dirname(__DIR__))).'/build.dat')){
            $ver .= ' Build: '.file_get_contents(dirname(dirname(dirname(__DIR__))).'/build.dat');
        }
        
        return $ver;
    }
    
    function nm_exclude_browser(){
        $user_agent     = $_SERVER['HTTP_USER_AGENT'];
        $style_display  = "";
        if (strpos($user_agent, 'Edg') !== false) {
            $style_display = "display:none;";
        }
        
        return $style_display;
    }
    /**
     * Exibe o conteudo.
     *
     * Exibe o conteudo da tela inicial do ScriptCase.
     *
     * @access  protected
     * @global  object     $nm_template  Objeto para exibicao de templates.
     */
    function DisplayContent()
    {
        global $nm_template, $nm_lang;
        
        $nm_template->Display('body_prod_login');
    } // DisplayContent
    /**
     * Define funcoes Javascript da pagina.
     *
     * Define a lista de funcoes Javascript especificos da pagina atual.
     *
     * @access  protected
     * @global  array $nm_config Array de configuracao do ScriptCase.
     * @global  array $nm_lang Array de idioma.
     */
    function PageJavascript()
    {
        global $nm_lang;
        $this->AddJavascript("document.title = ' ScriptCase :: ".$nm_lang['sc_prod']."';");
    } // PageJavascript
    
    /**
     * Define arquivos JS da pagina.
     *
     * Define a lista de arquivos JS especificos da pagina atual.
     *
     * @access  protected
     */
    function PageJs()
    {
        
        $this->AddJs('third', 'jquery/js/jquery.js');
        $this->AddJs('third', 'semantic-ui/semantic.min.js');
    } // PageJs
    
    /**
     * Define folhas de estilo da pagina.
     *
     * Define a lista de folhas de estilo especificas da pagina atual.
     *
     * @access  protected
     */
    function PageStyle()
    {
        global $scBaseUrl;
        $this->AddStyleCss('third', 'font-awesome/6/css/all.min.css');
        $this->AddStyleCss('third', 'semantic-ui/semantic.min.css');
        $this->AddStyle("body,html{margin:0;padding:0;height:100%;width:100%;background:url(../../../../img/bgLogin.jpg) 0 0/cover #bfd1e3}.nmFormField{display:flex;justify-content:center;align-items:flex-start;flex-flow:column nowrap}#footer_info{display:flex;flex-direction:row;align-items:center;justify-content:center;position:fixed;bottom:0;left:0;width:100vw;color:#efefef9c;font-size:12px;background:rgba(29,46,61,.67);height:40px;padding:0 20px}#footer_info .spacer{flex-grow:1}");
        $this->AddStyle(".nm_help_red{color:red!important}.nm_help_green{color:green!important}.login-container{min-width:560px;max-width:560px;position:relative;margin:0 auto;background-color:#fff;border-radius:4px;padding:1.5rem 0 0;box-sizing:border-box;}.group{padding:0 1.5rem}.bullet.item::before {content: '\\2022'; margin-right: 0.1rem;}");
        
    } // PageStyle
}