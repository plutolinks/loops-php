<?php

declare(strict_types=1);

namespace Hosmelq\Loops\Resources;

use Hosmelq\Loops\Requests\Events\EventSendRequest;
use Hosmelq\Loops\Responses\Events\EventSendResponse;
use Saloon\Http\BaseResource;

class EventResource extends BaseResource
{
    public function send(
        string $eventName,
        null|string $email = null,
        null|string $userId = null,
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
