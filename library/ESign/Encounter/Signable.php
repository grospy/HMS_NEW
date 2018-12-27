<?php

namespace ESign;



require_once $GLOBALS['srcdir'].'/ESign/DbRow/Signable.php';
require_once $GLOBALS['srcdir'].'/ESign/SignableIF.php';
require_once $GLOBALS['srcdir'].'/ESign/Form/Factory.php';

class Encounter_Signable extends DbRow_Signable implements SignableIF
{
    private $_encounterId = null;
    
    public function __construct($encounterId)
    {
        $this->_encounterId = $encounterId;
        parent::__construct($encounterId, 'form_encounter');
    }
    
    /**
     * Implementatinon of getData() for encounters.
     *
     * We get all forms under the encounter, and then get all the data
     * from the individual form tables.
     *
     * @see \ESign\SignableIF::getData()
     */
    public function getData()
    {
        $encStatement = "SELECT F.id, F.date, F.encounter, F.form_name, F.form_id, F.pid, F.user, F.formdir FROM forms F ";
        $encStatement .= "WHERE F.encounter = ? ";
        $data = array();
        $res = sqlStatement($encStatement, array( $this->_encounterId ));
        while ($encRow = sqlFetchArray($res)) {
            $formFactory = new Form_Factory($encRow['id'], $encRow['formdir'], $this->_encounterId);
            $signable = $formFactory->createSignable();
            $data[]= $signable->getData();
        }

        return $data;
    }
    
    public function isLocked()
    {
        $locked = false;
        if ($GLOBALS['lock_esign_all']) {
            $locked = parent::isLocked();
        }
        
        return $locked;
    }
}
