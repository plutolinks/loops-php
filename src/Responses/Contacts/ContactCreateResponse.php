<?php

declare(strict_types=1);

namespace Hosmelq\Loops\Responses\Contacts;

class ContactCreateResponse
{
    public function __construct(
        public readonly bool $success,
        public readonly null|string $id,
        public readonly null|string $message,
    ) {
    }
}
