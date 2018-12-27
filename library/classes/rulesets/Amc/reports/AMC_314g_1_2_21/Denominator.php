<?php

class AMC_314g_1_2_21_Denominator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_314g_1_2_21 Denominator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        // Seen by the EP
        //  (basically needs an encounter within the report dates)
        $options = array( Encounter::OPTION_ENCOUNTER_COUNT => 1 );
        if (Helper::checkAnyEncounter($patient, $beginDate, $endDate, $options)) {
            return true;
        } else {
            return false;
        }
    }
}
