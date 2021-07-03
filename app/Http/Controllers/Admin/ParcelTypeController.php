<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UploadFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ParcelTypeCreateRequest;
use App\Models\ParcelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ParcelTypeController extends Controller
{
    use UploadFile;
 
    /**
     * @name index
     * 
     */
    public function index ( ) {
        return view('admin.parcel_type.view');
    }

    /**
     * @name ajaxTableData
     * 
     * Return datatable ajax data 
     */
    public function ajaxTableData ( Request $request ){
        $orderColumns = [
            'id',
            'name',
            '',
            'price',
            'status',
            'created_at',
        ];
        $totalRecords = ParcelType::count();
        $parcelTypes = ParcelType::query();
        
        if( $request->has('search') ){
            $search = $request->get('search');
            if( !empty( $search['value'] )){

                $parcelTypes = $parcelTypes->allColumnFilter( $search['value'] );
            }
        }
        
        $fileteredRecords = $parcelTypes->count();
        
        if( $request->has('order') ){
            $order = $request->get('order')[0];
            $parcelTypes = $parcelTypes->orderBy( $orderColumns[ $order['column'] ], $order['dir'] );
        }
        $parcelTypes = $parcelTypes->latest()
                        ->take( $request->get('length', 10) )
                        ->skip( $request->get('start', 0))
                        ->get();

        $parcelTypes->map(function($item, $key)
                {
                    $item->setAppends(['thumbnail_image_url']);

                    return $item;
                });
        
        $data = [
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $fileteredRecords,
            'data' => $parcelTypes,
        ];
        return response()->json( $data, 200);
    }
    /**
     * @name create
     * 
     */
    public function create ( ParcelType $parcelType ) {
        $parcelType->status = 'n'; 
        return view('admin.parcel_type.create', compact('parcelType'));
    }
 
    /**
     * @name edit
     * 
     */
    public function edit ( ParcelType $parcelType ) {
        return view('admin.parcel_type.create', compact('parcelType'));
    }

    /**
     * @name store
     * 
     */
    public function store ( ParcelTypeCreateRequest $request ) {
        $messageKey = 'success-message';
        $message = '';
        if( $request->has('id') ){
            $parcelType = ParcelType::find( $request->get('id') );
            $message = 'Parcel Type has been updated successfully.';
        }else{
            $parcelType = new ParcelType;
            $message = 'Parcel Type has been created successfully.';

        }
        
        $newFileName = $this->move_file( $request->get('parcel_type_image'), $parcelType->image, $request->get('name'), ParcelType::IMAGE_PATH );

        if( $newFileName !== false ){
            if( $parcelType->name != $request->get('name') ){
                $parcelType->slug = Str::slug( $request->get('name') );
            }
            // $parcelType->user_id = auth()->id();
            $parcelType->name = $request->get('name');
            $parcelType->image = $newFileName;
            $parcelType->description = $request->get('description');
            $parcelType->price = $request->get('price');
            // $parcelType->meta_keywords = $this->storeMetaKeywords( $request->get('keywords') );
            // $parcelType->meta_description = $request->get('meta_description');
            $parcelType->status = $request->get('status');
            $parcelType->save();
            return redirect()->back()->with( $messageKey, $message );
        }else{
            
            $message = 'Cover image not found.';
            $messageKey = 'error-message';
            return redirect()->back()->with( $messageKey, $message )->withInput();
        }

    }

    

    /**
     * @name delete
     * 
     * Remove Parcel Type complete
     * 
     */
    public function delete ( ParcelType $parcelType) {
        $parcelType->delete();
        $data = [
            'message' => 'Success ! Parcel Type has been removed.'
        ];
        return response()->json( $data, 200 );
    }

    /**
     * @name changeStatus
     * 
     * Change status of Parcel Type
     * 
     */
    public function changeStatus ( ParcelType $parcelType) {
        if( $parcelType->status == 'y' ){
            $parcelType->status = 'n';
        }else{
            
            $parcelType->status = 'y';
        }
        $parcelType->save();
        $data = [
            'message' => 'Success ! Parcel Type status changed successfully.'
        ];
        return response()->json( $data, 200 );
    }
}
