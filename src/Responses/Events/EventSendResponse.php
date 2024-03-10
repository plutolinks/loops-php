<?php

declare(strict_types=1);

namespace PlutoLinks\Loops\Responses\Events;

class EventSendResponse
{
    public function __construct(
        public readonly bool $success,
        public readonly string|null $message,
    ) {
    }
}
