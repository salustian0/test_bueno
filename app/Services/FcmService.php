<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FcmService
{


    public function __construct(
        private Request $request
    )
    {
    }

    public function send(User $user){
        $apiKey = env('API_KEY');
        $tokens = $user->device_tokens->pluck('token')->toArray();

        if(!$user || empty($tokens))
            return;


        $message = [
            'title' => 'Atualização de dados',
            'body' => "Os dados de ". $user->name . " foram atulizados por: ". $this->request->user()->name,
        ];

        $data = ['key1' => 'value1'];

        $payload = [
            'registration_ids' => $tokens,
            'notification' => $message,
            'data' => $data,
        ];

        $jsonPayload = json_encode($payload);

        $headers = [
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init('https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if ($response === false) {
            die('Erro ao enviar a mensagem FCM: ' . curl_error($ch));
        }


        curl_close($ch);
    }
}
