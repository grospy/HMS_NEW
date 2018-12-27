<?php


namespace Documents;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\ModuleManager;
use Documents\Model\DocumentsTable;

class Module implements AutoloaderProviderInterface
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
        
    public function init(ModuleManager $mm)
    {
        $mm->getEventManager()->getSharedManager()->attach(__NAMESPACE__, 'dispatch', function ($e) {
            $controller             = $e->getTarget();
            $route                      = $controller->getEvent()->getRouteMatch();
            $controller_name    = $route->getParam('controller');
            switch ($controller_name) {
                default:
                    $controller->layout('documents/layout');
            };
            $controller->getEvent()->getViewModel()->setVariables(array(
                        'current_controller' => $route->getParam('controller'),
                        'current_action'         => $route->getParam('action'),
                    ));
        });
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
            
    public function getServiceConfig()
    {
        return array(
        'factories' => array(
          'Documents\Model\DocumentsTable' =>  function ($sm) {
            $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
            $table = new DocumentsTable($dbAdapter);
            return $table;
          },
        ),
        );
    }
    
    public function getControllerPluginConfig()
    {
        return array(
        'factories' => array(
          'Documents' => function ($sm) {
            $sm = $sm->getServiceLocator();
            return new Plugin\Documents($sm);
          }
        )
        );
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
