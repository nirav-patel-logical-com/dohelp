<?php
/**
 * Created by PhpStorm.
 * User: vidhi_BSP
 * Date: 7/18/2019
 * Time: 11:47 AM
 */
?>
@extends('includes.base')

@section('seo-tag')
    <title>Man Help User Profile</title>
@endsection

@section('header-pages-include')

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
                                    <img src="{{ env('APP_URL') }}public/assets/images/users/avatar-3.jpg"
                                         class="img-responsive rounded-circle"
                                         alt="user">
                                    <div class="w-100"></div>
                                    <a href="#" class="btn btn-link"><i class="fa fa-edit"></i>&nbsp; Edit</a>
                                </div>

                                <div class="col-9 wid-u-info">
                                    <h5 class="m-t-1 m-b-5">Chadengle</h5>
                                    <p class="text-muted mb-1 font-13"><i class="fa fa-map-marker"></i>&nbsp;Abu Road</p>
                                    <p class="text-muted mb-1 font-13"><i class="fa fa-envelope"></i>&nbsp;coderthemes@gmail.com</p>
                                    <p class="text-muted mb-1 font-13"><i class="fa fa-phone"></i>&nbsp;+91 7575001042</p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one border-success border">
                            <i class="fa fa-info-circle float-right text-muted"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Get Help</h6>
                            <h2 class="m-b-20"><i class="fa fa-rupee"></i> <span data-plugin="counterup">1,587</span></h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one border-success border">
                            <i class="fa fa-info-circle float-right text-muted"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Get Help</h6>
                            <h2 class="m-b-20"><i class="fa fa-rupee"></i> <span data-plugin="counterup">1,587</span></h2>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- container -->
        </div>
        <!-- content -->
    </div>
@endsection


@section('footer-pages-include')

@endsection