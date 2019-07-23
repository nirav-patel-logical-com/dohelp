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
    <title>Man Help Member Edit</title>
@endsection

@section('header-pages-include')
    <link href="{{env('APP_URL')}}public/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <!-- form Uploads -->
    <link href="{{env('APP_URL')}}public/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    <h4 class="page-title float-left">Member Create</h4>
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
                    <div class="col-sm-6 offset-sm-3">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="m-t-10 p-20">
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <h4 class="text-muted text-uppercase m-b-0 m-t-0">Member Create</h4>
                                            </div>
                                        </div>
                                        <form class="m-t-20" id="myLoginForm">
                                            @csrf

                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <h4 class="header-title m-t-0">Basic Details</h4>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input class="form-control" type="text" id="user_name"  placeholder="Full Name">
                                                    <ul class="parsley-errors-list filled"><li class="parsley-required" id="label_user_name" ></li></ul>
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
                                                    <input class="form-control" type="text" name="user_age" id="user_age" placeholder="Age" onkeyup="BSP.only('digit','user_age')">
                                                    <ul class="parsley-errors-list filled"><li class="parsley-required" id="label_user_age"></li></ul>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input class="form-control" type="text" id="user_reference_number" name="user_reference_number" placeholder="User Reference Number" >
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input class="form-control" type="text"  id="user_city" placeholder="City" name="user_city" >
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
                                                    <input class="form-control" type="text" name="user_bank_name" id="user_bank_name" placeholder="Bank Name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input class="form-control" type="text" name="user_bank_account_number"  id="user_bank_account_number" required="" placeholder="A/c No."   >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input class="form-control" type="text" name="user_bank_IFAC_code" id="user_bank_IFAC_code" placeholder="IFSC Code" >
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
                                                    <input class="form-control" type="text" name="paytem_number" id="paytem_number" placeholder="PayTM Number" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input class="form-control" type="text" name="phone_pay_number" id="phone_pay_number" placeholder="Phone Pay Number"  >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input class="form-control" type="text" name="google_pay_number" id="google_pay_number" placeholder="Google Pay Number" >
                                                </div>
                                            </div>

                                            <div class="form-group text-center row m-t-10">
                                                <div class="col-12">
                                                    <button class="btn btn-success waves-effect waves-light" type="button" id="submitBtnJoinNow">Submit
                                                    </button>
                                                    <button type="reset" class="btn btn-secondary waves-effect m-l-5" id="cancelBtnJoinNow">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>

                                        </form>

                                    </div>


                                </div>

                            </div>
                            <!-- end row -->

                        </div>
                    </div><!-- end col-->

                </div>
                <!-- end row -->


            </div> <!-- container -->

        </div> <!-- content -->



    </div>
    <!-- End content-page -->


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->

@endsection
@section('footer-pages-include')
    <script src="{{env('APP_URL')}}public/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="{{env('APP_URL')}}public/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{env('APP_URL')}}public/assets/js/bsp_script.js" type="text/javascript"></script>

    <script>
        $(document).ready(function(){

            $("#submitBtnJoinNow").click(function(){
                var mobile_no_regx = BSP.regx('mobile');
                var user_mobile = $("#user_mobile").val();
                var user_name = $("#user_name").val();
                var user_city = $("#user_city").val();
                var user_age = $("#user_age").val();
                var user_bank_name = $("#user_bank_name").val();
                var user_bank_account_number = $("#user_bank_account_number").val();
                var user_bank_IFAC_code = $("#user_bank_IFAC_code").val();
                var bank_branch = $("#bank_branch").val();
                var paytem_number = $("#paytem_number").val();
                var phone_pay_number = $("#phone_pay_number").val();
                var google_pay_number = $("#google_pay_number").val();
                var user_reference_number = $("#user_reference_number").val();
                var user_gender = $("#user_gender").val();

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
                if (user_age == '') {
                    $("#user_age").addClass('parsley-error');
                    $("#label_user_age").html("Please Enter Your Age.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'user_age';
                    }
                }
                else {
                    $("#user_age").removeClass('parsley-error');
                    $("#label_user_age").html("");
                }
                if(flag==0){
                    var user_image ='';
                        $.ajax({
                            url: '<?php echo route('userCreateAction'); ?>',
                            type: 'POST',
                            data: {
                                'user_mobile': user_mobile,
                                'user_name': user_name,
                                'user_city': user_city,
                                'user_age': user_age,
                                'user_reference_number': user_reference_number,
                                'user_bank_name': user_bank_name,
                                'user_bank_number': user_bank_account_number,
                                'user_IFSC_code': user_bank_IFAC_code,
                                'user_bank_branch': bank_branch,
                                'user_paytm_number': paytem_number,
                                'user_phone_pay_number': phone_pay_number,
                                'user_google_pay_number': google_pay_number,
                                'user_gender': '',
                                'user_image':'',
                                'user_add_by': '<?php echo $login_data[0]->id ?>',
                                'user_mobile_country_code': '+91',
                                '_token': '<?php echo csrf_token();?>'
                            },
                            success: function (response) {

                                var obj = jQuery.parseJSON(response)
                                if (obj.STATUS_CODE == 200) {
                                   var user_unique_id = obj.DATA['user_unique_id'];
                                   var user_mobile = obj.DATA['user_mobile'];
                                   var user_reference_number = obj.DATA['user_reference_number'];
                                   window.location =obj.DATA['redirect_url'] ;
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
