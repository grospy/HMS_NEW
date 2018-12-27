<?php


class DuplicateRegistrationException extends Exception
{
    public function errorMessage()
    {
        return $this->getMessage();
    }
}
