<?php
if($this->session->has_userdata('user')){
	
} else {
	redirect('/login');
}
?>
<?php echo $_header; ?>
<?php echo $_sidebar; ?>
<?php echo $_content; ?>
<?php echo $_footer; ?>