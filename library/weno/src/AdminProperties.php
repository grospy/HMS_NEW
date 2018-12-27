<?php


namespace OpenEMR\Rx\Weno;

class AdminProperties
{

    public function __construct()
    {
    }

    public function addNarcotics()
    {

  /*
  * Import the narcotics into the table database from SQL file
  *
  */
        $sqlNarc = file_get_contents('../../contrib/weno/narc.sql');

        // Settings to drastically speed up import with InnoDB
        sqlStatementNoLog("SET autocommit=0");
        sqlStatementNoLog("START TRANSACTION");

        sqlStatementNoLog($sqlNarc);

        // Settings to drastically speed up import with InnoDB
        sqlStatementNoLog("COMMIT");
        sqlStatementNoLog("SET autocommit=1");

        return xlt("Narcotic drugs imported");
    }

    public function drugTableInfo()
    {
         $sql = "SELECT ndc FROM erx_drug_paid ORDER BY drugid LIMIT 1";
         return sqlQuery($sql);
    }

    public function pharmacies()
    {
        $sql = "SELECT Store_Name FROM erx_pharmacies ORDER BY id LIMIT 1";
        return sqlQuery($sql);
    }
}
