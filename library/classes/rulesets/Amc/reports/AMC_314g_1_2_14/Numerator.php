<?php


class AMC_314g_1_2_14_Numerator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_314g_1_2_14 Numerator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        // The number of unique patients (or their authorized representatives) in
                // the denominator who have viewed online, downloaded, or transmitted to a
                // third party the patient's health information.
                //
                // Still TODO
                // AMC MU2 TODO :
                // This needs to be converted to the Z&H offsite portal solution.

                $check = sqlQuery('select count(id) as count from ccda where pid = ? and (view = 1 or emr_transfer = 1) and user_id is null and updated_date >= ? and updated_date <= ?', array($patient->id,$beginDate,$endDate));
        if ($check['count'] > 0) {
            return true;
        } else {
            return false;
        }
    }
}
