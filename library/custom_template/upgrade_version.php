<?php




include_once('../../interface/globals.php');
$sql="select distinct tu_user_id from template_users";
$rs=SqlStatement($sql);
while ($row=SqlFetchArray($rs)) {
    $sql="select * from template_users join customlists on cl_list_slno=tu_template_id where
 cl_deleted=0 and tu_user_id=?";
    $rs2=SqlStatement($sql, array($row['tu_user_id']));
    while ($row2=SqlFetchArray($rs2)) {
        $sql="select cl_list_slno from customlists where cl_deleted=0 and cl_list_id=?";
        $rs3=SqlStatement($sql, array($row2['cl_list_slno']));
        while ($row3=SqlFetchArray($rs3)) {
            SqlStatement("insert into template_users (tu_template_id,tu_user_id) values(?,?)", array($row3['cl_list_slno'],$row['tu_user_id']));
        }
    }
}
