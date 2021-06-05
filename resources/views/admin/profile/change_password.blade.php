@extends('admin.layouts.app')

@section('title')
    Change Passwords
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Change Password</h1>

    </div>
    @include('component.error-message')
    
    <div class="row">
        
        <div class="col-lg-12">
            
            <form action="{{route('admin.profile.change_password.post_data')}}" method="POST">
                @csrf
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label>
                                        Current Password
                                    </label>
                                    <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                                    @error('current_password')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>
                                        New Password
                                    </label>
                                    <input type="password" class="form-control" name="password" placeholder="New Password">
                                    @error('password')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>
                                        Confirm New Password
                                    </label>
                                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm New Password">
                                    @error('confirm_password')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
