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
                    Student Id : <br><b>{{ $student->unique_id }}</b>
                </div>
                <div class="col-2 invoice-col">
                    Name: <br><b> {{ $student->first_name }} {{ $student->last_name }}</b><br>
                </div>
                <div class="col-2 invoice-col">
                    Email: <br><b> {{ $student->email }}</b><br>
                </div>
                <div class="col-2 invoice-col">
                    Mobile: <br><b> {{ $student->mobile }}</b><br>
                </div>
                <div class="col-2 invoice-col">
                    Added By: <br><b> {{ $student->addedBy->name }}</b><br>
                </div>
            </div>

            <div class="row">
                <div class="col-5">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Course Detail </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th style="width:50%">Name:</th>
                                                    <td>{{ $student->studentCourse->course->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Duration</th>
                                                    <td>{{ $student->studentCourse->course->duration }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Fixed Price:</th>
                                                    <td>{{ $student->studentCourse->course_fixed_price }}</td>
                                                </tr>
                                                @if ($student->studentCourse->payment_mode == 'installment')
                                                    <tr>
                                                        <th>Monthly Installment:</th>
                                                        <td>{{ $student->studentCourse->monthly_payment }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Installment Month:</th>
                                                        <td>{{ $student->studentCourse->installment_months }} Months</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Pay:</th>
                                                        <td>{{ $totalPaid }}</td>
                                                    </tr>
                                                    @if($balanceLeft == 0)
                                                        <tr>
                                                            <th>Status</th>
                                                            <td><span class="badge badge-success">Payment Completed</span></td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <th>Fees Left:</th>
                                                            <td> {{ $balanceLeft }} </td>
                                                        </tr>
                                                    @endif
                                                @else
                                                    <tr>
                                                        <th>Status</th>
                                                        <td><span class="badge badge-success">Payment Completed</span></td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    @if ($student->studentCourse->payment_mode == 'installment' && $balanceLeft != 0)
                        <div class="card card-primary  card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Manual Payment </h3>
                            </div>
                            {{ Form::open(['url' => route('storeMonthlyInstallment'), 'method' => 'POST', 'onSubmit' => "document.getElementById('submit').disabled=true;",'id'=>'form']) }}
                            <input type="hidden" name="student_course_id" value="{{ $student->studentCourse->id }}">
                            <div class="card-body">
                                <div class="row" >
                                    <div class="form-group" id="payment_method" >
                                        <label for="payment_method">Payment Method</label><span style="color: red;"> *</span>
                                        <div>
                                            <label>{{ Form::radio('payment_method', 'online', true) }} Online Payment</label>
                                            <label>{{ Form::radio('payment_method', 'offline', false) }} Offline Payment</label>
                                        </div>
                                    </div>

                                    <div class="form-group ml-4">
                                        {{ Form::label('installment', 'Monthly Installment', []) }}
                                        {{ Form::number('installment', null, ['class' => 'form-control', 'placeholder' => 'Enter Monthly Installment','id'=>'installment','required','min'=>'1']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="submit" class="btn btn-success float-right"><i
                                        class="far fa-credit-card"></i> Submit
                                    Payment
                                </button>
                            </div>
                            {{ Form::close() }}
                        </div>
                    @endif

                </div>


                <div class="col-7 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Payment Mode</th>
                                <th>Payment Method</th>
                                <th>Pay</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($student->studentCourse->payments as $payment)
                                <tr>
                                    <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                                    @if ($loop->iteration == 1 && $payment->payment_mode == 'installment')
                                        <td>Down Payment</td>
                                    @else
                                        <td>{{ $payment->payment_mode == 'full_pay' ? 'Full Pay' : 'Installment' }}</td>
                                    @endif
                                    <td>{{ ucfirst($payment->payment_method) ?? 'N/A' }}</td>
                                    <td>{{ $payment->pay ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>




        </div>

    </div>

    <div class="row"></div>
@endsection
@section('footerScript')
    <script>
        $(document).ready(function() {
            $('#form').on('submit', function() {
                $('#submit').attr('disabled', 'disabled');
            });
        });
    </script>
@endsection
