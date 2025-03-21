<?php

namespace App\Http\Controllers;

use App\Jobs\NewApplication;
use App\Models\Application;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ApplicationController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate([
            'position_id' => 'required|exists:positions,id',
        ]);

        $user = Auth::user();

        $existingApplication = Application::where('user_id', $user->id)
            ->where('position_id', $request->position_id)
            ->first();

        if ($existingApplication) {
            return response()->json(['message' => 'You have already applied for this position.'], 400);
        }

        Application::create([
            'user_id' => $user->id,
            'position_id' => $request->position_id,
        ]);

        NewApplication::dispatch([
            'user_id' => $user->id,
            'position_id' => $request->position_id,
        ])->onQueue(config('services.analisis.queue'));

        $position = Position::find($request->position_id);

        return Redirect::route('pages.position', $position);
    }
}
