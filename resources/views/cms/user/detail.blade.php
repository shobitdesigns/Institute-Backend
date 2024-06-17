@extends('cms.layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User List</a></li>
                        <li class="breadcrumb-item active">User Detail</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <div class="col-12">
        <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                User Detail
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-7">
                        <h2 class="lead"><b>{{ $user->name }} </b></h2>
                        <p class="text-muted text-sm"><b>Email: </b> {{ $user->email }} </p>
                        <p class="text-muted text-sm"><b>Mobile Number: </b> {{ $user->contact_number }} </p>

                        <p class="text-muted text-sm"><b>Documents: </b> </p>
                        <div class="col-12 ">
                            @if(!empty($user->document))
                                <div class="row ml-2">
                                    @if (!empty($user->document->aadhar_card))
                                        <div class="col-3">
                                            <strong><i class="far fa-file-alt"></i> Aadhar Card</strong>
                                            <a target="_blank"
                                                href="{{ asset('uploads/documents/'.$user->id.'/'.$user->document->aadhar_card) }}"><i
                                                    class="fa fa-arrow-up-right-from-square ml-3"></i></a>
                                        </div>
                                    @endif
                                    @if (!empty($user->document->bank_document))
                                        <div class="col-3">
                                            <strong><i class="far fa-file-alt"></i> Bank Document</strong>
                                            <a target="_blank"
                                                href="{{ asset('uploads/documents/'.$user->id.'/'.$user->document->bank_document) }}"><i
                                                    class="fa fa-arrow-up-right-from-square ml-3"></i></a>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>

                    </div>
                    <div class="col-5 text-center">
                        <img src="{{ asset('uploads/users/' . $user->profile_pic) }}" style="max-width: 35%;height: auto;"
                            alt="user-avatar" class="img-circle img-fluid">
                    </div>
                </div>
            </div>

        </div>
    </div>
<div class="row"></div>
@endsection
@section('footerScript')
    <script></script>
@endsection
