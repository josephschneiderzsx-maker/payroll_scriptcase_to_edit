<?php 
include_once('../lib/php/base_ini.inc.php');
nm_load_class('page', 'PageOutdatedApps');
$obj_page = new nmPageOutdatedApps();
$obj_page->Display();
?>