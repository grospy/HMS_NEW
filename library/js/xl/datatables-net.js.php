<?php

?>
"language": {
    "emptyTable":     "<?php echo xla('No data available in table'); ?>",
    "info":           "<?php echo xla('Showing') . ' _START_ ' . xla('to{{range}}') . ' _END_ ' . xla('of') . ' _TOTAL_ ' . xla('entries'); ?>",
    "infoEmpty":      "<?php echo xla('Showing 0 to 0 of 0 entries'); ?>",
    "infoFiltered":   "(<?php echo xla('filtered from') . ' _MAX_ ' . xla('total entries'); ?>)",
    "lengthMenu":     "<?php echo xla('Show') . ' _MENU_ ' . xla('entries'); ?>",
    "loadingRecords": "<?php echo xla('Loading'); ?>...",
    "processing":     "<?php echo xla('Processing'); ?>...",
    "search":         "<?php echo xla('Search'); ?>:",
    "zeroRecords":    "<?php echo xla('No matching records found'); ?>",
    "paginate": {
        "first":      "<?php echo xla('First'); ?>",
        "last":       "<?php echo xla('Last'); ?>",
        "next":       "<?php echo xla('Next'); ?>",
        "previous":   "<?php echo xla('Previous'); ?>"
    },
    "aria": {
        "sortAscending":  ": <?php echo xla('activate to sort column ascending'); ?>",
        "sortDescending": ": <?php echo xla('activate to sort column descending'); ?>"
    }
    <?php
    if (!empty($translationsDatatablesOverride)) {
        foreach ($translationsDatatablesOverride as $key => $value) {
            echo ', "' . $key . '": "' . $value . '"';
        }
    }
    ?>
}
