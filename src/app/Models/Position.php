<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Position extends Model
{
    /** @use HasFactory<\Database\Factories\PositionFactory> */
    use HasFactory;

    // Scopes
    public function scopeOpen(Builder $query): Builder
    {
        return $query->whereNull('closed_at');
    }

    public function getDetailsUrlAttribute()
    {
        return route('pages.position', $this);
    }

    // Relationships

    public function candidates(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'applications')->using(Application::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    protected $appends = ['details_url'];
}
