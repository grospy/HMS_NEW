<?php


class CdrResults
{
        var $id;
        var $rule;
        var $passive_flag;
        var $active_flag;
        var $reminder_flag;
        var $access_control;
        
    function __construct($rule_id = "", $active_alert_flag = "", $passive_alert_flag = "", $patient_reminder_flag = "", $access_control = "")
    {
        $this->id = $rule_id;
                $this->rule = getLabel($this->id, 'clinical_rules');
        $this->active_flag = $active_alert_flag;
        $this->passive_flag = $passive_alert_flag;
        $this->reminder_flag = $patient_reminder_flag;
                    $this->access_control = $access_control;
    }
      
    function active_alert_flag()
    {
            return $this->active_flag;
    }

    function passive_alert_flag()
    {
            return $this->passive_flag;
    }

    function get_rule()
    {
            return $this->rule;
    }

    function get_id()
    {
            return $this->id;
    }
      
    function patient_reminder_flag()
    {
            return $this->reminder_flag;
    }

    function access_control()
    {
            return $this->access_control;
    }
      
    function update_table()
    {

                    // Set the settings that only apply to the main rule (pid = 0)
            $query = "UPDATE clinical_rules SET active_alert_flag = ?" .
                              ", passive_alert_flag = ?" .
                              ", patient_reminder_flag = ?" .
                          " WHERE id = ? AND pid = 0";
    
           sqlStatement($query, array($this->active_flag,$this->passive_flag,$this->reminder_flag,$this->id));
                        
                    // Set the settings that apply to all rules including the patient custom rules (pid is > 0)
                    $query = "UPDATE clinical_rules SET access_control = ?" .
                                                      " WHERE id = ?";

                       sqlStatement($query, array($this->access_control,$this->id));
    }
}
