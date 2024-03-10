<?php

declare(strict_types=1);

namespace PlutoLinks\Loops\Responses\Contacts;

class ContactDeleteResponse
{
    public function __construct(
        public readonly string $message,
        public readonly bool $success,
    ) {
    }
}
