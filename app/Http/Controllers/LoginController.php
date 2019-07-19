<?php
/**
 * Created by PhpStorm.
 * User: vidhi_BSP
 * Date: 7/17/2019
 * Time: 3:29 PM
 */

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller{

    public function login()
    {
        if (Session::has('login_data')) {
            return redirect()->route('dashboard');
        }else{
            return response()
                ->view('auth.login');
        }

    }

    private function set_session_during_back_end_login($login_data)
    {
        Session::push('login_data', $login_data[0]);
    }
// User Login API
    public function loginAction()
    {
        $BSPController = new BSPController();
        if (isset($_POST['user_mobile']) && !empty($_POST['user_mobile']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $User = new User();
            $mobile = $_POST['user_mobile'];
            $mobile_country_code = $_POST['user_mobile_country_code'];
            $login_data = $User->check_admin_login($mobile, $mobile_country_code);
            //dd($login_data);
            if (isset($login_data) && !empty($login_data)) {
                if (Hash::check($_POST['password'], $login_data[0]->password)) {
                    // get mobile and password from request
                    unset($login_data[0]->password);
                    if($_POST["remember_me"]=='1' || $_POST["remember_me"]=='on')
                    {
                        $hour = time() + 3600 * 24 * 30;
                        setcookie('user_mobile', $_POST['user_mobile'], $hour);
                        setcookie('password', $_POST['password'], $hour);
                        setcookie('user_mobile_country_code', $_POST['user_mobile_country_code'], $hour);
                    }
                    $this->set_session_during_back_end_login($login_data);
                    $BSPController->send_response_api(200, 'Login Success', $login_data[0]);
                } else {
                    $BSPController->send_response_api(401, 'Please enter valid password.', '');
                }
            } else {
                $BSPController->send_response_api(401, 'Please enter valid Username and password.', '');
            }

        } else {
            $BSPController->send_response_api(401, 'Please enter Username and password.', '');
        }

    }
    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }

}