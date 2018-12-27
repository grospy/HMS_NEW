<?php


/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("OnsiteDocumentMap.php");


class OnsiteDocumentDAO extends Phreezable
{
    /** @var int */
    public $Id;

    /** @var int */
    public $Pid;

    /** @var int */
    public $Facility;

    /** @var int */
    public $Provider;

    /** @var int */
    public $Encounter;

    /** @var timestamp */
    public $CreateDate;

    /** @var string */
    public $DocType;

    /** @var int */
    public $PatientSignedStatus;

    /** @var date */
    public $PatientSignedTime;

    /** @var date */
    public $AuthorizeSignedTime;

    /** @var int */
    public $AcceptSignedStatus;

    /** @var string */
    public $AuthorizingSignator;

    /** @var date */
    public $ReviewDate;

    /** @var string */
    public $DenialReason;

    /** @var string */
    public $AuthorizedSignature;

    /** @var string */
    public $PatientSignature;

    /** @var blob */
    public $FullDocument;

    /** @var string */
    public $FileName;

    /** @var string */
    public $FilePath;
}
