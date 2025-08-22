<?php

include_once('../lib/php/base_ini.inc.php');
if(!isset($_SESSION['nm_session']['prod_v8']['updateMe']) && !isset($_POST['ajax'])){
    nm_load_class('page', 'PageUpdateMe');
    $obj_page = new nmPageUpdateMe();
    $obj_page->Display();
}else {
    nm_load_class('page', 'PageUpdate');
    $obj_page = new nmPageUpdate();
    $obj_page->Display();
}
?>