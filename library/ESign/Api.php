<?php

namespace ESign;



require_once $GLOBALS['srcdir'].'/ESign/ESign.php';
require_once $GLOBALS['srcdir'].'/ESign/FactoryIF.php';
require_once $GLOBALS['srcdir'].'/ESign/ConfigurationIF.php';
require_once $GLOBALS['srcdir'].'/ESign/SignableIF.php';
require_once $GLOBALS['srcdir'].'/ESign/Form/Factory.php';
require_once $GLOBALS['srcdir'].'/ESign/Form/Configuration.php';
require_once $GLOBALS['srcdir'].'/ESign/Encounter/Factory.php';
require_once $GLOBALS['srcdir'].'/ESign/Encounter/Configuration.php';

class Api
{
    public function lockEncounters()
    {
        return $GLOBALS['lock_esign_all'];
    }
    
    public function formConfigToJson()
    {
        $configuration = new Form_Configuration();
        return $this->configToJson($configuration);
    }
    
    public function createFormESign($formId, $formDir, $encounterId)
    {
        $factory = new Form_Factory($formId, $formDir, $encounterId);
        $esign = $this->createESign($factory);
        return $esign;
    }
    
    public function encounterConfigToJson()
    {
        $configuration = new Encounter_Configuration();
        return $this->configToJson($configuration);
    }
    
    public function createEncounterESign($encounterId)
    {
        $factory = new Encounter_Factory($encounterId);
        $esign = $this->createESign($factory);
        return $esign;
    }
    
    public function createEncounterSignable($encounterId)
    {
        $signable = new Encounter_Signable($encounterId);
        return $signable;
    }
    
    public function createESign(FactoryIF $factory)
    {
        $configuration = $factory->createConfiguration();
        $signable = $factory->createSignable();
        $button = $factory->createButton();
        $log = $factory->createLog();
        $esign = new ESign($configuration, $signable, $button, $log);
        return $esign;
    }
    
    /**
     * This contains the configuration for the esign javascript object
     *
     * @return string
     */
    public function configToJson(ConfigurationIF $configuration)
    {
        $params = array(
            'baseUrl' => $configuration->getBaseUrl(),
            'logViewAction' => $configuration->getLogViewAction(),
            'formViewAction' => $configuration->getFormViewAction(),
            'formSubmitAction' => $configuration->getFormSubmitAction(),
            'module' => $configuration->getModule()
        );
    
        $json = json_encode($params);
        return $json;
    }

    public function sign(SignableIF $signable, $userId, $lock = false, $amendment = null)
    {
        try {
            $ret = $signable->sign($userId, $lock, $amendment);
            return $ret;
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    
    public function lock(SignableIF $signable, $userId, $amendment = null)
    {
        return $this->sign($signable, $userId, true, $amendment);
    }
}
