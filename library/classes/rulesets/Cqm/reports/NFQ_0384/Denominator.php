<?php

 
class NFQ_0384_Denominator implements CqmFilterIF
{
    public function getTitle()
    {
        return "Denominator";
    }
    
    public function test(CqmPatient $patient, $beginDate, $endDate)
    {
        return true;
    }
}
