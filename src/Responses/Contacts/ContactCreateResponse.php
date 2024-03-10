<?php

declare(strict_types=1);

namespace PlutoLinks\Loops\Responses\Contacts;

class ContactCreateResponse
{
    public function __construct(
        public readonly bool $success,
        public readonly string|null $id,
        public readonly string|null $message,
    ) {
    }
}
