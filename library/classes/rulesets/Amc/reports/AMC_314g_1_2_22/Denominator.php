<?php

class AMC_314g_1_2_22_Denominator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_314g_1_2_22 Denominator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        // Seen by the EP
        //  (basically needs an Office Visit within the report dates)
        $options = array( Encounter::OPTION_ENCOUNTER_COUNT => 1 );
        if (Helper::check(ClinicalType::ENCOUNTER, Encounter::ENC_OFF_VIS, $patient, $beginDate, $endDate, $options)) {
            return true;
        } else {
            return false;
        }
    }
}
