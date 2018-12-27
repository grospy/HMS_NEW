<?php


class AMC_314g_1_2_20 extends AbstractAmcReport
{
    public function getTitle()
    {
        return "AMC_314g_1_2_20";
    }

    public function getObjectToCount()
    {
        return "image_orders";
    }
 
    public function createDenominator()
    {
        return new AMC_314g_1_2_20_Denominator();
    }
    
    public function createNumerator()
    {
        return new AMC_314g_1_2_20_Numerator();
    }
}
