<?php

declare(strict_types=1);

namespace Hosmelq\Loops\DataTransferObjects;

class CustomField
{
    /**
     * @param 'boolean'|'date'|'number'|'string' $type
     */
    public function __construct(
        public readonly string $key,
        public readonly string $label,
        public readonly string $type,
    ) {
    }

    /**
     * @param array{key: string, label: string, type: 'boolean'|'date'|'number'|'string'} $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            key: $attributes['key'],
            label: $attributes['label'],
            type: $attributes['type']
        );
    }
}
