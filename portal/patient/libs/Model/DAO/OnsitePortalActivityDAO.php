<?php


/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("OnsitePortalActivityMap.php");


class OnsitePortalActivityDAO extends Phreezable
{
    /** @var int */
    public $Id;

    /** @var date */
    public $Date;

    /** @var int */
    public $PatientId;

    /** @var string */
    public $Activity;

    /** @var int */
    public $RequireAudit;

    /** @var string */
    public $PendingAction;

    /** @var string */
    public $ActionTaken;

    /** @var string */
    public $Status;

    /** @var longtext */
    public $Narrative;

    /** @var longtext */
    public $TableAction;

    /** @var longtext */
    public $TableArgs;

    /** @var int */
    public $ActionUser;

    /** @var date */
    public $ActionTakenTime;

    /** @var longtext */
    public $Checksum;
}
