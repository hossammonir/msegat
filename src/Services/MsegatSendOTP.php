<?php

namespace HossamMonir\Msegat\Services;

use HossamMonir\Msegat\Contracts\Msegat;
use HossamMonir\Msegat\Interfaces\MsegatOTPInterface;
use HossamMonir\Msegat\Traits\MsegatAPIRequest;
use Illuminate\Http\JsonResponse;

class MsegatSendOTP extends Msegat implements MsegatOTPInterface
{
    use MsegatAPIRequest;

    private string $pin;

    /**
     * Initialize API Processor Constructor.
     * Accept All Msegat API Parameters.
     */
    public function __construct(array $config)
    {
        // Call parent constructor to initialize common settings
        parent::__construct($config);
    }

    /**
     * Bulk of numbers to send SMS.
     *
     * @param  array  $numbers
     * @return $this
     */
    public function numbers(array $numbers): static
    {
        $this->config['numbers'] = $this->renderNumbers($numbers);

        return $this;
    }

    /**
     * OTP Message Generator.
     *
     * @return $this
     */
    protected function generateOTPMessage(): static
    {
        $this->pin = rand(1000, 9999);

        $message = str('Pin Code is: ')->append($this->pin);

        $this->config['msg'] = $message;

        return $this;
    }

    /**
     * Submit SMS to MSEGAT API.
     *
     * @return JsonResponse
     *
     * @throws \Throwable
     */
    public function send(): JsonResponse
    {
        $this->generateOTPMessage(); // Generate Message

        return response()->json(['response' => $this->SendSMSRequest(), 'pin' => $this->pin]);
    }
}
