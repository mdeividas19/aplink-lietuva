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
    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorite_user_locations', 'location_id', 'user_id')->withTimestamps();
    }
    public function reviews(){
        return $this->hasMany(Review::class, 'location_id');
    }
    public function getAverageRatingAttribute()
{
    return $this->reviews()->avg('rating');
}
}
