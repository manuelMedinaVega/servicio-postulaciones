<?php

use App\Models\Position;
use App\Models\User;

it('has applications', function () {
    // Arrange
    $user = User::factory()->create();
    $positionA = Position::factory()->create();
    $positionB = Position::factory()->create();
    $user->applications()->attach([$positionA, $positionB]);

    // Act & Assert
    expect($user->applications)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(Position::class);
});

it('detects when user has already applied to a position', function () {
    // Arrange
    $user = User::factory()->create();
    $position = Position::factory()->create();

    // Act
    $user->applications()->attach($position);

    // Assert
    expect($user->applications()->where('position_id', $position->id)->exists())
        ->toBeTrue();
    expect($user->hasAppliedTo($position))
        ->toBeTrue();
});
