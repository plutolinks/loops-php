<?php

declare(strict_types=1);

namespace PlutoLinks\Loops\Responses\Transactional;

class TransactionalSendResponse
{
    /**
     * @param array{path: string, message: string} $error
     */
    public function __construct(
        public readonly bool $success,
        public readonly array|null $error = null,
        public readonly string|null $message = null,
        public readonly string|null $path = null,
        public readonly string|null $transactionalId = null,
    ) {
    }
}
