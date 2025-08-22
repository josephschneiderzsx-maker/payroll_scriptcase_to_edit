<?php

/* Classes ancestrais */
nm_load_class('page', 'Page');

/* Definicao da classe */

class nmPageOutdatedApps extends nmPage
{
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
        $this->SetPage('OutdatedApps');
        $this->CheckLogin();
        $this->SetPageSubtitle('');
    } // nmPageMenu
    function doAjax()
    {
        $_SESSION['nm_session']['prod_v8']['outdated_apps']['is_pub_dir_list']           = false;
        $_SESSION['nm_session']['prod_v8']['outdated_apps']['is_pub_dir_app_list']       = false;
        $_SESSION['nm_session']['prod_v8']['outdated_apps']['outdated_apps']             = array();
        $this->getDocLinks($_SESSION['nm_session']['prod_v8']['lang']);
        
        
        
        $str_response = "";
        if (isset($_POST['ajax']) && $_POST['ajax'] == 'nm') {
            switch($_POST['nm_action']){
                case 'refresh':
                    $str_response = $this->getPubDirApps($_POST['param']);
                    break;
                case 'list_apps':
                    $this->getAppList($_POST['dir']);
                    break;
                case 'user_action':
                    $str_response = $this->manageAppSolution($_POST['tipo'],$_POST['app'],$_POST['qtd']);
                    break;
                default:
                    break;
            }
            echo $str_response;
            exit;
        }else if(isset($_POST['option']) && $_POST['option'] == 'outdated_apps' && $_POST['opt_par'] == ''){
            $this->getPubDirList();
        }else if(isset($_POST['option']) && $_POST['option'] == 'outdated_apps' && $_POST['opt_par'] == 'list_apps'){
            $_SESSION['nm_session']['prod_v8']['outdated_apps']['is_pub_dir_app_list']  = true;
        }else{
            $this->getPubDirList();
        }
    }
    
    function getPubDirList(){
        $_SESSION['nm_session']['prod_v8']['outdated_apps']['is_pub_dir_list']  = true;
        $_SESSION['nm_session']['prod_v8']['outdated_apps']['scan_date']        = "";
        $_SESSION['nm_session']['prod_v8']['outdated_apps']['pub_dir']          = "";
        $_SESSION['nm_session']['prod_v8']['outdated_apps']['pub_dir_apps']     = "";
        $_SESSION['nm_session']['prod_v8']['outdated_apps']['outdated_apps']    = "";
        $_SESSION['nm_session']['prod_v8']['outdated_apps']['scan_apps']        = "";
        $_SESSION['nm_session']['prod_v8']['outdated_apps']['outdated']['obsolete_apps'] = array();
        if(!isset($_SESSION['nm_session']['prod_v8']['outdated_apps']['outdated'])){
            $_SESSION['nm_session']['prod_v8']['outdated_apps']['outdated']     = array();
        }
        $str_file = $this->getPubDirConfFile();
        if(is_file($str_file)){
            include($str_file);
            $_SESSION['nm_session']['prod_v8']['outdated_apps']['pub_dir'] = $sc_arr_system_dir;
        }
    }
    
    function getPubDirApps($p_option=array()){
        $_SESSION['nm_session']['prod_v8']['outdated_apps']['is_pub_dir_list']  = true;
        $prod_version = $this->getProdVersion();
        $conf_file    = $this->getPubDirConfFile();
        if(is_file($conf_file)){
            $obsolete_apps = array();
            $total_apl = array();
            $scan_arr  = array();
            include($conf_file);
            foreach($p_option as $key => $value){
                $dir = $sc_arr_system_dir[$value][0];
                $_SESSION['nm_session']['prod_v8']['outdated_apps']['outdated'][$value] = array();
                if(is_dir($dir)){
                    $sc_folder = $this->isScFolder($dir);
                    $ini_dir = $dir."/_lib/_app_data/";
                    if(is_dir($ini_dir)){
                        $arr_files = array_diff(scandir($ini_dir), ['.', '..']);
                        foreach($arr_files as $file){
                            if(strpos($file,'mob_ini.php') === false){
                                include($ini_dir.$file);
                                $temp_apl = $arr_data['apl'];
                                if($temp_apl != $arr_data['friendly_url']){
                                    $temp_apl = $arr_data['friendly_url'];
                                }
                                if(is_dir($dir.'/'.$temp_apl)){
                                    if(trim($arr_data['prod_version']) != trim($prod_version)){
                                        $_SESSION['nm_session']['prod_v8']['outdated_apps']['outdated'][$value][$temp_apl] = $arr_data['prod_version'].'@@'.$prod_version;
                                    }else{
                                        if( is_file($dir.'/'.$temp_apl.'/'.$temp_apl.'_ini.txt')){
                                            unlink ($dir.'/'.$temp_apl.'/'.$temp_apl.'_ini.txt');
                                        }
                                        if( is_file($dir.'/'.$temp_apl.'/'.$temp_apl.'_mob_ini.txt')){
                                            unlink ($dir.'/'.$temp_apl.'/'.$temp_apl.'_mob_ini.txt');
                                        }
                                        if( is_file($dir.'/'.$temp_apl.'/'.$temp_apl.'_img.txt')){
                                            unlink ($dir.'/'.$temp_apl.'/'.$temp_apl.'_img.txt');
                                        }
                                        if( is_file($dir.'/'.$temp_apl.'/'.$temp_apl.'_mob_img.txt')){
                                            unlink ($dir.'/'.$temp_apl.'/'.$temp_apl.'_mob_img.txt');
                                        }
                                    }
                                }else{
                                    $_SESSION['nm_session']['prod_v8']['outdated_apps']['outdated'][$value][$temp_apl] = "_folder_not_found_@@".$prod_version;
                                }
                            }
                        }
                    }
                    
                }
                $obsolete_apps[$value]          = $this->checkObsoleteApps($dir);
                $total_apl[$value]              = count($_SESSION['nm_session']['prod_v8']['outdated_apps']['outdated'][$value])+count($obsolete_apps[$value]);
                $scan_arr[$value]               = date('d/m/Y H:i:s');
                $sc_arr_system_dir[$value][1]   = $scan_arr[$value];
                $sc_arr_system_dir[$value][2]   = $total_apl[$value];
                if(isset($_SESSION['nm_session']['prod_v8']['outdated_apps']['outdated'][$value])){
                    $sc_arr_system_dir[$value][3] = $_SESSION['nm_session']['prod_v8']['outdated_apps']['outdated'][$value];
                }else{
                    $sc_arr_system_dir[$value][3] = "";
                }
                foreach( $obsolete_apps[$value] as $key => $item ){
                    $sc_arr_system_dir[$value][3][$key] = $item.'@@'.$prod_version;
                }
                
                $sc_arr_system_dir[$value][4] = $obsolete_apps[$value];
                $sc_arr_system_dir[$value][5] = $sc_folder;
            }
            unlink($conf_file);
            $str_file  = '<?php '."\r\n";
            $str_file .= '$sc_arr_system_dir = array();'."\r\n";
            foreach($sc_arr_system_dir as $key => $item){
                $str_file .= '$sc_arr_system_dir[] = array(';
                $str_file .= '"0" => "'.$item[0].'",';
                $str_file .= '"1" => "'.(isset($item[1]) ? $item[1]: '').'",';
                $str_file .= '"2" => "'.(isset($item[2]) ? $item[2]: '').'",';
                $str_file .= '"3" => array(';
                if(isset($item[3])){
                    foreach($item[3] as $k => $value){
                        $str_file .= '"'.$k.'" => "'.$value.'",';
                    }
                }
                $str_file .= '),';
                $str_file .= '"4" => array(';
                if(!empty($item[4])){
                    foreach($item[4] as $k => $value){
                        $str_file .= '"'.$k.'" => "'.$value.'",';
                    }
                    
                }
                $str_file .= '),';
                $str_file .= '"5" => "'.$item[5].'",';
                $str_file .= ');'."\r\n";
            }
            file_put_contents($conf_file,$str_file);
            
            $v_response = json_encode([
                'status' => 'ok',
                'apps' => $total_apl,
                'scan' => $scan_arr
            ]);
        }else{
            $v_response = json_encode([
                'status' => 'error'
            ]);
        }
        return $v_response;
    }
    
    function checkObsoleteApps($str_dir){
        $arr_temp       = array();
        $pub_dir 		= $str_dir;
        $new_apps_dir 	= $str_dir."/_lib/_app_data/";
        $pub_apps 		= array_diff(scandir($pub_dir),array('.','..'));
        if(is_dir($new_apps_dir)){
            $new_apps 		= array_diff(scandir($new_apps_dir),array('.','..'));
            foreach($new_apps as $key => $apps){
                $new_apps[$key] = str_replace('_ini.php','',$apps);
            }
            $old_apps = array_diff($pub_apps,$new_apps);
            foreach($old_apps as $app){
                if(is_file($pub_dir.'/'.$app.'/'.$app.'_ini.txt')){
                    $arr_temp[$app] = '_app_obsolete_';
                }
            }
        }else{
            foreach($pub_apps as $app){
                if(is_file($pub_dir.'/'.$app.'/'.$app.'_ini.txt')){
                    $arr_temp[$app] = '_app_obsolete_';
                }
            }
        }
        return $arr_temp;
    }
    
    function isScFolder($str_dir){
        $response = 'false';
        if(is_file($str_dir.'/_lib/lib/php/fix.php')){
            $response = 'true';
        }
        return $response;
    }
    
    function getObsoleteApps($str_option){
        $arr_temp = array();
        $conf_file = $this->getPubDirConfFile();
        if(is_file($conf_file)){
            include($conf_file);
            if(isset($sc_arr_system_dir[$str_option][4])){
                $arr_temp = $sc_arr_system_dir[$str_option][4];
            }
        }
        $_SESSION['nm_session']['prod_v8']['outdated_apps']['outdated']['obsolete_apps'] = $arr_temp;
    }
    
    function getAppList($str_opt){
        $_SESSION['nm_session']['prod_v8']['outdated_apps']['pub_dir_apps'] = "";
        
        $conf_file = $this->getPubDirConfFile();
        if(is_file($conf_file)){
            include($conf_file);
        }
        if(isset($sc_arr_system_dir[$str_opt])){
            $_SESSION['nm_session']['prod_v8']['outdated_apps']['pub_dir_apps'] = $sc_arr_system_dir[$str_opt];
        }
        
        $this->getObsoleteApps($str_opt);
        $_SESSION['nm_session']['prod_v8']['outdated_apps']['is_pub_dir_app_list']       = true;
    }
    
    function getPubDirConfFile()
    {
        global $nm_config;
        return $nm_config['path_conf'].'prod.pub.dir.php';
        
    }
    
    function getProdVersion(){
        global $nm_config;
        $str_file = $nm_config['path_prod'].'prod.dat';
        if(is_file($str_file)){
            $version = file_get_contents($str_file);
        }else{
            $version = '10';
        }
        
        return $version;
    }
    
    function getDocLinks($str_lang){
        $_SESSION['nm_session']['prod_v8']['outdated_apps']['links'] = array();
        if($str_lang == 'pt-br'){
            $_SESSION['nm_session']['prod_v8']['outdated_apps']['links']['prod_new'] = 'https://www.scriptcase.com.br/lp/ambiente/producao/#compatible';
            $_SESSION['nm_session']['prod_v8']['outdated_apps']['links']['deploy']   = 'https://www.scriptcase.com.br/docs/pt_br/v9/manual/12-publicacao/01-visao-geral/';
        }else if($str_lang == 'es-es'){
            $_SESSION['nm_session']['prod_v8']['outdated_apps']['links']['prod_new'] = 'https://www.scriptcase.net/lp/environment/prod-es/';
            $_SESSION['nm_session']['prod_v8']['outdated_apps']['links']['deploy']   = 'https://www.scriptcase.net/docs/es_es/v9/manual/12-deploy/01-general-view/';
        }else{
            $_SESSION['nm_session']['prod_v8']['outdated_apps']['links']['prod_new'] = 'https://www.scriptcase.net/lp/environment/prod/';
            $_SESSION['nm_session']['prod_v8']['outdated_apps']['links']['deploy']   = 'https://www.scriptcase.net/docs/en_us/v9/manual/12-deploy/01-general-view/';
        }
    }
    function manageAppSolution($str_tipo,$str_app,$str_key){
        global $nm_lang;
        $this->LoadLang('OutdatedApps');
        if(trim($str_tipo) == '_folder_not_found_'){
            if(isset($_SESSION['nm_session']['prod_v8']['outdated_apps']['pub_dir'][$str_key][0])){
                $dir      = $_SESSION['nm_session']['prod_v8']['outdated_apps']['pub_dir'][$str_key][0];
                $ini_file = $dir.'/_lib/_app_data/'.trim($str_app);
                if(is_file($ini_file.'_ini.php')){
                    unlink($ini_file.'_ini.php');
                    if(is_file($ini_file.'_mob_ini.php')){
                        unlink($ini_file.'_mob_ini.php');
                    }
                    
                    $p_response = $this->getPubDirApps(array($str_key));
                    $p_response = json_decode($p_response,true);
                    if($p_response['status'] == 'ok'){
                        $this->getAppList($str_key);
                        $response = json_encode(['result' => 'success', 'message' => $nm_lang['outdate_apps_app_deleted'], 'option' => $str_key ]);
                    }else{
                        $response = json_encode(['result' => 'error', 'message' => $nm_lang['outdate_apps_general_err'] ]);
                    }
                }else{
                    $response = json_encode(['result' => 'error', 'message' => $nm_lang['outdate_apps_general_err'] ]);
                }
            }else{
                $response = json_encode(['result' => 'error', 'message' => $nm_lang['outdate_apps_dir_err'] ]);
            }
            
        }else{
            $response = json_encode(['result' => 'error', 'message' => $nm_lang['outdate_apps_general_err'] ]);
        }
        return $response;
    }
    
    
    /**
     * Exibe o conteudo.
     *
     * Exibe o conteudo da tela inicial do ScriptCase.
     *
     * @access  protected
     * @global  object $nm_template Objeto para exibicao de templates.
     */
    function DisplayContent()
    {
        global $nm_template, $nm_lang;
        $nm_template->Display('body_outdated_apps');
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
        $this->AddStyleCss('third', 'semantic-ui/semantic.min.css');
        $this->AddStyleCss('third', 'font-awesome/6/css/all.min.css');
        
    } // PageStyle
}