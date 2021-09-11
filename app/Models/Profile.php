<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $provider
 * @property string $nickname
 * @property string $avatar
 * @property string $data
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read User $user_id
 */
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
