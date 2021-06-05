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
                <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                <p class="mb-4">We get it, stuff happens. Just enter your email address below
                    and we'll send you a link to reset your password!</p>
            </div>
            <form class="user" action="{{route('admin.post_forgot_password')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user"
                        id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter Email Address...">
                        @error('email')
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