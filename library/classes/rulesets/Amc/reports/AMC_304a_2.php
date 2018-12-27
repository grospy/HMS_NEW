<?php


class AMC_304a_2 extends AbstractAmcReport
{
    public function getTitle()
    {
        return "AMC_304a_2";
    }

    public function getObjectToCount()
    {
        return "cpoe_lab_orders";
    }
 
    public function createDenominator()
    {
        return new AMC_304a_2_Denominator();
    }
    
    public function createNumerator()
    {
        return new AMC_304a_2_Numerator();
    }
}
