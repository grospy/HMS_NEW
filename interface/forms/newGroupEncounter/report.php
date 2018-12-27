<?php




include_once(dirname(__file__)."/../../globals.php");
require_once("$srcdir/group.inc");

function newGroupEncounter_report($group_id, $encounter, $cols, $id)
{
    $res = sqlStatement("select * from form_groups_encounter where group_id=? and id=?", array($group_id,$id));
    print "<table><tr><td>\n";
    while ($result = sqlFetchArray($res)) {
        print "<span class=bold>" . xlt('Facility') . ": </span><span class=text>" . text($result["facility"]) . "</span><br>\n";
        if (acl_check('sensitivities', $result['sensitivity'])) {
            print "<span class=bold>" . xlt('Reason') . ": </span><span class=text>" . nl2br(text($result["reason"])) . "</span><br>\n";
            $counselors ='';
            foreach (explode(',', $result["counselors"]) as $userId) {
                $counselors .= getUserNameById($userId) . ', ';
            }

            $counselors = rtrim($counselors, ", ");
            print "<span class=bold>" . xlt('Counselors') . ": </span><span class=text>" . nl2br(text($counselors)) . "</span><br>\n";
        }
    }

    print "</td></tr></table>\n";
}
