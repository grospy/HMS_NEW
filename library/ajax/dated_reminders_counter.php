<?php




require_once("../../interface/globals.php");
require_once("$srcdir/dated_reminder_functions.php");
require_once("$srcdir/pnotes.inc");

//Collect number of due reminders
$dueReminders = GetDueReminderCount(5, strtotime(date('Y/m/d')));

//Collect number of active messages
$activeMessages = getPnotesByUser("1", "no", $_SESSION['authUser'], true);

$totalNumber = $dueReminders + $activeMessages;
echo ($totalNumber > 0 ? '('.text(intval($totalNumber)).')' : '');
