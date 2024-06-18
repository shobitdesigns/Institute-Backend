@extends('cms.layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('qualification.index') }}">Qualification List</a></li>
                        <li class="breadcrumb-item active">Qualification Form</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Qualification Form</h3>
                <div class="card-tools"><span class="text-danger"><b>Note:-</b> </span><b>*</b> Fields are Required</div>
            </div>

            {!! Form::model($object,['method'=>$method, 'url'=>$url,  'onSubmit' => "document.getElementById('submit').disabled=true;"]) !!}
                <input type="hidden" name="id" value="{{ $object->id }}">
                <div class="card-body">
                    <div class="row ml-0"><b>Note :- </b>&nbsp;<p class="text-danger">Name field should only contain
                            alphabetical characters.</p>
                    </div>
                    <div class="form-group">
                        {{ Form::label('qualification', 'Qualification', []) }}<span style="color: red;"> *</span>
                        {{ Form::text('qualification', null, ['class' => 'form-control qualification', 'placeholder' => 'Enter Qualification', 'required']) }}
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('footerScript')
    <script>
        $(document).ready(function() {
            var category    =   $(".name").val();
            if(category == "")
            {
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

                if ( hasSpecialCharacter  || emojiRegex.test(inputValue) || hasnumeric) {
                    $('#submit').prop('disabled', true);
                } else {
                    $('#submit').prop('disabled', false);
                }
            });
        });
    </script>
@endsection
