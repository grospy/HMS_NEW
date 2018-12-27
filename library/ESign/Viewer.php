<?php
namespace ESign;


require_once $GLOBALS['srcdir'].'/ESign/Abstract/Model.php';
require_once $GLOBALS['srcdir'].'/ESign/ViewableIF.php';

class Viewer extends Abstract_Model
{
    public function __construct(array $args = null)
    {
        parent::__construct($args);
        
        // Force the args key => value pairs to be set as properties on the viewer objet
        $this->pushArgs(true);
    }
    
    protected function setAttributes(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }
    }
    
    public function render(ViewableIF $viewable, array $attributes = null)
    {
        if ($attributes) {
            $this->setAttributes($attributes);
        }

        include $viewable->getViewScript();
    }
    
    public function getHtml(ViewableIF $viewable, array $attributes = null)
    {
        ob_start();
        $this->render($viewable, $attributes);
        $buffer = ob_get_clean();
        return $buffer;
    }
}
