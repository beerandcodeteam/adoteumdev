<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $data
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read User $user_id
 */
class Knowledge extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'data'];

    protected $casts = ['data' => 'array'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
