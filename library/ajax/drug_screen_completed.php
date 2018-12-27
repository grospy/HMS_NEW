<?php




require_once("../../interface/globals.php");

$drugval = '0';
if ($_POST['testcomplete'] =='true') {
    $drugval = '1';
}

$tracker_id = $_POST['trackerid'];
if ($tracker_id != 0) {
       sqlStatement("UPDATE patient_tracker SET " .
           "drug_screen_completed = ? " .
           "WHERE id =? ", array($drugval,$tracker_id));
}
