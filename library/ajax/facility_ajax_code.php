<?php
//While creating new encounter this code is used to change the "Billing Facility:".
//This happens on change of the "Facility:" field.





//
require_once("../../interface/globals.php");
require_once("$srcdir/options.inc.php");

$pid=$_REQUEST['pid'];
$facility=$_REQUEST['facility'];
$date=$_REQUEST['date'];
$q=sqlStatement("SELECT pc_billing_location FROM openemr_postcalendar_events WHERE pc_pid=? AND pc_eventDate=? AND pc_facility=?", array($pid,$date,$facility));
$row=sqlFetchArray($q);
billing_facility('billing_facility', $row['pc_billing_location']);
