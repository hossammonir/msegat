<?php

namespace HossamMonir\Msegat\Traits;

use HossamMonir\Msegat\Exceptions\MsegatException;
use Illuminate\Support\Arr;

trait MsegatValidateParams
{
    /**
     * @throws \Throwable
     */
    public function validateMsegatParams(array $config, array $params)
    {
        return throw_unless(Arr::has($config, $params), new MsegatException('One of ('.implode(' or ', $params).' ) is missing.'));
    }
}
