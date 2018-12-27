<?php



define("PRIV_DB", "PRIV_DB");
function getPrivDB()
{
    if (!isset($GLOBALS[PRIV_DB])) {
        $secure_config=$GLOBALS['OE_SITE_DIR'] . "/secure_sqlconf.php";
        if (file_exists($secure_config)) {
            require_once($secure_config);
            $GLOBALS[PRIV_DB]=NewADOConnection("mysql_log");
            $GLOBALS[PRIV_DB]->PConnect($secure_host.":".$secure_port, $secure_login, $secure_pass, $secure_dbase);
        } else {
            $GLOBALS[PRIV_DB]=$GLOBALS['adodb']['db'];
        }
    }

    return $GLOBALS[PRIV_DB];
}

/**
 * mechanism to use "super user" for SQL queries related to password operations
 *
 * @param type $sql
 * @param type $params
 * @return type
 */
function privStatement($sql, $params = null)
{
    if (is_array($params)) {
        $recordset = getPrivDB()->Execute($sql, $params);
    } else {
        $recordset = getPrivDB()->Execute($sql);
    }

    if ($recordset === false) {
      // These error messages are explictly NOT run through xl() because we still
      // need them if there is a database problem.
        echo "Failure during database access! Check server error log.";
        $backtrace=debug_backtrace();

        error_log("Executing as user:" .getPrivDB()->user." Statement failed:".$sql.":". $GLOBALS['last_mysql_error']
              ."==>".$backtrace[1]["file"]." at ".$backtrace[1]["line"].":".$backtrace[1]["function"]);
        exit;
    }

    return $recordset;
    return sqlStatement($sql, $params);
}

/**
 *
 * Wrapper for privStatement that just returns the first row of a query or FALSE
 * if there were no results.
 *
 * @param type $sql
 * @param type $params
 * @return boolean
 */
function privQuery($sql, $params = null)
{
    $recordset=privStatement($sql, $params);
    if ($recordset->EOF) {
        return false;
    }

    $rez = $recordset->FetchRow();
    if ($rez == false) {
        return false;
    }

    return $rez;
}
