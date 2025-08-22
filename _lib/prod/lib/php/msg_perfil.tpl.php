<?php
/**
 * $Id: msg_perfil.tpl.php,v 1.1.1.1 2011-05-12 20:31:29 diogo Exp $
 */
$url_prod = "";
if(isset($_SESSION['scriptcase'])){
    foreach($_SESSION['scriptcase'] as $item){
        if(is_array($item)){
            foreach($item as $key => $path){
                if($key == 'glo_nm_path_prod'){
                    $url_prod = $path;
                    break;
                }
            }
        }
    }
}
?>
<html>
<head>
	<title><?php echo $nm_lang['error_perfil_title']; ?></title>
	<link rel="stylesheet" href="<?php echo $url_prod.'/third/semantic-ui/semantic.css';?>">
</head>
<body>
<div class="ui container" style="padding-top:2rem">
        <section class="ui message">                    
          <div class="content">
            <div class="header">
              <h1 class="ui header"><?php echo $nm_lang['error_perfil_title']; ?></h1>
            </div>
            <p><?php echo $nm_lang['error_perfil_msg_desc']; ?></p>
            <p><?php echo $nm_lang['error_perfil_msg_conn']; ?><strong class="ui text red"><?php echo $str_conexao; ?></strong></p>
            <button class="ui button primary"><i class="database icon"></i><a href="<?php echo $str_link; ?>" style="color: white;"><?php echo $nm_lang['error_perfil_msg_conn_link']; ?></a></button>
          </div>
        </section>
    </div>
</body>
</html>