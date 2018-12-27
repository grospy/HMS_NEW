<?php

 
class NFQ_0013_InitialPatientPopulation implements CqmFilterIF
{
    public function getTitle()
    {
        return "Initial Patient Population";
    }
    
    public function test(CqmPatient $patient, $beginDate, $endDate)
    {
        $encounterCount = array( Encounter::OPTION_ENCOUNTER_COUNT => 1 );
        if ($patient->calculateAgeOnDate($beginDate) >= 18 && $patient->calculateAgeOnDate($beginDate) < 85 &&
            ( Helper::check(ClinicalType::DIAGNOSIS, Diagnosis::HYPERTENSION, $patient, $beginDate, date('Y-m-d H:i:s', strtotime('+6 month', strtotime($beginDate)))) || (Helper::check(ClinicalType::DIAGNOSIS, Diagnosis::HYPERTENSION, $patient, $beginDate, $beginDate))  ) &&
            ( Helper::check(ClinicalType::ENCOUNTER, Encounter::ENC_OUTPATIENT, $patient, $beginDate, $endDate, $encounterCount) ||
              Helper::check(ClinicalType::ENCOUNTER, Encounter::ENC_NURS_FAC, $patient, $beginDate, $endDate, $encounterCount) ) ) {
            return true;
        }
        
        return false;
    }
}
