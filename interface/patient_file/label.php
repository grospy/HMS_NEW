<?php

// I used the program example supplied with the Avery Label Print Class to produce this program


require_once("../globals.php");

//Get the data to place on labels
//
$patdata = sqlQuery("SELECT " .
  "p.fname, p.mname, p.lname, p.pubpid, p.DOB, " .
  "p.street, p.city, p.state, p.postal_code, p.pid " .
  "FROM patient_data AS p " .
  "WHERE p.pid = ? LIMIT 1", array($pid));

// re-order the dates
//

$today = oeFormatShortDate($date = 'today');
$dob = oeFormatShortDate($patdata['DOB']);

//get label type and number of labels on sheet
//

if ($GLOBALS['chart_label_type'] == '1') {
    $pdf = new PDF_Label('5160');
    $last = 30;
}

if ($GLOBALS['chart_label_type'] == '2') {
    $pdf = new PDF_Label('5161');
    $last = 20;
}

if ($GLOBALS['chart_label_type'] == '3') {
    $pdf = new PDF_Label('5162');
    $last = 14;
}

$pdf->AddPage();

// Added spaces to the sprintf for Fire Fox it was having a problem with alignment
$text = sprintf("  %s %s\n  %s\n  %s\n  %s", $patdata['fname'], $patdata['lname'], $dob, $today, $patdata['pid']);

// For loop for printing the labels
//

for ($i=1; $i<=$last; $i++) {
    $pdf->Add_Label($text);
}

$pdf->Output();
