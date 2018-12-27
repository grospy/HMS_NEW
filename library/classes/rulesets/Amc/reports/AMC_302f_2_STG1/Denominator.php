<?php


class AMC_302f_2_STG1_Denominator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_302f_2_STG1 Denominator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        //Number of unique patients seen by the EP during the EHR reporting period
        $options = array( Encounter::OPTION_ENCOUNTER_COUNT => 1 );
        if (Helper::checkAnyEncounter($patient, $beginDate, $endDate, $options)) {
            return true;
        } else {
            return false;
        }
    }
}
