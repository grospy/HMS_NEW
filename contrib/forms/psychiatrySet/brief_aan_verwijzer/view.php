<?php include_once("../../globals.php");include_once($srcdir."/api.inc");include_once($srcdir."/patient.inc");$returnurl='encounter_top.php';$result=getPatientData($pid,"fname,lname,pid,pubpid,phone_home,sex,pharmacy_id,DOB,DATE_FORMAT(DOB,'%Y%m%d') as DOB_YMD");$provider_results=sqlQuery("select * from users where username='".$_SESSION{"authUser"}."'");function getPatientDateOfLastEncounter($nPid){$strEventDate=sqlQuery("SELECT MAX(pc_eventDate) AS max
                  FROM openemr_postcalendar_events
                  WHERE pc_pid = ".$nPid."
                  AND pc_apptstatus = '@'
                  AND pc_eventDate >= '2007-01-01'");if($strEventDate['max']!=""){return($strEventDate['max']);}else{return("00-00-0000");}}$m_strEventDate=getPatientDateOfLastEncounter($result['pid']);$vectAutosave=sqlQuery("SELECT id, autosave_flag, autosave_datetime FROM form_brief_aan_verwijzer
                            WHERE pid = ".$_SESSION["pid"]." AND groupname='".$_SESSION["authProvider"]."' AND user='".$_SESSION["authUser"]."' AND
                            authorized=".$userauthorized." AND activity=1
                            AND autosave_flag=1
                            ORDER by id DESC limit 1");if($vectAutosave['id']&&$vectAutosave['id']!=""&&$vectAutosave['id']>0){$obj=formFetch("form_brief_aan_verwijzer",$vectAutosave['id']);}else{$obj=formFetch("form_brief_aan_verwijzer",(int)$_GET["id"]);};echo'
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

';if($_GET["id"]){$brief_aan_verwijzer_id=$_GET["id"];}else{$brief_aan_verwijzer_id="0";};echo'<script type="text/javascript">
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
              url: "../../forms/brief_aan_verwijzer/delete_autosave.php",
              data: "id=" + ';echo$brief_aan_verwijzer_id;echo'                        ,
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

  var a_introductie = $("#introductie").val();
  var a_reden_van_aanmelding = $("#reden_van_aanmelding").val();
  var a_anamnese = $("#anamnese").val();
  var a_psychiatrisch_onderzoek = $("#psychiatrisch_onderzoek").val();
  var a_beschrijvend_conclusie = $("#beschrijvend_conclusie").val();
  var a_advies_beleid = $("#advies_beleid").val();

  if( a_introductie.length > 0 || a_reden_van_aanmelding.length > 0 )
  {
    $.ajax(
            {
              type: "POST",
              url: "../../forms/brief_aan_verwijzer/autosave.php",
              data: "id=" + ';echo$brief_aan_verwijzer_id;echo' +
                        "&introductie=" + $("#introductie").val() +
                        "&reden_van_aanmelding=" + a_reden_van_aanmelding +
                        "&anamnese=" + a_anamnese +
                        "&psychiatrisch_onderzoek=" + a_psychiatrisch_onderzoek +
                        "&beschrijvend_conclusie=" + a_beschrijvend_conclusie +
                        "&advies_beleid=" + a_advies_beleid +
                        "&mode=update"
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

';include_once($srcdir."/api.inc");echo'
<form method=post action="';echo$rootdir;echo'/forms/brief_aan_verwijzer/save.php?mode=update&id=';echo$_GET["id"];echo'" name="my_form">
<span class="title">';xl('Psychiatric Brief Letter','e');echo'</span><Br><br>

<br><span class=text>';xl('Introduction','e');echo'</span><br>
<textarea cols=80 rows=5 wrap=virtual name="introductie" id="introductie">';echo stripslashes($obj{"introductie"});echo'</textarea><br>

<br><span class=text>';xl('Reason for Visit','e');echo'</span><br>
<textarea cols=80 rows=5 wrap=virtual name="reden_van_aanmelding" id="reden_van_aanmelding">';echo stripslashes($obj{"reden_van_aanmelding"});echo'</textarea><br>
<br><span class=text>';xl('History','e');echo'</span><br>
<textarea cols=80 rows=5 wrap=virtual name="anamnese" id="anamnese">';echo stripslashes($obj{"anamnese"});echo'</textarea><br>
<br><span class=text>';xl('Psychiatric Examination','e');echo'</span><br>
<textarea cols=80 rows=5 wrap=virtual name="psychiatrisch_onderzoek" id="psychiatrisch_onderzoek">';echo stripslashes($obj{"psychiatrisch_onderzoek"});echo'</textarea><br>
<br><span class=text>';xl('Conclusions','e');echo'</span><br>
<textarea cols=80 rows=5 wrap=virtual name="beschrijvend_conclusie" id="beschrijvend_conclusie">';echo stripslashes($obj{"beschrijvend_conclusie"});echo'</textarea><br>
<br><span class=text>';xl('Treatment Plan','e');echo'</span><br>
<textarea cols=80 rows=5 wrap=virtual name="advies_beleid" id="advies_beleid">';echo stripslashes($obj{"advies_beleid"});echo'</textarea><br>

<table><tr>
';;echo'</tr></table>

<br><br>
<a href="javascript:document.my_form.submit();" class="link_submit">[';xl('Save','e');echo']</a>
<br>
<a href="';echo$GLOBALS['form_exit_url'];echo'" class="link_submit"
 onclick="delete_autosave();top.restoreSession()">[';xl('Don\'t Save Changes','e');echo']</a>
</form>

<div id="timestamp"></div>

';formFooter();