<?php
/**
 * Created by PhpStorm.
 * User: vidhi_BSP
 * Date: 7/17/2019
 * Time: 6:12 PM
 */

namespace App\Http\Controllers;


use App\User;

class DashboardController extends Controller{

    public function dashboard()
    {
            return response()
                ->view('dashboard.dashboard');

    }

    public function dashboardAPI(){
        $User =new User();
        $dashboard_data =[];
        $BSPController =new BSPController();
        $user_id = $_POST['user_id'];
        $user_details = $User->get_user_details_for_dashboard($user_id);
        if(isset($user_details[0]->user_image) && !empty($user_details[0]->user_image)){
            $user_details[0]->user_image_url = env('APP_URL').'public/user_image/'.$user_details[0]->user_image;
        }else{
            $user_details[0]->user_image_url = env('APP_URL').'public/assets/images/users/avatar-1.jpg';
        }
        $dashboard_data['user_details']=$user_details;

        if(isset($dashboard_data) && !empty($dashboard_data)){
            $BSPController->send_response_api(200, 'Record Found', $dashboard_data);
        }else{
            $BSPController->send_response_api(202, 'No Record Found', '');
        }
    }

}