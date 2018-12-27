<?php


class AMC_314g_1_2_19_Numerator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_314g_1_2_19 Numerator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        //Secure electronic message received by EP using secure electronic messaging function of CEHRT
        $smQry = "SELECT  * FROM `pnotes` WHERE `user` = ? AND `date` >= ? AND `date` <= ?";
        $check = sqlQuery($smQry, array($patient->id, $beginDate, $endDate));
        if (!(empty($check))) {
            return true;
        } else {
            return false;
        }
    }
}
