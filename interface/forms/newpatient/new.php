<?php


include_once("../../globals.php");
include_once("$srcdir/acl.inc");
include_once("$srcdir/lists.inc");

// Check permission to create encounters.
$tmp = getPatientData($pid, "squad");
if (($tmp['squad'] && ! acl_check('squads', $tmp['squad'])) ||
  !acl_check_form('newpatient', '', array('write', 'addonly'))) {
    echo "<body>\n<html>\n";
    echo "<p>(" . xlt('New encounters not authorized') . ")</p>\n";
    echo "</body>\n</html>\n";
    exit();
}

$viewmode = false;
require_once("common.php");
