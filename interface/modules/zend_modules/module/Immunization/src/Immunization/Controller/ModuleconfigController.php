<?php

namespace Immunization\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

use Immunization\Form\ImmunizationForm;
use Application\Listener\Listener;

class ModuleconfigController extends AbstractActionController
{
    protected $inputFilter;

    public function __construct()
    {
    }

    public function exchangeArray($data)
    {
    }
  
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
  
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();
            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
  
    public function getHookConfig()
    {
        $hooks  =  array();
        return $hooks;
    }
    
    public function getAclConfig()
    {
        $acl = array();
        return $acl;
    }
  
    public function configSettings()
    {
        $settings = array();
        return $settings;
    }
  
    public function getDependedModulesConfig()
    {
        return $dependedModules;
    }
}
