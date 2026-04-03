<?php

declare(strict_types=1);

namespace Hosmelq\Loops\Resources;

use Hosmelq\Loops\Requests\Transactional\TransactionalSendRequest;
use Hosmelq\Loops\Responses\Transactional\TransactionalSendResponse;
use Saloon\Http\BaseResource;

class TransactionalResource extends BaseResource
{
    /**
     * @param array<array-key, numeric|string> $dataVariables
     * @param array<array-key, array{contentType: string, data: string, filename: string}> $attachments
     */
    public function send(
        string $transactionalId,
        string $email,
        array $dataVariables = [],
        array $attachments = [],
    ): TransactionalSendResponse {
        /** @var TransactionalSendResponse $response */
        $response = $this->connector->send(new TransactionalSendRequest(
            transactionalId: $transactionalId,
            email: $email,
            dataVariables: $dataVariables,
            attachments: $attachments
        ))->dto();

        return $response;
    }
}
