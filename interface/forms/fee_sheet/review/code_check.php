<?php



function diag_code_types($format = 'json', $sqlEscape = false)
{
    global $code_types;
    $diagCodes=array();
    foreach ($code_types as $key => $ct) {
        if ($ct['active'] && $ct['diag']) {
            if ($format=='json') {
                $entry=array("key"=>$key,"id"=>$ct['id']);
            } else if ($format=='keylist') {
                $entry="'";
                $entry.= $sqlEscape ? add_escape_custom($key) : $key;
                $entry.="'";
            }

            array_push($diagCodes, $entry);
        }
    }

    if ($format=='json') {
        return json_encode($diagCodes);
    }

    if ($format=='keylist') {
        return implode(",", $diagCodes);
    }
}
