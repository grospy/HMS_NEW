<?php

?>
<!doctype html>

<html lang="">
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="<?php echo $GLOBALS['assets_static_relative'];?>/bootstrap-3-3-4/dist/css/bootstrap.min.css" type="text/css">
    <?php if ($_SESSION['language_direction'] == 'rtl') : ?>
        <link rel="stylesheet" href="<?php echo $GLOBALS['assets_static_relative'];?>/bootstrap-rtl-3-3-4/dist/css/bootstrap-rtl.min.css" type="text/css">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo $GLOBALS['assets_static_relative'];?>/jquery-ui-1-11-4/themes/base/theme.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $GLOBALS['assets_static_relative'];?>/datatables.net-jqui-1-10-13/css/dataTables.jqueryui.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $GLOBALS['assets_static_relative'];?>/jquery-datetimepicker-2-5-4/build/jquery.datetimepicker.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $GLOBALS['css_header'];?>" type="text/css">

    <script src="<?php echo $GLOBALS['assets_static_relative'];?>/jquery-min-1-9-1/index.js"></script>
    <script src="<?php echo $GLOBALS['assets_static_relative'];?>/moment-2-13-0/min/moment.min.js"></script>
    <script src="<?php echo $GLOBALS['assets_static_relative'];?>/datatables.net-1-10-13/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo $GLOBALS['assets_static_relative'];?>/jquery-datetimepicker-2-5-4/build/jquery.datetimepicker.full.min.js"></script>
    <script src="<?php echo $GLOBALS['assets_static_relative'];?>/jquery-ui-1-12-1/jquery-ui.min.js"></script>
    <script src="<?php echo $GLOBALS['web_root'];?>/library/topdialog.js"></script>
    <script src="<?php echo $GLOBALS['web_root'];?>/library/dialog.js"></script>
    <script>
        <?php require $GLOBALS['srcdir'] . "/formatting_DateToYYYYMMDD_js.js.php" ?>
    </script>
</head>

<body class="body_top therapy_group">


