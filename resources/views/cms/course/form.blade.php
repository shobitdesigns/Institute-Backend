@extends('cms.layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Course List</a></li>
                        <li class="breadcrumb-item active">Course Form</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Course Form</h3>
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
                        {{ Form::label('name', 'Name', []) }}<span style="color: red;"> *</span>
                        {{ Form::text('name', null, ['class' => 'form-control name', 'placeholder' => 'Enter Name', 'required']) }}
                    </div>
                    <div class="form-group col-6">
                        {{ Form::label('duration', 'Duration', []) }}<span style="color: red;"> *</span>
                        {{ Form::number('duration', null, ['class' => 'form-control name', 'placeholder' => 'Enter duration in months', 'required','min'=>'0']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        {{ Form::label('mrp', 'MRP', []) }}<span style="color: red;"> *</span>
                        {{ Form::number('mrp', null, ['class' => 'form-control mrp', 'placeholder' => 'Enter MRP', 'required','min'=>'0']) }}
                    </div>
                    <div class="form-group col-4">
                        {{ Form::label('fix_price', 'Fix Price', []) }}<span style="color: red;"> *</span>
                        {{ Form::number('fix_price', null, ['class' => 'form-control fix_price', 'placeholder' => 'Enter Fix Price', 'required','min'=>'0']) }}
                    </div>
                    <div class="form-group col-4">
                        {{ Form::label('qualification_ids[]', 'Select Qualifications', []) }}<span style="color: red;"> *</span>
                        {{ Form::select('qualification_ids[]',$qualifications,  null, ['class' => 'form-control select2 qualifications', 'multiple','placeholder' => 'Select Qualifications', 'data-placeholder' => 'Select Qualifications','required']) }}
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


        });
    </script>
@endsection
