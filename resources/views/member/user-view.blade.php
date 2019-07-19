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
    <title>Man Help User Profile</title>
@endsection

@section('header-pages-include')
    <!-- form Uploads -->
    <link href="{{env('APP_URL')}}public/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('page-title')
    <h4 class="page-title float-left">User Profile</h4>
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        {{--        {{dd($user_data)}}--}}
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6  col-xl-4">
                        <div class="card-box widget-user">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{$user_data->user_image_url}}"
                                         class="img-responsive rounded-circle"
                                         alt="user">

                                    <div class="w-100"></div>
                                    <a href="{{route('user_edit',[$user_data->id])}}" class="btn btn-link"><i
                                                class="fa fa-edit"></i>&nbsp; Edit</a>
                                </div>

                                <div class="col-9 wid-u-info">
                                    <h5 class="m-t-1 m-b-5">{{$user_data->user_name}}</h5>

                                    <p class="text-muted mb-1 font-13"><i
                                                class="fa fa-phone"></i>&nbsp;{{$user_data->user_mobile}}</p>

                                    <p class="text-muted mb-1 font-13"><i
                                                class="fa fa-map-marker"></i>&nbsp;{{$user_data->user_city   }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one border-success border">
                            <i class="fa fa-info-circle float-right text-muted"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Get Help</h6>

                            <h2 class="m-b-20"><i class="fa fa-rupee"></i> <span data-plugin="counterup">1,587</span>
                            </h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one border-success border">
                            <i class="fa fa-info-circle float-right text-muted"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Get Help</h6>

                            <h2 class="m-b-20"><i class="fa fa-rupee"></i> <span data-plugin="counterup">1,587</span>
                            </h2>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-md-6  col-xl-4">
                        <div class="card-box widget-user">
                            <div class="row">
                                <div class="col-12 wid-u-info">
                                    <h5 class="m-t-1 m-b-5">BASIC DETAILS</h5>

                                    <p class="text-muted mb-1 font-13"><strong>Name :</strong>
                                        &nbsp;{{$user_data->user_name}}</p>

                                    <p class="text-muted mb-1 font-13"><strong>Mobile : </strong>
                                        &nbsp;{{$user_data->user_mobile}}</p>

                                    <p class="text-muted mb-1 font-13"><strong>City :</strong>
                                        &nbsp;{{$user_data->user_city}}</p>

                                    <p class="text-muted mb-1 font-13"><strong>Reference Number : </strong>
                                        &nbsp;{{$user_data->user_reference_number}}</p>

                                    <p class="text-muted mb-1 font-13"><strong>Gender :</strong>
                                        &nbsp;{{$user_data->user_gender}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="card-box widget-user">
                            <div class="row">
                                <div class="col-12 wid-u-info">
                                    <h5 class="m-t-1 m-b-5">BANK DETAILS</h5>

                                    <p class="text-muted mb-1 font-13"><strong>Bank Name : </strong>
                                        &nbsp;{{$user_data->user_bank_name}}</p>

                                    <p class="text-muted mb-1 font-13"><strong>A/c No. : </strong>
                                        &nbsp;{{$user_data->user_bank_number}}</p>

                                    <p class="text-muted mb-1 font-13"><strong>IFSC Code : </strong>
                                        &nbsp;{{$user_data->user_IFSC_code}}</p>

                                    <p class="text-muted mb-1 font-13"><strong>Bank Branch : </strong>
                                        &nbsp;{{$user_data->user_bank_branch}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="card-box widget-user">
                            <div class="row">
                                <div class="col-12 wid-u-info">
                                    <h5 class="m-t-1 m-b-5">Payment Wallet Details</h5>

                                    <p class="text-muted mb-1 font-13"><strong>PayTM Number : </strong>
                                        &nbsp; {{$user_data->user_paytm_number}}</p>

                                    <p class="text-muted mb-1 font-13"><strong>Phone Pay Number : </strong>
                                        &nbsp;{{$user_data->user_phone_pay_number}}</p>

                                    <p class="text-muted mb-1 font-13"><strong>Google Pay Number : </strong>
                                        &nbsp;{{$user_data->user_google_pay_number}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @if(isset($user_data->user_details_amount) && empty($user_data->user_details_amount))
                <div class="row">
                    <div class="col-md-12">
                        <!-- Large modal -->
                        @if($errors->any())
                            <ul class="parsley-errors-list filled"><li class="parsley-required"><h4>{{$errors->first()}}</h4></li></ul>
                        @endif
                        <button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                                data-target=".bs-example-modal-lg">Large modal
                        </button>
                    </div>
                </div>
                    @else
                    <div class="row">
                        <div class="col-md-6  col-xl-4">
                            <div class="card-box widget-user">
                                <div class="row">
                                    <div class="col-12 wid-u-info">
                                        <h5 class="m-t-1 m-b-5">FEES DETAILS</h5>

                                        <p class="text-muted mb-1 font-13"><strong>Amount :</strong>
                                            &nbsp;{{$user_data->user_details_amount}}</p>

                                        <p class="text-muted mb-1 font-13"><strong>Payment Date : </strong>
                                            &nbsp;{{$user_data->user_details_payment_date}}</p>

                                        <p class="text-muted mb-1 font-13"><strong>Description :</strong>
                                            &nbsp;{{$user_data->user_details_by}}</p>
                                        @if(isset($user_data->user_details_image_url) && !empty($user_data->user_details_image_url))

                                        <p class="text-muted mb-1 font-13"><img src="{{$user_data->user_details_image_url}}"
                                                                                class="img-responsive rounded-circle"
                                                                                alt="user"></p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- container -->
            <!-- Modal -->
            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">Fees Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="m-t-20" id="myFeesForm" method="post" enctype="multipart/form-data" action="{{route('add_fees_details')}}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{$user_data->id}}">
                                <input type="hidden" name="add_by" value="{{$user_data->id}}">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control" type="text" name="user_details_amount" id="user_amount" placeholder="Amount" onkeyup="BSP.only('int_flot','user_amount')">
                                        <ul class="parsley-errors-list filled"><li class="parsley-required" id="label_user_amount"></li></ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-box">
                                            <h4 class="header-title m-t-0 m-b-30">Proof</h4>
                                            <input type="file" class="dropify" id="user_details_image" name="user_details_image" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control" type="text"  id="user_details_by" placeholder="Description" name="user_details_by" >
                                    </div>
                                </div>

                                <div class="form-group text-center row m-t-10">
                                    <div class="col-12">
                                        <button class="btn btn-success waves-effect waves-light" type="button" id="submitBtnFees">Submit
                                        </button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- content -->
    </div>
@endsection


@section('footer-pages-include')
    <!-- file uploads js -->
    <script src="{{env('APP_URL')}}public/plugins/fileuploads/js/dropify.min.js"></script>
    <script src="{{env('APP_URL')}}public/assets/js/bsp_script.js" type="text/javascript"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong appended.'
            },
            error: {
                'fileSize': 'The file size is too big (1M max).'
            }
        });
    </script>
    <script>
        $(document).ready(function(){

            $("#submitBtnFees").click(function(){

                var user_amount = $("#user_amount").val();
                var scroll_element = '';
                var flag = 0;
                if (user_amount == '') {
                    $("#user_amount").addClass('parsley-error');
                    $("#label_user_amount").html("Please Enter Amount.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'user_amount';
                    }
                }
                else{
                    $("#user_amount").removeClass('parsley-error');
                    $("#label_user_amount").html("");
                }

                if(flag==0){
                    $( "#myFeesForm" ).submit();
                }
            });
        });
    </script>
@endsection