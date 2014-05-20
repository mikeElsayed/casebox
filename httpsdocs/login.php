<?php
namespace CB;

require_once 'init.php';
if (!empty($_SESSION['check_TSV']) && ((time() - $_SESSION['check_TSV']) > 180)) {
    unset($_SESSION['check_TSV']);
}

$coreName = Config::get('core_name');
$coreUrl = Config::get('core_url');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title><?php

echo Config::get('project_name_' . \CB\Config::get('user_language'), $coreName);

?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $coreUrl; ?>css/bs/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $coreUrl; ?>css/bs/css/bootstrap-responsive.min.css" />
    <link type='text/css' rel="stylesheet" href="<?php echo $coreUrl; ?>css/login.css" />
</head>
<body onload="javascript: e = document.getElementById('u'); if(!e) e = document.getElementById('c'); e.focus(); editChanged();">
<script type="text/javascript">
//<--
String.prototype.trim = function() {return this.replace(/^\s+|\s+$/g,"");}
function editChanged()
{
    s = document.getElementById('s');
<?php

if (empty($_SESSION['check_TSV'])) {

    ?>

    s.disabled = ((document.getElementById('u').value.trim() == '') || (document.getElementById('p').value == ''));

    <?php

} else {

    ?>

    s.disabled = (document.getElementById('c').value.trim() == '');

    <?php

}

?>
    if(s.disabled) setTimeout(editChanged, 500)
}
//-->
</script>
<div class="main">
    <div class="form_login tac">
        <a href="/" class="dib"><img src="<?php echo $coreUrl; ?>css/i/CaseBox-Logo-medium.png" style="width: 300px"></a><br>
        <form method="post" action="auth.php" class="standart_form tal" autocomplete="off">
<?php

if (empty($_SESSION['check_TSV'])) {

    ?>
            <label>
                <input type="text" name="u" id="u" placeholder="<?php echo L\get('Username');?>">
                <span class="icon-user"></span>
            </label>
            <label>
                <input type="password" name="p" id="p" placeholder="<?php echo L\get('Password');?>" onkeydown="javascript:editChanged()">
                <?php echo isset($_SESSION['message']) ? '<div class="alert alert-error">'.$_SESSION['message'].'</div>' : '';?>
                <span class="icon-lock"></span>
            </label>
            <a style="margin-top: 30px;" class="pull-right" href="<?php echo '/'.$coreName; ?>/login/forgot-password/"><?php echo L\get('ForgotPassword');?></a>
            <input type="submit" name="s" id="s" value="<?php echo L\get('Login');?>" class="btn btn-info" style="margin-top: 26px;" disabled>
    <?php

} else {

    ?>
            <label>
                <?php echo L\get('TSV');//$_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name'];
                ?>
            </label>
            <label>
                <input type="text" name="c" id="c" placeholder="<?php echo L\get('EnterCode');?>">
                <?php echo isset($_SESSION['message']) ? '<div class="alert alert-error">'.$_SESSION['message'].'</div>' : '';?>
                <span class="icon-lock"></span>
            </label>
            <input type="submit" name="s" id="s" value="<?php echo L\get('Verify');?>" class="btn btn-info" style="margin-top: 26px;" disabled>
    <?php

}

?>
        </form>
    </div>
</div>

<div class="footer">
<?php echo Config::get('login_footer_text'); ?>
</div>

<div class="footer" style="right: 0px;">
    <a href="https://www.casebox.org/">www.casebox.org</a> <span style="color: #AAA; padding-left: 2px; padding-right: 5px">&bull;</span>  <a href="http://forum.casebox.org/">Support forum</a>
</div>

</body>
</html>
<?php

unset($_SESSION['message']);

if (empty($_SESSION['check_TSV'])) {
    unset($_SESSION['user']);
}
