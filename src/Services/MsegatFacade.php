<?php

namespace HossamMonir\Msegat\Services;

use Illuminate\Http\JsonResponse;

class MsegatFacade
{
    private string $message;

    private array $numbers;

    /**
     * @param  array  $numbers
     * @return $this
     */
    public function numbers(array $numbers): self
    {
        $this->numbers = $numbers;

        return $this;
    }

    /**
     * @param  string  $message
     * @return $this
     */
    public function message(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Send SMS WithDefault Sender.
     *
     * @return JsonResponse
     *
     * @throws \Throwable
     */
    public function sendWithDefaultSender(): JsonResponse
    {
        return (new MsegatSending(['userSender' => config('services.msegat.sender')]))
            ->numbers($this->numbers)
            ->message($this->message)
            ->send();
    }

    /**
     * Send With Custom Sender.
     *
     * @param  string  $senderName
     * @return JsonResponse
     *
     * @throws \Throwable
     */
    public function sendWithSender(string $senderName): JsonResponse
    {
        return (new MsegatSending(['userSender' => $senderName]))
            ->numbers($this->numbers)
            ->message($this->message)
            ->send();
    }

    /**
     * Send OTP with Default Sender or OTP Sender.
     *
     * @param  string|null  $senderName
     * @return JsonResponse
     *
     * @throws \Throwable
     */
    public function sendOTP(string $senderName = null): JsonResponse
    {
        $sender = match ($senderName) {
            'OTP' => 'OTP',
            default => config('msegat.config.sender'),
        };

        return (new MsegatSendOTP(['userSender' => $sender]))
            ->numbers($this->numbers)
            ->send();
    }

    /**
     * Calculate Message Cost.
     *
     * @throws \Throwable
     */
    public function calculateCost(): JsonResponse
    {
        return (new MsegatCalculateMessageCost)
            ->message($this->message)
            ->numbers($this->numbers)
            ->calculate();
    }

    /**
     * Get Current SMS Balance.
     *
     * @return JsonResponse
     *
     * @throws \Throwable
     */
    public function getBalance(): JsonResponse
    {
        return (new MsegatBalanceInquiry)->get();
    }

    /**
     * Get Current SMS Balance.
     *
     * @return JsonResponse
     *
     * @throws \Throwable
     */
    public function getSenders(): JsonResponse
    {
        return (new MsegatSenderNamesInquiry)->get();
    }
}
