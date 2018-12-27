<?php

namespace ESign;



require_once $GLOBALS['srcdir'].'/ESign/FactoryIF.php';
require_once $GLOBALS['srcdir'].'/ESign/Encounter/Configuration.php';
require_once $GLOBALS['srcdir'].'/ESign/Encounter/Signable.php';
require_once $GLOBALS['srcdir'].'/ESign/Encounter/Button.php';
require_once $GLOBALS['srcdir'].'/ESign/Encounter/Log.php';

class Encounter_Factory implements FactoryIF
{
    protected $_encounterId = null;
    
    public function __construct($encounterId)
    {
        $this->_encounterId = $encounterId;
    }
    
    public function createConfiguration()
    {
        return new Encounter_Configuration();
    }
    
    public function createSignable()
    {
        return new Encounter_Signable($this->_encounterId);
    }
    
    public function createButton()
    {
        return new Encounter_Button($this->_encounterId);
    }

    public function createLog()
    {
        return new Encounter_Log($this->_encounterId);
    }
}
