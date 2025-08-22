<?php

include_once('../lib/php/base_ini.inc.php');

nm_load_class('page', 'PageDiagnosis');
$obj_page = new nmPageDiagnosis();
$obj_page->Display();
        
?>