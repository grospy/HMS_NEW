<?php


function generateDateQualifierSelect($name, $options, $obj)
{
    echo     "<select name='".attr($name)."'>";
    for ($idx=0; $idx<count($options); $idx++) {
        echo "<option value='".attr($options[$idx][1])."'";
        if ($obj[$name]==$options[$idx][1]) {
            echo " selected";
        }

        echo ">".text($options[$idx][0])."</option>";
    }

    echo     "</select>";
}

function genProviderSelect($selname, $toptext, $default = 0, $disabled = false)
{
    $query = "SELECT id, lname, fname FROM users WHERE " .
    "( authorized = 1 OR info LIKE '%provider%' ) AND username != '' " .
    "AND active = 1 AND ( info IS NULL OR info NOT LIKE '%Inactive%' ) " .
    "ORDER BY lname, fname";
    $res = sqlStatement($query);
    echo "<select name='" . attr($selname) . "'";
    if ($disabled) {
        echo " disabled";
    }

    echo ">";
    echo "<option value=''>" . text($toptext);
    while ($row = sqlFetchArray($res)) {
        $provid = $row['id'];
        echo "<option value='" . attr($provid) . "'";
        if ($provid == $default) {
            echo " selected";
        }

        echo ">" . text($row['lname'] . ", " . $row['fname']);
    }

    echo "</select>\n";
}

$box_14_qualifier_options=array(array(xl("Onset of Current Symptoms or Illness"),"431"),
                                            array(xl("Last Menstrual Period"),"484"));

$box_15_qualifier_options=array(array(xl("Initial Treatment"),"454"),
                                           array(xl("Latest Visit or Consultation"),"304"),
                                           array(xl("Acute Manifestation of a Chronic Condition"),"453"),
                                           array(xl("Accident"),"439"),
                                           array(xl("Last X-ray"),"455"),
                                           array(xl("Prescription"),"471"),
                                           array(xl("Report Start (Assumed Care Date)"),"090"),
                                           array(xl("Report End (Relinquished Care Date)"),"091"),
                                           array(xl("First Visit or Consultation"),"444")
                                            );
$hcfa_date_quals=array("box_14_date_qual"=>$box_14_qualifier_options,"box_15_date_qual"=>$box_15_qualifier_options);

function qual_id_to_description($qual_type, $value)
{
    $options=$GLOBALS['hcfa_date_quals'][$qual_type];
    for ($idx=0; $idx<count($options); $idx++) {
        if ($options[$idx][1]==$value) {
            return $options[$idx][0];
        }
    }

    return null;
}
