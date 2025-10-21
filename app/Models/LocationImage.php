<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationImage extends Model
{
    protected $fillable = ['location_id', 'image_path'];

    public function location()
    {
        return $this->belongsTo(Locations::class, 'location_id');
    }
}
