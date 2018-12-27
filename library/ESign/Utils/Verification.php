<?php
namespace ESign;



require_once $GLOBALS['srcdir'].'/ESign/VerificationIF.php';

class Utils_Verification implements VerificationIF
{
    public function hash($data)
    {
        $string = "";
        if (is_array($data)) {
            $string = $this->stringifyArray($data);
        } else {
            $string = $data;
        }

        $hash = sha1($string);
        return $hash;
    }

    protected function stringifyArray(array $arr)
    {
        $string = "";
        foreach ($arr as $part) {
            if (is_array($part)) {
                $string .= $this->stringifyArray($part);
            } else {
                $string .= $part;
            }
        }

        return $string;
    }
    
    public function verify($data, $hash)
    {
        $currentHash = $this->hash($data);
        if ($currentHash == $hash) {
            return true;
        }
        
        return false;
    }
}
