<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Twilio\Rest\Client;

class ContactPhoneVerifier extends Controller
{
    public function verify(Request $request){
        return response()->json(['phonex' => $request->input('phone')]);
        $twilio_sid = 'ACcb65ab7c1416edf551146687bb72d1be';
        $twilio_token = '3d72887cc5cc0fd8fa5ab0871161e2bc';
        $twilio_number = '+15153052339';
        $otp = rand(1000,9999);

        $client = new Client($twilio_sid, $twilio_token);

        $client->messages->create($request->input('phone'), [
            'from' => $twilio_number,
            'body' => 'hi Khokho'
        ]);
        
    }
}
