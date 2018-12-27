<?php


class NFQ_0028_2014_DenominatorException implements CqmFilterIF
{
    public function getTitle()
    {
        return "DenominatorException";
    }
    
    public function test(CqmPatient $patient, $beginDate, $endDate)
    {
        
        // Diagnosis Limited Life Expectancy
        $limited_life = array();
        foreach (Codes::lookup(Diagnosis::LIMITED_LIFE, 'SNOMED-CT') as $code) {
            $limited_life[] = "SNOMED-CT:".$code;
        }

        $limited_life = "'".implode("','", $limited_life)."'";
        $query = "SELECT count(*) as cnt from lists where type ='medical_problem' and pid = ? and diagnosis in ($limited_life) and begdate between ? and ? and (enddate is null or enddate > ? )";
        $diagnosis = sqlQuery($query, array($patient->id,$beginDate,$endDate,$endDate));
        if ($diagnosis['cnt'] > 0) {
            return true;
        }
        
        //Risk Category Tobacco Screening Done to allow a provider to document that the screening was performed along with other numerous options from the Risk
        //Category Assessment not done:  Medical Reason value set with the identifying SNOMEDCT Code attached at the Select List level.
        //Risk Category Assessment SNOMEDCT 161590003, 183932001, 183964008, 183966005, 216952002, 266721009, 269191009
        $riskCatAssessQry = "SELECT count(*) as cnt FROM form_encounter fe ".
                            "INNER JOIN openemr_postcalendar_categories opc ON fe.pc_catid = opc.pc_catid ".
                            "INNER JOIN procedure_order pr ON  fe.encounter = pr.encounter_id ".
                            "INNER JOIN procedure_order_code prc ON pr.procedure_order_id = prc.procedure_order_id ".
                            "WHERE opc.pc_catname = 'Office Visit' ".
                            "AND (fe.date BETWEEN ? AND ?) ".
                            "AND fe.pid = ? ".
                            "AND ( prc.procedure_code = '161590003' OR prc.procedure_code = '183932001' OR prc.procedure_code = '183964008' OR prc.procedure_code = '183966005' OR prc.procedure_code = '216952002' OR prc.procedure_code = '266721009' OR prc.procedure_code = '269191009') ".
                            "AND prc.procedure_order_title = 'Risk Category Assessment'";
        
        $check = sqlQuery($riskCatAssessQry, array($beginDate, $endDate, $patient->id));
        if ($check['cnt'] > 0) {
            return true;
        } else {
            return false;
        }
    }
}
