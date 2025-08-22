<?php
session_start();
if(!isset($_SESSION['nm_session']['prod_v8']['login']['captcha_text'])){
    $_SESSION['nm_session']['prod_v8']['login']['captcha_text'] = '';
}
echo json_encode($_SESSION['nm_session']['prod_v8']['login']['captcha_text']);
?>