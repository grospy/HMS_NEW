<?php


class AMC_304a_3_Numerator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_304a_3 Numerator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        // MEASURE STAGE2: Medication Order(s) Created as CPOE
        //
        // Still TODO
        // AMC MU2 TODO :
        // Note the counter for this is using prescriptions which does not incorporate the cpoe_stat field.
        //
        if (isset($patient->object['cpoe_stat']) && $patient->object['cpoe_stat'] == 1) {
              return true;
        } else {
            return false;
        }
    }
}
