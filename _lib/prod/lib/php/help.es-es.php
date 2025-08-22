<?php
$nm_link_help                                                   = 'https://www.scriptcase.net/docs/es_es/v9/manual/';
if($nm_config['is_dev']){
    $nm_link_help = 'http://royalsalutre.netmake.com.br/tools/nm/sc_helpv9/gerado/es_es/manual_mp/manual/';
}
$_SESSION['nm_session']['prod_v8']['help']                      = array();
$_SESSION['nm_session']['prod_v8']['help']['prod_create_conn']  = $nm_link_help.'12-deploy/04-production-environment/03-database-connections/#id-01';
$_SESSION['nm_session']['prod_v8']['help']['prod_edit_conn']    = $nm_link_help.'12-deploy/04-production-environment/03-database-connections/#id-02';
$_SESSION['nm_session']['prod_v8']['help']['prod_rename_conn']  = $nm_link_help.'12-deploy/04-production-environment/03-database-connections/#id-03';
$_SESSION['nm_session']['prod_v8']['help']['prod_peding_conn']  = $nm_link_help.'12-deploy/04-production-environment/03-database-connections/#id-04';
$_SESSION['nm_session']['prod_v8']['help']['prod_setting']      = $nm_link_help.'12-deploy/04-production-environment/04-production-configuration/#id-01';
$_SESSION['nm_session']['prod_v8']['help']['pub_dir']           = $nm_link_help.'12-deploy/04-production-environment/04-production-configuration/#id-02';
$_SESSION['nm_session']['prod_v8']['help']['outdated_main']     = $nm_link_help.'12-deploy/04-production-environment/04-production-configuration/#id-03';
$_SESSION['nm_session']['prod_v8']['help']['prod_pswd_recover'] = $nm_link_help.'12-deploy/04-production-environment/04-production-configuration/#id-04';
$_SESSION['nm_session']['prod_v8']['help']['prod_update']       = $nm_link_help.'12-deploy/04-production-environment/04-production-configuration/#id-05';
$_SESSION['nm_session']['prod_v8']['help']['prod_api']          = $nm_link_help.'12-deploy/04-production-environment/04-production-configuration/#id-06';
$_SESSION['nm_session']['prod_v8']['help']['prod_change_pswd']  = $nm_link_help.'12-deploy/04-production-environment/04-production-configuration/#id-07';
$_SESSION['nm_session']['prod_v8']['help']['prod_help']         = $nm_link_help.'12-deploy/04-production-environment/04-production-configuration/#id-08';
$_SESSION['nm_session']['prod_v8']['help']['prod_diagnosis']    = $nm_link_help.'12-deploy/04-production-environment/04-production-configuration/#id-09';
$_SESSION['nm_session']['prod_v8']['help']['prod_about']        = $nm_link_help.'12-deploy/04-production-environment/04-production-configuration/#id-10';
$_SESSION['nm_session']['prod_v8']['help']['prod_logout']       = $nm_link_help.'12-deploy/04-production-environment/04-production-configuration/#id-11';
$_SESSION['nm_session']['prod_v8']['help']['prod_api_setting']  = $nm_link_help.'07-tools/13-api/';
?>