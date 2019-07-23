<?php
/**
 * Created by PhpStorm.
 * User: vidhi_BSP
 * Date: 7/19/2019
 * Time: 3:59 PM
 */

namespace App\Http\Controllers;


use App\Help;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HelpController extends Controller{

    public function getHelp(){
        return view('get-help.get-help');
    }

//    public function get_help_list_post(Request $request){
//        $Help = new Help();
//        $columns = array(
//            0 => 'id',
//            1 => 'user_name',
//            2 => 'user_mobile',
//            3 => 'user_city',
//            4 => 'fee_status',
//            5 => 'get_help',
//            6 => 'status',
//            7 => 'action'
//        );
//
//        $total =DB::table('users')
//            ->Where('user_role_name','!=','Admin')
//            ->count();
//        $totalData = $total;
//        $totalFiltered = $total;
//
//        $limit = $request->input('length');
//        $start = $request->input('start');
//        $order = $columns[$request->input('order.0.column')];
//        $dir = $request->input('order.0.dir');
//        $search = $request->input('search.value');
//
//        if (empty($search)) {
//            $posts = $Help->get_help_list_post($start, $limit, $order, $dir);
//        } else {
//
//            $posts = $Help->get_help_list_post($start, $limit, $order, $dir, $search);
//            $totalFiltered = count($posts);
//        }
//        $data = array();
//        if (!empty($posts)) {
//
//            foreach ($posts as $post) {
//                $status = "<a class='font-green-sharp' onclick='status_change({$post->id},&#39{$post->user_status}&#39);' title='Status' ><span>" . $post->user_status . "</span></a>";
//                $show = route('user_view', $post->id);
//                $edit = route('user_edit', $post->id);
//                $edit_view ="<a href='{$show}' title='View' ><i class='font-green-sharp fa fa-eye-slash'></i> </a>";
//                $get_help_button ="<button class='btn btn-primary waves-effect waves-light' data-toggle='modal' data-id='$post->id' data-help='Get'>Assign get Help</button>";
//                $paid_help_button ="<button class='btn btn-primary waves-effect waves-light' data-toggle='modal' data-id='$post->id' data-help='Paid'>Assign Paid Help</button>";
//                $nestedData['id'] = $post->id;
//                $nestedData['user_name'] = $post->user_name;
//                $nestedData['user_unique_id'] = $post->user_unique_id;
//                $nestedData['user_mobile'] = $post->user_mobile;
//                $nestedData['user_city'] = $post->user_city;
//                $nestedData['user_reference_number'] = $post->user_reference_number;
//                $nestedData['user_status'] =  "{$status}";
//                $nestedData['action'] = "{$get_help_button} {$paid_help_button}&emsp;{$edit_view}
//                                          &emsp;<a href='{$edit}' title='EDIT' ><i class='font-green-sharp fa fa-pencil-square-o'></i></a>";
//                $data[] = $nestedData;
//
//            }
//        }
//
//        $json_data = array(
//            "draw" => intval($request->input('draw')),
//            "recordsTotal" => intval($totalData),
//            "recordsFiltered" => intval($totalFiltered),
//            "data" => $data
//        );
//
//        echo json_encode($json_data);
//    }

    public function GetPaidAssignAction(){
        $user = new User();
        $BSPController = new BSPController();
        if (isset($_POST['assign_id']) && !empty($_POST['assign_id']) && isset($_POST['type']) && !empty($_POST['type'])) {
            $fess_id =DB::table('fees_details')
                    ->WHERE('fees_user_id',$_POST['assign_id'])
                    ->value('fees_id');
            if ($_POST['type'] == 'Get') {
                $id = DB::table('get_help')->insertGetId([
                    'status' => 'Pending',
                    'assign_id' => $_POST['assign_id'],
                    'date' => time(),
                    'Id_proof' => '',
                    'fess_id' => $fess_id,
                    'amount' => '7000',
                    'add_date' => time(),
                    'add_by' => $_POST['user_add_by'],
                ]);
            } else {
                $id = DB::table('paid_help')->insertGetId([
                    'status' => 'Pending',
                    'assign_id' => $_POST['assign_id'],
                    'date' => time(),
                    'Id_proof' => '',
                    'amount' => '7000',
                    'fess_id' => $fess_id,
                    'add_date' => time(),
                    'add_by' => $_POST['user_add_by'],
                ]);
            }

            if ($id) {
                $BSPController->send_response_api(200, 'Assign User for' .$_POST["type"]. 'Help', $id);
            } else {
                $BSPController->send_response_api(400, 'Invalid Request', '');
            }
        } else {
            $BSPController->send_response_api(400, 'Invalid Request.', '');
        }
    }

    public function GetHelpList(){
        $Help = new Help();
        $BSPController = new BSPController();
        if (isset($_POST['last_id']) && !empty($_POST['last_id'])) {
            $start = $_POST['last_id'];
        } else {
            $get_max_id = DB::table('get_help')->latest('help_id')->first();
            if (isset($get_max_id) && !empty($get_max_id)) {
                $start = intval($get_max_id->id) + 1;
            } else {
                $start = 0;
            }
        }
        $limit = 10;
        $help_list= $Help->get_help_list($start, $limit);
        if (isset($user_list) && !empty($user_list)) {
            $BSPController->send_response_api(200, 'Record Found', $help_list);
        } else {
            $BSPController->send_response_api(202, 'No Record Found', '');
        }
    }

    public function PaidHelpList(){
        $Help = new Help();
        $BSPController = new BSPController();
        if (isset($_POST['last_id']) && !empty($_POST['last_id'])) {
            $start = $_POST['last_id'];
        } else {
            $get_max_id = DB::table('paid_help')->latest('paid_id')->first();
            if (isset($get_max_id) && !empty($get_max_id)) {
                $start = intval($get_max_id->id) + 1;
            } else {
                $start = 0;
            }
        }
        $limit = 10;
        $help_list= $Help->paid_help_list($start, $limit);
        if (isset($user_list) && !empty($user_list)) {
            $BSPController->send_response_api(200, 'Record Found', $help_list);
        } else {
            $BSPController->send_response_api(202, 'No Record Found', '');
        }
    }
}