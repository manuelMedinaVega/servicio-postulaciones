<?php

use App\Jobs\NewApplication;
use App\Models\Application;
use App\Models\Position;
use Illuminate\Support\Facades\Queue;

use function Pest\Laravel\post;

it('redirect if not user is logged in', function () {
    // Arrange
    $position = Position::factory()->create();

    // Act & Assert
    post(route('positions.apply'), [
        'position_id' => $position->id,
    ])->assertRedirect(route('login'));

    $this->assertDatabaseCount(Application::class, 0);
});

it('only a logged in user can apply for a position', function () {
    // Arrange
    Queue::fake();

    $position = Position::factory()->create();

    // Act & Assert
    $user = loginAsUser();

    post(route('positions.apply'), [
        'position_id' => $position->id,
    ])->assertRedirect(route('pages.position', $position));

    $this->assertDatabaseHas('applications', [
        'user_id' => $user->id,
        'position_id' => $position->id,
    ]);
});

it('a user can apply for a position only once', function () {
    // Arrange
    Queue::fake();

    $position = Position::factory()->create();

    // Act & Assert
    loginAsUser();

    post(route('positions.apply'), [
        'position_id' => $position->id,
    ])->assertRedirect(route('pages.position', $position));

    $this->assertDatabaseCount('applications', 1);

    $response = post(route('positions.apply'), [
        'position_id' => $position->id,
    ]);

    $response->assertSessionHasErrors(['position_id']);

    $this->assertDatabaseCount('applications', 1);
});

it('a user con only apply to an open position', function () {
    // Arrange
    Queue::fake();

    $closedPosition = Position::factory()->closed()->create();
    $openPosition = Position::factory()->create();

    // Act & Assert
    loginAsUser();

    $response = post(route('positions.apply'), [
        'position_id' => $closedPosition->id,
    ]);

    $response->assertSessionHasErrors(['position_id']);

    $this->assertDatabaseCount('applications', 0);

    post(route('positions.apply'), [
        'position_id' => $openPosition->id,
    ])->assertRedirect(route('pages.position', $openPosition));

    $this->assertDatabaseCount('applications', 1);
});

it('dispatches a NewApplication Job with info about the application', function () {
    // Arrange
    Queue::fake();

    // Act & Assert
    $position = Position::factory()->create();

    // Act & Assert
    $user = loginAsUser();

    post(route('positions.apply'), [
        'position_id' => $position->id,
    ]);

    Queue::assertPushed(NewApplication::class, function($job) use ($user, $position) {
        return $job->data['user_id'] === $user->id
            && $job->data['position_id'] === $position->id;
    });
});
