<?php


// Build the $ISSUE_TYPE_CATEGORIES array
// First, set the hard-coded options
$ISSUE_TYPE_CATEGORIES = array(
  'default' => xl('Default'),             // Normal OpenEMR use
  'ippf_specific' => xl('IPPF')           // For IPPF use
);
// Second, collect the non hard-coded options and add to the array
$res = sqlStatement("SELECT DISTINCT `category` FROM `issue_types`");
while ($row = sqlFetchArray($res)) {
    if (($row['category'] == "default") || ($row['category'] == "ippf_specific")) {
        continue;
    }

    $ISSUE_TYPE_CATEGORIES[$row['category']] = $row['category'];
}

$ISSUE_TYPE_STYLES = array(
  0 => xl('Standard'),                    // Standard
  1 => xl('Simplified'),                  // Simplified: only title, start date, comments and an Active checkbox;no diagnosis, occurrence, end date, referred-by or sports fields.
  2 => xl('Football Injury'),             // Football Injury
  3 => xl('IPPF Abortion'),               // IPPF specific (abortions issues)
  4 => xl('IPPF Contraception')           // IPPF specific (contraceptions issues)
);

/**
 * Will return the current issue type category that is being used.
 * @return  string  The current issue type category that is being used.
 */
function collect_issue_type_category()
{
    if (!empty($GLOBALS['ippf_specific'])) { // IPPF version
        return "ippf_specific";
    } else { // Default version
        return "default";
    }
}

// Build the $ISSUE_TYPES array (see script header for description)
$res = sqlStatement(
    "SELECT * FROM `issue_types` WHERE active = 1 AND `category`=? ORDER BY `ordering`",
    array(collect_issue_type_category())
);
while ($row = sqlFetchArray($res)) {
    $ISSUE_TYPES[$row['type']] = array(
    xl($row['plural']),
    xl($row['singular']),
    xl($row['abbreviation']),
    $row['style'],
    $row['force_show'],
    $row['aco_spec']);
}

$ISSUE_CLASSIFICATIONS = array(
  0   => xl('Unknown or N/A'),
  1   => xl('Trauma'),
  2   => xl('Overuse')
);

function getListById($id, $cols = "*")
{
    return sqlQuery("select $cols from lists where id='$id' order by date DESC limit 0,1");
}

function getListByType($pid, $type, $cols = "*", $active = "all", $limit = "all", $offset = "0")
{
    if ($active == "all") {
        $sql = "select $cols from lists where pid='$pid' and type='$type' order by date DESC";
    } else {
        $sql = "select $cols from lists where pid='$pid' and type='$type' and activity='$active' order by date DESC";
    }

    if ($limit != "all") {
        $sql .= " limit $offset,$limit";
    }
    
    $res = sqlStatement($sql);
    for ($iter =0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }

    return $all;
}

function addList($pid, $type, $title, $comments, $activity = "1")
{
    return sqlInsert("insert into lists (date, pid, type, title, activity, comments, user, groupname) values (NOW(), '$pid', '$type', '$title', '$activity', '$comments', '".$_SESSION['authUser']."', '".$_SESSION['authProvider']."')");
}

function disappearList($id)
{
    sqlStatement("update lists set activity = '0' where id='$id'");
    return true;
}

function reappearList($id)
{
    sqlStatement("update lists set activity = '1' where id='$id'");
    return true;
}

function getListTouch($patient_id, $type)
{
    $ret = sqlQuery("SELECT `date` FROM `lists_touch` WHERE pid=? AND type=?", array($patient_id,$type));

    if (!empty($ret)) {
        return $ret['date'];
    } else {
        return false;
    }
}

function setListTouch($patient_id, $type)
{
    $ret = sqlQuery("SELECT `date` FROM `lists_touch` WHERE pid=? AND type=?", array($patient_id,$type));

    if (!empty($ret)) {
                // Already touched, so can exit
        return;
    } else {
        sqlStatement("INSERT INTO `lists_touch` ( `pid`,`type`,`date` ) VALUES ( ?, ?, NOW() )", array($patient_id,$type));
    }
}
