<?php

namespace App\Service;

use Twilio\Rest\Client;
class TwilioService
{
    public function sendVoiceOTP($recipientPhoneNumber)
    {
       $accountSid = $_ENV['TWILIO_ACCOUNT_SID'];
        $authToken = $_ENV['TWILIO_AUTH_TOKEN'];
        $twilioPhoneNumber = $_ENV['TWILIO_PHONE_NUMBER'];
        dump($_ENV);
        $client = new Client($accountSid, $authToken);
        $call = $client->messages->create(
            $recipientPhoneNumber,
            [
                // A Twilio phone number you purchased at https://console.twilio.com
                'from' => $twilioPhoneNumber,
                // The body of the text message you'd like to send
                'body' => "Bonjour Aziz, Une nouvelle connection a ete etablie a votre compte!"
            ]
        );
        return $call->sid;
        /*
        $sid    = "AC6ff4feb6facba279d8e1ec07002a37d1";
        $token  = "8c1152df2031a06d9a63eb2f1dba4136";
        $twilio = new Client($sid, $token);
    
        $message = $twilio->messages
          ->create("+21655686370", // to
            array(
              "from" => "+16508661728",
              "body" => "testest"
            )
          );
    */
    //print($message->sid);
    }
}