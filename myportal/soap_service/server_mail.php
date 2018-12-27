<?php

class UserMail
{


    public function getMails($data)
    {
        global $pid;
        if (UserService::valid($data[0])=='existingpatient') {
            require_once("../../library/pnotes.inc");
            if ($data[2] == "inbox") {
                if ($data[3] && $data[4]) {
                    $result_notes = getPatientNotes($pid, '', '0', $data[3]);
                    $result_notifications = getPatientNotifications($pid, '', '0', $data[4]);
                    $result = array_merge((array)$result_notes, (array)$result_notifications);
                } else {
                    $result_notes = getPatientNotes($pid);
                    $result_notifications = getPatientNotifications($pid);
                    $result = array_merge((array)$result_notes, (array)$result_notifications);
                }

                return $result;
            } elseif ($data[2] == "sent") {
                if ($data[3]) {
                    $result_sent_notes = getPatientSentNotes($pid, '', '0', $data[3]);
                } else {
                    $result_sent_notes = getPatientSentNotes($pid);
                }

                return $result_sent_notes;
            }
        } else {
            throw new SoapFault("Server", "credentials failed");
        }
    }

  



    public function getMailDetails($data)
    {
        if (UserService::valid($data[0])=='existingpatient') {
            require_once("../../library/pnotes.inc");
            $result = getPnoteById($data[1]);
            if ($result['assigned_to'] == '-patient-' && $result['message_status'] == 'New') {
                updatePnoteMessageStatus($data[1], 'Read');
            }

            return $result;
        } else {
            throw new SoapFault("Server", "credentials failed");
        }
    }

  



    public function sendMail($data)
    {
        global $pid;
        if (UserService::valid($data[0])=='existingpatient') {
            require_once("../../library/pnotes.inc");
            $to_list = explode(';', $data[2]);
            foreach ($to_list as $to) {
                addMailboxPnote($pid, $data[4], '1', '1', $data[3], $to);
            }

            return 1;
        } else {
            throw new SoapFault("Server", "credentials failed");
        }
    }

  



    public function updateStatus($data)
    {
        if (UserService::valid($data[0])=='existingpatient') {
            require_once("../../library/pnotes.inc");
            foreach ($data[1] as $id) {
                updatePnoteMessageStatus($id, $data[2]);
            }
        } else {
            throw new SoapFault("Server", "credentials failed");
        }
    }
}
