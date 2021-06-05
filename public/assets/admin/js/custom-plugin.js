function statusChangeFn( data ){
    $.ajax({
        url : serverUrl + data.slug +"/" + data.id +"/change-status",
        type : "post",
        headers : {
            "X-CSRF-TOKEN" : requestToken
        },
        success:function ( res ) {
            
            toastr.success(res.message);
            $("#" + data.datatable_id ).DataTable().ajax.reload();
        },
        error: function () {
            toastr.error("Error ! Please try again");
        },
        complete: function (){

        }
    })
}

function confirmStatusChange ( el, e, data ){
    e.preventDefault();
    var $this = $(el);
    var id = $this.data("id");
    data.id = id;
    Swal.fire({
        title: 'Are you sure?',
        text: data.message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it!'
        }).then((result) => {
            
        if (result.value) {
            statusChangeFn( data );
        }
    })
}

function deleteRecord ( data ) {
    $.ajax({
        url : serverUrl + data.slug + "/" + data.id +"/delete",
        type : "post",
        headers : {
            "X-CSRF-TOKEN" : requestToken
        },
        success:function ( res ) {
            
            toastr.success(res.message);
            $("#" + data.datatable_id ).DataTable().ajax.reload();
        },
        error: function ( err ) {
            var errData = err.responseJSON;
            var message = "Error ! Please try again";
            if( errData && errData.message ){
                message = errData.message;
            }
            toastr.error( message );
        },
        complete: function (){

        }
    })
    
}

function deleteRecordConfirmBox( el, e, data ) {
    e.preventDefault();
    var $this = $(el);
    var id = $this.data("id");
    data.id = id;
    Swal.fire({
        title: 'Are you sure?',
        text: data.message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            
        if (result.value) {
            deleteRecord( data );
        }
    })
}

function getStatusSwitchHtml ( status, rowData, className ){
    var customSwitch = $("<div/>",{
        class: "custom-control custom-switch custom-switch-off-danger custom-switch-on-success"
    });
    var inputSwitch = $("<input/>",{
        type: "checkbox",
        class: "custom-control-input " + className,
        checked : status == 'y',
        id : "switch_" + rowData.id,
        "data-id" : rowData.id
    }).appendTo( customSwitch );
    var inputSwitch = $("<label/>",{
        class: "custom-control-label",
        for : "switch_" + rowData.id

    }).appendTo( customSwitch );
    return customSwitch[0].outerHTML;
}

function actionBtnHtml ( data ) {
    var $edit = $("<a/>", {
        html : "<i class='fa fa-edit text-primary' title='Edit'>",
        href : serverUrl + data.slug + "/" + data.id + "/edit"
    })[0].outerHTML
    var $delete = '';
    if( data.delete_class ){

        $delete = $("<a/>", {
            html : "<i class='fa fa-trash text-danger' title='Delete'>",
            href : "#",
            class : "text-red " + data.delete_class,
            "data-id": data.id
        })[0].outerHTML;
    }
    if( $delete !== '' ){
        $delete = ' | ' + $delete;
    }
    return $edit + $delete;
}
$.fn.deleteImage = function ( ){
    var $this = $(this);
    $this.click(function( e ){
        var $thisEl = $(this);
        e.preventDefault();

        Swal.fire({
            title: 'Delete?',
            text: "Are you sure to remove the selected image?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
              
            if (result.value) {
                $thisEl.closest("li").remove();
            }
          })
    })
}

$.fn.uploadImage = function (){
    var $this = $(this);
    
    $this.change( function (){
        var fileUploadInput = $(this);
        var isMultiple = false;
        var files = this.files;
        var form = new FormData;
        var imgPreviewId = $this.data('image-preview-container');
        var imgInput = $this.data('image-input');

        if( $this.data('multiple') ){
            isMultiple = true;
            $.each( files, function( k, file){
    
                form.append('media[]', file);
            })
        }else{
    
            form.append('media[]', files[0]);
        }
        $.ajax({
            url : serverUrl + "upload-media",
            type : "post",
            data : form,
            headers : {
                "X-CSRF-TOKEN" : requestToken
            },
            contentType: false,
            processData: false,
            success:function ( res ) {
                if( "files" in res && res.files && res.files.length ){
                    $imgPreviewContainerEl = $( imgPreviewId );
                    $imgPreviewContainerEl.removeClass("d-none");
                    if( $imgPreviewContainerEl.find( "ul.mailbox-attachments").length ){
                        $ul = $imgPreviewContainerEl.find( "ul.mailbox-attachments");
                    }else{
                        $ul = $("<ul/>",{
                            class: "mailbox-attachments d-flex align-items-stretch clearfix"
                        });
    
                    }
    
                    $.each( res.files, function ( key, url){
                        if( !isMultiple ){
                            $ul.html("");
                        }
                        var imageName = url.split("/");
                        imageName = imageName[ imageName.length - 1 ];
    
                        $li = $("<li/>",{}).appendTo( $ul );
                        $attachmentIconSpan = $("<span/>",{
                            class: "mailbox-attachment-icon has-img h-100"
                        }).appendTo( $li );
                        $imgEl = $("<img/>",{
                            src: url,
                            class: "h-100 w-100"
                        }).appendTo( $attachmentIconSpan );
                        $attachmentInfoDiv = $("<div/>",{
                            class: "mailbox-attachment-info"
                        }).appendTo( $li );
                        $attachmentSizeSpan = $("<span/>",{
                            class: "mailbox-attachment-size clearfix mt-1"
                        }).appendTo( $attachmentInfoDiv );
                        $delImgLink = $("<a/>",{
                            class: "btn btn-danger btn-sm float-right",
                            href: "#",
                        }).appendTo( $attachmentSizeSpan );
                        
                        $delImgLink.deleteImage();
                        
                        $trashIcon = $("<i/>",{
                            class: "fas fa-trash"
                        }).appendTo( $delImgLink );
                        
                        $inputHiddenEl = $("<input/>",{
                            type: "hidden",
                            name: imgInput,
                            value: imageName
                        }).appendTo( $li );

                        // $('[name="'+imgInput+'"]').val( imageName );
                        if( !isMultiple ){
                            // $('[name="'+imgInput+'"]').val( imageName );
                            return false;
                        }
                    });
                    
                }
            },
            error: function () {
                toastr.error("Error ! Something went wrong. Please try again.");
            },
            complete: function (){
                fileUploadInput.val(null);
            }
        })
    })
}

