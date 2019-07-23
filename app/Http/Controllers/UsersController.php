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
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{

    public function memberCreate()
    {
        return response()
            ->view('member.member-create');
    }

    public function user_create_success($u_id,$mobile){
        $password =DB::table('users')
            ->Where('user_status', 'Active')
            ->Where('user_unique_id', $u_id)
            ->Where('user_role_name','!=','Admin')
            ->value('password');
        return response()
            ->view('member.member-create-success',[
                'u_id'=>$u_id,'mobile'=>$mobile,'password'=>$password]);
    }

    /*Create User API*/
    public function userCreate()
    {
        //dd($_POST);
        $User = new User();
        $BSPController = new BSPController();
        if (isset($_POST['user_name']) && !empty($_POST['user_name']) &&
            isset($_POST['user_mobile']) && !empty($_POST['user_mobile']) &&
            isset($_POST['user_city']) && !empty($_POST['user_city'])
        ) {
            $user_reference_number = '';
            $user_bank_name = '';
            $user_bank_number = '';
            $user_IFSC_code = '';
            $user_bank_branch = '';
            $user_paytm_number = '';
            $user_google_pay_number = '';
            $user_phone_pay_number = '';
            $user_add_by = 0;
            if (isset($_POST['user_reference_number']) && !empty($_POST['user_reference_number'])) {
                $user_reference_number = $_POST['user_reference_number'];
                $check_reference_number = $User->check_reference_number($user_reference_number);
                if (isset($check_reference_number) && empty($check_reference_number)) {
                    $BSPController->send_response_api(400, 'Your Reference number not valid.', '');
                    exit;
                }
            }
//            $check_mobile_exist = $User->check_mobile_exist($_POST['user_mobile']);
//            if (isset($check_mobile_exist) && empty($check_mobile_exist)) {
//                $BSPController->send_response_api(400, 'Mobile Number exist.', '');
//                exit;
//            }
            if (isset($_POST['user_bank_name']) && !empty($_POST['user_bank_name'])) {
                $user_bank_name = $_POST['user_bank_name'];
            }
            if (isset($_POST['user_bank_number']) && !empty($_POST['user_bank_number'])) {
                $user_bank_number = $_POST['user_bank_number'];
            }
            if (isset($_POST['user_IFSC_code']) && !empty($_POST['user_IFSC_code'])) {
                $user_IFSC_code = $_POST['user_IFSC_code'];
            }
            if (isset($_POST['user_bank_branch']) && !empty($_POST['user_bank_branch'])) {
                $user_bank_branch = $_POST['user_bank_branch'];
            }
            if (isset($_POST['user_paytm_number']) && !empty($_POST['user_paytm_number'])) {
                $user_paytm_number = $_POST['user_paytm_number'];
            }
            if (isset($_POST['user_phone_pay_number']) && !empty($_POST['user_phone_pay_number'])) {
                $user_phone_pay_number = $_POST['user_phone_pay_number'];
            }
            if (isset($_POST['user_google_pay_number']) && !empty($_POST['user_google_pay_number'])) {
                $user_google_pay_number = $_POST['user_google_pay_number'];
            }
            if (isset($_POST['user_add_by']) && !empty($_POST['user_add_by'])) {
                $user_add_by = $_POST['user_add_by'];
            }
            $user_unique_id = $BSPController->generateRandomString();
            $user_unique_id = 'MH' . $user_unique_id;
            $user_password = $BSPController->generateRandomStringPassword();
            $user_id = DB::table('users')->insertGetId([
                'user_name' => $_POST['user_name'],
                'user_mobile' => $_POST['user_mobile'],
                'user_mobile_country_code' => '+91',
                'user_city' => $_POST['user_city'],
                'user_age' => $_POST['user_age'],
                'user_reference_number' => $user_reference_number,
                'password' => Hash::make($user_password),
                'user_unique_id' => $user_unique_id,
                'user_role_name' => 'User',
                'user_status' => 'Active',
                'user_add_date' => time(),
                'user_add_by' => $user_add_by,
            ]);
            $site_settings = DB::table('site_setting')->orderBy('ss_id','desc')->get();
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
                'user_details_amount' => $site_settings[0]->ss_total_amount,
                'donation_fees' => $site_settings[0]->ss_donation,
                'entry_fees' => $site_settings[0]->ss_entry_fees,
                'discount' => $site_settings[0]->ss_discount,
                'discount_amount' => $site_settings[0]->ss_discount_amount,
                'user_details_payment_date' => time(),
                'user_details_by' => '',
                'user_details_image' => '',
                'user_details_add_by' => $user_add_by,
            ]);

            $user_details['user_unique_id'] = $user_unique_id;
            $user_details['user_mobile'] = $_POST['user_mobile'];
            $user_details['redirect_url'] = env('APP_URL').'user_create_success/'. $user_unique_id.'/'.$_POST['user_mobile'];
            $BSPController->send_response_api(200, 'User added successfully please contact to admin', $user_details);
        } else {
            $BSPController->send_response_api(400, 'Invalid Request.', '');
        }
    }

    /*Create User API*/
    public function userCreateAPI()
    {
        //dd($_POST);
        $User = new User();
        $BSPController = new BSPController();
        if (isset($_POST['user_name']) && !empty($_POST['user_name']) &&
            isset($_POST['user_mobile']) && !empty($_POST['user_mobile']) &&
            isset($_POST['user_city']) && !empty($_POST['user_city'])&&
            isset($_POST['user_age']) && !empty($_POST['user_age'])
        ) {
            $user_reference_number = '';
            $user_bank_name = '';
            $user_bank_number = '';
            $user_IFSC_code = '';
            $user_bank_branch = '';
            $user_paytm_number = '';
            $user_google_pay_number = '';
            $user_phone_pay_number = '';
            $user_add_by = 0;
            if (isset($_POST['user_reference_number']) && !empty($_POST['user_reference_number'])) {
                $user_reference_number = $_POST['user_reference_number'];
                $check_reference_number = $User->check_reference_number($user_reference_number);
                if (isset($check_reference_number) && empty($check_reference_number)) {
                    $BSPController->send_response_api(400, 'Your Reference number not valid.', '');
                    exit;
                }
            }
//            $check_mobile_exist = $User->check_mobile_exist($_POST['user_mobile']);
//            if (isset($check_mobile_exist) && empty($check_mobile_exist)) {
//                $BSPController->send_response_api(400, 'Mobile Number exist.', '');
//                exit;
//            }
            if (isset($_POST['user_bank_name']) && !empty($_POST['user_bank_name'])) {
                $user_bank_name = $_POST['user_bank_name'];
            }
            if (isset($_POST['user_bank_number']) && !empty($_POST['user_bank_number'])) {
                $user_bank_number = $_POST['user_bank_number'];
            }
            if (isset($_POST['user_IFSC_code']) && !empty($_POST['user_IFSC_code'])) {
                $user_IFSC_code = $_POST['user_IFSC_code'];
            }
            if (isset($_POST['user_bank_branch']) && !empty($_POST['user_bank_branch'])) {
                $user_bank_branch = $_POST['user_bank_branch'];
            }
            if (isset($_POST['user_paytm_number']) && !empty($_POST['user_paytm_number'])) {
                $user_paytm_number = $_POST['user_paytm_number'];
            }
            if (isset($_POST['user_phone_pay_number']) && !empty($_POST['user_phone_pay_number'])) {
                $user_phone_pay_number = $_POST['user_phone_pay_number'];
            }
            if (isset($_POST['user_google_pay_number']) && !empty($_POST['user_google_pay_number'])) {
                $user_google_pay_number = $_POST['user_google_pay_number'];
            }
            if (isset($_POST['user_add_by']) && !empty($_POST['user_add_by'])) {
                $user_add_by = $_POST['user_add_by'];
            }
            $user_unique_id = $BSPController->generateRandomString();
            $user_unique_id = 'MH' . $user_unique_id;
            $user_password = $BSPController->generateRandomStringPassword();
            $user_id = DB::table('users')->insertGetId([
                'user_name' => $_POST['user_name'],
                'user_mobile' => $_POST['user_mobile'],
                'user_mobile_country_code' => '+91',
                'user_city' => $_POST['user_city'],
                'user_age' => $_POST['user_age'],
                'user_reference_number' => $user_reference_number,
                'password' => Hash::make($user_password),
                'user_unique_id' => $user_unique_id,
                'user_role_name' => 'User',
                'user_status' => 'Inactive',
                'user_add_date' => time(),
                'user_add_by' => $user_add_by,
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
                'donation_fees' => '',
                'entry_fees' => '',
                'discount' => '',
                'discount_amount' => '',
                'user_details_payment_date' => time(),
                'user_details_by' => '',
                'user_details_image' => '',
                'user_details_add_by' => $user_add_by,
            ]);

            $BSPController->send_response_api(200, 'User added successfully please contact to admin', '');
        } else {
            $BSPController->send_response_api(400, 'Invalid Request.', '');
        }
    }
    /*Create User API*/
    public function userEdit()
    {
        // dd($_POST);
        $User = new User();
        $BSPController = new BSPController();
        if (isset($_POST['user_name']) && !empty($_POST['user_name']) &&
            isset($_POST['user_mobile']) && !empty($_POST['user_mobile']) &&
            isset($_POST['user_city']) && !empty($_POST['user_city'])
        ) {
            $user_reference_number = '';
            $user_bank_name = '';
            $user_bank_number = '';
            $user_IFSC_code = '';
            $user_bank_branch = '';
            $user_paytm_number = '';
            $user_google_pay_number = '';
            $user_phone_pay_number = '';
            $user_gender = '';
            $user_image = '';
            $user_modify_by = '';
            $user_id = $_POST['user_id'];
            if (isset($_POST['user_reference_number']) && !empty($_POST['user_reference_number'])) {
                $user_reference_number = $_POST['user_reference_number'];
                $check_reference_number = $User->check_reference_number($user_reference_number);
                if (isset($check_reference_number) && empty($check_reference_number)) {
                    $BSPController->send_response_api(400, 'Your Reference number not valid.', '');
                }
            }
//            $check_mobile_exist = $User->check_mobile_exist($_POST['user_mobile']);
//            if (isset($check_mobile_exist) && empty($check_mobile_exist) && $check_mobile_exist != $user_id) {
//                $BSPController->send_response_api(400, 'Mobile Number exist.', '');
//                exit;
//            }
            if (isset($_POST['user_gender']) && !empty($_POST['user_gender'])) {
                $user_gender = $_POST['user_gender'];
            }

            $check_old_image = $User->check_old_image($user_id);
            if (isset($_POST['user_image']) && !empty($_POST['user_image'])) {
                $user_image = $_POST['user_image'];
            } elseif (isset($check_old_image) && !empty($check_old_image)) {
                $user_image = $check_old_image;
            }
            if (isset($_POST['user_bank_name']) && !empty($_POST['user_bank_name'])) {
                $user_bank_name = $_POST['user_bank_name'];
            }
            if (isset($_POST['user_bank_number']) && !empty($_POST['user_bank_number'])) {
                $user_bank_number = $_POST['user_bank_number'];
            }
            if (isset($_POST['user_IFSC_code']) && !empty($_POST['user_IFSC_code'])) {
                $user_IFSC_code = $_POST['user_IFSC_code'];
            }
            if (isset($_POST['user_bank_branch']) && !empty($_POST['user_bank_branch'])) {
                $user_bank_branch = $_POST['user_bank_branch'];
            }
            if (isset($_POST['user_paytm_number']) && !empty($_POST['user_paytm_number'])) {
                $user_paytm_number = $_POST['user_paytm_number'];
            }
            if (isset($_POST['user_phone_pay_number']) && !empty($_POST['user_phone_pay_number'])) {
                $user_phone_pay_number = $_POST['user_phone_pay_number'];
            }
            if (isset($_POST['user_google_pay_number']) && !empty($_POST['user_google_pay_number'])) {
                $user_google_pay_number = $_POST['user_google_pay_number'];
            }
            if (isset($_POST['user_add_by']) && !empty($_POST['user_add_by'])) {
                $user_modify_by = $_POST['user_add_by'];
            } else {
                $user_modify_by = $user_id;
            }
            DB::table('users')
                ->where('id', $user_id)
                ->update([
                    'user_name' => $_POST['user_name'],
                    'user_mobile' => $_POST['user_mobile'],
                    'user_mobile_country_code' => '+91',
                    'user_city' => $_POST['user_city'],
                    'user_age' => $_POST['user_age'],
                    'user_image' => $user_image,
                    'user_gender' => $user_gender,
                    'user_reference_number' => $user_reference_number,
                    'user_modify_date' => time(),
                    'user_modify_by' => $user_modify_by,
                ]);
            DB::table('user_details')
                ->where('user_id', $user_id)
                ->update([
                    'user_bank_name' => $user_bank_name,
                    'user_bank_number' => $user_bank_number,
                    'user_IFSC_code' => $user_IFSC_code,
                    'user_bank_branch' => $user_bank_branch,
                    'user_paytm_number' => $user_paytm_number,
                    'user_phone_pay_number' => $user_phone_pay_number,
                    'user_google_pay_number' => $user_google_pay_number,
                    'user_details_modify_date' => time(),
                    'user_details_modify_by' => $user_modify_by
                ]);
            $BSPController->send_response_api(200, 'User data update successfully.', $user_id);
        } else {
            $BSPController->send_response_api(400, 'Invalid Request.', '');
        }
    }


    /*Create User List API*/
    public function changePassword()
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

    public function recoveryPassword()
    {
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
            if (isset($check_user_is_admin) && !empty($check_user_is_admin)) {
                $new_pass_update = $BSPController->generateRandomString();
                //Call function to update password
                $change_password = DB::table('users')
                    ->where('user_mobile', $user_mobile)
                    ->update(['password' => Hash::make($new_pass_update),
                        'user_modify_date' => time()
                    ]);
                $message = "Your new password is $new_pass_update.";
                //$BSPController->send_sms($user_mobile,$message);
                if ($change_password) {
                    $code = 200;
                    $status_message = "Your password send to your mobile number please check.";
                }

            } else {
                $code = 400;
                $status_message = "You are not admin user.";
            }

        }

        $BSPController->send_response_api($code, $status_message, '');

    }

    public function forgotPasswordAPI(){
        $BSPController = new BSPController();
        $response = array();
        $code = 404;
        $status_message = "Invalid Request.";
        if (isset($_POST['user_unique_id']) && !empty($_POST['user_unique_id'])) {
            $user_unique_id = trim($_POST['user_unique_id']);
            $User = new User();
            $check_user_is_unique_id = $User->check_user_is_unique_id($user_unique_id);
            if (isset($check_user_is_unique_id) && !empty($check_user_is_unique_id)) {
                $new_pass_update = $BSPController->generateRandomString();
                //Call function to update password
                $user_mobile = $check_user_is_unique_id;
                $change_password = DB::table('users')
                    ->where('user_mobile', $user_mobile)
                    ->update(['password' => Hash::make($new_pass_update),
                        'user_modify_date' => time()
                    ]);
                $message = "Your new password is $new_pass_update.";
                //$BSPController->send_sms($user_mobile,$message);
                if ($change_password) {
                    $code = 200;
                    $status_message = "Your password send to your mobile number please check.";
                }

            } else {
                $code = 400;
                $status_message = "You are not authorize user.";
            }

        }else {
            $code = 400;
            $status_message = "You are not authorize user.";
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
    public function userDetails()
    {
        $User = new User();
        $BSPController = new BSPController();
        $user_id = $_POST['user_id'];
        $user_details = $User->get_user_details_by_user_id($user_id);
        if (isset($user_details[0]->user_image) && !empty($user_details[0]->user_image)) {
            $user_details[0]->user_image_url = env('APP_URL') . 'public/user_image/' . $user_details[0]->user_image;
        } else {
            $user_details[0]->user_image_url = env('APP_URL') . 'public/assets/images/users/avatar-1.jpg';
        }
        if (isset($user_details) && !empty($user_details)) {
            $BSPController->send_response_api(200, 'Record Found', $user_details);
        } else {
            $BSPController->send_response_api(202, 'No Record Found', '');
        }
    }

    /*Create User List API*/
    public function userList()
    {
        $User = new User();
        $BSPController = new BSPController();
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
        if (isset($user_list) && !empty($user_list)) {
            $BSPController->send_response_api(200, 'Record Found', $user_list);
        } else {
            $BSPController->send_response_api(202, 'No Record Found', '');
        }
    }

    public function register($id)
    {
        $data['id'] = $id;
        return response()
            ->view('auth.register', $data);
    }

    public function registerAction()
    {
        $User = new User();
        $BSPController = new BSPController();
        if (isset($_POST['user_name']) && !empty($_POST['user_name']) &&
            isset($_POST['user_mobile']) && !empty($_POST['user_mobile']) &&
            isset($_POST['user_city']) && !empty($_POST['user_city'])
        ) {
            $user_reference_number = '';
            $user_bank_name = '';
            $user_bank_number = '';
            $user_IFSC_code = '';
            $user_bank_branch = '';
            $user_paytm_number = '';
            $user_google_pay_number = '';
            $user_phone_pay_number = '';
            $user_gender = '';
            $user_image = '';
            $user_add_by = 0;
            if (isset($_POST['user_reference_number']) && !empty($_POST['user_reference_number'])) {
                $user_reference_number = $_POST['user_reference_number'];
                $check_reference_number = $User->check_reference_number($user_reference_number);
                if (isset($check_reference_number) && empty($check_reference_number)) {
                    $BSPController->send_response_api(400, 'Your Unique number not valid.You are not authorize person.', '');
                }
            }
            if (isset($_POST['user_bank_name']) && !empty($_POST['user_bank_name'])) {
                $user_bank_name = $_POST['user_bank_name'];
            }
            if (isset($_POST['user_gender']) && !empty($_POST['user_gender'])) {
                $user_gender = $_POST['user_gender'];
            }
            if (isset($_POST['user_image']) && !empty($_POST['user_image'])) {
                $user_image = $_POST['user_image'];
            }
            if (isset($_POST['user_bank_number']) && !empty($_POST['user_bank_number'])) {
                $user_bank_number = $_POST['user_bank_number'];
            }
            if (isset($_POST['user_IFSC_code']) && !empty($_POST['user_IFSC_code'])) {
                $user_IFSC_code = $_POST['user_IFSC_code'];
            }
            if (isset($_POST['user_bank_branch']) && !empty($_POST['user_bank_branch'])) {
                $user_bank_branch = $_POST['user_bank_branch'];
            }
            if (isset($_POST['user_paytm_number']) && !empty($_POST['user_paytm_number'])) {
                $user_paytm_number = $_POST['user_paytm_number'];
            }
            if (isset($_POST['user_phone_pay_number']) && !empty($_POST['user_phone_pay_number'])) {
                $user_phone_pay_number = $_POST['user_phone_pay_number'];
            }
            if (isset($_POST['user_google_pay_number']) && !empty($_POST['user_google_pay_number'])) {
                $user_google_pay_number = $_POST['user_google_pay_number'];
            }
            if (isset($_POST['user_add_by']) && !empty($_POST['user_add_by'])) {
                $user_add_by = $_POST['user_add_by'];
            }

            DB::table('users')
                ->where('user_unique_id', $_POST['user_reference_number'])
                ->update([
                'user_name' => $_POST['user_name'],
                'user_mobile' => $_POST['user_mobile'],
                'user_mobile_country_code' => '+91',
                'user_city' => $_POST['user_city'],
                'user_gender' => $user_gender,
                'user_image' => $user_image,
                'user_reference_number' => $user_reference_number,
                'user_role_name' => 'User',
                'user_status' => 'Inactive',
                'user_add_date' => time(),
                'user_add_by' => $user_add_by,
            ]);
            $user_id = $User->get_user_id_by_reference_number($_POST['user_reference_number']);
            DB::table('user_details')
                ->where('user_id', $user_id)
                ->update([
                'user_bank_name' => $user_bank_name,
                'user_bank_number' => $user_bank_number,
                'user_IFSC_code' => $user_IFSC_code,
                'user_bank_branch' => $user_bank_branch,
                'user_paytm_number' => $user_paytm_number,
                'user_phone_pay_number' => $user_phone_pay_number,
                'user_google_pay_number' => $user_google_pay_number,
                'user_details_add_date' => time(),
                'user_details_modify_by' => $user_id,
            ]);
            $BSPController->send_response_api(200, 'User added successfully please contact to admin', $user_id);
        } else {
            $BSPController->send_response_api(400, 'Invalid Request.', '');
        }
    }

    public function memberList()
    {
        return response()
            ->view('member.member-list');
    }

    public function user_list_post(Request $request)
    {
        $user = new User();
        $columns = array(
            0 => 'id',
            1 => 'user_name',
            2 => 'user_unique_id',
            3 => 'user_mobile',
            4 => 'user_city',
            5 => 'user_reference_number',
            6 => 'user_status',
            7 => 'id'
        );

        $total = DB::table('users')
            ->Where('user_role_name', '!=', 'Admin')
            ->count();
        $totalData = $total;
        $totalFiltered = $total;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        if (empty($search)) {
            $posts = $user->getUserList($start, $limit, $order, $dir);
        } else {

            $posts = $user->getUserList($start, $limit, $order, $dir, $search);
            $totalFiltered = count($posts);
        }
        $data = array();
        if (!empty($posts)) {

            foreach ($posts as $post) {
                $get_help_count = $user->get_help_count($post->id);
                $paid_help_count = $user->paid_help_count($post->id);
                $status = "<a class='font-green-sharp' onclick='status_change({$post->id},&#39{$post->user_status}&#39);' title='Status' ><span>" . $post->user_status . "</span></a>";
                if(isset($post->entry_fees) && !empty($post->entry_fees)){
                    $fees_status = "<span class='badge badge-success'>Paid</span>";
                }else{
                    $fees_status = "<span class='badge badge-danger'>Pending</span>";
                }
                $show = route('user_view', $post->id);
                $edit = route('user_edit', $post->id);
                $get_help_button = '';
                $paid_help_button = '';
//                if ($post->user_status == 'Active') {
//                    if ($get_help_count == 0) {
//                        $get_help_button = "<button class='btn btn-primary waves-effect waves-light model-getHelp' data-target='#modelGetHelp' data-toggle='modal' data-id='$post->id' data-help='Get'>Assign get Help</button>";
//                    }
//                    if ($paid_help_count < 3) {
//                        $paid_help_button = "<button class='btn btn-primary waves-effect waves-light model-paidHelp' data-target='#modelPaidHelp' data-toggle='modal' data-id='$post->id' data-help='Paid'>Assign Paid Help</button>";
//                    }
//                }
                $edit_view = "<a href='{$show}' title='View' ><i class='font-green-sharp fa fa-eye-slash'></i> </a>";
                $nestedData['id'] = $post->id;
                $nestedData['user_name'] = $post->user_name;
                $nestedData['user_unique_id'] = $post->user_unique_id;
                $nestedData['user_mobile'] = $post->user_mobile;
                $nestedData['user_city'] = $post->user_city;
                $nestedData['user_reference_number'] = $post->user_reference_number;
                $nestedData['user_status'] = "{$status}";
                $nestedData['user_fees_status'] ="{$fees_status}";
                $nestedData['action'] = "{$edit_view}
                                          &emsp;<a href='{$edit}' title='EDIT' ><i class='font-green-sharp fa fa-pencil-square-o'></i></a>&emsp;{$get_help_button} {$paid_help_button}";
                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }

    public function change_user_status()
    {
        $BSPController = new BSPController();
        if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['status']) && !empty($_POST['status'])) {
            $id = $_POST['id'];

            if ($_POST['status'] === 'Active') {
                $status = 'Inactive';
            } else {
                $status = 'Active';
            }

            $user_data = DB::table('users')
                ->where('id', $id)
                ->update(['user_status' => $status
                ]);
            $check_fees_status =DB::table('user_details')
                ->where('user_id', $id)
                ->value('user_details_amount');
            if(isset($check_fees_status) && empty($check_fees_status) && $status =='Active'){
                $site_settings = DB::table('site_setting')->orderBy('ss_id','desc')->get();
                $user_data = DB::table('user_details')
                    ->where('user_id', $id)
                    ->update([
                        'user_details_amount' => $site_settings[0]->ss_total_amount,
                        'donation_fees' => $site_settings[0]->ss_donation,
                        'entry_fees' => $site_settings[0]->ss_entry_fees,
                        'discount' => $site_settings[0]->ss_discount,
                        'discount_amount' => $site_settings[0]->ss_discount_amount,
                        'user_details_payment_date' => time(),
                    ]);
                $user_unique_id_details =DB::table('users')
                    ->select('user_unique_id','user_mobile')
                    ->where('id', $id)
                    ->get();

                $user_details['user_unique_id'] = $user_unique_id_details[0]->user_unique_id;
                $user_details['user_mobile'] =  $user_unique_id_details[0]->user_mobile;
                $user_details['redirect_url'] = env('APP_URL').'user_create_success/'. $user_unique_id_details[0]->user_unique_id.'/'.$user_unique_id_details[0]->user_mobile;
            }else{
                $user_details['user_unique_id'] = '';
                $user_details['user_mobile'] = '';
                $user_details['redirect_url'] = '';
            }
            if ($user_data) {
                $BSPController->send_response_api(200, 'Status is ' . $status, $user_details);
            } else {
                $BSPController->send_response_api(400, 'Status Can not be updated..', '');
            }
        } else {
            $BSPController->send_response_api(400, 'Invalid Request.', '');
        }
    }
    public function send_sms_by_mobile()
    {
        $BSPController = new BSPController();
        if (isset($_POST['u_id']) && !empty($_POST['u_id']) && isset($_POST['mobile']) && !empty($_POST['mobile'])) {
            $u_id = $_POST['u_id'];
            $password =DB::table('users')
                ->where('user_unique_id', $u_id)
                ->value('password');
            $user_mobile = $_POST['mobile'];
            $message = "Your password is $password. and username is $u_id";
           // $BSPController->send_sms($user_mobile,$message);
            $BSPController->send_response_api(200, 'Send sms to user mobile number','');

        } else {
            $BSPController->send_response_api(400, 'Invalid Request.', '');
        }
    }

    /*display User details page*/
    public function user_view($id)
    {
        $Users = new User();
        $user_data = $Users->get_user_details_by_user_id($id);
        if (isset($user_data[0]->user_image) && !empty($user_data[0]->user_image)) {
            $user_data[0]->user_image_url = env('APP_URL') . 'public/user_image/' . $user_data[0]->user_image;
        } else {
            $user_data[0]->user_image_url = env('APP_URL') . 'public/assets/images/users/avatar-1.jpg';
        }
        if (isset($user_data[0]->user_details_image) && !empty($user_data[0]->user_details_image)) {
            $user_data[0]->user_details_image_url = env('APP_URL') . 'public/user_amount_proof/' . $user_data[0]->user_details_image;
        } else {
            $user_data[0]->user_details_image_url = '';
        }

        return response()
            ->view('member.user-view', ['user_data' => $user_data[0]]);

    }

    public function user_view_api()
    {
        $Users = new User();
        $BSPController = new BSPController();
        $user_data = $Users->get_user_details_by_user_id($_POST['user_id']);
        if (isset($user_data[0]->user_image) && !empty($user_data[0]->user_image)) {
            $user_data[0]->user_image_url = env('APP_URL') . 'public/user_image/' . $user_data[0]->user_image;
        } else {
            $user_data[0]->user_image_url = env('APP_URL') . 'public/assets/images/users/avatar-1.jpg';
        }
        $BSPController->send_response_api(200, 'Success ', $user_data[0]);
    }
    /*start insert admin details*/


    /*end user details*/
    public function user_edit($id)
    {
        $Users = new User();
        $user_data = $Users->get_user_details_by_user_id($id);
        if (isset($user_data[0]->user_image) && !empty($user_data[0]->user_image)) {
            $user_data[0]->user_image_url = env('APP_URL') . 'public/user_image/' . $user_data[0]->user_image;
        } else {
            $user_data[0]->user_image_url = env('APP_URL') . 'public/assets/images/users/avatar-1.jpg';
        }
        //dd($user_data);
        return response()->view('member.user-edit', ['user_data' => $user_data[0]]);
    }

    public function userImageUpload()
    {
        $BSPController = new BSPController();
        $uploadedFile = '';
        $user_image_array = [];
        if (!empty($_FILES["user_image"]["type"])) {
            $fileName = time() . '_' . $_FILES['user_image']['name'];
            $valid_extensions = array("jpeg", "jpg", "png");
            $temporary = explode(".", $_FILES["user_image"]["name"]);
            $file_extension = end($temporary);
            if ((($_FILES["user_image"]["type"] == "image/png") || ($_FILES["user_image"]["type"] == "image/jpg") || ($_FILES["user_image"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)) {
                $sourcePath = $_FILES['user_image']['tmp_name'];
                $targetPath = "public/user_image/" . $fileName;
                if (move_uploaded_file($sourcePath, $targetPath)) {
                    $uploadedFile = $fileName;
                    $user_image_array['image_name'] = $uploadedFile;
                    $user_image_array['image_url'] = env('APP_URL') . "public/user_image/" . $fileName;
                    $BSPController->send_response_api(200, 'Image Uploaded', $user_image_array);
                } else {
                    $BSPController->send_response_api(400, 'Image not uploaded.', '');
                }
            } else {
                $BSPController->send_response_api(400, 'Image not uploaded.', '');
            }
        } else {
            $BSPController->send_response_api(400, 'Image not uploaded.', '');
        }
    }

    public function add_fees_details()
    {

        $user_id = $_POST['user_id'];
        $uploadedFile = '';
        if (!empty($_FILES["user_details_image"]["type"])) {
            $fileName = time() . '_' . $_FILES['user_details_image']['name'];
            $valid_extensions = array("jpeg", "jpg", "png");
            $temporary = explode(".", $_FILES["user_details_image"]["name"]);
            $file_extension = end($temporary);
            if ((($_FILES["user_details_image"]["type"] == "image/png") || ($_FILES["user_details_image"]["type"] == "image/jpg") || ($_FILES["user_details_image"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)) {
                $sourcePath = $_FILES['user_details_image']['tmp_name'];
                $targetPath = "public/user_amount_proof/" . $fileName;
                if (move_uploaded_file($sourcePath, $targetPath)) {
                    $uploadedFile = $fileName;
                } else {
                    return Redirect::back()->withErrors(['msg', 'Image not uploaded.']);
                }
            } else {
                return Redirect::back()->withErrors(['msg', 'Image not uploaded.']);
            }
        }
        if ($_POST['user_details_amount'] && !empty($_POST['user_details_amount'])) {
            $user_details_by = '';
            if (isset($_POST['user_details_by']) && !empty($_POST['user_details_by'])) {
                $user_details_by = $_POST['user_details_by'];
            }
            $payment_date = time();
            DB::table('user_details')
                ->where('user_id', $user_id)
                ->update([
                    'user_details_amount' => $_POST['user_details_amount'],
                    'user_details_image' => $uploadedFile,
                    'user_details_payment_date' => $payment_date,
                    'user_details_by' => $user_details_by,
                    'user_details_modify_date' => $payment_date,
                    'user_details_modify_by' => $_POST['user_details_by']
                ]);
            $fees_id = DB::table('fees_details')->insertGetId([
                'fees_amount' => $_POST['user_details_amount'],
                'fees_date' => $payment_date,
                'fees_by' => $user_details_by,
                'fees_image' => $uploadedFile,
                'fees_user_id' => $user_id,
                'fees_add_date' => $payment_date,
                'fees_add_by' => $_POST['user_details_by'],
            ]);
            return Redirect::back();
        }
    }

    public function get_paid_user_list()
    {
        $user = new User();
        $BSPController = new BSPController();
        if (isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['get_help']) && !empty($_POST['get_help'])) {
            $user_id = $_POST['user_id'];
            if ($_POST['get_help'] == 'Get') {
                $user_data = $user->get_get_user_list($user_id);
            } else {
                $user_data = $user->get_paid_user_list($user_id);
            }

            if ($user_data) {
                $BSPController->send_response_api(200, 'Success', $user_data);
            } else {
                $BSPController->send_response_api(400, 'Invalid Request', '');
            }
        } else {
            $BSPController->send_response_api(400, 'Invalid Request.', '');
        }
    }

}