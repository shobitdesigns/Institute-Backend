@extends('cms.layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Role List</a></li>
                        <li class="breadcrumb-item active">Role Assign Permission</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">{{ $role->name }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            {{ Form::open(['url' => route('submitPermission'), 'method' => 'POST', 'onSubmit' => "document.getElementById('submit').disabled=true;"]) }}
            <input type="hidden" name="id" value="{{ $role->id }}">
            <!-- /.card-body -->
            <div class="card-body">
                    @foreach ($modulePermissions as $name => $permissions)
                        <h6 class="mt-2"><b>{{ $name }}</b></h6>
                        <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-sm-3 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permission_id[]"
                                        value="{{ $permission->id }}" @if (array_key_exists($permission->id, $assignedPermissions)) checked @endif>
                                    <label class="form-check-label">{{ $permission->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endforeach
            </div>
            <div class="card-footer">
                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
