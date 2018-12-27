<?php


class AMC_304h_STG2 extends AbstractAmcReport
{
    public function getTitle()
    {
        return "AMC_304h_STG2";
    }

    public function getObjectToCount()
    {
        return "encounters_office_visit";
    }
 
    public function createDenominator()
    {
        return new AMC_304h_STG2_Denominator();
    }
    
    public function createNumerator()
    {
        return new AMC_304h_STG2_Numerator();
    }
}
