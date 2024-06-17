@extends('cms.layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User List</a></li>
                        <li class="breadcrumb-item active">User Form</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">User Form</h3>
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
                <div class="form-group">
                    {{ Form::label('name', 'Name', []) }}<span style="color: red;"> *</span>
                    {{ Form::text('name', null, ['class' => 'form-control name', 'placeholder' => 'Enter Name', 'required']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Email', []) }}<span style="color: red;"> *</span>
                    {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email', 'required', 'email']) }}
                    <small id="emailError" style="color: red; display: none;">Invalid email type. Please enter an @gmail.com
                    </small>
                </div>
                <div class="form-group">
                    {{ Form::label('contact_number', 'Contact Number', []) }}<span style="color: red;"> *</span>
                    {{ Form::text('contact_number', null, ['class' => 'form-control contact_number','id'=>'numberInput' ,'placeholder' => 'Enter Contact Number', 'required']) }}
                </div>
                <div class="form-group" id="image">
                    {{ Form::label('profile_pic', 'Profile Picture') }}
                    {{ Form::file('profile_pic', ['class' => 'file', 'accept' => 'image/*']) }}
                    <div class="image-preview">
                        @if (!empty($object->profile_pic))
                            <img style="background:thistle;max-height: 150px;"
                                src={{ asset('uploads/users/' . $object->profile_pic) }} />
                        @endif
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
