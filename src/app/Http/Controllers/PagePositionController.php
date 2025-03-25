<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Inertia\Inertia;

class PagePositionController extends Controller
{
    public function __invoke(Position $position)
    {
        $position->load('company');

        $user = auth()->user();

        return Inertia::render('Position', [
            'position' => $position,
            'hasApplied' => $user ? $user->hasAppliedTo($position) : false,
        ]);
    }
}
