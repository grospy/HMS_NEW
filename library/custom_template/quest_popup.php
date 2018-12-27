<?php




require_once("../../interface/globals.php");
$content = $_REQUEST['content'];
?>
<html>
    <head>
        <link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
        <script type="text/javascript" src="<?php echo $webroot ?>/interface/main/tabs/js/include_opener.js?v=<?php echo $v_js_includes; ?>"></script>
        <script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-min-3-1-1/index.js"></script>
        <script type="text/javascript">
    function showWhereInTextarea(){
    opener.restoreSession();
    var textarea = document.getElementById('quest');
    start = textarea.value.indexOf("??");
    len =2;
    if(textarea.setSelectionRange){
        textarea.setSelectionRange(parseInt(start), (parseInt(start)+parseInt(len)));
    }
    else{
        var range = textarea.createTextRange();
        range.collapse(true);

        range.moveStart('character',parseInt(start) );
        range.moveEnd('character',parseInt(len));
        range.select();

    }
    document.getElementById('quest').focus();
    }
    function replace_quest(val){
        opener.restoreSession();
        var textarea = document.getElementById('quest').value;
        textarea=textarea.replace(/\?\?/i,val);
        document.getElementById('quest').value=textarea;
    }
    function save_this(){
            opener.restoreSession();
            var textFrom = document.getElementById('quest').value;
            window.opener.CKEDITOR.instances.textarea1.insertText(textFrom);
            window.close();
    }
        </script>
    </head>
    <body class="body_top" onload="showWhereInTextarea()">
        <table>
            <tr class="text">
                <td>
                    <?php
                    $res = sqlStatement("SELECT * FROM list_options WHERE list_id = 'nation_notes_replace_buttons' AND activity = 1 ORDER BY seq");
                    while ($row = sqlFetchArray($res)) {
                    ?>
                    <a href="#" onclick="replace_quest('<?php echo htmlspecialchars($row['option_id'], ENT_QUOTES);?>')" class="css_button"><span><?php echo htmlspecialchars($row['title'], ENT_QUOTES);?></span></a>
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <tr class="text">
                <td>
                <textarea name="quest" id="quest" rows="5" cols="70"><?php echo htmlspecialchars($content, ENT_QUOTES);?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="button" name="save" value="<?php echo htmlspecialchars(xl('Save'), ENT_QUOTES);?>" onclick="save_this()">
                    <input type="button" name="cancel" value="<?php echo htmlspecialchars(xl('Cancel'), ENT_QUOTES);?>" onclick="javascript:window.close()">
                </td>
            </tr>
        </table>

    </body>
</html>
