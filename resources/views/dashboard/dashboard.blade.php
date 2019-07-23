<?php
/**
 * Created by PhpStorm.
 * User: vidhi_BSP
 * Date: 7/16/2019
 * Time: 5:09 PM
 */
$login_data = Session::get('login_data');
?>
@extends('includes.base')

@section('seo-tag')
    <title>Man Help Dashboard</title>
@endsection

@section('header-pages-include')
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
            <div class="row ">
                <div class="col-12 mb-2">
                    <div class="form-group row justify-content-end">
                        <label class="col-md-2 col-form-label text-right">Select Date Range</label>
                        <div class="col-auto">
                            <div id="reportrange" class="float-right form-control">
                                <i class="fa fa-calendar"></i>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6 col-xl-3 ">
                    <div class="card-box tilebox-one border-primary border">
                        <i class="fa fa-users float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase m-b-20">Registerd Members</h6>
                        <h2 class="m-b-20"><span id="total_member_count">0</span><small class="text-muted text-sub">/Users</small></h2>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card-box tilebox-one border-success border">
                        <i class="fa fa-check-circle float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase m-b-20">Active Member</h6>
                        <h2 class="m-b-20"><span  id="total_active_member_count">0</span><small class="text-muted text-sub">/Users</small></h2>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card-box tilebox-one border-danger border">
                        <i class="fa fa-money float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase m-b-20">Fee Pending</h6>
                        <h2 class="m-b-20"><span id="fees_pending">0</span><small class="text-muted text-sub">/Users</small></h2>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card-box tilebox-one border-warning border">
                        <i class="fa fa-user-times float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase m-b-20">Inactive Member</h6>
                        <h2 class="m-b-20"><span id="total_inactive_member_count">0</span><small class="text-muted text-sub">/Users</small></h2>
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
                                    <th>Age</th>
                                    <th>Fee status</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($user_list) && !empty($user_list))
                                @foreach($user_list as $single_user)
                                <tr>
                                    <td>{{$single_user->id}}</td>
                                    <td>{{$single_user->user_name}}</td>
                                    <td>+91 {{$single_user->user_mobile}}</td>
                                    <td>{{$single_user->user_city}}</td>
                                    <td>{{$single_user->user_age}}</td>
                                    @if($single_user->user_details_amount >0 )
                                        <td><span class="badge badge-success">Paid</span></td>
                                    @else
                                        <td><span class="badge badge-danger">Pending</span></td>
                                    @endif
                                    @if($single_user->user_status =='Active')
                                        <td><span class="badge badge-success">{{$single_user->user_status}}</span></td>
                                    @else
                                        <td><span class="badge badge-danger">{{$single_user->user_status}}</span></td>
                                    @endif
                                    <td>
                                       <a href="{{route('user_view', $single_user->id)}}" class="btn btn-link">
                                            <i class="fa fa-eye"></i>&nbsp;View</a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
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

<!-- Page specific js -->
{{--<script src="{{ env('APP_URL') }}public/assets/pages/jquery.dashboard.js"></script>--}}

<!--Date Range Picker Start-->
<script src="{{ env('APP_URL') }}public/plugins/moment/moment.js"></script>
<script src="{{ env('APP_URL') }}public/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="{{ env('APP_URL') }}public/plugins/mjolnic-bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="{{ env('APP_URL') }}public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="{{ env('APP_URL') }}public/plugins/clockpicker/bootstrap-clockpicker.js"></script>
<script src="{{ env('APP_URL') }}public/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<!--Date Range Picker End-->
{{--<script src="{{ env('APP_URL') }}public/assets/pages/jquery.form-pickers.init.js"></script>--}}
<script>
    $(document).ready(function(){
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

        $('#reportrange').daterangepicker({
            format: 'MM/DD/YYYY',
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2016',
            dateLimit: {
                days: 60
            },
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'left',
            drops: 'down',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-custom',
            cancelClass: 'btn-secondary',
            separator: ' to ',
            locale: {
                applyLabel: 'Submit',
                cancelLabel: 'Cancel',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        }, function (start, end, label) {
            /*console.log(start, end, label);*/
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            dashboard_data_get(start.format('YYYY-MM-DD HH:mm'),end.format('YYYY-MM-DD HH:mm'))
        });

        dashboard_data_get(moment().subtract(29, 'days').format('YYYY-MM-DD'), moment().format('YYYY-MM-DD'));
        function dashboard_data_get(date_range_start,date_range_end){
            $.ajax({
                url: '<?php echo route('dashboardAction'); ?>',
                type: 'POST',
                data: {
                    'user_id': '<?php echo $login_data[0]->id ?>',
                    'date_range_start':date_range_start,
                    'date_range_end':date_range_end,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (response) {
                    var obj = jQuery.parseJSON(response);
                    $('#total_active_member_count').html(obj.DATA['total_active_member_count']);
                    $('#total_inactive_member_count').html(obj.DATA['total_inactive_member_count']);
                    $('#total_member_count').html(obj.DATA['total_member_count']);
                    $('#fees_pending').html(obj.DATA['fees_pending']);
                }
            });
        }
    });
</script>
@endsection

