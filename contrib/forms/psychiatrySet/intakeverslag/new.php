<?php include_once("../../globals.php");include_once($srcdir."/api.inc");include_once($srcdir."/patient.inc");include_once($srcdir."/patient.inc");formHeader("Form: intakeverslag");$returnurl='encounter_top.php';$result=getPatientData($pid,"fname,lname,pid,pubpid,phone_home,pharmacy_id,DOB,DATE_FORMAT(DOB,'%Y%m%d') as DOB_YMD");$provider_results=sqlQuery("select * from users where username='".$_SESSION{"authUser"}."'");$age=getPatientAge($result["DOB_YMD"]);function getPatientDateOfLastEncounter($nPid){$strEventDate=sqlQuery("SELECT MAX(pc_eventDate) AS max
                  FROM openemr_postcalendar_events
                  WHERE pc_pid = ".$nPid."
                  AND pc_apptstatus = '@'
                  AND ( pc_catid = 12 OR pc_catid = 16 )
                  AND pc_eventDate >= '2007-01-01'");if($strEventDate['max']!=""){return($strEventDate['max']);}else{return("00-00-0000");}}$m_strEventDate=getPatientDateOfLastEncounter($result['pid']);$vectAutosave=sqlQuery("SELECT id, autosave_flag, autosave_datetime FROM form_intakeverslag
                            WHERE pid = ".$_SESSION["pid"]." AND groupname='".$_SESSION["authProvider"]."' AND user='".$_SESSION["authUser"]."' AND
                            authorized=".$userauthorized." AND activity=1
                            AND autosave_flag=1
                            ORDER by id DESC limit 1");$obj=formFetch("form_intakeverslag",$vectAutosave['id']);$tmpDate=stripslashes($obj{"intakedatum"});if($tmpDate&&$tmpDate!='0000-00-00 00:00:00'){$m_strEventDate=$tmpDate;};echo'
<html>
<head>
    <link rel=stylesheet href="';echo$css_header;echo'" type="text/css">
    <link rel="stylesheet" href="';echo$GLOBALS['assets_static_relative'];echo'/jquery-datetimepicker-2-5-4/build/jquery.datetimepicker.min.css">
</head>



<body ';echo$top_bg_line;echo' topmargin=0 rightmargin=0 leftmargin=2 bottommargin=0 marginwidth=2 marginheight=0>

<style type="text/css">
 body       { font-family:sans-serif; font-size:10pt; font-weight:normal }
  .dehead    { color:#000000; font-family:sans-serif; font-size:10pt; font-weight:bold;
                padding-left:3px; padding-right:3px; }
                 .detail    { color:#000000; font-family:sans-serif; font-size:10pt; font-weight:normal;
                               padding-left:3px; padding-right:3px; }
</style>

<script type="text/javascript" src="../../../library/dialog.js?v=';echo$v_js_includes;echo'"></script>
<script type="text/javascript" src="../../../library/textformat.js?v=';echo$v_js_includes;echo'"></script>
<script type="text/javascript" src="';echo$GLOBALS['assets_static_relative'];echo'/jquery-min-3-1-1/index.js"></script>
<script type="text/javascript" src="';echo$GLOBALS['assets_static_relative'];echo'/jquery-datetimepicker-2-5-4/build/jquery.datetimepicker.full.min.js"></script>

';if($vectAutosave['id']){$intakeverslag_id=$vectAutosave['id'];}else{$intakeverslag_id="0";};echo'<script type="text/javascript">
$(document).ready(function(){
        autosave();
        $(\'.datepicker\').datetimepicker({
            ';$datetimepicker_timepicker=false;echo'            ';$datetimepicker_showseconds=false;echo'            ';$datetimepicker_formatInput=false;echo'            ';require($GLOBALS['srcdir'].'/js/xl/jquery-datetimepicker-2-5-4.js.php');echo'            ';;echo'        });
                        });

function delete_autosave( )
{
  if( confirm("';xl('Are you sure you want to completely remove this form?','e');echo'") )
  {
    $.ajax(
            {
              type: "POST",
              url: "../../forms/intakeverslag/delete_autosave.php",
              data: "id=" + ';echo$intakeverslag_id;echo'                        ,
                                cache: false,
                                success: function( message )
                {
                     $("#timestamp").empty().append(message);
                }
            });
    return true;

  } else
  {
    return false;
  }

}

function autosave( )
{
  var t = setTimeout("autosave()", 20000);

  var a_intakedatum = $("#intakedatum").val();
  var a_reden_van_aanmelding = $("#reden_van_aanmelding").val();
  var a_klachten_probleemgebieden = $("#klachten_probleemgebieden").val();
  var a_hulpverlening_onderzoek = $("#hulpverlening_onderzoek").val();
  var a_hulpvraag_en_doelen = $("#hulpvraag_en_doelen").val();
  var a_bijzonderheden_systeem = $("#bijzonderheden_systeem").val();
  var a_werk_opleiding_vrije_tijdsbesteding = $("#werk_opleiding_vrije_tijdsbesteding").val();
  var a_relatie_kinderen = $("#relatie_kinderen").val();
  var a_somatische_context = $("#somatische_context").val();
  var a_alcohol = $("#alcohol").val();
  var a_drugs = $("#drugs").val();
  var a_roken = $("#roken").val();
  var a_medicatie = $("#medicatie").val();
  var a_familieanamnese = $("#familieanamnese").val();
  var a_indruk_observaties = $("#indruk_observaties").val();
  var a_beschrijvende_conclusie = $("#beschrijvende_conclusie").val();
  var a_behandelvoorstel = $("#behandelvoorstel").val();

  if( a_intakedatum.length > 0 || a_reden_van_aanmelding.length > 0 )
  {
    $.ajax(
            {
              type: "POST",
              url: "../../forms/intakeverslag/autosave.php",
              data: "id=" + ';echo$intakeverslag_id;echo' +
                        "&intakedatum=" + $("#intakedatum").val() +
                        "&reden_van_aanmelding=" + a_reden_van_aanmelding +
                        "&klachten_probleemgebieden=" + a_klachten_probleemgebieden +
                        "&hulpverlening_onderzoek=" + a_hulpverlening_onderzoek +
                        "&hulpvraag_en_doelen=" + a_hulpvraag_en_doelen +
                        "&bijzonderheden_systeem=" + a_bijzonderheden_systeem +
                        "&werk_opleiding_vrije_tijdsbesteding=" + a_werk_opleiding_vrije_tijdsbesteding +
                        "&relatie_kinderen=" + a_relatie_kinderen +
                        "&somatische_context=" + a_somatische_context +
                        "&alcohol=" + a_alcohol +
                        "&drugs=" + a_drugs +
                        "&roken=" + a_roken +
                        "&medicatie=" + a_medicatie +
                        "&familieanamnese=" + a_familieanamnese +
                        "&indruk_observaties=" + a_indruk_observaties +
                        "&beschrijvende_conclusie=" + a_beschrijvende_conclusie +
                        "&behandelvoorstel=" + a_behandelvoorstel
                        ,
                                cache: false,
                                success: function( message )
                {
                                        $("#timestamp").empty().append(message);
                }
            });
  }

}

</script>

<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<form method=post action="';echo$rootdir;echo'/forms/intakeverslag/save.php?mode=new&saveid=';echo$intakeverslag_id;echo'" name="my_form">
<span class="title">';xl('Psychiatric Intake','e');echo'</span><br><br>

<table>
<tr>
<td>';xl('Intake Date','e');echo':</td><td>
<input type=\'text\' class=\'datepicker\' name=\'intakedatum\' id=\'intakedatum\' size=\'10\' value=\'';echo$m_strEventDate;echo'\'
          title=\'';xl('Intake Date','e');echo': yyyy-mm-dd\'></input>


';;echo'</td>
</tr>
</table>

<br><span class=text>';xl('Reason for Visit','e');echo'</span><br>
<textarea cols=80 rows=5 wrap=virtual name="reden_van_aanmelding" id="reden_van_aanmelding">';echo stripslashes($obj{"reden_van_aanmelding"});echo'</textarea><br>
<br><span class=text>';xl('Problem List','e');echo'</span><br>
<textarea cols=80 rows=5 wrap=virtual name="klachten_probleemgebieden" id="klachten_probleemgebieden">';echo stripslashes($obj{"klachten_probleemgebieden"});echo'</textarea><br>

<br><span class=text>';xl('Psychiatric History','e');echo'</span><br>
<textarea cols=80 rows=10 wrap=virtual name="hulpverlening_onderzoek" id="hulpverlening_onderzoek">';echo stripslashes($obj{"hulpverlening_onderzoek"});echo'</textarea><br>

<br><span class=text>';xl('Treatment Goals','e');echo'</span><br>
<textarea cols=80 rows=10 wrap=virtual name="hulpvraag_en_doelen" id="hulpvraag_en_doelen">';echo stripslashes($obj{"hulpvraag_en_doelen"});echo'</textarea><br>

<br><span class=text>';xl('Specialty Systems','e');echo'</span><br>
<textarea cols=80 rows=5 wrap=virtual name="bijzonderheden_systeem" id="bijzonderheden_systeem">';echo stripslashes($obj{"bijzonderheden_systeem"});echo'</textarea><br>
<br><span class=text>';xl('Work/ Education/ Hobbies','e');echo'</span><br>
<textarea cols=80 rows=5 wrap=virtual name="werk_opleiding_vrije_tijdsbesteding" id="werk_opleiding_vrije_tijdsbesteding">';echo stripslashes($obj{"werk_opleiding_vrije_tijdsbesteding"});echo'</textarea><br>
<br><span class=text>';xl('Relation(s) / Children','e');echo'</span><br>
<textarea cols=80 rows=5 wrap=virtual name="relatie_kinderen" id="relatie_kinderen">';echo stripslashes($obj{"relatie_kinderen"});echo'</textarea><br>
<br><span class=text>';xl('Somatic Context','e');echo'</span><br>
<textarea cols=80 rows=5 wrap=virtual name="somatische_context" id="somatische_context">';echo stripslashes($obj{"somatische_context"});echo'</textarea><br>

<br>
<table>
<tr>
<td align="right"  class=text>';xl('Alcohol','e');echo'</td>
<td><input type="text" name="alcohol" size="60" value="';echo stripslashes($obj{"alcohol"});echo'" id="alcohol"></input></td>
</tr><tr>
<td align="right" class=text>';xl('Drugs','e');echo'</td>
<td><input type="text" name="drugs" size="60" value="';echo stripslashes($obj{"drugs"});echo'" id="drugs"></input></td>
</tr><tr>
<td align="right" class=text>';xl('Tobacco','e');echo'</td>
<td><input type="text" name="roken" size="60" value="';echo stripslashes($obj{"roken"});echo'" id="roken"></input></td>
</tr>
</table>

<br><span class=text>';xl('Medications','e');echo'</span><br>
<textarea cols=80 rows=5 wrap=virtual name="medicatie" id="medicatie">';echo stripslashes($obj{"medicatie"});echo'</textarea><br>
<br><span class=text>';xl('Family History','e');echo'</span><br>
<textarea cols=80 rows=5 wrap=virtual name="familieanamnese" id="familieanamnese">';echo stripslashes($obj{"familieanamnese"});echo'</textarea><br>
<br><span class=text>';xl('Assessment','e');echo'</span><br>
<textarea cols=80 rows=5 wrap=virtual name="indruk_observaties" id="indruk_observaties">';echo stripslashes($obj{"indruk_observaties"});echo'</textarea><br>
<br><span class=text>';xl('Conclusions','e');echo'</span><br>
<textarea cols=80 rows=5 wrap=virtual name="beschrijvende_conclusie" id="beschrijvende_conclusie">';echo stripslashes($obj{"beschrijvende_conclusie"});echo'</textarea><br>
<br><span class=text>';xl('Treatment Plan','e');echo'</span><br>
<textarea cols=80 rows=5 wrap=virtual name="behandelvoorstel" id="behandelvoorstel">';echo stripslashes($obj{"behandelvoorstel"});echo'</textarea><br>

<table><tr>

';;echo'</tr></table>

<br><br>
<a href="javascript:document.my_form.submit();" class="link_submit">[';xl('Save','e');echo']</a>
<br>
<a href="';echo$GLOBALS['form_exit_url'];echo'" class="link_submit" onclick="delete_autosave();top.restoreSession()">[';xl('Don\'t Save','e');echo']</a>
</form>

<div id="timestamp"></div>

';formFooter();