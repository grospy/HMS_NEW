<?php



class AMC_302f_3_STG1 extends AbstractAmcReport
{
    public function getTitle()
    {
        return "AMC_302f_3_STG1";
    }

    public function getObjectToCount()
    {
        return "patients";
    }
 
    public function createDenominator()
    {
        return new AMC_302f_3_STG1_Denominator();
    }
    
    public function createNumerator()
    {
        return new AMC_302f_3_STG1_Numerator();
    }
}
