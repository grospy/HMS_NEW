<?php require_once("../globals.php");require_once($srcdir."/registry.inc");require_once("../../library/acl.inc");require_once("batchcom.inc.php");;if(!acl_check('admin','batchcom')){echo"<html>\n<body>\n<h1>";echo xlt('You are not authorized for this.');echo"</h1>\n</body>\n</html>";exit();}$process_choices=array(xl('Download CSV File'),xl('Send Emails'),xl('Phone call list'));$gender_choices=array(xl('Any'),xl('Male'),xl('Female'));$hipaa_choices=array(xl('No'),xl('Yes'));$sort_by_choices=array(xl('Zip Code')=>'patient_data.postal_code',xl('Last Name')=>'patient_data.lname',xl('Appointment Date')=>'last_appt');if($_POST['form_action']=='process'){if(!check_date_format($_POST['app_s'])){$form_err.=xl('Date format for "appointment start" is not valid');}if(!check_date_format($_POST['app_e'])){$form_err.=xl('Date format for "appointment end" is not valid');}if(!check_date_format($_POST['seen_since'])){$form_err.=xl('Date format for "seen since" is not valid');}if(!check_date_format($_POST['seen_before'])){$form_err.=xl('Date format for "seen before" is not valid');}if(!check_age($_POST['age_from'])){$form_err.=xl('Age format for "age from" is not valid');}if(!check_age($_POST['age_upto'])){$form_err.=xl('Age format for "age up to" is not valid');}if(!check_select($_POST['gender'],$gender_choices)){$form_err.=xl('Error in "Gender" selection');}if(!check_select($_POST['process_type'],$process_choices)){$form_err.=xl('Error in "Process" selection');}if(!check_select($_POST['hipaa_choice'],$hipaa_choices)){$form_err.=xl('Error in "HIPAA" selection');}if(!check_select($_POST['sort_by'],$sort_by_choices)){$form_err.=xl('Error in "Sort By" selection');}if(!$form_err){$sql="select patient_data.*, cal_events.pc_eventDate as next_appt, cal_events.pc_startTime
                    as appt_start_time,cal_date.last_appt,forms.last_visit from patient_data
                    left outer join openemr_postcalendar_events as cal_events on patient_data.pid=cal_events.pc_pid
                    and curdate() < cal_events.pc_eventDate left outer join (select pc_pid,max(pc_eventDate)
                    as last_appt from openemr_postcalendar_events where curdate() >= pc_eventDate group by pc_pid )
                    as cal_date on cal_date.pc_pid=patient_data.pid left outer join (select pid,max(date)
                    as last_visit from forms where curdate() >= date group by pid)
                    as forms on forms.pid=patient_data.pid where 1=1";$params=array();if($_POST['app_s']!=0 and $_POST['app_s']!=''){$sql.=" and cal_events.pc_eventDate >= ?";array_push($params,$_POST['app_s']);}if($_POST['app_e']!=0 and $_POST['app_e']!=''){$sql.=" and cal_events.pc_endDate <= ?";array_push($params,$_POST['app_e']);}if($_POST['seen_since']!=0 and $_POST['seen_since']!=''){$sql.=" and forms.date >= ?";array_push($params,$_POST['seen_since']);}if($_POST['seen_before']!=0 and $_POST['seen_before']!=''){$sql.=" and forms.date <= ?";array_push($params,$_POST['seen_before']);}if($_POST['age_from']!=0 and $_POST['age_from']!=''){$sql.=" and DATEDIFF( CURDATE( ), patient_data.DOB )/ 365.25 >= ?";array_push($params,$_POST['age_from']);}if($_POST['age_upto']!=0 and $_POST['age_upto']!=''){$sql.=" and DATEDIFF( CURDATE( ), patient_data.DOB )/ 365.25 <= ?";array_push($params,$_POST['age_upto']);}if($_POST['gender']!='Any'){$sql.=" and patient_data.sex=?";array_push($params,$_POST['gender']);}if($_POST['hipaa_choice']!=$hipaa_choices[0]){$sql.=" and patient_data.hipaa_mail='YES' ";}switch($_POST['process_type']):case $choices[1]:$sql.=" and patient_data.email IS NOT NULL ";break;endswitch;$sql.=' ORDER BY '.escape_identifier($_POST['sort_by'],array_values($sort_by_choices),true);$res=sqlStatement($sql,$params);if(sqlNumRows($res)==0){$form_err=xl('No results found, please try again.');}else{switch($_POST['process_type']):case $process_choices[0]:generate_csv($res);exit();case $process_choices[1]:require_once('batchEmail.php');exit();case $process_choices[2]:require_once('batchPhoneList.php');exit();endswitch;}}};echo'<html>
<head>
<title>';echo xlt('BatchCom');echo'</title>
';\OpenEMR\Core\Header::setupHeader(['datetime-picker']);echo'</head>
<body class="body_top container">
<header class="row">
    ';require_once("batch_navigation.php");echo'    <h1 class="col-md-6 col-md-offset-3 text-center">
        ';echo xlt('Batch Communication Tool');echo'    </h1>
</header>
<main>
    ';if($form_err){echo'<div class="alert alert-danger">'.xlt('The following errors occurred').': '.text($form_err).'</div>';};echo'    <form name="select_form" method="post" action="">
        <div class="row">
            <div class="col-md-3 well form-group">
                <label for="process_type">';echo xlt("Process").":";echo'</label>
                <select name="process_type" class="form-control">
                    ';foreach($process_choices as$choice){echo"<option>".text($choice)."</option>";};echo'                </select>
            </div>
            <div class="col-md-3 well form-group">
                <label for="hipaa_choice">';echo xlt("Override HIPAA choice").":";echo'</label>
                <select name="hipaa_choice" class="form-control">
                    ';foreach($hipaa_choices as$choice){echo"<option>".text($choice)."</option>";};echo'                </select>
            </div>
            <div class="col-md-3 well form-group">
                <label for="sort_by">';echo xlt("Sort by");echo'</label>
                <select name="sort_by" class="form-control">
                    ';foreach($sort_by_choices as$choice=>$sorting_code){echo"<option value=\"".$sorting_code."\">".text($choice)."</option>";};echo'                </select>
            </div>
            <div class="col-md-3 well form-group">
                <label for="gender">';echo xlt('Gender');echo':</label>
                <select name="gender" class="form-control">
                    ';foreach($gender_choices as$choice){echo"<option>".text($choice)."</option>";};echo'                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 well form-group">
                <label for="age_from">';echo xlt("Age Range").":";echo'</label>
                <input name="age_from" size="2" type="num" class="form-control" placeholder="';echo xla("any");echo'">
                <label for="age_upto" class="text-center">';echo xlt('to');echo'</label>
                <input name="age_upto" size="2" type="num" class="form-control" placeholder="';echo xla("any");echo'">
            </div>
            <div class="col-md-3 well form-group">
                <label for="app_s">';echo xlt('Appointment within');echo':</label>
                    <input type="text" class="datepicker form-control" name="app_s" placeholder="';echo xla('any date');echo'">
                    <div class="text-center">';echo xlt('to');echo'</div>
                    <input type="text" class="datepicker form-control" name="app_e" placeholder="';echo xla('any date');echo'">
            </div>
            <!-- later gator    <br>Insurance: <SELECT multiple NAME="insurance" Rows="10" cols="20"></SELECT> -->
            <div class="col-md-3 well form-group">
                <label for="app_s">';echo xlt('Seen within');echo':</label>
                    <input type="text" class="datepicker form-control" name="seen_since" placeholder="';echo xla('any date');echo'">
                    <div class="text-center">';echo xlt('to');echo'</div>
                    <input type="text" class="datepicker form-control" name="seen_before" placeholder="';echo xla('any date');echo'">
            </div>
        </div>
        <div class="email row form-group">
            <div class="col-md-6 col-md-offset-3 well">
                <div class="col-md-6">
                    <label for="email_sender">';echo xlt('Email Sender');echo':</label>
                    <input class="form-control" type="text" name="email_sender" placeholder="your@email.email">
                </div>

                <div class="col-md-6">
                    <label for="email_subject">';echo xlt('Email Subject');echo':</label>
                    <input class="form-control" type="text" name="email_subject" placeholder="From your clinic">
                </div>
                <div class="col-md-12">
                    <label for="email_subject">';echo xlt('Email Text, Usable Tag: ***NAME*** , i.e. Dear ***NAME***{{Do Not translate the ***NAME*** elements of this constant.}}');echo':</label>
                </div>
                <div class="col-md-12">
                    <textarea class="form-control" name="email_body" id="" cols="40" rows="8"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <input type="hidden" name="form_action" value="process">
                <button type="submit" name="submit" class="btn btn-default btn-save">
                    ';echo xla("Process");echo'                </button>
            </div>
        </div>
    </form>
</main>
</body>

<script>
    (function() {
        var email = document.querySelector(\'.email\');
        var process = document.querySelector(\'select[name="process_type"]\');
        function hideEmail() {
            if (process.value !== \'';echo attr($process_choices[1]);echo'\') { email.style.display = \'none\'; } else { email.style.display = \'\'; }
        }
        process.addEventListener(\'change\', hideEmail);
        hideEmail();
        $(\'.datepicker\').datetimepicker({
            ';$datetimepicker_timepicker=false;echo'            ';$datetimepicker_showseconds=false;echo'            ';$datetimepicker_formatInput=false;echo'            ';require($GLOBALS['srcdir'].'/js/xl/jquery-datetimepicker-2-5-4.js.php');echo'            ';;echo'        });
    })();
</script>
</html>
';