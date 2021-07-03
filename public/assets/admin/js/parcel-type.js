var brandDataTable;

$(document).ready(function(){
    $(".parcel-type-menu-link").addClass("active");
    brandDataTable = $("#parcel_type_table").dataTable({
        paging: true,
        serverSide: true,
        processing: true,
        ajax: {
            url : serverUrl + "parcel-type/ajax-data",
            type: "post",
            headers:{
                "X-CSRF-TOKEN" : requestToken,
            }
        },
        "columns": [
            { "data": "id", class:"text-center" },
            { "data": "name", class:"text-center" },
            { "data": "thumbnail_image_url", class:"text-center", 'orderable' : false },
            { "data": "price", class:"text-center" },
            { "data": "status", class:"text-center" },
            { "data": "id", class:"text-center", 'orderable' : false }
        ],
        "columnDefs": [
            { 
                "targets": 'parcel_type_img', 
                render: function( data, type, row  ){
                    var $img = $("<img/>",{
                        class: "img img-thumbnail",
                        style : "height:75px;",
                        src: data
                    })
                    return $img[0].outerHTML;
                    
                } 
            },
            { 
                "targets": 'parcel_type_price', 
                render: function( data, type, row  ){
                   if( data > 0 ){
                       var $rupeeIco = $("<i/>",{
                           class: "fa fa-rupee-sign"
                       })[0].outerHTML;
                       return $rupeeIco + " " + data;
                   }
                   return " - "; 
                } 
            },
            { 
                "targets": 'parcel_type_status', 
                render: function( data, type, row  ){
                    return getStatusSwitchHtml( data, row, 'parcel_type_status_switch');
                    
                } 
            },
            { 
                "targets": 'parcel_type_action', 
                render: function( id, type, row  ){
                    var data = {
                        id: id,
                        slug: 'parcel-type',
                        delete_class: 'parcel_type_delete'
                    };
                    return actionBtnHtml( data );
                    
                } 
            },
        ],
    });

    $("#parcelTypeImage").uploadImage();

    $(".del_parcel_type_img").deleteImage();
    
    $(document).on("click", ".parcel_type_delete", function (e){
        var data = {
            message: "You won't be able to revert this!",
            slug: 'parcel-type',
            datatable_id: 'parcel_type_table'
        };
        deleteRecordConfirmBox( this, e, data );
        
          
    })
    $(document).on("click", ".parcel_type_status_switch", function (e){
        var data = {
            message: "It will change the status of the selected parcel type !",
            slug: 'parcel-type',
            datatable_id: 'parcel_type_table'
        };

        confirmStatusChange( this, e, data );
        
        
          
    });

});