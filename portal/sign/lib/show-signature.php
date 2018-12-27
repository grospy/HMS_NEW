<?php





$ignoreAuth = true;
require_once("../../../interface/globals.php");

$errors = array ();
// @TODO sanatize these
$pid = $_GET ['pid'];
$user = $_GET ['user'];
$type = $_GET ['type'];
$signer = $_GET ['signer'];

if ($pid == 0 || empty($user)) {
    if ($type != 'admin-signature' || empty($user)) {
        echo ('error');
        return;
    }
}

$sig_hash = sha1($output);
$created = time();
$ip = $_SERVER ['REMOTE_ADDR'];
$status = 'filed';
$lastmod = date('Y-m-d H:i:s');
if ($type == 'admin-signature') {
    $pid = 0;
    $row = sqlQuery("SELECT pid,status,sig_image,type,user FROM onsite_signatures WHERE user=? && type=?", array($user,$type));
} else {
    $row = sqlQuery("SELECT pid,status,sig_image,type,user FROM onsite_signatures WHERE pid=?", array($pid));
}

if (!$row ['pid'] && !$row ['user']) {
    $status = 'waiting';
    $qstr = "INSERT INTO onsite_signatures (pid,lastmod,status,type,user,signator,created) VALUES (?,?,?,?,?,?,?) ";
    sqlStatement($qstr, array($pid,$lastmod, $status,$type,$user,$signer,$created));
}

if ($row ['status'] == 'filed') {
    header("Content-Type: image/png");
    echo $row ['sig_image'];
    return;
} else if ($row ['status'] == 'waiting' || $status  == 'waiting') {
    echo 'waiting';
    return;
}
