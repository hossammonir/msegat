<?php

namespace HossamMonir\Msegat\Traits;

use GuzzleHttp\Psr7\MultipartStream;
use Illuminate\Support\Facades\Http;

trait MsegatAPIRequest
{
    use MsegatValidateParams;

    /**
     * Send SMS API Request.
     *
     * @throws \Throwable
     */
    public function SendSMSRequest()
    {
        // Validate Core API Parameters + Required Parameters for this API
        $this->validateMsegatParams($this->config, ['userName', 'apiKey', 'userSender']);

        return Http::baseUrl($this->msegatEndpoint)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->retry(5, 2000)
            ->withBody($this->getMsegatBody(), 'application/json')
            ->post('sendsms.php')
            ->json();
    }

    /**
     * Get Account Balance API Request.
     *
     * @throws \Throwable
     */
    public function BalanceInquiry()
    {
        // Validate Core API Parameters + Required Parameters for this API
        $this->validateMsegatParams($this->config, ['userName', 'apiKey']);

        return Http::baseUrl($this->msegatEndpoint)
            ->withHeaders(['Content-Type' => 'multipart/form-data; boundary=BOUNDARY'])
            ->retry(5, 2000)
            ->withBody(new MultipartStream($this->getBoundaryStream(), 'BOUNDARY'), 'multipart/form-data; boundary=BOUNDARY')
            ->post('Credits.php')
            ->json();
    }

    /**
     * Get Messages Cost API Request.
     *
     * @throws \Throwable
     */
    public function CalculateMessageCostRequest(): string
    {
        $this->validateMsegatParams($this->config, ['userName', 'apiKey', 'contacts', 'msg', 'By', 'msgEncoding']);

        return Http::baseUrl($this->msegatEndpoint)
            ->withHeaders(['Content-Type' => 'multipart/form-data; boundary=BOUNDARY'])
            ->retry(5, 2000)
            ->withBody(new MultipartStream($this->getBoundaryStream(), 'BOUNDARY'), 'multipart/form-data; boundary=BOUNDARY')
            ->post('calculateCost.php')
            ->body();
    }

    /**
     * Get Registered Sender Names API Request.
     *
     * @throws \Throwable
     */
    public function SenderNamesInquiryRequest()
    {
        // Validate Core API Parameters + Required Parameters for this API
        $this->validateMsegatParams($this->config, ['userName', 'apiKey']);

        return Http::baseUrl($this->msegatEndpoint)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->retry(5, 2000)
            ->withBody($this->getMsegatBody(), 'application/json')
            ->post('senders.php')
            ->json();
    }
}
