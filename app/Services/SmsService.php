<?php

namespace App\Services;

use Twilio\Rest\Client;

class SmsService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(config('services.twilio.sid'), config('services.twilio.auth_token'));
    }

    public function sendSms($to, $message)
    {
        $this->client->messages->create($to, [
            'from' => config('services.twilio.phone_number'),
            'body' => $message,
        ]);
    }
}
