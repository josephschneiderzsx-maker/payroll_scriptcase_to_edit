<?php

$str_conn  = $this->GetVar('str_conn');
$str_teste = $this->GetVar('str_teste');
$str_msg   = nm_conv_utf8($this->GetVar('str_msg'));
$tp_busca  = $this->GetVar('tp_busca');

if(substr($str_msg, 0, 6) == "error_" && isset($nm_lang[$str_msg]))
{
    $str_msg = $nm_lang[$str_msg];
}
if ('teste_ok' == $str_teste)
{
    $str_text = '<div class="header">' . $nm_lang['label'][$str_teste] . '</div>';
    $str_css  = 'ui success message';
}
elseif ('teste_fail' == $str_teste)
{
    $str_text = '<div class="header">' . $nm_lang['label'][$str_teste] . '</div>' . $str_msg;
    $str_css  = 'ui negative message';
}
else
{
    $str_text = '<div class="header">' . $nm_lang['label']['teste_fail'] . '</div>' . $str_msg;
    $str_css  = 'ui negative message';
}
//Carrega Array com Grupos do ScriptCase
$arr_sgbd = $this->GetVar('arr_sgbd');

$create_connect = $this->GetVar('hid_create_connect');
?>
<form action="<?php echo nm_url_rand($nm_config['url_iface'] . 'admin_sys_allconections_filt.php'); ?>" name="form_test" METHOD="post">
    <center>
        <?php
        if ($create_connect)
        {
            ?>
            <div style="text-align: left;" class="<?php echo $str_css; ?>"><?php echo $str_text; ?></div>
            <?php
        }
        else
        {
            ?>
            <table class="nmTable" width="350px">
                <tr>
                    <td class="nmTitle" align="center" colspan="2"><?php echo $nm_lang['page_title']; ?></td>
                </tr>
                <tr>
                    <td class="nmLineV3"><?php echo $nm_lang['label']['teste'] . "<b>".$str_conn."</b>"; ?></td>
                </tr>
                <tr>
                    <td class="<?php echo $str_css; ?>"><?php echo $str_text; ?></td>
                </tr>
            </table>
            <br>
            <?php
        }
        ?>

        <input type="hidden" name="str_conn" value="<?php echo $str_conn; ?>">
        <?php
        if($tp_busca!='post')
        {
            ?>
            <input type="button" name="botao" value="<?php echo $nm_lang['button']; ?>" class="nmButton" onClick="nm_cancelar()">
            <?php
        }
        ?>
        <input type="hidden" name="form_test" value="<?php echo $nm_config['form_valid']; ?>" />
    </center>
</form>
<form name="nm_form_cancel" style="display:none" action="<?php echo nm_url_rand($nm_config['url_iface'] . 'admin_sys_allconections.php'); ?>" method="post">
</form>

<script language="javascript">

    if (parent && parent.document.getElementById('span_iframe_test_conn'))
    {
        parent.document.getElementById('span_load_ajax_test_conn').style.display = 'none';
        parent.document.getElementById('span_iframe_test_conn').style.display = '';


        if (parent.document.getElementById('span_save_conn').innerHTML == 'S')
        {
            <?php
            if ('teste_fail' == $str_teste)
            {
            ?>
            //parent.document.getElementById('bt_nav_2').style.display = '';
            parent.nm_show_confirm_modal();
            <?php
            }
            else
            {
            ?>
            parent.fc_ajust_port();
            console.log('ok');
            //parent.setStep('testar');
            parent.nm_show_msg_modal();
            <?php
            }
            ?>
        }
    }

</script>

