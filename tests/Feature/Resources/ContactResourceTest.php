<?php

declare(strict_types=1);

use PlutoLinks\Loops\DataTransferObjects\Contact;
use PlutoLinks\Loops\DataTransferObjects\CustomField;
use PlutoLinks\Loops\Loops;
use PlutoLinks\Loops\Requests\Contacts\ContactCreateRequest;
use PlutoLinks\Loops\Requests\Contacts\ContactCustomFieldsRequest;
use PlutoLinks\Loops\Requests\Contacts\ContactDeleteRequest;
use PlutoLinks\Loops\Requests\Contacts\ContactRetrieveRequest;
use PlutoLinks\Loops\Requests\Contacts\ContactUpdateRequest;
use PlutoLinks\Loops\Responses\Contacts\ContactCreateResponse;
use PlutoLinks\Loops\Responses\Contacts\ContactDeleteResponse;
use PlutoLinks\Loops\Responses\Contacts\ContactUpdateResponse;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function (): void {
    $this->loops = Loops::client('asdf');
});

describe('create', function (): void {
    it('can create a contact', function (): void {
        $mockClient = MockClient::global([
            ContactCreateRequest::class => MockResponse::make([
                'id' => 'asdf',
                'success' => true,
            ]),
        ]);

        $response = $this->loops->contacts()->create([
            'email' => 'john@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'source' => 'API',
            'subscribed' => true,
            'thisIsACustom' => 'property',
            'userGroup' => 'Developers',
            'userId' => 'user_asdf',
        ]);

        $mockClient->assertSent(function (ContactCreateRequest $request): bool {
            return $request->body()->all() == [
                'email' => 'john@example.com',
                'firstName' => 'John',
                'lastName' => 'Doe',
                'source' => 'API',
                'subscribed' => true,
                'thisIsACustom' => 'property',
                'userGroup' => 'Developers',
                'userId' => 'user_asdf',
            ];
        });

        expect($response)
            ->toBeInstanceOf(ContactCreateResponse::class)
            ->message->toBeNull()
            ->success->toBeTrue();
    });
});

describe('custom fields', function (): void {
    it('can list all custom fields', function (): void {
        $mockClient = MockClient::global([
            ContactCustomFieldsRequest::class => MockResponse::make([
                [
                    'key' => 'plan',
                    'label' => 'Plan',
                    'type' => 'string',
                ],
            ]),
        ]);

        $response = $this->loops->contacts()->customFields();

        $mockClient->assertSent(ContactCustomFieldsRequest::class);

        expect($response[0])
            ->toBeInstanceOf(CustomField::class)
            ->key->toBe('plan')
            ->label->toBe('Plan')
            ->type->toBe('string');
    });
});

describe('delete', function (): void {
    it('can delete a contact', function (): void {
        $mockClient = MockClient::global([
            ContactDeleteRequest::class => MockResponse::make([
                'message' => 'Contact deleted.',
                'success' => true,
            ]),
        ]);

        $response = $this->loops->contacts()->delete(email: 'john@example.com');

        $mockClient->assertSent(function (ContactDeleteRequest $request): bool {
            return $request->body()->all() == ['email' => 'john@example.com'];
        });

        expect($response)
            ->toBeInstanceOf(ContactDeleteResponse::class)
            ->message->toBe('Contact deleted.')
            ->success->toBeTrue();
    });
});

describe('retrieve', function (): void {
    it('can retrieve a contact', function (): void {
        $mockClient = MockClient::global([
            ContactRetrieveRequest::class => MockResponse::make([
                [
                    'email' => 'john@example.com',
                    'firstName' => 'John',
                    'id' => 'asdf',
                    'lastName' => 'Doe',
                    'source' => 'API',
                    'subscribed' => true,
                    'thisIsACustom' => 'property',
                    'userGroup' => 'Developers',
                    'userId' => 'user_asdf',
                ],
            ]),
        ]);

        $contact = $this->loops->contacts()->retrieve('john@example.com');

        $mockClient->assertSent(function (ContactRetrieveRequest $request): bool {
            return $request->query()->get('email') == 'john@example.com';
        });

        expect($contact)
            ->toBeInstanceOf(Contact::class)
            ->email->toBe('john@example.com')
            ->firstName->toBe('John')
            ->id->toBe('asdf')
            ->lastName->toBe('Doe')
            ->source->toBe('API')
            ->subscribed->toBeTrue()
            ->thisIsACustom->toBe('property')
            ->userGroup->toBe('Developers')
            ->userId->toBe('user_asdf');
    });
});

describe('update', function (): void {
    it('can update a contact', function (): void {
        $mockClient = MockClient::global([
            ContactUpdateRequest::class => MockResponse::make([
                'id' => 'asdf',
                'success' => true,
            ]),
        ]);

        $response = $this->loops->contacts()->update('john@example.com', [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'source' => 'API',
            'subscribed' => true,
            'thisIsACustom' => 'property',
            'userGroup' => 'Developers',
            'userId' => 'user_asdf',
        ]);

        $mockClient->assertSent(function (ContactUpdateRequest $request): bool {
            return $request->body()->all() == [
                'firstName' => 'John',
                'lastName' => 'Doe',
                'source' => 'API',
                'subscribed' => true,
                'thisIsACustom' => 'property',
                'userGroup' => 'Developers',
                'userId' => 'user_asdf',
                'email' => 'john@example.com',
            ];
        });

        expect($response)
            ->toBeInstanceOf(ContactUpdateResponse::class)
            ->success->toBeTrue()
            ->message->toBeNull();
    });
});
