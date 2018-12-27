<?php



class AMC_302m_STG2 extends AbstractAmcReport
{
    public function getTitle()
    {
        return "AMC_302m_STG2";
    }

    public function getObjectToCount()
    {
        return "patients";
    }
 
    public function createDenominator()
    {
        return new AMC_302m_STG2_Denominator();
    }
    
    public function createNumerator()
    {
        return new AMC_302m_STG2_Numerator();
    }
}
