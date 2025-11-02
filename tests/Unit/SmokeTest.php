<?php

declare(strict_types=1);

it('boots the testbench', function () {
    expect(app())->not->toBeNull();
});
