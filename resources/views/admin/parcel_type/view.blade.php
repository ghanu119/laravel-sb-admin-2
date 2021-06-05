@extends('admin.layouts.app')

@section('title')
    All Parcel Types
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Parcel Types</h1>
        <a href="{{route('admin.parcel_type.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Create New
        </a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Parcel Types Lists</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="parcel_type_table" class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                            <tr role="row">
                                <th>#</th>
                                <th>Name</th>
                                <th class="parcel_type_img">Image</th>
                                <th class="parcel_type_status">Status</th>
                                <th class="parcel_type_action">Action</th>
                            </thead>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-header d-none">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Parcel Types</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.index')}}">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        Parcel Types
                    </li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content d-none">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
               
                    <div class="card card-grey">
                        <div class="card-header">
                            <h3 class="card-title">
                                Parcel Types Lists
                            </h3>
                            <div class="btn-group float-right" role="group">
                                <a href="{{route('admin.parcel_type.create')}}" class="btn btn-dark" >
                                    <i class="fa fa-plus"></i>
                                    Create New 
                                </a>
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="parcel_type_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th class="parcel_type_img">Image</th>
                                    <th class="parcel_type_status">Status</th>
                                    <th class="parcel_type_action">Action</th>
                                </thead>
                                
                              </table>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
</section>
@endsection
@section('js-footer')
    <script src="{{url('assets/admin/js/parcel-type.js')}}"></script>
    
@endsection