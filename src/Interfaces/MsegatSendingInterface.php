<?php

namespace HossamMonir\Msegat\Interfaces;

interface MsegatSendingInterface
{
    public function numbers(array $numbers);

    public function message(string $message);

    public function send();
}
