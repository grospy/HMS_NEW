<?php require_once(dirname(__FILE__)."/../../interface/globals.php");require_once($GLOBALS['srcdir']."/maviq_phone_api.php");require_once($GLOBALS['srcdir']."/reminders.php");require_once($GLOBALS['srcdir']."/report_database.inc");;session_write_close();set_time_limit(0);$report_id=($_GET['report_id'])?$_GET['report_id']:"";if(empty($report_id)&&!empty($GLOBALS['pat_rem_clin_nice'])){proc_nice($GLOBALS['pat_rem_clin_nice']);};echo'
<html>
<head>
    ';\OpenEMR\Core\Header::setupHeader();echo'    <title>';echo xlt('Patient Reminder Batch Job');echo'</title>
</head>
<body class="body_top container">
    <header class="row">
        ';require_once("batch_navigation.php");echo'        <h1 class="col-md-12">
            <a href="batchcom.php">';echo xlt('Batch Communication Tool');echo'</a>
            <small>';echo xlt('Patient Reminder Batch Job');echo'</small>
        </h1>
    </header>
    ';;echo'    <main class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered">
            <tr>
              <td class=\'text\' align=\'left\' colspan="3"><br>

                ';if($report_id){$results_log=collectReportDatabase($report_id);$data_log=json_decode($results_log['data'],true);$update_rem_log=$data_log[0];if($results_log['type']=="process_send_reminders"){$send_rem_log=$data_log[1];}echo"<span class='text'>".xlt("Date of Report").": ".text($results_log['date_report'])."</span><br><br>";}else{$update_rem_log=update_reminders_batch_method();$send_rem_log=send_reminders();};echo'
                <span class="text">';echo xlt('The patient reminders have been updated').":";echo'</span><br>
                <span class="text">';echo xlt('Total active actions').": ".$update_rem_log['total_active_actions'];echo'</span><br>
                <span class="text">';echo xlt('Total active reminders before update').": ".$update_rem_log['total_pre_active_reminders'];echo'</span><br>
                <span class="text">';echo xlt('Total unsent reminders before update').": ".$update_rem_log['total_pre_unsent_reminders'];echo'</span><br>
                <span class="text">';echo xlt('Total active reminders after update').": ".$update_rem_log['total_post_active_reminders'];echo'</span><br>
                <span class="text">';echo xlt('Total unsent reminders after update').": ".$update_rem_log['total_post_unsent_reminders'];echo'</span><br>
                <span class="text">';echo xlt('Total new reminders').": ".$update_rem_log['number_new_reminders'];echo'</span><br>
                <span class="text">';echo xlt('Total updated reminders').": ".$update_rem_log['number_updated_reminders'];echo'</span><br>
                <span class="text">';echo xlt('Total inactivated reminders').": ".$update_rem_log['number_inactivated_reminders'];echo'</span><br>
                <span class="text">';echo xlt('Total unchanged reminders').": ".$update_rem_log['number_unchanged_reminders'];echo'</span><br>

                ';if($results_log['type']!="process_reminders"){echo'                <br><span class="text">';echo xlt('The patient reminders have been sent').":";echo'</span><br>
                <span class="text">';echo xlt('Total unsent reminders before sending process').": ".$send_rem_log['total_pre_unsent_reminders'];echo'</span><br>
                <span class="text">';echo xlt('Total unsent reminders after sending process').": ".$send_rem_log['total_post_unsent_reminders'];echo'</span><br>
                <span class="text">';echo xlt('Total successful reminders sent via email').": ".$send_rem_log['number_success_emails'];echo'</span><br>
                <span class="text">';echo xlt('Total failed reminders sent via email').": ".$send_rem_log['number_failed_emails'];echo'</span><br>
                <span class="text">';echo xlt('Total successful reminders sent via phone').": ".$send_rem_log['number_success_calls'];echo'</span><br>
                <span class="text">';echo xlt('Total failed reminders sent via phone').": ".$send_rem_log['number_unchanged_reminders'];echo'</span><br>

                <br><span class="text">';echo xlt('(Email delivery is immediate, while automated VOIP is sent to the service provider for further processing.)');echo'</span><br>
                ';};echo'
                ';if(report_id){echo'                <br><input type="button" value="';echo xlt('Back');echo'" onClick="top.restoreSession(); window.open(\'../reports/report_results.php\',\'_self\',false)"><br><br><br>
                ';}else{echo'                <input type="button" value="';echo xlt('Close');echo'" onClick="window.close()">
                ';};echo'              </td>
            </tr>
            </table>
        </div>
    </main>
</body>
</html>

';