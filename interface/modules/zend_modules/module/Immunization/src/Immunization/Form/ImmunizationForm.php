<?php

namespace Immunization\Form;

use Zend\Form\Form;

class ImmunizationForm extends Form
{
    public function __construct($name = null)
    {
        global $pid,$encounter;
        parent::__construct('immunization');
        $this->setAttribute('method', 'post');
        
     // Codes
        $this->add(array(
                'name'          => 'codes',
                'type'          => 'Zend\Form\Element\Select',
                'attributes'        => array(
                                        'multiple'      => 'multiple',
                                        'size'          => '3',
                        'class'     => 'select',
                        'style'     => 'width:150px',
                        'editable'  => 'false',
                        'id'        => 'codes'
                ),
                'options' => array(
                        'value_options' => array(
                                '' => \Application\Listener\Listener::z_xlt('Unassigned'),
                        ),),
        ));
        
        $this->add(array(
                            'name' => 'from_date',
                            'type' => 'Zend\Form\Element\Text',
                            'attributes' => array(
                                            'id'          => 'from_date',
                                            'placeholder' => 'From Date',
                                            'value'       => date('Y-m-d', strtotime(date('Ymd')) - (86400*7)),
                                            'class'       => 'date_field',
                                            'style'       => 'width: 42%;cursor:not-allowed;',
                            ),
                          ));
       
        $this->add(array(
                        'name' => 'to_date',
                        'type' => 'Date',
                        'attributes' => array(
                                        'id'        => 'to_date',
                                        'placeholder'   => 'To Date',
                                        'class'         => 'date_field',
                                        'value'         => date('Y-m-d'),
                                        'style'         => 'width: 42%;cursor:not-allowed;',
                                        'type'          => 'text',
                                        'onchange' => 'validate_search();'
                        ),
                    ));
        
        $this->add(array(
                        'name' => 'search',
                        'type' => 'submit',
                        'attributes' => array(
                                        'value' => \Application\Listener\Listener::z_xlt('SEARCH'),
                                        'id'    => 'search_form_button',
                                        ),
                    ));
        $this->add(array(
                        'name' => 'print',
                        'attributes' => array(
                                        'type'  => 'button',
                                        'value' => \Application\Listener\Listener::z_xlt('Print'),
                                        'id'    => 'printbutton',
                                         ),
                    ));
        $this->add(array(
                        'name' => 'hl7button',
                        'type'  => 'submit',
                        'attributes' => array(
                                        'value' => \Application\Listener\Listener::z_xlt('GET HL7'),
                                        'id'    => 'hl7button',
                                        'onclick'=> 'getHl7(this.value);',
                                        'style' => 'display:none;'
                                        ),
                    ));
    }
}
