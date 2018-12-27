<?php


class NFQ_0384_Numerator implements CqmFilterIF
{
    public function getTitle()
    {
        return "Numerator";
    }

    public function test(CqmPatient $patient, $beginDate, $endDate)
    {
        //Patient visits in which pain intensity is quantified
        $riskCatAssessQry = "SELECT count(*) as cnt FROM form_encounter fe ".
                            "INNER JOIN openemr_postcalendar_categories opc ON fe.pc_catid = opc.pc_catid ".
                            "INNER JOIN procedure_order pr ON  fe.encounter = pr.encounter_id ".
                            "INNER JOIN procedure_order_code prc ON pr.procedure_order_id = prc.procedure_order_id ".
                            "WHERE opc.pc_catname = 'Office Visit' ".
                            "AND (fe.date BETWEEN ? AND ?) ".
                            "AND fe.pid = ? ".
                            "AND ( prc.procedure_code = '38208-5') ".
                            "AND prc.procedure_order_title = 'Risk Category Assessment'";
    
        $check = sqlQuery($riskCatAssessQry, array($beginDate, $endDate, $patient->id));
        if ($check['cnt'] > 0) {
            return true;
        } else {
            return false;
        }
    }
}
