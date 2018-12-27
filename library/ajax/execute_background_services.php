<?php




//ajax param should be set by calling ajax scripts
$isAjaxCall = isset($_POST['ajax']);

//if false, we may assume this is a cron job and set up accordingly
if (!$isAjaxCall) {
    $ignoreAuth = 1;
   //process optional arguments when called from cron
    $_GET['site'] = (isset($argv[1])) ? $argv[1] : 'default';
    if (isset($argv[2]) && $argv[2]!='all') {
        $_GET['background_service'] = $argv[2];
    }

    if (isset($argv[3]) && $argv[3]=='1') {
        $_GET['background_force'] = 1;
    }
}

//an additional require file can be specified for each service in the background_services table
require_once(dirname(__FILE__) . "/../../interface/globals.php");

//Remove time limit so script doesn't time out
set_time_limit(0);

//Release session lock to prevent freezing of other scripts
session_write_close();

//Safety in case one of the background functions tries to output data
ignore_user_abort(1);

/**
 * Execute background services
 * This function reads a list of available services from the background_services table
 * For each service that is not already running and is due for execution, the associated
 * background function is run.
 *
 * Note: Each service must do its own logging, as appropriate, and should disable itself
 * to prevent continued service calls if an error condition occurs which requires
 * administrator intervention. Any service function return values and output are ignored.
 */

function execute_background_service_calls()
{
  /**
   * Note: The global $service_name below is set to the name of the service currently being
   * processed before the actual service function call, and is unset after normal
   * completion of the loop. If the script exits abnormally, the shutdown_function
   * uses the value of $service_name to do any required clean up.
   */
    global $service_name;

    $single_service = isset($_REQUEST['background_service']) ? $_REQUEST['background_service'] : '';
    $force = (isset($_REQUEST['background_force']) && $_REQUEST['background_force']);

    $sql = 'SELECT * FROM background_services WHERE ' . ($force ? '1' : 'execute_interval > 0');
    if ($single_service!="") {
        $services = sqlStatementNoLog($sql.' AND name=?', array($single_service));
    } else {
        $services = sqlStatementNoLog($sql.' ORDER BY sort_order');
    }

    while ($service = sqlFetchArray($services)) {
        $service_name = $service['name'];
        if (!$service['active'] || $service['running'] == 1) {
            continue;
        }

        $interval=(int)$service['execute_interval'];

        //leverage locking built-in to UPDATE to prevent race conditions
        //will need to assess performance in high concurrency setting at some point
        $sql='UPDATE background_services SET running = 1, next_run = NOW()+ INTERVAL ?'
        . ' MINUTE WHERE running < 1 ' . ($force ? '' : 'AND NOW() > next_run ') . 'AND name = ?';
        if (sqlStatementNoLog($sql, array($interval,$service_name))===false) {
            continue;
        }

        $acquiredLock =  generic_sql_affected_rows();
        if ($acquiredLock<1) {
            continue; //service is already running or not due yet
        }

        if ($service['require_once']) {
            require_once($GLOBALS['fileroot'] . $service['require_once']);
        }

        if (!function_exists($service['function'])) {
            continue;
        }

        //use try/catch in case service functions throw an unexpected Exception
        try {
            $service['function']();
        } catch (Exception $e) {
          //do nothing
        }

        $sql = 'UPDATE background_services SET running = 0 WHERE name = ?';
        $res = sqlStatementNoLog($sql, array($service_name));
    }
}

/**
 * Catch unexpected failures.
 *
 * if the global $service_name is still set, then a die() or exit() occurred during the execution
 * of that service's function call, and we did not complete the foreach loop properly,
 * so we need to reset the is_running flag for that service before quitting
 */

function background_shutdown()
{
    global $service_name;
    if (isset($service_name)) {
        $sql = 'UPDATE background_services SET running = 0 WHERE name = ?';
        $res = sqlStatementNoLog($sql, array($service_name));
    }
}

register_shutdown_function('background_shutdown');
execute_background_service_calls();
unset($service_name);
