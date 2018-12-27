<?php

namespace ESign;



require_once $GLOBALS['srcdir'].'/ESign/Abstract/Configuration.php';

class Encounter_Configuration extends Abstract_Configuration implements ConfigurationIF
{
    public function getModule()
    {
        return "encounter";
    }
}
