<?php

declare(strict_types=1);

namespace Hosmelq\Loops\DataTransferObjects;

class Contact
{
    /**
     * @var list<string>
     */
    public const array DEFAULT_PROPERTIES = [
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
        public readonly null|string $firstName = null,
        public readonly null|string $lastName = null,
        public readonly null|string $source = null,
        public readonly bool $subscribed = true,
        public readonly null|string $userGroup = null,
        public readonly null|string $userId = null,
        public readonly null|array $properties = null,
    ) {
    }

    /**
     * @param array{email: string, firstName: null|string, id: string, lastName: null|string, source: string, subscribed: bool, userGroup: string, userId: null|string} $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
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

    public function __get(string $name): mixed
    {
        return $this->properties[$name] ?? null;
    }
}
