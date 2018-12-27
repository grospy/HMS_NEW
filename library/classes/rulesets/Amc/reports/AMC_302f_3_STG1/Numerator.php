<?php


class AMC_302f_3_STG1_Numerator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_302f_3_STG1 Numerator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        //The number of patients in the denominator who have entries of BP as structured data (Effective 2013 onward for providers for whom height and weight is out of scope of practice)
        if ((exist_database_item($patient->id, 'form_vitals', 'bps', 'gt', '0', 'ge', 1, '', '', $endDate)) &&
              (exist_database_item($patient->id, 'form_vitals', 'bpd', 'gt', '0', 'ge', 1, '', '', $endDate))
           ) {
            return true;
        } else {
            return false;
        }
    }
}
