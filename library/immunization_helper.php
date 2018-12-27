<?php


/**
 * Return listing of immunizations for a patient.
 *
 * @param   string    $pid        person id
 * @param   string    $sortby     sorting field ('vacc' sorts by name, otherwise will sort by date)
 * @param   boolean   $showError  indicator whether to retrieve the records that were added erroneously
 * @return  recordset             listing of immunizations for a patient
 */
function getImmunizationList($pid, $sortby, $showError)
{
        $sql = "select i1.id ,i1.immunization_id, i1.cvx_code, i1.administered_date, c.code_text_short, c.code".
                ",i1.manufacturer ,i1.lot_number, i1.completion_status ".
                ",ifnull(concat(u.lname,', ',u.fname),'Other') as administered_by ".
                ",i1.education_date ,i1.note ". ",i1.expiration_date " .
                ",i1.amount_administered, i1.amount_administered_unit, i1.route, i1.administration_site, i1.added_erroneously".
                " from immunizations i1 ".
                " left join users u on i1.administered_by_id = u.id ".
                " left join code_types ct on ct.ct_key = 'CVX' ".
                " left join codes c on c.code_type = ct.ct_id AND i1.cvx_code = c.code ".
                " where i1.patient_id = ? ";
    if (!$showError) {
        $sql .= "and i1.added_erroneously = 0 ";
    }

        $sql .= " order by ";
        
    if ($sortby == "vacc") {
        $sql .= " c.code_text_short, i1.immunization_id, i1.administered_date DESC";
    } else {
        $sql .= " administered_date desc";
    }

        $results = sqlStatement($sql, array($pid));
        return $results;
}
