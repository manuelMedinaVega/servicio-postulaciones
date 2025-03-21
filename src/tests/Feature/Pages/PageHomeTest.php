<?php

use App\Models\Position;

use function Pest\Laravel\get;

it('show positions overview', function () {
    // Arrange
    $firstPosition = Position::factory()->create();
    $secondPosition = Position::factory()->create();

    // Act & Assert
    get(route('pages.home'))
        ->assertOk()
        ->assertInertia(function ($page) use ($firstPosition, $secondPosition) {
            $page->has('positions', 2)
                ->where('positions.0.company.name', $firstPosition->company->name)
                ->where('positions.0.title', $firstPosition->title)
                ->where('positions.0.location', $firstPosition->location)
                ->where('positions.1.company.name', $secondPosition->company->name)
                ->where('positions.1.title', $secondPosition->title)
                ->where('positions.1.location', $secondPosition->location);
        });
});

it('includes positions links', function () {
    // Arrange
    $firstPosition = Position::factory()->create();
    $secondPosition = Position::factory()->create();

    // Act & Assert
    get(route('pages.home'))
        ->assertOk()
        ->assertInertia(function ($page) use ($firstPosition, $secondPosition) {
            $page->has('positions', 2)
                ->where('positions.0.details_url', route('pages.position', $firstPosition))
                ->where('positions.1.details_url', route('pages.position', $secondPosition));
        });
});
