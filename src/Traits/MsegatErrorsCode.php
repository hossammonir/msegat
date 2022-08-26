<?php

namespace HossamMonir\Msegat\Traits;


trait MsegatErrorsCode
{
    /**
     * Msegat Errors Codes.
     *
     * @param $responseCode
     * @return string
     */
    public function validateResponseCode($responseCode)
    {
        return match ($responseCode) {
            'M0000', '1', 1 => 'Success',
            'M0001', '1010', 1010 => 'Variables missing',
            'M0002', '1020', 1020 => 'Invalid login info',
            'M0022' => 'Exceed number of senders allowed',
            'M0023' => 'Sender Name is active or under activation or refused',
            'M0024' => 'Sender Name should be in English or number',
            'M0025' => 'Invalid Sender Name Length',
            'M0026' => 'Sender Name is already activated or not found',
            'M0027' => 'Activation Code is not Correct',
            '1050', 1050 => 'MSG body is empty',
            '1060', 1060 => 'Balance is not enough',
            '1061', 1061 => 'MSG duplicated',
            '1064', 1064 => 'Free OTP , Invalid MSG content you should use "Pin Code is: xxxx" or "Verification Code: xxxx" or "رمز التحقق: 1234" , or upgrade your account and activate your sender to send any content',
            '1110', 1110 => 'Sender name is missing or incorrect',
            '1120', 1120 => 'Mobile numbers is not correct',
            '1140', 1140 => '1140',
            'M0029' => 'Invalid Sender Name - Sender Name should contain only letters, numbers and the maximum length should be 11 characters',
            'M0030' => 'Sender Name should ended with AD',
            'M0031' => 'Maximum allowed size of uploaded file is 5 MB',
            'M0032' => 'Only pdf,png,jpg and jpeg files are allowed!',
            'M0033' => 'Sender Type should be normal or whitelist only',
            'M0034' => 'Please Use POST Method',
            'M0036' => 'There is no any sender',
            default => 'unknown status code',
        };
    }
}

