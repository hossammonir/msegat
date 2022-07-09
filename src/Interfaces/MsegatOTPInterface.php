<?php

namespace HossamMonir\Msegat\Interfaces;

interface MsegatOTPInterface
{
    public function numbers(array $numbers);

    public function send();
}
