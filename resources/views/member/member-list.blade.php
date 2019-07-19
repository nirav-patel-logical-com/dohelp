<?php
/**
 * Created by PhpStorm.
 * User: vidhi_BSP
 * Date: 7/18/2019
 * Time: 11:47 AM
 */
$login_data = Session::get('login_data');
?>
@extends('includes.base')

@section('seo-tag')
    <title>Man Help Member List</title>
@endsection

@section('header-pages-include')
    <!-- DataTables -->
    <link href="{{env('APP_URL')}}public/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{env('APP_URL')}}public/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
    <!-- Plugins css-->
    <link href="{{env('APP_URL')}}public/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>

@endsection
@section('page-title')
    <h4 class="page-title float-left">Member List</h4>
@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card-box table-responsive">

                            <table id="post" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>User Name</th>
                                    <th>Unique Id</th>
                                    <th>Mobile</th>
                                    <th>City</th>
                                    <th>Reference Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div> <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->
        <!-- Modal -->
        <div class="modal fade" id="modelGetHelp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1>Get User</h1>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <select id='myGetUser' class="form-control select2">
                            </select>
                            <ul class="parsley-errors-list filled"><li class="parsley-required" id="label_myGetUser"></li></ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-success waves-effect waves-light" type="button" id="submitBtnGetAssign">Assign</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content-page -->
        <!-- Modal -->
        <div class="modal fade" id="modelPaidHelp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1>Paid User </h1>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <select id='myPaidUser' class="form-control select2">
                            </select>
                            <ul class="parsley-errors-list filled"><li class="parsley-required" id="label_myPaidUser"></li></ul>
                        </div>

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-success waves-effect waves-light" type="button" id="submitBtnPaidAssign">Assign</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content-page -->


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->

@endsection
@section('footer-pages-include')
    <!-- Required datatable js -->
    <script src="{{env('APP_URL')}}public/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{env('APP_URL')}}public/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{env('APP_URL')}}public/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="{{env('APP_URL')}}public/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>

    <script src="{{env('APP_URL')}}public/plugins/select2/js/select2.full.min.js"></script>

    <script>
        $(document).ready(function () {
            //$('#post').DataTable();
            $('#post').DataTable({
                //"processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo route('user_list_post'); ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        '_token': '<?php echo csrf_token(); ?>'
                    }

                },
                "columns": [
                    {"data": "id"},
                    {"data": "user_name"},
                    {"data": "user_unique_id"},
                    {"data": "user_mobile"},
                    {"data": "user_city"},
                    {"data": "user_reference_number"},
                    {"data": "user_status"},
                    {"data": "action"}
                ]

            });
        });
    </script>
    <script>
        function status_change(id, status) {
            $.ajax({
                url: 'api/change_user_status',
                method: 'POST',
                data: {
                    'id': id,
                    'status': status,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (response) {
                    var obj = jQuery.parseJSON(response)
                    //console.log($obj);
                    if (obj.STATUS_CODE == 200) {
                        Swal.fire({
                            type: 'success',
                            title: 'Status Change!',
                            text: obj.MESSAGE,
                            timer: 1500
                        })
                        window.location = '<?php echo route('memberList');?>';
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Status Change!',
                            text: obj.MESSAGE
                        })
                    }
                }
            });
        }
        $(document).on('click','.model-getHelp', function(event){
            $('#modelGetHelp #myGetUser').empty();
            var dataId = $(this).attr("data-id");
            var dataHelp = $(this).attr("data-help");
            $('#modelGetHelp #new_id').html(dataId +'Help ::'+ dataHelp);
            $.ajax({
                url: '{{route('get_paid_user_list')}}',
                method: 'POST',
                data: {
                    'user_id': dataId,
                    'get_help': dataHelp,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (response) {
                    var obj = jQuery.parseJSON(response);
                    for (var field in obj['DATA']) {
                        $('<option value="'+ obj['DATA'][field].id +'">' + obj['DATA'][field].user_name + '</option>').appendTo('#modelGetHelp #myGetUser');
                    }
                }
            });
        });
        $(document).on('click','.model-paidHelp', function(event){
            $('#modelPaidHelp #myPaidUser').empty(); // <<<<<< No more issue here
            var dataId = $(this).attr("data-id");
            var dataHelp = $(this).attr("data-help");
            $('#modelPaidHelp #new_id').html(dataId +'Help ::'+ dataHelp);
            $.ajax({
                url: '{{route('get_paid_user_list')}}',
                method: 'POST',
                data: {
                    'user_id': dataId,
                    'get_help': dataHelp,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (response) {
                    var obj = jQuery.parseJSON(response);
                    for (var field in obj['DATA']) {
                        $('<option value="'+ obj['DATA'][field].id +'">' + obj['DATA'][field].user_name + '</option>').appendTo('#modelPaidHelp #myPaidUser');
                    }
                }
            });
        });

        $("#submitBtnPaidAssign").click(function(){

            var myPaidUser = $("#myPaidUser").val();

            var scroll_element = '';
            var flag = 0;
            if (myPaidUser == '') {
                $("#myPaidUser").addClass('parsley-error');
                $("#label_myPaidUser").html("Please Enter Mobile Number.");
                flag++;
                if (scroll_element == '') {
                    scroll_element = 'myPaidUser';
                }
            }
           else{
                $("#myPaidUser").removeClass('parsley-error');
                $("#label_myPaidUser").html("");
            }


            if(flag==0){

                $.ajax({
                    url: '<?php echo route('GetPaidAssignAction'); ?>',
                    type: 'POST',
                    data: {
                        'assign_id': myPaidUser,
                        'type': 'Paid',
                        'user_add_by': '<?php echo $login_data[0]->id ?>',
                        '_token': '<?php echo csrf_token();?>'
                    },
                    success: function (response) {

                        var obj = jQuery.parseJSON(response)
                        if (obj.STATUS_CODE == 200) {
                            Swal.fire({
                                type: 'success',
                                title: 'Success!',
                                text: obj.MESSAGE,
                                timer: 1500
                            })
                            window.location = '<?php echo route('memberList');?>';
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'Failed!',
                                text: obj.MESSAGE
                            })
                        }
                    }
                });

            }
        });
        $("#submitBtnGetAssign").click(function(){

            var myGetUser = $("#myGetUser").val();

            var scroll_element = '';
            var flag = 0;
            if (myGetUser == '') {
                $("#myGetUser").addClass('parsley-error');
                $("#label_myGetUser").html("Please Enter Mobile Number.");
                flag++;
                if (scroll_element == '') {
                    scroll_element = 'myPaidUser';
                }
            }
            else{
                $("#myGetUser").removeClass('parsley-error');
                $("#label_myGetUser").html("");
            }


            if(flag==0){

                $.ajax({
                    url: '<?php echo route('GetPaidAssignAction'); ?>',
                    type: 'POST',
                    data: {
                        'assign_id': myGetUser,
                        'type': 'Get',
                        'user_add_by': '<?php echo $login_data[0]->id ?>',
                        '_token': '<?php echo csrf_token();?>'
                    },
                    success: function (response) {

                        var obj = jQuery.parseJSON(response)
                        if (obj.STATUS_CODE == 200) {
                            Swal.fire({
                                type: 'success',
                                title: 'Success!',
                                text: obj.MESSAGE,
                                timer: 1500
                            })
                            window.location = '<?php echo route('memberList');?>';
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'Failed!',
                                text: obj.MESSAGE
                            })
                        }
                    }
                });

            }
        });
    </script>
@endsection
