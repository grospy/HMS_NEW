<?php



class AMC_304i_STG1 extends AbstractAmcReport
{
    public function getTitle()
    {
        return "AMC_304i_STG1";
    }

    public function getObjectToCount()
    {
        return "transitions-out";
    }
 
    public function createDenominator()
    {
        return new AMC_304i_STG1_Denominator();
    }
    
    public function createNumerator()
    {
        return new AMC_304i_STG1_Numerator();
    }
}
