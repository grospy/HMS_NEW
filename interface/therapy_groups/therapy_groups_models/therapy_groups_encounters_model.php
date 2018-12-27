<?php


class Therapy_Groups_Encounters
{

    const TABLE = 'form_groups_encounter';

    /**
      * Get all encounters of specified group.
      * @param $gid
      * @return ADORecordSet_mysqli
      */
    public function getGroupEncounters($gid)
    {
        $sql = "SELECT * FROM " . self::TABLE . " WHERE group_id = ? AND date >= CURDATE();";
        $result = sqlStatement($sql, array($gid));
        while ($row = sqlFetchArray($result)) {
            $encounters[] = $row;
        }

        return $encounters;
    }
}
