<?php


require_once("../globals.php");

echo xlt("Trying")."<BR>";

$zip = new ZipArchive;
$zip->open('FormularyFiles.zip');
$zip->extractTo($GLOBALS['temporary_files_dir']);
$zip->close();

$file = $GLOBALS['temporary_files_dir'] . "./Weno Exchange LLC/BSureFormulary.txt";
$lines = count(file($file));
echo text($lines). "<br>";

$i = 2;
// Settings to drastically speed up import with InnoDB
sqlStatementNoLog("SET autocommit=0");
sqlStatementNoLog("START TRANSACTION");
do {
    $fileName = new SplFileObject($file);
    $fileName->seek($i);

    $in = explode("|", $fileName);

    $ndc = $in[2];
    $price = $in[5];
    $drugName = $in[8];

    sqlStatementNoLog("INSERT INTO `erx_drug_paid` SET `drug_label_name` = ?, `NDC` = ?, `price_per_unit` = ? ", array($drugName,$ndc,$price));
    echo xlt("Inserted") . " " . text($drugName) . "<br> ";

    $i++;
} while ($i < $lines);

// Settings to drastically speed up import with InnoDB
sqlStatementNoLog("COMMIT");
sqlStatementNoLog("SET autocommit=1");
