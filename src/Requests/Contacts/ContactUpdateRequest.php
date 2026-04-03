<?php

declare(strict_types=1);

namespace Hosmelq\Loops\Requests\Contacts;

use Hosmelq\Loops\Responses\Contacts\ContactUpdateResponse;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class ContactUpdateRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        protected readonly string $email,
        protected readonly array $properties
    ) {
    }

    public function createDtoFromResponse(Response $response): ContactUpdateResponse
    {
        /** @var array{id: null|string, message: null|string, success: bool} $data */
        $data = $response->json();

        return new ContactUpdateResponse(
            success: $data['success'],
            id: $data['id'] ?? null,
            message: $data['message'] ?? null
        );
    }

    public function resolveEndpoint(): string
    {
        return 'contacts/update';
    }

    protected function defaultBody(): array
    {
        return [
            ...$this->properties,
            'email' => $this->email,
        ];
    }
}
