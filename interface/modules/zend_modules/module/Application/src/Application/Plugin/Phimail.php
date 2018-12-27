<?php

namespace Application\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Application\Model\ApplicationTable;
use Application\Listener\Listener;

require_once($GLOBALS['srcdir'].'/direct_message_check.inc');

class Phimail extends AbstractPlugin
{
    protected $application;
  /**
  *
  * Application Table Object
  * Listener Oblect
  * @param type $sm Service Manager
  */
    public function __construct($sm)
    {
        $sm->get('Zend\Db\Adapter\Adapter');
        $this->application    = new ApplicationTable();
        $this->listenerObject = new Listener;
    }

    public function phimail_connect($err)
    {
        return phimail_connect($err);
    }
  
    public function phimail_write($fp, $text)
    {
        phimail_write($fp, $text);
    }
  
    public function phimail_write_expect_OK($fp, $text)
    {
        return phimail_write_expect_OK($fp, $text);
    }
  
    public function phimail_close($fp)
    {
        phimail_close($fp);
    }
}
