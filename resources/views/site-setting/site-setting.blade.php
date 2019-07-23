<?php
/**
 * Created by PhpStorm.
 * User: vidhi_BSP
 * Date: 7/22/2019
 * Time: 4:13 PM
 */?>
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
    <title>Man Help Site setting</title>
@endsection

@section('header-pages-include')
    <link href="{{env('APP_URL')}}public/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <!-- form Uploads -->
    <link href="{{env('APP_URL')}}public/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    <h4 class="page-title float-left">Site setting</h4>
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
                        <div class="row">
                            <div class="col-md-12 col-md-offset-2">
                                @if ( (Session::has('SUCCESS'))&&(Session::get('SUCCESS')=="TRUE") )
                                    <div class="alert alert-success" role="alert">
                                        <!--strong>Well done!</strong-->
                                        @if ( (Session::has('MESSAGE'))&&(Session::get('MESSAGE')!="") )
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{Session::get('MESSAGE')}}</strong>
                                        @endif
                                    </div>
                                @endif
                                @if ( (Session::has('SUCCESS'))&&(Session::get('SUCCESS')=="FALSE") )
                                    <div class="alert alert-danger" role="alert">
                                        <!--strong>Oh snap!</strong-->
                                        @if ( (Session::has('MESSAGE'))&&(Session::get('MESSAGE')!="") )
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{Session::get('MESSAGE')}}</strong>
                                        @endif
                                    </div>
                                @endif
                                <?php Session::forget('SUCCESS'); Session::forget('MESSAGE'); ?>
                            </div>
                        </div>
                        <div class="card-box">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="m-t-10 p-20">
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <h4 class="text-muted text-uppercase m-b-0 m-t-0">Site setting</h4>
                                            </div>
                                        </div>
                                        <form class="m-t-20"  name="form_site_setting" id="form_site_setting" method="post" action="<?=route('site_setting_update')?>">
                                            @csrf
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    Total Amount : <input class="form-control" type="text" id="user_amount"  name="ss_total_amount" placeholder="Total Amount" onkeyup="BSP.only('int_flot','user_amount')" value="{{$site_settings->ss_total_amount}}">
                                                    <ul class="parsley-errors-list filled"><li class="parsley-required" id="label_user_amount" ></li></ul>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-12">
                                                   Entry Fees : <input class="form-control" type="text" id="entry_fees" name="ss_entry_fees" placeholder="Entry Fees" onkeyup="BSP.only('int_flot','entry_fees')" value="{{$site_settings->ss_entry_fees}}">
                                                    <ul class="parsley-errors-list filled"><li class="parsley-required" id="label_entry_fees"></li></ul>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-12">
                                                    Donation : <input class="form-control" type="text" id="donation_fees" name="ss_donation" placeholder="Donation" onkeyup="BSP.only('int_flot','donation_fees')" value="{{$site_settings->ss_donation}}">
                                                    <ul class="parsley-errors-list filled"><li class="parsley-required" id="label_donation_fees"></li></ul>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-11">
                                                    Tax : <input class="form-control" type="text" id="discount" placeholder="discount" name="ss_discount" value="{{$site_settings->ss_discount}}">
                                                    <ul class="parsley-errors-list filled"><li class="parsley-required" id="label_discount"></li></ul>
                                                </div>
                                                <div class="col-1" style="margin-top: 27px">
                                                    %
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    Tax Price <input class="form-control" type="text" id="discount_price" placeholder="discount_price" name="ss_discount_amount" onkeyup="BSP.only('int_flot','discount_price')" value="{{$site_settings->ss_discount_amount}}">
                                                    <ul class="parsley-errors-list filled"><li class="parsley-required" id="label_donation_fees"></li></ul>
                                                </div>
                                            </div>


                                            <div class="form-group text-center row m-t-10">
                                                <div class="col-12">
                                                    <button class="btn btn-success waves-effect waves-light" type="button" id="btn_site_setting">Submit
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
            $("#btn_site_setting").click(function(){

                var scroll_element = '';
                var flag = 0;
                var user_amount = $("#user_amount").val();
                if(user_amount == '')
                {
                    $("#user_amount").addClass('parsley-error');
                    $("#label_user_amount").html("Please Enter Total Amount.");
                    flag++;
                    if (scroll_element == '')
                    {
                        scroll_element = 'user_amount';
                    }
                }
                else
                {
                    $("#user_amount").removeClass('parsley-error');
                    $("#label_user_amount").html('');
                }

                if(flag == 0)
                {
                    $(this).attr('disabled','disabled');
                    $("#form_site_setting").submit();
                }
                else if(scroll_element!=''){
                    BSP.scroll_upto_div(scroll_element);
                    return false;
                }
            });

        });
    </script>
@endsection
