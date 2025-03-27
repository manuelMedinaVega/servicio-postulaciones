<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Application extends Pivot
{
    protected $table = 'applications';

    public $incrementing = true;
}
