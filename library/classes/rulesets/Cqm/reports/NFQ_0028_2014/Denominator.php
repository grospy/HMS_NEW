<?php

 
class NFQ_0028_2014_Denominator implements CqmFilterIF
{
    public function getTitle()
    {
        return "NFQ 0028b Denominator";
    }

    public function test(CqmPatient $patient, $beginDate, $endDate)
    {
        return true;
    }
}
