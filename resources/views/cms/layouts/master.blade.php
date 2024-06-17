<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UKUU-EMS | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ asset('assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- toastr -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/toastr/toastr.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    @yield('headerLinks')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @php
        use App\Models\Setting;
        $setting = Setting::first();
    @endphp

    <div class="wrapper">

        <!-- Navbar -->
        @include('cms.layouts.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('cms.layouts.sidebar')


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <button class="btn btn-block btn-outline-primary col-2 ml-auto customButton"
                onclick="registerStudent()">Register
                Student
                &nbsp;&nbsp; <i class="fa fa-plus-circle"></i></button>
            <!-- Main content -->
            @yield('content')
            <!-- /.content -->

            <div class="modal fade show" id="register-student-form" style="display: none; padding-right: 17px;"
                aria-modal="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Register New Student</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" id="close-btn-form" onclick="registerStudent()">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open([
                                'url' => route('student.store'),
                                'method' => 'POST',
                                'id' => 'student-register-form',
                                'onSubmit' => "document.getElementById('register-student-submit').disabled=true;",
                            ]) !!}
                            <div class="card-body">
                                <div class="form-group">
                                    {{ Form::label('first_name', 'First Name', []) }}<span style="color: red;">
                                        *</span>
                                    {{ Form::text('first_name', null, ['class' => 'form-control ', 'id' => 'first-name', 'placeholder' => 'Enter First Name', 'required']) }}
                                    <small id="firstNameError" style="color: red; display: none;">First Name is
                                        required.
                                    </small>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('last_name', 'Last Name', []) }}<span style="color: red;"> *</span>
                                    {{ Form::text('last_name', null, ['class' => 'form-control', 'id' => 'last-name', 'placeholder' => 'Enter Last Name', 'required']) }}
                                    <small id="lastNameError" style="color: red; display: none;">Last Name is required.
                                    </small>
                                </div>
                                <div class="form-group wdAdjust">
                                    {{ Form::label('mobile', 'Mobile Number', []) }}<span style="color: red;">
                                        *</span>
                                    {{ Form::number('mobile', null, ['class' => 'form-control customwdajust', 'id' => 'mobile-number', 'placeholder' => 'Enter Mobile Number', 'required']) }}
                                    <small id="mobileNumberError" style="color: red; display: none;">Mobile Number is
                                        required.
                                    </small>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('email', 'Email', []) }}<span style="color: red;"> *</span>
                                    {{ Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter Email', 'required']) }}
                                    <small id="emailStudentError" style="color: red; display: none;">Email is required
                                    </small>
                                </div>
                                @php
                                    $courses = App\Models\Course::pluck('name', 'id')->toArray();
                                @endphp
                                <div class="form-group">
                                    {{ Form::label('course_id', 'Select Course', []) }}<span style="color: red;">
                                        *</span>
                                    {{ Form::select('course_id', $courses, null, ['class' => 'form-control select2', 'id' => 'courseId', 'data-placeholder' => 'Select Course', 'placeholder' => 'Select Course', 'required']) }}
                                    <small id="courseError" style="color: red; display: none;">Course feild is required
                                    </small>
                                </div>
                            </div>
                            <div class="row" id="right-button">
                                <button type="submit" class="btn btn-primary" id="register-student-submit">Register
                                    Student</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024-2030 <a href="#">UKUU-EMS</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets/adminlte/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets/adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets/adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <!-- Summernote -->
    <script src="{{ asset('assets/adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/adminlte/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('assets/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('assets/adminlte/plugins/toastr/toastr.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: "bootstrap4",
                allowClear: true
            });


            $('#student-register-form').submit(function(e) {
                e.preventDefault();
                if (!validateData(this)) {
                    return false;
                }
                var url = $(this).attr("action");
                let formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        toastr.success('Candidate registered successfully');
                        location.reload();
                    },
                    error: function(failure) {
                        if (failure.responseJSON && failure.responseJSON.errors) {
                            // If there are detailed error messages for specific fields
                            $.each(failure.responseJSON.errors, function(key, value) {
                                toastr.error(value);
                            });
                            $("#student-register-form").find("#register-student-submit").prop(
                                "disabled", false);
                        }
                    }
                });

            });

            $('#mobile-number').on('input', function() {
                var mobileNumber = $(this).val();
                if (mobileNumber.length > 10) {
                    $(this).val(mobileNumber.slice(0, 10));
                }
            });



        });

        function registerStudent() {
            $("#register-student-form").modal("show");
        }

        function validateData(formObject) {
            var firstName = $("#first-name").val();
            var lastName = $("#last-name").val();
            var mobileNumber = $("#mobile-number").val();
            var email = $("#email").val();
            var courseId = $("#courseId").val();
            if (firstName == "" || firstName == null) {
                $('#firstNameError').toggle();
                return false;
            }
            if (lastName == "" || lastName == null) {
                $('#lastNameError').toggle();
                return false;
            }
            if (mobileNumber == "" || mobileNumber == null) {
                $('#mobileNumberError').toggle();
                return false;
            }
            if (email == "" || email == null) {
                $('#emailStudentError').toggle();
                return false;
            }
            if (courseId == "" || courseId == null) {
                $('#courseError').toggle();
                return false;
            }

            return true;
        }

        if ("{{ session()->has('success') }}") {
            let message = "{{ session()->get('success') }}";
            toastr.success(message);
        }

        if ("{{ session()->has('error') }}") {
            let message = "{{ session()->get('error') }}";
            toastr.error(message);
        }

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif

        function confirmBox(submitBtnTarget) {
            let result = confirm("Want to delete?");
            if (result) {
                $(submitBtnTarget).closest("form").submit();
            }

        }

        function deleteItem(path) {
            var sure = confirm('are you sure');
            if (!sure) {
                return false;
            }

            $.ajax({
                url: path,
                type: 'DELETE',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    toastr.success('Successfully Deleted');
                    location.reload();
                },
                error: function(response) {
                    if (response.status == '404') {
                        alert("Item not found");
                    } else
                        alert(response.statusText);
                }
            });
        }
    </script>
    @yield('footerScript')
</body>

</html>
