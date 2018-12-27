<?php




require_once("../interface/globals.php");
require_once("$srcdir/log.inc");


    $valid  = true;
    $errors = array();
    catch_logs();
    $sql = sqlStatement("select * from log_validator");
while ($row = sqlFetchArray($sql)) {
    $logEntry = sqlQuery("select * from log where id = ?", array($row['log_id']));
    if (empty($logEntry)) {
        $valid = false;
        array_push($errors, xl("Following audit log entry number is missing") . ": " . $row['log_id']);
    } else if ($row['log_checksum'] != $logEntry['checksum']) {
        $valid = false;
        array_push($errors, xl("Audit log tampering evident at entry number") . " " . $row['log_id']);
    }

    if (!$valid) {
        break;
    }
}

if ($valid) {
    echo xl("Audit Log Validated Successfully");
} else {
    echo xl("Audit Log Validation Failed") . "(ERROR:: $errors[0])";
}

function catch_logs()
{
    $sql  = sqlStatement("select * from log where id not in(select log_id from log_validator) and checksum is NOT null and checksum != ''");
    while ($row = sqlFetchArray($sql)) {
        sqlInsert("INSERT into log_validator (log_id,log_checksum) VALUES(?,?)", array($row['id'],$row['checksum']));
    }
}
