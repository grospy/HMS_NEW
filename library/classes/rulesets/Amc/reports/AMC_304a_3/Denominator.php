<?php


class AMC_304a_3_Denominator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_304a_3 Denominator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        // MEASURE STAGE2: Medication Order(s) Check
        if ((Helper::checkAnyEncounter($patient, $beginDate, $endDate, $options))) {
            return true;
        }

        return false;
    }
}
