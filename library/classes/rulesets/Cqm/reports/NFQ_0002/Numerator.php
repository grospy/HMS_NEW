<?php

 
class NFQ_0002_Numerator implements CqmFilterIF
{
    public function getTitle()
    {
        return "Numerator";
    }

    public function test(CqmPatient $patient, $beginDate, $endDate)
    {
        
        //Group A Streptococcus Test Array
        $strep_test_code = "'".implode("','", Codes::lookup(LabResult::STREPTOCOCCUS_TEST, 'LOINC'))."'";
        
        //Patients who were tested for Streptococcus A during the same encounter that the antibiotic was prescribed, Encounter category should be office visit.
        $query = "SELECT count(*) as cnt FROM form_encounter fe ".
                 "INNER JOIN openemr_postcalendar_categories opc ON fe.pc_catid = opc.pc_catid ".
                 "INNER JOIN procedure_order po ON po.encounter_id = fe.encounter ".
                 "INNER JOIN procedure_order_code pc ON po.procedure_order_id = pc.procedure_order_id ".
                 "INNER JOIN procedure_report pr on pr.procedure_order_id = po.procedure_order_id ".
                 "INNER JOIN procedure_result pres on pres.procedure_report_id = pr.procedure_report_id ".
                 "WHERE opc.pc_catname = 'Office Visit' AND fe.pid = ? AND (fe.date BETWEEN ? AND  ? ) ".
                 " AND pres.result_code in ($strep_test_code) AND ( DATEDIFF(po.date_ordered,fe.date) between 0 and 3 or DATEDIFF(fe.date,po.date_ordered) between 0 and 3)";
        
        $check = sqlQuery($query, array($patient->id, $beginDate, $endDate));
        if ($check['cnt'] > 0) {
            return true;
        } else {
            return false;
        }
    }
}
