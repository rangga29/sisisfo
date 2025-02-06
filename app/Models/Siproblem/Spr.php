<?php

namespace App\Models\Siproblem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Spr extends Model
{
    protected $connection = 'sqlite';

    protected $fillable = ['dp_id', 'pr_id', 'sender_id', 'assigned_id', 'spr_ucode', 'spr_title', 'spr_status'];

    public function getRouteKeyName(): string
    {
        return 'spr_ucode';
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'dp_id');
    }

    public function problem(): BelongsTo
    {
        return $this->belongsTo(Problem::class, 'pr_id');
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function assigned(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(SprMessage::class, 'spr_id');
    }
}
