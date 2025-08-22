<?php
include_once('../lib/php/base_ini.inc.php');
nm_load_class('page', 'PageProdLogin');
$obj_page = new nmPageProdLogin();
$obj_page->Display();
?>