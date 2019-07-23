<?php
/**
 * Created by PhpStorm.
 * User: vidhi_BSP
 * Date: 7/22/2019
 * Time: 6:00 PM
 */
?>
<?php
$login_data = Session::get('login_data');
?>
@extends('includes.base')

@section('seo-tag')
    <title>Man Help Send SMS</title>
@endsection

@section('header-pages-include')
    <link href="{{env('APP_URL')}}public/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <!-- form Uploads -->
    <link href="{{env('APP_URL')}}public/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" type="text/css"/>
@endsection
@section('page-title')
    <h4 class="page-title float-left">Send SMS</h4>
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
                    <div class="col-lg-12 text-center mobile">
                        <div class="check"><i class="fa fa-check" style="font-size: 180px;color:#4BB543;"></i></div>
                        <input type="hidden" id="mobile" value="{{$mobile}}">
                        <input type="hidden" id="u_id" value="{{$u_id}}">

                        <h3 style="margin-top:20px !important;">Thank you for create new user.</h3>

                        <p>You are send sms to user by clicking send sms button.</p>

                        <div style="margin-top: 2%;" class="text-center">

                            <button class="btn btn-success waves-effect waves-light" onclick="send_sms();">Send SMS
                            </button>
                        </div>
                    </div>

                </div>
                <!-- end row -->


            </div>
            <!-- container -->

        </div>
        <!-- content -->


    </div>
    <!-- End content-page -->


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->

@endsection
@section('footer-pages-include')
    <script src="{{env('APP_URL')}}public/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script>

        function send_sms() {
            var u_id = $('#u_id').val();
            var mobile = $('#mobile').val();
            $.ajax({
                url: '<?php echo route('send_sms_by_mobile');?>',
                method: 'POST',
                data: {
                    'u_id': u_id,
                    'mobile': mobile,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (response) {
                    var obj = jQuery.parseJSON(response)
                    //console.log($obj);
                    if (obj.STATUS_CODE == 200) {
                        Swal.fire({
                            type: 'success',
                            title: 'Message send!',
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
    </script>

@endsection
