<?php


require_once("$include_root/globals.php");
require_once("$srcdir/pnotes.inc");
require_once("$srcdir/patient.inc");
require_once("$srcdir/auth.inc");

function lab_results_messages($set_pid, $rid, $provider_id = "")
{
    global $userauthorized;
    if ($provider_id != "") {
        $where = "AND id = '".$provider_id."'";
    }

    // Get all active users.
    $rez = sqlStatement("select id, username from users where username != '' AND active = '1' $where");
    for ($iter = 0; $row = sqlFetchArray($rez); $iter++) {
        $result[$iter] = $row;
    }

    if (!empty($result)) {
        foreach ($result as $user_detail) {
            unset($thisauth); // Make sure it is empty.
            // Check user authorization. Only send the panding review message to authorised user.
            // $thisauth = acl_check('patients', 'sign', $user_detail['username']);

            // Route message to administrators if there is no provider match.
            if ($provider_id == "") {
                $thisauth = acl_check('admin', 'super', $user_detail['username']);
            } else {
                $thisauth = true;
            }

            if ($thisauth) {
                // Send lab result message to the ordering provider when there is a new lab report.
                $pname = getPatientName($set_pid);
                $link = "<a href='../../orders/orders_results.php?review=1&set_pid=$set_pid'" .
                " onclick='return top.restoreSession()'>here</a>";
                $note = "Patient $pname's lab results have arrived. Please click $link to review them.<br/>";
                $note_type = "Lab Results";
                $message_status = "New";
                // Add pnote.
                $noteid = addPnote($set_pid, $note, $userauthorized, '1', $note_type, $user_detail['username'], '', $message_status);
            }
        }
    }
}
