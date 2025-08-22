<?php
global $nm_lang;
?>
<table style="width:100%;height: 100%;" cellpadding="0" cellspacing="0">
    <tr>
        <td valign="top" align="center">
            <div class="ui container" style="background:none;border:none;padding-top:36px;">
                <div class="ui menu">

                    <?php

                    function nm_get_text_lang($str_lang)
                    {
                        global $nm_lang;

                        eval("\$lang = \$nm_lang" . $str_lang . ";");

                        return $lang;
                    }

                    //antiga classe do diagnosis, apenas adaptado para jogar aqui dentro cliente
                    class sc_ambiente
                    {
                        //Versao do php
                        var $str_php_version;

                        //nome da maquina
                        var $str_hostname;

                        //Sistema Operacional
                        var $str_so;

                        //versao
                        var $devel_version;

                        //build
                        var $build_version;

                        //Prod build
                        var $prod_build_version;

                        //versao
                        var $prod_version;

                        //Vers�o do Zend
                        var $str_zend_version;

                        //Vers�o do Zend
                        var $str_ic_version;

                        //Vers�o do Zend
                        var $str_sg_version;

                        //Servidor WEB
                        var $str_web_server;

                        //database suportadas
                        var $arr_databases;

                        //extensao necessarias para sc
                        var $arr_ext;

                        //extensao necessarias para sc
                        var $str_ini;

                        //cwd
                        var $str_cwd;

                        //diretorio de licenca
                        var $str_license_path;

                        //se o scriptcase tem permissao de escrita
                        var $bol_scriptcase_writeable;

                        //se o diretorio da sessao tem permissao de escrita
                        var $bol_session_writeable;

                        //se tem acesso a internet
                        var $bol_internet_acess_socks;

                        //se tem acesso a internet
                        var $bol_internet_acess_direct;

                        //se tem permissao de execucao
                        var $bol_zendid_permission;

                        //md5 do zendid
                        var $bol_zendid_md5;

                        //se tem permissao no imagemagick
                        var $str_gd_or_imagemagick;

                        //se tem mb_convert_encoding
                        var $str_mb_convert_encoding;

                        //se tem iconv
                        var $str_iconv;


                        //construtor
                        function __construct()
                        {
                            $this->SetPhpVersion();
                            $this->SetHostname();
                            $this->SetCwd();
                            $this->SetZendVersion();
                            $this->SetICVersion();
                            $this->SetSGVersion();
                            $this->SetSo();
                            $this->SetDevelVersion();
                            $this->SetBuildVersion();
                            $this->SetProdVersion();
                            $this->SetProdBuildVersion();
                            $this->SetWebServer();
                            $this->SetDatabasesSuportadas();
                            $this->SetExtNecessarias();
                            $this->SetPhpIniPath();
                            $this->SetScriptcaseWriteable();
                            $this->SetSessionWriteable();
                            //$this->SetInternetAcessSocks(); movido para final dos processos, para agilizar abertura do diagnosis
                            $this->SetZendIdPermission();
                            $this->SetGdOrImagemagick();
                            $this->SetMbConvertEncoding();
                            $this->SetIconv();
                        }

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

                        //** GETs and SETs**//

                        //seta versao do php
                        function SetPhpVersion()
                        {
                            $this->str_php_version = phpversion();
                        }//seta versao do php

                        //pega versao do php
                        function GetPhpVersion()
                        {
                            return $this->str_php_version;
                        }//pega versao do php

                        //seta versao do php
                        function SetHostname()
                        {
                            $this->str_hostname = @gethostname();
                        }//seta versao do php

                        //pega versao do php
                        function GetHostname()
                        {
                            return $this->str_hostname;
                        }//pega versao do php

                        //seta cwd
                        function SetCwd()
                        {
                            $this->str_cwd = getcwd();
                        }//seta cwd

                        //pega cwd
                        function GetCwd()
                        {
                            return $this->str_cwd;
                        }//pega cwd

                        //seta SO
                        function SetSo()
                        {
                            $str_sys = "";
                            if (function_exists("php_uname")) {
                                $str_sys = strtoupper(php_uname());
                            } elseif (defined("PHP_OS")) {
                                $str_sys = strtoupper(PHP_OS);
                            }


                            $this->str_so = $str_sys;
                        } //seta SO

                        //seta Devel Version
                        function SetDevelVersion()
                        {
                            $str_version = "";

                            if (is_file("../../../../../devel/lib/php/ver.dat")) {
                                $str_version = implode("", file("../../../../../devel/lib/php/ver.dat"));
                            } elseif (is_file(__DIR__ . "/../../../ver.dat")) {
                                $str_version = implode("", file(__DIR__ . "/../../../ver.dat"));
                            }

                            $this->devel_version = $str_version;
                        } //SetDevelVersion

                        //seta Build Version
                        function SetBuildVersion()
                        {
                            $str_version = "";
                            if (is_file("../../../../../devel/lib/php/build.dat")) {
                                $str_version = implode("", file("../../../../../devel/lib/php/build.dat"));
                            }

                            $this->build_version = $str_version;
                        } //SetBuildVersion

                        //seta Build Version
                        function SetProdBuildVersion()
                        {
                            $str_version = "";
                            if (is_file(__DIR__ . "/../../../build.dat")) {
                                $str_version = implode("", file(__DIR__ . "/../../../build.dat"));
                            }

                            $this->prod_build_version = $str_version;
                        } //SetBuildVersion

                        //seta Prod Version
                        function SetProdVersion()
                        {
                            $str_version = "";

                            if (is_file(__DIR__ . "/../../../prod.dat")) {
                                $str_version = implode("", file(__DIR__ . "/../../../prod.dat"));
                            } elseif (is_file("../../../../../prod/lib/php/ver.dat")) {
                                $str_version = implode("", file("../../../../../prod/lib/php/ver.dat"));
                            }

                            $this->prod_version = $str_version;
                        } //seta Prod Version

                        //pega SO
                        function GetSo()
                        {
                            return $this->str_so;
                        }//pega SO

                        //pega versao
                        function GetDevelVersion()
                        {
                            return $this->devel_version;
                        }//pega versao

                        //pega versao
                        function GetBuildVersion()
                        {
                            return $this->build_version;
                        }//pega versao

                        //pega versao do prod
                        function GetProdBuildVersion()
                        {
                            return $this->prod_build_version;
                        }//pega versao

                        //pega versao do prod
                        function GetProdVersion()
                        {
                            return $this->prod_version;
                        }//pega versao

                        //seta versao do zend
                        function SetZendVersion()
                        {
                            ob_start();
                            phpinfo();
                            $str_opt = ob_get_contents();
                            ob_end_clean();
                            $str_opt = html_entity_decode(str_replace("&nbsp;", " ", $str_opt));
                            $str_src = "with Zend Guard Loader";
                            if (FALSE !== strpos($str_opt, $str_src)) {
                                $str_opt = trim(substr($str_opt, strpos($str_opt, $str_src) + strlen($str_src)));
                                if (FALSE !== strpos($str_opt, ',')) {
                                    $str_opt = trim(substr($str_opt, 1, strpos($str_opt, ',')));
                                    if (',' == substr($str_opt, -1)) {
                                        $str_opt = substr($str_opt, 0, -1);
                                    }
                                } else {
                                    $str_opt = '';
                                }
                            } else {
                                $str_opt = '';
                            }
                            $this->str_zend_version = $str_opt;
                        }//seta versao do zend

                        //seta versao do zend
                        function SetICVersion()
                        {
                            ob_start();
                            phpinfo();
                            $str_opt = ob_get_contents();
                            ob_end_clean();
                            $str_opt = html_entity_decode(str_replace("&nbsp;", " ", $str_opt));
                            $str_src = "with the ionCub";

                            if (FALSE !== strpos($str_opt, $str_src)) {
                                $str_opt = trim(substr($str_opt, strpos($str_opt, $str_src) + strlen($str_src)));

                                if (FALSE !== strpos($str_opt, ',')) {
                                    $str_opt = trim(substr($str_opt, 1, strpos($str_opt, ',')));
                                    if (',' == substr($str_opt, -1)) {
                                        $str_opt = substr($str_opt, 0, -1);
                                    }
                                } else {
                                    $str_opt = '';
                                }
                            } else {
                                $str_opt = '';
                            }
                            $this->str_ic_version = $str_opt;
                        }//SetICVersion

                        //seta versao do zend
                        function SetSGVersion()
                        {
                            ob_start();
                            phpinfo();
                            $str_opt = ob_get_contents();
                            ob_end_clean();
                            $str_opt = html_entity_decode(str_replace("&nbsp;", " ", $str_opt));
                            $str_src = "with SourceGuardian";

                            if (FALSE !== strpos($str_opt, $str_src)) {
                                $str_opt = trim(substr($str_opt, strpos($str_opt, $str_src) + strlen($str_src)));

                                if (FALSE !== strpos($str_opt, ',')) {
                                    $str_opt = trim(substr($str_opt, 1, strpos($str_opt, ',')));
                                    if (',' == substr($str_opt, -1)) {
                                        $str_opt = substr($str_opt, 0, -1);
                                    }
                                } else {
                                    $str_opt = '';
                                }
                            } else {
                                $str_opt = '';
                            }
                            $this->str_sg_version = $str_opt;
                        }//SetSGVersion

                        //pega versao do zend
                        function GetZendVersion()
                        {
                            return $this->str_zend_version;
                        }//pega versao do zend

                        //pega versao do zend
                        function GetICVersion()
                        {
                            return $this->str_ic_version;
                        }//pega versao do zend

                        //pega versao do zend
                        function GetSGVersion()
                        {
                            return $this->str_sg_version;
                        }//pega versao do zend

                        //seta o servidor web
                        function SetWebServer()
                        {
                            $servidor = "";
                            if (isset($_SERVER["SERVER_SOFTWARE"])) {
                                $servidor = $_SERVER["SERVER_SOFTWARE"];
                            }
                            $this->str_web_server = $servidor;
                        }//seta o servidor web

                        //pega servidor web
                        function GetWebServer()
                        {
                            return $this->str_web_server;
                        }//pega servidor web

                        //seta os tipos de banco suportados pelo php
                        function SetDatabasesSuportadas()
                        {
                            $arr_databases = array();

                            if (5 == $this->nm_php_version()) {
                                $arr_databases['com_dotnet'] = 'off';
                            } else {
                                $arr_databases['com'] = 'off';
                            }

                            $arr_databases['ibm_db2'] = 'off';
                            $arr_databases['interbase'] = 'off';
                            $arr_databases['mssql'] = 'off';
                            $arr_databases['sqlsrv'] = 'off';
                            $arr_databases['mysql'] = 'off';
                            $arr_databases['mysqli'] = 'off';
                            $arr_databases['odbc'] = 'off';
                            $arr_databases['oci8'] = 'off';
                            $arr_databases['oracle'] = 'off';
                            $arr_databases['pgsql'] = 'off';
                            $arr_databases['sqlite'] = 'off';
                            $arr_databases['sqlite3'] = 'off';
                            $arr_databases['sybase_ct'] = 'off';
                            $arr_databases['pdo_cubrid'] = 'off';
                            $arr_databases['pdo_dblib'] = 'off';
                            $arr_databases['pdo_firebird'] = 'off';
                            $arr_databases['pdo_ibm'] = 'off';
                            $arr_databases['pdo_informix'] = 'off';
                            $arr_databases['pdo_mysql'] = 'off';
                            $arr_databases['pdo_oci'] = 'off';
                            $arr_databases['pdo_odbc'] = 'off';
                            $arr_databases['pdo_pgsql'] = 'off';
                            $arr_databases['pdo_sqlite'] = 'off';
                            $arr_databases['pdo_sqlsrv'] = 'off';
                            $arr_databases['pdo_4d'] = 'off';

                            foreach ($arr_databases as $database => $setada) {
                                if (extension_loaded($database)) {
                                    $arr_databases[$database] = 'on';
                                }
                            }
                            $this->arr_databases = $arr_databases;
                        }//seta os tipos de banco suportados pelo php

                        //pega os tipos de banco suportados pelo php
                        function GetDatabasesSuportadas()
                        {
                            return $this->arr_databases;
                        }//pega os tipos de banco suportados pelo php

                        //seta extensoes necessarios pro scriptcase
                        function SetExtNecessarias()
                        {
                            $arr_ext = array();
                            $arr_ext['zlib'] = 'off';
                            $arr_ext['gd'] = 'off';
                            $arr_ext['iconv'] = 'off';
                            $arr_ext['bcmath'] = 'off';
                            $arr_ext['mbstring'] = 'off';

                            foreach ($arr_ext as $ext => $setada) {
                                if (extension_loaded($ext)) {
                                    $arr_ext[$ext] = 'on';
                                }
                            }

                            $this->arr_ext = $arr_ext;
                        }//seta extensoes necessarios pro scriptcase

                        //pega extensoes necessarios pro scriptcase
                        function GetExtNecessarias()
                        {
                            return $this->arr_ext;
                        }//pega extensoes necessarios pro scriptcase

                        //seta o end do ini do php(se ele existir
                        function SetPhpIniPath()
                        {
                            $str_ini = get_cfg_var('cfg_file_path');

                            if (is_file($str_ini)) {
                                $this->str_ini = $str_ini;
                            }
                        }//seta o end do ini do php(se ele existir

                        //pega o end do ini do php(se ele existir
                        function GetPhpIniPath()
                        {
                            return $this->str_ini;
                        }//pega o end do ini do php(se ele existir

                        //Seta diretorio da licenca
                        function SetScriptcaseWriteable()
                        {
                            $bol_scriptcase_writeable = 'on';

                            $arr_path = array();

                            $arr_path[] = 'app';
                            $arr_path[] = 'devel';
                            $arr_path[] = 'tmp';
                            $arr_path[] = 'devel/class/interface';
                            $arr_path[] = 'devel/class/page';
                            $arr_path[] = 'devel/class/xmlparser';
                            $arr_path[] = 'devel/compat';
                            $arr_path[] = 'devel/tpl/scriptcase';

                            foreach ($arr_path as $path) {
                                if (is_dir($path)) {
                                    $str_temp = trim($path);
                                    $old_dir = getcwd();
                                    chdir($str_temp);

                                    $handle = @fopen("teste.tmp", "w+");

                                    if ($handle) {
                                        @fclose($handle);
                                        @unlink("teste.tmp");
                                    } else {
                                        $bol_scriptcase_writeable = 'off';
                                    }
                                    chdir($old_dir);
                                }
                            }

                            $this->bol_scriptcase_writeable = $bol_scriptcase_writeable;
                        }//Seta diretorio da licenca

                        //Pega diretorio da licenca
                        function GetScriptcaseWriteable()
                        {
                            return $this->bol_scriptcase_writeable;
                        }//Pega diretorio da licenca

                        //seta se o dir da sessao � writeable
                        function SetSessionWriteable()
                        {
                            $bol_session_writeable = "off";


                            $session_dir = get_cfg_var('session.save_path');

                            if (empty($session_dir)) {
                                $session_dir = session_save_path();
                            }

                            if (is_dir($session_dir)) {
                                $str_temp = trim($session_dir);
                                $old_dir = getcwd();
                                chdir($str_temp);

                                $handle = @fopen("teste.tmp", "w+");

                                if ($handle) {
                                    fclose($handle);
                                    @unlink("teste.tmp");
                                    $bol_session_writeable = 'on';
                                }
                                chdir($old_dir);
                            }

                            $this->bol_session_writeable = $bol_session_writeable;
                        }//seta se o dir da sessao � writeable

                        //pega se o dir da sessao � writeable
                        function GetSessionWriteable()
                        {
                            return $this->bol_session_writeable;
                        }//pega se o dir da sessao � writeable

                        //seta se a maquina tem acesso a internet
                        function SetInternetAcessSocks()
                        {
                            $bol_internet_acess_socks = "off";

                            $str_caminho = "http://webservice.scriptcase.com.br/checaupd/nm_checaupd_service.php";
                            $v_str_dados = '<?xml version="1.0" encoding="iso-8859-1" ?><checaupd>ok</checaupd>';

                            $arr_result = $this->nm_xml_send($str_caminho, "POST", $v_str_dados, false, 10);

                            if (strpos($arr_result, "<checaupd>ok</checaupd>") !== false) {
                                $bol_internet_acess_socks = 'on';
                            }

                            $this->bol_internet_acess_socks = $bol_internet_acess_socks;
                        }//seta se a maquina tem acesso a internet

                        //pega se a maquina tem acesso a internet
                        function GetInternetAcessSocks()
                        {
                            return $this->bol_internet_acess_socks;
                        }//pega se a maquina tem acesso a internet

                        //seta ze o zend tem permiss�o de execu�ao
                        function SetZendIdPermission()
                        {
                            $bol_zendid_permission = 'off';
                            $bol_zendid_md5 = '';

                            $zend_dir = "../../../../../prod/third/zend";
                            if (!is_dir($zend_dir)) {
                                $zend_dir = "../../../../../devel/lib/third/zend";
                            }
                            $old_dir = getcwd();
                            chdir($zend_dir);

                            if (substr($this->GetSo(), 0, 3) === 'WIN') {
                                if (is_file("zendid.exe")) {
                                    @exec("zendid.exe", $arr_exec);
                                    $bol_zendid_md5 = md5_file("zendid.exe");
                                }
                            } else {
                                if (is_file("zendid")) {
                                    @exec("./zendid", $arr_exec);
                                    $bol_zendid_md5 = md5_file("./zendid");
                                }
                            }

                            if (isset($arr_exec) && is_array($arr_exec) && isset($arr_exec[0]) && strlen($arr_exec[0]) > 20) {
                                $bol_zendid_permission = 'on';
                            }

                            chdir($old_dir);

                            $this->bol_zendid_md5 = $bol_zendid_md5;
                            $this->bol_zendid_permission = $bol_zendid_permission;
                        }//seta ze o zend tem permiss�o de execu�ao

                        //pega ze o zend tem permiss�o de execu�ao
                        function GetZendIdPermission()
                        {
                            return $this->bol_zendid_permission;
                        }//pega ze o zend tem permiss�o de execu�ao

                        //pega o md5 zendid
                        function GetZendIdMd5()
                        {
                            return $this->bol_zendid_md5;
                        }//pega o md5 zendid

                        //pega id da maquina
                        function GetZendIdinfo()
                        {
                            $str_id = "";
                            if ($this->GetZendIdPermission() == 'on') {
                                $old_dir = getcwd();

                                $zend_dir = "../../../../../prod/third/zend";
                                if (!is_dir($zend_dir)) {
                                    $zend_dir = "../../../../../devel/lib/third/zend";
                                }

                                chdir($zend_dir);

                                if (substr($this->GetSo(), 0, 3) === 'WIN') {
                                    if (is_file("zendid.exe")) {
                                        @exec("zendid.exe allid", $arr_exec);
                                    }
                                } else {
                                    if (is_file("zendid")) {
                                        @exec("./zendid allid", $arr_exec);
                                    }
                                }

                                if (isset($arr_exec)) {
                                    if (is_array($arr_exec)) {
                                        $str_id = implode("#lic#", $arr_exec);
                                    } else {
                                        $str_id = $arr_exec;
                                    }
                                }

                                chdir($old_dir);
                                return $str_id;
                            }

                            return $str_id;
                        }

                        //pega se usa imagemagick ou gd
                        function GetGdOrImagemagick()
                        {
                            return $this->str_gd_or_imagemagick;
                        }//pega se usa imagemagick ou gd

                        //seta se usa imagemagickiz ou gd
                        function SetGdOrImagemagick()
                        {
                            $str_gd_or_imagemagick = "ImageMagick";
                            $prod_version = "";
                            if (is_file("../../../../../prod/lib/php/ver.dat")) {
                                $prod_version = str_replace(".", "", implode("", file("../../../../../prod/lib/php/ver.dat")));
                            }

                            if ($prod_version >= 2168 && function_exists("gd_info")) {
                                $sc_info_GD = gd_info();
                                if (isset($sc_info_GD['GD Version'])) {
                                    $pos_Temp = strpos($sc_info_GD['GD Version'], "(");
                                    if ($pos_Temp) {
                                        $sc_GD_version = substr($sc_info_GD['GD Version'], $pos_Temp + 1, 3);
                                    } elseif (!empty($sc_info_GD['GD Version'])) {
                                        $pos_Temp = strpos($sc_info_GD['GD Version'], " ");
                                        $sc_GD_version = substr($sc_info_GD['GD Version'], 0, $pos_Temp);
                                    }
                                    if ($sc_GD_version >= 2) {
                                        $str_gd_or_imagemagick = "GD - " . $sc_GD_version;
                                    }
                                }
                            }

                            $this->str_gd_or_imagemagick = $str_gd_or_imagemagick;
                        }//seta se usa imagemagick ou gd


                        function GetMbConvertEncoding()
                        {
                            return $this->str_mb_convert_encoding;
                        }

                        function SetMbConvertEncoding()
                        {
                            $this->str_mb_convert_encoding = "off";
                            if (function_exists("mb_convert_encoding")) {
                                $this->str_mb_convert_encoding = "on";
                            }
                            return $this->str_mb_convert_encoding;
                        }

                        function GetIconv()
                        {
                            return $this->str_iconv;
                        }

                        function SetIconv()
                        {
                            $this->str_iconv = "off";
                            if (function_exists("iconv")) {
                                $this->str_iconv = "on";
                            }

                            return $this->str_iconv;
                        }

                        //** fim GETs and SETs**//

                        /**
                         * Acessa o servico de registro.
                         *
                         * Envia o pedido de registro para o servico e aguarda a resposta.
                         *
                         * @access  public
                         */
                        function nm_xml_send($v_str_servico, $v_str_metodo, $v_str_dados, $v_bol_msie = FALSE, $v_int_timeout = -1, $v_bol_trata_dados = TRUE)
                        {
                            $str_proxy_serv = "";
                            $str_proxy_usu = "";
                            $str_proxy_pass = "";
                            $str_proxy_port = "";


                            $str_cabecalho = "";
                            if ('http://' == strtolower(substr(trim($v_str_servico), 0, 7))) {
                                $str_cabecalho = "http://";
                                $v_str_servico = substr(trim($v_str_servico), 7);
                            }

                            if ($v_int_timeout > 0) {
                                $int_timeout = $v_int_timeout;
                            } else {
                                $int_timeout = ini_get("default_socket_timeout");

                                if ($int_timeout < 30) {
                                    $int_timeout = 60;
                                }
                            }

                            $str_servidor = substr($v_str_servico, 0, strpos($v_str_servico, '/'));
                            $str_caminho = substr($v_str_servico, strpos($v_str_servico, '/'));
                            $v_str_metodo = (empty($v_str_metodo)) ? 'POST' : strtoupper($v_str_metodo);

                            if ($v_bol_trata_dados) {
                                $v_str_dados = str_replace('%', '__NM_ENC__', $v_str_dados);
                                $v_str_dados = str_replace('+', '__NM_MAIS__', $v_str_dados);
                            }

                            $v_str_dados = 'reg_data=' . $v_str_dados;
                            if (isset($_SESSION['nm_session']['status']['lang']) && '' != $_SESSION['nm_session']['status']['lang']) {
                                $v_str_dados .= '&rem_lang=' . $_SESSION['nm_session']['status']['lang'];
                            }
                            if (FALSE !== strpos($str_servidor, ':')) {
                                $int_port = substr($str_servidor, strpos($str_servidor, ':') + 1);
                                $str_servidor = substr($str_servidor, 0, strpos($str_servidor, ':'));
                            } else {
                                $int_port = 80;
                            }

                            //adicionado servico de proxy
                            $str_proxy_aut = false;
                            $str_servidor_con = $str_servidor;
                            if (!empty($str_proxy_serv)) {
                                $str_caminho = $str_caminho;
                                $str_caminho = $str_cabecalho . $str_servidor . $str_caminho;
                                $str_servidor_con = $str_proxy_serv;
                                $int_port = $str_proxy_port;
                                if (!empty($str_proxy_usu)) {
                                    $str_proxy_aut = true;
                                }
                            }
                            //fim adicionado servico de proxy

                            $res_socket = @fsockopen($str_servidor_con, $int_port, $int_err, $str_err, $int_timeout);

                            if (FALSE == $res_socket) {
                                return FALSE;
                            }
                            if ('GET' == $v_str_metodo) {
                                if (strpos($str_caminho, "?") === FALSE) {
                                    $str_caminho .= '?' . $v_str_dados;
                                } else {
                                    $str_caminho .= '&' . $v_str_dados;
                                }
                            }

                            fputs($res_socket, "$v_str_metodo $str_caminho HTTP/1.1\r\n");
                            fputs($res_socket, "Host: $str_servidor\r\n");

                            if ($str_proxy_aut) {
                                fputs($res_socket, "Proxy-Connection: Keep-Alive\r\n");
                                fputs($res_socket, "Proxy-Authorization: Basic " . base64_encode("$str_proxy_usu:$str_proxy_pass") . "\r\n\r\n");
                            }
                            if ($v_str_metodo == 'POST') {
                                fputs($res_socket, "Content-type: application/x-www-form-urlencoded\r\n");
                                fputs($res_socket, 'Content-length: ' . strlen($v_str_dados) . "\r\n");
                            }
                            if ($v_bol_msie) {
                                fputs($res_socket, "User-Agent: MSIE\r\n");
                            }
                            fputs($res_socket, "Connection: close\r\n\r\n");
                            if ('POST' == $v_str_metodo) {
                                fputs($res_socket, $v_str_dados);
                            }

                            $str_buffer = '';
                            $bol_echo = FALSE;

                            while (!feof($res_socket)) {
                                $str_line = fread($res_socket, 256);
                                if (FALSE !== strpos($str_line, '?xml ') && !$bol_echo) {
                                    $bol_echo = TRUE;
                                    $str_line = substr($str_line, strpos($str_line, "<?xml"));
                                }
                                if ($bol_echo) {
                                    $str_buffer .= $str_line;
                                }

                            }
                            fclose($res_socket);

                            $str_buffer = trim($str_buffer);
                            if (strpos($str_buffer, "xml") !== false) {
                                $str_buffer = "<?" . substr($str_buffer, strpos($str_buffer, "xml"));
                            }

                            return $str_buffer;
                        } // nm_xml_send // nm_xml_send
                    }

                    class diagnosis
                    {
                        var $v_str_dados;

                        function getEnvLang()
                        {
                            $strlang = "";
                            if (isset($_SESSION['nm_session']['status']['lang'])) {
                                $strlang = $_SESSION['nm_session']['status']['lang'];
                            }

                            if (empty($strlang)) {
                                if (is_file("../../../../../devel/conf/scriptcase/scriptcase.config.php")) {
                                    $arr_ini = unserialize(substr(file_get_contents('../../../../../devel/conf/scriptcase/scriptcase.config.php'), 8, -5));
                                    if (isset($arr_ini['sys_idioma']) && !empty($arr_ini['sys_idioma'])) {
                                        $strlang = $arr_ini['sys_idioma'];
                                    }
                                }
                            }

                            if (empty($strlang)) {
                                $arr_accept = array();
                                $strlang = '';
                                if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
                                    if (FALSE !== strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'], ',')) {
                                        $arr_accept = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
                                        $strlang = $arr_accept[0];
                                    } else {
                                        $strlang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
                                    }
                                    $strlang = str_replace('-', '_', $strlang);
                                }
                            }

                            if (empty($strlang)) {
                                $strlang = 'en_us';
                            }
                            return $strlang;
                        }

                        function __cosntruct()
                        {
                            $this->v_str_dados = "";
                        }

                        function makeDiagnosis()
                        {
                            $obj_ambiente = new sc_ambiente();
                            $cor1 = "ffffff";
                            $cor2 = "f5f6f8";
                            $cssTitle1 = " style=' height: 30px; background-color:#87adde;'";
                            $cssTitle = " style='color: #FFFFFF; font-weight: bold; height: 25px; margin: 0; padding: 0 0 0 6px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; background-color:#959595;'";
                            $cssTextTitle = " Style='color: #FFFFFF; font-family: Verdana, Arial, sans-serif; font-size: 13px; font-weight: bold;'";
                            $cssText = " style='color: #404040; font-family: Tahoma, Arial, sans-serif; font-size: 11px;'";

                            $this->escreveTela("<H1></H1>\r");

                            $log_file = "sc_diagnosis_" . date("YmdHis") . ".html";

                            $this->escreveTela("<center " . $cssText . ">\r");
                            $this->escreveTela("<span id='id_msg'></span>\r");
                            $this->escreveTela("</center>\r");

                            $this->escreveTela("<BR />\r");
                            $this->escreveTela("<BR />\r");

                            $this->escreveTela("<TABLE cellpadding='2' cellspacing='0' style='border: 1px solid #f0f2f5' align='center' width='700'>\r");

                            //titulo 1
                            $this->escreveTela("  <TR " . $cssTitle1 . ">\r");
                            $this->escreveTela("    <TD colspan='2' align='center' " . $cssTextTitle . ">\r");
                            $this->escreveTela("      <B>" . nm_get_text_lang("['page_title']") . "</B>\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //titulo 1

                            //titulo 1
                            $this->escreveTela("  <TR " . $cssTitle . ">\r");
                            $this->escreveTela("    <TD colspan='2' align='center' " . $cssTextTitle . ">\r");
                            $this->escreveTela("      <B>" . nm_get_text_lang("['diagnosis_ambiente']") . "</B>\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //titulo 1

                            //checa versao do php
                            $teste_ver = version_compare($obj_ambiente->GetPhpVersion(), "4.3.2");
                            $imagem = "button_ok.png";
                            if ($teste_ver < 0) {
                                $imagem = "button_cancel.png";
                            }
                            $this->escreveTela("  <TR bgcolor='#" . $cor1 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      <img src='diagnosis.php?ajax=nm&button=" . $imagem . "' border='0'>\r", 'N', $imagem);
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      PHP: " . $obj_ambiente->GetPhpVersion() . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //fim checa versao do php

                            //checa versao do php
                            $teste_ver = $obj_ambiente->GetHostname();
                            $imagem = "button_ok.png";
                            if (!$teste_ver) {
                                $imagem = "button_cancel.png";
                            }
                            $this->escreveTela("  <TR bgcolor='#" . $cor2 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      <img src='diagnosis.php?ajax=nm&button=" . $imagem . "' border='0'>\r", 'N', $imagem);
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      Hostname: " . $teste_ver . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //fim checa versao do php

                            $imagem = "button_ok.png";
                            if ($teste_ver < 0) {
                                $imagem = "button_cancel.png";
                            }
                            $this->escreveTela("  <TR bgcolor='#" . $cor1 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      &nbsp;\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      Ioncube: " . $obj_ambiente->GetICVersion() . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //fim checa versao do zend

                            $imagem = "button_ok.png";
                            if ($teste_ver < 0) {
                                $imagem = "button_cancel.png";
                            }
                            $this->escreveTela("  <TR bgcolor='#" . $cor1 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      &nbsp;\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      SourceGuardian: " . $obj_ambiente->GetSGVersion() . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //fim checa versao do zend

                            $imagem = "button_ok.png";
                            if ($teste_ver < 0) {
                                $imagem = "button_cancel.png";
                            }
                            $this->escreveTela("  <TR bgcolor='#" . $cor1 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      &nbsp;\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      ZendGuard: " . $obj_ambiente->GetZendVersion() . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //fim checa versao do zend

                            //checa sistema operacional
                            $imagem = "button_ok.png";
                            $this->escreveTela("  <TR bgcolor='#" . $cor2 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      <img src='diagnosis.php?ajax=nm&button=" . $imagem . "' border='0'>\r", 'N', $imagem);
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      " . nm_get_text_lang("['diagnosis_so']") . ": " . $obj_ambiente->GetSo() . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //checa sistema operacional

                            //checa webserver
                            $imagem = "button_ok.png";
                            $this->escreveTela("  <TR bgcolor='#" . $cor1 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      <img src='diagnosis.php?ajax=nm&button=" . $imagem . "' border='0'>\r", 'N', $imagem);
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      " . nm_get_text_lang("['diagnosis_webserver']") . ": " . $obj_ambiente->GetWebServer() . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //checa webserver

                            //checa devel version
                            $this->escreveTela("  <TR bgcolor='#" . $cor1 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      &nbsp;\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      ScriptCase Devel: " . $obj_ambiente->GetDevelVersion() . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //checa devel version

                            //checa build version
                            $this->escreveTela("  <TR bgcolor='#" . $cor2 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      &nbsp;\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      ScriptCase Build: " . $obj_ambiente->GetBuildVersion() . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //checa build version

                            //checa prod version
                            $this->escreveTela("  <TR bgcolor='#" . $cor1 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      &nbsp;\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      ScriptCase Prod: " . $obj_ambiente->GetProdVersion() . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //checa prod version

                            //checa prod build version
                            $this->escreveTela("  <TR bgcolor='#" . $cor2 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      &nbsp;\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      ScriptCase Prod Build: " . $obj_ambiente->GetProdBuildVersion() . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //checa prod build version

                            //datetime
                            $this->escreveTela("  <TR bgcolor='#" . $cor1 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      &nbsp;\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      Server time: " . date('Ymd Hisu') . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //datetime

                            //checa bancos suportados
                            $this->escreveTela("  <TR " . $cssTitle . ">\r");
                            $this->escreveTela("    <TD colspan='2' align='center' " . $cssTextTitle . ">\r");
                            $this->escreveTela("      <B>" . nm_get_text_lang("['diagnosis_basedados']") . "</B>\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");

                            if (5 == $obj_ambiente->nm_php_version()) {
                                $arr_db['com_dotnet'] = 'COM';
                            } else {
                                $arr_db['com'] = 'ADO';
                            }
                            $arr_db['ibm_db2'] = 'DB2';
                            $arr_db['interbase'] = 'InterBase';
                            $arr_db['mssql'] = 'MsSQL Server';
                            $arr_db['sqlsrv'] = 'MsSQL Server SRV';
                            $arr_db['mysql'] = 'MySQL';
                            $arr_db['mysqli'] = 'MySQLI';
                            $arr_db['odbc'] = 'ODBC';
                            $arr_db['oci8'] = 'Oracle 8';
                            $arr_db['oracle'] = 'Oracle';
                            $arr_db['pgsql'] = 'PostGreSQL';
                            $arr_db['sqlite'] = 'SQLite';
                            $arr_db['sqlite3'] = 'SQLite 3';
                            $arr_db['sybase_ct'] = 'SyBase';
                            $arr_db['pdo_mysql'] = 'PDO MySQL';
                            $arr_db['pdo_pgsql'] = 'PDO PostGreSQL';
                            $arr_db['pdo_sqlite'] = 'PDO SQLite';
                            $arr_db['pdo_sqlsrv'] = 'PDO MsSQL Server';
                            $arr_db['pdo_oci'] = 'PDO Oracle';
                            $arr_db['pdo_firebird'] = 'PDO Firebird';
                            $arr_db['pdo_informix'] = 'PDO Informix';
                            $arr_db['pdo_dblib'] = 'PDO DBLIB';
                            $arr_db['pdo_odbc'] = 'PDO ODBC';

                            $arr_databases = $obj_ambiente->GetDatabasesSuportadas();
                            $cor = 1;
                            foreach ($arr_databases as $database => $flag) {
                                if ($cor == 1) {
                                    $color = $cor1;
                                } else {
                                    $color = $cor2;
                                }

                                $imagem = "button_ok.png";
                                if ($flag == 'off') {
                                    $imagem = "button_cancel.png";
                                }
                                $str_db = isset($arr_db[$database]) ? $arr_db[$database] : $database;
                                $this->escreveTela("  <TR bgcolor='#" . $color . "'>\r");
                                $this->escreveTela("    <TD>\r");
                                $this->escreveTela("      <img src='diagnosis.php?ajax=nm&button=" . $imagem . "' border='0'>\r", 'N', $imagem);
                                $this->escreveTela("    </TD>\r");
                                $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                                $this->escreveTela("      " . $str_db . "\r");
                                $this->escreveTela("    </TD>\r");
                                $this->escreveTela("  </TR>\r");

                                if ($cor == 1) {
                                    $cor = 0;
                                } else {
                                    $cor++;
                                }
                            }
                            //checa bancos suportados

                            //checa extensoes necessarias
                            $this->escreveTela("  <TR " . $cssTitle . ">\r");
                            $this->escreveTela("    <TD colspan='2' align='center' " . $cssTextTitle . ">\r");
                            $this->escreveTela("      <B>" . nm_get_text_lang("['diagnosis_extensoes']") . "</B>\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");

                            $arr_ext = $obj_ambiente->GetExtNecessarias();
                            $cor = 1;
                            foreach ($arr_ext as $ext => $flag) {
                                if ($cor == 1) {
                                    $color = $cor1;
                                } else {
                                    $color = $cor2;
                                }

                                $imagem = "button_ok.png";
                                if ($flag == 'off') {
                                    $imagem = "button_cancel.png";
                                }

                                $this->escreveTela("  <TR bgcolor='#" . $color . "'>\r");
                                $this->escreveTela("    <TD>\r");
                                $this->escreveTela("      <img src='diagnosis.php?ajax=nm&button=" . $imagem . "' border='0'>\r", 'N', $imagem);
                                $this->escreveTela("    </TD>\r");
                                $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                                $this->escreveTela("      " . strtoupper($ext) . "\r");
                                $this->escreveTela("    </TD>\r");
                                $this->escreveTela("  </TR>\r");

                                if ($cor == 1) {
                                    $cor = 0;
                                } else {
                                    $cor++;
                                }
                            }
                            //checa extensoes necessarias

                            //titulo 2
                            $this->escreveTela("  <TR " . $cssTitle . ">\r");
                            $this->escreveTela("    <TD colspan='2' align='center' " . $cssTextTitle . ">\r");
                            $this->escreveTela("      <B>" . nm_get_text_lang("['diagnosis_ambiente2']") . "</B>\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //titulo 2

                            //checa ini do php
                            $teste_tmp = $obj_ambiente->GetPhpIniPath();
                            $imagem = "button_ok.png";
                            if (empty($teste_tmp)) {
                                $imagem = "button_cancel.png";
                            }
                            $this->escreveTela("  <TR bgcolor='#" . $cor1 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      <img src='diagnosis.php?ajax=nm&button=" . $imagem . "' border='0'>\r", 'N', $imagem);
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      " . nm_get_text_lang("['diagnosis_phpinipath']") . ": " . $teste_tmp . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //checa ini do php

                            //checa scriptcasewriteable
                            $teste_tmp = $obj_ambiente->GetScriptcaseWriteable();
                            $imagem = "button_ok.png";
                            if ($teste_tmp == 'off') {
                                $imagem = "button_cancel.png";
                            }
                            $this->escreveTela("  <TR bgcolor='#" . $cor1 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      <img src='diagnosis.php?ajax=nm&button=" . $imagem . "' border='0'>\r", 'N', $imagem);
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      " . nm_get_text_lang("['diagnosis_sc_write_perm']") . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //checa scriptcasewriteable

                            //checa escrita na sessao
                            $teste_tmp = $obj_ambiente->GetSessionWriteable();
                            $imagem = "button_ok.png";
                            if ($teste_tmp == 'off') {
                                $imagem = "button_cancel.png";
                            }
                            $this->escreveTela("  <TR bgcolor='#" . $cor2 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      <img src='diagnosis.php?ajax=nm&button=" . $imagem . "' border='0'>\r", 'N', $imagem);
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      " . nm_get_text_lang("['diagnosis_sess_write_perm']") . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //checa escrita na sessao

                            //checa acesso a internet
                            /*$teste_tmp = $obj_ambiente->GetInternetAcessSocks();
                            $imagem = "button_ok.png";
                            if($teste_tmp=='off')
                            {
                                    $imagem = "button_cancel.png";
                            }*/
                            $this->escreveTela("<!-- INTERNET_SOCKS -->");
                            $this->escreveTela("  <TR bgcolor='#" . $cor1 . "'>\r", 'N');
                            $this->escreveTela("    <TD>\r", 'N');
                            $this->escreveTela("      <span id='id_internet_img'></span>\r", 'N');
                            $this->escreveTela("    </TD>\r", 'N');
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r", 'N');
                            $this->escreveTela("      " . nm_get_text_lang("['diagnosis_acesso_internet']") . " - Socks\r", 'N');
                            $this->escreveTela("      <span id='id_internet_text'> - " . nm_get_text_lang("['diagnosis_acesso_checando']") . "...</span>\r", 'N');
                            $this->escreveTela("    </TD>\r", 'N');
                            $this->escreveTela("  </TR>\r", 'N');
                            //checa acesso a internet

                            //checa permissao no zendid
                            $teste_tmp = $obj_ambiente->GetZendIdPermission();
                            $imagem = "button_ok.png";
                            if ($teste_tmp == 'off') {
                                $imagem = "button_cancel.png";
                            }
                            $this->escreveTela("  <TR bgcolor='#" . $cor2 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      <img src='diagnosis.php?ajax=nm&button=" . $imagem . "' border='0'>\r", 'N', $imagem);
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      " . nm_get_text_lang("['diagnosis_zendid_perm']") . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //checa permissao no zendid

                            //checa mod5 do zendid
                            $teste_tmp = $obj_ambiente->GetZendIdMd5();
                            $imagem = "button_ok.png";
                            if ($teste_tmp == 'off') {
                                $imagem = "button_cancel.png";
                            }
                            $this->escreveTela("  <TR bgcolor='#" . $cor2 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      <img src='diagnosis.php?ajax=nm&button=" . $imagem . "' border='0'>\r", 'N', $imagem);
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      " . nm_get_text_lang("['diagnosis_zendid_md5']") . ": " . $teste_tmp . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //checa mod5 do zendid

                            //checa id da maquina
                            $teste_tmp = $obj_ambiente->GetZendIdinfo();
                            $imagem = "button_ok.png";
                            if (empty($teste_tmp)) {
                                $imagem = "button_cancel.png";
                            }
                            $this->escreveTela("  <TR bgcolor='#" . $cor2 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      <img src='diagnosis.php?ajax=nm&button=" . $imagem . "' border='0'>\r", 'N', $imagem);
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      ID: " . $teste_tmp . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //checa id da maquina

                            //checa popup
                            $imagem = "button_ok.png";
                            $this->escreveTela("  <TR bgcolor='#" . $cor2 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      <img id='id_img' src='diagnosis.php?ajax=nm&button=" . $imagem . "' border='0'>\r", 'N', $imagem);
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      <span id='id_popup'>Popup: Erro</span>\r");
                            $this->escreveTela("      <script type='text/JavaScript' language='JavaScript'>");
                            $this->escreveTela("       var wTestPopup = window.open('', '', 'width=1,height=1,left=0,top=0,scrollbars=no');");
                            $this->escreveTela("       if (wTestPopup)");
                            $this->escreveTela("       {");
                            $this->escreveTela("        document.getElementById('id_popup').innerHTML = 'Popup: OK';");
                            $this->escreveTela("        wTestPopup.close();");
                            $this->escreveTela("       }");
                            $this->escreveTela("      </script>");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //checa se usa gd ou imagemagick

                            $teste_tmp = $obj_ambiente->GetGdOrImagemagick();
                            $imagem = "button_ok.png";
                            $this->escreveTela("  <TR bgcolor='#" . $cor1 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      <img src='diagnosis.php?ajax=nm&button=" . $imagem . "' border='0'>\r", 'N', $imagem);
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      " . $teste_tmp . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //checa se usa gd ou imagemagick

                            //checa cwd
                            $teste_tmp = $obj_ambiente->GetCwd();
                            $imagem = "button_ok.png";
                            if (empty($teste_tmp)) {
                                $imagem = "button_cancel.png";
                            }
                            $this->escreveTela("  <TR bgcolor='#" . $cor2 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      <img src='diagnosis.php?ajax=nm&button=" . $imagem . "' border='0'>\r", 'N', $imagem);
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      " . $teste_tmp . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //checa cwd

                            //checa cwd
                            $teste_tmp = $obj_ambiente->GetMbConvertEncoding();
                            $imagem = "button_ok.png";
                            if ($teste_tmp == 'off') {
                                $imagem = "button_cancel.png";
                            }
                            $this->escreveTela("  <TR bgcolor='#" . $cor2 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      <img src='diagnosis.php?ajax=nm&button=" . $imagem . "' border='0'>\r", 'N', $imagem);
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      mb_convert_encoding " . $teste_tmp . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //checa cwd

                            //checa cwd
                            $teste_tmp = $obj_ambiente->GetIconv();
                            $imagem = "button_ok.png";
                            if ($teste_tmp == 'off') {
                                $imagem = "button_cancel.png";
                            }
                            $this->escreveTela("  <TR bgcolor='#" . $cor2 . "'>\r");
                            $this->escreveTela("    <TD>\r");
                            $this->escreveTela("      <img src='diagnosis.php?ajax=nm&button=" . $imagem . "' border='0'>\r", 'N', $imagem);
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("    <TD align='left' " . $cssText . ">\r");
                            $this->escreveTela("      iconv " . $teste_tmp . "\r");
                            $this->escreveTela("    </TD>\r");
                            $this->escreveTela("  </TR>\r");
                            //checa cwd


                            $this->escreveTela("</TABLE>\r");

                            //checa acesso a internet
                            $this->escreveTela("<script>document.getElementById('id_msg').innerHTML = '" . nm_get_text_lang("['diagnosis_acesso_checando']") . "...';</script>\r", 'N');
                            $obj_ambiente->SetInternetAcessSocks();
                            $teste_tmp = $obj_ambiente->GetInternetAcessSocks();
                            $imagem = "button_ok.png";
                            $msg = nm_get_text_lang("['diagnosis_ok']");
                            $cor_erro_log = "#123456";
                            if ($teste_tmp == 'off') {
                                $imagem = "button_cancel.png";
                                $msg = nm_get_text_lang("['diagnosis_problema']");
                                $cor_erro_log = "#E71800";
                            }
                            $this->escreveTela("<script>document.getElementById('id_internet_img').innerHTML = \"<img src='diagnosis.php?ajax=nm&button=" . $imagem . "' border='0'>\" </script> \r", 'N');
                            $this->escreveTela("<script>document.getElementById('id_internet_text').innerHTML = \" - $msg\" </script>\r", 'N');

                            $str_res_socks = "  <TR bgcolor='#" . $cor1 . "'>";
                            $str_res_socks .= "	   <TD>";
                            $str_res_socks .= "	     <font color='" . $cor_erro_log . "'>&nbsp;&nbsp; " . $msg . " &nbsp;&nbsp;</font>\r";
                            $str_res_socks .= "    </TD>\r";
                            $str_res_socks .= "    <TD align='left' " . $cssText . ">\r";
                            $str_res_socks .= "      " . nm_get_text_lang("['diagnosis_acesso_internet']") . " - Socks\r";
                            $str_res_socks .= "    </TD>\r";
                            $str_res_socks .= "  </TR>\r";
                            $this->v_str_dados = str_replace("<!-- INTERNET_SOCKS -->", $str_res_socks, $this->v_str_dados);
                            //checa acesso a internet


                            $this->createLogFile($log_file);
                            if (is_file("../../../../../tmp/" . $log_file)) {
                                $this->escreveTela("
						        <script>document.getElementById('id_msg').innerHTML = \"<a href='../../../../../tmp/" . $log_file . "' target='nmWinDiagV9'><font color='#0044C8'>" . nm_get_text_lang("['diagnosis_mensagem_sucesso']") . "</font></a>\"</script>\r\n");
                            } else {
                                $this->escreveTela("<script>document.getElementById('id_msg').innerHTML = '" . nm_get_text_lang("['diagnosis_mensagem_fail']") . "';</script>\r");
                            }
                        }

                        function escreveTela($str_string, $v_str_arquivo = 'S', $str_arq = '')
                        {
                            if ($v_str_arquivo == 'S') {
                                $this->v_str_dados .= $str_string;
                            } else {
                                if (strpos($str_arq, 'button_ok.png') !== false) {
                                    $str_arq = "<font color='#123456'>&nbsp;&nbsp; " . nm_get_text_lang("['diagnosis_ok']") . " &nbsp;&nbsp;</font>";
                                    $this->v_str_dados .= $str_arq;
                                } elseif (strpos($str_arq, 'button_cancel.png') !== false) {
                                    $str_arq = "<font color='#E71800'>&nbsp;&nbsp; " . nm_get_text_lang("['diagnosis_problema']") . " &nbsp;&nbsp;</font>";
                                    $this->v_str_dados .= $str_arq;
                                }
                            }
                            echo $str_string;
                            flush();
                        }

                        function createLogFile($v_str_nome)
                        {
                            ob_start();
                            phpinfo();
                            $str_opt = "<BR /><BR /><CENTER>PHP INFO</CENTER><BR /><BR />\r" . ob_get_contents();
                            ob_end_clean();

                            $possibleErros = "";
                            if (isset($_SESSION['nm_session']['error_msgs']) && is_array($_SESSION['nm_session']['error_msgs'])) {
                                $possibleErros = implode("<BR />\r", $_SESSION['nm_session']['error_msgs']);
                            }

                            file_put_contents('../../../../../tmp/' . $v_str_nome, $this->v_str_dados . $str_opt . "<BR /><BR />Erros Possíveis:<BR /><BR />" . $possibleErros);
                        }
                    }

                    function treatError($int_error_level, $str_error_msg, $str_error_file, $int_error_line)
                    {
                        $error_msg = "Erro Level: " . $int_error_level . "; Mensagem: " . $str_error_msg . "; Arquivo: " . $str_error_file . "; Linha: " . $int_error_line;
                        $_SESSION['nm_session']['error_msgs'][] = $error_msg;
                    }

                    set_error_handler('treatError');
                    $obj_diag = new diagnosis();
                    $obj_diag->makeDiagnosis();
                    ?>

                </div>
            </div>
        </td>
    </tr>
</table>