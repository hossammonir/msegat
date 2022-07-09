<?php

namespace HossamMonir\Msegat\Contracts;

use Illuminate\Support\Arr;

abstract class Msegat
{
    /**
     * Configurations array
     *
     * @var array
     */
    protected array $config;

    /**
     * Msegat endpoint
     *
     * @var string
     */
    protected string $msegatEndpoint;

    /**
     * API Key
     *
     * @var string
     */
    protected string $apiKey;

    /**
     * Msegat Username
     *
     * @var string
     */
    protected string $username;

    /**
     * Configurations array
     *
     * @var string | bool
     */
    protected mixed $body;

    /**
     * Msegat Processor Constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->setMsegatConfig($config);
    }

    /**
     * Function to set payfort API Configuration.
     *
     * @param  array  $config Package configuration array
     * @return void
     */
    protected function setMsegatConfig(array $config): void
    {
        $this->msegatEndpoint = 'https://www.msegat.com/gw';
        $this->username = config('msegat.config.username');
        $this->apiKey = config('msegat.config.key');

        $defaultConfig = [
            'userName' => $this->username,
            'apiKey' => $this->apiKey,
        ];

        $this->config = array_merge($defaultConfig, $config);
    }

    /**
     * Convert the object to its JSON representation.
     * @param array $numbers
     * @return string
     */
    public function renderNumbers(array $numbers): string
    {
        return collect($numbers)->implode(',');
    }

    /**
     * This will remove all 00 from the numbers.
     * @param array $numbers
     * @return string
     */
    public function renderNumberForCalculation(array $numbers): string
    {
        $collection = Arr::map($numbers, function ($number) {
            return str()->replace(['00', '+'], '', $number);
        });

        return collect($collection)->implode(',');
    }

    /** Encode all configurations to json string.
     * @return bool|string
     */
    protected function getMsegatBody(): bool|string
    {
        return $this->body = json_encode($this->config);
    }

    /**
     * Convert the given configuration to Boundary parameters.
     * @return array
     */
    public function getBoundaryStream(): array
    {
        return Arr::map($this->config, function ($value, $key) {
            return [
                'name' => $key,
                'contents' => $value,
            ];
        });
    }
}
