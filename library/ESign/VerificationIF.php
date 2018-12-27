<?php

namespace ESign;



interface VerificationIF
{
    public function hash($data);
    public function verify($data, $hash);
}
