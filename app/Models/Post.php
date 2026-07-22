<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Post extends Model
{
    protected $fillable = [
        'userId',
        'body',
    ];

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
