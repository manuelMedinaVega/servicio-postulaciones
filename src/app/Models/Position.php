<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    protected $appends = ['details_url'];
}
