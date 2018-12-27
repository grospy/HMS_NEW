<?php



require_once(__DIR__.'/../globals.php');
require_once($GLOBALS['fileroot'].'/interface/eRxGlobals.php');
require_once($GLOBALS['fileroot'].'/interface/eRxStore.php');
require_once($GLOBALS['srcdir'].'/xmltoarray_parser_htmlfix.php');
require_once($GLOBALS['srcdir'].'/lists.inc');
require_once($GLOBALS['srcdir'].'/amc.php');
require_once($GLOBALS['fileroot'].'/interface/eRxSOAP.php');
require_once($GLOBALS['fileroot'].'/interface/eRx_xml.php');

set_time_limit(0);

$eRxSOAP = new eRxSOAP;
$eRxSOAP->setGlobals(new eRxGlobals($GLOBALS))
    ->setStore(new eRxStore)
    ->setAuthUserId($_SESSION['authUserID']);

if (array_key_exists('patient', $_REQUEST)) {
    $eRxSOAP->setPatientId($_REQUEST['patient']);
} elseif (array_key_exists('pid', $GLOBALS)) {
    $eRxSOAP->setPatientId($GLOBALS['pid']);
}

if ((array_key_exists('refresh', $_REQUEST)
        && $_REQUEST['refresh'] == 'true')
    || $eRxSOAP->elapsedTTL(eRxSOAP::ACTION_MEDICATIONS)
    || $eRxSOAP->checkPatientImportStatus(eRxSOAP::FLAG_PRESCRIPTION_PRESS)
) {
    $insertedRows = $eRxSOAP->insertUpdateMedications();

    $message = $insertedRows
        ? xl('Prescription History import successfully completed')
        : xl('Nothing to import for Prescription');

    $eRxSOAP->updatePatientImportStatus(eRxSOAP::FLAG_PRESCRIPTION_IMPORT)
        ->updateTTL(eRxSOAP::ACTION_MEDICATIONS);
} else {
    $message = xl('Import deferred for time-to-live');
}

echo text($message);
