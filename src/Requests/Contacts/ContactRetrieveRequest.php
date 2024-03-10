<?php

declare(strict_types=1);

namespace PlutoLinks\Loops\Requests\Contacts;

use PlutoLinks\Loops\DataTransferObjects\Contact;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class ContactRetrieveRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected readonly string $email)
    {
    }

    public function createDtoFromResponse(Response $response): Contact|null
    {
        /** @var array{email: string, firstName: string|null, id: string, lastName: string|null, source: string, subscribed: bool, userGroup: string, userId: string|null}|null $data */
        $data = $response->json('0');

        if (is_null($data)) {
            return null;
        }

        return Contact::from($data);
    }

    protected function defaultQuery(): array
    {
        return [
            'email' => $this->email,
        ];
    }

    public function resolveEndpoint(): string
    {
        return 'contacts/find';
    }
}
