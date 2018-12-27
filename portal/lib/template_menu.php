<?php

foreach (glob($GLOBALS['OE_SITE_DIR'] . "/documents/onsite_portal_documents/templates/*.tpl") as $filename) {
    $basefile = basename($filename, ".tpl");
    $btnname = str_replace('_', ' ', $basefile);
    $btnfile = $basefile . '.tpl';

    echo '<li class="bg-success"><a id="' . $basefile . '"' . 'href="#" onclick="page.newDocument(' . "<%= cpid %>,'<%= cuser %>','$btnfile')".'"'.">$btnname</a></li>";
}

foreach (glob($GLOBALS['OE_SITE_DIR'] . "/documents/onsite_portal_documents/templates/" . $pid . "/*.tpl") as $filename) {
    $basefile = basename($filename, ".tpl");
    $btnname = str_replace('_', ' ', $basefile);
    $btnfile = $basefile . '.tpl';

    echo '<li class="bg-success"><a id="' . $basefile . '"' . 'href="#" onclick="page.newDocument(' . "<%= cpid %>,'<%= cuser %>','$btnfile')".'"'.">$btnname</a></li>";
}
