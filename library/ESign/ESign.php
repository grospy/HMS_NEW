<?php
namespace ESign;




class ESign
{
    private $_configuration = null;
    private $_signable = null;
    private $_button = null;
    private $_log = null;

    function __construct(ConfigurationIF $configuration, SignableIF $signable, ButtonIF $button, LogIF $log)
    {
        $this->_configuration = $configuration;
        $this->_signable = $signable;
        $this->_button = $button;
        $this->_log = $log;
    }

    /**
     * Check if the signable object is locked from futher editing
     *
     * @return boolean
     */
    public function isLocked()
    {
        return $this->_signable->isLocked();
    }

    public function isButtonViewable()
    {
        return $this->_button->isViewable();
    }

    /**
     * Check if the log is viewable
     * @param  string  $mode  Currently supports "default" and "report"
     * @return boolean
     */
    public function isLogViewable($mode = "default")
    {
        $viewable = false;
        if (count($this->_signable->getSignatures()) > 0) {
            // If we have signatures, always show the log.
            $viewable = true;
        } else {
            // If in report mode then hide the log if $_GLOBALS['esign_report_hide_empty_sig'] is true and there are no signatures
            if (($mode=="report") && ($GLOBALS['esign_report_hide_empty_sig'])) {
                $viewable = false;
            } else {
                // defer if viewable to the log object
                $viewable = $this->_log->isViewable();
            }
        }

        return $viewable;
    }

    public function renderLog()
    {
        $this->_log->render($this->_signable);
    }

    public function buttonHtml()
    {
        return $this->_button->getHtml();
    }

    public function getSignatures()
    {
        return $this->_signable->getSignatures();
    }
}
