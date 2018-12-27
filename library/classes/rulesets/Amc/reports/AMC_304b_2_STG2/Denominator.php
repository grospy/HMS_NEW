<?php

// Denominator:
// Reporting period start and end date
// Prescription written for drugs requiring a prescription in order to be dispensed
// Denominator exclusion:
// Prescription written for controlled substance
// Generate and transmit permissible prescriptions electronically (other than controlled substances) queried for drug formulary).( AMC-2014:170.314(g)(1)/(2)-8 )

class AMC_304b_2_STG2_Denominator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_304b_2_STG2 Denominator";
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
