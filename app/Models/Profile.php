<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'provider',
        'provider_user_id',
        'nickname',
        'avatar',
        'data'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
