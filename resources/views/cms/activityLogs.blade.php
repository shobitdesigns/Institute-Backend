@extends('cms.layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Activity Logs</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Activity Logs</h3>
            </div>
            <div class="table-responsive">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Module</th>
                                <th>Action</th>
                                <th>ActionBy</th>
                                <th>Message</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footerScript')
    <script>
        $(document).ready(function() {

            $('#example1').DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                ajax: "{{ route('activityLogs') }}",
                order: [
                    [5, "desc"]
                ],
                sorting: true,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'Index',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'Module',
                        name: 'Module',
                    },
                    {
                        data: 'Action',
                        name: 'Action',
                    },
                    {
                        data: 'Responsible',
                        name: 'Responsible',
                    },
                    {
                        data: 'Message',
                        name: 'Message',
                    },
                    {
                        data: 'Time',
                        name: 'Time',
                    },
                ]
            });
        });
    </script>
@endsection
