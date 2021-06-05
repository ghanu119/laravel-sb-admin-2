@extends('admin.layouts.login')

@section('title')
    Forot Password
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="p-5">
            @include('component.error-message')
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-2">Reset Your Password!</h1>
                <p>You are only one step a way from your new password, recover your password now.</p>
            </div>
            <form class="user" action="{{route('admin.post_reset_passeword')}}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token}}">
                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user"
                        id="password" placeholder="Password">
                        @error('password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="re_password" class="form-control form-control-user"
                        id="re_password" placeholder="Confirm Password">
                        @error('re_password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Reset Password
                </button>
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="{{route('admin.login')}}">Back to Login!</a>
            </div>
        </div>
    </div>
</div>
@endsection