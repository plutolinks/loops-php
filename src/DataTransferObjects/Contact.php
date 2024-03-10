<?php

declare(strict_types=1);

namespace PlutoLinks\Loops\DataTransferObjects;

class Contact
{
    public const DEFAULT_PROPERTIES = [
        'email',
        'firstName',
        'id',
        'lastName',
        'source',
        'subscribed',
        'userGroup',
        'userId',
    ];

    public function __construct(
        public readonly string $id,
        public readonly string $email,
        public readonly string|null $firstName = null,
        public readonly string|null $lastName = null,
        public readonly string|null $source = null,
        public readonly bool $subscribed = true,
        public readonly string|null $userGroup = null,
        public readonly string|null $userId = null,
        public readonly ?array $properties = null,
    ) {
    }

    public function __get(string $name): mixed
    {
        return $this->properties[$name] ?? null;
    }

    /**
     * @param array{email: string, firstName: string|null, id: string, lastName: string|null, source: string, subscribed: bool, userGroup: string, userId: string|null} $attributes
     */
    public static function from(array $attributes): Contact
    {
        return new Contact(
            id: $attributes['id'],
            email: $attributes['email'],
            firstName: $attributes['firstName'],
            lastName: $attributes['lastName'],
            source: $attributes['source'],
            subscribed: $attributes['subscribed'],
            userGroup: $attributes['userGroup'],
            userId: $attributes['userId'],
            properties: array_diff_key($attributes, array_flip(static::DEFAULT_PROPERTIES)),
        );
    }
}
