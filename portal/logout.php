<?php


require_once(dirname(__FILE__)."/lib/appsql.class.php");

//continue session
session_start();
$logit = new ApplicationTable();
$logit->portalLog('logout', $_SESSION['pid'], ($_SESSION['portal_username'].': '.$_SESSION['ptName'].':success'));
//landing page definition -- where to go after logout
$landingpage = "index.php?site=".$_SESSION['site_id'];

//log out by killing the session
session_destroy();

//redirect to pretty login/logout page
header('Location: '.$landingpage.'&logout');
//
