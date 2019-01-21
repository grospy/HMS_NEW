<?php

?>
<?php
require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h3 align="center">You have successfully logged in...redirecting now.</h3>
				<?php require_once $abs_us_root.$us_url_root.'usersc/includes/oauth_success_redirect.php';?>
				<?=Redirect::to($us_url_root.'users/account.php'); ?>
			</div>
		</div>
	</div>
</div>
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; ?>
