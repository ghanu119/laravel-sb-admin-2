<?php

namespace App\Models\Helper;

trait CommonMetaKeywordsFunction {

    public function keywords (){
        return $this->hasManyWithCommaSeperate( '\App\Models\MetaKeyword', 'id', 'meta_keywords');
    }

    /**
     * @name meta_keywords_names
     */
    public function getMetaKeywordsNamesAttribute(){
        $metaKeywords = [];
        if( old('keywords') ){
            $metaKeywords = old('keywords');
        }else{
            if( $this->id && $this->meta_keywords ){

                $metaKeywords = $this->keywords->pluck('name')->toArray();
            }else{
                $metaKeywords = [];

            }

        }
        return $metaKeywords;
    }
} 