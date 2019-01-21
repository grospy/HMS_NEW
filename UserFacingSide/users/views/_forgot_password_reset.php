<?php

?>
<div class="row">
<div class="col-xs-12">
	<h2 class="text-center">Hello <?=$ruser->data()->fname;?>,</h2>
	<p class="text-center">Please reset your password.</p>
	<form action="forgot_password_reset.php?reset=1" method="post">
		<?php if(!$errors=='') {?><div class="alert alert-danger"><?=display_errors($errors);?></div><?php } ?>
		<div class="form-group">
			<label for="password">New Password:</label>
			<input type="password" name="password" value="" id="password" class="form-control">
		</div>
		<div class="form-group">
			<label for="confirm">Confirm Password:</label>
			<input type="password" name="confirm" value="" id="confirm" class="form-control">
		</div>
		<input type="hidden" name="csrf" value="<?=Token::generate();?>">
		<input type="hidden" name="email" value="<?=$email;?>">
		<input type="hidden" name="vericode" value="<?=$vericode;?>">
		<input type="submit" name="resetPassword" value="Reset" class="btn btn-primary">
	</form>
<br />
</div><!-- /.col -->
</div><!-- /.row -->
