<?php





// Set the GET auth parameter to logout.
//  This parameter is then captured in the auth.inc script (which is included in globals.php script) and does the following:
//    1. Logs out user
//    2. Closes the php session
//    3. Redirects user to the login screen (maintains the site id)
$_GET['auth'] = "logout";
require_once("globals.php");
