<?php




require_once("../../globals.php");

?>
<div id='labdata' style='margin-top: 3px; margin-left: 10px; margin-right: 10px'><!--outer div-->
<br>
<?php
//retrieve most recent set of labdata.
$spell = "SELECT procedure_report.date_collected AS thedate, " .
                  "procedure_order_code.procedure_name AS theprocedure, " .
                  "procedure_order.encounter_id AS theencounter " .
            "FROM procedure_report " .
            "JOIN procedure_order ON  procedure_report.procedure_order_id = procedure_order.procedure_order_id " .
            "JOIN procedure_order_code ON procedure_order.procedure_order_id = procedure_order_code.procedure_order_id " .
            "WHERE procedure_order.patient_id = ? " .
            "ORDER BY procedure_report.date_collected DESC ";
$result=sqlQuery($spell, array($pid));
    
if (!$result) { //If there are no lab data recorded
    ?>
  <span class='text'> <?php echo htmlspecialchars(xl("No lab data documented."), ENT_NOQUOTES);
?>
  </span> 
<?php
} else {
?> 
  <span class='text'><b>
    <?php echo htmlspecialchars(xl('Most recent lab data:'), ENT_NOQUOTES); ?>
  </b>
  <br />
    <?php
    echo xlt('Procedure') . ": " . text($result['theprocedure']) . " (" . text($result['thedate']) . ")<br>";
    echo xlt('Encounter') . ": <a href='../../patient_file/encounter/encounter_top.php?set_encounter=" . attr($result['theencounter']) . "' target='RBot'>" . text($result['theencounter']) . "</a>";
    ?>
  <br />
  </span><span class='text'>
  <br />
  <a href='../summary/labdata.php' onclick='top.restoreSession()'><?php echo htmlspecialchars(xl('Click here to view and graph all labdata.'), ENT_NOQUOTES);?></a>
  </span><?php
} ?>
<br />
<br />
</div>
