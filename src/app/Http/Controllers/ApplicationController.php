<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyRequest;
use App\Jobs\NewApplication;
use App\Models\Application;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ApplicationController extends Controller
{
    public function apply(ApplyRequest $request)
    {
        $user = auth()->user();

        $position = Position::find($request->position_id);

        $user->applications()->attach($position);

        NewApplication::dispatch([
            'user_id' => $user->id,
            'position_id' => $position->id,
        ])->onQueue(config('services.analisis.queue'));

        return Redirect::route('pages.position', $position);
    }
}
