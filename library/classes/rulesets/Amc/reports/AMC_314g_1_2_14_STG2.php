<?php



class AMC_314g_1_2_14_STG2 extends AbstractAmcReport
{
    public function getTitle()
    {
        return "AMC_314g_1_2_14_STG2";
    }

    public function getObjectToCount()
    {
        return "patients";
    }
 
    public function createDenominator()
    {
        return new AMC_314g_1_2_14_STG2_Denominator();
    }
    
    public function createNumerator()
    {
        return new AMC_314g_1_2_14_STG2_Numerator();
    }
}
