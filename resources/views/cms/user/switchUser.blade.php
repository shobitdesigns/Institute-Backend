@extends('cms.layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Switch User Form</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"> Switch User </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            {{ Form::open(['url' => route('switchUser'), 'method' => 'POST', 'onSubmit' => "document.getElementById('submit').disabled=true;"]) }}
            <!-- /.card-body -->
                <div class="card-body">
                    <div class="form-group row">
                        {!! Form::label('user_id', 'Select User',['class' => ' col-sm-2']) !!}
                        {!! Form::select('user_id', $users, null, ['class' => 'form-control select2 col-sm-6','data-placeholder' => 'Select User',
                            'placeholder' => 'Select User','required' ]) !!}
                    </div>
                </div>
            <div class="card-footer">
                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