$.fn.metaKeywordsSelect2 = function () {
    return $(this).select2({
        theme: "bootstrap4",
        multiple:true,
        clear:true,
        tags: true,
        ajax: {
            url: serverUrl + "select2/meta-keywords",
            type: "POST",
            headers:{
                "X-CSRF-TOKEN" : requestToken
            },
            dataType: 'json',
            data: function (params) {
                var query = {
                  search: params.term,
                  page: params.page || 1
                }
          
                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data.data,
                    pagination: {
                        more: data.hasMorePage
                    }
                };
              }
        }
    });
}

$.fn.categorySelect2 = function ( id ) {
    if( id == undefined ){
        id = null;
    }
    return $(this).select2({
        theme: "bootstrap4",
        clear:true,
        ajax: {
            url: serverUrl + "select2/category",
            type: "POST",
            headers:{
                "X-CSRF-TOKEN" : requestToken
            },
            dataType: 'json',
            data: function (params) {
                var query = {
                  id: id,
                  search: params.term,
                  page: params.page || 1
                }
          
                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data.data,
                    pagination: {
                        more: data.hasMorePage
                    }
                };
              }
        }
    });
}

$.fn.attrValSelect2 = function ( id ) {
    if( id == undefined ){
        id = null;
    }
    return $(this).select2({
        theme: "bootstrap4",
        clear:true,
        multiple:true,
        ajax: {
            url: serverUrl + "select2/attribute-values",
            type: "POST",
            headers:{
                "X-CSRF-TOKEN" : requestToken
            },
            dataType: 'json',
            data: function (params) {
                var query = {
                    attr_id: id,
                    search: params.term,
                    page: params.page || 1
                }
          
                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data.data,
                    pagination: {
                        more: data.hasMorePage
                    }
                };
              }
        }
    });
}

$.fn.select2WithAjax = function ( data ) {
    var select2Data = {
        theme: "bootstrap4",
        allowClear:true,
        multiple: ( data && "multiple" in data ? data.multiple : true ),
        tags: ( data && "tags" in data ? data.tags : false ),
        ajax: {
            url: serverUrl + data.slug,
            type: "POST",
            headers:{
                "X-CSRF-TOKEN" : requestToken
            },
            dataType: 'json',
            data: function (params) {
                var queryData = {
                    search: params.term,
                    page: params.page || 1
                }
                if( "search_param" in data && data.search_param ){
                    if( typeof data.search_param == "function" ){

                        queryData = Object.assign( queryData, data.search_param() );
                    }else{

                        queryData = Object.assign( queryData, data.search_param);
                    }
                }
                // Query parameters will be ?search=[term]&type=public
                return queryData;
            },
            processResults: function (data) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data.data,
                    pagination: {
                        more: data.hasMorePage
                    }
                };
              }
        }
    }
    if( "select2_data" in data && data.select2_data ){

        select2Data = data.select2_data;
    }
    return $(this).select2( select2Data );
}

$.fn.attributeSelect2 = function ( selectedAttrData ) {
    return $(this).select2({
        theme: "bootstrap4",
        clear:true,
        ajax: {
            url: serverUrl + "select2/attributes",
            type: "POST",
            headers:{
                "X-CSRF-TOKEN" : requestToken
            },
            dataType: 'json',
            data: function (params) {
                var query = {
                  id: id,
                  selected: selectedAttrData(),
                  search: params.term,
                  page: params.page || 1
                }
          
                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data.data,
                    pagination: {
                        more: data.hasMorePage
                    }
                };
              }
        }
    });
}