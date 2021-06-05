<?php

namespace App\Models\Helper;

use DB;

trait CommonFunction {

    public function getIsActiveAttribute (){
        return $this->status == 'y';
    }
    
    public function scopeActive ( $q ){
        return $q->where( $this->table. '.status', '=', DB::raw('"y"') );
    }

    /**
     * @name getTempImageUrl
     * 
     */
    public function getTempImageUrl( $img ){
        return route('admin.media.original', [ config('app.common_upload_dir') . '/' . $img]);
    }

    
    /**
     * @name image_path
     * 
     */
    public function getImagePathAttribute(){
        if( !empty( $this->image ) ){

            return self::IMAGE_PATH . '/' . $this->image;
        }else{
            return null;
        }
    }

    /**
     * @name thumbnail_image_url
     * 
     */
    public function getThumbnailImageUrlAttribute(){
        if( !empty( $this->image ) ){

            return route('admin.media.fetch', [ '75','75',self::IMAGE_PATH . '/' . $this->image]);
        }else{
            return null;
        }
    }

    /**
     * @name original_image_url
     * 
     */
    public function getOriginalImageUrlAttribute(){
        if( !empty( $this->image ) ){

            return route('admin.media.original', [ self::IMAGE_PATH . '/' . $this->image]);
        }else{
            return null;
        }
    }

} 