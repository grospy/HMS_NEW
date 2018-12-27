<?php


namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Listener\Listener;

use Carecoordination\Controller\EncounterccdadispatchController;
use Zend\Soap\Server;

class SoapController extends AbstractActionController
{
    protected $sendtoTable;
    protected $applicationTable;
    protected $listenerObject;
    protected $encounterccdadispatchTable;
    
    public function __construct()
    {
        $this->listenerObject   = new Listener;
    }
    
    
    public function indexAction()
    {

        $server = new Server(
            null,
            array('uri' => 'http://localhost/index/soap')
        );
        // set SOAP service class
        // Bind already initialized object to Soap Server
        $server->setObject(new EncounterccdadispatchController($this->getServiceLocator()));
        // handle request
        $server->handle();
        exit;
    }
    
        /**
    * Table Gateway
    *
    * @return type
    */
    public function getEncounterccdadispatchTable()
    {
        if (!$this->encounterccdadispatchTable) {
            $sm = $this->getServiceLocator();
            $this->encounterccdadispatchTable = $sm->get('Zend\Db\Adapter\Adapter');
        }

        return $this->encounterccdadispatchTable;
    }
    
    /**
    * Table Gateway
    *
    * @return type
    */
    public function getApplicationTable()
    {
        if (!$this->applicationTable) {
            $sm = $this->getServiceLocator();
            $this->applicationTable = $sm->get('Application\Model\ApplicationTable');
        }

        return $this->applicationTable;
    }
}
