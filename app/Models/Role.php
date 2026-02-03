<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = [
        'name',
        'section',
        'order',
    ];

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class)->withTimestamps();
    }
}
