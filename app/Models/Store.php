<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function city()
    {
        return $this->hasOne(City::class,'id', 'city_id');
    }

    public function deals()
    {
        return $this->hasMany(Deal::class,'store_id', 'id');
    }
}
