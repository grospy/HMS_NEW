<?php





include_once("../../globals.php");

$feature = $_GET["feature"];
$featureData['amendment']['title'] = xl("Amendments");
$featureData['amendment']['addLink'] = "add_edit_amendments.php";
$featureData['amendment']['listLink'] = "list_amendments.php";

?>
<html>
<head>
<?php html_header_show();?>
<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
</head>
<body class="body_top">

<span class="title"><?php echo text($featureData[$feature]['title']); ?></span>
<table>
<tr height="20px">
<td>

<a href="<?php echo $GLOBALS['webroot']?>/interface/patient_file/summary/<?php echo attr($featureData[$feature]['listLink']); ?>?id=<?php echo attr($pid); ?>" target='rightFrame' class="css_button" onclick="top.restoreSession()">
<span><?php echo xlt('List');?></span></a>
<?php if (acl_check('patients', 'trans')) { ?>
    <a href="<?php echo $GLOBALS['webroot']?>/interface/patient_file/summary/<?php echo attr($featureData[$feature]['addLink']); ?>" target='rightFrame' class="css_button" onclick="top.restoreSession()">
    <span><?php echo xlt('Add');?></span></a>
<?php } ?>
</td>
</tr>
</table>
</body>
</html>
