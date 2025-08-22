<?php 
include_once('../lib/php/base_ini.inc.php');
nm_load_class('page', 'PagePubDirectory');
$obj_page = new nmPagePubDirectory();
$obj_page->Display();
?>