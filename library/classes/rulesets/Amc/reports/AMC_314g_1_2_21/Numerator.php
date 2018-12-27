<?php


class AMC_314g_1_2_21_Numerator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_314g_1_2_21 Numerator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        $check = sqlQuery("SELECT dc_father,dc_mother, dc_siblings, dc_offspring FROM `history_data` WHERE `pid`=? ORDER BY id DESC LIMIT 1", array($patient->id));
        
        if ($check['dc_father'] != "" || $check['dc_mother'] != "" || $check['dc_siblings'] != "" || $check['dc_offspring'] != "") {
            return true;
        } else {
            return false;
        }
    }
}
