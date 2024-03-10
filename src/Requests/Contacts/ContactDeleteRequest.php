<?php

declare(strict_types=1);

namespace PlutoLinks\Loops\Requests\Contacts;

use PlutoLinks\Loops\Responses\Contacts\ContactDeleteResponse;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class ContactDeleteRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected readonly string|null $email = null,
        protected readonly string|null $userId = null
    ) {
    }

    public function createDtoFromResponse(Response $response): ContactDeleteResponse
    {
        /** @var array{message: string, success: bool} $data */
        $data = $response->json();

        return new ContactDeleteResponse(
            message: $data['message'],
            success: $data['success']
        );
    }

    protected function defaultBody(): array
    {
        return array_filter([
            'email' => $this->email,
            'userId' => $this->userId,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return 'contacts/delete';
    }
}
