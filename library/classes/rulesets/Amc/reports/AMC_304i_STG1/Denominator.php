<?php


class AMC_304i_STG1_Denominator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_304i_STG1 Denominator";
    }

    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        //  (basically needs a referral within the report dates,
        //   which are already filtered for, so all the objects are a positive)
        return true;
    }
}
