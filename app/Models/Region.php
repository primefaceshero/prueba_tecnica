<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'id',
        'name',
        'code',
        'created_at',
        'updated_at'
    ];

    public function provinces(){

    }
//    public function communes(){
//        return $this->hasManyThrough(Commune::class, Province::class,'region_id', 'province_id','id', 'id');
//    }

    public function communes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Commune::class);
    }
}
