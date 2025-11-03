<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    protected $fillable = [
        'name',
        'city_id',
        'description',
        'address',
        'latitude',
        'longitude',
    ];

    public function images()
    {
        return $this->hasMany(LocationImage::class, 'location_id');
    }

    public function firstImage()
    {
        return $this->hasOne(LocationImage::class, 'location_id')->oldest();
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
