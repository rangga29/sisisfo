<?php

namespace App\Models\Siproblem;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $connection = 'sqlite';

    protected $fillable = ['dp_id', 'nik', 'name', 'password', 'role'];

    protected $hidden = ['password', 'remember_token',];

    protected $casts = ['password' => 'hashed'];

    public function getAuthIdentifierName(): string
    {
        return 'nik';
    }

    public function getRouteKeyName(): string
    {
        return 'nik';
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'dp_id');
    }

    public function sentSprs(): HasMany
    {
        return $this->hasMany(SPR::class, 'sender_id');
    }

    public function assignedSprs(): HasMany
    {
        return $this->hasMany(SPR::class, 'assigned_id');
    }

    public function sprMessages(): HasMany
    {
        return $this->hasMany(SprMessage::class, 'user_id');
    }
}
