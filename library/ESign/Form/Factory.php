<?php

namespace ESign;



require_once $GLOBALS['srcdir'].'/ESign/FactoryIF.php';
require_once $GLOBALS['srcdir'].'/ESign/Form/Configuration.php';
require_once $GLOBALS['srcdir'].'/ESign/Form/Signable.php';
require_once $GLOBALS['srcdir'].'/ESign/Form/LBF/Signable.php';
require_once $GLOBALS['srcdir'].'/ESign/Form/Button.php';
require_once $GLOBALS['srcdir'].'/ESign/Form/Log.php';

class Form_Factory implements FactoryIF
{
    protected $_formId = null;
    protected $_formDir = null;
    protected $_encounterId = null;
    
    public function __construct($formId, $formDir, $encounterId)
    {
        $this->_formId = $formId;
        $this->_formDir = $formDir;
        $this->_encounterId = $encounterId;
    }
    
    public function createConfiguration()
    {
        return new Form_Configuration();
    }
    
    public function createSignable()
    {
        $signable = null;
        if (strpos($this->_formDir, 'LBF') === 0) {
            $signable = new Form_LBF_Signable($this->_formId, $this->_formDir, $this->_encounterId);
        } else {
            $signable = new Form_Signable($this->_formId, $this->_formDir, $this->_encounterId);
        }
        
        return $signable;
    }
    
    public function createButton()
    {
        return new Form_Button($this->_formId, $this->_formDir, $this->_encounterId);
    }

    public function createLog()
    {
        return new Form_Log($this->_formId, $this->_formDir, $this->_encounterId);
    }
}
