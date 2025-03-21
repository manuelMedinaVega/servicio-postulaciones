<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Inertia\Inertia;

class PageHomeController extends Controller
{
    public function __invoke()
    {
        $positions = Position::with('company')->get();

        return Inertia::render('Home', [
            'positions' => $positions,
        ]);
    }
}
