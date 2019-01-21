<?php

 ?>
<div class="row">
<div class="col-xs-12">
	<h2>Verify Your Email</h2>
	<ol>
		<li>Enter your email address and click Resend</li>
		<li>Check your email and click the link that is sent to you</li>
		<li>Done</li>
	</ol>
	<form class="" action="verify_resend.php" method="post">
	<?php if(!$errors=='') {?><div class="alert alert-danger"><?=display_errors($errors);?></div><?php } ?>
	<div class="form-group">
	<label for="email">Enter Your Email</label>
	<input class="form-control" type="text" id="email" name="email" placeholder="Email">
	</div>
	<input type="hidden" name="csrf" value="<?=Token::generate();?>">
	<input type="submit" value="Resend" class="btn btn-primary">
</form><br />
</div>
</div>
