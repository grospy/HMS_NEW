<?php




require_once("../../interface/globals.php");
?>
<html>
    <head>
        <link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
    </head>
    <body class="body_top">
        <form>
            <table>
                <tr class="text">
                    <td>
                        <input type="text" name="saveas" id="saveas">
                    </td>
                    <td>
                        <a href="#" class="css_button"><span><?php echo htmlspecialchars (xl('OK'),ENT_QUOTES);?></span></a>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>