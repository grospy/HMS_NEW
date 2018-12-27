<?php

require_once("$srcdir/../custom/code_types.inc.php");

/**
 *
 * wrapper for sequential code set search
 *
 * @param type $search_type_id      The integer ID used for code_type in codes (e.g. 2 for ICD9)
 * @param type $search_type         A string representing the code type to be searched on (e.g. ICD9, DSMIV)
 * @param type $search_query        The text to search on.
 * @return array
 */
function diagnosis_search($search_type_id, $search_type, $search_query)
{
    $retval=array();
    $search=main_code_set_search($search_type, $search_query, 20);
    while ($code=sqlFetchArray($search)) {
        array_push($retval, new code_info($code['code'], $search_type, $code['code_text']));
    }

    return $retval;
}
