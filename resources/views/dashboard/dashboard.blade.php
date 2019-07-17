<?php
/**
 * Created by PhpStorm.
 * User: vidhi_BSP
 * Date: 7/16/2019
 * Time: 5:09 PM
 */
?>
@extends('includes.base')

@section('seo-tag')
    <title>Man Help Desh board</title>
@endsection

@section('header-pages-include')
<!--Morris Chart CSS -->
<link rel="stylesheet" href="{{ env('APP_URL') }}public/plugins/morris/morris.css">
<!-- Plugins css -->
<link href="{{ env('APP_URL') }}public/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
<link href="{{ env('APP_URL') }}public/plugins/mjolnic-bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<link href="{{ env('APP_URL') }}public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="{{ env('APP_URL') }}public/plugins/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet">
<link href="{{ env('APP_URL') }}public/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

@endsection

@section('page-title')
    <h4 class="page-title float-left">Dashboard</h4>
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-end">
                <div class="col-auto">
                    <div class="form-group ">
                        <label>Select Date Range</label>

                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6 col-xl-3 ">
                    <div class="card-box tilebox-one border-primary border">
                        <i class="fa fa-users float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase m-b-20">Registerd Members</h6>
                        <h2 class="m-b-20"><span data-plugin="counterup">1,587</span><small class="text-muted text-sub">/Users</small></h2>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card-box tilebox-one border-success border">
                        <i class="fa fa-check-circle float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase m-b-20">Active Member</h6>
                        <h2 class="m-b-20"><span data-plugin="counterup">46782</span><small class="text-muted text-sub">/Users</small></h2>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card-box tilebox-one border-danger border">
                        <i class="fa fa-money float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase m-b-20">Fee Pending</h6>
                        <h2 class="m-b-20"><span data-plugin="counterup">500</span><small class="text-muted text-sub">/Users</small></h2>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card-box tilebox-one border-warning border">
                        <i class="fa fa-user-times float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase m-b-20">Inactive Member</h6>
                        <h2 class="m-b-20"><span data-plugin="counterup">1,890</span><small class="text-muted text-sub">/Users</small></h2>
                    </div>
                </div>
            </div>

            <!-- end row -->
            <div class="row">
                <div class="col-md-12">
                    <hr/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card-box tilebox-one border-success border">
                        <i class="fa fa-info-circle float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase m-b-20">Get Help</h6>
                        <h2 class="m-b-20"><span data-plugin="counterup">1,587</span><small class="text-muted text-sub">/Users</small></h2>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card-box tilebox-one border-danger border">
                        <i class="fa fa-info float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase m-b-20">Pending Get Help</h6>
                        <h2 class="m-b-20"><span data-plugin="counterup">46782</span><small class="text-muted text-sub">/Users</small></h2>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card-box tilebox-one border-success border">
                        <i class="ti-info-alt float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase m-b-20">Paid Help</h6>
                        <h2 class="m-b-20"><span data-plugin="counterup">500</span><small class="text-muted text-sub">/Users</small></h2>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card-box tilebox-one border-danger border">
                        <i class="ti-info float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase m-b-20">Pending Paid Help</h6>
                        <h2 class="m-b-20"><span data-plugin="counterup">1,890</span><small class="text-muted text-sub">/Users</small></h2>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-xl-12">
                    <div class="card-box">

                        <h4 class="header-title m-t-0 m-b-30">New Members</h4>

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>City</th>
                                    <th>Fee status</th>
                                    <th>Paid Help</th>
                                    <th>Get Help</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Raj Joshi</td>
                                    <td>+91 7575757575</td>
                                    <td>Abu Road</td>
                                    <td><span class="badge badge-danger">Pending</span></td>
                                    <td><span class="badge badge-warning"> Pending </span> </td>
                                    <td><span class="badge badge-warning">Pending (2)</span></td>
                                    <td><span class="badge badge-warning">Pending</span></td>
                                    <td>
                                       <a href="" class="btn btn-link">
                                            <i class="fa fa-eye"></i>&nbsp;View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Aaron Allston</td>
                                    <td>+91 7575757575</td>
                                    <td>Abu Road</td>
                                    <td><span class="badge badge-success">Paid</span></td>
                                    <td><span class="badge badge-success">Paid</span></td>
                                    <td><span class="badge badge-info">Pending (1)</span></td>
                                    <td><span class="badge badge-warning">Pending</span></td>
                                    <td>
                                        <a href="" class="btn btn-link">
                                            <i class="fa fa-eye"></i>&nbsp;View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Raj Joshi</td>
                                    <td>+91 7575757575</td>
                                    <td>Abu Road</td>
                                    <td><span class="badge badge-success">Paid</span></td>
                                    <td><span class="badge badge-success">Paid</span> </td>
                                    <td><span class="badge badge-success">Recived</span></td>
                                    <td><span class="badge badge-success">Complete</span></td>
                                    <td>
                                        <a href="" class="btn btn-link">
                                            <i class="fa fa-eye"></i>&nbsp;View</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div><!-- end col-->

            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->


</div>
<!-- End content-page -->

@endsection


@section('footer-pages-include')
<!--Morris Chart-->
<script src="{{ env('APP_URL') }}public/plugins/morris/morris.min.js"></script>
<script src="{{ env('APP_URL') }}public/plugins/raphael/raphael.min.js"></script>

<!-- Page specific js -->
<script src="{{ env('APP_URL') }}public/assets/pages/jquery.dashboard.js"></script>

<!--Date Range Picker Start-->
<script src="{{ env('APP_URL') }}public/plugins/moment/moment.js"></script>
<script src="{{ env('APP_URL') }}public/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="{{ env('APP_URL') }}public/plugins/mjolnic-bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="{{ env('APP_URL') }}public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="{{ env('APP_URL') }}public/plugins/clockpicker/bootstrap-clockpicker.js"></script>
<script src="{{ env('APP_URL') }}public/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<!--Date Range Picker End-->


@endsection

