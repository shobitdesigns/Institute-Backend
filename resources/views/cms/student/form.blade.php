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
                    <div class="form-group col-3">
                        {{ Form::label('course_id', 'Select Course', []) }}<span style="color: red;"> *</span>
                        {{ Form::select('course_id',$courses, $object->studentCourse->course_id ?? null, ['class' => 'form-control select2 course','placeholder' => 'Select Course', 'data-placeholder' => 'Select Course','required']) }}
                    </div>

                    <div class="form-group col-3">
                        {{ Form::label('tenth_document', '10th Document') }}
                        {{ Form::file('tenth_document', ['class' => 'file', 'accept' => 'application/pdf']) }}
                    </div>
                    <div class="form-group col-3">
                        {{ Form::label('twelfth_document', '12th Document') }}
                        {{ Form::file('twelfth_document', ['class' => 'file', 'accept' => 'application/pdf']) }}
                    </div>
                    <div class="form-group col-3">
                        {{ Form::label('aadhaar_document', 'Aadhaar') }}
                        {{ Form::file('aadhaar_document', ['class' => 'file', 'accept' => 'application/pdf']) }}
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
        });
    </script>
@endsection
