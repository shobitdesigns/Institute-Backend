@extends('cms.layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('student.index') }}">Student List</a></li>
                        <li class="breadcrumb-item active">Student Payment Detail</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>

    <div class="col-12">

        <div class="invoice p-3 mb-3">

            <div class="row invoice-info mb-3">
                <div class="col-2 invoice-col">
                    Student Id : <br><b>{{$student->unique_id}}</b>
                </div>
                <div class="col-2 invoice-col">
                    Name:   <br><b> {{$student->first_name}} {{$student->last_name}}</b><br>
                </div>
                <div class="col-2 invoice-col">
                    Email:  <br><b> {{$student->email}}</b><br>
                </div>
                <div class="col-2 invoice-col">
                    Mobile: <br><b> {{$student->mobile}}</b><br>
                </div>
                <div class="col-2 invoice-col">
                    Added By: <br><b> {{$student->addedBy->name}}</b><br>
                </div>
            </div>

            <div class="row">
                <div class="col-5">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Course Detail</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th style="width:50%">Name:</th>
                                                    <td>{{$student->studentCourse->course->name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Duration</th>
                                                    <td>{{$student->studentCourse->course->duration}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Fixed Price:</th>
                                                    <td>{{$student->studentCourse->payments->first()->course_fixed_price}}</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-7 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Payment Mode</th>
                                <th>Payment Method</th>
                                <th>First Installment</th>
                                <th>Installment Months</th>
                                <th>Monthly Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($student->studentCourse->payments as $payment)
                                <tr>
                                    <td>{{$payment->created_at->format('d/m/Y')}}</td>
                                    <td>{{ ucfirst($payment->payment_mode) }}</td>
                                    <td>{{ ucfirst($payment->payment_method) ?? 'N/A' }}</td>
                                    <td>{{ $payment->first_installment ?? 'N/A' }}</td>
                                    <td>{{ $payment->installment_months ?? 'N/A' }}</td>
                                    <td>{{ $payment->monthly_payment ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="row">



                <div class="col-12">
                    <p class="lead">Amount Due 2/22/2014</p>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td>$250.30</td>
                                </tr>
                                <tr>
                                    <th>Tax (9.3%)</th>
                                    <td>$10.34</td>
                                </tr>
                                <tr>
                                    <th>Shipping:</th>
                                    <td>$5.80</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td>$265.24</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


            <div class="row no-print">
                <div class="col-12">
                    <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                            class="fas fa-print"></i> Print</a>
                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                        Payment
                    </button>
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fas fa-download"></i> Generate PDF
                    </button>
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
