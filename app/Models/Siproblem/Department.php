<?php

namespace App\Models\Siproblem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $connection = 'sqlite';
    
    protected $fillable = ['dp_code', 'dp_name', 'dp_group', 'dp_spr'];

    public function getRouteKeyName(): string
    {
        return 'id';
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'dp_id');
    }

    public function problems(): HasMany
    {
        return $this->hasMany(Problem::class, 'dp_id');
    }

    public function sprs(): HasMany
    {
        return $this->hasMany(Spr::class, 'dp_id');
    }
}
