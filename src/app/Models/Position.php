<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Position extends Model
{
    /** @use HasFactory<\Database\Factories\PositionFactory> */
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getDetailsUrlAttribute()
    {
        return route('pages.position', $this);
    }

    public function candidates(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'applications')->using(Application::class);
    }

    protected $appends = ['details_url'];
}
