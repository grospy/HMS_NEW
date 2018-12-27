<?php


class AMC_304a_1_Denominator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_304a_1 Denominator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        // MEASURE STAGE2: Radiology Order(s) Created checking
        return true;
    }
}
