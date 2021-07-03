<?php
namespace App\Helper;

use Illuminate\Support\Str;

trait UploadFile {

    public function move_file ( $requestImage, $modelImage, $newFileName, $imagePath){
        $returnImageName = '';
        if( $requestImage != $modelImage ){
            $requestImage = urldecode( $requestImage );
            $fromFile = storage_path( config('app.common_upload_dir') . '/' . $requestImage );
            $fileExt = pathinfo( $fromFile, PATHINFO_EXTENSION);
            $returnImageName = Str::slug( $newFileName . ' ' . time() . ' ' . Str::random( 8 ) ) . '.' . $fileExt;
            $toFile = storage_path( $imagePath . '/' . $returnImageName );
            if( !file_exists( storage_path( $imagePath ) ) ){
                mkdir( storage_path( $imagePath ), 0777, true );
            }
            // dd( $fromFile, $toFile );
            if( !rename( $fromFile, $toFile ) ){
                $returnImageName = false;
            }
        }else{
            $returnImageName = $requestImage;
        }
        return $returnImageName;
    }
}