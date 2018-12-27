<?php




require_once("../../interface/globals.php");
$res=sqlStatement("SELECT * FROM customlists as cl left outer join users as u on cl_creator=u.id WHERE cl_list_type=3 AND cl_deleted=0");
?>
<html>
    <head>
        <title><!-- Insert your title here --></title>
        <link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
        <script type="text/javascript" src="<?php echo $webroot ?>/interface/main/tabs/js/include_opener.js?v=<?php echo $v_js_includes; ?>"></script>
        <script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/dialog.js?v=<?php echo $v_js_includes; ?>"></script>
        <script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-min-3-1-1/index.js"></script>
        <script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/js/ajax_functions_writer.js"></script>

        <script type='text/javascript'>
        function delete_full_category(id){
                top.restoreSession();
                $.ajax({
                type: "POST",
                url: "ajax_code.php",
                dataType: "html",
                data: {
                     templateid: id,
                     source: "delete_full_category"
                },
                success: function(thedata){
                            alert("<?php echo addslashes(xl('Deleted Successfully.'));?>");
                            document.location.reload();
                            },
                error:function(){
                }
               });
               return;
        }
        function delete_category(id){
            top.restoreSession();
            if(confirm("<?php echo addslashes(xl('Do you want to delete?'));?>")){
                $.ajax({
                type: "POST",
                url: "ajax_code.php",
                dataType: "html",
                data: {
                     templateid: id,
                     source: "delete_category"
                },
                success: function(thedata){
                            if(thedata){
                                alert("<?php echo addslashes('There are currently other users of the category you are trying to delete. Please contact them and ask them to delete it. Categories may not be deleted while in use. This Categories are currently used by \n');?>"+thedata);
                            }
                            else{
                                delete_full_category(id);
                            }
                            },
                error:function(){
                }
               });

               return;
            }
        }
        </script>
    </head>
    <body class="body_top">
    <form name="myform">
        <table align="center">
            <tr class="text reportTableHeadRow">
                <th><?php echo htmlspecialchars('Sl.No', ENT_QUOTES);?></th>
                <th><?php echo htmlspecialchars(xl('Category'), ENT_QUOTES);?></th>
                <th><?php echo htmlspecialchars(xl('Context'), ENT_QUOTES);?></th>
                <th><?php echo htmlspecialchars(xl('Creator'), ENT_QUOTES);?></th>
                <th><?php echo htmlspecialchars(xl('Delete'), ENT_QUOTES);?></th>
            </tr>
    <?php
    $i=0;
    while ($row=sqlFetchArray($res)) {
        $context=sqlQuery("SELECT * FROM customlists WHERE cl_list_slno=?", array($row['cl_list_id']));
        $i++;
        $class = ($class=='reportTableOddRow') ? 'reportTableEvenRow' : 'reportTableOddRow';
        echo "<tr class='text ".htmlspecialchars($class, ENT_QUOTES)."'>";
        echo "<td>".$i."</td>";
        echo "<td>".htmlspecialchars($row['cl_list_item_long'], ENT_QUOTES)."</td>";
        echo "<td>".htmlspecialchars($context['cl_list_item_long'], ENT_QUOTES)."</td>";
        echo "<td>".htmlspecialchars($row['fname']." ".$row['mname']." ".$row['lname'], ENT_QUOTES)."</td>";
        echo "<td><a href=#>";
        echo "<img src='../../interface/pic/Delete.gif' border=0 title='Delete This Row' onclick=delete_category('".htmlspecialchars($row['cl_list_slno'], ENT_QUOTES)."')>";
        echo "</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
