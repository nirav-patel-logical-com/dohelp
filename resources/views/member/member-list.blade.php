@extends('includes.base')

@section('seo-tag')
    <title>Man Help Member List</title>
@endsection

@section('header-pages-include')
    <!-- DataTables -->
    <link href="{{env('APP_URL')}}public/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{env('APP_URL')}}public/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
@endsection
@section('page-title')
    <h4 class="page-title float-left">Member List</h4>
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
                    <div class="col-12">
                        <div class="card-box table-responsive">

                            <table id="post" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>User Name</th>
                                    <th>Unique Id</th>
                                    <th>Mobile</th>
                                    <th>City</th>
                                    <th>Reference Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div> <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Text in a modal</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content-page -->


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->

@endsection
@section('footer-pages-include')
    <!-- Required datatable js -->
    <script src="{{env('APP_URL')}}public/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{env('APP_URL')}}public/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{env('APP_URL')}}public/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function () {
            //$('#post').DataTable();
            $('#post').DataTable({
                //"processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo route('user_list_post'); ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        '_token': '<?php echo csrf_token(); ?>'
                    }

                },
                "columns": [
                    {"data": "id"},
                    {"data": "user_name"},
                    {"data": "user_unique_id"},
                    {"data": "user_mobile"},
                    {"data": "user_city"},
                    {"data": "user_reference_number"},
                    {"data": "user_status"},
                    {"data": "action"}
                ]

            });
        });
    </script>
    <script>
        function status_change(id, status) {
            $.ajax({
                url: 'api/change_user_status',
                method: 'POST',
                data: {
                    'id': id,
                    'status': status,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (response) {
                    var obj = jQuery.parseJSON(response)
                    //console.log($obj);
                    if (obj.STATUS_CODE == 200) {
                        Swal.fire({
                            type: 'success',
                            title: 'Status Change!',
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
