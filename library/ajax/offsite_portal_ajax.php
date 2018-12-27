<?php



require_once(dirname(__FILE__)."/../../interface/globals.php");
require_once("$srcdir/acl.inc");
require_once(dirname(__FILE__)."/../../myportal/soap_service/portal_connectivity.php");

if ($_POST['action'] == 'check_file' && acl_check('admin', 'super')) {
    $client = portal_connection();
    $error_message = '';
    try {
        $response = $client->getPortalConnectionFiles($credentials);
    } catch (SoapFault $e) {
        error_log('SoapFault Error');
        $error_message = xlt('Patient Portal connectivity issue');
    } catch (Exception $e) {
        error_log('Exception Error');
        $error_message = xlt('Patient Portal connectivity issue');
    }

    if ($response['status'] == 1) {
        if ($response['value'] != '') {
            echo "OK";
        } else {
            echo $error_message;
        }
    } else {
        echo xlt('Offsite Portal web Service Failed').": ".text($response['value']);
    }
}
