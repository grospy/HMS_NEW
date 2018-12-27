<?php


require_once("../../interface/globals.php");
require_once("$srcdir/pid.inc");

if ($_GET["set_pid"] && $_GET["set_pid"] != $_SESSION["pid"]) {
    setpid($_GET["set_pid"]);
}
