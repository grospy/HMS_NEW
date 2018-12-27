<?php

namespace ESign;



interface FactoryIF
{
    /**
     * Returns an instance of ConfigurationIF
     */
    public function createConfiguration();
    
    /**
     * Returns an instance of SignableIF
     */
    public function createSignable();
    
    /**
     * Returns an instance of ButtonIF
     */
    public function createButton();
    
    /**
     * Returns an instance of LogIF
     */
    public function createLog();
}
