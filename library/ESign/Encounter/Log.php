<?php

namespace ESign;



require_once $GLOBALS['srcdir'].'/ESign/LogIF.php';
require_once $GLOBALS['srcdir'].'/ESign/Viewer.php';

class Encounter_Log implements LogIF
{
    protected $_viewer = null;
    
    /**
     * Create a new instance of Encounter_Log.
     *
     * We pass custom variables needed to render log through
     * the constructor because they aren't necessarily available
     * through the SignableIF interface when render() function is called.
     *
     * @param unknown $encounterId
     */
    public function __construct($encounterId)
    {
        $this->_viewer = new Viewer();
        $this->_viewer->encounterId = $encounterId;
        $this->_viewer->logId = "encounter-".$encounterId;
    }
    
    public function render(SignableIF $signable)
    {
        $this->_viewer->signatures = $signable->getSignatures();
        $this->_viewer->verified = $signable->verify();
        return $this->_viewer->render($this);
    }
    
    public function getHtml(SignableIF $signable)
    {
        $this->_viewer->verified = $signable->verify();
        $this->_viewer->signatures = $signable->getSignatures();
        return $this->_viewer->getHtml($this);
    }
    
    public function getViewScript()
    {
        return $GLOBALS['srcdir'].'/ESign/views/default/esign_signature_log.php';
    }

    /**
     * Check if the log is viewable.
     *
     * @return boolean
     */
    public function isViewable()
    {
        $viewable = false;
        if ($GLOBALS['esign_all']) {
            $viewable = true;
        }
        
        return $viewable;
    }
}
