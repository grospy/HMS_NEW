<?php

namespace Carecoordination\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Filter\Compress\Zip;
use Carecoordination\Form\ModuleconfigForm;

class ModuleconfigController extends AbstractActionController
{
    protected $inputFilter;
    
    public function __construct()
    {
    }
    
    public function indexAction()
    {
        $form = new ModuleconfigForm();
        $form->get('hie_author_id')->setAttribute('options', array('user 1','user 2'));
        
        $view =  new ViewModel(array(
            'form' => $form,
        ));
        return $view;
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
    //SOECIFY HOOKS DETAILS OF A MODULE IN AN ARRAY, WITH MODULE NAME AS KEY
    //SHOULD SPECIFY THE CONTROLLER AND ITS ACTION IN THE PATH, INCLUDING INDEX ACTION
        $hooks  =  array(
                '0' => array(
                        'name'  => "send_to_hie",
                        'title' => "Send To HIE",
                        'path'  => "encountermanager",
                    ),
               );
    
        return $hooks;
    }
    
    public function getDependedModulesConfig()
    {
        $dependedModules = array('Ccr','Immunization','Syndromicsurveillance');
        return $dependedModules;
    }
    
    public function getAclConfig()
    {
        $acl = array(
        array(
        'section_id' => 'send_to_hie',
        'section_name' => 'Send To HIE',
        'parent_section' => 'carecoordination',
        ),
        );
        return $acl;
    }
}
