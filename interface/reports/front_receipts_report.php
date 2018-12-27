<?php



require_once("../globals.php");
require_once("$srcdir/patient.inc");

use OpenEMR\Core\Header;

$from_date = (isset($_POST['form_from_date'])) ? DateToYYYYMMDD($_POST['form_from_date']) : date('Y-m-d');
$to_date   = (isset($_POST['form_to_date'])) ? DateToYYYYMMDD($_POST['form_to_date']) : date('Y-m-d');

function bucks($amt)
{
    return ($amt != 0.00) ? oeFormatMoney($amt) : '';
}
?>
<html>
<head>

    <title><?php echo xlt('Front Office Receipts'); ?></title>

    <?php Header::setupHeader('datetime-picker'); ?>

    <script language="JavaScript">
        <?php require($GLOBALS['srcdir'] . "/restoreSession.php"); ?>

        $(document).ready(function() {
            var win = top.printLogSetup ? top : opener.top;
            win.printLogSetup(document.getElementById('printbutton'));

            $('.datepicker').datetimepicker({
                <?php $datetimepicker_timepicker = false; ?>
                <?php $datetimepicker_showseconds = false; ?>
                <?php $datetimepicker_formatInput = true; ?>
                <?php require($GLOBALS['srcdir'] . '/js/xl/jquery-datetimepicker-2-5-4.js.php'); ?>
                <?php // can add any additional javascript settings to datetimepicker here; need to prepend first setting with a comma ?>
            });
        });

        // The OnClick handler for receipt display.
        function show_receipt(pid,timestamp) {
            dlgopen('../patient_file/front_payment.php?receipt=1&patient=' + pid +
                '&time=' + timestamp, '_blank', 550, 400, '', '', {
                onClosed: 'reload'
            });
         }
    </script>

    <style type="text/css">
    /* specifically include & exclude from printing */
    @media print {
        #report_parameters {
            visibility: hidden;
            display: none;
        }
        #report_parameters_daterange {
            visibility: visible;
            display: inline;
        }
        #report_results {
           margin-top: 30px;
        }
    }

    /* specifically exclude some from the screen */
    @media screen {
        #report_parameters_daterange {
            visibility: hidden;
            display: none;
        }
    }
    </style>
</head>

<body class="body_top">

<!-- Required for the popup date selectors -->
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>

<span class='title'><?php echo xlt('Report'); ?> - <?php echo xlt('Front Office Receipts'); ?></span>

<div id="report_parameters_daterange">
<?php echo text(oeFormatShortDate($from_date)) ." &nbsp; " . xlt("to") . " &nbsp; ". text(oeFormatShortDate($to_date)); ?>
</div>

<form name='theform' method='post' action='front_receipts_report.php' id='theform' onsubmit='return top.restoreSession()'>

<div id="report_parameters">

<input type='hidden' name='form_refresh' id='form_refresh' value=''/>

<table>
 <tr>
  <td width='410px'>
    <div style='float:left'>

    <table class='text'>
        <tr>
            <td class='control-label'>
                <?php echo xlt('From'); ?>:
            </td>
            <td>
               <input type='text' class='datepicker form-control' name='form_from_date' id="form_from_date" size='10' value='<?php echo attr(oeFormatShortDate($from_date)); ?>'>
            </td>
            <td class='control-label'>
                <?php xl('To', 'e'); ?>:
            </td>
            <td>
               <input type='text' class='datepicker form-control' name='form_to_date' id="form_to_date" size='10' value='<?php echo attr(oeFormatShortDate($to_date)); ?>'>
            </td>
        </tr>
    </table>

    </div>

  </td>
  <td align='left' valign='middle' height="100%">
    <table style='border-left:1px solid; width:100%; height:100%' >
        <tr>
            <td>
                <div class="text-center">
          <div class="btn-group" role="group">
                      <a href='#' class='btn btn-default btn-save' onclick='$("#form_refresh").attr("value","true"); $("#theform").submit();'>
                            <?php echo xlt('Submit'); ?>
                      </a>
                        <?php if ($_POST['form_refresh']) { ?>
                        <a href='#' class='btn btn-default btn-print' id='printbutton'>
                                <?php echo xlt('Print'); ?>
                        </a>
                        <?php } ?>
          </div>
                </div>
            </td>
        </tr>
    </table>
  </td>
 </tr>
