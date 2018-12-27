<?php



include_once("../../globals.php");
include_once("$srcdir/api.inc");
include_once("$srcdir/forms.inc");

if (!$encounter) { // comes from globals.php
    die(xlt("Internal error: we do not seem to be in an encounter!"));
}

$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');
$code = $_POST["code"];
$code_text = $_POST["codetext"];
$code_date = $_POST["code_date"];
$code_des = $_POST["description"];
$count = $_POST["count"];
$care_plan_type = $_POST['care_plan_type'];

if ($id && $id != 0) {
    sqlStatement("DELETE FROM `form_care_plan` WHERE id=? AND pid = ? AND encounter = ?", array($id, $_SESSION["pid"], $_SESSION["encounter"]));
    $newid = $id;
} else {
    $res2 = sqlStatement("SELECT MAX(id) as largestId FROM `form_care_plan`");
    $getMaxid = sqlFetchArray($res2);
    if ($getMaxid['largestId']) {
        $newid = $getMaxid['largestId'] + 1;
    } else {
        $newid = 1;
    }

    addForm($encounter, "Care Plan Form", $newid, "care_plan", $_SESSION["pid"], $userauthorized);
}

$count = array_filter($count);
if (!empty($count)) {
    foreach ($count as $key => $codeval) :
        $code_val = $code[$key] ? $code[$key] : 0;
        $codetext_val = $code_text[$key] ? $code_text[$key] :'NULL';
        $description_val = $code_des[$key] ? $code_des[$key] : 'NULL';
        $care_plan_type_val = $care_plan_type[$key] ? $care_plan_type[$key] : 'NULL';
        $sets = "id    = ". add_escape_custom($newid) .",
            pid        = ". add_escape_custom($_SESSION["pid"]) .",
            groupname  = '" . add_escape_custom($_SESSION["authProvider"]) . "',
            user       = '" . add_escape_custom($_SESSION["authUser"]) . "',
            encounter  = '" . add_escape_custom($_SESSION["encounter"]) . "',
            authorized = ". add_escape_custom($userauthorized) .",
            activity   = 1,
            code       = '" . add_escape_custom($code_val) . "',
            codetext   = '" . add_escape_custom($codetext_val) . "',
            description= '" . add_escape_custom($description_val) . "',
            date       =  '" . add_escape_custom($code_date[$key]) . "',
            care_plan_type = '" .add_escape_custom($care_plan_type_val). "'";
        sqlInsert("INSERT INTO form_care_plan SET $sets");
    endforeach;
}

$_SESSION["encounter"] = $encounter;
formHeader("Redirecting....");
formJump();
formFooter();
