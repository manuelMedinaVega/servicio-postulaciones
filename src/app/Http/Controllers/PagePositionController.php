<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Position;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PagePositionController extends Controller
{
    public function __invoke(Position $position)
    {
        $position->load('company');

        $user = Auth::user();

        if (! $user) {
            $applied = false;
        } else {
            $applied = Application::where('position_id', $position->id)
                ->where('user_id', $user->id)
                ->exists();
        }

        return Inertia::render('Position', [
            'position' => $position,
            'hasApplied' => $applied,
        ]);
    }
}
