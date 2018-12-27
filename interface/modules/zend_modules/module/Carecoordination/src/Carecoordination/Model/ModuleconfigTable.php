<?php

namespace Carecoordination\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class ModuleconfigTable extends AbstractTableGateway
{
    public function getUsers()
    {
        $users = array('0' => '');
        $res = $this->applicationTable->zQuery(("SELECT id, fname, lname, street, city, state, zip  FROM users WHERE abook_type='ccda'"));
        foreach ($res as $row) {
            $users[$row['id']] = $row['fname']." ".$row['lname'];
        }

        return $users;
    }
}
