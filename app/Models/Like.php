<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Like extends Model
{
    protected $fillable = [
        'userId',
        'likeable_type',
        'likeable_id',
    ];

    public function likeable():MorphTo
    {
        return $this->morphTo();
    }
}
