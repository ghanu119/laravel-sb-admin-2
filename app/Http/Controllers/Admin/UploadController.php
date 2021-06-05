<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str; 

class UploadController extends Controller
{
 
    /**
     * @name uploadMedia
     * 
     */
    public function uploadMedia ( Request $request ) {
        if( $request->has('media') ){

            $contentPath = storage_path( config('app.common_upload_dir') );
            
            if( !file_exists( $contentPath ) ){
                mkdir( $contentPath, 0777, true );
            }
            $files = $request->file('media');
            $uploadedFiles = [];
            foreach( $files as $file ){
                $fileExtension = $file->getClientOriginalExtension();
                $name = $file->getClientOriginalName();
                $name = str_replace( '.'. $fileExtension, '', $name);
                $name .= '_'  . time() . Str::random(5) . '.' . $fileExtension;
                if( $file->move( $contentPath, $name ) ){
                    $uploadedFiles[] = route('admin.media.original', [  config('app.common_upload_dir') . '/'. $name] );
                }
            }
            $data = [
                'files' => $uploadedFiles
            ];
            return response()->json( $data, 200);
        }else{
            return false;
        }
    }

    /**
     * @name readOriginalMedia
     * 
     */
    public function readOriginalMedia ( $image_path ) {
        $img = storage_path( $image_path );
        if( file_exists( $img ) ){
            $imgeFile = File::get( $img );
            $type = File::mimeType( $img );
            $respone = response()->make( $imgeFile, 200 );
            $respone->header('Content-Type', $type);
            return $respone;
        }
        abort(404);
    }

    /**
     * @name readMedia
     * 
     */
    public function readMedia ( $width, $height, $image_path ) {
        $img = storage_path( $image_path );
        if( file_exists( $img ) ){
            $imgeFile = File::get( $img );
            $type = File::mimeType( $img );
            $respone = response()->make( $imgeFile, 200 );
            $respone->header('Content-Type', $type);
            return $respone;
        }
        abort(404);
    }
}
