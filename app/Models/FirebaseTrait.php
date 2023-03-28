<?php 
namespace App\Models;

use Illuminate\Http\Request;


trait FirebaseTrait {

    protected $serverKey;
     
    public function __construct() {

        $this->serverKey = config('app.firebase_server_key');
    }

    public function saveToken (Request $request)
    {
        $user = User::find($request->user_id);
        $user->device_token = $request->fcm_token;
        $user->save();

        if($user)
            return response()->json([
                'message' => 'User token updated'
            ]);

        return response()->json([
            'message' => 'Error!'
        ]);
    }

    public function sendPush (Request $request) {

        $user = User::find($request->user_id);
        $data = [
            "to" => $user->device_token,
            "notification" =>
                [
                    "title" => 'Twitter',
                    "body" => current_user()->name . ' Started Follwing You',
                    "icon" => url('/images/icon.png')
                ],
        ];
        $dataString = json_encode($data);
        //   dd($data);
        $headers = [
            'Authorization: key=' . $this->serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
    
        return curl_exec($ch);
    }

}