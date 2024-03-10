# Loops PHP

## Introduction

The Loops PHP SDK provides an expressive interface for interacting with [Loops](https://loops.so)'s API.

## Requirements

Requires PHP 8.1+

## Installation

You may install Loops into your project using the Composer package manager:

```sh
composer require plutolinks/loops
```

## Usage

You can create an instance of the SDK like so:

```php
use PlutoLinks\Loops\Loops;

$loops = Loops::client('<api-key>'); 
```

### Contacts

#### Create a new contact

```php
$response = $loops->contacts()->create([
    'email' => 'john@example.com',
    'firstName' => 'John',
]);
```

You can access the properties of the response:

```php
$response->success;
$response->id;
$response->message;
```

[API Reference](https://loops.so/docs/api-reference/create-contact)

#### Retrieve a contact

```php
$contact = $loops->contacts()->retrieve('john@example.com');
```

You can access the properties of the contact:

```php
$contact->email;
$contact->firstName;
$contact->id;
$contact->lastName;
$contact->source;
$contact->subscribed;
$contact->userGroup;
$contact->userId;

$contact->favoriteColor; // Custom property
```

[API Reference](https://loops.so/docs/api-reference/find-contact)

#### Update a contact

```php
$response = $loops->contacts()->update('john@example.com', [
    'firstName' => 'John',
]);
```

You can access the properties of the response:

```php
$response->success;
$response->id;
$response->message;
```

[API Reference](https://loops.so/docs/api-reference/update-contact)

#### Delete a contact

```php
$loops->contacts()->delete(email: 'john@example.com');
```

Alternatively, you can delete a contact by its userId:

```php
$loops->contacts()->delete(userId: 'asdf');
```

You can access the properties of the response:

```php
$response->message;
$response->success;
```

[API Reference](https://loops.so/docs/api-reference/delete-contact)

#### Custom fields

```php
$fields = $loops->contacts()->customFields();
```

You can access the properties of the response:

```php
foreach ($fields as $field) {
    $field->key;
    $field->label;
    $field->type;
}
```

[API Reference](https://loops.so/docs/api-reference/list-custom-fields)

## Events

### Send event

```php
$response = $loops->events()->send(
    eventName: 'signup',
    email: 'john@example.com',
    properties: [
        'firstName' => 'John',
    ]
);
```

You can access the properties of the response:

```php
$response->success;
$response->message;
```

[API Reference](https://loops.so/docs/api-reference/send-event)

## Transactional emails

### Send transactional email

```php
$response = $loops->transactional()->send(
    transactionalId: 'asdf',
    email: 'john@example.com',
    dataVariables: [
        'url' => 'https://example.com',
    ],
    attachments: [
        [
            'contentType' => 'application/pdf', 
            'data' => '/9j/4AAQSkZJRgABAQEASABIAAD/4...', 
            'filename' => 'file.pdf', 
        ],
    ]
);
```

You can access the properties of the response:

```php
$response->success;
$response->error;
$response->message;
$response->path;
$response->transactionalId;
```

It's necessary to check for errors in different places due to the difference error responses from the Loops API.

[API Reference](https://loops.so/docs/api-reference/send-transactional-email)

## Credits

- [Hosmel Quintana](https://github.com/hosmelq)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
