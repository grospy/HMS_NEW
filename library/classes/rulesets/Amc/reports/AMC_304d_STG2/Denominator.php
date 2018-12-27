<?php


class AMC_304d_STG2_Denominator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_304d_STG2 Denominator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        //MEASURE STAGE 2: Number of unique patients who have had two or more office visits with the EP in the 24 months prior to the beginning of the EHR reporting period

                // the begin date for encounter range is 2 years minus the above $beginDate
                $d1 = new DateTime($beginDate);
                $d2 = $d1->sub(new DateInterval('P2Y'));
                $beginDate_encounter = $d2->format('Y-m-d H:i:s');
                // the end date for encounter range is the above $beginDate
                $endDate_encounter = $beginDate;

        $twoEncounter = array( Encounter::OPTION_ENCOUNTER_COUNT => 2 );
        if (Helper::check(ClinicalType::ENCOUNTER, Encounter::ENC_OFF_VIS, $patient, $beginDate_encounter, $endDate_encounter, $twoEncounter)) {
            return true;
        }

        return false;
    }
}
