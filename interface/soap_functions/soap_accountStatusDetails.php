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

$accountStatus = $eRxSOAP->getAccountStatus()
    ->GetAccountStatusResult->accountStatusDetail;

?>
<head>
    <link rel="stylesheet" href="<?php echo $css_header; ?>" type="text/css">
</head>
<body class='body_top'>
    <table class='text' align=center width='90%' height='80%' style='padding-top:6%'>
        <tr>
            <th colspan=2><?php echo xlt('eRx Account Status'); ?></th>
        </tr>
        <tr>
            <td><?php echo xlt('Pending Rx Count'); ?></td>
            <td><?php echo $accountStatus->PendingRxCount;?></td>
        </tr>
        <tr>
            <td><?php echo xlt('Alert Count'); ?></td>
            <td><?php echo $accountStatus->AlertCount;?></td>
        </tr>
        <tr>
            <td><?php echo xlt('Fax Count'); ?></td>
            <td><?php echo $accountStatus->FaxCount;?></td>
        </tr>
        <tr>
            <td><?php echo xlt('Pharm Com Count'); ?></td>
            <td><?php echo $accountStatus->PharmComCount;?></td>
        </tr>
    </table>
</body>
