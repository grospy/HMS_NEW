<?php

namespace ESign;



require_once $GLOBALS['srcdir'].'/ESign/ViewableIF.php';
require_once $GLOBALS['srcdir'].'/ESign/SignableIF.php';

interface LogIF extends ViewableIF
{
    public function isViewable();
    public function render(SignableIF $signable);
    public function getHtml(SignableIF $signable);
}
