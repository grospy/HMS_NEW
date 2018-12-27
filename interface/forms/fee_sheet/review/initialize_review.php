<?php

if (!$isBilled) {
    require_once("code_check.php");
?>
<script>
    var webroot="<?php echo $web_root;?>";
    var pid=<?php echo $pid;?>;
    var enc=<?php echo $encounter;?>;
    var review_tag="<?php echo xls('Review');?>";
    var justify_click_title="<?php echo xls('Click to choose diagnoses to justify.')?>";
    var fee_sheet_options=[];
    var diag_code_types=<?php echo diag_code_types('json');?>;  // This is a list of diagnosis code types to present for as options in the justify dialog, for now, only "internal codes" included.
    var ippf_specific = <?php echo $GLOBALS['ippf_specific'] ? 'true' : 'false'; ?>;
</script>
<script>
    function fee_sheet_option(code,code_type,description,fee)
    {
        this.code=code;
        this.code_type=code_type;
        this.description=description;
        this.fee=fee;
        return this;
    }
</script>
<!-- rev= in next line is to force a reload if the script is a prior version. -->
<script type="text/javascript" src="<?php echo $web_root;?>/interface/forms/fee_sheet/review/initialize_review.js?rev=1"></script>
<!-- Increment "v=" in the next line if you change fee_sheet_core.js. This makes sure the browser won't use the old cached version. -->
<script type="text/javascript" src="<?php echo $web_root;?>/interface/forms/fee_sheet/review/js/fee_sheet_core.js?v=1"></script>
<script type="text/javascript" src="<?php echo $web_root;?>/interface/forms/fee_sheet/review/fee_sheet_review_view_model.js"></script>
<script type="text/javascript" src="<?php echo $web_root;?>/interface/forms/fee_sheet/review/fee_sheet_justify_view_model.js"></script>

<?php
    // knockoutjs template files
    include_once("views/review.php");
    include_once("views/procedure_select.php");
    include_once("views/justify_display.php");
}
?>
