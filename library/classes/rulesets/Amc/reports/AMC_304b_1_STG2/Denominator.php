<?php

// Denominator:
// Reporting period start and end date
// Prescription written for drugs requiring a prescription in order to be dispensed(including controlled substance)
class AMC_304b_1_STG2_Denominator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_304b_1_STG2 Denominator";
    }

    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        return true;
    }
}
