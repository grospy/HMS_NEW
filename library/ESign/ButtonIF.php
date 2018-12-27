<?php

namespace ESign;



require_once $GLOBALS['srcdir'].'/ESign/ViewableIF.php';
require_once $GLOBALS['srcdir'].'/ESign/SignableIF.php';

interface ButtonIF extends ViewableIF
{
    public function isViewable();
    public function render(SignableIF $signable = null);
    public function getHtml(SignableIF $signable = null);
}
