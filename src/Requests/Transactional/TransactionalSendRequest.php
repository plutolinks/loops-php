<?php

declare(strict_types=1);

namespace PlutoLinks\Loops\Requests\Transactional;

use PlutoLinks\Loops\Responses\Transactional\TransactionalSendResponse;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class TransactionalSendRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        public readonly string $transactionalId,
        public readonly string $email,
        public readonly array $dataVariables,
        public readonly array $attachments,
    ) {
    }

    public function createDtoFromResponse(Response $response): TransactionalSendResponse
    {
        /** @var array{error: array{path: string, message: string}|null, message: string|null, path: string|null, success: bool, transactionalId: string|null} $data */
        $data = $response->json();

        return new TransactionalSendResponse(
            success: $data['success'],
            error: $data['error'] ?? null,
            message: $data['message'] ?? null,
            path: $data['path'] ?? null,
            transactionalId: $data['transactionalId'] ?? null,
        );
    }

    protected function defaultBody(): array
    {
        return [
            'attachments' => $this->attachments,
            'dataVariables' => $this->dataVariables,
            'email' => $this->email,
            'transactionalId' => $this->transactionalId,
        ];
    }

    public function resolveEndpoint(): string
    {
        return 'transactional';
    }
}
