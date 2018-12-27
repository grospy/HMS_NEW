<?php


class AMC_314g_1_2_21 extends AbstractAmcReport
{
    public function getTitle()
    {
        return "AMC_314g_1_2_21";
    }

    public function getObjectToCount()
    {
        return "patients";
    }
 
    public function createDenominator()
    {
        return new AMC_314g_1_2_21_Denominator();
    }
    
    public function createNumerator()
    {
        return new AMC_314g_1_2_21_Numerator();
    }
}
