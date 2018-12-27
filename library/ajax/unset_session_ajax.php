<?php




require_once("../../interface/globals.php");
require_once("../pid.inc");
require_once("../group.inc");

//Setpid function is called on receiving an ajax request.
if (($_POST['func']=="unset_pid")) {
    setpid(0);
}

//Setpid function is called on receiving an ajax request.
if (($_POST['func']=="unset_gid")) {
    unsetGroup();
}
