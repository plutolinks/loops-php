<?php

declare(strict_types=1);

namespace Hosmelq\Loops\Requests\Contacts;

use Hosmelq\Loops\DataTransferObjects\Contact;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class ContactRetrieveRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected readonly string $email)
    {
    }

    public function createDtoFromResponse(Response $response): null|Contact
    {
        /** @var null|array{email: string, firstName: null|string, id: string, lastName: null|string, source: string, subscribed: bool, userGroup: string, userId: null|string} $data */
        $data = $response->json('0');

        if (is_null($data)) {
            return null;
        }

        return Contact::from($data);
    }

    public function resolveEndpoint(): string
    {
        return 'contacts/find';
    }

    protected function defaultQuery(): array
    {
        return [
            'email' => $this->email,
        ];
    }
}
