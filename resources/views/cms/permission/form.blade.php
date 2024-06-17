@extends('cms.layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('permission.index') }}">Permission List</a></li>
                        <li class="breadcrumb-item active">Permission Form</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Permission Form</h3>
                <div class="card-tools"><span class="text-danger"><b>Note:-</b> </span><b>*</b> Fields are Required</div>
            </div>

            {{Form::model($object,['url'=>$url,'method'=>$method,'onSubmit'=>"document.getElementById('submit').disabled=true;"])}}
                <input type="hidden" name="id" value="{{$object->id}}">
                <div class="card-body">
                    <div class="row ml-0"><b>Note :- </b>&nbsp;<p class="text-danger">Name field should only contain alphabetical characters.</p></div>
                    <div class="form-group">
                        {{Form::label("module_id","Module",[])}}<span style="color: red;"> *</span>
                        {{Form::select("module_id",$modules, null, ['class'=>'form-control select2','placeholder'=>'Select Module','data-placeholder'=>'Select Module','required'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label("name","Name",[])}}<span style="color: red;"> *</span>
                        {{Form::text("name", null, ['class'=>'form-control name','placeholder'=>'Enter Name','required'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label("description","Description",[])}}
                        {{Form::text("description", null, ['class'=>'form-control','placeholder'=>'Enter Description'])}}
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                </div>
            {{Form::close()}}
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
