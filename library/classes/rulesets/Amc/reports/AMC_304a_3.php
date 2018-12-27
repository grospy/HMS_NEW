<?php



class AMC_304a_3 extends AbstractAmcReport
{
    public function getTitle()
    {
        return "AMC_304a_3";
    }

    public function getObjectToCount()
    {
           return "med_orders";
    }
 
    public function createDenominator()
    {
        return new AMC_304a_3_Denominator();
    }
    
    public function createNumerator()
    {
        return new AMC_304a_3_Numerator();
    }
}
