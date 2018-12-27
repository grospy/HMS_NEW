<?php


class AMC_314g_1_2_14_STG2_Numerator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_314g_1_2_14_STG2 Numerator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        // Need to meet following criteria:
        //  -Offsite patient portal is turned on.
        //  -Patient permits having access to the patient portal.
        //  -Patient has an account on the offsite patient portal.

        if ($GLOBALS['portal_offsite_enable'] != 1) {
            return false;
        }

        $portal_permission = sqlQuery("SELECT `allow_patient_portal` FROM `patient_data` WHERE pid = ?", array($patient->id));
        if ($portal_permission['allow_patient_portal'] != "YES") {
            return false;
        }
                
        $portalQry = "SELECT count(*) as cnt FROM `patient_access_offsite` WHERE pid=?";
        $check = sqlQuery($portalQry, array($patient->id));
        if ($check['cnt'] > 0) {
            return true;
        } else {
            return false;
        }
    }
}
