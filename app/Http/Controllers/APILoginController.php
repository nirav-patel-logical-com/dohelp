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
        if (isset($_POST['user_unique_id']) && !empty($_POST['user_unique_id']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $User = new User();
            $user_unique_id = $_POST['user_unique_id'];
            $login_data = $User->check_user_login($user_unique_id);
            //dd($login_data);
            if (isset($login_data) && !empty($login_data)) {
                if (Hash::check($_POST['password'], $login_data[0]->password)) {
                    // get mobile and password from request
                    $credentials = request(['user_unique_id', 'password']);
                    unset($login_data[0]->password);
                    // try to auth and get the token using api authentication
                    if (!$token = auth('api')->attempt($credentials)) {
                        // if the credentials are wrong we send an unauthorized error in json format
                        return response()->json(['error' => 'Unauthorized'], 401);
                    }
                    if(isset($login_data[0]->user_image) && !empty($login_data[0]->user_image)){
                        $login_data[0]->user_image_url = env('APP_URL').'public/user_image/'.$login_data[0]->user_image;
                    }else{
                        $login_data[0]->user_image_url = env('APP_URL').'public/assets/images/users/avatar-1.jpg';
                    }
                    $data['user_details'] = $login_data[0];
                    $data['token'] = $token;
                    $data['type'] = 'bearer';
                    $data['expires'] = auth('api')->factory()->getTTL() * 60; // time to expiration
                    $BSPController->send_response_api(200, 'Login Success', $data);
                }else {
                    $BSPController->send_response_api(401, 'Please enter valid password.', '');
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
