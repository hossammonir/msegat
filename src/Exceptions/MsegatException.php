<?php

namespace HossamMonir\Msegat\Exceptions;

use Exception;
use Illuminate\Http\Response;

class MsegatException extends Exception
{
    public function render(): Response
    {
        $status = 400;
        $error = $this->getMessage();
        $help = 'Contact the support team to with Error message to resolve the issue.';

        return response(['error' => $error, 'help' => $help], $status);
    }
}
