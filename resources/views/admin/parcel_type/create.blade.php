@extends('admin.layouts.app')

@section('title')
    {{ !empty( $parcelType->name ) ? $parcelType->name : 'Create Parcel Type'}}
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ !empty( $parcelType->name ) ? $parcelType->name : 'Create Parcel Type'}}</h1>

    </div>
    @include('component.error-message')
    
    <div class="row">
        
        <div class="col-lg-12">
            
            <form action="{{route('admin.parcel_type.post_data')}}" method="POST">
                @csrf
                @if( $parcelType->id )
                    <input type="hidden" name="id" value="{{ $parcelType->id }}">
                @endif
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ !empty( $parcelType->id  ) ? 'Edit Parcel Type' :'Create Parcel Type'}}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label>
                                        Title
                                    </label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter title" value="{{old('name', $parcelType->name)}}">
                                    @error('name')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 pl-0">
        
                                        <label for="parcelTypeImage">
                                            Parcel Type Image
                                        </label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" data-image-preview-container="#coverImagePreview" data-image-input="parcel_type_image" id="parcelTypeImage">
                                                
                                                <label class="custom-file-label" for="parcelTypeImage">
                                                    Select Parcel Type image
                                                </label>
                                            </div>
                                        </div>
                                        @error('parcel_type_image')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mt-2 {{ !empty( old('parcel_type_image',$parcelType->original_image_url) ) ? '': 'd-none'}}" id="coverImagePreview">
                                        
                                        <ul class="mailbox-attachments align-items-stretch  list-unstyled">
                                            <li >
                                                <input type="hidden" name="parcel_type_image"  value="{{old('parcel_type_image', $parcelType->image)}}">
                                                <span class="mailbox-attachment-icon has-img h-100">
                                                    <img src="{{ old('parcel_type_image') && $parcelType->image != old('parcel_type_image') ? $parcelType->getTempImageUrl( old('parcel_type_image') ) : $parcelType->original_image_url}}" alt="Attachment" class="h-100 w-100">
                                                </span>
                                    
                                                <div class="mt-3 text-center">
                                                    
                                                    <a href="#" class="btn btn-danger btn-sm del_parcel_type_img ">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>
                                        Price
                                    </label>
                                    <input type="text" class="form-control" name="price" placeholder="Enter price" value="{{old('price', $parcelType->price)}}">
                                    @error('price')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>
                                        Details
                                    </label>
                                    <textarea name="description" class="form-control" cols="30" rows="5">{{old('description', $parcelType->description)}}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label> Status </label>
                                    <div class="input-group">
        
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" value="y" type="radio" id="active" name="status" {{ old('status', $parcelType->status) == 'y' ? 'checked' : ''}}>
                                            <label for="active" class="custom-control-label">Active</label>
                                        </div>
                                        <div class="custom-control custom-radio ml-2">
                                            <input class="custom-control-input" type="radio" value="n" id="inactive" name="status" {{ old('status', $parcelType->status) == 'n' ? 'checked' : ''}}>
                                            <label for="inactive" class="custom-control-label">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('admin.parcel_type')}}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('js-footer')
    
    <script src="{{url('assets/admin/js/parcel-type.js')}}"></script>
    
@endsection