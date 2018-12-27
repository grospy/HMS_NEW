<?php


function stripslashes_deep($value)
{
    $value = is_array($value) ? array_map('stripslashes_deep', $value) : strip_escape_custom($value);
    return $value;
}

//Parses the search value part of the criteria and prepares for sql.
function PrepareSearchItem($SearchItem)
{
    $SplitArray=explode(' like ', $SearchItem);
    if (isset($SplitArray[1])) {
        $SplitArray[1] = substr($SplitArray[1], 0, -1);
        $SplitArray[1] = substr($SplitArray[1], 1);
        $SearchItem=$SplitArray[0].' like '."'".add_escape_custom($SplitArray[1])."'";
    } else {
        $SplitArray=explode(' = ', $SearchItem);
        if (isset($SplitArray[1])) {
            $SplitArray[1] = substr($SplitArray[1], 0, -1);
            $SplitArray[1] = substr($SplitArray[1], 1);
            $SearchItem=$SplitArray[0].' = '."'".add_escape_custom($SplitArray[1])."'";
        }
    }

    return($SearchItem);
}

//Parses the database value and prepares for display.
function BuildArrayForReport($Query)
{
    $array_data=array();
    $res = sqlStatement($Query);
    while ($row=sqlFetchArray($res)) {
        $array_data[$row['id']]=htmlspecialchars($row['name'], ENT_QUOTES);
    }

    return $array_data;
}

//The criteria  "Insurance Company" is coded here.The ajax one
function InsuranceCompanyDisplay()
{
    global $ThisPageSearchCriteriaDisplay,$ThisPageSearchCriteriaKey,$ThisPageSearchCriteriaIndex,$web_root;

    echo '<table width="140" border="0" cellspacing="0" cellpadding="0">'.
      '<tr>'.
        '<td width="140" colspan="2">'.
            '<iframe id="frame_to_hide" style="position:absolute;display:none; width:240px; height:100px" frameborder=0'.
                'scrolling=no marginwidth=0 src="" marginheight=0>hello</iframe>'.
        '<input type="hidden" id="hidden_ajax_close_value" value="'.attr($_POST['type_code']).'" /><input name="type_code"  id="type_code" class="text "'.
        'style=" width:140px;"  title="'.xla("Type Id or Name.3 characters minimum (including spaces).").'"'.
        'onfocus="hide_frame_to_hide();appendOptionTextCriteria(\''.$ThisPageSearchCriteriaDisplay[$ThisPageSearchCriteriaIndex].'\','.
                                    '\''.$ThisPageSearchCriteriaKey[$ThisPageSearchCriteriaIndex].'\','.
                                    'document.getElementById(\'type_code\').value,document.getElementById(\'div_insurance_or_patient\').innerHTML,'.
                                    '\' = \','.
                                    '\'text\')" onblur="show_frame_to_hide()" onKeyDown="PreventIt(event)" value="'.attr($_POST['type_code']).'"  autocomplete="off"   /><br>'.
        '<!--onKeyUp="ajaxFunction(event,\'non\',\'search_payments.php\');"-->'.
            '<div id="ajax_div_insurance_section">'.
            '<div id="ajax_div_insurance_error">            </div>'.
            '<div id="ajax_div_insurance" style="display:none;"></div>'.
            '</div>'.
            '</div>        </td>'.
      '</tr>'.
      '<tr height="5"><td colspan="2"></td></tr>'.
      '<tr>'.
        '<td><div  name="div_insurance_or_patient" id="div_insurance_or_patient" class="text"  style="border:1px solid black; padding-left:5px; width:50px; height:17px;">'.attr($_POST['hidden_type_code']).'</div><input type="hidden" name="description"  id="description" /></td>'.
        '<td><a href="#" onClick="CleanUpAjax(\''.$ThisPageSearchCriteriaDisplay[$ThisPageSearchCriteriaIndex].'\','.
                                    '\''.$ThisPageSearchCriteriaKey[$ThisPageSearchCriteriaIndex].'\',\' = \')"><img src="'.$web_root.'/interface/pic/Clear.gif" border="0" /></a></td>'.
      '</tr>'.
    '</table>'.
    '<input type="hidden" name="hidden_type_code" id="hidden_type_code" value="'.attr($_POST['hidden_type_code']).'"/>';
}
