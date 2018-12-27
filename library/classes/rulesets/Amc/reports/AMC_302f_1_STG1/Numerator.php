<?php


class AMC_302f_1_STG1_Numerator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_302f_1_STG1 Numerator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
       //The number of patients in the denominator who have entries of height/length, weight and blood pressure recorded as structured data (effective 2013 only).
        if ((exist_database_item($patient->id, 'form_vitals', 'height', 'gt', '0', 'ge', 1, '', '', $endDate)) &&
             (exist_database_item($patient->id, 'form_vitals', 'weight', 'gt', '0', 'ge', 1, '', '', $endDate)) &&
             (exist_database_item($patient->id, 'form_vitals', 'bps', 'gt', '0', 'ge', 1, '', '', $endDate)) &&
              (exist_database_item($patient->id, 'form_vitals', 'bpd', 'gt', '0', 'ge', 1, '', '', $endDate))  &&
             (exist_database_item($patient->id, 'form_vitals', 'BMI', 'gt', '0', 'ge', 1, '', '', $endDate)) ) {
            return true;
        } else {
            return false;
        }
    }
}
