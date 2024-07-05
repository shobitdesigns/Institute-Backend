@extends('cms.layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Student</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Search Program</h3>
            </div>
            <div class="card-body">
                {!! Form::open(['method' => 'GET']) !!}
                <div class="row">
                    <div class="form-group col-10">
                        {{ Form::label('student', 'Search Student') }}
                        {{ Form::text('student', request()->student ?? null, ['class' => 'form-control ', 'placeholder' => 'Search Student Name | ID | Student Father Name ']) }}
                    </div>



                    <div class=" float-right mt-4 col-2">
                        <button type="submit" class="btn btn-success mr-3" id="filterButton">Search Student</button>
                        <a href="{{ url()->current() }}" class="btn btn-warning mr-2" id="clearFilterButton">Clear All</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @if($students->isNotEmpty())
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Student List</h3>
                </div>
                <div class="table-responsive">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>U-ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Father Name</th>
                                    <th>Mobile</th>
                                    <th>Institute</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{ $student->unique_id }}</td>
                                        <td>{{ $student->first_name }}</td>
                                        <td>{{ $student->last_name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>{{ $student->father_name }}</td>
                                        <td>{{ $student->mobile }}</td>
                                        <td>{{ ucFirst($student->institute) }}</td>
                                        <td><a href="{{ route('student.show',['student'=>$student->id]) }}"><i class="fa fa-cash-register"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    @elseif (!empty(request()->all()))
        <h3 class="text-center text-danger">Data not found</h3>
    @endif

    <div class="row"></div>
@endsection
