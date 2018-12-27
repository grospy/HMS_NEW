<?php


// Given a list ID, name of a target form field and a default value, this creates
// JavaScript that will write Option values into the target selection list.




require_once("../globals.php");

$listid  = $_GET['listid'];
$target  = $_GET['target'];
$current = $_GET['current'];

$res = sqlStatement("SELECT option_id FROM list_options WHERE list_id = ? AND activity = 1 " .
  "ORDER BY seq, option_id", array($listid));

echo "var itemsel = document.forms[0]['$target'];\n";
echo "var j = 0;\n";
echo "itemsel.options[j++] = new Option('-- " . xls('Please Select') . " --','',false,false);\n";
while ($row = sqlFetchArray($res)) {
    $tmp = addslashes($row['option_id']);
    $def = $row['option_id'] == $current ? 'true' : 'false';
    echo "itemsel.options[j++] = new Option('$tmp','$tmp',$def,$def);\n";
}