</table>
</div> <!-- end of parameters -->

<?php
if ($_POST['form_refresh'] || $_POST['form_orderby']) {
?>
<div id="report_results">
<table>
<thead>
<th> <?php echo xlt('Time'); ?> </th>
<th> <?php echo xlt('Patient'); ?> </th>
<th> <?php echo xlt('ID'); ?> </th>
<th> <?php echo xlt('Method'); ?> </th>
<th> <?php echo xlt('Source'); ?> </th>
<th align='right'> <?php echo xlt('Today'); ?> </th>
<th align='right'> <?php echo xlt('Previous'); ?> </th>
<th align='right'> <?php echo xlt('Total'); ?> </th>
</thead>
<tbody>
<?php
if (true || $_POST['form_refresh']) {
    $total1 = 0.00;
    $total2 = 0.00;

    $query = "SELECT r.pid, r.dtime, " .
    "SUM(r.amount1) AS amount1, " .
    "SUM(r.amount2) AS amount2, " .
    "MAX(r.method) AS method, " .
    "MAX(r.source) AS source, " .
    "MAX(r.user) AS user, " .
    "p.fname, p.mname, p.lname, p.pubpid " .
    "FROM payments AS r " .
    "LEFT OUTER JOIN patient_data AS p ON " .
    "p.pid = r.pid " .
    "WHERE " .
    "r.dtime >= ? AND " .
    "r.dtime <= ? " .
    "GROUP BY r.dtime, r.pid ORDER BY r.dtime, r.pid";

    // echo "<!-- $query -->\n"; // debugging
    $res = sqlStatement($query, array($from_date.' 00:00:00', $to_date.' 23:59:59'));

    while ($row = sqlFetchArray($res)) {
        // Make the timestamp URL-friendly.
        $timestamp = preg_replace('/[^0-9]/', '', $row['dtime']);
    ?>
   <tr>
    <td nowrap>
     <a href="javascript:show_receipt(<?php echo $row['pid'] . ",'$timestamp'"; ?>)">
        <?php echo text(oeFormatShortDate(substr($row['dtime'], 0, 10))) . text(substr($row['dtime'], 10, 6)); ?>
   </a>
  </td>
  <td>
        <?php echo text($row['lname']) . ', ' . text($row['fname']) . ' ' . text($row['mname']); ?>
  </td>
  <td>
        <?php echo text($row['pubpid']); ?>
  </td>
  <td>
        <?php echo text($row['method']); ?>
  </td>
  <td>
        <?php echo text($row['source']); ?>
  </td>
  <td align='right'>
        <?php echo text(bucks($row['amount1'])); ?>
  </td>
  <td align='right'>
        <?php echo text(bucks($row['amount2'])); ?>
  </td>
  <td align='right'>
        <?php echo text(bucks($row['amount1'] + $row['amount2'])); ?>
  </td>
 </tr>
<?php
    $total1 += $row['amount1'];
    $total2 += $row['amount2'];
    }
?>

<tr>
 <td colspan='8'>
  &nbsp;
 </td>
</tr>

<tr class="report_totals">
 <td colspan='5'>
    <?php echo xlt('Totals'); ?>
 </td>
 <td align='right'>
    <?php echo text(bucks($total1)); ?>
 </td>
 <td align='right'>
    <?php echo text(bucks($total2)); ?>
 </td>
 <td align='right'>
    <?php echo text(bucks($total1 + $total2)); ?>
 </td>
</tr>

<?php
}
?>
</tbody>
</table>
</div> <!-- end of results -->
<?php } else { ?>
<div class='text'>
    <?php echo xlt('Please input search criteria above, and click Submit to view results.'); ?>
</div>
<?php } ?>

</form>
</body>
</html>
