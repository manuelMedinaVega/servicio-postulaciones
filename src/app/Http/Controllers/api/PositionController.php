<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PositionResource;
use App\Models\Position;

class PositionController extends Controller
{

    public function index()
    {
        return PositionResource::collection(Position::whereNotNull('opened_at')->paginate());
    }

    public function show(Position $position)
    {
        return new PositionResource($position);
    }
}
