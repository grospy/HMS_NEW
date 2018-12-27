<?php


require_once("../../interface/globals.php");

if (isset($_GET['term'])) {
    $return_arr = array();
    $term = filter_input(INPUT_GET, "term");

    $sql = "SELECT `drug_id`, `name` FROM `drugs` WHERE `name` LIKE ? ORDER BY `name`";
    $val = array($term.'%');
    $res = sqlStatement($sql, $val);
    while ($row = sqlFetchArray($res)) {
        $return_arr[] =  $row['name'] . " - ". $row['drug_id'];
    }

    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}
