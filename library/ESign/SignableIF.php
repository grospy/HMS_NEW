<?php

namespace ESign;



require_once $GLOBALS['srcdir'].'/ESign/VerifiableIF.php';

interface SignableIF extends VerifiableIF
{
    public function getSignatures();
    public function isLocked();
    public function sign($userId, $amendment = null);
}
