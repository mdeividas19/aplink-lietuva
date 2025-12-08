<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $fillable = [
        'location_id',
        'user_id',
        'rating',
        'comment',
    ];

    public function location()
    {
        return $this->belongsTo(Locations::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
