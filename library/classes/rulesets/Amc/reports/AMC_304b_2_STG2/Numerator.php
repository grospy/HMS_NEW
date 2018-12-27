<?php


class AMC_304b_2_STG2_Numerator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_304b_2_STG2 Numerator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        //The number of prescriptions in the denominator generated, queried for a drug formulary and transmitted electronically
        $eprescribe = amcCollect('e_prescribe_amc', $patient->id, 'prescriptions', $patient->object['id']);
        $checkformulary = amcCollect('e_prescribe_chk_formulary_amc', $patient->id, 'prescriptions', $patient->object['id']);
        if (!(empty($eprescribe)) && !(empty($checkformulary))) {
            return true;
        } else {
            return false;
        }
    }
}
