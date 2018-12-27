<?php


/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("OnsiteActivityViewMap.php");


class OnsiteActivityViewDAO extends Phreezable
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

    /** @var string */
    public $Title;

    /** @var string */
    public $Fname;

    /** @var string */
    public $Lname;

    /** @var string */
    public $Mname;

    /** @var date */
    public $Dob;

    /** @var string */
    public $Ss;

    /** @var string */
    public $Street;

    /** @var string */
    public $PostalCode;

    /** @var string */
    public $City;

    /** @var string */
    public $State;

    /** @var string */
    public $Referrerid;

    /** @var int */
    public $Providerid;

    /** @var int */
    public $RefProviderid;

    /** @var string */
    public $Pubpid;

    /** @var int */
    public $CareTeam;

    /** @var string */
    public $Username;

    /** @var int */
    public $Authorized;

    /** @var string */
    public $Ufname;

    /** @var string */
    public $Umname;

    /** @var string */
    public $Ulname;

    /** @var string */
    public $Facility;

    /** @var int */
    public $Active;

    /** @var string */
    public $Utitle;

    /** @var string */
    public $PhysicianType;
}
