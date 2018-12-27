<?php

?>

function DateToYYYYMMDD_js(value){
    var value = value.replace(/\//g,'-');
    var parts = value.split('-');
    var date_display_format = <?php echo (empty($GLOBALS['date_display_format']) ? 0 : $GLOBALS['date_display_format']) ?>;

    if (date_display_format == 1)      // mm/dd/yyyy, note year is added below
        value = parts[2] + '-' + parts[0]  + '-' + parts[1];
    else if (date_display_format == 2) // dd/mm/yyyy, note year is added below
        value = parts[2] + '-' + parts[1]  + '-' + parts[0];

    return value;
}

function TimeToHHMMSS_js(value){
    //For now, just return the Value, since input fields are not formatting time.
    // This can be upgraded if decided to format input time fields.
    return value.trim();
}

function DateToYYYYMMDDHHMMSS_js(value){
    if (typeof value === 'undefined') {
        return undefined;
    }
    var parts = value.split(' ');

    var datePart = DateToYYYYMMDD_js(parts[0]);
    var timePart = TimeToHHMMSS_js(parts[1]);

    var value = datePart + ' ' + timePart;

    return value.trim();
}
