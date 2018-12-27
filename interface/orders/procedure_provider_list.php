<?php




use OpenEMR\Core\Header;

require_once("../globals.php");
require_once("$srcdir/acl.inc");
require_once("$srcdir/options.inc.php");

$popup = empty($_GET['popup']) ? 0 : 1;

$form_name = trim($_POST['form_name']);

$query = "SELECT pp.* FROM procedure_providers AS pp";
$query .= " ORDER BY pp.name";
$res = sqlStatement($query);
?>
<html>

<head>
<?php Header::setupHeader(); ?>
<title><?php echo xlt('Procedure Providers'); ?></title>

<?php if ($popup) { ?>
<script type="text/javascript" src="../../library/topdialog.js"></script>
<?php } ?>

<script language="JavaScript">

<?php if ($popup) {
    require($GLOBALS['srcdir'] . "/restoreSession.php");
} ?>

// Callback from popups to refresh this display.
function refreshme() {
 // location.reload();
 document.forms[0].submit();
}

// Process click to pop up the add window.
function doedclick_add() {
 top.restoreSession();
 dlgopen('procedure_provider_edit.php?ppid=0', '_blank', 700, 550);
}

// Process click to pop up the edit window.
function doedclick_edit(ppid) {
 top.restoreSession();
 dlgopen('procedure_provider_edit.php?ppid=' + ppid, '_blank', 700, 550);
}

</script>

</head>

<body class="body_top">
<div class="container">
   <div class="row">
       <div class="col-xs-12">
           <form method='post' action='procedure_provider_list.php'>
               <div class="page-header">
                   <h1><?php echo xlt('Procedure Providers');?></h1>
               </div>
               <div class="btn-group">
                   <button type="button" name="form_search" class="btn btn-default btn-refresh" onclick="refreshme()"><?php echo xlt('Refresh');?></button>
                   <button type="button" class="btn btn-default btn-add" onclick="doedclick_add()"><?php echo xlt('Add New');?></button>
               </div>

               <table class="table table-striped table-hover">
                   <thead>
                   <tr>
                       <th title='<?php echo xla('Click to view or edit'); ?>'><?php echo xlt('Name'); ?></th>
                       <th><?php echo xlt('NPI'); ?></th>
                       <th><?php echo xlt('Protocol'); ?></th>
                   </tr>
                   </thead>
                   <tbody>
                    <?php
                    while ($row = sqlFetchArray($res)) {
                        if (acl_check('admin', 'practice')) {
                            $trTitle = xl('Edit') . ' ' . $row['name'];
                            echo " <tr class='detail' style='cursor:pointer' " .
                               "onclick='doedclick_edit(" . $row['ppid'] . ")' title='" . attr($trTitle) . "'>\n";
                        } else {
                            $trTitle = $displayName . " (" . xl("Not Allowed to Edit") . ")";
                            echo " <tr class='detail $bgclass' title='" . attr($trTitle) . "'>\n";
                        }

                        echo "  <td>" . text($row['name']) . "</td>\n";
                        echo "  <td>" . text($row['npi']) . "</td>\n";
                        echo "  <td>" . text($row['protocol']) . "</td>\n";
                        echo " </tr>\n";
                    }
                    ?>
                   </tbody>
               </table>
       </div>
   </div>
</body>
</html>
