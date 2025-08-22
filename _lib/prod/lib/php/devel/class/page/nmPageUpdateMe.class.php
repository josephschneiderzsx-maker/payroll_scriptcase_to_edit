<?php

/* Classes ancestrais */
nm_load_class('page', 'Page');

/* Definicao da classe */

class nmPageUpdateMe extends nmPage
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
        if (true || file_exists($dir . '/is_dev')) {
            $url = "dev-webservice.scriptcase.com.br";
        }
        return $url;
    }

    function update()
    {
        $dir = $this->getDirProd();
        $url = $this->getUrlService();
        $arr_files = $this->searchFiles($dir, $dir . '/');


        $str_request = $this->nm_xml_send($url . "/produpdservicev9/nm_prod_upd_service_v9.php", 'POST');
        $__tmp = preg_split("/\r\n|\n|\r/", $str_request);


        $arr_file_update = [];
        $arr_file_news = [];
        foreach ($__tmp as $file) {
            $file = explode('_!NM!_', $file);
            if (isset($arr_files[$file[0]])) {
                if ($arr_files[$file[0]] != $file[1]) {
                    $arr_file_update[] = $file[0];
                }
                unset($arr_files[$file[0]]);
            }
            $arr_file_news[] = $file[0];
        }
        $log_file = $dir . '/../tmp/prod_update_' . date('YmdHis') . '.log';
        $fr = @fopen($log_file, 'w');
        @fputs($fr, "******   LOG PROD UPDATE   ******\n");
        foreach ($arr_files as $file => $trash) {
            $log_msg = " => Deleted\n";
            if (!@unlink($dir . '/' . $file)) {
                $log_msg = " => Failed to Delete\n";
            }
            @fputs($fr, $file . $log_msg);
            $thisdir = dirname($dir . '/' . $file);
            if (count(scandir($thisdir)) == 2) {
                $log_msg = " => Deleted\n";
                if (!@unlink($thisdir)) {
                    $log_msg = " => Failed to Delete\n";
                }
                @fputs($fr, $file . " (empty dir)" . $log_msg);
            }
        }
        @fclose($fr);
        return json_encode([
            'deleted' => count($arr_files),
            'updated' => count($arr_file_update) + count($arr_file_news),
        ]);
    }

    function getFilesService($arr_files)
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

        $file_content = "";
        $file_name = '';
        $i = 0;
        while (true) {
            $line = (fgets($fp, 2048));
//            echo "\n", date("Y-m-d H:i:s") . ':' . $line . "<br/>";
            //echo 'aqui:' .$line . "<br/><br/>\r\n";
            if (strpos($line, '@@NM@@') !== false) {
                $__tmp = explode("@@NM@@", $line);

                foreach($__tmp as $part) {
                    if ($part == 'STARTFILE') {
                        $tmpfname = tempnam(sys_get_temp_dir(), "update_");
                        $temp_file = fopen($tmpfname, "w");
                        continue;
                    }
                    if ($part == 'ENDFILE') {
                        fwrite($temp_file, $file_content);
                        fclose($temp_file);

                        $file_final = $dir."/".$file_name;

                        if($accept_gz){
                            @file_put_contents($file_final, @file_get_contents("compress.zlib://" . $tmpfname));
                        }
                        else {
                            copy($tmpfname, $file_final);
                        }
                        $file_content = '';
                        $file_name = '';
                        continue;
                    }
                    if(substr($part, 0, 9) == 'FILENAME:') {
                        $file_name = substr($part, 9);
//                        echo "@@".$file_name; exit;
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
            $this->getFilesService([ 'lib/php/devel/class/page/nmPageUpdate.class.php', 'lib/php/devel/tpl/scriptcase/body_update.tpl.php']);
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
        curl_close($ch);
        return $str_response;
    }


    function searchFiles($dir, $exclude_dir = '')
    {
        $dir .= '/';
        $arr_return = [];
        $arr_files = array_diff(scandir($dir), ['.', '..']);
        foreach ($arr_files as $file) {
            if (is_dir($dir . $file)) {
//                $arr_return[ strtr($dir . $file, [$exclude_dir => '']) ] = 'dir';
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
        $this->AddStyleCss('third', 'bootstrap/css/bootstrap.min.css');
        $this->AddStyleCss('third', 'semantic-ui/semantic.min.css');
    } // PageStyle


}

?>