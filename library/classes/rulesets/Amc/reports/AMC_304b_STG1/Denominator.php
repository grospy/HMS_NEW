<?php

// Denominator: 
// Number of prescriptions written for drugs requiring a prescription in order to be
// dispensed other than controlled substances during the EHR reporting period

class AMC_304b_STG1_Denominator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_304b_STG1 Denominator";
    }

    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        // Check if prescription is for a controlled substance
        $controlledSubstanceCheck = amcCollect('e_prescribe_cont_subst_amc', $patient->id, 'prescriptions', $patient->object['id']);
        // Exclude controlled substances
        if (empty($controlledSubstanceCheck)) {
            // Not a controlled substance, so include in denominator.
            return true;
        } else {
            // Is a controlled substance, so exclude from denominator.
            return false;
        }
    }
}
