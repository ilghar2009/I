<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Save extends Model
{
    protected $fillable = [
        'userId',
        'post_id',
    ];
}
