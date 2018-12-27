<?php



class AMC_304b_1_STG2 extends AbstractAmcReport
{
    public function getTitle()
    {
        return "AMC_304b_1_STG2";
    }

    public function getObjectToCount()
    {
        return "prescriptions";
    }
 
    public function createDenominator()
    {
        return new AMC_304b_1_STG2_Denominator();
    }
    
    public function createNumerator()
    {
        return new AMC_304b_1_STG2_Numerator();
    }
}
