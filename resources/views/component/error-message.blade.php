@if( session()->has('error-message') )
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5>
        <i class="icon fas fa-ban"></i> Error!
    </h5>
    {{ session()->get('error-message') }}
</div>
@endif
@if( session()->has('success-message') )
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5>
        <i class="icon fas fa-check"></i> Success!
    </h5>
    {{ session()->get('success-message') }}
</div>
@endif