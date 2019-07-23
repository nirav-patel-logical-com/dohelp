<?php
/**
 * Created by PhpStorm.
 * User: vidhi_BSP
 * Date: 7/17/2019
 * Time: 6:12 PM
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller{

    public function dashboard()
    {
        $User =new User();
        $dashboard_data =[];
        $BSPController =new BSPController();
        $login_data = Session::get('login_data');
        $user_details = $User->get_user_details_for_admin_dashboard($login_data[0]->id);
        if(isset($user_details[0]->user_image) && !empty($user_details[0]->user_image)){
            $user_details[0]->user_image_url = env('APP_URL').'public/user_image/'.$user_details[0]->user_image;
        }else{
            $user_details[0]->user_image_url = env('APP_URL').'public/assets/images/users/avatar-1.jpg';
        }
        $user_list = $User->get_user_list_for_dashboard(10);
        $dashboard_data['user_details']=$user_details;
        $dashboard_data['user_list']=$user_list;
        return response()
                ->view('dashboard.dashboard',$dashboard_data);

    }
    public function dashboardAction()
    {
        $User =new User();
        $dashboard_data =[];
        $BSPController =new BSPController();
        $user_id = $_POST['user_id'];
        $date_range_start ='';
        $date_range_end ='';
        if(isset($_POST['date_range_start']) && !empty($_POST['date_range_start'])){
            $date_range_start = strtotime($_POST['date_range_start']);
            $date_range_end = strtotime($_POST['date_range_end']);
        }
        $total_active_member_count = DB::table('users')
            ->Where('user_status', 'Active')
            ->Where('user_role_name','!=','Admin')
            ->WhereBetween('user_add_date', [$date_range_start, $date_range_end])
            ->count();
        $total_inactive_member_count = DB::table('users')
            ->Where('user_status', 'Inactive')
            ->Where('user_role_name','!=','Admin')
            ->WhereBetween('user_add_date', [$date_range_start, $date_range_end])
            ->count();
        $total_member_count = DB::table('users')
            ->Where('user_role_name','!=','Admin')
            ->WhereBetween('user_add_date', [$date_range_start, $date_range_end])
            ->count();
        $fees_pending =DB::table('user_details')
            ->Where('user_details_amount','>',0)
            ->WhereBetween('user_details_add_date', [$date_range_start, $date_range_end])
            ->count();
        $dashboard_data['total_active_member_count']=$total_active_member_count;
        $dashboard_data['total_inactive_member_count']=$total_inactive_member_count;
        $dashboard_data['total_member_count']=$total_member_count;
        $dashboard_data['fees_pending']=$fees_pending;
        //dd($dashboard_data);
        $BSPController->send_response_api(200, 'Success', $dashboard_data);
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