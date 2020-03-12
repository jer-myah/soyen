
@extends('layouts.admin_layout.admin_design')

@section('content')

<div class="row">
    <div role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="px-2 fa fa-home"></i><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Settings</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 mb-3 border-bottom">
            
            <p class="h5 text-secondary"><strong>Admin Settings</strong></p>
            @if(Session::has('flash_message_success'))
                <div class="alert alert-success alert-block" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong> {!! session('flash_message_success') !!} </strong>
                </div>
            @endif 
            @if(Session::has('flash_message_error'))
                <div class="alert alert-error alert-block" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong> {!! session('flash_message_error') !!} </strong>
                </div>
            @endif             
        </div>

        <div class="jumbotron">
            <h5 class="pb-3 lead" >Update Password</h5> <hr>
            <form class="form-signin" id="loginform" method="post" action="{{ url('/admin/update-password') }}" >
                @csrf
                <div class="row">
                    <label for="current_password" class="col-3">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="form-control col-5" placeholder="Current Password" required autofocus>
                    <span class="mx-3" id="checkpassword"></span>
                </div>
                <div class="row mt-4">
                    <label for="new_password" class="mt-3 col-3">New Password</label>
                    <input type="password" name="new_password" id="new_password" class="form-control col-5" placeholder="New Password" required>
                </div>
                <div class="row mt-4">
                    <label for="confirm_password" class="mt-3 col-3">Confirm New Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control col-5" placeholder="Confirm New Password" required>
                </div>                
                <button style="width:50%; margin:auto" class="btn btn-md btn-primary btn-block rounded-pill mt-4" type="submit">Sign in</button>
                
            </form>
        </div>
    </div>
</div>
@endsection