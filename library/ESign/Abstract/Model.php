<?php

namespace ESign;



abstract class Abstract_Model
{
    private $_args = array();
    
    public function __construct(array $args = null)
    {
        if ($args !== null) {
            $this->_args = $args;
        }
    }
    
    protected function pushArgs($force = false)
    {
        foreach ($this->_args as $key => $value) {
            if ($force) {
                $this->{$key} = $value;
            } else {
                if (property_exists($this, $key)) {
                    $this->{$key} = $value;
                } else if (property_exists($this, "_".$key)) {
                    $this->{"_".$key} = $value;
                }
            }
        }
    }
}
