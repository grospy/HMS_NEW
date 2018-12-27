<?php

        require_once("verify_session.php");

        $sql = "SELECT * FROM lists WHERE pid = ? AND type = 'allergy' ORDER BY begdate";

        $res = sqlStatement($sql, array($pid));

if (sqlNumRows($res)>0) {
    ?>
    <table class="table table-striped">
        <tr class="header">
    <th><?php echo xlt('Title'); ?></th>
    <th><?php echo xlt('Reported Date'); ?></th>
    <th><?php echo xlt('Start Date'); ?></th>
    <th><?php echo xlt('End Date'); ?></th>
    <th><?php echo xlt('Referrer'); ?></th>
        </tr>
    <?php
    $even=false;
    while ($row = sqlFetchArray($res)) {
        echo "<tr class='".$class."'>";
        echo "<td>".text($row['title'])."</td>";
        echo "<td>".text($row['date'])."</td>";
        echo "<td>".text($row['begdate'])."</td>";
        echo "<td>".text($row['enddate'])."</td>";
        echo "<td>".text($row['referredby'])."</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo xlt("No Results");
}
?>
