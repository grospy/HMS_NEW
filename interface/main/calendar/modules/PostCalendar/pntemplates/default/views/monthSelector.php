<?php


$DOMClass="DOMDocument";
if (!class_exists($DOMClass)) {
    error_log("Creation of month drop down failed:".PHP_EOL."Do you have php-xml installed?");
    return;
}

$DOM=new $DOMClass;

$divMonths= $DOM->createElement("DIV");
$divMonths->setAttribute("ID", "monthPicker");
$divMonths->setAttribute("style", "display:none;position: absolute; top: 15px;");
$DOM->appendChild($divMonths);
$tblMonths=$DOM->createElement("TABLE");
$divMonths->appendChild($tblMonths);
$tbodyMonths=$DOM->createElement("TBODY");
$tblMonths->appendChild($tbodyMonths);
$pMonth = date("m");
$pYear = date("Y");

$tdClasses = "tdDatePicker tdMonthName-small";
for ($idx=0; $idx<13; $idx++) {
    $pDay = $cDay;

    if ($pMonth > 12) {
        $pMonth = $pMonth-12;
        $pYear = $pYear + 1;
    }

    while (! checkdate($pMonth, $pDay, $pYear)) {
        $pDay = $pDay - 1;
    }

    $pDate = sprintf("%d%02d%02d", $pYear, $pMonth, $pDay);
    $trMonth=$DOM->createElement("TR");
    $tdMonth=$DOM->createElement("TD", xl(date("F", strtotime($pDate)))." ".$pYear);
    $tdMonth->setAttribute("ID", $pDate);
    $tdMonth->setAttribute("CLASS", $tdClasses);
    $trMonth->appendChild($tdMonth);
    $tbodyMonths->appendChild($trMonth);
    $pMonth = $pMonth + 1;
}

echo $DOM->saveXML($divMonths);
