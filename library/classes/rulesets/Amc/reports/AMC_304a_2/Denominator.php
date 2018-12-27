<?php


class AMC_304a_2_Denominator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_304a_2 Denominator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        // MEASURE STAGE2: Procedure Order(s) Check
        return true;
    }
}
