<?php

 ?>
<?php require_once '../users/init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>
<div id="page-wrapper">
<div class="container">
<?php
$settingsQ = $db->query("SELECT * FROM settings");
$settings = $settingsQ->first();
if($user->isLoggedIn()) Redirect::to($us_url_root.'index.php');
//Decide whether or not to use email activation
$query = $db->query("SELECT * FROM email");
$results = $query->first();
$act = $results->email_act;

if($act == 1) {
	require $abs_us_root.$us_url_root.'users/views/_joinThankYou_verify.php';
}else{
	require $abs_us_root.$us_url_root.'users/views/_joinThankYou.php';
}

?>
</div>
</div>
<!-- Content Ends Here -->
<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
