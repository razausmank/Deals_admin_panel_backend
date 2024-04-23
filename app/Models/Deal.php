<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function store()
    {
        return $this->hasOne(Store::class,'id', 'store_id');
    }
}
