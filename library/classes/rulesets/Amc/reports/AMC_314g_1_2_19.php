<?php



class AMC_314g_1_2_19 extends AbstractAmcReport
{
    public function getTitle()
    {
        return "AMC_314g_1_2_19";
    }

    public function getObjectToCount()
    {
        return "patients";
    }
 
    public function createDenominator()
    {
        return new AMC_314g_1_2_19_Denominator();
    }
    
    public function createNumerator()
    {
        return new AMC_314g_1_2_19_Numerator();
    }
}
