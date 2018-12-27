<?php


class AMC_304a_1 extends AbstractAmcReport
{
    public function getTitle()
    {
        return "AMC_304a_1";
    }

    public function getObjectToCount()
    {
        return "lab_radiology";
    }
 
    public function createDenominator()
    {
        return new AMC_304a_1_Denominator();
    }
    
    public function createNumerator()
    {
        return new AMC_304a_1_Numerator();
    }
}
