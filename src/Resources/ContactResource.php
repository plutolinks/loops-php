<?php

declare(strict_types=1);

namespace Hosmelq\Loops\Resources;

use Hosmelq\Loops\DataTransferObjects\Contact;
use Hosmelq\Loops\Requests\Contacts\ContactCreateRequest;
use Hosmelq\Loops\Requests\Contacts\ContactCustomFieldsRequest;
use Hosmelq\Loops\Requests\Contacts\ContactDeleteRequest;
use Hosmelq\Loops\Requests\Contacts\ContactRetrieveRequest;
use Hosmelq\Loops\Requests\Contacts\ContactUpdateRequest;
use Hosmelq\Loops\Responses\Contacts\ContactCreateResponse;
use Hosmelq\Loops\Responses\Contacts\ContactDeleteResponse;
use Hosmelq\Loops\Responses\Contacts\ContactUpdateResponse;
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

    public function retrieve(string $email): Contact
    {
        /** @var Contact $contact */
        $contact = $this->connector->send(new ContactRetrieveRequest($email))->dto();

        return $contact;
    }

    public function update(string $email, array $properties): ContactUpdateResponse
    {
        /** @var ContactUpdateResponse $response */
        $response = $this->connector->send(new ContactUpdateRequest($email, $properties))->dto();

        return $response;
    }
}
