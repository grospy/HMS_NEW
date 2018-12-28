<?php require_once("../interface/globals.php");require_once($srcdir."/acl.inc");require_once($srcdir."/options.inc.php");;;;;$form_newid=isset($_POST['form_newid'])?trim($_POST['form_newid']):'';$form_curpid=isset($_POST['form_curpid'])?trim($_POST['form_curpid']):'';$form_curid=isset($_POST['form_curid'])?trim($_POST['form_curid']):'';$form_newloc=isset($_POST['form_newloc'])?trim($_POST['form_newloc']):'';$form_newuser=isset($_POST['form_newuser'])?trim($_POST['form_newuser']):'';if($form_newuser){$form_newloc='';}else{$form_newuser=0;};echo'<html>

<head>
';\OpenEMR\Core\Header::setupHeader();echo'<title>';echo xlt('Chart Tracker');echo'</title>

<script language="JavaScript">

function locationSelect() {
 var f = document.forms[0];
 var i = f.form_newloc.selectedIndex;
 if (i > 0) {
  f.form_newuser.selectedIndex = 0;
 }
}

function userSelect() {
 var f = document.forms[0];
 var i = f.form_newuser.selectedIndex;
 if (i > 0) {
  f.form_newloc.selectedIndex = 0;
 }
}

</script>

</head>

<body class="body_top">
<div class="container">

    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1>';echo xlt('Chart Tracker');echo'</h1>
            </div>
         </div>
    </div>

<form method=\'post\' action=\'chart_tracker.php\' class=\'form-horizontal\' onsubmit=\'return top.restoreSession()\'>

';if($form_newloc||$form_newuser){$tracker=new \OpenEMR\Entities\ChartTracker();$tracker->setPid($form_curpid);$tracker->setWhen(new \DateTime(date('Y-m-d H:i:s')));$tracker->setUserId($form_newuser);$tracker->setLocation($form_newloc);$chartTrackerService=new \OpenEMR\Services\ChartTrackerService();$chartTrackerService->trackPatientLocation($tracker);echo"<div class='alert alert-success'>".xlt('Save Successful for chart ID')." "."'".text($form_curid)."'.</div>";}$row=array();if($form_newid){$query="SELECT pd.pid, pd.pubpid, pd.fname, pd.mname, pd.lname, "."pd.ss, pd.DOB, ct.ct_userid, ct.ct_location, ct.ct_when "."FROM patient_data AS pd "."LEFT OUTER JOIN chart_tracker AS ct ON ct.ct_pid = pd.pid "."WHERE pd.pubpid = ? "."ORDER BY pd.pid ASC, ct.ct_when DESC LIMIT 1";$row=sqlQuery($query,array($form_newid));if(empty($row)){echo"<div class='alert alert-danger'>".xlt('Chart ID')." "."'".text($form_newid)."' ".xlt('not found')."!</div>";}};echo'
';if(!empty($row)){$userService=new \OpenEMR\Services\UserService();$ct_userid=$row['ct_userid'];$ct_location=$row['ct_location'];$current_location=xlt('Unassigned');if($ct_userid){$user=$userService->getUser($ct_userid);$current_location=text($user->getLname().", ".$user->getFname()." ".$user->getMname()." ".oeFormatDateTime($row['ct_when'],"global",true));}else if($ct_location){$current_location=generate_display_field(array('data_type'=>'1','list_id'=>'chartloc'),$ct_location);};echo'
    <div class="row">
        <div class="col-sm-6 well">
            <div class="form-group">
                <label for="form_pat_id" class=\'control-label col-sm-3\'>';echo xlt('Patient ID').":";echo'</label>
                <div class=\'col-sm-9\'>
                    <p class="form-control-static">';echo text($row['pid']);echo'</p>
                    <input type=\'hidden\' name=\'form_curpid\' value=\'';echo attr($row['pid']);echo'\'  />
                    <input type=\'hidden\' name=\'form_curid\' value=\'';echo attr($row['pubpid']);echo'\' />
                </div>
            </div>
            <div class="form-group">
                <label for="form_pat_id" class=\'control-label col-sm-3\'>';echo xlt('Name').":";echo'</label>
                <div class=\'col-sm-9\'>
                    <p class="form-control-static">';echo text($row['lname'].", ".$row['fname']." ".$row['mname']);echo'</p>
                </div>
            </div>
            <div class="form-group">
                <label for="form_pat_id" class=\'control-label col-sm-3\'>';echo xlt('DOB').":";echo'</label>
                <div class=\'col-sm-9\'>
                    <p class="form-control-static">';echo text(oeFormatShortDate($row['DOB']));echo'</p>
                </div>
              </div>
            <div class="form-group">
                <label for="form_pat_id" class=\'control-label col-sm-3\'>';echo xlt('SSN').":";echo'</label>
                <div class=\'col-sm-9\'>
                    <p class="form-control-static">';echo text($row['ss']);echo'</p>
                </div>
            </div>
            <div class="form-group">
                <label for="form_pat_id" class=\'control-label col-sm-3\'>';echo xlt('Current Location').":";echo'</label>
                <div class=\'col-sm-9\'>
                    <p class="form-control-static">';echo text($current_location);echo'</p>
                </div>
            </div>
            <div class="form-group">
                <label for="form_curr_loc" class=\'control-label col-sm-3\'>';echo xlt('Check In To').":";echo'</label>
                <div class=\'col-sm-9\'>
                    ';generate_form_field(array('data_type'=>1,'field_id'=>'newloc','list_id'=>'chartloc','empty_title'=>''),'');echo'                </div>
            </div>
            <div class="form-group">
                <label for="form_out_to" class=\'control-label col-sm-3\'>';echo xlt('Our Out To').":";echo'</label>
                <div class=\'col-sm-9\'>
                    <select name=\'form_newuser\' class=\'form-control\' onchange=\'userSelect()\'>
                        <option value=\'\'></option>
                        ';$users=$userService->getActiveUsers();foreach($users as$activeUser){echo"    <option value='".attr($activeUser->getId())."'";echo">".text($activeUser->getLname()).', '.text($activeUser->getFname()).' '.text($activeUser->getMname())."</option>\n";};echo'                    </select>
                </div>
            </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                    <button type=\'submit\' class=\'btn btn-default btn-save\' name=\'form_save\'>';echo xlt("Save");echo'</button>
            </div>
        </div>
    </div>


';};echo'    <div class="row">
        <div class="col-sm-6 well">
            <div class="form-group">
                <label for=\'form_newid\' class=\'control-label col-sm-3\'>';echo xlt('New Patient ID').":";echo'</label>
                <div class=\'col-sm-9\'>
                   <input type=\'text\' name=\'form_newid\' id=\'form_newid\' class=\'form-control\' title=\'';echo xla('Type or scan the patient identifier here');echo'\'>
                </div>
            </div>
            <div class="form-group">
            <div class=\'col-sm-offset-3 col-sm-9\'>
                <button type=\'submit\' class=\'btn btn-default btn-search\' name=\'form_lookup\'>';echo xlt("Look Up");echo'</button>
            </div>
        </div>
    </div>
</form>

</div>

</body>
</html>
';