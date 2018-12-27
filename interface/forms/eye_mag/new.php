<?php





include_once("../../globals.php");
include_once("$srcdir/api.inc");

$form_name = "Eye Exam";
$table_name = "form_eye_mag";
$form_folder = "eye_mag";
include_once("../../forms/".$form_folder."/php/".$form_folder."_functions.php");
formHeader("Form: ".$form_name);
$returnurl = 'encounter_top.php';

$pid = $_REQUEST['pid'];

if (!$pid) {
    $pid = $_SESSION['pid'];
} else {
    $_SESSION['pid'] = $pid;
}

if (!$user) {
    $user = $_SESSION['authUser'];
}

if (!$group) {
    $group = $_SESSION['authProvider'];
}

if (!$_SESSION['encounter']) {
    $encounter = date("Ymd");
} else {
    $encounter=$_SESSION['encounter'];
}

$query = "select * from form_encounter where pid =? and encounter= ?";
$encounter_data = sqlQuery($query, array($pid,$encounter));
$encounter_date = $encounter_data['date'];

$query = "SELECT * " .
    "FROM form_encounter AS fe, forms AS f WHERE " .
    "fe.pid = ? AND fe.date = ? AND " .
    "f.formdir = ? AND f.encounter = fe.encounter AND f.deleted = 0";
$erow = sqlQuery($query, array($pid,$encounter_date,$form_folder));
    
if ($erow['form_id'] > '0') {
    formHeader("Redirecting....");
    formJump('./view_form.php?formname='.$form_folder.'&id='.attr($erow['form_id']).'&pid='.attr($pid));
    formFooter();
    exit;
} else {
    $id = $erow2['count']++;
    $providerid = findProvider(attr($pid), $encounter);
    $newid = formSubmit($table_name, $_POST, $id, $providerid);
    $sql = "insert into forms (date, encounter, form_name, form_id, pid, " .
            "user, groupname, authorized, formdir) values (NOW(),?,?,?,?,?,?,?,?)";//activity=1, date = NOW()
    $answer = sqlInsert($sql, array($encounter,$form_name,$newid,$pid,$user,$group,$providerid,$form_folder));
}
 
    formHeader("Redirecting....");
    formJump('./view_form.php?formname='.$form_folder.'&id='.attr($newid).'&pid='.attr($pid));
    formFooter();
    exit;
