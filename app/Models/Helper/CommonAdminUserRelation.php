<?php

namespace App\Models\Helper;

trait CommonAdminUserRelation {

    public function adminUser (){
        return $this->belongsTO('\App\Models\AdminUser', 'user_id', 'id');
    }
    /**
     * @name byCurrentLoggedUser
     */
    public function scopeByCurrentLoggedUser ( $q ){
        return $q->where('user_id', auth()->id() );
    }
} 