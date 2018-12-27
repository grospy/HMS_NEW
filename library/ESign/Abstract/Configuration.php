<?php

namespace ESign;



require_once $GLOBALS['srcdir'].'/ESign/ConfigurationIF.php';

abstract class Abstract_Configuration implements ConfigurationIF
{
    public function getLogViewMethod()
    {
        return "esign_log_view";
    }
    
    public function getFormViewMethod()
    {
        return "esign_form_view";
    }
    
    public function getFormSubmitMethod()
    {
        return "esign_form_submit";
    }
    
    public function getBaseUrl()
    {
        return $GLOBALS['webroot']."/interface/esign/index.php";
    }
    
    public function getLogViewAction()
    {
        return $this->getBaseUrl()."?module=".$this->getModule()."&method=".$this->getLogViewMethod();
    }
    
    public function getFormViewAction()
    {
        return $this->getBaseUrl()."?module=".$this->getModule()."&method=".$this->getFormViewMethod();
    }
    
    public function getFormSubmitAction()
    {
        return $this->getBaseUrl()."?module=".$this->getModule()."&method=".$this->getFormSubmitMethod();
    }
}
