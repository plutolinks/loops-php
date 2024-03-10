<?php

declare(strict_types=1);

use PlutoLinks\Loops\Loops;

it('may create a client', function (): void {
    $loops = Loops::client('asdf');

    expect($loops)->toBeInstanceOf(Loops::class);
});
