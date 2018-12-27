<?php



class AMC_304b_STG1 extends AbstractAmcReport
{
    public function getTitle()
    {
        return "AMC_304b_STG1";
    }

    public function getObjectToCount()
    {
        return "prescriptions";
    }
 
    public function createDenominator()
    {
        return new AMC_304b_STG1_Denominator();
    }
    
    public function createNumerator()
    {
        return new AMC_304b_STG1_Numerator();
    }
}
