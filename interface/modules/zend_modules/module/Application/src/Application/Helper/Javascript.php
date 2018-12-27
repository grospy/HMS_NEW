<?php


namespace Application\Helper;

use Zend\View\Helper\AbstractHelper;
 
class Javascript extends AbstractHelper
{
    public function __invoke()
    {
        switch (true) {
            case (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] === true)):
            case (isset($_SERVER['HTTP_SCHEME']) && ($_SERVER['HTTP_SCHEME'] == 'https')):
            case (443 === $_SERVER['SERVER_PORT']):
                $scheme = 'https://';
                break;
            default:
                $scheme = 'http://';
                break;
        }

        $basePath = str_replace("/index.php", "", $_SERVER['PHP_SELF']);
        echo '<script type="text/javascript">';
        echo 'var basePath    = "'.$scheme.$_SERVER['SERVER_NAME'].$basePath.'";';
        echo 'var dateFormat = "yy-mm-dd"';
        echo '</script>';
    }
}
