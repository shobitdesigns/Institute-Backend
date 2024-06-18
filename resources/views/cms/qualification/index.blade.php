@extends('cms.layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Qualification List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Qualification List</h3>
                <div class="card-tools"><a href="{{ route('qualification.create') }}"><span class="btn btn-sm btn-info">Add
                    &nbsp;<span class="fa fa-plus"></span></span></a></div>
            </div>
            <div class="table-responsive">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($qualifications as $qualification)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $qualification->qualification }}</td>

                                    <td>
                                        <div class="row">
                                            <a href="{{ route('qualification.edit',['qualification'=>$qualification->id]) }}"><i class="fa fa-edit"></i></a>
                                            @can('superAdmin', new App\Models\User())
                                                <form action="{{ route('qualification.destroy', ['qualification' => $qualification->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('Delete')
                                                    <button type="button" onclick="confirmBox(this)"
                                                        style="border: 0px;background-color:transparent;"><i
                                                            class="fa fa-trash text-red"></i></button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
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
            $('#example1').DataTable();
        });
    </script>
@endsection
