<?php



include_once(dirname(__FILE__).'/../../globals.php');
include_once($GLOBALS["srcdir"]."/api.inc");
function clinical_instructions_report($pid, $encounter, $cols, $id)
{
    $count = 0;
    $data = formFetch("form_clinical_instructions", $id);
    if ($data) {
        ?>
        <table style='border-collapse:collapse;border-spacing:0;width: 100%;'>
            <tr>
                <td align='center' style='border:1px solid #ccc;padding:4px;'><span class=bold><?php echo xlt('Instructions'); ?></span></td>
            </tr>            
            <tr>
                <td style='border:1px solid #ccc;padding:4px;'><span class=text><?php echo nl2br(text($data['instruction'])); ?></span></td>
            </tr>
        </table>
        <?php
    }
}
?>