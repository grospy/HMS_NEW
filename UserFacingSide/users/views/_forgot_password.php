<?php

?>
<div class="row">
<div class="col-xs-12">
<h1>Reset your password.</h1>
<ol>
	<li>Enter your email address and click Reset</li>
	<li>Check your email and click the link that is sent to you.</li>
	<li>Follow the on screen instructions</li>
</ol>
<?php if(!$errors=='') {?><div class="alert alert-danger"><?=display_errors($errors);?></div><?php } ?>
<form action="forgot_password.php" method="post" class="form ">
	
	<div class="form-group">
		<label for="email">Email</label>
		<input type="text" name="email" placeholder="Email Address" class="form-control" autofocus>
	</div>

	<input type="hidden" name="csrf" value="<?=Token::generate();?>">
	<p><input type="submit" name="forgotten_password" value="Reset" class="btn btn-primary"></p>
</form>

</div><!-- /.col -->
</div><!-- /.row -->