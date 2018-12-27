<?php

 
  
include_once("../../globals.php");
include_once("$srcdir/api.inc");
include_once("$srcdir/forms.inc");

if (! $encounter) { // comes from globals.php
    die(xl("Internal error: we do not seem to be in an encounter!"));
}


$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');

$sets = "pid = {$_SESSION["pid"]},
  groupname = '" . $_SESSION["authProvider"] . "',
  user = '" . $_SESSION["authUser"] . "',
  authorized = $userauthorized, activity=1, date = NOW(),
  provider          = '" . add_escape_custom($_POST["provider"]) . "',
  client_name          = '" . add_escape_custom($_POST["client_name"]) . "',
  transfer_to          = '" . add_escape_custom($_POST["transfer_to"]) . "',
  transfer_date          = '" . add_escape_custom($_POST["transfer_date"]) . "',
  status_of_admission          = '" . add_escape_custom($_POST["status_of_admission"]) . "',
  diagnosis          =  '" . add_escape_custom($_POST["diagnosis"]) . "',
  intervention_provided          =  '" . add_escape_custom($_POST["intervention_provided"]) . "',
  overall_status_of_discharge                    = '" . add_escape_custom($_POST["overall_status_of_discharge"]) ."'";

  
if (empty($id)) {
    $newid = sqlInsert("INSERT INTO form_transfer_summary SET $sets");
    addForm($encounter, "Transfer Summary", $newid, "transfer_summary", $pid, $userauthorized);
} else {
    sqlStatement("UPDATE form_transfer_summary SET $sets WHERE id = '". add_escape_custom("$id"). "'");
}

$_SESSION["encounter"] = $encounter;
formHeader("Redirecting....");
formJump();
formFooter();
