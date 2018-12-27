<?php


class NFQ_0059_Denominator implements CqmFilterIF
{
    public function getTitle()
    {
        return "NQF 0059 Denominator";
    }

    public function test(CqmPatient $patient, $beginDate, $endDate)
    {
        // Same as IPP
        return true ;
    }
}
