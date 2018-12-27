<?php


class AMC_302m_STG2_Denominator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_302m_STG2 Denominator";
    }

    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        $off_visits = sqlQuery("select count(encounter) as cnt from form_encounter e inner join openemr_postcalendar_categories opc on opc.pc_catid = e.pc_catid where e.pid = ? and e.date >= ? and e.date <= ? and opc.pc_catname = 'office visit'", array($patient->id,$beginDate,$endDate));
        if ($off_visits['cnt'] >= 1) {
            return true;
        }

        return false;
    }
}
