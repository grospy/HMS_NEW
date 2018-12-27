<?php




require_once("../../../globals.php");
require_once("fee_sheet_options_queries.php");

if (!acl_check('acct', 'bill')) {
    header("HTTP/1.0 403 Forbidden");
    echo "Not authorized for billing";
    return false;
}

if (isset($_REQUEST['pricelevel'])) {
    $pricelevel=$_REQUEST['pricelevel'];
} else {
    $pricelevel='standard';
}

$fso=load_fee_sheet_options($pricelevel);
$retval=array();
$retval['fee_sheet_options']=$fso;
$retval['pricelevel']=$pricelevel;
echo json_encode($retval);