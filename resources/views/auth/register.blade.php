<?php
/**
 * Created by PhpStorm.
 * User: vidhi_BSP
 * Date: 7/17/2019
 * Time: 6:52 PM
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
                            <h6 class="text-muted text-uppercase m-b-0 m-t-0">Sign Up</h6>
                        </div>
                    </div>
                    <form class="m-t-20" id="myLoginForm">
                        @csrf
                        <!---Hidden Text Field--->
                        <input type="hidden" name="ref_number" value="{{$id}}">
                        <!---Hidden Text Field--->
                        <div class="form-group row">
                            <div class="col-12">
                                <h4 class="header-title m-t-0">Basic Details</h4>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="text" id="user_name"  placeholder="Full Name">
                                <ul class="parsley-errors-list filled"><li class="parsley-required" id="label_user_name"></li></ul>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="text" id="user_mobile" placeholder="Mobile" onkeyup="BSP.only('digit','user_mobile')">
                                <ul class="parsley-errors-list filled"><li class="parsley-required" id="label_user_phone"></li></ul>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="text"  id="user_city" placeholder="City" name="user_city">
                                <ul class="parsley-errors-list filled"><li class="parsley-required" id="label_user_city"></li></ul>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <h4 class="header-title m-t-0">Bank Details</h4>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="text" name="user_bank_name" placeholder="Bank Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="text" name="user_bank_account_number" required="" placeholder="A/c No.">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="text" name="user_bank_IFAC_code" required="" placeholder="IFSC Code">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" name="bank_branch" type="text" required="" placeholder="Bank Branch">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <h4 class="header-title m-t-0">Payment Wallet Details</h4>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="text" name="paytem_number" placeholder="PayTM Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="text" name="phone_pay_number" placeholder="Phone Pay Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="text" name="google_pay_number" placeholder="Google Pay Number">
                            </div>
                        </div>

                        <div class="form-group text-center row m-t-10">
                            <div class="col-12">
                                <button class="btn btn-success btn-block waves-effect waves-light" type="button" id="submitBtnJoinNow">Join Now
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
                <p class="text-white">Already have account? <a href="{{route('login')}}" class="text-white m-l-5"><b>Sign In</b> </a></p>
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
            $("#submitBtnJoinNow").click(function(){
                var mobile_no_regx = BSP.regx('mobile');
                var user_mobile = $("#user_mobile").val();
                var user_name = $("#user_name").val();
                var user_city = $("#user_city").val();
                var user_bank_name = $("#user_bank_name").val();
                var user_bank_account_number = $("#user_bank_account_number").val();
                var user_bank_IFAC_code = $("#user_bank_IFAC_code").val();
                var bank_branch = $("#bank_branch").val();
                var paytem_number = $("#paytem_number").val();
                var phone_pay_number = $("#phone_pay_number").val();
                var google_pay_number = $("#google_pay_number").val();

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

                if (user_name == '') {
                    $("#user_name").addClass('parsley-error');
                    $("#label_user_name").html("Please Enter Full Name.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'user_name';
                    }
                }
                else {
                    $("#user_name").removeClass('parsley-error');
                    $("#label_user_name").html("");
                }

                if (user_city == '') {
                    $("#user_city").addClass('parsley-error');
                    $("#label_user_city").html("Please Enter City Name.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'user_city';
                    }
                }
                else {
                    $("#user_city").removeClass('parsley-error');
                    $("#label_user_city").html("");
                }
                if(flag==0){
                    $.ajax({
                        url: '<?php echo route('registerAction'); ?>',
                        type: 'POST',
                        data: {
                            'user_mobile': user_mobile,
                            'user_name': user_name,
                            'user_city': user_city,
                            'user_bank_name': user_bank_name,
                            'user_bank_number': user_bank_account_number,
                            'user_IFSC_code': user_bank_IFAC_code,
                            'user_bank_branch': bank_branch,
                            'user_paytm_number': paytem_number,
                            'user_phone_pay_number': phone_pay_number,
                            'user_google_pay_number': google_pay_number,
                            'user_reference_number':'<?php echo $id; ?>',
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
                                window.location = '<?php echo route('dashboard');?>';
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

