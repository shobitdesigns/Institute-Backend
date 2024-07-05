@extends('cms.layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Monthly Collection</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>

    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Monthly Collection</h3>
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
                                <th>Monthly Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->unique_id }}</td>
                                    <td>{{ $student->first_name }}</td>
                                    <td>{{ $student->last_name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->father_name }}</td>
                                    <td>{{ $student->mobile }}</td>
                                    <td>{{ $student->institute }}</td>
                                    <td>{{ $student->studentCourse->monthly_payment }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7" style="text-align:right;"><strong>Total Monthly Payment:</strong></td>
                                <td><strong>{{ $totalMonthlyPayment }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer text-right">
                    <a class="btn-success btn" href="{{ route('exportMonthlyCollection') }}"><i class="far fa-credit-card mr-2"></i>Export</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row"></div>
@endsection
@section('footerScript')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
