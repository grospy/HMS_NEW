<?php




require_once('../../../interface/globals.php');


if (!empty($_GET['term'])) {
    $term = $_GET['term'];
    $return_arr = array();

    $sql = "SELECT DISTINCT lot_number FROM immunizations WHERE lot_number LIKE ?";
    $res = sqlstatement($sql, array("%".$term."%"));
    while ($row = sqlFetchArray($res)) {
        $return_arr[] =  $row['lot_number'] ;
    }
    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}
