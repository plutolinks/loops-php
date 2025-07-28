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

    public function __construct(
        protected readonly string|null $email = null,
        protected readonly string|null $userId = null
    ) {
        if (($email === null && $userId === null) || ($email !== null && $userId !== null)) {
            throw new \InvalidArgumentException('Exactly one of email or userId must be provided');
        }
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
        return array_filter([
            'email' => $this->email,
            'userId' => $this->userId,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return 'contacts/find';
    }
}
