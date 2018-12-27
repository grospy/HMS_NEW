<?php




require_once(dirname(__FILE__) . "/../../interface/globals.php");
require_once(dirname(__FILE__) . "/../report_database.inc");

//  Collect/bookmark a new report id in report_results sql table and send it back.
if (!empty($_POST['status_report_id'])) {
    echo getStatusReportDatabase($_POST['status_report_id']);
} else {
    echo "ERROR";
}
