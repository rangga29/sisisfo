<?php

namespace App\Models\Siproblem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class SprMessage extends Model
{
    protected $connection = 'sqlite';

    protected $fillable = ['spr_id', 'user_id', 'spr_st_ucode', 'spr_st_description', 'spr_st_attachment'];

    public function getRouteKeyName(): string
    {
        return 'spr_st_ucode';
    }

    public function spr(): BelongsTo
    {
        return $this->belongsTo(Spr::class, 'spr_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Helper method to get the full URL of the attachment
    public function getAttachmentUrl(): ?string
    {
        return $this->attachment ? Storage::url($this->attachment) : null;
    }
}
