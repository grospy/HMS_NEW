<?php



require_once(dirname(__FILE__) . "/../../interface/globals.php");

$term = isset($_GET["term"]) ? filter_input(INPUT_GET, 'term') : '';

function get_patients_list($term)
{
    $term = "%" . $term . "%";
    $clear = "- " . xl("Reset to no patient") . " -";
    $response = sqlStatement("SELECT Concat(patient_data.fname, ' ',patient_data.lname) as label, patient_data.pid as value FROM patient_data HAVING label LIKE ? ORDER BY patient_data.lname ASC", array($term));
    $resultpd[] = array(
        'label' => $clear,
        'value' => '00'
    );
    while ($row = sqlFetchArray($response)) {
        if ($GLOBALS['pid'] == $row['value']) {
            $row['value'] = "00";
            $row['label'] = xl("Locked") . "-" . xl("In Use") . ":" . $row['label'];
        }

        $resultpd[] = $row;
    }

    echo json_encode($resultpd);
}

get_patients_list($term);
