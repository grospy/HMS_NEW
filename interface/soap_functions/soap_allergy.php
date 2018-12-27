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
    || $eRxSOAP->elapsedTTL(eRxSOAP::ACTION_ALLERGIES)
    || $eRxSOAP->checkPatientImportStatus(eRxSOAP::FLAG_ALLERGY_PRESS)
) {
    $eRxSOAP->insertUpdateAllergies();

    $message = $eRxSOAP->updateUploadedErx()
        ? xl('Allergy import successfully completed')
        : xl('Nothing to import for Allergy');

    $eRxSOAP->updatePatientImportStatus(eRxSOAP::FLAG_ALLERGY_IMPORT)
        ->updateTTL(eRxSOAP::ACTION_ALLERGIES);
} else {
    $message = xl('Import deferred for time-to-live');
}

echo text($message);
