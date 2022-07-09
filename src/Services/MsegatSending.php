<?php

namespace HossamMonir\Msegat\Services;

use HossamMonir\Msegat\Contracts\Msegat;
use HossamMonir\Msegat\Interfaces\MsegatSendingInterface;
use HossamMonir\Msegat\Traits\MsegatAPIRequest;
use Illuminate\Http\JsonResponse;

class MsegatSending extends Msegat implements MsegatSendingInterface
{
    use MsegatAPIRequest;

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
     * Text message to be sent.
     *
     * @param  string  $message
     * @return $this
     */
    public function message(string $message): static
    {
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
        return response()->json(['response' => $this->SendSMSRequest()]);
    }
}
