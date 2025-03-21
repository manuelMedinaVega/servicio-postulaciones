<?php

use function Pest\Laravel\get;

test('gives back successful response for home page', function () {
    // Act & Assert
    get(route('pages.home'))->assertOk();
});
