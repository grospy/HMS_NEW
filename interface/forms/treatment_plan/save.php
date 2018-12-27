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
  provider               = '" . add_escape_custom($_POST["provider"]) . "',
  client_name            = '" . add_escape_custom($_POST["client_name"]) . "',
  client_number          = '" . add_escape_custom($_POST["client_number"]) . "',
  admit_date             =  '" . add_escape_custom($_POST["admit_date"]) . "',
  presenting_issues          = '" . add_escape_custom($_POST["presenting_issues"]) . "',
  patient_history            =  '" . add_escape_custom($_POST["patient_history"]) . "',
  medications                = '" . add_escape_custom($_POST["medications"]) . "',
  anyother_relevant_information          = '" . add_escape_custom($_POST["anyother_relevant_information"]) . "',
  diagnosis                    = '" . add_escape_custom($_POST["diagnosis"]) . "',
  treatment_received           = '" . add_escape_custom($_POST["treatment_received"]) . "',
  recommendation_for_follow_up                    = '" . add_escape_custom($_POST["recommendation_for_follow_up"]) . "'";
  

  
if (empty($id)) {
    $newid = sqlInsert("INSERT INTO form_treatment_plan SET $sets");
    addForm($encounter, "Treatment Plan", $newid, "treatment_plan", $pid, $userauthorized);
} else {
    sqlStatement("UPDATE form_treatment_plan SET $sets WHERE id = '". add_escape_custom("$id"). "'");
}

$_SESSION["encounter"] = $encounter;
formHeader("Redirecting....");
formJump();
formFooter();
