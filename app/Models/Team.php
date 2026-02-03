<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'genre',
        'section',
        'niveau',
        'photo',
        'ffvolley_embed_url',
    ];

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
        );
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, 'team_player')
            ->withPivot(['number', 'position'])
            ->withTimestamps();
    }

    public function coachs(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, 'team_player')
            ->withPivot(['number', 'position'])
            ->wherePivot('position', 'Coach')
            ->withTimestamps();
    }

    public function joueurs(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, 'team_player')
            ->withPivot(['number', 'position'])
            ->wherePivot('position', '!=', 'Coach')
            ->orderByPivot('number')
            ->withTimestamps();
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? asset('storage/'.$this->photo) : null;
    }
}
