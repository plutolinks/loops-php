<?php

declare(strict_types=1);

namespace PlutoLinks\Loops\Requests\Events;

use PlutoLinks\Loops\Responses\Events\EventSendResponse;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class EventSendRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        public readonly string $eventName,
        public readonly string|null $email = null,
        public readonly string|null $userId = null,
        public readonly array $properties = [],
    ) {
    }

    public function createDtoFromResponse(Response $response): EventSendResponse
    {
        /** @var array{message: string|null, success: bool} $data */
        $data = $response->json();

        return new EventSendResponse(
            success: $data['success'],
            message: $data['message'] ?? null
        );
    }

    protected function defaultBody(): array
    {
        return [
            ...$this->properties,
            ...array_filter([
                'email' => $this->email,
                'userId' => $this->userId,
            ]),
            'eventName' => $this->eventName,
        ];
    }

    public function resolveEndpoint(): string
    {
        return 'events/send';
    }
}
