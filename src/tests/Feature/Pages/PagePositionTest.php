<?php

use App\Models\Position;

use function Pest\Laravel\get;

it('shows position details', function () {
    // Arrange
    $position = Position::factory()->create();

    // Act & Assert
    get(route('pages.position', $position))
        ->assertOk()
        ->assertInertia(function ($page) use ($position) {
            $page->has('position')
                ->where('position.company.name', $position->company->name)
                ->where('position.title', $position->title)
                ->where('position.location', $position->location)
                ->where('position.description', $position->description);
        });
});
