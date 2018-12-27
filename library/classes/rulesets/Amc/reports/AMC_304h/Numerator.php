<?php


class AMC_304h_Numerator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_304h Numerator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        // Need patient summary given/sent to patient within 3 business days of each encounter.
        $amcElement = amcCollect('provide_sum_pat_amc', $patient->id, 'form_encounter', $patient->object['encounter']);
        if (!(empty($amcElement))) {
            $daysDifference = businessDaysDifference(date("Y-m-d", strtotime($patient->object['date'])), date("Y-m-d", strtotime($amcElement['date_completed'])));
            if ($daysDifference < 4) {
                return true;
            }
        }

        return false;
    }
}
