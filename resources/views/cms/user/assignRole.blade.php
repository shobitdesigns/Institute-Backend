@extends('cms.layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User List</a></li>
                        <li class="breadcrumb-item active">Assign Role</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">{{ $user->name }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            {{ Form::open(['url' => route('submitRole'), 'method' => 'POST', 'onSubmit' => "document.getElementById('submit').disabled=true;"]) }}
            <input type="hidden" name="id" value="{{ $user->id }}">
            <!-- /.card-body -->
            <div class="card-body">
                @php $assignedRoles =  $user->roles->isEmpty() ? [] : $user->roles->pluck("name","id")->toArray()  @endphp
                <div class="row">
                    {{-- @can('superAdmin', auth()->user())
                        <div class="col-sm-3 mt-2">
                            <div class="form-check">
                                {{ Form::checkbox('super_admin', 1, $user->super_admin, ['class' => 'form-check-input']) }}
                                {{ Form::label('super_admin', 'Super Admin', ['class' => 'form-check-label']) }}
                            </div>
                        </div>
                    @endcan --}}

                    @foreach ($roles as $key => $role)
                        <div class="col-sm-3 mt-2">
                            <div class="form-check">
                                <input id="{{ $key }}" class="form-check-input" type="checkbox" name="role_id[]"
                                    value="{{ $key }}" @if (array_key_exists($key, $assignedRoles)) checked @endif>
                                <label for="{{ $key }}" class="form-check-label">{{ $role }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    <!-- /.card -->
@endsection
