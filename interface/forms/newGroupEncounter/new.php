<?php





include_once("../../globals.php");
include_once("$srcdir/acl.inc");
include_once("$srcdir/lists.inc");

// todo -include_once("$srcdir/groups.inc");


/*// todo Check permission to create encounters.
$tmp = getGroupData($pid, "squad");
if (($tmp['squad'] && ! acl_check('squads', $tmp['squad'])) ||
     ! (acl_check('encounters', 'notes_a' ) ||
        acl_check('encounters', 'notes'   ) ||
        acl_check('encounters', 'coding_a') ||
        acl_check('encounters', 'coding'  ) ||
        acl_check('encounters', 'relaxed' )))
{
  echo "<body>\n<html>\n";
  echo "<p>(" . xlt('New encounters not authorized'). ")</p>\n";
  echo "</body>\n</html>\n";
  exit();
}*/

$viewmode = false;
if (acl_check("groups", "glog", false, 'write')) {
    require_once("common.php");
} else {
    echo xlt("access not allowed");
}
