<?php


class AMC_304i_STG2_Numerator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_304i_STG2 Numerator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        //The number of transitions of care and referrals in the denominator where a summary of care record was electronically transmitted using CEHRT to a recipient.
        //  (so basically both amc elements of send_sum_amc and send_sum_elec_amc needs to exist)

        $amcElement_elec = amcCollect('send_sum_elec_amc', $patient->id, 'transactions', $patient->object['id']);
        $amc_elec_check  = sqlQuery('select count(*) as cnt from ccda where pid = ? and emr_transfer = 1', array($patient->id));
        if (!(empty($amcElement_elec))) {
            $no_problems = sqlQuery("select count(*) as cnt from lists_touch where pid = ? and type = 'medical_problem'", array($patient->id));
            $problems    = sqlQuery("select count(*) as cnt from lists where pid = ? and type = 'medical_problem'", array($patient->id));
                
            $no_allergy = sqlQuery("select count(*) as cnt from lists_touch where pid = ? and type = 'allergy'", array($patient->id));
            $allergies  = sqlQuery("select count(*) as cnt from lists where pid = ? and type = 'allergy'", array($patient->id));
                
            $no_medication = sqlQuery("select count(*) as cnt from lists_touch where pid = ? and type = 'medication'", array($patient->id));
            $medications   = sqlQuery("select count(*) as cnt from lists where pid = ? and type = 'medication'", array($patient->id));
            $prescriptions = sqlQuery("select count(*) as cnt from prescriptions where patient_id = ? ", array($patient->id));

            if (($no_problems['cnt'] > 0 || $problems['cnt'] > 0) && ($no_allergy['cnt'] > 0 || $allergies['cnt'] > 0) && ($no_medication['cnt'] > 0 || $medications['cnt'] > 0 || $prescriptions['cnt'] > 0)) {
                return true;
            }
            
            return false;
        } else {
            return false;
        }
    }
}
