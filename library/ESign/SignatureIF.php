<?php

namespace ESign;



require_once $GLOBALS['srcdir'].'/ESign/VerifiableIF.php';

interface SignatureIF extends VerifiableIF
{
    const ESIGN_NOLOCK = 0;
    const ESIGN_LOCK = 1;

    public function getId();
    public function getUid();
    public function getFirstName();
    public function getLastName();
    public function getDatetime();
    public function isLock();
    public function getAmendment();
}
