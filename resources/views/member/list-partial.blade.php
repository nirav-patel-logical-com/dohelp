<?php
/**
 * Created by PhpStorm.
 * User: vidhi_BSP
 * Date: 7/19/2019
 * Time: 3:31 PM
 */
$data = array();
if (!empty($posts)) {

    foreach ($posts as $post) {
        $status = "<a class='font-green-sharp' onclick='status_change({$post->id},&#39{$post->user_status}&#39);' title='Status' ><span>" . $post->user_status . "</span></a>";
        $show = route('user_view', $post->id);
        $edit = route('user_edit', $post->id);
        $edit_view ="<a href='{$show}' title='View' ><i class='font-green-sharp fa fa-eye-slash'></i> </a>";
        $get_help_button ="<button class='btn btn-primary waves-effect waves-light' data-toggle='modal' data-id='$post->id' data-help='Get'>Assign get Help</button>";
        $paid_help_button ="<button class='btn btn-primary waves-effect waves-light' data-toggle='modal' data-id='$post->id' data-help='Paid'>Assign Paid Help</button>";
        $nestedData['id'] = $post->id;
        $nestedData['user_name'] = $post->user_name;
        $nestedData['user_unique_id'] = $post->user_unique_id;
        $nestedData['user_mobile'] = $post->user_mobile;
        $nestedData['user_city'] = $post->user_city;
        $nestedData['user_reference_number'] = $post->user_reference_number;
        $nestedData['user_status'] =  "{$status}";
        $nestedData['action'] = "{$get_help_button} {$paid_help_button}&emsp;{$edit_view}
                                          &emsp;<a href='{$edit}' title='EDIT' ><i class='font-green-sharp fa fa-pencil-square-o'></i></a>";
        $data[] = $nestedData;

    }
}
?>