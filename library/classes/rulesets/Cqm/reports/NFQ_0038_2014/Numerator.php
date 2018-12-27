<?php


class NFQ_0038_2014_Numerator implements CqmFilterIF
{
    public function getTitle()
    {
        return "Numerator";
    }
    
    public function test(CqmPatient $patient, $beginDate, $endDate)
    {
        if ((Immunizations::checkDtap($patient, $beginDate, $endDate) ) ||
              ( Immunizations::checkIpv($patient, $beginDate, $endDate) ) ||
              ( Immunizations::checkMmr($patient, $beginDate, $endDate) ) ||
              ( Immunizations::checkHib($patient, $beginDate, $endDate) ) ||
              ( Immunizations::checkHepB($patient, $beginDate, $endDate) ) ||
              ( Immunizations::checkVzv($patient, $beginDate, $endDate) )  ||
              ( Immunizations::checkPheumococcal($patient, $beginDate, $endDate) ) ||
              ( Immunizations::checkHepA($patient, $beginDate, $endDate) ) ||
              ( Immunizations::checkRotavirus_2014($patient, $beginDate, $endDate) ) ||
              ( Immunizations::checkInfluenza($patient, $beginDate, $endDate) )
            ) {
            return true;
        }

        return false;
    }
}
