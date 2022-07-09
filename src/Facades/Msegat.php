<?php

namespace HossamMonir\Msegat\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static sendWithDefaultSender()
 * @method static sendWithSender(string $senderName)
 * @method static sendOTP(string $senderName = null)
 * @method static numbers(array $numbers)
 * @method static message(string $message)
 * @method static getBalance()
 * @method static getSenders()
 * @method static calculateCost()
 */
class Msegat extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'Msegat';
    }
}
