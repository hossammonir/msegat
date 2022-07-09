<?php

namespace HossamMonir\Msegat\Interfaces;

interface MsegatCalculateInterface
{
    public function numbers(array $numbers);

    public function message(string $message);

    public function calculate();
}
