<?php





require_once("../../globals.php");
?>
<html>
<head>
<?php html_header_show();?>
<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
</head>
<body class="body_top">

<span class="title"><?php echo xlt('Prescriptions'); ?></span>
<table>
<tr height="20px">
<td>
    <a href="<?php echo $GLOBALS['webroot']?>/controller.php?prescription&list&id=<?php echo attr($pid); ?>"  target='RxRight' class="css_button" onclick="top.restoreSession()">
    <span><?php echo xlt('List');?></span></a>
    <a href="<?php echo $GLOBALS['webroot']?>/controller.php?prescription&edit&id=&pid=<?php echo attr($pid); ?>"  target='RxRight' class="css_button" onclick="top.restoreSession()">
    <span><?php echo xlt('Add');?></span></a>
</td>
</tr>
<tr>
<td>
<?php if ($GLOBALS['rx_show_drug-drug']) { ?>
    <a href="<?php echo $GLOBALS['webroot']?>/interface/weno/drug-drug.php"  target='RxRight' class="css_button" onclick="top.restoreSession()">
    <span><?php echo xlt('Drug-Drug');?></span></a>
<?php } ?>
</td>
</tr>
</table>

</body>
</html>
