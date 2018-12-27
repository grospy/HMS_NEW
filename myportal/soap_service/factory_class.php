<?php

class factoryclass
{
    public static function dynamic_class_factory($page)
    {
        include_once('server_'.$page.'.php');
    
        return new $page;
    }
}
