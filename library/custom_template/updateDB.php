<?php




require_once("../../interface/globals.php");

$action         = $_POST['action'];
$updateRecordsArray     = $_POST['clorder'];

if ($action == "updateRecordsListings") {
    $listingCounter = 1;
    foreach ($updateRecordsArray as $recordIDValue) {
        $query = "UPDATE template_users SET tu_template_order = ? WHERE tu_template_id = ? AND tu_user_id=?";
        sqlStatement($query, array($listingCounter,$recordIDValue,$_SESSION['authId']));
        $listingCounter = $listingCounter + 1;
    }
}
