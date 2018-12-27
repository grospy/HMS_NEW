<?php

class AMC_304b_STG1_Numerator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_304b_STG1 Numerator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        // The number of prescriptions in the denominator transmitted electronically.
        $amcElement = amcCollect('e_prescribe_amc', $patient->id, 'prescriptions', $patient->object['id']);
        if (!(empty($amcElement))) {
            return true;
        } else {
            return false;
        }
    }
}
