<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    protected $fillable = ['name', 'description'];

    public function images()
    {
        return $this->hasMany(LocationImage::class, 'location_id');
    }

    public function firstImage()
    {
        return $this->hasOne(LocationImage::class, 'location_id')->oldest();
    }
}
