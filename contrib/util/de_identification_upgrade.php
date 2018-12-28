<?php ini_set('max_execution_time','0');$ignoreAuth=true;$de_identification_config=0;require_once('../../interface/globals.php');function tableExists_de($tblname){$row=sqlQuery("SHOW TABLES LIKE '".$tblname."'");if(empty($row)){return false;}return true;}function upgradeFromSqlFile_de($filename){global $webserver_root;flush();echo"<font color='green'>";echo xl('Processing');echo" ".$filename."...</font><br />\n";$fullname=$webserver_root."/sql/".$filename;$fd=fopen($fullname,'r');if($fd==false){echo xl("Error, unable to open file");echo" ".$fullname."\n";flush();break;}$query="";$line="";$skipping=false;$proc=0;while(!feof($fd)){$line=fgets($fd,2048);$line=rtrim($line);if(preg_match('/^\s*--/',$line)){continue;}if($line==""){continue;}if(preg_match('/^#IfNotTable\s+(\S+)/',$line,$matches)){$skipping=tableExists_de($matches[1]);if($skipping){echo"<font color='green'>";}echo xl('Skipping section');echo" ".$line."</font><br />\n";}else if(preg_match('/^#EndIf/',$line)){$skipping=false;}if(preg_match('/^\s*#/',$line)){continue;}if($skipping){continue;}if($proc==1){$query.="\n";}$query=$query.$line;if(substr($query,-1)=='$'){$query=rtrim($query,'$');if($proc==0){$proc=1;}else{$proc=0;if(!sqlStatement($query)){echo"<font color='red'>";echo xl("The above statement failed");echo": ".getSqlLastError()."<br />";echo xl("Upgrading will continue");echo".<br /></font>\n";}$query='';}}if(substr($query,-1)==';' and $proc==0){$query=rtrim($query,';');echo$query."<br />\n";if(!sqlStatement($query)){echo"<font color='red'>";echo xl("The above statement failed");echo": ".getSqlLastError()."<br />";echo xl("Upgrading will continue");echo".<br /></font>\n";}$query='';}}flush();}$sqldir=$webserver_root."/sql";$dh=opendir($sqldir);if(!$dh){die(xl("Cannot read","e")." ".$sqldir);}closedir($dh);echo'<html>
<head>
<title>';xl('HMS Database Upgrade','e');echo'</title>
<link rel=\'STYLESHEET\' href=\'../../interface/themes/style_sky_blue.css\'>
</head>
<body> <br>
<center>
<span class=\'title\'>';xl('HMS Database Upgrade for De-identification','e');echo'</span>
<br>
</center>
';if(!empty($_POST['form_submit'])){upgradeFromSqlFile_de("database_de_identification.sql");$dbh=$GLOBALS['dbh'];if($dbh==false){echo"\n";echo"<p>".getSqlLastError()." (#".getSqlLastErrorNo().")\n";break;}$login=$sqlconf["login"];$loginhost=$sqlconf["host"];generic_sql_select_db($sqlconf['dbase']) or die(getSqlLastError());if(sqlStatement("GRANT FILE ON *.* TO '".$login."'@'".$loginhost."'")==false){echo xl("Error when granting file privilege to the HMS user.");echo"\n";echo"<p>".getSqlLastError()." (#".getSqlLastErrorNo().")\n";echo xl("Error");echo"\n";break;}else{echo"<font color='green'>";}echo xl("File privilege granted to HMS user.");echo"<br></font>\n";echo"<p><font color='green'>";echo xl("Database upgrade finished.");echo"</font></p>\n";echo"<p><font color='red'>";echo xl("Please restart the apache server before playing with de-identification");echo"</font></p>\n";echo"<p><font color='red'>";echo xl("Please set de_identification_config variable back to zero");echo"</font></p>\n";echo"</body></html>\n";sqlClose($dbh);exit();};echo'
<script language="JavaScript">
function form_validate()
{
 if(document.forms[0].root_user_name.value == "")
 {
  alert("';echo xl('Enter Database root Username');echo'");
  return false;
 }
 /*if(document.forms[0].root_user_pass.value == "")
 {
  alert("';echo xl('Enter Database root Password');echo'");
  return false;
 }*/
 return true;
}
</script>

<center>
<form method=\'post\' action=\'de_identification_upgrade.php\' onsubmit="return form_validate();">
</br>
<p>';if($de_identification_config!=1){echo"<p><font color='red'>";echo xl("Please set");echo" 'de_identification_config' ";echo xl("variable to one to run de-identification upgrade script");echo"</br></br>";echo"([OPENEMR]/contrib/util/de_identification_upgrade.php)";}else{xl('Upgrades the HMS database to include Procedures, Functions and tables needed for De-identification process','e');echo'</p></br>
        <table class="de_id_upgrade_login" align="center">
    <tr><td>&nbsp;</td><td colspan=3 align=center>&nbsp;</td><td>&nbsp;</td></tr>
    <tr valign="top">
        <td>&nbsp;</td>
        <td>';xl('Enter Database root Username','e');echo'</td>
        <td>:</td>
        <td> <input type=\'text\' size=\'20\' name=\'root_user_name\' id=\'root_user_name\'
            value= "" title="';xl('Enter Database root Username','e');echo'" /> </td>
        <td>&nbsp;</td>
    </tr>
    <tr valign="top">
        <td>&nbsp;</td>
        <td>';xl('Enter Database root Password','e');echo'</td>
        <td>:</td>
        <td><input type=\'password\' size=\'20\' name=\'root_user_pass\' id=\'root_user_pass\'
            value= "" title="';xl('Enter Database root Password','e');echo'" /> </td>
        <td>&nbsp;</td>
    </tr>
    <tr><td>&nbsp;</td><td colspan=3 align=center>&nbsp;</td><td>&nbsp;</td></tr>

    </table>
<p><input type=\'submit\' name=\'form_submit\' value="';xl('Upgrade Database','e');echo'"  /></p>
';};echo'</form>
</center>
</body>
</html>
';