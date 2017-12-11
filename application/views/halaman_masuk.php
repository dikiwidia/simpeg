<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Halaman Masuk | Sistem Informasi Kepegawaian</title>

<!--STYLESHEETS-->
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" />
<!--SCRIPTS-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
<!--Slider-in icons-->
<script type="text/javascript">
$(document).ready(function() {
	$(".username").focus(function() {
		$(".user-icon").css("left","-48px");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-48px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
	});
});
</script>

</head>
<body>

<!--WRAPPER-->
<div id="wrapper">

	<!--SLIDE-IN ICONS-->
    <div class="user-icon" style="margin-top: 10px;"></div>
    <div class="pass-icon" style="margin-top: 10px;"></div>
    <!--END SLIDE-IN ICONS-->

<!--LOGIN FORM-->
<?php echo form_open('login/attempt', array('class' => 'login-form','name' => 'login-form'
)); ?>

	<!--HEADER-->
    <div class="header">
    <center>
    <!--TITLE--><h1>Halaman Masuk</h1><!--END TITLE-->
    <!--DESCRIPTION--><span>Anda terlebih dahulu diminta memasukan username dan password dengan benar.</span><!--END DESCRIPTION-->
    </center>
    </div>
    <!--END HEADER-->
	
	<!--CONTENT-->
    <div class="content">
	<!--USERNAME--><input name="username" type="text" class="input username" value="Username" autocomplete="off" onfocus="this.value=''" /><!--END USERNAME-->
    <!--PASSWORD--><input name="password" type="password" class="input password" value="Password" onfocus="this.value=''" /><!--END PASSWORD-->
    </div>
    <!--END CONTENT-->
    
    <!--FOOTER-->
    <div class="footer">
    <!--LOGIN BUTTON--><center><input type="submit" name="submit" value="Masuk" class="button" /></center><!--END LOGIN BUTTON-->
    </div>
    <!--END FOOTER-->

<?php echo form_close(); ?>
<!--END LOGIN FORM-->

</div>
<!--END WRAPPER-->

<!--GRADIENT--><div class="gradient"></div><!--END GRADIENT-->

</body>
</html>