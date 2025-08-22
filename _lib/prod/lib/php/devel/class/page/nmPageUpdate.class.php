<?php

/* Classes ancestrais */
nm_load_class('page', 'Page');

/* Definicao da classe */

class nmPageUpdate extends nmPage
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
        $this->SetPage('Update');
        $this->CheckLogin();
        $this->SetPageSubtitle('');
        $this->updateMe();
    } // nmPageMenu

    function doAjax()
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] == 'nm') {
            $str_retorno = "";
            switch ($_POST['nm_action']) {
                case 'check_version':
                    $str_retorno = $this->check_version();
                    break;
                case 'update':
                    $str_retorno = $this->update();
                    break;
                case 'check_update':
                    $str_retorno = $this->updateMe();
                    break;
                default:
                    break;
            }
            echo $str_retorno;
            exit;
        }
    }

    function getDirProd()
    {
        $dir = dirname(dirname(dirname(dirname(dirname(__DIR__)))));
        return $dir;
    }

    function getUrlService()
    {
        $dir = $this->getDirProd();
        $url = "webservice.scriptcase.com.br";
        if (file_exists($dir . '/is_dev')) {
            $url = "dev-webservice.scriptcase.com.br";
        }
        return $url;
    }

    function check_version()
    {
        global $nm_lang;

        $this->LoadLang('Update');
        $dir = $this->getDirProd();
        $url = $this->getUrlService();

        $str_request = $this->nm_xml_send($url . "/produpdservicev9/nm_prod_upd_service_v9.php", ['data' => json_encode(['action' => 'checkVersion'])]);
        if ($str_request === false) {
            return json_encode(['status' => 'error']);
        }
        $service_data = json_decode($str_request, true);

        $version    = file_get_contents($dir .'/lib/php/prod.dat');
        $build      = file_get_contents($dir .'/lib/php/build.dat');

        if($version != $service_data['version']){
            return json_encode(['status' => 'outdated', 'msg' => $nm_lang['outdated_message_version']]);
        }
        if($build != $service_data['build']){
            return json_encode(['status' => 'outdated', 'msg' => $nm_lang['outdated_message_build']]);
        }
        return json_encode(['status' => 'updated']);

    }
    function update()
    {
        global $nm_config;
        
        $dir = $this->getDirProd();
        $url = $this->getUrlService();

        $str_request = $this->nm_xml_send($url . "/produpdservicev9/nm_prod_upd_service_v9.php", 'POST');
        if($str_request === false) {
            return json_encode(['status' => 'error']);
        }
        $__tmp = preg_split("/\r\n|\n|\r/", $str_request);

        $arr_files = $this->searchFiles($dir, $dir . '/');

        $arr_file_update = [];
        $arr_file_news = [];
        foreach ($__tmp as $file) {
            $file = explode('_!NM!_', $file);
            if(empty($file[0])) {
                continue;
            }
            if (isset($arr_files[$file[0]])) {
                if ($arr_files[$file[0]] != $file[1]) {
                    $arr_file_update[] = $file[0];
                }
                unset($arr_files[$file[0]]);
                continue;
            }
            $arr_file_news[] = $file[0];
        }
        $prod_update_log = 'prod_update_' . date('YmdHis') . '.log';
        $log_file = $dir . '/../tmp/'.$prod_update_log;
        $fr = @fopen($log_file, 'a');
        @fputs($fr, "******   LOG PROD UPDATE   ******\n");
        foreach ($arr_files as $file => $trash) {
            if($file == 'is_dev' || substr($file, 0, 5) == '/conf') {
                unset($arr_files[$file]);
                continue;
            }

            $path_file = $dir . '/' . $file;
            if(is_file($path_file)) {
                $log_msg = " => Deleted\n";
                if (!@unlink($path_file)) {
                    $log_msg = " => Failed to Delete\n";
                }
                @fputs($fr, $file . $log_msg . PHP_EOL);
            }
            //delete empty folders
            if($trash == 'dir'){
                unset($arr_files[$file]);
            }
            $thisdir = is_dir($path_file) ? $path_file : dirname($path_file);

            while(count(scandir($thisdir)) == 2){
                $log_msg = " => Deleted\n";
                if (!@rmdir($thisdir)) {
                    $log_msg = " => Failed to Delete\n";
                }
                @fputs($fr, $thisdir . " (empty dir)" . $log_msg . PHP_EOL);
                $thisdir = dirname($thisdir);
            };
        }
        @fclose($fr);

        $this->getFilesService($arr_file_news, $log_file);
        $this->getFilesService($arr_file_update, $log_file);

        return json_encode([
            'status' => 'ok',
            'deleted' => count($arr_files),
            'updated' => count($arr_file_update) + count($arr_file_news),
            'changelog' => $nm_config['url_prod'].'../../../tmp/'.$prod_update_log,
        ]);
    }

    function getFilesService($arr_files, $log_file ='')
    {

        $dir = $this->getDirProd();
        $url = $this->getUrlService();

        $accept_gz = extension_loaded('zlib') ? true : false;

        $data = http_build_query([
            'data' => json_encode([
                'action' => 'getFiles',
                'accept_gz' => $accept_gz,
                'arr_files' => base64_encode(json_encode($arr_files))
            ])
        ]);

        $context_options = array(
            'http' => array(
                'method' => "POST",
                'header' => "Content-type: application/x-www-form-urlencoded\r\n"
                    . "Content-Length: " . strlen($data) . "\r\n",
                'content' => $data,
            ),
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),

        );

        $fp = fopen('https://' . $url . "/produpdservicev9/nm_prod_upd_service_v9.php", 'r', false, stream_context_create($context_options));
        $log_file = empty($log_file) ? tempnam(sys_get_temp_dir(), "log_") : $log_file;
        $fr = @fopen($log_file, 'a');
        $file_content = "";
        $file_name = '';
        $i = 0;
        while (true) {
            $line = (fgets($fp, 2048));
            if (strpos($line, '@@NM@@') !== false) {
                $__tmp = explode("@@NM@@", $line);

                foreach($__tmp as $part) {
                    if ($part == 'STARTFILE') {
                        $tmpfname = tempnam(sys_get_temp_dir(), "update_");
                        $temp_file = fopen($tmpfname, "w");
                        continue;
                    }
                    if ($part == 'ENDFILE') {
                        $msg = " => Downloaded";
                        try {
                            fwrite($temp_file, $file_content);
                            fclose($temp_file);
                        }catch(Exception $e){
                            $msg = " => Download error";
                        }
                        @fputs($fr, $file_name . $msg . PHP_EOL);
                        $file_final = $dir."/".$file_name;

                        if($accept_gz){
                            @file_put_contents($file_final, @file_get_contents("compress.zlib://" . $tmpfname));
                        }
                        else {
                            @copy($tmpfname, $file_final);
                        }
                        $file_content = '';
                        $file_name = '';
                        continue;
                    }
                    if(substr($part, 0, 9) == 'FILENAME:') {
                        $file_name = substr($part, 9);
                        $__dir = dirname($dir."/".$file_name);
                        if(!@is_dir($__dir)){
                            @mkdir($__dir, 0755, true);
                        }
                        continue;
                    }
                    if ($part == 'CLOSE') {
                        break(2);
                    }
                    $file_content .= $part;
                }

                continue;
            }

            $file_content .= $line;
        }


    }

    function updateMe()
    {
        if(isset( $_SESSION['nm_session']['prod_v8']['updateMe'])){
            return;
        }
        $dir = dirname(dirname(dirname(dirname(dirname(__DIR__)))));


        $url = $this->getUrlService();
        $md5 = md5_file(__FILE__);
        $str_request = $this->nm_xml_send($url . "/produpdservicev9/nm_prod_upd_service_v9.php", ['data' => json_encode(['action' => 'updateMe', 'md5' => $md5])]);

        if (!$str_request) {
            return false;
        }
        $str_request = json_decode($str_request, true);
        if ($str_request['result'] == 201) {
            $this->getFilesService([
                            'lib/php/devel/class/page/nmPageUpdate.class.php',
                            'lib/php/devel/tpl/scriptcase/body_update.tpl.php',
                            'lib/php/devel/lang/en_us/Update.lang.php',
                            'lib/php/devel/lang/es_es/Update.lang.php',
                            'lib/php/devel/lang/pt_br/Update.lang.php',
            ]);
        }

        $_SESSION['nm_session']['prod_v8']['updateMe'] = 1;
        echo "<script>parent.nm_set_option('update', '', 'nm_iframe');</script>";
        exit;
    }

    function nm_xml_send($nm_url, $nm_method)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $nm_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $nm_method);
        $str_response = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        return $info['http_code'] == 200 ? $str_response : false;
    }


    function searchFiles($dir, $exclude_dir = '')
    {
        $dir .= '/';
        $arr_return = [];
        $arr_files = array_diff(scandir($dir), ['.', '..']);
        foreach ($arr_files as $file) {
            if (is_dir($dir . $file)) {
                $arr_return[ strtr($dir . $file, [$exclude_dir => '']) ] = 'dir';
                $arr_return = array_merge($arr_return, $this->searchFiles($dir . $file, $exclude_dir));
            } else {
                $arr_return[strtr($dir . $file, [$exclude_dir => ''])] = md5_file($dir . $file);
            }
        }
        return $arr_return;
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
        $nm_template->Display('body_update');
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
        $this->AddJs('third', 'jquery/js/jquery-ui.js');
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

?>