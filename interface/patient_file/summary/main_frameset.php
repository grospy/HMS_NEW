<?php




include_once("../../globals.php");

$feature = $_GET["feature"];
$id = $_GET["id"];

$featureData['amendment']['title'] = xl("Amendments");
$featureData['amendment']['addLink'] = "add_edit_amendments.php";
$featureData['amendment']['listLink'] = "list_amendments.php";
?>
<html>
<head>
<?php html_header_show();?>
<title><?php echo text($featureData[$feature]['title']); ?></title>
</head>

<frameset cols="18%,*" id="main_frame">
 <frame src="left_frame.php?feature=<?php echo attr($feature); ?>" name="leftFrame" scrolling="auto"/>
    <?php if ($id) { ?>
    <frame src="<?php echo $GLOBALS['webroot'] ?>/interface/patient_file/summary/<?php echo attr($featureData[$feature]['addLink']); ?>?id=<?php echo attr($id) ?>"
        name="rightFrame" scrolling="auto"/>
    <?php } else { ?>
    <frame src="<?php echo $GLOBALS['webroot'] ?>/interface/patient_file/summary/<?php echo attr($featureData[$feature]['listLink']); ?>?id=<?php echo attr($pid) ?>"
        name="rightFrame" scrolling="auto"/>
    <?php } ?>
</frameset>

</html>
