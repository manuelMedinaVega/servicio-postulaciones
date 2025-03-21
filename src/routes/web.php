<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\PageHomeController;
use App\Http\Controllers\PagePositionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', PageHomeController::class)
    ->name('pages.home');

Route::get('positions/{position:slug}', PagePositionController::class)
    ->name('pages.position');

Route::post('/positions/apply', [ApplicationController::class, 'apply'])
    ->name('positions.apply')
    ->middleware('auth');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
