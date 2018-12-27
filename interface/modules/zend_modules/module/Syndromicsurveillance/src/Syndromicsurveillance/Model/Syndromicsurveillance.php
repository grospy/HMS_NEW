<?php


namespace Syndromicsurveillance\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Form\Form;

class Syndromicsurveillance extends Form implements InputFilterAwareInterface
{
    protected $inputFilter;

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
    
    public function fetch_result($fromDate, $toDate, $code_selected, $provider_selected, $form_provider_id)
    {
    }
}
