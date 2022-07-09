<?php

namespace HossamMonir\Msegat\Services;

use HossamMonir\Msegat\Contracts\Msegat;
use HossamMonir\Msegat\Interfaces\MsegatCalculateInterface;
use HossamMonir\Msegat\Traits\MsegatAPIRequest;
use Illuminate\Http\JsonResponse;

class MsegatCalculateMessageCost extends Msegat implements MsegatCalculateInterface
{
    use MsegatAPIRequest;

    /**
     * Initialize API Processor Constructor.
     * Accept All Msegat API Parameters.
     */
    public function __construct()
    {
        $config['contactType'] = 'numbers'; // Required for calculate message cost.
        $config['By'] = 'Link'; // Required for calculate message cost.
        $config['msgEncoding'] = 'UTF8'; // Required for calculate message cost.
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
        $this->config['contacts'] = $this->renderNumberForCalculation($numbers);

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
     * Submit Calculate request API.
     *
     * @return JsonResponse
     *
     * @throws \Throwable
     */
    public function calculate(): JsonResponse
    {
        return response()->json([
            'total_numbers' => (int) str()->before($this->CalculateMessageCostRequest(), ','),
            'point_cost' => (float) str()->after($this->CalculateMessageCostRequest(), ','),
            'message_length' => str()->length($this->config['msg']),
        ]);
    }
}
