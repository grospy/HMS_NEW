<?php


namespace ESign;

interface ConfigurationIF
{
    public function getBaseUrl();
    public function getModule();
    public function getLogViewAction();
    public function getFormViewAction();
    public function getFormSubmitAction();
}
