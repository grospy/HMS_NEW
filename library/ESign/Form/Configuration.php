<?php

namespace ESign;



require_once $GLOBALS['srcdir'].'/ESign/Abstract/Configuration.php';

class Form_Configuration extends Abstract_Configuration implements ConfigurationIF
{
    public function getModule()
    {
        return "form";
    }
}
