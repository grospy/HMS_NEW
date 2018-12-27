<?php

class AMC_304a_2_Numerator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_304a_2 Numerator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        // MEASURE STAGE2: Procedure Order(s) Created CPOE
        if (isset($patient->object['history_order']) && $patient->object['history_order'] == '0') {
              return true;
        } else {
            return false;
        }
    }
}
