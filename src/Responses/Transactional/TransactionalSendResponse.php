<?php

declare(strict_types=1);

namespace Hosmelq\Loops\Responses\Transactional;

class TransactionalSendResponse
{
    /**
     * @param array{path: string, message: string} $error
     */
    public function __construct(
        public readonly bool $success,
        public readonly null|array $error = null,
        public readonly null|string $message = null,
        public readonly null|string $path = null,
        public readonly null|string $transactionalId = null,
    ) {
    }
}
