<?php

declare(strict_types=1);

namespace PlutoLinks\Loops\Requests\Contacts;

use PlutoLinks\Loops\DataTransferObjects\CustomField;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class ContactCustomFieldsRequest extends Request
{
    protected Method $method = Method::GET;

    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, array{key: string, label: string, type: string}> $data */
        $data = $response->json();

        return array_map(fn (array $customField): CustomField => CustomField::from($customField), $data);
    }

    public function resolveEndpoint(): string
    {
        return 'contacts/customFields';
    }
}
