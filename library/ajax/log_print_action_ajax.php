<?php


// AJAX handler for logging a printing action.




require_once("../../interface/globals.php");
require_once("$srcdir/log.inc");

$instance = new html2text($_POST['comments']);
$h2t = &$instance;
$h2t->width = 0;
$h2t->_convert(false);

newEvent("print", $_SESSION['authUser'], $_SESSION['authProvider'], 1, $h2t->get_text());
