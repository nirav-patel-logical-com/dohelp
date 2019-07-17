<?php
/**
 * Created by PhpStorm.
 * User: vidhi_BSP
 * Date: 7/17/2019
 * Time: 10:31 AM
 */ ?>

@include('includes.header_account')
<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">

    <div class="account-bg">
        <div class="card-box mb-0">
            <div class="text-center m-t-20">
                <a href="#" class="logo">
                  <img src="public/assets/images/logo/man-help_01Logo.jpg" width="95%">
                </a>
            </div>
            <div class="m-t-10 p-20">
                <div class="row">
                    <div class="col-12 text-center">
                        <h6 class="text-muted text-uppercase m-b-0 m-t-0">Sign In</h6>
                    </div>
                </div>
                <form class="m-t-20" id="myLoginForm" method="post" action="{{route('loginAction')}}">

                    <div class="form-group row"  id="div_user_phone">
                        <div class="col-12">
                            <input class="form-control{{$errors->has('mobile') ? 'is-invalid' : ''}}" type="text" id="user_mobile" placeholder="Mobile">
                            <label class="control-label pull-right" id="label_user_phone"></label>
                        </div>
                    </div>

                    <div class="form-group row" id="div_user_password">
                        <div class="col-12">
                            <input class="form-control" type="password" id="password" placeholder="Password">
                            <label class="control-label pull-right" id="label_user_password"></label>
                        </div>
                    </div>

                    <div class="form-group text-center row m-t-10">
                        <div class="col-12">
                            <button class="btn btn-success btn-block waves-effect waves-light" type="button" id="submitBtnLogin">Log In
                            </button>
                        </div>
                    </div>
                </form>

            </div>

            <div class="clearfix"></div>
        </div>
    </div>
    <!-- end card-box-->
</div>
<!-- end wrapper page -->

@include('includes.footer_account')
<script>
    $(document).ready(function(){
        $("#submitBtnLogin").click(function(){
            var mobile_no_regx = BSP.regx('mobile');
            var user_mobile = $("#user_mobile").val();
            var password = $("#password").val();
            var scroll_element = '';
            var flag = 0;
            if (user_mobile == '') {
                $("#div_user_phone").addClass('has-error');
                $("#label_user_phone").html("Please Enter Mobile Number.");
                flag++;
                if (scroll_element == '') {
                    scroll_element = 'div_user_phone';
                }
            }
            else if(!mobile_no_regx.test(user_mobile))
            {
                $("#div_user_phone").addClass('has-error');
                $("#label_user_phone").html("Mobile number length should be enter 4 to 12 digits.");
                flag++;
                if (scroll_element == '') {
                    scroll_element = 'div_user_phone';
                }
            }else{
                $("#div_user_phone").removeClass('has-error');
                $("#label_user_phone").html("");
            }

            if (password == '') {
                $("#div_user_password").addClass('has-error');
                $("#label_user_password").html("Please Enter Password.");
                flag++;
                if (scroll_element == '') {
                    scroll_element = 'div_user_password';
                }
            }
            else {
                $("#div_user_password").removeClass('has-error');
                $("#label_user_password").html("");
            }
            if(flag==0){
                $("#myLoginForm").submit(); // Submit the form
            }
        });
    });
</script>