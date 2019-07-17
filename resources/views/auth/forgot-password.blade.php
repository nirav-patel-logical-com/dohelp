<?php
/**
 * Created by PhpStorm.
 * User: vidhi_BSP
 * Date: 7/17/2019
 * Time: 6:30 PM
 */?>

@extends('includes.base_account')

@section('seo-tag')
    <title>Man Help</title>
@endsection

@section('header-pages-include')
    <!-- Sweet Alert css -->
    <link href="{{env('APP_URL')}}public/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="account-pages"></div>
    <div class="clearfix"></div>
    <div class="wrapper-page">

        <div class="account-bg">
            <div class="card-box mb-0">
                <div class="text-center m-t-20">
                    <a href="#" class="logo">
                        <img src="{{env('APP_URL')}}public/assets/images/logo/man-help_01Logo.jpg" height="60px">
                    </a>
                </div>
                <div class="m-t-10 p-20">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h6 class="text-muted text-uppercase mb-0 m-t-0">Reset Password</h6>
                            <p class="text-muted m-b-0 font-13 m-t-20">Enter your Mobile number and we'll send you an sms with instructions to reset your password.  </p>
                        </div>
                    </div>
                    <form class="m-t-20" id="myLoginForm">
                        @csrf
                        <div class="form-group row"  id="div_user_phone">
                            <div class="col-12">
                                <input class="form-control" type="text" id="user_mobile" placeholder="Mobile" onkeyup="BSP.only('digit','user_mobile')">
                                <ul class="parsley-errors-list filled"><li class="parsley-required" id="label_user_phone"></li></ul>
                            </div>
                        </div>

                        <div class="form-group text-center row m-t-10">
                            <div class="col-12">
                                <button class="btn btn-success btn-block waves-effect waves-light" type="button" id="submitBtnForgotPassword">Send SMS
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- end card-box-->
        <div class="m-t-20">
            <div class="text-center">
                <p class="text-white">Return to<a href="{{route('login')}}" class="text-white m-l-5"><b>Sign In</b></p>
            </div>
        </div>
    </div>
    <!-- end wrapper page -->
@endsection

@section('footer-pages-include')
    <!-- Sweet Alert js -->
    <script src="{{env('APP_URL')}}public/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    {{--<script src="{{env('APP_URL')}}public/assets/pages/jquery.sweet-alert.init.js"></script>--}}
    <script>
        $(document).ready(function(){
            $("#submitBtnForgotPassword").click(function(){
                var mobile_no_regx = BSP.regx('mobile');
                var user_mobile = $("#user_mobile").val();
                var scroll_element = '';
                var flag = 0;
                if (user_mobile == '') {
                    $("#user_mobile").addClass('parsley-error');
                    $("#label_user_phone").html("Please Enter Mobile Number.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'user_mobile';
                    }
                }
                else if(!mobile_no_regx.test(user_mobile))
                {
                    $("#user_mobile").addClass('parsley-error');
                    $("#label_user_phone").html("Mobile number length should be enter 4 to 12 digits.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'user_mobile';
                    }
                }else{
                    $("#user_mobile").removeClass('parsley-error');
                    $("#label_user_phone").html("");
                }

                if(flag==0){
                    $.ajax({
                        url: '<?php echo route('recoveryPasswordAction'); ?>',
                        type: 'POST',
                        data: {
                            'user_mobile': user_mobile,
                            'user_mobile_country_code': '+91',
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
                                window.location = '<?php echo route('login');?>';
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
        });
    </script>
@endsection

