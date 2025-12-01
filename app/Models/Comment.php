<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = ['story_id','user_id','parent_id','depth','body'];

    public function story(): BelongsTo { return $this->belongsTo(Story::class); }
    public function user(): BelongsTo { return $this->belongsTo(User::class); }

    public function parent(): BelongsTo { return $this->belongsTo(Comment::class, 'parent_id'); }

    public function children(): HasMany { return $this->hasMany(Comment::class, 'parent_id')->orderBy('created_at'); }
}
