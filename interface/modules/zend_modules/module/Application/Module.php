<?php


namespace Application;

use Application\Model\ApplicationTable;
use Application\Model\SendtoTable;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
    
    public function getControllerPluginConfig()
    {
        return array(
        'factories' => array(
          'CommonPlugin' => function ($sm) {
            $sm = $sm->getServiceLocator();
            return new Plugin\CommonPlugin($sm);
          }
        ),
        
        'Phimail' => function ($sm) {
            $sm = $sm->getServiceLocator();
            return new Plugin\Phimail($sm);
        },
        );
    }

    public function getServiceConfig()
    {
        return array(
        'factories' => array(
          'Application\Model\ApplicationTable' =>  function ($sm) {
            $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
            $table = new ApplicationTable($dbAdapter);
            return $table;
          },
            'Application\Model\SendtoTable' =>  function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new SendtoTable($dbAdapter);
                    return $table;
            },
        ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
        'Zend\Loader\StandardAutoloader' => array(
            'namespaces' => array(
                __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
            ),
        ),
        );
    }
}
