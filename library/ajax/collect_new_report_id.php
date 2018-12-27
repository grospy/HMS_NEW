<?php




require_once(dirname(__FILE__) . "/../../interface/globals.php");
require_once(dirname(__FILE__) . "/../report_database.inc");

//  Collect/bookmark a new report id in report_results sql table and send it back.
echo bookmarkReportDatabase();
