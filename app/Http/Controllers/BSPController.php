<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;

class BSPController extends Controller
{
    /*
     * Function Create By : Vidhi
     * Generate Random String for password generate
     * length of string is 6 character
     */
    function generateRandomString($length = 6) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /*
     * Function Create By : Vidhi
     * send response to the api
     * all api response send to this function
     * $data = array()
     * $message =  message
     * $status code 200 , 202 ,404 ,400
     */
    public function send_response_api($status_code,$message,$data){
        $response =['STATUS_CODE' => $status_code, 'MESSAGE' => $message, 'DATA' => $data];
        $response_json=json_encode($response,true);
        echo $response_json;
    }

    public function send_sms($mobile,$msg){
        $message = urlencode($msg);
        $contact_no =$mobile;
        $url="http://zensmsinstantmarketers.zenenterprises.in/api/v4/?api_key=A7ace0afac8b60d47e1381933a39c2cad&method=sms&message=$message&to=$contact_no&sender=REGMIN";
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        $html = curl_exec($ch);
        curl_close($ch);

}

}
