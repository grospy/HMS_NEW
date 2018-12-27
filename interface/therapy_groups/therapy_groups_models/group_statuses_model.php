<?php


class Group_Statuses
{

    const TABLE = 'list_options';

    /**
     * Gets group appointment statuses
     * @return ADORecordSet_mysqli
     */
    public function getGroupStatuses()
    {
        $sql = 'SELECT  option_id, title FROM ' . self::TABLE . ' WHERE list_id = ?;';
        $result = sqlStatement($sql, array('groupstat'));
        $final_result =array();
        while ($row = sqlFetchArray($result)) {
            $final_result[] = $row;
        }

        return $final_result;
    }

    /**
     * Gets group meeting attendance statuses
     * @return ADORecordSet_mysqli
     */
    public function getGroupAttendanceStatuses()
    {
        $sql = 'SELECT  option_id, title FROM ' . self::TABLE . ' WHERE list_id = ?;';
        $result = sqlStatement($sql, array('attendstat'));
        $final_result =array();
        while ($row = sqlFetchArray($result)) {
            $row['title']=xla(trim($row['title']));
            $final_result[] = $row;
        }

        return $final_result;
    }
}
