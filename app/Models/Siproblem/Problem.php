<?php

namespace App\Models\Siproblem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Problem extends Model
{
    protected $connection = 'sqlite';

    protected $fillable = ['dp_id', 'pr_ucode', 'pr_name'];

    public function getRouteKeyName(): string
    {
        return 'pr_ucode';
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'dp_id');
    }

    public function sprs(): HasMany
    {
        return $this->hasMany(Spr::class, 'pr_id');
    }
}
