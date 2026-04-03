<?php

declare(strict_types=1);

namespace Hosmelq\Loops\Responses\Events;

class EventSendResponse
{
    public function __construct(
        public readonly bool $success,
        public readonly null|string $message,
    ) {
    }
}
