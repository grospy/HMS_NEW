<?php


require_once('../../../interface/globals.php');


if (isset($_GET['term'])) {
    $return_arr = array();
    $term    = filter_input(INPUT_GET, "term");
    $city    = filter_input(INPUT_GET, "city");
    $address = filter_input(INPUT_GET, "address");

    $sql = "SELECT id, Store_name, address_line_1, city, state FROM erx_pharmacies WHERE Store_name LIKE ? AND city LIKE ? ";
    $sql .= " AND address_line_1 LIKE ? ";
    $stm = array('%'.$term.'%','%'.$city.'%','%'.$address.'%');
    $res = sqlStatement($sql, $stm);
    while ($row = sqlFetchArray($res)) {
        $return_arr[] = $row['id'] . " - " . $row['Store_name'] . " " . $row['address_line_1'] . " " . $row['city'] . " " . $row['state'];
    }
    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}
