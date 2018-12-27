<?php

namespace ESign;



require_once $GLOBALS['srcdir'].'/ESign/ButtonIF.php';
require_once $GLOBALS['srcdir'].'/ESign/ViewableIF.php';

class Encounter_Button implements ButtonIF
{
    private $_viewer = null;

    public function __construct($encounterId)
    {
        $this->_viewer = new Viewer();
        $this->_viewer->target = "_parent";
        $this->_viewer->encounterId = $encounterId;
    }
    
    public function isViewable()
    {
        return $GLOBALS['esign_all'];
    }
    
    public function getViewScript()
    {
        return $GLOBALS['srcdir'].'/ESign/views/encounter/esign_button.php';
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
