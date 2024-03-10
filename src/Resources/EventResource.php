<?php

declare(strict_types=1);

namespace PlutoLinks\Loops\Resources;

use PlutoLinks\Loops\Requests\Events\EventSendRequest;
use PlutoLinks\Loops\Responses\Events\EventSendResponse;
use Saloon\Http\BaseResource;

class EventResource extends BaseResource
{
    public function send(
        string $eventName,
        string|null $email = null,
        string|null $userId = null,
        array $properties = []
    ): EventSendResponse {
        /** @var EventSendResponse $response */
        $response = $this->connector->send(new EventSendRequest(
            eventName: $eventName,
            email: $email,
            userId: $userId,
            properties: $properties
        ))->dto();

        return $response;
    }
}
