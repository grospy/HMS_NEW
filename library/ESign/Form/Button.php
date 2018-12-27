<?php

namespace ESign;



require_once $GLOBALS['srcdir'].'/ESign/ButtonIF.php';
require_once $GLOBALS['srcdir'].'/ESign/Viewer.php';
        
class Form_Button implements ButtonIF
{
    private $_viewer = null;

    public function __construct($formId, $formDir, $encounterId)
    {
        // Configure the viewer so it has access to these variables
        $this->_viewer = new Viewer();
        $this->_viewer->formId = $formId;
        $this->_viewer->formDir = $formDir;
        $this->_viewer->encounterId = $encounterId;
        $this->_viewer->target = "_parent";
    }
    
    public function isViewable()
    {
        return $GLOBALS['esign_individual'];
    }
    
    public function getViewScript()
    {
        return $GLOBALS['srcdir'].'/ESign/views/form/esign_button.php';
    }
    
    public function render(SignableIF $signable = null)
    {
        return $this->_viewer->render($this);
    }
    
    public function getHtml(SignableIF $signable = null)
    {
        return $this->_viewer->getHtml($this);
    }
}
