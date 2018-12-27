<?php

require_once("verify_session.php");

$query = "SELECT a.*,lo.title AS AmendmentBy,lo1.title AS AmendmentStatus FROM amendments a 
	INNER JOIN list_options lo ON a.amendment_by = lo.option_id AND lo.list_id = 'amendment_from' AND lo.activity = 1
	LEFT JOIN list_options lo1 ON a.amendment_status = lo1.option_id AND lo1.list_id = 'amendment_status' AND lo1.activity = 1
	WHERE a.pid = ? ORDER BY amendment_date DESC";
$res = sqlStatement($query, array($pid));
if (sqlNumRows($res) > 0) { ?>

    <table class="class1">
        <tr class="header">
            <th><?php echo xlt('Date'); ?></th>
            <th><?php echo xlt('Requested By'); ?></th>
            <th><?php echo xlt('Description'); ?></th>
            <th><?php echo xlt('Status'); ?></th>
        </tr>
    <?php
        $even = false;
    while ($row = sqlFetchArray($res)) {
        if ($even) {
            $class = "class1_even";
            $even = false;
        } else {
            $class="class1_odd";
            $even=true;
        }

        echo "<tr class='".$class."'>";
        echo "<td>".text($row['amendment_date'])."</td>";
        echo "<td>".text($row['AmendmentBy'])."</td>";
        echo "<td>".text($row['amendment_desc'])."</td>";
        echo "<td>".text($row['AmendmentStatus'])."</td>";
        echo "</tr>";
    }

        echo "</table>";
} else {
    echo xlt("No Results");
}
?>