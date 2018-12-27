<?php


class InvalidEmailException extends Exception
{
    public function errorMessage()
    {
        return $this->getMessage();
    }
}
