<?php

declare(strict_types=1);

namespace PlutoLinks\Loops\Resources;

use PlutoLinks\Loops\DataTransferObjects\Contact;
use PlutoLinks\Loops\Requests\Contacts\ContactCreateRequest;
use PlutoLinks\Loops\Requests\Contacts\ContactCustomFieldsRequest;
use PlutoLinks\Loops\Requests\Contacts\ContactDeleteRequest;
use PlutoLinks\Loops\Requests\Contacts\ContactRetrieveRequest;
use PlutoLinks\Loops\Requests\Contacts\ContactUpdateRequest;
use PlutoLinks\Loops\Responses\Contacts\ContactCreateResponse;
use PlutoLinks\Loops\Responses\Contacts\ContactDeleteResponse;
use PlutoLinks\Loops\Responses\Contacts\ContactUpdateResponse;
use Saloon\Http\BaseResource;

class ContactResource extends BaseResource
{
    /**
     * @param array{email: string, firstName: string|null, lastName: string|null, source: string, subscribed: bool, userGroup: string|null, userId: string|null} $properties
     */
    public function create(array $properties): ContactCreateResponse
    {
        /** @var ContactCreateResponse $response */
        $response = $this->connector->send(new ContactCreateRequest($properties))->dto();

        return $response;
    }

    public function customFields(): array
    {
        /** @var array $response */
        $response = $this->connector->send(new ContactCustomFieldsRequest())->dto();

        return $response;
    }

    public function delete(string|null $email = null, string|null $userId = null): ContactDeleteResponse
    {
        /** @var ContactDeleteResponse $response */
        $response = $this->connector->send(
            new ContactDeleteRequest(email: $email, userId: $userId)
        )->dto();

        return $response;
    }

    public function retrieve(?string $email = null, ?string $userId = null): Contact|null
    {
        /** @var Contact|null $contact */
        $contact = $this->connector->send(new ContactRetrieveRequest($email, $userId))->dto();

        return $contact;
    }

    public function update(string $email, array $properties): ContactUpdateResponse
    {
        /** @var ContactUpdateResponse $response */
        $response = $this->connector->send(new ContactUpdateRequest($email, $properties))->dto();

        return $response;
    }
}
