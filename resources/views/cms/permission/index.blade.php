@extends('cms.layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Permission List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Permission List</h3>
                @can('superAdmin', new App\Models\User())
                    <div class="card-tools"><a href="{{ route('permission.create') }}"><span class="btn btn-sm btn-info">Add
                    &nbsp;<span class="fa fa-plus"></span></span></a></div>
                @endcan
            </div>
            <div class="table-responsive">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Module</th>
                                <th>Name</th>
                                @can('superAdmin', new App\Models\User())
                                    <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $permission->module->name ?? '' }}</td>
                                    <td>{{ $permission->name }}</td>
                                    @can('superAdmin', new App\Models\User())
                                        <td>
                                            <div class="row">
                                                <a href="{{ route('permission.edit', ['permission' => $permission->id]) }}"><i
                                                        class="fa fa-edit"></i></a>
                                                <form
                                                    action="{{ route('permission.destroy', ['permission' => $permission->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('Delete')
                                                    <button type="button" onclick="confirmBox(this)"
                                                        style="border: 0px;background-color:transparent;"><i
                                                            class="fa fa-trash text-red"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    @endcan
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
