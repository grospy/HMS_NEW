<?php


namespace Application\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Exception;
 
class Getvariables extends \Zend\View\Helper\AbstractHelper implements ServiceLocatorAwareInterface
{

  /**
   * @var ServiceLocatorInterface
   */
    protected $serviceLocator;
   
  /**
   * Get variables from actions view model object
   * @param String $controllerName Controller
   * @param String $actionName Action
   * @param Array $params Parameters to action
   * @return Array
   * @author  Basil PT <basil@zhservices.com>
   **/
  
    public function __invoke($controllerName, $actionName, $params = array())
    {
        $controllerLoader = $this->serviceLocator->getServiceLocator()->get('ControllerLoader');
        $controllerLoader->setInvokableClass($controllerName, $controllerName);
        $controller = $controllerLoader->get($controllerName);
        $viewModel = $controller->$actionName($params);
        return $viewModel->getVariables();
    }

  /**
   * Set the service locator.
   *
   * @param ServiceLocatorInterface $serviceLocator
   * @return AbstractHelper
   *
   */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

  /**
   * Get the service locator.
   *
   * @return \Zend\ServiceManager\ServiceLocatorInterface
   *
   */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}
