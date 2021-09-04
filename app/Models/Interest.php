<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Interest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'data'];

    protected $casts = ['data' => 'json'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

//    protected static function booted()
//    {
//        static::addGlobalScope('topSkill', function (Builder $builder) {
//            $builder->whereJsonContains('data->Linguagens->name', ['Assembly']);
//        });
//    }

    public function scopeTopSkill($query)
    {
        return $query->where('data->Linguagens', ['name' => 'Assembly']);
    }
}
