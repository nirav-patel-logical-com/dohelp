<?php
/**
 * Created by PhpStorm.
 * User: vidhi_BSP
 * Date: 7/15/2019
 * Time: 6:31 PM
 */

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller{

    /*Create User API*/
    public function userCreate(){
        $User =new User();
        $BSPController =new BSPController();
        if (isset($_POST['user_name']) && !empty($_POST['user_name']) &&
            isset($_POST['user_mobile']) && !empty($_POST['user_mobile']) &&
            isset($_POST['user_city']) && !empty($_POST['user_city'])
        ) {
            $user_reference_number ='';
            $user_bank_name ='';
            $user_bank_number ='';
            $user_IFSC_code ='';
            $user_bank_branch ='';
            $user_paytm_number ='';
            $user_google_pay_number ='';
            $user_phone_pay_number ='';
            if(isset($_POST['user_reference_number']) && !empty($_POST['user_reference_number'])){
                $user_reference_number = $_POST['user_reference_number'];
                $check_reference_number = $User->check_reference_number($user_reference_number);
                if(isset($check_reference_number) && empty($check_reference_number)){
                    $BSPController->send_response_api(400, 'Your Reference number not valid.', '');
                }
            }
            if(isset($_POST['user_bank_name']) && !empty($_POST['user_bank_name'])){
                $user_bank_name =$_POST['user_bank_name'];
            }
            if(isset($_POST['user_bank_number']) && !empty($_POST['user_bank_number'])){
                $user_bank_number =$_POST['user_bank_number'];
            }
            if(isset($_POST['user_IFSC_code']) && !empty($_POST['user_IFSC_code'])){
                $user_IFSC_code =$_POST['user_IFSC_code'];
            }
            if(isset($_POST['user_bank_branch']) && !empty($_POST['user_bank_branch'])){
                $user_bank_branch =$_POST['user_bank_branch'];
            }
            if(isset($_POST['user_paytm_number']) && !empty($_POST['user_paytm_number'])){
                $user_paytm_number =$_POST['user_paytm_number'];
            }
            if(isset($_POST['user_phone_pay_number']) && !empty($_POST['user_phone_pay_number'])){
                $user_phone_pay_number =$_POST['user_phone_pay_number'];
            }
            if(isset($_POST['user_google_pay_number']) && !empty($_POST['user_google_pay_number'])){
                $user_google_pay_number =$_POST['user_google_pay_number'];
            }
            $user_unique_id = $BSPController->generateRandomString();
            $user_unique_id = 'MH'.$user_unique_id;
            $user_id = DB::table('users')->insertGetId([
                 'user_name' => $_POST['user_name'],
                 'user_mobile' => $_POST['user_mobile'],
                 'user_mobile_country_code' => '+91',
                 'user_city' => $_POST['user_city'],
                 'user_reference_number' => $user_reference_number,
                 'user_unique_id' => $user_unique_id,
                 'user_role_name' => 'User',
                 'user_status' => 'Inactive',
                 'user_add_date' => time(),
                 'user_add_by' => 0,
            ]);
            $user_details_id = DB::table('user_details')->insertGetId([
                'user_id' => $user_id,
                'user_bank_name' => $user_bank_name,
                'user_bank_number' => $user_bank_number,
                'user_IFSC_code' => $user_IFSC_code,
                'user_bank_branch' => $user_bank_branch,
                'user_paytm_number' => $user_paytm_number,
                'user_phone_pay_number' => $user_phone_pay_number,
                'user_google_pay_number' => $user_google_pay_number,
                'user_details_add_date' => time(),
                'user_details_amount' => '',
                'user_details_payment_date' => '',
                'user_details_by' => '',
                'user_details_image' => '',
                'user_details_add_by' => $user_id,
            ]);
            $BSPController->send_response_api(201, 'User added successfully please contact to admin', $user_id);
        }else{
            $BSPController->send_response_api(400, 'Invalid Request.', '');
        }
    }
    /*Create User API*/
    public function userEdit(){
        $User =new User();
        $BSPController =new BSPController();
        if (isset($_POST['user_name']) && !empty($_POST['user_name']) &&
            isset($_POST['user_mobile']) && !empty($_POST['user_mobile']) &&
            isset($_POST['user_city']) && !empty($_POST['user_city'])
        ) {
            $user_reference_number ='';
            $user_bank_name ='';
            $user_bank_number ='';
            $user_IFSC_code ='';
            $user_bank_branch ='';
            $user_paytm_number ='';
            $user_google_pay_number ='';
            $user_phone_pay_number ='';
            if(isset($_POST['user_reference_number']) && !empty($_POST['user_reference_number'])){
                $user_reference_number = $_POST['user_reference_number'];
                $check_reference_number = $User->check_reference_number($user_reference_number);
                if(isset($check_reference_number) && empty($check_reference_number)){
                    $BSPController->send_response_api(400, 'Your Reference number not valid.', '');
                }
            }
            if(isset($_POST['user_bank_name']) && !empty($_POST['user_bank_name'])){
                $user_bank_name =$_POST['user_bank_name'];
            }
            if(isset($_POST['user_bank_number']) && !empty($_POST['user_bank_number'])){
                $user_bank_number =$_POST['user_bank_number'];
            }
            if(isset($_POST['user_IFSC_code']) && !empty($_POST['user_IFSC_code'])){
                $user_IFSC_code =$_POST['user_IFSC_code'];
            }
            if(isset($_POST['user_bank_branch']) && !empty($_POST['user_bank_branch'])){
                $user_bank_branch =$_POST['user_bank_branch'];
            }
            if(isset($_POST['user_paytm_number']) && !empty($_POST['user_paytm_number'])){
                $user_paytm_number =$_POST['user_paytm_number'];
            }
            if(isset($_POST['user_phone_pay_number']) && !empty($_POST['user_phone_pay_number'])){
                $user_phone_pay_number =$_POST['user_phone_pay_number'];
            }
            if(isset($_POST['user_google_pay_number']) && !empty($_POST['user_google_pay_number'])){
                $user_google_pay_number =$_POST['user_google_pay_number'];
            }
            $user_id =$_POST['user_id'];
            DB::table('users')
                ->where('id', $user_id)
                ->update([
                'user_name' => $_POST['user_name'],
                'user_mobile' => $_POST['user_mobile'],
                'user_mobile_country_code' => '+91',
                'user_city' => $_POST['user_city'],
                'user_reference_number' => $user_reference_number,
                'user_modify_date' => time(),
                'user_modify_by' => $user_id,
            ]);
            DB::table('user_details')
                ->where('id', $user_id)
                ->update([
                'user_bank_name' => $user_bank_name,
                'user_bank_number' => $user_bank_number,
                'user_IFSC_code' => $user_IFSC_code,
                'user_bank_branch' => $user_bank_branch,
                'user_paytm_number' => $user_paytm_number,
                'user_phone_pay_number' => $user_phone_pay_number,
                'user_google_pay_number' => $user_google_pay_number,
                'user_details_modify_date' => time(),
                'user_details_modify_by' => $user_id
            ]);
            $BSPController->send_response_api(201, 'User data update successfully.', $user_id);
        }else{
            $BSPController->send_response_api(400, 'Invalid Request.', '');
        }
    }


    /*Create User List API*/
    public function changePassword(){
        $response = array();
        $code = 404;
        $status_message = "Invalid Request.";
        if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
            $user_id = trim($_POST['user_id']);
            $User = new User();
            $old_pass = $User->get_user_password_by_user_id($user_id);
            $code = 401;
            $status_message = "Old Password wrong.";
            $old_password = $_POST['current_password'];
            $new_password = $_POST['new_password'];

            if (Hash::check($old_password, $old_pass[0]->password)) {
                $new_pass_update = Hash::make($new_password);
                //Call function to update password
                $change_password = DB::table('users')
                    ->where('id', $user_id)
                    ->update(['password' => $new_pass_update,
                        'user_modify_date' => time()
                    ]);
                if ($change_password) {
                    $code = 200;
                    $status_message = "Password Changed.";
                }

            }
        }
        $BSPController = new BSPController();
        $BSPController->send_response_api($code, $status_message, '');
    }
    public function recoveryPassword(){
        return response()
            ->view('auth.forgot-password');
    }
    public function recoveryPasswordAction()
    {
        $BSPController = new BSPController();
        $response = array();
        $code = 404;
        $status_message = "Invalid Request.";
        if (isset($_POST['user_mobile']) && !empty($_POST['user_mobile'])) {
            $user_mobile = trim($_POST['user_mobile']);
            $User = new User();
            $check_user_is_admin = $User->check_user_is_admin($user_mobile);
            if(isset($check_user_is_admin) && !empty($check_user_is_admin)){
                $new_pass_update = $BSPController->generateRandomString();
                //Call function to update password
                $change_password = DB::table('users')
                    ->where('user_mobile', $user_mobile)
                    ->update(['password' => Hash::make($new_pass_update),
                        'user_modify_date' => time()
                    ]);
                $message ="Your new password is $new_pass_update.";
                //$BSPController->send_sms($user_mobile,$message);
                if ($change_password) {
                    $code = 200;
                    $status_message = "Your password send to your mobile number please check.";
                }

            }else{
                $code = 400;
                $status_message = "You are not admin user.";
            }

        }

        $BSPController->send_response_api($code, $status_message, '');

    }

    public function changePasswordWeb()
    {
        $response = array();
        $code = 404;
        $status_message = "Invalid Request.";
        if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
            $user_id = trim($_POST['user_id']);
            $User = new User();
            $old_pass = $User->get_user_password_by_user_id($user_id);
            $code = 401;
            $status_message = "Old Password wrong.";
            $old_password = $_POST['current_password'];
            $new_password = $_POST['new_password'];

            if (Hash::check($old_password, $old_pass[0]->password)) {
                $new_pass_update = Hash::make($new_password);
                //Call function to update password
                $change_password = DB::table('users')
                    ->where('id', $user_id)
                    ->update(['password' => $new_pass_update,
                        'user_modify_date' => time()
                    ]);
                if ($change_password) {
                    $code = 200;
                    $status_message = "Password Changed.";
                }

            }
        }
        $BSPController = new BSPController();
        $BSPController->send_response_api($code, $status_message, '');
    }


    /*User Details*/
    public function userDetails(){
        $User =new User();
        $BSPController =new BSPController();
        $user_id = $_POST['user_id'];
        $user_details = $User->get_user_details_by_user_id($user_id);
        if(isset($user_details) && !empty($user_details)){
            $BSPController->send_response_api(200, 'Record Found', $user_details);
        }else{
            $BSPController->send_response_api(202, 'No Record Found', '');
        }
    }
    /*Create User List API*/
    public function userList(){
        $User =new User();
        $BSPController =new BSPController();
        if (isset($_POST['last_id']) && !empty($_POST['last_id'])) {
            $start = $_POST['last_id'];
        } else {
            $get_max_id = DB::table('users')->latest('id')->first();
            if (isset($get_max_id) && !empty($get_max_id)) {
                $start = intval($get_max_id->id) + 1;
            } else {
                $start = 0;
            }
        }
        $limit = 10;
        $user_list = $User->get_user_list($start, $limit);
        if(isset($user_list) && !empty($user_list)){
            $BSPController->send_response_api(200, 'Record Found', $user_list);
        }else{
            $BSPController->send_response_api(202, 'No Record Found', '');
        }
    }
    public function register($id){
        $data['id']=$id;
        return response()
            ->view('auth.register',$data);
    }
    public function registerAction(){
        $User =new User();
        $BSPController =new BSPController();
        if (isset($_POST['user_name']) && !empty($_POST['user_name']) &&
            isset($_POST['user_mobile']) && !empty($_POST['user_mobile']) &&
            isset($_POST['user_city']) && !empty($_POST['user_city'])
        ) {
            $user_reference_number ='';
            $user_bank_name ='';
            $user_bank_number ='';
            $user_IFSC_code ='';
            $user_bank_branch ='';
            $user_paytm_number ='';
            $user_google_pay_number ='';
            $user_phone_pay_number ='';
            if(isset($_POST['user_reference_number']) && !empty($_POST['user_reference_number'])){
                $user_reference_number = $_POST['user_reference_number'];
                $check_reference_number = $User->check_reference_number($user_reference_number);
                if(isset($check_reference_number) && empty($check_reference_number)){
                    $BSPController->send_response_api(400, 'Your Reference number not valid.', '');
                }
            }
            if(isset($_POST['user_bank_name']) && !empty($_POST['user_bank_name'])){
                $user_bank_name =$_POST['user_bank_name'];
            }
            if(isset($_POST['user_bank_number']) && !empty($_POST['user_bank_number'])){
                $user_bank_number =$_POST['user_bank_number'];
            }
            if(isset($_POST['user_IFSC_code']) && !empty($_POST['user_IFSC_code'])){
                $user_IFSC_code =$_POST['user_IFSC_code'];
            }
            if(isset($_POST['user_bank_branch']) && !empty($_POST['user_bank_branch'])){
                $user_bank_branch =$_POST['user_bank_branch'];
            }
            if(isset($_POST['user_paytm_number']) && !empty($_POST['user_paytm_number'])){
                $user_paytm_number =$_POST['user_paytm_number'];
            }
            if(isset($_POST['user_phone_pay_number']) && !empty($_POST['user_phone_pay_number'])){
                $user_phone_pay_number =$_POST['user_phone_pay_number'];
            }
            if(isset($_POST['user_google_pay_number']) && !empty($_POST['user_google_pay_number'])){
                $user_google_pay_number =$_POST['user_google_pay_number'];
            }
            $user_unique_id = $BSPController->generateRandomString();
            $user_unique_id = 'MH'.$user_unique_id;
            $user_id = DB::table('users')->insertGetId([
                'user_name' => $_POST['user_name'],
                'user_mobile' => $_POST['user_mobile'],
                'user_mobile_country_code' => '+91',
                'user_city' => $_POST['user_city'],
                'user_reference_number' => $user_reference_number,
                'user_unique_id' => $user_unique_id,
                'user_role_name' => 'User',
                'user_status' => 'Inactive',
                'user_add_date' => time(),
                'user_add_by' => 0,
            ]);
            $user_details_id = DB::table('user_details')->insertGetId([
                'user_id' => $user_id,
                'user_bank_name' => $user_bank_name,
                'user_bank_number' => $user_bank_number,
                'user_IFSC_code' => $user_IFSC_code,
                'user_bank_branch' => $user_bank_branch,
                'user_paytm_number' => $user_paytm_number,
                'user_phone_pay_number' => $user_phone_pay_number,
                'user_google_pay_number' => $user_google_pay_number,
                'user_details_add_date' => time(),
                'user_details_amount' => '',
                'user_details_payment_date' => '',
                'user_details_by' => '',
                'user_details_image' => '',
                'user_details_add_by' => $user_id,
            ]);
            $BSPController->send_response_api(201, 'User added successfully please contact to admin', $user_id);
        }else{
            $BSPController->send_response_api(400, 'Invalid Request.', '');
        }
    }
}