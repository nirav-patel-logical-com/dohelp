<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class APILoginController extends Controller
{
    // User Login API
    public function login()
    {
        $BSPController = new BSPController();
        if (isset($_POST['user_mobile']) && !empty($_POST['user_mobile']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $User = new User();
            $mobile = $_POST['user_mobile'];
            $mobile_country_code = $_POST['user_mobile_country_code'];
            $login_data = $User->check_user_login($mobile, $mobile_country_code);
            //dd($login_data);
            if (isset($login_data) && !empty($login_data)) {
                if (Hash::check($_POST['password'], $login_data[0]->password)) {
                    // get mobile and password from request
                    $credentials = request(['user_mobile', 'password']);
                    unset($login_data[0]->password);
                    // try to auth and get the token using api authentication
                    if (!$token = auth('api')->attempt($credentials)) {
                        // if the credentials are wrong we send an unauthorized error in json format
                        return response()->json(['error' => 'Unauthorized'], 401);
                    }
                    $data['user_details'] = $login_data[0];
                    $data['token'] = $token;
                    $data['type'] = 'bearer';
                    $data['expires'] = auth('api')->factory()->getTTL() * 60; // time to expiration
                    $BSPController->send_response_api(200, 'Login Success', $data);
                }
            } else {
                $BSPController->send_response_api(401, 'Please enter valid Username and password.', '');
            }

        } else {
            $BSPController->send_response_api(401, 'Please enter Username and password.', '');
        }

    }

    public function generateNewToken()
    {
        $BSPController = new BSPController();
        $token = JWTAuth::getToken();

        if (! $token) {
            throw new BadRequestHttpException('Token not provided');
        }

        try {
            $token = JWTAuth::refresh($token);

        } catch (TokenInvalidException $e) {
            $BSPController->send_response_api(400, 'The token is invalid', '');
        }

        $data['token'] = $token;
        $data['type'] = 'bearer';
        $data['expires'] = auth('api')->factory()->getTTL() * 60; // time to expiration
        $BSPController->send_response_api(200, 'New Token generated', $data);

    }

    public function logout(){
        $BSPController = new BSPController();
        $token = JWTAuth::getToken();

        if (! $token) {
            throw new BadRequestHttpException('Token not provided');
        }

        try {
            $token = auth('api')->logout();

        } catch (TokenInvalidException $e) {
            $BSPController->send_response_api(400, 'The token is invalid', '');
        }

        $BSPController->send_response_api(200, 'Your Token has been expired.', '');
    }
}
