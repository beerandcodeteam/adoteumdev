<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property Carbon $email_verified_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read HasOne profile
 *
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function interests(): HasMany
    {
        return $this->hasMany(Interest::class);
    }

    public function knowledge(): HasMany
    {
        return $this->hasMany(Knowledge::class);
    }

    public function sentActions(): HasMany
    {
        return $this->hasMany(Action::class, 'from_user_id', 'id');
    }

    public function receivedActions(): HasMany
    {
        return $this->hasMany(Action::class, 'to_user_id', 'id');
    }

    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'from_user_id', 'id');
    }

    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'to_user_id', 'id');
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }
}
