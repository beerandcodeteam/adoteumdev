<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $data
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read User $user_id
 */
class Interest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skill_id',
        'level',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }
//    TODO: Validar utilidade/validade de skills
    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }
}
