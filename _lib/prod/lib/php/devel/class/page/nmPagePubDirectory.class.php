<?php 

/* Classes ancestrais */
nm_load_class('page', 'Page');

/* Definicao da classe */
class nmPagePubDirectory extends nmPage
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
        $this->SetPage('PubDirectory');
        $this->CheckLogin();
        $this->SetPageSubtitle('');
        $this->getOSPath();
    } // nmPageMenu

    function doAjax()
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] == 'nm') {
            $response = array('result' => 'success', 'double' => 'true');
            switch ($_POST['nm_action'])
            {
                case 'pub_dir_save':
                    if(!empty($_POST['data']) && is_array($_POST['data'])){
                        $response = $this->savePubDir($_POST['data']);
                    }
                    break;
                case 'pub_dir_del':
                    if(isset($_POST['data']) && !empty($_POST['data'])){
                        $response = $this->delPubDir($_POST['data']);
                    }
                    break;
                case 'check_dir':
                    if(isset($_POST['data']) && !empty($_POST['data'])){
                        $response = $this->checkPubDir($_POST['data']);
                    }
                    break;
                case 'check_double_dir':
                    if(isset($_POST['data']) && !empty($_POST['data'])){
                        $response = $this->checkDoubleDir($_POST['data']);
                    }
                    break;
                case 'check_is_sc_folder':
                    if(isset($_POST['data']) && !empty($_POST['data'])){
                       $response = array('result' => 'success', 'sc_dir' => $this->isScFolder($_POST['data']));
                    }
                    break;
                default:
                    break;
            }
            echo json_encode($response);
            exit;
        }
        else if(isset($_POST['option']) && $_POST['option'] == 'pub_dir')
        {
            echo $this->listPubDir();
        }
    }
    
    function savePubDir($arr_data = array())
    {
        $_SESSION['nm_session']['prod_v8']['pub_dir']['dir_data'] = "";
        $response   = array('result' => 'error');
        $conf_file  = $this->getPubDirConfFile();
        if(is_file($conf_file))
        {
            include($conf_file);
            unlink($conf_file);
        }
        $str_file = '<?php '."\r\n";
        $str_file .= '$sc_arr_system_dir = array();'."\r\n";
        $arr_data = array_unique($arr_data);
        foreach($arr_data as $key => $item ){
            $exists = false;
            if(!empty($item)){
                if( strlen($item) != 1 ){
                    $ult_char = substr($item, -1);
                    if ($ult_char === '/' || $ult_char === '\\') {
                        $item = substr($item, 0, -1);
                    }
                }
                $item = trim(str_replace('\\','/',$item));
                if(isset($sc_arr_system_dir)){
                    foreach($sc_arr_system_dir as $j => $value){
                        if(trim($value[0]) == $item){
                            $exists = true;
                            $position = $j;
                        }
                    }
                }
                //$str_file .= '$sc_arr_system_dir[] = array("0" => "'.str_replace('\\','/',$item).'");'."\r\n";
                $str_file .= '$sc_arr_system_dir[] = array(';
                if(isset($item[0])){
                    $str_file .= '"0" => "'.$item.'",';
                    $str_file .= '"5" => "'.$this->isScFolder($item).'",';
                }
                if($exists){
                    if(isset($sc_arr_system_dir[$position][1])){
                        $str_file .= '"1" => "'.$sc_arr_system_dir[$position][1].'",';
                    }else{
                        $str_file .= '"1" => "",';
                    }
                    if(isset($sc_arr_system_dir[$position][2])){
                        $str_file .= '"2" => "'.$sc_arr_system_dir[$position][2].'",';
                    }else{
                        $str_file .= '"2" => "",';
                    }
                    
                    $str_file .= '"3" => array(';
                    if(isset($sc_arr_system_dir[$position][3])){
                        foreach($sc_arr_system_dir[$position][3] as $k => $item){
                            $str_file .= '"'.$k.'" => "'.$item.'",';
                        }
                    }
                    $str_file .= '),';
                    
                    $str_file .= '"4" => array(';
                    if(isset($sc_arr_system_dir[$position][4])){
                        foreach($sc_arr_system_dir[$position][4] as $k => $item){
                            $str_file .= '"'.$k.'" => "'.$item.'",';
                        }
                    }
                    $str_file .= '),';
                    if(isset($sc_arr_system_dir[$position][5])){
                        $str_file .= '"5" => "'.$sc_arr_system_dir[$position][5].'",';
                    }else{
                        $str_file .= '"5" => "'.$this->isScFolder($item).'",';
                    }
                }
                $str_file .= ');'."\r\n";
            }
        }
        $_SESSION['nm_session']['prod_v8']['pub_dir']['dir_data'] = $arr_data;
        file_put_contents($conf_file,$str_file);
        $response   = array('result' => 'success');
        return  $response;
        
    }
    
    function delPubDir($str_option){        
        $response   = array('result' => 'error');
        $dir_path   = $str_option;
        if( strlen($dir_path) != 1 ){
            $ult_char = substr($dir_path, -1);
            if ($ult_char === '/' || $ult_char === '\\') {
                $dir_path = substr($dir_path, 0, -1);
            }
        }
        $dir_path = str_replace('\\','/',$dir_path);
        $conf_file  = $this->getPubDirConfFile();
        include($conf_file);
        foreach($sc_arr_system_dir as $key => $item){
            if(trim($item[0]) == trim($dir_path)){
                unset($sc_arr_system_dir[$key]);
                break;
            }
        }
        unlink($conf_file);
        $str_file = '<?php'."\r\n";
        $str_file .= '$sc_arr_system_dir = array();'."\r\n";
        foreach($sc_arr_system_dir as $key => $item){
            $str_file .= '$sc_arr_system_dir[] = array(';
            if(isset($item[0])){
                $str_file .= '"0" => "'.str_replace('\\','/',$item[0]).'",';
            }
            if(isset($item[1])){
                $str_file .= '"1" => "'.$item[1].'",';
            }else{
                $str_file .= '"1" => "",';
            }
            if(isset($item[2])){
                $str_file .= '"2" => "'.$item[2].'",';
            }else{
                $str_file .= '"2" => "",';
            }
            $str_file .= '"3" => array(';
            if(isset($item[3])){
                foreach($item[3] as $k => $value){
                    $str_file .= '"'.$k.'" => "'.$value.'",';
                }
            }
            $str_file .= '),';
            $str_file .= '"4" => array(';
            if(isset($item[4])){
                foreach($item[4] as $k => $value){
                    $str_file .= '"'.$k.'" => "'.$value.'",';
                }
            }
            $str_file .= '),';
            if(isset($item[5])){
                $str_file .= '"5" => "'.$item[5].'",';
            }else{
                $str_file .= '"5" => "",';
            }
            $str_file .= ');'."\r\n";
        }
        file_put_contents($conf_file,$str_file);
        $response   = array('result' => 'success');
        return $response;
    }
    
    function listPubDir()
    {
        $_SESSION['nm_session']['prod_v8']['pub_dir']['dir_data'] = "";
        $conf_file   = $this->getPubDirConfFile();
        $deploy_path = $this->getDirTipicalDeploy();
        if(is_file($conf_file)){
            include($conf_file);
            $_SESSION['nm_session']['prod_v8']['pub_dir']['dir_data'] = $sc_arr_system_dir;
        }else{
            if($this->isTipicalDeploy()){
                $response  = $this->savePubDir(array($deploy_path));
                if($response['result'] == 'success'){
                    $_SESSION['nm_session']['prod_v8']['pub_dir']['dir_data'] = array ( array("0" => $deploy_path, "5" => 'true') );
                }
            }
        }
    }
    
    function checkPubDir($str_path){
        $response   = array('result' => 'error','is_dir' => 'false');
        if(!empty($str_path[0]) && is_dir($str_path[0])){
            $response   = array('result' => 'success','is_dir' => 'true');
        }else{
            $response   = array('result' => 'success','is_dir' => 'false');
        }
        return $response;
    }
    
    function checkDoubleDir($str_path){
        $response   = array('result' => 'error_general');
        $dir_path   = $str_path;
        if( strlen($dir_path) != 1 ){
            $ult_char = substr($dir_path, -1);
            if ($ult_char === '/' || $ult_char === '\\') {
                $dir_path = substr($dir_path, 0, -1);
            }
        }
        $str_path = str_replace('\\','/',$dir_path);
        $conf_file  = $this->getPubDirConfFile();
        if(is_file($conf_file)){
            $bool_exists = false;
            include($conf_file);
            foreach($sc_arr_system_dir as $item){
                if($item[0] == $str_path){
                    $bool_exists = true;
                }
            }
            if($bool_exists){
                $response = array('result' => 'success', 'double' => 'true');
            }else{
                $response = array('result' => 'success', 'double' => 'false');
            }
        }else{
            $response = array('result' => 'success', 'double' => 'false' );
        }
        return $response;
        
    }
    
    function isScFolder($str_dir){
        $response = 'false';
        if(is_file($str_dir.'/_lib/lib/php/fix.php')){
            $response = 'true';
        }
        return $response;
    }
    
    function isTipicalDeploy()
    {
        $response = false;
        $dir = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
        if(is_file($dir.'/lib/php/fix.php')){
            $response = true;
        }
        return $response;
    }
    
    function getDirTipicalDeploy()
    {
        $dir = dirname(dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
        return $dir;
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

        $nm_template->Display('body_pub_dir');
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
        $this->AddStyleCss('third', 'font-awesome/6/css/all.min.css');
        $this->AddStyleCss('third', 'semantic-ui/semantic.min.css');
        $this->AddStyle("   .nmIconSize{font-size: 1.2rem}");
    } // PageStyle
    
    function getPubDirConfFile()
    {
        global $nm_config;
        return $nm_config['path_conf'].'prod.pub.dir.php';
        
    }
    
    function getOSPath(){
        $_SESSION['nm_session']['prod_v8']['pub_dir']['placeholder'] = "";
        if(!defined(PHP_OS)){
            $str_os = php_uname();
        }else{
            $str_os = PHP_OS;
        }
        
        if(strpos(strtolower($str_os),'darwin') !== FALSE){
            $str_return = '/Applications/Scriptcase/v9-php81/wwwroot/appdir';
        }elseif(strpos(strtoupper($str_os),'WIN')  !== FALSE){
            $str_return = 'C:\Program Files (x86)\NetMake\v9\wwwroot\appdir';
        }else{
            $str_return = '/opt/NetMake/v9-php81/wwwroot/appdir';
        }
        $_SESSION['nm_session']['prod_v8']['pub_dir']['placeholder']  = $str_return;
    }
}
?>