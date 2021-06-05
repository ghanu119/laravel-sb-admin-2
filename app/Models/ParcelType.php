<?php

namespace App\Models;

use App\Models\Extension\Eloquent\HasManyWithCommaSeparate\CommaSeparateRelationTrait;
use App\Models\Helper\CommonFunction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelType extends Model
{
    use HasFactory, 
        CommonFunction;

    const IMAGE_PATH = 'app/public/files/parcel_types';

    protected $table = 'parcel_types';
    
    
    
    /**
     * @name allColumnFilter
     * 
     * To get only active brand  
     */
    public function scopeAllColumnFilter ( $q, $value ){
        return $q->where(function ( $where ) use ( $value ) {
            $where->orWhere('name', 'LIKE', '%'. $value . '%');
            $where->orWhere('description', 'LIKE', '%'. $value . '%');
        });
    }

}
