<?php


class GenericProductRegistrationException extends Exception
{
    public function errorMessage()
    {
        return $this->getMessage();
    }
}
