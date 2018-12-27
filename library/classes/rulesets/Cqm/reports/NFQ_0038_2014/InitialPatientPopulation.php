<?php


class NFQ_0038_2014_InitialPatientPopulation implements CqmFilterIF
{
    public function getTitle()
    {
        return "Initial Patient Population";
    }

    public function test(CqmPatient $patient, $beginDate, $endDate)
    {
        // Rs_Patient characteristic: birth date� (age) >=1 year and <2 years to capture all Rs_Patients who will reach 2 years during the �measurement period�;
        $age = $patient->calculateAgeOnDate($beginDate);
        if ($age >= 1 && $age <= 2 &&  Helper::check(ClinicalType::ENCOUNTER, Encounter::ENC_OFF_VIS, $patient, $beginDate, $endDate, 1)) {
            return true;
        }
        
        return false;
    }
}
