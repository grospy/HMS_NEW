<?php


function portal_connection()
{
    global $credentials;
    $password   = $GLOBALS['portal_offsite_password'];
    $randkey    = '';
    $timminus = date("Y-m-d H:m", (strtotime(date("Y-m-d H:m"))-7200)).":00";
    sqlStatement("DELETE FROM audit_details WHERE audit_master_id IN(SELECT id FROM audit_master WHERE type=5 AND created_time<=?)", array($timminus));
    sqlStatement("DELETE FROM audit_master WHERE type=5 AND created_time<=?", array($timminus));
    do {
        $randkey    = substr(md5(rand().rand()), 0, 8);
        $res    = sqlStatement("SELECT * FROM audit_details WHERE field_value = ?", array($randkey));
        $cnt    = sqlNumRows($res);
    } while ($cnt>0);
    $password   = sha1($password.gmdate("Y-m-d H").$randkey);
    $grpID  = sqlInsert("INSERT INTO audit_master SET type=5");
    sqlStatement("INSERT INTO audit_details SET field_value=? , audit_master_id=?", array($randkey,$grpID));
    $credentials    = array($GLOBALS['portal_offsite_username'],$password,$randkey);
    //CALLING WEBSERVICE ON THE PATIENT-PORTAL
    $client     = new SoapClient(null, array(
            'location' => $GLOBALS['portal_offsite_address_patient_link']."/webservice/webserver.php",
            'uri'      => "urn://portal/req"
        ));
    return $client;
}
