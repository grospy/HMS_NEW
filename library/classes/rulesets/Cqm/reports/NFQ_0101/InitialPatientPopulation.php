<?php

 
class NFQ_0101_InitialPatientPopulation implements CqmFilterIF
{
    public function getTitle()
    {
        return "Initial Patient Population";
    }
    
    public function test(CqmPatient $patient, $beginDate, $endDate)
    {
        $oneEncounter = array( Encounter::OPTION_ENCOUNTER_COUNT => 1 );
        if (($patient->calculateAgeOnDate($beginDate) >= 65) &&
             ( Helper::check(ClinicalType::ENCOUNTER, Encounter::ENC_OFF_VIS, $patient, $beginDate, $endDate, $oneEncounter) ) ) {
            return true;
        }
        
        return false;
    }
}
