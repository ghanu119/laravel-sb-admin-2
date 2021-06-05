@extends('admin.layouts.login')

@section('title')
    Login
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6 m-auto">
        <div class="p-5">
            @include('component.error-message')
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
            </div>
            <form class="user" action="{{route('admin.post_login')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user"
                        id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter Email Address...">
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user"
                        id="exampleInputPassword" placeholder="Password">
                        @error('password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <input type="checkbox" name="remember_me" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                            Me</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Login
                </button>
               
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="{{route('admin.forgot_password')}}">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>
@endsection