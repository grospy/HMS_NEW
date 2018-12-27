<?php


class Users
{

    const TABLE = 'users';
    const EVENTS_TABLE = 'openemr_postcalendar_events';

    /**
     * Get all users' ids and full names from users table.
     * @return array
     */
    public function getAllUsers()
    {

        $sql = 'SELECT id, fname, lname FROM ' . self::TABLE . ' WHERE active = 1';

        $users = array();
        $result = sqlStatement($sql);
        while ($u = sqlFetchArray($result)) {
            $users[] = $u;
        }

        return $users;
    }

    /**
     * Get user name by user id from users table.
     * @param $uid
     * @return string
     */
    public function getUserNameById($uid)
    {
        $sql = 'SELECT fname, lname FROM ' . self::TABLE . ' WHERE id = ?';

        $user_name = sqlQuery($sql, array($uid));
        $user_full_name = $user_name['fname'] . "   " . $user_name['lname'];

        return $user_full_name;
    }

    /**
     * Get all providers of event.
     * @param $eid
     * @return array
     */
    public function getProvidersOfEvent($eid)
    {

        $multiple = $this->checkIfMultiple($eid);
        if ($multiple > 0) {
            $sql = "SELECT pc_aid From " . self::EVENTS_TABLE . " WHERE pc_multiple = ?";
            $result = sqlStatement($sql, array($multiple));
            while ($p = sqlFetchArray($result)) {
                $providers[] = $p['pc_aid'];
            }

            return $providers;
        } else {
            $sql = "SELECT pc_aid From " . self::EVENTS_TABLE . " WHERE pc_eid = ?";
            $result = sqlStatement($sql, array($eid));
            while ($p = sqlFetchArray($result)) {
                $providers[] = $p['pc_aid'];
            }

            return $providers;
        }
    }


    /**
     * Checks if event has multiple providers and if so returns the key of 'multiple providers'.
     * @param $eid
     * @return bool|ADORecordSet_mysqli
     */
    private function checkIfMultiple($eid)
    {

        $sql = "SELECT pc_multiple FROM " . self::EVENTS_TABLE . " WHERE pc_eid = ?";
        $result = sqlQuery($sql, array($eid));
        if ($result['pc_multiple'] == 0) {
            return false;
        }

        return $result['pc_multiple'];
    }
}
