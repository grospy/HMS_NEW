<?php

?>
<script type="text/html" id="procedure-select">
    <select data-bind="options: procedure_choices, optionsText: function(item){ return (item.code + ' ' + item.description);}, value:procedure_choice, event: {change: change_procedure}"></select>
</script>
