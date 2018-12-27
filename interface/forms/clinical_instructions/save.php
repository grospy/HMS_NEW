<?php



include_once("../../globals.php");
include_once("$srcdir/api.inc");
include_once("$srcdir/forms.inc");

if (!$encounter) { // comes from globals.php
    die(xlt("Internal error: we do not seem to be in an encounter!"));
}

$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');
$instruction = $_POST["instruction"];

if ($id && $id != 0) {
    sqlInsert("UPDATE form_clinical_instructions SET instruction =? WHERE id = ?", array($instruction, $id));
} else {
    $newid = sqlInsert("INSERT INTO form_clinical_instructions (pid,encounter,user,instruction) VALUES (?,?,?,?)", array($pid, $encounter, $_SESSION['authUser'], $instruction));
    addForm($encounter, "Clinical Instructions", $newid, "clinical_instructions", $pid, $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();
