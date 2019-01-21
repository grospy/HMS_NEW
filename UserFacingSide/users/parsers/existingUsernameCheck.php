<?php

die(); //This feature has been disabled for security reasons.
//
// require_once '../init.php';
// $db = DB::getInstance();
// $username = Input::get('username');
// $response = 'error';
//
// if (strlen($username) > 0) {
//     if ($db->query('SELECT username FROM users WHERE username = ?', array($username))->count() > 0) {
//         $response = 'taken';
//     }
//     else $response = 'valid';
// }
//
// if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
//     header('Content-Type: application/json');
//     echo json_encode($response);
//     exit;
// }
