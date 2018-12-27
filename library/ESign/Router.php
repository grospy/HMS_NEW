<?php

namespace ESign;



require_once $GLOBALS['srcdir'].'/ESign/Abstract/Controller.php';

class Router
{
    public function route()
    {
        $request = new Request();
        $moduleParam = $request->getParam('module');
        $Module = ucfirst($moduleParam);
        require_once $GLOBALS['srcdir'].'/ESign/'.$Module.'/Controller.php';
        $controllerClass = "\\ESign\\".$Module."_Controller";
        $controller = new $controllerClass( $request );
        if ($controller instanceof Abstract_Controller) {
            $controller->run();
        }
    }
}
