@extends('cms.layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('student.index') }}">Student List</a></li>
                        <li class="breadcrumb-item active">Student Form</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Student Form</h3>
            </div>

            {!! Form::model($object, [
                'method' => $method,
                'url' => $url,
                'onSubmit' => "document.getElementById('submit').disabled=true;",
                'files' => true,
            ]) !!}
            <input type="hidden" name="id" value="{{ $object->id }}">
            <div class="card-body">
                <div class="row ml-0"><b>Note :- </b>&nbsp;<p class="text-danger">Name field should only contain
                        alphabetical characters.</p>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        {{ Form::label('first_name', 'First Name', []) }}<span style="color: red;"> *</span>
                        {{ Form::text('first_name', null, ['class' => 'form-control name', 'placeholder' => 'Enter First Name', 'required']) }}
                    </div>
                    <div class="form-group col-6">
                        {{ Form::label('last_name', 'Last Name', []) }}<span style="color: red;"> *</span>
                        {{ Form::text('last_name', null, ['class' => 'form-control name', 'placeholder' => 'Enter Last Name', 'required']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        {{ Form::label('email', 'Email', []) }}<span style="color: red;"> *</span>
                        {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email', 'required', 'email']) }}
                        <small id="emailError" style="color: red; display: none;">Invalid email type. Please enter an @gmail.com
                        </small>
                    </div>
                    <div class="form-group col-6">
                        {{ Form::label('mobile', 'Mobile', []) }}<span style="color: red;"> *</span>
                        {{ Form::text('mobile', null, ['class' => 'form-control contact_number','id'=>'numberInput' ,'placeholder' => 'Enter Mobile', 'required']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        {{ Form::label('tenth_document', '10th Document') }}
                        {{ Form::file('tenth_document', ['class' => 'file', 'accept' => 'application/pdf']) }}
                        @if (!empty($object->tenth_document))
                            <div class="ml-3">
                                <a href="{{asset('uploads/students/'.$object->id.'/'.$object->tenth_document)}}" target="_blank"><i class="fa-eye fa text-primary mt-5"></i></a>
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-4">
                        {{ Form::label('twelfth_document', '12th Document') }}
                        {{ Form::file('twelfth_document', ['class' => 'file', 'accept' => 'application/pdf']) }}
                        @if (!empty($object->twelfth_document))
                            <div class="ml-3">
                                <a href="{{asset('uploads/students/'.$object->id.'/'.$object->twelfth_document)}}" target="_blank"><i class="fa-eye fa text-primary mt-5"></i></a>
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-4">
                        {{ Form::label('aadhaar_document', 'Aadhaar') }}
                        {{ Form::file('aadhaar_document', ['class' => 'file', 'accept' => 'application/pdf']) }}
                        @if (!empty($object->aadhaar_document))
                            <div class="ml-3">
                                <a href="{{asset('uploads/students/'.$object->id.'/'.$object->aadhaar_document)}}" target="_blank"><i class="fa-eye fa text-primary mt-5"></i></a>
                            </div>
                        @endif
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-3">
                        {{ Form::label('course_id', 'Select Course', []) }}<span style="color: red;"> *</span>
                        {{ Form::select('course_id',$courses, $object->studentCourse->course_id ?? null, ['class' => 'form-control select2','id'=>'course_id', !empty($object->studentCourse) ? 'disabled' : '','placeholder' => 'Select Course', 'data-placeholder' => 'Select Course','required']) }}
                    </div>
                    <div class="form-group col-2">
                        {{ Form::label('duration', 'Duration', []) }}
                        {{ Form::number('duration', null, ['class' => 'form-control name', 'placeholder' => 'Enter duration in months','disabled', 'id' => 'duration']) }}
                    </div>
                    <div class="form-group col-2">
                        {{ Form::label('mrp', 'MRP', []) }}
                        {{ Form::number('mrp', null, ['class' => 'form-control mrp', 'placeholder' => 'Enter MRP','disabled', 'id' => 'mrp']) }}
                    </div>
                    <div class="form-group col-2">
                        {{ Form::label('fix_price', 'Fix Price', []) }}
                        {{ Form::number('fix_price', null, ['class' => 'form-control fix_price', 'placeholder' => 'Enter Fix Price','disabled','id'=>'fix_price']) }}
                    </div>
                    <div class="form-group col-3">
                        {{ Form::label('qualification', 'Qualifications', []) }}
                        {{ Form::text('qualification',  null, ['class' => 'form-control  qualifications', 'disabled', 'placeholder' => ' Qualifications', 'id' => 'qualification']) }}
                    </div>
                </div>

                <div class="row" id="payment_mode" style="display:none;">
                    <div class="form-group col-3">
                        <label for="payment_mode">Payment Mode</label><span style="color: red;"> *</span>
                        <div>
                            <label>{{ Form::radio('payment_mode', 'full_pay', true, ['id' => 'full_payment']) }} Full Payment</label>
                            <label>{{ Form::radio('payment_mode', 'installment', false, ['id' => 'installment_payment']) }} Installment</label>
                        </div>
                    </div>
                    <div class="col-9" id="installment_details" style="display: none;">
                        <div class="row">
                            <div class="form-group col-3" >
                                {{ Form::label('installment', 'First Installment', []) }}
                                {{ Form::number('installment', null, ['class' => 'form-control', 'placeholder' => 'Enter first installment','id'=>'installment']) }}
                            </div>
                            <div class="form-group col-3">
                                {{ Form::label('installment_months', 'Installment Months', []) }}
                                {{ Form::number('installment_months', null, ['class' => 'form-control', 'placeholder' => 'Enter number of months','id'=>'installment_months']) }}
                            </div>
                            <div class="form-group col-3">
                                {{ Form::label('monthly_payment', 'Monthly Payment', []) }}
                                {{ Form::number('monthly_payment', null, ['class' => 'form-control', 'placeholder' => 'Monthly Payment', 'disabled', 'id' => 'monthly_payment']) }}
                            </div>
                            <input type="hidden" name="monthly_payment" value="" id="monthlyPayment">
                        </div>
                    </div>
                </div>

                <div class="row" id="paymentMethod"  style="display:none;">
                    <div class="form-group col-3" id="payment_method" >
                        <label for="payment_method">Payment Method</label><span style="color: red;"> *</span>
                        <div>
                            <label>{{ Form::radio('payment_method', 'online', true) }} Online Payment</label>
                            <label>{{ Form::radio('payment_method', 'offline', false) }} Offline Payment</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col-md-6 text-right">
                        <div>
                            <span class="text-danger"><b>Note:-</b></span>
                            <span> <b>*</b> Fields are Required</span>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('footerScript')
    <script>
        $(document).ready(function() {
            var category = $(".name").val();
            if (category == "") {
                $('#submit').prop('disabled', true);
            }
            $('.name').on('input', function() {
                var inputValue = $(this).val();
                var numeric = /^\d/;
                var specialCharacter = "!@#\\$%\^&*()_\\-+=\\[\\]{};':\",./<>?\\|`~";
                var emojiRegex = /[\uD800-\uDBFF][\uDC00-\uDFFF]|[\u2600-\u27FF]/;
                var hasSpecialCharacter = false;
                var hasnumeric = false;

                for (var i = 0; i < specialCharacter.length; i++) {
                    if (inputValue.includes(specialCharacter[i])) {
                        hasSpecialCharacter = true;
                        break;
                    }
                }

                if (/\d/.test(inputValue)) {
                    hasnumeric = true;
                }

                if (hasSpecialCharacter || emojiRegex.test(inputValue) || hasnumeric) {
                    $('#submit').prop('disabled', true);
                } else {
                    $('#submit').prop('disabled', false);
                }
            });


            const $emailError = $('#emailError');
            $('#email').on('input', function() {
                const email = $('#email').val().trim();
                const gmailRegex = /@gmail\.com$/i;

                if (email === '' || gmailRegex.test(email)) {
                    $emailError.hide();
                    $('#submit').prop('disabled', false);
                } else {
                    $emailError.show();
                    $('#submit').prop('disabled', true);
                }
            });

            $('#numberInput').on('input', function(){
                var inputValue = $(this).val();
                inputValue = inputValue.replace(/\D/g, '');
                inputValue = inputValue.substring(0, 10);
                $(this).val(inputValue);
            });

            $('#course_id').change(function() {
                var courseId = $(this).val();
                if (courseId) {
                    var getCourseUrl    = "{{ route('getCourse', ['id' => 'PLACEHOLDER']) }}";
                    var courseUrl       = getCourseUrl.replace('PLACEHOLDER', courseId)
                    $.ajax({
                        url: courseUrl,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data) {
                                $('#duration').val(data.duration);
                                $('#mrp').val(data.mrp);
                                $('#fix_price').val(data.fix_price);
                                var qualifications = data.qualifications.map(function(q) {
                                    return q.qualification;
                                });
                                $('#qualification').val(qualifications);
                            } else {
                                $('#duration').val('');
                                $('#mrp').val('');
                                $('#fix_price').val('');
                                $('#qualification').val('');
                            }
                        }
                    });

                    $('#payment_mode,#paymentMethod').show();

                } else {
                    $('#duration').val('');
                    $('#mrp').val('');
                    $('#fix_price').val('');
                    $('#qualification').val('');
                    $('#payment_mode,#paymentMethod').hide();
                }
            });

            $('input[name="payment_mode"]').change(function() {
                if ($('#installment_payment').is(':checked')) {
                    $('#installment_details').show();
                } else {
                    $('#installment_details').hide();
                }
            });


            $('#installment_months, #installment').on('input', function() {
                var fixPrice            =   parseFloat($('#fix_price').val());
                var firstInstallment    =   parseFloat($('#installment').val());
                var installmentMonths   =   parseInt($('#installment_months').val());
                var courseDuration      =   parseInt($('#duration').val());

                if (firstInstallment >= fixPrice)
                {
                    alert("Installment cannot be more than Fixed Price.");
                    $('#installment').val('');
                    $('#installment_months').val('');
                    $('#monthly_payment').val('');
                }

                if (installmentMonths > courseDuration) {
                    alert("Installment months cannot be more than course duration.");
                    $('#installment_months').val('');
                    $('#monthly_payment').val('');
                } else {
                    var payment         =   fixPrice - firstInstallment ;
                    var monthlyPayment  =   payment / installmentMonths;
                    $('#monthly_payment, #monthlyPayment').val(monthlyPayment.toFixed(2));
                }
            });
        });
    </script>
@endsection
