<?php

declare(strict_types=1);

namespace Hosmelq\Loops\Requests\Events;

use Hosmelq\Loops\Responses\Events\EventSendResponse;
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
        public readonly null|string $email = null,
        public readonly null|string $userId = null,
        public readonly array $properties = [],
    ) {
    }

    public function createDtoFromResponse(Response $response): EventSendResponse
    {
        /** @var array{message: null|string, success: bool} $data */
        $data = $response->json();

        return new EventSendResponse(
            success: $data['success'],
            message: $data['message'] ?? null
        );
    }

    public function resolveEndpoint(): string
    {
        return 'events/send';
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
}
