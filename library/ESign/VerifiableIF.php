<?php

namespace ESign;



interface VerifiableIF
{
    /**
     * Return true if verification is successful, false ow
     */
    public function verify();
    
    /**
     * Get the data in an array
     */
    public function getData();
}
