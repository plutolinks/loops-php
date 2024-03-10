<?php

declare(strict_types=1);

namespace PlutoLinks\Loops\Requests\Contacts;

use PlutoLinks\Loops\Responses\Contacts\ContactCreateResponse;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class ContactCreateRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(protected readonly array $properties)
    {
    }

    public function createDtoFromResponse(Response $response): ContactCreateResponse
    {
        /** @var array{id: string|null, message: string|null, success: bool} $data */
        $data = $response->json();

        return new ContactCreateResponse(
            success: $data['success'],
            id: $data['id'] ?? null,
            message: $data['message'] ?? null
        );
    }

    protected function defaultBody(): array
    {
        return $this->properties;
    }

    public function resolveEndpoint(): string
    {
        return 'contacts/create';
    }
}
