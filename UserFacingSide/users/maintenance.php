<?php

require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
//if (!securePage($_SERVER['PHP_SELF'])){die();}

$settingsQ = $db->query("SELECT * FROM settings");
$settings = $settingsQ->first();
if($settings->site_offline==0) Redirect::to($us_url_root.'index.php');
?>
<!-- Do what you want here -->
<div id="page-wrapper">
	<div class="container-fluid">

<div class="row">
	<div class="col-xs-12">
		<div class="jumbotron">

			<div class="col-xs-12 col-md-2">
				<h1 style="font-size: 140px; color: #FFD700; text-align:center"><i class="glyphicon glyphicon-warning-sign"></i></h1>
			</div>

			<div class="col-xs-12 col-md-10">

				<article>

				    <h3>We&rsquo;ll be back soon!</h3>

				        <p>Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment.<br> We&rsquo;ll be back online shortly!</p>
				        <p>&mdash; The <?=$settings->site_name?> Team</p>

				</article>
			</div>

			<div class="clearfix"></div>

		</div>
	</div>
</div>

</div> <!-- /container -->

</div> <!-- /#page-wrapper -->

<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
