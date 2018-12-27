<?php


require_once(dirname(__FILE__) . '/../../amc.php');

function smarty_function_amcCollect($params, &$smarty)
{
    $amc_id = $params['amc_id'];
        $patient_id = $params['patient_id'];
        $object_category = $params['object_category'];
        $object_id = $params['object_id'];

    $returnArray = amcCollect($amc_id, $patient_id, $object_category, $object_id);
        $smarty->assign('amcCollectReturn', $returnArray);
}

/* vim: set expandtab: */
