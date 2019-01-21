<?php

?>
<?php require_once '../users/init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>
<?php
if(!in_array($user->data()->id,$master_account)){die();}
if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
//Errors Successes
$errors = [];
$successes = [];
 //Forms posted
if(!empty($_POST)) {

}

?>
<div id="page-wrapper">
	<div class="container-fluid">
		<?php require_once($abs_us_root.$us_url_root.'users/views/_form_manager_menu.php');?>
	<div class="row">
		<div class="col-xs-6">
				<?php require_once($abs_us_root.$us_url_root."users/views/_form_existing_forms.php");?>
		</div>
			<div class="col-xs-6">
				<?php require_once($abs_us_root.$us_url_root."users/views/_form_existing_views.php");?>
			</div>
			</div>
	</div>



	</div>
	<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; ?>

	<script>
	$(document).ready(function() {
	    $('#forms').DataTable({"pageLength": 25,"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]], "aaSorting": []});
			$('#views').DataTable({"pageLength": 25,"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]], "aaSorting": []});
	} );
	</script>
	<script src="../users/js/pagination/jquery.dataTables.js" type="text/javascript"></script>
	<script src="../users/js/pagination/dataTables.js" type="text/javascript"></script>
	<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; ?>
