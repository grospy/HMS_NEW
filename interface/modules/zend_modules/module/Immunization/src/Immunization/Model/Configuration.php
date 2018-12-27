<?php


namespace Immunization\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Form\Form;

class Configuration extends Form implements InputFilterAwareInterface
{
    protected $inputFilter;

    public function __construct()
    {
        parent::__construct('configuration');
        $this->setAttribute('method', 'post');
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
        $hooks    =  array();
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
