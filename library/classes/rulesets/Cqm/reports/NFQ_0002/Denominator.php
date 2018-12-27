<?php

 
class NFQ_0002_Denominator implements CqmFilterIF
{
    public function getTitle()
    {
        return "Denominator";
    }
    
    public function test(CqmPatient $patient, $beginDate, $endDate)
    {
        //Same as initial population
        return true;
    }
}
