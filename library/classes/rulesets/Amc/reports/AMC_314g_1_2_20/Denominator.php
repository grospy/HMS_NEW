<?php


class AMC_314g_1_2_20_Denominator implements AmcFilterIF
{
    //
    // Still TODO
    // AMC MU2 TODO :
    //    In this case want a counter that lists the orders.
    //    Likely best to use labs-radiology counter or could do:
    //    Then can screen for the imaging orders in the denominator screening.
    //
    public function getTitle()
    {
        return "AMC_314g_1_2_20 Denominator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        return true;
    }
}
