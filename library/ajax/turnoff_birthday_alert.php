<?php


require_once(dirname(__FILE__) . "/../../interface/globals.php");
use OpenEMR\Reminder\BirthdayReminder;

if (!empty($_POST['pid']) && !empty($_POST['user_id'])) {
    $birthdayReminder = new BirthdayReminder($_POST['pid'], $_POST['user_id']);
    $birthdayReminder->birthdayAlertResponse($_POST['turnOff']);
}
